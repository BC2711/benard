@extends('layouts.admin')

@section('content')
    <div class="max-w-7xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-8">Edit Team Section</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-6">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.team.update', $team) }}" method="POST" class="space-y-8">
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
                        <x-input name="cta_primary_link" label="Primary Link" type="url" :value="old('cta_primary_link', $team->cta_primary_link)" />
                        <x-input name="cta_primary_icon" label="Primary Icon" :value="old('cta_primary_icon', $team->cta_primary_icon)" />
                    </div>
                    <div>
                        <x-input name="cta_secondary_text" label="Secondary Button Text" :value="old('cta_secondary_text', $team->cta_secondary_text)" />
                        <x-input name="cta_secondary_link" label="Secondary Link" type="url" :value="old('cta_secondary_link', $team->cta_secondary_link)" />
                        <x-input name="cta_secondary_icon" label="Secondary Icon" :value="old('cta_secondary_icon', $team->cta_secondary_icon)" />
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
                                <x-input name="member_name_{{ $i }}" label="Name" :value="old('member_name_' . $i, $member['name'])" />
                                <x-input name="member_role_{{ $i }}" label="Role" :value="old('member_role_' . $i, $member['role'])" />
                                <x-textarea name="member_bio_{{ $i }}" label="Bio" rows="2"
                                    :value="old('member_bio_' . $i, $member['bio'])" />
                                <x-input name="member_image_{{ $i }}" label="Image URL" :value="old('member_image_' . $i, $member['image'])" />
                            </div>

                            <div class="mt-4 space-y-2" id="social-{{ $i }}">
                                @foreach ($member['social'] as $j => $link)
                                    <div class="flex gap-2 social-row">
                                        <x-input name="member_social_icon_{{ $i }}[]"
                                            placeholder="fa-linkedin-in" :value="old('member_social_icon_' . $i . '.' . $j, $link['icon'])" class="w-32" />
                                        <x-input name="member_social_url_{{ $i }}[]" placeholder="https://..."
                                            :value="old('member_social_url_' . $i . '.' . $j, $link['url'])" />
                                        <x-select name="member_social_color_{{ $i }}[]" :options="['primary' => 'Primary', 'accent' => 'Accent']"
                                            :selected="old('member_social_color_' . $i . '.' . $j, $link['color'])" class="w-32" />
                                        <button type="button" class="text-red-600 remove-social">Remove</button>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" class="text-sm text-blue-600 add-social"
                                data-index="{{ $i }}">+ Add Social</button>
                            <button type="button" class="text-red-600 text-sm mt-2 remove-member">Remove Member</button>
                        </div>
                    @endforeach
                </div>
                <button type="button" id="add-member" class="bg-primary text-white px-4 py-2 rounded">+ Add Member</button>
            </div>

            <button type="submit" class="bg-primary text-white px-8 py-3 rounded-lg font-bold">Save Changes</button>
        </form>
    </div>

    <script>
        let memberIndex = {{ count($team->members) }};

        document.getElementById('add-member').addEventListener('click', function() {
            const container = document.getElementById('members-container');
            const html = `
        <div class="border p-6 rounded-lg bg-gray-50 mb-4 member-item">
            <div class="grid md:grid-cols-2 gap-4">
                <input type="text" name="member_name_${memberIndex}" placeholder="Name" class="border rounded p-2">
                <input type="text" name="member_role_${memberIndex}" placeholder="Role" class="border rounded p-2">
                <textarea name="member_bio_${memberIndex}" placeholder="Bio" rows="2" class="border rounded p-2"></textarea>
                <input type="url" name="member_image_${memberIndex}" placeholder="Image URL" class="border rounded p-2">
            </div>
            <div class="mt-4 space-y-2" id="social-${memberIndex}"></div>
            <button type="button" class="text-sm text-blue-600 add-social" data-index="${memberIndex}">+ Add Social</button>
            <button type="button" class="text-red-600 text-sm mt-2 remove-member">Remove Member</button>
        </div>`;
            container.insertAdjacentHTML('beforeend', html);
            memberIndex++;
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('add-social')) {
                const idx = e.target.dataset.index;
                const container = document.getElementById(`social-${idx}`);
                const row = document.createElement('div');
                row.className = 'flex gap-2 social-row';
                row.innerHTML = `
            <input type="text" name="member_social_icon_${idx}[]" placeholder="fa-linkedin-in" class="w-32 border rounded p-2">
            <input type="url" name="member_social_url_${idx}[]" placeholder="https://..." class="border rounded p-2 flex-1">
            <select name="member_social_color_${idx}[]" class="w-32 border rounded p-2">
                <option value="primary">Primary</option>
                <option value="accent">Accent</option>
            </select>
            <button type="button" class="text-red-600 remove-social">Remove</button>`;
                container.appendChild(row);
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
