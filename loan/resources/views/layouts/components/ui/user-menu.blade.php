@props([
    'size' => 'md',
])

@php
    $sizes = [
        'sm' => 'w-8 h-8',
        'md' => 'w-10 h-10',
        'lg' => 'w-12 h-12',
    ];

    $sizeClass = $sizes[$size] ?? $sizes['md'];
@endphp

<div class="relative" x-data="userMenu">
    <button @click="toggleUserMenu()"
        class="flex items-center space-x-3 text-gray-700 dark:text-gray-300 hover:text-londa-orange dark:hover:text-londa-300 focus:outline-none focus:ring-2 focus:ring-londa-orange focus:ring-offset-2 p-2 rounded-xl transition-all duration-200 group relative"
        aria-label="User menu" :aria-expanded="userMenuOpen">

        <!-- User Avatar -->
        <div class="relative">
            <img class="{{ $sizeClass }} rounded-full border-2 border-transparent group-hover:border-londa-orange transition-colors duration-200 shadow-lg"
                src="{{ auth()->user()->profile_picture ? Storage::url(auth()->user()->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->first_name . ' ' . auth()->user()->last_name) . '&color=7F9CF5&background=EBF4FF&size=128' }}"
                alt="{{ auth()->user()->first_name }}'s profile picture" loading="lazy">
            <div
                class="absolute -bottom-1 -right-1 w-3 h-3 bg-green-400 border-2 border-white dark:border-gray-800 rounded-full shadow-sm animate-pulse">
            </div>
        </div>

        <!-- User Info (hidden on mobile) -->
        <div class="hidden lg:block text-left">
            <p
                class="text-sm font-semibold text-gray-900 dark:text-white group-hover:text-londa-orange transition-colors duration-200 truncate max-w-32">
                {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
            </p>
            <p class="text-xs text-gray-500 dark:text-gray-400 truncate max-w-32">
                {{ ucfirst(auth()->user()->role) }}
            </p>
        </div>

        <!-- Chevron Icon -->
        <i class="fas fa-chevron-down text-xs transition-transform duration-200"
            :class="{ 'transform rotate-180': userMenuOpen }" aria-hidden="true"></i>
    </button>

    <!-- User Dropdown Menu -->
    <div x-show="userMenuOpen" @click.away="userMenuOpen = false" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
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
                        {{ auth()->user()->email }}
                    </p>
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

        <!-- Logout -->
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

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('userMenu', () => ({
            userMenuOpen: false,

            toggleUserMenu() {
                this.userMenuOpen = !this.userMenuOpen;
            }
        }));
    });
</script>
