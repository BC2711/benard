<?php

namespace App\Services;

use App\Jobs\SendTemplatedEmail;
use App\Mail\SystemEmail;
use App\Models\EmailDeliveryLog;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class EmailDeliveryService
{
    public function __construct(
        private readonly EmailSettingsService $settings,
        private readonly EmailTemplateService $templates,
    ) {
    }

    public function queue(string $templateKey, string|array $recipients, array $context = []): array
    {
        $rendered = $this->templates->render($templateKey, $context);

        if (!$this->settings->mailEnabled() || !$rendered['enabled']) {
            Log::info('Email notification disabled', ['template' => $templateKey]);

            return [];
        }

        $logs = [];
        foreach ((array) $recipients as $recipient) {
            if (!filter_var($recipient, FILTER_VALIDATE_EMAIL)) {
                Log::warning('Skipped invalid email recipient', ['template' => $templateKey, 'recipient' => $recipient]);
                continue;
            }

            $log = EmailDeliveryLog::create([
                'tracking_token' => (string) Str::uuid(),
                'template_key' => $templateKey,
                'recipient' => $recipient,
                'subject' => $rendered['subject'],
                'context' => $context,
                'status' => 'queued',
                'queued_at' => now(),
            ]);

            SendTemplatedEmail::dispatch($log->id)->onQueue('emails');
            $logs[] = $log;
        }

        return $logs;
    }

    public function deliver(EmailDeliveryLog $log): void
    {
        $this->settings->applyMailerConfiguration();
        $rendered = $this->templates->render($log->template_key, $log->context ?? []);

        $log->increment('attempts');

        Mail::to($log->recipient)->send(new SystemEmail(
            subjectLine: $rendered['subject'],
            htmlBody: $rendered['html'],
            textBody: $rendered['text'],
            trackingToken: $log->tracking_token,
            actionUrl: $log->context['action_url'] ?? null,
            actionText: $log->context['action_text'] ?? null,
        ));

        $log->update([
            'subject' => $rendered['subject'],
            'status' => 'sent',
            'sent_at' => now(),
            'failed_at' => null,
            'error_message' => null,
        ]);
    }

    public function recordFailure(EmailDeliveryLog $log, \Throwable $exception, bool $final = false): void
    {
        $log->update([
            'status' => $final ? 'failed' : 'retrying',
            'failed_at' => $final ? now() : null,
            'error_message' => Str::limit($exception->getMessage(), 2000),
        ]);

        Log::error('Email delivery failed', [
            'log_id' => $log->id,
            'template' => $log->template_key,
            'recipient' => $log->recipient,
            'attempts' => $log->attempts,
            'final' => $final,
            'error' => $exception->getMessage(),
        ]);
    }
}
