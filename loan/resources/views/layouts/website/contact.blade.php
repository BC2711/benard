<style>
    /* Base Styles */
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: 'Inter', Arial, sans-serif;
        line-height: 1.6;
        color: #333;
    }

    #support {
        background: linear-gradient(135deg, #6b3d02 0%, #f5a623 100%);
        padding: 5rem 0;
        position: relative;
        overflow: hidden;
    }

    /* Background Shapes */
    .bg-shape {
        position: absolute;
        animation: float 4s ease-in-out infinite;
        will-change: transform;
    }

    .bg-shape.circle {
        top: 8%;
        left: 4%;
        width: 180px;
        height: 180px;
        background-color: rgba(255, 255, 255, 0.12);
        border-radius: 50%;
    }

    .bg-shape.shape-03 {
        top: 12%;
        right: 6%;
        max-width: 90px;
        animation-duration: 3.8s;
    }

    .bg-shape.shape-06 {
        top: 18%;
        left: 8%;
        max-width: 80px;
        animation-duration: 4.5s;
    }

    .bg-shape.shape-07 {
        bottom: 12%;
        right: 12%;
        max-width: 100px;
        animation-duration: 4.1s;
    }

    .bg-shape.shape-12 {
        bottom: 18%;
        left: 8%;
        max-width: 95px;
        animation-duration: 4.4s;
    }

    .bg-shape.shape-13 {
        bottom: 22%;
        right: 8%;
        max-width: 85px;
        animation-duration: 3.9s;
    }

    /* Section Title */
    .section-title {
        text-align: center;
        margin-bottom: 3.5rem;
        animation: fadeIn 0.8s ease-in;
        padding: 0 1.5rem;
    }

    .section-title h2 {
        font-size: clamp(2rem, 5vw, 2.5rem);
        font-weight: 700;
        color: #fff;
        line-height: 1.2;
        margin-bottom: 1rem;
    }

    .section-title p {
        font-size: clamp(1rem, 3vw, 1.1rem);
        color: rgba(255, 255, 255, 0.9);
        line-height: 1.7;
        max-width: 700px;
        margin: 0 auto;
    }

    /* Content Container */
    .content-container {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 1.5rem;
    }

    .content-grid {
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 2.5rem;
    }

    /* Contact Information */
    .contact-info {
        background-color: #fff;
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
        padding: 1rem;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: transform 0.3s ease;
        color: white;
        width: 48px;
        height: 48px;
    }

    .contact-item h3 {
        font-size: 1.3rem;
        font-weight: 600;
        color: #6b3d02;
        margin-bottom: 0.3rem;
    }

    .contact-item p,
    .contact-item a {
        color: #4b4b4b;
        text-decoration: none;
        font-size: 0.95rem;
        line-height: 1.5;
    }

    .contact-divider {
        border: 0;
        height: 1px;
        background-color: #e5e7eb;
        margin: 1.5rem 0;
    }

    .social-section h3 {
        font-size: 1.3rem;
        font-weight: 600;
        color: #6b3d02;
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
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .social-link:hover {
        background-color: transparent;
        transform: scale(1.1);
    }

    .social-link:hover i {
        color: inherit;
    }

    /* Contact Form */
    .contact-form {
        background-color: #fff;
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
        margin-bottom: 1.25rem;
    }

    .form-group label {
        font-size: 1rem;
        font-weight: 600;
        color: #6b3d02;
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
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    textarea.form-control {
        resize: vertical;
        min-height: 140px;
    }

    .form-submit {
        text-align: center;
    }

    .submit-btn {
        padding: 0.9rem 2rem;
        background-color: #f5a623;
        border: 2px solid #f5a623;
        color: #fff;
        border-radius: 6px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .submit-btn:hover {
        background-color: transparent;
        color: #f5a623;
        transform: translateY(-3px);
    }

    .form-note {
        font-size: 0.9rem;
        color: #4b4b4b;
        text-align: center;
        margin-top: 1.25rem;
    }

    /* Message Styles */
    .form-message {
        padding: 1rem;
        border-radius: 6px;
        margin: 1rem 0;
        text-align: center;
        font-weight: 500;
    }

    .form-message.success {
        background-color: #d1fae5;
        color: #065f46;
        border: 1px solid #a7f3d0;
    }

    .form-message.error {
        background-color: #fee2e2;
        color: #991b1b;
        border: 1px solid #fecaca;
    }

    .form-message.info {
        background-color: #dbeafe;
        color: #1e40af;
        border: 1px solid #bfdbfe;
    }

    /* Loading State */
    .submit-btn.loading {
        position: relative;
        color: transparent;
    }

    .submit-btn.loading::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 20px;
        height: 20px;
        margin: -10px 0 0 -10px;
        border: 2px solid transparent;
        border-top: 2px solid #fff;
        border-radius: 50%;
        animation: spin 1s linear infinite;
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

    @keyframes float {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-10px);
        }
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    /* Focus and Hover Effects */
    input:focus,
    select:focus,
    textarea:focus {
        outline: none;
        border-color: #f5a623;
        box-shadow: 0 0 6px rgba(245, 166, 35, 0.4);
    }

    a:hover,
    button:hover {
        transform: translateY(-3px);
    }

    /* Responsive Styles */
    @media (max-width: 1024px) {
        #support {
            padding: 3rem 0;
        }

        .bg-shape {
            max-width: 70px;
        }

        .content-grid {
            grid-template-columns: 1fr;
        }

        .section-title {
            margin-bottom: 2.5rem;
        }
    }

    @media (max-width: 768px) {
        .section-title h2 {
            font-size: clamp(1.75rem, 4vw, 2rem);
        }

        .section-title p {
            font-size: 0.95rem;
        }

        .contact-item h3,
        .social-section h3 {
            font-size: 1.2rem;
        }

        .contact-item p,
        .contact-item a {
            font-size: 0.9rem;
        }

        .bg-shape,
        .bg-shape.circle {
            display: none;
        }

        .form-grid {
            grid-template-columns: 1fr;
        }

        .contact-info,
        .contact-form {
            padding: 2rem;
        }
    }

    @media (max-width: 480px) {
        .section-title h2 {
            font-size: clamp(1.5rem, 3.5vw, 1.75rem);
        }

        .contact-item {
            flex-direction: column;
            text-align: center;
            gap: 1rem;
        }

        .social-links {
            justify-content: center;
        }

        .contact-info,
        .contact-form {
            padding: 1.5rem;
        }

        .submit-btn {
            padding: 0.8rem 1.5rem;
            font-size: 0.95rem;
        }
    }
</style>

<section id="support">
    <!-- Background Shapes -->
    <span class="bg-shape circle"></span>
    <img src="{{ asset('assets/images/shape-03.svg') }}" alt="Decorative shape background" class="bg-shape shape-03">
    <img src="{{ asset('assets/images/shape-06.svg') }}" alt="Decorative shape pattern" class="bg-shape shape-06">
    <img src="{{ asset('assets/images/shape-07.svg') }}" alt="Decorative shape accent" class="bg-shape shape-07">
    <img src="{{ asset('assets/images/shape-12.svg') }}" alt="Decorative shape detail" class="bg-shape shape-12">
    <img src="{{ asset('assets/images/shape-13.svg') }}" alt="Decorative shape element" class="bg-shape shape-13">

    <!-- Section Title -->
    <div class="section-title">
        <h2>{{ $sectionData['headline'] ?? 'Get Started with Your Loan Application' }}</h2>
        <p>{{ $sectionData['subheadline'] ?? 'Ready to fund your next marketing success? Our team is here to help you navigate the loan process and find the perfect financing solution for your business.' }}
        </p>
    </div>

    <!-- Contact Information and Form -->
    <div class="content-container">
        <div class="content-grid">
            <!-- Contact Information -->
            <div class="contact-info">
                <div class="contact-list">
                    @foreach ($sectionData['contact_info'] ?? [] as $contact)
                        <div class="contact-item">
                            <div class="contact-icon"
                                style="background-color: {{ $contact['icon_color'] ?? '#f5a623' }};">
                                @if (str_contains(strtolower($contact['title']), 'email'))
                                    <i class="fas fa-envelope"></i>
                                @elseif(str_contains(strtolower($contact['title']), 'location'))
                                    <i class="fas fa-building"></i>
                                @elseif(str_contains(strtolower($contact['title']), 'phone'))
                                    <i class="fas fa-phone"></i>
                                @elseif(str_contains(strtolower($contact['title']), 'hour'))
                                    <i class="fas fa-clock"></i>
                                @else
                                    <i class="fas fa-info-circle"></i>
                                @endif
                            </div>
                            <div>
                                <h3>{{ $contact['title'] ?? 'Contact Information' }}</h3>
                                @if (str_contains(strtolower($contact['title']), 'email'))
                                    <p><a href="mailto:{{ $contact['value'] }}"
                                            aria-label="Email {{ $contact['value'] }}">{{ $contact['value'] }}</a></p>
                                @elseif(str_contains(strtolower($contact['title']), 'phone'))
                                    <p><a href="tel:{{ preg_replace('/[^0-9+]/', '', $contact['value']) }}"
                                            aria-label="Call {{ $contact['value'] }}">{{ $contact['value'] }}</a></p>
                                @else
                                    <p>{{ $contact['value'] }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach

                    {{-- Fallback contact info if no data --}}
                    @if (empty($sectionData['contact_info']))
                        <div class="contact-item">
                            <div class="contact-icon" style="background-color: #f5a623;">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div>
                                <h3>Email Address</h3>
                                <p><a href="mailto:loans@londaloans.com"
                                        aria-label="Email loans@londaloans.com">loans@londaloans.com</a></p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon" style="background-color: #6b3d02;">
                                <i class="fas fa-building"></i>
                            </div>
                            <div>
                                <h3>Office Location</h3>
                                <p>123 Marketing District<br>San Francisco, CA 94105</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon" style="background-color: #f5a623;">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div>
                                <h3>Phone Number</h3>
                                <p><a href="tel:+18005551234" aria-label="Call +1 (800) 555-1234">+1 (800) 555-1234</a>
                                </p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon" style="background-color: #6b3d02;">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div>
                                <h3>Business Hours</h3>
                                <p>Mon-Fri: 8AM-6PM PST<br>Sat: 9AM-2PM PST</p>
                            </div>
                        </div>
                    @endif
                </div>
                <hr class="contact-divider">
                <div class="social-section">
                    <h3>Follow Us</h3>
                    <ul class="social-links">
                        @foreach ($sectionData['social_links'] ?? [] as $social)
                            <li>
                                <a href="{{ $social['url'] }}" class="social-link"
                                    style="background-color: {{ $social['color'] ?? '#6b3d02' }}; border-color: {{ $social['color'] ?? '#6b3d02' }};"
                                    aria-label="Follow us on {{ $social['platform'] }}" target="_blank"
                                    rel="noopener noreferrer">
                                    @if (strtolower($social['platform']) == 'facebook')
                                        <i class="fab fa-facebook-f" style="color: white;"></i>
                                    @elseif(strtolower($social['platform']) == 'twitter')
                                        <i class="fab fa-twitter" style="color: white;"></i>
                                    @elseif(strtolower($social['platform']) == 'linkedin')
                                        <i class="fab fa-linkedin-in" style="color: white;"></i>
                                    @else
                                        <i class="fas fa-share-alt" style="color: white;"></i>
                                    @endif
                                </a>
                            </li>
                        @endforeach

                        {{-- Fallback social links if no data --}}
                        @if (empty($sectionData['social_links']))
                            <li>
                                <a href="https://facebook.com/londaloans" class="social-link"
                                    style="background-color: #6b3d02; border-color: #6b3d02;"
                                    aria-label="Follow us on Facebook" target="_blank" rel="noopener noreferrer">
                                    <i class="fab fa-facebook-f" style="color: white;"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://twitter.com/londaloans" class="social-link"
                                    style="background-color: #f5a623; border-color: #f5a623;"
                                    aria-label="Follow us on Twitter" target="_blank" rel="noopener noreferrer">
                                    <i class="fab fa-twitter" style="color: white;"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://linkedin.com/company/londaloans" class="social-link"
                                    style="background-color: #6b3d02; border-color: #6b3d02;"
                                    aria-label="Follow us on LinkedIn" target="_blank" rel="noopener noreferrer">
                                    <i class="fab fa-linkedin-in" style="color: white;"></i>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="contact-form">
                <form id="loanApplicationForm">
                    @csrf
                    <div id="formMessage" class="form-message" style="display: none;"></div>

                    <div class="form-grid">
                        <div class="form-group">
                            <label for="fullname">Full Name</label>
                            <input type="text" name="fullname" id="fullname" placeholder="Your full name"
                                required class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" name="email" id="email" placeholder="your.email@example.com"
                                required class="form-control">
                        </div>
                    </div>
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" name="phone" id="phone" placeholder="" {{-- pattern="[0-9]{10,}"  --}}
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="business">Business Type</label>
                            <select name="business" id="business" class="form-control" required>
                                <option value="" disabled selected>Select your business type</option>
                                @foreach ($sectionData['form_options']['business_types'] ?? [] as $businessType)
                                    <option value="{{ Str::slug($businessType) }}">{{ $businessType }}</option>
                                @endforeach
                                @if (empty($sectionData['form_options']['business_types']))
                                    <option value="marketing-agency">Marketing Agency</option>
                                    <option value="ecommerce">E-commerce Business</option>
                                    <option value="content-creator">Content Creator</option>
                                    <option value="consulting">Consulting Business</option>
                                    <option value="other">Other</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="loan-amount">Desired Loan Amount</label>
                            <select name="loan_amount" id="loan-amount" class="form-control" required>
                                <option value="" disabled selected>Select amount range</option>
                                @foreach ($sectionData['form_options']['loan_amounts'] ?? [] as $loanAmount)
                                    <option value="{{ Str::slug($loanAmount) }}">{{ $loanAmount }}</option>
                                @endforeach
                                @if (empty($sectionData['form_options']['loan_amounts']))
                                    <option value="5k-25k">$5,000 - $25,000</option>
                                    <option value="25k-75k">$25,000 - $75,000</option>
                                    <option value="75k-150k">$75,000 - $150,000</option>
                                    <option value="150k-plus">$150,000+</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="purpose">Loan Purpose</label>
                            <select name="purpose" id="purpose" class="form-control" required>
                                <option value="" disabled selected>Select purpose</option>
                                @foreach ($sectionData['form_options']['loan_purposes'] ?? [] as $purpose)
                                    <option value="{{ Str::slug($purpose) }}">{{ $purpose }}</option>
                                @endforeach
                                @if (empty($sectionData['form_options']['loan_purposes']))
                                    <option value="marketing-campaign">Marketing Campaign</option>
                                    <option value="business-expansion">Business Expansion</option>
                                    <option value="equipment">Equipment Purchase</option>
                                    <option value="working-capital">Working Capital</option>
                                    <option value="other">Other</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message">Tell us about your project</label>
                        <textarea placeholder="Describe your business and how you plan to use the loan..." rows="5" name="message"
                            id="message" class="form-control"></textarea>
                    </div>
                    <div class="form-submit">
                        <button type="submit" class="submit-btn" id="submitBtn"
                            aria-label="Submit loan application">
                            {{ $sectionData['form_config']['submit_text'] ?? 'Submit Application' }}
                        </button>
                        <p class="form-note">
                            {{ $sectionData['form_config']['note'] ?? 'One of our loan specialists will contact you within 24 hours to discuss your application.' }}
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('loanApplicationForm');
        const submitBtn = document.getElementById('submitBtn');
        const formMessage = document.getElementById('formMessage');

        form.addEventListener('submit', async function(e) {
            e.preventDefault();

            // Get form data
            const formData = new FormData(form);
            const data = Object.fromEntries(formData.entries());

            // Validate required fields
            if (!data.fullname || !data.email || !data.business || !data.loan_amount || !data
                .purpose) {
                showMessage('Please fill in all required fields.', 'error');
                return;
            }

            // Validate email format
            if (!isValidEmail(data.email)) {
                showMessage('Please enter a valid email address.', 'error');
                return;
            }

            // Show loading state
            setLoadingState(true);

            try {
                const response = await fetch('/notifications/loan-application', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();

                if (response.ok && result.success) {
                    showMessage(result.message ||
                        'Application submitted successfully! We will contact you soon.',
                        'success');
                    form.reset(); 
                } else {
                    showMessage(result.message || 'Failed to submit application. Please try again.',
                        'error');
                }
            } catch (error) {
                console.error('Error submitting application:', error);
                showMessage('An error occurred. Please try again later.', 'error');
            } finally {
                setLoadingState(false);
            }
        });

        function showMessage(message, type) {
            formMessage.textContent = message;
            formMessage.className = `form-message ${type}`;
            formMessage.style.display = 'block';

            // Auto-hide success messages after 5 seconds
            if (type === 'success') {
                setTimeout(() => {
                    formMessage.style.display = 'none';
                }, 5000);
            }
        }

        function setLoadingState(loading) {
            if (loading) {
                submitBtn.disabled = true;
                submitBtn.classList.add('loading');
                submitBtn.innerHTML = 'Submitting...';
            } else {
                submitBtn.disabled = false;
                submitBtn.classList.remove('loading');
                submitBtn.innerHTML =
                    '{{ $sectionData['form_config']['submit_text'] ?? 'Submit Application' }}';
            }
        }

        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        // Phone number formatting
        const phoneInput = document.getElementById('phone');
        if (phoneInput) {
            phoneInput.addEventListener('input', function(e) {
                const value = e.target.value.replace(/\D/g, '');
                if (value.length <= 10) {
                    e.target.value = formatPhoneNumber(value);
                }
            });
        }

        function formatPhoneNumber(phoneNumber) {
            const cleaned = ('' + phoneNumber).replace(/\D/g, '');
            const match = cleaned.match(/^(\d{3})(\d{3})(\d{4})$/);
            if (match) {
                return '(' + match[1] + ') ' + match[2] + '-' + match[3];
            }
            return phoneNumber;
        }
    });
</script>
