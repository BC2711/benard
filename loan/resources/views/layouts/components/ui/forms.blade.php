{{-- Form Group --}}
@props([
    'label' => null,
    'name' => null,
    'error' => null,
    'help' => null,
    'required' => false,
    'inline' => false,
])

@php
    $groupClasses = $inline ? 'flex items-center space-x-4' : 'space-y-2';
    $labelClasses = 'block text-sm font-medium text-gray-700 dark:text-gray-300' . ($required ? ' required' : '');
@endphp

<div {{ $attributes->merge(['class' => 'form-group ' . $groupClasses]) }}>
    @if ($label)
        <label for="{{ $name }}" class="{{ $labelClasses }}">
            {{ $label }}
            @if ($required)
                <span class="text-red-500 ml-1">*</span>
            @endif
        </label>
    @endif

    <div class="{{ $inline ? 'flex-1' : '' }}">
        {{ $slot }}

        @if ($help)
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ $help }}</p>
        @endif

        @if ($error)
            <p class="mt-1 text-sm text-red-600 dark:text-red-400 flex items-center gap-2">
                <i class="fas fa-exclamation-circle"></i>
                {{ $error }}
            </p>
        @endif
    </div>
</div>

{{-- Text Input --}}
@props([
    'type' => 'text',
    'name' => null,
    'value' => null,
    'placeholder' => null,
    'icon' => null,
    'size' => 'md',
    'error' => null,
])

@php
    $sizes = [
        'sm' => 'px-3 py-2 text-sm',
        'md' => 'px-4 py-2.5 text-sm',
        'lg' => 'px-4 py-3 text-base',
    ];

    $baseClasses =
        'w-full border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-londa-orange focus:border-londa-orange dark:focus:ring-londa-400 dark:focus:border-londa-400 transition-all duration-200';
    $classes = $baseClasses . ' ' . $sizes[$size];

    if ($icon) {
        $classes .= ' pl-10';
    }

    if ($error) {
        $classes .= ' border-red-300 dark:border-red-700 bg-red-50 dark:bg-red-900/20';
    }
@endphp

<div class="relative">
    @if ($icon)
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <i class="fas fa-{{ $icon }} text-gray-400 {{ $error ? 'text-red-500' : '' }}"></i>
        </div>
    @endif

    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
        value="{{ old($name, $value) }}" placeholder="{{ $placeholder }}"
        {{ $attributes->merge(['class' => $classes]) }}
        @if ($error) aria-invalid="true" aria-describedby="{{ $name }}-error" @endif>
</div>

{{-- Textarea --}}
@props([
    'name' => null,
    'value' => null,
    'placeholder' => null,
    'rows' => 4,
    'resize' => true,
])

@php
    $classes =
        'w-full border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-londa-orange focus:border-londa-orange dark:focus:ring-londa-400 dark:focus:border-londa-400 transition-all duration-200 px-4 py-2.5';

    if (!$resize) {
        $classes .= ' resize-none';
    }
@endphp

<textarea name="{{ $name }}" id="{{ $name }}" rows="{{ $rows }}"
    placeholder="{{ $placeholder }}" {{ $attributes->merge(['class' => $classes]) }}>{{ old($name, $value) }}</textarea>

{{-- Select --}}
@props([
    'name' => null,
    'options' => [],
    'selected' => null,
    'placeholder' => 'Select an option',
])

@php
    $classes =
        'w-full border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-londa-orange focus:border-londa-orange dark:focus:ring-londa-400 dark:focus:border-londa-400 transition-all duration-200 px-4 py-2.5 pr-10 appearance-none bg-no-repeat bg-right';
    $bgImage =
        "url(\"data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e\")";
@endphp

<div class="relative">
    <select name="{{ $name }}" id="{{ $name }}" {{ $attributes->merge(['class' => $classes]) }}
        style="background-image: {{ $bgImage }}; background-position: right 0.5rem center; background-size: 1.5em 1.5em;">
        @if ($placeholder)
            <option value="">{{ $placeholder }}</option>
        @endif

        @foreach ($options as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>
                {{ $label }}
            </option>
        @endforeach
    </select>
</div>

{{-- Checkbox --}}
@props([
    'name' => null,
    'label' => null,
    'checked' => false,
    'value' => 1,
])

@php
    $classes =
        'w-4 h-4 text-londa-orange bg-gray-100 border-gray-300 rounded focus:ring-londa-orange dark:focus:ring-londa-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600';
@endphp

<label class="flex items-center space-x-3 cursor-pointer">
    <input type="checkbox" name="{{ $name }}" value="{{ $value }}" {{ $checked ? 'checked' : '' }}
        {{ $attributes->merge(['class' => $classes]) }}>
    @if ($label)
        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $label }}</span>
    @endif
</label>

{{-- Radio Button --}}
@props([
    'name' => null,
    'label' => null,
    'value' => null,
    'checked' => false,
])

<label class="flex items-center space-x-3 cursor-pointer">
    <input type="radio" name="{{ $name }}" value="{{ $value }}" {{ $checked ? 'checked' : '' }}
        {{ $attributes->merge(['class' => 'w-4 h-4 text-londa-orange bg-gray-100 border-gray-300 focus:ring-londa-orange dark:focus:ring-londa-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600']) }}>
    @if ($label)
        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $label }}</span>
    @endif
</label>

{{-- File Input --}}
@props([
    'name' => null,
    'accept' => null,
    'multiple' => false,
])

@php
    $classes =
        'w-full border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white file:mr-4 file:py-2 file:px-4 file:rounded-l-md file:border-0 file:text-sm file:font-semibold file:bg-londa-orange file:text-white hover:file:bg-orange-600 transition-all duration-200';
@endphp

<input type="file" name="{{ $name }}" @if ($accept) accept="{{ $accept }}" @endif
    @if ($multiple) multiple @endif {{ $attributes->merge(['class' => $classes]) }}>

{{-- Search Input --}}
@props([
    'name' => 'search',
    'placeholder' => 'Search...',
    'value' => null,
])

<div class="relative">
    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
        <i class="fas fa-search text-gray-400"></i>
    </div>
    <input type="search" name="{{ $name }}" value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        {{ $attributes->merge(['class' => 'w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-londa-orange focus:border-londa-orange transition-all duration-200']) }}>
</div>

{{-- Form Actions --}}
@props([
    'align' => 'right',
])

@php
    $alignment = [
        'left' => 'justify-start',
        'center' => 'justify-center',
        'right' => 'justify-end',
        'between' => 'justify-between',
    ];
@endphp

<div
    {{ $attributes->merge(['class' => 'flex items-center gap-3 mt-6 pt-6 border-t border-gray-200 dark:border-gray-700 ' . $alignment[$align]]) }}>
    {{ $slot }}
</div>

{{-- Usage Examples (commented out for reference) --}}
{{--
<x-ui.form-group label="Email Address" name="email" required error="{{ $errors->first('email') }}">
    <x-ui.form-input type="email" name="email" placeholder="Enter your email" icon="envelope" />
</x-ui.form-group>

<x-ui.form-group label="Description" name="description">
    <x-ui.form-textarea name="description" placeholder="Enter a description" rows="3" />
</x-ui.form-group>

<x-ui.form-group label="Category" name="category">
    <x-ui.form-select name="category" :options="['1' => 'Option 1', '2' => 'Option 2']" selected="1" />
</x-ui.form-group>

<x-ui.form-actions>
    <x-ui.button variant="outline-gray">Cancel</x-ui.button>
    <x-ui.button variant="primary">Save Changes</x-ui.button>
</x-ui.form-actions>
--}}
