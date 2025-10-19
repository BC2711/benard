@props([
    'icon' => 'bolt',
    'label' => 'Quick Actions',
    'size' => 'md',
])

@php
    $sizes = [
        'sm' => 'px-3 py-1.5 text-xs',
        'md' => 'px-4 py-2 text-sm',
        'lg' => 'px-5 py-2.5 text-base',
    ];

    $sizeClass = $sizes[$size] ?? $sizes['md'];
@endphp

<div class="relative hidden sm:block" x-data="quickActions">
    <button @click="actionsOpen = !actionsOpen"
        class="flex items-center space-x-2 {{ $sizeClass }} bg-londa-orange text-white rounded-xl hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-londa-orange focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105"
        aria-label="Quick actions" :aria-expanded="actionsOpen">
        <i class="fas fa-{{ $icon }} text-sm"></i>
        <span class="font-medium">{{ $label }}</span>
        <i class="fas fa-chevron-down text-xs transition-transform duration-200"
            :class="{ 'transform rotate-180': actionsOpen }"></i>
    </button>

    <!-- Quick Actions Dropdown -->
    <div x-show="actionsOpen" @click.away="actionsOpen = false" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="absolute right-0 mt-2 w-64 bg-white dark:bg-gray-800 rounded-xl shadow-2xl border border-gray-200 dark:border-gray-700 py-2 z-50"
        x-cloak>

        <div class="px-4 py-2 border-b border-gray-100 dark:border-gray-700">
            <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Quick Actions</h3>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Frequently used actions</p>
        </div>

        <div class="py-2">
            <template x-for="action in actions" :key="action.label">
                <a :href="action.url"
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

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('quickActions', () => ({
            actionsOpen: false,
            actions: [{
                    icon: 'fa-plus',
                    label: 'New Loan',
                    url: '{{ route('management.dashboard') }}',
                    color: 'text-green-600'
                },
                {
                    icon: 'fa-user-plus',
                    label: 'Add Customer',
                    url: '{{ route('management.dashboard') }}',
                    color: 'text-blue-600'
                },
                {
                    icon: 'fa-file-invoice',
                    label: 'Create Report',
                    url: '{{ route('management.dashboard') }}',
                    color: 'text-purple-600'
                },
                {
                    icon: 'fa-chart-line',
                    label: 'Analytics',
                    url: '{{ route('management.dashboard') }}',
                    color: 'text-orange-600'
                }
            ]
        }));
    });
</script>
