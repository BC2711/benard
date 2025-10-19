@props([
    'collapsed' => false
])

<div class="p-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50">
    <div class="relative">
        <button @click="userMenuOpen = !userMenuOpen"
                class="flex items-center space-x-3 w-full p-2 rounded-lg hover:bg-white dark:hover:bg-gray-800 hover:shadow-sm transition-all duration-200 ease-in-out group focus:outline-none focus:ring-2 focus:ring-londa-orange focus:ring-offset-2 dark:focus:ring-offset-gray-900"
                aria-label="User menu" 
                :aria-expanded="userMenuOpen">
            
            <!-- User Avatar -->
            <div class="relative">
                <img class="w-10 h-10 rounded-full border-2 border-transparent group-hover:border-londa-orange transition-colors duration-200 shadow-sm"
                     src="{{ auth()->user()->profile_picture ? Storage::url(auth()->user()->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->first_name . ' ' . auth()->user()->last_name) . '&color=7F9CF5&background=EBF4FF&size=128' }}"
                     alt="Profile picture of {{ auth()->user()->first_name }}" 
                     loading="lazy">
                <div class="absolute -bottom-1 -right-1 w-3 h-3 bg-green-400 border-2 border-white dark:border-gray-800 rounded-full shadow-sm"
                     title="Online"></div>
            </div>

            <!-- User Info -->
            <div class="flex-1 min-w-0 text-left transition-all duration-300"
                 :class="{ 'opacity-0 w-0 hidden': {{ $collapsed ? 'true' : 'false' }} }">
                <p class="text-sm font-semibold text-gray-900 dark:text-white truncate group-hover:text-londa-orange transition-colors duration-200">
                    {{ auth()->user()->username }}
                </p>
                <p class="text-xs text-gray-600 dark:text-gray-400 truncate flex items-center">
                    <span class="w-2 h-2 bg-green-400 rounded-full mr-1.5 animate-pulse-soft"></span>
                    {{ ucfirst(auth()->user()->role) }}
                </p>
            </div>

            <!-- Chevron -->
            <i class="fas fa-chevron-down text-xs text-gray-400 transition-transform duration-200 ease-in-out"
               :class="{ 'transform rotate-180': userMenuOpen }" 
               aria-hidden="true"></i>
        </button>

        <!-- User Dropdown Menu -->
        <div x-show="userMenuOpen" 
             @click.away="userMenuOpen = false"
             x-transition:enter="transition ease-out duration-200" 
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100" 
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 scale-100" 
             x-transition:leave-end="opacity-0 scale-95"
             class="absolute bottom-full left-0 mb-2 w-full bg-white dark:bg-gray-800 rounded-lg shadow-xl border border-gray-200 dark:border-gray-700 py-1 z-50"
             x-cloak>
            
            <!-- User Info -->
            <div class="px-4 py-2 border-b border-gray-200 dark:border-gray-700">
                <p class="text-sm font-medium text-gray-900 dark:text-white">
                    {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                </p>
                <p class="text-xs text-gray-500 dark:text-gray-400">{{ auth()->user()->email }}</p>
            </div>

            <!-- Menu Items -->
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

            <!-- Divider -->
            <div class="border-t border-gray-200 dark:border-gray-700 my-1"></div>

            <!-- Logout -->
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
         :class="{ 'opacity-0 h-0 pt-0 hidden': {{ $collapsed ? 'true' : 'false' }} }">
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
            :aria-label="collapsed ? 'Expand sidebar' : 'Collapse sidebar'" 
            title="Toggle sidebar">
        <i class="fas text-xs transition-transform duration-300"
           :class="collapsed ? 'fa-chevron-right' : 'fa-chevron-left'"></i>
    </button>
</div>