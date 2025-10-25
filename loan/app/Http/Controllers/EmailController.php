<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function send_loan_application_email(Request $request): JsonResponse
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'business' => 'required|string|max:255',
            'loan_amount' => 'required|string|max:255',
            'purpose' => 'required|string|max:255',
            'message' => 'nullable|string|max:1000'
        ]);

        try {
            // Store the application in the database
            $notification = Notification::create([
                'type' => 'EMAIL',
                'full_name' => $request->fullname,
                'email' => $request->email,
                'phone' => $request->phone,
                'subject' => 'New Loan Application - ' . $request->fullname,
                'message' => $this->formatApplicationMessage($request->all()),
                'status' => 'PENDING'
            ]);

            // Send email notification
            $this->sendApplicationEmail($request->all());

            // Update status to sent
            $notification->update(['status' => 'SENT']);

            return response()->json([
                'success' => true,
                'message' => 'Your loan application has been submitted successfully! Our team will contact you within 24 hours.'
            ]);
        } catch (\Exception $e) {
            Log::error('Loan application failed: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to submit application. Please try again later.'
            ], 500);
        }
    }

    private function formatApplicationMessage(array $data): string
    {
        return "New Loan Application Received:
                Name: {$data['fullname']}
                Email: {$data['email']}
                Phone: " . ($data['phone'] ?: 'Not provided') . "
                Business Type: {$data['business']}
                Desired Loan Amount: {$data['loan_amount']}
                Loan Purpose: {$data['purpose']}

                Message:" . ($data['message'] ?: 'No additional message provided') . "
        ";
    }

    private function sendApplicationEmail(array $data): bool
    {
        try {
            Mail::send('emails.loan_application', $data, function ($message) use ($data) {
                $message->to('binesschama1127@gmail.com')
                    ->subject('New Loan Application - ' . $data['fullname']);
            });

            return count(Mail::failures()) === 0;
        } catch (\Exception $e) {
            Log::error('Loan application email failed: ' . $e->getMessage());
            return false;
        }
    }
}
