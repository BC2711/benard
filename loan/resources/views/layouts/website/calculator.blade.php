<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Calculator | Londa Loans</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        :root {
            --primary: #db9123;
            --primary-dark: #7a4603;
            --secondary: #2d3748;
            --light: #f8f5f0;
            --white: #ffffff;
            --gray: #718096;
            --success: #38a169;
            --shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            --radius: 12px;
        }

        body {
            background-color: var(--light);
            color: var(--secondary);
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header Styles */
        header {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: var(--white);
            padding: 1.5rem 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: var(--white);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-weight: bold;
            font-size: 1.2rem;
        }

        .logo-text {
            font-size: 1.5rem;
            font-weight: 700;
        }

        .logo-text span {
            color: #a3e635;
        }

        nav ul {
            display: flex;
            list-style: none;
            gap: 2rem;
        }

        nav a {
            color: var(--white);
            text-decoration: none;
            font-weight: 500;
            transition: opacity 0.3s;
        }

        nav a:hover {
            opacity: 0.8;
        }

        /* Hero Section */
        .hero {
            padding: 3rem 0;
            text-align: center;
            background: var(--white);
            margin-bottom: 2rem;
            border-radius: 0 0 var(--radius) var(--radius);
            box-shadow: var(--shadow);
        }

        .hero h1 {
            font-size: 2.5rem;
            color: var(--primary-dark);
            margin-bottom: 1rem;
        }

        .hero p {
            font-size: 1.2rem;
            color: var(--gray);
            max-width: 700px;
            margin: 0 auto;
        }

        /* Main Calculator Section */
        .calculator-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            margin-bottom: 4rem;
        }

        @media (max-width: 968px) {
            .calculator-section {
                grid-template-columns: 1fr;
            }
        }

        /* Calculator Card */
        .calculator-card {
            background: var(--white);
            border-radius: var(--radius);
            padding: 2rem;
            box-shadow: var(--shadow);
        }

        .card-header {
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e2e8f0;
        }

        .card-header h2 {
            color: var(--primary-dark);
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-header i {
            color: var(--primary);
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--secondary);
        }

        .input-with-icon {
            position: relative;
        }

        .input-with-icon i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
        }

        .input-with-icon input,
        .input-with-icon select {
            width: 100%;
            padding: 12px 15px 12px 45px;
            border: 1px solid #cbd5e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s;
        }

        .input-with-icon input:focus,
        .input-with-icon select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(219, 145, 35, 0.2);
        }

        .range-container {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .range-container input[type="range"] {
            flex: 1;
            height: 6px;
            -webkit-appearance: none;
            background: #e2e8f0;
            border-radius: 5px;
            outline: none;
        }

        .range-container input[type="range"]::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 20px;
            height: 20px;
            background: var(--primary);
            border-radius: 50%;
            cursor: pointer;
        }

        .range-value {
            min-width: 80px;
            padding: 8px 12px;
            background: #edf2f7;
            border-radius: 6px;
            text-align: center;
            font-weight: 600;
        }

        .btn-calculate {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: var(--white);
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-calculate:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(219, 145, 35, 0.4);
        }

        /* Results Card */
        .results-card {
            background: var(--white);
            border-radius: var(--radius);
            padding: 2rem;
            box-shadow: var(--shadow);
            height: fit-content;
        }

        .results-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e2e8f0;
        }

        .results-header h2 {
            color: var(--primary-dark);
            font-size: 1.5rem;
        }

        .reset-btn {
            background: #edf2f7;
            border: none;
            padding: 8px 15px;
            border-radius: 6px;
            color: var(--secondary);
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 5px;
            transition: all 0.3s;
        }

        .reset-btn:hover {
            background: #e2e8f0;
        }

        .result-item {
            display: flex;
            justify-content: space-between;
            padding: 1rem 0;
            border-bottom: 1px solid #f1f1f1;
        }

        .result-item:last-child {
            border-bottom: none;
        }

        .result-label {
            color: var(--gray);
        }

        .result-value {
            font-weight: 700;
            color: var(--secondary);
        }

        .monthly-payment {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: var(--white);
            padding: 1.5rem;
            border-radius: var(--radius);
            text-align: center;
            margin: 2rem 0;
        }

        .payment-amount {
            font-size: 2.5rem;
            font-weight: 700;
            margin: 0.5rem 0;
        }

        .payment-label {
            font-size: 1rem;
            opacity: 0.9;
        }

        .amortization-chart {
            margin-top: 2rem;
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .chart-bar {
            height: 10px;
            background: #e2e8f0;
            border-radius: 5px;
            margin-bottom: 1.5rem;
            overflow: hidden;
        }

        .chart-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--primary), var(--primary-dark));
            border-radius: 5px;
            width: 65%;
            /* This would be dynamic in a real app */
        }

        .chart-labels {
            display: flex;
            justify-content: space-between;
            font-size: 0.9rem;
            color: var(--gray);
        }

        /* Loan Types Section */
        .loan-types {
            margin-bottom: 4rem;
        }

        .section-title {
            text-align: center;
            margin-bottom: 2rem;
        }

        .section-title h2 {
            color: var(--primary-dark);
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .section-title p {
            color: var(--gray);
            max-width: 600px;
            margin: 0 auto;
        }

        .loan-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }

        .loan-card {
            background: var(--white);
            border-radius: var(--radius);
            padding: 2rem;
            box-shadow: var(--shadow);
            transition: transform 0.3s;
            text-align: center;
        }

        .loan-card:hover {
            transform: translateY(-5px);
        }

        .loan-icon {
            width: 70px;
            height: 70px;
            background: rgba(219, 145, 35, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: var(--primary);
            font-size: 1.8rem;
        }

        .loan-card h3 {
            color: var(--primary-dark);
            margin-bottom: 1rem;
        }

        .loan-card p {
            color: var(--gray);
            margin-bottom: 1.5rem;
        }

        .loan-features {
            list-style: none;
            text-align: left;
            margin-bottom: 1.5rem;
        }

        .loan-features li {
            padding: 0.5rem 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .loan-features i {
            color: var(--success);
        }

        .loan-btn {
            display: inline-block;
            padding: 10px 20px;
            background: var(--primary);
            color: var(--white);
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .loan-btn:hover {
            background: var(--primary-dark);
        }

        /* FAQ Section */
        .faq-section {
            margin-bottom: 4rem;
        }

        .faq-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .faq-item {
            background: var(--white);
            border-radius: var(--radius);
            margin-bottom: 1rem;
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .faq-question {
            padding: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            font-weight: 600;
        }

        .faq-answer {
            padding: 0 1.5rem;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease, padding 0.3s ease;
        }

        .faq-answer.active {
            padding: 0 1.5rem 1.5rem;
            max-height: 500px;
        }

        .faq-toggle {
            color: var(--primary);
            transition: transform 0.3s;
        }

        .faq-item.active .faq-toggle {
            transform: rotate(180deg);
        }

        /* CTA Section */
        .cta-section {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: var(--white);
            padding: 4rem 0;
            text-align: center;
            border-radius: var(--radius);
            margin-bottom: 4rem;
        }

        .cta-content {
            max-width: 700px;
            margin: 0 auto;
        }

        .cta-content h2 {
            font-size: 2.2rem;
            margin-bottom: 1rem;
        }

        .cta-content p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        .cta-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-primary {
            padding: 12px 30px;
            background: var(--white);
            color: var(--primary);
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-secondary {
            padding: 12px 30px;
            background: transparent;
            color: var(--white);
            border: 2px solid var(--white);
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        /* Footer */
        footer {
            background: var(--secondary);
            color: var(--white);
            padding: 3rem 0 1.5rem;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .footer-column h3 {
            margin-bottom: 1.5rem;
            font-size: 1.2rem;
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 0.8rem;
        }

        .footer-links a {
            color: #a0aec0;
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-links a:hover {
            color: var(--white);
        }

        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .social-links a {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            text-decoration: none;
            transition: all 0.3s;
        }

        .social-links a:hover {
            background: var(--primary);
            transform: translateY(-3px);
        }

        .footer-bottom {
            text-align: center;
            padding-top: 1.5rem;
            border-top: 1px solid #4a5568;
            color: #a0aec0;
            font-size: 0.9rem;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                gap: 1rem;
            }

            nav ul {
                gap: 1.5rem;
            }

            .hero h1 {
                font-size: 2rem;
            }

            .calculator-card,
            .results-card {
                padding: 1.5rem;
            }

            .payment-amount {
                font-size: 2rem;
            }

            .cta-content h2 {
                font-size: 1.8rem;
            }
        }

        @media (max-width: 480px) {
            .hero {
                padding: 2rem 0;
            }

            .hero h1 {
                font-size: 1.8rem;
            }

            .range-container {
                flex-direction: column;
                align-items: stretch;
                gap: 10px;
            }

            .range-value {
                text-align: center;
            }

            .cta-buttons {
                flex-direction: column;
                align-items: center;
            }

            .btn-primary,
            .btn-secondary {
                width: 100%;
                max-width: 250px;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header>
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <div class="logo-icon">LL</div>
                    <div class="logo-text">Londa<span>Loans</span></div>
                </div>
                <nav>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Loans</a></li>
                        <li><a href="#" class="active">Calculator</a></li>
                        <li><a href="#">About</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1>Loan Calculator</h1>
            <p>Calculate your monthly payments, total interest, and see how different loan terms affect your budget</p>
        </div>
    </section>

    <!-- Main Calculator Section -->
    <div class="container">
        <section class="calculator-section">
            <!-- Calculator Form -->
            <div class="calculator-card">
                <div class="card-header">
                    <h2><i class="fas fa-calculator"></i> Loan Details</h2>
                </div>
                <form id="loan-form">
                    <div class="form-group">
                        <label for="loan-amount">Loan Amount</label>
                        <div class="input-with-icon">
                            <i class="fas fa-dollar-sign"></i>
                            <input type="number" id="loan-amount" placeholder="10,000" min="100" max="1000000"
                                value="15000">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="interest-rate">Interest Rate (%)</label>
                        <div class="input-with-icon">
                            <i class="fas fa-percent"></i>
                            <input type="number" id="interest-rate" placeholder="5.5" min="0.1" max="30"
                                step="0.1" value="7.5">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="loan-term">Loan Term (Years)</label>
                        <div class="range-container">
                            <input type="range" id="loan-term" min="1" max="30" value="5">
                            <div class="range-value" id="term-value">5 years</div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="loan-type">Loan Type</label>
                        <div class="input-with-icon">
                            <i class="fas fa-hand-holding-usd"></i>
                            <select id="loan-type">
                                <option value="personal">Personal Loan</option>
                                <option value="business">Business Loan</option>
                                <option value="mortgage">Mortgage</option>
                                <option value="auto">Auto Loan</option>
                            </select>
                        </div>
                    </div>

                    <button type="button" id="calculate-btn" class="btn-calculate">
                        <i class="fas fa-calculator"></i> Calculate Loan
                    </button>
                </form>
            </div>

            <!-- Results Card -->
            <div class="results-card">
                <div class="results-header">
                    <h2>Loan Summary</h2>
                    <button class="reset-btn" id="reset-btn">
                        <i class="fas fa-redo"></i> Reset
                    </button>
                </div>

                <div class="monthly-payment">
                    <div class="payment-label">Estimated Monthly Payment</div>
                    <div class="payment-amount" id="monthly-payment">$301.00</div>
                    <div class="payment-note">For 5 years at 7.5% interest</div>
                </div>

                <div class="result-item">
                    <div class="result-label">Total Principal</div>
                    <div class="result-value" id="total-principal">$15,000.00</div>
                </div>

                <div class="result-item">
                    <div class="result-label">Total Interest</div>
                    <div class="result-value" id="total-interest">$3,060.00</div>
                </div>

                <div class="result-item">
                    <div class="result-label">Total Payment</div>
                    <div class="result-value" id="total-payment">$18,060.00</div>
                </div>

                <div class="result-item">
                    <div class="result-label">Payoff Date</div>
                    <div class="result-value" id="payoff-date">May 2028</div>
                </div>

                <div class="amortization-chart">
                    <div class="chart-header">
                        <div>Principal & Interest</div>
                        <div>100%</div>
                    </div>
                    <div class="chart-bar">
                        <div class="chart-fill"></div>
                    </div>
                    <div class="chart-labels">
                        <div>Principal: 83%</div>
                        <div>Interest: 17%</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Loan Types Section -->
        <section class="loan-types">
            <div class="section-title">
                <h2>Our Loan Options</h2>
                <p>Choose the loan that best fits your financial needs and goals</p>
            </div>

            <div class="loan-cards">
                <div class="loan-card">
                    <div class="loan-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <h3>Personal Loans</h3>
                    <p>Flexible loans for any personal need with competitive rates</p>
                    <ul class="loan-features">
                        <li><i class="fas fa-check"></i> $1,000 - $50,000</li>
                        <li><i class="fas fa-check"></i> 1-7 year terms</li>
                        <li><i class="fas fa-check"></i> Fixed monthly payments</li>
                        <li><i class="fas fa-check"></i> No collateral required</li>
                    </ul>
                    <a href="#" class="loan-btn">Learn More</a>
                </div>

                <div class="loan-card">
                    <div class="loan-icon">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <h3>Business Loans</h3>
                    <p>Fuel your business growth with our tailored financing solutions</p>
                    <ul class="loan-features">
                        <li><i class="fas fa-check"></i> $5,000 - $500,000</li>
                        <li><i class="fas fa-check"></i> 1-10 year terms</li>
                        <li><i class="fas fa-check"></i> Competitive interest rates</li>
                        <li><i class="fas fa-check"></i> Fast approval process</li>
                    </ul>
                    <a href="#" class="loan-btn">Learn More</a>
                </div>

                <div class="loan-card">
                    <div class="loan-icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <h3>Mortgage Loans</h3>
                    <p>Make your dream home a reality with our mortgage solutions</p>
                    <ul class="loan-features">
                        <li><i class="fas fa-check"></i> 15-30 year terms</li>
                        <li><i class="fas fa-check"></i> Fixed & adjustable rates</li>
                        <li><i class="fas fa-check"></i> Low down payment options</li>
                        <li><i class="fas fa-check"></i> Pre-approval available</li>
                    </ul>
                    <a href="#" class="loan-btn">Learn More</a>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="faq-section">
            <div class="section-title">
                <h2>Frequently Asked Questions</h2>
                <p>Get answers to common questions about our loan process</p>
            </div>

            <div class="faq-container">
                <div class="faq-item">
                    <div class="faq-question">
                        How does the loan calculator work?
                        <i class="fas fa-chevron-down faq-toggle"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Our loan calculator uses the principal amount, interest rate, and loan term to estimate your
                            monthly payments and total loan cost. It provides a detailed breakdown of how much you'll
                            pay in interest over the life of the loan.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        What factors affect my loan eligibility?
                        <i class="fas fa-chevron-down faq-toggle"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Loan eligibility depends on several factors including credit score, income, employment
                            history, debt-to-income ratio, and the purpose of the loan. Our team evaluates each
                            application individually to determine the best options for you.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        How long does the loan approval process take?
                        <i class="fas fa-chevron-down faq-toggle"></i>
                    </div>
                    <div class="faq-answer">
                        <p>For most personal and business loans, we provide decisions within 1-2 business days after
                            receiving all required documents. Mortgage loans typically take longer due to additional
                            verification steps, usually 2-4 weeks.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        Can I pay off my loan early?
                        <i class="fas fa-chevron-down faq-toggle"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Yes, most of our loans allow for early repayment without penalties. Paying off your loan
                            early can save you money on interest. Check your specific loan agreement for details about
                            early repayment options.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="cta-section">
            <div class="cta-content">
                <h2>Ready to Apply for Your Loan?</h2>
                <p>Take the next step toward achieving your financial goals with Londa Loans. Our team is here to help
                    you find the perfect loan solution.</p>
                <div class="cta-buttons">
                    <a href="#" class="btn-primary">Apply Now</a>
                    <a href="#" class="btn-secondary">Contact Us</a>
                </div>
            </div>
        </section>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>Londa Loans</h3>
                    <p>Providing financial solutions that empower individuals and businesses to achieve their goals.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>

                <div class="footer-column">
                    <h3>Quick Links</h3>
                    <ul class="footer-links">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Loan Products</a></li>
                        <li><a href="#">Calculator</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h3>Loan Products</h3>
                    <ul class="footer-links">
                        <li><a href="#">Personal Loans</a></li>
                        <li><a href="#">Business Loans</a></li>
                        <li><a href="#">Mortgage Loans</a></li>
                        <li><a href="#">Auto Loans</a></li>
                        <li><a href="#">Debt Consolidation</a></li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h3>Contact Us</h3>
                    <ul class="footer-links">
                        <li><i class="fas fa-map-marker-alt"></i> 123 Finance Street, City, State 12345</li>
                        <li><i class="fas fa-phone"></i> (555) 123-4567</li>
                        <li><i class="fas fa-envelope"></i> info@londaloans.com</li>
                        <li><i class="fas fa-clock"></i> Mon-Fri: 9am-6pm</li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 2023 Londa Loans. All rights reserved. | <a href="#">Privacy Policy</a> | <a
                        href="#">Terms of Service</a></p>
            </div>
        </div>
    </footer>

    <script>
        // Loan Calculator Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const loanAmount = document.getElementById('loan-amount');
            const interestRate = document.getElementById('interest-rate');
            const loanTerm = document.getElementById('loan-term');
            const termValue = document.getElementById('term-value');
            const calculateBtn = document.getElementById('calculate-btn');
            const resetBtn = document.getElementById('reset-btn');

            const monthlyPayment = document.getElementById('monthly-payment');
            const totalPrincipal = document.getElementById('total-principal');
            const totalInterest = document.getElementById('total-interest');
            const totalPayment = document.getElementById('total-payment');
            const payoffDate = document.getElementById('payoff-date');

            // Update term value display
            loanTerm.addEventListener('input', function() {
                termValue.textContent = `${this.value} years`;
            });

            // Calculate loan function
            function calculateLoan() {
                const principal = parseFloat(loanAmount.value);
                const rate = parseFloat(interestRate.value) / 100 / 12; // Monthly interest rate
                const term = parseFloat(loanTerm.value) * 12; // Total months

                if (isNaN(principal) || isNaN(rate) || isNaN(term)) {
                    alert('Please enter valid numbers for all fields');
                    return;
                }

                // Calculate monthly payment
                const x = Math.pow(1 + rate, term);
                const monthly = (principal * x * rate) / (x - 1);

                // Calculate totals
                const totalPaid = monthly * term;
                const totalInt = totalPaid - principal;

                // Update display
                monthlyPayment.textContent = `$${monthly.toFixed(2)}`;
                totalPrincipal.textContent = `$${principal.toFixed(2)}`;
                totalInterest.textContent = `$${totalInt.toFixed(2)}`;
                totalPayment.textContent = `$${totalPaid.toFixed(2)}`;

                // Calculate payoff date
                const today = new Date();
                const payoff = new Date(today.getFullYear() + parseInt(loanTerm.value), today.getMonth());
                payoffDate.textContent = payoff.toLocaleDateString('en-US', {
                    month: 'long',
                    year: 'numeric'
                });

                // Update chart (simplified for demo)
                const principalPercent = Math.round((principal / totalPaid) * 100);
                const interestPercent = 100 - principalPercent;

                document.querySelector('.chart-fill').style.width = `${principalPercent}%`;
                document.querySelector('.chart-labels').innerHTML = `
                    <div>Principal: ${principalPercent}%</div>
                    <div>Interest: ${interestPercent}%</div>
                `;
            }

            // Reset form function
            function resetForm() {
                loanAmount.value = 15000;
                interestRate.value = 7.5;
                loanTerm.value = 5;
                termValue.textContent = '5 years';
                calculateLoan();
            }

            // Event listeners
            calculateBtn.addEventListener('click', calculateLoan);
            resetBtn.addEventListener('click', resetForm);

            // FAQ Toggle
            const faqItems = document.querySelectorAll('.faq-item');
            faqItems.forEach(item => {
                const question = item.querySelector('.faq-question');
                question.addEventListener('click', () => {
                    const answer = item.querySelector('.faq-answer');
                    const isActive = answer.classList.contains('active');

                    // Close all FAQ items
                    document.querySelectorAll('.faq-answer').forEach(ans => {
                        ans.classList.remove('active');
                    });
                    document.querySelectorAll('.faq-item').forEach(itm => {
                        itm.classList.remove('active');
                    });

                    // Open clicked item if it wasn't active
                    if (!isActive) {
                        answer.classList.add('active');
                        item.classList.add('active');
                    }
                });
            });

            // Initialize calculator with default values
            calculateLoan();
        });
    </script>
</body>

</html>
