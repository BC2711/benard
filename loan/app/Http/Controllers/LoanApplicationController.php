<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLoanApplicationRequest;
use App\Models\LoanApplication;
use App\Services\EmailDeliveryService;
use App\Services\EmailSettingsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class LoanApplicationController extends Controller
{
    public function store(
        StoreLoanApplicationRequest $request,
        EmailDeliveryService $email,
        EmailSettingsService $settings,
    ): JsonResponse
    {
        $data = $request->validated();

        try {
            $context = [
                'full_name' => $data['fullname'],
                'email' => $data['email'],
                'phone' => $data['phone'] ?? 'Not provided',
                'company' => $data['company'] ?? 'Not provided',
                'business_type' => $this->label($data['businessType']),
                'loan_amount' => strtoupper($data['loanAmount']),
                'loan_purpose' => $this->label($data['loanPurpose']),
                'timeline' => $this->label($data['timeline'] ?? 'Not provided'),
                'message' => $data['message'] ?? 'No additional message provided.',
            ];

            $application = LoanApplication::create([
                'full_name' => $data['fullname'],
                'email' => $data['email'],
                'phone' => $data['phone'] ?? null,
                'company' => $data['company'] ?? null,
                'business_type' => $data['businessType'],
                'loan_amount' => $data['loanAmount'],
                'loan_purpose' => $data['loanPurpose'],
                'timeline' => $data['timeline'] ?? null,
                'message' => $data['message'] ?? null,
            ]);

            try {
                $email->queue('loan_application.admin', $settings->adminRecipients(), $context);
                $email->queue('loan_application.confirmation', $data['email'], $context);
            } catch (\Throwable $exception) {
                Log::error('Loan application email queueing failed', [
                    'application_id' => $application->id,
                    'error' => $exception->getMessage(),
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Application submitted! We\'ll contact you within 24 hours.'
            ]);
        } catch (\Exception $e) {
            Log::error('Loan application failed: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to submit application. Please try again or contact support.'
            ], 500);
        }
    }

    private function label(string $value): string
    {
        return ucwords(str_replace('-', ' ', $value));
    }
}
