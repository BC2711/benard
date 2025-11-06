<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Campaign Expansion Loan - Marketeer Loans' }}</title>
    <!-- Laravel Asset Helper for static files -->
    <script defer src="{{ asset('assets/js/tailwind.js') }}"></script>
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />

    <!-- Include Alpine.js for x-data functionality -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #7a4603;
            --secondary-color: #db9123;
            --light-bg: #f8f5f0;
            --text-dark: #333;
            --text-light: #666;
            --white: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
            background-color: var(--light-bg);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        /* Header Styles */
        .service-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: var(--white);
            padding: 4rem 0;
            position: relative;
            overflow: hidden;
        }

        .service-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
            opacity: 0.1;
        }

        .breadcrumb {
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }

        .breadcrumb a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: color 0.3s;
        }

        .breadcrumb a:hover {
            color: var(--white);
        }

        .service-title {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .service-subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
            margin-bottom: 1.5rem;
            max-width: 700px;
        }

        .service-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .meta-item i {
            font-style: normal;
            background: rgba(255, 255, 255, 0.2);
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .header-cta {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }

        /* Content Styles */
        .service-content {
            padding: 4rem 0;
            background-color: var(--white);
        }

        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 3rem;
        }

        @media (max-width: 768px) {
            .content-grid {
                grid-template-columns: 1fr;
            }
        }

        .main-content h2 {
            color: var(--primary-color);
            margin: 2rem 0 1rem;
            font-size: 1.75rem;
        }

        .main-content h3 {
            color: var(--secondary-color);
            margin: 1.5rem 0 0.75rem;
            font-size: 1.3rem;
        }

        .main-content p {
            margin-bottom: 1rem;
            color: var(--text-light);
        }

        .highlight-box {
            background-color: var(--light-bg);
            border-left: 4px solid var(--secondary-color);
            padding: 1.5rem;
            margin: 1.5rem 0;
            border-radius: 0 4px 4px 0;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
            margin: 2rem 0;
        }

        @media (max-width: 600px) {
            .features-grid {
                grid-template-columns: 1fr;
            }
        }

        .feature-item {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
        }

        .feature-icon {
            width: 50px;
            height: 50px;
            background-color: var(--secondary-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .feature-icon img {
            width: 24px;
            height: 24px;
            filter: brightness(0) invert(1);
        }

        .feature-content h4 {
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .feature-content p {
            font-size: 0.9rem;
        }

        .use-cases {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin: 2rem 0;
        }

        .use-case {
            background-color: var(--light-bg);
            padding: 1.5rem;
            border-radius: 8px;
            border-top: 4px solid var(--primary-color);
        }

        .use-case h4 {
            color: var(--primary-color);
            margin-bottom: 0.75rem;
        }

        /* Sidebar Styles */
        .sidebar {
            background-color: var(--light-bg);
            padding: 2rem;
            border-radius: 8px;
            height: fit-content;
            position: sticky;
            top: 2rem;
        }

        .sidebar-section {
            margin-bottom: 2rem;
        }

        .sidebar-section:last-child {
            margin-bottom: 0;
        }

        .sidebar-section h3 {
            color: var(--primary-color);
            margin-bottom: 1rem;
            font-size: 1.2rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid rgba(122, 70, 3, 0.2);
        }

        .loan-details {
            list-style: none;
        }

        .loan-details li {
            display: flex;
            justify-content: space-between;
            padding: 0.75rem 0;
            border-bottom: 1px solid rgba(122, 70, 3, 0.1);
        }

        .loan-details li:last-child {
            border-bottom: none;
        }

        .detail-label {
            color: var(--text-light);
        }

        .detail-value {
            font-weight: bold;
            color: var(--primary-color);
        }

        .eligibility-list {
            list-style: none;
        }

        .eligibility-list li {
            padding: 0.5rem 0;
            display: flex;
            align-items: flex-start;
            gap: 0.5rem;
        }

        .eligibility-list li::before {
            content: "✓";
            color: var(--secondary-color);
            font-weight: bold;
        }

        .testimonial {
            background-color: var(--white);
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            position: relative;
        }

        .testimonial::before {
            content: '"';
            position: absolute;
            top: 10px;
            left: 15px;
            font-size: 3rem;
            color: var(--secondary-color);
            opacity: 0.3;
            line-height: 1;
        }

        .testimonial-text {
            font-style: italic;
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .author-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: var(--secondary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-weight: bold;
            font-size: 1.2rem;
        }

        .author-info h4 {
            color: var(--primary-color);
            margin-bottom: 0.25rem;
        }

        .author-info p {
            font-size: 0.8rem;
            color: var(--text-light);
        }

        .cta-sidebar {
            text-align: center;
            padding: 1.5rem;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: var(--white);
            border-radius: 8px;
        }

        .cta-sidebar h3 {
            color: var(--white);
            margin-bottom: 1rem;
        }

        .cta-sidebar p {
            margin-bottom: 1.5rem;
            opacity: 0.9;
        }

        .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            border-radius: 4px;
            font-weight: bold;
            text-decoration: none;
            transition: all 0.3s;
            text-align: center;
            cursor: pointer;
            border: none;
        }

        .btn-primary {
            background-color: var(--white);
            color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: rgba(255, 255, 255, 0.9);
            transform: translateY(-2px);
        }

        .btn-secondary {
            background-color: var(--secondary-color);
            color: var(--white);
        }

        .btn-secondary:hover {
            background-color: #b3741c;
            transform: translateY(-2px);
        }

        /* Process Section */
        .process-section {
            padding: 3rem 0;
            background-color: var(--light-bg);
        }

        .section-title {
            text-align: center;
            margin-bottom: 2rem;
            color: var(--primary-color);
            font-size: 1.75rem;
        }

        .process-steps {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .process-step {
            background-color: var(--white);
            padding: 1.5rem;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .step-number {
            width: 40px;
            height: 40px;
            background-color: var(--secondary-color);
            color: var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin: 0 auto 1rem;
        }

        .process-step h4 {
            color: var(--primary-color);
            margin-bottom: 0.75rem;
        }

        .process-step p {
            font-size: 0.9rem;
            color: var(--text-light);
        }

        /* FAQ Section */
        .faq-section {
            padding: 4rem 0;
            background-color: var(--white);
        }

        .faq-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .faq-item {
            background-color: var(--light-bg);
            border-radius: 8px;
            overflow: hidden;
        }

        .faq-question {
            padding: 1.5rem;
            background-color: var(--primary-color);
            color: var(--white);
            font-weight: bold;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .faq-answer {
            padding: 1.5rem;
            display: none;
        }

        .faq-item.active .faq-answer {
            display: block;
        }

        /* Related Services */
        .related-services {
            padding: 4rem 0;
            background-color: var(--light-bg);
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        .service-card {
            background-color: var(--white);
            border-top: 4px solid var(--secondary-color);
            border-radius: 8px;
            padding: 1.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s;
        }

        .service-card:hover {
            transform: translateY(-5px);
        }

        .service-card h3 {
            color: var(--primary-color);
            margin-bottom: 0.75rem;
        }

        .service-card p {
            color: var(--text-light);
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }

        .service-card a {
            color: var(--secondary-color);
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s;
        }

        .service-card a:hover {
            color: #b3741c;
        }

        /* Footer CTA */
        .footer-cta {
            padding: 4rem 0;
            text-align: center;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: var(--white);
        }

        .footer-cta h2 {
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .footer-cta p {
            max-width: 600px;
            margin: 0 auto 2rem;
            opacity: 0.9;
        }

        .btn-outline {
            background-color: transparent;
            border: 2px solid var(--white);
            color: var(--white);
            margin-right: 1rem;
        }

        .btn-outline:hover {
            background-color: var(--white);
            color: var(--primary-color);
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

        .fade-in {
            animation: fadeIn 0.6s ease-in;
        }

        .fade-in-up {
            animation: fadeInUp 0.6s ease-in;
        }
    </style>
</head>

<body>
    @include('layouts.website.header')

    <main>
        <!-- Service Header -->
        <header class="service-header fade-in">
            <div class="container">
                <div class="breadcrumb">
                    <a href="services.html">Our Services</a> &gt; <span>Campaign Expansion Loan</span>
                </div>
                <h1 class="service-title">Campaign Expansion Loan</h1>
                <p class="service-subtitle">Fuel your marketing campaigns with flexible funding designed to scale your
                    advertising efforts and maximize ROI</p>

                <div class="service-meta">
                    <div class="meta-item">
                        <i>💰</i>
                        <span>Up to $100,000</span>
                    </div>
                    <div class="meta-item">
                        <i>⏱️</i>
                        <span>6-36 Month Terms</span>
                    </div>
                    <div class="meta-item">
                        <i>⚡</i>
                        <span>Funding in 48 Hours</span>
                    </div>
                    <div class="meta-item">
                        <i>📊</i>
                        <span>For Marketing Campaigns</span>
                    </div>
                </div>

                <div class="header-cta">
                    <a href="#apply" class="btn btn-primary">Apply Now</a>
                    <a href="#details" class="btn btn-outline">Learn More</a>
                </div>
            </div>
        </header>

        <!-- Service Content -->
        <section class="service-content">
            <div class="container">
                <div class="content-grid">
                    <div class="main-content fade-in-up">
                        <h2>Amplify Your Marketing Impact</h2>
                        <p>Our Campaign Expansion Loan is specifically designed for marketers who need immediate capital
                            to
                            scale successful campaigns, test new channels, or capitalize on time-sensitive
                            opportunities.
                            Whether you're running Facebook ads, Google campaigns, or influencer marketing, this loan
                            provides the fuel to accelerate your growth.</p>

                        <div class="highlight-box">
                            <p>"We increased our campaign budget by 300% with a Campaign Expansion Loan, resulting in a
                                5x
                                return on ad spend within the first quarter." - Sarah Johnson, Digital Marketing
                                Director
                            </p>
                        </div>

                        <h2>Key Features & Benefits</h2>

                        <div class="features-grid">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <img src="https://via.placeholder.com/24/ffffff?text=💰" alt="Flexible funding">
                                </div>
                                <div class="feature-content">
                                    <h4>Flexible Funding</h4>
                                    <p>Borrow from $5,000 to $100,000 with terms that match your campaign cycles</p>
                                </div>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <img src="https://via.placeholder.com/24/ffffff?text=⚡" alt="Quick approval">
                                </div>
                                <div class="feature-content">
                                    <h4>Rapid Approval</h4>
                                    <p>Get approved in as little as 24 hours with funding in 48 hours</p>
                                </div>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <img src="https://via.placeholder.com/24/ffffff?text=📈" alt="Performance based">
                                </div>
                                <div class="feature-content">
                                    <h4>Performance-Based</h4>
                                    <p>Terms adapt to your campaign performance and business metrics</p>
                                </div>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <img src="https://via.placeholder.com/24/ffffff?text=🔄" alt="No collateral">
                                </div>
                                <div class="feature-content">
                                    <h4>No Collateral Required</h4>
                                    <p>Unsecured loans based on your marketing track record</p>
                                </div>
                            </div>
                        </div>

                        <h2>Ideal Use Cases</h2>
                        <p>Our Campaign Expansion Loan is perfect for various marketing scenarios:</p>

                        <div class="use-cases">
                            <div class="use-case">
                                <h4>Scale Winning Campaigns</h4>
                                <p>Increase budget for high-performing campaigns to maximize returns before competitors
                                    catch up</p>
                            </div>
                            <div class="use-case">
                                <h4>Test New Channels</h4>
                                <p>Fund experiments with emerging platforms like TikTok, programmatic, or connected TV
                                </p>
                            </div>
                            <div class="use-case">
                                <h4>Seasonal Opportunities</h4>
                                <p>Capitalize on holiday seasons, product launches, or industry events</p>
                            </div>
                            <div class="use-case">
                                <h4>Content Production</h4>
                                <p>Create high-quality video, photography, or other assets for campaigns</p>
                            </div>
                        </div>

                        <h2>How It Works</h2>
                        <p>The application process is streamlined for marketers who need to move quickly:</p>

                        <ol>
                            <li><strong>Apply Online:</strong> Complete our simple application in 10 minutes</li>
                            <li><strong>Submit Campaign Data:</strong> Share performance metrics and campaign plans</li>
                            <li><strong>Get Approved:</strong> Receive a decision within 24 hours</li>
                            <li><strong>Receive Funds:</strong> Access capital in 48 hours or less</li>
                            <li><strong>Execute & Scale:</strong> Deploy funds to your highest-opportunity campaigns
                            </li>
                        </ol>
                    </div>

                    <div class="sidebar fade-in-up">
                        <div class="sidebar-section">
                            <h3>Loan Details</h3>
                            <ul class="loan-details">
                                <li>
                                    <span class="detail-label">Loan Amount</span>
                                    <span class="detail-value">$5,000 - $100,000</span>
                                </li>
                                <li>
                                    <span class="detail-label">Term Length</span>
                                    <span class="detail-value">6 - 36 Months</span>
                                </li>
                                <li>
                                    <span class="detail-label">Interest Rate</span>
                                    <span class="detail-value">7.5% - 12.5%</span>
                                </li>
                                <li>
                                    <span class="detail-label">Monthly Payment</span>
                                    <span class="detail-value">Varies by Amount</span>
                                </li>
                                <li>
                                    <span class="detail-label">Time to Funding</span>
                                    <span class="detail-value">48 Hours</span>
                                </li>
                                <li>
                                    <span class="detail-label">Collateral</span>
                                    <span class="detail-value">Not Required</span>
                                </li>
                            </ul>
                        </div>

                        <div class="sidebar-section">
                            <h3>Eligibility</h3>
                            <ul class="eligibility-list">
                                <li>Minimum 6 months in business</li>
                                <li>Active marketing campaigns with performance data</li>
                                <li>Monthly revenue of $10,000+</li>
                                <li>Good standing with previous lenders (if applicable)</li>
                                <li>US-based business</li>
                            </ul>
                        </div>

                        <div class="sidebar-section">
                            <h3>Client Testimonial</h3>
                            <div class="testimonial">
                                <p class="testimonial-text">The Campaign Expansion Loan allowed us to triple our Google
                                    Ads
                                    budget during peak season. We generated $350,000 in additional revenue that we would
                                    have missed otherwise.</p>
                                <div class="testimonial-author">
                                    <div class="author-avatar">MJ</div>
                                    <div class="author-info">
                                        <h4>Michael Johnson</h4>
                                        <p>E-commerce Marketing Manager</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="sidebar-section">
                            <div class="cta-sidebar">
                                <h3>Ready to Scale Your Campaigns?</h3>
                                <p>Apply now and get a decision within 24 hours</p>
                                <a href="#apply" class="btn btn-primary">Apply Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Process Section -->
        <section class="process-section">
            <div class="container">
                <h2 class="section-title">Simple Application Process</h2>
                <div class="process-steps">
                    <div class="process-step">
                        <div class="step-number">1</div>
                        <h4>Apply Online</h4>
                        <p>Complete our streamlined application in under 10 minutes</p>
                    </div>
                    <div class="process-step">
                        <div class="step-number">2</div>
                        <h4>Submit Documents</h4>
                        <p>Provide basic business information and campaign performance data</p>
                    </div>
                    <div class="process-step">
                        <div class="step-number">3</div>
                        <h4>Get Approved</h4>
                        <p>Receive a decision within 24 hours of application</p>
                    </div>
                    <div class="process-step">
                        <div class="step-number">4</div>
                        <h4>Receive Funds</h4>
                        <p>Access your capital in 48 hours or less</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="faq-section">
            <div class="container">
                <h2 class="section-title">Frequently Asked Questions</h2>
                <div class="faq-grid">
                    <div class="faq-item">
                        <div class="faq-question">
                            <span>What can I use the loan for?</span>
                            <span>+</span>
                        </div>
                        <div class="faq-answer">
                            <p>Campaign Expansion Loans can be used for any marketing-related expenses including ad
                                spend,
                                content creation, agency fees, software tools, and campaign testing.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question">
                            <span>How quickly can I get funded?</span>
                            <span>+</span>
                        </div>
                        <div class="faq-answer">
                            <p>Most applicants receive funding within 48 hours of approval. We prioritize speed because
                                we
                                understand marketing opportunities are often time-sensitive.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question">
                            <span>What documents do I need?</span>
                            <span>+</span>
                        </div>
                        <div class="faq-answer">
                            <p>You'll need basic business information, bank statements, and campaign performance data.
                                We've
                                streamlined the process to require minimal documentation.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question">
                            <span>Is there a prepayment penalty?</span>
                            <span>+</span>
                        </div>
                        <div class="faq-answer">
                            <p>No, you can pay off your loan early without any penalties. We want you to succeed and
                                scale
                                your business.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Related Services -->
        <section class="related-services">
            <div class="container">
                <h2 class="section-title">Other Services You Might Like</h2>
                <div class="services-grid">
                    <div class="service-card">
                        <h3>Business Growth Loan</h3>
                        <p>Long-term financing for expanding your marketing agency or team</p>
                        <a href="business-growth-loan.html">Learn More →</a>
                    </div>
                    <div class="service-card">
                        <h3>Equipment Financing</h3>
                        <p>Fund cameras, computers, and other marketing equipment</p>
                        <a href="equipment-financing.html">Learn More →</a>
                    </div>
                    <div class="service-card">
                        <h3>Working Capital</h3>
                        <p>Bridge cash flow gaps between client payments</p>
                        <a href="working-capital.html">Learn More →</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer CTA -->
        <section class="footer-cta">
            <div class="container">
                <h2>Ready to Scale Your Marketing Campaigns?</h2>
                <p>Join thousands of marketers who have accelerated their growth with our Campaign Expansion Loans</p>
                <a href="#apply" class="btn btn-outline">Apply Now</a>
                <a href="contact.html" class="btn btn-primary">Speak With an Expert</a>
            </div>
        </section>
    </main>

    <!-- Footer -->
    @include('layouts.website.footer')
    <script>
        // Simple animation on scroll
        document.addEventListener('DOMContentLoaded', function() {
            const fadeElements = document.querySelectorAll('.fade-in-up');

            const fadeInOnScroll = function() {
                fadeElements.forEach(element => {
                    const elementTop = element.getBoundingClientRect().top;
                    const elementVisible = 150;

                    if (elementTop < window.innerHeight - elementVisible) {
                        element.style.opacity = "1";
                        element.style.transform = "translateY(0)";
                    }
                });
            };

            // Set initial state
            fadeElements.forEach(element => {
                element.style.opacity = "0";
                element.style.transform = "translateY(20px)";
                element.style.transition = "opacity 0.6s ease, transform 0.6s ease";
            });

            // FAQ toggle functionality
            const faqQuestions = document.querySelectorAll('.faq-question');
            faqQuestions.forEach(question => {
                question.addEventListener('click', () => {
                    const faqItem = question.parentElement;
                    faqItem.classList.toggle('active');
                });
            });

            window.addEventListener('scroll', fadeInOnScroll);
            fadeInOnScroll(); // Check on load
        });
    </script>
</body>

</html>
