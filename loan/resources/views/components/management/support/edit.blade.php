@extends('layouts.admin')

@section('content')
    <div class="max-w-7xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-8">Edit Support Section</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-6">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.support.update', $section) }}" method="POST" class="space-y-8">
            @csrf @method('PUT')

            <!-- Header -->
            <x-input name="heading" label="Main Heading" :value="old('heading', $section->heading)" />
            <x-textarea name="description" label="Description" rows="3" :value="old('description', $section->description)" />

            <!-- 3-Step Process -->
            <div class="border p-6 rounded-lg bg-gray-50 space-y-4">
                <h3 class="text-xl font-semibold">3-Step Process</h3>
                @for ($i = 0; $i < 3; $i++)
                    <div class="grid md:grid-cols-2 gap-4">
                        <x-input name="step_title_{{ $i }}" label="Step {{ $i + 1 }} Title"
                            :value="old('step_title_' . $i, $section->steps[$i]['title'] ?? '')" />
                        <x-input name="step_desc_{{ $i }}" label="Description" :value="old('step_desc_' . $i, $section->steps[$i]['desc'] ?? '')" />
                    </div>
                @endfor
            </div>

            <!-- Contact Info -->
            <div class="border p-6 rounded-lg bg-gray-50 space-y-4">
                <h3 class="text-xl font-semibold">Contact Information</h3>
                <x-input name="email" label="Email" type="email" :value="old('email', $section->email)" />
                <x-input name="phone" label="Phone" :value="old('phone', $section->phone)" />
                <x-input name="address_line1" label="Address Line 1" :value="old('address_line1', $section->address_line1)" />
                <x-input name="address_line2" label="Address Line 2" :value="old('address_line2', $section->address_line2)" />
                <x-input name="hours_line1" label="Hours Line 1" :value="old('hours_line1', $section->hours_line1)" />
                <x-input name="hours_line2" label="Hours Line 2" :value="old('hours_line2', $section->hours_line2)" />
            </div>

            <!-- Social Links -->
            <div class="border p-6 rounded-lg bg-gray-50 space-y-4">
                <h3 class="text-xl font-semibold">Social Links</h3>
                <x-input name="facebook" label="Facebook" type="url" :value="old('facebook', $section->facebook)" />
                <x-input name="twitter" label="Twitter" type="url" :value="old('twitter', $section->twitter)" />
                <x-input name="linkedin" label="LinkedIn" type="url" :value="old('linkedin', $section->linkedin)" />
                <x-input name="instagram" label="Instagram" type="url" :value="old('instagram', $section->instagram)" />
            </div>

            <!-- Form Settings -->
            <div class="border p-6 rounded-lg bg-gray-50 space-y-4">
                <h3 class="text-xl font-semibold">Form Settings</h3>
                <x-input name="form_heading" label="Form Heading" :value="old('form_heading', $section->form_heading)" />
                <x-input name="form_subheading" label="Subheading" :value="old('form_subheading', $section->form_subheading)" />
            </div>

            <!-- Trust Indicators -->
            <div class="border p-6 rounded-lg bg-gray-50 space-y-4">
                <h3 class="text-xl font-semibold">Trust Indicators (3)</h3>
                @for ($i = 0; $i < 3; $i++)
                    <div class="grid md:grid-cols-3 gap-4">
                        <x-input name="trust_icon_{{ $i }}" label="Icon" :value="old('trust_icon_' . $i, $section->trust_indicators[$i]['icon'] ?? '')" />
                        <x-input name="trust_title_{{ $i }}" label="Title" :value="old('trust_title_' . $i, $section->trust_indicators[$i]['title'] ?? '')" />
                        <x-input name="trust_desc_{{ $i }}" label="Description" :value="old('trust_desc_' . $i, $section->trust_indicators[$i]['desc'] ?? '')" />
                    </div>
                @endfor
            </div>

            <button type="submit" class="bg-primary text-white px-8 py-3 rounded-lg font-bold">Save Changes</button>
        </form>
    </div>
@endsection
