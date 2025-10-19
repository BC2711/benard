@props([
    'version' => '1.0.0',
    'showSystemStatus' => true,
    'showLastUpdated' => true,
])

<footer class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 py-4 px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between text-sm text-gray-500 dark:text-gray-400">
        <!-- Left Section -->
        <div class="flex items-center space-x-4 mb-2 sm:mb-0">
            <span>&copy; {{ date('Y') }} Londa Loans. All rights reserved.</span>

            @if ($showSystemStatus)
                <span class="hidden sm:inline">•</span>
                <span class="flex items-center">
                    <span class="w-2 h-2 bg-green-400 rounded-full mr-2 animate-pulse-soft"></span>
                    System Operational
                </span>
            @endif
        </div>

        <!-- Right Section -->
        <div class="flex items-center space-x-4">
            <span>v{{ $version }}</span>

            @if ($showLastUpdated)
                <span class="hidden sm:inline">•</span>
                <span>Last updated: {{ now()->format('M j, Y') }}</span>
            @endif
        </div>
    </div>

    <!-- Additional Footer Content -->
    @if ($slot->isNotEmpty())
        <div class="mt-3 pt-3 border-t border-gray-200 dark:border-gray-700">
            {{ $slot }}
        </div>
    @endif
</footer>
