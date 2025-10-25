<?php

namespace App\Http\Controllers;

use App\Mail\LoanApplicationEmail;
use App\Mail\NewslatterMail;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use InvalidArgumentException;

abstract class Controller
{
    private function send_newsletter_email($to, $subject, $body, $queue = false)
    {
        try {
            // Validate email address
            if (!filter_var($to, FILTER_VALIDATE_EMAIL)) {
                throw new InvalidArgumentException("Invalid email address: " . $to);
            }

            $mail = new NewslatterMail($subject, $body);

            if ($queue) {
                // Send email to queue
                Mail::to($to)->queue($mail);
                Log::info("Email queued for sending to: {$to}, Subject: {$subject}");
            } else {
                // Send email immediately
                Mail::to($to)->send($mail);

                if (count(Mail::failures()) > 0) {
                    throw new Exception("Email failed to send to: " . $to);
                }

                Log::info("Email sent successfully to: {$to}, Subject: {$subject}");
            }

            return true;
        } catch (\Exception $e) {
            Log::error("Failed to send email to: {$to}, Error: " . $e->getMessage());
            return false;
        }
    }

    private function send_loan_application_email($to, $subject, $body, $isLoanApplication = false, $loanData = [])
    {
        try {
            // Validate email address
            if (!filter_var($to, FILTER_VALIDATE_EMAIL)) {
                throw new InvalidArgumentException("Invalid email address: " . $to);
            }

            if ($isLoanApplication && !empty($loanData)) {
                // Send loan application email with template
                Mail::to($to)->send(new LoanApplicationEmail($loanData));
            } else {
                // Send regular email
                Mail::send([], [], function ($message) use ($to, $subject, $body) {
                    $message->to($to)
                        ->subject($subject)
                        ->html($body);
                });
            }

            // Check if email was sent successfully
            if (count(Mail::failures()) > 0) {
                throw new Exception("Email failed to send to: " . $to);
            }

            Log::info("Email sent successfully to: {$to}, Subject: {$subject}");

            return true;
        } catch (\Exception $e) {
            Log::error("Failed to send email to: {$to}, Error: " . $e->getMessage());
            return false;
        }
    }
}
