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

        .footer-preview-container {
            background-color: var(--secondary-color);
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 2rem;
            box-shadow: var(--shadow);
        }

        .footer-section {
            color: var(--white);
            padding: clamp(2rem, 4vw, 3rem) 0;
            position: relative;
            isolation: isolate;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 clamp(1rem, 3vw, 2rem);
            position: relative;
            z-index: 1;
        }

        .footer-top {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: clamp(1rem, 3vw, 2rem);
            margin-bottom: 2rem;
        }

        .footer-column {
            animation: fadeIn 0.5s ease-in;
        }

        .logo-container {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            text-decoration: none;
            margin-bottom: 1rem;
        }

        .logo-text {
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .logo-londa {
            font-size: clamp(1.25rem, 3vw, 1.5rem);
            font-weight: 700;
            color: var(--white);
        }

        .logo-loans {
            font-size: clamp(1.25rem, 3vw, 1.5rem);
            font-weight: 700;
            color: var(--primary-color);
        }

        .logo-tagline {
            font-size: 0.9rem;
            opacity: 0.8;
            font-style: italic;
        }

        .footer-description {
            font-size: 0.9rem;
            opacity: 0.8;
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        .contact-info {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .contact-icon {
            width: 20px;
            height: 20px;
            color: var(--primary-color);
            flex-shrink: 0;
        }

        .contact-link {
            font-size: 0.9rem;
            opacity: 0.8;
            color: var(--white);
            text-decoration: none;
            transition: var(--transition);
        }

        .contact-link:hover {
            opacity: 1;
            color: var(--primary-color);
        }

        .social-links {
            display: flex;
            gap: 0.75rem;
            list-style: none;
            padding: 0;
        }

        .social-link {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            background-color: var(--primary-color);
            border-radius: 50%;
            text-decoration: none;
            transition: var(--transition);
        }

        .social-link:hover {
            transform: translateY(-2px);
            background-color: var(--white);
        }

        .social-link:hover .social-icon {
            fill: var(--primary-color);
        }

        .social-icon {
            width: 16px;
            height: 16px;
            fill: var(--white);
            transition: var(--transition);
        }

        .footer-heading {
            font-size: clamp(1rem, 2vw, 1.2rem);
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .footer-links {
            list-style: none;
            padding: 0;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .footer-link {
            font-size: 0.9rem;
            color: var(--white);
            opacity: 0.8;
            text-decoration: none;
            transition: var(--transition);
        }

        .footer-link:hover {
            opacity: 1;
            color: var(--primary-color);
        }

        .newsletter-form {
            display: flex;
            gap: 0.5rem;
        }

        .newsletter-input {
            flex: 1;
            padding: 0.5rem;
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid var(--primary-color);
            color: var(--white);
            border-radius: 4px;
            font-size: 0.9rem;
        }

        .newsletter-input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .newsletter-input:focus {
            outline: none;
            border-color: var(--white);
        }

        .newsletter-button {
            padding: 0.5rem 1rem;
            background-color: var(--primary-color);
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .newsletter-button:hover {
            background-color: var(--white);
        }

        .newsletter-button:hover .newsletter-icon {
            fill: var(--primary-color);
        }

        .newsletter-icon {
            width: 20px;
            height: 20px;
            fill: var(--white);
            transition: var(--transition);
        }

        .footer-bottom {
            border-top: 1px solid var(--primary-color);
            padding-top: 1rem;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
        }

        .footer-bottom-links {
            display: flex;
            gap: 1rem;
            list-style: none;
            padding: 0;
        }

        .footer-bottom-link {
            font-size: 0.9rem;
            color: var(--white);
            opacity: 0.8;
            text-decoration: none;
            transition: var(--transition);
        }

        .footer-bottom-link:hover {
            opacity: 1;
            color: var(--primary-color);
        }

        .copyright {
            font-size: 0.9rem;
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

        .link-item-row,
        .social-item-row {
            display: flex;
            gap: 12px;
            align-items: center;
            margin-bottom: 12px;
            padding: 12px;
            background: #f8f9fa;
            border-radius: 8px;
            border: 1px solid #e9ecef;
        }

        .link-item-row .form-control,
        .social-item-row .form-control {
            flex: 1;
            margin-bottom: 0;
        }

        .column-container {
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            background: #f8f9fa;
        }

        .column-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 1rem;
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
                transform: translateY(10px);
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
            .footer-top {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .footer-bottom {
                flex-direction: column;
                text-align: center;
            }

            .footer-bottom-links {
                justify-content: center;
                flex-wrap: wrap;
            }

            .newsletter-form {
                flex-direction: column;
            }

            .link-item-row,
            .social-item-row {
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
            .footer-container {
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
@section('breadcrumbs')
    <nav class="flex items-center space-x-2">
        <a href="{{ route('management.dashboard') }}" class="text-sm text-gray-500 hover:text-gray-700">Website Management</a>
        <span class="text-gray-400">/</span>
        <span class="text-sm text-gray-500">Footer Section</span>
    </nav>
@endsection
@section('page-icon')
    <i class="fas fa-cogs fa-lg text-gray-700"></i>
@endsection
@section('page-title')
    <h1 class="text-2xl font-bold text-gray-900">Footer Section Management</h1>
    <p class="text-gray-600 text-sm mt-1">Customize and manage the footer section for your website.</p>
@endsection

@section('title', 'Footer Section Management')

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

    <!-- Footer Preview -->
    <div class="footer-preview-container">
        <footer class="footer-section" aria-label="Footer">
            <div class="footer-container">
                <!-- Footer Top -->
                <div class="footer-top" id="previewFooterTop" role="navigation">
                    @foreach ($footerData['columns'] ?? [] as $column)
                        <div class="footer-column" role="region" aria-label="{{ $column['title'] ?? 'Footer column' }}">
                            @if ($column['type'] === 'logo')
                                <a href="{{ route('management.footer-section') }}" class="logo-container">
                                    <div class="logo-text">
                                        <span class="logo-londa">Londa</span>
                                        <span class="logo-loans">Loans</span>
                                    </div>
                                    <span class="logo-tagline">empowering marketeers</span>
                                </a>
                                <p class="footer-description" id="previewCompanyDescription">
                                    {{ $footerData['company_info']['description'] ?? 'Empowering marketeers with tailored financial solutions to grow their businesses and achieve marketing success.' }}
                                </p>
                                <div class="contact-info">
                                    <div class="contact-item">
                                        <svg class="contact-icon" fill="currentColor" viewBox="0 0 20 20"
                                            aria-hidden="true">
                                            <path
                                                d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                        </svg>
                                        <a href="mailto:{{ $footerData['company_info']['email'] ?? 'hello@londaloans.com' }}"
                                            class="contact-link" id="previewCompanyEmail">
                                            {{ $footerData['company_info']['email'] ?? 'hello@londaloans.com' }}
                                        </a>
                                    </div>
                                    <div class="contact-item">
                                        <svg class="contact-icon" fill="currentColor" viewBox="0 0 20 20"
                                            aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span class="contact-link" id="previewCompanyAddress">
                                            {{ $footerData['company_info']['address'] ?? '123 Business District, Marketing City, MC 10001' }}
                                        </span>
                                    </div>
                                    <div class="contact-item">
                                        <svg class="contact-icon" fill="currentColor" viewBox="0 0 20 20"
                                            aria-hidden="true">
                                            <path
                                                d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                        </svg>
                                        <a href="tel:{{ $footerData['company_info']['phone'] ?? '+1 (555) 123-4567' }}"
                                            class="contact-link" id="previewCompanyPhone">
                                            {{ $footerData['company_info']['phone'] ?? '+1 (555) 123-4567' }}
                                        </a>
                                    </div>
                                </div>
                                <ul class="social-links" id="previewSocialLinks" role="list">
                                    @foreach ($footerData['social_links'] ?? [] as $social)
                                        <li>
                                            <a href="{{ $social['url'] }}" target="_blank" rel="noopener noreferrer"
                                                class="social-link" aria-label="{{ $social['aria_label'] }}">
                                                <svg class="social-icon" viewBox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    @if ($social['platform'] === 'facebook')
                                                        <path
                                                            d="M18 10a8 8 0 10-9.25 7.903v-5.59H7.094v-2.313h1.656V8.766c0-1.633.973-2.536 2.461-2.536.713 0 1.458.127 1.458.127v1.604h-.821c-.808 0-1.06.5-1.06 1.015v1.223h1.805l-.288 2.313h-1.517v5.59A8.002 8.002 0 0018 10z" />
                                                    @elseif($social['platform'] === 'twitter')
                                                        <path
                                                            d="M6.29 18.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0020 3.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.073 4.073 0 01.8 7.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 010 16.407a11.616 11.616 0 006.29 1.84" />
                                                    @elseif($social['platform'] === 'linkedin')
                                                        <path
                                                            d="M16 8c0 4.418-3.582 8-8 8s-8-3.582-8-8 3.582-8 8-8 8 3.582 8 8zM7 6a1 1 0 11-2 0 1 1 0 012 0zm-1 9v-5h2v5H6zm4 0v-3c0-.553.447-1 1-1h1c.553 0 1 .447 1 1v3h2v-3c0-1.657-1.343-3-3-3h-1c-1.657 0-3 1.343-3 3v3h2z" />
                                                    @elseif($social['platform'] === 'instagram')
                                                        <path
                                                            d="M10 2.5a7.5 7.5 0 017.5 7.5 7.5 7.5 0 01-7.5 7.5A7.5 7.5 0 012.5 10 7.5 7.5 0 0110 2.5zm0-2.5a10 10 0 1010 10A10 10 0 0010 0zm4.167 5.833a1.167 1.167 0 100-2.333 1.167 1.167 0 000 2.333zM10 7.5a2.5 2.5 0 110 5 2.5 2.5 0 010-5z" />
                                                    @endif
                                                </svg>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @elseif($column['type'] === 'links')
                                <h4 class="footer-heading">{{ $column['title'] }}</h4>
                                <ul class="footer-links" role="list">
                                    @foreach ($column['links'] as $link)
                                        <li><a href="{{ $link['url'] }}" class="footer-link">{{ $link['text'] }}</a></li>
                                    @endforeach
                                </ul>
                            @elseif($column['type'] === 'newsletter')
                                <h4 class="footer-heading">{{ $column['title'] }}</h4>
                                <p class="footer-description">
                                    {{ $column['description'] ?? 'Subscribe to our newsletter for the latest updates and marketing insights.' }}
                                </p>
                                <div class="newsletter-form">
                                    <input type="email" placeholder="Your email address" class="newsletter-input"
                                        aria-label="Email address for newsletter">
                                    <button class="newsletter-button" aria-label="Subscribe to newsletter">
                                        <svg class="newsletter-icon" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                        </svg>
                                    </button>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

                <!-- Footer Bottom -->
                <div class="footer-bottom">
                    <ul class="footer-bottom-links" id="previewBottomLinks" role="list">
                        @foreach ($footerData['bottom_links'] ?? [] as $link)
                            <li role="listitem">
                                <a href="{{ $link['url'] }}" class="footer-bottom-link">{{ $link['text'] }}</a>
                            </li>
                        @endforeach
                    </ul>
                    <p class="copyright" id="previewCopyright">
                        {!! $footerData['copyright'] ??
                            '&copy; 2025 Londa Loans. All rights reserved. Empowering marketeers with financial solutions.' !!}
                    </p>
                </div>
            </div>
        </footer>
    </div>

    <!-- Admin Panel -->
    <div class="admin-panel" id="adminPanel" role="dialog" aria-labelledby="adminPanelTitle" aria-modal="true">
        <h3 id="adminPanelTitle">
            <i class="fas fa-edit"></i>
            Manage Footer Section
        </h3>

        <form id="footerForm" action="{{ route('management.footer-section') }}" method="POST" novalidate>
            @csrf

            <!-- Company Information -->
            <div class="form-group">
                <label for="company_description">Company Description *</label>
                <textarea id="company_description" name="company_description" class="form-control" rows="3"
                    placeholder="Empowering marketeers with tailored financial solutions to grow their businesses and achieve marketing success."
                    maxlength="500" required>{{ old('company_description', $section->company_description ?? '') }}</textarea>
                <span class="error-message" id="companyDescriptionError"></span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="form-group">
                    <label for="company_email">Company Email *</label>
                    <input type="email" id="company_email" name="company_email" class="form-control"
                        value="{{ old('company_email', $section->company_email ?? '') }}"
                        placeholder="hello@londaloans.com" required maxlength="100">
                    <span class="error-message" id="companyEmailError"></span>
                </div>

                <div class="form-group">
                    <label for="company_phone">Company Phone *</label>
                    <input type="text" id="company_phone" name="company_phone" class="form-control"
                        value="{{ old('company_phone', $section->company_phone ?? '') }}" placeholder="+1 (555) 123-4567"
                        required maxlength="20">
                    <span class="error-message" id="companyPhoneError"></span>
                </div>
            </div>

            <div class="form-group">
                <label for="company_address">Company Address *</label>
                <input type="text" id="company_address" name="company_address" class="form-control"
                    value="{{ old('company_address', $section->company_address ?? '') }}"
                    placeholder="123 Business District, Marketing City, MC 10001" required maxlength="200">
                <span class="error-message" id="companyAddressError"></span>
            </div>

            <!-- Footer Columns -->
            <div class="form-group">
                <label>Footer Columns</label>
                <div id="footerColumnsContainer">
                    @foreach ($footerData['columns'] ?? [] as $index => $column)
                        <div class="column-container" data-index="{{ $index }}">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="form-group">
                                    <label for="column_type_{{ $index }}">Column Type</label>
                                    <select id="column_type_{{ $index }}"
                                        name="columns[{{ $index }}][type]" class="form-control column-type-select"
                                        data-index="{{ $index }}">
                                        <option value="logo" {{ $column['type'] == 'logo' ? 'selected' : '' }}>Logo &
                                            Contact</option>
                                        <option value="links" {{ $column['type'] == 'links' ? 'selected' : '' }}>Links
                                        </option>
                                        <option value="newsletter"
                                            {{ $column['type'] == 'newsletter' ? 'selected' : '' }}>Newsletter</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="column_title_{{ $index }}">Column Title *</label>
                                    <input type="text" id="column_title_{{ $index }}"
                                        name="columns[{{ $index }}][title]" class="form-control"
                                        value="{{ $column['title'] }}" placeholder="Column Title" required
                                        maxlength="100">
                                </div>
                                <div class="form-group column-description-field"
                                    style="{{ $column['type'] == 'newsletter' ? 'display: block;' : 'display: none;' }}">
                                    <label for="column_description_{{ $index }}">Description</label>
                                    <input type="text" id="column_description_{{ $index }}"
                                        name="columns[{{ $index }}][description]" class="form-control"
                                        value="{{ $column['description'] ?? '' }}" placeholder="Column Description"
                                        maxlength="200">
                                </div>
                            </div>

                            <!-- Links for link columns -->
                            <div class="column-links-container"
                                style="{{ $column['type'] == 'links' ? 'display: block;' : 'display: none;' }}"
                                data-index="{{ $index }}">
                                <label>Links</label>
                                @foreach ($column['links'] as $linkIndex => $link)
                                    <div class="link-item-row">
                                        <input type="text"
                                            name="columns[{{ $index }}][links][{{ $linkIndex }}][text]"
                                            class="form-control" value="{{ $link['text'] }}" placeholder="Link Text"
                                            required maxlength="50">
                                        <input type="url"
                                            name="columns[{{ $index }}][links][{{ $linkIndex }}][url]"
                                            class="form-control" value="{{ $link['url'] }}" placeholder="Link URL"
                                            required maxlength="255">
                                        <button type="button" class="admin-btn btn-danger remove-link"
                                            data-index="{{ $index }}" data-link-index="{{ $linkIndex }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                @endforeach
                                <button type="button" class="admin-btn btn-save add-link"
                                    data-index="{{ $index }}">
                                    <i class="fas fa-plus"></i> Add Link
                                </button>
                            </div>

                            <button type="button" class="admin-btn btn-danger remove-column"
                                data-index="{{ $index }}">
                                <i class="fas fa-trash"></i> Remove Column
                            </button>
                        </div>
                    @endforeach
                </div>
                <button type="button" class="admin-btn btn-save mt-3" id="addFooterColumn">
                    <i class="fas fa-plus"></i> Add Footer Column
                </button>
            </div>

            <!-- Social Links -->
            <div class="form-group">
                <label>Social Media Links</label>
                <div id="socialLinksContainer">
                    @foreach ($footerData['social_links'] ?? [] as $index => $social)
                        <div class="social-item-row">
                            <select name="social_links[{{ $index }}][platform]" class="form-control" required>
                                <option value="facebook" {{ $social['platform'] == 'facebook' ? 'selected' : '' }}>
                                    Facebook</option>
                                <option value="twitter" {{ $social['platform'] == 'twitter' ? 'selected' : '' }}>Twitter
                                </option>
                                <option value="linkedin" {{ $social['platform'] == 'linkedin' ? 'selected' : '' }}>
                                    LinkedIn</option>
                                <option value="instagram" {{ $social['platform'] == 'instagram' ? 'selected' : '' }}>
                                    Instagram</option>
                                <option value="youtube" {{ $social['platform'] == 'youtube' ? 'selected' : '' }}>YouTube
                                </option>
                            </select>
                            <input type="url" name="social_links[{{ $index }}][url]" class="form-control"
                                value="{{ $social['url'] }}" placeholder="Profile URL" required maxlength="255">
                            <input type="text" name="social_links[{{ $index }}][aria_label]"
                                class="form-control" value="{{ $social['aria_label'] }}" placeholder="ARIA Label"
                                required maxlength="100">
                            <button type="button" class="admin-btn btn-danger remove-social-link"
                                data-index="{{ $index }}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    @endforeach
                </div>
                <button type="button" class="admin-btn btn-save mt-3" id="addSocialLink">
                    <i class="fas fa-plus"></i> Add Social Link
                </button>
            </div>

            <!-- Bottom Links -->
            <div class="form-group">
                <label>Bottom Links</label>
                <div id="bottomLinksContainer">
                    @foreach ($footerData['bottom_links'] ?? [] as $index => $link)
                        <div class="link-item-row">
                            <input type="text" name="bottom_links[{{ $index }}][text]" class="form-control"
                                value="{{ $link['text'] }}" placeholder="Link Text" required maxlength="50">
                            <input type="url" name="bottom_links[{{ $index }}][url]" class="form-control"
                                value="{{ $link['url'] }}" placeholder="Link URL" required maxlength="255">
                            <button type="button" class="admin-btn btn-danger remove-bottom-link"
                                data-index="{{ $index }}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    @endforeach
                </div>
                <button type="button" class="admin-btn btn-save mt-3" id="addBottomLink">
                    <i class="fas fa-plus"></i> Add Bottom Link
                </button>
            </div>

            <!-- Copyright -->
            <div class="form-group">
                <label for="copyright_text">Copyright Text *</label>
                <input type="text" id="copyright_text" name="copyright_text" class="form-control"
                    value="{{ old('copyright_text', $section->copyright_text ?? '') }}"
                    placeholder="&copy; 2025 Londa Loans. All rights reserved. Empowering marketeers with financial solutions."
                    required maxlength="500">
                <span class="error-message" id="copyrightTextError"></span>
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
        class FooterSectionManager {
            constructor() {
                this.elements = {
                    adminPanel: document.getElementById('adminPanel'),
                    toggleAdminBtn: document.getElementById('toggleAdmin'),
                    footerForm: document.getElementById('footerForm'),
                    cancelEditBtn: document.getElementById('cancelEdit'),
                    footerColumnsContainer: document.getElementById('footerColumnsContainer'),
                    socialLinksContainer: document.getElementById('socialLinksContainer'),
                    bottomLinksContainer: document.getElementById('bottomLinksContainer'),
                    addFooterColumnBtn: document.getElementById('addFooterColumn'),
                    addSocialLinkBtn: document.getElementById('addSocialLink'),
                    addBottomLinkBtn: document.getElementById('addBottomLink')
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

                // Add footer column
                this.elements.addFooterColumnBtn.addEventListener('click', () => this.addFooterColumn());

                // Add social link
                this.elements.addSocialLinkBtn.addEventListener('click', () => this.addSocialLink());

                // Add bottom link
                this.elements.addBottomLinkBtn.addEventListener('click', () => this.addBottomLink());

                // Form submission
                this.elements.footerForm.addEventListener('submit', (e) => this.validateForm(e));

                // Event delegation for dynamic elements
                this.setupEventDelegation();
            }

            setupEventDelegation() {
                // Column type change
                this.elements.footerColumnsContainer.addEventListener('change', (e) => {
                    if (e.target.classList.contains('column-type-select')) {
                        this.handleColumnTypeChange(e.target);
                    }
                });

                // Remove column
                this.elements.footerColumnsContainer.addEventListener('click', (e) => {
                    if (e.target.closest('.remove-column')) {
                        this.removeColumn(e.target.closest('.remove-column'));
                    }
                });

                // Add link to column
                this.elements.footerColumnsContainer.addEventListener('click', (e) => {
                    if (e.target.closest('.add-link')) {
                        this.addLinkToColumn(e.target.closest('.add-link'));
                    }
                });

                // Remove link from column
                this.elements.footerColumnsContainer.addEventListener('click', (e) => {
                    if (e.target.closest('.remove-link')) {
                        this.removeLinkFromColumn(e.target.closest('.remove-link'));
                    }
                });

                // Remove social link
                this.elements.socialLinksContainer.addEventListener('click', (e) => {
                    if (e.target.closest('.remove-social-link')) {
                        this.removeSocialLink(e.target.closest('.remove-social-link'));
                    }
                });

                // Remove bottom link
                this.elements.bottomLinksContainer.addEventListener('click', (e) => {
                    if (e.target.closest('.remove-bottom-link')) {
                        this.removeBottomLink(e.target.closest('.remove-bottom-link'));
                    }
                });
            }

            setupRealTimePreview() {
                // Real-time preview updates
                const previewFields = [{
                        input: 'company_description',
                        preview: 'previewCompanyDescription'
                    },
                    {
                        input: 'company_email',
                        preview: 'previewCompanyEmail'
                    },
                    {
                        input: 'company_address',
                        preview: 'previewCompanyAddress'
                    },
                    {
                        input: 'company_phone',
                        preview: 'previewCompanyPhone'
                    },
                    {
                        input: 'copyright_text',
                        preview: 'previewCopyright'
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
                    if (field.input === 'company_email') {
                        preview.href = `mailto:${input.value}`;
                        preview.textContent = input.value;
                    } else if (field.input === 'company_phone') {
                        preview.href = `tel:${input.value}`;
                        preview.textContent = input.value;
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

            addFooterColumn() {
                const columnCount = this.elements.footerColumnsContainer.querySelectorAll('.column-container').length;
                const newIndex = columnCount;

                const columnHtml = `
                    <div class="column-container" data-index="${newIndex}">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="form-group">
                                <label for="column_type_${newIndex}">Column Type</label>
                                <select id="column_type_${newIndex}" name="columns[${newIndex}][type]" class="form-control column-type-select" data-index="${newIndex}">
                                    <option value="logo">Logo & Contact</option>
                                    <option value="links">Links</option>
                                    <option value="newsletter">Newsletter</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="column_title_${newIndex}">Column Title *</label>
                                <input type="text" id="column_title_${newIndex}" name="columns[${newIndex}][title]" class="form-control" placeholder="Column Title" required maxlength="100">
                            </div>
                            <div class="form-group column-description-field" style="display: none;">
                                <label for="column_description_${newIndex}">Description</label>
                                <input type="text" id="column_description_${newIndex}" name="columns[${newIndex}][description]" class="form-control" placeholder="Column Description" maxlength="200">
                            </div>
                        </div>

                        <div class="column-links-container" style="display: none;" data-index="${newIndex}">
                            <label>Links</label>
                            <button type="button" class="admin-btn btn-save add-link" data-index="${newIndex}">
                                <i class="fas fa-plus"></i> Add Link
                            </button>
                        </div>

                        <button type="button" class="admin-btn btn-danger remove-column" data-index="${newIndex}">
                            <i class="fas fa-trash"></i> Remove Column
                        </button>
                    </div>
                `;

                this.elements.footerColumnsContainer.insertAdjacentHTML('beforeend', columnHtml);
            }

            handleColumnTypeChange(select) {
                const index = select.dataset.index;
                const container = select.closest('.column-container');
                const descriptionField = container.querySelector('.column-description-field');
                const linksContainer = container.querySelector('.column-links-container');

                if (select.value === 'newsletter') {
                    descriptionField.style.display = 'block';
                    linksContainer.style.display = 'none';
                } else if (select.value === 'links') {
                    descriptionField.style.display = 'none';
                    linksContainer.style.display = 'block';
                } else {
                    descriptionField.style.display = 'none';
                    linksContainer.style.display = 'none';
                }
            }

            removeColumn(button) {
                if (confirm('Are you sure you want to remove this column?')) {
                    button.closest('.column-container').remove();
                }
            }

            addLinkToColumn(button) {
                const index = button.dataset.index;
                const linksContainer = button.closest('.column-links-container');
                const linkCount = linksContainer.querySelectorAll('.link-item-row').length;
                const linkIndex = linkCount;

                const linkHtml = `
                    <div class="link-item-row">
                        <input type="text" name="columns[${index}][links][${linkIndex}][text]" class="form-control" placeholder="Link Text" required maxlength="50">
                        <input type="url" name="columns[${index}][links][${linkIndex}][url]" class="form-control" placeholder="Link URL" required maxlength="255">
                        <button type="button" class="admin-btn btn-danger remove-link" data-index="${index}" data-link-index="${linkIndex}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                `;

                button.insertAdjacentHTML('beforebegin', linkHtml);
            }

            removeLinkFromColumn(button) {
                if (confirm('Are you sure you want to remove this link?')) {
                    button.closest('.link-item-row').remove();
                }
            }

            addSocialLink() {
                const socialCount = this.elements.socialLinksContainer.querySelectorAll('.social-item-row').length;
                const newIndex = socialCount;

                const socialHtml = `
                    <div class="social-item-row">
                        <select name="social_links[${newIndex}][platform]" class="form-control" required>
                            <option value="facebook">Facebook</option>
                            <option value="twitter">Twitter</option>
                            <option value="linkedin">LinkedIn</option>
                            <option value="instagram">Instagram</option>
                            <option value="youtube">YouTube</option>
                        </select>
                        <input type="url" name="social_links[${newIndex}][url]" class="form-control" placeholder="Profile URL" required maxlength="255">
                        <input type="text" name="social_links[${newIndex}][aria_label]" class="form-control" placeholder="ARIA Label" required maxlength="100">
                        <button type="button" class="admin-btn btn-danger remove-social-link" data-index="${newIndex}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                `;

                this.elements.socialLinksContainer.insertAdjacentHTML('beforeend', socialHtml);
            }

            removeSocialLink(button) {
                if (confirm('Are you sure you want to remove this social link?')) {
                    button.closest('.social-item-row').remove();
                }
            }

            addBottomLink() {
                const bottomCount = this.elements.bottomLinksContainer.querySelectorAll('.link-item-row').length;
                const newIndex = bottomCount;

                const bottomHtml = `
                    <div class="link-item-row">
                        <input type="text" name="bottom_links[${newIndex}][text]" class="form-control" placeholder="Link Text" required maxlength="50">
                        <input type="url" name="bottom_links[${newIndex}][url]" class="form-control" placeholder="Link URL" required maxlength="255">
                        <button type="button" class="admin-btn btn-danger remove-bottom-link" data-index="${newIndex}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                `;

                this.elements.bottomLinksContainer.insertAdjacentHTML('beforeend', bottomHtml);
            }

            removeBottomLink(button) {
                if (confirm('Are you sure you want to remove this bottom link?')) {
                    button.closest('.link-item-row').remove();
                }
            }

            validateForm(e) {
                let isValid = true;

                // Clear previous errors
                this.clearErrors();

                // Validate required fields
                const requiredFields = [
                    'company_description', 'company_email', 'company_phone',
                    'company_address', 'copyright_text', 'title'
                ];

                requiredFields.forEach(fieldId => {
                    const field = document.getElementById(fieldId);
                    if (!field.value.trim()) {
                        this.showError(fieldId, 'This field is required.');
                        isValid = false;
                    }
                });

                // Validate at least one column
                const columns = this.elements.footerColumnsContainer.querySelectorAll('.column-container');
                if (columns.length === 0) {
                    this.showError('company_description', 'At least one footer column is required.');
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

        // Initialize the footer section manager
        document.addEventListener('DOMContentLoaded', () => {
            new FooterSectionManager();
        });
    </script>
@endpush
