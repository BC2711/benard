{{-- resources/views/components/select.blade.php --}}
@props(['name', 'label' => null, 'options' => [], 'required' => false, 'value' => ''])

<div {{ $attributes->merge(['class' => 'space-y-2']) }}>
    @if ($label)
        <label for="{{ $name }}" class="block text-sm font-semibold text-primary-700 mb-2">
            {{ $label }}
            @if ($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    <select id="{{ $name }}" name="{{ $name }}" {{ $required ? 'required' : '' }}
        {{ $attributes->class([
            'w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-accent-500 transition-colors',
            'form-input' => true,
        ]) }}>
        @foreach ($options as $val => $text)
            <option value="{{ $val }}" {{ old($name, $value) == $val ? 'selected' : '' }}>
                {{ $text }}
            </option>
        @endforeach
    </select>

    @error($name)
        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>
