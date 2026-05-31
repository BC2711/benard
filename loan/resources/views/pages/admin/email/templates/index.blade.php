@extends('layouts.admin.main')

@section('title', 'Email Templates')
@section('page-title', 'Email Templates')
@section('page-description', 'Control the subject, responsive HTML content, plain-text fallback, and enabled state of every system email.')
@section('page-icon')<i class="fas fa-envelope-open-text"></i>@endsection

@section('content')
    <div class="admin-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-100 text-xs uppercase text-slate-500 dark:bg-slate-800">
                    <tr><th class="px-5 py-4">Template</th><th class="px-5 py-4">Subject</th><th class="px-5 py-4">Status</th><th class="px-5 py-4 text-right">Actions</th></tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                    @foreach ($templates as $template)
                        <tr>
                            <td class="px-5 py-4"><div class="font-bold">{{ $template->name }}</div><div class="mt-1 text-xs text-slate-500">{{ $template->key }}</div></td>
                            <td class="px-5 py-4">{{ $template->subject }}</td>
                            <td class="px-5 py-4"><span class="rounded-full px-3 py-1 text-xs font-bold {{ $template->enabled ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-500' }}">{{ $template->enabled ? 'Enabled' : 'Disabled' }}</span></td>
                            <td class="px-5 py-4 text-right">
                                <a class="admin-btn-secondary" href="{{ route('management.email-templates.preview', $template) }}" target="_blank">Preview</a>
                                <a class="admin-btn-primary ml-2" href="{{ route('management.email-templates.edit', $template) }}">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
