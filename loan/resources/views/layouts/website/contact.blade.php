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
        /* background-color: #427c0c */
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
        background-color: #f5a623;
        padding: 1rem;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: transform 0.3s ease;
    }

    .contact-icon.location {
        background-color: #6b3d02;
    }

    .contact-icon.phone {
        background-color: #f5a623;
    }

    .contact-icon.hours {
        background-color: #6b3d02;
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
        border: 2px solid #6b3d02;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .social-link.facebook {
        background-color: #6b3d02;
        border-color: #6b3d02;
    }

    .social-link.twitter {
        background-color: #f5a623;
        border-color: #f5a623;
    }

    .social-link.linkedin {
        background-color: #6b3d02;
        border-color: #6b3d02;
    }

    .social-link:hover {
        background-color: transparent;
        transform: scale(1.1);
    }

    .social-link.facebook:hover svg' %} {
        fill: #6b3d02;
    }

    .social-link.twitter:hover svg' %} {
        fill: #f5a623;
    }

    .social-link.linkedin:hover svg' %} {
        fill: #6b3d02;
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
        <h2>Get Started with Your Loan Application</h2>
        <p>Ready to fund your next marketing success? Our team is here to help you navigate the loan process and find
            the perfect financing solution for your business.</p>
    </div>

    <!-- Contact Information and Form -->
    <div class="content-container">
        <div class="content-grid">
            <!-- Contact Information -->
            <div class="contact-info">
                <div class="contact-list">
                    <div class="contact-item">
                        <div class="contact-icon">
                           <i class="fas fa-envelope"></i>
                            {{-- <img src="{{ asset('assets/images/icon-email.svg') }}" alt="Email icon" width="24" height="24"> --}}
                        </div>
                        <div>
                            <h3>Email Address</h3>
                            <p><a href="mailto:loans@londaloans.com"
                                    aria-label="Email loans@londaloans.com">loans@londaloans.com</a></p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon location">
                            <i class="fas fa-building"></i>
                            {{-- <img src="{{ asset('assets/images/icon-location.svg') }}" alt="Location icon" width="24" height="24"> --}}
                        </div>
                        <div>
                            <h3>Office Location</h3>
                            <p>123 Marketing District<br>San Francisco, CA 94105</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon phone">
                            <i class="fas fa-phone"></i>
                            {{-- <img src="{{ asset('assets/images/icon-phone.svg') }}" alt="Phone icon" width="24" height="24"> --}}
                        </div>
                        <div>
                            <h3>Phone Number</h3>
                            <p><a href="tel:+18005551234" aria-label="Call +1 (800) 555-1234">+1 (800) 555-1234</a></p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon hours">
                            <i class="fas fa-clock"></i>
                            {{-- <img src="{{ asset('assets/images/icon-clock.svg') }}" alt="Hours icon" width="24" height="24"> --}}
                        </div>
                        <div>
                            <h3>Business Hours</h3>
                            <p>Mon-Fri: 8AM-6PM PST<br>Sat: 9AM-2PM PST</p>
                        </div>
                    </div>
                </div>
                <hr class="contact-divider">
                <div class="social-section">
                    <h3>Follow Us</h3>
                    <ul class="social-links">
                        <li>
                            <a href="https://facebook.com/londaloans" class="social-link facebook"
                                aria-label="Follow us on Facebook">
                                <svg width="11" height="20" fill="white" viewBox="0 0 11 20"
                                    xmlns="http://www.w3.org/2000/svg'">
                                    <path
                                        d="M6.83366 11.3752H9.12533L10.042 7.7085H6.83366V5.87516C6.83366 4.931 6.83366 4.04183 8.667 4.04183H10.042V0.96183C9.74316 0.922413 8.61475 0.833496 7.42308 0.833496C4.93433 0.833496 3.16699 2.35241 3.16699 5.14183V7.7085H0.416992V11.3752H3.16699V19.1668H6.83366V11.3752Z" />
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="https://twitter.com/londaloans" class="social-link twitter"
                                aria-label="Follow us on Twitter">
                                <svg width="20" height="16" fill="white" viewBox="0 0 20 16"
                                    xmlns="http://www.w3.org/2000/svg'">
                                    <path
                                        d="M19.3153 2.18484C18.6155 2.4944 17.8733 2.6977 17.1134 2.78801C17.9144 2.30899 18.5138 1.55511 18.8001 0.666844C18.0484 1.11418 17.2244 1.42768 16.3654 1.59726C15.7885 0.979958 15.0238 0.57056 14.1901 0.432713C13.3565 0.294866 12.5007 0.436294 11.7558 0.835009C11.0108 1.23372 10.4185 1.86739 10.0708 2.63749C9.72313 3.40759 9.63963 4.27098 9.83327 5.09343C8.30896 5.01703 6.81775 4.62091 5.45645 3.93079C4.09516 3.24067 2.89423 2.27197 1.93161 1.08759C1.59088 1.67284 1.41182 2.33814 1.41278 3.01534C1.41278 4.34451 2.08928 5.51876 3.11778 6.20626C2.50912 6.1871 1.91386 6.02273 1.38161 5.72685V5.77451C1.38179 6.65974 1.68811 7.51766 2.24864 8.20282C2.80916 8.88797 3.58938 9.3582 4.45703 9.53376C3.89201 9.68688 3.29956 9.70945 2.72453 9.59976C2.96915 10.3617 3.44595 11.0281 4.08815 11.5056C4.73035 11.9831 5.50581 12.2478 6.30594 12.2627C5.51072 12.8872 4.60019 13.3489 3.62642 13.6213C2.65264 13.8938 1.63473 13.9716 0.630859 13.8503C2.38325 14.9773 4.4232 15.5756 6.50669 15.5737C13.5586 15.5737 17.415 9.73176 17.415 4.66535C17.415 4.50035 17.4104 4.33351 17.4031 4.17035C18.1537 3.62783 18.8016 2.95578 19.3162 2.18576L19.3153 2.18484Z" />
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="https://linkedin.com/company/londaloans" class="social-link linkedin"
                                aria-label="Follow us on LinkedIn">
                                <svg width="19" height="18" fill="white" viewBox="0 0 19 18"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M4.36198 2.58327C4.36174 3.0695 4.16835 3.53572 3.82436 3.87937C3.48037 4.22301 3.01396 4.41593 2.52773 4.41569C2.0415 4.41545 1.57528 4.22206 1.23164 3.87807C0.887991 3.53408 0.69507 3.06767 0.695313 2.58144C0.695556 2.09521 0.888943 1.62899 1.23293 1.28535C1.57692 0.941701 2.04333 0.748781 2.52956 0.749024C3.01579 0.749267 3.48201 0.942654 3.82566 1.28664C4.1693 1.63063 4.36222 2.09704 4.36198 2.58327ZM4.41698 5.77327H0.750313V17.2499H4.41698V5.77327ZM10.2103 5.77327H6.56198V17.2499H10.1736V11.2274C10.1736 7.87244 14.5461 7.56077 14.5461 11.2274V17.2499H18.167V9.98077C18.167 4.32494 11.6953 4.53577 10.1736 7.31327L10.2103 5.77327Z" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="contact-form">
                <form action="/submit-application" method="POST">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="fullname">Full Name</label>
                            <input type="text" name="fullname" id="fullname" placeholder="Your full name" required
                                class="form-control">
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
                            <input type="tel" name="phone" id="phone" placeholder="+1 (555) 000-0000"
                                pattern="[0-9]{10,}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="business">Business Type</label>
                            <select name="business" id="business" class="form-control" required>
                                <option value="" disabled selected>Select your business type</option>
                                <option value="marketing-agency">Marketing Agency</option>
                                <option value="ecommerce">E-commerce Business</option>
                                <option value="content-creator">Content Creator</option>
                                <option value="consulting">Consulting Business</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="loan-amount">Desired Loan Amount</label>
                            <select name="loan-amount" id="loan-amount" class="form-control" required>
                                <option value="" disabled selected>Select amount range</option>
                                <option value="5k-25k">$5,000 - $25,000</option>
                                <option value="25k-75k">$25,000 - $75,000</option>
                                <option value="75k-150k">$75,000 - $150,000</option>
                                <option value="150k-plus">$150,000+</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="purpose">Loan Purpose</label>
                            <select name="purpose" id="purpose" class="form-control" required>
                                <option value="" disabled selected>Select purpose</option>
                                <option value="marketing-campaign">Marketing Campaign</option>
                                <option value="business-expansion">Business Expansion</option>
                                <option value="equipment">Equipment Purchase</option>
                                <option value="working-capital">Working Capital</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message">Tell us about your project</label>
                        <textarea placeholder="Describe your business and how you plan to use the loan..." rows="5" name="message"
                            id="message" class="form-control"></textarea>
                    </div>
                    <div class="form-submit">
                        <button type="submit" class="submit-btn" aria-label="Submit loan application">Submit
                            Application</button>
                        <p class="form-note">One of our loan specialists will contact you within 24 hours to discuss
                            your application.</p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
