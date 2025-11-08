@extends('layouts.admin.main')
@section('title', 'Team Management')
@section('breadcrumbs')
    <nav class="flex items-center space-x-2">
        <a href="{{ route('management.dashboard.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Website Management</a>
        <span class="text-gray-400">/</span>
        <span class="text-sm text-gray-500">Team</span>
    </nav>
@endsection
@section('page-icon')
    <i class="fas fa-users fa-lg text-gray-700"></i>
@endsection
@section('page-title')
    <h1 class="text-2xl font-bold text-gray-900">Team</h1>
@endsection
@section('content')
    <div class="max-w-8xl mx-auto p-6 bg-white rounded-lg shadow">
        <h1 class="text-3xl font-bold mb-8">Edit Team Section</h1>

        <form action="{{ route('management.team.update', $team) }}" method="POST" enctype="multipart/form-data"
            class="space-y-8">
            @csrf @method('PUT')

            <!-- Header -->
            <x-input name="heading" label="Main Heading" :value="old('heading', $team->heading)" />
            <x-textarea name="description" label="Description" rows="3" :value="old('description', $team->description)" />

            <!-- CTA -->
            <div class="border p-6 rounded-lg bg-gray-50 space-y-4">
                <h3 class="text-xl font-semibold">Bottom CTA</h3>
                <x-input name="cta_heading" label="Heading" :value="old('cta_heading', $team->cta_heading)" />
                <x-textarea name="cta_description" label="Description" rows="2" :value="old('cta_description', $team->cta_description)" />
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <x-input name="cta_primary_text" label="Primary Button Text" :value="old('cta_primary_text', $team->cta_primary_text)" />
                        <x-input name="cta_primary_link" label="Primary Link" type="text" :value="old('cta_primary_link', $team->cta_primary_link)" />
                        <x-input name="cta_primary_icon" label="Primary Icon (fa-...)" :value="old('cta_primary_icon', $team->cta_primary_icon)" />
                    </div>
                    <div>
                        <x-input name="cta_secondary_text" label="Secondary Button Text" :value="old('cta_secondary_text', $team->cta_secondary_text)" />
                        <x-input name="cta_secondary_link" label="Secondary Link" type="text" :value="old('cta_secondary_link', $team->cta_secondary_link)" />
                        <x-input name="cta_secondary_icon" label="Secondary Icon (fa-...)" :value="old('cta_secondary_icon', $team->cta_secondary_icon)" />
                    </div>
                </div>
            </div>

            <!-- Dynamic Team Members -->
            <div class="space-y-6">
                <h3 class="text-xl font-semibold">Team Members</h3>
                <div id="members-container">
                    @foreach ($team->members as $i => $member)
                        <div class="border p-6 rounded-lg bg-gray-50 mb-4 member-item">
                            <div class="grid md:grid-cols-2 gap-4">
                                <x-input name="member_name[]" label="Name" :value="old('member_name.' . $i, $member['name'])" />
                                <x-input name="member_role[]" label="Role" :value="old('member_role.' . $i, $member['role'])" />
                                <x-textarea name="member_bio[]" label="Bio" rows="2" :value="old('member_bio.' . $i, $member['bio'])" />

                                <!-- Image Upload -->
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700">Photo</label>
                                    <input type="hidden" name="member_image_old[]" value="{{ $member['image'] ?? '' }}">
                                    <input type="file" name="member_image[]" accept="image/*"
                                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">

                                    @if ($member['image'] ?? false)
                                        <img src="{{ asset('storage/teams/' . $member['image']) }}"
                                            class="mt-2 w-24 h-24 object-cover rounded-lg shadow" alt="Current">
                                    @endif

                                    <div class="mt-2 hidden preview-container">
                                        <img class="preview-image w-24 h-24 object-cover rounded-lg shadow">
                                    </div>
                                </div>
                            </div>

                            <!-- Social Links -->
                            <div class="mt-4 space-y-2 social-container">
                                @foreach ($member['social'] as $j => $link)
                                    <div class="flex gap-2 social-row">
                                        <x-input name="member_social_icon[{{ $i }}][]"
                                            placeholder="fa-linkedin-in" :value="$link['icon']" class="w-32" />
                                        <x-input name="member_social_url[{{ $i }}][]" placeholder="https://..."
                                            :value="$link['url']" />
                                        <x-select name="member_social_color[{{ $i }}][]" :options="['primary' => 'Primary', 'accent' => 'Accent']"
                                            :selected="$link['color']" class="w-32" />
                                        <button type="button" class="text-red-600 remove-social">Remove</button>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" class="text-sm text-blue-600 add-social">+ Add Social</button>
                            <button type="button" class="text-red-600 text-sm mt-2 remove-member">Remove Member</button>
                        </div>
                    @endforeach
                </div>
                <button type="button" id="add-member" class="bg-primary-700 text-white px-4 py-2 rounded">+ Add
                    Member</button>
            </div>

            <button type="submit" class="bg-primary-700 text-white px-8 py-3 rounded-lg font-bold">Save Changes</button>
        </form>
    </div>

    <script>
        document.getElementById('add-member').addEventListener('click', () => {
            const container = document.getElementById('members-container');
            const index = container.children.length;

            const html = `
        <div class="border p-6 rounded-lg bg-gray-50 mb-4 member-item">
            <div class="grid md:grid-cols-2 gap-4">
                <input type="text" name="member_name[]" placeholder="Name" class="border rounded p-2" required>
                <input type="text" name="member_role[]" placeholder="Role" class="border rounded p-2">
                <textarea name="member_bio[]" placeholder="Bio" rows="2" class="border rounded p-2"></textarea>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Photo</label>
                    <input type="hidden" name="member_image_old[]" value="">
                    <input type="file" name="member_image[]" accept="image/*"
                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
                    <div class="mt-2 hidden preview-container">
                        <img class="preview-image w-24 h-24 object-cover rounded-lg shadow">
                    </div>
                </div>
            </div>
            <div class="mt-4 space-y-2 social-container"></div>
            <button type="button" class="text-sm text-blue-600 add-social">+ Add Social</button>
            <button type="button" class="text-red-600 text-sm mt-2 remove-member">Remove Member</button>
        </div>`;
            container.insertAdjacentHTML('beforeend', html);
        });

        // File preview
        document.addEventListener('change', e => {
            if (e.target.type === 'file' && e.target.name === 'member_image[]') {
                const file = e.target.files[0];
                const container = e.target.closest('.member-item').querySelector('.preview-container');
                const preview = container.querySelector('.preview-image');

                if (file) {
                    const reader = new FileReader();
                    reader.onload = e => {
                        preview.src = e.target.result;
                        container.classList.remove('hidden');
                    };
                    reader.readAsDataURL(file);
                }
            }
        });

        // Social links management
        document.addEventListener('click', e => {
            if (e.target.classList.contains('add-social')) {
                const memberItem = e.target.closest('.member-item');
                const socialContainer = memberItem.querySelector('.social-container');
                const memberIndex = Array.from(document.querySelectorAll('.member-item')).indexOf(memberItem);

                const row = document.createElement('div');
                row.className = 'flex gap-2 social-row';
                row.innerHTML = `
                <input type="text" name="member_social_icon[${memberIndex}][]" placeholder="fa-linkedin-in" class="w-32 border rounded p-2">
                <input type="text" name="member_social_url[${memberIndex}][]" placeholder="https://..." class="border rounded p-2 flex-1">
                <select name="member_social_color[${memberIndex}][]" class="w-32 border rounded p-2">
                    <option value="primary">Primary</option>
                    <option value="accent">Accent</option>
                </select>
                <button type="button" class="text-red-600 remove-social">Remove</button>`;
                socialContainer.appendChild(row);
            }

            if (e.target.classList.contains('remove-social')) {
                e.target.closest('.social-row').remove();
            }

            if (e.target.classList.contains('remove-member')) {
                e.target.closest('.member-item').remove();
            }
        });
    </script>
@endsection
