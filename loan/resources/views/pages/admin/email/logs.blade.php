@extends('layouts.admin.main')

@section('title', 'Email Logs')
@section('page-title', 'Email Delivery Logs')
@section('page-description', 'Review queued deliveries, retry outcomes, SMTP failures, and engagement tracking.')
@section('page-icon')<i class="fas fa-server"></i>@endsection

@section('content')
    <form class="admin-card flex flex-wrap gap-3 p-4">
        <input class="admin-input" name="recipient" value="{{ request('recipient') }}" placeholder="Filter recipient">
        <select class="admin-input" name="status">
            <option value="">All statuses</option>
            @foreach (['queued', 'retrying', 'sent', 'failed'] as $status)
                <option value="{{ $status }}" @selected(request('status') === $status)>{{ ucfirst($status) }}</option>
            @endforeach
        </select>
        <button class="admin-btn-primary" type="submit">Filter</button>
    </form>

    <div class="admin-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-100 text-xs uppercase text-slate-500 dark:bg-slate-800">
                    <tr><th class="px-5 py-4">Time</th><th class="px-5 py-4">Recipient</th><th class="px-5 py-4">Subject</th><th class="px-5 py-4">Status</th><th class="px-5 py-4">Attempts</th><th class="px-5 py-4">Engagement</th><th class="px-5 py-4">Error</th></tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                    @forelse ($logs as $log)
                        <tr>
                            <td class="whitespace-nowrap px-5 py-4">{{ $log->created_at->format('M j, Y H:i') }}</td>
                            <td class="px-5 py-4">{{ $log->recipient }}</td>
                            <td class="px-5 py-4"><div>{{ $log->subject }}</div><div class="mt-1 text-xs text-slate-500">{{ $log->template_key }}</div></td>
                            <td class="px-5 py-4 font-bold">{{ ucfirst($log->status) }}</td>
                            <td class="px-5 py-4">{{ $log->attempts }}</td>
                            <td class="px-5 py-4 text-xs">{{ $log->opened_at ? 'Opened ' . $log->opened_at->diffForHumans() : 'Not opened' }}<br>{{ $log->clicked_at ? 'Clicked ' . $log->clicked_at->diffForHumans() : 'Not clicked' }}</td>
                            <td class="max-w-xs px-5 py-4 text-xs text-red-600">{{ $log->error_message }}</td>
                        </tr>
                    @empty
                        <tr><td class="px-5 py-8 text-center text-slate-500" colspan="7">No email deliveries found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4">{{ $logs->links() }}</div>
    </div>
@endsection
