<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ConsultationRequest;
use App\Models\NewsletterSubscriber;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class DashboardController extends Controller
{
    protected $notificationService;

    public function __construct()
    {
        $this->notificationService = new \App\Services\NotificationManagerService();
    }

    public function index()
    {
        try {
            // Use count() instead of get() for better performance
            $total_users = User::count();
            $active_users = User::where('status', 'ACTIVE')->count();
            $pending_users = User::where('status', 'PENDING')->count();

            // Remove soft deletes check since table doesn't have deleted_at
            $total_consultations = ConsultationRequest::whereIn('status', ['new', 'contacted', 'scheduled', 'cancelled'])->count();
            $pending_consultations = ConsultationRequest::where('status', 'new')->count();
            $completed_consultations = ConsultationRequest::where('status', 'scheduled')->count();

            $total_subscribers = NewsletterSubscriber::count();

            // Recent data for tables
            $recent_consultations = ConsultationRequest::latest()
                ->take(5)
                ->get();

            $recent_users = User::latest()
                ->take(5)
                ->get();

            // Chart data - last 7 days consultations (simplified for now)
            $consultation_trend = [
                'labels' => ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                'data' => [3, 5, 2, 8, 6, 9, 4]
            ];

            $stats = [
                'total_users' => $total_users,
                'active_users' => $active_users,
                'pending_users' => $pending_users,
                'total_consultation' => $total_consultations,
                'pending_consultation' => $pending_consultations,
                'completed_consultation' => $completed_consultations,
                'total_subscribers' => $total_subscribers,
                'recent_consultation' => $recent_consultations,
                'recent_users' => $recent_users,
                'consultation_trend' => $consultation_trend,
            ];

            // Debug info
            Log::info('Dashboard stats loaded', [
                'users' => $total_users,
                'consultations' => $total_consultations,
                'subscribers' => $total_subscribers
            ]);

            return view('pages.admin.dashboard', compact('stats'));
        } catch (\Exception $e) {
            Log::error('Dashboard error: ' . $e->getMessage());

            // Provide fallback stats in case of error
            $fallback_stats = [
                'total_users' => 0,
                'active_users' => 0,
                'pending_users' => 0,
                'total_consultation' => 0,
                'pending_consultation' => 0,
                'completed_consultation' => 0,
                'total_subscribers' => 0,
                'recent_consultation' => collect(),
                'recent_users' => collect(),
                'consultation_trend' => [
                    'labels' => ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                    'data' => [0, 0, 0, 0, 0, 0, 0]
                ],
            ];

            return view('pages.admin.dashboard')
                ->with('stats', $fallback_stats)
                ->with('error', 'Unable to load dashboard data: ' . $e->getMessage());
        }
    }
}
