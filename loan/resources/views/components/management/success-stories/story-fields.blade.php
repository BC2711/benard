{{-- resources/views/admin/success-stories/story-fields.blade.php --}}
<div class="grid md:grid-cols-2 gap-4">
    <x-input name="story_title_{{ $i }}" label="Title" :value="old('story_title_' . $i, $story['title'] ?? '')" />
    <x-input name="story_amount_{{ $i }}" label="Amount (e.g. $75,000 Growth Loan)" :value="old('story_amount_' . $i, $story['amount'] ?? '')" />

    <x-select name="story_category_{{ $i }}" label="Category" :options="array_combine($section->categories, array_map('ucfirst', $section->categories))" :selected="old('story_category_' . $i, $story['category'] ?? '')" />

    <x-input name="story_funding_{{ $i }}" label="Funding (e.g. $75K)" :value="old('story_funding_' . $i, $story['funding'] ?? '')" />
    <x-input name="story_type_{{ $i }}" label="Type" :value="old('story_type_' . $i, $story['type'] ?? '')" />
    <x-input name="story_result_{{ $i }}" label="Result" :value="old('story_result_' . $i, $story['result'] ?? '')" />
    <x-input name="story_time_{{ $i }}" label="Time" :value="old('story_time_' . $i, $story['time'] ?? '')" />
    <x-input name="story_gradient_from_{{ $i }}" label="Gradient From" :value="old('story_gradient_from_' . $i, $story['gradient_from'] ?? '')" />
    <x-input name="story_gradient_to_{{ $i }}" label="Gradient To" :value="old('story_gradient_to_' . $i, $story['gradient_to'] ?? '')" />
</div>

<x-textarea name="story_description_{{ $i }}" label="Description" rows="2" :value="old('story_description_' . $i, $story['description'] ?? '')" />
<x-input name="story_overlay_title_{{ $i }}" label="Overlay Title" :value="old('story_overlay_title_' . $i, $story['overlay_title'] ?? '')" />
<x-textarea name="story_overlay_desc_{{ $i }}" label="Overlay Description" rows="2"
    :value="old('story_overlay_desc_' . $i, $story['overlay_desc'] ?? '')" />

<div class="mt-4">
    <label class="block font-medium mb-2">Tags (one per field)</label>
    @php
        $tags = old("story_tags_{$i}", $story['tags'] ?? []);
        $tags = is_array($tags) ? $tags : [];
        $tags = array_pad($tags, 3, ''); // Ensure 3 inputs
    @endphp
    @foreach ($tags as $j => $tag)
        <input type="text" name="story_tags_{{ $i }}[]" value="{{ $tag }}"
            class="w-full border rounded p-2 mb-1" placeholder="Tag {{ $j + 1 }}">
    @endforeach
</div>

<button type="button" class="text-red-600 text-sm mt-3 remove-story">Remove Story</button>
