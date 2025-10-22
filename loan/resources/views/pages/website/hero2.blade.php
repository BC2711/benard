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

        .hero-preview-container {
            background: linear-gradient(135deg, var(--secondary-color) 0%, var(--primary-color) 100%);
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 2rem;
            box-shadow: var(--shadow);
        }

        .hero-section {
            color: var(--white);
            padding: clamp(2rem, 4vw, 3rem) 0;
            position: relative;
            overflow: hidden;
            isolation: isolate;
        }

        .hero-images {
            position: absolute;
            top: 0;
            right: 0;
            width: 50%;
            height: 100%;
            z-index: 0;
        }

        .hero-image {
            position: absolute;
            max-width: 200px;
            height: auto;
            animation: float 3s ease-in-out infinite;
        }

        .hero-image--main {
            top: 10%;
            right: 0;
            max-width: 100%;
            max-height: 80%;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .hero-image--shape1 {
            top: 10%;
            left: -10%;
            display: none;
            animation-duration: 3s;
        }

        .hero-image--shape2 {
            bottom: 10%;
            right: 10%;
            display: none;
            animation-duration: 4s;
        }

        .hero-image--shape3 {
            top: 50%;
            right: 20%;
            display: none;
            animation-duration: 5s;
        }

        .hero-image--shape4 {
            bottom: 20%;
            left: 20%;
            animation-duration: 3.5s;
        }

        .hero-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 clamp(1rem, 3vw, 2rem);
            position: relative;
            z-index: 1;
        }

        .hero-text {
            max-width: 600px;
            animation: fadeIn 0.5s ease-in;
        }

        .logo-container {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
            text-decoration: none;
            gap: 0.5rem;
        }

        .logo-text {
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .logo-londa {
            font-size: clamp(1.75rem, 3vw, 2rem);
            font-weight: 700;
            color: var(--white);
        }

        .logo-loans {
            font-size: clamp(1.75rem, 3vw, 2rem);
            font-weight: 700;
            color: var(--primary-color);
        }

        .logo-tagline {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.8);
            font-style: italic;
        }

        .hero-heading {
            font-size: clamp(2rem, 5vw, 2.5rem);
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 1rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .hero-description {
            font-size: clamp(0.9rem, 2vw, 1rem);
            opacity: 0.9;
            line-height: 1.6;
            margin-bottom: 1.5rem;
            max-width: 500px;
        }

        .hero-cta {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            align-items: center;
            margin-bottom: 2rem;
        }

        .cta-button {
            padding: 0.875rem 2rem;
            background-color: var(--primary-color);
            border: 2px solid var(--primary-color);
            color: var(--white);
            text-decoration: none;
            border-radius: 6px;
            font-weight: 700;
            transition: var(--transition);
            box-shadow: 0 4px 12px rgba(219, 145, 35, 0.3);
        }

        .cta-button:hover {
            background-color: transparent;
            color: var(--primary-color);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(219, 145, 35, 0.4);
        }

        .cta-contact {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .cta-phone {
            font-size: 1.1rem;
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 700;
            transition: var(--transition);
        }

        .cta-phone:hover {
            opacity: 0.8;
            transform: translateX(5px);
        }

        .cta-phone-subtext {
            font-size: 0.85rem;
            opacity: 0.8;
        }

        .trust-indicators {
            display: flex;
            flex-wrap: wrap;
            gap: clamp(1.5rem, 4vw, 3rem);
        }

        .trust-indicator {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .trust-value {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--primary-color);
            line-height: 1;
        }

        .trust-label {
            font-size: 0.9rem;
            opacity: 0.9;
            margin-top: 0.25rem;
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

        .trust-indicators-container .trust-item-row {
            display: flex;
            gap: 12px;
            align-items: center;
            margin-bottom: 12px;
            padding: 12px;
            background: #f8f9fa;
            border-radius: 8px;
            border: 1px solid #e9ecef;
        }

        .trust-item-row .form-control {
            flex: 1;
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
        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-12px);
            }
        }

        @keyframes fadeIn {
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
        @media (min-width: 1536px) {

            .hero-image--shape1,
            .hero-image--shape2,
            .hero-image--shape3 {
                display: block;
            }
        }

        @media (max-width: 1024px) {
            .hero-section {
                padding: 2rem 0;
            }

            .hero-images {
                width: 45%;
            }
        }

        @media (max-width: 768px) {
            .hero-images {
                width: 100%;
                height: 40%;
                opacity: 0.2;
            }

            .hero-cta {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .trust-indicators {
                gap: 1rem;
            }

            .trust-item-row {
                flex-direction: column;
                gap: 8px;
            }

            .form-actions {
                flex-direction: column;
            }

            .admin-btn {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .hero-content {
                padding: 0 1rem;
            }

            .logo-container {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.25rem;
            }
        }

        /* Utility Classes */
        .text-primary {
            color: var(--primary-color);
        }

        .text-secondary {
            color: var(--secondary-color);
        }

        .bg-light {
            background: #f8f9fa;
        }

        .rounded-lg {
            border-radius: 12px;
        }

        .shadow-sm {
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
    </style>
@endpush
@section('breadcrumbs')
    <nav class="flex items-center space-x-2">
        <a href="{{ route('management.dashboard') }}" class="text-sm text-gray-500 hover:text-gray-700">Website Management</a>
        <span class="text-gray-400">/</span>
        <span class="text-sm text-gray-500">Hero Section</span>
    </nav>
@endsection
@section('page-icon')
    <i class="fas fa-home fa-lg text-gray-700"></i>
@endsection
@section('page-title')
    <h1 class="text-2xl font-bold text-gray-900">Hero Section Management</h1>
    <p class="text-gray-600 text-sm mt-1">Customize and manage the hero section for your website. Changes are
        reflected in real-time.</p>
@endsection

@section('title', 'Hero Section Management')
@section('content')
    <div class="main-content">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div class="flex gap-2">
                    <button
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 flex items-center gap-2">
                        <i class="fas fa-eye"></i>
                        Preview
                    </button>
                    <button
                        class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-200 flex items-center gap-2">
                        <i class="fas fa-sync-alt"></i>
                        Reset
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Hero Preview -->
    <div class="hero-preview-container">
        <section class="hero-section" aria-label="Hero Section Preview">
            <div class="hero-images" id="heroImages">
                <img src="{{ asset('assets/images/shape-01.svg') }}" alt="Decorative shape"
                    class="hero-image hero-image--shape1">
                <img src="{{ asset('assets/images/shape-02.svg') }}" alt="Decorative shape"
                    class="hero-image hero-image--shape2">
                <img src="{{ asset('assets/images/shape-03.svg') }}" alt="Decorative shape"
                    class="hero-image hero-image--shape3">
                <img src="{{ asset('assets/images/shape-04.svg') }}" alt="Decorative shape"
                    class="hero-image hero-image--shape4">

                @if (isset($heroData['hero_image']) && $heroData['hero_image'])
                    <img src="{{ Storage::url($heroData['hero_image']) }}" alt="Woman representing business growth"
                        class="hero-image hero-image--main">
                @else
                    <img src="{{ asset('assets/images/hero.png') }}" alt="Woman representing business growth"
                        class="hero-image hero-image--main">
                @endif
            </div>

            <div class="hero-content">
                <div class="hero-text" id="heroText">
                    <a href="{{ route('management.dashboard') }}" class="logo-container">
                        <div class="logo-text">
                            <span class="logo-londa">Londa</span>
                            <span class="logo-loans">Loans</span>
                        </div>
                        <span class="logo-tagline">empowering marketeers</span>
                    </a>
                    <h1 class="hero-heading" id="previewHeading">
                        {{ $heroData['heading'] ?? 'Get a Loan for Your Business Growth or Startup' }}
                    </h1>
                    <p class="hero-description" id="previewDescription">
                        {{ $heroData['description'] ?? 'Fast, flexible financing solutions designed specifically for marketers and entrepreneurs. Grow your business with our tailored loan programs.' }}
                    </p>
                    <div class="hero-cta">
                        <a href="{{ $heroData['ctaButton']['url'] ?? '#!' }}" class="cta-button" id="previewCtaButton">
                            {{ $heroData['ctaButton']['text'] ?? 'Get Started Now' }}
                        </a>
                        <div class="cta-contact">
                            <a href="tel:{{ $heroData['ctaPhone'] ?? '+123456789' }}" class="cta-phone"
                                id="previewCtaPhone">
                                {{ $heroData['ctaPhone'] ?? '+123456789' }}
                            </a>
                            <span class="cta-phone-subtext" id="previewCtaPhoneSubtext">
                                {{ $heroData['ctaPhoneSubtext'] ?? 'For any question or concern' }}
                            </span>
                        </div>
                    </div>
                    <div class="trust-indicators" role="list" id="previewTrustIndicators">
                        @foreach ($heroData['trustIndicators'] ?? [] as $indicator)
                            <div class="trust-indicator" role="listitem">
                                <span class="trust-value">{{ $indicator['value'] ?? '' }}</span>
                                <span class="trust-label">{{ $indicator['label'] ?? '' }}</span>
                            </div>
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
            Manage Hero Content
        </h3>

        <form id="heroForm" action="{{ route('management.hero-section') }}" method="POST" novalidate
            enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Left Column -->
                <div class="space-y-6">
                    <div class="form-group">
                        <label for="heroHeading">Heading *</label>
                        <input type="text" id="heroHeading" name="heading" class="form-control"
                            value="{{ old('heading', $heroData['heading'] ?? '') }}"
                            placeholder="Enter compelling heading..." required>
                        <span class="error-message" id="heroHeadingError"></span>
                    </div>

                    <div class="form-group">
                        <label for="heroDescription">Description *</label>
                        <textarea id="heroDescription" name="description" class="form-control" rows="4"
                            placeholder="Describe your services..." required>{{ old('description', $heroData['description'] ?? '') }}</textarea>
                        <span class="error-message" id="heroDescriptionError"></span>
                    </div>

                    <div class="form-group">
                        <label for="ctaButtonText">CTA Button Text *</label>
                        <input type="text" id="ctaButtonText" name="ctaButtonText" class="form-control"
                            value="{{ old('ctaButtonText', $heroData['ctaButton']['text'] ?? '') }}"
                            placeholder="e.g., Get Started Now" required>
                        <span class="error-message" id="ctaButtonTextError"></span>
                    </div>

                    <div class="form-group">
                        <label for="ctaButtonUrl">CTA Button URL *</label>
                        <input type="url" id="ctaButtonUrl" name="ctaButtonUrl" class="form-control"
                            value="{{ old('ctaButtonUrl', $heroData['ctaButton']['url'] ?? '') }}"
                            placeholder="https://example.com/apply" required>
                        <span class="error-message" id="ctaButtonUrlError"></span>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <div class="form-group">
                        <label for="ctaPhone">Phone Number *</label>
                        <input type="tel" id="ctaPhone" name="ctaPhone" class="form-control"
                            value="{{ old('ctaPhone', $heroData['ctaPhone'] ?? '') }}" placeholder="+1234567890" required
                            pattern="[0-9+\-\s()]{10,}">
                        <span class="error-message" id="ctaPhoneError"></span>
                    </div>

                    <div class="form-group">
                        <label for="ctaPhoneSubtext">Phone Subtext *</label>
                        <input type="text" id="ctaPhoneSubtext" name="ctaPhoneSubtext" class="form-control"
                            value="{{ old('ctaPhoneSubtext', $heroData['ctaPhoneSubtext'] ?? '') }}"
                            placeholder="e.g., Available 24/7" required>
                        <span class="error-message" id="ctaPhoneSubtextError"></span>
                    </div>

                    <div class="form-group">
                        <label for="heroImage">Hero Image</label>
                        <input type="file" id="heroImage" name="hero_image" class="form-control" accept="image/*">
                        @if (isset($heroData['hero_image']) && $heroData['hero_image'])
                            <div class="image-preview">
                                <img src="{{ Storage::url($heroData['hero_image']) }}" alt="Current hero image">
                                <p class="text-sm text-gray-600 mt-2 text-center">Current image</p>
                            </div>
                        @endif
                        <span class="error-message" id="heroImageError"></span>
                    </div>
                </div>
            </div>

            <!-- Trust Indicators -->
            <div class="form-group">
                <label>Trust Indicators</label>
                <div id="trustIndicatorsContainer" class="trust-indicators-container">
                    @foreach ($heroData['trustIndicators'] ?? [] as $index => $indicator)
                        <div class="trust-item-row">
                            <input type="text" name="trustIndicators[{{ $index }}][value]"
                                class="form-control trust-value-input"
                                value="{{ old("trustIndicators.$index.value", $indicator['value'] ?? '') }}"
                                data-id="{{ $index }}" placeholder="Value (e.g., 500+)">
                            <input type="text" name="trustIndicators[{{ $index }}][label]"
                                class="form-control trust-label-input"
                                value="{{ old("trustIndicators.$index.label", $indicator['label'] ?? '') }}"
                                data-id="{{ $index }}" placeholder="Label (e.g., Marketeers Funded)">
                            <button type="button" class="admin-btn btn-danger remove-trust-indicator"
                                data-id="{{ $index }}" aria-label="Remove trust indicator">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    @endforeach
                </div>
                <button type="button" class="admin-btn btn-save mt-3" id="addTrustIndicator">
                    <i class="fas fa-plus"></i> Add Trust Indicator
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
    <script>
        class HeroSectionManager {
            constructor() {
                this.elements = {
                    adminPanel: document.getElementById('adminPanel'),
                    toggleAdminBtn: document.getElementById('toggleAdmin'),
                    heroForm: document.getElementById('heroForm'),
                    cancelEditBtn: document.getElementById('cancelEdit'),
                    trustIndicatorsContainer: document.getElementById('trustIndicatorsContainer'),
                    addTrustIndicatorBtn: document.getElementById('addTrustIndicator')
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

                // Add trust indicator
                this.elements.addTrustIndicatorBtn.addEventListener('click', () => this.addTrustIndicator());

                // Form submission
                this.elements.heroForm.addEventListener('submit', (e) => this.validateForm(e));

                // Remove trust indicator delegation
                this.elements.trustIndicatorsContainer.addEventListener('click', (e) => {
                    if (e.target.closest('.remove-trust-indicator')) {
                        this.removeTrustIndicator(e.target.closest('.remove-trust-indicator'));
                    }
                });
            }

            setupRealTimePreview() {
                // Real-time preview updates
                const previewFields = [{
                        input: 'heroHeading',
                        preview: 'previewHeading'
                    },
                    {
                        input: 'heroDescription',
                        preview: 'previewDescription'
                    },
                    {
                        input: 'ctaButtonText',
                        preview: 'previewCtaButton'
                    },
                    {
                        input: 'ctaButtonUrl',
                        preview: 'previewCtaButton',
                        attr: 'href'
                    },
                    {
                        input: 'ctaPhone',
                        preview: 'previewCtaPhone'
                    },
                    {
                        input: 'ctaPhone',
                        preview: 'previewCtaPhone',
                        attr: 'href',
                        prefix: 'tel:'
                    },
                    {
                        input: 'ctaPhoneSubtext',
                        preview: 'previewCtaPhoneSubtext'
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
                const preview = document.getElementById(field.preview);

                if (input && preview) {
                    if (field.attr) {
                        let value = input.value;
                        if (field.prefix) {
                            value = field.prefix + value;
                        }
                        preview.setAttribute(field.attr, value);
                    } else {
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

            addTrustIndicator() {
                const trustRows = document.querySelectorAll('.trust-item-row');
                const newId = trustRows.length > 0 ?
                    parseInt(trustRows[trustRows.length - 1].querySelector('.trust-value-input').dataset.id) + 1 : 0;

                const indicatorHtml = `
                    <div class="trust-item-row">
                        <input type="text" name="trustIndicators[${newId}][value]" 
                               class="form-control trust-value-input" data-id="${newId}" 
                               placeholder="Value (e.g., 500+)" required>
                        <input type="text" name="trustIndicators[${newId}][label]" 
                               class="form-control trust-label-input" data-id="${newId}" 
                               placeholder="Label (e.g., Marketeers Funded)" required>
                        <button type="button" class="admin-btn btn-danger remove-trust-indicator" 
                                data-id="${newId}" aria-label="Remove trust indicator">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                `;

                this.elements.trustIndicatorsContainer.insertAdjacentHTML('beforeend', indicatorHtml);
            }

            removeTrustIndicator(button) {
                if (confirm('Are you sure you want to remove this trust indicator?')) {
                    button.closest('.trust-item-row').remove();
                }
            }

            validateForm(e) {
                let isValid = true;

                // Clear previous errors
                this.clearErrors();

                // Validate required fields
                const requiredFields = [
                    'heroHeading', 'heroDescription', 'ctaButtonText',
                    'ctaButtonUrl', 'ctaPhone', 'ctaPhoneSubtext'
                ];

                requiredFields.forEach(fieldId => {
                    const field = document.getElementById(fieldId);
                    if (!field.value.trim()) {
                        this.showError(fieldId, 'This field is required.');
                        isValid = false;
                    }
                });

                // Validate URL format
                const urlField = document.getElementById('ctaButtonUrl');
                if (urlField.value && !this.isValidUrl(urlField.value)) {
                    this.showError('ctaButtonUrl', 'Please enter a valid URL.');
                    isValid = false;
                }

                // Validate phone format
                const phoneField = document.getElementById('ctaPhone');
                if (phoneField.value && !this.isValidPhone(phoneField.value)) {
                    this.showError('ctaPhone', 'Please enter a valid phone number.');
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

            isValidPhone(phone) {
                const phoneRegex = /^[+]?[0-9\s\-()]{10,}$/;
                return phoneRegex.test(phone);
            }
        }

        // Initialize the hero section manager
        document.addEventListener('DOMContentLoaded', () => {
            new HeroSectionManager();
        });
    </script>
@endpush
