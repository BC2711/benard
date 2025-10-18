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
            --background-gradient: linear-gradient(135deg, #7a4603 0%, #db9123 100%);
            --text-color: #666;
        }

        .pricing-preview-container {
            background: var(--white);
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 2rem;
            box-shadow: var(--shadow);
            border: 1px solid #e5e7eb;
        }

        .loan-plans-section {
            background: var(--background-gradient);
            padding: clamp(3rem, 5vw, 4rem) 0;
            position: relative;
            overflow: hidden;
            color: var(--white);
        }

        .shape {
            position: absolute;
            max-width: clamp(60px, 8vw, 100px);
            animation: float 3s ease-in-out infinite;
        }

        .section-title {
            text-align: center;
            margin-bottom: 3rem;
            animation: fadeIn 0.6s ease-in;
        }

        .section-heading {
            font-size: clamp(1.75rem, 3vw, 2.25rem);
            font-weight: 700;
            line-height: 1.3;
            margin-bottom: 0.75rem;
        }

        .section-description {
            font-size: clamp(0.9rem, 2vw, 1rem);
            line-height: 1.6;
            max-width: 600px;
            margin: 0 auto;
            opacity: 0.9;
        }

        .loan-type-switcher {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .loan-type-label {
            font-size: 1rem;
            font-weight: 700;
        }

        .switcher-button {
            width: 48px;
            height: 24px;
            background-color: var(--secondary-color);
            border-radius: 12px;
            position: relative;
            cursor: pointer;
            border: none;
            outline: none;
        }

        .switcher-knob {
            width: 20px;
            height: 20px;
            background-color: var(--white);
            border-radius: 50%;
            position: absolute;
            top: 2px;
            left: 2px;
            transition: transform 0.3s ease-in-out;
        }

        .switcher-button.active .switcher-knob {
            transform: translateX(24px);
        }

        .pricing-table {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 clamp(1rem, 3vw, 2rem);
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 3rem;
        }

        .pricing-card {
            background-color: var(--white);
            border-radius: 12px;
            padding: 2rem;
            text-align: center;
            animation: fadeInUp 0.6s ease-in both;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }

        .pricing-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .pricing-card.featured {
            transform: scale(1.05);
            border: 2px solid var(--primary-color);
        }

        .pricing-card.featured:hover {
            transform: scale(1.05) translateY(-5px);
        }

        .featured-label {
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--white);
            background-color: var(--primary-color);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            display: inline-block;
            margin-bottom: 1rem;
        }

        .plan-title {
            font-size: clamp(1.3rem, 2vw, 1.5rem);
            font-weight: 700;
            color: var(--secondary-color);
            margin-bottom: 0.5rem;
        }

        .plan-description {
            font-size: clamp(0.85rem, 1.5vw, 0.95rem);
            color: var(--text-color);
            line-height: 1.5;
            margin-bottom: 1rem;
        }

        .plan-amount {
            font-size: clamp(1.75rem, 2.5vw, 2rem);
            font-weight: 700;
            color: var(--primary-color);
        }

        .plan-term {
            font-size: 0.9rem;
            color: var(--text-color);
        }

        .plan-note {
            font-size: 0.95rem;
            color: var(--secondary-color);
            margin-bottom: 1.5rem;
        }

        .plan-apply-button {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            background-color: var(--primary-color);
            color: var(--white);
            text-decoration: none;
            border-radius: 6px;
            font-weight: 700;
            transition: var(--transition);
            box-shadow: 0 2px 8px rgba(219, 145, 35, 0.3);
        }

        .plan-apply-button:hover {
            background-color: transparent;
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(219, 145, 35, 0.4);
        }

        .plan-features {
            list-style: none;
            padding: 0;
            margin: 1.5rem 0 0;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .plan-feature {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-color);
        }

        .plan-feature svg {
            width: 20px;
            height: 20px;
            color: var(--primary-color);
        }

        .custom-loan {
            background-color: var(--white);
            border-radius: 12px;
            border: 2px solid var(--primary-color);
            padding: 2rem;
            text-align: center;
            animation: fadeInUp 0.6s ease-in 0.7s both;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }

        .custom-loan:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .custom-label {
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--white);
            background-color: var(--secondary-color);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            display: inline-block;
            margin-bottom: 1rem;
        }

        .custom-title {
            font-size: clamp(1.3rem, 2vw, 1.5rem);
            font-weight: 700;
            color: var(--secondary-color);
            margin-bottom: 0.5rem;
        }

        .custom-description {
            font-size: clamp(0.85rem, 1.5vw, 0.95rem);
            color: var(--text-color);
            line-height: 1.5;
            margin-bottom: 1rem;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        .custom-amount {
            font-size: clamp(1.75rem, 2.5vw, 2rem);
            font-weight: 700;
            color: var(--primary-color);
        }

        .custom-term {
            font-size: 0.9rem;
            color: var(--text-color);
        }

        .custom-note {
            font-size: 0.95rem;
            color: var(--secondary-color);
            margin-bottom: 1.5rem;
        }

        .custom-button {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            background-color: var(--primary-color);
            color: var(--white);
            text-decoration: none;
            border-radius: 6px;
            font-weight: 700;
            transition: var(--transition);
            box-shadow: 0 2px 8px rgba(219, 145, 35, 0.3);
        }

        .custom-button:hover {
            background-color: transparent;
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(219, 145, 35, 0.4);
        }

        .custom-features {
            list-style: none;
            padding: 0;
            margin: 1.5rem 0 0;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
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

        .shape-items-container .shape-item-row,
        .plan-items-container .plan-item-row,
        .custom-feature-items-container .custom-feature-item-row {
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

        .plan-feature-row {
            display: flex;
            gap: 12px;
            align-items: center;
            margin-bottom: 8px;
            padding: 8px;
            background: #f1f3f4;
            border-radius: 6px;
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

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-12px);
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
            .loan-plans-section {
                padding: 2rem 0;
            }

            .shape {
                max-width: 60px;
            }

            .pricing-table {
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .section-heading {
                font-size: clamp(1.5rem, 2vw, 1.75rem);
            }

            .plan-title,
            .custom-title {
                font-size: clamp(1.1rem, 1.5vw, 1.25rem);
            }

            .section-description,
            .plan-description,
            .custom-description,
            .plan-note,
            .custom-note {
                font-size: 0.9rem;
            }

            .plan-amount,
            .custom-amount {
                font-size: clamp(1.5rem, 2vw, 1.75rem);
            }

            .shape {
                display: none;
            }

            .pricing-card.featured {
                transform: scale(1);
            }

            .admin-panel {
                margin: 1.5rem 1rem;
                padding: 1.5rem;
            }

            .shape-item-row,
            .plan-item-row,
            .custom-feature-item-row {
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
                    <h1 class="text-2xl font-bold text-gray-900">Loan Plans Section Management</h1>
                    <p class="text-gray-600 text-sm mt-1">Customize and manage the loan plans section for your website.
                        Changes are reflected in real-time.</p>
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

    <!-- Pricing Preview -->
    <div class="pricing-preview-container">
        <section class="loan-plans-section" aria-label="Loan Plans Section Preview">
            <div id="shapesContainer">
                @foreach ($loanPlansData['shapes'] as $shape)
                    <img src="{{ asset($shape['src']) }}" alt="{{ $shape['alt'] }}" class="shape"
                        style="{{ $shape['position'] }}; animation-duration: {{ $shape['animationDuration'] }};" />
                @endforeach
            </div>

            <div class="section-title" id="sectionTitle">
                <h2 class="section-heading" id="previewSectionHeading">{{ $loanPlansData['sectionHeading'] }}</h2>
                <p class="section-description" id="previewSectionDescription">
                    {{ $loanPlansData['sectionDescription'] }}
                </p>
            </div>

            <div class="loan-type-switcher" id="loanTypeSwitcher">
                <span class="loan-type-label">Short Term Loans</span>
                <button class="switcher-button {{ session('loanType', 'short') === 'long' ? 'active' : '' }}"
                    id="loanTypeSwitcherBtn" aria-label="Toggle between short and long term loans">
                    <span class="switcher-knob"></span>
                </button>
                <span class="loan-type-label">Long Term Loans</span>
            </div>

            <div class="pricing-table" id="pricingTable">
                @foreach ($loanPlansData['plans'] as $index => $plan)
                    <div class="pricing-card {{ $plan['featured'] ? 'featured' : '' }}"
                        style="animation-delay: {{ 0.2 * ($index + 1) }}s;" role="article">
                        @if ($plan['featured'])
                            <div><span class="featured-label">Most Popular</span></div>
                        @endif
                        <h4 class="plan-title">{{ $plan['name'] }}</h4>
                        <p class="plan-description">{{ $plan['description'] }}</p>
                        <div>
                            <h2 class="plan-amount">
                                ${{ session('loanType', 'short') === 'short' ? $plan['amount']['short'] : $plan['amount']['long'] }}
                            </h2>
                            <span
                                class="plan-term">{{ session('loanType', 'short') === 'short' ? $plan['term']['short'] : $plan['term']['long'] }}</span>
                        </div>
                        <p class="plan-note">{{ $plan['note'] }}</p>
                        <a href="{{ $plan['buttonUrl'] }}" class="plan-apply-button"
                            aria-label="{{ $plan['buttonAriaLabel'] }}">{{ $plan['buttonText'] }}</a>
                        <ul class="plan-features">
                            @foreach ($plan['features'] as $feature)
                                <li class="plan-feature">
                                    <svg fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $feature['text'] }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>

            <div class="custom-loan" id="customLoan">
                <div class="custom-label">{{ $loanPlansData['customLoan']['label'] }}</div>
                <h4 class="custom-title">{{ $loanPlansData['customLoan']['title'] }}</h4>
                <p class="custom-description">
                    {{ $loanPlansData['customLoan']['description'] }}
                </p>
                <div>
                    <h2 class="custom-amount">{{ $loanPlansData['customLoan']['amount'] }}</h2>
                    <span class="custom-term">{{ $loanPlansData['customLoan']['term'] }}</span>
                </div>
                <p class="custom-note">{{ $loanPlansData['customLoan']['note'] }}</p>
                <a href="{{ $loanPlansData['customLoan']['buttonUrl'] }}" class="custom-button"
                    aria-label="{{ $loanPlansData['customLoan']['buttonAriaLabel'] }}">{{ $loanPlansData['customLoan']['buttonText'] }}</a>
                <ul class="custom-features">
                    @foreach ($loanPlansData['customLoan']['features'] as $feature)
                        <li class="plan-feature">
                            <svg fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            {{ $feature['text'] }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>
    </div>

    <!-- Admin Panel -->
    <div class="admin-panel" id="adminPanel" role="dialog" aria-labelledby="adminPanelTitle" aria-modal="true">
        <h3 id="adminPanelTitle">
            <i class="fas fa-edit"></i>
            Manage Loan Plans Content
        </h3>

        <form id="loanPlansForm" method="POST" action="{{ route('management.price-section') }}" enctype="multipart/form-data"
            novalidate>
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Left Column -->
                <div class="space-y-6">
                    <div class="form-group">
                        <label for="sectionHeading">Section Heading *</label>
                        <input type="text" id="sectionHeading" name="sectionHeading"
                            value="{{ old('sectionHeading', $loanPlansData['sectionHeading']) }}" class="form-control"
                            placeholder="Enter section heading..." required>
                        <span class="error-message" id="sectionHeadingError"></span>
                    </div>

                    <div class="form-group">
                        <label for="sectionDescription">Section Description *</label>
                        <textarea id="sectionDescription" name="sectionDescription" class="form-control" rows="4"
                            placeholder="Describe your loan plans..." required>{{ old('sectionDescription', $loanPlansData['sectionDescription']) }}</textarea>
                        <span class="error-message" id="sectionDescriptionError"></span>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <div class="form-group">
                        <label for="customLabel">Custom Loan Label *</label>
                        <input type="text" id="customLabel" name="customLoan[label]"
                            value="{{ old('customLoan.label', $loanPlansData['customLoan']['label']) }}"
                            class="form-control" placeholder="Custom loan label..." required>
                        <span class="error-message" id="customLabelError"></span>
                    </div>

                    <div class="form-group">
                        <label for="customTitle">Custom Loan Title *</label>
                        <input type="text" id="customTitle" name="customLoan[title]"
                            value="{{ old('customLoan.title', $loanPlansData['customLoan']['title']) }}"
                            class="form-control" placeholder="Custom loan title..." required>
                        <span class="error-message" id="customTitleError"></span>
                    </div>
                </div>
            </div>

            <!-- Shapes -->
            <div class="form-group">
                <label>Decorative Shapes</label>
                <div id="shapeItemsContainer" class="shape-items-container">
                    @foreach ($loanPlansData['shapes'] as $index => $shape)
                        <div class="shape-item-row">
                            <input type="file" name="shapes[{{ $index }}][file]"
                                class="form-control shape-file-input" accept="image/*">
                            <div class="image-preview">
                                <img src="{{ asset($shape['src']) }}" alt="Current shape">
                                <p class="text-sm text-gray-600 mt-2 text-center">Current shape</p>
                            </div>
                            <input type="text" name="shapes[{{ $index }}][alt]"
                                class="form-control shape-alt-input"
                                value="{{ old("shapes.$index.alt", $shape['alt']) }}" placeholder="Shape Alt Text"
                                required>
                            <input type="text" name="shapes[{{ $index }}][position]"
                                class="form-control shape-position-input"
                                value="{{ old("shapes.$index.position", $shape['position']) }}"
                                placeholder="Position (e.g., top: 10%; left: 5%;)" required>
                            <input type="text" name="shapes[{{ $index }}][animationDuration]"
                                class="form-control shape-animation-duration-input"
                                value="{{ old("shapes.$index.animationDuration", $shape['animationDuration']) }}"
                                placeholder="Animation Duration (e.g., 3s)" required>
                            <button type="button" class="admin-btn btn-danger remove-shape" aria-label="Remove shape">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    @endforeach
                </div>
                <button type="button" class="admin-btn btn-save mt-3" id="addShapeItem">
                    <i class="fas fa-plus"></i> Add Shape
                </button>
            </div>

            <!-- Pricing Plans -->
            <div class="form-group">
                <label>Pricing Plans</label>
                <div id="planItemsContainer" class="plan-items-container">
                    @foreach ($loanPlansData['plans'] as $index => $plan)
                        <div class="plan-item-row">
                            <input type="text" name="plans[{{ $index }}][name]"
                                class="form-control plan-name-input"
                                value="{{ old("plans.$index.name", $plan['name']) }}" placeholder="Plan Name" required>
                            <textarea name="plans[{{ $index }}][description]" class="form-control plan-description-input"
                                placeholder="Plan Description" required>{{ old("plans.$index.description", $plan['description']) }}</textarea>
                            <div class="flex items-center">
                                <input type="checkbox" name="plans[{{ $index }}][featured]"
                                    class="form-control plan-featured-input"
                                    {{ old("plans.$index.featured", $plan['featured']) ? 'checked' : '' }}>
                                <label class="ml-2">Featured Plan</label>
                            </div>
                            <input type="text" name="plans[{{ $index }}][amount][short]"
                                class="form-control plan-short-amount-input"
                                value="{{ old("plans.$index.amount.short", $plan['amount']['short']) }}"
                                placeholder="Short Term Amount" required>
                            <input type="text" name="plans[{{ $index }}][amount][long]"
                                class="form-control plan-long-amount-input"
                                value="{{ old("plans.$index.amount.long", $plan['amount']['long']) }}"
                                placeholder="Long Term Amount" required>
                            <input type="text" name="plans[{{ $index }}][term][short]"
                                class="form-control plan-short-term-input"
                                value="{{ old("plans.$index.term.short", $plan['term']['short']) }}"
                                placeholder="Short Term" required>
                            <input type="text" name="plans[{{ $index }}][term][long]"
                                class="form-control plan-long-term-input"
                                value="{{ old("plans.$index.term.long", $plan['term']['long']) }}"
                                placeholder="Long Term" required>
                            <input type="text" name="plans[{{ $index }}][note]"
                                class="form-control plan-note-input"
                                value="{{ old("plans.$index.note", $plan['note']) }}" placeholder="Plan Note" required>
                            <input type="text" name="plans[{{ $index }}][buttonText]"
                                class="form-control plan-button-text-input"
                                value="{{ old("plans.$index.buttonText", $plan['buttonText']) }}"
                                placeholder="Button Text" required>
                            <input type="url" name="plans[{{ $index }}][buttonUrl]"
                                class="form-control plan-button-url-input"
                                value="{{ old("plans.$index.buttonUrl", $plan['buttonUrl']) }}" placeholder="Button URL"
                                required>
                            <input type="text" name="plans[{{ $index }}][buttonAriaLabel]"
                                class="form-control plan-button-aria-label-input"
                                value="{{ old("plans.$index.buttonAriaLabel", $plan['buttonAriaLabel']) }}"
                                placeholder="Button ARIA Label" required>

                            <!-- Plan Features -->
                            <div class="w-full">
                                <label>Plan Features</label>
                                <div class="plan-features-container">
                                    @foreach ($plan['features'] as $fIndex => $feature)
                                        <div class="plan-feature-row">
                                            <input type="text"
                                                name="plans[{{ $index }}][features][{{ $fIndex }}][text]"
                                                class="form-control plan-feature-input"
                                                value="{{ old("plans.$index.features.$fIndex.text", $feature['text']) }}"
                                                placeholder="Feature Text" required>
                                            <button type="button" class="admin-btn btn-danger remove-plan-feature"
                                                aria-label="Remove feature">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" class="admin-btn btn-save mt-2 add-plan-feature"
                                    data-plan-index="{{ $index }}" aria-label="Add plan feature">
                                    <i class="fas fa-plus"></i> Add Feature
                                </button>
                            </div>

                            <button type="button" class="admin-btn btn-danger remove-plan" aria-label="Remove plan">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    @endforeach
                </div>
                <button type="button" class="admin-btn btn-save mt-3" id="addPlanItem">
                    <i class="fas fa-plus"></i> Add Pricing Plan
                </button>
            </div>

            <!-- Custom Loan Details -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="form-group">
                    <label for="customDescription">Custom Loan Description *</label>
                    <textarea id="customDescription" name="customLoan[description]" class="form-control" rows="4"
                        placeholder="Custom loan description..." required>{{ old('customLoan.description', $loanPlansData['customLoan']['description']) }}</textarea>
                    <span class="error-message" id="customDescriptionError"></span>
                </div>

                <div class="form-group">
                    <label for="customAmount">Custom Loan Amount *</label>
                    <input type="text" id="customAmount" name="customLoan[amount]"
                        value="{{ old('customLoan.amount', $loanPlansData['customLoan']['amount']) }}"
                        class="form-control" placeholder="Custom amount..." required>
                    <span class="error-message" id="customAmountError"></span>
                </div>

                <div class="form-group">
                    <label for="customTerm">Custom Loan Term *</label>
                    <input type="text" id="customTerm" name="customLoan[term]"
                        value="{{ old('customLoan.term', $loanPlansData['customLoan']['term']) }}" class="form-control"
                        placeholder="Custom term..." required>
                    <span class="error-message" id="customTermError"></span>
                </div>

                <div class="form-group">
                    <label for="customNote">Custom Loan Note *</label>
                    <input type="text" id="customNote" name="customLoan[note]"
                        value="{{ old('customLoan.note', $loanPlansData['customLoan']['note']) }}" class="form-control"
                        placeholder="Custom note..." required>
                    <span class="error-message" id="customNoteError"></span>
                </div>

                <div class="form-group">
                    <label for="customButtonText">Custom Loan Button Text *</label>
                    <input type="text" id="customButtonText" name="customLoan[buttonText]"
                        value="{{ old('customLoan.buttonText', $loanPlansData['customLoan']['buttonText']) }}"
                        class="form-control" placeholder="Button text..." required>
                    <span class="error-message" id="customButtonTextError"></span>
                </div>

                <div class="form-group">
                    <label for="customButtonUrl">Custom Loan Button URL *</label>
                    <input type="url" id="customButtonUrl" name="customLoan[buttonUrl]"
                        value="{{ old('customLoan.buttonUrl', $loanPlansData['customLoan']['buttonUrl']) }}"
                        class="form-control" placeholder="https://..." required>
                    <span class="error-message" id="customButtonUrlError"></span>
                </div>

                <div class="form-group">
                    <label for="customButtonAriaLabel">Custom Loan Button ARIA Label *</label>
                    <input type="text" id="customButtonAriaLabel" name="customLoan[buttonAriaLabel]"
                        value="{{ old('customLoan.buttonAriaLabel', $loanPlansData['customLoan']['buttonAriaLabel']) }}"
                        class="form-control" placeholder="ARIA label..." required>
                    <span class="error-message" id="customButtonAriaLabelError"></span>
                </div>
            </div>

            <!-- Custom Loan Features -->
            <div class="form-group">
                <label>Custom Loan Features</label>
                <div id="customFeatureItemsContainer" class="custom-feature-items-container">
                    @foreach ($loanPlansData['customLoan']['features'] as $index => $feature)
                        <div class="custom-feature-item-row">
                            <input type="text" name="customLoan[features][{{ $index }}][text]"
                                class="form-control custom-feature-input"
                                value="{{ old("customLoan.features.$index.text", $feature['text']) }}"
                                placeholder="Feature Text" required>
                            <button type="button" class="admin-btn btn-danger remove-custom-feature"
                                aria-label="Remove custom feature">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    @endforeach
                </div>
                <button type="button" class="admin-btn btn-save mt-3" id="addCustomFeatureItem">
                    <i class="fas fa-plus"></i> Add Custom Feature
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
        class PricingSectionManager {
            constructor() {
                this.elements = {
                    adminPanel: document.getElementById('adminPanel'),
                    toggleAdminBtn: document.getElementById('toggleAdmin'),
                    loanPlansForm: document.getElementById('loanPlansForm'),
                    cancelEditBtn: document.getElementById('cancelEdit'),
                    shapeItemsContainer: document.getElementById('shapeItemsContainer'),
                    planItemsContainer: document.getElementById('planItemsContainer'),
                    customFeatureItemsContainer: document.getElementById('customFeatureItemsContainer'),
                    addShapeItemBtn: document.getElementById('addShapeItem'),
                    addPlanItemBtn: document.getElementById('addPlanItem'),
                    addCustomFeatureItemBtn: document.getElementById('addCustomFeatureItem'),
                    loanTypeSwitcherBtn: document.getElementById('loanTypeSwitcherBtn'),
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

                // Add items
                this.elements.addShapeItemBtn.addEventListener('click', () => this.addShapeItem());
                this.elements.addPlanItemBtn.addEventListener('click', () => this.addPlanItem());
                this.elements.addCustomFeatureItemBtn.addEventListener('click', () => this.addCustomFeatureItem());

                // Remove items delegation
                this.elements.shapeItemsContainer.addEventListener('click', (e) => {
                    if (e.target.closest('.remove-shape')) {
                        this.removeShapeItem(e.target.closest('.remove-shape'));
                    }
                });

                this.elements.planItemsContainer.addEventListener('click', (e) => {
                    if (e.target.closest('.remove-plan')) {
                        this.removePlanItem(e.target.closest('.remove-plan'));
                    } else if (e.target.closest('.add-plan-feature')) {
                        const planIndex = e.target.closest('.add-plan-feature').dataset.planIndex;
                        this.addPlanFeature(planIndex);
                    } else if (e.target.closest('.remove-plan-feature')) {
                        this.removePlanFeature(e.target.closest('.remove-plan-feature'));
                    }
                });

                this.elements.customFeatureItemsContainer.addEventListener('click', (e) => {
                    if (e.target.closest('.remove-custom-feature')) {
                        this.removeCustomFeatureItem(e.target.closest('.remove-custom-feature'));
                    }
                });

                // Form submission
                this.elements.loanPlansForm.addEventListener('submit', (e) => this.validateForm(e));

                // Loan type switcher
                this.elements.loanTypeSwitcherBtn.addEventListener('click', () => this.toggleLoanType());

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
                        input: 'customLabel',
                        preview: 'customLabel'
                    },
                    {
                        input: 'customTitle',
                        preview: 'customTitle'
                    },
                    {
                        input: 'customDescription',
                        preview: 'customDescription'
                    },
                    {
                        input: 'customAmount',
                        preview: 'customAmount'
                    },
                    {
                        input: 'customTerm',
                        preview: 'customTerm'
                    },
                    {
                        input: 'customNote',
                        preview: 'customNote'
                    },
                    {
                        input: 'customButtonText',
                        preview: 'customButtonText'
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
                // In a real implementation, this would update the preview section
                console.log(`Updating ${field.preview} with:`, input.value);
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

            addShapeItem() {
                const shapeRows = document.querySelectorAll('.shape-item-row');
                const newIndex = shapeRows.length;

                const shapeHtml = `
                    <div class="shape-item-row">
                        <input type="file" name="shapes[${newIndex}][file]" 
                               class="form-control shape-file-input" accept="image/*">
                        <div class="image-preview" style="display: none;">
                            <img src="" alt="Shape preview">
                            <p class="text-sm text-gray-600 mt-2 text-center">New shape</p>
                        </div>
                        <input type="text" name="shapes[${newIndex}][alt]" 
                               class="form-control shape-alt-input" 
                               placeholder="Shape Alt Text" required>
                        <input type="text" name="shapes[${newIndex}][position]" 
                               class="form-control shape-position-input" 
                               placeholder="Position (e.g., top: 10%; left: 5%;)" required>
                        <input type="text" name="shapes[${newIndex}][animationDuration]" 
                               class="form-control shape-animation-duration-input" 
                               placeholder="Animation Duration (e.g., 3s)" required>
                        <button type="button" class="admin-btn btn-danger remove-shape" 
                                aria-label="Remove shape">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                `;

                this.elements.shapeItemsContainer.insertAdjacentHTML('beforeend', shapeHtml);

                // Setup image preview for the new item
                this.setupImagePreview(this.elements.shapeItemsContainer.lastElementChild);
            }

            setupImagePreview(row) {
                const fileInput = row.querySelector('.shape-file-input');
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

            addPlanItem() {
                const planRows = document.querySelectorAll('.plan-item-row');
                const newIndex = planRows.length;

                const planHtml = `
                    <div class="plan-item-row">
                        <input type="text" name="plans[${newIndex}][name]" 
                               class="form-control plan-name-input" 
                               placeholder="Plan Name" required>
                        <textarea name="plans[${newIndex}][description]" 
                                  class="form-control plan-description-input" 
                                  placeholder="Plan Description" required></textarea>
                        <div class="flex items-center">
                            <input type="checkbox" name="plans[${newIndex}][featured]" 
                                   class="form-control plan-featured-input">
                            <label class="ml-2">Featured Plan</label>
                        </div>
                        <input type="text" name="plans[${newIndex}][amount][short]" 
                               class="form-control plan-short-amount-input" 
                               placeholder="Short Term Amount" required>
                        <input type="text" name="plans[${newIndex}][amount][long]" 
                               class="form-control plan-long-amount-input" 
                               placeholder="Long Term Amount" required>
                        <input type="text" name="plans[${newIndex}][term][short]" 
                               class="form-control plan-short-term-input" 
                               placeholder="Short Term" required>
                        <input type="text" name="plans[${newIndex}][term][long]" 
                               class="form-control plan-long-term-input" 
                               placeholder="Long Term" required>
                        <input type="text" name="plans[${newIndex}][note]" 
                               class="form-control plan-note-input" 
                               placeholder="Plan Note" required>
                        <input type="text" name="plans[${newIndex}][buttonText]" 
                               class="form-control plan-button-text-input" 
                               placeholder="Button Text" required>
                        <input type="url" name="plans[${newIndex}][buttonUrl]" 
                               class="form-control plan-button-url-input" 
                               placeholder="Button URL" required>
                        <input type="text" name="plans[${newIndex}][buttonAriaLabel]" 
                               class="form-control plan-button-aria-label-input" 
                               placeholder="Button ARIA Label" required>
                        
                        <!-- Plan Features -->
                        <div class="w-full">
                            <label>Plan Features</label>
                            <div class="plan-features-container"></div>
                            <button type="button" class="admin-btn btn-save mt-2 add-plan-feature" 
                                    data-plan-index="${newIndex}" aria-label="Add plan feature">
                                <i class="fas fa-plus"></i> Add Feature
                            </button>
                        </div>

                        <button type="button" class="admin-btn btn-danger remove-plan" 
                                aria-label="Remove plan">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                `;

                this.elements.planItemsContainer.insertAdjacentHTML('beforeend', planHtml);
            }

            addPlanFeature(planIndex) {
                const planRow = document.querySelector(`.plan-item-row:nth-child(${parseInt(planIndex) + 1})`);
                const featuresContainer = planRow.querySelector('.plan-features-container');
                const featureRows = featuresContainer.querySelectorAll('.plan-feature-row');
                const newFeatureIndex = featureRows.length;

                const featureHtml = `
                    <div class="plan-feature-row">
                        <input type="text" 
                               name="plans[${planIndex}][features][${newFeatureIndex}][text]" 
                               class="form-control plan-feature-input" 
                               placeholder="Feature Text" required>
                        <button type="button" class="admin-btn btn-danger remove-plan-feature" 
                                aria-label="Remove feature">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                `;

                featuresContainer.insertAdjacentHTML('beforeend', featureHtml);
            }

            addCustomFeatureItem() {
                const featureRows = document.querySelectorAll('.custom-feature-item-row');
                const newIndex = featureRows.length;

                const featureHtml = `
                    <div class="custom-feature-item-row">
                        <input type="text" name="customLoan[features][${newIndex}][text]" 
                               class="form-control custom-feature-input" 
                               placeholder="Feature Text" required>
                        <button type="button" class="admin-btn btn-danger remove-custom-feature" 
                                aria-label="Remove custom feature">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                `;

                this.elements.customFeatureItemsContainer.insertAdjacentHTML('beforeend', featureHtml);
            }

            removeShapeItem(button) {
                if (confirm('Are you sure you want to remove this shape?')) {
                    button.closest('.shape-item-row').remove();
                }
            }

            removePlanItem(button) {
                if (confirm('Are you sure you want to remove this plan?')) {
                    button.closest('.plan-item-row').remove();
                }
            }

            removePlanFeature(button) {
                if (confirm('Are you sure you want to remove this feature?')) {
                    button.closest('.plan-feature-row').remove();
                }
            }

            removeCustomFeatureItem(button) {
                if (confirm('Are you sure you want to remove this custom feature?')) {
                    button.closest('.custom-feature-item-row').remove();
                }
            }

            toggleLoanType() {
                const isLongTerm = this.elements.loanTypeSwitcherBtn.classList.contains('active');
                const newLoanType = isLongTerm ? 'short' : 'long';

                fetch('{{ route('management.pricing.toggle') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            loanType: newLoanType
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            this.elements.loanTypeSwitcherBtn.classList.toggle('active');
                            window.location.reload();
                        }
                    })
                    .catch(error => {
                        console.error('Error toggling loan type:', error);
                        this.showNotification('Error updating loan type', 'error');
                    });
            }

            validateForm(e) {
                let isValid = true;

                // Clear previous errors
                this.clearErrors();

                // Validate required fields
                const requiredFields = [
                    'sectionHeading', 'sectionDescription', 'customLabel', 'customTitle',
                    'customDescription', 'customAmount', 'customTerm', 'customNote',
                    'customButtonText', 'customButtonUrl', 'customButtonAriaLabel'
                ];

                requiredFields.forEach(fieldId => {
                    const field = document.getElementById(fieldId);
                    if (!field.value.trim()) {
                        this.showError(fieldId, 'This field is required.');
                        isValid = false;
                    }
                });

                // Validate URL format
                const urlFields = ['customButtonUrl'];
                urlFields.forEach(fieldId => {
                    const field = document.getElementById(fieldId);
                    if (field.value && !this.isValidUrl(field.value)) {
                        this.showError(fieldId, 'Please enter a valid URL.');
                        isValid = false;
                    }
                });

                // Validate plans
                const planRows = document.querySelectorAll('.plan-item-row');
                if (planRows.length === 0) {
                    this.showError('planItemsContainer', 'At least one pricing plan is required.');
                    isValid = false;
                }

                planRows.forEach((row, index) => {
                    const requiredPlanFields = [
                        'name', 'description', 'amount][short', 'amount][long',
                        'term][short', 'term][long', 'note', 'buttonText', 'buttonUrl', 'buttonAriaLabel'
                    ];

                    requiredPlanFields.forEach(field => {
                        const input = row.querySelector(`[name="plans[${index}][${field}]"]`);
                        if (input && !input.value.trim()) {
                            this.showError(`plans[${index}][${field}]`, 'This field is required.');
                            isValid = false;
                        }
                    });

                    // Validate plan features
                    const featureRows = row.querySelectorAll('.plan-feature-row');
                    if (featureRows.length === 0) {
                        this.showError(`plans[${index}][features]`, 'At least one feature is required.');
                        isValid = false;
                    }
                });

                // Validate custom features
                const customFeatureRows = document.querySelectorAll('.custom-feature-item-row');
                if (customFeatureRows.length === 0) {
                    this.showError('customFeatureItemsContainer', 'At least one custom feature is required.');
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
                    this.elements.loanPlansForm.reset();
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

        // Initialize the pricing section manager
        document.addEventListener('DOMContentLoaded', () => {
            window.pricingManager = new PricingSectionManager();

            // Setup image previews for existing shape items
            document.querySelectorAll('.shape-item-row').forEach(row => {
                window.pricingManager.setupImagePreview(row);
            });
        });
    </script>
@endpush
