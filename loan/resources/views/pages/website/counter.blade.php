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

        .counter-preview-container {
            background: linear-gradient(135deg, var(--secondary-color) 0%, var(--primary-color) 100%);
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 2rem;
            box-shadow: var(--shadow);
        }

        .counter-section {
            color: var(--white);
            padding: clamp(2rem, 4vw, 3rem) 0;
            position: relative;
            overflow: hidden;
            isolation: isolate;
        }

        .counter-background {
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

        .shape-1 {
            top: 10%;
            left: 5%;
            width: 150px;
            height: 150px;
            animation-duration: 3s;
        }

        .shape-2 {
            top: 15%;
            right: 5%;
            width: 80px;
            height: 80px;
            animation-duration: 3.5s;
        }

        .shape-3 {
            top: 20%;
            left: 10%;
            width: 70px;
            height: 70px;
            animation-duration: 4s;
        }

        .shape-4 {
            bottom: 10%;
            right: 15%;
            width: 90px;
            height: 90px;
            animation-duration: 3.8s;
        }

        .shape-5 {
            bottom: 15%;
            left: 10%;
            width: 85px;
            height: 85px;
            animation-duration: 4.2s;
        }

        .counter-content {
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

        .main-stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .main-stat {
            text-align: center;
            animation: fadeInUp 0.6s ease-in both;
        }

        .main-stat-value {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--primary-color);
            line-height: 1;
            margin-bottom: 0.5rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .main-stat-label {
            font-size: 1rem;
            opacity: 0.9;
        }

        .mini-stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 1.5rem;
            margin-bottom: 3rem;
        }

        .mini-stat {
            text-align: center;
            animation: fadeInUp 0.6s ease-in both;
        }

        .mini-stat-value {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0.25rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .mini-stat-label {
            font-size: 0.9rem;
            opacity: 0.8;
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

        .form-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            align-items: center;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e5e7eb;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .stat-item {
            padding: 1rem;
            background: #f8f9fa;
            border-radius: 8px;
            border: 1px solid #e9ecef;
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
            .main-stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }

            .mini-stats-grid {
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

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .counter-content {
                padding: 0 1rem;
            }

            .main-stats-grid,
            .mini-stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush
@section('breadcrumbs')
    <nav class="flex items-center space-x-2">
        <a href="{{ route('management.dashboard') }}" class="text-sm text-gray-500 hover:text-gray-700">Website Management</a>
        <span class="text-gray-400">/</span>
        <span class="text-sm text-gray-500">Counter Section</span>
    </nav>
@endsection
@section('page-icon')
    <i class="fas fa-chart-bar fa-lg text-gray-700"></i>
@endsection
@section('page-title')
    <h1 class="text-2xl font-bold text-gray-900">Counter Section Management</h1>
    <p class="text-gray-600 text-sm mt-1">Manage and customize the impact numbers and statistics section for
        your website.</p>
@endsection

@section('title', 'Counter Section Management')
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

    <!-- Counter Preview -->
    <div class="counter-preview-container">
        <section class="counter-section" aria-label="Counter Section Preview">
            <div class="counter-background">
                <div class="background-shape shape-1"></div>
                <div class="background-shape shape-2"></div>
                <div class="background-shape shape-3"></div>
                <div class="background-shape shape-4"></div>
                <div class="background-shape shape-5"></div>
            </div>

            <div class="counter-content">
                <div class="section-header">
                    <h2 class="section-heading" id="previewHeading">
                        {{ $counterData['headline'] ?? 'Our Impact in Numbers' }}
                    </h2>
                    <p class="section-subheading" id="previewSubheading">
                        {{ $counterData['subheadline'] ?? 'Real results for marketing professionals and entrepreneurs' }}
                    </p>
                </div>

                <!-- Main Stats -->
                <div class="main-stats-grid" id="previewMainStats">
                    @foreach ($counterData['main_stats'] ?? [] as $stat)
                        <div class="main-stat" style="animation-delay: {{ $stat['animation_delay'] ?? '0.1' }}s">
                            <div class="main-stat-value">{{ $stat['value'] ?? '' }}</div>
                            <div class="main-stat-label">{{ $stat['label'] ?? '' }}</div>
                        </div>
                    @endforeach
                </div>

                <!-- Mini Stats -->
                @if (!empty($counterData['mini_stats']))
                    <div class="mini-stats-grid" id="previewMiniStats">
                        @foreach ($counterData['mini_stats'] as $stat)
                            <div class="mini-stat" style="animation-delay: {{ $stat['animation_delay'] ?? '0.5' }}s">
                                <div class="mini-stat-value">{{ $stat['value'] ?? '' }}</div>
                                <div class="mini-stat-label">{{ $stat['label'] ?? '' }}</div>
                            </div>
                        @endforeach
                    </div>
                @endif

                <!-- CTA Section -->
                <div class="cta-section">
                    <h3 class="cta-heading" id="previewCtaHeading">
                        {{ $counterData['cta_headline'] ?? 'Ready to join our success stories?' }}
                    </h3>
                    <p class="cta-subheading" id="previewCtaSubheading">
                        {{ $counterData['cta_subheadline'] ?? 'Start your application and become our next success story' }}
                    </p>
                    <div class="cta-buttons">
                        <a href="#!" class="cta-button" id="previewCtaPrimary">
                            {{ $counterData['cta_primary_text'] ?? 'Apply Now' }}
                        </a>
                        <a href="#!" class="cta-button cta-button--secondary" id="previewCtaSecondary">
                            {{ $counterData['cta_secondary_text'] ?? 'Calculate Loan' }}
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
            Manage Counter Content
        </h3>

        <form id="counterForm" action="{{ route('management.counter-section') }}" method="POST" novalidate>
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
                                value="{{ old('headline', $counterData['headline'] ?? '') }}"
                                placeholder="Our Impact in Numbers" required>
                            <span class="error-message" id="headlineError"></span>
                        </div>
                        <div>
                            <label for="subheadline">Subheadline</label>
                            <textarea id="subheadline" name="subheadline" class="form-control" rows="3"
                                placeholder="Real results for marketing professionals...">{{ old('subheadline', $counterData['subheadline'] ?? '') }}</textarea>
                            <span class="error-message" id="subheadlineError"></span>
                        </div>
                    </div>
                </div>

                <!-- Main Statistics -->
                <div class="form-group">
                    <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                        <i class="fas fa-chart-bar text-green-600"></i>
                        Main Statistics
                    </h4>
                    <div class="stats-grid">
                        @foreach (range(1, 4) as $stat)
                            <div class="stat-item">
                                <h5 class="font-semibold text-gray-900 text-sm mb-3">Stat {{ $stat }}</h5>
                                <div class="space-y-2">
                                    <div>
                                        <label for="main_stat_{{ $stat }}_value">Value *</label>
                                        <input type="text" id="main_stat_{{ $stat }}_value"
                                            name="main_stats[{{ $stat - 1 }}][value]" class="form-control"
                                            value="{{ old('main_stats.' . ($stat - 1) . '.value', $counterData['main_stats'][$stat - 1]['value'] ?? '') }}"
                                            placeholder="e.g., 500+" required>
                                    </div>
                                    <div>
                                        <label for="main_stat_{{ $stat }}_label">Label *</label>
                                        <input type="text" id="main_stat_{{ $stat }}_label"
                                            name="main_stats[{{ $stat - 1 }}][label]" class="form-control"
                                            value="{{ old('main_stats.' . ($stat - 1) . '.label', $counterData['main_stats'][$stat - 1]['label'] ?? '') }}"
                                            placeholder="e.g., Marketing Campaigns Funded" required>
                                    </div>
                                    <div>
                                        <label for="main_stat_{{ $stat }}_animation_delay">Animation Delay</label>
                                        <select id="main_stat_{{ $stat }}_animation_delay"
                                            name="main_stats[{{ $stat - 1 }}][animation_delay]" class="form-control">
                                            <option value="0.1"
                                                {{ old('main_stats.' . ($stat - 1) . '.animation_delay', $counterData['main_stats'][$stat - 1]['animation_delay'] ?? '') == '0.1' ? 'selected' : '' }}>
                                                0.1s (First)</option>
                                            <option value="0.2"
                                                {{ old('main_stats.' . ($stat - 1) . '.animation_delay', $counterData['main_stats'][$stat - 1]['animation_delay'] ?? '') == '0.2' ? 'selected' : '' }}>
                                                0.2s (Second)</option>
                                            <option value="0.3"
                                                {{ old('main_stats.' . ($stat - 1) . '.animation_delay', $counterData['main_stats'][$stat - 1]['animation_delay'] ?? '') == '0.3' ? 'selected' : '' }}>
                                                0.3s (Third)</option>
                                            <option value="0.4"
                                                {{ old('main_stats.' . ($stat - 1) . '.animation_delay', $counterData['main_stats'][$stat - 1]['animation_delay'] ?? '') == '0.4' ? 'selected' : '' }}>
                                                0.4s (Fourth)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Mini Statistics -->
                <div class="form-group">
                    <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                        <i class="fas fa-chart-line text-orange-600"></i>
                        Additional Statistics
                    </h4>
                    <div class="stats-grid">
                        @foreach (range(1, 3) as $stat)
                            <div class="stat-item">
                                <h5 class="font-semibold text-gray-900 text-sm mb-3">Mini Stat {{ $stat }}</h5>
                                <div class="space-y-2">
                                    <div>
                                        <label for="mini_stat_{{ $stat }}_value">Value</label>
                                        <input type="text" id="mini_stat_{{ $stat }}_value"
                                            name="mini_stats[{{ $stat - 1 }}][value]" class="form-control"
                                            value="{{ old('mini_stats.' . ($stat - 1) . '.value', $counterData['mini_stats'][$stat - 1]['value'] ?? '') }}"
                                            placeholder="e.g., 300%">
                                    </div>
                                    <div>
                                        <label for="mini_stat_{{ $stat }}_label">Label</label>
                                        <input type="text" id="mini_stat_{{ $stat }}_label"
                                            name="mini_stats[{{ $stat - 1 }}][label]" class="form-control"
                                            value="{{ old('mini_stats.' . ($stat - 1) . '.label', $counterData['mini_stats'][$stat - 1]['label'] ?? '') }}"
                                            placeholder="e.g., Average ROI for Funded Campaigns">
                                    </div>
                                    <div>
                                        <label for="mini_stat_{{ $stat }}_animation_delay">Animation Delay</label>
                                        <select id="mini_stat_{{ $stat }}_animation_delay"
                                            name="mini_stats[{{ $stat - 1 }}][animation_delay]" class="form-control">
                                            <option value="0.5"
                                                {{ old('mini_stats.' . ($stat - 1) . '.animation_delay', $counterData['mini_stats'][$stat - 1]['animation_delay'] ?? '') == '0.5' ? 'selected' : '' }}>
                                                0.5s (First)</option>
                                            <option value="0.6"
                                                {{ old('mini_stats.' . ($stat - 1) . '.animation_delay', $counterData['mini_stats'][$stat - 1]['animation_delay'] ?? '') == '0.6' ? 'selected' : '' }}>
                                                0.6s (Second)</option>
                                            <option value="0.7"
                                                {{ old('mini_stats.' . ($stat - 1) . '.animation_delay', $counterData['mini_stats'][$stat - 1]['animation_delay'] ?? '') == '0.7' ? 'selected' : '' }}>
                                                0.7s (Third)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
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
                                value="{{ old('cta_headline', $counterData['cta_headline'] ?? '') }}"
                                placeholder="Ready to join our success stories?">
                        </div>
                        <div>
                            <label for="cta_subheadline">CTA Subheadline</label>
                            <textarea id="cta_subheadline" name="cta_subheadline" class="form-control" rows="2"
                                placeholder="Start your application...">{{ old('cta_subheadline', $counterData['cta_subheadline'] ?? '') }}</textarea>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="cta_primary_text">Primary Button Text</label>
                                <input type="text" id="cta_primary_text" name="cta_primary_text" class="form-control"
                                    value="{{ old('cta_primary_text', $counterData['cta_primary_text'] ?? '') }}"
                                    placeholder="Apply Now">
                            </div>
                            <div>
                                <label for="cta_secondary_text">Secondary Button Text</label>
                                <input type="text" id="cta_secondary_text" name="cta_secondary_text"
                                    class="form-control"
                                    value="{{ old('cta_secondary_text', $counterData['cta_secondary_text'] ?? '') }}"
                                    placeholder="Calculate Loan">
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
                                value="{{ old('title', $counterData['title'] ?? '') }}" placeholder="Enter section title"
                                required>
                            <p class="text-sm text-gray-500 mt-1">Internal reference name</p>
                        </div>
                        <div>
                            <label for="order">Display Order</label>
                            <input type="number" id="order" name="order" class="form-control"
                                value="{{ old('order', $counterData['order'] ?? 0) }}" min="0" max="100"
                                step="1">
                            <p class="text-sm text-gray-500 mt-1">Lower numbers display first</p>
                        </div>
                        <div>
                            <label for="status">Status</label>
                            <select id="status" name="status" class="form-control">
                                <option value="ACTIVE"
                                    {{ old('status', $counterData['status'] ?? '') == 'ACTIVE' ? 'selected' : '' }}>Active
                                </option>
                                <option value="INACTIVE"
                                    {{ old('status', $counterData['status'] ?? '') == 'INACTIVE' ? 'selected' : '' }}>
                                    Inactive</option>
                                <option value="DRAFT"
                                    {{ old('status', $counterData['status'] ?? '') == 'DRAFT' ? 'selected' : '' }}>Draft
                                </option>
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
        class CounterSectionManager {
            constructor() {
                this.elements = {
                    adminPanel: document.getElementById('adminPanel'),
                    toggleAdminBtn: document.getElementById('toggleAdmin'),
                    counterForm: document.getElementById('counterForm'),
                    cancelEditBtn: document.getElementById('cancelEdit')
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

                // Form submission
                this.elements.counterForm.addEventListener('submit', (e) => this.validateForm(e));
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

                // Update stats preview
                for (let i = 1; i <= 4; i++) {
                    const valueInput = document.getElementById(`main_stat_${i}_value`);
                    const labelInput = document.getElementById(`main_stat_${i}_label`);

                    if (valueInput) valueInput.addEventListener('input', () => this.updateMainStatsPreview());
                    if (labelInput) labelInput.addEventListener('input', () => this.updateMainStatsPreview());
                }

                for (let i = 1; i <= 3; i++) {
                    const valueInput = document.getElementById(`mini_stat_${i}_value`);
                    const labelInput = document.getElementById(`mini_stat_${i}_label`);

                    if (valueInput) valueInput.addEventListener('input', () => this.updateMiniStatsPreview());
                    if (labelInput) labelInput.addEventListener('input', () => this.updateMiniStatsPreview());
                }
            }

            updatePreview(field) {
                const input = document.getElementById(field.input);
                const preview = document.getElementById(field.preview);

                if (input && preview) {
                    preview.textContent = input.value;
                }
            }

            updateMainStatsPreview() {
                // This would update the main stats grid in real-time
                console.log('Updating main stats preview...');
            }

            updateMiniStatsPreview() {
                // This would update the mini stats grid in real-time
                console.log('Updating mini stats preview...');
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

            validateForm(e) {
                let isValid = true;

                // Clear previous errors
                this.clearErrors();

                // Validate required fields
                const requiredFields = [
                    'headline', 'title'
                ];

                requiredFields.forEach(fieldId => {
                    const field = document.getElementById(fieldId);
                    if (!field.value.trim()) {
                        this.showError(fieldId, 'This field is required.');
                        isValid = false;
                    }
                });

                // Validate main stats
                for (let i = 1; i <= 4; i++) {
                    const valueInput = document.getElementById(`main_stat_${i}_value`);
                    const labelInput = document.getElementById(`main_stat_${i}_label`);

                    if (valueInput && valueInput.value.trim() && !labelInput.value.trim()) {
                        this.showError(`main_stat_${i}_label`, 'Label is required when value is provided.');
                        isValid = false;
                    }
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

        // Initialize the counter section manager
        document.addEventListener('DOMContentLoaded', () => {
            new CounterSectionManager();
        });
    </script>
@endpush
