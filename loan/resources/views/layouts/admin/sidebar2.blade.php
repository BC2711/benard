<div id="sidebar"
    class="sidebar-transition bg-white dark:bg-gray-800 w-64 shadow-xl flex flex-col border-r border-gray-200 dark:border-gray-700 relative z-40"
    role="navigation" aria-label="Main navigation" x-data="sidebarManager" :class="{ 'w-20': collapsed }"
    @keydown.escape="userMenuOpen = false; activeSubmenu = null">

    <!-- Sidebar Resize Handle -->
    <div class="absolute -right-2 top-1/2 transform -translate-y-1/2 w-1 h-16 bg-gray-300 dark:bg-gray-600 rounded-full cursor-col-resize opacity-0 hover:opacity-100 transition-opacity duration-200 hidden lg:block"
        data-resize-handle="true" title="Resize sidebar">
    </div>

    <!-- Logo Section -->
    <div
        class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-white to-londa-50 dark:from-gray-800 dark:to-gray-900">
        <div class="flex items-center space-x-3" :class="{ 'justify-center': collapsed }">
            @include('layouts.components.ui.logo', ['collapsed' => 'collapsed'])
        </div>
    </div>

    <!-- Search Bar -->
    <div class="px-3 py-3 border-b border-gray-200 dark:border-gray-700 transition-all duration-300"
        :class="{ 'opacity-0 h-0 py-0 hidden': collapsed }">
        <div class="relative">
            @include('layouts.components.forms.search-input')
        </div>
    </div>

    <!-- Navigation Menu -->
    <div class="flex-1 overflow-y-auto custom-scrollbar py-4">
        <nav class="px-3 space-y-1" aria-label="Sidebar navigation">
            <!-- Search Results -->
            <template x-if="searchQuery.length > 0">
                <div class="mb-4">
                    @include('layouts.components.ui.search-results')
                </div>
            </template>

            <!-- Dynamic Menu Content -->
            <div x-show="searchQuery.length === 0">
                {!! $menu_html !!}
            </div>

            <!-- Quick Actions -->
            @include('layouts.components.ui.quick-actions-button')

            <!-- Administration Section -->
            @include('layouts.components.ui.admin-section')
        </nav>
    </div>

    <!-- User Profile Section -->
    @include('layouts.components.ui.user-profile')
</div>

<style>
    .sidebar-transition {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
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
</style>




