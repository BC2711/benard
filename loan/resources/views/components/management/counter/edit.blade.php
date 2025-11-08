@extends('layouts.admin.main')
@section('title', 'Impact Numbers Management')
@section('breadcrumbs')
    <nav class="flex items-center space-x-2">
        <a href="{{ route('management.dashboard') }}" class="text-sm text-gray-500 hover:text-gray-700">Website Management</a>
        <span class="text-gray-400">/</span>
        <span class="text-sm text-gray-500">Impact Numbers</span>
    </nav>
@endsection
@section('page-icon')
    <i class="fas fa-users fa-lg text-gray-700"></i>
@endsection
@section('page-title')
    <h1 class="text-2xl font-bold text-gray-900">Impact Numbers</h1>
@endsection
@section('content')
    <div class="max-w-8xl mx-auto p-6 rounded-lg bg-white">
        <h1 class="text-3xl font-bold mb-8">Edit Impact Numbers Section</h1>

        <form action="{{ route('management.counter.update', $section->id) }}" method="POST" class="space-y-8">
            @csrf @method('PUT')

            <!-- Header -->
            <x-input name="heading" label="Main Heading" :value="old('heading', $section->heading)" />
            <x-textarea name="description" label="Description" rows="3" :value="old('description', $section->description)" />

            <!-- Main Stats -->
            <div class="border p-6 rounded-lg bg-gray-50 space-y-6">
                <h3 class="text-xl font-semibold">Main Stats (4)</h3>
                @for ($i = 0; $i < 4; $i++)
                    <div class="grid md:grid-cols-3 gap-4">
                        <x-input name="main_stat_target_{{ $i }}" label="Target Number" type="number"
                            :value="old('main_stat_target_' . $i, $section->main_stats[$i]['target'] ?? '')" />
                        <x-input name="main_stat_suffix_{{ $i }}" label="Suffix (%, M+, h)" :value="old('main_stat_suffix_' . $i, $section->main_stats[$i]['suffix'] ?? '')" />
                        <x-input name="main_stat_label_{{ $i }}" label="Label" :value="old('main_stat_label_' . $i, $section->main_stats[$i]['label'] ?? '')" />
                        <x-input name="main_stat_icon_{{ $i }}" label="Icon (fa-bullseye)" :value="old('main_stat_icon_' . $i, $section->main_stats[$i]['icon'] ?? '')" />
                        <x-input name="main_stat_progress_{{ $i }}" label="Progress %" type="number"
                            min="0" max="100" :value="old('main_stat_progress_' . $i, $section->main_stats[$i]['progress'] ?? '')" />
                    </div>
                @endfor
            </div>

            <!-- Performance Metrics -->
            <div class="border p-6 rounded-lg bg-gray-50 space-y-4">
                <h3 class="text-xl font-semibold">Performance Metrics (3)</h3>
                @for ($i = 0; $i < 3; $i++)
                    <div class="grid md:grid-cols-3 gap-4">
                        <x-input name="metric_value_{{ $i }}" label="Value" :value="old('metric_value_' . $i, $section->performance_metrics[$i]['value'] ?? '')" />
                        <x-input name="metric_label_{{ $i }}" label="Label" :value="old('metric_label_' . $i, $section->performance_metrics[$i]['label'] ?? '')" />
                        <x-input name="metric_icon_{{ $i }}" label="Icon" :value="old('metric_icon_' . $i, $section->performance_metrics[$i]['icon'] ?? '')" />
                    </div>
                @endfor
            </div>

            <!-- Industry Impact -->
            <div class="border p-6 rounded-lg bg-gray-50 space-y-4">
                <h3 class="text-xl font-semibold">Industry Impact (4)</h3>
                @for ($i = 0; $i < 4; $i++)
                    <div class="grid md:grid-cols-2 gap-4">
                        <x-input name="industry_value_{{ $i }}" label="Value" :value="old('industry_value_' . $i, $section->industry_impact[$i]['value'] ?? '')" />
                        <x-input name="industry_label_{{ $i }}" label="Label" :value="old('industry_label_' . $i, $section->industry_impact[$i]['label'] ?? '')" />
                    </div>
                @endfor
            </div>

            <!-- Growth Timeline -->
            <div class="border p-6 rounded-lg bg-gray-50 space-y-4">
                <h3 class="text-xl font-semibold">Growth Timeline (3)</h3>
                @for ($i = 0; $i < 3; $i++)
                    <div class="grid md:grid-cols-3 gap-4">
                        <x-input name="timeline_year_{{ $i }}" label="Year" :value="old('timeline_year_' . $i, $section->timeline[$i]['year'] ?? '')" />
                        <x-input name="timeline_label_{{ $i }}" label="Label" :value="old('timeline_label_' . $i, $section->timeline[$i]['label'] ?? '')" />
                        <x-input name="timeline_detail_{{ $i }}" label="Detail" :value="old('timeline_detail_' . $i, $section->timeline[$i]['detail'] ?? '')" />
                    </div>
                @endfor
            </div>

            <!-- CTA -->
            <div class="border p-6 rounded-lg bg-gray-50 space-y-4">
                <h3 class="text-xl font-semibold">CTA</h3>
                <x-input name="cta_heading" label="Heading" :value="old('cta_heading', $section->cta_heading)" />
                <x-textarea name="cta_description" label="Description" rows="2" :value="old('cta_description', $section->cta_description)" />
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <x-input name="cta_primary_text" label="Primary Text" :value="old('cta_primary_text', $section->cta_primary_text)" />
                        <x-input name="cta_primary_link" label="Primary Link" type="text" :value="old('cta_primary_link', $section->cta_primary_link)" />
                        <x-input name="cta_primary_icon" label="Primary Icon" :value="old('cta_primary_icon', $section->cta_primary_icon)" />
                    </div>
                    <div>
                        <x-input name="cta_secondary_text" label="Secondary Text" :value="old('cta_secondary_text', $section->cta_secondary_text)" />
                        <x-input name="cta_secondary_link" label="Secondary Link" type="text" :value="old('cta_secondary_link', $section->cta_secondary_link)" />
                        <x-input name="cta_secondary_icon" label="Secondary Icon" :value="old('cta_secondary_icon', $section->cta_secondary_icon)" />
                    </div>
                </div>
            </div>

            <!-- Trust Badges -->
            <div class="border p-6 rounded-lg bg-gray-50">
                <h3 class="text-xl font-semibold mb-4">Trust Badges</h3>
                <div id="badges-container">
                    @foreach ($section->trust_badges as $i => $badge)
                        <div class="flex gap-4 mb-2">
                            <x-input name="badge_icon_{{ $i }}" label="Icon" :value="old('badge_icon_' . $i, $badge['icon'])"
                                class="w-32" />
                            <x-input name="badge_text_{{ $i }}" label="Text" :value="old('badge_text_' . $i, $badge['text'])"
                                class="flex-1" />
                            <button type="button" class="text-red-600 remove-badge">Remove</button>
                        </div>
                    @endforeach
                </div>
                <button type="button" id="add-badge" class="text-sm text-blue-600">+ Add Badge</button>
            </div>

            <button type="submit" class="bg-primary-primary text-white px-8 py-3 rounded-lg font-bold">Save
                Changes</button>
        </form>
    </div>

    <script>
        let badgeIndex = {{ count($section->trust_badges) }};

        document.getElementById('add-badge').addEventListener('click', function() {
            const container = document.getElementById('badges-container');
            const html = `
        <div class="flex gap-4 mb-2">
            <input type="text" name="badge_icon_${badgeIndex}" placeholder="fa-shield-alt" class="border rounded p-2 w-32">
            <input type="text" name="badge_text_${badgeIndex}" placeholder="Secure & Confidential" class="border rounded p-2 flex-1">
            <button type="button" class="text-red-600 remove-badge">Remove</button>
        </div>`;
            container.insertAdjacentHTML('beforeend', html);
            badgeIndex++;
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-badge')) {
                e.target.parentElement.remove();
            }
        });
    </script>
@endsection
