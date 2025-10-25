<?php
// app/Services/NotificationManagerService.php

namespace App\Services;

use App\Models\Notification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class NotificationManagerService
{
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

        $data = [
            'full_name' => $notification->full_name,
            'message' => $notification->message,
            'subject' => $notification->subject
        ];

        Mail::send('emails.notification', $data, function ($message) use ($notification) {
            $message->to($notification->email)
                ->subject($notification->subject ?? 'Notification from ' . config('app.name'));
        });

        if (count(Mail::failures()) > 0) {
            throw new \Exception("Email failed to send to: " . $notification->email);
        }

        $notification->markAsSent("Email sent successfully to {$notification->email}");
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

        $data = [
            'full_name' => $notification->full_name,
            'message' => "Welcome to the Londa loan news! You have successfully subscribed to our newsletter.",
            'subject' => "Welcome to Londa Loan News"
        ];

        Mail::send('emails.newslatter', $data, function ($message) use ($notification) {
            $message->to($notification->email)
                ->subject('Welcome to Londa Loan Newsletter');
        });

        if (count(Mail::failures()) > 0) {
            throw new \Exception("Welcome email failed to send to: " . $notification->email);
        }

        $notification->markAsSent("Newsletter subscription confirmed and email sent to {$notification->email}");
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

    /**
     * Placeholder for SMS gateway integration
     */
    private function sendViaSmsGateway($phone, $message): bool
    {
        // Implement your preferred SMS gateway (Twilio, Nexmo, etc.)
        Log::info("SMS would be sent to: {$phone} - Message: {$message}");

        // For demo purposes, return true
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
