<?php
// app/Http/Controllers/NotificationController.php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Services\NotificationManagerService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class NotificationController extends Controller
{
    protected $notificationService;

    public function __construct()
    {
        // Manual instantiation to avoid dependency injection issues
        $this->notificationService = new \App\Services\NotificationManagerService();
    }

    /**
     * Send a new notification
     */
    public function sendNotification(Request $request): JsonResponse
    {
        $request->validate([
            'type' => 'required|in:EMAIL,SMS,SUBSCRIBE',
            'email' => 'required_if:type,EMAIL,SUBSCRIBE|email',
            'phone' => 'required_if:type,SMS',
            'message' => 'required|string',
            'full_name' => 'nullable|string',
            'subject' => 'nullable|string'
        ]);

        try {
            $success = $this->notificationService->createAndSend($request->all());

            if ($success) {
                return response()->json([
                    'success' => true,
                    'message' => 'Notification sent successfully'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to send notification'
                ], 500);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Subscribe to newsletter - FIXED (removed dd())
     */
    public function subscribeNewsletter(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'full_name' => 'nullable|string'
        ]);

        try {
            $success = $this->notificationService->createAndSend([
                'type' => 'SUBSCRIBE',
                'email' => $request->email,
                'full_name' => $request->full_name ?? '',
                'subject' => 'Newsletter Subscription',
                'message' => 'New newsletter subscription request'
            ]);

            // Remove the dd() statement and uncomment the proper return statements
            if ($success) {
                return response()->json([
                    'success' => true,
                    'message' => 'Successfully subscribed to newsletter!'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to subscribe to newsletter'
                ], 500);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get notifications for header dropdowns
     */
    public function getHeaderNotifications(Request $request): JsonResponse
    {
        try {
            $type = $request->get('type', 'EMAIL');
            $query = Notification::query();

            // Filter by type if provided
            if ($type) {
                $query->where('type', $type);
            }

            // Get recent notifications (last 10)
            $notifications = $query->orderBy('created_at', 'desc')
                ->take(10)
                ->get();

            // Transform notifications based on type
            if ($type === 'MESSAGE') {
                $formattedNotifications = $notifications->map(function ($notification) {
                    return [
                        'id' => $notification->id,
                        'name' => $notification->full_name ?: 'Customer',
                        'avatar' => $this->generateAvatar($notification->email),
                        'preview' => substr($notification->message, 0, 50) . '...',
                        'time' => $notification->created_at->diffForHumans(),
                        'unread' => $notification->status === 'PENDING',
                        'url' => '/messages/' . $notification->id
                    ];
                });
            } else {
                $formattedNotifications = $notifications->map(function ($notification) {
                    return [
                        'id' => $notification->id,
                        'title' => $this->getNotificationTitle($notification),
                        'message' => $notification->message,
                        'type' => strtolower($notification->type),
                        'time' => $notification->created_at->diffForHumans(),
                        'unread' => $notification->status === 'PENDING',
                        'url' => $this->getNotificationUrl($notification)
                    ];
                });
            }

            $unreadCount = $query->where('status', 'PENDING')->count();

            return response()->json([
                'success' => true,
                'notifications' => $formattedNotifications,
                'unread_count' => $unreadCount
            ]);
        } catch (\Exception $e) {
            // Return empty data with success false for frontend to use fallback
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch notifications',
                'notifications' => [],
                'unread_count' => 0
            ], 500);
        }
    }

    /**
     * Generate avatar URL from email
     */
    private function generateAvatar($email): string
    {
        $hash = md5(strtolower(trim($email)));
        return "https://www.gravatar.com/avatar/{$hash}?d=identicon&s=128";
    }

    /**
     * Get notification title based on type and content
     */
    private function getNotificationTitle(Notification $notification): string
    {
        return match ($notification->type) {
            'EMAIL' => 'New Email',
            'SMS' => 'SMS Notification',
            'SUBSCRIBE' => 'Newsletter Subscription',
            'MESSAGE' => 'New Message',
            default => 'Notification'
        };
    }

    /**
     * Get notification URL based on type
     */
    private function getNotificationUrl(Notification $notification): string
    {
        return match ($notification->type) {
            'EMAIL' => '/notifications/emails/' . $notification->id,
            'SMS' => '/notifications/sms/' . $notification->id,
            'SUBSCRIBE' => '/subscribers/' . $notification->id,
            'MESSAGE' => '/messages/' . $notification->id,
            default => '/notifications/' . $notification->id
        };
    }

    /**
     * Mark notification as read
     */
    public function markAsRead(Notification $notification): JsonResponse
    {
        try {
            $notification->update(['status' => 'SENT']);

            return response()->json([
                'success' => true,
                'message' => 'Notification marked as read'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to mark notification as read'
            ], 500);
        }
    }

    /**
     * Mark all notifications as read
     */
    public function markAllAsRead(Request $request): JsonResponse
    {
        try {
            $type = $request->get('type', 'EMAIL');

            Notification::where('type', $type)
                ->where('read', 0)
                ->update(['read' => 1]);

            return response()->json([
                'success' => true,
                'message' => 'All notifications marked as read'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to mark all notifications as read'
            ], 500);
        }
    }

    /**
     * Get notification statistics
     */
    public function statistics(): JsonResponse
    {
        try {
            $stats = $this->notificationService->getStatistics();

            return response()->json([
                'success' => true,
                'data' => $stats
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Process pending notifications
     */
    public function processPending(): JsonResponse
    {
        try {
            $results = $this->notificationService->processPendingNotifications();

            return response()->json([
                'success' => true,
                'message' => 'Processed pending notifications',
                'data' => $results
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * List notifications (for admin panel)
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $query = Notification::query();

            if ($request->has('type')) {
                $query->where('type', $request->type);
            }

            if ($request->has('status')) {
                $query->where('status', $request->status);
            }

            if ($request->has('read')) {
                $query->where('read', $request->boolean('read'));
            }

            $notifications = $query->orderBy('created_at', 'desc')
                ->paginate($request->get('per_page', 20));

            // Get total count with the same filters
            $count = (clone $query)->count();

            return response()->json([
                'success' => true,
                'data' => $notifications,
                'count' => $count
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
