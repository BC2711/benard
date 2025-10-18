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

        .cta-preview-container {
            background: linear-gradient(135deg, var(--secondary-color) 0%, var(--primary-color) 100%);
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 2rem;
            box-shadow: var(--shadow);
        }

        .cta-section {
            color: #fff;
            padding: clamp(2rem, 4vw, 3rem) 0;
            position: relative;
            overflow: hidden;
            isolation: isolate;
        }

        .cta-shape {
            position: absolute;
            animation: float 3.5s ease-in-out infinite;
            pointer-events: none;
        }

        .cta-shape--circle {
            top: 10%;
            left: 5%;
            width: clamp(100px, 10vw, 150px);
            height: clamp(100px, 10vw, 150px);
            background-color: var(--white);
            opacity: 0.1;
            border-radius: 50%;
            animation-duration: 3s;
        }

        .cta-shape--bottom-left,
        .cta-shape--top-right,
        .cta-shape--bottom-right {
            max-width: clamp(60px, 8vw, 90px);
        }

        .cta-shape--bottom-left {
            bottom: 15%;
            left: 10%;
            animation-duration: 4.2s;
        }

        .cta-shape--top-right {
            top: 15%;
            right: 5%;
            animation-duration: 3.5s;
        }

        .cta-shape--bottom-right {
            bottom: 10%;
            right: 15%;
            animation-duration: 3.8s;
        }

        .cta-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 clamp(1rem, 3vw, 2rem);
            position: relative;
            z-index: 1;
        }

        .cta-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: clamp(1rem, 3vw, 2rem);
            align-items: center;
        }

        .cta-content {
            animation: fadeInLeft 0.6s ease-in;
        }

        .cta-title {
            font-size: clamp(1.75rem, 4vw, 2.25rem);
            font-weight: 700;
            color: var(--white);
            line-height: 1.3;
            margin-bottom: 1rem;
        }

        .cta-description {
            font-size: clamp(0.9rem, 2vw, 1rem);
            color: var(--white);
            line-height: 1.6;
            margin-bottom: 1.5rem;
            opacity: 0.9;
        }

        .trust-indicators {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
        }

        .trust-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .trust-icon {
            width: 20px;
            height: 20px;
            color: var(--white);
            flex-shrink: 0;
        }

        .trust-text {
            font-size: 0.9rem;
            color: var(--white);
            opacity: 0.9;
        }

        .cta-actions {
            animation: fadeInRight 0.6s ease-in;
        }

        .cta-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        .cta-button {
            padding: 0.75rem 1.5rem;
            text-decoration: none;
            border-radius: 4px;
            font-weight: 600;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 2px solid transparent;
            font-size: 0.95rem;
        }

        .cta-button-primary {
            background-color: var(--white);
            border-color: var(--white);
            color: var(--primary-color);
        }

        .cta-button-secondary {
            border-color: var(--white);
            color: var(--white);
            background-color: transparent;
        }

        .cta-button:hover {
            transform: translateY(-2px);
        }

        .cta-button-primary:hover {
            background-color: transparent;
            color: var(--white);
        }

        .cta-button-secondary:hover {
            background-color: var(--white);
            color: var(--primary-color);
        }

        .cta-note {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
        }

        .note-icon {
            width: 20px;
            height: 20px;
            color: var(--white);
            flex-shrink: 0;
        }

        .note-text {
            font-size: 0.9rem;
            color: var(--white);
            opacity: 0.8;
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

        .trust-item-row,
        .button-row {
            display: flex;
            gap: 12px;
            align-items: center;
            margin-bottom: 12px;
            padding: 12px;
            background: #f8f9fa;
            border-radius: 8px;
            border: 1px solid #e9ecef;
        }

        .trust-item-row .form-control,
        .button-row .form-control {
            flex: 1;
            margin-bottom: 0;
        }

        .button-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            width: 100%;
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
                transform: translateY(-8px);
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
            .cta-grid {
                grid-template-columns: 1fr;
            }

            .trust-indicators {
                grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .cta-shape {
                display: none;
            }

            .cta-buttons {
                flex-direction: column;
                align-items: center;
            }

            .trust-indicators {
                grid-template-columns: 1fr;
            }

            .button-details {
                grid-template-columns: 1fr;
            }

            .trust-item-row,
            .button-row {
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
            .cta-container {
                padding: 0 1rem;
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

@section('content')
    <div class="main-content">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">CTA Section Management</h1>
                    <p class="text-gray-600 text-sm mt-1">Customize and manage the Call-to-Action section for your website.
                    </p>
                </div>
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

    <!-- CTA Preview -->
    <div class="cta-preview-container">
        <section class="cta-section" id="call-to-action" aria-labelledby="ctaTitle">
            <!-- Background Shapes -->
            @if ($ctaData['background']['shapes'] ?? true)
                <div class="cta-shape cta-shape--circle" aria-hidden="true"></div>
                <img src="{{ asset('images/shapes/bottom-left.png') }}" alt=""
                    class="cta-shape cta-shape--bottom-left" aria-hidden="true" />
                <img src="{{ asset('images/shapes/top-right.png') }}" alt="" class="cta-shape cta-shape--top-right"
                    aria-hidden="true" />
                <img src="{{ asset('images/shapes/bottom-right.png') }}" alt=""
                    class="cta-shape cta-shape--bottom-right" aria-hidden="true" />
            @endif

            <!-- Main Content -->
            <div class="cta-container">
                <div class="cta-grid">
                    <!-- Text and Trust Indicators -->
                    <div class="cta-content">
                        <h2 class="cta-title" id="previewCtaTitle">
                            {{ $ctaData['headline'] ?? 'Join 500+ Marketeers Growing Their Business with Londa Loans' }}
                        </h2>
                        <p class="cta-description" id="previewCtaDescription">
                            {{ $ctaData['subheadline'] ?? 'Get the funding you need to launch campaigns, scale your agency, and achieve your marketing goals. Fast approval, flexible terms, and expert support.' }}
                        </p>

                        <!-- Trust Indicators -->
                        <div class="trust-indicators" id="previewTrustIndicators" role="list">
                            @foreach ($ctaData['trust_indicators'] ?? [] as $indicator)
                                <div class="trust-item" role="listitem">
                                    <svg class="trust-icon" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="trust-text">{{ $indicator['text'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- CTA Buttons and Additional Info -->
                    <div class="cta-actions">
                        <div class="cta-buttons" id="previewCtaButtons" role="navigation">
                            @foreach ($ctaData['buttons'] ?? [] as $button)
                                <a href="{{ $button['url'] }}" class="cta-button cta-button-{{ $button['type'] }}"
                                    aria-label="{{ $button['aria_label'] }}">
                                    {{ $button['text'] }}
                                </a>
                            @endforeach
                        </div>
                        <div class="cta-note">
                            <svg class="note-icon" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="note-text"
                                id="previewCtaNote">{{ $ctaData['note'] ?? 'No credit check required for initial inquiry' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Admin Panel -->
    <div class="admin-panel" id="adminPanel" role="dialog" aria-labelledby="adminPanelTitle" aria-modal="true">
        <h3 id="adminPanelTitle">
            <i class="fas fa-edit"></i>
            Manage CTA Section
        </h3>

        <form id="ctaForm" action="{{ route('management.cta-section') }}" method="POST" novalidate>
            @csrf

            <!-- Main Content -->
            <div class="form-group">
                <label for="headline">Headline *</label>
                <input type="text" id="headline" name="headline" class="form-control"
                    value="{{ old('headline', $section->headline ?? '') }}"
                    placeholder="Join 500+ Marketeers Growing Their Business with Londa Loans" required maxlength="200">
                <span class="error-message" id="headlineError"></span>
            </div>

            <div class="form-group">
                <label for="subheadline">Subheadline *</label>
                <textarea id="subheadline" name="subheadline" class="form-control" rows="4"
                    placeholder="Get the funding you need to launch campaigns, scale your agency, and achieve your marketing goals. Fast approval, flexible terms, and expert support."
                    maxlength="500" required>{{ old('subheadline', $section->subheadline ?? '') }}</textarea>
                <span class="error-message" id="subheadlineError"></span>
            </div>

            <div class="form-group">
                <label for="note">Note Text *</label>
                <input type="text" id="note" name="note" class="form-control"
                    value="{{ old('note', $section->note ?? '') }}"
                    placeholder="No credit check required for initial inquiry" required maxlength="200">
                <span class="error-message" id="noteError"></span>
            </div>

            <!-- Trust Indicators -->
            <div class="form-group">
                <label>Trust Indicators</label>
                <div id="trustIndicatorsContainer">
                    @foreach ($ctaData['trust_indicators'] ?? [] as $index => $indicator)
                        <div class="trust-item-row">
                            <input type="text" name="trust_indicators[{{ $index }}][text]"
                                class="form-control" value="{{ $indicator['text'] }}" placeholder="Trust indicator text"
                                required maxlength="100">
                            <select name="trust_indicators[{{ $index }}][icon]" class="form-control" required>
                                <option value="check" {{ $indicator['icon'] == 'check' ? 'selected' : '' }}>Check Icon
                                </option>
                                <option value="star" {{ $indicator['icon'] == 'star' ? 'selected' : '' }}>Star Icon
                                </option>
                                <option value="shield" {{ $indicator['icon'] == 'shield' ? 'selected' : '' }}>Shield Icon
                                </option>
                                <option value="clock" {{ $indicator['icon'] == 'clock' ? 'selected' : '' }}>Clock Icon
                                </option>
                            </select>
                            <button type="button" class="admin-btn btn-danger remove-trust-indicator"
                                data-index="{{ $index }}" aria-label="Remove trust indicator">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    @endforeach
                </div>
                <button type="button" class="admin-btn btn-save mt-3" id="addTrustIndicator">
                    <i class="fas fa-plus"></i> Add Trust Indicator
                </button>
            </div>

            <!-- Buttons -->
            <div class="form-group">
                <label>Call-to-Action Buttons</label>
                <div id="buttonsContainer">
                    @foreach ($ctaData['buttons'] ?? [] as $index => $button)
                        <div class="button-row">
                            <div class="button-details">
                                <input type="text" name="buttons[{{ $index }}][text]" class="form-control"
                                    value="{{ $button['text'] }}" placeholder="Button text" required maxlength="50">
                                <select name="buttons[{{ $index }}][type]" class="form-control" required>
                                    <option value="primary" {{ $button['type'] == 'primary' ? 'selected' : '' }}>Primary
                                    </option>
                                    <option value="secondary" {{ $button['type'] == 'secondary' ? 'selected' : '' }}>
                                        Secondary</option>
                                </select>
                                <input type="url" name="buttons[{{ $index }}][url]" class="form-control"
                                    value="{{ $button['url'] }}" placeholder="Button URL" required maxlength="255">
                                <input type="text" name="buttons[{{ $index }}][aria_label]"
                                    class="form-control" value="{{ $button['aria_label'] }}" placeholder="ARIA label"
                                    required maxlength="100">
                            </div>
                            <button type="button" class="admin-btn btn-danger remove-button"
                                data-index="{{ $index }}" aria-label="Remove button">
                                <i class="fas fa-trash"></i> Remove
                            </button>
                        </div>
                    @endforeach
                </div>
                <button type="button" class="admin-btn btn-save mt-3" id="addButton">
                    <i class="fas fa-plus"></i> Add Button
                </button>
            </div>

            <!-- Background Settings -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="form-group">
                    <label for="background_type">Background Type</label>
                    <select id="background_type" name="background_type" class="form-control" required>
                        <option value="gradient"
                            {{ old('background_type', $section->background_type ?? '') == 'gradient' ? 'selected' : '' }}>
                            Gradient</option>
                        <option value="solid"
                            {{ old('background_type', $section->background_type ?? '') == 'solid' ? 'selected' : '' }}>
                            Solid Color</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="primary_color">Primary Color</label>
                    <input type="color" id="primary_color" name="primary_color" class="form-control"
                        value="{{ old('primary_color', $section->primary_color ?? '#7a4603') }}" required>
                </div>

                <div class="form-group">
                    <label for="secondary_color">Secondary Color</label>
                    <input type="color" id="secondary_color" name="secondary_color" class="form-control"
                        value="{{ old('secondary_color', $section->secondary_color ?? '#db9123') }}" required>
                </div>
            </div>

            <div class="form-group">
                <label class="flex items-center">
                    <input type="checkbox" name="enable_shapes" value="1"
                        {{ old('enable_shapes', $section->enable_shapes ?? true) ? 'checked' : '' }} class="mr-2">
                    <span>Enable Background Shapes</span>
                </label>
            </div>

            <!-- Section Settings -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="form-group">
                    <label for="title">Section Title *</label>
                    <input type="text" id="title" name="title" class="form-control"
                        value="{{ old('title', $section->title ?? '') }}" placeholder="Enter section title" required
                        maxlength="100">
                    <span class="error-message" id="titleError"></span>
                </div>

                <div class="form-group">
                    <label for="order">Display Order</label>
                    <input type="number" id="order" name="order" class="form-control"
                        value="{{ old('order', $section->order ?? 0) }}" min="0" max="100" step="1">
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status" class="form-control">
                        <option value="ACTIVE" {{ old('status', $section->status ?? '') == 'ACTIVE' ? 'selected' : '' }}>
                            Active
                        </option>
                        <option value="INACTIVE"
                            {{ old('status', $section->status ?? '') == 'INACTIVE' ? 'selected' : '' }}>
                            Inactive
                        </option>
                        <option value="DRAFT" {{ old('status', $section->status ?? '') == 'DRAFT' ? 'selected' : '' }}>
                            Draft
                        </option>
                    </select>
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
        class CTASectionManager {
            constructor() {
                this.elements = {
                    adminPanel: document.getElementById('adminPanel'),
                    toggleAdminBtn: document.getElementById('toggleAdmin'),
                    ctaForm: document.getElementById('ctaForm'),
                    cancelEditBtn: document.getElementById('cancelEdit'),
                    trustIndicatorsContainer: document.getElementById('trustIndicatorsContainer'),
                    buttonsContainer: document.getElementById('buttonsContainer'),
                    addTrustIndicatorBtn: document.getElementById('addTrustIndicator'),
                    addButtonBtn: document.getElementById('addButton')
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

                // Add button
                this.elements.addButtonBtn.addEventListener('click', () => this.addButton());

                // Form submission
                this.elements.ctaForm.addEventListener('submit', (e) => this.validateForm(e));

                // Remove trust indicator delegation
                this.elements.trustIndicatorsContainer.addEventListener('click', (e) => {
                    if (e.target.closest('.remove-trust-indicator')) {
                        this.removeTrustIndicator(e.target.closest('.remove-trust-indicator'));
                    }
                });

                // Remove button delegation
                this.elements.buttonsContainer.addEventListener('click', (e) => {
                    if (e.target.closest('.remove-button')) {
                        this.removeButton(e.target.closest('.remove-button'));
                    }
                });
            }

            setupRealTimePreview() {
                // Real-time preview updates
                const previewFields = [{
                        input: 'headline',
                        preview: 'previewCtaTitle'
                    },
                    {
                        input: 'subheadline',
                        preview: 'previewCtaDescription'
                    },
                    {
                        input: 'note',
                        preview: 'previewCtaNote'
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

                // Update trust indicators and buttons on any change
                this.elements.trustIndicatorsContainer.addEventListener('input', () => this
                    .updateTrustIndicatorsPreview());
                this.elements.buttonsContainer.addEventListener('input', () => this.updateButtonsPreview());
            }

            updatePreview(field) {
                const input = document.getElementById(field.input);
                const preview = document.getElementById(field.preview);

                if (input && preview) {
                    preview.textContent = input.value;
                }
            }

            updateTrustIndicatorsPreview() {
                const previewContainer = document.getElementById('previewTrustIndicators');
                let html = '';

                const trustRows = this.elements.trustIndicatorsContainer.querySelectorAll('.trust-item-row');
                trustRows.forEach(row => {
                    const textInput = row.querySelector('input[type="text"]');
                    if (textInput && textInput.value) {
                        html += `
                            <div class="trust-item" role="listitem">
                                <svg class="trust-icon" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="trust-text">${this.sanitizeInput(textInput.value)}</span>
                            </div>
                        `;
                    }
                });

                previewContainer.innerHTML = html;
            }

            updateButtonsPreview() {
                const previewContainer = document.getElementById('previewCtaButtons');
                let html = '';

                const buttonRows = this.elements.buttonsContainer.querySelectorAll('.button-row');
                buttonRows.forEach(row => {
                    const textInput = row.querySelector('input[name$="[text]"]');
                    const typeInput = row.querySelector('select[name$="[type]"]');
                    const urlInput = row.querySelector('input[name$="[url]"]');
                    const ariaInput = row.querySelector('input[name$="[aria_label]"]');

                    if (textInput && textInput.value) {
                        const text = this.sanitizeInput(textInput.value);
                        const type = typeInput ? typeInput.value : 'primary';
                        const url = urlInput && urlInput.value ? this.sanitizeInput(urlInput.value) : '#!';
                        const ariaLabel = ariaInput && ariaInput.value ? this.sanitizeInput(ariaInput.value) :
                            text;

                        html += `
                            <a href="${url}" class="cta-button cta-button-${type}" aria-label="${ariaLabel}">
                                ${text}
                            </a>
                        `;
                    }
                });

                previewContainer.innerHTML = html;
            }

            sanitizeInput(input) {
                const div = document.createElement('div');
                div.textContent = input;
                return div.innerHTML;
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
                const trustRows = this.elements.trustIndicatorsContainer.querySelectorAll('.trust-item-row');
                const newIndex = trustRows.length;

                const indicatorHtml = `
                    <div class="trust-item-row">
                        <input type="text" name="trust_indicators[${newIndex}][text]" class="form-control" 
                               placeholder="Trust indicator text" required maxlength="100">
                        <select name="trust_indicators[${newIndex}][icon]" class="form-control" required>
                            <option value="check">Check Icon</option>
                            <option value="star">Star Icon</option>
                            <option value="shield">Shield Icon</option>
                            <option value="clock">Clock Icon</option>
                        </select>
                        <button type="button" class="admin-btn btn-danger remove-trust-indicator" data-index="${newIndex}" aria-label="Remove trust indicator">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                `;

                this.elements.trustIndicatorsContainer.insertAdjacentHTML('beforeend', indicatorHtml);
            }

            addButton() {
                const buttonRows = this.elements.buttonsContainer.querySelectorAll('.button-row');
                const newIndex = buttonRows.length;

                const buttonHtml = `
                    <div class="button-row">
                        <div class="button-details">
                            <input type="text" name="buttons[${newIndex}][text]" class="form-control" 
                                   placeholder="Button text" required maxlength="50">
                            <select name="buttons[${newIndex}][type]" class="form-control" required>
                                <option value="primary">Primary</option>
                                <option value="secondary">Secondary</option>
                            </select>
                            <input type="url" name="buttons[${newIndex}][url]" class="form-control" 
                                   placeholder="Button URL" required maxlength="255">
                            <input type="text" name="buttons[${newIndex}][aria_label]" class="form-control" 
                                   placeholder="ARIA label" required maxlength="100">
                        </div>
                        <button type="button" class="admin-btn btn-danger remove-button" data-index="${newIndex}" aria-label="Remove button">
                            <i class="fas fa-trash"></i> Remove
                        </button>
                    </div>
                `;

                this.elements.buttonsContainer.insertAdjacentHTML('beforeend', buttonHtml);
            }

            removeTrustIndicator(button) {
                if (confirm('Are you sure you want to remove this trust indicator?')) {
                    button.closest('.trust-item-row').remove();
                    this.updateTrustIndicatorsPreview();
                }
            }

            removeButton(button) {
                if (confirm('Are you sure you want to remove this button?')) {
                    button.closest('.button-row').remove();
                    this.updateButtonsPreview();
                }
            }

            validateForm(e) {
                let isValid = true;

                // Clear previous errors
                this.clearErrors();

                // Validate required fields
                const requiredFields = ['headline', 'subheadline', 'note', 'title'];

                requiredFields.forEach(fieldId => {
                    const field = document.getElementById(fieldId);
                    if (!field.value.trim()) {
                        this.showError(fieldId, 'This field is required.');
                        isValid = false;
                    }
                });

                // Validate at least one trust indicator
                const trustIndicators = this.elements.trustIndicatorsContainer.querySelectorAll('.trust-item-row');
                if (trustIndicators.length === 0) {
                    this.showError('headline', 'At least one trust indicator is required.');
                    isValid = false;
                }

                // Validate at least one button
                const buttons = this.elements.buttonsContainer.querySelectorAll('.button-row');
                if (buttons.length === 0) {
                    this.showError('headline', 'At least one button is required.');
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
        }

        // Initialize the CTA section manager
        document.addEventListener('DOMContentLoaded', () => {
            new CTASectionManager();
        });
    </script>
@endpush
