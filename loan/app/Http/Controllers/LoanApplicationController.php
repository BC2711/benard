<?php

// app/Http/Controllers/LoanApplicationController.php
namespace App\Http\Controllers;

use App\Http\Requests\StoreLoanApplicationRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\LoanApplicationSubmitted;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class LoanApplicationController extends Controller
{
    public function store(StoreLoanApplicationRequest $request): JsonResponse
    {
        $data = $request->validated();

        try {
            // Send email (configure in .env)
            Mail::to(config('mail.from.address'))->send(new LoanApplicationSubmitted($data));

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
}
