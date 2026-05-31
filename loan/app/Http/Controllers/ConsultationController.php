<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreConsultationRequest;
use App\Models\ConsultationRequest;
use App\Services\EmailDeliveryService;
use App\Services\EmailSettingsService;
use Illuminate\Support\Facades\Log;

class ConsultationController extends Controller
{
    public function store(
        StoreConsultationRequest $request,
        EmailDeliveryService $email,
        EmailSettingsService $settings,
    )
    {
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
}
