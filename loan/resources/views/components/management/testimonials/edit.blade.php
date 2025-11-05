@extends('layouts.admin.main')

@section('content')
    <div class="max-w-8xl mx-auto p-6 rounded-lg bg-white">
        <h1 class="text-3xl font-bold mb-8">Edit Testimonials Section</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-6">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
                <strong class="font-semibold">Please fix the following errors:</strong>
                <ul class="list-disc list-inside mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 text-red-700 p-4 rounded mb-6">{{ session('error') }}</div>
        @endif

        <form action="{{ route('management.testimonial.update', $section->id) }}" method="POST" class="space-y-8"
            enctype="multipart/form-data" id="testimonial-form">
            @csrf @method('PUT')

            <!-- Header -->
            <x-input name="heading" label="Main Heading" :value="old('heading', $section->heading)" />
            @error('heading')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror

            <x-textarea name="description" label="Description" rows="3" :value="old('description', $section->description)" />
            @error('description')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror

            <!-- Video Highlight -->
            <div class="border p-6 rounded-lg bg-gray-50 space-y-4">
                <h3 class="text-xl font-semibold">Video Testimonial</h3>

                <x-input name="video_title" label="Title" :value="old('video_title', $section->video_title)" />
                @error('video_title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

                <x-textarea name="video_description" label="Description" rows="2" :value="old('video_description', $section->video_description)" />
                @error('video_description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

                <!-- Background Image Upload -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Background Image</label>
                    @if ($section->video_image_path)
                        <img src="{{ asset('storage/' . $section->video_image_path) }}" alt="Current"
                            class="h-40 w-auto rounded-lg object-cover mb-2 shadow">
                    @elseif($section->video_image)
                        <img src="{{ $section->video_image }}" alt="Current URL"
                            class="h-40 w-auto rounded-lg object-cover mb-2 shadow">
                    @endif
                    <input type="file" name="video_image_upload" accept="image/*"
                        class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-primary-primary file:text-white hover:file:bg-primary-600">
                    <p class="text-xs text-gray-500 mt-1">Or keep URL: <code
                            class="bg-gray-100 px-1 rounded">{{ $section->video_image }}</code></p>
                    @error('video_image_upload')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Video File Upload -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Video File (MP4, MOV, AVI, WebM - Max
                        10MB)</label>
                    @if ($section->video_file_path)
                        <div class="relative">
                            <video controls class="h-40 w-full rounded-lg shadow mb-2">
                                <source src="{{ asset('storage/' . $section->video_file_path) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                            <div class="absolute top-2 right-2 bg-green-500 text-white text-xs px-2 py-1 rounded">
                                Current Video
                            </div>
                        </div>
                    @elseif($section->video_url)
                        <div
                            class="bg-gray-200 border-2 border-dashed rounded-xl p-4 text-center text-sm text-gray-600 mb-2">
                            <div class="flex items-center justify-center space-x-2">
                                <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" />
                                </svg>
                                <span>External video: <code
                                        class="bg-gray-100 px-2 py-1 rounded">{{ $section->video_url }}</code></span>
                            </div>
                        </div>
                    @endif
                    <input type="file" name="video_file_upload"
                        accept="video/mp4,video/quicktime,video/x-m4v,video/avi,video/webm"
                        class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-primary-600"
                        id="video-file-input">
                    <p class="text-xs text-gray-500 mt-1">Or keep YouTube/Vimeo URL: <code
                            class="bg-gray-100 px-1 rounded">{{ $section->video_url }}</code></p>
                    @error('video_file_upload')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <div id="video-file-error" class="text-red-500 text-xs mt-1 hidden"></div>
                    <div id="video-file-info" class="text-blue-500 text-xs mt-1 hidden"></div>
                </div>
            </div>

            <!-- Stats -->
            <div class="border p-6 rounded-lg bg-gray-50 space-y-4">
                <h3 class="text-xl font-semibold">Trust Stats (4)</h3>
                @for ($i = 0; $i < 4; $i++)
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <x-input name="stat_value_{{ $i }}" label="Value" :value="old('stat_value_' . $i, $section->stats[$i]['value'] ?? '')" />
                            @error("stat_value_{$i}")
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <x-input name="stat_label_{{ $i }}" label="Label" :value="old('stat_label_' . $i, $section->stats[$i]['label'] ?? '')" />
                            @error("stat_label_{$i}")
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                @endfor
            </div>

            <!-- Testimonials -->
            <div class="space-y-6">
                <h3 class="text-xl font-semibold">Testimonials</h3>
                <div id="testimonials-container">
                    @foreach ($section->testimonials as $i => $t)
                        <div class="border p-6 rounded-lg bg-gray-50 mb-4 testimonial-item">
                            <div class="grid md:grid-cols-2 gap-4">
                                <div>
                                    <x-input name="testimonial_name_{{ $i }}" label="Name"
                                        :value="old('testimonial_name_' . $i, $t['name'])" />
                                    @error("testimonial_name_{$i}")
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <x-input name="testimonial_role_{{ $i }}" label="Role/Company"
                                        :value="old('testimonial_role_' . $i, $t['role'])" />
                                    @error("testimonial_role_{$i}")
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Avatar Upload -->
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700">Avatar</label>
                                    @if (isset($t['image']) && \Illuminate\Support\Str::startsWith($t['image'], 'testimonials/avatars'))
                                        <img src="{{ asset('storage/' . $t['image']) }}" alt="{{ $t['name'] }}"
                                            class="w-16 h-16 rounded-full object-cover mb-2 shadow">
                                    @elseif(isset($t['image']) && filter_var($t['image'], FILTER_VALIDATE_URL))
                                        <img src="{{ $t['image'] }}" alt="{{ $t['name'] }}"
                                            class="w-16 h-16 rounded-full object-cover mb-2 shadow">
                                    @endif
                                    <input type="file" name="testimonial_image_upload_{{ $i }}"
                                        accept="image/*"
                                        class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-primary-600">
                                    <p class="text-xs text-gray-500 mt-1">Or keep URL: <code
                                            class="bg-gray-100 px-1 rounded">{{ $t['image'] ?? '' }}</code></p>
                                    @error("testimonial_image_upload_{$i}")
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <x-select name="testimonial_rating_{{ $i }}" label="Rating"
                                        :options="[1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5]" :selected="old('testimonial_rating_' . $i, $t['rating'] ?? 5)" />
                                    @error("testimonial_rating_{$i}")
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <x-textarea name="testimonial_quote_{{ $i }}" label="Quote" rows="4"
                                    :value="old('testimonial_quote_' . $i, $t['quote'])" />
                                @error("testimonial_quote_{$i}")
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="button" class="text-red-600 text-sm mt-2 remove-testimonial">Remove
                                Testimonial</button>
                        </div>
                    @endforeach
                </div>
                <button type="button" id="add-testimonial"
                    class="bg-primary text-white px-4 py-2 rounded hover:bg-primary-600 transition">+ Add
                    Testimonial</button>
            </div>

            <!-- CTA -->
            <div class="border p-6 rounded-lg bg-gray-50 space-y-4">
                <h3 class="text-xl font-semibold">Bottom CTA</h3>

                <x-input name="cta_heading" label="Heading" :value="old('cta_heading', $section->cta_heading)" />
                @error('cta_heading')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

                <x-textarea name="cta_description" label="Description" rows="2" :value="old('cta_description', $section->cta_description)" />
                @error('cta_description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

                <div class="grid md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <x-input name="cta_primary_text" label="Primary Button Text" :value="old('cta_primary_text', $section->cta_primary_text)" />
                        @error('cta_primary_text')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror

                        <x-input name="cta_primary_link" label="Primary Link" type="text" :value="old('cta_primary_link', $section->cta_primary_link)" />
                        @error('cta_primary_link')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror

                        <x-input name="cta_primary_icon" label="Primary Icon (e.g. fa-paper-plane)" :value="old('cta_primary_icon', $section->cta_primary_icon)" />
                        @error('cta_primary_icon')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="space-y-4">
                        <x-input name="cta_secondary_text" label="Secondary Button Text" :value="old('cta_secondary_text', $section->cta_secondary_text)" />
                        @error('cta_secondary_text')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror

                        <x-input name="cta_secondary_link" label="Secondary Link" type="text" :value="old('cta_secondary_link', $section->cta_secondary_link)" />
                        @error('cta_secondary_link')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror

                        <x-input name="cta_secondary_icon" label="Secondary Icon (e.g. fa-star)" :value="old('cta_secondary_icon', $section->cta_secondary_icon)" />
                        @error('cta_secondary_icon')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <button type="submit"
                class="bg-primary-primary text-white px-8 py-3 rounded-lg font-bold hover:bg-primary-600 transition">Save
                Changes</button>
        </form>
    </div>

    <script>
        let testimonialIndex = {{ count($section->testimonials) }};

        // Video file validation
        document.getElementById('video-file-input').addEventListener('change', function(e) {
            const file = this.files[0];
            const errorDiv = document.getElementById('video-file-error');
            const infoDiv = document.getElementById('video-file-info');

            // Reset messages
            errorDiv.classList.add('hidden');
            infoDiv.classList.add('hidden');

            if (file) {
                // Show file info
                const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);
                infoDiv.textContent = `Selected: ${file.name} (${fileSizeMB} MB)`;
                infoDiv.classList.remove('hidden');

                // Check file size (10MB in bytes)
                if (file.size > 10 * 1024 * 1024) {
                    errorDiv.textContent = 'File size must be less than 10MB';
                    errorDiv.classList.remove('hidden');
                    infoDiv.classList.add('hidden');
                    this.value = ''; // Clear the file input
                    return;
                }

                // Check file type
                const validTypes = [
                    'video/mp4',
                    'video/quicktime',
                    'video/x-m4v',
                    'video/avi',
                    'video/webm',
                    'video/mp4v-es'
                ];

                if (!validTypes.includes(file.type) && !file.name.toLowerCase().match(
                    /\.(mp4|mov|avi|m4v|webm)$/)) {
                    errorDiv.textContent = 'Please select a valid video file (MP4, MOV, AVI, WebM)';
                    errorDiv.classList.remove('hidden');
                    infoDiv.classList.add('hidden');
                    this.value = ''; // Clear the file input
                }
            }
        });

        // Form submission handler to prevent double submission
        document.getElementById('testimonial-form').addEventListener('submit', function(e) {
            const submitButton = this.querySelector('button[type="submit"]');
            submitButton.disabled = true;
            submitButton.innerHTML = 'Saving... <i class="fas fa-spinner fa-spin ml-2"></i>';

            // You can add additional validation here if needed
        });

        // Testimonial management
        document.getElementById('add-testimonial').addEventListener('click', function() {
            const container = document.getElementById('testimonials-container');
            const html = `
                <div class="border p-6 rounded-lg bg-gray-50 mb-4 testimonial-item">
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                            <input type="text" name="testimonial_name_${testimonialIndex}" placeholder="Name" class="w-full border rounded p-2 text-sm" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Role/Company</label>
                            <input type="text" name="testimonial_role_${testimonialIndex}" placeholder="Role/Company" class="w-full border rounded p-2 text-sm" required>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Avatar</label>
                            <input type="file" name="testimonial_image_upload_${testimonialIndex}" accept="image/*" class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-primary-600">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Rating</label>
                            <select name="testimonial_rating_${testimonialIndex}" class="w-full border rounded p-2 text-sm">
                                <option value="5">5 Stars</option>
                                <option value="4">4 Stars</option>
                                <option value="3">3 Stars</option>
                                <option value="2">2 Stars</option>
                                <option value="1">1 Star</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Quote</label>
                        <textarea name="testimonial_quote_${testimonialIndex}" placeholder="Quote" rows="4" class="w-full border rounded p-2 text-sm" required></textarea>
                    </div>
                    <button type="button" class="text-red-600 text-sm mt-2 remove-testimonial">Remove Testimonial</button>
                </div>`;
            container.insertAdjacentHTML('beforeend', html);
            testimonialIndex++;
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-testimonial')) {
                e.target.closest('.testimonial-item').remove();
            }
        });
    </script>
@endsection
