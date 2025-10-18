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

        .blog-preview-container {
            background: linear-gradient(135deg, #f8f5f0 0%, #ffffff 100%);
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 2rem;
            box-shadow: var(--shadow);
            border: 1px solid #e5e7eb;
        }

        .blog-section {
            color: #333;
            padding: clamp(2rem, 4vw, 3rem) 0;
            position: relative;
            overflow: hidden;
            isolation: isolate;
        }

        .blog-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 clamp(1rem, 3vw, 2rem);
            position: relative;
            z-index: 1;
        }

        .blog-heading {
            text-align: center;
            margin-bottom: 3rem;
            animation: fadeIn 0.6s ease-in;
        }

        .blog-heading h2 {
            font-size: clamp(1.75rem, 4vw, 2.25rem);
            font-weight: 700;
            color: var(--secondary-color);
            line-height: 1.3;
            margin-bottom: 0.75rem;
        }

        .blog-heading p {
            font-size: 1rem;
            color: #666;
            line-height: 1.6;
            max-width: 600px;
            margin: 0 auto;
        }

        .blog-posts {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 3rem;
        }

        .blog-post {
            background-color: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: var(--transition);
            position: relative;
        }

        .blog-post:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .post-image {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 1.25rem;
            position: relative;
            overflow: hidden;
        }

        .post-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .post-category {
            position: absolute;
            top: 1rem;
            left: 1rem;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            font-size: 0.85rem;
            font-weight: bold;
        }

        .post-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(122, 70, 3, 0.9) 0%, rgba(219, 145, 35, 0.9) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: var(--transition);
        }

        .blog-post:hover .post-overlay {
            opacity: 1;
        }

        .post-content {
            padding: 1.5rem;
        }

        .post-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.75rem;
        }

        .author-info,
        .date-info {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .author-avatar {
            background-color: var(--secondary-color);
            padding: 0.5rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 0.75rem;
            min-width: 32px;
            height: 32px;
        }

        .date-icon {
            background-color: var(--primary-color);
            padding: 0.5rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 0.75rem;
            min-width: 32px;
            height: 32px;
        }

        .post-title {
            font-size: 1.25rem;
            font-weight: bold;
            color: var(--secondary-color);
            margin-bottom: 0.5rem;
            line-height: 1.4;
        }

        .post-title a {
            text-decoration: none;
            color: inherit;
            transition: var(--transition);
        }

        .post-title a:hover {
            color: var(--primary-color);
        }

        .post-excerpt {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 0.75rem;
            line-height: 1.5;
        }

        .post-footer {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }

        .read-time,
        .post-category-tag {
            font-size: 0.85rem;
        }

        .read-time {
            color: var(--primary-color);
        }

        .post-category-tag {
            color: var(--primary-color);
        }

        .blog-cta {
            text-align: center;
            animation: fadeInUp 0.6s ease-in 0.4s both;
        }

        .blog-cta h3 {
            font-size: 1.75rem;
            font-weight: bold;
            color: var(--secondary-color);
            margin-bottom: 0.5rem;
        }

        .blog-cta p {
            font-size: 1rem;
            color: #666;
            margin-bottom: 1.5rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.6;
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

        .blog-tabs {
            border-bottom: 1px solid #e5e7eb;
            margin-bottom: 1.5rem;
        }

        .tab-buttons {
            display: flex;
            gap: 0;
            overflow-x: auto;
        }

        .tab-button {
            padding: 1rem 1.5rem;
            border: none;
            background: none;
            border-bottom: 2px solid transparent;
            font-weight: 600;
            color: #6b7280;
            cursor: pointer;
            transition: var(--transition);
            white-space: nowrap;
        }

        .tab-button.active {
            color: var(--primary-color);
            border-bottom-color: var(--primary-color);
        }

        .tab-button:hover:not(.active) {
            color: #374151;
            background-color: #f9fafb;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
            animation: fadeIn 0.3s ease-in;
        }

        .image-preview {
            margin-top: 0.5rem;
            padding: 1rem;
            background: #f8f9fa;
            border-radius: 8px;
            border: 2px dashed #dee2e6;
            text-align: center;
        }

        .image-preview img {
            max-height: 120px;
            width: auto;
            border-radius: 6px;
            margin-bottom: 0.5rem;
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
            .blog-posts {
                grid-template-columns: 1fr;
            }

            .post-meta {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }

            .cta-buttons {
                flex-direction: column;
                align-items: center;
            }

            .tab-buttons {
                flex-direction: column;
            }

            .tab-button {
                text-align: left;
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
            .blog-content {
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

        .grid-cols-2 {
            grid-template-columns: repeat(2, 1fr);
        }

        @media (max-width: 1024px) {
            .grid-cols-2 {
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
                    <h1 class="text-2xl font-bold text-gray-900">Blog Section Management</h1>
                    <p class="text-gray-600 text-sm mt-1">Manage and customize the financial insights and blog section for
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

    <!-- Blog Preview -->
    <div class="blog-preview-container">
        <section class="blog-section" aria-label="Blog Section Preview">
            <div class="blog-content">
                <div class="blog-heading" id="blogHeading">
                    <h2 id="previewMainHeading">{{ $blogData['headline'] ?? 'Financial Insights for Marketeers' }}</h2>
                    <p id="previewSubheading">
                        {{ $blogData['subheadline'] ?? 'Expert advice and insights to help marketing professionals make smart financial decisions and grow their businesses effectively.' }}
                    </p>
                </div>

                <div class="blog-posts" id="previewBlogPosts">
                    @foreach ($blogData['posts'] ?? [] as $post)
                        <article class="blog-post" style="animation-delay: {{ $post['animation_delay'] ?? '0.1' }}s">
                            <div class="post-image">
                                @if (isset($post['image']) && $post['image'])
                                    <img src="{{ Storage::url($post['image']) }}"
                                        alt="{{ $post['alt'] ?? $post['title'] }}">
                                @else
                                    {{ $post['title'] }}
                                @endif
                                <span class="post-category"
                                    style="background-color: {{ $post['category_color'] ?? '#db9123' }}">
                                    {{ $post['category'] ?? 'Funding Guide' }}
                                </span>
                                <div class="post-overlay">
                                    <a href="{{ $post['url'] ?? '#!' }}" class="cta-button">Read More</a>
                                </div>
                            </div>
                            <div class="post-content">
                                <div class="post-meta">
                                    <div class="author-info">
                                        <div class="author-avatar">{{ substr($post['author'] ?? 'Sarah Johnson', 0, 1) }}
                                        </div>
                                        <p class="text-sm text-gray-600">{{ $post['author'] ?? 'Sarah Johnson' }}</p>
                                    </div>
                                    <div class="date-info">
                                        <div class="date-icon">📅</div>
                                        <p class="text-sm text-gray-600">
                                            {{ \Carbon\Carbon::parse($post['date'] ?? now())->format('d M, Y') }}</p>
                                    </div>
                                </div>
                                <h3 class="post-title">
                                    <a href="{{ $post['url'] ?? '#!' }}">{{ $post['title'] }}</a>
                                </h3>
                                <p class="post-excerpt">{{ $post['excerpt'] ?? '' }}</p>
                                <div class="post-footer">
                                    <span class="read-time">{{ $post['read_time'] ?? '5 min read' }}</span>
                                    <span class="text-gray-400">•</span>
                                    <span class="post-category-tag">{{ $post['category'] ?? 'Funding Guide' }}</span>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="blog-cta" id="previewCta">
                    <h3 id="previewCtaHeadline">{{ $blogData['cta']['headline'] ?? 'Want more financial insights?' }}</h3>
                    <p id="previewCtaSubheadline">
                        {{ $blogData['cta']['subheadline'] ?? 'Explore our complete library of resources for marketing professionals' }}
                    </p>
                    <div class="cta-buttons">
                        <a href="#!" class="cta-button"
                            id="previewCtaPrimary">{{ $blogData['cta']['primary_text'] ?? 'View All Articles' }}</a>
                        <a href="#!" class="cta-button-secondary"
                            id="previewCtaSecondary">{{ $blogData['cta']['secondary_text'] ?? 'Subscribe to Updates' }}</a>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Admin Panel -->
    <div class="admin-panel" id="adminPanel" role="dialog" aria-labelledby="adminPanelTitle" aria-modal="true">
        <h3 id="adminPanelTitle">
            <i class="fas fa-edit"></i>
            Manage Blog Section
        </h3>

        <form id="blogForm" action="{{ route('management.blog-section') }}" method="POST" novalidate
            enctype="multipart/form-data">
            @csrf

            <!-- Main Content Section -->
            <div class="form-group">
                <label for="headline">Main Headline *</label>
                <input type="text" id="headline" name="headline" class="form-control"
                    value="{{ old('headline', $section->headline ?? '') }}" placeholder="Financial Insights for Marketeers"
                    required maxlength="100">
                <span class="error-message" id="headlineError"></span>
            </div>

            <div class="form-group">
                <label for="subheadline">Subheadline</label>
                <textarea id="subheadline" name="subheadline" class="form-control" rows="4"
                    placeholder="Expert advice and insights to help marketing professionals make smart financial decisions and grow their businesses effectively."
                    maxlength="500">{{ old('subheadline', $section->subheadline ?? '') }}</textarea>
                <span class="error-message" id="subheadlineError"></span>
            </div>

            <!-- Blog Posts Tabs -->
            <div class="blog-tabs">
                <div class="tab-buttons">
                    @foreach ([1, 2, 3] as $index)
                        <button type="button" class="tab-button {{ $loop->first ? 'active' : '' }}"
                            data-tab="blog-{{ $index }}">
                            Blog Post {{ $index }}
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Blog Posts Content -->
            <div class="tab-contents">
                @foreach ([1, 2, 3] as $index)
                    <div id="blog-{{ $index }}" class="tab-content {{ $loop->first ? 'active' : '' }}">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <!-- Blog Post Details -->
                            <div class="space-y-4">
                                <h4 class="font-semibold text-gray-900">Blog Post {{ $index }} Details</h4>

                                <div class="form-group">
                                    <label for="blog_{{ $index }}_title">Post Title *</label>
                                    <input type="text" id="blog_{{ $index }}_title"
                                        name="blog_{{ $index }}_title" class="form-control"
                                        value="{{ old("blog_{$index}_title", $section->{"blog_{$index}_title"} ?? '') }}"
                                        placeholder="e.g., How to Calculate the Right Loan Amount for Your Marketing Campaign"
                                        maxlength="200" required>
                                    <span class="error-message" id="blog{{ $index }}TitleError"></span>
                                </div>

                                <div class="form-group">
                                    <label for="blog_{{ $index }}_excerpt">Post Excerpt *</label>
                                    <textarea id="blog_{{ $index }}_excerpt" name="blog_{{ $index }}_excerpt" class="form-control"
                                        rows="4" placeholder="Brief description of the blog post content" maxlength="300" required>{{ old("blog_{$index}_excerpt", $section->{"blog_{$index}_excerpt"} ?? '') }}</textarea>
                                    <span class="error-message" id="blog{{ $index }}ExcerptError"></span>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="form-group">
                                        <label for="blog_{{ $index }}_author">Author Name</label>
                                        <input type="text" id="blog_{{ $index }}_author"
                                            name="blog_{{ $index }}_author" class="form-control"
                                            value="{{ old("blog_{$index}_author", $section->{"blog_{$index}_author"} ?? '') }}"
                                            placeholder="e.g., Sarah Johnson" maxlength="100">
                                    </div>

                                    <div class="form-group">
                                        <label for="blog_{{ $index }}_date">Publish Date</label>
                                        <input type="date" id="blog_{{ $index }}_date"
                                            name="blog_{{ $index }}_date" class="form-control"
                                            value="{{ old("blog_{$index}_date", $section->{"blog_{$index}_date"} ?? '') }}">
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="form-group">
                                        <label for="blog_{{ $index }}_read_time">Read Time</label>
                                        <input type="text" id="blog_{{ $index }}_read_time"
                                            name="blog_{{ $index }}_read_time" class="form-control"
                                            value="{{ old("blog_{$index}_read_time", $section->{"blog_{$index}_read_time"} ?? '') }}"
                                            placeholder="e.g., 5 min read" maxlength="20">
                                    </div>

                                    <div class="form-group">
                                        <label for="blog_{{ $index }}_category">Category</label>
                                        <input type="text" id="blog_{{ $index }}_category"
                                            name="blog_{{ $index }}_category" class="form-control"
                                            value="{{ old("blog_{$index}_category", $section->{"blog_{$index}_category"} ?? '') }}"
                                            placeholder="e.g., Funding Guide" maxlength="50">
                                    </div>
                                </div>
                            </div>

                            <!-- Blog Post Media & Settings -->
                            <div class="space-y-4">
                                <h4 class="font-semibold text-gray-900">Media & Settings</h4>

                                <!-- Featured Image -->
                                <div class="form-group">
                                    <label for="blog_{{ $index }}_image">Featured Image</label>
                                    <input type="file" id="blog_{{ $index }}_image"
                                        name="blog_{{ $index }}_image" class="form-control"
                                        accept="image/jpeg,image/png,image/webp">

                                    @if (isset($blogData['posts'][$index - 1]['image']) && $blogData['posts'][$index - 1]['image'])
                                        <div class="image-preview">
                                            <img src="{{ Storage::url($blogData['posts'][$index - 1]['image']) }}"
                                                alt="Current blog image">
                                            <p class="text-sm text-gray-600 mt-2">Current image</p>
                                        </div>
                                    @endif

                                    <p class="text-sm text-gray-500 mt-1">Recommended: 600×400px, JPEG, PNG, or WebP format
                                    </p>
                                </div>

                                <div class="form-group">
                                    <label for="blog_{{ $index }}_alt">Image Alt Text</label>
                                    <input type="text" id="blog_{{ $index }}_alt"
                                        name="blog_{{ $index }}_alt" class="form-control"
                                        value="{{ old("blog_{$index}_alt", $section->{"blog_{$index}_alt"} ?? '') }}"
                                        placeholder="e.g., Marketing campaign funding strategies" maxlength="200">
                                </div>

                                <div class="form-group">
                                    <label for="blog_{{ $index }}_category_color">Category Badge Color</label>
                                    <select id="blog_{{ $index }}_category_color"
                                        name="blog_{{ $index }}_category_color" class="form-control">
                                        <option value="#db9123"
                                            {{ old("blog_{$index}_category_color", $section->{"blog_{$index}_category_color"} ?? '') == '#db9123' ? 'selected' : '' }}>
                                            Orange (#db9123)
                                        </option>
                                        <option value="#7a4603"
                                            {{ old("blog_{$index}_category_color", $section->{"blog_{$index}_category_color"} ?? '') == '#7a4603' ? 'selected' : '' }}>
                                            Brown (#7a4603)
                                        </option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="blog_{{ $index }}_animation_delay">Animation Delay</label>
                                    <select id="blog_{{ $index }}_animation_delay"
                                        name="blog_{{ $index }}_animation_delay" class="form-control">
                                        <option value="0.1"
                                            {{ old("blog_{$index}_animation_delay", $section->{"blog_{$index}_animation_delay"} ?? '') == '0.1' ? 'selected' : '' }}>
                                            0.1s (First)
                                        </option>
                                        <option value="0.2"
                                            {{ old("blog_{$index}_animation_delay", $section->{"blog_{$index}_animation_delay"} ?? '') == '0.2' ? 'selected' : '' }}>
                                            0.2s (Second)
                                        </option>
                                        <option value="0.3"
                                            {{ old("blog_{$index}_animation_delay", $section->{"blog_{$index}_animation_delay"} ?? '') == '0.3' ? 'selected' : '' }}>
                                            0.3s (Third)
                                        </option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="blog_{{ $index }}_url">Post URL</label>
                                    <input type="url" id="blog_{{ $index }}_url"
                                        name="blog_{{ $index }}_url" class="form-control"
                                        value="{{ old("blog_{$index}_url", $section->{"blog_{$index}_url"} ?? '') }}"
                                        placeholder="https://example.com/blog-post">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- CTA Section -->
            <div class="form-group">
                <label for="cta_headline">CTA Headline</label>
                <input type="text" id="cta_headline" name="cta_headline" class="form-control"
                    value="{{ old('cta_headline', $section->cta_headline ?? '') }}"
                    placeholder="Want more financial insights?" maxlength="100">
            </div>

            <div class="form-group">
                <label for="cta_subheadline">CTA Subheadline</label>
                <textarea id="cta_subheadline" name="cta_subheadline" class="form-control" rows="3"
                    placeholder="Explore our complete library of resources for marketing professionals" maxlength="300">{{ old('cta_subheadline', $section->cta_subheadline ?? '') }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="form-group">
                    <label for="cta_primary_text">Primary Button Text</label>
                    <input type="text" id="cta_primary_text" name="cta_primary_text" class="form-control"
                        value="{{ old('cta_primary_text', $section->cta_primary_text ?? '') }}"
                        placeholder="View All Articles" maxlength="50">
                </div>

                <div class="form-group">
                    <label for="cta_secondary_text">Secondary Button Text</label>
                    <input type="text" id="cta_secondary_text" name="cta_secondary_text" class="form-control"
                        value="{{ old('cta_secondary_text', $section->cta_secondary_text ?? '') }}"
                        placeholder="Subscribe to Updates" maxlength="50">
                </div>
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
        class BlogSectionManager {
            constructor() {
                this.elements = {
                    adminPanel: document.getElementById('adminPanel'),
                    toggleAdminBtn: document.getElementById('toggleAdmin'),
                    blogForm: document.getElementById('blogForm'),
                    cancelEditBtn: document.getElementById('cancelEdit'),
                    tabButtons: document.querySelectorAll('.tab-button'),
                    tabContents: document.querySelectorAll('.tab-content')
                };

                this.init();
            }

            init() {
                this.setupEventListeners();
                this.setupRealTimePreview();
                this.setupTabNavigation();
            }

            setupEventListeners() {
                // Toggle admin panel
                this.elements.toggleAdminBtn.addEventListener('click', () => this.toggleAdminPanel());

                // Cancel edit
                this.elements.cancelEditBtn.addEventListener('click', () => this.hideAdminPanel());

                // Form submission
                this.elements.blogForm.addEventListener('submit', (e) => this.validateForm(e));
            }

            setupTabNavigation() {
                this.elements.tabButtons.forEach(button => {
                    button.addEventListener('click', () => {
                        const targetTab = button.getAttribute('data-tab');

                        // Update active tab button
                        this.elements.tabButtons.forEach(btn => btn.classList.remove('active'));
                        button.classList.add('active');

                        // Show target tab content
                        this.elements.tabContents.forEach(content => content.classList.remove(
                        'active'));
                        document.getElementById(targetTab).classList.add('active');
                    });
                });
            }

            setupRealTimePreview() {
                // Real-time preview updates
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
                    }
                });

                // Update blog posts preview on any change
                for (let i = 1; i <= 3; i++) {
                    const postInputs = document.querySelectorAll(
                        `#blog-${i} input, #blog-${i} textarea, #blog-${i} select`);
                    postInputs.forEach(input => {
                        input.addEventListener('input', () => this.updateBlogPostsPreview());
                        input.addEventListener('change', () => this.updateBlogPostsPreview());
                    });
                }
            }

            updatePreview(field) {
                const input = document.getElementById(field.input);
                const preview = document.getElementById(field.preview);

                if (input && preview) {
                    preview.textContent = input.value;
                }
            }

            updateBlogPostsPreview() {
                const previewContainer = document.getElementById('previewBlogPosts');
                let html = '';

                for (let i = 1; i <= 3; i++) {
                    const titleInput = document.getElementById(`blog_${i}_title`);
                    const excerptInput = document.getElementById(`blog_${i}_excerpt`);
                    const authorInput = document.getElementById(`blog_${i}_author`);
                    const dateInput = document.getElementById(`blog_${i}_date`);
                    const readTimeInput = document.getElementById(`blog_${i}_read_time`);
                    const categoryInput = document.getElementById(`blog_${i}_category`);
                    const categoryColorInput = document.getElementById(`blog_${i}_category_color`);
                    const urlInput = document.getElementById(`blog_${i}_url`);
                    const animationDelayInput = document.getElementById(`blog_${i}_animation_delay`);

                    if (titleInput && titleInput.value) {
                        const title = titleInput.value;
                        const excerpt = excerptInput ? excerptInput.value : '';
                        const author = authorInput ? authorInput.value : 'Sarah Johnson';
                        const date = dateInput && dateInput.value ? this.formatDate(dateInput.value) : '15 Jan, 2024';
                        const readTime = readTimeInput ? readTimeInput.value : '5 min read';
                        const category = categoryInput ? categoryInput.value : 'Funding Guide';
                        const categoryColor = categoryColorInput ? categoryColorInput.value : '#db9123';
                        const url = urlInput && urlInput.value ? urlInput.value : '#!';
                        const animationDelay = animationDelayInput ? animationDelayInput.value : '0.1';

                        html += `
                            <article class="blog-post" style="animation-delay: ${animationDelay}s">
                                <div class="post-image">
                                    ${title}
                                    <span class="post-category" style="background-color: ${categoryColor}">
                                        ${category}
                                    </span>
                                    <div class="post-overlay">
                                        <a href="${url}" class="cta-button">Read More</a>
                                    </div>
                                </div>
                                <div class="post-content">
                                    <div class="post-meta">
                                        <div class="author-info">
                                            <div class="author-avatar">${author.charAt(0)}</div>
                                            <p class="text-sm text-gray-600">${author}</p>
                                        </div>
                                        <div class="date-info">
                                            <div class="date-icon">📅</div>
                                            <p class="text-sm text-gray-600">${date}</p>
                                        </div>
                                    </div>
                                    <h3 class="post-title">
                                        <a href="${url}">${title}</a>
                                    </h3>
                                    <p class="post-excerpt">${excerpt}</p>
                                    <div class="post-footer">
                                        <span class="read-time">${readTime}</span>
                                        <span class="text-gray-400">•</span>
                                        <span class="post-category-tag">${category}</span>
                                    </div>
                                </div>
                            </article>
                        `;
                    }
                }

                previewContainer.innerHTML = html;
            }

            formatDate(dateString) {
                if (!dateString) return '15 Jan, 2024';
                const date = new Date(dateString);
                const options = {
                    day: 'numeric',
                    month: 'short',
                    year: 'numeric'
                };
                return date.toLocaleDateString('en-US', options);
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
                const requiredFields = ['headline', 'title'];

                requiredFields.forEach(fieldId => {
                    const field = document.getElementById(fieldId);
                    if (!field.value.trim()) {
                        this.showError(fieldId, 'This field is required.');
                        isValid = false;
                    }
                });

                // Validate blog post titles (all 3 required)
                for (let i = 1; i <= 3; i++) {
                    const titleField = document.getElementById(`blog_${i}_title`);
                    const excerptField = document.getElementById(`blog_${i}_excerpt`);

                    if (titleField && !titleField.value.trim()) {
                        this.showError(`blog${i}Title`, 'Blog post title is required.');
                        isValid = false;
                    }

                    if (excerptField && !excerptField.value.trim()) {
                        this.showError(`blog${i}Excerpt`, 'Blog post excerpt is required.');
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

        // Initialize the blog section manager
        document.addEventListener('DOMContentLoaded', () => {
            new BlogSectionManager();
        });
    </script>
@endpush
