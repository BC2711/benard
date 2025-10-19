<div id="sidebar"
    class="sidebar-transition bg-white dark:bg-gray-800 w-64 shadow-xl flex flex-col border-r border-gray-200 dark:border-gray-700 relative z-40"
    role="navigation" aria-label="Main navigation" x-data="{
        collapsed: localStorage.getItem('sidebarCollapsed') === 'true',
        userMenuOpen: false,
        activeSubmenu: null,
        searchQuery: '',
        get filteredMenuItems() {
            if (!this.searchQuery) return [];
            // Implement search functionality here
            return [];
        }
    }" :class="{ 'w-20': collapsed }"
    @keydown.escape="userMenuOpen = false; activeSubmenu = null">

    <!-- Sidebar Resize Handle -->
    <div class="absolute -right-2 top-1/2 transform -translate-y-1/2 w-1 h-16 bg-gray-300 dark:bg-gray-600 rounded-full cursor-col-resize opacity-0 hover:opacity-100 transition-opacity duration-200 hidden lg:block"
        @mousedown="startResize" title="Resize sidebar">
    </div>

    <!-- Logo Section -->
    <div
        class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-white to-londa-50 dark:from-gray-800 dark:to-gray-900">
        <div class="flex items-center space-x-3" :class="{ 'justify-center': collapsed }">
            <div
                class="w-12 h-12 bg-gradient-to-br from-londa-orange to-orange-600 rounded-xl flex items-center justify-center shadow-lg group relative">
                <img src="{{ asset('assets/logos/londa.jpg') }}" alt="Londa Loans Logo"
                    class="w-8 h-8 rounded object-cover transition-transform duration-300 group-hover:scale-110"
                    loading="lazy">
                <div
                    class="absolute inset-0 bg-londa-orange rounded-xl opacity-0 group-hover:opacity-20 transition-opacity duration-300">
                </div>
            </div>
            <div class="flex-1 min-w-0 transition-all duration-300" :class="{ 'opacity-0 w-0 hidden': collapsed }">
                <h1 class="text-xl font-bold text-gray-900 dark:text-white truncate">
                    Londa<span class="text-green-600 dark:text-green-400">Loans</span>
                </h1>
                <p class="text-xs text-gray-600 dark:text-gray-400 mt-1 font-medium animate-pulse-soft">
                    Ma Loans Yama Londa!
                </p>
            </div>
        </div>
    </div>

    <!-- Search Bar -->
    <div class="px-3 py-3 border-b border-gray-200 dark:border-gray-700 transition-all duration-300"
        :class="{ 'opacity-0 h-0 py-0 hidden': collapsed }">
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-search text-gray-400 text-sm"></i>
            </div>
            <input type="text" x-model="searchQuery"
                class="w-full pl-10 pr-4 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-londa-orange focus:border-londa-orange dark:focus:ring-londa-400 dark:focus:border-londa-400 text-sm transition-all duration-200"
                placeholder="Search menu..." aria-label="Search menu items">
        </div>
    </div>

    <!-- Navigation Menu -->
    <div class="flex-1 overflow-y-auto custom-scrollbar py-4">
        <nav class="px-3 space-y-1" aria-label="Sidebar navigation">

            <!-- Search Results -->
            <template x-if="searchQuery.length > 0">
                <div class="mb-4">
                    <div
                        class="px-3 py-2 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                        Search Results
                    </div>
                    <div class="space-y-1">
                        <template x-for="item in filteredMenuItems" :key="item.id">
                            <a :href="item.url"
                                class="nav-item flex items-center px-3 py-2 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-londa-50 dark:hover:bg-gray-700 hover:text-londa-orange dark:hover:text-londa-300 transition-all duration-200 ease-in-out group">
                                <i class="fas fa-search w-5 text-center text-gray-400 group-hover:text-londa-orange transition-colors duration-200"
                                    aria-hidden="true"></i>
                                <span class="ml-3 font-medium text-sm" x-text="item.name"></span>
                            </a>
                        </template>
                        <div x-show="filteredMenuItems.length === 0"
                            class="px-3 py-2 text-sm text-gray-500 dark:text-gray-400 text-center">
                            No results found
                        </div>
                    </div>
                </div>
            </template>

            <!-- Dynamic Menu Content -->
            <div x-show="searchQuery.length === 0">
                {!! $menu_html !!}
            </div>

            <!-- Quick Actions -->
            <div class="mt-6 pt-4 border-t border-gray-200 dark:border-gray-700 transition-all duration-300"
                :class="{ 'opacity-0 h-0 pt-0 hidden': collapsed }">
                <h3
                    class="px-3 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-3 flex items-center">
                    <i class="fas fa-bolt w-4 text-center mr-2" aria-hidden="true"></i>
                    Quick Actions
                </h3>
                <div class="space-y-1">
                    <a href="{{ route('management.dashboard') }}"
                        class="nav-item group flex items-center px-3 py-2 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-londa-50 dark:hover:bg-gray-700 hover:text-londa-orange dark:hover:text-londa-300 transition-all duration-200 ease-in-out">
                        <i class="fas fa-plus w-5 text-center text-gray-400 group-hover:text-londa-orange transition-colors duration-200"
                            aria-hidden="true"></i>
                        <span class="ml-3 font-medium text-sm">New Loan</span>
                    </a>
                    <a href="{{ route('management.users.create') }}"
                        class="nav-item group flex items-center px-3 py-2 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-londa-50 dark:hover:bg-gray-700 hover:text-londa-orange dark:hover:text-londa-300 transition-all duration-200 ease-in-out">
                        <i class="fas fa-user-plus w-5 text-center text-gray-400 group-hover:text-londa-orange transition-colors duration-200"
                            aria-hidden="true"></i>
                        <span class="ml-3 font-medium text-sm">Add User</span>
                    </a>
                </div>
            </div>

            <!-- Administration Section -->
            <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                <h3 class="px-3 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-3 flex items-center transition-all duration-300"
                    :class="{ 'opacity-0 hidden': collapsed }">
                    <i class="fas fa-cog w-4 text-center mr-2" aria-hidden="true"></i>
                    Administration
                </h3>
                <div class="space-y-1">
                    <a href="{{ route('management.users.index') }}"
                        class="nav-item group flex items-center px-3 py-2.5 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-londa-50 dark:hover:bg-gray-700 hover:text-londa-orange dark:hover:text-londa-300 transition-all duration-200 ease-in-out border-l-4"
                        :class="{
                                                   'bg-londa-50 dark:bg-gray-700 text-londa-orange dark:text-londa-300 border-l-4 border-londa-orange': request()->routeIs('management.users.*'),
                                                   'border-transparent': !request()->routeIs('management.users.*')
                                               }">
                        <i class="fas fa-user-shield w-5 text-center transition-colors duration-200"
                            :class="{
                                                           'text-londa-orange': request()->routeIs('management.users.*'),
                                                           'text-gray-400 group-hover:text-londa-orange': !request()->routeIs('management.users.*')
                                                       }"
                            aria-hidden="true"></i>
                        <span class="ml-3 font-medium text-sm transition-all duration-300"
                            :class="{ 'opacity-0 w-0 hidden': collapsed }">Admin Users</span>
                        <span class="ml-auto transition-all duration-200"
                            :class="{
                                                              'opacity-100': !collapsed && (request()->routeIs('management.users.*') || group.hover),
                                                              'opacity-0': collapsed || (!request()->routeIs('management.users.*') && !group.hover)
                                                          }">
                            <i class="fas fa-chevron-right text-xs text-gray-400" aria-hidden="true"></i>
                        </span>
                    </a>
                </div>
            </div>

        </nav>
    </div>

    <!-- User Profile Section -->
    <div class="p-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50">
        <div class="relative">
            <button @click="userMenuOpen = !userMenuOpen"
                class="flex items-center space-x-3 w-full p-2 rounded-lg hover:bg-white dark:hover:bg-gray-800 hover:shadow-sm transition-all duration-200 ease-in-out group focus:outline-none focus:ring-2 focus:ring-londa-orange focus:ring-offset-2 dark:focus:ring-offset-gray-900"
                aria-label="User menu" :aria-expanded="userMenuOpen">
                <div class="relative">
                    <img class="w-10 h-10 rounded-full border-2 border-transparent group-hover:border-londa-orange transition-colors duration-200 shadow-sm"
                        src="{{ auth()->user()->profile_picture ? Storage::url(auth()->user()->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->first_name . ' ' . auth()->user()->last_name) . '&color=7F9CF5&background=EBF4FF&size=128' }}"
                        alt="Profile picture of {{ auth()->user()->first_name }}" loading="lazy">
                    <div class="absolute -bottom-1 -right-1 w-3 h-3 bg-green-400 border-2 border-white dark:border-gray-800 rounded-full shadow-sm"
                        title="Online"></div>
                </div>
                <div class="flex-1 min-w-0 text-left transition-all duration-300"
                    :class="{ 'opacity-0 w-0 hidden': collapsed }">
                    <p
                        class="text-sm font-semibold text-gray-900 dark:text-white truncate group-hover:text-londa-orange transition-colors duration-200">
                        {{ auth()->user()->username }}
                    </p>
                    <p class="text-xs text-gray-600 dark:text-gray-400 truncate flex items-center">
                        <span class="w-2 h-2 bg-green-400 rounded-full mr-1.5 animate-pulse-soft"></span>
                        {{ ucfirst(auth()->user()->role) }}
                    </p>
                </div>
                <i class="fas fa-chevron-down text-xs text-gray-400 transition-transform duration-200 ease-in-out"
                    :class="{ 'transform rotate-180': userMenuOpen }" aria-hidden="true"></i>
            </button>

            <!-- User Dropdown Menu -->
            <div x-show="userMenuOpen" @click.away="userMenuOpen = false"
                x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                class="absolute bottom-full left-0 mb-2 w-full bg-white dark:bg-gray-800 rounded-lg shadow-xl border border-gray-200 dark:border-gray-700 py-1 z-50"
                x-cloak>
                <div class="px-4 py-2 border-b border-gray-200 dark:border-gray-700">
                    <p class="text-sm font-medium text-gray-900 dark:text-white">
                        {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                    </p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ auth()->user()->email }}</p>
                </div>

                <a href="{{ route('management.profile') }}"
                    class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-londa-50 dark:hover:bg-gray-700 hover:text-londa-orange dark:hover:text-londa-300 transition-colors duration-150 group">
                    <i class="fas fa-user-circle mr-3 text-gray-400 group-hover:text-londa-orange transition-colors duration-150 w-4 text-center"
                        aria-hidden="true"></i>
                    My Profile
                </a>

                <a href="{{ route('management.change-password') }}"
                    class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-londa-50 dark:hover:bg-gray-700 hover:text-londa-orange dark:hover:text-londa-300 transition-colors duration-150 group">
                    <i class="fas fa-key mr-3 text-gray-400 group-hover:text-londa-orange transition-colors duration-150 w-4 text-center"
                        aria-hidden="true"></i>
                    Change Password
                </a>

                <div class="border-t border-gray-200 dark:border-gray-700 my-1"></div>

                <form action="{{ route('management.logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="flex items-center w-full px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors duration-150 group">
                        <i class="fas fa-sign-out-alt mr-3 text-red-400 group-hover:text-red-600 transition-colors duration-150 w-4 text-center"
                            aria-hidden="true"></i>
                        Sign Out
                    </button>
                </form>
            </div>
        </div>

        <!-- System Status -->
        <div class="mt-3 pt-3 border-t border-gray-200 dark:border-gray-700 transition-all duration-300"
            :class="{ 'opacity-0 h-0 pt-0 hidden': collapsed }">
            <div class="flex items-center justify-between text-xs">
                <span class="text-gray-600 dark:text-gray-400">System Status</span>
                <span class="flex items-center text-green-600 dark:text-green-400 font-medium">
                    <i class="fas fa-circle text-xs mr-1 animate-pulse-soft" aria-hidden="true"></i>
                    Operational
                </span>
            </div>
            <div class="mt-1 text-xs text-gray-500 dark:text-gray-500">
                Last login: {{ auth()->user()->updated_at->diffForHumans() }}
            </div>
        </div>

        <!-- Collapse Toggle -->
        <button @click="collapsed = !collapsed; localStorage.setItem('sidebarCollapsed', collapsed)"
            class="absolute -right-3 top-1/2 transform -translate-y-1/2 w-6 h-6 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-full shadow-md flex items-center justify-center text-gray-500 dark:text-gray-400 hover:text-londa-orange dark:hover:text-londa-300 transition-all duration-200 hover:shadow-lg"
            :aria-label="collapsed ? 'Expand sidebar' : 'Collapse sidebar'" title="Toggle sidebar">
            <i class="fas text-xs transition-transform duration-300"
                :class="collapsed ? 'fa-chevron-right' : 'fa-chevron-left'"></i>
        </button>
    </div>
</div>

<style>
    .sidebar-transition {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Custom scrollbar styling */
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
        border-radius: 3px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 3px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    .dark .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #4b5563;
    }

    .dark .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #6b7280;
    }

    /* Active state for navigation items */
    .nav-item.active {
        background-color: #fef6e6;
        color: #db9123;
        border-left-color: #db9123;
    }

    .dark .nav-item.active {
        background-color: rgba(219, 145, 35, 0.1);
        color: #fbd895;
    }

    .nav-item.active i {
        color: #db9123;
    }

    /* Smooth hover effects */
    .nav-item {
        position: relative;
        overflow: hidden;
    }

    .nav-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(219, 145, 35, 0.1), transparent);
        transition: left 0.5s ease-in-out;
    }

    .nav-item:hover::before {
        left: 100%;
    }

    /* Active state dot indicator */
    .nav-item.active::after {
        content: '';
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        width: 6px;
        height: 6px;
        background-color: #db9123;
        border-radius: 50%;
        animation: pulse-dot 2s infinite;
    }

    @keyframes pulse-dot {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.5;
        }
    }

    /* Shimmer effect for loading */
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

    /* Soft pulse animation */
    .animate-pulse-soft {
        animation: pulse-soft 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    @keyframes pulse-soft {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.7;
        }
    }
</style>

<script>
   document.addEventListener('DOMContentLoaded', function() {
    initializeSidebar();
    initializeActiveStates();
    initializeResizeHandler();
});

function initializeSidebar() {
    // Sidebar resize functionality
    let isResizing = false;

    function startResize(e) {
        isResizing = true;
        document.addEventListener('mousemove', handleResize);
        document.addEventListener('mouseup', stopResize);
        e.preventDefault();
    }

    function handleResize(e) {
        if (!isResizing) return;

        const sidebar = document.getElementById('sidebar');
        const newWidth = Math.max(200, Math.min(400, e.clientX - sidebar.getBoundingClientRect().left));
        sidebar.style.width = `${newWidth}px`;
    }

    function stopResize() {
        isResizing = false;
        document.removeEventListener('mousemove', handleResize);
        document.removeEventListener('mouseup', stopResize);
    }

    // CORRECTED: Use a proper CSS selector
    const resizeHandle = document.querySelector('[data-resize-handle]');
    if (resizeHandle) {
        resizeHandle.addEventListener('mousedown', startResize);
    }

    // Update the HTML to include the data attribute
    if (!resizeHandle) {
        // Add the resize handle if it doesn't exist
        const sidebar = document.getElementById('sidebar');
        if (sidebar) {
            const resizeElement = document.createElement('div');
            resizeElement.className = 'absolute -right-2 top-1/2 transform -translate-y-1/2 w-1 h-16 bg-gray-300 dark:bg-gray-600 rounded-full cursor-col-resize opacity-0 hover:opacity-100 transition-opacity duration-200 hidden lg:block';
            resizeElement.setAttribute('data-resize-handle', 'true');
            resizeElement.setAttribute('title', 'Resize sidebar');
            sidebar.appendChild(resizeElement);
            
            // Add event listener to the newly created element
            resizeElement.addEventListener('mousedown', startResize);
        }
    }

    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        const sidebar = document.getElementById('sidebar');
        if (!sidebar) return;
        
        const data = Alpine.$data(sidebar);
        if (e.key === 'Escape') {
            // Close all open menus
            if (data) {
                data.userMenuOpen = false;
                data.activeSubmenu = null;
            }
        }

        // Ctrl/Cmd + B to toggle sidebar
        if ((e.ctrlKey || e.metaKey) && e.key === 'b') {
            e.preventDefault();
            if (data) {
                data.collapsed = !data.collapsed;
                localStorage.setItem('sidebarCollapsed', data.collapsed);
            }
        }
    });
}

function initializeActiveStates() {
    // Enhanced active state detection with route matching
    function updateActiveStates() {
        const currentPath = window.location.pathname;
        const currentRoute = window.location.href;

        document.querySelectorAll('.nav-item').forEach(item => {
            const href = item.getAttribute('href');
            if (href) {
                // Remove existing active classes
                item.classList.remove('active', 'bg-londa-50', 'text-londa-orange', 'border-l-4', 'border-londa-orange');

                // Check for exact or partial route matches
                if (isActiveRoute(href, currentPath, currentRoute)) {
                    item.classList.add('active', 'bg-londa-50', 'text-londa-orange', 'border-l-4', 'border-londa-orange');
                    item.setAttribute('aria-current', 'page');
                } else {
                    item.removeAttribute('aria-current');
                }
            }
        });
    }

    function isActiveRoute(menuHref, currentPath, currentRoute) {
        try {
            // Handle relative URLs
            let menuPath = menuHref;
            if (menuHref.startsWith('http')) {
                const menuUrl = new URL(menuHref);
                menuPath = menuUrl.pathname;
            } else {
                // For relative URLs, construct full URL
                const fullUrl = new URL(menuHref, window.location.origin);
                menuPath = fullUrl.pathname;
            }

            // Exact match
            if (currentPath === menuPath) return true;

            // Parent route match (e.g., /admin/users matches /admin/users/1)
            if (menuPath !== '/' && currentPath.startsWith(menuPath + '/')) return true;

            // Exact match for root
            if (menuPath === '/' && currentPath === '/') return true;

            return false;
        } catch (e) {
            console.warn('Error checking active route:', e);
            return false;
        }
    }

    // Initial update
    updateActiveStates();

    // Update on navigation
    document.addEventListener('click', function(e) {
        const link = e.target.closest('a.nav-item');
        if (link) {
            setTimeout(updateActiveStates, 100);
        }
    });

    // Update on browser history changes
    window.addEventListener('popstate', updateActiveStates);
}

function initializeResizeHandler() {
    let resizeTimer;

    function handleResize() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            const sidebar = document.getElementById('sidebar');
            if (!sidebar) return;
            
            const data = Alpine.$data(sidebar);
            if (!data) return;

            // Auto-collapse on very small screens
            if (window.innerWidth < 768 && !data.collapsed) {
                data.collapsed = true;
                localStorage.setItem('sidebarCollapsed', 'true');
            }

            // Auto-expand on larger screens if previously collapsed for mobile
            if (window.innerWidth >= 1024 && data.collapsed && localStorage.getItem('sidebarCollapsed') !== 'true') {
                data.collapsed = false;
            }
        }, 250);
    }

    window.addEventListener('resize', handleResize);
    handleResize(); // Initial check
}

// Safe Alpine.js data access utility
function getAlpineData(element) {
    if (!element || !element.__x) return null;
    return element.__x;
}

// Export sidebar utilities to global scope with error handling
window.SidebarManager = {
    toggle() {
        const sidebar = document.getElementById('sidebar');
        if (!sidebar) return;
        
        const data = getAlpineData(sidebar);
        if (data) {
            data.collapsed = !data.collapsed;
            localStorage.setItem('sidebarCollapsed', data.collapsed);
        }
    },

    expand() {
        const sidebar = document.getElementById('sidebar');
        if (!sidebar) return;
        
        const data = getAlpineData(sidebar);
        if (data) {
            data.collapsed = false;
            localStorage.setItem('sidebarCollapsed', 'false');
        }
    },

    collapse() {
        const sidebar = document.getElementById('sidebar');
        if (!sidebar) return;
        
        const data = getAlpineData(sidebar);
        if (data) {
            data.collapsed = true;
            localStorage.setItem('sidebarCollapsed', 'true');
        }
    },

    isCollapsed() {
        const sidebar = document.getElementById('sidebar');
        if (!sidebar) return true;
        
        const data = getAlpineData(sidebar);
        return data ? data.collapsed : true;
    }
};

// Error handling for the entire application
window.addEventListener('error', function(e) {
    console.error('Global error caught:', e.error);
    
    // Don't show error notifications for Alpine.js initialization errors
    if (e.error && e.error.message && e.error.message.includes('Alpine')) {
        return;
    }
    
    // Show user-friendly error message
    if (window.LondaAdmin && window.LondaAdmin.notify) {
        window.LondaAdmin.notify('An unexpected error occurred. Please refresh the page.', 'error');
    }
});

// Alpine.js initialization safety
document.addEventListener('alpine:init', function() {
    console.log('Alpine.js initialized successfully');
});
</script>
