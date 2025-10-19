@props([
    'iconOpen' => 'times',
    'iconClosed' => 'bars',
    'size' => 'md',
    'position' => 'relative',
])

@php
    $sizes = [
        'sm' => 'w-8 h-8 text-sm',
        'md' => 'w-10 h-10 text-base',
        'lg' => 'w-12 h-12 text-lg',
    ];

    $positions = [
        'fixed' => 'fixed top-4 left-4 z-50',
        'absolute' => 'absolute top-4 left-4 z-50',
        'relative' => 'relative',
    ];

    $sizeClass = $sizes[$size] ?? $sizes['md'];
    $positionClass = $positions[$position] ?? 'relative';
@endphp

<button @click="sidebarOpen = !sidebarOpen"
    class="{{ $positionClass }} {{ $sizeClass }} bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 flex items-center justify-center text-gray-500 dark:text-gray-400 hover:text-londa-orange dark:hover:text-londa-300 hover:border-londa-orange transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-londa-orange focus:ring-offset-2 dark:focus:ring-offset-gray-900 group lg:hidden"
    aria-label="Toggle sidebar navigation" :aria-expanded="sidebarOpen" aria-controls="sidebar">
    <!-- Animated Hamburger Icon -->
    <div class="relative w-5 h-5 transform transition-transform duration-200" :class="{ 'rotate-180': sidebarOpen }">
        <span
            class="absolute top-1/2 left-1/2 w-4 h-0.5 bg-current transform -translate-x-1/2 -translate-y-1/2 transition-all duration-200"
            :class="sidebarOpen ? 'rotate-45' : '-translate-y-1.5'"></span>
        <span
            class="absolute top-1/2 left-1/2 w-4 h-0.5 bg-current transform -translate-x-1/2 -translate-y-1/2 transition-all duration-200"
            :class="sidebarOpen ? 'opacity-0' : 'opacity-100'"></span>
        <span
            class="absolute top-1/2 left-1/2 w-4 h-0.5 bg-current transform -translate-x-1/2 -translate-y-1/2 transition-all duration-200"
            :class="sidebarOpen ? '-rotate-45' : 'translate-y-1.5'"></span>
    </div>

    <!-- Pulse dot when sidebar is closed -->
    <div class="absolute -top-1 -right-1 w-2 h-2 bg-londa-orange rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-200"
        :class="{ 'opacity-100 animate-pulse': !sidebarOpen }"></div>
</button>
