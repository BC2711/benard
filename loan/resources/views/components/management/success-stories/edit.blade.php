@extends('layouts.admin')

@section('content')
    <div class="max-w-7xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-8">Edit Success Stories Section</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-6">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.success-stories.update', $section) }}" method="POST" class="space-y-8">
            @csrf @method('PUT')

            <!-- Header -->
            <x-input name="heading" label="Main Heading" :value="old('heading', $section->heading)" />
            <x-textarea name="description" label="Description" rows="3" :value="old('description', $section->description)" />

            <!-- Stats -->
            <div class="border p-6 rounded-lg bg-gray-50 space-y-4">
                <h3 class="text-xl font-semibold">Statistics (4)</h3>
                @for ($i = 0; $i < 4; $i++)
                    <div class="grid md:grid-cols-2 gap-4">
                        <x-input name="stat_value_{{ $i }}" label="Value" :value="old('stat_value_' . $i, $section->stats[$i]['value'] ?? '')" />
                        <x-input name="stat_label_{{ $i }}" label="Label" :value="old('stat_label_' . $i, $section->stats[$i]['label'] ?? '')" />
                    </div>
                @endfor
            </div>

            <!-- Categories -->
            <div class="border p-6 rounded-lg bg-gray-50">
                <h3 class="text-xl font-semibold mb-4">Filter Tabs (comma-separated)</h3>
                <input type="text" name="categories" value="{{ old('categories', implode(',', $section->categories)) }}"
                    class="w-full border rounded p-2" placeholder="all, marketing, ecommerce, startup">
            </div>

            <!-- Success Stories -->
            <div class="space-y-6">
                <h3 class="text-xl font-semibold">Success Stories</h3>
                <div id="stories-container">
                    @foreach ($section->stories as $i => $story)
                        <div class="border p-6 rounded-lg bg-gray-50 mb-4 story-item">
                            <div class="grid md:grid-cols-2 gap-4">
                                <x-input name="story_title_{{ $i }}" label="Title" :value="old('story_title_' . $i, $story['title'])" />
                                <x-input name="story_amount_{{ $i }}" label="Amount (e.g. $75,000 Growth Loan)"
                                    :value="old('story_amount_' . $i, $story['amount'])" />
                                <x-select name="story_category_{{ $i }}" label="Category" :options="array_combine($section->categories, $section->categories)"
                                    :selected="old('story_category_' . $i, $story['category'])" />
                                <x-input name="story_funding_{{ $i }}" label="Funding (e.g. $75K)"
                                    :value="old('story_funding_' . $i, $story['funding'])" />
                                <x-input name="story_type_{{ $i }}" label="Type (e.g. Marketing Agency)"
                                    :value="old('story_type_' . $i, $story['type'])" />
                                <x-input name="story_result_{{ $i }}" label="Result (e.g. 150% Revenue Growth)"
                                    :value="old('story_result_' . $i, $story['result'])" />
                                <x-input name="story_time_{{ $i }}" label="Time (e.g. 6 Months)"
                                    :value="old('story_time_' . $i, $story['time'])" />
                                <x-input name="story_gradient_from_{{ $i }}"
                                    label="Gradient From (e.g. primary-700)" :value="old('story_gradient_from_' . $i, $story['gradient_from'])" />
                                <x-input name="story_gradient_to_{{ $i }}" label="Gradient To (e.g. accent-500)"
                                    :value="old('story_gradient_to_' . $i, $story['gradient_to'])" />
                            </div>
                            <x-textarea name="story_description_{{ $i }}" label="Description" rows="2"
                                :value="old('story_description_' . $i, $story['description'])" />
                            <x-input name="story_overlay_title_{{ $i }}" label="Overlay Title"
                                :value="old('story_overlay_title_' . $i, $story['overlay_title'])" />
                            <x-textarea name="story_overlay_desc_{{ $i }}" label="Overlay Description"
                                rows="2" :value="old('story_overlay_desc_' . $i, $story['overlay_desc'])" />
                            <div class="mt-2">
                                <label class="block font-medium mb-1">Tags (one per line)</label>
                                @foreach ($story['tags'] as $j => $tag)
                                    <input type="text" name="story_tags_{{ $i }}[]"
                                        value="{{ old('story_tags_' . $i . '.' . $j, $tag) }}"
                                        class="w-full border rounded p-2 mb-1">
                                @endforeach
                                <input type="text" name="story_tags_{{ $i }}[]"
                                    class="w-full border rounded p-2 mb-1" placeholder="Add tag">
                            </div>
                            <button type="button" class="text-red-600 text-sm mt-2 remove-story">Remove Story</button>
                        </div>
                    @endforeach
                </div>
                <button type="button" id="add-story" class="bg-primary text-white px-4 py-2 rounded">+ Add Story</button>
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
        let storyIndex = {{ count($section->stories) }};

        document.getElementById('add-story').addEventListener('click', function() {
            const container = document.getElementById('stories-container');
            const cats = @json($section->categories);
            const catOptions = cats.map(c =>
                `<option value="${c}">${c.charAt(0).toUpperCase() + c.slice(1)}</option>`).join('');
            const html = `
        <div class="border p-6 rounded-lg bg-gray-50 mb-4 story-item">
            <div class="grid md:grid-cols-2 gap-4">
                <input type="text" name="story_title_${storyIndex}" placeholder="Title" class="border rounded p-2">
                <input type="text" name="story_amount_${storyIndex}" placeholder="Amount" class="border rounded p-2">
                <select name="story_category_${storyIndex}" class="border rounded p-2">${catOptions}</select>
                <input type="text" name="story_funding_${storyIndex}" placeholder="Funding" class="border rounded p-2">
                <input type="text" name="story_type_${storyIndex}" placeholder="Type" class="border rounded p-2">
                <input type="text" name="story_result_${storyIndex}" placeholder="Result" class="border rounded p-2">
                <input type="text" name="story_time_${storyIndex}" placeholder="Time" class="border rounded p-2">
                <input type="text" name="story_gradient_from_${storyIndex}" placeholder="primary-700" class="border rounded p-2">
                <input type="text" name="story_gradient_to_${storyIndex}" placeholder="accent-500" class="border rounded p-2">
            </div>
            <textarea name="story_description_${storyIndex}" placeholder="Description" rows="2" class="w-full border rounded p-2 mt-2"></textarea>
            <input type="text" name="story_overlay_title_${storyIndex}" placeholder="Overlay Title" class="w-full border rounded p-2 mt-2">
            <textarea name="story_overlay_desc_${storyIndex}" placeholder="Overlay Desc" rows="2" class="w-full border rounded p-2 mt-2"></textarea>
            <div class="mt-2">
                <label class="block font-medium mb-1">Tags</label>
                <input type="text" name="story_tags_${storyIndex}[]" class="w-full border rounded p-2 mb-1" placeholder="Tag 1">
                <input type="text" name="story_tags_${storyIndex}[]" class="w-full border rounded p-2 mb-1" placeholder="Tag 2">
            </div>
            <button type="button" class="text-red-600 text-sm mt-2 remove-story">Remove Story</button>
        </div>`;
            container.insertAdjacentHTML('beforeend', html);
            storyIndex++;
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-story')) {
                e.target.closest('.story-item').remove();
            }
        });
    </script>
@endsection
