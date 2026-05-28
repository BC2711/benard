@extends('layouts.admin.main')

@section('title', 'Dashboard')
@section('page-title', 'Executive Dashboard')
@section('page-description', 'Monitor users, consultations, subscriptions, and operational activity from one command center.')
@section('page-icon')
    <i class="fas fa-chart-pie"></i>
@endsection
@section('page-actions')
    <select class="admin-input h-11 px-4 text-sm" aria-label="Select reporting range">
        <option>Last 7 days</option>
        <option>Last 30 days</option>
        <option>This quarter</option>
    </select>
    <button type="button"
        class="inline-flex h-11 items-center gap-2 rounded-xl bg-brand-700 px-4 text-sm font-bold text-white shadow-soft transition hover:-translate-y-0.5 hover:bg-brand-600">
        <i class="fas fa-download"></i> Export
    </button>
@endsection

@section('content')
    @php
        $metrics = [
            ['label' => 'Total users', 'value' => number_format($stats['total_users']), 'change' => '+12.4%', 'icon' => 'fa-users', 'tone' => 'cyan'],
            ['label' => 'Active consultations', 'value' => number_format($stats['total_consultation']), 'change' => '+8.1%', 'icon' => 'fa-calendar-check', 'tone' => 'emerald'],
            ['label' => 'Pending actions', 'value' => number_format($stats['pending_consultation']), 'change' => 'Needs review', 'icon' => 'fa-clock', 'tone' => 'amber'],
            ['label' => 'Subscribers', 'value' => number_format($stats['total_subscribers']), 'change' => '+5.2%', 'icon' => 'fa-envelope-open-text', 'tone' => 'violet'],
        ];
        $trendLabels = collect($stats['consultation_trend'])->pluck('country')->values();
        $trendValues = collect($stats['consultation_trend'])->pluck('value')->values();
    @endphp

    <section class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">
        @foreach ($metrics as $metric)
            <article class="admin-card group overflow-hidden p-5">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">{{ $metric['label'] }}</p>
                        <p class="mt-3 text-3xl font-extrabold tracking-tight text-slate-950 dark:text-white">{{ $metric['value'] }}</p>
                    </div>
                    <div class="grid h-12 w-12 place-items-center rounded-2xl bg-{{ $metric['tone'] }}-100 text-{{ $metric['tone'] }}-700 transition group-hover:scale-105 dark:bg-{{ $metric['tone'] }}-400/10 dark:text-{{ $metric['tone'] }}-200">
                        <i class="fas {{ $metric['icon'] }}"></i>
                    </div>
                </div>
                <div class="mt-5 flex items-center justify-between">
                    <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-bold text-slate-600 dark:bg-slate-800 dark:text-slate-300">{{ $metric['change'] }}</span>
                    <span class="text-xs font-semibold text-slate-400">vs previous period</span>
                </div>
            </article>
        @endforeach
    </section>

    <section class="grid grid-cols-1 gap-6 xl:grid-cols-3">
        <div class="admin-card p-5 xl:col-span-2">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-lg font-bold">Consultation trend</h2>
                    <p class="text-sm text-slate-500 dark:text-slate-400">Daily requests across the current reporting window.</p>
                </div>
                <div class="inline-flex rounded-xl border border-slate-200 bg-slate-50 p-1 dark:border-slate-800 dark:bg-slate-900">
                    <button class="rounded-lg bg-white px-3 py-1.5 text-xs font-bold shadow-sm dark:bg-slate-800">Week</button>
                    <button class="px-3 py-1.5 text-xs font-bold text-slate-500">Month</button>
                    <button class="px-3 py-1.5 text-xs font-bold text-slate-500">Year</button>
                </div>
            </div>
            <div class="mt-6 h-80">
                <canvas id="consultationChart" aria-label="Consultation trend chart"></canvas>
            </div>
        </div>

        <div class="admin-card p-5">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-bold">User health</h2>
                    <p class="text-sm text-slate-500 dark:text-slate-400">Status distribution</p>
                </div>
                <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-bold text-emerald-700 dark:bg-emerald-400/10 dark:text-emerald-200">Stable</span>
            </div>
            <div class="mt-6 space-y-4">
                <div class="rounded-2xl bg-slate-50 p-4 dark:bg-slate-900">
                    <div class="flex items-center justify-between">
                        <span class="font-semibold">Active users</span>
                        <span class="text-2xl font-extrabold text-emerald-600">{{ number_format($stats['active_users']) }}</span>
                    </div>
                    <div class="mt-3 h-2 overflow-hidden rounded-full bg-slate-200 dark:bg-slate-800">
                        <div class="h-full rounded-full bg-emerald-500" style="width: 72%"></div>
                    </div>
                </div>
                <div class="rounded-2xl bg-slate-50 p-4 dark:bg-slate-900">
                    <div class="flex items-center justify-between">
                        <span class="font-semibold">Pending users</span>
                        <span class="text-2xl font-extrabold text-amber-600">{{ number_format($stats['pending_users']) }}</span>
                    </div>
                    <div class="mt-3 h-2 overflow-hidden rounded-full bg-slate-200 dark:bg-slate-800">
                        <div class="h-full rounded-full bg-amber-500" style="width: 28%"></div>
                    </div>
                </div>
                <div class="rounded-2xl bg-slate-50 p-4 dark:bg-slate-900">
                    <div class="flex items-center justify-between">
                        <span class="font-semibold">Scheduled consultations</span>
                        <span class="text-2xl font-extrabold text-brand-600">{{ number_format($stats['completed_consultation']) }}</span>
                    </div>
                    <div class="mt-3 h-2 overflow-hidden rounded-full bg-slate-200 dark:bg-slate-800">
                        <div class="h-full rounded-full bg-brand-600" style="width: 54%"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="grid grid-cols-1 gap-6 xl:grid-cols-3">
        <div class="admin-card p-5 xl:col-span-2">
            <div class="mb-5 flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-bold">Recent consultations</h2>
                    <p class="text-sm text-slate-500 dark:text-slate-400">Newest customer intent and scheduling activity.</p>
                </div>
                <a href="{{ route('management.consultation.index') }}" class="text-sm font-bold text-brand-700 dark:text-cyan-300">View all</a>
            </div>
            <div class="overflow-hidden rounded-2xl border border-slate-200 dark:border-slate-800">
                <table class="min-w-full divide-y divide-slate-200 text-sm dark:divide-slate-800">
                    <thead class="bg-slate-50 text-left text-xs font-bold uppercase tracking-wider text-slate-500 dark:bg-slate-900">
                        <tr>
                            <th class="px-4 py-3">Customer</th>
                            <th class="px-4 py-3">Preferred date</th>
                            <th class="px-4 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white/50 dark:divide-slate-800 dark:bg-slate-950/20">
                        @forelse($stats['recent_consultation'] as $consultation)
                            <tr class="transition hover:bg-brand-50/60 dark:hover:bg-cyan-400/5">
                                <td class="px-4 py-4">
                                    <div class="flex items-center gap-3">
                                        <span class="grid h-10 w-10 place-items-center rounded-xl bg-brand-700 text-sm font-bold text-white">
                                            {{ substr($consultation->first_name ?? 'U', 0, 1) }}{{ substr($consultation->last_name ?? 'N', 0, 1) }}
                                        </span>
                                        <span>
                                            <span class="block font-bold">{{ $consultation->first_name ?? 'Unknown' }} {{ $consultation->last_name ?? 'User' }}</span>
                                            <span class="text-slate-500">{{ $consultation->email ?? 'No email' }}</span>
                                        </span>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-slate-600 dark:text-slate-300">
                                    {{ isset($consultation->preferred_date) && $consultation->preferred_date ? \Carbon\Carbon::parse($consultation->preferred_date)->format('M j, Y') : 'Not set' }}
                                </td>
                                <td class="px-4 py-4">
                                    <span class="rounded-full px-3 py-1 text-xs font-bold {{ ($consultation->status ?? 'new') === 'new' ? 'bg-amber-100 text-amber-700 dark:bg-amber-400/10 dark:text-amber-200' : 'bg-emerald-100 text-emerald-700 dark:bg-emerald-400/10 dark:text-emerald-200' }}">
                                        {{ ucfirst($consultation->status ?? 'new') }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-12 text-center text-slate-500">
                                    <i class="fas fa-calendar-xmark mb-3 text-3xl text-slate-300"></i>
                                    <p class="font-semibold">No consultations yet</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="space-y-6">
            <div class="admin-card p-5">
                <h2 class="text-lg font-bold">Quick actions</h2>
                <div class="mt-4 grid grid-cols-2 gap-3">
                    <a href="{{ route('management.users.create') }}" class="admin-quick-action"><i class="fas fa-user-plus"></i><span>Add user</span></a>
                    <a href="{{ route('management.consultation.index') }}" class="admin-quick-action"><i class="fas fa-calendar"></i><span>Schedule</span></a>
                    <button type="button" class="admin-quick-action"><i class="fas fa-file-export"></i><span>Report</span></button>
                    <button type="button" class="admin-quick-action"><i class="fas fa-sliders"></i><span>Settings</span></button>
                </div>
            </div>

            <div class="admin-card p-5">
                <h2 class="text-lg font-bold">Activity timeline</h2>
                <div class="mt-5 space-y-5">
                    @forelse($stats['recent_users']->take(4) as $user)
                        <div class="flex gap-3">
                            <span class="mt-1 h-2.5 w-2.5 rounded-full bg-brand-600"></span>
                            <div>
                                <p class="text-sm font-bold">{{ $user->first_name ?? 'A user' }} joined the workspace</p>
                                <p class="text-xs text-slate-500">{{ $user->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="rounded-2xl border border-dashed border-slate-300 p-6 text-center text-sm text-slate-500 dark:border-slate-700">
                            No recent activity.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const chart = document.getElementById('consultationChart');
            if (!chart || typeof Chart === 'undefined') return;

            new Chart(chart, {
                type: 'line',
                data: {
                    labels: @json($trendLabels),
                    datasets: [{
                        label: 'Consultations',
                        data: @json($trendValues),
                        fill: true,
                        tension: 0.42,
                        borderColor: '#0e7490',
                        backgroundColor: 'rgba(14, 116, 144, 0.12)',
                        pointBackgroundColor: '#d99b2b',
                        pointBorderWidth: 0,
                        pointRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        x: { grid: { display: false } },
                        y: { beginAtZero: true, ticks: { precision: 0 }, grid: { color: 'rgba(148, 163, 184, 0.18)' } }
                    }
                }
            });
        });
    </script>
@endpush
