@extends('layouts.admin.main')

@section('title', 'Website Settings')
@section('page-title', 'Website Settings')
@section('page-description', 'Manage global branding, contact details, social links, location, footer text, and business hours.')
@section('page-icon')<i class="fas fa-globe"></i>@endsection

@section('content')
    @php
        $fields = [
            'site' => ['brand_name' => 'Company name', 'tagline' => 'Brand tagline', 'subtitle' => 'Brand subtitle', 'logo' => 'Logo path', 'favicon' => 'Favicon path', 'meta_description' => 'Default meta description', 'consultation_url' => 'Consultation URL', 'copyright' => 'Copyright text', 'footer_content' => 'Footer content'],
            'contact' => ['email' => 'Primary email', 'phone' => 'Phone number', 'address' => 'Physical address', 'map_url' => 'Google Maps URL', 'business_hours' => 'Business hours'],
            'social' => ['facebook' => 'Facebook URL', 'instagram' => 'Instagram URL', 'linkedin' => 'LinkedIn URL', 'twitter' => 'Twitter / X URL', 'youtube' => 'YouTube URL'],
        ];
    @endphp
    <form method="POST" action="{{ route('management.cms.settings.update') }}" class="space-y-6">
        @csrf
        @method('PUT')
        @foreach ($fields as $group => $groupFields)
            <section class="admin-card p-5">
                <h2 class="text-lg font-bold">{{ ucfirst($group) }}</h2>
                <div class="mt-4 grid gap-4 md:grid-cols-2">
                    @foreach ($groupFields as $key => $label)
                        <label>
                            <span class="mb-2 block text-sm font-bold text-slate-600 dark:text-slate-300">{{ $label }}</span>
                            <input name="settings[{{ $group }}][{{ $key }}]" class="admin-input h-11 w-full px-3" value="{{ old("settings.$group.$key", $settings[$group][$key][0] ?? '') }}">
                        </label>
                    @endforeach
                </div>
            </section>
        @endforeach
        <button class="rounded-xl bg-brand-700 px-5 py-3 text-sm font-bold text-white shadow-soft">Save website settings</button>
    </form>
@endsection
