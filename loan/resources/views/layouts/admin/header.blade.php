<header class="bg-white dark:bg-gray-800 shadow-sm z-40 border-b border-gray-200 dark:border-gray-700 relative"
    role="banner" x-data="{
        sidebarOpen: false,
        searchOpen: false,
        searchQuery: '',
        notificationsOpen: false,
        messagesOpen: false,
        userMenuOpen: false,
        quickActionsOpen: false,
        darkMode: localStorage.getItem('darkMode') === 'true',
        unreadNotifications: 3,
        unreadMessages: 5,
        searchResults: [],
        isLoading: false,
        get filteredResults() {
            if (!this.searchQuery) return [];
            return this.searchResults.filter(item =>
                item.title.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                item.description.toLowerCase().includes(this.searchQuery.toLowerCase())
            );
        }
    }"
    @keydown.escape="searchOpen = false; notificationsOpen = false; messagesOpen = false; userMenuOpen = false; quickActionsOpen = false"
    @search-results.window="searchResults = $event.detail">

    <!-- Announcement Bar -->
    <div class="bg-gradient-to-r from-londa-orange to-orange-500 px-4 py-2 text-white text-sm text-center">
        <div class="flex items-center justify-center space-x-2">
            <i class="fas fa-rocket animate-pulse"></i>
            <span>Welcome to Londa Loans Admin v2.0 - New features available!</span>
            <a href="#" class="underline hover:no-underline ml-2 font-medium">Learn more</a>
        </div>
    </div>

    <div class="flex items-center justify-between px-4 sm:px-6 py-3">
        <!-- Left Section: Menu Toggle, Breadcrumb & Search -->
        <div class="flex items-center space-x-4 flex-1">
            <!-- Menu Toggle -->
            <button @click="sidebarOpen = !sidebarOpen; $dispatch('sidebar-toggle', { open: sidebarOpen })"
                class="text-gray-500 hover:text-londa-orange dark:text-gray-400 dark:hover:text-londa-300 focus:outline-none focus:ring-2 focus:ring-londa-orange focus:ring-offset-2 p-2 rounded-lg transition-all duration-200 group relative"
                aria-label="Toggle sidebar" :aria-expanded="sidebarOpen">
                <i class="fas fa-bars text-lg sm:text-xl transition-transform duration-300"
                    :class="{ 'rotate-90': sidebarOpen }" aria-hidden="true"></i>
                <div
                    class="absolute -top-1 -right-1 w-3 h-3 bg-londa-orange rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                </div>
            </button>

            <!-- Breadcrumb -->
            <nav class="hidden lg:flex items-center space-x-2 text-sm" aria-label="Breadcrumb">
                <a href="{{ route('management.dashboard') }}"
                    class="text-gray-500 dark:text-gray-400 hover:text-londa-orange dark:hover:text-londa-300 transition-colors">
                    <i class="fas fa-home"></i>
                </a>
                <span class="text-gray-300 dark:text-gray-600">/</span>
                <span class="text-gray-700 dark:text-gray-300 font-medium" x-text="currentPage"></span>
            </nav>

            <!-- Search Bar -->
            <div class="relative flex-1 max-w-2xl">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
                        aria-hidden="true">
                        <i class="fas fa-search text-gray-400 text-sm" :class="{ 'text-londa-orange': searchOpen }"></i>
                    </div>
                    <input type="text" x-model="searchQuery" @focus="searchOpen = true"
                        @input.debounce.300ms="performSearch"
                        class="w-full pl-10 pr-12 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-londa-orange focus:border-londa-orange dark:focus:ring-londa-400 dark:focus:border-londa-400 transition-all duration-200 placeholder-gray-500 dark:placeholder-gray-400"
                        placeholder="Search customers, loans, reports..." aria-label="Search">

                    <!-- Search Shortcut -->
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                        <kbd
                            class="hidden sm:inline-flex items-center px-2 py-1 border border-gray-300 dark:border-gray-600 rounded text-xs text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800">
                            ⌘K
                        </kbd>
                    </div>
                </div>

                <!-- Search Results Dropdown -->
                <div x-show="searchOpen && searchQuery.length > 0" @click.away="searchOpen = false"
                    x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                    class="absolute top-full left-0 right-0 mt-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-2xl z-50 max-h-96 overflow-y-auto custom-scrollbar"
                    x-cloak>

                    <!-- Recent Searches -->
                    <template x-if="searchQuery.length < 2">
                        <div class="p-4 border-b border-gray-100 dark:border-gray-700">
                            <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-3 flex items-center">
                                <i class="fas fa-clock mr-2 text-gray-400"></i>
                                Recent Searches
                            </h3>
                            <div class="space-y-2">
                                <button
                                    class="flex items-center w-full text-left p-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 text-sm text-gray-600 dark:text-gray-400">
                                    <i class="fas fa-search mr-3 text-gray-400"></i>
                                    John Doe - Loan Application
                                </button>
                                <button
                                    class="flex items-center w-full text-left p-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 text-sm text-gray-600 dark:text-gray-400">
                                    <i class="fas fa-search mr-3 text-gray-400"></i>
                                    Business Loans Report
                                </button>
                            </div>
                        </div>
                    </template>

                    <!-- Search Results -->
                    <template x-if="searchQuery.length >= 2">
                        <div>
                            <div class="p-4 border-b border-gray-100 dark:border-gray-700">
                                <div class="flex items-center justify-between mb-3">
                                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white">
                                        Search Results
                                    </h3>
                                    <span class="text-xs text-gray-500 dark:text-gray-400"
                                        x-text="`${filteredResults.length} results`"></span>
                                </div>
                            </div>

                            <div class="max-h-80 overflow-y-auto">
                                <template x-for="item in filteredResults" :key="item.id">
                                    <a :href="item.url"
                                        class="flex items-center p-4 hover:bg-gray-50 dark:hover:bg-gray-700 border-b border-gray-100 dark:border-gray-700 last:border-b-0 group transition-colors duration-150">
                                        <div
                                            class="flex-shrink-0 w-10 h-10 rounded-lg bg-gradient-to-br from-londa-orange to-orange-500 flex items-center justify-center text-white mr-4">
                                            <i class="fas" :class="item.icon"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900 dark:text-white group-hover:text-londa-orange transition-colors"
                                                x-text="item.title"></p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1"
                                                x-text="item.description"></p>
                                        </div>
                                        <div class="flex-shrink-0 ml-4">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                                                :class="item.type === 'Customer' ?
                                                    'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' :
                                                    item.type === 'Loan' ?
                                                    'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300' :
                                                    'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-300'"
                                                x-text="item.type"></span>
                                        </div>
                                    </a>
                                </template>

                                <div x-show="filteredResults.length === 0 && !isLoading" class="p-8 text-center">
                                    <i class="fas fa-search text-gray-300 dark:text-gray-600 text-3xl mb-3"></i>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">No results found for "<span
                                            x-text="searchQuery" class="font-medium"></span>"</p>
                                    <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">Try different keywords or
                                        check your spelling</p>
                                </div>
                            </div>
                        </div>
                    </template>

                    <!-- Quick Actions -->
                    <div class="p-4 bg-gray-50 dark:bg-gray-900/50 rounded-b-xl">
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-gray-500 dark:text-gray-400">Quick Actions</span>
                            <div class="flex space-x-2">
                                <kbd
                                    class="px-1.5 py-1 border border-gray-300 dark:border-gray-600 rounded text-xs">↑↓</kbd>
                                <span class="text-gray-400">to navigate</span>
                                <kbd
                                    class="px-1.5 py-1 border border-gray-300 dark:border-gray-600 rounded text-xs">↵</kbd>
                                <span class="text-gray-400">to select</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Section: Actions & User Menu -->
        <div class="flex items-center space-x-3 sm:space-x-4">
            <!-- Quick Actions -->
            <div class="relative" x-data="{
                quickActions: [
                    { icon: 'fa-plus', label: 'New Loan', action: '{{ route('management.dashboard') }}', color: 'text-green-600' },
                    { icon: 'fa-user-plus', label: 'Add Customer', action: '{{ route('management.dashboard') }}', color: 'text-blue-600' },
                    { icon: 'fa-file-invoice', label: 'Create Report', action: '{{ route('management.dashboard') }}', color: 'text-purple-600' },
                    { icon: 'fa-chart-line', label: 'Analytics', action: '{{ route('management.dashboard') }}', color: 'text-orange-600' }
                ]
            }">
                <button @click="quickActionsOpen = !quickActionsOpen"
                    class="hidden sm:flex items-center space-x-2 px-4 py-2 bg-londa-orange text-white rounded-xl hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-londa-orange focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105"
                    aria-label="Quick actions" :aria-expanded="quickActionsOpen">
                    <i class="fas fa-bolt text-sm"></i>
                    <span class="font-medium text-sm">Quick Actions</span>
                    <i class="fas fa-chevron-down text-xs transition-transform duration-200"
                        :class="{ 'transform rotate-180': quickActionsOpen }"></i>
                </button>

                <!-- Quick Actions Dropdown -->
                <div x-show="quickActionsOpen" @click.away="quickActionsOpen = false"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                    class="absolute right-0 mt-2 w-64 bg-white dark:bg-gray-800 rounded-xl shadow-2xl border border-gray-200 dark:border-gray-700 py-2 z-50"
                    x-cloak>
                    <div class="px-4 py-2 border-b border-gray-100 dark:border-gray-700">
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Quick Actions</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Frequently used actions</p>
                    </div>

                    <div class="py-2">
                        <template x-for="action in quickActions" :key="action.label">
                            <a :href="action.action"
                                class="flex items-center px-4 py-3 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150 group">
                                <i class="fas text-lg mr-3 transition-transform group-hover:scale-110"
                                    :class="[action.icon, action.color]"></i>
                                <span x-text="action.label" class="font-medium"></span>
                                <i
                                    class="fas fa-arrow-right ml-auto text-gray-400 group-hover:text-londa-orange transition-colors transform group-hover:translate-x-1"></i>
                            </a>
                        </template>
                    </div>
                </div>
            </div>

            <!-- Theme Toggle -->
            <button
                @click="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode); $dispatch('theme-changed', { dark: darkMode })"
                class="text-gray-500 hover:text-londa-orange dark:text-gray-400 dark:hover:text-londa-300 focus:outline-none focus:ring-2 focus:ring-londa-orange focus:ring-offset-2 p-2 rounded-lg transition-all duration-200 relative group"
                aria-label="Toggle theme">
                <i class="fas text-lg" :class="darkMode ? 'fa-sun' : 'fa-moon'"></i>
                <div
                    class="absolute -top-1 -right-1 w-2 h-2 bg-londa-orange rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                </div>
            </button>

            <!-- Notifications -->
            <div class="relative">
                <button @click="notificationsOpen = !notificationsOpen; messagesOpen = false"
                    class="text-gray-500 hover:text-londa-orange dark:text-gray-400 dark:hover:text-londa-300 focus:outline-none focus:ring-2 focus:ring-londa-orange focus:ring-offset-2 p-2 rounded-lg transition-all duration-200 relative group"
                    aria-label="View notifications" :aria-expanded="notificationsOpen">
                    <i class="fas fa-bell text-lg sm:text-xl"></i>
                    <span
                        class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-medium animate-pulse shadow-lg"
                        x-text="unreadNotifications" x-show="unreadNotifications > 0"></span>
                    <div class="absolute -top-1 -right-1 w-3 h-3 bg-londa-orange rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-200"
                        x-show="unreadNotifications === 0"></div>
                </button>

                <!-- Notifications Dropdown -->
                <div x-show="notificationsOpen" @click.away="notificationsOpen = false"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                    class="absolute right-0 mt-2 w-80 sm:w-96 bg-white dark:bg-gray-800 rounded-xl shadow-2xl border border-gray-200 dark:border-gray-700 py-2 z-50 max-h-96 overflow-y-auto custom-scrollbar"
                    x-cloak>
                    <div class="px-4 py-3 border-b border-gray-100 dark:border-gray-700">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Notifications</h3>
                            <div class="flex items-center space-x-2">
                                <span class="text-sm text-gray-500 dark:text-gray-400"
                                    x-text="`${unreadNotifications} unread`"></span>
                                <button @click="markAllAsRead"
                                    class="text-xs text-londa-orange hover:text-orange-700 font-medium">
                                    Mark all as read
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Notification Items -->
                    <div class="divide-y divide-gray-100 dark:divide-gray-700">
                        <template x-for="notification in notifications" :key="notification.id">
                            <a :href="notification.url"
                                class="flex items-start px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150 group"
                                :class="{ 'bg-blue-50 dark:bg-blue-900/20': notification.unread }">
                                <div class="flex-shrink-0 mt-1">
                                    <div class="w-2 h-2 rounded-full animate-pulse"
                                        :class="{
                                            'bg-blue-500': notification.type === 'info',
                                            'bg-green-500': notification.type === 'success',
                                            'bg-yellow-500': notification.type === 'warning',
                                            'bg-red-500': notification.type === 'error'
                                        }">
                                    </div>
                                </div>
                                <div class="ml-3 flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white group-hover:text-londa-orange transition-colors"
                                        x-text="notification.title"></p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1"
                                        x-text="notification.message"></p>
                                    <div class="flex items-center mt-2 space-x-2">
                                        <span class="text-xs text-gray-400 dark:text-gray-500"
                                            x-text="notification.time"></span>
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium"
                                            :class="{
                                                'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300': notification
                                                    .type === 'info',
                                                'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300': notification
                                                    .type === 'success',
                                                'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300': notification
                                                    .type === 'warning',
                                                'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300': notification
                                                    .type === 'error'
                                            }"
                                            x-text="notification.type"></span>
                                    </div>
                                </div>
                                <button @click.stop="markAsRead(notification.id)"
                                    class="ml-3 opacity-0 group-hover:opacity-100 transition-opacity duration-200 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                                    <i class="fas fa-times text-xs"></i>
                                </button>
                            </a>
                        </template>
                    </div>

                    <div
                        class="px-4 py-3 border-t border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50 rounded-b-xl">
                        <a href="{{ route('management.dashboard') }}"
                            class="block text-center text-sm font-medium text-londa-orange hover:text-orange-700 dark:hover:text-orange-300 transition-colors duration-200">
                            View all notifications
                        </a>
                    </div>
                </div>
            </div>

            <!-- Messages -->
            <div class="relative">
                <button @click="messagesOpen = !messagesOpen; notificationsOpen = false"
                    class="text-gray-500 hover:text-londa-orange dark:text-gray-400 dark:hover:text-londa-300 focus:outline-none focus:ring-2 focus:ring-londa-orange focus:ring-offset-2 p-2 rounded-lg transition-all duration-200 relative group"
                    aria-label="View messages" :aria-expanded="messagesOpen">
                    <i class="fas fa-envelope text-lg sm:text-xl"></i>
                    <span
                        class="absolute -top-1 -right-1 bg-blue-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-medium shadow-lg"
                        x-text="unreadMessages" x-show="unreadMessages > 0"></span>
                    <div class="absolute -top-1 -right-1 w-3 h-3 bg-londa-orange rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-200"
                        x-show="unreadMessages === 0"></div>
                </button>

                <!-- Messages Dropdown -->
                <div x-show="messagesOpen" @click.away="messagesOpen = false"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                    class="absolute right-0 mt-2 w-80 sm:w-96 bg-white dark:bg-gray-800 rounded-xl shadow-2xl border border-gray-200 dark:border-gray-700 py-2 z-50 max-h-96 overflow-y-auto custom-scrollbar"
                    x-cloak>
                    <div class="px-4 py-3 border-b border-gray-100 dark:border-gray-700">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Messages</h3>
                            <span class="text-sm text-gray-500 dark:text-gray-400"
                                x-text="`${unreadMessages} unread`"></span>
                        </div>
                    </div>

                    <!-- Message Items -->
                    <div class="divide-y divide-gray-100 dark:divide-gray-700">
                        <template x-for="message in messages" :key="message.id">
                            <a :href="message.url"
                                class="flex items-start px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150 group"
                                :class="{ 'bg-blue-50 dark:bg-blue-900/20': message.unread }">
                                <img class="w-8 h-8 rounded-full flex-shrink-0 ring-2 ring-white dark:ring-gray-800"
                                    :src="message.avatar" :alt="message.name">
                                <div class="ml-3 flex-1 min-w-0">
                                    <div class="flex items-center justify-between">
                                        <p class="text-sm font-medium text-gray-900 dark:text-white group-hover:text-londa-orange transition-colors"
                                            x-text="message.name"></p>
                                        <span class="text-xs text-gray-400 dark:text-gray-500"
                                            x-text="message.time"></span>
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 truncate"
                                        x-text="message.preview"></p>
                                </div>
                            </a>
                        </template>
                    </div>

                    <div
                        class="px-4 py-3 border-t border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50 rounded-b-xl">
                        <a href="{{ route('management.dashboard') }}"
                            class="block text-center text-sm font-medium text-londa-orange hover:text-orange-700 dark:hover:text-orange-300 transition-colors duration-200">
                            View all messages
                        </a>
                    </div>
                </div>
            </div>

            <!-- User Menu -->
            <div class="relative">
                <button @click="userMenuOpen = !userMenuOpen"
                    class="flex items-center space-x-3 text-gray-700 dark:text-gray-300 hover:text-londa-orange dark:hover:text-londa-300 focus:outline-none focus:ring-2 focus:ring-londa-orange focus:ring-offset-2 p-2 rounded-xl transition-all duration-200 group relative"
                    aria-label="User menu" :aria-expanded="userMenuOpen">
                    <div class="relative">
                        <img class="w-8 h-8 rounded-full border-2 border-transparent group-hover:border-londa-orange transition-colors duration-200 shadow-lg"
                            src="{{ auth()->user()->profile_picture ? Storage::url(auth()->user()->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->first_name . ' ' . auth()->user()->last_name) . '&color=7F9CF5&background=EBF4FF&size=128' }}"
                            alt="{{ auth()->user()->first_name }}'s profile picture" loading="lazy">
                        <div
                            class="absolute -bottom-1 -right-1 w-3 h-3 bg-green-400 border-2 border-white dark:border-gray-800 rounded-full shadow-sm animate-pulse">
                        </div>
                    </div>
                    <div class="hidden lg:block text-left">
                        <p
                            class="text-sm font-semibold text-gray-900 dark:text-white group-hover:text-londa-orange transition-colors duration-200 truncate max-w-32">
                            {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                        </p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 truncate max-w-32">
                            {{ ucfirst(auth()->user()->role) }}
                        </p>
                    </div>
                    <i class="fas fa-chevron-down text-xs transition-transform duration-200"
                        :class="{ 'transform rotate-180': userMenuOpen }" aria-hidden="true"></i>
                </button>

                <!-- User Dropdown Menu -->
                <div x-show="userMenuOpen" @click.away="userMenuOpen = false"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                    class="absolute right-0 mt-2 w-64 bg-white dark:bg-gray-800 rounded-xl shadow-2xl border border-gray-200 dark:border-gray-700 py-2 z-50"
                    x-cloak>
                    <!-- User Info -->
                    <div class="px-4 py-3 border-b border-gray-100 dark:border-gray-700">
                        <div class="flex items-center space-x-3">
                            <img class="w-12 h-12 rounded-full border-2 border-londa-orange"
                                src="{{ auth()->user()->profile_picture ? Storage::url(auth()->user()->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->first_name . ' ' . auth()->user()->last_name) . '&color=7F9CF5&background=EBF4FF&size=128' }}"
                                alt="{{ auth()->user()->first_name }}'s profile picture">
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-gray-900 dark:text-white truncate">
                                    {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 truncate">
                                    {{ auth()->user()->email }}</p>
                                <div class="flex items-center mt-1">
                                    <span
                                        class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-londa-100 text-londa-800 dark:bg-londa-900 dark:text-londa-300">
                                        {{ ucfirst(auth()->user()->role) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Menu Items -->
                    <div class="py-2">
                        <a href="{{ route('management.profile') }}"
                            class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-londa-50 dark:hover:bg-gray-700 hover:text-londa-orange dark:hover:text-londa-300 transition-colors duration-150 group">
                            <i
                                class="fas fa-user-circle mr-3 text-gray-400 group-hover:text-londa-orange transition-colors duration-150 w-5 text-center"></i>
                            <span>My Profile</span>
                        </a>
                        <a href="{{ route('management.dashboard') }}"
                            class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-londa-50 dark:hover:bg-gray-700 hover:text-londa-orange dark:hover:text-londa-300 transition-colors duration-150 group">
                            <i
                                class="fas fa-cog mr-3 text-gray-400 group-hover:text-londa-orange transition-colors duration-150 w-5 text-center"></i>
                            <span>Settings</span>
                        </a>
                        <a href="{{ route('management.dashboard') }}"
                            class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-londa-50 dark:hover:bg-gray-700 hover:text-londa-orange dark:hover:text-londa-300 transition-colors duration-150 group">
                            <i
                                class="fas fa-question-circle mr-3 text-gray-400 group-hover:text-londa-orange transition-colors duration-150 w-5 text-center"></i>
                            <span>Help & Support</span>
                        </a>
                    </div>

                    <div class="border-t border-gray-100 dark:border-gray-700 py-2">
                        <form action="{{ route('management.logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="flex items-center w-full px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors duration-150 group">
                                <i
                                    class="fas fa-sign-out-alt mr-3 text-red-400 group-hover:text-red-600 transition-colors duration-150 w-5 text-center"></i>
                                <span>Sign out</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        initializeHeader();
        initializeSearch();
        initializeNotifications();
    });

    function initializeHeader() {
        // Update current page title
        const pageTitle = document.querySelector('h1')?.textContent || 'Dashboard';
        Alpine.$data(document.querySelector('header')).currentPage = pageTitle;

        // Keyboard shortcuts
        document.addEventListener('keydown', (e) => {
            // Cmd/Ctrl + K for search
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                const searchInput = document.querySelector('input[type="text"]');
                if (searchInput) {
                    searchInput.focus();
                    Alpine.$data(document.querySelector('header')).searchOpen = true;
                }
            }

            // Cmd/Ctrl + / for help
            if ((e.ctrlKey || e.metaKey) && e.key === '/') {
                e.preventDefault();
                showKeyboardShortcuts();
            }
        });

        // Close dropdowns when clicking outside
        document.addEventListener('click', (e) => {
            const header = document.querySelector('header');
            const data = Alpine.$data(header);
            if (!e.target.closest('[x-data]')) {
                data.searchOpen = false;
                data.notificationsOpen = false;
                data.messagesOpen = false;
                data.userMenuOpen = false;
                data.quickActionsOpen = false;
            }
        });
    }

    function initializeSearch() {
        const header = document.querySelector('header');
        const data = Alpine.$data(header);

        // Sample search data
        data.searchResults = [{
                id: 1,
                title: 'John Doe',
                description: 'Customer - Loan Application Pending',
                type: 'Customer',
                icon: 'fa-user',
                url: '/customers/1'
            },
            {
                id: 2,
                title: 'Business Expansion Loan',
                description: 'Loan Application - $50,000',
                type: 'Loan',
                icon: 'fa-file-invoice-dollar',
                url: '/loans/123'
            },
            {
                id: 3,
                title: 'Monthly Performance Report',
                description: 'Generated on Dec 1, 2024',
                type: 'Report',
                icon: 'fa-chart-bar',
                url: '/reports/monthly'
            }
        ];

        data.performSearch = function() {
            if (this.searchQuery.length < 2) return;

            this.isLoading = true;

            // Simulate API call
            setTimeout(() => {
                this.isLoading = false;
                // In real implementation, you would fetch from your backend
                // this.searchResults = await fetchSearchResults(this.searchQuery);
            }, 300);
        };
    }

    function initializeNotifications() {
        const header = document.querySelector('header');
        const data = Alpine.$data(header);

        // Sample notifications
        data.notifications = [{
                id: 1,
                title: 'New Loan Application',
                message: 'John Smith submitted a loan application for $25,000',
                type: 'info',
                time: '2 minutes ago',
                unread: true,
                url: '/loans/456'
            },
            {
                id: 2,
                title: 'Payment Received',
                message: 'Payment of $1,200 received from Sarah Johnson',
                type: 'success',
                time: '1 hour ago',
                unread: true,
                url: '/payments/789'
            },
            {
                id: 3,
                title: 'Document Expiry Warning',
                message: '3 customer documents are expiring in 7 days',
                type: 'warning',
                time: '5 hours ago',
                unread: true,
                url: '/documents'
            }
        ];

        // Sample messages
        data.messages = [{
                id: 1,
                name: 'Sarah Johnson',
                avatar: 'https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
                preview: 'Hi, I wanted to follow up on my loan application...',
                time: '10:24 AM',
                unread: true,
                url: '/messages/1'
            },
            {
                id: 2,
                name: 'Mike Chen',
                avatar: 'https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
                preview: 'Regarding the document requirements for...',
                time: 'Yesterday',
                unread: false,
                url: '/messages/2'
            }
        ];

        data.markAsRead = function(notificationId) {
            const notification = this.notifications.find(n => n.id === notificationId);
            if (notification && notification.unread) {
                notification.unread = false;
                this.unreadNotifications--;
            }
        };

        data.markAllAsRead = function() {
            this.notifications.forEach(notification => {
                notification.unread = false;
            });
            this.unreadNotifications = 0;
        };
    }

    function showKeyboardShortcuts() {
        const shortcuts = [{
                key: '⌘K',
                action: 'Focus search'
            },
            {
                key: '⌘/',
                action: 'Show shortcuts'
            },
            {
                key: 'Esc',
                action: 'Close modals/dropdowns'
            },
            {
                key: '⌘B',
                action: 'Toggle sidebar'
            },
            {
                key: '⌘P',
                action: 'Print current page'
            }
        ];

        // You can implement a proper modal here
        console.log('Keyboard Shortcuts:', shortcuts);
        // For now, we'll use a simple alert
        alert('Keyboard Shortcuts:\n\n' + shortcuts.map(s => `${s.key} - ${s.action}`).join('\n'));
    }

    // Export header utilities
    window.HeaderManager = {
        toggleSearch() {
            const header = document.querySelector('header');
            const data = Alpine.$data(header);
            data.searchOpen = !data.searchOpen;
            if (data.searchOpen) {
                const searchInput = document.querySelector('input[type="text"]');
                searchInput?.focus();
            }
        },

        showNotification(message, type = 'info') {
            // Implementation for showing toast notifications
            console.log(`Notification (${type}):`, message);
        },

        updateNotificationCount(count) {
            const header = document.querySelector('header');
            Alpine.$data(header).unreadNotifications = count;
        }
    };
</script>

<style>
    /* Custom scrollbar for dropdowns */
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
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

    .dark .custom-scrollbar::-webkit-scrollbar-track {
        background: #1e293b;
    }

    .dark .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #475569;
    }

    .dark .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #64748b;
    }

    /* Smooth transitions */
    .transition-all {
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Hide Alpine.js elements until loaded */
    [x-cloak] {
        display: none !important;
    }

    /* Pulse animation for notifications */
    @keyframes pulse {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.5;
        }
    }

    .animate-pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    /* Gradient backgrounds */
    .bg-gradient-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    /* Shadow enhancements */
    .shadow-2xl {
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }
</style>
