@extends('layouts.admin.main')

@push('styles')
    <style>
        :root {
            --primary-color: #f5a623;
            --secondary-color: #6b3d02;
            --white: #ffffff;
            --shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
            --error-color: #e3342f;
            --success-color: #10b981;
        }

        .contact-preview-container {
            background: linear-gradient(135deg, var(--secondary-color) 0%, var(--primary-color) 100%);
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 2rem;
            box-shadow: var(--shadow);
        }

        .contact-section {
            color: #333;
            padding: clamp(2rem, 4vw, 3rem) 0;
            position: relative;
            overflow: hidden;
            isolation: isolate;
        }

        .contact-content {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 clamp(1rem, 3vw, 2rem);
            position: relative;
            z-index: 1;
        }

        .contact-heading {
            text-align: center;
            margin-bottom: 3.5rem;
            animation: fadeIn 0.8s ease-in;
        }

        .contact-heading h2 {
            font-size: clamp(2rem, 5vw, 2.5rem);
            font-weight: 700;
            color: var(--white);
            line-height: 1.2;
            margin-bottom: 1rem;
        }

        .contact-heading p {
            font-size: clamp(1rem, 3vw, 1.1rem);
            color: rgba(255, 255, 255, 0.9);
            line-height: 1.7;
            max-width: 700px;
            margin: 0 auto;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 2.5rem;
        }

        .contact-info {
            background-color: var(--white);
            border-radius: 16px;
            padding: 2.5rem;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
            animation: fadeInUp 0.7s ease-in 0.1s both;
        }

        .contact-item {
            display: flex;
            align-items: flex-start;
            gap: 1.25rem;
            margin-bottom: 2rem;
        }

        .contact-icon {
            background-color: var(--primary-color);
            padding: 1rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: var(--transition);
            min-width: 56px;
            height: 56px;
        }

        .contact-icon:hover {
            transform: scale(1.05);
        }

        .contact-details h3 {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--secondary-color);
            margin-bottom: 0.3rem;
        }

        .contact-details p {
            color: #4b4b4b;
            font-size: 0.95rem;
            line-height: 1.5;
        }

        .social-section {
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e5e7eb;
        }

        .social-section h3 {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--secondary-color);
            margin-bottom: 1rem;
        }

        .social-links {
            display: flex;
            gap: 1rem;
            list-style: none;
        }

        .social-link {
            width: 44px;
            height: 44px;
            background-color: var(--secondary-color);
            border: 2px solid var(--secondary-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
            text-decoration: none;
        }

        .social-link:hover {
            transform: scale(1.1);
            background-color: transparent;
        }

        .social-link span {
            color: var(--white);
            font-weight: bold;
            font-size: 0.9rem;
        }

        .social-link:hover span {
            color: var(--secondary-color);
        }

        .contact-form {
            background-color: var(--white);
            border-radius: 16px;
            padding: 2.5rem;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
            animation: fadeInUp 0.7s ease-in 0.2s both;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            font-size: 1rem;
            font-weight: 600;
            color: var(--secondary-color);
            display: block;
            margin-bottom: 0.6rem;
        }

        .form-control {
            width: 100%;
            padding: 0.9rem;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            color: #4b4b4b;
            font-size: 0.95rem;
            transition: var(--transition);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 6px rgba(245, 166, 35, 0.4);
        }

        .form-note {
            font-size: 0.9rem;
            color: #4b4b4b;
            text-align: center;
            margin-top: 1.25rem;
        }

        .submit-button {
            padding: 0.9rem 2rem;
            background-color: var(--primary-color);
            border: 2px solid var(--primary-color);
            color: var(--white);
            border-radius: 6px;
            font-weight: 600;
            font-size: 1rem;
            transition: var(--transition);
            cursor: pointer;
        }

        .submit-button:hover {
            background-color: transparent;
            color: var(--primary-color);
            transform: translateY(-3px);
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

        .admin-form-control {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 1rem;
            transition: var(--transition);
            background: #fafafa;
        }

        .admin-form-control:focus {
            border-color: var(--primary-color);
            background: var(--white);
            outline: none;
            box-shadow: 0 0 0 3px rgba(245, 166, 35, 0.1);
        }

        .admin-form-control--error {
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
            box-shadow: 0 2px 8px rgba(245, 166, 35, 0.3);
        }

        .btn-save:hover {
            background: var(--secondary-color);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(107, 61, 2, 0.4);
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
            box-shadow: 0 4px 20px rgba(245, 166, 35, 0.4);
            transition: var(--transition);
            font-size: 1.25rem;
        }

        .toggle-admin:hover {
            background: var(--secondary-color);
            transform: scale(1.1) rotate(90deg);
            box-shadow: 0 6px 25px rgba(107, 61, 2, 0.5);
        }

        .options-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
        }

        .options-section {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 8px;
            border: 1px solid #e9ecef;
        }

        .options-section h4 {
            color: var(--secondary-color);
            margin-bottom: 1rem;
            font-size: 1.1rem;
            font-weight: 600;
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
                transform: translateY(25px);
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
            .contact-grid {
                grid-template-columns: 1fr;
            }

            .options-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .social-links {
                justify-content: center;
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
            .contact-content {
                padding: 0 1rem;
            }

            .contact-item {
                flex-direction: column;
                text-align: center;
                gap: 1rem;
            }

            .contact-icon {
                align-self: center;
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
                    <h1 class="text-2xl font-bold text-gray-900">Contact Section Management</h1>
                    <p class="text-gray-600 text-sm mt-1">Manage and customize the contact and loan application section for
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

    <!-- Contact Preview -->
    <div class="contact-preview-container">
        <section class="contact-section" aria-label="Contact Section Preview">
            <div class="contact-content">
                <div class="contact-heading" id="contactHeading">
                    <h2 id="previewMainHeading">{{ $contactData['headline'] ?? 'Get Started with Your Loan Application' }}
                    </h2>
                    <p id="previewSubheading">
                        {{ $contactData['subheadline'] ?? 'Ready to fund your next marketing success? Our team is here to help you navigate the loan process and find the perfect financing solution for your business.' }}
                    </p>
                </div>

                <div class="contact-grid" id="previewContactGrid">
                    <!-- Contact Information -->
                    <div class="contact-info">
                        <div id="previewContactInfo">
                            @foreach ($contactData['contact_info'] ?? [] as $contact)
                                <div class="contact-item">
                                    <div class="contact-icon"
                                        style="background-color: {{ $contact['icon_color'] ?? '#f5a623' }}">
                                        <span
                                            style="color: white; font-weight: bold;">{{ substr($contact['title'] ?? '', 0, 1) }}</span>
                                    </div>
                                    <div class="contact-details">
                                        <h3>{{ $contact['title'] ?? '' }}</h3>
                                        <p>{{ $contact['value'] ?? '' }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @if (isset($contactData['social_links']) && count($contactData['social_links']) > 0)
                            <div class="social-section">
                                <h3>Follow Us</h3>
                                <div class="social-links" id="previewSocialLinks">
                                    @foreach ($contactData['social_links'] as $social)
                                        <a href="{{ $social['url'] }}" class="social-link"
                                            style="background-color: {{ $social['color'] ?? '#6b3d02' }}; border-color: {{ $social['color'] ?? '#6b3d02' }}">
                                            <span>{{ substr($social['platform'] ?? '', 0, 1) }}</span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Contact Form -->
                    <div class="contact-form">
                        <form action="{{ $contactData['form_config']['action'] ?? '/submit-application' }}" method="POST"
                            id="previewContactForm">
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="previewFullName">Full Name</label>
                                    <input type="text" id="previewFullName" class="form-control"
                                        placeholder="Your full name" required>
                                </div>
                                <div class="form-group">
                                    <label for="previewEmail">Email Address</label>
                                    <input type="email" id="previewEmail" class="form-control"
                                        placeholder="your.email@example.com" required>
                                </div>
                            </div>

                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="previewPhone">Phone Number</label>
                                    <input type="tel" id="previewPhone" class="form-control"
                                        placeholder="+1 (555) 000-0000">
                                </div>
                                <div class="form-group">
                                    <label for="previewBusinessType">Business Type</label>
                                    <select id="previewBusinessType" class="form-control" required>
                                        <option value="" disabled selected>Select your business type</option>
                                        @foreach ($contactData['form_options']['business_types'] ?? [] as $option)
                                            <option value="{{ Str::slug($option) }}">{{ $option }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="previewLoanAmount">Desired Loan Amount</label>
                                    <select id="previewLoanAmount" class="form-control" required>
                                        <option value="" disabled selected>Select amount range</option>
                                        @foreach ($contactData['form_options']['loan_amounts'] ?? [] as $option)
                                            <option value="{{ Str::slug($option) }}">{{ $option }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="previewLoanPurpose">Loan Purpose</label>
                                    <select id="previewLoanPurpose" class="form-control" required>
                                        <option value="" disabled selected>Select purpose</option>
                                        @foreach ($contactData['form_options']['loan_purposes'] ?? [] as $option)
                                            <option value="{{ Str::slug($option) }}">{{ $option }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="previewProject">Tell us about your project</label>
                                <textarea id="previewProject" class="form-control"
                                    placeholder="Describe your business and how you plan to use the loan..." rows="5"></textarea>
                            </div>

                            <div style="text-align: center;">
                                <button type="submit" class="submit-button" id="previewSubmitButton">
                                    {{ $contactData['form_config']['submit_text'] ?? 'Submit Application' }}
                                </button>
                                <p class="form-note" id="previewFormNote">
                                    {{ $contactData['form_config']['note'] ?? 'One of our loan specialists will contact you within 24 hours to discuss your application.' }}
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Admin Panel -->
    <div class="admin-panel" id="adminPanel" role="dialog" aria-labelledby="adminPanelTitle" aria-modal="true">
        <h3 id="adminPanelTitle">
            <i class="fas fa-edit"></i>
            Manage Contact Section
        </h3>

        <form id="contactForm" action="{{ route('management.contact-section') }}" method="POST" novalidate>
            @csrf

            <!-- Main Content Section -->
            <div class="form-group">
                <label for="headline">Main Headline *</label>
                <input type="text" id="headline" name="headline" class="admin-form-control"
                    value="{{ old('headline', $section->headline ?? '') }}"
                    placeholder="Get Started with Your Loan Application" required maxlength="100">
                <span class="error-message" id="headlineError"></span>
            </div>

            <div class="form-group">
                <label for="subheadline">Subheadline</label>
                <textarea id="subheadline" name="subheadline" class="admin-form-control" rows="4"
                    placeholder="Ready to fund your next marketing success? Our team is here to help you navigate the loan process and find the perfect financing solution for your business."
                    maxlength="500">{{ old('subheadline', $section->subheadline ?? '') }}</textarea>
                <span class="error-message" id="subheadlineError"></span>
            </div>

            <!-- Contact Information -->
            <div class="form-group">
                <label>Contact Information</label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach ([1, 2, 3, 4] as $index)
                        <div class="options-section">
                            <h4>
                                @if ($index == 1)
                                    Email Address
                                @elseif($index == 2)
                                    Office Location
                                @elseif($index == 3)
                                    Phone Number
                                @else
                                    Business Hours
                                @endif
                            </h4>

                            <div class="form-group">
                                <label for="contact_{{ $index }}_title">Title *</label>
                                <input type="text" id="contact_{{ $index }}_title"
                                    name="contact_{{ $index }}_title" class="admin-form-control"
                                    value="{{ old("contact_{$index}_title", $section->{"contact_{$index}_title"} ?? '') }}"
                                    placeholder="e.g., Email Address" maxlength="50" required>
                                <span class="error-message" id="contact{{ $index }}TitleError"></span>
                            </div>

                            <div class="form-group">
                                <label for="contact_{{ $index }}_value">Value *</label>
                                <textarea id="contact_{{ $index }}_value" name="contact_{{ $index }}_value"
                                    class="admin-form-control" rows="2" placeholder="Enter contact information" maxlength="200" required>{{ old("contact_{$index}_value", $section->{"contact_{$index}_value"} ?? '') }}</textarea>
                                <span class="error-message" id="contact{{ $index }}ValueError"></span>
                            </div>

                            <div class="form-group">
                                <label for="contact_{{ $index }}_icon_color">Icon Color</label>
                                <select id="contact_{{ $index }}_icon_color"
                                    name="contact_{{ $index }}_icon_color" class="admin-form-control">
                                    <option value="#f5a623"
                                        {{ old("contact_{$index}_icon_color", $section->{"contact_{$index}_icon_color"} ?? '') == '#f5a623' ? 'selected' : '' }}>
                                        Orange (#f5a623)
                                    </option>
                                    <option value="#6b3d02"
                                        {{ old("contact_{$index}_icon_color", $section->{"contact_{$index}_icon_color"} ?? '') == '#6b3d02' ? 'selected' : '' }}>
                                        Brown (#6b3d02)
                                    </option>
                                </select>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Social Media Links -->
            <div class="form-group">
                <label>Social Media Links</label>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach ([1, 2, 3] as $index)
                        <div class="options-section">
                            <h4>
                                @if ($index == 1)
                                    Facebook
                                @elseif($index == 2)
                                    Twitter
                                @else
                                    LinkedIn
                                @endif
                            </h4>

                            <div class="form-group">
                                <label for="social_{{ $index }}_url">Profile URL</label>
                                <input type="url" id="social_{{ $index }}_url"
                                    name="social_{{ $index }}_url" class="admin-form-control"
                                    value="{{ old("social_{$index}_url", $section->{"social_{$index}_url"} ?? '') }}"
                                    placeholder="https://facebook.com/yourpage">
                            </div>

                            <div class="form-group">
                                <label for="social_{{ $index }}_color">Button Color</label>
                                <select id="social_{{ $index }}_color" name="social_{{ $index }}_color"
                                    class="admin-form-control">
                                    <option value="#6b3d02"
                                        {{ old("social_{$index}_color", $section->{"social_{$index}_color"} ?? '') == '#6b3d02' ? 'selected' : '' }}>
                                        Brown (#6b3d02)
                                    </option>
                                    <option value="#f5a623"
                                        {{ old("social_{$index}_color", $section->{"social_{$index}_color"} ?? '') == '#f5a623' ? 'selected' : '' }}>
                                        Orange (#f5a623)
                                    </option>
                                </select>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Form Configuration -->
            <div class="form-group">
                <label>Form Configuration</label>
                <div class="space-y-4">
                    <div class="form-group">
                        <label for="form_action">Form Action URL</label>
                        <input type="url" id="form_action" name="form_action" class="admin-form-control"
                            value="{{ old('form_action', $section->form_action ?? '') }}"
                            placeholder="/submit-application" maxlength="200">
                    </div>

                    <div class="form-group">
                        <label for="submit_text">Submit Button Text</label>
                        <input type="text" id="submit_text" name="submit_text" class="admin-form-control"
                            value="{{ old('submit_text', $section->submit_text ?? '') }}"
                            placeholder="Submit Application" maxlength="50">
                    </div>

                    <div class="form-group">
                        <label for="form_note">Form Note/Disclaimer</label>
                        <textarea id="form_note" name="form_note" class="admin-form-control" rows="3"
                            placeholder="One of our loan specialists will contact you within 24 hours to discuss your application."
                            maxlength="300">{{ old('form_note', $section->form_note ?? '') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Form Options -->
            <div class="form-group">
                <label>Form Dropdown Options</label>
                <div class="options-grid">
                    <!-- Business Type Options -->
                    <div class="options-section">
                        <h4>Business Type Options</h4>
                        @foreach ([1, 2, 3, 4, 5] as $index)
                            <div class="form-group">
                                <label for="business_option_{{ $index }}">Option {{ $index }}</label>
                                <input type="text" id="business_option_{{ $index }}"
                                    name="business_option_{{ $index }}" class="admin-form-control"
                                    value="{{ old("business_option_{$index}", $section->{"business_option_{$index}"} ?? '') }}"
                                    placeholder="e.g., Marketing Agency" maxlength="100">
                            </div>
                        @endforeach
                    </div>

                    <!-- Loan Amount Options -->
                    <div class="options-section">
                        <h4>Loan Amount Options</h4>
                        @foreach ([1, 2, 3, 4] as $index)
                            <div class="form-group">
                                <label for="loan_option_{{ $index }}">Option {{ $index }}</label>
                                <input type="text" id="loan_option_{{ $index }}"
                                    name="loan_option_{{ $index }}" class="admin-form-control"
                                    value="{{ old("loan_option_{$index}", $section->{"loan_option_{$index}"} ?? '') }}"
                                    placeholder="e.g., $5,000 - $25,000" maxlength="100">
                            </div>
                        @endforeach
                    </div>

                    <!-- Loan Purpose Options -->
                    <div class="options-section">
                        <h4>Loan Purpose Options</h4>
                        @foreach ([1, 2, 3, 4, 5] as $index)
                            <div class="form-group">
                                <label for="purpose_option_{{ $index }}">Option {{ $index }}</label>
                                <input type="text" id="purpose_option_{{ $index }}"
                                    name="purpose_option_{{ $index }}" class="admin-form-control"
                                    value="{{ old("purpose_option_{$index}", $section->{"purpose_option_{$index}"} ?? '') }}"
                                    placeholder="e.g., Marketing Campaign" maxlength="100">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Section Settings -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="form-group">
                    <label for="title">Section Title *</label>
                    <input type="text" id="title" name="title" class="admin-form-control"
                        value="{{ old('title', $section->title ?? '') }}" placeholder="Enter section title" required
                        maxlength="100">
                    <span class="error-message" id="titleError"></span>
                </div>

                <div class="form-group">
                    <label for="order">Display Order</label>
                    <input type="number" id="order" name="order" class="admin-form-control"
                        value="{{ old('order', $section->order ?? 0) }}" min="0" max="100" step="1">
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status" class="admin-form-control">
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
        class ContactSectionManager {
            constructor() {
                this.elements = {
                    adminPanel: document.getElementById('adminPanel'),
                    toggleAdminBtn: document.getElementById('toggleAdmin'),
                    contactForm: document.getElementById('contactForm'),
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
                this.elements.contactForm.addEventListener('submit', (e) => this.validateForm(e));
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
                        input: 'submit_text',
                        preview: 'previewSubmitButton'
                    },
                    {
                        input: 'form_note',
                        preview: 'previewFormNote'
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

                // Update contact information preview
                for (let i = 1; i <= 4; i++) {
                    const contactInputs = document.querySelectorAll(`[id^="contact_${i}_"]`);
                    contactInputs.forEach(input => {
                        input.addEventListener('input', () => this.updateContactInfoPreview());
                        input.addEventListener('change', () => this.updateContactInfoPreview());
                    });
                }

                // Update social links preview
                for (let i = 1; i <= 3; i++) {
                    const socialInputs = document.querySelectorAll(`[id^="social_${i}_"]`);
                    socialInputs.forEach(input => {
                        input.addEventListener('input', () => this.updateSocialLinksPreview());
                        input.addEventListener('change', () => this.updateSocialLinksPreview());
                    });
                }

                // Update form options preview
                const formOptionInputs = document.querySelectorAll(
                    '[id*="business_option_"], [id*="loan_option_"], [id*="purpose_option_"]');
                formOptionInputs.forEach(input => {
                    input.addEventListener('input', () => this.updateFormOptionsPreview());
                });
            }

            updatePreview(field) {
                const input = document.getElementById(field.input);
                const preview = document.getElementById(field.preview);

                if (input && preview) {
                    if (field.input === 'submit_text') {
                        preview.textContent = input.value;
                    } else {
                        preview.textContent = input.value;
                    }
                }
            }

            updateContactInfoPreview() {
                const previewContainer = document.getElementById('previewContactInfo');
                let html = '';

                for (let i = 1; i <= 4; i++) {
                    const titleInput = document.getElementById(`contact_${i}_title`);
                    const valueInput = document.getElementById(`contact_${i}_value`);
                    const colorInput = document.getElementById(`contact_${i}_icon_color`);

                    if (titleInput && titleInput.value && valueInput && valueInput.value) {
                        const title = titleInput.value;
                        const value = valueInput.value;
                        const color = colorInput ? colorInput.value : '#f5a623';

                        html += `
                            <div class="contact-item">
                                <div class="contact-icon" style="background-color: ${color}">
                                    <span style="color: white; font-weight: bold;">${title.charAt(0)}</span>
                                </div>
                                <div class="contact-details">
                                    <h3>${title}</h3>
                                    <p>${value}</p>
                                </div>
                            </div>
                        `;
                    }
                }

                previewContainer.innerHTML = html;
            }

            updateSocialLinksPreview() {
                const previewContainer = document.getElementById('previewSocialLinks');
                let html = '';
                const platforms = ['Facebook', 'Twitter', 'LinkedIn'];

                for (let i = 1; i <= 3; i++) {
                    const urlInput = document.getElementById(`social_${i}_url`);
                    const colorInput = document.getElementById(`social_${i}_color`);

                    if (urlInput && urlInput.value) {
                        const url = urlInput.value;
                        const color = colorInput ? colorInput.value : '#6b3d02';
                        const platform = platforms[i - 1];

                        html += `
                            <a href="${url}" class="social-link" style="background-color: ${color}; border-color: ${color}">
                                <span>${platform.charAt(0)}</span>
                            </a>
                        `;
                    }
                }

                previewContainer.innerHTML = html;
            }

            updateFormOptionsPreview() {
                // This would update the form dropdowns in the preview
                // For simplicity, we'll just trigger a full preview update
                this.updateContactInfoPreview();
                this.updateSocialLinksPreview();
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

                // Validate contact information (all 4 required)
                for (let i = 1; i <= 4; i++) {
                    const titleField = document.getElementById(`contact_${i}_title`);
                    const valueField = document.getElementById(`contact_${i}_value`);

                    if (titleField && !titleField.value.trim()) {
                        this.showError(`contact${i}Title`, 'Contact title is required.');
                        isValid = false;
                    }

                    if (valueField && !valueField.value.trim()) {
                        this.showError(`contact${i}Value`, 'Contact value is required.');
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
                document.querySelectorAll('.admin-form-control--error').forEach(input => {
                    input.classList.remove('admin-form-control--error');
                });
            }

            showError(fieldId, message) {
                const field = document.getElementById(fieldId);
                const errorElement = document.getElementById(fieldId + 'Error');

                if (field && errorElement) {
                    field.classList.add('admin-form-control--error');
                    errorElement.textContent = message;
                    errorElement.classList.add('show');
                }
            }
        }

        // Initialize the contact section manager
        document.addEventListener('DOMContentLoaded', () => {
            new ContactSectionManager();
        });
    </script>
@endpush
