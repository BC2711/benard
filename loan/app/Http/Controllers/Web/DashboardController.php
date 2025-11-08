<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ConsultationRequest;
use App\Models\NewsletterSubscriber;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    protected $notificationService;

    public function __construct()
    {
        // Manual instantiation to avoid dependency injection issues
        $this->notificationService = new \App\Services\NotificationManagerService();
    }

    /**
     * Display a listing of the resource.
     */
    // app/Http/Controllers/Web/DashboardController.php
    public function index()
    {
        try {
            $stats = [
                'total_users' => User::count(),
                'total_consultations' => ConsultationRequest::count(),
                'total_subscribers' => NewsletterSubscriber::count(),
                'pending_consultations' => ConsultationRequest::where('status', 'pending')->count(),
                'recent_users' => User::latest()->take(5)->get(),
                'recent_consultations' => ConsultationRequest::with('user')->latest()->take(5)->get(),
            ];
            dd($stats['total_users']);
            return view('pages.admin.dashboard', compact('stats'));
        } catch (\Exception $e) {
            Log::error('Dashboard error: ' . $e->getMessage());

            // Always pass $stats (even empty) to avoid undefined variable
            $stats = [
                'total_users' => 0,
                'total_consultations' => 0,
                'total_subscribers' => 0,
                'pending_consultations' => 0,
                'recent_users' => collect(),
                'recent_consultations' => collect(),
            ];
//  dd($stats['total_users']);
            return view('pages.admin.dashboard', compact('stats'))
                ->with('error', 'Unable to load some data: ' . $e->getMessage());
        }
    }
}
