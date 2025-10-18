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

@section('content')
    <div class="main-content">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">About Section Management</h1>
                    <p class="text-gray-600 text-sm mt-1">Customize and manage the about section for your website. Changes
                        are reflected in real-time.</p>
                </div>
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

        <!-- Success/Error Messages -->
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg flex items-center gap-3">
                <i class="fas fa-check-circle text-green-500"></i>
                <div>
                    <p class="font-medium">Success!</p>
                    <p class="text-sm">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg">
                <div class="flex items-center gap-3 mb-2">
                    <i class="fas fa-exclamation-circle text-red-500"></i>
                    <p class="font-medium">Please fix the following errors:</p>
                </div>
                <ul class="list-disc list-inside text-sm space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
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
                        <label for="videoCtaUrl">Video CTA URL *</label>
                        <input type="url" id="videoCtaUrl" name="videoCtaUrl" class="form-control"
                            value="{{ old('videoCtaUrl', $aboutData['videoCta']['url'] ?? '') }}"
                            placeholder="https://www.youtube.com/watch?v=..." required>
                        <span class="error-message" id="videoCtaUrlError"></span>
                    </div>

                    <div class="form-group">
                        <label for="videoCtaText">Video CTA Text *</label>
                        <input type="text" id="videoCtaText" name="videoCtaText" class="form-control"
                            value="{{ old('videoCtaText', $aboutData['videoCta']['text'] ?? '') }}"
                            placeholder="e.g., Watch Our Story" required>
                        <span class="error-message" id="videoCtaTextError"></span>
                    </div>

                    <div class="form-group">
                        <label for="videoCtaAriaLabel">Video CTA ARIA Label *</label>
                        <input type="text" id="videoCtaAriaLabel" name="videoCtaAriaLabel" class="form-control"
                            value="{{ old('videoCtaAriaLabel', $aboutData['videoCta']['ariaLabel'] ?? '') }}"
                            placeholder="e.g., Watch our company story video" required>
                        <span class="error-message" id="videoCtaAriaLabelError"></span>
                    </div>
                </div>
            </div>

            <!-- Images and Shapes -->
            <div class="form-group">
                <label>Images and Shapes</label>
                <div id="imageItemsContainer" class="image-items-container">
                    @foreach ($aboutData['images'] ?? [] as $index => $image)
                        <div class="image-item-row">
                            <div class="w-full">
                                <label>Image File</label>
                                <input type="file" name="images[{{ $index }}][file]"
                                    class="form-control image-file-input" accept="image/*">
                                @if (isset($image['src']) && $image['src'])
                                    <div class="image-preview">
                                        <img src="{{ Storage::url($image['src']) }}" alt="Current image">
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
                                <input type="file" name="images[{{ $index }}][shapeFile]"
                                    class="form-control shape-file-input" accept="image/*">
                                @if (isset($image['shape']) && $image['shape'])
                                    <div class="image-preview">
                                        <img src="{{ Storage::url($image['shape']) }}" alt="Current shape">
                                        <p class="text-sm text-gray-600 mt-2 text-center">Current shape</p>
                                    </div>
                                @endif
                            </div>
                            <div class="w-full">
                                <label>Shape Alt Text</label>
                                <input type="text" name="images[{{ $index }}][shapeAlt]"
                                    class="form-control shape-alt-input"
                                    value="{{ old("images.$index.shapeAlt", $image['shapeAlt'] ?? '') }}"
                                    placeholder="Shape description">
                            </div>
                            <div class="w-full">
                                <label>Shape Position</label>
                                <select name="images[{{ $index }}][shapePosition]"
                                    class="form-control shape-position-input">
                                    <option value="">None</option>
                                    <option value="top-left"
                                        {{ old("images.$index.shapePosition", $image['shapePosition'] ?? '') == 'top-left' ? 'selected' : '' }}>
                                        Top Left</option>
                                    <option value="top-right"
                                        {{ old("images.$index.shapePosition", $image['shapePosition'] ?? '') == 'top-right' ? 'selected' : '' }}>
                                        Top Right</option>
                                    <option value="bottom-left"
                                        {{ old("images.$index.shapePosition", $image['shapePosition'] ?? '') == 'bottom-left' ? 'selected' : '' }}>
                                        Bottom Left</option>
                                </select>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" name="images[{{ $index }}][isCentered]"
                                    class="form-control is-centered-input"
                                    {{ old("images.$index.isCentered", $image['isCentered'] ?? false) ? 'checked' : '' }}>
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
                    @foreach ($aboutData['features'] ?? [] as $index => $feature)
                        <div class="feature-item-row">
                            <input type="text" name="features[{{ $index }}][title]"
                                class="form-control feature-title-input"
                                value="{{ old("features.$index.title", $feature['title'] ?? '') }}"
                                placeholder="Feature Title" required>
                            <input type="text" name="features[{{ $index }}][description]"
                                class="form-control feature-description-input"
                                value="{{ old("features.$index.description", $feature['description'] ?? '') }}"
                                placeholder="Feature Description" required>
                            <select name="features[{{ $index }}][bgColor]"
                                class="form-control feature-bg-color-input">
                                <option value="primary"
                                    {{ old("features.$index.bgColor", $feature['bgColor'] ?? '') == 'primary' ? 'selected' : '' }}>
                                    Primary Color</option>
                                <option value="secondary"
                                    {{ old("features.$index.bgColor", $feature['bgColor'] ?? '') == 'secondary' ? 'selected' : '' }}>
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
                    @foreach ($aboutData['stats'] ?? [] as $index => $stat)
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
                this.aboutData = this.getDefaultData();
                this.elements = this.initializeElements();
                this.isEditing = false;
                this.init();
            }

            getDefaultData() {
                return {
                    subheading: "Why Choose Londa Loans",
                    heading: "We Empower Marketeers with Financial Solutions That Drive Growth",
                    description: "At Londa Loans, we understand the unique financial needs of marketers and entrepreneurs. Our tailored loan programs are designed specifically to fuel your business growth and marketing initiatives.",
                    images: [{
                            id: 1,
                            src: "{{ asset('assets/images/about-01.png') }}",
                            alt: "Team collaborating on a marketing campaign",
                            shape: "{{ asset('assets/images/shape-05.svg') }}",
                            shapeAlt: "Decorative shape pattern",
                            shapePosition: "top-left",
                            isCentered: false
                        },
                        {
                            id: 2,
                            src: "{{ asset('assets/images/about-02.png') }}",
                            alt: "Entrepreneur analyzing financial growth",
                            shape: null,
                            shapeAlt: null,
                            shapePosition: null,
                            isCentered: false
                        },
                        {
                            id: 3,
                            src: "{{ asset('assets/images/about-03.png') }}",
                            alt: "Marketer presenting a growth strategy",
                            shape: "{{ asset('assets/images/shape-06.svg') }}",
                            shapeAlt: "Decorative shape accent",
                            shapePosition: "top-right",
                            isCentered: true
                        },
                        {
                            id: 4,
                            src: null,
                            alt: null,
                            shape: "{{ asset('assets/images/shape-07.svg') }}",
                            shapeAlt: "Decorative shape detail",
                            shapePosition: "bottom-left",
                            isCentered: true
                        }
                    ],
                    features: [{
                            id: 1,
                            title: "Fast Approval",
                            description: "Get decisions within 24 hours",
                            bgColor: "primary"
                        },
                        {
                            id: 2,
                            title: "Flexible Terms",
                            description: "Repayment plans that work for you",
                            bgColor: "secondary"
                        },
                        {
                            id: 3,
                            title: "No Hidden Fees",
                            description: "Transparent pricing always",
                            bgColor: "primary"
                        },
                        {
                            id: 4,
                            title: "Marketing Focus",
                            description: "Loans designed for marketeers",
                            bgColor: "secondary"
                        }
                    ],
                    stats: [{
                            id: 1,
                            value: "500+",
                            label: "Successful Campaigns Funded"
                        },
                        {
                            id: 2,
                            value: "98%",
                            label: "Customer Satisfaction"
                        },
                        {
                            id: 3,
                            value: "$10M+",
                            label: "Loans Disbursed"
                        }
                    ],
                    videoCta: {
                        url: "https://www.youtube.com/watch?v=xcJtL7QggTI",
                        text: "See How We Empower Marketers",
                        ariaLabel: "Watch video about Londa Loans' impact on marketers"
                    }
                };
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
                this.loadData();
                this.renderAbout();
                this.setupEventListeners();
                this.setupRealTimePreview();
            }

            loadData() {
                // In a real application, this would load from your backend
                // For now, we'll use the default data
                console.log('About section manager initialized');
            }

            renderAbout() {
                // Images
                this.elements.aboutImages.innerHTML = `
                    <div class="about-images-grid">
                        ${this.aboutData.images.map(image => `
                                    <div class="about-image-container" ${image.isCentered ? 'style="grid-column: span 2;"' : ''}>
                                        ${image.shape ? `
                                    <img src="${image.shape}" alt="${this.sanitizeInput(image.shapeAlt)}" class="shape shape--${image.shapePosition}" />
                                ` : ''}
                                        ${image.src ? `
                                    <img src="${image.src}" alt="${this.sanitizeInput(image.alt)}" class="about-image ${image.isCentered ? 'about-image--center' : ''}" />
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
                                        <div class="feature-icon-container ${feature.bgColor === 'secondary' ? 'secondary' : ''}">
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
                    <a href="${this.sanitizeInput(this.aboutData.videoCta.url)}" data-fslightbox class="video-cta" aria-label="${this.sanitizeInput(this.aboutData.videoCta.ariaLabel)}">
                        <span class="video-cta-icon-container">
                            <span class="video-cta-pulse"></span>
                            <img src="{{ asset('assets/images/icon-play.svg') }}" alt="Play video icon" class="video-cta-icon" />
                        </span>
                        <span class="video-cta-text">${this.sanitizeInput(this.aboutData.videoCta.text)}</span>
                    </a>
                `;

                // Refresh fslightbox
                if (window.refreshFsLightbox) {
                    window.refreshFsLightbox();
                }
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
                        preview: 'aboutSubheading'
                    },
                    {
                        input: 'aboutHeading',
                        preview: 'aboutHeading'
                    },
                    {
                        input: 'aboutDescription',
                        preview: 'aboutDescription'
                    },
                    {
                        input: 'videoCtaUrl',
                        preview: 'videoCtaUrl'
                    },
                    {
                        input: 'videoCtaText',
                        preview: 'videoCtaText'
                    },
                    {
                        input: 'videoCtaAriaLabel',
                        preview: 'videoCtaAriaLabel'
                    }
                ];

                previewFields.forEach(field => {
                    const input = document.getElementById(field.input);
                    if (input) {
                        input.addEventListener('input', () => {
                            this.updateAboutData();
                            this.renderAbout();
                        });
                    }
                });
            }

            updateAboutData() {
                // Update basic data from form inputs
                this.aboutData.subheading = document.getElementById('aboutSubheading')?.value || this.aboutData
                    .subheading;
                this.aboutData.heading = document.getElementById('aboutHeading')?.value || this.aboutData.heading;
                this.aboutData.description = document.getElementById('aboutDescription')?.value || this.aboutData
                    .description;
                this.aboutData.videoCta.url = document.getElementById('videoCtaUrl')?.value || this.aboutData.videoCta
                    .url;
                this.aboutData.videoCta.text = document.getElementById('videoCtaText')?.value || this.aboutData.videoCta
                    .text;
                this.aboutData.videoCta.ariaLabel = document.getElementById('videoCtaAriaLabel')?.value || this
                    .aboutData.videoCta.ariaLabel;
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
                            <input type="file" name="images[${newId}][file]" class="form-control image-file-input" accept="image/*">
                        </div>
                        <div class="w-full">
                            <label>Image Alt Text</label>
                            <input type="text" name="images[${newId}][alt]" class="form-control image-alt-input" placeholder="Image description">
                        </div>
                        <div class="w-full">
                            <label>Shape File</label>
                            <input type="file" name="images[${newId}][shapeFile]" class="form-control shape-file-input" accept="image/*">
                        </div>
                        <div class="w-full">
                            <label>Shape Alt Text</label>
                            <input type="text" name="images[${newId}][shapeAlt]" class="form-control shape-alt-input" placeholder="Shape description">
                        </div>
                        <div class="w-full">
                            <label>Shape Position</label>
                            <select name="images[${newId}][shapePosition]" class="form-control shape-position-input">
                                <option value="">None</option>
                                <option value="top-left">Top Left</option>
                                <option value="top-right">Top Right</option>
                                <option value="bottom-left">Bottom Left</option>
                            </select>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="images[${newId}][isCentered]" class="form-control is-centered-input">
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
                        <select name="features[${newId}][bgColor]" class="form-control feature-bg-color-input">
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
                    'videoCtaUrl', 'videoCtaText', 'videoCtaAriaLabel'
                ];

                requiredFields.forEach(fieldId => {
                    const field = document.getElementById(fieldId);
                    if (!field.value.trim()) {
                        this.showError(fieldId, 'This field is required.');
                        isValid = false;
                    }
                });

                // Validate URL format
                const urlField = document.getElementById('videoCtaUrl');
                if (urlField.value && !this.isValidUrl(urlField.value)) {
                    this.showError('videoCtaUrl', 'Please enter a valid URL.');
                    isValid = false;
                }

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
                    this.aboutData = this.getDefaultData();
                    this.renderAbout();
                    this.hideAdminPanel();
                    this.showNotification('Reset to default values successfully!', 'success');
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
