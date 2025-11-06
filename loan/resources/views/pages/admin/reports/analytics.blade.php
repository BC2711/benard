<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics - Londa Loans Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="bg-white w-64 shadow-lg">
            <nav class="p-4">
                <a href="analytics.html"
                    class="flex items-center px-4 py-3 text-londa-orange bg-londa-light rounded-lg border-r-4 border-londa-orange">
                    <i class="fas fa-chart-line w-6"></i>
                    <span class="ml-3">Analytics</span>
                </a>
                <a href="reports.html"
                    class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-londa-light">
                    <i class="fas fa-file-invoice w-6"></i>
                    <span class="ml-3">Reports</span>
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-6">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Business Analytics</h1>
                <p class="text-gray-600">Comprehensive insights into loan performance and business metrics</p>
            </div>

            <!-- Date Range Selector -->
            <div class="bg-white rounded-lg shadow p-4 mb-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <select class="border border-gray-300 rounded-lg px-3 py-2">
                            <option>Last 7 Days</option>
                            <option>Last 30 Days</option>
                            <option>Last 90 Days</option>
                            <option>Year to Date</option>
                            <option>Custom Range</option>
                        </select>
                        <div class="flex items-center space-x-2 text-sm text-gray-600">
                            <span>Jan 1, 2024</span>
                            <span>-</span>
                            <span>Jan 31, 2024</span>
                        </div>
                    </div>
                    <button class="bg-londa-orange text-white px-4 py-2 rounded-lg hover:bg-orange-600">
                        <i class="fas fa-download mr-2"></i>Export Data
                    </button>
                </div>
            </div>

            <!-- Key Metrics -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm font-medium text-gray-500">Total Loan Volume</h3>
                        <i class="fas fa-dollar-sign text-green-600"></i>
                    </div>
                    <p class="text-2xl font-bold text-gray-900">$8.2M</p>
                    <div class="flex items-center mt-2">
                        <i class="fas fa-arrow-up text-green-600 mr-1"></i>
                        <span class="text-green-600 text-sm font-medium">12.5%</span>
                        <span class="text-gray-500 text-sm ml-1">vs last month</span>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm font-medium text-gray-500">Approval Rate</h3>
                        <i class="fas fa-check-circle text-blue-600"></i>
                    </div>
                    <p class="text-2xl font-bold text-gray-900">71.4%</p>
                    <div class="flex items-center mt-2">
                        <i class="fas fa-arrow-up text-green-600 mr-1"></i>
                        <span class="text-green-600 text-sm font-medium">3.2%</span>
                        <span class="text-gray-500 text-sm ml-1">vs last month</span>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm font-medium text-gray-500">Average Loan Size</h3>
                        <i class="fas fa-chart-bar text-purple-600"></i>
                    </div>
                    <p class="text-2xl font-bold text-gray-900">$42,500</p>
                    <div class="flex items-center mt-2">
                        <i class="fas fa-arrow-up text-green-600 mr-1"></i>
                        <span class="text-green-600 text-sm font-medium">8.7%</span>
                        <span class="text-gray-500 text-sm ml-1">vs last month</span>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm font-medium text-gray-500">Customer Satisfaction</h3>
                        <i class="fas fa-smile text-yellow-600"></i>
                    </div>
                    <p class="text-2xl font-bold text-gray-900">4.8/5</p>
                    <div class="flex items-center mt-2">
                        <i class="fas fa-minus text-gray-400 mr-1"></i>
                        <span class="text-gray-400 text-sm font-medium">0.0%</span>
                        <span class="text-gray-500 text-sm ml-1">vs last month</span>
                    </div>
                </div>
            </div>

            <!-- Charts Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <!-- Loan Volume Chart -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium text-gray-900">Loan Volume Trend</h3>
                        <select class="border border-gray-300 rounded-lg px-3 py-1 text-sm">
                            <option>Monthly</option>
                            <option>Weekly</option>
                            <option>Daily</option>
                        </select>
                    </div>
                    <div class="h-64 bg-gray-50 rounded-lg flex items-center justify-center">
                        <div class="text-center text-gray-500">
                            <i class="fas fa-chart-line text-4xl mb-2"></i>
                            <p>Loan Volume Chart</p>
                            <p class="text-sm">$8.2M total volume this month</p>
                        </div>
                    </div>
                </div>

                <!-- Loan Types Distribution -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium text-gray-900">Loan Types Distribution</h3>
                        <select class="border border-gray-300 rounded-lg px-3 py-1 text-sm">
                            <option>By Volume</option>
                            <option>By Count</option>
                        </select>
                    </div>
                    <div class="h-64 bg-gray-50 rounded-lg flex items-center justify-center">
                        <div class="text-center text-gray-500">
                            <i class="fas fa-chart-pie text-4xl mb-2"></i>
                            <p>Loan Types Distribution</p>
                            <p class="text-sm">Marketing: 45%, Business: 35%, Personal: 20%</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Performance Metrics -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Application Funnel</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Applications Received</span>
                            <span class="font-medium">156</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Under Review</span>
                            <span class="font-medium">89</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Approved</span>
                            <span class="font-medium text-green-600">67</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Rejected</span>
                            <span class="font-medium text-red-600">21</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Top Performing Segments</h3>
                    <div class="space-y-3">
                        <div>
                            <div class="flex justify-between text-sm mb-1">
                                <span>Marketing Agencies</span>
                                <span class="font-medium">45%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-londa-orange h-2 rounded-full" style="width: 45%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between text-sm mb-1">
                                <span>E-commerce</span>
                                <span class="font-medium">30%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-blue-500 h-2 rounded-full" style="width: 30%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between text-sm mb-1">
                                <span>Startups</span>
                                <span class="font-medium">15%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-green-500 h-2 rounded-full" style="width: 15%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Quick Actions</h3>
                    <div class="space-y-3">
                        <button
                            class="w-full text-left p-3 border border-gray-200 rounded-lg hover:border-londa-orange hover:bg-londa-light transition-colors">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <i class="fas fa-file-pdf text-red-600 mr-3"></i>
                                    <span>Generate Monthly Report</span>
                                </div>
                                <i class="fas fa-chevron-right text-gray-400"></i>
                            </div>
                        </button>
                        <button
                            class="w-full text-left p-3 border border-gray-200 rounded-lg hover:border-londa-orange hover:bg-londa-light transition-colors">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <i class="fas fa-chart-bar text-blue-600 mr-3"></i>
                                    <span>Performance Analysis</span>
                                </div>
                                <i class="fas fa-chevron-right text-gray-400"></i>
                            </div>
                        </button>
                        <button
                            class="w-full text-left p-3 border border-gray-200 rounded-lg hover:border-londa-orange hover:bg-londa-light transition-colors">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <i class="fas fa-bell text-yellow-600 mr-3"></i>
                                    <span>Set Up Alerts</span>
                                </div>
                                <i class="fas fa-chevron-right text-gray-400"></i>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
