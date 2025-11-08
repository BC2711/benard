@extends('layouts.admin.main')

@section('title', 'Dashboard')
{{-- @php dd($stats['total_users']) @endphp --}}

@section('content')
    <div class="p-6 space-y-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
                <p class="text-sm text-gray-600 mt-1">Welcome back! Here's what's happening today.</p>
            </div>
            <a href="{{ route('management.consultation.index') }}"
                class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg shadow-sm transition-colors">
                <i class="fas fa-calendar-check mr-2 text-sm"></i>
                View Consultations
            </a>
        </div>

        <!-- Success/Error Alert -->
        @if (session('success'))
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg flex items-center">
                <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg flex items-center">
                <i class="fas fa-exclamation-circle mr-2"></i> {{ session('error') }}
            </div>
        @endif

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Users -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Users</p>
                        <p class="text-2xl font-bold text-gray-900 mt-1">{{ $stats['total_users'] ?? 0 }}</p>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full">
                        <i class="fas fa-users text-blue-600 text-xl"></i>
                    </div>
                </div>
                <div class="mt-3 text-xs text-gray-500">
                    <span class="text-green-600 font-medium">+12%</span> from last month
                </div>
            </div>

            <!-- Total Consultations -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Consultations</p>
                        <p class="text-2xl font-bold text-gray-900 mt-1">{{ $stats['total_consultation'] ?? 0 }}</p>
                    </div>
                    <div class="bg-green-100 p-3 rounded-full">
                        <i class="fas fa-calendar-check text-green-600 text-xl"></i>
                    </div>
                </div>
                <div class="mt-3 text-xs text-gray-500">
                    <span class="text-green-600 font-medium">+8%</span> from last week
                </div>
            </div>

            <!-- Pending Consultations -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Pending</p>
                        <p class="text-2xl font-bold text-orange-600 mt-1">{{ $stats['pending_consultation'] ?? 0 }}</p>
                    </div>
                    <div class="bg-orange-100 p-3 rounded-full">
                        <i class="fas fa-clock text-orange-600 text-xl"></i>
                    </div>
                </div>
                <div class="mt-3 text-xs text-gray-500">
                    Requires attention
                </div>
            </div>

            <!-- Newsletter Subscribers -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Subscribers</p>
                        <p class="text-2xl font-bold text-gray-900 mt-1">{{ $stats['total_subscribers'] ?? 0 }}</p>
                    </div>
                    <div class="bg-purple-100 p-3 rounded-full">
                        <i class="fas fa-envelope text-purple-600 text-xl"></i>
                    </div>
                </div>
                <div class="mt-3 text-xs text-gray-500">
                    <span class="text-green-600 font-medium">+5%</span> growth
                </div>
            </div>
        </div>

        <!-- Charts & Tables Row -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Consultation Trend Chart -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Consultation Trend</h3>
                    <select
                        class="text-sm border border-gray-300 rounded-lg px-3 py-1 focus:outline-none focus:ring-2 focus:ring-primary-500">
                        <option>Last 7 days</option>
                        <option>Last 30 days</option>
                        <option>Last 90 days</option>
                    </select>
                </div>
                <canvas id="consultationChart" class="h-64"></canvas>
            </div>

            <!-- Recent Consultations Table -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Recent Consultations</h3>
                    <a href="{{ route('management.consultation.index') }}" class="text-sm text-primary-600 hover:underline">
                        View all
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="border-b">
                            <tr>
                                <th class="text-left py-2 font-medium text-gray-700">Name</th>
                                <th class="text-left py-2 font-medium text-gray-700">Date</th>
                                <th class="text-left py-2 font-medium text-gray-700">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse(($stats['recent_consultation'] ?? []) as $c)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="py-3">
                                        <div class="flex items-center gap-2">
                                            <div
                                                class="w-8 h-8 bg-gradient-to-br from-primary-500 to-accent-500 rounded-full flex items-center justify-center text-white text-xs font-bold">
                                                {{ substr($c->first_name, 0, 1) }}
                                            </div>
                                            <span class="font-medium">{{ $c->first_name }} {{ $c->last_name }}</span>
                                        </div>
                                    </td>
                                    <td class="py-3 text-gray-600">{{ $c->preferred_date->format('M j') }}</td>
                                    <td class="py-3">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $c->status === 'pending' ? 'bg-orange-100 text-orange-800' : 'bg-green-100 text-green-800' }}">
                                            {{ ucfirst($c->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="py-8 text-center text-gray-500">No recent consultations</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Recent Users & Quick Actions -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Recent Users -->
            <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Recent Users</h3>
                    <a href="{{ route('management.users.index') }}" class="text-sm text-primary-600 hover:underline">
                        View all
                    </a>
                </div>
                <div class="space-y-3">
                    @forelse(($stats['recent_users'] ?? []) as $user)
                        <div class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 transition-colors">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gray-200 border-2 border-dashed rounded-full"></div>
                                <div>
                                    <p class="font-medium text-gray-900">{{ $user->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $user->email }}</p>
                                </div>
                            </div>
                            <div class="text-right text-sm">
                                <p class="text-gray-600">{{ $user->created_at->diffForHumans() }}</p>
                                <span
                                    class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium
                            {{ $user->email_verified_at ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ $user->email_verified_at ? 'Verified' : 'Pending' }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-500 py-8">No users yet</p>
                    @endforelse
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                <div class="space-y-3">
                    <a href="{{ route('management.users.create') }}"
                        class="w-full inline-flex items-center justify-center px-4 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors">
                        <i class="fas fa-user-plus mr-2"></i> Add User
                    </a>
                    <a href="{{ route('management.consultation.index') }}"
                        class="w-full inline-flex items-center justify-center px-4 py-3 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-colors">
                        <i class="fas fa-list mr-2"></i> Manage Consultations
                    </a>
                    <a href="#"
                        class="w-full inline-flex items-center justify-center px-4 py-3 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors">
                        <i class="fas fa-cog mr-2"></i> Settings
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Consultation Trend Chart
            const ctx = document.getElementById('consultationChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                    datasets: [{
                        label: 'Consultations',
                        data: [3, 5, 2, 8, 6, 9, 4],
                        borderColor: 'rgb(59, 130, 246)',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: 'rgb(59, 130, 246)',
                        pointRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                display: false
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });

            // Animate numbers on scroll
            const animateValue = (obj, start, end, duration) => {
                let startTimestamp = null;
                const step = (timestamp) => {
                    if (!startTimestamp) startTimestamp = timestamp;
                    const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                    obj.innerHTML = Math.floor(progress * (end - start) + start);
                    if (progress < 1) window.requestAnimationFrame(step);
                };
                window.requestAnimationFrame(step);
            };

            document.querySelectorAll('.font-bold.text-2xl').forEach(el => {
                const final = parseInt(el.textContent.replace(/,/g, ''));
                animateValue(el, 0, final, 1500);
            });
        });
    </script>
@endsection
