<?php

namespace App\Jobs;

use App\Models\EmailDeliveryLog;
use App\Services\EmailDeliveryService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendTemplatedEmail implements ShouldQueue
{
    use Queueable;

    public int $tries = 3;

    public array $backoff = [60, 300, 900];

    public function __construct(public readonly int $deliveryLogId)
    {
    }

    public function handle(EmailDeliveryService $delivery): void
    {
        $log = EmailDeliveryLog::findOrFail($this->deliveryLogId);

        try {
            $delivery->deliver($log);
        } catch (\Throwable $exception) {
            $delivery->recordFailure($log->fresh(), $exception);
            throw $exception;
        }
    }

    public function failed(?\Throwable $exception): void
    {
        if ($exception && ($log = EmailDeliveryLog::find($this->deliveryLogId))) {
            app(EmailDeliveryService::class)->recordFailure($log, $exception, true);
        }
    }
}
