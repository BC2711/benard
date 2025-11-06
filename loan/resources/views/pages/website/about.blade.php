@extends('layouts.admin.main')

@push('styles')
    <style>
        :root {
            --primary-color: #db9123;
            --secondary-color: #7a4603;
            --white: #ffffff;
            --shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
            --error-color: #e3342f;
            --success-color: #10b981;
        }

        .about-preview-container {
            background: var(--white);
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 2rem;
            box-shadow: var(--shadow);
            border: 1px solid #e5e7eb;
        }

        .about-section {
            padding: clamp(3rem, 5vw, 4rem) 0;
            position: relative;
            overflow: hidden;
            isolation: isolate;
        }

        .about-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 clamp(1rem, 3vw, 2rem);
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: clamp(2rem, 4vw, 3rem);
            align-items: center;
        }

        .about-images {
            position: relative;
            animation: fadeInLeft 0.6s ease-in;
        }

        .about-images-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            align-items: start;
        }

        .about-image-container {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            transition: var(--transition);
        }

        .about-image-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        }

        .about-image {
            width: 100%;
            height: auto;
            display: block;
            transition: var(--transition);
        }

        .about-image--center {
            width: 80%;
            margin: 0 auto;
            grid-column: span 2;
        }

        .shape {
            position: absolute;
            max-width: 80px;
            z-index: 0;
            animation: float 3s ease-in-out infinite;
        }

        .shape--top-left {
            top: -15px;
            left: -15px;
        }

        .shape--top-right {
            top: 10px;
            right: -10px;
            animation-duration: 4s;
        }

        .shape--bottom-left {
            bottom: -10px;
            left: 0;
            animation-duration: 3.5s;
        }

        .about-content {
            animation: fadeInRight 0.6s ease-in;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .about-subheading {
            font-size: clamp(1rem, 2vw, 1.25rem);
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0.75rem;
            letter-spacing: 1px;
        }

        .about-heading {
            font-size: clamp(1.75rem, 3vw, 2.25rem);
            font-weight: 700;
            color: var(--secondary-color);
            line-height: 1.3;
            margin-bottom: 1.5rem;
        }

        .about-description {
            font-size: clamp(0.9rem, 2vw, 1rem);
            color: #666;
            line-height: 1.6;
            margin-bottom: 2rem;
            max-width: 500px;
        }

        .features-list {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .feature-item {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            transition: var(--transition);
            padding: 1rem;
            border-radius: 8px;
        }

        .feature-item:hover {
            background-color: rgba(219, 145, 35, 0.05);
            transform: translateX(5px);
        }

        .feature-icon-container {
            width: 40px;
            height: 40px;
            background-color: var(--primary-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: var(--transition);
        }

        .feature-item:hover .feature-icon-container {
            transform: scale(1.1);
        }

        .feature-icon-container.secondary {
            background-color: var(--secondary-color);
        }

        .feature-icon {
            width: 20px;
            height: 20px;
            filter: brightness(0) invert(1);
        }

        .feature-title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--secondary-color);
            margin-bottom: 0.25rem;
        }

        .feature-description {
            font-size: 0.875rem;
            color: #666;
            line-height: 1.4;
        }

        .stats {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            margin-bottom: 2rem;
            justify-content: flex-start;
        }

        .stat-item {
            text-align: center;
            min-width: 100px;
            padding: 1rem;
            transition: var(--transition);
        }

        .stat-item:hover {
            transform: translateY(-3px);
        }

        .stat-value {
            font-size: clamp(1.5rem, 2vw, 1.75rem);
            font-weight: 700;
            color: var(--primary-color);
            display: block;
        }

        .stat-label {
            font-size: 0.875rem;
            color: #666;
            display: block;
        }

        .video-cta {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            transition: var(--transition);
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: var(--white);
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(219, 145, 35, 0.3);
        }

        .video-cta:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(219, 145, 35, 0.4);
        }

        .video-cta-icon-container {
            width: 48px;
            height: 48px;
            background-color: var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            transition: var(--transition);
        }

        .video-cta-icon-container:hover {
            transform: scale(1.1);
        }

        .video-cta-pulse {
            width: 100%;
            height: 100%;
            background-color: var(--white);
            border-radius: 50%;
            opacity: 0.3;
            position: absolute;
            animation: pulse 2s infinite;
        }

        .video-cta-icon {
            width: 20px;
            height: 20px;
            color: var(--primary-color);
        }

        .video-cta-text {
            font-size: 0.875rem;
            font-weight: 700;
            color: var(--white);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Admin Panel */
        .admin-panel {
            background: var(--white);
            border-radius: 12px;
            padding: clamp(1.5rem, 3vw, 2rem);
            margin: 2rem 0;
            box-shadow: var(--shadow);
            border: 1px solid #e5e7eb;
            display: none;
        }

        .admin-panel.show {
            display: block;
            animation: slideDown 0.3s ease-out;
        }

        .admin-panel h3 {
            color: var(--secondary-color);
            margin-bottom: 1.5rem;
            text-align: center;
            font-size: 1.5rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #374151;
            font-size: 0.95rem;
        }

        .form-control {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 1rem;
            transition: var(--transition);
            background: #fafafa;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            background: var(--white);
            outline: none;
            box-shadow: 0 0 0 3px rgba(219, 145, 35, 0.1);
        }

        .form-control--error {
            border-color: var(--error-color);
            background: #fef2f2;
        }

        .error-message {
            color: var(--error-color);
            font-size: 0.85rem;
            margin-top: 0.375rem;
            display: none;
        }

        .error-message.show {
            display: block;
        }

        .admin-btn {
            padding: 0.875rem 1.75rem;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.95rem;
        }

        .btn-save {
            background: var(--primary-color);
            color: var(--white);
            box-shadow: 0 2px 8px rgba(219, 145, 35, 0.3);
        }

        .btn-save:hover {
            background: var(--secondary-color);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(122, 70, 3, 0.4);
        }

        .btn-cancel {
            background: #6b7280;
            color: var(--white);
        }

        .btn-cancel:hover {
            background: #4b5563;
            transform: translateY(-1px);
        }

        .btn-danger {
            background: #ef4444;
            color: var(--white);
        }

        .btn-danger:hover {
            background: #dc2626;
            transform: translateY(-1px);
        }

        .toggle-admin {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1000;
            background: var(--primary-color);
            color: var(--white);
            border: none;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 4px 20px rgba(219, 145, 35, 0.4);
            transition: var(--transition);
            font-size: 1.25rem;
        }

        .toggle-admin:hover {
            background: var(--secondary-color);
            transform: scale(1.1) rotate(90deg);
            box-shadow: 0 6px 25px rgba(122, 70, 3, 0.5);
        }

        .image-items-container .image-item-row,
        .feature-items-container .feature-item-row,
        .stat-items-container .stat-item-row {
            display: flex;
            gap: 12px;
            align-items: center;
            margin-bottom: 12px;
            padding: 12px;
            background: #f8f9fa;
            border-radius: 8px;
            border: 1px solid #e9ecef;
        }

        .image-item-row .form-control[type="file"] {
            padding: 0.5rem;
        }

        .image-preview {
            margin-top: 0.5rem;
            padding: 1rem;
            background: #f8f9fa;
            border-radius: 8px;
            border: 2px dashed #dee2e6;
        }

        .image-preview img {
            max-height: 120px;
            width: auto;
            border-radius: 6px;
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            align-items: center;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e5e7eb;
        }

        /* Animations */
        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-12px);
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 0.3;
            }

            50% {
                transform: scale(1.15);
                opacity: 0.5;
            }

            100% {
                transform: scale(1);
                opacity: 0.3;
            }
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .about-section {
                padding: 2rem 0;
            }

            .about-container {
                grid-template-columns: 1fr;
            }

            .about-images-grid {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                justify-items: center;
            }

            .shape {
                max-width: 60px;
            }
        }

        @media (max-width: 768px) {
            .about-heading {
                font-size: clamp(1.5rem, 2vw, 1.75rem);
            }

            .about-subheading {
                font-size: 1rem;
            }

            .features-list {
                grid-template-columns: 1fr;
            }

            .stats {
                flex-direction: column;
                align-items: center;
            }

            .shape {
                display: none;
            }

            .about-image--center {
                width: 80%;
            }

            .admin-panel {
                margin: 1.5rem 1rem;
                padding: 1.5rem;
            }

            .image-item-row,
            .feature-item-row,
            .stat-item-row {
                flex-direction: column;
                align-items: stretch;
            }

            .form-actions {
                flex-direction: column;
            }
        }
    </style>
@endpush

@section('breadcrumbs')
    <nav class="flex items-center space-x-2">
        <a href="{{ route('management.dashboard') }}" class="text-sm text-gray-500 hover:text-gray-700">Dashboard</a>
        <span class="text-gray-400">/</span>
        <span class="text-sm text-gray-500">About Section</span>
    </nav>
@endsection
@section('page-icon')
    <i class="fas fa-info-circle fa-lg text-gray-700"></i>
@endsection
@section('page-title')
    <h1 class="text-2xl font-bold text-gray-900">About Section Management</h1>
    <p class="text-gray-600 text-sm mt-1">Customize and manage the about section for your website. Changes
        are reflected in real-time.</p>
@endsection
@section('content')
    <div class="main-content">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div class="flex gap-2">
                    <button
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 flex items-center gap-2"
                        id="previewChanges">
                        <i class="fas fa-eye"></i>
                        Preview
                    </button>
                    <button
                        class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-200 flex items-center gap-2"
                        id="resetToDefault">
                        <i class="fas fa-sync-alt"></i>
                        Reset
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- About Preview -->
    <div class="about-preview-container">
        <section class="about-section" aria-label="About Section Preview">
            <div class="about-container">
                <div class="about-images" id="aboutImages">
                    <!-- Images will be dynamically rendered here -->
                </div>
                <div class="about-content" id="aboutContent">
                    <!-- Content will be dynamically rendered here -->
                </div>
            </div>
        </section>
    </div>

    <!-- Admin Panel -->
    <div class="admin-panel" id="adminPanel" role="dialog" aria-labelledby="adminPanelTitle" aria-modal="true">
        <h3 id="adminPanelTitle">
            <i class="fas fa-edit"></i>
            Manage About Content
        </h3>

        <form id="aboutForm" action="{{ route('management.about-section') }}" method="POST" novalidate
            enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Left Column -->
                <div class="space-y-6">
                    <div class="form-group">
                        <label for="aboutSubheading">Subheading *</label>
                        <input type="text" id="aboutSubheading" name="subheading" class="form-control"
                            value="{{ old('subheading', $aboutData['subheading'] ?? '') }}"
                            placeholder="Enter about section subheading..." required>
                        <span class="error-message" id="aboutSubheadingError"></span>
                    </div>

                    <div class="form-group">
                        <label for="aboutHeading">Heading *</label>
                        <input type="text" id="aboutHeading" name="heading" class="form-control"
                            value="{{ old('heading', $aboutData['heading'] ?? '') }}"
                            placeholder="Enter compelling heading..." required>
                        <span class="error-message" id="aboutHeadingError"></span>
                    </div>

                    <div class="form-group">
                        <label for="aboutDescription">Description *</label>
                        <textarea id="aboutDescription" name="description" class="form-control" rows="4"
                            placeholder="Describe your company..." required>{{ old('description', $aboutData['description'] ?? '') }}</textarea>
                        <span class="error-message" id="aboutDescriptionError"></span>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <div class="form-group">
                        <label for="video_cta_url">Video CTA URL *</label>
                        <input type="url" id="video_cta_url" name="video_cta_url" class="form-control"
                            value="{{ old('video_cta_url', $aboutData['video_cta']['url'] ?? '') }}"
                            placeholder="https://www.youtube.com/watch?v=..." required>
                        <span class="error-message" id="videoCtaUrlError"></span>
                    </div>

                    <div class="form-group">
                        <label for="video_cta_text">Video CTA Text *</label>
                        <input type="text" id="video_cta_text" name="video_cta_text" class="form-control"
                            value="{{ old('video_cta_text', $aboutData['video_cta']['text'] ?? '') }}"
                            placeholder="e.g., Watch Our Story" required>
                        <span class="error-message" id="videoCtaTextError"></span>
                    </div>

                    <div class="form-group">
                        <label for="video_cta_aria_label">Video CTA ARIA Label *</label>
                        <input type="text" id="video_cta_aria_label" name="video_cta_aria_label" class="form-control"
                            value="{{ old('video_cta_aria_label', $aboutData['video_cta']['aria_label'] ?? '') }}"
                            placeholder="e.g., Watch our company story video" required>
                        <span class="error-message" id="videoCtaAriaLabelError"></span>
                    </div>
                </div>
            </div>

            <!-- In the Images and Shapes section -->
            <div class="form-group">
                <label>Images and Shapes</label>
                <div id="imageItemsContainer" class="image-items-container">
                    @php
                        $images = $aboutData['images'] ?? [];
                    @endphp
                    @foreach ($images as $index => $image)
                        <div class="image-item-row">
                            <div class="w-full">
                                <label>Image File</label>
                                <input type="file" name="image_files[{{ $index }}]"
                                    class="form-control image-file-input" accept="image/*">
                                @if (isset($image['src']) && $image['src'])
                                    <div class="image-preview">
                                        @if (str_starts_with($image['src'], 'assets/'))
                                            <img src="{{ asset($image['src']) }}" alt="Current image">
                                        @else
                                            <img src="{{ Storage::url($image['src']) }}" alt="Current image">
                                        @endif
                                        <p class="text-sm text-gray-600 mt-2 text-center">Current image</p>
                                    </div>
                                @endif
                            </div>
                            <div class="w-full">
                                <label>Image Alt Text</label>
                                <input type="text" name="images[{{ $index }}][alt]"
                                    class="form-control image-alt-input"
                                    value="{{ old("images.$index.alt", $image['alt'] ?? '') }}"
                                    placeholder="Image description">
                            </div>
                            <div class="w-full">
                                <label>Shape File</label>
                                <input type="file" name="shape_files[{{ $index }}]"
                                    class="form-control shape-file-input" accept="image/*">
                                @if (isset($image['shape']) && $image['shape'])
                                    <div class="image-preview">
                                        @if (str_starts_with($image['shape'], 'assets/'))
                                            <img src="{{ asset($image['shape']) }}" alt="Current shape">
                                        @else
                                            <img src="{{ Storage::url($image['shape']) }}" alt="Current shape">
                                        @endif
                                        <p class="text-sm text-gray-600 mt-2 text-center">Current shape</p>
                                    </div>
                                @endif
                            </div>
                            <div class="w-full">
                                <label>Shape Alt Text</label>
                                <input type="text" name="images[{{ $index }}][shape_alt]"
                                    class="form-control shape-alt-input"
                                    value="{{ old("images.$index.shape_alt", $image['shape_alt'] ?? '') }}"
                                    placeholder="Shape description">
                            </div>
                            <div class="w-full">
                                <label>Shape Position</label>
                                <select name="images[{{ $index }}][shape_position]"
                                    class="form-control shape-position-input">
                                    <option value="">None</option>
                                    <option value="top-left"
                                        {{ old("images.$index.shape_position", $image['shape_position'] ?? '') == 'top-left' ? 'selected' : '' }}>
                                        Top Left</option>
                                    <option value="top-right"
                                        {{ old("images.$index.shape_position", $image['shape_position'] ?? '') == 'top-right' ? 'selected' : '' }}>
                                        Top Right</option>
                                    <option value="bottom-left"
                                        {{ old("images.$index.shape_position", $image['shape_position'] ?? '') == 'bottom-left' ? 'selected' : '' }}>
                                        Bottom Left</option>
                                </select>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" name="images[{{ $index }}][is_centered]" value="1"
                                    class="form-control is-centered-input"
                                    {{ old("images.$index.is_centered", $image['is_centered'] ?? false) ? 'checked' : '' }}>
                                <label class="ml-2">Center Image</label>
                            </div>
                            <button type="button" class="admin-btn btn-danger remove-image"
                                data-id="{{ $index }}" aria-label="Remove image">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    @endforeach
                </div>
                <button type="button" class="admin-btn btn-save mt-3" id="addImageItem">
                    <i class="fas fa-plus"></i> Add Image/Shape
                </button>
            </div>

            <!-- Feature Items -->
            <div class="form-group">
                <label>Feature Items</label>
                <div id="featureItemsContainer" class="feature-items-container">
                    @php
                        $features = $aboutData['features'] ?? [];
                    @endphp
                    @foreach ($features as $index => $feature)
                        <div class="feature-item-row">
                            <input type="text" name="features[{{ $index }}][title]"
                                class="form-control feature-title-input"
                                value="{{ old("features.$index.title", $feature['title'] ?? '') }}"
                                placeholder="Feature Title" required>
                            <input type="text" name="features[{{ $index }}][description]"
                                class="form-control feature-description-input"
                                value="{{ old("features.$index.description", $feature['description'] ?? '') }}"
                                placeholder="Feature Description" required>
                            <select name="features[{{ $index }}][bg_color]"
                                class="form-control feature-bg-color-input">
                                <option value="primary"
                                    {{ old("features.$index.bg_color", $feature['bg_color'] ?? '') == 'primary' ? 'selected' : '' }}>
                                    Primary Color</option>
                                <option value="secondary"
                                    {{ old("features.$index.bg_color", $feature['bg_color'] ?? '') == 'secondary' ? 'selected' : '' }}>
                                    Secondary Color</option>
                            </select>
                            <button type="button" class="admin-btn btn-danger remove-feature"
                                data-id="{{ $index }}" aria-label="Remove feature">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    @endforeach
                </div>
                <button type="button" class="admin-btn btn-save mt-3" id="addFeatureItem">
                    <i class="fas fa-plus"></i> Add Feature Item
                </button>
            </div>

            <!-- Stats -->
            <div class="form-group">
                <label>Stats</label>
                <div id="statItemsContainer" class="stat-items-container">
                    @php
                        $stats = $aboutData['stats'] ?? [];
                    @endphp
                    @foreach ($stats as $index => $stat)
                        <div class="stat-item-row">
                            <input type="text" name="stats[{{ $index }}][value]"
                                class="form-control stat-value-input"
                                value="{{ old("stats.$index.value", $stat['value'] ?? '') }}"
                                placeholder="Value (e.g., 500+)" required>
                            <input type="text" name="stats[{{ $index }}][label]"
                                class="form-control stat-label-input"
                                value="{{ old("stats.$index.label", $stat['label'] ?? '') }}"
                                placeholder="Label (e.g., Successful Campaigns)" required>
                            <button type="button" class="admin-btn btn-danger remove-stat"
                                data-id="{{ $index }}" aria-label="Remove stat">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    @endforeach
                </div>
                <button type="button" class="admin-btn btn-save mt-3" id="addStatItem">
                    <i class="fas fa-plus"></i> Add Stat Item
                </button>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <button type="button" class="admin-btn btn-cancel" id="cancelEdit">
                    <i class="fas fa-times"></i> Cancel
                </button>
                <button type="submit" class="admin-btn btn-save">
                    <i class="fas fa-save"></i> Save Changes
                </button>
            </div>
        </form>
    </div>

    <button class="toggle-admin" id="toggleAdmin" aria-label="Toggle admin panel">
        <i class="fas fa-cog"></i>
    </button>
@endsection

@push('scripts')
    <!-- Include fslightbox.js for video lightbox functionality -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fslightbox/3.4.1/index.min.js"></script>

    <script>
        class AboutSectionManager {
            constructor() {
                this.aboutData = @json($aboutData);
                this.elements = this.initializeElements();
                this.isEditing = false;
                this.init();
            }

            initializeElements() {
                return {
                    aboutImages: document.getElementById('aboutImages'),
                    aboutContent: document.getElementById('aboutContent'),
                    adminPanel: document.getElementById('adminPanel'),
                    toggleAdminBtn: document.getElementById('toggleAdmin'),
                    aboutForm: document.getElementById('aboutForm'),
                    cancelEditBtn: document.getElementById('cancelEdit'),
                    imageItemsContainer: document.getElementById('imageItemsContainer'),
                    featureItemsContainer: document.getElementById('featureItemsContainer'),
                    statItemsContainer: document.getElementById('statItemsContainer'),
                    addImageItemBtn: document.getElementById('addImageItem'),
                    addFeatureItemBtn: document.getElementById('addFeatureItem'),
                    addStatItemBtn: document.getElementById('addStatItem'),
                    previewChangesBtn: document.getElementById('previewChanges'),
                    resetToDefaultBtn: document.getElementById('resetToDefault')
                };
            }

            init() {
                this.renderAbout();
                this.setupEventListeners();
                this.setupRealTimePreview();
                this.setupFileInputHandling();
            }

            setupFileInputHandling() {
                // Clear empty file inputs before form submission to prevent validation errors
                this.elements.aboutForm.addEventListener('submit', (e) => {
                    const emptyFileInputs = this.elements.aboutForm.querySelectorAll('input[type="file"]');
                    emptyFileInputs.forEach(input => {
                        if (!input.files || input.files.length === 0) {
                            // Create a new input without the name attribute to exclude from submission
                            const newInput = input.cloneNode(false);
                            newInput.removeAttribute('name');
                            input.parentNode.replaceChild(newInput, input);
                        }
                    });
                });
            }

            renderAbout() {
                // Images
                this.elements.aboutImages.innerHTML = `
                    <div class="about-images-grid">
                        ${this.aboutData.images.map(image => `
                                                                                <div class="about-image-container ${image.is_centered ? 'about-image--center' : ''}" ${image.is_centered ? 'style="grid-column: span 2;"' : ''}>
                                                                                    ${image.shape ? `
                                    <img src="${this.getImageUrl(image.shape)}" alt="${this.sanitizeInput(image.shape_alt)}" class="shape shape--${image.shape_position}" />
                                ` : ''}
                                                                                    ${image.src ? `
                                    <img src="${this.getImageUrl(image.src)}" alt="${this.sanitizeInput(image.alt)}" class="about-image" />
                                ` : ''}
                                                                                </div>
                                                                            `).join('')}
                    </div>
                `;

                // Content
                this.elements.aboutContent.innerHTML = `
                    <h4 class="about-subheading">${this.sanitizeInput(this.aboutData.subheading)}</h4>
                    <h2 class="about-heading">${this.sanitizeInput(this.aboutData.heading)}</h2>
                    <p class="about-description">${this.sanitizeInput(this.aboutData.description)}</p>
                    <div class="features-list" role="list">
                        ${this.aboutData.features.map(feature => `
                                                                                <div class="feature-item" role="listitem">
                                                                                    <div class="feature-icon-container ${feature.bg_color === 'secondary' ? 'secondary' : ''}">
                                                                                        <img src="{{ asset('assets/images/icon-check.svg') }}" alt="Check mark for ${this.sanitizeInput(feature.title)}" class="feature-icon" />
                                                                                    </div>
                                                                                    <div>
                                                                                        <h4 class="feature-title">${this.sanitizeInput(feature.title)}</h4>
                                                                                        <p class="feature-description">${this.sanitizeInput(feature.description)}</p>
                                                                                    </div>
                                                                                </div>
                                                                            `).join('')}
                    </div>
                    <div class="stats" role="list">
                        ${this.aboutData.stats.map(stat => `
                                                                                <div class="stat-item" role="listitem">
                                                                                    <span class="stat-value">${this.sanitizeInput(stat.value)}</span>
                                                                                    <span class="stat-label">${this.sanitizeInput(stat.label)}</span>
                                                                                </div>
                                                                            `).join('')}
                    </div>
                    <a href="${this.sanitizeInput(this.aboutData.video_cta.url)}" data-fslightbox class="video-cta" aria-label="${this.sanitizeInput(this.aboutData.video_cta.aria_label)}">
                        <span class="video-cta-icon-container">
                            <span class="video-cta-pulse"></span>
                            <img src="{{ asset('assets/images/icon-play.svg') }}" alt="Play video icon" class="video-cta-icon" />
                        </span>
                        <span class="video-cta-text">${this.sanitizeInput(this.aboutData.video_cta.text)}</span>
                    </a>
                `;

                // Refresh fslightbox
                if (window.refreshFsLightbox) {
                    window.refreshFsLightbox();
                }
            }

            getImageUrl(path) {
                if (!path) return '';
                if (path.startsWith('assets/') || path.startsWith('http')) {
                    return path;
                }
                return `/storage/${path}`;
            }

            setupEventListeners() {
                // Toggle admin panel
                this.elements.toggleAdminBtn.addEventListener('click', () => this.toggleAdminPanel());

                // Cancel edit
                this.elements.cancelEditBtn.addEventListener('click', () => this.hideAdminPanel());

                // Add items
                this.elements.addImageItemBtn.addEventListener('click', () => this.addImageItem());
                this.elements.addFeatureItemBtn.addEventListener('click', () => this.addFeatureItem());
                this.elements.addStatItemBtn.addEventListener('click', () => this.addStatItem());

                // Remove items delegation
                this.elements.imageItemsContainer.addEventListener('click', (e) => {
                    if (e.target.closest('.remove-image')) {
                        this.removeItem(e.target.closest('.remove-image'), 'image');
                    }
                });

                this.elements.featureItemsContainer.addEventListener('click', (e) => {
                    if (e.target.closest('.remove-feature')) {
                        this.removeItem(e.target.closest('.remove-feature'), 'feature');
                    }
                });

                this.elements.statItemsContainer.addEventListener('click', (e) => {
                    if (e.target.closest('.remove-stat')) {
                        this.removeItem(e.target.closest('.remove-stat'), 'stat');
                    }
                });

                // Form submission
                this.elements.aboutForm.addEventListener('submit', (e) => this.validateForm(e));

                // Reset to default
                this.elements.resetToDefaultBtn.addEventListener('click', () => this.resetToDefault());

                // Preview changes
                this.elements.previewChangesBtn.addEventListener('click', () => this.previewChanges());
            }

            setupRealTimePreview() {
                // Real-time preview updates for form fields
                const previewFields = [{
                        input: 'aboutSubheading',
                        preview: 'subheading'
                    },
                    {
                        input: 'aboutHeading',
                        preview: 'heading'
                    },
                    {
                        input: 'aboutDescription',
                        preview: 'description'
                    },
                    {
                        input: 'video_cta_url',
                        preview: 'video_cta.url'
                    },
                    {
                        input: 'video_cta_text',
                        preview: 'video_cta.text'
                    },
                    {
                        input: 'video_cta_aria_label',
                        preview: 'video_cta.aria_label'
                    }
                ];

                previewFields.forEach(field => {
                    const input = document.getElementById(field.input);
                    if (input) {
                        input.addEventListener('input', () => {
                            this.updateAboutData(field.preview, input.value);
                            this.renderAbout();
                        });
                    }
                });
            }

            updateAboutData(path, value) {
                const paths = path.split('.');
                let current = this.aboutData;

                for (let i = 0; i < paths.length - 1; i++) {
                    current = current[paths[i]];
                }

                current[paths[paths.length - 1]] = value;
            }

            toggleAdminPanel() {
                this.elements.adminPanel.classList.toggle('show');
                const isVisible = this.elements.adminPanel.classList.contains('show');

                if (isVisible) {
                    this.elements.adminPanel.focus();
                    this.elements.adminPanel.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            }

            hideAdminPanel() {
                this.elements.adminPanel.classList.remove('show');
            }

            addImageItem() {
                const imageRows = document.querySelectorAll('.image-item-row');
                const newId = imageRows.length;

                const imageHtml = `
                                    <div class="image-item-row">
                                        <div class="w-full">
                                            <label>Image File</label>
                                            <input type="file" name="image_files[${newId}]" class="form-control image-file-input" accept="image/*">
                                        </div>
                                        <div class="w-full">
                                            <label>Image Alt Text</label>
                                            <input type="text" name="images[${newId}][alt]" class="form-control image-alt-input" placeholder="Image description">
                                        </div>
                                        <div class="w-full">
                                            <label>Shape File</label>
                                            <input type="file" name="shape_files[${newId}]" class="form-control shape-file-input" accept="image/*">
                                        </div>
                                        <div class="w-full">
                                            <label>Shape Alt Text</label>
                                            <input type="text" name="images[${newId}][shape_alt]" class="form-control shape-alt-input" placeholder="Shape description">
                                        </div>
                                        <div class="w-full">
                                            <label>Shape Position</label>
                                            <select name="images[${newId}][shape_position]" class="form-control shape-position-input">
                                                <option value="">None</option>
                                                <option value="top-left">Top Left</option>
                                                <option value="top-right">Top Right</option>
                                                <option value="bottom-left">Bottom Left</option>
                                            </select>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="checkbox" name="images[${newId}][is_centered]" value="1" class="form-control is-centered-input">
                                            <label class="ml-2">Center Image</label>
                                        </div>
                                        <button type="button" class="admin-btn btn-danger remove-image" data-id="${newId}" aria-label="Remove image">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                `;

                this.elements.imageItemsContainer.insertAdjacentHTML('beforeend', imageHtml);
            }

            addFeatureItem() {
                const featureRows = document.querySelectorAll('.feature-item-row');
                const newId = featureRows.length;

                const featureHtml = `
                    <div class="feature-item-row">
                        <input type="text" name="features[${newId}][title]" class="form-control feature-title-input" placeholder="Feature Title" required>
                        <input type="text" name="features[${newId}][description]" class="form-control feature-description-input" placeholder="Feature Description" required>
                        <select name="features[${newId}][bg_color]" class="form-control feature-bg-color-input">
                            <option value="primary">Primary Color</option>
                            <option value="secondary">Secondary Color</option>
                        </select>
                        <button type="button" class="admin-btn btn-danger remove-feature" data-id="${newId}" aria-label="Remove feature">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                `;

                this.elements.featureItemsContainer.insertAdjacentHTML('beforeend', featureHtml);
            }

            addStatItem() {
                const statRows = document.querySelectorAll('.stat-item-row');
                const newId = statRows.length;

                const statHtml = `
                    <div class="stat-item-row">
                        <input type="text" name="stats[${newId}][value]" class="form-control stat-value-input" placeholder="Value (e.g., 500+)" required>
                        <input type="text" name="stats[${newId}][label]" class="form-control stat-label-input" placeholder="Label (e.g., Successful Campaigns)" required>
                        <button type="button" class="admin-btn btn-danger remove-stat" data-id="${newId}" aria-label="Remove stat">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                `;

                this.elements.statItemsContainer.insertAdjacentHTML('beforeend', statHtml);
            }

            removeItem(button, type) {
                if (confirm(`Are you sure you want to remove this ${type}?`)) {
                    button.closest(`.${type}-item-row`).remove();
                }
            }

            validateForm(e) {
                let isValid = true;

                // Clear previous errors
                this.clearErrors();

                // Validate required fields
                const requiredFields = [
                    'aboutSubheading', 'aboutHeading', 'aboutDescription',
                    'video_cta_url', 'video_cta_text', 'video_cta_aria_label'
                ];

                requiredFields.forEach(fieldId => {
                    const field = document.getElementById(fieldId);
                    if (!field.value.trim()) {
                        this.showError(fieldId, 'This field is required.');
                        isValid = false;
                    }
                });

                // Validate URL format
                const urlField = document.getElementById('video_cta_url');
                if (urlField.value && !this.isValidUrl(urlField.value)) {
                    this.showError('video_cta_url', 'Please enter a valid URL.');
                    isValid = false;
                }

                // Validate feature items
                const featureInputs = this.elements.aboutForm.querySelectorAll(
                    '.feature-title-input, .feature-description-input');
                featureInputs.forEach(input => {
                    if (!input.value.trim() && input.hasAttribute('required')) {
                        this.showError(input.name, 'This field is required.');
                        isValid = false;
                    }
                });

                // Validate stat items
                const statInputs = this.elements.aboutForm.querySelectorAll('.stat-value-input, .stat-label-input');
                statInputs.forEach(input => {
                    if (!input.value.trim() && input.hasAttribute('required')) {
                        this.showError(input.name, 'This field is required.');
                        isValid = false;
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    this.elements.adminPanel.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            }

            clearErrors() {
                document.querySelectorAll('.error-message').forEach(error => {
                    error.classList.remove('show');
                    error.textContent = '';
                });
                document.querySelectorAll('.form-control--error').forEach(input => {
                    input.classList.remove('form-control--error');
                });
            }

            showError(fieldId, message) {
                const field = document.getElementById(fieldId);
                const errorElement = document.getElementById(fieldId + 'Error');

                if (field && errorElement) {
                    field.classList.add('form-control--error');
                    errorElement.textContent = message;
                    errorElement.classList.add('show');
                }
            }

            isValidUrl(string) {
                try {
                    new URL(string);
                    return true;
                } catch (_) {
                    return false;
                }
            }

            resetToDefault() {
                if (confirm('Are you sure you want to reset all changes to default values?')) {
                    // This would typically reload the page to get fresh data from server
                    window.location.reload();
                }
            }

            previewChanges() {
                // In a real implementation, this would show a preview modal
                this.showNotification('Preview functionality would show how changes look before saving.', 'info');
            }

            sanitizeInput(input) {
                if (typeof input !== 'string') return input;
                const div = document.createElement('div');
                div.textContent = input;
                return div.innerHTML;
            }

            showNotification(message, type) {
                const notification = document.createElement('div');
                notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 ${
                    type === 'success' ? 'bg-green-500 text-white' : 
                    type === 'error' ? 'bg-red-500 text-white' : 
                    'bg-blue-500 text-white'
                }`;
                notification.innerHTML = `
                    <div class="flex items-center gap-2">
                        <i class="fas fa-${type === 'success' ? 'check' : type === 'error' ? 'exclamation-triangle' : 'info'}"></i>
                        <span>${message}</span>
                    </div>
                `;

                document.body.appendChild(notification);

                setTimeout(() => {
                    notification.remove();
                }, 3000);
            }
        }

        // Initialize the about section manager
        document.addEventListener('DOMContentLoaded', () => {
            window.aboutManager = new AboutSectionManager();
        });
    </script>
@endpush
