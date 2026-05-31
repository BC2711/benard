<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\EmailDeliveryService;
use App\Services\EmailSettingsService;
use Illuminate\Http\Request;

class EmailSettingsController extends Controller
{
    public function edit(EmailSettingsService $settings)
    {
        return view('pages.admin.email.settings', ['settings' => $settings->all()]);
    }

    public function update(Request $request, EmailSettingsService $settings)
    {
        $validated = $request->validate([
            'mail_enabled' => 'nullable|boolean',
            'mailer' => 'required|in:smtp,log,array,sendmail',
            'host' => 'nullable|required_if:mailer,smtp|string|max:255',
            'port' => 'nullable|required_if:mailer,smtp|integer|min:1|max:65535',
            'scheme' => 'nullable|in:smtp,smtps',
            'username' => 'nullable|string|max:255',
            'password' => 'nullable|string|max:500',
            'from_address' => 'required|email|max:255',
            'from_name' => 'required|string|max:255',
            'admin_recipients' => 'required|string|max:1000',
            'two_factor_enabled' => 'nullable|boolean',
        ]);

        $validated['mail_enabled'] = $request->boolean('mail_enabled');
        $validated['two_factor_enabled'] = $request->boolean('two_factor_enabled');
        $settings->update($validated);

        return back()->with('success', 'Email settings updated successfully.');
    }

    public function test(Request $request, EmailDeliveryService $email)
    {
        $validated = $request->validate(['email' => 'required|email|max:255']);
        $email->queue('email.test', $validated['email']);

        return back()->with('success', 'Test email queued. Check Email Logs for delivery status.');
    }
}
