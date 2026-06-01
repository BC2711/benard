<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreConsultationRequest;
use App\Models\ConsultationRequest;
use App\Services\EmailDeliveryService;
use App\Services\EmailSettingsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ConsultationController extends Controller
{
    public function index(Request $request)
    {
        $consultations = ConsultationRequest::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->string('search')->toString();

                $query->where(function ($query) use ($search) {
                    $query->where('first_name', 'ilike', "%{$search}%")
                        ->orWhere('last_name', 'ilike', "%{$search}%")
                        ->orWhere('email', 'ilike', "%{$search}%")
                        ->orWhere('phone', 'ilike', "%{$search}%");
                });
            })
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->string('status')))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $stats = [
            'total' => ConsultationRequest::count(),
            'new' => ConsultationRequest::where('status', 'new')->count(),
            'scheduled' => ConsultationRequest::where('status', 'scheduled')->count(),
            'cancelled' => ConsultationRequest::where('status', 'cancelled')->count(),
        ];

        return view('components.management.consultation.index', compact('consultations', 'stats'));
    }

    public function create()
    {
        return view('components.management.consultation.create', [
            'consultation' => new ConsultationRequest(),
        ]);
    }

    public function show(ConsultationRequest $consultation)
    {
        return view('components.management.consultation.show', compact('consultation'));
    }

    public function edit(ConsultationRequest $consultation)
    {
        return view('components.management.consultation.request-edit', compact('consultation'));
    }

    public function destroy(ConsultationRequest $consultation)
    {
        $consultation->delete();

        return redirect()->route('management.consultation.index')->with('success', 'Consultation request deleted successfully.');
    }

    public function update(Request $request, ConsultationRequest $consultation)
    {
        $consultation->update($this->validateManagementRequest($request));

        return redirect()
            ->route('management.consultation.show', $consultation)
            ->with('success', 'Consultation request updated successfully.');
    }

    public function store(
        StoreConsultationRequest $request,
        EmailDeliveryService $email,
        EmailSettingsService $settings,
    ) {
        try {
            $consultation = ConsultationRequest::create($request->validated());
            $context = [
                'first_name' => $consultation->first_name,
                'full_name' => "{$consultation->first_name} {$consultation->last_name}",
                'email' => $consultation->email,
                'phone' => $consultation->phone,
                'preferred_date' => $consultation->preferred_date->format('F j, Y'),
                'preferred_time' => $consultation->preferred_time->format('g:i A'),
                'message' => $consultation->message ?: 'No additional message provided.',
            ];

            try {
                $email->queue('consultation.admin', $settings->adminRecipients(), $context);
                $email->queue('consultation.confirmation', $consultation->email, $context);
            } catch (\Throwable $exception) {
                Log::error('Consultation email queueing failed', [
                    'consultation_id' => $consultation->id,
                    'error' => $exception->getMessage(),
                ]);
            }

            if ($request->routeIs('management.consultation.store')) {
                return redirect()
                    ->route('management.consultation.show', $consultation)
                    ->with('success', 'Consultation request created successfully.');
            }

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Thank you! Your consultation request has been received. We\'ll contact you soon.'
                ]);
            }

            return back()->with('success', 'Thank you! We\'ll contact you soon to confirm your appointment.');
        } catch (\Exception $e) {
            Log::error('Consultation submission error: ' . $e->getMessage());

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred while submitting your request. Please try again.'
                ], 500);
            }

            return back()->with('error', 'An error occurred. Please try again.');
        }
    }

    private function validateManagementRequest(Request $request): array
    {
        return $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'preferred_date' => ['required', 'date'],
            'preferred_time' => ['required', 'date_format:H:i'],
            'message' => ['nullable', 'string', 'max:2000'],
            'status' => ['required', 'in:new,contacted,scheduled,cancelled'],
        ]);
    }
}
