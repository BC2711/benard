<!DOCTYPE html>
<html lang="en" class="h-full scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Londa Loans administration workspace">
    <title>@yield('title', 'Admin') - Londa Loans</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('assets/logos/londa.jpg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/premium-ui.css') }}">
    <script src="{{ asset('assets/js/tailwind.js') }}"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'system-ui', 'sans-serif'] },
                    colors: {
                        brand: {
                            50: '#ecfeff', 100: '#cffafe', 500: '#0891b2',
                            600: '#0e7490', 700: '#155e75', 900: '#083344'
                        },
                        mint: { 500: '#0f766e', 600: '#0d625c' },
                        gold: { 500: '#d99b2b', 600: '#b87d18' }
                    },
                    boxShadow: {
                        soft: '0 18px 60px rgba(15, 23, 42, 0.08)',
                        lift: '0 26px 80px rgba(15, 23, 42, 0.14)'
                    }
                }
            }
        }
    </script>
    @stack('styles')
</head>

<body
    class="premium-admin min-h-full bg-slate-50 font-sans text-slate-950 antialiased dark:bg-slate-950 dark:text-slate-100"
    x-data="adminShell()" x-init="init()" :class="{ 'dark': darkMode }" @keydown.escape="closePanels()">
    <a href="#admin-content"
        class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-[80] focus:rounded-lg focus:bg-white focus:px-4 focus:py-2 focus:text-sm focus:font-semibold focus:text-brand-700 focus:shadow-lift">
        Skip to content
    </a>

    <div x-show="booting" x-transition.opacity
        class="fixed inset-0 z-[90] grid place-items-center bg-white/90 backdrop-blur dark:bg-slate-950/90">
        <div class="text-center">
            <div class="mx-auto grid h-14 w-14 place-items-center rounded-2xl bg-brand-700 text-white shadow-lift">
                <img src="{{ asset('assets/logos/londa.jpg') }}" alt="" class="h-9 w-9 rounded-xl object-cover">
            </div>
            <p class="mt-4 text-sm font-semibold text-slate-600 dark:text-slate-300">Preparing workspace</p>
        </div>
    </div>

    <div class="min-h-screen lg:flex">
        <div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 z-40 bg-slate-950/50 lg:hidden"
            @click="sidebarOpen = false" aria-hidden="true"></div>

        @include('layouts.admin.sidebar')

        <div class="min-w-0 flex-1 transition-all duration-300"
            :class="sidebarCollapsed ? 'lg:pl-20' : 'lg:pl-72'">
            @include('layouts.admin.header')

            <main id="admin-content" class="relative min-h-[calc(100vh-72px)] px-4 py-5 sm:px-6 lg:px-8">
                <div class="mx-auto max-w-[1500px]">
                    <section
                        class="mb-6 rounded-2xl border border-white/70 bg-white/80 p-4 shadow-soft backdrop-blur-xl dark:border-slate-800 dark:bg-slate-900/80 sm:p-5">
                        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                            <div>
                                @hasSection('breadcrumbs')
                                    <div class="mb-3 text-sm text-slate-500 dark:text-slate-400">
                                        @yield('breadcrumbs')
                                    </div>
                                @else
                                    <nav class="mb-3 flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400"
                                        aria-label="Breadcrumb">
                                        <a href="{{ route('management.dashboard.index') }}"
                                            class="hover:text-brand-700 dark:hover:text-cyan-300">Admin</a>
                                        <i class="fas fa-chevron-right text-[10px]" aria-hidden="true"></i>
                                        <span>@yield('title', 'Dashboard')</span>
                                    </nav>
                                @endif
                                <div class="flex items-center gap-3">
                                    @hasSection('page-icon')
                                        <div class="grid h-11 w-11 place-items-center rounded-xl bg-brand-50 text-brand-700 dark:bg-cyan-400/10 dark:text-cyan-200">
                                            @yield('page-icon')
                                        </div>
                                    @endif
                                    <div>
                                        <div class="text-2xl font-bold tracking-tight text-slate-950 dark:text-white">
                                            @yield('page-title', 'Dashboard')
                                        </div>
                                        @hasSection('page-description')
                                            <p class="mt-1 max-w-3xl text-sm text-slate-500 dark:text-slate-400">
                                                @yield('page-description')
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @hasSection('page-actions')
                                <div class="flex flex-wrap items-center gap-3">@yield('page-actions')</div>
                            @endif
                        </div>
                    </section>

                    <div class="fixed right-4 top-24 z-[70] w-[min(92vw,24rem)] space-y-3" aria-live="polite">
                        @foreach (['success', 'error', 'warning', 'info'] as $type)
                            @if (session($type))
                                <div class="admin-toast {{ $type }}" x-data="{ show: true }" x-show="show"
                                    x-transition>
                                    <i class="fas {{ $type === 'success' ? 'fa-check-circle' : ($type === 'error' ? 'fa-circle-exclamation' : ($type === 'warning' ? 'fa-triangle-exclamation' : 'fa-circle-info')) }}"></i>
                                    <span>{{ session($type) }}</span>
                                    <button type="button" @click="show = false" aria-label="Dismiss message">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    @if ($errors->any())
                        <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-4 text-sm text-red-700 dark:border-red-900/60 dark:bg-red-950/40 dark:text-red-200">
                            <p class="font-semibold">Please fix the highlighted fields.</p>
                            <ul class="mt-2 list-inside list-disc space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="admin-page-enter space-y-6">
                        @yield('content')
                    </div>
                </div>
            </main>
        </div>
    </div>

    <div x-show="drawerOpen" x-transition.opacity class="fixed inset-0 z-[75] bg-slate-950/40" @click="drawerOpen = false"></div>
    <aside x-show="drawerOpen" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"
        class="fixed right-0 top-0 z-[80] h-full w-full max-w-md border-l border-slate-200 bg-white p-6 shadow-lift dark:border-slate-800 dark:bg-slate-950"
        aria-label="Notification center">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-semibold uppercase text-brand-700 dark:text-cyan-300">Notifications</p>
                <h2 class="mt-1 text-xl font-bold">Operational center</h2>
            </div>
            <button type="button" class="admin-icon-btn" @click="drawerOpen = false" aria-label="Close notifications">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="mt-6 space-y-3">
            <template x-for="item in notifications" :key="item.title">
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-800 dark:bg-slate-900">
                    <div class="flex gap-3">
                        <span class="mt-1 h-2.5 w-2.5 rounded-full" :class="item.color"></span>
                        <div>
                            <p class="font-semibold" x-text="item.title"></p>
                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400" x-text="item.message"></p>
                            <p class="mt-2 text-xs font-medium text-slate-400" x-text="item.time"></p>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </aside>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function adminShell() {
            return {
                booting: true,
                sidebarOpen: false,
                sidebarCollapsed: localStorage.getItem('sidebarCollapsed') === 'true',
                darkMode: localStorage.getItem('darkMode') === 'true',
                userMenuOpen: false,
                quickOpen: false,
                searchOpen: false,
                drawerOpen: false,
                notifications: [
                    { title: 'New consultation request', message: 'A customer submitted a consultation form.', time: '2 min ago', color: 'bg-brand-500' },
                    { title: 'Weekly report ready', message: 'Performance analytics export is available.', time: '1 hour ago', color: 'bg-gold-500' },
                    { title: 'System health normal', message: 'All critical services are responding.', time: 'Today', color: 'bg-emerald-500' }
                ],
                init() {
                    document.documentElement.classList.toggle('dark', this.darkMode);
                    setTimeout(() => this.booting = false, 350);
                    this.$watch('darkMode', value => {
                        localStorage.setItem('darkMode', value);
                        document.documentElement.classList.toggle('dark', value);
                    });
                    this.$watch('sidebarCollapsed', value => localStorage.setItem('sidebarCollapsed', value));
                },
                closePanels() {
                    this.sidebarOpen = false;
                    this.userMenuOpen = false;
                    this.quickOpen = false;
                    this.searchOpen = false;
                    this.drawerOpen = false;
                }
            }
        }

        window.AdminUI = {
            confirmSubmit(form, message = 'Are you sure you want to continue?') {
                if (confirm(message)) form.submit();
            },
            toast(message, type = 'info') {
                const toast = document.createElement('div');
                toast.className = `admin-toast ${type} fixed right-4 top-4 z-[100]`;
                toast.innerHTML = `<i class="fas fa-circle-info"></i><span>${message}</span><button type="button" aria-label="Dismiss"><i class="fas fa-times"></i></button>`;
                toast.querySelector('button').addEventListener('click', () => toast.remove());
                document.body.appendChild(toast);
                setTimeout(() => toast.remove(), 4500);
            }
        };
    </script>
    @stack('scripts')
</body>

</html>
