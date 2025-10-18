<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Londa Loans - Admin Dashboard</title>

    <!-- Laravel Asset Helper -->
    <script defer src="{{ asset('assets/js/tailwind.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'londa-brown': '#7a4603',
                        'londa-orange': '#db9123',
                        'londa-light': '#f8f5f0'
                    }
                }
            }
        }
    </script>

    <style>
        .sidebar-transition {
            transition: all 0.3s ease;
        }

        .nav-item.active {
            background-color: #f8f5f0;
            border-right: 4px solid #db9123;
        }

        .nav-item.active i,
        .nav-item.active span {
            color: #db9123;
        }

        /* Custom scrollbar for sidebar */
        .sidebar-scroll::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar-scroll::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .sidebar-scroll::-webkit-scrollbar-thumb {
            background: #db9123;
            border-radius: 4px;
        }
    </style>

    <!-- Additional Styles for Admin -->
    @stack('styles')
</head>

<body class="bg-gray-50">
    <!-- Main Container -->
    <div class="flex h-screen">
        <!-- Sidebar -->
        @include('layouts.admin.sidebar')

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Navbar -->
            @include('layouts.admin.header')

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-6 bg-gray-50">
                <!-- Page Header -->
                @hasSection('page-header')
                    <div class="mb-6">
                        @yield('page-header')
                    </div>
                @endif

                <!-- Breadcrumbs -->
                @hasSection('breadcrumbs')
                    <div class="mb-6">
                        @yield('breadcrumbs')
                    </div>
                @endif

                <!-- Flash Messages -->
                @if (session('success'))
                    <div
                        class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div
                        class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg flex items-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            <span class="font-semibold">Please fix the following errors:</span>
                        </div>
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Main Content -->
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <script>
        // Sidebar Toggle Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    const sidebar = document.getElementById('sidebar');
                    if (sidebar) {
                        sidebar.classList.toggle('hidden');
                        sidebar.classList.toggle('w-64');
                        sidebar.classList.toggle('w-0');

                        // Update localStorage for persistence
                        const isHidden = sidebar.classList.contains('hidden');
                        localStorage.setItem('sidebarHidden', isHidden);
                    }
                });
            }

            // Active Navigation Item Management
            document.querySelectorAll('.nav-item').forEach((item) => {
                item.addEventListener('click', function() {
                    document.querySelectorAll('.nav-item').forEach((i) => i.classList.remove(
                        'active'));
                    this.classList.add('active');

                    // Store active state in localStorage
                    const activePage = this.getAttribute('data-page');
                    if (activePage) {
                        localStorage.setItem('activePage', activePage);
                    }
                });
            });

            // Restore sidebar state from localStorage
            const sidebarHidden = localStorage.getItem('sidebarHidden');
            const sidebar = document.getElementById('sidebar');
            if (sidebar && sidebarHidden === 'true') {
                sidebar.classList.add('hidden');
                sidebar.classList.remove('w-64');
                sidebar.classList.add('w-0');
            }

            // Restore active page from localStorage
            const activePage = localStorage.getItem('activePage');
            if (activePage) {
                const activeItem = document.querySelector(`.nav-item[data-page="${activePage}"]`);
                if (activeItem) {
                    document.querySelectorAll('.nav-item').forEach((i) => i.classList.remove('active'));
                    activeItem.classList.add('active');
                }
            }

            // Auto-hide sidebar on small screens
            function handleResize() {
                const sidebar = document.getElementById('sidebar');
                if (window.innerWidth < 768 && sidebar) {
                    sidebar.classList.add('hidden');
                    sidebar.classList.remove('w-64');
                    sidebar.classList.add('w-0');
                }
            }

            // Initial check
            handleResize();

            // Listen for resize events
            window.addEventListener('resize', handleResize);
        });

        // Initialize Alpine.js for dropdowns
        document.addEventListener('alpine:init', () => {
            Alpine.data('dropdown', () => ({
                open: false,
                toggle() {
                    this.open = !this.open;
                },
                close() {
                    this.open = false;
                }
            }));

            Alpine.data('modal', () => ({
                open: false,
                toggle() {
                    this.open = !this.open;
                },
                close() {
                    this.open = false;
                }
            }));
        });

        // Global utility functions
        window.adminUtils = {
            confirmAction(message = 'Are you sure you want to perform this action?') {
                return confirm(message);
            },

            showLoading() {
                // Implement loading overlay if needed
                console.log('Loading...');
            },

            hideLoading() {
                // Hide loading overlay if implemented
                console.log('Loading complete');
            },

            formatCurrency(amount) {
                return new Intl.NumberFormat('en-US', {
                    style: 'currency',
                    currency: 'USD'
                }).format(amount);
            },

            formatDate(dateString) {
                return new Date(dateString).toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric'
                });
            }
        };
    </script>

    <!-- Additional Scripts -->
    @stack('scripts')
</body>

</html>
