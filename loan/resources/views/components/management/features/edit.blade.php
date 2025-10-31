@extends('layouts.admin')

@section('content')
    <div class="max-w-6xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-8">Edit Features Section</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-6">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.features.update', $feature) }}" method="POST" class="space-y-8">
            @csrf @method('PUT')

            {{-- Header --}}
            <div class="grid md:grid-cols-2 gap-6">
                <x-input name="badge_text" label="Badge Text" :value="old('badge_text', $feature->badge_text)" />
                <x-input name="badge_icon" label="Badge Icon (fa-…)" :value="old('badge_icon', $feature->badge_icon)" />
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <x-input name="heading" label="Main Heading" :value="old('heading', $feature->heading)" />
                <x-input name="highlighted_text" label="Highlighted Text" :value="old('highlighted_text', $feature->highlighted_text)" />
            </div>

            <x-textarea name="description" label="Description" rows="3" :value="old('description', $feature->description)" />

            {{-- Trust Stats --}}
            <div class="space-y-4">
                <h3 class="text-xl font-semibold">Trust Indicators (4)</h3>
                <div class="grid md:grid-cols-4 gap-4">
                    @for ($i = 1; $i <= 4; $i++)
                        <div>
                            <x-input name="stat_{{ $i }}_value" placeholder="Value"
                                :value="old('stat_{$i}_value', $feature[\"stat_{$i}_value\"])" />
                            <x-input name="stat_{{ $i }}_label" placeholder="Label"
                                :value="old('stat_{$i}_label', $feature[\"stat_{$i}_label\"])" class="mt-2" />
                        </div>
                    @endfor
                </div>
            </div>

            {{-- Features (6) --}}
            <div class="space-y-6">
                <h3 class="text-xl font-semibold">Feature Cards (6)</h3>
                @foreach ($feature->features as $idx => $f)
                    @php $i = $idx + 1; @endphp
                    <div class="border p-4 rounded-lg grid md:grid-cols-4 gap-4 bg-gray-50">
                        <x-input name="feature_{{ $i }}_icon" label="Icon (fa-…)"
                            :value="old(\"feature_{$i}_icon\", $f['icon'])" />
                        <x-input name="feature_{{ $i }}_title" label="Title"
                            :value="old(\"feature_{$i}_title\", $f['title'])" />
                        <x-textarea name="feature_{{ $i }}_desc" label="Description" rows="2"
                            :value="old(\"feature_{$i}_desc\", $f['desc'])" />
                        <x-input name="feature_{{ $i }}_learn_more" label="Learn More Text"
                            :value="old(\"feature_{$i}_learn_more\", $f['learn_more'] ?? 'Learn more' )" />
                    </div>
                @endforeach
            </div>

            {{-- CTA Section --}}
            <div class="space-y-4">
                <h3 class="text-xl font-semibold">Bottom CTA</h3>
                <x-input name="cta_heading" label="Heading" :value="old('cta_heading', $feature->cta_heading)" />
                <x-textarea name="cta_description" label="Description" rows="3" :value="old('cta_description', $feature->cta_description)" />

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <x-input name="cta_primary_text" label="Primary Button Text" :value="old('cta_primary_text', $feature->cta_primary_text)" />
                        <x-input name="cta_primary_link" label="Primary Link" type="url" :value="old('cta_primary_link', $feature->cta_primary_link)" />
                    </div>
                    <div>
                        <x-input name="cta_secondary_text" label="Secondary Button Text" :value="old('cta_secondary_text', $feature->cta_secondary_text)" />
                        <x-input name="cta_secondary_link" label="Secondary Link" type="url" :value="old('cta_secondary_link', $feature->cta_secondary_link)" />
                    </div>
                </div>
            </div>

            <button type="submit" class="bg-primary text-white px-8 py-3 rounded-lg font-bold hover:bg-primary/90">
                Save Changes
            </button>
        </form>
    </div>
@endsection
