{{-- resources/views/admin/consultation/edit.blade.php --}}
@extends('layouts.admin.main')
@section('title', 'Consultation Management')
@section('breadcrumbs')
    <nav class="flex items-center space-x-2">
        <a href="{{ route('management.dashboard.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Website Management</a>
        <span class="text-gray-400">/</span>
        <span class="text-sm text-gray-500">Consultation</span>
    </nav>
@endsection
@section('page-icon')
    <i class="fas fa-users fa-lg text-gray-700"></i>
@endsection
@section('page-title')
    <h1 class="text-2xl font-bold text-gray-900">Consultation</h1>
@endsection
@section('content')
    <div class="max-w-8xl mx-auto p-6 rounded-lg bg-white">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Edit Consultation Section</h1>

        <form action="{{ route('management.consultation.update', $section->id) }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT')

            <!-- Heading & Description -->
            <div class="bg-gray-50 p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-4">Main Heading</h2>
                <input type="text" name="heading" value="{{ old('heading', $section->heading) }}"
                    class="w-full px-4 py-2 border rounded-lg" required>
                <textarea name="description" rows="3" class="w-full mt-3 px-4 py-2 border rounded-lg" required>{{ old('description', $section->description) }}</textarea>
            </div>

            <!-- Info Heading -->
            <div class="bg-gray-50 p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-4">Why Section Heading</h2>
                <input type="text" name="info_heading" value="{{ old('info_heading', $section->info_heading) }}"
                    class="w-full px-4 py-2 border rounded-lg" required>
            </div>

            <!-- Benefits -->
            <div class="bg-gray-50 p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-4">Benefits (3 Items)</h2>
                <div id="benefits-container">
                    @foreach (old('benefits', $section->benefits ?? []) as $i => $benefit)
                        <div class="benefit-item border p-4 rounded mb-4 flex gap-4 items-start">
                            <select name="benefits[{{ $i }}][icon]" class="px-3 py-2 border rounded">
                                <option value="fa-chart-line"
                                    {{ ($benefit['icon'] ?? '') === 'fa-chart-line' ? 'selected' : '' }}>Chart Line</option>
                                <option value="fa-clock" {{ ($benefit['icon'] ?? '') === 'fa-clock' ? 'selected' : '' }}>
                                    Clock</option>
                                <option value="fa-hand-holding-usd"
                                    {{ ($benefit['icon'] ?? '') === 'fa-hand-holding-usd' ? 'selected' : '' }}>Money
                                </option>
                            </select>
                            <div class="flex-1">
                                <input type="text" name="benefits[{{ $i }}][title]" placeholder="Title"
                                    value="{{ $benefit['title'] ?? '' }}" class="w-full px-3 py-2 border rounded mb-2"
                                    required>
                                <textarea name="benefits[{{ $i }}][description]" placeholder="Description" rows="2"
                                    class="w-full px-3 py-2 border rounded" required>{{ $benefit['description'] ?? '' }}</textarea>
                            </div>
                            <button type="button" class="text-red-600 remove-benefit">Remove</button>
                        </div>
                    @endforeach
                </div>
                <button type="button" id="add-benefit" class="mt-2 text-primary-700 hover:underline">+ Add Benefit</button>
            </div>

            <!-- Expectations -->
            <div class="bg-gray-50 p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-4">What to Expect</h2>
                <input type="text" name="expect_heading" value="{{ old('expect_heading', $section->expect_heading) }}"
                    class="w-full px-4 py-2 border rounded-lg mb-4" required>

                <div id="expectations-container">
                    @foreach (old('expectations', $section->expectations ?? []) as $i => $exp)
                        <div class="flex gap-3 mb-3">
                            <input type="text" name="expectations[{{ $i }}][text]"
                                value="{{ $exp['text'] ?? '' }}" class="flex-1 px-3 py-2 border rounded"
                                placeholder="e.g. 30-minute consultation" required>
                            <button type="button" class="text-red-600 remove-expect">Remove</button>
                        </div>
                    @endforeach
                </div>
                <button type="button" id="add-expect" class="mt-2 text-primary-700 hover:underline">+ Add Item</button>
            </div>

            <!-- Contact Info -->
            <div class="bg-gray-50 p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-4">Contact Info</h2>
                <input type="text" name="contact_heading"
                    value="{{ old('contact_heading', $section->contact_heading) }}"
                    class="w-full px-4 py-2 border rounded-lg mb-3" required>
                <textarea name="contact_description" rows="2" class="w-full px-4 py-2 border rounded-lg mb-3" required>{{ old('contact_description', $section->contact_description) }}</textarea>
                <input type="text" name="phone" value="{{ old('phone', $section->phone) }}"
                    class="w-full px-4 py-2 border rounded-lg mb-3" required>
                <input type="email" name="email" value="{{ old('email', $section->email) }}"
                    class="w-full px-4 py-2 border rounded-lg" required>
            </div>

            <button type="submit"
                class="w-full bg-primary-700 text-white py-3 rounded-lg font-semibold hover:bg-primary-800">
                Save Changes
            </button>
        </form>
    </div>

    <script>
        // Add Benefit
        document.getElementById('add-benefit').onclick = function() {
            const container = document.getElementById('benefits-container');
            const index = container.children.length;
            const html = `
            <div class="benefit-item border p-4 rounded mb-4 flex gap-4 items-start">
                <select name="benefits[${index}][icon]" class="px-3 py-2 border rounded">
                    <option value="fa-chart-line">Chart Line</option>
                    <option value="fa-clock">Clock</option>
                    <option value="fa-hand-holding-usd">Money</option>
                </select>
                <div class="flex-1">
                    <input type="text" name="benefits[${index}][title]" placeholder="Title" class="w-full px-3 py-2 border rounded mb-2" required>
                    <textarea name="benefits[${index}][description]" placeholder="Description" rows="2" class="w-full px-3 py-2 border rounded" required></textarea>
                </div>
                <button type="button" class="text-red-600 remove-benefit">Remove</button>
            </div>`;
            container.insertAdjacentHTML('beforeend', html);
        };

        // Add Expectation
        document.getElementById('add-expect').onclick = function() {
            const container = document.getElementById('expectations-container');
            const index = container.children.length;
            const html = `
            <div class="flex gap-3 mb-3">
                <input type="text" name="expectations[${index}][text]" class="flex-1 px-3 py-2 border rounded" placeholder="e.g. 30-minute consultation" required>
                <button type="button" class="text-red-600 remove-expect">Remove</button>
            </div>`;
            container.insertAdjacentHTML('beforeend', html);
        };

        // Remove handlers
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-benefit')) {
                e.target.closest('.benefit-item').remove();
            }
            if (e.target.classList.contains('remove-expect')) {
                e.target.closest('div').remove();
            }
        });
    </script>
@endsection
