<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreConsultationRequest;
use App\Models\ConsultationRequest;
use App\Mail\ConsultationReceived;
use App\Mail\ConsultationConfirmation;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ConsultationController extends Controller
{
    public function store(StoreConsultationRequest $request)
    {
        try {
            // Create record
            $consultation = ConsultationRequest::create($request->validated());

            // Send email to admin
            try {
                Mail::to(config('mail.from.address'))
                    ->send(new ConsultationReceived($consultation));
            } catch (\Exception $e) {
                Log::error('Admin email failed: ' . $e->getMessage());
            }

            // Send confirmation to user
            try {
                Mail::to($consultation->email)
                    ->send(new ConsultationConfirmation($consultation));
            } catch (\Exception $e) {
                Log::error('User confirmation email failed: ' . $e->getMessage());
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
