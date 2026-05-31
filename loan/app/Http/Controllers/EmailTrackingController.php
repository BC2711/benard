<?php

namespace App\Http\Controllers;

use App\Models\EmailDeliveryLog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class EmailTrackingController extends Controller
{
    public function open(string $token): Response
    {
        EmailDeliveryLog::where('tracking_token', $token)
            ->whereNull('opened_at')
            ->update(['opened_at' => now()]);

        return response(base64_decode('R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw=='))
            ->header('Content-Type', 'image/gif')
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate');
    }

    public function click(string $token): RedirectResponse
    {
        $log = EmailDeliveryLog::where('tracking_token', $token)->firstOrFail();
        $log->update(['clicked_at' => $log->clicked_at ?: now()]);

        $target = $log->context['action_url'] ?? route('website.home');

        return redirect()->away($target);
    }
}
