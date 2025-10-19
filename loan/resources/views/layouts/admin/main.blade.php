<!DOCTYPE html>
<html lang="en" class="h-full">

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

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'londa': {
                            '50': '#fef6e6',
                            '100': '#fdebc7',
                            '200': '#fbd895',
                            '300': '#f8be58',
                            '400': '#f5a32a',
                            '500': '#ef8710',
                            '600': '#db9123',
                            '700': '#b3741c',
                            '800': '#7a4603',
                            '900': '#663a0a',
                        },
                        'londa-brown': '#7a4603',
                        'londa-orange': '#db9123',
                        'londa-light': '#f8f5f0'
                    },
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', 'sans-serif'],
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-in-right': 'slideInRight 0.3s ease-out',
                        'slide-in-left': 'slideInLeft 0.3s ease-out',
                        'bounce-in': 'bounceIn 0.6s ease-out',
                        'pulse-soft': 'pulseSoft 2s infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': {
                                opacity: '0',
                                transform: 'translateY(10px)'
                            },
                            '100%': {
                                opacity: '1',
                                transform: 'translateY(0)'
                            }
                        },
                        slideInRight: {
                            '0%': {
                                transform: 'translateX(100%)'
                            },
                            '100%': {
                                transform: 'translateX(0)'
                            }
                        },
                        slideInLeft: {
                            '0%': {
                                transform: 'translateX(-100%)'
                            },
                            '100%': {
                                transform: 'translateX(0)'
                            }
                        },
                        bounceIn: {
                            '0%': {
                                opacity: '0',
                                transform: 'scale(0.3)'
                            },
                            '50%': {
                                opacity: '1',
                                transform: 'scale(1.05)'
                            },
                            '70%': {
                                transform: 'scale(0.9)'
                            },
                            '100%': {
                                opacity: '1',
                                transform: 'scale(1)'
                            }
                        },
                        pulseSoft: {
                            '0%, 100%': {
                                opacity: '1'
                            },
                            '50%': {
                                opacity: '0.7'
                            }
                        }
                    }
                }
            },
            darkMode: 'class',
        }
    </script>

    <style>
        /* Custom Scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Glass Morphism Effect */
        .glass {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        .glass-dark {
            background: rgba(15, 23, 42, 0.25);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Gradient Text */
        .gradient-text {
            background: linear-gradient(135deg, #7a4603 0%, #db9123 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Shimmer Loading */
        .shimmer {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% {
                background-position: -200% 0;
            }

            100% {
                background-position: 200% 0;
            }
        }

        /* Custom Checkbox */
        .custom-checkbox:checked {
            background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3cpath d='M12.207 4.793a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0l-2-2a1 1 0 011.414-1.414L6.5 9.086l4.293-4.293a1 1 0 011.414 0z'/%3e%3c/svg%3e");
        }

        /* Focus States */
        .focus-londa:focus {
            box-shadow: 0 0 0 3px rgba(219, 145, 35, 0.1);
            border-color: #db9123;
        }

        /* Print Styles */
        @media print {
            .no-print {
                display: none !important;
            }
        }
    </style>

    <!-- Additional Styles -->
    @stack('styles')
</head>

<body class="h-full bg-gray-50 font-sans antialiased" x-data="{
    darkMode: localStorage.getItem('darkMode') === 'true',
    sidebarOpen: false,
    sidebarCollapsed: localStorage.getItem('sidebarCollapsed') === 'true',
    notificationsOpen: false,
    userMenuOpen: false
}" :class="{ 'dark': darkMode }"
    @keydown.escape="sidebarOpen = false; notificationsOpen = false; userMenuOpen = false">

    <!-- Loading Screen -->
    <div id="loadingScreen"
        class="fixed inset-0 bg-white dark:bg-gray-900 z-50 flex items-center justify-center transition-opacity duration-500">
        <div class="text-center">
            <div class="w-16 h-16 mx-auto mb-4 relative">
                <div class="absolute inset-0 bg-londa-orange rounded-full animate-ping opacity-20"></div>
                <div class="absolute inset-2 bg-londa-orange rounded-full flex items-center justify-center">
                    <img src="{{ asset('assets/logos/londa.jpg') }}" alt="Londa Loans" class="w-8 h-8 rounded">
                </div>
            </div>
            <p class="text-gray-600 dark:text-gray-400 font-medium">Loading Dashboard...</p>
        </div>
    </div>

    <!-- Main Container -->
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900 transition-colors duration-300">
        <!-- Mobile Sidebar Overlay -->
        <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" class="fixed inset-0 flex z-40 lg:hidden" @click="sidebarOpen = false">
            <div class="fixed inset-0 bg-gray-600 dark:bg-gray-900 opacity-75"></div>
        </div>

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
                    <!-- Page Header Section -->
                    <div class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700">
                        <div class="px-4 sm:px-6 lg:px-8 py-4">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                                <div class="flex-1 min-w-0">
                                    <!-- Breadcrumbs -->
                                    @hasSection('breadcrumbs')
                                        <nav class="flex mb-2" aria-label="Breadcrumb">
                                            <ol class="flex items-center space-x-2 text-sm">
                                                @yield('breadcrumbs')
                                            </ol>
                                        </nav>
                                    @endif

                                    <!-- Page Title & Description -->
                                    <div class="flex items-center">
                                        @hasSection('page-icon')
                                            <div class="flex-shrink-0 mr-3">
                                                @yield('page-icon')
                                            </div>
                                        @endif
                                        <div>
                                            <h1
                                                class="text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                                                @yield('page-title', 'Dashboard')
                                                @hasSection('page-badge')
                                                    @yield('page-badge')
                                                @endif
                                            </h1>
                                            @hasSection('page-description')
                                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400 max-w-2xl">
                                                    @yield('page-description')
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Page Actions -->
                                @hasSection('page-actions')
                                    <div class="mt-4 sm:mt-0 flex items-center space-x-3">
                                        @yield('page-actions')
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Notification Area -->
                    <div class="px-4 sm:px-6 lg:px-8 py-2">
                        <!-- System Alerts -->
                        @if (app()->environment('local'))
                            <div
                                class="mb-4 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4 flex items-center">
                                <i class="fas fa-exclamation-triangle text-yellow-600 dark:text-yellow-400 mr-3"></i>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-yellow-800 dark:text-yellow-300">
                                        Development Environment
                                    </p>
                                    <p class="text-sm text-yellow-700 dark:text-yellow-400 mt-1">
                                        You are currently in development mode. Some features may behave differently.
                                    </p>
                                </div>
                            </div>
                        @endif

                        <!-- Flash Messages -->
                        <div id="flash-messages">
                            @foreach (['success', 'error', 'warning', 'info'] as $type)
                                @if (session($type))
                                    <div class="mb-4 animate-fade-in flash-message" data-type="{{ $type }}">
                                        <div
                                            class="rounded-lg p-4 border-l-4 
                                            @if ($type === 'success') bg-green-50 dark:bg-green-900/20 border-green-400 text-green-700 dark:text-green-300
                                            @elseif($type === 'error') bg-red-50 dark:bg-red-900/20 border-red-400 text-red-700 dark:text-red-300
                                            @elseif($type === 'warning') bg-yellow-50 dark:bg-yellow-900/20 border-yellow-400 text-yellow-700 dark:text-yellow-300
                                            @else bg-blue-50 dark:bg-blue-900/20 border-blue-400 text-blue-700 dark:text-blue-300 @endif">
                                            <div class="flex items-center">
                                                <i
                                                    class="fas 
                                                    @if ($type === 'success') fa-check-circle
                                                    @elseif($type === 'error') fa-exclamation-circle
                                                    @elseif($type === 'warning') fa-exclamation-triangle
                                                    @else fa-info-circle @endif mr-3 text-lg"></i>
                                                <div class="flex-1">
                                                    <p class="font-medium">
                                                        @if ($type === 'success')
                                                            Success!
                                                        @elseif($type === 'error')
                                                            Error!
                                                        @elseif($type === 'warning')
                                                            Warning!
                                                        @else
                                                            Information
                                                        @endif
                                                    </p>
                                                    <p class="text-sm mt-1">{{ session($type) }}</p>
                                                </div>
                                                <button onclick="this.closest('.flash-message').remove()"
                                                    class="ml-auto opacity-70 hover:opacity-100 transition-opacity">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach

                            <!-- Validation Errors -->
                            @if ($errors->any())
                                <div class="mb-4 animate-fade-in">
                                    <div class="bg-red-50 dark:bg-red-900/20 border-l-4 border-red-400 rounded-lg p-4">
                                        <div class="flex items-center">
                                            <i class="fas fa-exclamation-triangle text-red-400 mr-3"></i>
                                            <div class="flex-1">
                                                <p class="font-medium text-red-800 dark:text-red-300">
                                                    Please fix the following errors:
                                                </p>
                                                <ul
                                                    class="mt-2 text-sm text-red-700 dark:text-red-400 list-disc list-inside space-y-1">
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <button onclick="this.closest('.animate-fade-in').remove()"
                                                class="ml-auto text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-200">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Main Content Container -->
                    <div class="px-4 sm:px-6 lg:px-8 py-6">
                        <!-- Content Wrapper -->
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
            <footer
                class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 py-4 px-4 sm:px-6 lg:px-8">
                <div
                    class="flex flex-col sm:flex-row sm:items-center sm:justify-between text-sm text-gray-500 dark:text-gray-400">
                    <div class="flex items-center space-x-4 mb-2 sm:mb-0">
                        <span>&copy; {{ date('Y') }} Londa Loans. All rights reserved.</span>
                        <span class="hidden sm:inline">•</span>
                        <span class="flex items-center">
                            <span class="w-2 h-2 bg-green-400 rounded-full mr-2 animate-pulse-soft"></span>
                            System Operational
                        </span>
                    </div>
                    <div class="flex items-center space-x-4">
                        <span>v1.0.0</span>
                        <span class="hidden sm:inline">•</span>
                        <span>Last updated: {{ now()->format('M j, Y') }}</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Back to Top Button -->
    <button id="backToTop"
        class="fixed bottom-8 right-8 w-12 h-12 bg-londa-orange text-white rounded-full shadow-lg hover:shadow-xl transform hover:scale-110 transition-all duration-300 ease-in-out z-30 hidden items-center justify-center"
        onclick="window.scrollTo({ top: 0, behavior: 'smooth' })">
        <i class="fas fa-chevron-up"></i>
    </button>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Initialize application when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            initializeApp();
        });

        function initializeApp() {
            // Hide loading screen
            setTimeout(() => {
                const loadingScreen = document.getElementById('loadingScreen');
                if (loadingScreen) {
                    loadingScreen.style.opacity = '0';
                    setTimeout(() => loadingScreen.remove(), 500);
                }
            }, 1000);

            // Initialize components
            initBackToTop();
            initFlashMessages();
            initPrintButtons();
            initKeyboardShortcuts();
            initPerformanceMonitor();
        }

        // Back to Top Button
        function initBackToTop() {
            const backToTop = document.getElementById('backToTop');
            if (backToTop) {
                window.addEventListener('scroll', () => {
                    backToTop.classList.toggle('hidden', window.scrollY < 300);
                });
            }
        }

        // Auto-dismiss flash messages
        function initFlashMessages() {
            const flashMessages = document.querySelectorAll('.flash-message');
            flashMessages.forEach(message => {
                setTimeout(() => {
                    message.style.opacity = '0';
                    setTimeout(() => message.remove(), 300);
                }, 5000);
            });
        }

        // Print functionality
        function initPrintButtons() {
            document.querySelectorAll('[data-print]').forEach(button => {
                button.addEventListener('click', () => {
                    window.print();
                });
            });
        }

        // Keyboard shortcuts
        function initKeyboardShortcuts() {
            document.addEventListener('keydown', (e) => {
                // Ctrl/Cmd + K for search
                if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                    e.preventDefault();
                    const searchInput = document.getElementById('searchInput');
                    if (searchInput) {
                        searchInput.focus();
                    }
                }

                // Ctrl/Cmd + / for help
                if ((e.ctrlKey || e.metaKey) && e.key === '/') {
                    e.preventDefault();
                    showKeyboardShortcuts();
                }
            });
        }

        function showKeyboardShortcuts() {
            const shortcuts = [{
                    key: 'Ctrl+K',
                    action: 'Focus search'
                },
                {
                    key: 'Ctrl+/',
                    action: 'Show shortcuts'
                },
                {
                    key: 'Esc',
                    action: 'Close modals/dropdowns'
                },
                {
                    key: 'Ctrl+P',
                    action: 'Print current page'
                }
            ];

            // Create modal with shortcuts (you can implement a proper modal)
            console.log('Keyboard Shortcuts:', shortcuts);
        }

        // Performance monitoring
        function initPerformanceMonitor() {
            if (window.performance) {
                const navTiming = performance.getEntriesByType('navigation')[0];
                if (navTiming) {
                    const loadTime = navTiming.loadEventEnd - navTiming.navigationStart;
                    if (loadTime > 3000) {
                        console.warn(`Page load time: ${loadTime}ms - Consider optimizing`);
                    }
                }
            }
        }

        // Global utility functions
        window.LondaAdmin = {
            // Theme management
            toggleDarkMode() {
                const isDark = document.documentElement.classList.toggle('dark');
                localStorage.setItem('darkMode', isDark);
                return isDark;
            },

            // Notification system
            notify(message, type = 'info', duration = 5000) {
                const types = {
                    success: {
                        icon: 'fa-check-circle',
                        color: 'green'
                    },
                    error: {
                        icon: 'fa-exclamation-circle',
                        color: 'red'
                    },
                    warning: {
                        icon: 'fa-exclamation-triangle',
                        color: 'yellow'
                    },
                    info: {
                        icon: 'fa-info-circle',
                        color: 'blue'
                    }
                };

                const config = types[type] || types.info;
                const notification = document.createElement('div');
                notification.className = `fixed top-4 right-4 z-50 animate-bounce-in`;
                notification.innerHTML = `
                    <div class="bg-${config.color}-50 dark:bg-${config.color}-900/20 border-l-4 border-${config.color}-400 rounded-lg shadow-lg p-4 max-w-sm">
                        <div class="flex items-center">
                            <i class="fas ${config.icon} text-${config.color}-400 mr-3"></i>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-${config.color}-800 dark:text-${config.color}-300">${message}</p>
                            </div>
                            <button onclick="this.parentElement.parentElement.parentElement.remove()" 
                                    class="ml-4 text-${config.color}-400 hover:text-${config.color}-600">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                `;

                document.body.appendChild(notification);
                setTimeout(() => notification.remove(), duration);
            },

            // Data export
            exportToCSV(data, filename = 'export.csv') {
                const csvContent = "data:text/csv;charset=utf-8," + data;
                const encodedUri = encodeURI(csvContent);
                const link = document.createElement("a");
                link.setAttribute("href", encodedUri);
                link.setAttribute("download", filename);
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            },

            // Form helpers
            serializeForm(form) {
                return new FormData(form);
            },

            // Date utilities
            formatDate(date, format = 'medium') {
                const formats = {
                    short: {
                        dateStyle: 'short'
                    },
                    medium: {
                        dateStyle: 'medium'
                    },
                    long: {
                        dateStyle: 'long'
                    },
                    full: {
                        dateStyle: 'full'
                    }
                };
                return new Date(date).toLocaleDateString('en-US', formats[format]);
            },

            formatCurrency(amount, currency = 'ZMW') {
                return new Intl.NumberFormat('en-ZM', {
                    style: 'currency',
                    currency: currency
                }).format(amount);
            },

            // Loading states
            setLoading(button, isLoading) {
                if (isLoading) {
                    button.disabled = true;
                    button.innerHTML = `<i class="fas fa-spinner fa-spin mr-2"></i>Loading...`;
                } else {
                    button.disabled = false;
                    button.innerHTML = button.getAttribute('data-original-text');
                }
            }
        };

        // Error boundary for JavaScript errors
        window.addEventListener('error', (e) => {
            console.error('JavaScript Error:', e.error);
            LondaAdmin.notify('An unexpected error occurred. Please refresh the page.', 'error');
        });

        // Offline detection
        window.addEventListener('online', () => {
            LondaAdmin.notify('Connection restored', 'success', 3000);
        });

        window.addEventListener('offline', () => {
            LondaAdmin.notify('You are currently offline', 'warning', 0);
        });
    </script>

    <!-- Additional Scripts -->
    @stack('scripts')
</body>

</html>
