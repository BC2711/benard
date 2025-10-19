@props([
    'items' => [],
    'separator' => 'chevron-right', // slash, chevron-right, dot
    'showHome' => true,
    'homeIcon' => 'home',
])

@php
    $separators = [
        'slash' => '/',
        'chevron-right' => '›',
        'dot' => '•',
    ];

    $separatorChar = $separators[$separator] ?? $separators['chevron-right'];
@endphp

<nav class="hidden lg:flex items-center space-x-2 text-sm" aria-label="Breadcrumb">
    @if ($showHome)
        <a href="{{ route('management.dashboard') }}"
            class="text-gray-500 dark:text-gray-400 hover:text-londa-orange dark:hover:text-londa-300 transition-colors duration-200 flex items-center"
            aria-label="Home">
            <i class="fas fa-{{ $homeIcon }} text-xs"></i>
        </a>
        <span class="text-gray-300 dark:text-gray-600" aria-hidden="true">{{ $separatorChar }}</span>
    @endif

    @foreach ($items as $index => $item)
        @if ($loop->last)
            <span class="text-gray-700 dark:text-gray-300 font-medium truncate max-w-32" aria-current="page">
                {{ $item['label'] }}
            </span>
        @else
            <a href="{{ $item['url'] ?? '#' }}"
                class="text-gray-500 dark:text-gray-400 hover:text-londa-orange dark:hover:text-londa-300 transition-colors duration-200 truncate max-w-32">
                {{ $item['label'] }}
            </a>
            <span class="text-gray-300 dark:text-gray-600" aria-hidden="true">{{ $separatorChar }}</span>
        @endif
    @endforeach

    @if (empty($items))
        <span class="text-gray-700 dark:text-gray-300 font-medium" x-text="currentPage"></span>
    @endif
</nav>

<script>
    // Auto-generate breadcrumb from page structure
    document.addEventListener('DOMContentLoaded', function() {
        const breadcrumb = document.querySelector('[aria-label="Breadcrumb"]');
        if (breadcrumb && !breadcrumb.querySelector('a[href]')) {
            // Auto-populate based on current page
            const pageTitle = document.querySelector('h1')?.textContent || 'Dashboard';
            const currentPageElement = breadcrumb.querySelector('[x-text="currentPage"]');
            if (currentPageElement) {
                currentPageElement.textContent = pageTitle;
            }
        }
    });
</script>
