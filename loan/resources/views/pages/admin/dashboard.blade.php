@extends('layouts.admin.main')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="fas fa-file-invoice-dollar text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-gray-500">Total Loans</h3>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['email'] }}</p>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-green-600 text-sm font-medium"><i class="fas fa-arrow-up mr-1"></i>12.5%</span>
                <span class="text-gray-500 text-sm ml-2">from last month</span>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-check-circle text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-gray-500">Approved</h3>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['sent'] }}</p>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-green-600 text-sm font-medium"><i class="fas fa-arrow-up mr-1"></i>8.2%</span>
                <span class="text-gray-500 text-sm ml-2">from last month</span>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <i class="fas fa-clock text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-gray-500">Pending</h3>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['pending'] }}</p>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-red-600 text-sm font-medium"><i class="fas fa-arrow-down mr-1"></i>3.4%</span>
                <span class="text-gray-500 text-sm ml-2">from last month</span>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-red-100 text-red-600">
                    <i class="fas fa-times-circle text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-gray-500">Rejected</h3>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['failed'] }}</p>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-green-600 text-sm font-medium"><i class="fas fa-arrow-down mr-1"></i>2.1%</span>
                <span class="text-gray-500 text-sm ml-2">from last month</span>
            </div>
        </div>
    </div>

    <!-- Recent Activity & Quick Actions -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Recent Activity -->
        <div class="lg:col-span-2 bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-medium text-gray-900">Recent Loan Applications</h2>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <!-- Activity Item -->
                    @foreach ($data as $item)
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-londa-light rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-londa-orange"></i>
                                </div>
                            </div>

                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900">{{$item['full_name']}}</p>
                                <p class="text-sm text-gray-500">{{$item['message']}}</p>
                                <p class="text-xs text-gray-400">2 hours ago</p>
                            </div>
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">{{$item['status']}}</span>


                        </div>
                    @endforeach
                    <!-- Activity Item -->
                    {{-- <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-londa-light rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-londa-orange"></i>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900">Michael Chen</p>
                            <p class="text-sm text-gray-500">Marketing Campaign Loan approved - $25,000</p>
                            <p class="text-xs text-gray-400">5 hours ago</p>
                        </div>
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Approved</span>
                    </div> --}}

                    <!-- Activity Item -->
                    {{-- <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-londa-light rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-londa-orange"></i>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900">David Rodriguez</p>
                            <p class="text-sm text-gray-500">Application requires additional documents</p>
                            <p class="text-xs text-gray-400">1 day ago</p>
                        </div>
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Review</span>
                    </div> --}}
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-medium text-gray-900">Quick Actions</h2>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <button
                        class="w-full flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:border-londa-orange hover:bg-londa-light transition-colors">
                        <div class="flex items-center">
                            <i class="fas fa-plus-circle text-londa-orange text-xl mr-3"></i>
                            <span class="font-medium text-gray-700">New Loan Application</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400"></i>
                    </button>

                    <button
                        class="w-full flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:border-londa-orange hover:bg-londa-light transition-colors">
                        <div class="flex items-center">
                            <i class="fas fa-user-plus text-londa-orange text-xl mr-3"></i>
                            <span class="font-medium text-gray-700">Add New Customer</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400"></i>
                    </button>

                    <button
                        class="w-full flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:border-londa-orange hover:bg-londa-light transition-colors">
                        <div class="flex items-center">
                            <i class="fas fa-chart-bar text-londa-orange text-xl mr-3"></i>
                            <span class="font-medium text-gray-700">Generate Report</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400"></i>
                    </button>

                    <button
                        class="w-full flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:border-londa-orange hover:bg-londa-light transition-colors">
                        <div class="flex items-center">
                            <i class="fas fa-cog text-londa-orange text-xl mr-3"></i>
                            <span class="font-medium text-gray-700">System Settings</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
