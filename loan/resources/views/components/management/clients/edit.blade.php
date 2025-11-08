@extends('layouts.admin.main')
@section('title', 'Trusted Clients Management')
@section('breadcrumbs')
    <nav class="flex items-center space-x-2">
        <a href="{{ route('management.dashboard') }}" class="text-sm text-gray-500 hover:text-gray-700">Website Management</a>
        <span class="text-gray-400">/</span>
        <span class="text-sm text-gray-500">Trusted Clients</span>
    </nav>
@endsection
@section('page-icon')
    <i class="fas fa-users fa-lg text-gray-700"></i>
@endsection
@section('page-title')
    <h1 class="text-2xl font-bold text-gray-900">Trusted Clients</h1>
@endsection
@section('content')
    <div class="max-w-8xl mx-auto p-6 rounded-lg bg-white">
        <h1 class="text-3xl font-bold mb-8">Edit Trusted Clients Section</h1>
        <form action="{{ route('management.client.update', $section->id) }}" method="POST" class="space-y-8">
            @csrf @method('PUT')

            <!-- Header -->
            <x-input name="heading" label="Main Heading" :value="old('heading', $section->heading)" />
            <x-textarea name="description" label="Description" rows="3" :value="old('description', $section->description)" />

            <!-- Industry Badges -->
            <div class="border p-6 rounded-lg bg-gray-50">
                <h3 class="text-xl font-semibold mb-4">Industry Badges</h3>
                <div id="badges-container">
                    @foreach ($section->industry_badges as $i => $b)
                        <div class="flex gap-4 mb-2">
                            <x-input name="badge_icon_{{ $i }}" label="Icon" :value="old('badge_icon_' . $i, $b['icon'])"
                                class="w-32" />
                            <x-input name="badge_text_{{ $i }}" label="Text" :value="old('badge_text_' . $i, $b['text'])"
                                class="flex-1" />
                            <button type="button" class="text-red-600 remove-badge">Remove</button>
                        </div>
                    @endforeach
                </div>
                <button type="button" id="add-badge" class="text-sm text-blue-600">+ Add Badge</button>
            </div>

            <!-- Clients -->
            <div class="border p-6 rounded-lg bg-gray-50 space-y-6">
                <h3 class="text-xl font-semibold">Clients (Carousel)</h3>
                <div id="clients-container">
                    @foreach ($section->clients as $i => $c)
                        <div class="border p-4 rounded bg-white mb-4 client-item">
                            <div class="grid md:grid-cols-2 gap-4">
                                <x-input name="client_name_{{ $i }}" label="Name" :value="old('client_name_' . $i, $c['name'])" />
                                <x-input name="client_type_{{ $i }}" label="Type" :value="old('client_type_' . $i, $c['type'])" />
                                <x-textarea name="client_description_{{ $i }}" label="Description" rows="2"
                                    :value="old('client_description_' . $i, $c['description'])" />
                                <x-input name="client_tag1_{{ $i }}" label="Tag 1" :value="old('client_tag1_' . $i, $c['tags'][0] ?? '')" />
                                <x-input name="client_tag2_{{ $i }}" label="Tag 2" :value="old('client_tag2_' . $i, $c['tags'][1] ?? '')" />
                            </div>
                            <button type="button" class="text-red-600 text-sm mt-2 remove-client">Remove Client</button>
                        </div>
                    @endforeach
                </div>
                <button type="button" id="add-client" class="bg-primary-primary text-white px-4 py-2 rounded">+ Add
                    Client</button>
            </div>

            <!-- Success Highlights -->
            <div class="border p-6 rounded-lg bg-gray-50 space-y-4">
                <h3 class="text-xl font-semibold">Success Highlights (3)</h3>
                @for ($i = 0; $i < 3; $i++)
                    <div class="grid md:grid-cols-3 gap-4 border p-4 rounded bg-white">
                        <x-input name="highlight_amount_{{ $i }}" label="Amount" :value="old('highlight_amount_' . $i, $section->highlights[$i]['amount'] ?? '')" />
                        <x-input name="highlight_client_{{ $i }}" label="Client" :value="old('highlight_client_' . $i, $section->highlights[$i]['client'] ?? '')" />
                        <x-input name="highlight_type_{{ $i }}" label="Type" :value="old('highlight_type_' . $i, $section->highlights[$i]['type'] ?? '')" />
                        <x-textarea name="highlight_result_{{ $i }}" label="Result" rows="2"
                            :value="old('highlight_result_' . $i, $section->highlights[$i]['result'] ?? '')" />
                        <x-input name="highlight_metric_{{ $i }}" label="Metric" :value="old('highlight_metric_' . $i, $section->highlights[$i]['metric'] ?? '')" />
                        <x-input name="highlight_timeline_{{ $i }}" label="Timeline" :value="old('highlight_timeline_' . $i, $section->highlights[$i]['timeline'] ?? '')" />
                    </div>
                @endfor
            </div>

            <!-- Testimonials -->
            <div class="border p-6 rounded-lg bg-gray-50 space-y-4">
                <h3 class="text-xl font-semibold">Client Testimonials (2)</h3>
                @for ($i = 0; $i < 2; $i++)
                    <div class="grid md:grid-cols-2 gap-4">
                        <x-input name="testimonial_name_{{ $i }}" label="Name" :value="old('testimonial_name_' . $i, $section->testimonials[$i]['name'] ?? '')" />
                        <x-input name="testimonial_role_{{ $i }}" label="Role" :value="old('testimonial_role_' . $i, $section->testimonials[$i]['role'] ?? '')" />
                        <x-textarea name="testimonial_quote_{{ $i }}" label="Quote" rows="3"
                            :value="old('testimonial_quote_' . $i, $section->testimonials[$i]['quote'] ?? '')" />
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

            <!-- Trust Indicators -->
            <div class="border p-6 rounded-lg bg-gray-50">
                <h3 class="text-xl font-semibold mb-4">Trust Indicators</h3>
                <div id="trust-container">
                    @foreach ($section->trust_indicators as $i => $t)
                        <div class="flex gap-4 mb-2">
                            <x-input name="trust_icon_{{ $i }}" label="Icon" :value="old('trust_icon_' . $i, $t['icon'])"
                                class="w-32" />
                            <x-input name="trust_text_{{ $i }}" label="Text" :value="old('trust_text_' . $i, $t['text'])"
                                class="flex-1" />
                            <button type="button" class="text-red-600 remove-trust">Remove</button>
                        </div>
                    @endforeach
                </div>
                <button type="button" id="add-trust" class="text-sm text-blue-600">+ Add
                    Indicator</button>
            </div>

            <button type="submit" class="bg-primary-primary text-white px-8 py-3 rounded-lg font-bold">Save
                Changes</button>
        </form>
    </div>

    <script>
        let badgeIndex = {{ count($section->industry_badges) }};
        let clientIndex = {{ count($section->clients) }};
        let trustIndex = {{ count($section->trust_indicators) }};

        document.getElementById('add-badge').addEventListener('click', () => {
            const html = `<div class="flex gap-4 mb-2">
        <input type="text" name="badge_icon_${badgeIndex}" placeholder="fa-bullhorn" class="border rounded p-2 w-32">
        <input type="text" name="badge_text_${badgeIndex}" placeholder="Marketing Agencies" class="border rounded p-2 flex-1">
        <button type="button" class="text-red-600 remove-badge">Remove</button>
    </div>`;
            document.getElementById('badges-container').insertAdjacentHTML('beforeend', html);
            badgeIndex++;
        });

        document.getElementById('add-client').addEventListener('click', () => {
            const html = `<div class="border p-4 rounded bg-white mb-4 client-item">
        <div class="grid md:grid-cols-2 gap-4">
            <input type="text" name="client_name_${clientIndex}" placeholder="Name" class="border rounded p-2">
            <input type="text" name="client_type_${clientIndex}" placeholder="Type" class="border rounded p-2">
            <textarea name="client_description_${clientIndex}" placeholder="Description" rows="2" class="border rounded p-2"></textarea>
            <input type="text" name="client_tag1_${clientIndex}" placeholder="Tag 1" class="border rounded p-2">
            <input type="text" name="client_tag2_${clientIndex}" placeholder="Tag 2" class="border rounded p-2">
        </div>
        <button type="button" class="text-red-600 text-sm mt-2 remove-client">Remove Client</button>
    </div>`;
            document.getElementById('clients-container').insertAdjacentHTML('beforeend', html);
            clientIndex++;
        });

        document.getElementById('add-trust').addEventListener('click', () => {
            const html = `<div class="flex gap-4 mb-2">
        <input type="text" name="trust_icon_${trustIndex}" placeholder="fa-check-circle" class="border rounded p-2 w-32">
        <input type="text" name="trust_text_${trustIndex}" placeholder="150+ Happy Clients" class="border rounded p-2 flex-1">
        <button type="button" class="text-red-600 remove-trust">Remove</button>
    </div>`;
            document.getElementById('trust-container').insertAdjacentHTML('beforeend', html);
            trustIndex++;
        });

        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('remove-badge') || e.target.classList.contains('remove-client') || e
                .target.classList.contains('remove-trust')) {
                e.target.parentElement.remove();
            }
        });
    </script>
@endsection
