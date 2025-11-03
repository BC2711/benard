{{-- Hidden template for JS --}}
<template id="story-template">
    <div class="border p-6 rounded-lg bg-gray-50 mb-4 story-item">
        <div class="grid md:grid-cols-2 gap-4">
            <input type="text" name="story_title___INDEX__" placeholder="Title" class="border rounded p-2">
            <input type="text" name="story_amount___INDEX__" placeholder="Amount" class="border rounded p-2">
            <select name="story_category___INDEX__" class="border rounded p-2">__CAT_OPTIONS__</select>
            <input type="text" name="story_funding___INDEX__" placeholder="Funding" class="border rounded p-2">
            <input type="text" name="story_type___INDEX__" placeholder="Type" class="border rounded p-2">
            <input type="text" name="story_result___INDEX__" placeholder="Result" class="border rounded p-2">
            <input type="text" name="story_time___INDEX__" placeholder="Time" class="border rounded p-2">
            <input type="text" name="story_gradient_from___INDEX__" placeholder="primary-700"
                class="border rounded p-2">
            <input type="text" name="story_gradient_to___INDEX__" placeholder="accent-500"
                class="border rounded p-2">
        </div>
        <textarea name="story_description___INDEX__" placeholder="Description" rows="2"
            class="w-full border rounded p-2 mt-2"></textarea>
        <input type="text" name="story_overlay_title___INDEX__" placeholder="Overlay Title"
            class="w-full border rounded p-2 mt-2">
        <textarea name="story_overlay_desc___INDEX__" placeholder="Overlay Desc" rows="2"
            class="w-full border rounded p-2 mt-2"></textarea>
        <div class="mt-2">
            <label class="block font-medium mb-1">Tags</label>
            <input type="text" name="story_tags___INDEX__[]" class="w-full border rounded p-2 mb-1"
                placeholder="Tag 1">
            <input type="text" name="story_tags___INDEX__[]" class="w-full border rounded p-2 mb-1"
                placeholder="Tag 2">
            <input type="text" name="story_tags___INDEX__[]" class="w-full border rounded p-2 mb-1"
                placeholder="Tag 3">
        </div>
        <button type="button" class="text-red-600 text-sm mt-2 remove-story">Remove Story</button>
    </div>
</template>
