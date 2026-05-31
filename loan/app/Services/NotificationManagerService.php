<?php

namespace App\Services;

use App\Models\Notification;
use Illuminate\Support\Facades\Log;

class NotificationManagerService
{
    public function __construct(private readonly EmailDeliveryService $email)
    {
    }

    /**
     * Send notification based on type
     */
    public function sendNotification(Notification $notification): bool
    {
        try {
            switch ($notification->type) {
                case Notification::TYPE_EMAIL:
                    return $this->sendEmail($notification);

                case Notification::TYPE_SMS:
                    return $this->sendSms($notification);

                case Notification::TYPE_SUBSCRIBE:
                    return $this->subscribeToNewsletter($notification);

                default:
                    Log::warning("Unknown notification type: {$notification->type}");
                    return false;
            }
        } catch (\Exception $e) {
            Log::error("Notification sending failed: " . $e->getMessage());
            $notification->markAsFailed($e->getMessage());
            return false;
        }
    }

    /**
     * Send email notification
     */
    private function sendEmail(Notification $notification): bool
    {
        if (!$notification->email) {
            throw new \Exception("Email address is required for email notifications");
        }

        $this->email->queue('notification.generic', $notification->email, [
            'full_name' => $notification->full_name,
            'message' => $notification->message,
            'subject' => $notification->subject ?? 'Notification from ' . config('app.name'),
        ]);

        $notification->markAsSent("Email queued successfully for {$notification->email}");
        return true;
    }

    /**
     * Subscribe to newsletter
     */
    public function subscribeToNewsletter(Notification $notification): bool
    {
        if (!$notification->email) {
            throw new \Exception("Email address is required for newsletter subscription");
        }

        $this->email->queue('newsletter.confirmation', $notification->email, [
            'email' => $notification->email,
        ]);

        $notification->markAsSent("Newsletter confirmation queued for {$notification->email}");
        return true;
    }

    /**
     * Send SMS notification
     */
    private function sendSms(Notification $notification): bool
    {
        if (!$notification->phone) {
            throw new \Exception("Phone number is required for SMS notifications");
        }

        $smsSent = $this->sendViaSmsGateway($notification->phone, $notification->message);

        if ($smsSent) {
            $notification->markAsSent("SMS sent successfully to {$notification->phone}");
            return true;
        } else {
            throw new \Exception("SMS failed to send to: " . $notification->phone);
        }
    }

    private function sendViaSmsGateway($phone, $message): bool
    {
        Log::info("SMS would be sent to: {$phone} - Message: {$message}");

        return true;
    }

    /**
     * Create and send notification immediately
     */
    public function createAndSend(array $data): bool
    {
        $notification = Notification::create($data);
        return $this->sendNotification($notification);
    }

    /**
     * Process pending notifications
     */
    public function processPendingNotifications(): array
    {
        $pendingNotifications = Notification::pending()->get();
        $results = ['sent' => 0, 'failed' => 0];

        foreach ($pendingNotifications as $notification) {
            if ($this->sendNotification($notification)) {
                $results['sent']++;
            } else {
                $results['failed']++;
            }
        }

        return $results;
    }

    /**
     * Get notification statistics
     */
    public function getStatistics($days = 30): array
    {
        return [
            'total' => Notification::recent($days)->count(),
            'email' => Notification::email()->recent($days)->count(),
            'sms' => Notification::sms()->recent($days)->count(),
            'subscribe' => Notification::where('type', Notification::TYPE_SUBSCRIBE)->recent($days)->count(),
            'sent' => Notification::recent($days)->where('status', Notification::STATUS_SENT)->count(),
            'pending' => Notification::recent($days)->where('status', Notification::STATUS_PENDING)->count(),
            'failed' => Notification::recent($days)->where('status', Notification::STATUS_FAILED)->count(),
        ];
    }

    public function get_all($days = 30)
    {
        return  Notification::where('type', 'EMAIL')->orderBy('created_at', 'desc')->get();
    }
}
