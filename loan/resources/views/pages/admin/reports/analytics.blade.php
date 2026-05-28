@extends('layouts.admin.main')

@section('title', 'Analytics')
@section('page-title', 'Business Analytics')
@section('page-description', 'Track portfolio movement, approvals, customer satisfaction, and operational funnels.')
@section('page-icon')
    <i class="fas fa-chart-line"></i>
@endsection
@section('page-actions')
    <select class="admin-input h-11 px-4 text-sm"><option>Last 30 days</option><option>Quarter to date</option><option>Year to date</option></select>
    <button class="inline-flex h-11 items-center gap-2 rounded-xl bg-brand-700 px-4 text-sm font-bold text-white shadow-soft"><i class="fas fa-download"></i>Export</button>
@endsection

@section('content')
    <section class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">
        @foreach ([['Total loan volume','ZMW 8.2M','+12.5%','fa-coins'],['Approval rate','71.4%','+3.2%','fa-circle-check'],['Average size','ZMW 42.5K','+8.7%','fa-chart-bar'],['Satisfaction','4.8/5','Stable','fa-face-smile']] as $metric)
            <article class="admin-card p-5">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-semibold text-slate-500">{{ $metric[0] }}</p>
                    <i class="fas {{ $metric[3] }} text-brand-700"></i>
                </div>
                <p class="mt-4 text-3xl font-extrabold">{{ $metric[1] }}</p>
                <p class="mt-2 text-sm font-bold text-emerald-600">{{ $metric[2] }} vs previous period</p>
            </article>
        @endforeach
    </section>

    <section class="grid grid-cols-1 gap-6 xl:grid-cols-2">
        <div class="admin-card p-5">
            <h2 class="text-lg font-bold">Loan volume trend</h2>
            <div class="mt-6 h-72"><canvas id="loanVolumeChart"></canvas></div>
        </div>
        <div class="admin-card p-5">
            <h2 class="text-lg font-bold">Loan types distribution</h2>
            <div class="mt-6 h-72"><canvas id="loanTypeChart"></canvas></div>
        </div>
    </section>

    <section class="grid grid-cols-1 gap-6 xl:grid-cols-3">
        <div class="admin-card p-5">
            <h2 class="text-lg font-bold">Application funnel</h2>
            <div class="mt-5 space-y-4">
                @foreach ([['Applications received',156,100],['Under review',89,57],['Approved',67,43],['Rejected',21,13]] as $row)
                    <div>
                        <div class="flex justify-between text-sm font-bold"><span>{{ $row[0] }}</span><span>{{ $row[1] }}</span></div>
                        <div class="mt-2 h-2 rounded-full bg-slate-200"><div class="h-2 rounded-full bg-brand-700" style="width: {{ $row[2] }}%"></div></div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="admin-card p-5">
            <h2 class="text-lg font-bold">Top segments</h2>
            <div class="mt-5 space-y-4">
                @foreach ([['Marketing agencies',45],['E-commerce',30],['Startups',15],['Personal lending',10]] as $row)
                    <div class="rounded-2xl bg-slate-50 p-3 dark:bg-slate-900">
                        <div class="flex justify-between text-sm font-bold"><span>{{ $row[0] }}</span><span>{{ $row[1] }}%</span></div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="admin-card p-5">
            <h2 class="text-lg font-bold">Report actions</h2>
            <div class="mt-4 grid gap-3">
                <button class="admin-menu-item"><i class="fas fa-file-pdf text-red-500"></i>Generate monthly report</button>
                <button class="admin-menu-item"><i class="fas fa-chart-column text-brand-700"></i>Performance analysis</button>
                <button class="admin-menu-item"><i class="fas fa-bell text-gold-500"></i>Set portfolio alerts</button>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (typeof Chart === 'undefined') return;
            new Chart(document.getElementById('loanVolumeChart'), {
                type: 'bar',
                data: { labels: ['Jan','Feb','Mar','Apr','May','Jun'], datasets: [{ data: [21,28,32,37,42,48], backgroundColor: '#0e7490', borderRadius: 10 }] },
                options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } } }
            });
            new Chart(document.getElementById('loanTypeChart'), {
                type: 'doughnut',
                data: { labels: ['Marketing','Business','Personal'], datasets: [{ data: [45,35,20], backgroundColor: ['#0e7490','#0f766e','#d99b2b'] }] },
                options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom' } } }
            });
        });
    </script>
@endpush
