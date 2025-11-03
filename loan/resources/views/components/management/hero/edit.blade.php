@extends('layouts.admin.main')

@section('content')
    <div class="max-w-8xl mx-auto p-6 rounded-lg bg-white">
        <h1 class="text-3xl font-bold mb-8">Edit Hero Section</h1>

        {{-- @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-6">{{ session('success') }}</div>
        @endif --}}

        <form action="{{ route('management.hero.update', $hero) }}" method="POST" enctype="multipart/form-data"
            class="space-y-8">
            @csrf
            @method('PUT')

            <!-- Brand -->
            <div class="border border-gray-200 p-6 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block font-medium mb-2">Brand Name</label>
                        <input type="text" name="brand_name" value="{{ old('brand_name', $hero->brand_name) }}"
                            class="w-full border rounded-lg px-4 py-2" required>
                    </div>
                    <div>
                        <label class="block font-medium mb-2">Brand Tagline</label>
                        <input type="text" name="brand_tagline" value="{{ old('brand_tagline', $hero->brand_tagline) }}"
                            class="w-full border rounded-lg px-4 py-2" required>
                    </div>
                </div>
            </div>

            <!-- Heading -->
            <div class="border border-gray-200 p-6 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block font-medium mb-2">Main Heading</label>
                        <input type="text" name="heading" value="{{ old('heading', $hero->heading) }}"
                            class="w-full border rounded-lg px-4 py-2" required>
                    </div>
                    <div>
                        <label class="block font-medium mb-2">Highlighted Text</label>
                        <input type="text" name="highlighted_text"
                            value="{{ old('highlighted_text', $hero->highlighted_text) }}"
                            class="w-full border rounded-lg px-4 py-2" required>
                    </div>
                </div>


                <div>
                    <label class="block font-medium mb-2">Description</label>
                    <textarea name="description" rows="4" class="w-full border rounded-lg px-4 py-2" required>{{ old('description', $hero->description) }}</textarea>
                </div>
            </div>

            <!-- CTA -->
            <div class="border border-gray-200 p-6 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors duration-200">

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block font-medium mb-2">CTA Button Text</label>
                        <input type="text" name="cta_text" value="{{ old('cta_text', $hero->cta_text) }}"
                            class="w-full border rounded-lg px-4 py-2" required>
                    </div>
                    <div>
                        <label class="block font-medium mb-2">CTA Link</label>
                        <input type="text" name="cta_link" value="{{ old('cta_link', $hero->cta_link) }}"
                            class="w-full border rounded-lg px-4 py-2" required>
                    </div>
                </div>
            </div>

            <!-- Phone -->
            <div class="border border-gray-200 p-6 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors duration-200">

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block font-medium mb-2">Phone Number</label>
                        <input type="text" name="phone_number" value="{{ old('phone_number', $hero->phone_number) }}"
                            class="w-full border rounded-lg px-4 py-2" required>
                    </div>
                    <div>
                        <label class="block font-medium mb-2">Phone Label</label>
                        <input type="text" name="phone_label" value="{{ old('phone_label', $hero->phone_label) }}"
                            class="w-full border rounded-lg px-4 py-2" required>
                    </div>
                </div>
            </div>

            <!-- Trust Stats -->
            <div class="border border-gray-200 p-6 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors duration-200">

                <div class="space-y-4">
                    <h3 class="text-xl font-semibold">Trust Indicators</h3>
                    <div class="grid md:grid-cols-4 gap-4">
                        @for ($i = 1; $i <= 4; $i++)
                            <div>
                                <input type="text" name="stat_{{ $i }}_value" placeholder="Value"
                                    value="{{ old("stat_{$i}_value", $hero["stat_{$i}_value"]) }}"
                                    class="w-full border rounded-lg px-3 py-2 mb-2" required>
                                <input type="text" name="stat_{{ $i }}_label" placeholder="Label"
                                    value="{{ old("stat_{$i}_label", $hero["stat_{$i}_label"]) }}"
                                    class="w-full border rounded-lg px-3 py-2" required>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>

            <!-- Image Card -->
            <div class="border border-gray-200 p-6 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors duration-200">

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block font-medium mb-2">Card Title</label>
                        <input type="text" name="card_title" value="{{ old('card_title', $hero->card_title) }}"
                            class="w-full border rounded-lg px-4 py-2" required>
                    </div>
                    <div>
                        <label class="block font-medium mb-2">Card Image</label>
                        <input type="file" name="hero_image" accept="image/*" class="w-full">
                        @if ($hero->hero_image)
                            <img src="{{ asset('storage/' . $hero->hero_image) }}" alt="Current"
                                class="mt-2 h-32 rounded">
                        @endif
                    </div>
                </div>

                <div>
                    <label class="block font-medium mb-2">Card Description</label>
                    <textarea name="card_description" rows="3" class="w-full border rounded-lg px-4 py-2">{{ old('card_description', $hero->card_description) }}</textarea>
                </div>
            </div>

            <!-- Floating Badges -->
            <div class="border border-gray-200 p-6 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors duration-200">

                <div class="space-y-6">
                    <h3 class="text-xl font-semibold">Floating Badges</h3>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="border p-4 rounded-lg">
                            <h4 class="font-medium mb-3">Badge 1</h4>
                            <input type="text" name="badge_1_icon" placeholder="FontAwesome class (e.g. fa-rocket)"
                                value="{{ old('badge_1_icon', $hero->badge_1_icon) }}"
                                class="w-full border rounded px-3 py-2 mb-2">
                            <input type="text" name="badge_1_title" placeholder="Title"
                                value="{{ old('badge_1_title', $hero->badge_1_title) }}"
                                class="w-full border rounded px-3 py-2 mb-2">
                            <input type="text" name="badge_1_subtitle" placeholder="Subtitle"
                                value="{{ old('badge_1_subtitle', $hero->badge_1_subtitle) }}"
                                class="w-full border rounded px-3 py-2">
                        </div>

                        <div class="border p-4 rounded-lg">
                            <h4 class="font-medium mb-3">Badge 2</h4>
                            <input type="text" name="badge_2_icon" placeholder="FontAwesome class"
                                value="{{ old('badge_2_icon', $hero->badge_2_icon) }}"
                                class="w-full border rounded px-3 py-2 mb-2">
                            <input type="text" name="badge_2_title" placeholder="Title"
                                value="{{ old('badge_2_title', $hero->badge_2_title) }}"
                                class="w-full border rounded px-3 py-2 mb-2">
                            <input type="text" name="badge_2_subtitle" placeholder="Subtitle"
                                value="{{ old('badge_2_subtitle', $hero->badge_2_subtitle) }}"
                                class="w-full border rounded px-3 py-2">
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit"
                class="bg-primary-primary text-white px-8 py-3 rounded-lg font-bold hover:bg-primary-primary/90 transition">
                Save Changes
            </button>
        </form>
    </div>
@endsection
