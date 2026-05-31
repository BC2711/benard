@extends('layouts.admin.main')

@section('title', 'Edit Email Template')
@section('page-title', 'Edit Email Template')
@section('page-description', $template->name)
@section('page-icon')<i class="fas fa-pen-to-square"></i>@endsection

@section('content')
    <form method="POST" action="{{ route('management.email-templates.update', $template) }}" class="admin-card space-y-5 p-6">
        @csrf
        @method('PUT')
        <label class="flex items-center gap-3"><input type="checkbox" name="enabled" value="1" @checked(old('enabled', $template->enabled))><span class="font-semibold">Enable this notification</span></label>
        <div><label class="admin-label">Subject</label><input class="admin-input w-full" name="subject" value="{{ old('subject', $template->subject) }}" required></div>
        <div><label class="admin-label">HTML body</label><textarea class="admin-input min-h-64 w-full font-mono text-sm" name="body_html" required>{{ old('body_html', $template->body_html) }}</textarea></div>
        <div><label class="admin-label">Plain-text fallback</label><textarea class="admin-input min-h-52 w-full font-mono text-sm" name="body_text" required>{{ old('body_text', $template->body_text) }}</textarea></div>
        <div class="rounded-xl bg-slate-100 p-4 text-sm dark:bg-slate-800">
            <strong>Available placeholders:</strong>
            {{ collect($template->variables ?? [])->map(fn ($variable) => '{{' . $variable . '}}')->join(', ') ?: 'No workflow-specific placeholders' }}
        </div>
        <div class="flex gap-3">
            <button class="admin-btn-primary" type="submit"><i class="fas fa-save"></i> Save template</button>
            <a class="admin-btn-secondary" href="{{ route('management.email-templates.preview', $template) }}" target="_blank">Preview</a>
        </div>
    </form>
@endsection
