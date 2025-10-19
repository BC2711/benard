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
            --background-color: #f8f5f0;
            --text-color: #5a5a5a;
        }

        /* Preview Styles */
        .services-preview-container {
            background: var(--white);
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 2rem;
            box-shadow: var(--shadow);
            border: 1px solid #e5e7eb;
        }

        .services-section {
            background-color: var(--background-color);
            padding: clamp(3rem, 5vw, 4rem) 0;
        }

        .services-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 clamp(1rem, 3vw, 2rem);
        }

        .section-title {
            text-align: center;
            margin-bottom: 3rem;
            animation: fadeIn 0.6s ease-in;
        }

        .section-heading {
            font-size: clamp(1.75rem, 3vw, 2.25rem);
            font-weight: 700;
            color: var(--secondary-color);
            line-height: 1.3;
            margin-bottom: 0.75rem;
        }

        .section-description {
            font-size: clamp(0.9rem, 2vw, 1rem);
            color: var(--text-color);
            line-height: 1.6;
            max-width: 600px;
            margin: 0 auto;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-bottom: 3rem;
        }

        .service-item {
            background-color: var(--white);
            border-radius: 8px;
            padding: 1.5rem;
            box-shadow: var(--shadow);
            text-align: center;
            animation: fadeInUp 0.6s ease-in both;
            transition: var(--transition);
        }

        .service-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .service-item.border-primary {
            border-top: 4px solid var(--primary-color);
        }

        .service-item.border-secondary {
            border-top: 4px solid var(--secondary-color);
        }

        .service-icon-container {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            transition: var(--transition);
        }

        .service-item:hover .service-icon-container {
            transform: scale(1.1);
        }

        .service-icon-container.primary {
            background-color: var(--primary-color);
        }

        .service-icon-container.secondary {
            background-color: var(--secondary-color);
        }

        .service-icon {
            width: 32px;
            height: 32px;
            filter: brightness(0) invert(1);
        }

        .service-title {
            font-size: clamp(1.1rem, 2vw, 1.25rem);
            font-weight: 700;
            color: var(--secondary-color);
            margin-bottom: 0.5rem;
        }

        .service-description {
            font-size: clamp(0.85rem, 1.5vw, 0.95rem);
            color: #666;
            line-height: 1.5;
            margin-bottom: 1rem;
        }

        .service-link {
            font-size: 0.9rem;
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 700;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }

        .service-link:hover {
            color: #b3741c;
            transform: translateX(3px);
        }

        .cta-section {
            text-align: center;
            animation: fadeIn 0.6s ease-in 0.7s both;
        }

        .cta-heading {
            font-size: clamp(1.5rem, 2.5vw, 1.75rem);
            font-weight: 700;
            color: var(--secondary-color);
            margin-bottom: 0.5rem;
        }

        .cta-description {
            font-size: clamp(0.9rem, 2vw, 1rem);
            color: #666;
            margin-bottom: 1.5rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .cta-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            justify-content: center;
        }

        .cta-button {
            padding: 0.75rem 1.5rem;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 700;
            transition: var(--transition);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .cta-button.primary {
            background-color: var(--primary-color);
            border: 2px solid var(--primary-color);
            color: var(--white);
        }

        .cta-button.primary:hover {
            background-color: transparent;
            color: var(--primary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(219, 145, 35, 0.3);
        }

        .cta-button.secondary {
            border: 2px solid var(--secondary-color);
            color: var(--secondary-color);
        }

        .cta-button.secondary:hover {
            background-color: var(--secondary-color);
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(122, 70, 3, 0.3);
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

        /* Service Items Grid */
        .service-items-grid {
            display: grid;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .service-item-card {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 1.5rem;
            border: 1px solid #e9ecef;
            transition: var(--transition);
        }

        .service-item-card:hover {
            border-color: var(--primary-color);
        }

        .service-item-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 1rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid #e9ecef;
        }

        .service-item-number {
            background: var(--primary-color);
            color: white;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.875rem;
        }

        .service-item-fields {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
        }

        .image-preview {
            margin-top: 0.5rem;
            padding: 1rem;
            background: #f8f9fa;
            border-radius: 8px;
            border: 2px dashed #dee2e6;
            text-align: center;
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
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
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
            .services-section {
                padding: 2rem 0;
            }

            .services-grid {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .section-heading {
                font-size: clamp(1.5rem, 2vw, 1.75rem);
            }

            .cta-heading {
                font-size: clamp(1.3rem, 2vw, 1.5rem);
            }

            .service-title {
                font-size: clamp(1rem, 1.5vw, 1.1rem);
            }

            .section-description,
            .service-description,
            .cta-description {
                font-size: 0.9rem;
            }

            .services-grid {
                grid-template-columns: 1fr;
            }

            .cta-buttons {
                flex-direction: column;
                align-items: center;
                gap: 0.75rem;
            }

            .admin-panel {
                margin: 1.5rem 1rem;
                padding: 1.5rem;
            }

            .service-item-fields {
                grid-template-columns: 1fr;
            }

            .form-actions {
                flex-direction: column;
            }

            .admin-btn {
                width: 100%;
                justify-content: center;
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
                    <h1 class="text-2xl font-bold text-gray-900">Services Section Management</h1>
                    <p class="text-gray-600 text-sm mt-1">Customize and manage the services section for your website. Changes
                        are reflected in real-time.</p>
                </div>
                <div class="flex gap-2">
                    <button
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 flex items-center gap-2"
                        id="previewChanges">
                        <i class="fas fa-eye"></i> Preview
                    </button>
                    <button
                        class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-200 flex items-center gap-2"
                        id="resetToDefault">
                        <i class="fas fa-sync-alt"></i> Reset
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

        <!-- Services Preview -->
        <div class="services-preview-container">
            <section class="services-section" aria-label="Services Section Preview">
                <div class="services-container">
                    <div class="section-title" id="sectionTitle">
                        <h2 class="section-heading" id="previewSectionHeading">{{ $servicesData['sectionHeading'] }}</h2>
                        <p class="section-description" id="previewSectionDescription">
                            {{ $servicesData['sectionDescription'] }}</p>
                    </div>

                    <div class="services-grid" id="servicesGrid">
                        @foreach ($servicesData['services'] as $service)
                            <div class="service-item border-{{ $service['borderColor'] }}"
                                style="animation-delay: {{ $service['animationDelay'] }};" role="article">
                                <div class="service-icon-container {{ $service['borderColor'] }}">
                                    <img src="{{ asset($service['icon']) }}" alt="{{ $service['iconAlt'] }}"
                                        class="service-icon" />
                                </div>
                                <h4 class="service-title">{{ $service['title'] }}</h4>
                                <p class="service-description">{{ $service['description'] }}</p>
                                <a href="{{ $service['linkUrl'] }}" class="service-link"
                                    aria-label="{{ $service['linkAriaLabel'] }}">
                                    Learn More <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        @endforeach
                    </div>

                    <div class="cta-section" id="ctaSection">
                        <h3 class="cta-heading" id="previewCtaHeading">{{ $servicesData['cta']['heading'] }}</h3>
                        <p class="cta-description" id="previewCtaDescription">{{ $servicesData['cta']['description'] }}</p>
                        <div class="cta-buttons">
                            @foreach ($servicesData['cta']['buttons'] as $button)
                                <a href="{{ $button['url'] }}" class="cta-button {{ $button['style'] }}"
                                    aria-label="{{ $button['ariaLabel'] }}">{{ $button['text'] }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Admin Panel -->
        <div class="admin-panel" id="adminPanel" role="dialog" aria-labelledby="adminPanelTitle" aria-modal="true">
            <h3 id="adminPanelTitle">
                <i class="fas fa-edit"></i> Manage Services Content
            </h3>

            <form id="servicesForm" method="POST" action="{{ route('management.service-section') }}"
                enctype="multipart/form-data" novalidate>
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Section Content -->
                    <div class="space-y-6">
                        <div class="form-group">
                            <label for="sectionHeading">Section Heading *</label>
                            <input type="text" id="sectionHeading" name="sectionHeading"
                                value="{{ old('sectionHeading', $servicesData['sectionHeading']) }}" class="form-control"
                                placeholder="Enter section heading..." required>
                            <span class="error-message" id="sectionHeadingError"></span>
                        </div>

                        <div class="form-group">
                            <label for="sectionDescription">Section Description *</label>
                            <textarea id="sectionDescription" name="sectionDescription" class="form-control" rows="4"
                                placeholder="Describe your services..." required>{{ old('sectionDescription', $servicesData['sectionDescription']) }}</textarea>
                            <span class="error-message" id="sectionDescriptionError"></span>
                        </div>
                    </div>

                    <!-- CTA Content -->
                    <div class="space-y-6">
                        <div class="form-group">
                            <label for="ctaHeading">CTA Heading *</label>
                            <input type="text" id="ctaHeading" name="ctaHeading"
                                value="{{ old('ctaHeading', $servicesData['cta']['heading']) }}" class="form-control"
                                placeholder="Enter CTA heading..." required>
                            <span class="error-message" id="ctaHeadingError"></span>
                        </div>

                        <div class="form-group">
                            <label for="ctaDescription">CTA Description *</label>
                            <textarea id="ctaDescription" name="ctaDescription" class="form-control" rows="4"
                                placeholder="Enter CTA description..." required>{{ old('ctaDescription', $servicesData['cta']['description']) }}</textarea>
                            <span class="error-message" id="ctaDescriptionError"></span>
                        </div>
                    </div>
                </div>

                <!-- Service Items -->
                <div class="form-group">
                    <div class="flex justify-between items-center mb-4">
                        <label class="!mb-0">Service Items</label>
                        <button type="button" class="admin-btn btn-save" id="addServiceItem">
                            <i class="fas fa-plus"></i> Add Service Item
                        </button>
                    </div>

                    <div id="serviceItemsContainer" class="service-items-grid">
                        @foreach ($servicesData['services'] as $index => $service)
                            <div class="service-item-card" data-index="{{ $index }}">
                                <div class="service-item-header">
                                    <div class="service-item-number">{{ $index + 1 }}</div>
                                    <button type="button" class="admin-btn btn-danger remove-service"
                                        aria-label="Remove service item">
                                        <i class="fas fa-trash"></i> Remove
                                    </button>
                                </div>

                                <div class="service-item-fields">
                                    <div class="form-group">
                                        <label>Service Title *</label>
                                        <input type="text" name="services[{{ $index }}][title]"
                                            value="{{ old("services.$index.title", $service['title']) }}"
                                            class="form-control" placeholder="Service Title" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Service Description *</label>
                                        <textarea name="services[{{ $index }}][description]" class="form-control" placeholder="Service Description"
                                            required>{{ old("services.$index.description", $service['description']) }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Service Icon</label>
                                        <input type="file" name="service_icons[{{ $index }}]"
                                            class="form-control" accept="image/*">
                                        @if ($service['icon'])
                                            <div class="image-preview">
                                                <img src="{{ asset($service['icon']) }}" alt="Current icon">
                                                <p class="text-sm text-gray-600 mt-2">Current icon</p>
                                            </div>
                                        @endif
                                        <small class="text-gray-500 text-xs">Accepted formats: JPEG, PNG, JPG, GIF, SVG.
                                            Max size: 2MB</small>
                                    </div>

                                    <div class="form-group">
                                        <label>Icon Alt Text *</label>
                                        <input type="text" name="services[{{ $index }}][iconAlt]"
                                            value="{{ old("services.$index.iconAlt", $service['iconAlt']) }}"
                                            class="form-control" placeholder="Icon Alt Text" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Border Color *</label>
                                        <select name="services[{{ $index }}][borderColor]" class="form-control">
                                            <option value="primary"
                                                {{ $service['borderColor'] == 'primary' ? 'selected' : '' }}>Primary Color
                                            </option>
                                            <option value="secondary"
                                                {{ $service['borderColor'] == 'secondary' ? 'selected' : '' }}>Secondary
                                                Color</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Link URL *</label>
                                        <input type="text" name="services[{{ $index }}][linkUrl]"
                                            value="{{ old("services.$index.linkUrl", $service['linkUrl']) }}"
                                            class="form-control" placeholder="Learn More URL" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Link ARIA Label *</label>
                                        <input type="text" name="services[{{ $index }}][linkAriaLabel]"
                                            value="{{ old("services.$index.linkAriaLabel", $service['linkAriaLabel']) }}"
                                            class="form-control" placeholder="Learn More ARIA Label" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Animation Delay *</label>
                                        <input type="text" name="services[{{ $index }}][animationDelay]"
                                            value="{{ old("services.$index.animationDelay", $service['animationDelay']) }}"
                                            class="form-control" placeholder="Animation Delay" required>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- CTA Buttons -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach ([0, 1] as $buttonIndex)
                        @php
                            $button = $servicesData['cta']['buttons'][$buttonIndex];
                            $buttonNum = $buttonIndex + 1;
                        @endphp
                        <div class="space-y-4 p-4 bg-gray-50 rounded-lg">
                            <h4 class="font-semibold text-gray-800">CTA Button {{ $buttonNum }}</h4>

                            <div class="form-group">
                                <label for="ctaButton{{ $buttonNum }}Text">Button Text *</label>
                                <input type="text" id="ctaButton{{ $buttonNum }}Text"
                                    name="ctaButton{{ $buttonNum }}Text"
                                    value="{{ old("ctaButton{$buttonNum}Text", $button['text']) }}" class="form-control"
                                    placeholder="Button text..." required>
                                <span class="error-message" id="ctaButton{{ $buttonNum }}TextError"></span>
                            </div>

                            <div class="form-group">
                                <label for="ctaButton{{ $buttonNum }}Url">Button URL *</label>
                                <input type="url" id="ctaButton{{ $buttonNum }}Url"
                                    name="ctaButton{{ $buttonNum }}Url"
                                    value="{{ old("ctaButton{$buttonNum}Url", $button['url']) }}" class="form-control"
                                    placeholder="https://..." required>
                                <span class="error-message" id="ctaButton{{ $buttonNum }}UrlError"></span>
                            </div>

                            <div class="form-group">
                                <label for="ctaButton{{ $buttonNum }}AriaLabel">ARIA Label *</label>
                                <input type="text" id="ctaButton{{ $buttonNum }}AriaLabel"
                                    name="ctaButton{{ $buttonNum }}AriaLabel"
                                    value="{{ old("ctaButton{$buttonNum}AriaLabel", $button['ariaLabel']) }}"
                                    class="form-control" placeholder="ARIA label..." required>
                                <span class="error-message" id="ctaButton{{ $buttonNum }}AriaLabelError"></span>
                            </div>
                        </div>
                    @endforeach
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
    </div>
@endsection

@push('scripts')
    <script>
        class ServicesSectionManager {
            constructor() {
                this.elements = {
                    adminPanel: document.getElementById('adminPanel'),
                    toggleAdminBtn: document.getElementById('toggleAdmin'),
                    servicesForm: document.getElementById('servicesForm'),
                    cancelEditBtn: document.getElementById('cancelEdit'),
                    serviceItemsContainer: document.getElementById('serviceItemsContainer'),
                    addServiceItemBtn: document.getElementById('addServiceItem'),
                    previewChangesBtn: document.getElementById('previewChanges'),
                    resetToDefaultBtn: document.getElementById('resetToDefault')
                };

                this.serviceCount = {{ count($servicesData['services']) }};
                this.init();
            }

            init() {
                this.setupEventListeners();
                this.setupRealTimePreview();
                this.setupImagePreviews();
            }

            setupEventListeners() {
                this.elements.toggleAdminBtn.addEventListener('click', () => this.toggleAdminPanel());
                this.elements.cancelEditBtn.addEventListener('click', () => this.hideAdminPanel());
                this.elements.addServiceItemBtn.addEventListener('click', () => this.addServiceItem());
                this.elements.servicesForm.addEventListener('submit', (e) => this.validateForm(e));
                this.elements.resetToDefaultBtn.addEventListener('click', () => this.resetToDefault());
                this.elements.previewChangesBtn.addEventListener('click', () => this.previewChanges());

                // Remove service item delegation
                this.elements.serviceItemsContainer.addEventListener('click', (e) => {
                    if (e.target.closest('.remove-service')) {
                        this.removeServiceItem(e.target.closest('.service-item-card'));
                    }
                });
            }

            setupRealTimePreview() {
                const previewFields = [{
                        input: 'sectionHeading',
                        preview: 'previewSectionHeading'
                    },
                    {
                        input: 'sectionDescription',
                        preview: 'previewSectionDescription'
                    },
                    {
                        input: 'ctaHeading',
                        preview: 'previewCtaHeading'
                    },
                    {
                        input: 'ctaDescription',
                        preview: 'previewCtaDescription'
                    },
                    {
                        input: 'ctaButton1Text',
                        preview: 'ctaButton1Text',
                        isButton: true,
                        index: 0
                    },
                    {
                        input: 'ctaButton1Url',
                        preview: 'ctaButton1Url',
                        isButton: true,
                        index: 0,
                        attr: 'href'
                    },
                    {
                        input: 'ctaButton1AriaLabel',
                        preview: 'ctaButton1AriaLabel',
                        isButton: true,
                        index: 0,
                        attr: 'aria-label'
                    },
                    {
                        input: 'ctaButton2Text',
                        preview: 'ctaButton2Text',
                        isButton: true,
                        index: 1
                    },
                    {
                        input: 'ctaButton2Url',
                        preview: 'ctaButton2Url',
                        isButton: true,
                        index: 1,
                        attr: 'href'
                    },
                    {
                        input: 'ctaButton2AriaLabel',
                        preview: 'ctaButton2AriaLabel',
                        isButton: true,
                        index: 1,
                        attr: 'aria-label'
                    }
                ];

                previewFields.forEach(field => {
                    const input = document.getElementById(field.input);
                    if (input) {
                        input.addEventListener('input', () => this.updatePreview(field));
                    }
                });
            }

            setupImagePreviews() {
                document.querySelectorAll('.service-item-card').forEach(card => {
                    const fileInput = card.querySelector('input[type="file"]');
                    const preview = card.querySelector('.image-preview');

                    if (fileInput && preview) {
                        fileInput.addEventListener('change', (e) => {
                            if (e.target.files && e.target.files[0]) {
                                const reader = new FileReader();
                                reader.onload = (e) => {
                                    const img = preview.querySelector('img');
                                    if (img) img.src = e.target.result;
                                    preview.style.display = 'block';
                                };
                                reader.readAsDataURL(e.target.files[0]);
                            }
                        });
                    }
                });
            }

            updatePreview(field) {
                const input = document.getElementById(field.input);
                if (!input) return;

                if (field.isButton) {
                    const buttons = document.querySelectorAll('.cta-buttons .cta-button');
                    if (buttons[field.index]) {
                        if (field.attr) {
                            buttons[field.index].setAttribute(field.attr, input.value);
                        } else {
                            buttons[field.index].textContent = input.value;
                        }
                    }
                } else {
                    const preview = document.getElementById(field.preview);
                    if (preview) {
                        preview.textContent = input.value;
                    }
                }
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

            addServiceItem() {
                const newIndex = this.serviceCount++;
                const newDelay = `${(newIndex * 0.1 + 0.1).toFixed(1)}s`;

                const serviceHtml = `
            <div class="service-item-card" data-index="${newIndex}">
                <div class="service-item-header">
                    <div class="service-item-number">${newIndex + 1}</div>
                    <button type="button" class="admin-btn btn-danger remove-service" aria-label="Remove service item">
                        <i class="fas fa-trash"></i> Remove
                    </button>
                </div>
                
                <div class="service-item-fields">
                    <div class="form-group">
                        <label>Service Title *</label>
                        <input type="text" name="services[${newIndex}][title]" class="form-control" placeholder="Service Title" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Service Description *</label>
                        <textarea name="services[${newIndex}][description]" class="form-control" placeholder="Service Description" required></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label>Service Icon</label>
                        <input type="file" name="service_icons[${newIndex}]" class="form-control" accept="image/*">
                        <div class="image-preview" style="display: none;">
                            <img src="" alt="Icon preview">
                            <p class="text-sm text-gray-600 mt-2">New icon</p>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Icon Alt Text *</label>
                        <input type="text" name="services[${newIndex}][iconAlt]" class="form-control" placeholder="Icon Alt Text" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Border Color *</label>
                        <select name="services[${newIndex}][borderColor]" class="form-control">
                            <option value="primary">Primary Color</option>
                            <option value="secondary">Secondary Color</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Link URL *</label>
                        <input type="text" name="services[${newIndex}][linkUrl]" class="form-control" placeholder="Learn More URL" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Link ARIA Label *</label>
                        <input type="text" name="services[${newIndex}][linkAriaLabel]" class="form-control" placeholder="Learn More ARIA Label" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Animation Delay *</label>
                        <input type="text" name="services[${newIndex}][animationDelay]" value="${newDelay}" class="form-control" placeholder="Animation Delay" required>
                    </div>
                </div>
            </div>
        `;

                this.elements.serviceItemsContainer.insertAdjacentHTML('beforeend', serviceHtml);
                this.setupImagePreviews();
            }

            removeServiceItem(card) {
                if (this.elements.serviceItemsContainer.children.length <= 1) {
                    this.showNotification('At least one service item is required.', 'error');
                    return;
                }

                if (confirm('Are you sure you want to remove this service item?')) {
                    card.remove();
                    this.renumberServiceItems();
                }
            }

            renumberServiceItems() {
                const cards = this.elements.serviceItemsContainer.querySelectorAll('.service-item-card');
                cards.forEach((card, index) => {
                    const number = card.querySelector('.service-item-number');
                    if (number) number.textContent = index + 1;
                });
                this.serviceCount = cards.length;
            }

            validateForm(e) {
                let isValid = true;
                this.clearErrors();

                // Validate required fields
                const requiredFields = [
                    'sectionHeading', 'sectionDescription', 'ctaHeading', 'ctaDescription',
                    'ctaButton1Text', 'ctaButton1Url', 'ctaButton1AriaLabel',
                    'ctaButton2Text', 'ctaButton2Url', 'ctaButton2AriaLabel'
                ];

                requiredFields.forEach(fieldId => {
                    const field = document.getElementById(fieldId);
                    if (!field.value.trim()) {
                        this.showError(fieldId, 'This field is required.');
                        isValid = false;
                    }
                });

                // Validate service items
                const serviceCards = document.querySelectorAll('.service-item-card');
                if (serviceCards.length === 0) {
                    this.showError('serviceItemsContainer', 'At least one service item is required.');
                    isValid = false;
                }

                serviceCards.forEach((card, index) => {
                    const inputs = card.querySelectorAll(
                        'input[required], textarea[required], select[required]');
                    inputs.forEach(input => {
                        if (!input.value.trim()) {
                            const fieldName = input.getAttribute('name');
                            this.showError(fieldName, 'This field is required.');
                            isValid = false;
                        }
                    });
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

            resetToDefault() {
                if (confirm('Are you sure you want to reset all changes to default values?')) {
                    this.elements.servicesForm.reset();
                    this.showNotification('Form has been reset to default values.', 'info');
                }
            }

            previewChanges() {
                this.showNotification('Preview functionality would show how changes look before saving.', 'info');
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
                setTimeout(() => notification.remove(), 3000);
            }
        }

        // Initialize the services section manager
        document.addEventListener('DOMContentLoaded', () => {
            new ServicesSectionManager();
        });
    </script>
@endpush
