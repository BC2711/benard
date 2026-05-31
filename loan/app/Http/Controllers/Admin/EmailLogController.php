<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmailDeliveryLog;
use Illuminate\Http\Request;

class EmailLogController extends Controller
{
    public function index(Request $request)
    {
        $logs = EmailDeliveryLog::query()
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->status))
            ->when($request->filled('recipient'), fn ($query) => $query->where('recipient', 'like', '%' . $request->recipient . '%'))
            ->latest()
            ->paginate(25)
            ->withQueryString();

        return view('pages.admin.email.logs', compact('logs'));
    }
}
