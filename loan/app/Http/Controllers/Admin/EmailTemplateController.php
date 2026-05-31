<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmailTemplate;
use App\Services\EmailTemplateService;
use Illuminate\Http\Request;

class EmailTemplateController extends Controller
{
    public function index(EmailTemplateService $templates)
    {
        $templates->syncDefaults();

        return view('pages.admin.email.templates.index', [
            'templates' => EmailTemplate::orderBy('name')->get(),
        ]);
    }

    public function edit(EmailTemplate $template)
    {
        return view('pages.admin.email.templates.edit', compact('template'));
    }

    public function update(Request $request, EmailTemplate $template)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'body_html' => 'required|string',
            'body_text' => 'required|string',
            'enabled' => 'nullable|boolean',
        ]);
        $validated['enabled'] = $request->boolean('enabled');
        $template->update($validated);

        return redirect()->route('management.email-templates.index')
            ->with('success', 'Email template updated successfully.');
    }

    public function preview(EmailTemplate $template, EmailTemplateService $templates)
    {
        $context = collect($template->variables ?? [])
            ->mapWithKeys(fn (string $variable) => [$variable => $this->previewValue($variable)])
            ->all();
        $rendered = $templates->render($template->key, $context);

        return view('emails.system', [
            'subjectLine' => $rendered['subject'],
            'htmlBody' => $rendered['html'],
            'textBody' => $rendered['text'],
            'trackingToken' => 'preview',
            'actionUrl' => $context['action_url'] ?? null,
            'actionText' => 'Preview action',
        ]);
    }

    private function previewValue(string $variable): string
    {
        return match ($variable) {
            'first_name' => 'Alex',
            'full_name' => 'Alex Customer',
            'email' => 'alex@example.com',
            'phone' => '+260 955 000 000',
            'preferred_date', 'changed_at', 'logged_in_at' => now()->toDayDateTimeString(),
            'preferred_time' => '10:00 AM',
            'loan_amount' => 'ZMW25,000 - ZMW75,000',
            'loan_purpose' => 'Business expansion',
            'business_type' => 'Marketing agency',
            'company' => 'Example Company',
            'timeline' => 'Within 1 month',
            'message' => 'Example message content.',
            'status' => 'ACTIVE',
            'ip_address' => '127.0.0.1',
            'user_agent' => 'Example browser',
            'code' => '123456',
            'expires_in' => '10',
            'action_url' => route('website.home'),
            default => config('app.name'),
        };
    }
}
