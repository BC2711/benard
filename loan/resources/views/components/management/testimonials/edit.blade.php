@extends('layouts.admin')

@section('content')
    <div class="max-w-7xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-8">Edit Testimonials Section</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-6">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.testimonials.update', $section) }}" method="POST" class="space-y-8">
            @csrf @method('PUT')

            <!-- Header -->
            <x-input name="heading" label="Main Heading" :value="old('heading', $section->heading)" />
            <x-textarea name="description" label="Description" rows="3" :value="old('description', $section->description)" />

            <!-- Video Highlight -->
            <div class="border p-6 rounded-lg bg-gray-50 space-y-4">
                <h3 class="text-xl font-semibold">Video Testimonial</h3>
                <x-input name="video_title" label="Title" :value="old('video_title', $section->video_title)" />
                <x-textarea name="video_description" label="Description" rows="2" :value="old('video_description', $section->video_description)" />
                <x-input name="video_image" label="Background Image URL" :value="old('video_image', $section->video_image)" />
                <x-input name="video_url" label="YouTube/Vimeo URL (optional)" :value="old('video_url', $section->video_url)" />
            </div>

            <!-- Stats -->
            <div class="border p-6 rounded-lg bg-gray-50 space-y-4">
                <h3 class="text-xl font-semibold">Trust Stats (4)</h3>
                @for ($i = 0; $i < 4; $i++)
                    <div class="grid md:grid-cols-2 gap-4">
                        <x-input name="stat_value_{{ $i }}" label="Value" :value="old('stat_value_' . $i, $section->stats[$i]['value'] ?? '')" />
                        <x-input name="stat_label_{{ $i }}" label="Label" :value="old('stat_label_' . $i, $section->stats[$i]['label'] ?? '')" />
                    </div>
                @endfor
            </div>

            <!-- Testimonials -->
            <div class="space-y-6">
                <h3 class="text-xl font-semibold">Testimonials</h3>
                <div id="testimonials-container">
                    @foreach ($section->testimonials as $i => $t)
                        <div class="border p-6 rounded-lg bg-gray-50 mb-4 testimonial-item">
                            <div class="grid md:grid-cols-2 gap-4">
                                <x-input name="testimonial_name_{{ $i }}" label="Name" :value="old('testimonial_name_' . $i, $t['name'])" />
                                <x-input name="testimonial_role_{{ $i }}" label="Role/Company"
                                    :value="old('testimonial_role_' . $i, $t['role'])" />
                                <x-input name="testimonial_image_{{ $i }}" label="Image URL"
                                    :value="old('testimonial_image_' . $i, $t['image'])" />
                                <x-select name="testimonial_rating_{{ $i }}" label="Rating" :options="[1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5]"
                                    :selected="old('testimonial_rating_' . $i, $t['rating'])" />
                            </div>
                            <x-textarea name="testimonial_quote_{{ $i }}" label="Quote" rows="4"
                                :value="old('testimonial_quote_' . $i, $t['quote'])" />
                            <button type="button" class="text-red-600 text-sm mt-2 remove-testimonial">Remove
                                Testimonial</button>
                        </div>
                    @endforeach
                </div>
                <button type="button" id="add-testimonial" class="bg-primary text-white px-4 py-2 rounded">+ Add
                    Testimonial</button>
            </div>

            <!-- CTA -->
            <div class="border p-6 rounded-lg bg-gray-50 space-y-4">
                <h3 class="text-xl font-semibold">Bottom CTA</h3>
                <x-input name="cta_heading" label="Heading" :value="old('cta_heading', $section->cta_heading)" />
                <x-textarea name="cta_description" label="Description" rows="2" :value="old('cta_description', $section->cta_description)" />
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <x-input name="cta_primary_text" label="Primary Button Text" :value="old('cta_primary_text', $section->cta_primary_text)" />
                        <x-input name="cta_primary_link" label="Primary Link" type="url" :value="old('cta_primary_link', $section->cta_primary_link)" />
                        <x-input name="cta_primary_icon" label="Primary Icon" :value="old('cta_primary_icon', $section->cta_primary_icon)" />
                    </div>
                    <div>
                        <x-input name="cta_secondary_text" label="Secondary Button Text" :value="old('cta_secondary_text', $section->cta_secondary_text)" />
                        <x-input name="cta_secondary_link" label="Secondary Link" type="url" :value="old('cta_secondary_link', $section->cta_secondary_link)" />
                        <x-input name="cta_secondary_icon" label="Secondary Icon" :value="old('cta_secondary_icon', $section->cta_secondary_icon)" />
                    </div>
                </div>
            </div>

            <button type="submit" class="bg-primary text-white px-8 py-3 rounded-lg font-bold">Save Changes</button>
        </form>
    </div>

    <script>
        let testimonialIndex = {{ count($section->testimonials) }};

        document.getElementById('add-testimonial').addEventListener('click', function() {
            const container = document.getElementById('testimonials-container');
            const html = `
        <div class="border p-6 rounded-lg bg-gray-50 mb-4 testimonial-item">
            <div class="grid md:grid-cols-2 gap-4">
                <input type="text" name="testimonial_name_${testimonialIndex}" placeholder="Name" class="border rounded p-2">
                <input type="text" name="testimonial_role_${testimonialIndex}" placeholder="Role/Company" class="border rounded p-2">
                <input type="url" name="testimonial_image_${testimonialIndex}" placeholder="Image URL" class="border rounded p-2">
                <select name="testimonial_rating_${testimonialIndex}" class="border rounded p-2">
                    <option value="5">5 Stars</option>
                    <option value="4">4 Stars</option>
                    <option value="3">3 Stars</option>
                    <option value="2">2 Stars</option>
                    <option value="1">1 Star</option>
                </select>
            </div>
            <textarea name="testimonial_quote_${testimonialIndex}" placeholder="Quote" rows="4" class="w-full border rounded p-2 mt-2"></textarea>
            <button type="button" class="text-red-600 text-sm mt-2 remove-testimonial">Remove Testimonial</button>
        </div>`;
            container.insertAdjacentHTML('beforeend', html);
            testimonialIndex++;
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-testimonial')) {
                e.target.closest('.testimonial-item').remove();
            }
        });
    </script>
@endsection
