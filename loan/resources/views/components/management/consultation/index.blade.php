@extends('layouts.admin.main')

@section('title', 'Consultation Requests')
@section('page-title', 'Consultation Requests')
@section('page-description', 'Review customer requests, update booking progress, and schedule follow-up conversations.')
@section('page-icon')<i class="fas fa-calendar-check"></i>@endsection
@section('page-actions')
    <a href="{{ route('management.consultation.create') }}" class="inline-flex h-11 items-center gap-2 rounded-xl bg-brand-700 px-4 text-sm font-bold text-white shadow-soft transition hover:-translate-y-0.5 hover:bg-brand-600">
        <i class="fas fa-plus"></i> Add Request
    </a>
@endsection

@section('content')
    @php
        $summary = [
            ['label' => 'Total Requests', 'value' => $stats['total'], 'icon' => 'fa-inbox'],
            ['label' => 'New', 'value' => $stats['new'], 'icon' => 'fa-bell'],
            ['label' => 'Scheduled', 'value' => $stats['scheduled'], 'icon' => 'fa-calendar-day'],
            ['label' => 'Cancelled', 'value' => $stats['cancelled'], 'icon' => 'fa-ban'],
        ];
    @endphp

    <section class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">
        @foreach ($summary as $item)
            <article class="admin-card p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">{{ $item['label'] }}</p>
                        <p class="mt-2 text-3xl font-extrabold">{{ number_format($item['value']) }}</p>
                    </div>
                    <span class="grid h-12 w-12 place-items-center rounded-2xl bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-200">
                        <i class="fas {{ $item['icon'] }}"></i>
                    </span>
                </div>
            </article>
        @endforeach
    </section>

    <section class="admin-card overflow-hidden">
        <div class="border-b border-slate-200 p-5 dark:border-slate-800">
            <form method="GET" action="{{ route('management.consultation.index') }}" class="grid gap-3 md:grid-cols-[1fr_14rem_auto]">
                <label class="relative">
                    <span class="sr-only">Search consultation requests</span>
                    <i class="fas fa-search pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-sm text-slate-400"></i>
                    <input type="search" name="search" value="{{ request('search') }}" class="admin-input h-11 w-full pl-9 pr-3 text-sm" placeholder="Search name, email, or phone">
                </label>
                <select name="status" class="admin-input h-11 px-3 text-sm" aria-label="Filter by status">
                    <option value="">All statuses</option>
                    @foreach (['new', 'contacted', 'scheduled', 'cancelled'] as $status)
                        <option value="{{ $status }}" @selected(request('status') === $status)>{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
                <button class="rounded-xl bg-slate-900 px-4 text-sm font-bold text-white dark:bg-cyan-700">Filter</button>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-sm dark:divide-slate-800">
                <thead class="bg-slate-50 text-left text-xs font-bold uppercase tracking-wider text-slate-500 dark:bg-slate-900">
                    <tr>
                        <th class="px-5 py-4">Customer</th>
                        <th class="px-5 py-4">Contact</th>
                        <th class="px-5 py-4">Preferred Time</th>
                        <th class="px-5 py-4">Status</th>
                        <th class="px-5 py-4">Received</th>
                        <th class="px-5 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @forelse ($consultations as $consultation)
                        <tr class="transition hover:bg-brand-50/50 dark:hover:bg-cyan-400/5">
                            <td class="px-5 py-4">
                                <p class="font-bold text-slate-950 dark:text-white">{{ $consultation->first_name }} {{ $consultation->last_name }}</p>
                                <p class="mt-1 max-w-xs truncate text-xs text-slate-500">{{ $consultation->message ?: 'No message provided' }}</p>
                            </td>
                            <td class="px-5 py-4 text-slate-500">
                                <p>{{ $consultation->email }}</p>
                                <p class="mt-1">{{ $consultation->phone }}</p>
                            </td>
                            <td class="px-5 py-4 text-slate-500">
                                <p>{{ $consultation->preferred_date?->format('M j, Y') }}</p>
                                <p class="mt-1">{{ $consultation->preferred_time?->format('g:i A') }}</p>
                            </td>
                            <td class="px-5 py-4">
                                <span class="rounded-full px-3 py-1 text-xs font-bold {{ $consultation->status === 'new' ? 'bg-blue-100 text-blue-700' : ($consultation->status === 'scheduled' ? 'bg-emerald-100 text-emerald-700' : ($consultation->status === 'cancelled' ? 'bg-red-100 text-red-700' : 'bg-amber-100 text-amber-700')) }}">
                                    {{ ucfirst($consultation->status) }}
                                </span>
                            </td>
                            <td class="px-5 py-4 text-slate-500">{{ $consultation->created_at->format('M j, Y g:i A') }}</td>
                            <td class="px-5 py-4 text-right">
                                <a href="{{ route('management.consultation.show', $consultation) }}" class="admin-icon-btn inline-grid h-9 w-9" title="View"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('management.consultation.edit', $consultation) }}" class="admin-icon-btn inline-grid h-9 w-9" title="Edit"><i class="fas fa-pen"></i></a>
                                <form method="POST" action="{{ route('management.consultation.destroy', $consultation) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="admin-icon-btn inline-grid h-9 w-9 text-red-600" title="Delete" onclick="return confirm('Delete this consultation request?')"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="px-5 py-16 text-center text-slate-500">No consultation requests found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="border-t border-slate-200 px-5 py-4 dark:border-slate-800">{{ $consultations->links() }}</div>
    </section>
@endsection
