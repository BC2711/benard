@extends('layouts.admin.main')

@section('title', 'Dashboard')

@section('content')
    <div class="min-h-screen bg-white rounded-lg border-b border-gray-200">
        <!-- Header -->
        <div class="bg-gray-50 border-b border-gray-200">
            <div class="px-6 py-4">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Dashboard Overview</h1>
                        <p class="text-sm text-gray-600 mt-1">Welcome back! Here's your platform overview.</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="relative">
                            <select
                                class="appearance-none bg-white border border-gray-300 rounded-lg pl-4 pr-10 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                <option>Last 7 days</option>
                                <option>Last 30 days</option>
                                <option>Last 90 days</option>
                            </select>
                            <i
                                class="fas fa-chevron-down absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-xs"></i>
                        </div>
                        <button
                            class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg shadow-sm transition-all duration-200 hover:shadow-md">
                            <i class="fas fa-download mr-2 text-sm"></i>
                            Export Report
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="p-6 space-y-6">
            <!-- Alert Messages -->
            @if (session('success'))
                <div
                    class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl flex items-center animate-fade-in">
                    <i class="fas fa-check-circle mr-3 text-green-500"></i>
                    <span class="flex-1">{{ session('success') }}</span>
                    <button class="ml-4 text-green-600 hover:text-green-800">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            @if (session('error'))
                <div
                    class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl flex items-center animate-fade-in">
                    <i class="fas fa-exclamation-circle mr-3 text-red-500"></i>
                    <span class="flex-1">{{ session('error') }}</span>
                    <button class="ml-4 text-red-600 hover:text-red-800">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            <!-- Key Metrics Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total Users Card -->
                <div
                    class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-lg p-6 text-white transform hover:scale-105 transition-all duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-100 text-sm font-medium">Total Users</p>
                            <p class="text-3xl font-bold mt-2" id="totalUsers">{{ number_format($stats['total_users']) }}
                            </p>
                            <div class="flex items-center mt-2">
                                <i class="fas fa-arrow-up text-green-300 mr-1 text-sm"></i>
                                <span class="text-blue-100 text-xs">12% growth</span>
                            </div>
                        </div>
                        <div class="bg-white/20 p-3 rounded-xl backdrop-blur-sm">
                            <i class="fas fa-users text-2xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Active Consultations Card -->
                <div
                    class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl shadow-lg p-6 text-white transform hover:scale-105 transition-all duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-100 text-sm font-medium">Active Consultations</p>
                            <p class="text-3xl font-bold mt-2" id="totalConsultations">
                                {{ number_format($stats['total_consultation']) }}</p>
                            <div class="flex items-center mt-2">
                                <i class="fas fa-arrow-up text-green-300 mr-1 text-sm"></i>
                                <span class="text-green-100 text-xs">8% this week</span>
                            </div>
                        </div>
                        <div class="bg-white/20 p-3 rounded-xl backdrop-blur-sm">
                            <i class="fas fa-calendar-check text-2xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Pending Actions Card -->
                <div
                    class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl shadow-lg p-6 text-white transform hover:scale-105 transition-all duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-orange-100 text-sm font-medium">Pending Actions</p>
                            <p class="text-3xl font-bold mt-2" id="pendingConsultations">
                                {{ number_format($stats['pending_consultation']) }}</p>
                            <div class="flex items-center mt-2">
                                <i class="fas fa-clock text-orange-200 mr-1 text-sm"></i>
                                <span class="text-orange-100 text-xs">Needs attention</span>
                            </div>
                        </div>
                        <div class="bg-white/20 p-3 rounded-xl backdrop-blur-sm">
                            <i class="fas fa-clock text-2xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Subscribers Card -->
                <div
                    class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl shadow-lg p-6 text-white transform hover:scale-105 transition-all duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-purple-100 text-sm font-medium">Newsletter Subscribers</p>
                            <p class="text-3xl font-bold mt-2" id="totalSubscribers">
                                {{ number_format($stats['total_subscribers']) }}</p>
                            <div class="flex items-center mt-2">
                                <i class="fas fa-arrow-up text-green-300 mr-1 text-sm"></i>
                                <span class="text-purple-100 text-xs">5.2% growth</span>
                            </div>
                        </div>
                        <div class="bg-white/20 p-3 rounded-xl backdrop-blur-sm">
                            <i class="fas fa-envelope text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts & Analytics Row -->
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
                <!-- Consultation Trends -->
                <div class="xl:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Consultation Trends</h3>
                            <p class="text-sm text-gray-600">Last 7 days performance</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <button
                                class="px-3 py-1 text-xs font-medium bg-primary-50 text-primary-700 rounded-lg">Week</button>
                            <button
                                class="px-3 py-1 text-xs font-medium text-gray-600 hover:bg-gray-50 rounded-lg">Month</button>
                            <button
                                class="px-3 py-1 text-xs font-medium text-gray-600 hover:bg-gray-50 rounded-lg">Year</button>
                        </div>
                    </div>
                    <div id="chartdiv"></div>
                </div>

                <!-- User Analytics -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-6">User Analytics</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 bg-blue-50 rounded-xl">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user-check text-blue-600"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">Active Users</p>
                                    <p class="text-sm text-gray-600">Currently online</p>
                                </div>
                            </div>
                            <span class="text-2xl font-bold text-blue-600"
                                id="activeUsers">{{ number_format($stats['active_users']) }}</span>
                        </div>

                        <div class="flex items-center justify-between p-4 bg-orange-50 rounded-xl">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user-clock text-orange-600"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">Pending Users</p>
                                    <p class="text-sm text-gray-600">Awaiting approval</p>
                                </div>
                            </div>
                            <span class="text-2xl font-bold text-orange-600"
                                id="pendingUsers">{{ number_format($stats['pending_users']) }}</span>
                        </div>

                        <div class="flex items-center justify-between p-4 bg-green-50 rounded-xl">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-calendar-check text-green-600"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">Completed</p>
                                    <p class="text-sm text-gray-600">Consultations</p>
                                </div>
                            </div>
                            <span class="text-2xl font-bold text-green-600"
                                id="completedConsultations">{{ number_format($stats['completed_consultation']) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Tables Row -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Recent Consultations -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">Recent Consultations</h3>
                        <a href="{{ route('management.consultation.index') }}"
                            class="inline-flex items-center text-sm text-primary-600 hover:text-primary-700 font-medium">
                            View all
                            <i class="fas fa-chevron-right ml-1 text-xs"></i>
                        </a>
                    </div>
                    <div class="space-y-4">
                        @forelse($stats['recent_consultation'] as $consultation)
                            <div
                                class="flex items-center justify-between p-4 rounded-xl border border-gray-100 hover:border-primary-200 hover:bg-primary-50/30 transition-all duration-200">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-12 h-12 bg-gradient-to-br from-primary-500 to-accent-500 rounded-xl flex items-center justify-center text-white font-bold text-sm">
                                        {{ substr($consultation->first_name ?? 'U', 0, 1) }}{{ substr($consultation->last_name ?? 'N', 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-900">
                                            {{ $consultation->first_name ?? 'Unknown' }}
                                            {{ $consultation->last_name ?? 'User' }}</p>
                                        <p class="text-sm text-gray-600">{{ $consultation->email ?? 'No email' }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-medium text-gray-900">
                                        @if (isset($consultation->preferred_date) && $consultation->preferred_date)
                                            {{ \Carbon\Carbon::parse($consultation->preferred_date)->format('M j, Y') }}
                                        @else
                                            Not set
                                        @endif
                                    </p>
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ ($consultation->status ?? 'new') === 'new'
                                    ? 'bg-orange-100 text-orange-800'
                                    : (($consultation->status ?? 'new') === 'scheduled'
                                        ? 'bg-green-100 text-green-800'
                                        : 'bg-blue-100 text-blue-800') }}">
                                        {{ ucfirst($consultation->status ?? 'new') }}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <i class="fas fa-calendar-times text-3xl text-gray-300 mb-3"></i>
                                <p class="text-gray-500">No recent consultations</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Recent Users & Quick Actions -->
                <div class="space-y-6">
                    <!-- Recent Users -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-semibold text-gray-900">Recent Users</h3>
                            <a href="{{ route('management.users.index') }}"
                                class="inline-flex items-center text-sm text-primary-600 hover:text-primary-700 font-medium">
                                View all
                                <i class="fas fa-chevron-right ml-1 text-xs"></i>
                            </a>
                        </div>
                        <div class="space-y-4">
                            @forelse($stats['recent_users'] as $user)
                                <div
                                    class="flex items-center justify-between p-3 rounded-xl hover:bg-gray-50 transition-colors">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 bg-gradient-to-br from-gray-400 to-gray-600 rounded-full flex items-center justify-center text-white text-sm font-bold">
                                            {{ substr($user->first_name ?? 'U', 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-900">{{ $user->first_name ?? 'Unknown User' }}</p>
                                            <p class="text-sm text-gray-500">{{ $user->email ?? 'No email' }}</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-xs text-gray-600">{{ $user->created_at->diffForHumans() }}</p>
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium
                                    {{ $user->email_verified_at ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ $user->email_verified_at ? 'Verified' : 'Pending' }}
                                        </span>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-8">
                                    <i class="fas fa-users text-3xl text-gray-300 mb-3"></i>
                                    <p class="text-gray-500">No users yet</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                        <div class="grid grid-cols-2 gap-3">
                            <a href="{{ route('management.users.create') }}"
                                class="flex flex-col items-center justify-center p-4 bg-blue-50 hover:bg-blue-100 rounded-xl transition-colors group">
                                <i
                                    class="fas fa-user-plus text-blue-600 text-xl mb-2 group-hover:scale-110 transition-transform"></i>
                                <span class="text-sm font-medium text-gray-900">Add User</span>
                            </a>
                            <a href="#"
                                class="flex flex-col items-center justify-center p-4 bg-green-50 hover:bg-green-100 rounded-xl transition-colors group">
                                <i
                                    class="fas fa-list text-green-600 text-xl mb-2 group-hover:scale-110 transition-transform"></i>
                                <span class="text-sm font-medium text-gray-900">Consultations</span>
                            </a>
                            <a href="#"
                                class="flex flex-col items-center justify-center p-4 bg-purple-50 hover:bg-purple-100 rounded-xl transition-colors group">
                                <i
                                    class="fas fa-chart-bar text-purple-600 text-xl mb-2 group-hover:scale-110 transition-transform"></i>
                                <span class="text-sm font-medium text-gray-900">Reports</span>
                            </a>
                            <a href="#"
                                class="flex flex-col items-center justify-center p-4 bg-orange-50 hover:bg-orange-100 rounded-xl transition-colors group">
                                <i
                                    class="fas fa-cog text-orange-600 text-xl mb-2 group-hover:scale-110 transition-transform"></i>
                                <span class="text-sm font-medium text-gray-900">Settings</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Use a reliable Chart.js CDN -->
    <!-- Styles -->
    <style>
        #chartdiv {
            width: 100%;
            height: 300px;
        }
    </style>

    <!-- Resources -->
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

    <!-- Chart code -->
    <script>
        am5.ready(function() {

            // Create root element
            // https://www.amcharts.com/docs/v5/getting-started/#Root_element
            var root = am5.Root.new("chartdiv");

            // Set themes
            // https://www.amcharts.com/docs/v5/concepts/themes/
            root.setThemes([
                am5themes_Animated.new(root)
            ]);

            // Create chart
            // https://www.amcharts.com/docs/v5/charts/xy-chart/
            var chart = root.container.children.push(am5xy.XYChart.new(root, {
                panX: true,
                panY: true,
                wheelX: "panX",
                wheelY: "zoomX",
                pinchZoomX: true,
                paddingLeft: 0,
                paddingRight: 1
            }));

            // Add cursor
            // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
            var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
            cursor.lineY.set("visible", false);


            // Create axes
            // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
            var xRenderer = am5xy.AxisRendererX.new(root, {
                minGridDistance: 30,
                minorGridEnabled: true
            });

            xRenderer.labels.template.setAll({
                rotation: -90,
                centerY: am5.p50,
                centerX: am5.p100,
                paddingRight: 15
            });

            xRenderer.grid.template.setAll({
                location: 1
            })

            var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
                maxDeviation: 0.3,
                categoryField: "country",
                renderer: xRenderer,
                tooltip: am5.Tooltip.new(root, {})
            }));

            var yRenderer = am5xy.AxisRendererY.new(root, {
                strokeOpacity: 0.1
            })

            var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                maxDeviation: 0.3,
                renderer: yRenderer
            }));

            // Create series
            // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
            var series = chart.series.push(am5xy.ColumnSeries.new(root, {
                name: "Series 1",
                xAxis: xAxis,
                yAxis: yAxis,
                valueYField: "value",
                sequencedInterpolation: true,
                categoryXField: "country",
                tooltip: am5.Tooltip.new(root, {
                    labelText: "{valueY}"
                })
            }));

            series.columns.template.setAll({
                cornerRadiusTL: 5,
                cornerRadiusTR: 5,
                strokeOpacity: 0
            });
            series.columns.template.adapters.add("fill", function(fill, target) {
                return chart.get("colors").getIndex(series.columns.indexOf(target));
            });

            series.columns.template.adapters.add("stroke", function(stroke, target) {
                return chart.get("colors").getIndex(series.columns.indexOf(target));
            });


            // Set data
            var data = @json($stats['consultation_trend']);

            xAxis.data.setAll(data);
            series.data.setAll(data);


            // Make stuff animate on load
            // https://www.amcharts.com/docs/v5/concepts/animations/
            series.appear(1000);
            chart.appear(1000, 100);

        });
    </script>


    <style>
        .animate-fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endsection
