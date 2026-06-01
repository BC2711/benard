@extends('layouts.admin.main')

@section('title', 'Edit Email Template')
@section('page-title', 'Edit Email Template')
@section('page-description', $template->name)
@section('page-icon')
    <i class="fas fa-pen-to-square"></i>
@endsection

@section('content')
    <form method="POST"
          action="{{ route('management.email-templates.update', $template) }}"
          class="admin-card space-y-6 p-6">

        @csrf
        @method('PUT')

        <div class="flex items-center justify-between gap-4 rounded-2xl bg-slate-50 p-4 dark:bg-slate-800">
            <div>
                <h2 class="font-bold text-slate-900 dark:text-white">Notification Status</h2>
                <p class="text-sm text-slate-500 dark:text-slate-400">
                    Enable or disable this email notification.
                </p>
            </div>

            <label class="inline-flex cursor-pointer items-center gap-3">
                <input type="hidden" name="enabled" value="0">
                <input type="checkbox"
                       name="enabled"
                       value="1"
                       @checked(old('enabled', $template->enabled))
                       class="h-5 w-5 rounded border-slate-300 text-brand-700 focus:ring-brand-600">
                <span class="font-semibold">Enabled</span>
            </label>
        </div>

        <div>
            <label class="admin-label">Subject</label>
            <input class="admin-input w-full"
                   name="subject"
                   value="{{ old('subject', $template->subject) }}"
                   placeholder="Enter email subject"
                   required>
            @error('subject')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="admin-label">HTML Body</label>
            <textarea class="admin-input min-h-72 w-full font-mono text-sm"
                      name="body_html"
                      required>{{ old('body_html', $template->body_html) }}</textarea>
            @error('body_html')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="admin-label">Plain Text Fallback</label>
            <textarea class="admin-input min-h-56 w-full font-mono text-sm"
                      name="body_text"
                      required>{{ old('body_text', $template->body_text) }}</textarea>
            @error('body_text')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 text-sm dark:border-slate-700 dark:bg-slate-800">
            <div class="mb-3 flex items-center justify-between gap-3">
                <div>
                    <strong class="text-slate-900 dark:text-white">Available Placeholders</strong>
                    <p class="text-xs text-slate-500 dark:text-slate-400">
                        Use these placeholders inside the subject, HTML body, or plain-text body.
                    </p>
                </div>
            </div>

            <div class="flex flex-wrap gap-2">
                @forelse($template->variables ?? [] as $variable)
                    <code class="inline-flex items-center rounded-lg bg-white px-3 py-1.5 text-xs font-semibold text-brand-700 shadow-sm ring-1 ring-slate-200 dark:bg-slate-900 dark:text-cyan-300 dark:ring-slate-700">
                        &#123;&#123;{{ $variable }}&#125;&#125;
                    </code>
                @empty
                    <span class="text-slate-500 dark:text-slate-400">
                        No workflow-specific placeholders
                    </span>
                @endforelse
            </div>
        </div>

        <div class="flex flex-col gap-3 border-t border-slate-200 pt-5 dark:border-slate-800 sm:flex-row sm:items-center sm:justify-between">
            <a class="admin-btn-secondary"
               href="{{ route('management.email-templates.preview', $template) }}"
               target="_blank">
                <i class="fas fa-eye"></i> Preview
            </a>

            <button class="admin-btn-primary" type="submit">
                <i class="fas fa-save"></i> Save Template
            </button>
        </div>
    </form>
@endsection