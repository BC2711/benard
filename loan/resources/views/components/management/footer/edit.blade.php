@extends('layouts.admin.main')
@section('title', 'Footer Management')
@section('breadcrumbs')
    <nav class="flex items-center space-x-2">
        <a href="{{ route('management.dashboard') }}" class="text-sm text-gray-500 hover:text-gray-700">Website Management</a>
        <span class="text-gray-400">/</span>
        <span class="text-sm text-gray-500">Footer</span>
    </nav>
@endsection
@section('page-icon')
    <i class="fas fa-users fa-lg text-gray-700"></i>
@endsection
@section('page-title')
    <h1 class="text-2xl font-bold text-gray-900">Footer</h1>
@endsection
@section('content')
    <div class="max-w-8xl mx-auto p-6 rounded-lg bg-white">
        <h1 class="text-3xl font-bold mb-8">Edit Footer</h1>

        <form action="{{ route('management.footer.update', $footer) }}" method="POST" class="space-y-8">
            @csrf @method('PUT')

            <!-- Brand -->
            <div class="border p-6 rounded-lg bg-gray-50 space-y-4">
                <h3 class="text-xl font-semibold">Brand Info</h3>
                <x-input name="brand_name" label="Brand Name" :value="old('brand_name', $footer->brand_name)" />
                <x-input name="brand_tagline" label="Tagline" :value="old('brand_tagline', $footer->brand_tagline)" />
                <x-textarea name="brand_description" label="Description" rows="3" :value="old('brand_description', $footer->brand_description)" />
                <x-input name="email" label="Email" type="email" :value="old('email', $footer->email)" />
                <x-input name="phone" label="Phone" :value="old('phone', $footer->phone)" />
                <x-input name="address_line1" label="Address Line 1" :value="old('address_line1', $footer->address_line1)" />
                <x-input name="address_line2" label="Address Line 2" :value="old('address_line2', $footer->address_line2)" />
            </div>

            <!-- Social Links -->
            <div class="border p-6 rounded-lg bg-gray-50 space-y-4">
                <h3 class="text-xl font-semibold">Social Links</h3>
                <x-input name="facebook" label="Facebook" type="text" :value="old('facebook', $footer->facebook)" />
                <x-input name="twitter" label="Twitter" type="text" :value="old('twitter', $footer->twitter)" />
                <x-input name="linkedin" label="LinkedIn" type="text" :value="old('linkedin', $footer->linkedin)" />
                <x-input name="instagram" label="Instagram" type="text" :value="old('instagram', $footer->instagram)" />
            </div>

            <!-- Quick Links -->
            <div class="border p-6 rounded-lg bg-gray-50">
                <h3 class="text-xl font-semibold mb-4">Quick Links</h3>
                <div id="quick-container">
                    @foreach ($footer->quick_links as $i => $link)
                        <div class="flex gap-4 mb-2">
                            <x-input name="quick_text_{{ $i }}" label="Text" :value="old('quick_text_' . $i, $link['text'])"
                                class="flex-1" />
                            <x-input name="quick_url_{{ $i }}" label="URL" :value="old('quick_url_' . $i, $link['url'])"
                                class="flex-1" />
                            <button type="button" class="text-red-600 remove-quick">Remove</button>
                        </div>
                    @endforeach
                </div>
                <button type="button" id="add-quick" class="text-sm text-blue-600">+ Add Link</button>
            </div>

            <!-- Resources -->
            <div class="border p-6 rounded-lg bg-gray-50">
                <h3 class="text-xl font-semibold mb-4">Resources</h3>
                <div id="resource-container">
                    @foreach ($footer->resources as $i => $res)
                        <div class="flex gap-4 mb-2">
                            <x-input name="resource_text_{{ $i }}" label="Text" :value="old('resource_text_' . $i, $res['text'])"
                                class="flex-1" />
                            <x-input name="resource_url_{{ $i }}" label="URL" :value="old('resource_url_' . $i, $res['url'])"
                                class="flex-1" />
                            <button type="button" class="text-red-600 remove-resource">Remove</button>
                        </div>
                    @endforeach
                </div>
                <button type="button" id="add-resource" class="text-sm text-blue-600">+ Add Resource</button>
            </div>

            <!-- Newsletter -->
            <div class="border p-6 rounded-lg bg-gray-50 space-y-4">
                <h3 class="text-xl font-semibold">Newsletter</h3>
                <x-input name="newsletter_heading" label="Heading" :value="old('newsletter_heading', $footer->newsletter_heading)" />
                <x-textarea name="newsletter_description" label="Description" rows="3" :value="old('newsletter_description', $footer->newsletter_description)" />
            </div>

            <!-- Trust Badges -->
            <div class="border p-6 rounded-lg bg-gray-50">
                <h3 class="text-xl font-semibold mb-4">Trust Badges</h3>
                <div id="trust-container">
                    @foreach ($footer->trust_badges as $i => $badge)
                        <div class="flex gap-4 mb-2">
                            <x-input name="trust_icon_{{ $i }}" label="Icon" :value="old('trust_icon_' . $i, $badge['icon'])"
                                class="w-32" />
                            <x-input name="trust_text_{{ $i }}" label="Text" :value="old('trust_text_' . $i, $badge['text'])"
                                class="flex-1" />
                            <button type="button" class="text-red-600 remove-trust">Remove</button>
                        </div>
                    @endforeach
                </div>
                <button type="button" id="add-trust" class="text-sm text-blue-600">+ Add Badge</button>
            </div>

            <!-- Legal Links -->
            <div class="border p-6 rounded-lg bg-gray-50">
                <h3 class="text-xl font-semibold mb-4">Legal Links</h3>
                <div id="legal-container">
                    @foreach ($footer->legal_links as $i => $link)
                        <div class="flex gap-4 mb-2">
                            <x-input name="legal_text_{{ $i }}" label="Text" :value="old('legal_text_' . $i, $link['text'])"
                                class="flex-1" />
                            <x-input name="legal_url_{{ $i }}" label="URL" :value="old('legal_url_' . $i, $link['url'])"
                                class="flex-1" />
                            <button type="button" class="text-red-600 remove-legal">Remove</button>
                        </div>
                    @endforeach
                </div>
                <button type="button" id="add-legal" class="text-sm text-blue-600">+ Add Link</button>
            </div>

            <!-- Copyright -->
            <div class="border p-6 rounded-lg bg-gray-50 space-y-4">
                <h3 class="text-xl font-semibold">Copyright</h3>
                <x-input name="copyright_text" label="Copyright Text" :value="old('copyright_text', $footer->copyright_text)" />
                <x-input name="footer_note" label="Footer Note" :value="old('footer_note', $footer->footer_note)" />
            </div>

            <button type="submit" class="bg-primary-primary text-white px-8 py-3 rounded-lg font-bold">Save
                Footer</button>
        </form>
    </div>

    <script>
        let quickIndex = {{ count($footer->quick_links) }};
        let resourceIndex = {{ count($footer->resources) }};
        let trustIndex = {{ count($footer->trust_badges) }};
        let legalIndex = {{ count($footer->legal_links) }};

        document.getElementById('add-quick').addEventListener('click', () => {
            const html = `<div class="flex gap-4 mb-2">
        <input type="text" name="quick_text_${quickIndex}" placeholder="Link Text" class="border rounded p-2 flex-1">
        <input type="text" name="quick_url_${quickIndex}" placeholder="https://..." class="border rounded p-2 flex-1">
        <button type="button" class="text-red-600 remove-quick">Remove</button>
    </div>`;
            document.getElementById('quick-container').insertAdjacentHTML('beforeend', html);
            quickIndex++;
        });

        document.getElementById('add-resource').addEventListener('click', () => {
            const html = `<div class="flex gap-4 mb-2">
        <input type="text" name="resource_text_${resourceIndex}" placeholder="Text" class="border rounded p-2 flex-1">
        <input type="text" name="resource_url_${resourceIndex}" placeholder="https://..." class="border rounded p-2 flex-1">
        <button type="button" class="text-red-600 remove-resource">Remove</button>
    </div>`;
            document.getElementById('resource-container').insertAdjacentHTML('beforeend', html);
            resourceIndex++;
        });

        document.getElementById('add-trust').addEventListener('click', () => {
            const html = `<div class="flex gap-4 mb-2">
        <input type="text" name="trust_icon_${trustIndex}" placeholder="fa-shield-alt" class="border rounded p-2 w-32">
        <input type="text" name="trust_text_${trustIndex}" placeholder="SSL Secure" class="border rounded p-2 flex-1">
        <button type="button" class="text-red-600 remove-trust">Remove</button>
    </div>`;
            document.getElementById('trust-container').insertAdjacentHTML('beforeend', html);
            trustIndex++;
        });

        document.getElementById('add-legal').addEventListener('click', () => {
            const html = `<div class="flex gap-4 mb-2">
        <input type="text" name="legal_text_${legalIndex}" placeholder="Privacy Policy" class="border rounded p-2 flex-1">
        <input type="text" name="legal_url_${legalIndex}" placeholder="https://..." class="border rounded p-2 flex-1">
        <button type="button" class="text-red-600 remove-legal">Remove</button>
    </div>`;
            document.getElementById('legal-container').insertAdjacentHTML('beforeend', html);
            legalIndex++;
        });

        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('remove-quick') || e.target.classList.contains('remove-resource') ||
                e.target.classList.contains('remove-trust') || e.target.classList.contains('remove-legal')) {
                e.target.parentElement.remove();
            }
        });
    </script>
@endsection
