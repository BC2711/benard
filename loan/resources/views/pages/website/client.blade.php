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

        .client-preview-container {
            background: linear-gradient(135deg, #f8f5f0 0%, #ffffff 100%);
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 2rem;
            box-shadow: var(--shadow);
            border: 1px solid #e5e7eb;
        }

        .client-section {
            color: #333;
            padding: clamp(2rem, 4vw, 3rem) 0;
            position: relative;
            overflow: hidden;
            isolation: isolate;
        }

        .client-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 clamp(1rem, 3vw, 2rem);
            position: relative;
            z-index: 1;
        }

        .client-heading {
            text-align: center;
            margin-bottom: 3rem;
            animation: fadeIn 0.6s ease-in;
        }

        .client-heading h2 {
            font-size: clamp(1.75rem, 4vw, 2.25rem);
            font-weight: 700;
            color: var(--secondary-color);
            line-height: 1.3;
            margin-bottom: 0.75rem;
        }

        .client-heading p {
            font-size: 1rem;
            color: #666;
            line-height: 1.6;
            max-width: 600px;
            margin: 0 auto;
        }

        .client-logos {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 1.5rem;
            text-align: center;
            margin-bottom: 3rem;
        }

        .client-logo-item {
            background-color: white;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            padding: 1.5rem;
            transition: var(--transition);
            text-decoration: none;
            display: block;
        }

        .client-logo-item:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
        }

        .client-name {
            font-size: 1.25rem;
            font-weight: bold;
            color: var(--secondary-color);
            margin-bottom: 0.25rem;
        }

        .client-description {
            font-size: 0.9rem;
            color: var(--primary-color);
        }

        .success-highlights {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 3rem;
        }

        .highlight-item {
            background-color: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            animation: fadeInUp 0.6s ease-in;
        }

        .highlight-content {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .highlight-amount {
            background-color: var(--primary-color);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: bold;
            min-width: 80px;
            text-align: center;
        }

        .highlight-text h4 {
            font-size: 1.25rem;
            font-weight: bold;
            color: var(--secondary-color);
            margin-bottom: 0.25rem;
        }

        .highlight-text p {
            font-size: 0.9rem;
            color: #666;
        }

        .client-cta {
            text-align: center;
            animation: fadeInUp 0.6s ease-in 1s both;
        }

        .client-cta h3 {
            font-size: 1.75rem;
            font-weight: bold;
            color: var(--secondary-color);
            margin-bottom: 0.5rem;
        }

        .client-cta p {
            font-size: 1rem;
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
            background-color: var(--primary-color);
            border: 2px solid var(--primary-color);
            color: var(--white);
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            transition: var(--transition);
        }

        .cta-button:hover {
            background-color: transparent;
            color: var(--primary-color);
        }

        .cta-button-secondary {
            padding: 0.75rem 1.5rem;
            border: 2px solid var(--secondary-color);
            color: var(--secondary-color);
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            transition: var(--transition);
        }

        .cta-button-secondary:hover {
            background-color: var(--secondary-color);
            color: white;
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

        .client-item-row {
            display: flex;
            gap: 12px;
            align-items: center;
            margin-bottom: 12px;
            padding: 12px;
            background: #f8f9fa;
            border-radius: 8px;
            border: 1px solid #e9ecef;
        }

        .client-item-row .form-control {
            flex: 1;
            margin-bottom: 0;
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

        /* Empty state styles */
        .empty-state {
            text-align: center;
            padding: 3rem 2rem;
            color: #6b7280;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        .empty-state p {
            font-size: 1.1rem;
        }

        /* Animations */
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
        @media (max-width: 768px) {
            .client-logos {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            }

            .success-highlights {
                grid-template-columns: 1fr;
            }

            .highlight-content {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.75rem;
            }

            .cta-buttons {
                flex-direction: column;
                align-items: center;
            }

            .client-item-row {
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
            .client-content {
                padding: 0 1rem;
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
                    <h1 class="text-2xl font-bold text-gray-900">Client Section Management</h1>
                    <p class="text-gray-600 text-sm mt-1">Manage and customize the trusted clients and partners section for
                        your website.</p>
                </div>
                <div class="flex gap-2">
                    <button type="button" id="previewBtn"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 flex items-center gap-2">
                        <i class="fas fa-eye"></i>
                        Preview
                    </button>
                    <button type="button" id="resetBtn"
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

    <!-- Client Preview -->
    <div class="client-preview-container">
        <section class="client-section" aria-label="Client Section Preview">
            <div class="client-content">
                <div class="client-heading" id="clientHeading">
                    <h2 id="previewMainHeading">{{ $form['headline'] ?? 'Trusted by Marketing Professionals' }}</h2>
                    <p id="previewSubheading">
                        {{ $form['subheadline'] ?? "We're proud to support marketing agencies, content creators, and entrepreneurs who are driving innovation and growth in their industries." }}
                    </p>
                </div>

                <div class="client-logos" id="previewClientLogos">
                    @php
                        $hasClients = false;
                    @endphp
                    @foreach (range(1, 6) as $client)
                        @if (!empty($form['client_' . $client . '_name']))
                            @php $hasClients = true; @endphp
                            <a href="{{ $form['client_' . $client . '_url'] ?? '#!' }}" class="client-logo-item"
                                style="animation-delay: {{ $form['client_' . $client . '_animation_delay'] ?? '0.1' }}s">
                                <div class="client-name">{{ $form['client_' . $client . '_name'] }}</div>
                                @if (!empty($form['client_' . $client . '_description']))
                                    <div class="client-description">{{ $form['client_' . $client . '_description'] }}</div>
                                @endif
                            </a>
                        @endif
                    @endforeach

                    @if (!$hasClients)
                        <div class="empty-state col-span-full">
                            <i class="fas fa-users"></i>
                            <p>No clients configured. Add client information in the admin panel.</p>
                        </div>
                    @endif
                </div>

                <div class="success-highlights" id="previewSuccessHighlights">
                    @php
                        $hasHighlights = false;
                    @endphp
                    @foreach (range(1, 3) as $highlight)
                        @if (!empty($form['highlight_' . $highlight . '_amount']))
                            @php $hasHighlights = true; @endphp
                            <div class="highlight-item"
                                style="animation-delay: {{ $form['highlight_' . $highlight . '_animation_delay'] ?? '0.7' }}s">
                                <div class="highlight-content">
                                    <div class="highlight-amount"
                                        style="background-color: {{ $form['highlight_' . $highlight . '_color'] ?? '#db9123' }}">
                                        {{ $form['highlight_' . $highlight . '_amount'] }}
                                    </div>
                                    <div class="highlight-text">
                                        <h4>{{ $form['highlight_' . $highlight . '_client'] ?? '' }}</h4>
                                        <p>{{ $form['highlight_' . $highlight . '_result'] ?? '' }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                    @if (!$hasHighlights)
                        <div class="empty-state col-span-full">
                            <i class="fas fa-chart-line"></i>
                            <p>No success highlights configured. Add highlights in the admin panel.</p>
                        </div>
                    @endif
                </div>

                <div class="client-cta" id="previewCta">
                    <h3 id="previewCtaHeadline">{{ $form['cta_headline'] ?? 'Ready to join our growing community?' }}</h3>
                    <p id="previewCtaSubheadline">
                        {{ $form['cta_subheadline'] ?? 'Get the funding you need to scale your marketing business' }}</p>
                    <div class="cta-buttons">
                        <a href="#!" class="cta-button"
                            id="previewCtaPrimary">{{ $form['cta_primary_text'] ?? 'Start Your Application' }}</a>
                        <a href="#!" class="cta-button-secondary"
                            id="previewCtaSecondary">{{ $form['cta_secondary_text'] ?? 'View Client Stories' }}</a>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Admin Panel -->
    <div class="admin-panel" id="adminPanel" role="dialog" aria-labelledby="adminPanelTitle" aria-modal="true">
        <h3 id="adminPanelTitle">
            <i class="fas fa-edit"></i>
            Manage Client Section
        </h3>

        <form id="clientForm" action="{{ route('management.client-section') }}" method="POST" novalidate>
            @csrf

            <!-- Main Content Section -->
            <div class="form-group">
                <label for="headline">Main Headline *</label>
                <input type="text" id="headline" name="headline" class="form-control"
                    value="{{ old('headline', $form['headline'] ?? '') }}" placeholder="Trusted by Marketing Professionals"
                    required maxlength="100">
                <span class="error-message" id="headlineError"></span>
            </div>

            <div class="form-group">
                <label for="subheadline">Subheadline</label>
                <textarea id="subheadline" name="subheadline" class="form-control" rows="4"
                    placeholder="We're proud to support marketing agencies, content creators, and entrepreneurs who are driving innovation and growth in their industries."
                    maxlength="500">{{ old('subheadline', $form['subheadline'] ?? '') }}</textarea>
                <span class="error-message" id="subheadlineError"></span>
            </div>

            <!-- Client Logos Section -->
            <div class="form-group">
                <label>Client Logos & Partners (At least one client required)</label>
                <div id="clientLogosContainer">
                    @foreach (range(1, 6) as $client)
                        <div class="client-item-row">
                            <input type="text" name="client_{{ $client }}_name"
                                class="form-control client-name-input"
                                value="{{ old('client_' . $client . '_name', $form['client_' . $client . '_name'] ?? '') }}"
                                placeholder="Client Name (e.g., SocialBoost)" maxlength="50">
                            <input type="text" name="client_{{ $client }}_description" class="form-control"
                                value="{{ old('client_' . $client . '_description', $form['client_' . $client . '_description'] ?? '') }}"
                                placeholder="Client Description (e.g., Marketing Agency)" maxlength="100">
                            <input type="url" name="client_{{ $client }}_url" class="form-control"
                                value="{{ old('client_' . $client . '_url', $form['client_' . $client . '_url'] ?? '') }}"
                                placeholder="Website URL">
                            <select name="client_{{ $client }}_animation_delay" class="form-control">
                                @foreach (['0.1', '0.2', '0.3', '0.4', '0.5', '0.6'] as $delay)
                                    <option value="{{ $delay }}"
                                        {{ old('client_' . $client . '_animation_delay', $form['client_' . $client . '_animation_delay'] ?? '') == $delay ? 'selected' : '' }}>
                                        {{ $delay }}s
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Client Success Highlights -->
            <div class="form-group">
                <label>Client Success Highlights</label>
                <div id="successHighlightsContainer">
                    @foreach (range(1, 3) as $highlight)
                        <div class="client-item-row">
                            <input type="text" name="highlight_{{ $highlight }}_amount" class="form-control"
                                value="{{ old('highlight_' . $highlight . '_amount', $form['highlight_' . $highlight . '_amount'] ?? '') }}"
                                placeholder="Funding Amount (e.g., $25K)" maxlength="20">
                            <input type="text" name="highlight_{{ $highlight }}_client" class="form-control"
                                value="{{ old('highlight_' . $highlight . '_client', $form['highlight_' . $highlight . '_client'] ?? '') }}"
                                placeholder="Client Name (e.g., SocialBoost Agency)" maxlength="100">
                            <input type="text" name="highlight_{{ $highlight }}_result" class="form-control"
                                value="{{ old('highlight_' . $highlight . '_result', $form['highlight_' . $highlight . '_result'] ?? '') }}"
                                placeholder="Achievement/Result (e.g., Campaign funding led to 300% ROI)" maxlength="200">
                            <select name="highlight_{{ $highlight }}_color" class="form-control">
                                <option value="#db9123"
                                    {{ old('highlight_' . $highlight . '_color', $form['highlight_' . $highlight . '_color'] ?? '') == '#db9123' ? 'selected' : '' }}>
                                    Orange (#db9123)
                                </option>
                                <option value="#7a4603"
                                    {{ old('highlight_' . $highlight . '_color', $form['highlight_' . $highlight . '_color'] ?? '') == '#7a4603' ? 'selected' : '' }}>
                                    Brown (#7a4603)
                                </option>
                            </select>
                            <select name="highlight_{{ $highlight }}_animation_delay" class="form-control">
                                @foreach (['0.7', '0.8', '0.9'] as $delay)
                                    <option value="{{ $delay }}"
                                        {{ old('highlight_' . $highlight . '_animation_delay', $form['highlight_' . $highlight . '_animation_delay'] ?? '') == $delay ? 'selected' : '' }}>
                                        {{ $delay }}s
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- CTA Section -->
            <div class="form-group">
                <label for="cta_headline">CTA Headline</label>
                <input type="text" id="cta_headline" name="cta_headline" class="form-control"
                    value="{{ old('cta_headline', $form['cta_headline'] ?? '') }}"
                    placeholder="Ready to join our growing community?" maxlength="100">
                <span class="error-message" id="ctaHeadlineError"></span>
            </div>

            <div class="form-group">
                <label for="cta_subheadline">CTA Subheadline</label>
                <textarea id="cta_subheadline" name="cta_subheadline" class="form-control" rows="3"
                    placeholder="Get the funding you need to scale your marketing business" maxlength="300">{{ old('cta_subheadline', $form['cta_subheadline'] ?? '') }}</textarea>
                <span class="error-message" id="ctaSubheadlineError"></span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="form-group">
                    <label for="cta_primary_text">Primary Button Text</label>
                    <input type="text" id="cta_primary_text" name="cta_primary_text" class="form-control"
                        value="{{ old('cta_primary_text', $form['cta_primary_text'] ?? '') }}"
                        placeholder="Start Your Application" maxlength="50">
                    <span class="error-message" id="ctaPrimaryTextError"></span>
                </div>

                <div class="form-group">
                    <label for="cta_secondary_text">Secondary Button Text</label>
                    <input type="text" id="cta_secondary_text" name="cta_secondary_text" class="form-control"
                        value="{{ old('cta_secondary_text', $form['cta_secondary_text'] ?? '') }}"
                        placeholder="View Client Stories" maxlength="50">
                    <span class="error-message" id="ctaSecondaryTextError"></span>
                </div>
            </div>

            <!-- Section Settings -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="form-group">
                    <label for="title">Section Title *</label>
                    <input type="text" id="title" name="title" class="form-control"
                        value="{{ old('title', $form['title'] ?? 'Client Section') }}" placeholder="Enter section title"
                        required maxlength="100">
                    <span class="error-message" id="titleError"></span>
                </div>

                <div class="form-group">
                    <label for="order">Display Order</label>
                    <input type="number" id="order" name="order" class="form-control"
                        value="{{ old('order', $form['order'] ?? 0) }}" min="0" max="100" step="1">
                    <span class="error-message" id="orderError"></span>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status" class="form-control">
                        <option value="ACTIVE" {{ old('status', $form['status'] ?? '') == 'ACTIVE' ? 'selected' : '' }}>
                            Active
                        </option>
                        <option value="INACTIVE"
                            {{ old('status', $form['status'] ?? '') == 'INACTIVE' ? 'selected' : '' }}>
                            Inactive
                        </option>
                        <option value="DRAFT" {{ old('status', $form['status'] ?? '') == 'DRAFT' ? 'selected' : '' }}>
                            Draft
                        </option>
                    </select>
                    <span class="error-message" id="statusError"></span>
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
        class ClientSectionManager {
            constructor() {
                this.elements = {
                    adminPanel: document.getElementById('adminPanel'),
                    toggleAdminBtn: document.getElementById('toggleAdmin'),
                    clientForm: document.getElementById('clientForm'),
                    cancelEditBtn: document.getElementById('cancelEdit'),
                    previewBtn: document.getElementById('previewBtn'),
                    resetBtn: document.getElementById('resetBtn')
                };

                this.init();
            }

            init() {
                this.setupEventListeners();
                this.setupRealTimePreview();
                this.setupButtonFunctionality();
            }

            setupEventListeners() {
                // Toggle admin panel
                if (this.elements.toggleAdminBtn) {
                    this.elements.toggleAdminBtn.addEventListener('click', () => this.toggleAdminPanel());
                }

                // Cancel edit
                if (this.elements.cancelEditBtn) {
                    this.elements.cancelEditBtn.addEventListener('click', () => this.hideAdminPanel());
                }

                // Form submission
                if (this.elements.clientForm) {
                    this.elements.clientForm.addEventListener('submit', (e) => this.validateForm(e));
                }
            }

            setupButtonFunctionality() {
                // Preview button
                if (this.elements.previewBtn) {
                    this.elements.previewBtn.addEventListener('click', () => {
                        const previewContainer = document.querySelector('.client-preview-container');
                        if (previewContainer) {
                            previewContainer.scrollIntoView({
                                behavior: 'smooth'
                            });
                        }
                    });
                }

                // Reset button
                if (this.elements.resetBtn) {
                    this.elements.resetBtn.addEventListener('click', () => {
                        if (confirm('Are you sure you want to reset all changes? This will reload the page.')) {
                            window.location.reload();
                        }
                    });
                }
            }

            setupRealTimePreview() {
                // Real-time preview updates for text fields
                const previewFields = [{
                        input: 'headline',
                        preview: 'previewMainHeading'
                    },
                    {
                        input: 'subheadline',
                        preview: 'previewSubheading'
                    },
                    {
                        input: 'cta_headline',
                        preview: 'previewCtaHeadline'
                    },
                    {
                        input: 'cta_subheadline',
                        preview: 'previewCtaSubheadline'
                    },
                    {
                        input: 'cta_primary_text',
                        preview: 'previewCtaPrimary'
                    },
                    {
                        input: 'cta_secondary_text',
                        preview: 'previewCtaSecondary'
                    }
                ];

                previewFields.forEach(field => {
                    const input = document.getElementById(field.input);
                    if (input) {
                        input.addEventListener('input', () => {
                            this.updatePreview(field);
                        });
                        // Initialize preview on load
                        this.updatePreview(field);
                    }
                });

                // Update client logos and success highlights on any change
                const clientInputs = document.querySelectorAll(
                    '#clientLogosContainer input, #clientLogosContainer select');
                clientInputs.forEach(input => {
                    input.addEventListener('input', () => this.updateClientLogosPreview());
                    input.addEventListener('change', () => this.updateClientLogosPreview());
                });

                const highlightInputs = document.querySelectorAll(
                    '#successHighlightsContainer input, #successHighlightsContainer select');
                highlightInputs.forEach(input => {
                    input.addEventListener('input', () => this.updateHighlightsPreview());
                    input.addEventListener('change', () => this.updateHighlightsPreview());
                });

                // Initialize previews on load
                this.updateClientLogosPreview();
                this.updateHighlightsPreview();
            }

            updatePreview(field) {
                const input = document.getElementById(field.input);
                const preview = document.getElementById(field.preview);

                if (input && preview) {
                    preview.textContent = input.value || preview.textContent;
                }
            }

            updateClientLogosPreview() {
                const previewContainer = document.getElementById('previewClientLogos');
                if (!previewContainer) return;

                let html = '';
                let hasClients = false;

                for (let i = 1; i <= 6; i++) {
                    const nameInput = document.querySelector(`input[name="client_${i}_name"]`);
                    const descInput = document.querySelector(`input[name="client_${i}_description"]`);
                    const urlInput = document.querySelector(`input[name="client_${i}_url"]`);
                    const delaySelect = document.querySelector(`select[name="client_${i}_animation_delay"]`);

                    if (nameInput && nameInput.value.trim()) {
                        hasClients = true;
                        const name = nameInput.value;
                        const description = descInput ? descInput.value : '';
                        const url = urlInput && urlInput.value ? urlInput.value : '#!';
                        const delay = delaySelect ? delaySelect.value : '0.1';

                        html += `
                            <a href="${url}" class="client-logo-item" style="animation-delay: ${delay}s">
                                <div class="client-name">${this.escapeHtml(name)}</div>
                                ${description ? `<div class="client-description">${this.escapeHtml(description)}</div>` : ''}
                            </a>
                        `;
                    }
                }

                if (!hasClients) {
                    html = `
                        <div class="empty-state col-span-full">
                            <i class="fas fa-users"></i>
                            <p>No clients configured. Add client information in the admin panel.</p>
                        </div>
                    `;
                }

                previewContainer.innerHTML = html;
            }

            updateHighlightsPreview() {
                const previewContainer = document.getElementById('previewSuccessHighlights');
                if (!previewContainer) return;

                let html = '';
                let hasHighlights = false;

                for (let i = 1; i <= 3; i++) {
                    const amountInput = document.querySelector(`input[name="highlight_${i}_amount"]`);
                    const clientInput = document.querySelector(`input[name="highlight_${i}_client"]`);
                    const resultInput = document.querySelector(`input[name="highlight_${i}_result"]`);
                    const colorSelect = document.querySelector(`select[name="highlight_${i}_color"]`);
                    const delaySelect = document.querySelector(`select[name="highlight_${i}_animation_delay"]`);

                    if (amountInput && amountInput.value.trim()) {
                        hasHighlights = true;
                        const amount = amountInput.value;
                        const client = clientInput ? clientInput.value : '';
                        const result = resultInput ? resultInput.value : '';
                        const color = colorSelect ? colorSelect.value : '#db9123';
                        const delay = delaySelect ? delaySelect.value : '0.7';

                        html += `
                            <div class="highlight-item" style="animation-delay: ${delay}s">
                                <div class="highlight-content">
                                    <div class="highlight-amount" style="background-color: ${color}">
                                        ${this.escapeHtml(amount)}
                                    </div>
                                    <div class="highlight-text">
                                        <h4>${this.escapeHtml(client)}</h4>
                                        <p>${this.escapeHtml(result)}</p>
                                    </div>
                                </div>
                            </div>
                        `;
                    }
                }

                if (!hasHighlights) {
                    html = `
                        <div class="empty-state col-span-full">
                            <i class="fas fa-chart-line"></i>
                            <p>No success highlights configured. Add highlights in the admin panel.</p>
                        </div>
                    `;
                }

                previewContainer.innerHTML = html;
            }

            escapeHtml(unsafe) {
                if (!unsafe) return '';
                return unsafe
                    .replace(/&/g, "&amp;")
                    .replace(/</g, "&lt;")
                    .replace(/>/g, "&gt;")
                    .replace(/"/g, "&quot;")
                    .replace(/'/g, "&#039;");
            }

            toggleAdminPanel() {
                if (!this.elements.adminPanel) return;

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
                if (this.elements.adminPanel) {
                    this.elements.adminPanel.classList.remove('show');
                }
            }

            validateForm(e) {
                let isValid = true;

                // Clear previous errors
                this.clearErrors();

                // Validate required fields
                const requiredFields = ['headline', 'title'];

                requiredFields.forEach(fieldId => {
                    const field = document.getElementById(fieldId);
                    if (field && !field.value.trim()) {
                        this.showError(fieldId, 'This field is required.');
                        isValid = false;
                    }
                });

                // Validate client names (at least one required)
                let hasClient = false;
                for (let i = 1; i <= 6; i++) {
                    const clientName = document.querySelector(`input[name="client_${i}_name"]`);
                    if (clientName && clientName.value.trim()) {
                        hasClient = true;
                        break;
                    }
                }

                if (!hasClient) {
                    this.showError('headline', 'At least one client name is required.');
                    isValid = false;
                }

                if (!isValid) {
                    e.preventDefault();
                    if (this.elements.adminPanel) {
                        this.elements.adminPanel.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
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

        // Initialize the client section manager
        document.addEventListener('DOMContentLoaded', function() {
            new ClientSectionManager();
        });
    </script>
@endpush
