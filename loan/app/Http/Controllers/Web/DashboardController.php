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
            $total_users = User::count();
            $active_users = User::where('status', 'ACTIVE')->count();
            $pending_users = User::where('status', 'PENDING')->count();

            $total_consultations = DB::table('consultation_requests')->count();
            $pending_consultations =  DB::table('consultation_requests')->where('status', 'new')->count();
            $completed_consultations =  DB::table('consultation_requests')->where('status', 'scheduled')->count();

            $total_subscribers = DB::table('newsletter_subscribers')->count();

            // Recent data for tables
            $recent_consultations = DB::table('consultation_requests')->latest()
                ->take(4)
                ->get();

            $recent_users = User::latest()
                ->take(5)
                ->get();

            $startDate = now()->subDays(7)->startOfDay();
            $endDate = now()->endOfDay();

            // PostgreSQL compatible query
            $consultation_trend = DB::table('consultation_requests')
                ->select(
                    DB::raw('EXTRACT(DOW FROM created_at) as day_of_week'),
                    DB::raw('TO_CHAR(created_at, \'Day\') as day_name'),
                    DB::raw('COUNT(*) as count')
                )
                ->whereBetween('created_at', [$startDate, $endDate])
                ->groupBy('day_of_week', 'day_name')
                ->orderBy('day_of_week')
                ->get();

            // Define day mapping for PostgreSQL (0=Sunday, 1=Monday, ..., 6=Saturday)
            $daysOfWeek = [
                1 => 'Monday',
                2 => 'Tuesday',
                3 => 'Wednesday',
                4 => 'Thursday',
                5 => 'Friday',
                6 => 'Saturday',
                0 => 'Sunday'
            ];

            $dayMap = [
                'Monday' => 'Mon',
                'Tuesday' => 'Tue',
                'Wednesday' => 'Wed',
                'Thursday' => 'Thu',
                'Friday' => 'Fri',
                'Saturday' => 'Sat',
                'Sunday' => 'Sun'
            ];

            // Initialize all days with 0
            $counts = [];
            foreach ($daysOfWeek as $dayNumber => $dayName) {
                $counts[$dayName] = 0;
            }

            // Fill with actual data
            foreach ($consultation_trend as $data) {
                // PostgreSQL returns day names with trailing spaces, so trim them
                $dayName = trim($data->day_name);
                if (isset($counts[$dayName])) {
                    $counts[$dayName] = $data->count;
                }
            }

            // Build the converted data array for amCharts
            $convertedData = [];
            foreach ($daysOfWeek as $dayNumber => $dayName) {
                $convertedData[] = [
                    'country' => $dayMap[$dayName],
                    'value' => $counts[$dayName]
                ];
            }

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
                'consultation_trend' => $convertedData,
            ];

            // Debug info
            // Log::info('Dashboard stats loaded', [
            //     'users' => $total_users,
            //     'consultations' => $total_consultations,
            //     'subscribers' => $total_subscribers,
            //     'chart_data' => $convertedData
            // ]);

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
                    ['country' => 'Mon', 'value' => 0],
                    ['country' => 'Tue', 'value' => 0],
                    ['country' => 'Wed', 'value' => 0],
                    ['country' => 'Thu', 'value' => 0],
                    ['country' => 'Fri', 'value' => 0],
                    ['country' => 'Sat', 'value' => 0],
                    ['country' => 'Sun', 'value' => 0]
                ],
            ];

            return view('pages.admin.dashboard')
                ->with('stats', $fallback_stats)
                ->with('error', 'Unable to load dashboard data: ' . $e->getMessage());
        }
    }
}
