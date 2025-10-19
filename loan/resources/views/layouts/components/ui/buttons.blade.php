{{-- Primary Button --}}
@props([
    'type' => 'button',
    'variant' => 'primary',
    'size' => 'md',
    'disabled' => false,
    'loading' => false,
    'icon' => null,
    'iconPosition' => 'left',
])

@php
    $baseClasses =
        'inline-flex items-center justify-center font-semibold rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed';

    $variants = [
        'primary' =>
            'bg-londa-orange hover:bg-orange-600 text-white focus:ring-londa-orange shadow-lg hover:shadow-xl transform hover:scale-105',
        'secondary' => 'bg-gray-600 hover:bg-gray-700 text-white focus:ring-gray-500',
        'success' => 'bg-green-600 hover:bg-green-700 text-white focus:ring-green-500',
        'danger' => 'bg-red-600 hover:bg-red-700 text-white focus:ring-red-500',
        'warning' => 'bg-yellow-600 hover:bg-yellow-700 text-white focus:ring-yellow-500',
        'info' => 'bg-blue-600 hover:bg-blue-700 text-white focus:ring-blue-500',
        'outline-primary' =>
            'border-2 border-londa-orange text-londa-orange hover:bg-londa-orange hover:text-white focus:ring-londa-orange',
        'outline-gray' =>
            'border-2 border-gray-300 text-gray-700 hover:bg-gray-50 focus:ring-gray-500 dark:border-gray-600 dark:text-gray-300',
        'ghost' => 'text-gray-600 hover:bg-gray-100 focus:ring-gray-500 dark:text-gray-400 dark:hover:bg-gray-800',
        'link' => 'text-londa-orange hover:text-orange-600 underline focus:ring-londa-orange',
    ];

    $sizes = [
        'xs' => 'px-2.5 py-1.5 text-xs',
        'sm' => 'px-3 py-2 text-sm',
        'md' => 'px-4 py-2.5 text-sm',
        'lg' => 'px-5 py-3 text-base',
        'xl' => 'px-6 py-3.5 text-lg',
    ];

    $classes = $baseClasses . ' ' . $variants[$variant] . ' ' . $sizes[$size];

    if ($loading) {
        $classes .= ' opacity-70 cursor-wait';
    }
@endphp

<button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}
    @if ($disabled) disabled @endif @if ($loading) aria-busy="true" @endif>
    @if ($loading)
        <i class="fas fa-spinner fa-spin mr-2"></i>
    @elseif($icon && $iconPosition === 'left')
        <i class="fas fa-{{ $icon }} mr-2"></i>
    @endif

    <span>{{ $slot }}</span>

    @if ($icon && $iconPosition === 'right' && !$loading)
        <i class="fas fa-{{ $icon }} ml-2"></i>
    @endif
</button>

{{-- Icon Button --}}
@props(['icon', 'size' => 'md', 'variant' => 'ghost'])

@php
    $iconSizes = [
        'xs' => 'w-6 h-6 text-xs',
        'sm' => 'w-8 h-8 text-sm',
        'md' => 'w-10 h-10 text-base',
        'lg' => 'w-12 h-12 text-lg',
        'xl' => 'w-14 h-14 text-xl',
    ];

    $iconClasses =
        'inline-flex items-center justify-center rounded-full transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2';
    $iconClasses .= ' ' . $variants[$variant] . ' ' . $iconSizes[$size];
@endphp

<button {{ $attributes->merge(['class' => $iconClasses]) }} aria-label="{{ $attributes->get('aria-label', 'Button') }}">
    <i class="fas fa-{{ $icon }}"></i>
</button>

{{-- Button Group --}}
@props([
    'vertical' => false,
])

@php
    $groupClasses = $vertical
        ? 'inline-flex flex-col space-y-0 rounded-lg overflow-hidden divide-y divide-gray-200 dark:divide-gray-700'
        : 'inline-flex rounded-lg overflow-hidden divide-x divide-gray-200 dark:divide-gray-700 shadow-sm';
@endphp

<div {{ $attributes->merge(['class' => $groupClasses]) }}>
    {{ $slot }}
</div>

{{-- Usage Examples (commented out for reference) --}}
{{--
<x-ui.button variant="primary" size="lg" icon="plus">
    Create New
</x-ui.button>

<x-ui.button icon="cog" variant="ghost" size="md" />

<x-ui.button-group>
    <x-ui.button variant="outline-gray">Edit</x-ui.button>
    <x-ui.button variant="outline-gray">Delete</x-ui.button>
</x-ui.button-group>
--}}
