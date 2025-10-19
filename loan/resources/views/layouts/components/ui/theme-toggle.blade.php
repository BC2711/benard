@props([
    'size' => 'md',
    'showLabel' => false,
])

@php
    $sizes = [
        'sm' => 'w-8 h-8 text-sm',
        'md' => 'w-10 h-10 text-base',
        'lg' => 'w-12 h-12 text-lg',
    ];

    $sizeClass = $sizes[$size] ?? $sizes['md'];
@endphp

<button @click="toggleDarkMode()"
    class="{{ $sizeClass }} text-gray-500 hover:text-londa-orange dark:text-gray-400 dark:hover:text-londa-300 focus:outline-none focus:ring-2 focus:ring-londa-orange focus:ring-offset-2 p-2 rounded-lg transition-all duration-200 relative group"
    aria-label="Toggle theme" :aria-pressed="darkMode">
    <!-- Sun Icon (Light Mode) -->
    <i class="fas fa-sun absolute inset-0 flex items-center justify-center transition-all duration-300 transform"
        :class="darkMode ? 'rotate-90 opacity-0' : 'rotate-0 opacity-100'"></i>

    <!-- Moon Icon (Dark Mode) -->
    <i class="fas fa-moon absolute inset-0 flex items-center justify-center transition-all duration-300 transform"
        :class="darkMode ? 'rotate-0 opacity-100' : '-rotate-90 opacity-0'"></i>

    <!-- Pulse Effect -->
    <div class="absolute -top-1 -right-1 w-2 h-2 bg-londa-orange rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-200"
        :class="{ 'animate-pulse': !darkMode }"></div>

    @if ($showLabel)
        <span class="sr-only" x-text="darkMode ? 'Switch to light mode' : 'Switch to dark mode'"></span>
    @endif
</button>

<style>
    @keyframes sunPulse {

        0%,
        100% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.1);
        }
    }

    .animate-sun-pulse {
        animation: sunPulse 2s ease-in-out infinite;
    }
</style>
