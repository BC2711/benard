@extends('layouts.admin.main')
@section('title', 'Services Management')
@section('breadcrumbs')
    <nav class="flex items-center space-x-2">
        <a href="{{ route('management.dashboard.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Website Management</a>
        <span class="text-gray-400">/</span>
        <span class="text-sm text-gray-500">Services</span>
    </nav>
@endsection
@section('page-icon')
    <i class="fas fa-users fa-lg text-gray-700"></i>
@endsection
@section('page-title')
    <h1 class="text-2xl font-bold text-gray-900">Services</h1>
@endsection
@section('content')
    <div class="max-w-8xl mx-auto p-6 rounded-lg bg-white">
        <h1 class="border-b text-3xl font-bold mb-8">Edit Services Section</h1>    

        <form action="{{ route('management.service.update', $service) }}" method="POST" class="space-y-8">
            @csrf @method('PUT')

            {{-- Header Section --}}
            <div class="border-b pb-6 ">
                <h2 class="text-2xl font-semibold mb-4 text-gray-800">Header Section</h2>
                <div
                    class="border border-gray-200 p-6 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                    <div class="grid md:grid-cols-2 gap-6">
                        <x-input name="badge_text" label="Badge Text" :value="old('badge_text', $service->badge_text)" placeholder="e.g., Our Services"
                            required />
                        <x-input name="badge_icon" label="Badge Icon (FontAwesome class)" :value="old('badge_icon', $service->badge_icon)"
                            placeholder="e.g., fa-star" required />
                    </div>
                    <div class="grid md:grid-cols-2 gap-6 mt-4">
                        <x-input name="heading" label="Main Heading" :value="old('heading', $service->heading)"
                            placeholder="e.g., Comprehensive Financial Solutions" required />
                        <x-input name="highlighted_text" label="Highlighted Word" :value="old('highlighted_text', $service->highlighted_text)"
                            placeholder="e.g., Solutions" required />
                    </div>
                    <x-textarea name="description" label="Description" rows="3" :value="old('description', $service->description)"
                        placeholder="Describe your services..." required />
                </div>

            </div>

            {{-- Services Section --}}
            <div class="border-b pb-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-semibold text-gray-800">Service Cards</h2>
                    <span class="text-sm text-gray-500 bg-gray-100 px-3 py-1 rounded-full">6 services required</span>
                </div>

                <div class="space-y-6">
                    <div class="grid md:grid-cols-3 gap-6 mt-4">
                        @foreach ($service->services as $idx => $s)
                            <div
                                class="border border-gray-200 p-6 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                                <div class="flex items-center mb-4">
                                    <div class="w-8 h-8 bg-primary-100 rounded-full flex items-center justify-center mr-3">
                                        <span class="text-primary-700 font-semibold text-sm"></span>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-800">Service</h3>
                                </div>

                                <div class="grid md:grid-cols-1 gap-4">
                                    <x-input name="icon[]" label="icon" :value="old('icon', $s['icon'])" placeholder="e.g., icon"
                                        required />
                                    <x-input name="title[]" label="Title" :value="old('title', $s['title'])" placeholder="e.g., title"
                                        required />
                                    <x-textarea name="desc[]" label="Description" rows="3" :value="old('desc', $s['desc'])"
                                        placeholder="Describe your services..." required />

                                    <x-select name="tag_color[]" label="Tag Color" :options="['primary' => 'Primary', 'secondary' => 'Secondary']" :value="old('tag_color', $s['tag_color'] ?? 'primary')"
                                        required />

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- CTA Section --}}
            <div class="border-b pb-6">
                <h2 class="text-2xl font-semibold mb-4 text-gray-800">Call to Action Section</h2>

                <div class="space-y-4">
                    <div
                        class="border border-gray-200 p-6 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                        <x-input name="cta_heading" label="Heading" :value="old('cta_heading', $service->cta_heading)"
                            placeholder="e.g., Ready to Get Started?" required />
                        <x-textarea name="cta_description" label="Description" rows="3" :value="old('cta_description', $service->cta_description)"
                            placeholder="Encourage users to take action..." required />
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="space-y-4 p-4 bg-blue-50 rounded-lg">
                            <h4 class="font-semibold text-blue-800">Primary Button</h4>
                            <x-input name="cta_primary_text" label="Button Text" :value="old('cta_primary_text', $service->cta_primary_text)"
                                placeholder="e.g., Get Started" required />
                            <x-input name="cta_primary_link" label="Link" type="text" :value="old('cta_primary_link', $service->cta_primary_link)"
                                placeholder="e.g., https://example.com/contact" required />
                            <x-input name="cta_primary_icon" label="Icon" :value="old('cta_primary_icon', $service->cta_primary_icon)"
                                placeholder="e.g., fa-arrow-right" required />
                        </div>
                        <div class="space-y-4 p-4 bg-green-50 rounded-lg">
                            <h4 class="font-semibold text-green-800">Secondary Button</h4>
                            <x-input name="cta_secondary_text" label="Button Text" :value="old('cta_secondary_text', $service->cta_secondary_text)"
                                placeholder="e.g., Learn More" required />
                            <x-input name="cta_secondary_link" label="Link" type="text" :value="old('cta_secondary_link', $service->cta_secondary_link)"
                                placeholder="e.g., https://example.com/about" required />
                            <x-input name="cta_secondary_icon" label="Icon" :value="old('cta_secondary_icon', $service->cta_secondary_icon)"
                                placeholder="e.g., fa-info-circle" required />
                        </div>
                    </div>
                </div>
            </div>

            {{-- Extra Info Section --}}
            <div class="pb-6">
                <h2 class="text-2xl font-semibold mb-4 text-gray-800">Extra Information Blocks</h2>

                <div class="space-y-4">
                    <div class="grid md:grid-cols-3 gap-4">
                        <div
                            class="border border-gray-200 p-6 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                            <x-input name="info_1_icon" label="Icon" :value="old('info_1_icon', $service->info_1_icon)" placeholder="e.g., fa-clock"
                                required />
                            <x-input name="info_1_title" label="Title" :value="old('info_1_title', $service->info_1_title)" placeholder="e.g., Fast Approval"
                                required />
                            <x-input name="info_1_subtitle" label="Subtitle" :value="old('info_1_subtitle', $service->info_1_subtitle)"
                                placeholder="e.g., 24-48 hours" required />
                        </div>

                        <div
                            class="border border-gray-200 p-6 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                            <x-input name="info_2_icon" label="Icon" :value="old('info_2_icon', $service->info_2_icon)" placeholder="e.g., fa-clock"
                                required />
                            <x-input name="info_2_title" label="Title" :value="old('info_2_title', $service->info_2_title)"
                                placeholder="e.g., Fast Approval" required />
                            <x-input name="info_2_subtitle" label="Subtitle" :value="old('info_2_subtitle', $service->info_2_subtitle)"
                                placeholder="e.g., 24-48 hours" required />
                        </div>

                        <div
                            class="border border-gray-200 p-6 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                            <x-input name="info_3_icon" label="Icon" :value="old('info_3_icon', $service->info_3_icon)" placeholder="e.g., fa-clock"
                                required />
                            <x-input name="info_3_title" label="Title" :value="old('info_3_title', $service->info_3_title)"
                                placeholder="e.g., Fast Approval" required />
                            <x-input name="info_3_subtitle" label="Subtitle" :value="old('info_3_subtitle', $service->info_3_subtitle)"
                                placeholder="e.g., 24-48 hours" required />
                        </div>
                    </div>


                </div>
            </div>

            {{-- Submit Button --}}
            <div class="flex justify-end space-x-4 pt-6 border-t">
                <a href="{{ url()->previous() }}"
                    class="bg-gray-500 text-white px-6 py-3 rounded-lg font-bold hover:bg-gray-600 transition-colors duration-200">
                    Cancel
                </a>
                <button type="submit"
                    class="bg-primary-700 text-white px-8 py-3 rounded-lg font-bold hover:bg-primary-800 transition-colors duration-200 shadow-md">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
@endsection
