<header class="bg-white dark:bg-gray-800 shadow-sm z-40 border-b border-gray-200 dark:border-gray-700 relative"
    role="banner" x-data="headerManager"
    @keydown.escape="searchOpen = false; notificationsOpen = false; messagesOpen = false; userMenuOpen = false; quickActionsOpen = false">

    <!-- Announcement Bar -->
    @include('layouts.components.ui.announcement-bar')

    <div class="flex items-center justify-between px-4 sm:px-6 py-3">
        <!-- Left Section -->
        <div class="flex items-center space-x-4 flex-1">
            @include('layouts.components.ui.menu-toggle')
            @include('layouts.components.ui.breadcrumb')
            @include('layouts.components.forms.global-search')
        </div>

        <!-- Right Section -->
        <div class="flex items-center space-x-3 sm:space-x-4">
            @include('layouts.components.ui.quick-actions-button')
            @include('layouts.components.ui.theme-toggle')
            @include('layouts.components.ui.notifications-button')
            @include('layouts.components.ui.messages-button')
            @include('layouts.components.ui.user-menu')
        </div>
    </div>
</header>
