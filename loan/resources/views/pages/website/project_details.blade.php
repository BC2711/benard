<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Success Story Details - Marketeer Loans' }}</title>
    <!-- Laravel Asset Helper for static files -->
    <script defer src="{{ asset('assets/js/tailwind.js') }}"></script>
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />

    <!-- Include Alpine.js for x-data functionality -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
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
    .story-header {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: var(--white);
        padding: 4rem 0;
        position: relative;
        overflow: hidden;
    }

    .story-header::before {
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

    .story-title {
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 0.5rem;
    }

    .story-subtitle {
        font-size: 1.2rem;
        opacity: 0.9;
        margin-bottom: 1.5rem;
    }

    .story-meta {
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

    .category-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .category-tag {
        padding: 0.25rem 0.75rem;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 4px;
        font-size: 0.8rem;
    }

    /* Content Styles */
    .story-content {
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

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
        margin: 2rem 0;
    }

    .stat-item {
        text-align: center;
        padding: 1.5rem;
        background-color: var(--light-bg);
        border-radius: 8px;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: bold;
        color: var(--secondary-color);
        display: block;
    }

    .stat-label {
        font-size: 0.9rem;
        color: var(--text-light);
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

    /* Gallery Section */
    .gallery-section {
        padding: 3rem 0;
        background-color: var(--light-bg);
    }

    .section-title {
        text-align: center;
        margin-bottom: 2rem;
        color: var(--primary-color);
        font-size: 1.75rem;
    }

    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1rem;
    }

    .gallery-item {
        border-radius: 8px;
        overflow: hidden;
        height: 200px;
        background-color: var(--white);
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Related Stories */
    .related-stories {
        padding: 4rem 0;
        background-color: var(--white);
    }

    .stories-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
    }

    .story-card {
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: var(--white);
        min-height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 1.5rem;
        position: relative;
    }

    .story-card:hover {
        transform: translateY(-5px);
    }

    .story-card h3 {
        margin-bottom: 0.5rem;
        position: relative;
        z-index: 1;
    }

    .story-card p {
        opacity: 0.9;
        position: relative;
        z-index: 1;
    }

    .story-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(122, 70, 3, 0.9) 0%, rgba(219, 145, 35, 0.9) 100%);
        opacity: 0;
        transition: opacity 0.3s;
    }

    .story-card:hover::before {
        opacity: 1;
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
    <!-- Header -->
    @include('layouts.website.header')
    <main>
        <!-- Story Header -->
        <header class="story-header fade-in">
            <div class="container">
                <div class="breadcrumb">
                    <a href="success-stories.html">Success Stories</a> &gt; <span>Digital Marketing Agency
                        Expansion</span>
                </div>
                <h1 class="story-title">How a $50,000 Loan Helped Scale a Digital Marketing Agency by 300%</h1>
                <p class="story-subtitle">From local boutique to national player in just 18 months</p>

                <div class="story-meta">
                    <div class="meta-item">
                        <i>💼</i>
                        <span>Digital Marketing Agency</span>
                    </div>
                    <div class="meta-item">
                        <i>💰</i>
                        <span>$50,000 Loan</span>
                    </div>
                    <div class="meta-item">
                        <i>📈</i>
                        <span>300% Growth</span>
                    </div>
                    <div class="meta-item">
                        <i>⏱️</i>
                        <span>18 Months</span>
                    </div>
                </div>

                <div class="category-tags">
                    <span class="category-tag">Digital Marketing</span>
                    <span class="category-tag">Agency Growth</span>
                    <span class="category-tag">Team Expansion</span>
                    <span class="category-tag">Client Acquisition</span>
                </div>
            </div>
        </header>

        <!-- Story Content -->
        <section class="story-content">
            <div class="container">
                <div class="content-grid">
                    <div class="main-content fade-in-up">
                        <h2>The Challenge</h2>
                        <p>Marketeer Pro, a digital marketing agency founded by Sarah Johnson, had reached a critical
                            growth
                            plateau. With a solid local client base and proven results, the agency was turning away
                            potential clients due to limited capacity and resources.</p>

                        <p>"We had a waiting list of over 20 qualified leads but couldn't onboard them without expanding
                            our
                            team and technology stack," Sarah explained. "Traditional banks considered us too risky
                            despite
                            our track record."</p>

                        <div class="highlight-box">
                            <p>"The turning point came when we realized our growth was limited not by market demand, but
                                by
                                our operational capacity. We needed capital to bridge that gap."</p>
                        </div>

                        <h2>The Solution</h2>
                        <p>After researching various funding options, Sarah applied for a Marketeer Loan specifically
                            designed for marketing professionals. The $50,000 loan was approved within 72 hours,
                            providing
                            the capital needed to execute their expansion plan.</p>

                        <h3>Strategic Allocation of Funds</h3>
                        <p>The loan was strategically allocated across three key areas:</p>

                        <div class="stats-grid">
                            <div class="stat-item">
                                <span class="stat-value">40%</span>
                                <span class="stat-label">Team Expansion</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-value">35%</span>
                                <span class="stat-label">Technology & Tools</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-value">15%</span>
                                <span class="stat-label">Marketing & Sales</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-value">10%</span>
                                <span class="stat-label">Operational Buffer</span>
                            </div>
                        </div>

                        <h2>The Results</h2>
                        <p>Within 18 months of receiving the loan, Marketeer Pro achieved remarkable growth:</p>

                        <ul>
                            <li>Increased monthly revenue from $25,000 to $100,000</li>
                            <li>Expanded team from 5 to 15 full-time specialists</li>
                            <li>Grew client base from 12 to 45 active accounts</li>
                            <li>Extended service offerings to include advanced analytics and marketing automation</li>
                            <li>Opened a second office in a major metropolitan area</li>
                        </ul>

                        <h2>Key Takeaways</h2>
                        <p>Sarah's experience offers valuable insights for other marketing professionals considering
                            growth
                            financing:</p>

                        <div class="highlight-box">
                            <p>"The loan wasn't just about money—it was about timing. Having access to capital when we
                                needed it most allowed us to capture market opportunities that would have otherwise
                                passed
                                us by."</p>
                        </div>

                        <p>She emphasizes the importance of having a clear growth plan before seeking funding: "We knew
                            exactly how we would use every dollar before we applied. This gave us confidence and showed
                            lenders we were a serious investment."</p>
                    </div>

                    <div class="sidebar fade-in-up">
                        <div class="sidebar-section">
                            <h3>Loan Details</h3>
                            <ul class="loan-details">
                                <li>
                                    <span class="detail-label">Loan Amount</span>
                                    <span class="detail-value">$50,000</span>
                                </li>
                                <li>
                                    <span class="detail-label">Term</span>
                                    <span class="detail-value">24 Months</span>
                                </li>
                                <li>
                                    <span class="detail-label">Interest Rate</span>
                                    <span class="detail-value">8.5%</span>
                                </li>
                                <li>
                                    <span class="detail-label">Monthly Payment</span>
                                    <span class="detail-value">$2,265</span>
                                </li>
                                <li>
                                    <span class="detail-label">Time to Funding</span>
                                    <span class="detail-value">3 Days</span>
                                </li>
                            </ul>
                        </div>

                        <div class="sidebar-section">
                            <h3>Client Testimonial</h3>
                            <div class="testimonial">
                                <p class="testimonial-text">The Marketeer Loan came at exactly the right time for our
                                    business. The application process was straightforward, and the funds allowed us to
                                    scale
                                    in ways we never thought possible in such a short timeframe.</p>
                                <div class="testimonial-author">
                                    <div class="author-avatar">SJ</div>
                                    <div class="author-info">
                                        <h4>Sarah Johnson</h4>
                                        <p>Founder & CEO, Marketeer Pro</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="sidebar-section">
                            <div class="cta-sidebar">
                                <h3>Ready to Grow Your Business?</h3>
                                <p>See if you qualify for a Marketeer Loan in minutes</p>
                                <a href="#apply" class="btn btn-primary">Apply Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Gallery Section -->
        <section class="gallery-section">
            <div class="container">
                <h2 class="section-title">Growth in Action</h2>
                <div class="gallery-grid">
                    <div class="gallery-item">
                        <img src="https://via.placeholder.com/300x200/7a4603/ffffff?text=Team+Expansion"
                            alt="Team expansion">
                    </div>
                    <div class="gallery-item">
                        <img src="https://via.placeholder.com/300x200/db9123/ffffff?text=New+Office"
                            alt="New office space">
                    </div>
                    <div class="gallery-item">
                        <img src="https://via.placeholder.com/300x200/7a4603/ffffff?text=Client+Presentation"
                            alt="Client presentation">
                    </div>
                    <div class="gallery-item">
                        <img src="https://via.placeholder.com/300x200/db9123/ffffff?text=Campaign+Results"
                            alt="Campaign results">
                    </div>
                </div>
            </div>
        </section>

        <!-- Related Stories -->
        <section class="related-stories">
            <div class="container">
                <h2 class="section-title">More Success Stories</h2>
                <div class="stories-grid">
                    <a href="story-2.html" class="story-card">
                        <div>
                            <h3>E-commerce Brand Launch</h3>
                            <p>How a $25,000 loan helped launch a successful DTC beauty brand</p>
                        </div>
                    </a>
                    <a href="story-3.html" class="story-card">
                        <div>
                            <h3>Content Studio Expansion</h3>
                            <p>Scaling a boutique content agency to serve enterprise clients</p>
                        </div>
                    </a>
                    <a href="story-4.html" class="story-card">
                        <div>
                            <h3>Marketing Tech Investment</h3>
                            <p>Leveraging AI tools to 3x campaign performance</p>
                        </div>
                    </a>
                </div>
            </div>
        </section>

        <!-- Footer CTA -->
        {{-- <section class="footer-cta">
        <div class="container">
            <h2>Start Your Success Story</h2>
            <p>Join hundreds of marketeers who have transformed their businesses with our tailored loan solutions</p>
            <a href="#apply" class="btn btn-outline">Apply for Funding</a>
            <a href="success-stories.html" class="btn btn-primary">View All Stories</a>
        </div>
    </section> --}}
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

            window.addEventListener('scroll', fadeInOnScroll);
            fadeInOnScroll(); // Check on load
        });
    </script>
</body>

</html>
