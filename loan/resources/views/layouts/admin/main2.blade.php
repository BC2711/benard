<!DOCTYPE html>
<html lang="en" class="h-full" x-data="adminApp">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Londa Loans - Admin Dashboard')</title>
    <meta name="description" content="Londa Loans Administration Panel - Empowering Marketeers">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/logos/londa.jpg') }}">

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
    @include('layouts.components.styles.tailwind-config')

    <!-- Additional Styles -->
    @stack('styles')
</head>

<body class="h-full bg-gray-50 font-sans antialiased" x-data="adminApp">
    <!-- Loading Screen -->
    {{-- @include('layouts.components.ui.loading-screen') --}}

    <!-- Main Container -->
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900 transition-colors duration-300">
        <!-- Mobile Sidebar Overlay -->
        @include('layouts.components.ui.sidebar-overlay')

        <!-- Sidebar -->
        @include('layouts.admin.sidebar')

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col w-0 min-w-0 transition-all duration-300 ease-in-out"
            :class="{ 'lg:ml-0': sidebarCollapsed, 'lg:ml-0': !sidebarCollapsed }">

            <!-- Top Navigation -->
            @include('layouts.admin.header')

            <!-- Page Content -->
            <main class="flex-1 relative overflow-y-auto custom-scrollbar">
                <!-- Background Pattern -->
                <div class="absolute inset-0 -z-10 opacity-5">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-londa-50 to-londa-100 dark:from-gray-800 dark:to-gray-900">
                    </div>
                </div>

                <div class="relative z-10">
                    <!-- Page Header -->
                    @include('layouts.components.ui.page-header')

                    <!-- Notification Area -->
                    @include('layouts.components.ui.notifications')

                    <!-- Main Content Container -->
                    <div class="px-4 sm:px-6 lg:px-8 py-6">
                        <div class="max-w-7xl mx-auto">
                            <!-- Content Section -->
                            <div class="space-y-6">
                                @yield('content')
                            </div>

                            <!-- Quick Actions Footer -->
                            @hasSection('quick-actions')
                                <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                                    @yield('quick-actions')
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </main>

            <!-- Footer -->
            @include('layouts.components.ui.footer')
        </div>
    </div>

    <!-- Back to Top Button -->
    @include('layouts.components.ui.back-to-top')

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.0/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- JavaScript Modules -->
    <script>
        // Admin App Configuration
        window.adminApp = {
            // State
            darkMode: localStorage.getItem('darkMode') === 'true',
            sidebarOpen: false,
            sidebarCollapsed: localStorage.getItem('sidebarCollapsed') === 'true',
            notificationsOpen: false,
            userMenuOpen: false,
            currentPage: 'Dashboard',

            // Methods
            toggleDarkMode() {
                this.darkMode = !this.darkMode;
                localStorage.setItem('darkMode', this.darkMode);
            },

            toggleSidebar() {
                this.sidebarOpen = !this.sidebarOpen;
            },

            toggleSidebarCollapsed() {
                this.sidebarCollapsed = !this.sidebarCollapsed;
                localStorage.setItem('sidebarCollapsed', this.sidebarCollapsed);
            }
        };
    </script>

    @include('layouts.components.scripts.app-initializer')
    @include('layouts.components.scripts.sidebar-manager')
    @include('layouts.components.scripts.header-manager')
    @include('layouts.components.scripts.notification-manager')
    @include('layouts.components.scripts.utility-functions')

    <!-- Additional Scripts -->
    @stack('scripts')
</body>

</html>
