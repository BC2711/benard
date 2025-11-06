<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - Londa Loans Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="bg-white w-64 shadow-lg">
            <nav class="p-4">
                <a href="settings.html"
                    class="flex items-center px-4 py-3 text-londa-orange bg-londa-light rounded-lg border-r-4 border-londa-orange">
                    <i class="fas fa-cog w-6"></i>
                    <span class="ml-3">System Settings</span>
                </a>
                <a href="admin-users.html"
                    class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-londa-light">
                    <i class="fas fa-user-shield w-6"></i>
                    <span class="ml-3">Admin Users</span>
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-6">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-900">System Settings</h1>
                <p class="text-gray-600">Configure your Londa Loans system preferences</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Settings Navigation -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow">
                        <nav class="p-4 space-y-1">
                            <a href="#"
                                class="flex items-center px-3 py-2 text-londa-orange bg-londa-light rounded-lg">
                                <i class="fas fa-sliders-h w-5 mr-3"></i>
                                General Settings
                            </a>
                            <a href="#"
                                class="flex items-center px-3 py-2 text-gray-700 rounded-lg hover:bg-gray-50">
                                <i class="fas fa-hand-holding-usd w-5 mr-3"></i>
                                Loan Settings
                            </a>
                            <a href="#"
                                class="flex items-center px-3 py-2 text-gray-700 rounded-lg hover:bg-gray-50">
                                <i class="fas fa-bell w-5 mr-3"></i>
                                Notifications
                            </a>
                            <a href="#"
                                class="flex items-center px-3 py-2 text-gray-700 rounded-lg hover:bg-gray-50">
                                <i class="fas fa-shield-alt w-5 mr-3"></i>
                                Security
                            </a>
                            <a href="#"
                                class="flex items-center px-3 py-2 text-gray-700 rounded-lg hover:bg-gray-50">
                                <i class="fas fa-plug w-5 mr-3"></i>
                                Integrations
                            </a>
                            <a href="#"
                                class="flex items-center px-3 py-2 text-gray-700 rounded-lg hover:bg-gray-50">
                                <i class="fas fa-database w-5 mr-3"></i>
                                Data Management
                            </a>
                        </nav>
                    </div>
                </div>

                <!-- Settings Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- General Settings -->
                    <div class="bg-white rounded-lg shadow">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-medium text-gray-900">General Settings</h2>
                        </div>
                        <div class="p-6 space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Company Name</label>
                                    <input type="text" value="Londa Loans"
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-londa-orange focus:border-londa-orange">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Support Email</label>
                                    <input type="email" value="support@londaloans.com"
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-londa-orange focus:border-londa-orange">
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Company Address</label>
                                <textarea
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-londa-orange focus:border-londa-orange"
                                    rows="3">123 Marketing District, San Francisco, CA 94105</textarea>
                            </div>

                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-sm font-medium text-gray-700">Maintenance Mode</h3>
                                    <p class="text-sm text-gray-500">Temporarily disable the application</p>
                                </div>
                                <button type="button"
                                    class="bg-gray-200 relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-londa-orange"
                                    role="switch">
                                    <span
                                        class="translate-x-0 pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200"></span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Loan Settings -->
                    <div class="bg-white rounded-lg shadow">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-medium text-gray-900">Loan Configuration</h2>
                        </div>
                        <div class="p-6 space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Minimum Loan
                                        Amount</label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500">$</span>
                                        </div>
                                        <input type="number" value="5000"
                                            class="pl-7 w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-londa-orange focus:border-londa-orange">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Maximum Loan
                                        Amount</label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500">$</span>
                                        </div>
                                        <input type="number" value="500000"
                                            class="pl-7 w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-londa-orange focus:border-londa-orange">
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Default Interest Rate
                                    (%)</label>
                                <input type="number" value="8.5" step="0.1"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-londa-orange focus:border-londa-orange">
                            </div>

                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-sm font-medium text-gray-700">Auto-Approval</h3>
                                    <p class="text-sm text-gray-500">Automatically approve loans meeting criteria</p>
                                </div>
                                <button type="button"
                                    class="bg-londa-orange relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-londa-orange"
                                    role="switch">
                                    <span
                                        class="translate-x-5 pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200"></span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Save Settings -->
                    <div class="bg-white rounded-lg shadow">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-medium text-gray-900">Save Changes</h2>
                        </div>
                        <div class="p-6">
                            <div class="flex justify-end space-x-3">
                                <button
                                    class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                                    Reset to Defaults
                                </button>
                                <button class="px-4 py-2 bg-londa-orange text-white rounded-lg hover:bg-orange-600">
                                    Save Changes
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
