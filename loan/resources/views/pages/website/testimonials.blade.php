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

        .testimonials-preview-container {
            background: linear-gradient(135deg, var(--secondary-color) 0%, var(--primary-color) 100%);
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 2rem;
            box-shadow: var(--shadow);
        }

        .testimonials-section {
            color: var(--white);
            padding: clamp(2rem, 4vw, 3rem) 0;
            position: relative;
            overflow: hidden;
            isolation: isolate;
        }

        .testimonials-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
        }

        .background-shape {
            position: absolute;
            background-color: var(--white);
            opacity: 0.1;
            border-radius: 50%;
            animation: float 3s ease-in-out infinite;
        }

        /* @foreach ($testimonialsData['background_shapes'] ?? [] as $shape)
        .shape-{{ $shape['id'] }} {
            {{ $shape['position'] }} width: {{ $shape['size'] }};
            height: {{ $shape['size'] }};
            animation-duration: {{ $shape['animationDuration'] }};
        }
        @endforeach
        */ .testimonials-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 clamp(1rem, 3vw, 2rem);
            position: relative;
            z-index: 1;
        }

        .section-header {
            text-align: center;
            margin-bottom: 3rem;
            animation: fadeIn 0.6s ease-in;
        }

        .section-heading {
            font-size: clamp(2rem, 5vw, 2.5rem);
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 1rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .section-subheading {
            font-size: clamp(0.9rem, 2vw, 1rem);
            opacity: 0.9;
            line-height: 1.6;
            max-width: 600px;
            margin: 0 auto;
        }

        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .testimonial-card {
            background: var(--white);
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            transition: var(--transition);
            animation: fadeInUp 0.6s ease-in both;
        }

        .testimonial-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.2);
        }

        .testimonial-content {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .quote-icon {
            width: 40px;
            height: 40px;
            background-color: var(--primary-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-size: 1.25rem;
            margin-bottom: 1rem;
        }

        .testimonial-text {
            font-size: 1rem;
            color: #666;
            line-height: 1.8;
            font-style: italic;
            margin-bottom: 1.5rem;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .author-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-weight: bold;
            font-size: 1.25rem;
            flex-shrink: 0;
        }

        .author-avatar img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }

        .author-info {
            flex: 1;
        }

        .author-name {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--secondary-color);
            margin-bottom: 0.25rem;
        }

        .author-position {
            font-size: 0.9rem;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .testimonial-rating {
            color: var(--primary-color);
            font-size: 1.1rem;
        }

        .trust-indicators {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
            text-align: center;
        }

        .trust-indicator {
            animation: fadeInUp 0.6s ease-in 0.3s both;
        }

        .trust-value {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--primary-color);
            line-height: 1;
            margin-bottom: 0.5rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .trust-label {
            font-size: 1rem;
            opacity: 0.9;
        }

        .cta-section {
            text-align: center;
            animation: fadeInUp 0.6s ease-in 0.4s both;
        }

        .cta-heading {
            font-size: 1.75rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .cta-subheading {
            font-size: 1rem;
            opacity: 0.9;
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

        .cta-button--secondary {
            background-color: transparent;
            border-color: var(--white);
            color: var(--white);
        }

        .cta-button--secondary:hover {
            background-color: var(--white);
            color: var(--secondary-color);
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

        .testimonial-tabs {
            border-bottom: 1px solid #e5e7eb;
            margin-bottom: 1.5rem;
        }

        .testimonial-tab-buttons {
            display: flex;
            overflow-x: auto;
            gap: 0;
        }

        .testimonial-tab-btn {
            padding: 1rem 1.5rem;
            border: none;
            background: transparent;
            border-bottom: 2px solid transparent;
            font-weight: 600;
            color: #6b7280;
            cursor: pointer;
            transition: var(--transition);
            white-space: nowrap;
        }

        .testimonial-tab-btn.active {
            color: var(--primary-color);
            border-bottom-color: var(--primary-color);
        }

        .testimonial-tab-content {
            display: none;
        }

        .testimonial-tab-content.active {
            display: block;
            animation: fadeIn 0.3s ease-in;
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

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
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
            .testimonials-grid {
                grid-template-columns: 1fr;
            }

            .trust-indicators {
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }

            .cta-buttons {
                flex-direction: column;
                align-items: center;
            }

            .form-actions {
                flex-direction: column;
            }

            .admin-btn {
                width: 100%;
                justify-content: center;
            }

            .testimonial-tab-buttons {
                flex-wrap: wrap;
            }

            .testimonial-tab-btn {
                flex: 1;
                min-width: 100px;
                text-align: center;
            }

            .trust-item-row {
                flex-direction: column;
                gap: 8px;
            }
        }

        @media (max-width: 480px) {
            .testimonials-content {
                padding: 0 1rem;
            }

            .trust-indicators {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush
@section('breadcrumbs')
    <nav class="flex items-center space-x-2">
        <a href="{{ route('management.dashboard') }}" class="text-sm text-gray-500 hover:text-gray-700">Website Management</a>
        <span class="text-gray-400">/</span>
        <span class="text-sm text-gray-500">Testimonials Section</span>
    </nav>
@endsection
@section('page-icon')
    <i class="fas fa-comments fa-lg text-gray-700"></i>
@endsection
@section('page-title')
    <h1 class="text-2xl font-bold text-gray-900">Testimonials Section Management</h1>
    <p class="text-gray-600 text-sm mt-1">Manage and customize the testimonials section for your website.</p>
@endsection

@section('title', 'Testimonials Section Management')
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

    <!-- Testimonials Preview -->
    <div class="testimonials-preview-container">
        <section class="testimonials-section" aria-label="Testimonials Section Preview">
            <div class="testimonials-background">
                @foreach ($testimonialsData['background_shapes'] ?? [] as $shape)
                    <div class="background-shape shape-{{ $shape['id'] }}"></div>
                @endforeach
            </div>

            <div class="testimonials-content">
                <div class="section-header">
                    <h2 class="section-heading" id="previewHeading">
                        {{ $testimonialsData['headline'] ?? 'What Our Marketeers Say' }}
                    </h2>
                    <p class="section-subheading" id="previewSubheading">
                        {{ $testimonialsData['subheadline'] ?? 'Hear from marketing professionals and entrepreneurs who have transformed their businesses with our funding solutions.' }}
                    </p>
                </div>

                <div class="testimonials-grid" id="previewTestimonials">
                    @foreach ($testimonialsData['testimonials'] ?? [] as $testimonial)
                        <div class="testimonial-card">
                            <div class="testimonial-content">
                                <div class="quote-icon">
                                    <i class="fas fa-quote-left"></i>
                                </div>
                                <p class="testimonial-text">{{ $testimonial['content'] ?? '' }}</p>
                                <div class="testimonial-rating">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i
                                            class="fas fa-star{{ $i <= ($testimonial['rating'] ?? 5) ? '' : '-half-alt' }}"></i>
                                    @endfor
                                </div>
                            </div>
                            <div class="testimonial-author">
                                <div class="author-avatar">
                                    @if (isset($testimonial['photo']) && $testimonial['photo'])
                                        <img src="{{ Storage::url($testimonial['photo']) }}"
                                            alt="{{ $testimonial['name'] ?? '' }}">
                                    @else
                                        {{ substr($testimonial['name'] ?? '', 0, 1) }}
                                    @endif
                                </div>
                                <div class="author-info">
                                    <div class="author-name">{{ $testimonial['name'] ?? '' }}</div>
                                    <div class="author-position">{{ $testimonial['position'] ?? '' }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if (!empty($testimonialsData['indicators']))
                    <div class="trust-indicators" id="previewTrustIndicators">
                        @foreach ($testimonialsData['indicators'] as $indicator)
                            <div class="trust-indicator">
                                <div class="trust-value">{{ $indicator['value'] ?? '' }}</div>
                                <div class="trust-label">{{ $indicator['label'] ?? '' }}</div>
                            </div>
                        @endforeach
                    </div>
                @endif

                <div class="cta-section">
                    <h3 class="cta-heading" id="previewCtaHeading">
                        {{ $testimonialsData['cta_headline'] ?? 'Join hundreds of successful marketeers' }}
                    </h3>
                    <p class="cta-subheading" id="previewCtaSubheading">
                        {{ $testimonialsData['cta_subheadline'] ?? 'Get the funding you need to take your marketing business to the next level' }}
                    </p>
                    <div class="cta-buttons">
                        <a href="#!" class="cta-button" id="previewCtaPrimary">
                            {{ $testimonialsData['cta_primary_text'] ?? 'Apply Now' }}
                        </a>
                        <a href="#!" class="cta-button cta-button--secondary" id="previewCtaSecondary">
                            {{ $testimonialsData['cta_secondary_text'] ?? 'Read More Reviews' }}
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Admin Panel -->
    <div class="admin-panel" id="adminPanel" role="dialog" aria-labelledby="adminPanelTitle" aria-modal="true">
        <h3 id="adminPanelTitle">
            <i class="fas fa-edit"></i>
            Manage Testimonials Content
        </h3>

        <form id="testimonialsForm" action="{{ route('management.testimonial-section') }}" method="POST" novalidate
            enctype="multipart/form-data">
            @csrf

            <div class="space-y-6">
                <!-- Main Content Section -->
                <div class="form-group">
                    <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                        <i class="fas fa-heading text-blue-600"></i>
                        Main Content
                    </h4>
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label for="headline">Main Headline *</label>
                            <input type="text" id="headline" name="headline" class="form-control"
                                value="{{ old('headline', $testimonialsData['headline'] ?? '') }}"
                                placeholder="What Our Marketeers Say" required>
                            <span class="error-message" id="headlineError"></span>
                        </div>
                        <div>
                            <label for="subheadline">Subheadline</label>
                            <textarea id="subheadline" name="subheadline" class="form-control" rows="3"
                                placeholder="Hear from marketing professionals...">{{ old('subheadline', $testimonialsData['subheadline'] ?? '') }}</textarea>
                            <span class="error-message" id="subheadlineError"></span>
                        </div>
                    </div>
                </div>

                <!-- Testimonials Management -->
                <div class="form-group">
                    <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                        <i class="fas fa-comments text-green-600"></i>
                        Testimonials
                    </h4>

                    <!-- Testimonial Tabs -->
                    <div class="testimonial-tabs">
                        <div class="testimonial-tab-buttons">
                            @for ($i = 0; $i < 3; $i++)
                                <button type="button" class="testimonial-tab-btn {{ $i === 0 ? 'active' : '' }}"
                                    data-tab="testimonial-{{ $i }}">
                                    Testimonial {{ $i + 1 }}
                                </button>
                            @endfor
                        </div>
                    </div>

                    <!-- Testimonial Content -->
                    <div class="testimonial-tab-contents">
                        @for ($i = 0; $i < 3; $i++)
                            <div id="testimonial-{{ $i }}"
                                class="testimonial-tab-content {{ $i === 0 ? 'active' : '' }}">
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                    <!-- Testimonial Details -->
                                    <div class="space-y-4">
                                        <div>
                                            <label for="testimonial_{{ $i }}_name">Client Name *</label>
                                            <input type="text" id="testimonial_{{ $i }}_name"
                                                name="testimonials[{{ $i }}][name]" class="form-control"
                                                value="{{ old("testimonials.$i.name", $testimonialsData['testimonials'][$i]['name'] ?? '') }}"
                                                placeholder="e.g., Sarah Johnson" required>
                                            <span class="error-message"
                                                id="testimonial{{ $i }}NameError"></span>
                                        </div>

                                        <div>
                                            <label for="testimonial_{{ $i }}_position">Position &
                                                Company</label>
                                            <input type="text" id="testimonial_{{ $i }}_position"
                                                name="testimonials[{{ $i }}][position]" class="form-control"
                                                value="{{ old("testimonials.$i.position", $testimonialsData['testimonials'][$i]['position'] ?? '') }}"
                                                placeholder="e.g., Owner @SocialBoost Agency">
                                        </div>

                                        <div>
                                            <label for="testimonial_{{ $i }}_rating">Rating</label>
                                            <select id="testimonial_{{ $i }}_rating"
                                                name="testimonials[{{ $i }}][rating]" class="form-control">
                                                <option value="5"
                                                    {{ old("testimonials.$i.rating", $testimonialsData['testimonials'][$i]['rating'] ?? '') == '5' ? 'selected' : '' }}>
                                                    ★★★★★ (5 stars)</option>
                                                <option value="4"
                                                    {{ old("testimonials.$i.rating", $testimonialsData['testimonials'][$i]['rating'] ?? '') == '4' ? 'selected' : '' }}>
                                                    ★★★★☆ (4 stars)</option>
                                                <option value="3"
                                                    {{ old("testimonials.$i.rating", $testimonialsData['testimonials'][$i]['rating'] ?? '') == '3' ? 'selected' : '' }}>
                                                    ★★★☆☆ (3 stars)</option>
                                                <option value="2"
                                                    {{ old("testimonials.$i.rating", $testimonialsData['testimonials'][$i]['rating'] ?? '') == '2' ? 'selected' : '' }}>
                                                    ★★☆☆☆ (2 stars)</option>
                                                <option value="1"
                                                    {{ old("testimonials.$i.rating", $testimonialsData['testimonials'][$i]['rating'] ?? '') == '1' ? 'selected' : '' }}>
                                                    ★☆☆☆☆ (1 star)</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Testimonial Content & Media -->
                                    <div class="space-y-4">
                                        <div>
                                            <label for="testimonial_{{ $i }}_content">Testimonial Content
                                                *</label>
                                            <textarea id="testimonial_{{ $i }}_content" name="testimonials[{{ $i }}][content]"
                                                class="form-control" rows="6" placeholder="Londa Loans funded our social media campaign..." required>{{ old("testimonials.$i.content", $testimonialsData['testimonials'][$i]['content'] ?? '') }}</textarea>
                                            <span class="error-message"
                                                id="testimonial{{ $i }}ContentError"></span>
                                        </div>

                                        <div>
                                            <label for="testimonial_{{ $i }}_photo">Client Photo</label>
                                            <input type="file" id="testimonial_{{ $i }}_photo"
                                                name="testimonials[{{ $i }}][photo]" class="form-control"
                                                accept="image/jpeg,image/png,image/webp">

                                            <!-- Current Photo Preview with Delete Option -->
                                            @if (isset($testimonialsData['testimonials'][$i]['photo']) && $testimonialsData['testimonials'][$i]['photo'])
                                                <div class="image-preview mt-2">
                                                    <img src="{{ Storage::url($testimonialsData['testimonials'][$i]['photo']) }}"
                                                        alt="Current client photo" class="max-w-xs rounded-lg">
                                                    <p class="text-sm text-gray-600 mt-2">Current photo</p>
                                                    <button type="button"
                                                        class="admin-btn btn-danger mt-2 delete-photo-btn"
                                                        data-testimonial-index="{{ $i }}"
                                                        data-photo-path="{{ $testimonialsData['testimonials'][$i]['photo'] }}">
                                                        <i class="fas fa-trash"></i> Delete Photo
                                                    </button>
                                                </div>
                                            @endif

                                            <p class="text-sm text-gray-500 mt-1">Max file size: 2MB. Allowed formats:
                                                JPEG, PNG, JPG, WebP</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>

                <!-- Trust Indicators -->
                <div class="form-group">
                    <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                        <i class="fas fa-chart-line text-orange-600"></i>
                        Trust Indicators
                    </h4>
                    <div id="trustIndicatorsContainer" class="trust-indicators-container">
                        @foreach ($testimonialsData['indicators'] ?? [] as $index => $indicator)
                            <div class="trust-item-row">
                                <input type="text" name="indicators[{{ $index }}][value]"
                                    class="form-control trust-value-input"
                                    value="{{ old("indicators.$index.value", $indicator['value'] ?? '') }}"
                                    data-id="{{ $index }}" placeholder="Value (e.g., 500+)" required>
                                <input type="text" name="indicators[{{ $index }}][label]"
                                    class="form-control trust-label-input"
                                    value="{{ old("indicators.$index.label", $indicator['label'] ?? '') }}"
                                    data-id="{{ $index }}" placeholder="Label (e.g., Marketing Campaigns Funded)"
                                    required>
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

                <!-- CTA Section -->
                <div class="form-group">
                    <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                        <i class="fas fa-bullhorn text-purple-600"></i>
                        Call to Action Section
                    </h4>
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label for="cta_headline">CTA Headline</label>
                            <input type="text" id="cta_headline" name="cta_headline" class="form-control"
                                value="{{ old('cta_headline', $testimonialsData['cta_headline'] ?? '') }}"
                                placeholder="Join hundreds of successful marketeers">
                        </div>
                        <div>
                            <label for="cta_subheadline">CTA Subheadline</label>
                            <textarea id="cta_subheadline" name="cta_subheadline" class="form-control" rows="2"
                                placeholder="Get the funding you need...">{{ old('cta_subheadline', $testimonialsData['cta_subheadline'] ?? '') }}</textarea>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="cta_primary_text">Primary Button Text</label>
                                <input type="text" id="cta_primary_text" name="cta_primary_text" class="form-control"
                                    value="{{ old('cta_primary_text', $testimonialsData['cta_primary_text'] ?? '') }}"
                                    placeholder="Apply Now">
                            </div>
                            <div>
                                <label for="cta_secondary_text">Secondary Button Text</label>
                                <input type="text" id="cta_secondary_text" name="cta_secondary_text"
                                    class="form-control"
                                    value="{{ old('cta_secondary_text', $testimonialsData['cta_secondary_text'] ?? '') }}"
                                    placeholder="Read More Reviews">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section Settings -->
                <div class="form-group">
                    <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                        <i class="fas fa-cog text-gray-600"></i>
                        Section Settings
                    </h4>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label for="title">Section Title *</label>
                            <input type="text" id="title" name="title" class="form-control"
                                value="{{ old('title', $testimonialsData['title'] ?? '') }}"
                                placeholder="Enter section title" required>
                            <p class="text-sm text-gray-500 mt-1">Internal reference name</p>
                        </div>
                        <div>
                            <label for="order">Display Order</label>
                            <input type="number" id="order" name="order" class="form-control"
                                value="{{ old('order', $testimonialsData['order'] ?? 0) }}" min="0"
                                max="100" step="1">
                            <p class="text-sm text-gray-500 mt-1">Lower numbers display first</p>
                        </div>
                        <div>
                            <label for="status">Status *</label>
                            <select id="status" name="status" class="form-control" required>
                                <option value="ACTIVE"
                                    {{ old('status', $testimonialsData['status'] ?? '') == 'ACTIVE' ? 'selected' : '' }}>
                                    Active</option>
                                <option value="INACTIVE"
                                    {{ old('status', $testimonialsData['status'] ?? '') == 'INACTIVE' ? 'selected' : '' }}>
                                    Inactive</option>
                                <option value="DRAFT"
                                    {{ old('status', $testimonialsData['status'] ?? '') == 'DRAFT' ? 'selected' : '' }}>
                                    Draft</option>
                            </select>
                            <p class="text-sm text-gray-500 mt-1">Control section visibility</p>
                        </div>
                    </div>
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
        class TestimonialsSectionManager {
            constructor() {
                this.elements = {
                    adminPanel: document.getElementById('adminPanel'),
                    toggleAdminBtn: document.getElementById('toggleAdmin'),
                    testimonialsForm: document.getElementById('testimonialsForm'),
                    cancelEditBtn: document.getElementById('cancelEdit'),
                    trustIndicatorsContainer: document.getElementById('trustIndicatorsContainer'),
                    addTrustIndicatorBtn: document.getElementById('addTrustIndicator'),
                    testimonialTabButtons: document.querySelectorAll('.testimonial-tab-btn'),
                    testimonialTabContents: document.querySelectorAll('.testimonial-tab-content')
                };

                this.trustIndicatorCounter = {{ count($testimonialsData['indicators'] ?? []) }};

                this.init();
            }

            init() {
                this.setupEventListeners();
                this.setupRealTimePreview();
                this.setupTestimonialTabs();
                this.setupPhotoDeletion();
            }

            setupEventListeners() {
                // Toggle admin panel
                this.elements.toggleAdminBtn.addEventListener('click', () => this.toggleAdminPanel());

                // Cancel edit
                this.elements.cancelEditBtn.addEventListener('click', () => this.hideAdminPanel());

                // Add trust indicator
                this.elements.addTrustIndicatorBtn.addEventListener('click', () => this.addTrustIndicator());

                // Form submission
                this.elements.testimonialsForm.addEventListener('submit', (e) => this.validateForm(e));

                // Remove trust indicator delegation
                this.elements.trustIndicatorsContainer.addEventListener('click', (e) => {
                    if (e.target.closest('.remove-trust-indicator')) {
                        this.removeTrustIndicator(e.target.closest('.remove-trust-indicator'));
                    }
                });
            }

            setupPhotoDeletion() {
                // Photo deletion event delegation
                document.addEventListener('click', (e) => {
                    if (e.target.closest('.delete-photo-btn')) {
                        this.deletePhoto(e.target.closest('.delete-photo-btn'));
                    }
                });
            }

            setupTestimonialTabs() {
                this.elements.testimonialTabButtons.forEach(button => {
                    button.addEventListener('click', () => {
                        const targetTab = button.getAttribute('data-tab');

                        // Update active tab button
                        this.elements.testimonialTabButtons.forEach(btn => {
                            btn.classList.remove('active');
                        });
                        button.classList.add('active');

                        // Show target tab content
                        this.elements.testimonialTabContents.forEach(content => {
                            content.classList.remove('active');
                        });
                        document.getElementById(targetTab).classList.add('active');
                    });
                });
            }

            setupRealTimePreview() {
                // Real-time preview updates
                const previewFields = [{
                        input: 'headline',
                        preview: 'previewHeading'
                    },
                    {
                        input: 'subheadline',
                        preview: 'previewSubheading'
                    },
                    {
                        input: 'cta_headline',
                        preview: 'previewCtaHeading'
                    },
                    {
                        input: 'cta_subheadline',
                        preview: 'previewCtaSubheading'
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

            addTrustIndicator() {
                const newId = this.trustIndicatorCounter++;

                const indicatorHtml = `
                <div class="trust-item-row">
                    <input type="text" name="indicators[${newId}][value]" 
                           class="form-control trust-value-input" data-id="${newId}" 
                           placeholder="Value (e.g., 500+)" required>
                    <input type="text" name="indicators[${newId}][label]" 
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

            async deletePhoto(button) {
                const testimonialIndex = button.getAttribute('data-testimonial-index');
                const photoPath = button.getAttribute('data-photo-path');

                if (!confirm('Are you sure you want to delete this photo?')) {
                    return;
                }

                try {
                    const response = await fetch(`/management/testimonial-section/delete-photo/${testimonialIndex}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content'),
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                        },
                    });

                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }

                    const data = await response.json();

                    if (data.success) {
                        // Remove the photo preview
                        const previewContainer = button.closest('.image-preview');
                        if (previewContainer) {
                            previewContainer.remove();
                        }

                        // Clear the file input
                        const fileInput = document.getElementById(`testimonial_${testimonialIndex}_photo`);
                        if (fileInput) {
                            fileInput.value = '';
                        }

                        // Show success message
                        this.showNotification('Photo deleted successfully', 'success');
                    } else {
                        this.showNotification(data.message || 'Failed to delete photo', 'error');
                    }
                } catch (error) {
                    console.error('Error deleting photo:', error);
                    this.showNotification('Failed to delete photo. Please try again.', 'error');
                }
            }

            showNotification(message, type = 'info') {
                // Create notification element
                const notification = document.createElement('div');
                notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 ${
                type === 'success' ? 'bg-green-500 text-white' :
                type === 'error' ? 'bg-red-500 text-white' :
                'bg-blue-500 text-white'
            }`;
                notification.textContent = message;

                document.body.appendChild(notification);

                // Remove after 3 seconds
                setTimeout(() => {
                    notification.remove();
                }, 3000);
            }

            validateForm(e) {
                let isValid = true;

                // Clear previous errors
                this.clearErrors();

                // Validate required fields
                const requiredFields = [
                    'headline', 'title', 'status'
                ];

                requiredFields.forEach(fieldId => {
                    const field = document.getElementById(fieldId);
                    if (!field.value.trim()) {
                        this.showError(fieldId, 'This field is required.');
                        isValid = false;
                    }
                });

                // Validate testimonials
                for (let i = 0; i < 3; i++) {
                    const testimonialName = document.getElementById(`testimonial_${i}_name`);
                    const testimonialContent = document.getElementById(`testimonial_${i}_content`);

                    if (testimonialName && testimonialName.value.trim() && !testimonialContent.value.trim()) {
                        this.showError(`testimonial${i}Content`,
                            'Testimonial content is required when name is provided.');
                        isValid = false;
                    }

                    if (testimonialName && testimonialName.value.trim() && testimonialContent && testimonialContent
                        .value.trim()) {
                        // Both name and content are provided, validate content length
                        if (testimonialContent.value.length > 1000) {
                            this.showError(`testimonial${i}Content`,
                                'Testimonial content must not exceed 1000 characters.');
                            isValid = false;
                        }
                    }

                    // Validate file size if a file is selected
                    const photoInput = document.getElementById(`testimonial_${i}_photo`);
                    if (photoInput && photoInput.files.length > 0) {
                        const file = photoInput.files[0];
                        if (file.size > 2 * 1024 * 1024) { // 2MB in bytes
                            this.showError(`testimonial${i}Photo`, 'File size must be less than 2MB.');
                            isValid = false;
                        }
                    }
                }

                // Validate trust indicators
                const trustValueInputs = document.querySelectorAll('.trust-value-input');
                const trustLabelInputs = document.querySelectorAll('.trust-label-input');

                trustValueInputs.forEach((input, index) => {
                    if (!input.value.trim()) {
                        this.showError(`trust-value-${index}`, 'Trust indicator value is required.');
                        isValid = false;
                    }
                });

                trustLabelInputs.forEach((input, index) => {
                    if (!input.value.trim()) {
                        this.showError(`trust-label-${index}`, 'Trust indicator label is required.');
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
        }

        // Initialize the testimonials section manager
        document.addEventListener('DOMContentLoaded', () => {
            new TestimonialsSectionManager();
        });
    </script>
@endpush
