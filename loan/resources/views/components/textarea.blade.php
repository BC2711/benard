{{-- resources/views/components/textarea.blade.php --}}
@props(['name', 'label' => null, 'rows' => 4, 'required' => false, 'value' => '', 'placeholder' => ''])

<div {{ $attributes->merge(['class' => 'space-y-2']) }}>
    @if ($label)
        <label for="{{ $name }}" class="block text-sm font-semibold text-primary-700 mb-2">
            {{ $label }}
            @if ($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    <textarea id="{{ $name }}" name="{{ $name }}" rows="{{ $rows }}" placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->class([
            'w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-accent-500 transition-colors',
            'form-input' => true,
        ]) }}>{{ old($name, $value) }}</textarea>

    @error($name)
        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>
