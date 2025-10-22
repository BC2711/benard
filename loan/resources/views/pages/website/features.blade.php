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
        }

        .features-preview-container {
            background-color: var(--background-color);
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 2rem;
            box-shadow: var(--shadow);
        }

        .features-section {
            padding: clamp(3rem, 5vw, 4rem) 0;
        }

        .features-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 clamp(1rem, 3vw, 2rem);
        }

        .section-title {
            text-align: center;
            margin-bottom: 3rem;
            animation: fadeIn 0.5s ease-in;
        }

        .section-heading {
            font-size: clamp(2rem, 4vw, 2.5rem);
            font-weight: 700;
            color: var(--secondary-color);
            margin-bottom: 1rem;
            line-height: 1.2;
        }

        .section-description {
            font-size: clamp(0.9rem, 2vw, 1rem);
            color: #666;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.6;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: clamp(1.5rem, 3vw, 2rem);
            margin-bottom: 3rem;
        }

        .feature-card {
            text-align: center;
            background: var(--white);
            padding: 2rem 1.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            animation: fadeInUp 0.6s ease-in both;
            transition: var(--transition);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        .feature-icon-container {
            width: 80px;
            height: 80px;
            background-color: var(--primary-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            transition: var(--transition);
        }

        .feature-card:hover .feature-icon-container {
            transform: scale(1.1);
        }

        .feature-icon-container.secondary {
            background-color: var(--secondary-color);
        }

        .feature-icon {
            width: 36px;
            height: 36px;
            filter: brightness(0) invert(1);
        }

        .feature-heading {
            font-size: clamp(1.1rem, 2vw, 1.35rem);
            font-weight: 700;
            color: var(--secondary-color);
            margin-bottom: 1rem;
            line-height: 1.3;
        }

        .feature-description {
            color: #666;
            line-height: 1.6;
            font-size: 0.95rem;
        }

        .trust-cta-container {
            text-align: center;
            background: var(--white);
            padding: 3rem 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .trust-indicators {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: clamp(1.5rem, 4vw, 3rem);
            margin-bottom: 2.5rem;
        }

        .trust-indicator {
            flex: 1;
            min-width: 150px;
        }

        .trust-value {
            font-size: clamp(1.75rem, 4vw, 2.25rem);
            font-weight: 800;
            color: var(--primary-color);
            line-height: 1;
            display: block;
        }

        .trust-label {
            font-size: 0.9rem;
            color: #666;
            margin-top: 0.5rem;
        }

        .cta-heading {
            font-size: clamp(1.5rem, 3vw, 2rem);
            font-weight: 700;
            color: var(--secondary-color);
            margin-bottom: 1rem;
            line-height: 1.3;
        }

        .cta-description {
            font-size: clamp(0.95rem, 2vw, 1.1rem);
            color: #666;
            margin-bottom: 2rem;
            line-height: 1.5;
        }

        .cta-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            justify-content: center;
        }

        .cta-button {
            padding: 0.875rem 2rem;
            border-radius: 6px;
            font-weight: 700;
            text-decoration: none;
            transition: var(--transition);
            font-size: 1rem;
        }

        .cta-button--primary {
            background-color: var(--primary-color);
            border: 2px solid var(--primary-color);
            color: var(--white);
            box-shadow: 0 4px 12px rgba(219, 145, 35, 0.3);
        }

        .cta-button--primary:hover {
            background-color: transparent;
            color: var(--primary-color);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(219, 145, 35, 0.4);
        }

        .cta-button--secondary {
            border: 2px solid var(--secondary-color);
            color: var(--secondary-color);
            background: transparent;
        }

        .cta-button--secondary:hover {
            background-color: var(--secondary-color);
            color: var(--white);
            transform: translateY(-2px);
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

        .feature-items-container .feature-item-row,
        .trust-indicators-container .trust-item-row,
        .cta-buttons-container .cta-item-row {
            display: flex;
            gap: 12px;
            align-items: center;
            margin-bottom: 12px;
            padding: 12px;
            background: #f8f9fa;
            border-radius: 8px;
            border: 1px solid #e9ecef;
        }

        .feature-item-row .form-control,
        .trust-item-row .form-control,
        .cta-item-row .form-control {
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
            .features-section {
                padding: 2rem 0;
            }

            .features-grid {
                gap: 1.5rem;
            }
        }

        @media (max-width: 768px) {
            .features-grid {
                grid-template-columns: 1fr;
            }

            .trust-indicators {
                flex-direction: column;
                gap: 1.5rem;
            }

            .trust-indicator {
                min-width: auto;
            }

            .cta-buttons {
                flex-direction: column;
                align-items: center;
            }

            .cta-button {
                width: 100%;
                max-width: 250px;
                text-align: center;
            }

            .feature-item-row,
            .trust-item-row,
            .cta-item-row {
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
            .features-container {
                padding: 0 1rem;
            }

            .feature-card {
                padding: 1.5rem 1rem;
            }

            .trust-cta-container {
                padding: 2rem 1rem;
            }
        }
    </style>
@endpush

@section('breadcrumbs')
    <nav class="flex items-center space-x-2">
        <a href="{{ route('management.dashboard') }}" class="text-sm text-gray-500 hover:text-gray-700">Website Management</a>
        <span class="text-gray-400">/</span>
        <span class="text-sm text-gray-500">Features Section</span>
    </nav>
@endsection
@section('page-icon')
    <i class="fas fa-cogs fa-lg text-gray-700"></i>
@endsection
@section('page-title')
    <h1 class="text-2xl font-bold text-gray-900">Features Section Management</h1>
    <p class="text-gray-600 text-sm mt-1">Customize and manage the features section for your website. Changes
        are reflected in real-time.</p>
@endsection

@section('title', 'Features Section Management')

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

    <!-- Features Preview -->
    <div class="features-preview-container">
        <section class="features-section" id="features" aria-label="Features Section Preview">
            <div class="features-container">
                <div class="section-title" id="sectionTitle">
                    <h2 class="section-heading" id="previewSectionHeading">
                        {{ $featureData['section_heading'] ?? 'Why Marketeers Choose Londa Loans' }}
                    </h2>
                    <p class="section-description" id="previewSectionDescription">
                        {{ $featureData['section_description'] ?? 'We understand the unique financial needs of marketing professionals and have built our services around your success.' }}
                    </p>
                </div>

                <div class="features-grid" id="featuresGrid">
                    @foreach ($featureData['feature_cards'] ?? [] as $card)
                        <div class="feature-card">
                            <div class="feature-icon-container {{ $card['bg_color'] === 'secondary' ? 'secondary' : '' }}">
                                <img src="{{ asset($card['icon'] ?? 'assets/images/icon-01.svg') }}"
                                    alt="{{ $card['title'] }} Icon" class="feature-icon" />
                            </div>
                            <h4 class="feature-heading">{{ $card['title'] }}</h4>
                            <p class="feature-description">{{ $card['description'] }}</p>
                        </div>
                    @endforeach

                    @if (empty($featureData['feature_cards']))
                        <!-- Default Feature Cards -->
                        <div class="feature-card">
                            <div class="feature-icon-container">
                                <img src="{{ asset('assets/images/icon-01.svg') }}" alt="Fast Approval Icon"
                                    class="feature-icon" />
                            </div>
                            <h4 class="feature-heading">Fast Approval</h4>
                            <p class="feature-description">Get loan decisions within 24 hours, so you can seize marketing
                                opportunities when they arise.</p>
                        </div>
                        <div class="feature-card">
                            <div class="feature-icon-container secondary">
                                <img src="{{ asset('assets/images/icon-02.svg') }}" alt="Marketing Expertise Icon"
                                    class="feature-icon" />
                            </div>
                            <h4 class="feature-heading">Marketing Expertise</h4>
                            <p class="feature-description">Our team understands marketing needs and tailors loans
                                specifically for campaign funding and growth.</p>
                        </div>
                        <div class="feature-card">
                            <div class="feature-icon-container">
                                <img src="{{ asset('assets/images/icon-03.svg') }}" alt="Flexible Terms Icon"
                                    class="feature-icon" />
                            </div>
                            <h4 class="feature-heading">Flexible Terms</h4>
                            <p class="feature-description">Repayment plans designed around your campaign ROI cycles and
                                revenue patterns.</p>
                        </div>
                        <div class="feature-card">
                            <div class="feature-icon-container secondary">
                                <img src="{{ asset('assets/images/icon-04.svg') }}" alt="Transparent Pricing Icon"
                                    class="feature-icon" />
                            </div>
                            <h4 class="feature-heading">Transparent Pricing</h4>
                            <p class="feature-description">No hidden fees or surprise charges. Know exactly what you're
                                paying from day one.</p>
                        </div>
                        <div class="feature-card">
                            <div class="feature-icon-container">
                                <img src="{{ asset('assets/images/icon-05.svg') }}" alt="Dedicated Support Icon"
                                    class="feature-icon" />
                            </div>
                            <h4 class="feature-heading">Dedicated Support</h4>
                            <p class="feature-description">Get personalized assistance from loan specialists who understand
                                marketing businesses.</p>
                        </div>
                        <div class="feature-card">
                            <div class="feature-icon-container secondary">
                                <img src="{{ asset('assets/images/icon-06.svg') }}" alt="Scalable Funding Icon"
                                    class="feature-icon" />
                            </div>
                            <h4 class="feature-heading">Scalable Funding</h4>
                            <p class="feature-description">Start small and access larger amounts as your marketing success
                                and business grow.</p>
                        </div>
                    @endif
                </div>

                <div class="trust-cta-container" id="trustCtaContainer">
                    <div class="trust-indicators" role="list">
                        @foreach ($featureData['trust_indicators'] ?? [] as $indicator)
                            <div class="trust-indicator" role="listitem">
                                <span class="trust-value">{{ $indicator['value'] }}</span>
                                <span class="trust-label">{{ $indicator['label'] }}</span>
                            </div>
                        @endforeach

                        @if (empty($featureData['trust_indicators']))
                            <!-- Default Trust Indicators -->
                            <div class="trust-indicator" role="listitem">
                                <span class="trust-value">500+</span>
                                <span class="trust-label">Marketing Campaigns Funded</span>
                            </div>
                            <div class="trust-indicator" role="listitem">
                                <span class="trust-value">98%</span>
                                <span class="trust-label">Approval Rate</span>
                            </div>
                            <div class="trust-indicator" role="listitem">
                                <span class="trust-value">24h</span>
                                <span class="trust-label">Average Processing Time</span>
                            </div>
                            <div class="trust-indicator" role="listitem">
                                <span class="trust-value">$10M+</span>
                                <span class="trust-label">Loans Disbursed</span>
                            </div>
                        @endif
                    </div>

                    <div style="animation: fadeInUp 0.6s ease-in 0.6s both;">
                        <h3 class="cta-heading" id="previewCtaHeading">
                            {{ $featureData['cta_heading'] ?? 'Ready to fund your next marketing success?' }}
                        </h3>
                        <p class="cta-description" id="previewCtaDescription">
                            {{ $featureData['cta_description'] ?? 'Join hundreds of marketeers who have scaled their businesses with Londa Loans' }}
                        </p>
                        <div class="cta-buttons">
                            @foreach ($featureData['cta_buttons'] ?? [] as $button)
                                <a href="{{ $button['url'] ?? '#!' }}"
                                    class="cta-button cta-button--{{ $button['style'] ?? 'primary' }}"
                                    aria-label="{{ $button['aria_label'] ?? 'CTA button' }}">
                                    {{ $button['text'] }}
                                </a>
                            @endforeach

                            @if (empty($featureData['cta_buttons']))
                                <!-- Default CTA Buttons -->
                                <a href="#!" class="cta-button cta-button--primary" aria-label="Apply for a loan">
                                    Apply for Loan
                                </a>
                                <a href="#!" class="cta-button cta-button--secondary"
                                    aria-label="Calculate loan payments">
                                    Calculate Payments
                                </a>
                            @endif
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
            Manage Features Content
        </h3>

        <form id="featuresForm" method="POST" action="{{ route('management.feature-section') }}" novalidate>
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
                <!-- Left Column -->
                <div class="space-y-6">
                    <div class="form-group">
                        <label for="sectionHeading">Section Heading *</label>
                        <input type="text" id="sectionHeading" name="section_heading" class="form-control"
                            value="{{ old('section_heading', $featureData['section_heading'] ?? '') }}"
                            placeholder="Enter section heading..." required>
                        <span class="error-message" id="sectionHeadingError">
                            @error('section_heading')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="form-group">
                        <label for="sectionDescription">Section Description *</label>
                        <textarea id="sectionDescription" name="section_description" class="form-control" rows="4"
                            placeholder="Enter section description..." required>{{ old('section_description', $featureData['section_description'] ?? '') }}</textarea>
                        <span class="error-message" id="sectionDescriptionError">
                            @error('section_description')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="form-group">
                        <label for="ctaHeading">CTA Heading *</label>
                        <input type="text" id="ctaHeading" name="cta_heading" class="form-control"
                            value="{{ old('cta_heading', $featureData['cta_heading'] ?? '') }}"
                            placeholder="Enter CTA heading..." required>
                        <span class="error-message" id="ctaHeadingError">
                            @error('cta_heading')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="form-group">
                        <label for="ctaDescription">CTA Description *</label>
                        <textarea id="ctaDescription" name="cta_description" class="form-control" rows="3"
                            placeholder="Enter CTA description..." required>{{ old('cta_description', $featureData['cta_description'] ?? '') }}</textarea>
                        <span class="error-message" id="ctaDescriptionError">
                            @error('cta_description')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <!-- Feature Cards -->
                    <div class="form-group">
                        <label>Feature Cards</label>
                        <div id="featureItemsContainer" class="feature-items-container">
                            @foreach ($featureData['feature_cards'] ?? [] as $index => $card)
                                <div class="feature-item-row">
                                    <input type="text" name="feature_cards[{{ $index }}][title]"
                                        class="form-control"
                                        value="{{ old("feature_cards.$index.title", $card['title'] ?? '') }}"
                                        placeholder="Feature Title" required>
                                    <textarea name="feature_cards[{{ $index }}][description]" class="form-control"
                                        placeholder="Feature Description" required>{{ old("feature_cards.$index.description", $card['description'] ?? '') }}</textarea>
                                    <input type="text" name="feature_cards[{{ $index }}][icon]"
                                        class="form-control"
                                        value="{{ old("feature_cards.$index.icon", $card['icon'] ?? '') }}"
                                        placeholder="Icon Path">
                                    <select name="feature_cards[{{ $index }}][bg_color]" class="form-control">
                                        <option value="primary"
                                            {{ ($card['bg_color'] ?? 'primary') === 'primary' ? 'selected' : '' }}>Primary
                                        </option>
                                        <option value="secondary"
                                            {{ ($card['bg_color'] ?? 'primary') === 'secondary' ? 'selected' : '' }}>
                                            Secondary</option>
                                    </select>
                                    <button type="button" class="admin-btn btn-danger remove-feature-item">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="admin-btn btn-save mt-3" id="addFeatureItem">
                            <i class="fas fa-plus"></i> Add Feature Card
                        </button>
                    </div>

                    <!-- Trust Indicators -->
                    <div class="form-group">
                        <label>Trust Indicators</label>
                        <div id="trustIndicatorsContainer" class="trust-indicators-container">
                            @foreach ($featureData['trust_indicators'] ?? [] as $index => $indicator)
                                <div class="trust-item-row">
                                    <input type="text" name="trust_indicators[{{ $index }}][value]"
                                        class="form-control"
                                        value="{{ old("trust_indicators.$index.value", $indicator['value'] ?? '') }}"
                                        placeholder="Value" required>
                                    <input type="text" name="trust_indicators[{{ $index }}][label]"
                                        class="form-control"
                                        value="{{ old("trust_indicators.$index.label", $indicator['label'] ?? '') }}"
                                        placeholder="Label" required>
                                    <button type="button" class="admin-btn btn-danger remove-trust-indicator">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="admin-btn btn-save mt-3" id="addTrustIndicator">
                            <i class="fas fa-plus"></i> Add Trust Indicator
                        </button>
                    </div>
                </div>
            </div>

            <!-- CTA Buttons -->
            <div class="form-group">
                <label>CTA Buttons</label>
                <div id="ctaButtonsContainer" class="cta-buttons-container">
                    @foreach ($featureData['cta_buttons'] ?? [] as $index => $button)
                        <div class="cta-item-row">
                            <input type="text" name="cta_buttons[{{ $index }}][text]" class="form-control"
                                value="{{ old("cta_buttons.$index.text", $button['text'] ?? '') }}"
                                placeholder="Button Text" required>
                            <input type="url" name="cta_buttons[{{ $index }}][url]" class="form-control"
                                value="{{ old("cta_buttons.$index.url", $button['url'] ?? '') }}"
                                placeholder="Button URL" required>
                            <select name="cta_buttons[{{ $index }}][style]" class="form-control">
                                <option value="primary"
                                    {{ ($button['style'] ?? 'primary') === 'primary' ? 'selected' : '' }}>Primary</option>
                                <option value="secondary"
                                    {{ ($button['style'] ?? 'primary') === 'secondary' ? 'selected' : '' }}>Secondary
                                </option>
                            </select>
                            <button type="button" class="admin-btn btn-danger remove-cta-button">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    @endforeach
                </div>
                <button type="button" class="admin-btn btn-save mt-3" id="addCtaButton">
                    <i class="fas fa-plus"></i> Add CTA Button
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
        class FeaturesSectionManager {
            constructor() {
                this.elements = {
                    adminPanel: document.getElementById('adminPanel'),
                    toggleAdminBtn: document.getElementById('toggleAdmin'),
                    featuresForm: document.getElementById('featuresForm'),
                    cancelEditBtn: document.getElementById('cancelEdit'),
                    featureItemsContainer: document.getElementById('featureItemsContainer'),
                    trustIndicatorsContainer: document.getElementById('trustIndicatorsContainer'),
                    ctaButtonsContainer: document.getElementById('ctaButtonsContainer'),
                    addFeatureItemBtn: document.getElementById('addFeatureItem'),
                    addTrustIndicatorBtn: document.getElementById('addTrustIndicator'),
                    addCtaButtonBtn: document.getElementById('addCtaButton')
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

                // Add feature item
                this.elements.addFeatureItemBtn.addEventListener('click', () => this.addFeatureItem());

                // Add trust indicator
                this.elements.addTrustIndicatorBtn.addEventListener('click', () => this.addTrustIndicator());

                // Add CTA button
                this.elements.addCtaButtonBtn.addEventListener('click', () => this.addCtaButton());

                // Form submission
                this.elements.featuresForm.addEventListener('submit', (e) => this.validateForm(e));

                // Remove item handlers
                this.elements.featureItemsContainer.addEventListener('click', (e) => {
                    if (e.target.closest('.remove-feature-item')) {
                        this.removeFeatureItem(e.target.closest('.remove-feature-item'));
                    }
                });

                this.elements.trustIndicatorsContainer.addEventListener('click', (e) => {
                    if (e.target.closest('.remove-trust-indicator')) {
                        this.removeTrustIndicator(e.target.closest('.remove-trust-indicator'));
                    }
                });

                this.elements.ctaButtonsContainer.addEventListener('click', (e) => {
                    if (e.target.closest('.remove-cta-button')) {
                        this.removeCtaButton(e.target.closest('.remove-cta-button'));
                    }
                });
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
                    preview.textContent = input.value;
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

            addFeatureItem() {
                const index = Date.now();
                const featureHtml = `
                    <div class="feature-item-row">
                        <input type="text" name="feature_cards[${index}][title]" class="form-control" placeholder="Feature Title" required>
                        <textarea name="feature_cards[${index}][description]" class="form-control" placeholder="Feature Description" required></textarea>
                        <input type="text" name="feature_cards[${index}][icon]" class="form-control" placeholder="Icon Path">
                        <select name="feature_cards[${index}][bg_color]" class="form-control">
                            <option value="primary">Primary</option>
                            <option value="secondary">Secondary</option>
                        </select>
                        <button type="button" class="admin-btn btn-danger remove-feature-item">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                `;
                this.elements.featureItemsContainer.insertAdjacentHTML('beforeend', featureHtml);
            }

            addTrustIndicator() {
                const index = Date.now();
                const indicatorHtml = `
                    <div class="trust-item-row">
                        <input type="text" name="trust_indicators[${index}][value]" class="form-control" placeholder="Value" required>
                        <input type="text" name="trust_indicators[${index}][label]" class="form-control" placeholder="Label" required>
                        <button type="button" class="admin-btn btn-danger remove-trust-indicator">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                `;
                this.elements.trustIndicatorsContainer.insertAdjacentHTML('beforeend', indicatorHtml);
            }

            addCtaButton() {
                const index = Date.now();
                const buttonHtml = `
                    <div class="cta-item-row">
                        <input type="text" name="cta_buttons[${index}][text]" class="form-control" placeholder="Button Text" required>
                        <input type="url" name="cta_buttons[${index}][url]" class="form-control" placeholder="Button URL" required>
                        <select name="cta_buttons[${index}][style]" class="form-control">
                            <option value="primary">Primary</option>
                            <option value="secondary">Secondary</option>
                        </select>
                        <button type="button" class="admin-btn btn-danger remove-cta-button">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                `;
                this.elements.ctaButtonsContainer.insertAdjacentHTML('beforeend', buttonHtml);
            }

            removeFeatureItem(button) {
                if (confirm('Are you sure you want to remove this feature card?')) {
                    button.closest('.feature-item-row').remove();
                }
            }

            removeTrustIndicator(button) {
                if (confirm('Are you sure you want to remove this trust indicator?')) {
                    button.closest('.trust-item-row').remove();
                }
            }

            removeCtaButton(button) {
                if (confirm('Are you sure you want to remove this CTA button?')) {
                    button.closest('.cta-item-row').remove();
                }
            }

            validateForm(e) {
                let isValid = true;

                // Clear previous errors
                this.clearErrors();

                // Validate required fields
                const requiredFields = [
                    'sectionHeading', 'sectionDescription', 'ctaHeading', 'ctaDescription'
                ];

                requiredFields.forEach(fieldId => {
                    const field = document.getElementById(fieldId);
                    if (!field.value.trim()) {
                        this.showError(fieldId, 'This field is required.');
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

        // Initialize the features section manager
        document.addEventListener('DOMContentLoaded', () => {
            new FeaturesSectionManager();
        });
    </script>
@endpush
