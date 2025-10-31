@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="space-y-8">

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-6">
            <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 card-hover">
                <div class="flex items-center justify-between mb-2">
                    <div class="text-3xl font-black text-primary-600">{{ number_format($stats['total_applications']) }}</div>
                    <i class="fas fa-file-invoice-dollar text-primary-500 text-2xl"></i>
                </div>
                <div class="text-gray-600 text-sm">Total Applications</div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 card-hover">
                <div class="flex items-center justify-between mb-2">
                    <div class="text-3xl font-black text-yellow-600">{{ $stats['pending_applications'] }}</div>
                    <i class="fas fa-clock text-yellow-500 text-2xl"></i>
                </div>
                <div class="text-gray-600 text-sm">Pending Review</div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 card-hover">
                <div class="flex items-center justify-between mb-2">
                    <div class="text-3xl font-black text-green-600">ZMW {{ number_format($stats['approved_loans']) }}</div>
                    <i class="fas fa-check-circle text-green-500 text-2xl"></i>
                </div>
                <div class="text-gray-600 text-sm">Approved Loans</div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 card-hover">
                <div class="flex items-center justify-between mb-2">
                    <div class="text-3xl font-black text-accent-600">{{ $stats['total_subscribers'] }}</div>
                    <i class="fas fa-users text-accent-500 text-2xl"></i>
                </div>
                <div class="text-gray-600 text-sm">Subscribers</div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 card-hover">
                <div class="flex items-center justify-between mb-2">
                    <div class="text-3xl font-black text-red-600">{{ $stats['unread_messages'] }}</div>
                    <i class="fas fa-envelope text-red-500 text-2xl"></i>
                </div>
                <div class="text-gray-600 text-sm">Unread Messages</div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 card-hover">
                <div class="flex items-center justify-between mb-2">
                    <div class="text-3xl font-black text-primary-600">ZMW {{ number_format($stats['revenue_this_month']) }}
                    </div>
                    <i class="fas fa-chart-line text-primary-500 text-2xl"></i>
                </div>
                <div class="text-gray-600 text-sm">Revenue (This Month)</div>
            </div>
        </div>

        <div class="grid lg:grid-cols-3 gap-6">
            <!-- Recent Applications -->
            <div class="lg:col-span-2 bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                <h3 class="text-xl font-bold text-primary-900 mb-4 flex items-center gap-2">
                    <i class="fas fa-list-alt text-accent-500"></i> Recent Applications
                </h3>
                <div class="space-y-3">
                    @forelse($recentApplications as $app)
                        <div
                            class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 bg-primary-100 rounded-full flex items-center justify-center text-primary-600 font-bold">
                                    {{ substr($app->user->name, 0, 1) }}
                                </div>
                                <div>
                                    <div class="font-semibold">{{ $app->user->name }}</div>
                                    <div class="text-sm text-gray-600">ZMW {{ number_format($app->amount) }}</div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-xs text-gray-500">{{ $app->created_at->diffForHumans() }}</div>
                                <span
                                    class="inline-block px-3 py-1 text-xs font-medium rounded-full
                            {{ $app->status === 'approved'
                                ? 'bg-green-100 text-green-700'
                                : ($app->status === 'pending'
                                    ? 'bg-yellow-100 text-yellow-700'
                                    : 'bg-red-100 text-red-700') }}">
                                    {{ ucfirst($app->status) }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-8">No applications yet.</p>
                    @endforelse
                </div>
            </div>

            <!-- Activity Feed -->
            <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                <h3 class="text-xl font-bold text-primary-900 mb-4 flex items-center gap-2">
                    <i class="fas fa-stream text-accent-500"></i> Recent Activity
                </h3>
                <div class="space-y-4">
                    @foreach ($activity as $act)
                        <div class="flex items-start gap-3">
                            <div
                                class="w-10 h-10 bg-primary-100 rounded-full flex items-center justify-center text-primary-600">
                                <i class="fas {{ $act['icon'] }}"></i>
                            </div>
                            <div class="flex-1">
                                <div class="text-sm font-medium">{{ $act['text'] }}</div>
                                <div class="text-xs text-gray-500">{{ $act['time'] }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-gradient-to-r from-primary-600 to-accent-600 rounded-2xl p-6 text-white shadow-xl">
            <h3 class="text-xl font-bold mb-4">Quick Actions</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <a href="{{ route('admin.calculator.index') }}"
                    class="bg-white/20 backdrop-blur-sm rounded-xl p-4 text-center hover:bg-white/30 transition-all">
                    <i class="fas fa-calculator text-2xl mb-2"></i>
                    <div class="text-sm font-medium">Edit Calculator</div>
                </a>
                <a href="{{ route('admin.footer.index') }}"
                    class="bg-white/20 backdrop-blur-sm rounded-xl p-4 text-center hover:bg-white/30 transition-all">
                    <i class="fas fa-cog text-2xl mb-2"></i>
                    <div class="text-sm font-medium">Update Footer</div>
                </a>
                <a href="{{ route('admin.blog.create') }}"
                    class="bg-white/20 backdrop-blur-sm rounded-xl p-4 text-center hover:bg-white/30 transition-all">
                    <i class="fas fa-plus text-2xl mb-2"></i>
                    <div class="text-sm font-medium">New Blog Post</div>
                </a>
                <a href="#"
                    class="bg-white/20 backdrop-blur-sm rounded-xl p-4 text-center hover:bg-white/30 transition-all">
                    <i class="fas fa-download text-2xl mb-2"></i>
                    <div class="text-sm font-medium">Export Report</div>
                </a>
            </div>
        </div>

    </div>
@endsection
