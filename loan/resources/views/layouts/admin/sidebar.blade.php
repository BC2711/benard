<aside
    class="fixed inset-y-0 left-0 z-50 flex w-72 -translate-x-full flex-col border-r border-white/70 bg-white/90 shadow-lift backdrop-blur-xl transition-all duration-300 dark:border-slate-800 dark:bg-slate-950/95 lg:translate-x-0"
    x-data="adminSidebar(@js($menu_data ?? []))"
    :class="{
        'translate-x-0': sidebarOpen,
        'lg:w-20': sidebarCollapsed,
        'lg:w-72': !sidebarCollapsed
    }"
    aria-label="Primary navigation">
    <div class="flex h-18 items-center gap-3 border-b border-slate-200/70 px-4 py-4 dark:border-slate-800">
        <a href="{{ route('management.dashboard.index') }}" class="flex min-w-0 flex-1 items-center gap-3">
            <span class="grid h-11 w-11 shrink-0 place-items-center rounded-2xl bg-brand-700 shadow-soft">
                <img src="{{ asset('assets/logos/londa.jpg') }}" alt="Londa Loans" class="h-8 w-8 rounded-xl object-cover">
            </span>
            <span class="min-w-0" x-show="!sidebarCollapsed" x-transition.opacity>
                <span class="block truncate text-lg font-extrabold tracking-tight">Londa Loans</span>
                <span class="block truncate text-xs font-semibold text-slate-500 dark:text-slate-400">Enterprise admin</span>
            </span>
        </a>
        <button type="button" class="admin-icon-btn lg:hidden" @click="sidebarOpen = false" aria-label="Close sidebar">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <div class="px-3 py-4" x-show="!sidebarCollapsed" x-transition.opacity>
        <label class="relative block">
            <span class="sr-only">Search navigation</span>
            <i class="fas fa-search pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-sm text-slate-400"></i>
            <input type="search" x-model="navSearch"
                class="admin-input h-11 w-full pl-9 text-sm" placeholder="Search menu">
        </label>
    </div>

    <nav class="custom-scrollbar flex-1 overflow-y-auto px-3 pb-4">
        <div class="space-y-6">
            <div>
                <p class="mb-2 px-3 text-xs font-bold uppercase tracking-wider text-slate-400" x-show="!sidebarCollapsed">
                    Workspace
                </p>
                <a href="{{ route('management.dashboard.index') }}" class="admin-nav-link"
                    @class(['is-active' => request()->routeIs('management.dashboard.*')])>
                    <i class="fas fa-table-cells-large"></i>
                    <span x-show="!sidebarCollapsed">Dashboard</span>
                    <span class="admin-nav-badge" x-show="!sidebarCollapsed">Live</span>
                </a>
                <a href="{{ route('management.users.index') }}" class="admin-nav-link"
                    @class(['is-active' => request()->routeIs('management.users.*')])>
                    <i class="fas fa-users-gear"></i>
                    <span x-show="!sidebarCollapsed">Users & Roles</span>
                </a>
                <a href="{{ route('management.consultation.index') }}" class="admin-nav-link"
                    @class(['is-active' => request()->routeIs('management.consultation.*')])>
                    <i class="fas fa-calendar-check"></i>
                    <span x-show="!sidebarCollapsed">Consultations</span>
                    <span class="admin-count" x-show="!sidebarCollapsed">8</span>
                </a>
                <a href="{{ route('management.cms.pages.index') }}" class="admin-nav-link"
                    @class(['is-active' => request()->routeIs('management.cms.*')])>
                    <i class="fas fa-layer-group"></i>
                    <span x-show="!sidebarCollapsed">CMS Pages</span>
                </a>
                <a href="{{ route('management.cms.collections.index', 'services') }}" class="admin-nav-link"
                    @class(['is-active' => request()->routeIs('management.cms.collections.*')])>
                    <i class="fas fa-database"></i>
                    <span x-show="!sidebarCollapsed">CMS Collections</span>
                </a>
            </div>

            <template x-for="group in filteredGroups" :key="group.id">
                <div>
                    <p class="mb-2 px-3 text-xs font-bold uppercase tracking-wider text-slate-400"
                        x-show="!sidebarCollapsed" x-text="group.name"></p>
                    <div class="space-y-1">
                        <template x-for="item in group.children" :key="item.id">
                            <div>
                                <a :href="item.url" class="admin-nav-link" :class="{ 'is-active': isActive(item.url) }">
                                    <i :class="item.icon || 'fas fa-circle'"></i>
                                    <span x-show="!sidebarCollapsed" x-text="item.name"></span>
                                </a>
                            </div>
                        </template>
                    </div>
                </div>
            </template>

            <div>
                <p class="mb-2 px-3 text-xs font-bold uppercase tracking-wider text-slate-400" x-show="!sidebarCollapsed">
                    Intelligence
                </p>
                <a href="#" class="admin-nav-link">
                    <i class="fas fa-chart-line"></i>
                    <span x-show="!sidebarCollapsed">Analytics</span>
                </a>
                <a href="#" class="admin-nav-link">
                    <i class="fas fa-file-export"></i>
                    <span x-show="!sidebarCollapsed">Reports</span>
                </a>
                <a href="#" class="admin-nav-link">
                    <i class="fas fa-server"></i>
                    <span x-show="!sidebarCollapsed">System Monitor</span>
                </a>
                <a href="#" class="admin-nav-link">
                    <i class="fas fa-sliders"></i>
                    <span x-show="!sidebarCollapsed">Settings</span>
                </a>
            </div>
        </div>
    </nav>

    <div class="border-t border-slate-200/70 p-3 dark:border-slate-800">
        <a href="{{ route('management.profile') }}"
            class="flex items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50 p-3 transition hover:-translate-y-0.5 hover:border-brand-200 hover:bg-white hover:shadow-soft dark:border-slate-800 dark:bg-slate-900 dark:hover:bg-slate-900/80">
            <img class="h-10 w-10 rounded-xl object-cover"
                src="{{ auth()->user()->profile_picture ? Storage::url(auth()->user()->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->first_name . ' ' . auth()->user()->last_name) . '&color=155e75&background=ecfeff' }}"
                alt="{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}">
            <span class="min-w-0" x-show="!sidebarCollapsed" x-transition.opacity>
                <span class="block truncate text-sm font-bold">{{ auth()->user()->username }}</span>
                <span class="mt-0.5 flex items-center gap-1.5 text-xs text-slate-500">
                    <span class="h-2 w-2 rounded-full bg-emerald-500"></span>{{ ucfirst(auth()->user()->role) }}
                </span>
            </span>
        </a>
        <button type="button" class="admin-nav-link mt-3 hidden w-full lg:flex"
            @click="sidebarCollapsed = !sidebarCollapsed"
            :aria-label="sidebarCollapsed ? 'Expand sidebar' : 'Collapse sidebar'">
            <i class="fas" :class="sidebarCollapsed ? 'fa-angles-right' : 'fa-angles-left'"></i>
            <span x-show="!sidebarCollapsed">Collapse sidebar</span>
        </button>
    </div>
</aside>

<script>
    function adminSidebar(groups) {
        return {
            navSearch: '',
            groups,
            get filteredGroups() {
                if (!this.navSearch) return this.groups;
                const term = this.navSearch.toLowerCase();
                return this.groups.map(group => ({
                    ...group,
                    children: (group.children || []).filter(item => item.name.toLowerCase().includes(term))
                })).filter(group => group.children.length);
            },
            isActive(url) {
                if (!url || url === '#') return false;
                try {
                    const target = new URL(url, window.location.origin).pathname;
                    return window.location.pathname === target;
                } catch (error) {
                    return false;
                }
            }
        }
    }
</script>
