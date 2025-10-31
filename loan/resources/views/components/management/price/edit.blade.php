@extends('layouts.admin')

@section('content')
    <div class="max-w-7xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-8">Edit Loan Plans Section</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-6">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.loan-plans.update', $plans) }}" method="POST" class="space-y-8">
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
                <x-input name="custom_link" label="Button Link" type="url" :value="old('custom_link', $plans->custom_link)" />
                <x-input name="custom_link_icon" label="Button Icon" :value="old('custom_link_icon', $plans->custom_link_icon)" />
                <x-input name="custom_flexible_text" label="Flexible Text" :value="old('custom_flexible_text', $plans->custom_flexible_text)" />
                <x-input name="custom_flexible_subtext" label="Subtext" :value="old('custom_flexible_subtext', $plans->custom_flexible_subtext)" />
                <x-input name="custom_rate_text" label="Rate Text" :value="old('custom_rate_text', $plans->custom_rate_text)" />

                <div>
                    <label class="block font-medium mb-2">Benefits (one per line)</label>
                    <textarea name="custom_benefits[]" rows="4" class="w-full border rounded-lg p-3">{{ old('custom_benefits.0', $plans->custom_benefits[0] ?? '') }}</textarea>
                    @for ($i = 1; $i < 3; $i++)
                        <textarea name="custom_benefits[]" rows="1" class="w-full border rounded-lg p-3 mt-2">{{ old("custom_benefits.{$i}", $plans->custom_benefits[$i] ?? '') }}</textarea>
                    @endfor
                </div>
            </div>

            <!-- Dynamic Pricing Cards -->
            <div class="space-y-6">
                <h3 class="text-xl font-semibold">Pricing Cards</h3>
                <div id="pricing-cards-container">
                    @foreach ($plans->pricing_cards as $i => $card)
                        <div class="border p-6 rounded-lg bg-gray-50 mb-4 card-item">
                            <div class="grid md:grid-cols-2 gap-4">
                                <x-select name="card_type_{{ $i }}" label="Type" :options="['short' => 'Short Term', 'long' => 'Long Term']"
                                    :selected="old('card_type_' . $i, $card['type'])" />
                                <x-input name="card_name_{{ $i }}" label="Name" :value="old('card_name_' . $i, $card['name'])" />
                                <x-input name="card_price_{{ $i }}" label="Price" :value="old('card_price_' . $i, $card['price'])" />
                                <x-input name="card_term_{{ $i }}" label="Term" :value="old('card_term_' . $i, $card['term'])" />
                                <x-input name="card_rate_{{ $i }}" label="Rate" :value="old('card_rate_' . $i, $card['rate'])" />
                                <div>
                                    <label><input type="checkbox" name="card_featured_{{ $i }}"
                                            {{ old('card_featured_' . $i, $card['featured'] ?? false) ? 'checked' : '' }}>
                                        Featured</label>
                                </div>
                            </div>
                            <div class="mt-4">
                                <label class="block font-medium mb-2">Features (one per line)</label>
                                @foreach ($card['features'] as $j => $feat)
                                    <input type="text" name="card_features_{{ $i }}[]"
                                        value="{{ old('card_features_' . $i . '.' . $j, $feat) }}"
                                        class="w-full border rounded p-2 mb-1">
                                @endforeach
                                <input type="text" name="card_features_{{ $i }}[]"
                                    class="w-full border rounded p-2 mb-1" placeholder="Add new feature">
                            </div>
                            <button type="button" class="text-red-600 text-sm mt-2 remove-card">Remove Card</button>
                        </div>
                    @endforeach
                </div>
                <button type="button" id="add-card" class="bg-primary text-white px-4 py-2 rounded">+ Add Card</button>
            </div>

            <button type="submit" class="bg-primary text-white px-8 py-3 rounded-lg font-bold">Save Changes</button>
        </form>
    </div>

    <script>
        document.getElementById('add-card').addEventListener('click', function() {
            const container = document.getElementById('pricing-cards-container');
            const index = container.children.length;
            const html = `
        <div class="border p-6 rounded-lg bg-gray-50 mb-4 card-item">
            <div class="grid md:grid-cols-2 gap-4">
                <select name="card_type_${index}" class="border rounded p-2"><option value="short">Short Term</option><option value="long">Long Term</option></select>
                <input type="text" name="card_name_${index}" placeholder="Name" class="border rounded p-2">
                <input type="text" name="card_price_${index}" placeholder="Price" class="border rounded p-2">
                <input type="text" name="card_term_${index}" placeholder="Term" class="border rounded p-2">
                <input type="text" name="card_rate_${index}" placeholder="Rate" class="border rounded p-2">
                <label><input type="checkbox" name="card_featured_${index}"> Featured</label>
            </div>
            <div class="mt-4">
                <label class="block font-medium mb-2">Features</label>
                <input type="text" name="card_features_${index}[]" class="w-full border rounded p-2 mb-1" placeholder="Feature 1">
                <input type="text" name="card_features_${index}[]" class="w-full border rounded p-2 mb-1" placeholder="Feature 2">
            </div>
            <button type="button" class="text-red-600 text-sm mt-2 remove-card">Remove Card</button>
        </div>`;
            container.insertAdjacentHTML('beforeend', html);
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-card')) {
                e.target.closest('.card-item').remove();
            }
        });
    </script>
@endsection
