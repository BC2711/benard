@extends('layouts.admin.main')

@push('styles')
    <style>
        :root {
            --primary-color: #db9123;
            --secondary-color: #7a4603;
            --white: #ffffff;
            --background-color: #f8f5f0;
            --shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
            --error-color: #e3342f;
            --success-color: #10b981;
            --text-color: #666;
        }

        .team-preview-container {
            background: var(--white);
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 2rem;
            box-shadow: var(--shadow);
            border: 1px solid #e5e7eb;
        }

        .team-section {
            background-color: var(--background-color);
            padding: clamp(3rem, 5vw, 4rem) 0;
            position: relative;
            overflow: hidden;
        }

        .shape {
            position: absolute;
            max-width: clamp(60px, 8vw, 90px);
            animation: float 3s ease-in-out infinite;
            z-index: 1;
        }

        .circle-shape {
            position: absolute;
            background-color: var(--primary-color);
            opacity: 0.1;
            border-radius: 50%;
            z-index: 1;
        }

        .section-title {
            text-align: center;
            margin-bottom: 3rem;
            animation: fadeIn 0.6s ease-in;
            position: relative;
            z-index: 2;
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

        .team-grid {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 clamp(1rem, 3vw, 2rem);
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
            position: relative;
            z-index: 2;
        }

        .team-member {
            text-align: center;
            animation: fadeInUp 0.6s ease-in both;
            background: var(--white);
            border-radius: 12px;
            padding: 2rem;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }

        .team-member:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .team-member-image {
            position: relative;
            margin-bottom: 1.5rem;
            border-radius: 12px;
            overflow: hidden;
        }

        .team-member-image img {
            width: 100%;
            max-width: 250px;
            height: 250px;
            object-fit: cover;
            border-radius: 12px;
            transition: var(--transition);
        }

        .team-member:hover .team-member-image img {
            transform: scale(1.05);
        }

        .social-links {
            display: flex;
            gap: 0.75rem;
            justify-content: center;
            margin-top: 1rem;
            opacity: 0;
            transform: translateY(10px);
            transition: var(--transition);
        }

        .team-member:hover .social-links {
            opacity: 1;
            transform: translateY(0);
        }

        .social-links a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background-color: var(--primary-color);
            border-radius: 50%;
            transition: var(--transition);
        }

        .social-links a:hover {
            background-color: var(--secondary-color);
            transform: scale(1.1);
        }

        .social-links svg {
            width: 18px;
            height: 18px;
            fill: var(--white);
        }

        .team-member-name {
            font-size: clamp(1.1rem, 1.5vw, 1.25rem);
            font-weight: 700;
            color: var(--secondary-color);
            margin-bottom: 0.5rem;
        }

        .team-member-title {
            font-size: clamp(0.85rem, 1.5vw, 0.95rem);
            color: var(--primary-color);
            margin-bottom: 0.75rem;
            font-weight: 600;
        }

        .team-member-description {
            font-size: clamp(0.8rem, 1.5vw, 0.9rem);
            color: var(--text-color);
            line-height: 1.5;
        }

        .team-cta {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 clamp(1rem, 3vw, 2rem);
            text-align: center;
            animation: fadeIn 0.6s ease-in 0.4s both;
            position: relative;
            z-index: 2;
        }

        .team-cta-heading {
            font-size: clamp(1.5rem, 2vw, 1.75rem);
            font-weight: 700;
            color: var(--secondary-color);
            margin-bottom: 0.75rem;
        }

        .team-cta-description {
            font-size: clamp(0.9rem, 2vw, 1rem);
            color: var(--text-color);
            margin-bottom: 2rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.6;
        }

        .team-cta-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            justify-content: center;
        }

        .cta-button {
            padding: 0.875rem 2rem;
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

        .shape-items-container .shape-item-row,
        .team-member-items-container .team-member-item-row,
        .social-link-items-container .social-link-item-row {
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

        .social-link-item-row {
            margin-bottom: 8px;
            padding: 8px;
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
            .team-section {
                padding: 2rem 0;
            }

            .shape {
                max-width: 60px;
            }

            .team-grid {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 1.5rem;
            }
        }

        @media (max-width: 768px) {
            .section-heading {
                font-size: clamp(1.5rem, 2vw, 1.75rem);
            }

            .team-cta-heading {
                font-size: clamp(1.3rem, 1.5vw, 1.5rem);
            }

            .team-member-name {
                font-size: clamp(1rem, 1.5vw, 1.1rem);
            }

            .section-description,
            .team-cta-description,
            .team-member-title,
            .team-member-description {
                font-size: 0.9rem;
            }

            .shape,
            .circle-shape {
                display: none;
            }

            .team-cta-buttons {
                flex-direction: column;
                align-items: center;
                gap: 0.75rem;
            }

            .admin-panel {
                margin: 1.5rem 1rem;
                padding: 1.5rem;
            }

            .shape-item-row,
            .team-member-item-row,
            .social-link-item-row {
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
                    <h1 class="text-2xl font-bold text-gray-900">Team Section Management</h1>
                    <p class="text-gray-600 text-sm mt-1">Customize and manage the team section for your website. Changes are
                        reflected in real-time.</p>
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

    <!-- Team Preview -->
    <div class="team-preview-container">
        <section class="team-section" aria-label="Team Section Preview">
            <div id="shapesContainer">
                @foreach ($teamData['shapes'] as $shape)
                    @if ($shape['type'] === 'circle')
                        <span class="circle-shape"
                            style="{{ $shape['position'] }}; width: {{ $shape['size'] }}; height: {{ $shape['size'] }}; opacity: {{ $shape['opacity'] }};"></span>
                    @else
                        <img src="{{ asset($shape['src']) }}" alt="{{ $shape['alt'] }}" class="shape"
                            style="{{ $shape['position'] }}; max-width: {{ $shape['maxWidth'] ?? '90px' }}; animation-duration: {{ $shape['animationDuration'] }};" />
                    @endif
                @endforeach
            </div>

            <div class="section-title" id="sectionTitle">
                <h2 class="section-heading" id="previewSectionHeading">{{ $teamData['sectionHeading'] }}</h2>
                <p class="section-description" id="previewSectionDescription">
                    {{ $teamData['sectionDescription'] }}
                </p>
            </div>

            <div class="team-grid" id="teamGrid">
                @foreach ($teamData['teamMembers'] as $index => $member)
                    <div class="team-member" style="animation-delay: {{ 0.1 * ($index + 1) }}s;" role="article">
                        <div class="team-member-image">
                            <img src="{{ asset($member['image']) }}" alt="{{ $member['alt'] }}" />
                        </div>
                        <h4 class="team-member-name">{{ $member['name'] }}</h4>
                        <p class="team-member-title">{{ $member['title'] }}</p>
                        <p class="team-member-description">{{ $member['description'] }}</p>
                        <div class="social-links">
                            @foreach ($member['socialLinks'] as $link)
                                <a href="{{ $link['url'] }}" aria-label="{{ $link['ariaLabel'] }}" target="_blank"
                                    rel="noopener">
                                    <svg viewBox="{{ $link['platform'] === 'twitter' ? '0 0 18 14' : ($link['platform'] === 'linkedin' ? '0 0 17 16' : '0 0 10 18') }}"
                                        xmlns="http://www.w3.org/2000/svg">
                                        @if ($link['platform'] === 'facebook')
                                            <path
                                                d="M6.66634 10.25H8.74968L9.58301 6.91669H6.66634V5.25002C6.66634 4.39169 6.66634 3.58335 8.33301 3.58335H9.58301V0.783354C9.31134 0.74752 8.28551 0.666687 7.20218 0.666687C4.93968 0.666687 3.33301 2.04752 3.33301 4.58335V6.91669H0.833008V10.25H3.33301V17.3334H6.66634V10.25Z" />
                                        @elseif ($link['platform'] === 'twitter')
                                            <path
                                                d="M17.4683 1.71333C16.8321 1.99475 16.1574 2.17956 15.4666 2.26167C16.1947 1.82619 16.7397 1.14085 16.9999 0.333333C16.3166 0.74 15.5674 1.025 14.7866 1.17917C14.2621 0.617982 13.5669 0.245803 12.809 0.120487C12.0512 -0.00482822 11.2732 0.123742 10.596 0.486211C9.91875 0.848679 9.38024 1.42474 9.06418 2.12483C8.74812 2.82492 8.67221 3.60982 8.84825 4.3575C7.46251 4.28805 6.10686 3.92794 4.86933 3.30055C3.63179 2.67317 2.54003 1.79254 1.66492 0.715833C1.35516 1.24788 1.19238 1.85269 1.19326 2.46833C1.19326 3.67667 1.80826 4.74417 2.74326 5.36917C2.18993 5.35175 1.64878 5.20232 1.16492 4.93333V4.97667C1.16509 5.78142 1.44356 6.56135 1.95313 7.18422C2.46269 7.80709 3.17199 8.23456 3.96075 8.39417C3.4471 8.53337 2.90851 8.55388 2.38576 8.45417C2.60814 9.14686 3.04159 9.75267 3.62541 10.1868C4.20924 10.6209 4.9142 10.8615 5.64159 10.875C4.91866 11.4428 4.0909 11.8625 3.20566 12.1101C2.32041 12.3578 1.39503 12.4285 0.482422 12.3183C2.0755 13.3429 3.93 13.8868 5.82409 13.885C12.2349 13.885 15.7408 8.57417 15.7408 3.96833C15.7408 3.81833 15.7366 3.66667 15.7299 3.51833C16.4123 3.02514 17.0013 2.41418 17.4691 1.71417L17.4683 1.71333Z" />
                                        @elseif ($link['platform'] === 'linkedin')
                                            <path
                                                d="M3.78353 2.16665C3.78331 2.60867 3.6075 3.03251 3.29478 3.34491C2.98207 3.65732 2.55806 3.8327 2.11603 3.83248C1.674 3.83226 1.25017 3.65645 0.937761 3.34373C0.625357 3.03102 0.449975 2.60701 0.450196 2.16498C0.450417 1.72295 0.626223 1.29912 0.93894 0.986712C1.25166 0.674307 1.67567 0.498925 2.1177 0.499146C2.55972 0.499367 2.98356 0.675173 3.29596 0.98789C3.60837 1.30061 3.78375 1.72462 3.78353 2.16665V2.16665ZM3.83353 5.06665H0.500195V15.5H3.83353V5.06665ZM9.1002 5.06665H5.78353V15.5H9.06686V10.025C9.06686 6.97498 13.0419 6.69165 13.0419 10.025V15.5H16.3335V8.89165C16.3335 3.74998 10.4502 3.94165 9.06686 6.46665L9.1002 5.06665V5.06665Z" />
                                        @endif
                                    </svg>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="team-cta" id="teamCta">
                <h3 class="team-cta-heading" id="previewCtaHeading">{{ $teamData['cta']['heading'] }}</h3>
                <p class="team-cta-description" id="previewCtaDescription">
                    {{ $teamData['cta']['description'] }}
                </p>
                <div class="team-cta-buttons">
                    <a href="{{ $teamData['cta']['primaryButton']['url'] }}" class="cta-button primary"
                        aria-label="{{ $teamData['cta']['primaryButton']['ariaLabel'] }}" id="previewPrimaryButton">
                        {{ $teamData['cta']['primaryButton']['text'] }}
                    </a>
                    <a href="{{ $teamData['cta']['secondaryButton']['url'] }}" class="cta-button secondary"
                        aria-label="{{ $teamData['cta']['secondaryButton']['ariaLabel'] }}" id="previewSecondaryButton">
                        {{ $teamData['cta']['secondaryButton']['text'] }}
                    </a>
                </div>
            </div>
        </section>
    </div>

    <!-- Admin Panel -->
    <div class="admin-panel" id="adminPanel" role="dialog" aria-labelledby="adminPanelTitle" aria-modal="true">
        <h3 id="adminPanelTitle">
            <i class="fas fa-edit"></i>
            Manage Team Content
        </h3>

        <form id="teamForm" method="POST" action="{{ route('management.team-section') }}" enctype="multipart/form-data"
            novalidate>
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Left Column -->
                <div class="space-y-6">
                    <div class="form-group">
                        <label for="sectionHeading">Section Heading *</label>
                        <input type="text" id="sectionHeading" name="sectionHeading"
                            value="{{ old('sectionHeading', $teamData['sectionHeading']) }}" class="form-control"
                            placeholder="Enter section heading..." required>
                        <span class="error-message" id="sectionHeadingError"></span>
                    </div>

                    <div class="form-group">
                        <label for="sectionDescription">Section Description *</label>
                        <textarea id="sectionDescription" name="sectionDescription" class="form-control" rows="4"
                            placeholder="Describe your team..." required>{{ old('sectionDescription', $teamData['sectionDescription']) }}</textarea>
                        <span class="error-message" id="sectionDescriptionError"></span>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <div class="form-group">
                        <label for="ctaHeading">CTA Heading *</label>
                        <input type="text" id="ctaHeading" name="cta[heading]"
                            value="{{ old('cta.heading', $teamData['cta']['heading']) }}" class="form-control"
                            placeholder="Enter CTA heading..." required>
                        <span class="error-message" id="ctaHeadingError"></span>
                    </div>

                    <div class="form-group">
                        <label for="ctaDescription">CTA Description *</label>
                        <textarea id="ctaDescription" name="cta[description]" class="form-control" rows="4"
                            placeholder="Enter CTA description..." required>{{ old('cta.description', $teamData['cta']['description']) }}</textarea>
                        <span class="error-message" id="ctaDescriptionError"></span>
                    </div>
                </div>
            </div>

            <!-- Shapes -->
            <div class="form-group">
                <label>Decorative Shapes</label>
                <div id="shapeItemsContainer" class="shape-items-container">
                    @foreach ($teamData['shapes'] as $index => $shape)
                        <div class="shape-item-row">
                            <select class="form-control shape-type-select" name="shapes[{{ $index }}][type]"
                                aria-label="Shape type" onchange="toggleShapeFields(this)">
                                <option value="circle" {{ $shape['type'] === 'circle' ? 'selected' : '' }}>Circle</option>
                                <option value="image" {{ $shape['type'] === 'image' ? 'selected' : '' }}>Image</option>
                            </select>

                            @if ($shape['type'] === 'image')
                                <input type="file" name="shapes[{{ $index }}][src]"
                                    class="form-control shape-file-input" accept="image/*">
                                <div class="image-preview">
                                    <img src="{{ asset($shape['src']) }}" alt="Current shape">
                                    <p class="text-sm text-gray-600 mt-2 text-center">Current shape</p>
                                </div>
                                <input type="text" name="shapes[{{ $index }}][alt]"
                                    class="form-control shape-alt-input"
                                    value="{{ old("shapes.$index.alt", $shape['alt']) }}" placeholder="Shape Alt Text"
                                    required>
                            @else
                                <input type="text" name="shapes[{{ $index }}][size]"
                                    class="form-control shape-size-input"
                                    value="{{ old("shapes.$index.size", $shape['size']) }}"
                                    placeholder="Size (e.g., 150px)" required>
                                <input type="text" name="shapes[{{ $index }}][opacity]"
                                    class="form-control shape-opacity-input"
                                    value="{{ old("shapes.$index.opacity", $shape['opacity']) }}"
                                    placeholder="Opacity (e.g., 0.1)" required>
                            @endif

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

            <!-- Team Members -->
            <div class="form-group">
                <label>Team Members</label>
                <div id="teamMemberItemsContainer" class="team-member-items-container">
                    @foreach ($teamData['teamMembers'] as $index => $member)
                        <div class="team-member-item-row">
                            <input type="text" name="teamMembers[{{ $index }}][name]"
                                class="form-control team-member-name-input"
                                value="{{ old("teamMembers.$index.name", $member['name']) }}" placeholder="Name"
                                required>
                            <input type="text" name="teamMembers[{{ $index }}][title]"
                                class="form-control team-member-title-input"
                                value="{{ old("teamMembers.$index.title", $member['title']) }}" placeholder="Title"
                                required>
                            <textarea name="teamMembers[{{ $index }}][description]" class="form-control team-member-description-input"
                                placeholder="Description" required>{{ old("teamMembers.$index.description", $member['description']) }}</textarea>
                            <input type="file" name="teamMembers[{{ $index }}][image]"
                                class="form-control team-member-image-input" accept="image/*">
                            <div class="image-preview">
                                <img src="{{ asset($member['image']) }}" alt="Current team member">
                                <p class="text-sm text-gray-600 mt-2 text-center">Current image</p>
                            </div>
                            <input type="text" name="teamMembers[{{ $index }}][alt]"
                                class="form-control team-member-alt-input"
                                value="{{ old("teamMembers.$index.alt", $member['alt']) }}" placeholder="Image Alt Text"
                                required>

                            <!-- Social Links -->
                            <div class="w-full">
                                <label>Social Links</label>
                                <div class="social-link-items-container">
                                    @foreach ($member['socialLinks'] as $linkIndex => $link)
                                        <div class="social-link-item-row">
                                            <select
                                                name="teamMembers[{{ $index }}][socialLinks][{{ $linkIndex }}][platform]"
                                                class="form-control social-link-platform-select"
                                                aria-label="Social platform">
                                                <option value="facebook"
                                                    {{ $link['platform'] === 'facebook' ? 'selected' : '' }}>Facebook
                                                </option>
                                                <option value="twitter"
                                                    {{ $link['platform'] === 'twitter' ? 'selected' : '' }}>Twitter
                                                </option>
                                                <option value="linkedin"
                                                    {{ $link['platform'] === 'linkedin' ? 'selected' : '' }}>LinkedIn
                                                </option>
                                            </select>
                                            <input type="url"
                                                name="teamMembers[{{ $index }}][socialLinks][{{ $linkIndex }}][url]"
                                                class="form-control social-link-url-input"
                                                value="{{ old("teamMembers.$index.socialLinks.$linkIndex.url", $link['url']) }}"
                                                placeholder="URL" required>
                                            <input type="text"
                                                name="teamMembers[{{ $index }}][socialLinks][{{ $linkIndex }}][ariaLabel]"
                                                class="form-control social-link-aria-label-input"
                                                value="{{ old("teamMembers.$index.socialLinks.$linkIndex.ariaLabel", $link['ariaLabel']) }}"
                                                placeholder="ARIA Label" required>
                                            <button type="button" class="admin-btn btn-danger remove-social-link"
                                                aria-label="Remove social link">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" class="admin-btn btn-save mt-2 add-social-link"
                                    data-member-index="{{ $index }}" aria-label="Add social link">
                                    <i class="fas fa-plus"></i> Add Social Link
                                </button>
                            </div>

                            <button type="button" class="admin-btn btn-danger remove-team-member"
                                aria-label="Remove team member">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    @endforeach
                </div>
                <button type="button" class="admin-btn btn-save mt-3" id="addTeamMemberItem">
                    <i class="fas fa-plus"></i> Add Team Member
                </button>
            </div>

            <!-- CTA Buttons -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="form-group">
                    <label for="ctaPrimaryButtonText">Primary CTA Button Text *</label>
                    <input type="text" id="ctaPrimaryButtonText" name="cta[primaryButton][text]"
                        value="{{ old('cta.primaryButton.text', $teamData['cta']['primaryButton']['text']) }}"
                        class="form-control" placeholder="Button text..." required>
                    <span class="error-message" id="ctaPrimaryButtonTextError"></span>
                </div>

                <div class="form-group">
                    <label for="ctaPrimaryButtonUrl">Primary CTA Button URL *</label>
                    <input type="url" id="ctaPrimaryButtonUrl" name="cta[primaryButton][url]"
                        value="{{ old('cta.primaryButton.url', $teamData['cta']['primaryButton']['url']) }}"
                        class="form-control" placeholder="https://..." required>
                    <span class="error-message" id="ctaPrimaryButtonUrlError"></span>
                </div>

                <div class="form-group">
                    <label for="ctaPrimaryButtonAriaLabel">Primary CTA Button ARIA Label *</label>
                    <input type="text" id="ctaPrimaryButtonAriaLabel" name="cta[primaryButton][ariaLabel]"
                        value="{{ old('cta.primaryButton.ariaLabel', $teamData['cta']['primaryButton']['ariaLabel']) }}"
                        class="form-control" placeholder="ARIA label..." required>
                    <span class="error-message" id="ctaPrimaryButtonAriaLabelError"></span>
                </div>

                <div class="form-group">
                    <label for="ctaSecondaryButtonText">Secondary CTA Button Text *</label>
                    <input type="text" id="ctaSecondaryButtonText" name="cta[secondaryButton][text]"
                        value="{{ old('cta.secondaryButton.text', $teamData['cta']['secondaryButton']['text']) }}"
                        class="form-control" placeholder="Button text..." required>
                    <span class="error-message" id="ctaSecondaryButtonTextError"></span>
                </div>

                <div class="form-group">
                    <label for="ctaSecondaryButtonUrl">Secondary CTA Button URL *</label>
                    <input type="url" id="ctaSecondaryButtonUrl" name="cta[secondaryButton][url]"
                        value="{{ old('cta.secondaryButton.url', $teamData['cta']['secondaryButton']['url']) }}"
                        class="form-control" placeholder="https://..." required>
                    <span class="error-message" id="ctaSecondaryButtonUrlError"></span>
                </div>

                <div class="form-group">
                    <label for="ctaSecondaryButtonAriaLabel">Secondary CTA Button ARIA Label *</label>
                    <input type="text" id="ctaSecondaryButtonAriaLabel" name="cta[secondaryButton][ariaLabel]"
                        value="{{ old('cta.secondaryButton.ariaLabel', $teamData['cta']['secondaryButton']['ariaLabel']) }}"
                        class="form-control" placeholder="ARIA label..." required>
                    <span class="error-message" id="ctaSecondaryButtonAriaLabelError"></span>
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
        class TeamSectionManager {
            constructor() {
                this.elements = {
                    adminPanel: document.getElementById('adminPanel'),
                    toggleAdminBtn: document.getElementById('toggleAdmin'),
                    teamForm: document.getElementById('teamForm'),
                    cancelEditBtn: document.getElementById('cancelEdit'),
                    shapeItemsContainer: document.getElementById('shapeItemsContainer'),
                    teamMemberItemsContainer: document.getElementById('teamMemberItemsContainer'),
                    addShapeItemBtn: document.getElementById('addShapeItem'),
                    addTeamMemberItemBtn: document.getElementById('addTeamMemberItem'),
                    previewChangesBtn: document.getElementById('previewChanges'),
                    resetToDefaultBtn: document.getElementById('resetToDefault')
                };

                this.init();
            }

            init() {
                this.setupEventListeners();
                this.setupRealTimePreview();
                this.setupImagePreviews();
            }

            setupEventListeners() {
                // Toggle admin panel
                this.elements.toggleAdminBtn.addEventListener('click', () => this.toggleAdminPanel());

                // Cancel edit
                this.elements.cancelEditBtn.addEventListener('click', () => this.hideAdminPanel());

                // Add items
                this.elements.addShapeItemBtn.addEventListener('click', () => this.addShapeItem());
                this.elements.addTeamMemberItemBtn.addEventListener('click', () => this.addTeamMemberItem());

                // Remove items delegation
                this.elements.shapeItemsContainer.addEventListener('click', (e) => {
                    if (e.target.closest('.remove-shape')) {
                        this.removeShapeItem(e.target.closest('.remove-shape'));
                    }
                });

                this.elements.teamMemberItemsContainer.addEventListener('click', (e) => {
                    if (e.target.closest('.remove-team-member')) {
                        this.removeTeamMemberItem(e.target.closest('.remove-team-member'));
                    } else if (e.target.closest('.add-social-link')) {
                        const memberIndex = e.target.closest('.add-social-link').dataset.memberIndex;
                        this.addSocialLink(memberIndex);
                    } else if (e.target.closest('.remove-social-link')) {
                        this.removeSocialLink(e.target.closest('.remove-social-link'));
                    }
                });

                // Form submission
                this.elements.teamForm.addEventListener('submit', (e) => this.validateForm(e));

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
                        input: 'ctaPrimaryButtonText',
                        preview: 'previewPrimaryButton'
                    },
                    {
                        input: 'ctaPrimaryButtonUrl',
                        preview: 'previewPrimaryButton',
                        attr: 'href'
                    },
                    {
                        input: 'ctaSecondaryButtonText',
                        preview: 'previewSecondaryButton'
                    },
                    {
                        input: 'ctaSecondaryButtonUrl',
                        preview: 'previewSecondaryButton',
                        attr: 'href'
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
                        preview.setAttribute(field.attr, input.value);
                    } else {
                        preview.textContent = input.value;
                    }
                }
            }

            setupImagePreviews() {
                // Setup image previews for file inputs
                const fileInputs = document.querySelectorAll('input[type="file"]');
                fileInputs.forEach(input => {
                    input.addEventListener('change', (e) => {
                        const preview = e.target.nextElementSibling?.querySelector('img');
                        if (preview && e.target.files && e.target.files[0]) {
                            const reader = new FileReader();
                            reader.onload = (e) => {
                                preview.src = e.target.result;
                            };
                            reader.readAsDataURL(e.target.files[0]);
                        }
                    });
                });
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
                    <select class="form-control shape-type-select" name="shapes[${newIndex}][type]" 
                            aria-label="Shape type" onchange="toggleShapeFields(this)">
                        <option value="circle">Circle</option>
                        <option value="image">Image</option>
                    </select>
                    <input type="text" name="shapes[${newIndex}][size]" 
                           class="form-control shape-size-input" 
                           placeholder="Size (e.g., 150px)" required>
                    <input type="text" name="shapes[${newIndex}][opacity]" 
                           class="form-control shape-opacity-input" 
                           placeholder="Opacity (e.g., 0.1)" required>
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
            }

            addTeamMemberItem() {
                const teamMemberRows = document.querySelectorAll('.team-member-item-row');
                const newIndex = teamMemberRows.length;

                const memberHtml = `
                <div class="team-member-item-row">
                    <input type="text" name="teamMembers[${newIndex}][name]" 
                           class="form-control team-member-name-input" 
                           placeholder="Name" required>
                    <input type="text" name="teamMembers[${newIndex}][title]" 
                           class="form-control team-member-title-input" 
                           placeholder="Title" required>
                    <textarea name="teamMembers[${newIndex}][description]" 
                              class="form-control team-member-description-input" 
                              placeholder="Description" required></textarea>
                    <input type="file" name="teamMembers[${newIndex}][image]" 
                           class="form-control team-member-image-input" accept="image/*">
                    <div class="image-preview" style="display: none;">
                        <img src="" alt="Team member preview">
                        <p class="text-sm text-gray-600 mt-2 text-center">New image</p>
                    </div>
                    <input type="text" name="teamMembers[${newIndex}][alt]" 
                           class="form-control team-member-alt-input" 
                           placeholder="Image Alt Text" required>
                    
                    <!-- Social Links -->
                    <div class="w-full">
                        <label>Social Links</label>
                        <div class="social-link-items-container"></div>
                        <button type="button" class="admin-btn btn-save mt-2 add-social-link" 
                                data-member-index="${newIndex}" aria-label="Add social link">
                            <i class="fas fa-plus"></i> Add Social Link
                        </button>
                    </div>

                    <button type="button" class="admin-btn btn-danger remove-team-member" 
                            aria-label="Remove team member">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            `;

                this.elements.teamMemberItemsContainer.insertAdjacentHTML('beforeend', memberHtml);
                this.setupImagePreviews();
            }

            addSocialLink(memberIndex) {
                const memberRow = document.querySelector(
                    `.team-member-item-row:nth-child(${parseInt(memberIndex) + 1})`);
                const socialLinksContainer = memberRow.querySelector('.social-link-items-container');
                const socialLinkRows = socialLinksContainer.querySelectorAll('.social-link-item-row');
                const newLinkIndex = socialLinkRows.length;

                const linkHtml = `
                <div class="social-link-item-row">
                    <select name="teamMembers[${memberIndex}][socialLinks][${newLinkIndex}][platform]" 
                            class="form-control social-link-platform-select" 
                            aria-label="Social platform">
                        <option value="facebook">Facebook</option>
                        <option value="twitter">Twitter</option>
                        <option value="linkedin">LinkedIn</option>
                    </select>
                    <input type="url" name="teamMembers[${memberIndex}][socialLinks][${newLinkIndex}][url]" 
                           class="form-control social-link-url-input" 
                           placeholder="URL" required>
                    <input type="text" name="teamMembers[${memberIndex}][socialLinks][${newLinkIndex}][ariaLabel]" 
                           class="form-control social-link-aria-label-input" 
                           placeholder="ARIA Label" required>
                    <button type="button" class="admin-btn btn-danger remove-social-link" 
                            aria-label="Remove social link">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            `;

                socialLinksContainer.insertAdjacentHTML('beforeend', linkHtml);
            }

            removeShapeItem(button) {
                if (confirm('Are you sure you want to remove this shape?')) {
                    button.closest('.shape-item-row').remove();
                }
            }

            removeTeamMemberItem(button) {
                if (confirm('Are you sure you want to remove this team member?')) {
                    button.closest('.team-member-item-row').remove();
                }
            }

            removeSocialLink(button) {
                if (confirm('Are you sure you want to remove this social link?')) {
                    button.closest('.social-link-item-row').remove();
                }
            }

            validateForm(e) {
                let isValid = true;

                // Clear previous errors
                this.clearErrors();

                // Validate required fields
                const requiredFields = [
                    'sectionHeading', 'sectionDescription', 'ctaHeading', 'ctaDescription',
                    'ctaPrimaryButtonText', 'ctaPrimaryButtonUrl', 'ctaPrimaryButtonAriaLabel',
                    'ctaSecondaryButtonText', 'ctaSecondaryButtonUrl', 'ctaSecondaryButtonAriaLabel'
                ];

                requiredFields.forEach(fieldId => {
                    const field = document.getElementById(fieldId);
                    if (!field.value.trim()) {
                        this.showError(fieldId, 'This field is required.');
                        isValid = false;
                    }
                });

                // Validate URL format
                const urlFields = ['ctaPrimaryButtonUrl', 'ctaSecondaryButtonUrl'];
                urlFields.forEach(fieldId => {
                    const field = document.getElementById(fieldId);
                    if (field.value && !this.isValidUrl(field.value)) {
                        this.showError(fieldId, 'Please enter a valid URL.');
                        isValid = false;
                    }
                });

                // Validate team members
                const teamMemberRows = document.querySelectorAll('.team-member-item-row');
                if (teamMemberRows.length === 0) {
                    this.showError('teamMemberItemsContainer', 'At least one team member is required.');
                    isValid = false;
                }

                teamMemberRows.forEach((row, index) => {
                    const requiredFields = ['name', 'title', 'description', 'alt'];

                    requiredFields.forEach(field => {
                        const input = row.querySelector(`[name="teamMembers[${index}][${field}]"]`);
                        if (input && !input.value.trim()) {
                            this.showError(`teamMembers[${index}][${field}]`,
                            'This field is required.');
                            isValid = false;
                        }
                    });

                    // Validate social links
                    const socialLinkRows = row.querySelectorAll('.social-link-item-row');
                    socialLinkRows.forEach((linkRow, linkIndex) => {
                        const urlInput = linkRow.querySelector('.social-link-url-input');
                        const ariaLabelInput = linkRow.querySelector('.social-link-aria-label-input');

                        if (!urlInput.value.trim() || !this.isValidUrl(urlInput.value)) {
                            this.showError(`teamMembers[${index}][socialLinks][${linkIndex}][url]`,
                                'Valid URL is required.');
                            isValid = false;
                        }
                        if (!ariaLabelInput.value.trim()) {
                            this.showError(
                                `teamMembers[${index}][socialLinks][${linkIndex}][ariaLabel]`,
                                'ARIA label is required.');
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
                    this.elements.teamForm.reset();
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

        // Global function to toggle shape fields
        function toggleShapeFields(select) {
            const row = select.closest('.shape-item-row');
            const isImage = select.value === 'image';

            // Remove existing fields
            const existingFields = row.querySelectorAll(
                '.shape-size-input, .shape-opacity-input, .shape-file-input, .shape-alt-input, .image-preview');
            existingFields.forEach(field => field.remove());

            // Add appropriate fields
            if (isImage) {
                row.insertAdjacentHTML('beforeend', `
                <input type="file" name="${select.name.replace('[type]', '[src]')}" 
                       class="form-control shape-file-input" accept="image/*">
                <div class="image-preview" style="display: none;">
                    <img src="" alt="Shape preview">
                    <p class="text-sm text-gray-600 mt-2 text-center">New shape</p>
                </div>
                <input type="text" name="${select.name.replace('[type]', '[alt]')}" 
                       class="form-control shape-alt-input" 
                       placeholder="Shape Alt Text" required>
            `);
            } else {
                row.insertAdjacentHTML('beforeend', `
                <input type="text" name="${select.name.replace('[type]', '[size]')}" 
                       class="form-control shape-size-input" 
                       placeholder="Size (e.g., 150px)" required>
                <input type="text" name="${select.name.replace('[type]', '[opacity]')}" 
                       class="form-control shape-opacity-input" 
                       placeholder="Opacity (e.g., 0.1)" required>
            `);
            }

            // Re-initialize image previews
            window.teamManager.setupImagePreviews();
        }

        // Initialize the team section manager
        document.addEventListener('DOMContentLoaded', () => {
            window.teamManager = new TeamSectionManager();
        });
    </script>
@endpush
