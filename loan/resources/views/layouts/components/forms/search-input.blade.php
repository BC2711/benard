@props([
    'placeholder' => 'Search menu...',
    'size' => 'md',
])

@php
    $sizes = [
        'sm' => 'py-2 text-xs',
        'md' => 'py-2 text-sm',
        'lg' => 'py-2.5 text-base',
    ];

    $sizeClass = $sizes[$size] ?? $sizes['md'];
@endphp

<input type="text" x-model="searchQuery"
    class="w-full pl-10 pr-4 {{ $sizeClass }} bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-londa-orange focus:border-londa-orange dark:focus:ring-londa-400 dark:focus:border-londa-400 transition-all duration-200"
    placeholder="{{ $placeholder }}" aria-label="Search menu items">
