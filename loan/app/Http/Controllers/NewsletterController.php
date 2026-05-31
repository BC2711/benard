<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsletterSubscriber;
use App\Rules\Recaptcha;
use App\Services\EmailDeliveryService;
use App\Services\EmailSettingsService;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class NewsletterController extends Controller
{
    public function store(Request $request, EmailDeliveryService $email, EmailSettingsService $settings)
    {
        $request->validate([
            'email' => 'required|email|max:255|unique:newsletter_subscribers,email',
            'website' => 'nullable|string|max:0',
            'g-recaptcha-response' => [
                Rule::requiredIf((bool) config('services.recaptcha.secret_key')),
                new Recaptcha(),
            ],
        ]);

        NewsletterSubscriber::create(['email' => $request->email]);

        try {
            $context = ['email' => $request->email];
            $email->queue('newsletter.confirmation', $request->email, $context);
            $email->queue('newsletter.admin', $settings->adminRecipients(), $context);
        } catch (\Throwable $exception) {
            Log::error('Newsletter email queueing failed', [
                'email' => $request->email,
                'error' => $exception->getMessage(),
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Thank you! You\'re subscribed to our newsletter.'
        ]);
    }
}
