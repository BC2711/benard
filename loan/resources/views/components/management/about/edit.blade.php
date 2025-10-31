@extends('layouts.admin')

@section('content')
    <div class="max-w-6xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-8">Edit About Section</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-6">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.about.update', $about) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf @method('PUT')

            {{-- Header --}}
            <div class="grid md:grid-cols-2 gap-6">
                <x-input name="section_label" label="Section Badge (Why Choose…)" :value="old('section_label', $about->section_label)" />
                <x-input name="highlighted_text" label="Highlighted Word" :value="old('highlighted_text', $about->highlighted_text)" />
            </div>

            <x-input name="heading" label="Main Heading" :value="old('heading', $about->heading)" />
            <x-textarea name="description" label="Description" rows="4" :value="old('description', $about->description)" />

            {{-- CTA --}}
            <div class="grid md:grid-cols-2 gap-6">
                <x-input name="cta_text" label="CTA Button Text" :value="old('cta_text', $about->cta_text)" />
                <x-input name="cta_link" label="CTA Link (URL)" type="url" :value="old('cta_link', $about->cta_link)" />
            </div>

            {{-- Stats (4) --}}
            <div class="space-y-4">
                <h3 class="text-xl font-semibold">Trust Stats</h3>
                <div class="grid md:grid-cols-4 gap-4">
                    @for ($i = 1; $i <= 4; $i++)
                        <div>
                            <x-input name="stat_{{ $i }}_value" placeholder="Value"
                                :value="old('stat_{$i}_value', $about[\"stat_{$i}_value\"])" />
                            <x-input name="stat_{{ $i }}_label" placeholder="Label"
                                :value="old('stat_{$i}_label', $about[\"stat_{$i}_label\"])" class="mt-2" />
                        </div>
                    @endfor
                </div>
            </div>

            {{-- Features (repeatable) --}}
            <div class="space-y-6">
                <h3 class="text-xl font-semibold">Features (4)</h3>
                @foreach ($about->features as $index => $feat)
                    @php $i = $index + 1; @endphp
                    <div class="border p-4 rounded-lg grid md:grid-cols-3 gap-4">
                        <x-input name="feature_{{ $i }}_icon" label="Icon (fa-…)"
                            :value="old(\"feature_{$i}_icon\", $feat['icon'])" />
                        <x-input name="feature_{{ $i }}_title" label="Title"
                            :value="old(\"feature_{$i}_title\", $feat['title'])" />
                        <x-input name="feature_{{ $i }}_desc" label="Description"
                            :value="old(\"feature_{$i}_desc\", $feat['desc'])" />
                    </div>
                @endforeach
            </div>

            {{-- Images (4) --}}
            <div class="space-y-6">
                <h3 class="text-xl font-semibold">Gallery Images (4)</h3>
                <div class="grid md:grid-cols-4 gap-4">
                    @foreach (['1', '2', '3', '4'] as $n)
                        <div>
                            <label class="block font-medium mb-2">Image {{ $n }}</label>
                            <input type="file" name="image_{{ $n }}" accept="image/*" class="w-full">
                            @if ($about["image_{$n}"])
                                <img src="{{ asset('storage/' . $about["image_{$n}"]) }}"
                                    class="mt-2 h-32 w-full object-cover rounded">
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Rating Card --}}
            <div class="grid md:grid-cols-3 gap-4">
                <x-input name="rating_icon" label="Icon (fa-…)" :value="old('rating_icon', $about->rating_icon)" />
                <x-input name="rating_value" label="Rating Text" :value="old('rating_value', $about->rating_value)" />
                <x-input name="rating_subtitle" label="Subtitle" :value="old('rating_subtitle', $about->rating_subtitle)" />
            </div>

            <button type="submit" class="bg-primary text-white px-8 py-3 rounded-lg font-bold hover:bg-primary/90">
                Save Changes
            </button>
        </form>
    </div>
@endsection
