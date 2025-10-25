<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
    public function index()
    {
        try {
            $stats = $this->notificationService->getStatistics();
            $data = $this->notificationService->get_all();
        //   dd($data);
            return view('pages.admin.dashboard', compact('stats', 'data'));
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
