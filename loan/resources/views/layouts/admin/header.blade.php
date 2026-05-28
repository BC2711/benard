<header
    class="sticky top-0 z-30 border-b border-white/70 bg-white/75 px-4 py-3 shadow-sm backdrop-blur-xl dark:border-slate-800 dark:bg-slate-950/80 sm:px-6 lg:px-8">
    <div class="mx-auto flex max-w-[1500px] items-center gap-3">
        <button type="button" class="admin-icon-btn lg:hidden" @click="sidebarOpen = true" aria-label="Open sidebar">
            <i class="fas fa-bars"></i>
        </button>

        <div class="relative hidden min-w-0 flex-1 md:block" x-data="{ query: '', open: false }">
            <i class="fas fa-search pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-sm text-slate-400"></i>
            <input id="globalSearch" type="search" x-model="query" @focus="open = true"
                @keydown.window.ctrl.k.prevent="$el.focus(); open = true"
                class="admin-input h-11 w-full max-w-2xl pl-10 pr-20 text-sm"
                placeholder="Search users, content, reports, or settings" aria-label="Global search">
            <kbd
                class="pointer-events-none absolute right-3 top-1/2 hidden -translate-y-1/2 rounded-md border border-slate-200 bg-white px-2 py-1 text-[11px] font-bold text-slate-400 dark:border-slate-700 dark:bg-slate-900 sm:block">Ctrl K</kbd>
            <div x-show="open && query.length" x-transition @click.outside="open = false"
                class="absolute left-0 top-full mt-3 w-full max-w-2xl rounded-2xl border border-slate-200 bg-white p-2 shadow-lift dark:border-slate-800 dark:bg-slate-900">
                <a href="{{ route('management.users.index') }}" class="admin-search-result">
                    <i class="fas fa-users"></i>
                    <span>
                        <strong>User management</strong>
                        <small>Manage roles, status, and profiles</small>
                    </span>
                </a>
                <a href="{{ route('management.dashboard.index') }}" class="admin-search-result">
                    <i class="fas fa-chart-line"></i>
                    <span>
                        <strong>Dashboard analytics</strong>
                        <small>Review platform performance</small>
                    </span>
                </a>
            </div>
        </div>

        <div class="ml-auto flex items-center gap-2">
            <button type="button" class="admin-icon-btn" @click="quickOpen = !quickOpen" aria-label="Open quick actions">
                <i class="fas fa-bolt"></i>
            </button>
            <button type="button" class="admin-icon-btn" @click="darkMode = !darkMode" aria-label="Toggle dark mode">
                <i class="fas" :class="darkMode ? 'fa-sun' : 'fa-moon'"></i>
            </button>
            <button type="button" class="admin-icon-btn relative" @click="drawerOpen = true" aria-label="Open notifications">
                <i class="fas fa-bell"></i>
                <span class="absolute right-2 top-2 h-2.5 w-2.5 rounded-full border-2 border-white bg-gold-500 dark:border-slate-950"></span>
            </button>

            <div class="relative">
                <button type="button"
                    class="flex items-center gap-2 rounded-2xl border border-slate-200 bg-white p-1.5 pr-3 shadow-sm transition hover:border-brand-200 hover:shadow-soft dark:border-slate-800 dark:bg-slate-900"
                    @click="userMenuOpen = !userMenuOpen" :aria-expanded="userMenuOpen" aria-label="Open profile menu">
                    <img class="h-9 w-9 rounded-xl object-cover"
                        src="{{ auth()->user()->profile_picture ? Storage::url(auth()->user()->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->first_name . ' ' . auth()->user()->last_name) . '&color=155e75&background=ecfeff' }}"
                        alt="{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}">
                    <span class="hidden text-left sm:block">
                        <span class="block text-sm font-bold leading-4">{{ auth()->user()->first_name }}</span>
                        <span class="text-xs text-slate-500">{{ ucfirst(auth()->user()->role) }}</span>
                    </span>
                    <i class="fas fa-chevron-down text-xs text-slate-400"></i>
                </button>

                <div x-show="userMenuOpen" x-transition @click.outside="userMenuOpen = false"
                    class="absolute right-0 mt-3 w-64 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-lift dark:border-slate-800 dark:bg-slate-900">
                    <div class="border-b border-slate-100 p-4 dark:border-slate-800">
                        <p class="font-bold">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</p>
                        <p class="truncate text-sm text-slate-500">{{ auth()->user()->email }}</p>
                    </div>
                    <div class="p-2">
                        <a href="{{ route('management.profile') }}" class="admin-menu-item">
                            <i class="fas fa-user-circle"></i>Profile
                        </a>
                        <a href="{{ route('management.change-password') }}" class="admin-menu-item">
                            <i class="fas fa-key"></i>Security
                        </a>
                        <form action="{{ route('management.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="admin-menu-item w-full text-red-600 dark:text-red-300">
                                <i class="fas fa-arrow-right-from-bracket"></i>Sign out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div x-show="quickOpen" x-transition @click.outside="quickOpen = false"
            class="absolute right-4 top-16 z-50 w-80 rounded-2xl border border-slate-200 bg-white p-3 shadow-lift dark:border-slate-800 dark:bg-slate-900">
            <p class="px-2 pb-2 text-xs font-bold uppercase tracking-wider text-slate-400">Quick actions</p>
            <div class="grid grid-cols-2 gap-2">
                <a href="{{ route('management.users.create') }}" class="admin-quick-action">
                    <i class="fas fa-user-plus"></i><span>Add user</span>
                </a>
                <a href="{{ route('management.consultation.index') }}" class="admin-quick-action">
                    <i class="fas fa-calendar-check"></i><span>Consultations</span>
                </a>
                <button type="button" class="admin-quick-action" onclick="window.print()">
                    <i class="fas fa-print"></i><span>Print page</span>
                </button>
                <button type="button" class="admin-quick-action" @click="drawerOpen = true; quickOpen = false">
                    <i class="fas fa-bell"></i><span>Alerts</span>
                </button>
            </div>
        </div>
    </div>
</header>
