@extends('layouts.admin')
@section('title', 'Loan Calculator Management')
@section('breadcrumbs')
    <nav class="flex items-center space-x-2">
        <a href="{{ route('management.dashboard.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Website Management</a>
        <span class="text-gray-400">/</span>
        <span class="text-sm text-gray-500">Loan Calculator</span>
    </nav>
@endsection
@section('page-icon')
    <i class="fas fa-users fa-lg text-gray-700"></i>
@endsection
@section('page-title')
    <h1 class="text-2xl font-bold text-gray-900">Loan Calculator</h1>
@endsection
@section('content')
    <div class="max-w-7xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-8">Edit Loan Calculator</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-6">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.calculator.update', $calc) }}" method="POST" class="space-y-8">
            @csrf @method('PUT')

            <!-- Hero -->
            <div class="border p-6 rounded-lg bg-gray-50 space-y-4">
                <h3 class="text-xl font-semibold">Hero Section</h3>
                <x-input name="hero_title" label="Title" :value="old('hero_title', $calc->hero_title)" />
                <x-textarea name="hero_description" label="Description" rows="3" :value="old('hero_description', $calc->hero_description)" />
            </div>

            <!-- Quick Stats -->
            <div class="border p-6 rounded-lg bg-gray-50 space-y-4">
                <h3 class="text-xl font-semibold">Quick Stats</h3>
                <x-input name="stat_loan_range" label="Loan Range" :value="old('stat_loan_range', $calc->stat_loan_range)" />
                <x-input name="stat_interest_rates" label="Interest Rates" :value="old('stat_interest_rates', $calc->stat_interest_rates)" />
                <x-input name="stat_loan_terms" label="Loan Terms" :value="old('stat_loan_terms', $calc->stat_loan_terms)" />
                <x-input name="stat_payment_options" label="Payment Options" :value="old('stat_payment_options', $calc->stat_payment_options)" />
            </div>

            <!-- Calculator Settings -->
            <div class="border p-6 rounded-lg bg-gray-50 space-y-4">
                <h3 class="text-xl font-semibold">Calculator Settings</h3>
                <div class="grid md:grid-cols-3 gap-4">
                    <x-input name="min_amount" label="Min Amount" type="number" :value="old('min_amount', $calc->min_amount)" />
                    <x-input name="max_amount" label="Max Amount" type="number" :value="old('max_amount', $calc->max_amount)" />
                    <x-input name="default_amount" label="Default Amount" type="number" :value="old('default_amount', $calc->default_amount)" />
                </div>
                <div class="grid md:grid-cols-3 gap-4">
                    <x-input name="min_rate" label="Min Rate (%)" type="number" step="0.01" :value="old('min_rate', $calc->min_rate)" />
                    <x-input name="max_rate" label="Max Rate (%)" type="number" step="0.01" :value="old('max_rate', $calc->max_rate)" />
                    <x-input name="default_rate" label="Default Rate (%)" type="number" step="0.01"
                        :value="old('default_rate', $calc->default_rate)" />
                </div>
                <div class="grid md:grid-cols-3 gap-4">
                    <x-input name="min_days" label="Min Days" type="number" :value="old('min_days', $calc->min_days)" />
                    <x-input name="max_days" label="Max Days" type="number" :value="old('max_days', $calc->max_days)" />
                    <x-input name="default_days" label="Default Days" type="number" :value="old('default_days', $calc->default_days)" />
                </div>
                <div class="grid md:grid-cols-3 gap-4">
                    <x-input name="min_months" label="Min Months" type="number" :value="old('min_months', $calc->min_months)" />
                    <x-input name="max_months" label="Max Months" type="number" :value="old('max_months', $calc->max_months)" />
                    <x-input name="default_months" label="Default Months" type="number" :value="old('default_months', $calc->default_months)" />
                </div>
            </div>

            <!-- Payment Schedules -->
            <div class="border p-6 rounded-lg bg-gray-50">
                <h3 class="text-xl font-semibold mb-4">Payment Schedules</h3>
                <div id="schedule-container">
                    @foreach ($calc->payment_schedules as $i => $sched)
                        <div class="flex gap-4 mb-2">
                            <x-input name="schedule_days_{{ $i }}" label="Days/Week" type="number"
                                min="1" max="7" :value="old('schedule_days_' . $i, $sched['days'])" class="w-32" />
                            <x-input name="schedule_label_{{ $i }}" label="Label" :value="old('schedule_label_' . $i, $sched['label'])"
                                class="flex-1" />
                            <button type="button" class="text-red-600 remove-schedule">Remove</button>
                        </div>
                    @endforeach
                </div>
                <button type="button" id="add-schedule" class="text-sm text-blue-600">+ Add Schedule</button>
            </div>

            <!-- CTA -->
            <div class="border p-6 rounded-lg bg-gray-50 space-y-4">
                <h3 class="text-xl font-semibold">Call to Action</h3>
                <x-input name="cta_heading" label="Heading" :value="old('cta_heading', $calc->cta_heading)" />
                <x-textarea name="cta_description" label="Description" rows="3" :value="old('cta_description', $calc->cta_description)" />
                <x-input name="cta_apply_text" label="Apply Button Text" :value="old('cta_apply_text', $calc->cta_apply_text)" />
                <x-input name="cta_apply_url" label="Apply URL" :value="old('cta_apply_url', $calc->cta_apply_url)" />
                <x-input name="cta_contact_text" label="Contact Button Text" :value="old('cta_contact_text', $calc->cta_contact_text)" />
                <x-input name="cta_contact_url" label="Contact URL" :value="old('cta_contact_url', $calc->cta_contact_url)" />
            </div>

            <button type="submit" class="bg-primary text-white px-8 py-3 rounded-lg font-bold">Save Calculator</button>
        </form>
    </div>

    <script>
        let scheduleIndex = {{ count($calc->payment_schedules) }};
        document.getElementById('add-schedule').addEventListener('click', () => {
            const html = `<div class="flex gap-4 mb-2">
        <input type="number" name="schedule_days_${scheduleIndex}" placeholder="Days" min="1" max="7" class="border rounded p-2 w-32">
        <input type="text" name="schedule_label_${scheduleIndex}" placeholder="Label" class="border rounded p-2 flex-1">
        <button type="button" class="text-red-600 remove-schedule">Remove</button>
    </div>`;
            document.getElementById('schedule-container').insertAdjacentHTML('beforeend', html);
            scheduleIndex++;
        });
        document.addEventListener('click', e => {
            if (e.target.classList.contains('remove-schedule')) {
                e.target.parentElement.remove();
            }
        });
    </script>
@endsection
