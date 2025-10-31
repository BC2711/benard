<?php

// app/Http/Controllers/Admin/DashboardController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LoanApplicationController;
use App\Models\LoanApplication;
use App\Models\NewsletterSubscriber;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $stats = [
            'total_applications' => LoanApplication::count(),
            'pending_applications' => LoanApplicationController::where('status', 'pending')->count(),
            'approved_loans' => LoanApplicationController::where('status', 'approved')->sum('amount'),
            'total_subscribers' => NewsletterSubscriber::count(),
            'unread_messages' => ContactMessage::where('read', false)->count(),
            'revenue_this_month' => LoanApplicationController::where('status', 'disbursed')
                ->whereMonth('created_at', now()->month)
                ->sum('amount'),
        ];

        $recentApplications = LoanApplicationController::with('user')
            ->latest()
            ->take(5)
            ->get();

        $activity = [
            ['icon' => 'fa-user-plus', 'text' => 'New loan application', 'time' => '2 mins ago'],
            ['icon' => 'fa-envelope', 'text' => 'New contact message', 'time' => '15 mins ago'],
            ['icon' => 'fa-check', 'text' => 'Loan approved', 'time' => '1 hour ago'],
        ];

        return view('admin.dashboard', compact('stats', 'recentApplications', 'activity'));
    }
}
