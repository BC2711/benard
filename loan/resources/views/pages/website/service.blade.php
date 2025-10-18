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

        .service-items-container .service-item-row {
            display: flex;
            gap: 12px;
            align-items: center;
            margin-bottom: 12px;
            padding: 12px;
            background: #f8f9fa;
            border-radius: 8px;
            border: 1px solid #e9ecef;
            flex-wrap: wrap;
        }

        .service-item-row .form-control {
            flex: 1;
            min-width: 150px;
            margin-bottom: 0;
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

            .service-item-row {
                flex-direction: column;
                align-items: stretch;
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

    <!-- Services Preview -->
    <div class="services-preview-container">
        <section class="services-section" aria-label="Services Section Preview">
            <div class="services-container">
                <div class="section-title" id="sectionTitle">
                    <h2 class="section-heading" id="previewSectionHeading">{{ $servicesData['sectionHeading'] }}</h2>
                    <p class="section-description" id="previewSectionDescription">
                        {{ $servicesData['sectionDescription'] }}
                    </p>
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
                    <p class="cta-description" id="previewCtaDescription">
                        {{ $servicesData['cta']['description'] }}
                    </p>
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
            <i class="fas fa-edit"></i>
            Manage Services Content
        </h3>

        <form id="servicesForm" method="POST" action="{{ route('management.service-section') }}" enctype="multipart/form-data"
            novalidate>
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Left Column -->
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

                <!-- Right Column -->
                <div class="space-y-6">
                    <div class="form-group">
                        <label for="ctaHeading">CTA Heading *</label>
                        <input type="text" id="ctaHeading" name="cta[heading]"
                            value="{{ old('cta.heading', $servicesData['cta']['heading']) }}" class="form-control"
                            placeholder="Enter CTA heading..." required>
                        <span class="error-message" id="ctaHeadingError"></span>
                    </div>

                    <div class="form-group">
                        <label for="ctaDescription">CTA Description *</label>
                        <textarea id="ctaDescription" name="cta[description]" class="form-control" rows="4"
                            placeholder="Enter CTA description..." required>{{ old('cta.description', $servicesData['cta']['description']) }}</textarea>
                        <span class="error-message" id="ctaDescriptionError"></span>
                    </div>
                </div>
            </div>

            <!-- Service Items -->
            <div class="form-group">
                <label>Service Items</label>
                <div id="serviceItemsContainer" class="service-items-container">
                    @foreach ($servicesData['services'] as $index => $service)
                        <div class="service-item-row">
                            <input type="text" name="services[{{ $index }}][title]"
                                class="form-control service-title-input"
                                value="{{ old("services.$index.title", $service['title']) }}" placeholder="Service Title"
                                required>
                            <textarea name="services[{{ $index }}][description]" class="form-control service-description-input"
                                placeholder="Service Description" required>{{ old("services.$index.description", $service['description']) }}</textarea>
                            <input type="file" name="services[{{ $index }}][icon]"
                                class="form-control service-icon-input" accept="image/*">
                            <div class="image-preview">
                                <img src="{{ asset($service['icon']) }}" alt="Current icon">
                                <p class="text-sm text-gray-600 mt-2 text-center">Current icon</p>
                            </div>
                            <input type="text" name="services[{{ $index }}][iconAlt]"
                                class="form-control service-icon-alt-input"
                                value="{{ old("services.$index.iconAlt", $service['iconAlt']) }}"
                                placeholder="Icon Alt Text" required>
                            <select name="services[{{ $index }}][borderColor]"
                                class="form-control service-border-color-input">
                                <option value="primary" {{ $service['borderColor'] == 'primary' ? 'selected' : '' }}>
                                    Primary Color</option>
                                <option value="secondary" {{ $service['borderColor'] == 'secondary' ? 'selected' : '' }}>
                                    Secondary Color</option>
                            </select>
                            <input type="text" name="services[{{ $index }}][linkUrl]"
                                class="form-control service-link-url-input"
                                value="{{ old("services.$index.linkUrl", $service['linkUrl']) }}"
                                placeholder="Learn More URL" required>
                            <input type="text" name="services[{{ $index }}][linkAriaLabel]"
                                class="form-control service-link-aria-label-input"
                                value="{{ old("services.$index.linkAriaLabel", $service['linkAriaLabel']) }}"
                                placeholder="Learn More ARIA Label" required>
                            <input type="text" name="services[{{ $index }}][animationDelay]"
                                class="form-control service-animation-delay-input"
                                value="{{ old("services.$index.animationDelay", $service['animationDelay']) }}"
                                placeholder="Animation Delay" required>
                            <button type="button" class="admin-btn btn-danger remove-service"
                                aria-label="Remove service item">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    @endforeach
                </div>
                <button type="button" class="admin-btn btn-save mt-3" id="addServiceItem">
                    <i class="fas fa-plus"></i> Add Service Item
                </button>
            </div>

            <!-- CTA Buttons -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="form-group">
                    <label for="ctaButton1Text">CTA Button 1 Text *</label>
                    <input type="text" id="ctaButton1Text" name="cta[buttons][0][text]"
                        value="{{ old('cta.buttons.0.text', $servicesData['cta']['buttons'][0]['text']) }}"
                        class="form-control" placeholder="Button text..." required>
                    <span class="error-message" id="ctaButton1TextError"></span>
                </div>

                <div class="form-group">
                    <label for="ctaButton1Url">CTA Button 1 URL *</label>
                    <input type="url" id="ctaButton1Url" name="cta[buttons][0][url]"
                        value="{{ old('cta.buttons.0.url', $servicesData['cta']['buttons'][0]['url']) }}"
                        class="form-control" placeholder="https://..." required>
                    <span class="error-message" id="ctaButton1UrlError"></span>
                </div>

                <div class="form-group">
                    <label for="ctaButton1AriaLabel">CTA Button 1 ARIA Label *</label>
                    <input type="text" id="ctaButton1AriaLabel" name="cta[buttons][0][ariaLabel]"
                        value="{{ old('cta.buttons.0.ariaLabel', $servicesData['cta']['buttons'][0]['ariaLabel']) }}"
                        class="form-control" placeholder="ARIA label..." required>
                    <span class="error-message" id="ctaButton1AriaLabelError"></span>
                </div>

                <div class="form-group">
                    <label for="ctaButton2Text">CTA Button 2 Text *</label>
                    <input type="text" id="ctaButton2Text" name="cta[buttons][1][text]"
                        value="{{ old('cta.buttons.1.text', $servicesData['cta']['buttons'][1]['text']) }}"
                        class="form-control" placeholder="Button text..." required>
                    <span class="error-message" id="ctaButton2TextError"></span>
                </div>

                <div class="form-group">
                    <label for="ctaButton2Url">CTA Button 2 URL *</label>
                    <input type="url" id="ctaButton2Url" name="cta[buttons][1][url]"
                        value="{{ old('cta.buttons.1.url', $servicesData['cta']['buttons'][1]['url']) }}"
                        class="form-control" placeholder="https://..." required>
                    <span class="error-message" id="ctaButton2UrlError"></span>
                </div>

                <div class="form-group">
                    <label for="ctaButton2AriaLabel">CTA Button 2 ARIA Label *</label>
                    <input type="text" id="ctaButton2AriaLabel" name="cta[buttons][1][ariaLabel]"
                        value="{{ old('cta.buttons.1.ariaLabel', $servicesData['cta']['buttons'][1]['ariaLabel']) }}"
                        class="form-control" placeholder="ARIA label..." required>
                    <span class="error-message" id="ctaButton2AriaLabelError"></span>
                </div>
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

                this.init();
            }

            init() {
                this.setupEventListeners();
                this.setupRealTimePreview();
            }

            setupEventListeners() {
                // Toggle admin panel
                this.elements.toggleAdminBtn.addEventListener('click', () => this.toggleAdminPanel());

                // Cancel edit
                this.elements.cancelEditBtn.addEventListener('click', () => this.hideAdminPanel());

                // Add service item
                this.elements.addServiceItemBtn.addEventListener('click', () => this.addServiceItem());

                // Form submission
                this.elements.servicesForm.addEventListener('submit', (e) => this.validateForm(e));

                // Remove service item delegation
                this.elements.serviceItemsContainer.addEventListener('click', (e) => {
                    if (e.target.closest('.remove-service')) {
                        this.removeServiceItem(e.target.closest('.remove-service'));
                    }
                });

                // Reset to default
                this.elements.resetToDefaultBtn.addEventListener('click', () => this.resetToDefault());

                // Preview changes
                this.elements.previewChangesBtn.addEventListener('click', () => this.previewChanges());
            }

            setupRealTimePreview() {
                // Real-time preview updates
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
                        input.addEventListener('input', () => {
                            this.updatePreview(field);
                        });
                    }
                });
            }

            updatePreview(field) {
                const input = document.getElementById(field.input);

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
                const serviceRows = document.querySelectorAll('.service-item-row');
                const newIndex = serviceRows.length;
                const newDelay = `${(newIndex * 0.1 + 0.1).toFixed(1)}s`;

                const serviceHtml = `
                    <div class="service-item-row">
                        <input type="text" name="services[${newIndex}][title]" 
                               class="form-control service-title-input" 
                               placeholder="Service Title" required>
                        <textarea name="services[${newIndex}][description]" 
                                  class="form-control service-description-input" 
                                  placeholder="Service Description" required></textarea>
                        <input type="file" name="services[${newIndex}][icon]" 
                               class="form-control service-icon-input" accept="image/*">
                        <div class="image-preview" style="display: none;">
                            <img src="" alt="Icon preview">
                            <p class="text-sm text-gray-600 mt-2 text-center">New icon</p>
                        </div>
                        <input type="text" name="services[${newIndex}][iconAlt]" 
                               class="form-control service-icon-alt-input" 
                               placeholder="Icon Alt Text" required>
                        <select name="services[${newIndex}][borderColor]" 
                                class="form-control service-border-color-input">
                            <option value="primary">Primary Color</option>
                            <option value="secondary">Secondary Color</option>
                        </select>
                        <input type="text" name="services[${newIndex}][linkUrl]" 
                               class="form-control service-link-url-input" 
                               placeholder="Learn More URL" required>
                        <input type="text" name="services[${newIndex}][linkAriaLabel]" 
                               class="form-control service-link-aria-label-input" 
                               placeholder="Learn More ARIA Label" required>
                        <input type="text" name="services[${newIndex}][animationDelay]" 
                               class="form-control service-animation-delay-input" 
                               value="${newDelay}" placeholder="Animation Delay" required>
                        <button type="button" class="admin-btn btn-danger remove-service" 
                                aria-label="Remove service item">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                `;

                this.elements.serviceItemsContainer.insertAdjacentHTML('beforeend', serviceHtml);

                // Setup image preview for the new item
                this.setupImagePreview(this.elements.serviceItemsContainer.lastElementChild);
            }

            setupImagePreview(row) {
                const fileInput = row.querySelector('.service-icon-input');
                const preview = row.querySelector('.image-preview');
                const previewImg = preview.querySelector('img');

                fileInput.addEventListener('change', (e) => {
                    if (e.target.files && e.target.files[0]) {
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            previewImg.src = e.target.result;
                            preview.style.display = 'block';
                        };
                        reader.readAsDataURL(e.target.files[0]);
                    } else {
                        preview.style.display = 'none';
                    }
                });
            }

            removeServiceItem(button) {
                if (confirm('Are you sure you want to remove this service item?')) {
                    button.closest('.service-item-row').remove();
                }
            }

            validateForm(e) {
                let isValid = true;

                // Clear previous errors
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

                // Validate URL format
                const urlFields = ['ctaButton1Url', 'ctaButton2Url'];
                urlFields.forEach(fieldId => {
                    const field = document.getElementById(fieldId);
                    if (field.value && !this.isValidUrl(field.value)) {
                        this.showError(fieldId, 'Please enter a valid URL.');
                        isValid = false;
                    }
                });

                // Validate service items
                const serviceRows = document.querySelectorAll('.service-item-row');
                if (serviceRows.length === 0) {
                    this.showError('serviceItemsContainer', 'At least one service item is required.');
                    isValid = false;
                }

                serviceRows.forEach((row, index) => {
                    const titleInput = row.querySelector('.service-title-input');
                    const descriptionInput = row.querySelector('.service-description-input');
                    const iconAltInput = row.querySelector('.service-icon-alt-input');
                    const linkUrlInput = row.querySelector('.service-link-url-input');
                    const linkAriaLabelInput = row.querySelector('.service-link-aria-label-input');
                    const animationDelayInput = row.querySelector('.service-animation-delay-input');

                    if (!titleInput.value.trim()) {
                        this.showError(`services[${index}][title]`, 'Service title is required.');
                        isValid = false;
                    }
                    if (!descriptionInput.value.trim()) {
                        this.showError(`services[${index}][description]`, 'Service description is required.');
                        isValid = false;
                    }
                    if (!iconAltInput.value.trim()) {
                        this.showError(`services[${index}][iconAlt]`, 'Icon alt text is required.');
                        isValid = false;
                    }
                    if (!linkUrlInput.value.trim()) {
                        this.showError(`services[${index}][linkUrl]`, 'Link URL is required.');
                        isValid = false;
                    }
                    if (!linkAriaLabelInput.value.trim()) {
                        this.showError(`services[${index}][linkAriaLabel]`, 'Link ARIA label is required.');
                        isValid = false;
                    }
                    if (!animationDelayInput.value.trim()) {
                        this.showError(`services[${index}][animationDelay]`, 'Animation delay is required.');
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
                    this.elements.servicesForm.reset();
                    this.showNotification('Form has been reset to default values.', 'info');
                }
            }

            previewChanges() {
                // In a real implementation, this would show a preview modal
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

                setTimeout(() => {
                    notification.remove();
                }, 3000);
            }
        }

        // Initialize the services section manager
        document.addEventListener('DOMContentLoaded', () => {
            const manager = new ServicesSectionManager();

            // Setup image previews for existing items
            document.querySelectorAll('.service-item-row').forEach(row => {
                manager.setupImagePreview(row);
            });
        });
    </script>
@endpush
