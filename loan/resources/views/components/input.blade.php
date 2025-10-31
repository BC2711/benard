{{-- resources/views/components/input.blade.php --}}
@props(['name', 'label' => null, 'type' => 'text', 'required' => false, 'value' => '', 'placeholder' => ''])

<div {{ $attributes->merge(['class' => 'space-y-2']) }}>
    @if ($label)
        <label for="{{ $name }}" class="block text-sm font-semibold text-primary-700 mb-2">
            {{ $label }}
            @if ($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    <input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}" {{ $required ? 'required' : '' }}
        {{ $attributes->class([
            'w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-accent-500 transition-colors',
            'form-input' => true,
        ]) }} />

    @error($name)
        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>
