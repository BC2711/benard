@extends('layouts.admin.main')
@section('title', 'Success Stories Management')
@section('breadcrumbs')
    <nav class="flex items-center space-x-2">
        <a href="{{ route('management.dashboard.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Website Management</a>
        <span class="text-gray-400">/</span>
        <span class="text-sm text-gray-500">Success Stories</span>
    </nav>
@endsection
@section('page-icon')
    <i class="fas fa-users fa-lg text-gray-700"></i>
@endsection
@section('page-title')
    <h1 class="text-2xl font-bold text-gray-900">Success Stories</h1>
@endsection
@section('content')
    <div class="max-w-8xl mx-auto p-6 rounded-lg bg-white">
        <h1 class="text-3xl font-bold mb-8">Edit Success Stories Section</h1>

        <form action="{{ route('management.project.update', $section->id) }}" method="POST" class="space-y-8">
            @csrf @method('PUT')

            <!-- Header -->
            <x-input name="heading" label="Main Heading" :value="old('heading', $section->heading)" />
            <x-textarea name="description" label="Description" rows="3" :value="old('description', $section->description)" />

            <!-- Stats -->
            <div class="border p-6 rounded-lg bg-gray-50 space-y-4">
                <h3 class="text-xl font-semibold">Statistics (4)</h3>
                @for ($i = 0; $i < 4; $i++)
                    @php
                        $stat = $section->stats[$i] ?? ['value' => '', 'label' => ''];
                    @endphp
                    <div class="grid md:grid-cols-2 gap-4">
                        <x-input name="stat_value_{{ $i }}" label="Value" :value="old('stat_value_' . $i, $stat['value'])" />
                        <x-input name="stat_label_{{ $i }}" label="Label" :value="old('stat_label_' . $i, $stat['label'])" />
                    </div>
                @endfor
            </div>

            <!-- Categories -->
            <div class="border p-6 rounded-lg bg-gray-50">
                <h3 class="text-xl font-semibold mb-4">Filter Tabs (comma-separated)</h3>
                <input type="text" name="categories" value="{{ old('categories', implode(', ', $section->categories)) }}"
                    class="w-full border rounded p-2" placeholder="all, marketing, ecommerce, startup">
            </div>

            <!-- Success Stories -->
            <div class="space-y-6">
                <h3 class="text-xl font-semibold">Success Stories</h3>
                <div id="stories-container">
                    @forelse ($section->stories as $i => $story)
                        <div class="border p-6 rounded-lg bg-gray-50 mb-4 story-item" data-index="{{ $i }}">
                            @include('components.management.success-stories.story-fields', [
                                'i' => $i,
                                'story' => $story,
                            ])
                        </div>
                    @empty
                        <p class="text-gray-500">No stories yet. Click "Add Story" to begin.</p>
                    @endforelse
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
                        <x-input name="cta_primary_link" label="Primary Link" :value="old('cta_primary_link', $section->cta_primary_link)" />
                        <x-input name="cta_primary_icon" label="Primary Icon" :value="old('cta_primary_icon', $section->cta_primary_icon)" />
                    </div>
                    <div>
                        <x-input name="cta_secondary_text" label="Secondary Button Text" :value="old('cta_secondary_text', $section->cta_secondary_text)" />
                        <x-input name="cta_secondary_link" label="Secondary Link" :value="old('cta_secondary_link', $section->cta_secondary_link)" />
                        <x-input name="cta_secondary_icon" label="Secondary Icon" :value="old('cta_secondary_icon', $section->cta_secondary_icon)" />
                    </div>
                </div>
            </div>

            <button type="submit" class="bg-primary-primary text-white px-8 py-3 rounded-lg font-bold">
                Save Changes
            </button>
        </form>
    </div>

    {{-- Story field partials --}}
    @include('components.management.success-stories.story-fields-template')

    <script>
        let storyIndex = {{ count($section->stories) }};
        const categories = @json($section->categories);

        document.getElementById('add-story').addEventListener('click', function() {
            const container = document.getElementById('stories-container');
            const template = document.getElementById('story-template').innerHTML;
            const html = template
                .replace(/__INDEX__/g, storyIndex)
                .replace(/__CAT_OPTIONS__/g, categories.map(c =>
                    `<option value="${c}">${c.charAt(0).toUpperCase() + c.slice(1)}</option>`
                ).join(''));

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
