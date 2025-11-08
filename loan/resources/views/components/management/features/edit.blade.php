@extends('layouts.admin.main')
@section('title', 'Features Management')
@section('breadcrumbs')
    <nav class="flex items-center space-x-2">
        <a href="{{ route('management.dashboard.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Website Management</a>
        <span class="text-gray-400">/</span>
        <span class="text-sm text-gray-500">Features</span>
    </nav>
@endsection
@section('page-icon')
    <i class="fas fa-users fa-lg text-gray-700"></i>
@endsection
@section('page-title')
    <h1 class="text-2xl font-bold text-gray-900">Features</h1>
@endsection
@section('content')
    <div class="max-w-8xl mx-auto p-6 rounded-lg bg-white">
        <h1 class="text-3xl font-bold mb-8">Edit Features Section</h1>
        <form action="{{ route('management.features.update', $feature) }}" method="POST" class="space-y-8">
            @csrf @method('PUT')

            {{-- Header Section --}}
            <div class="border-b pb-6">
                <h2 class="text-2xl font-semibold mb-4 text-gray-800">Header Section</h2>
                <div
                    class="border border-gray-200 p-6 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                    <div class="grid md:grid-cols-2 gap-6">
                        <x-input name="badge_text" label="Badge Text" :value="old('badge_text', $feature->badge_text)" placeholder="e.g., Why Choose Us"
                            required />
                        <x-input name="badge_icon" label="Badge Icon (FontAwesome class)" :value="old('badge_icon', $feature->badge_icon)"
                            placeholder="e.g., fa-star" required />
                    </div>

                    <div class="grid md:grid-cols-2 gap-6 mt-4">
                        <x-input name="heading" label="Main Heading" :value="old('heading', $feature->heading)"
                            placeholder="e.g., Why Marketeers Choose Londa Loans" required />
                        <x-input name="highlighted_text" label="Highlighted Text" :value="old('highlighted_text', $feature->highlighted_text)"
                            placeholder="e.g., Londa Loans" required />
                    </div>

                    <x-textarea name="description" label="Description" rows="3" :value="old('description', $feature->description)"
                        placeholder="Describe why customers should choose your services..." required />
                </div>
            </div>


            {{-- Trust Stats Section --}}
            <div class="border-b pb-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-semibold text-gray-800">Trust Indicators</h2>
                    <span class="text-sm text-gray-500 bg-gray-100 px-3 py-1 rounded-full">4 statistics required</span>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                    {{-- Stat 1 --}}
                    <div
                        class="border border-gray-200 p-4 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                        <div class="flex items-center mb-2">
                            <div class="w-6 h-6 bg-primary-100 rounded-full flex items-center justify-center mr-2">
                                <span class="text-primary-700 font-semibold text-xs">1</span>
                            </div>
                            <h4 class="font-semibold text-gray-700">Campaigns Funded</h4>
                        </div>
                        <x-input name="stat_1_value" label="Value" :value="old('stat_1_value', $feature->stat_1_value)" placeholder="e.g., 500+" required />
                        <x-input name="stat_1_label" label="Label" :value="old('stat_1_label', $feature->stat_1_label)"
                            placeholder="e.g., Marketing Campaigns Funded" required class="mt-2" />
                    </div>

                    {{-- Stat 2 --}}
                    <div
                        class="border border-gray-200 p-4 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                        <div class="flex items-center mb-2">
                            <div class="w-6 h-6 bg-primary-100 rounded-full flex items-center justify-center mr-2">
                                <span class="text-primary-700 font-semibold text-xs">2</span>
                            </div>
                            <h4 class="font-semibold text-gray-700">Approval Rate</h4>
                        </div>
                        <x-input name="stat_2_value" label="Value" :value="old('stat_2_value', $feature->stat_2_value)" placeholder="e.g., 98%" required />
                        <x-input name="stat_2_label" label="Label" :value="old('stat_2_label', $feature->stat_2_label)" placeholder="e.g., Approval Rate"
                            required class="mt-2" />
                    </div>

                    {{-- Stat 3 --}}
                    <div
                        class="border border-gray-200 p-4 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                        <div class="flex items-center mb-2">
                            <div class="w-6 h-6 bg-primary-100 rounded-full flex items-center justify-center mr-2">
                                <span class="text-primary-700 font-semibold text-xs">3</span>
                            </div>
                            <h4 class="font-semibold text-gray-700">Processing Time</h4>
                        </div>
                        <x-input name="stat_3_value" label="Value" :value="old('stat_3_value', $feature->stat_3_value)" placeholder="e.g., 24h" required />
                        <x-input name="stat_3_label" label="Label" :value="old('stat_3_label', $feature->stat_3_label)"
                            placeholder="e.g., Average Processing Time" required class="mt-2" />
                    </div>

                    {{-- Stat 4 --}}
                    <div
                        class="border border-gray-200 p-4 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                        <div class="flex items-center mb-2">
                            <div class="w-6 h-6 bg-primary-100 rounded-full flex items-center justify-center mr-2">
                                <span class="text-primary-700 font-semibold text-xs">4</span>
                            </div>
                            <h4 class="font-semibold text-gray-700">Loans Disbursed</h4>
                        </div>
                        <x-input name="stat_4_value" label="Value" :value="old('stat_4_value', $feature->stat_4_value)" placeholder="e.g., $10M+" required />
                        <x-input name="stat_4_label" label="Label" :value="old('stat_4_label', $feature->stat_4_label)" placeholder="e.g., Loans Disbursed"
                            required class="mt-2" />
                    </div>
                </div>
            </div>


            {{-- Features Section --}}
            <div class="border-b pb-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-semibold text-gray-800">Feature Cards</h2>
                    <span class="text-sm text-gray-500 bg-gray-100 px-3 py-1 rounded-full">6 features required</span>
                </div>

                <div class="space-y-6">
                    <div class="grid md:grid-cols-1 lg:grid-cols-3 gap-6">
                        @foreach ($feature->features as $idx => $f)
                            @php $i = $idx + 1; @endphp
                            <div
                                class="border border-gray-200 p-6 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                                <div class="flex items-center mb-4">
                                    <div class="w-8 h-8 bg-primary-100 rounded-full flex items-center justify-center mr-3">
                                        <span class="text-primary-700 font-semibold text-sm">{{ $i }}</span>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-800">Feature #{{ $i }}</h3>
                                </div>

                                <div class="grid md:grid-cols-1 gap-4">
                                    <x-input name="icon[]" label="Icon" :value="old('icon', $f['icon'])" placeholder="" required />
                                    <x-input name="title[]" label="Title" :value="old('title', $f['title'])" placeholder="" required />
                                    <x-textarea name="desc[]" label="Description" rows="3" :value="old('desc', $f['desc'])"
                                        placeholder="" required />
                                    <x-input type="text" name="learn_more[]" label="" :value="old('learn_more', $f['learn_more'])" placeholder=""
                                        required />
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- CTA Section --}}
            <div class="pb-6">
                <h2 class="text-2xl font-semibold mb-4 text-gray-800">Call to Action Section</h2>
                <div
                    class="border border-gray-200 p-6 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                    <div class="space-y-4">
                        <x-input name="cta_heading" label="Heading" :value="old('cta_heading', $feature->cta_heading)"
                            placeholder="e.g., Ready to fund your next marketing success?" required />
                        <x-textarea name="cta_description" label="Description" rows="3" :value="old('cta_description', $feature->cta_description)"
                            placeholder="Encourage users to take the next step..." required />

                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="space-y-4 p-4 bg-blue-50 rounded-lg">
                                <h4 class="font-semibold text-blue-800">Primary Button</h4>
                                <x-input name="cta_primary_text" label="Button Text" :value="old('cta_primary_text', $feature->cta_primary_text)"
                                    placeholder="e.g., Apply for Loan" required />
                                <x-input name="cta_primary_link" label="Link" type="text" :value="old('cta_primary_link', $feature->cta_primary_link)"
                                    placeholder="e.g., #apply or https://example.com/apply" required />
                            </div>
                            <div class="space-y-4 p-4 bg-green-50 rounded-lg">
                                <h4 class="font-semibold text-green-800">Secondary Button</h4>
                                <x-input name="cta_secondary_text" label="Button Text" :value="old('cta_secondary_text', $feature->cta_secondary_text)"
                                    placeholder="e.g., Calculate Payments" required />
                                <x-input name="cta_secondary_link" label="Link" type="text" :value="old('cta_secondary_link', $feature->cta_secondary_link)"
                                    placeholder="e.g., #calculator or https://example.com/calculator" required />
                            </div>
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
