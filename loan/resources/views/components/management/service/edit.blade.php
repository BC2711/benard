@extends('layouts.admin')

@section('content')
    <div class="max-w-6xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-8">Edit Services Section</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-6">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.services.update', $service) }}" method="POST" class="space-y-8">
            @csrf @method('PUT')

            {{-- Header --}}
            <div class="grid md:grid-cols-2 gap-6">
                <x-input name="badge_text" label="Badge Text" :value="old('badge_text', $service->badge_text)" />
                <x-input name="badge_icon" label="Badge Icon (fa-…)" :value="old('badge_icon', $service->badge_icon)" />
            </div>
            <div class="grid md:grid-cols-2 gap-6">
                <x-input name="heading" label="Main Heading" :value="old('heading', $service->heading)" />
                <x-input name="highlighted_text" label="Highlighted Word" :value="old('highlighted_text', $service->highlighted_text)" />
            </div>
            <x-textarea name="description" label="Description" rows="3" :value="old('description', $service->description)" />

            {{-- Services (6) --}}
            <div class="space-y-6">
                <h3 class="text-xl font-semibold">Service Cards (6)</h3>
                @foreach ($service->services as $idx => $s)
                    @php $i = $idx + 1; @endphp
                    <div class="border p-4 rounded-lg grid md:grid-cols-5 gap-4 bg-gray-50">
                        <x-input name="service_{{ $i }}_icon" label="Icon"
                            :value="old(\"service_{$i}_icon\", $s['icon'])" />
                        <x-input name="service_{{ $i }}_title" label="Title"
                            :value="old(\"service_{$i}_title\", $s['title'])" />
                        <x-textarea name="service_{{ $i }}_desc" label="Desc" rows="2"
                            :value="old(\"service_{$i}_desc\", $s['desc'])" />
                        <x-input name="service_{{ $i }}_tag" label="Tag" :value="old(\"service_{$i}_tag\",
                            $s['tag'])" />
                        <x-select name="service_{{ $i }}_tag_color" label="Tag Color" :options="['primary' => 'Primary', 'secondary' => 'Secondary']"
                            :selected="old('service_{$i}_tag_color', $s['tag_color'])" />
                    </div>
                @endforeach
            </div>

            {{-- CTA --}}
            <div class="space-y-4">
                <h3 class="text-xl font-semibold">Bottom CTA</h3>
                <x-input name="cta_heading" label="Heading" :value="old('cta_heading', $service->cta_heading)" />
                <x-textarea name="cta_description" label="Description" rows="3" :value="old('cta_description', $service->cta_description)" />

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <x-input name="cta_primary_text" label="Primary Button Text" :value="old('cta_primary_text', $service->cta_primary_text)" />
                        <x-input name="cta_primary_link" label="Primary Link" type="url" :value="old('cta_primary_link', $service->cta_primary_link)" />
                        <x-input name="cta_primary_icon" label="Primary Icon" :value="old('cta_primary_icon', $service->cta_primary_icon)" />
                    </div>
                    <div>
                        <x-input name="cta_secondary_text" label="Secondary Button Text" :value="old('cta_secondary_text', $service->cta_secondary_text)" />
                        <x-input name="cta_secondary_link" label="Secondary Link" type="url" :value="old('cta_secondary_link', $service->cta_secondary_link)" />
                        <x-input name="cta_secondary_icon" label="Secondary Icon" :value="old('cta_secondary_icon', $service->cta_secondary_icon)" />
                    </div>
                </div>
            </div>

            {{-- Extra Info (3) --}}
            <div class="space-y-4">
                <h3 class="text-xl font-semibold">Extra Info Blocks (3)</h3>
                @for ($i = 1; $i <= 3; $i++)
                    <div class="grid md:grid-cols-3 gap-4 border p-4 rounded-lg">
                        <x-input name="info_{{ $i }}_icon" label="Icon"
                            :value="old('info_{$i}_icon', $service[\"info_{$i}_icon\"])" />
                        <x-input name="info_{{ $i }}_title" label="Title"
                            :value="old('info_{$i}_title', $service[\"info_{$i}_title\"])" />
                        <x-input name="info_{{ $i }}_subtitle" label="Subtitle"
                            :value="old('info_{$i}_subtitle', $service[\"info_{$i}_subtitle\"])" />
                    </div>
                @endfor
            </div>

            <button type="submit" class="bg-primary text-white px-8 py-3 rounded-lg font-bold hover:bg-primary/90">
                Save Changes
            </button>
        </form>
    </div>
@endsection
