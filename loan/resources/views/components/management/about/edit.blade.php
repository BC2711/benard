@extends('layouts.admin.main')

@section('content')
    <div class="max-w-8xl mx-auto p-6 rounded-lg bg-white">
        <h1 class="text-3xl font-bold mb-8">Edit About Section</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-6">{{ session('success') }}</div>
        @endif

        <form action="{{ route('management.about.update', $about) }}" method="POST" enctype="multipart/form-data"
            class="space-y-8">
            @csrf @method('PUT')

            {{-- Header --}}
            <div class="border border-gray-200 p-6 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                <div class="grid md:grid-cols-2 gap-6">
                    <x-input name="section_label" label="Section Badge (Why Choose…)" :value="old('section_label', $about->section_label)" />
                    <x-input name="highlighted_text" label="Highlighted Word" :value="old('highlighted_text', $about->highlighted_text)" />
                </div>

                <x-input name="heading" label="Main Heading" :value="old('heading', $about->heading)" />
                <x-textarea name="description" label="Description" rows="4" :value="old('description', $about->description)" />
            </div>

            {{-- CTA --}}
            <div class="border border-gray-200 p-6 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                <div class="grid md:grid-cols-2 gap-6">
                    <x-input name="cta_text" label="CTA Button Text" :value="old('cta_text', $about->cta_text)" />
                    <x-input name="cta_link" label="CTA Link (URL)" type="text" :value="old('cta_link', $about->cta_link)" />
                </div>
            </div>

            {{-- Stats (4) --}}
            <div class="space-y-4">
                <h3 class="text-xl font-semibold">Trust Stats</h3>
                <div class="grid md:grid-cols-4 gap-4">
                    <div
                        class="border border-gray-200 p-6 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                        <x-input name="stat_1_value" label="Stat 1 Value" placeholder="Value" :value="old('stat_1_value', $about->stat_1_value)" />
                        <x-input name="stat_1_label" placeholder="Label" label="Stat 1 Label" :value="old('stat_1_label', $about->stat_1_label)"
                            class="mt-2" />
                    </div>
                    <div
                        class="border border-gray-200 p-6 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                        <x-input name="stat_2_value" label="Stat 2 Value" placeholder="Value" :value="old('stat_2_value', $about->stat_2_value)" />
                        <x-input name="stat_2_label" placeholder="Label" label="Stat 2 Label" :value="old('stat_2_label', $about->stat_2_label)"
                            class="mt-2" />
                    </div>
                    <div
                        class="border border-gray-200 p-6 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                        <x-input name="stat_3_value" label="Stat 3 Value" placeholder="Value" :value="old('stat_3_value', $about->stat_3_value)" />
                        <x-input name="stat_3_label" placeholder="Label" label="Stat 3 Label" :value="old('stat_3_label', $about->stat_3_label)"
                            class="mt-2" />
                    </div>
                    <div
                        class="border border-gray-200 p-6 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                        <x-input name="stat_4_value" label="Stat 4 Value" placeholder="Value" :value="old('stat_4_value', $about->stat_4_value)" />
                        <x-input name="stat_4_label" placeholder="Label" label="Stat 4 Label" :value="old('stat_4_label', $about->stat_4_label)"
                            class="mt-2" />
                    </div>
                </div>
            </div>

            {{-- Features (repeatable) --}}
            <div class="space-y-6">
                <h3 class="text-xl font-semibold">Features (4)</h3>
                <div class="lg:grid-cols-4 grid md:grid-cols-2 gap-4">
                    @php
                  
                        // Decode the JSON features string
                        $features = json_decode($about->features, true) ?? [];
                        //   dd($features);
                    @endphp

                    @foreach ($features as $index => $feat)
                        <div
                            class="border border-gray-200 p-6 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                            <x-input name="icon[]" label="Icon (Font Awesome class)" placeholder="e.g., fa-bolt"
                                :value="old('icon.' . $index, $feat['icon'] ?? '')" />
                            <x-input name="title[]" placeholder="Feature Title" label="Feature Title" :value="old('title.' . $index, $feat['title'] ?? '')"
                                class="mt-2" />
                            <x-textarea name="desc[]" label="Description" rows="3" :value="old('desc.' . $index, $feat['desc'] ?? '')" />
                           
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Images (4) --}}
            <div class="space-y-6">
                <h3 class="text-xl font-semibold">Gallery Images (4)</h3>
                <div class="grid md:grid-cols-4 gap-4">
                    @foreach (['1', '2', '3', '4'] as $n)
                        <div
                            class="border border-gray-200 p-6 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                            <label class="block font-medium mb-2">Image {{ $n }}</label>
                            <input type="file" name="image_{{ $n }}" accept="image/*" class="w-full">
                            @if ($about["image_{$n}"])
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $about["image_{$n}"]) }}"
                                        class="h-32 w-full object-cover rounded">
                                    <p class="text-xs text-gray-500 mt-1">Current image</p>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Rating Card --}}
            <div class="border border-gray-200 p-6 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                <div class="grid md:grid-cols-3 gap-4">
                    <x-input name="rating_icon" label="Icon (fa-…)" :value="old('rating_icon', $about->rating_icon)" />
                    <x-input name="rating_value" label="Rating Text" :value="old('rating_value', $about->rating_value)" />
                    <x-input name="rating_subtitle" label="Subtitle" :value="old('rating_subtitle', $about->rating_subtitle)" />
                </div>
            </div>

            <button type="submit"
                class="bg-primary-primary text-white px-8 py-3 rounded-lg font-bold hover:bg-primary-primary/90">
                Save Changes
            </button>
        </form>
    </div>
@endsection
