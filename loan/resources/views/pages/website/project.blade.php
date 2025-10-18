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

        .projects-preview-container {
            background: var(--white);
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 2rem;
            box-shadow: var(--shadow);
            border: 1px solid #e5e7eb;
        }

        .projects-section {
            color: #333;
            padding: clamp(2rem, 4vw, 3rem) 0;
            position: relative;
            overflow: hidden;
            isolation: isolate;
            background: linear-gradient(135deg, #f8f5f0 0%, #ffffff 100%);
        }

        .projects-background-shapes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            pointer-events: none;
        }

        .background-shape {
            position: absolute;
            opacity: 0.1;
            animation: float 3s ease-in-out infinite;
        }

        .shape-1 {
            top: 10%;
            left: 5%;
            width: 150px;
            height: 150px;
            background-color: var(--secondary-color);
            border-radius: 50%;
            animation-duration: 3s;
        }

        .shape-2 {
            top: 15%;
            right: 5%;
            width: 80px;
            height: 80px;
            background-color: var(--primary-color);
            border-radius: 50%;
            animation-duration: 3.5s;
        }

        .shape-3 {
            top: 20%;
            left: 10%;
            width: 70px;
            height: 70px;
            background-color: var(--secondary-color);
            border-radius: 50%;
            animation-duration: 4s;
        }

        .shape-4 {
            bottom: 10%;
            right: 15%;
            width: 90px;
            height: 90px;
            background-color: var(--primary-color);
            border-radius: 50%;
            animation-duration: 3.8s;
        }

        .shape-5 {
            bottom: 15%;
            left: 10%;
            width: 85px;
            height: 85px;
            background-color: var(--secondary-color);
            border-radius: 50%;
            animation-duration: 4.2s;
        }

        .projects-content {
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
            color: var(--secondary-color);
        }

        .section-subheading {
            font-size: clamp(0.9rem, 2vw, 1rem);
            color: #666;
            line-height: 1.6;
            max-width: 600px;
            margin: 0 auto;
        }

        .projects-tabs {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 2rem;
            background-color: var(--white);
            border-radius: 8px;
            padding: 0.5rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .tab-btn {
            padding: 0.75rem 1.5rem;
            background-color: transparent;
            color: var(--secondary-color);
            border: 2px solid var(--secondary-color);
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            transition: var(--transition);
        }

        .tab-btn.active,
        .tab-btn:hover {
            background-color: var(--primary-color);
            color: var(--white);
            border-color: var(--primary-color);
        }

        .projects-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 3rem;
        }

        .project-card {
            background: var(--white);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: var(--transition);
            animation: fadeInUp 0.6s ease-in both;
        }

        .project-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .project-image {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-weight: bold;
            position: relative;
            overflow: hidden;
        }

        .project-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .project-content {
            padding: 1.5rem;
        }

        .project-title {
            font-size: 1.25rem;
            font-weight: bold;
            color: var(--secondary-color);
            margin-bottom: 0.5rem;
        }

        .project-loan {
            font-size: 1rem;
            color: #666;
            margin-bottom: 0.5rem;
        }

        .project-result {
            font-size: 0.9rem;
            color: #888;
            margin-bottom: 1rem;
        }

        .project-categories {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .category-tag {
            padding: 0.25rem 0.5rem;
            background-color: #f8f5f0;
            color: var(--secondary-color);
            border-radius: 4px;
            font-size: 0.75rem;
        }

        .cta-section {
            text-align: center;
            animation: fadeIn 0.6s ease-in 0.4s both;
            padding: 2rem;
            background: var(--white);
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .cta-heading {
            font-size: 1.75rem;
            font-weight: bold;
            color: var(--secondary-color);
            margin-bottom: 0.5rem;
        }

        .cta-subheading {
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
            transform: translateY(-2px);
        }

        .cta-button--secondary {
            background-color: transparent;
            color: var(--secondary-color);
            border-color: var(--secondary-color);
        }

        .cta-button--secondary:hover {
            background-color: var(--secondary-color);
            color: var(--white);
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

        .category-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .category-item {
            padding: 1rem;
            background: #f8f9fa;
            border-radius: 8px;
            border: 1px solid #e9ecef;
        }

        .project-tabs {
            border-bottom: 1px solid #e5e7eb;
            margin-bottom: 1.5rem;
        }

        .project-tab-buttons {
            display: flex;
            overflow-x: auto;
            gap: 0;
        }

        .project-tab-btn {
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

        .project-tab-btn.active {
            color: var(--primary-color);
            border-bottom-color: var(--primary-color);
        }

        .project-tab-content {
            display: none;
        }

        .project-tab-content.active {
            display: block;
            animation: fadeIn 0.3s ease-in;
        }

        .checkbox-group {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-top: 0.5rem;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .checkbox-item input[type="checkbox"] {
            width: 18px;
            height: 18px;
            border-radius: 4px;
            border: 2px solid #d1d5db;
        }

        .checkbox-item label {
            margin-bottom: 0;
            font-weight: 500;
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
            .projects-tabs {
                flex-wrap: wrap;
            }

            .tab-btn {
                flex: 1;
                min-width: 120px;
                text-align: center;
            }

            .projects-grid {
                grid-template-columns: 1fr;
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

            .project-tab-buttons {
                flex-wrap: wrap;
            }

            .project-tab-btn {
                flex: 1;
                min-width: 100px;
                text-align: center;
            }
        }

        @media (max-width: 480px) {
            .projects-content {
                padding: 0 1rem;
            }

            .category-grid {
                grid-template-columns: 1fr;
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
                    <h1 class="text-2xl font-bold text-gray-900">Projects Section Management</h1>
                    <p class="text-gray-600 text-sm mt-1">Manage and customize the success stories and projects section for
                        your website.</p>
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

    <!-- Projects Preview -->
    <div class="projects-preview-container">
        <section class="projects-section" aria-label="Projects Section Preview">
            <div class="projects-background-shapes">
                <div class="background-shape shape-1"></div>
                <div class="background-shape shape-2"></div>
                <div class="background-shape shape-3"></div>
                <div class="background-shape shape-4"></div>
                <div class="background-shape shape-5"></div>
            </div>

            <div class="projects-content">
                <div class="section-header">
                    <h2 class="section-heading" id="previewHeading">
                        {{ $projectsData['headline'] ?? 'Success Stories: Marketeers We\'ve Empowered' }}
                    </h2>
                    <p class="section-subheading" id="previewSubheading">
                        {{ $projectsData['subheadline'] ?? 'Discover how our loan solutions have helped marketing professionals and businesses achieve remarkable growth and success in their campaigns and operations.' }}
                    </p>
                </div>

                <div class="projects-tabs" id="previewTabs">
                    <button class="tab-btn active" data-filter="all">All Success Stories</button>
                    @foreach ($projectsData['categories'] ?? [] as $category)
                        <button class="tab-btn" data-filter="{{ $category['slug'] ?? '' }}">
                            {{ $category['name'] ?? 'Category' }}
                        </button>
                    @endforeach
                </div>

                <div class="projects-grid" id="previewProjectsGrid">
                    @foreach ($projectsData['projects'] ?? [] as $project)
                        <div class="project-card" data-categories="{{ implode(',', $project['categories'] ?? []) }}">
                            <div class="project-image">
                                @if (isset($project['image']) && $project['image'])
                                    <img src="{{ Storage::url($project['image']) }}"
                                        alt="{{ $project['alt'] ?? $project['title'] }}">
                                @else
                                    <span>{{ $project['title'] ?? 'Project' }}</span>
                                @endif
                            </div>
                            <div class="project-content">
                                <h3 class="project-title">{{ $project['title'] ?? 'Project Title' }}</h3>
                                <p class="project-loan">{{ $project['loan'] ?? '' }}</p>
                                <p class="project-result">{{ $project['result'] ?? '' }}</p>
                                <div class="project-categories">
                                    @foreach ($project['categories'] ?? [] as $categorySlug)
                                        @php
                                            $category = collect($projectsData['categories'] ?? [])->firstWhere(
                                                'slug',
                                                $categorySlug,
                                            );
                                        @endphp
                                        <span class="category-tag">{{ $category['name'] ?? $categorySlug }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="cta-section">
                    <h3 class="cta-heading" id="previewCtaHeading">
                        {{ $projectsData['cta_headline'] ?? 'Ready to create your success story?' }}
                    </h3>
                    <p class="cta-subheading" id="previewCtaSubheading">
                        {{ $projectsData['cta_subheadline'] ?? 'Join hundreds of marketeers who have transformed their businesses with our loans' }}
                    </p>
                    <div class="cta-buttons">
                        <a href="#!" class="cta-button" id="previewCtaPrimary">
                            {{ $projectsData['cta_primary_text'] ?? 'Apply for Funding' }}
                        </a>
                        <a href="#!" class="cta-button cta-button--secondary" id="previewCtaSecondary">
                            {{ $projectsData['cta_secondary_text'] ?? 'View All Case Studies' }}
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
            Manage Projects Content
        </h3>

        <form id="projectsForm" action="{{ route('management.project-section') }}" method="POST" novalidate
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

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
                                value="{{ old('headline', $projectsData['headline'] ?? '') }}"
                                placeholder="Success Stories: Marketeers We've Empowered" required>
                            <span class="error-message" id="headlineError"></span>
                        </div>
                        <div>
                            <label for="subheadline">Subheadline</label>
                            <textarea id="subheadline" name="subheadline" class="form-control" rows="3"
                                placeholder="Discover how our loan solutions have helped...">{{ old('subheadline', $projectsData['subheadline'] ?? '') }}</textarea>
                            <span class="error-message" id="subheadlineError"></span>
                        </div>
                    </div>
                </div>

                <!-- Categories Section -->
                <div class="form-group">
                    <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                        <i class="fas fa-tags text-green-600"></i>
                        Project Categories
                    </h4>
                    <div class="category-grid" id="categoriesContainer">
                        @for ($i = 1; $i <= 4; $i++)
                            <div class="category-item">
                                <label for="category_{{ $i }}_name">Category {{ $i }} Name</label>
                                <input type="text" id="category_{{ $i }}_name"
                                    name="categories[{{ $i }}][name]" class="form-control"
                                    value="{{ old("categories.$i.name", $projectsData['categories'][$i]['name'] ?? '') }}"
                                    placeholder="e.g., Marketing Campaigns">

                                <label for="category_{{ $i }}_slug" class="mt-2">Category Slug</label>
                                <input type="text" id="category_{{ $i }}_slug"
                                    name="categories[{{ $i }}][slug]" class="form-control"
                                    value="{{ old("categories.$i.slug", $projectsData['categories'][$i]['slug'] ?? '') }}"
                                    placeholder="e.g., campaign">
                                <p class="text-sm text-gray-500 mt-1">Used for filtering (lowercase, no spaces)</p>
                            </div>
                        @endfor
                    </div>
                </div>

                <!-- Projects Management -->
                <div class="form-group">
                    <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                        <i class="fas fa-briefcase text-purple-600"></i>
                        Projects & Success Stories
                    </h4>

                    <!-- Project Tabs -->
                    <div class="project-tabs">
                        <div class="project-tab-buttons">
                            {{-- @for ($i = 1; $i <= 4; $i++)
                                <button type="button" class="project-tab-btn {{ $loop->first ? 'active' : '' }}"
                                    data-tab="project-{{ $i }}">
                                    Project {{ $i }}
                                </button>
                            @endfor --}}
                        </div>
                    </div>

                    <!-- Project Content -->
                    <div class="project-tab-contents">
                        {{-- @for ($i = 1; $i <= 4; $i++)
                            <div id="project-{{ $i }}"
                                class="project-tab-content {{ $loop->first ? 'active' : '' }}">
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                    <!-- Project Details -->
                                    <div class="space-y-4">
                                        <div>
                                            <label for="project_{{ $i }}_title">Project Title *</label>
                                            <input type="text" id="project_{{ $i }}_title"
                                                name="projects[{{ $i }}][title]" class="form-control"
                                                value="{{ old("projects.$i.title", $projectsData['projects'][$i]['title'] ?? '') }}"
                                                placeholder="e.g., Social Media Blitz" required>
                                            <span class="error-message" id="project{{ $i }}TitleError"></span>
                                        </div>

                                        <div>
                                            <label for="project_{{ $i }}_loan">Loan Details</label>
                                            <input type="text" id="project_{{ $i }}_loan"
                                                name="projects[{{ $i }}][loan]" class="form-control"
                                                value="{{ old("projects.$i.loan", $projectsData['projects'][$i]['loan'] ?? '') }}"
                                                placeholder="e.g., $25K Campaign Loan">
                                        </div>

                                        <div>
                                            <label for="project_{{ $i }}_result">Achievement/Result</label>
                                            <input type="text" id="project_{{ $i }}_result"
                                                name="projects[{{ $i }}][result]" class="form-control"
                                                value="{{ old("projects.$i.result", $projectsData['projects'][$i]['result'] ?? '') }}"
                                                placeholder="e.g., 300% ROI achieved">
                                        </div>

                                        <div>
                                            <label>Categories</label>
                                            <div class="checkbox-group">
                                                @for ($cat = 1; $cat <= 4; $cat++)
                                                    <div class="checkbox-item">
                                                        <input type="checkbox"
                                                            id="project_{{ $i }}_category_{{ $cat }}"
                                                            name="projects[{{ $i }}][categories][]"
                                                            value="{{ $projectsData['categories'][$cat]['slug'] ?? 'category' . $cat }}"
                                                            {{ in_array($projectsData['categories'][$cat]['slug'] ?? 'category' . $cat, old('projects.' . $i . '.categories', $projectsData['projects'][$i]['categories'] ?? [])) ? 'checked' : '' }}>
                                                        <label
                                                            for="project_{{ $i }}_category_{{ $cat }}"
                                                            id="project-{{ $i }}-category-{{ $cat }}-label">
                                                            {{ $projectsData['categories'][$cat]['name'] ?? 'Category ' . $cat }}
                                                        </label>
                                                    </div>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Project Media -->
                                    <div class="space-y-4">
                                        <div>
                                            <label for="project_{{ $i }}_image">Project Image</label>
                                            <input type="file" id="project_{{ $i }}_image"
                                                name="projects[{{ $i }}][image]" class="form-control"
                                                accept="image/jpeg,image/png,image/webp">
                                            @if (isset($projectsData['projects'][$i]['image']) && $projectsData['projects'][$i]['image'])
                                                <div class="image-preview">
                                                    <img src="{{ Storage::url($projectsData['projects'][$i]['image']) }}"
                                                        alt="Current project image">
                                                    <p class="text-sm text-gray-600 mt-2 text-center">Current image</p>
                                                </div>
                                            @endif
                                        </div>

                                        <div>
                                            <label for="project_{{ $i }}_alt">Image Alt Text</label>
                                            <input type="text" id="project_{{ $i }}_alt"
                                                name="projects[{{ $i }}][alt]" class="form-control"
                                                value="{{ old("projects.$i.alt", $projectsData['projects'][$i]['alt'] ?? '') }}"
                                                placeholder="e.g., Social Media Campaign Success">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor --}}
                    </div>
                </div>

                <!-- CTA Section -->
                <div class="form-group">
                    <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                        <i class="fas fa-bullhorn text-orange-600"></i>
                        Call to Action Section
                    </h4>
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label for="cta_headline">CTA Headline</label>
                            <input type="text" id="cta_headline" name="cta_headline" class="form-control"
                                value="{{ old('cta_headline', $projectsData['cta_headline'] ?? '') }}"
                                placeholder="Ready to create your success story?">
                        </div>
                        <div>
                            <label for="cta_subheadline">CTA Subheadline</label>
                            <textarea id="cta_subheadline" name="cta_subheadline" class="form-control" rows="2"
                                placeholder="Join hundreds of marketeers...">{{ old('cta_subheadline', $projectsData['cta_subheadline'] ?? '') }}</textarea>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="cta_primary_text">Primary Button Text</label>
                                <input type="text" id="cta_primary_text" name="cta_primary_text" class="form-control"
                                    value="{{ old('cta_primary_text', $projectsData['cta_primary_text'] ?? '') }}"
                                    placeholder="Apply for Funding">
                            </div>
                            <div>
                                <label for="cta_secondary_text">Secondary Button Text</label>
                                <input type="text" id="cta_secondary_text" name="cta_secondary_text"
                                    class="form-control"
                                    value="{{ old('cta_secondary_text', $projectsData['cta_secondary_text'] ?? '') }}"
                                    placeholder="View All Case Studies">
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
                                value="{{ old('title', $projectsData['title'] ?? '') }}"
                                placeholder="Enter section title" required>
                            <p class="text-sm text-gray-500 mt-1">Internal reference name</p>
                        </div>
                        <div>
                            <label for="order">Display Order</label>
                            <input type="number" id="order" name="order" class="form-control"
                                value="{{ old('order', $projectsData['order'] ?? 0) }}" min="0" max="100"
                                step="1">
                            <p class="text-sm text-gray-500 mt-1">Lower numbers display first</p>
                        </div>
                        <div>
                            <label for="status">Status</label>
                            <select id="status" name="status" class="form-control">
                                <option value="ACTIVE"
                                    {{ old('status', $projectsData['status'] ?? '') == 'ACTIVE' ? 'selected' : '' }}>Active
                                </option>
                                <option value="INACTIVE"
                                    {{ old('status', $projectsData['status'] ?? '') == 'INACTIVE' ? 'selected' : '' }}>
                                    Inactive</option>
                                <option value="DRAFT"
                                    {{ old('status', $projectsData['status'] ?? '') == 'DRAFT' ? 'selected' : '' }}>Draft
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
        class ProjectsSectionManager {
            constructor() {
                this.elements = {
                    adminPanel: document.getElementById('adminPanel'),
                    toggleAdminBtn: document.getElementById('toggleAdmin'),
                    projectsForm: document.getElementById('projectsForm'),
                    cancelEditBtn: document.getElementById('cancelEdit'),
                    projectTabButtons: document.querySelectorAll('.project-tab-btn'),
                    projectTabContents: document.querySelectorAll('.project-tab-content')
                };

                this.init();
            }

            init() {
                this.setupEventListeners();
                this.setupRealTimePreview();
                this.setupProjectTabs();
            }

            setupEventListeners() {
                // Toggle admin panel
                this.elements.toggleAdminBtn.addEventListener('click', () => this.toggleAdminPanel());

                // Cancel edit
                this.elements.cancelEditBtn.addEventListener('click', () => this.hideAdminPanel());

                // Form submission
                this.elements.projectsForm.addEventListener('submit', (e) => this.validateForm(e));

                // Preview tab functionality
                this.setupPreviewTabs();
            }

            setupProjectTabs() {
                this.elements.projectTabButtons.forEach(button => {
                    button.addEventListener('click', () => {
                        const targetTab = button.getAttribute('data-tab');

                        // Update active tab button
                        this.elements.projectTabButtons.forEach(btn => {
                            btn.classList.remove('active');
                        });
                        button.classList.add('active');

                        // Show target tab content
                        this.elements.projectTabContents.forEach(content => {
                            content.classList.remove('active');
                        });
                        document.getElementById(targetTab).classList.add('active');
                    });
                });
            }

            setupPreviewTabs() {
                const previewTabs = document.querySelectorAll('#previewTabs .tab-btn');
                const previewProjects = document.querySelectorAll('#previewProjectsGrid .project-card');

                previewTabs.forEach(tab => {
                    tab.addEventListener('click', () => {
                        const filter = tab.getAttribute('data-filter');

                        // Update active tab
                        previewTabs.forEach(t => t.classList.remove('active'));
                        tab.classList.add('active');

                        // Filter projects
                        previewProjects.forEach(project => {
                            if (filter === 'all') {
                                project.style.display = 'block';
                            } else {
                                const categories = project.getAttribute('data-categories')
                                    .split(',');
                                if (categories.includes(filter)) {
                                    project.style.display = 'block';
                                } else {
                                    project.style.display = 'none';
                                }
                            }
                        });
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

                // Update category labels in real-time
                for (let i = 1; i <= 4; i++) {
                    const categoryNameInput = document.getElementById(`category_${i}_name`);
                    if (categoryNameInput) {
                        categoryNameInput.addEventListener('input', () => {
                            this.updateCategoryLabels(i);
                        });
                    }
                }
            }

            updatePreview(field) {
                const input = document.getElementById(field.input);
                const preview = document.getElementById(field.preview);

                if (input && preview) {
                    preview.textContent = input.value;
                }
            }

            updateCategoryLabels(categoryIndex) {
                const categoryNameInput = document.getElementById(`category_${categoryIndex}_name`);
                const newName = categoryNameInput.value || `Category ${categoryIndex}`;

                // Update preview tabs
                const previewTab = document.querySelector(`#previewTabs .tab-btn[data-filter="${categoryIndex}"]`);
                if (previewTab) {
                    previewTab.textContent = newName;
                }

                // Update category labels in project forms
                for (let projectIndex = 1; projectIndex <= 4; projectIndex++) {
                    const categoryLabel = document.getElementById(
                        `project-${projectIndex}-category-${categoryIndex}-label`);
                    if (categoryLabel) {
                        categoryLabel.textContent = newName;
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

                // Validate project titles
                for (let i = 1; i <= 4; i++) {
                    const projectTitle = document.getElementById(`project_${i}_title`);
                    if (projectTitle && projectTitle.value.trim()) {
                        // If any project field is filled, validate required fields for that project
                        if (!projectTitle.value.trim()) {
                            this.showError(`project${i}Title`, 'Project title is required when adding a project.');
                            isValid = false;
                        }
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

        // Initialize the projects section manager
        document.addEventListener('DOMContentLoaded', () => {
            new ProjectsSectionManager();
        });
    </script>
@endpush
