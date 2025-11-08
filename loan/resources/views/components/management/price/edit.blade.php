@extends('layouts.admin.main')
@section('title', 'Loan Plans Management')
@section('breadcrumbs')
    <nav class="flex items-center space-x-2">
        <a href="{{ route('management.dashboard.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Website Management</a>
        <span class="text-gray-400">/</span>
        <span class="text-sm text-gray-500">Loan Plans</span>
    </nav>
@endsection
@section('page-icon')
    <i class="fas fa-users fa-lg text-gray-700"></i>
@endsection
@section('page-title')
    <h1 class="text-2xl font-bold text-gray-900">Loan Plans</h1>
@endsection
@section('content')
    <div class="max-w-8xl mx-auto p-6 rounded-lg bg-white">
        <h1 class="text-3xl font-bold mb-8">Edit Loan Plans Section</h1>
        <form action="{{ route('management.price.update', $plans->id) }}" method="POST" class="space-y-8">
            @csrf @method('PUT')

            <!-- Header -->
            <div class="grid md:grid-cols-2 gap-6">
                <x-input name="heading" label="Main Heading" :value="old('heading', $plans->heading)" />
                <x-input name="highlighted_text" label="Highlighted Text" :value="old('highlighted_text', $plans->highlighted_text)" />
            </div>
            <x-textarea name="description" label="Description" rows="3" :value="old('description', $plans->description)" />

            <!-- Toggle -->
            <div class="grid md:grid-cols-2 gap-6">
                <x-input name="short_term_label" label="Short Term Label" :value="old('short_term_label', $plans->short_term_label)" />
                <x-input name="long_term_label" label="Long Term Label" :value="old('long_term_label', $plans->long_term_label)" />
            </div>
            <div class="grid md:grid-cols-2 gap-6">
                <x-textarea name="short_term_desc" label="Short Term Description" rows="2" :value="old('short_term_desc', $plans->short_term_desc)" />
                <x-textarea name="long_term_desc" label="Long Term Description" rows="2" :value="old('long_term_desc', $plans->long_term_desc)" />
            </div>

            <!-- Custom Solution -->
            <div class="border p-6 rounded-lg bg-gray-50 space-y-4">
                <h3 class="text-xl font-semibold">Custom Solution Block</h3>
                <x-input name="custom_badge" label="Badge" :value="old('custom_badge', $plans->custom_badge)" />
                <x-input name="custom_heading" label="Heading" :value="old('custom_heading', $plans->custom_heading)" />
                <x-textarea name="custom_description" label="Description" rows="3" :value="old('custom_description', $plans->custom_description)" />
                <x-input name="custom_link_text" label="Button Text" :value="old('custom_link_text', $plans->custom_link_text)" />
                <x-input name="custom_link" label="Button Link" type="text" :value="old('custom_link', $plans->custom_link)" />
                <x-input name="custom_link_icon" label="Button Icon" :value="old('custom_link_icon', $plans->custom_link_icon)" />
                <x-input name="custom_flexible_text" label="Flexible Text" :value="old('custom_flexible_text', $plans->custom_flexible_text)" />
                <x-input name="custom_flexible_subtext" label="Subtext" :value="old('custom_flexible_subtext', $plans->custom_flexible_subtext)" />
                <x-input name="custom_rate_text" label="Rate Text" :value="old('custom_rate_text', $plans->custom_rate_text)" />

                <div>
                    <label class="block font-medium mb-2">Benefits (one per line)</label>
                    @for ($i = 0; $i < 3; $i++)
                        <textarea name="custom_benefits[]" rows="2" class="w-full border rounded-lg p-3 mt-2"
                            placeholder="Benefit {{ $i + 1 }}">{{ old("custom_benefits.{$i}", $plans->custom_benefits[$i] ?? '') }}</textarea>
                    @endfor
                </div>
            </div>

            <!-- Dynamic Pricing Cards -->
            <div class="space-y-6">
                <h3 class="text-xl font-semibold">Pricing Cards</h3>
                <div id="pricing-cards-container">
                    @php
                        $cardCount = count($plans->pricing_cards);
                    @endphp
                    @foreach ($plans->pricing_cards as $i => $card)
                        <div class="border p-6 rounded-lg bg-gray-50 mb-4 card-item" data-index="{{ $i }}">
                            <div class="grid md:grid-cols-2 gap-4">
                                <x-select name="card_type_{{ $i }}" label="Type" :options="['short' => 'Short Term', 'long' => 'Long Term']"
                                    :selected="old('card_type_' . $i, $card['type'])" />
                                <x-input name="card_name_{{ $i }}" label="Name" :value="old('card_name_' . $i, $card['name'])" />
                                <x-input name="card_price_{{ $i }}" label="Price" :value="old('card_price_' . $i, $card['price'])" />
                                <x-input name="card_term_{{ $i }}" label="Term" :value="old('card_term_' . $i, $card['term'])" />
                                <x-input name="card_rate_{{ $i }}" label="Rate" :value="old('card_rate_' . $i, $card['rate'])" />
                                <div class="flex items-center">
                                    <label class="flex items-center space-x-2">
                                        <input type="checkbox" name="card_featured_{{ $i }}" value="on"
                                            {{ old('card_featured_' . $i, $card['featured'] ?? false) ? 'checked' : '' }}>
                                        <span>Featured</span>
                                    </label>
                                </div>
                            </div>
                            <div class="mt-4">
                                <label class="block font-medium mb-2">Features (leave empty to remove)</label>
                                <div class="features-container">
                                    @foreach ($card['features'] as $j => $feat)
                                        @if (!empty($feat))
                                            <input type="text" name="card_features_{{ $i }}[]"
                                                value="{{ old('card_features_' . $i . '.' . $j, $feat) }}"
                                                class="w-full border rounded p-2 mb-2 feature-input"
                                                placeholder="Feature {{ $j + 1 }}">
                                        @endif
                                    @endforeach
                                    <!-- Always include at least one empty feature input -->
                                    <input type="text" name="card_features_{{ $i }}[]"
                                        class="w-full border rounded p-2 mb-2 feature-input" placeholder="Add new feature">
                                </div>
                                <button type="button" class="text-blue-600 text-sm mt-2 add-feature"
                                    data-card="{{ $i }}">+ Add Another Feature</button>
                            </div>
                            @if ($i > 0)
                                <button type="button" class="text-red-600 text-sm mt-2 remove-card">Remove Card</button>
                            @endif
                        </div>
                    @endforeach
                </div>
                <button type="button" id="add-card" class="bg-primary-primary text-white px-4 py-2 rounded">+ Add
                    Card</button>
            </div>

            <button type="submit" class="bg-primary-primary text-white px-8 py-3 rounded-lg font-bold">Save
                Changes</button>
        </form>
    </div>

    <script>
        let cardCounter = {{ $cardCount }};

        document.getElementById('add-card').addEventListener('click', function() {
            const container = document.getElementById('pricing-cards-container');
            const index = cardCounter++;

            const html = `
                <div class="border p-6 rounded-lg bg-gray-50 mb-4 card-item" data-index="${index}">
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="block font-medium mb-1">Type</label>
                            <select name="card_type_${index}" class="w-full border rounded p-2">
                                <option value="short">Short Term</option>
                                <option value="long">Long Term</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-medium mb-1">Name</label>
                            <input type="text" name="card_name_${index}" placeholder="Card Name" class="w-full border rounded p-2" required>
                        </div>
                        <div>
                            <label class="block font-medium mb-1">Price</label>
                            <input type="text" name="card_price_${index}" placeholder="e.g., ZMW5,000" class="w-full border rounded p-2" required>
                        </div>
                        <div>
                            <label class="block font-medium mb-1">Term</label>
                            <input type="text" name="card_term_${index}" placeholder="e.g., 3 months" class="w-full border rounded p-2" required>
                        </div>
                        <div>
                            <label class="block font-medium mb-1">Rate</label>
                            <input type="text" name="card_rate_${index}" placeholder="e.g., 12%" class="w-full border rounded p-2" required>
                        </div>
                        <div class="flex items-center">
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" name="card_featured_${index}" value="on">
                                <span>Featured</span>
                            </label>
                        </div>
                    </div>
                    <div class="mt-4">
                        <label class="block font-medium mb-2">Features (leave empty to remove)</label>
                        <div class="features-container">
                            <input type="text" name="card_features_${index}[]" class="w-full border rounded p-2 mb-2 feature-input" placeholder="Feature 1" required>
                            <input type="text" name="card_features_${index}[]" class="w-full border rounded p-2 mb-2 feature-input" placeholder="Feature 2">
                        </div>
                        <button type="button" class="text-blue-600 text-sm mt-2 add-feature" data-card="${index}">+ Add Another Feature</button>
                    </div>
                    <button type="button" class="text-red-600 text-sm mt-2 remove-card">Remove Card</button>
                </div>`;

            container.insertAdjacentHTML('beforeend', html);
        });

        // Add feature input
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('add-feature')) {
                const cardIndex = e.target.getAttribute('data-card');
                const featuresContainer = e.target.previousElementSibling;

                const input = document.createElement('input');
                input.type = 'text';
                input.name = `card_features_${cardIndex}[]`;
                input.className = 'w-full border rounded p-2 mb-2 feature-input';
                input.placeholder = 'Additional feature';

                featuresContainer.appendChild(input);
            }

            // Remove card
            if (e.target.classList.contains('remove-card')) {
                e.target.closest('.card-item').remove();
            }
        });

        // Remove empty feature inputs on form submit
        document.querySelector('form').addEventListener('submit', function() {
            document.querySelectorAll('.feature-input').forEach(input => {
                if (!input.value.trim()) {
                    input.remove();
                }
            });
        });
    </script>
@endsection
