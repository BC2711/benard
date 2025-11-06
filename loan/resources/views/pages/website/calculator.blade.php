<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  
    
</head>

<style>
    :root {
        --primary: #db9123;
        --primary-dark: #7a4603;
        --primary-light: #fef6e6;
        --secondary: #2d3748;
        --light: #f8f5f0;
        --white: #ffffff;
        --gray: #718096;
        --gray-light: #e2e8f0;
        --success: #38a169;
        --shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        --shadow-lg: 0 10px 40px rgba(0, 0, 0, 0.12);
        --radius: 16px;
        --radius-sm: 8px;
    }

    .dark {
        --light: #1a202c;
        --white: #2d3748;
        --secondary: #f7fafc;
        --gray: #cbd5e0;
        --gray-light: #4a5568;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background-color: var(--light);
        color: var(--secondary);
        font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
        line-height: 1.6;
        transition: all 0.3s ease;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 clamp(1rem, 4vw, 2rem);
    }

    /* Hero Section */
    .calculator-hero {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: var(--white);
        padding: clamp(3rem, 8vw, 6rem) 0;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .calculator-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
        opacity: 0.3;
    }

    .hero-content {
        position: relative;
        z-index: 1;
        max-width: 800px;
        margin: 0 auto;
    }

    .hero-content h1 {
        font-size: clamp(2rem, 5vw, 3.5rem);
        font-weight: 800;
        margin-bottom: 1rem;
        line-height: 1.2;
    }

    .hero-content p {
        font-size: clamp(1rem, 2.5vw, 1.25rem);
        opacity: 0.9;
        margin-bottom: 2rem;
    }

    /* Main Calculator Section */
    .calculator-section {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: clamp(2rem, 4vw, 3rem);
        margin: -4rem auto 4rem;
        position: relative;
        z-index: 10;
    }

    @media (max-width: 968px) {
        .calculator-section {
            grid-template-columns: 1fr;
            margin-top: -2rem;
        }
    }

    /* Calculator Card */
    .calculator-card {
        background: var(--white);
        border-radius: var(--radius);
        padding: clamp(1.5rem, 4vw, 2.5rem);
        box-shadow: var(--shadow-lg);
        border: 1px solid var(--gray-light);
        transition: all 0.3s ease;
    }

    .calculator-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .card-header {
        margin-bottom: 2rem;
        padding-bottom: 1.5rem;
        border-bottom: 2px solid var(--primary-light);
    }

    .card-header h2 {
        color: var(--primary-dark);
        font-size: clamp(1.25rem, 3vw, 1.75rem);
        display: flex;
        align-items: center;
        gap: 12px;
        font-weight: 700;
    }

    .card-header i {
        color: var(--primary);
        font-size: 1.5rem;
    }

    /* Form Styles */
    .form-group {
        margin-bottom: 2rem;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.75rem;
        font-weight: 600;
        color: var(--secondary);
        font-size: 1rem;
    }

    .input-with-icon {
        position: relative;
    }

    .input-with-icon i {
        position: absolute;
        left: 18px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--gray);
        font-size: 1.1rem;
    }

    .input-with-icon input,
    .input-with-icon select {
        width: 100%;
        padding: 16px 20px 16px 50px;
        border: 2px solid var(--gray-light);
        border-radius: var(--radius-sm);
        font-size: 1.1rem;
        transition: all 0.3s ease;
        background: var(--white);
        color: var(--secondary);
        font-weight: 500;
    }

    .input-with-icon input:focus,
    .input-with-icon select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(219, 145, 35, 0.15);
        transform: translateY(-2px);
    }

    .range-container {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .range-container input[type="range"] {
        flex: 1;
        height: 8px;
        -webkit-appearance: none;
        background: var(--gray-light);
        border-radius: 10px;
        outline: none;
    }

    .range-container input[type="range"]::-webkit-slider-thumb {
        -webkit-appearance: none;
        width: 24px;
        height: 24px;
        background: var(--primary);
        border-radius: 50%;
        cursor: pointer;
        border: 3px solid var(--white);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }

    .range-container input[type="range"]::-webkit-slider-thumb:hover {
        transform: scale(1.1);
        background: var(--primary-dark);
    }

    .range-value {
        min-width: 100px;
        padding: 10px 16px;
        background: var(--primary-light);
        border-radius: var(--radius-sm);
        text-align: center;
        font-weight: 700;
        color: var(--primary-dark);
        font-size: 1rem;
        border: 2px solid transparent;
        transition: all 0.3s ease;
    }

    .range-value:hover {
        border-color: var(--primary);
    }

    .term-selector {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .term-option {
        padding: 1rem;
        border: 2px solid var(--gray-light);
        border-radius: var(--radius-sm);
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        background: var(--white);
    }

    .term-option.active {
        border-color: var(--primary);
        background: var(--primary-light);
        color: var(--primary-dark);
        font-weight: 600;
    }

    .term-option:hover {
        border-color: var(--primary);
        transform: translateY(-2px);
    }

    .btn-calculate {
        width: 100%;
        padding: 18px;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: var(--white);
        border: none;
        border-radius: var(--radius-sm);
        font-size: 1.2rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        margin-top: 1rem;
        position: relative;
        overflow: hidden;
    }

    .btn-calculate::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .btn-calculate:hover::before {
        left: 100%;
    }

    .btn-calculate:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(219, 145, 35, 0.4);
    }

    .btn-calculate:active {
        transform: translateY(-1px);
    }

    /* Results Card */
    .results-card {
        background: var(--white);
        border-radius: var(--radius);
        padding: clamp(1.5rem, 4vw, 2.5rem);
        box-shadow: var(--shadow-lg);
        border: 1px solid var(--gray-light);
        height: fit-content;
        position: sticky;
        top: 2rem;
        transition: all 0.3s ease;
    }

    .results-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .results-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        padding-bottom: 1.5rem;
        border-bottom: 2px solid var(--primary-light);
    }

    .results-header h2 {
        color: var(--primary-dark);
        font-size: clamp(1.25rem, 3vw, 1.75rem);
        font-weight: 700;
    }

    .reset-btn {
        background: var(--primary-light);
        border: 2px solid transparent;
        padding: 10px 18px;
        border-radius: var(--radius-sm);
        color: var(--primary-dark);
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        font-weight: 600;
        font-size: 0.95rem;
    }

    .reset-btn:hover {
        background: var(--primary);
        color: var(--white);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(219, 145, 35, 0.3);
    }

    .result-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.25rem 0;
        border-bottom: 1px solid var(--gray-light);
        transition: all 0.3s ease;
    }

    .result-item:hover {
        background: var(--primary-light);
        margin: 0 -1rem;
        padding: 1.25rem 1rem;
        border-radius: var(--radius-sm);
    }

    .result-item:last-child {
        border-bottom: none;
    }

    .result-label {
        color: var(--gray);
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .result-label i {
        font-size: 1.1rem;
        width: 20px;
    }

    .result-value {
        font-weight: 700;
        color: var(--secondary);
        font-size: 1.1rem;
    }

    .monthly-payment {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: var(--white);
        padding: 2.5rem 2rem;
        border-radius: var(--radius);
        text-align: center;
        margin: 2.5rem 0;
        position: relative;
        overflow: hidden;
        box-shadow: 0 8px 32px rgba(219, 145, 35, 0.3);
    }

    .monthly-payment::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
        animation: pulse-glow 4s ease-in-out infinite;
    }

    @keyframes pulse-glow {

        0%,
        100% {
            transform: scale(1);
            opacity: 0.5;
        }

        50% {
            transform: scale(1.1);
            opacity: 0.8;
        }
    }

    .payment-amount {
        font-size: clamp(2rem, 5vw, 3.5rem);
        font-weight: 800;
        margin: 0.5rem 0;
        position: relative;
        z-index: 2;
    }

    .payment-label {
        font-size: 1.1rem;
        opacity: 0.9;
        position: relative;
        z-index: 2;
    }

    .payment-note {
        font-size: 0.9rem;
        opacity: 0.8;
        margin-top: 0.5rem;
        position: relative;
        z-index: 2;
    }

    .payment-schedule {
        background: var(--primary-light);
        border-radius: var(--radius-sm);
        padding: 1.5rem;
        margin: 1.5rem 0;
        border-left: 4px solid var(--primary);
    }

    .schedule-title {
        font-weight: 700;
        color: var(--primary-dark);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .schedule-dates {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    .schedule-item {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .schedule-label {
        font-size: 0.875rem;
        color: var(--gray);
        font-weight: 500;
    }

    .schedule-value {
        font-weight: 600;
        color: var(--secondary);
    }

    .amortization-chart {
        margin-top: 2.5rem;
        padding-top: 2rem;
        border-top: 2px solid var(--primary-light);
    }

    .chart-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        font-weight: 600;
        color: var(--secondary);
    }

    .chart-bar {
        height: 16px;
        background: var(--gray-light);
        border-radius: 10px;
        margin-bottom: 1.5rem;
        overflow: hidden;
        position: relative;
    }

    .chart-fill {
        height: 100%;
        background: linear-gradient(90deg, var(--primary), var(--primary-dark));
        border-radius: 10px;
        width: 65%;
        position: relative;
        transition: width 1s ease-in-out;
    }

    .chart-fill::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        animation: shimmer 2s infinite;
    }

    @keyframes shimmer {
        0% {
            transform: translateX(-100%);
        }

        100% {
            transform: translateX(100%);
        }
    }

    .chart-labels {
        display: flex;
        justify-content: space-between;
        font-size: 0.95rem;
        color: var(--gray);
        font-weight: 500;
    }

    /* Additional Sections */
    .section-title {
        text-align: center;
        margin-bottom: 3rem;
    }

    .section-title h2 {
        color: var(--primary-dark);
        font-size: clamp(1.75rem, 4vw, 2.5rem);
        margin-bottom: 1rem;
        font-weight: 800;
    }

    .section-title p {
        color: var(--gray);
        max-width: 600px;
        margin: 0 auto;
        font-size: 1.1rem;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {

        .calculator-card,
        .results-card {
            padding: 1.5rem;
        }

        .payment-amount {
            font-size: 2.5rem;
        }

        .range-container {
            flex-direction: column;
            align-items: stretch;
            gap: 15px;
        }

        .range-value {
            text-align: center;
            order: -1;
        }

        .term-selector {
            grid-template-columns: 1fr;
        }

        .schedule-dates {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 480px) {
        .calculator-hero {
            padding: 2rem 0;
        }

        .results-header {
            flex-direction: column;
            gap: 1rem;
            align-items: flex-start;
        }

        .reset-btn {
            align-self: stretch;
            justify-content: center;
        }
    }

    /* Loading animation */
    .loading {
        opacity: 0.7;
        pointer-events: none;
    }

    .loading::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 20px;
        height: 20px;
        margin: -10px 0 0 -10px;
        border: 2px solid var(--primary);
        border-top: 2px solid transparent;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>

<body >

  
        <!-- Hero Section -->
        <section class="calculator-hero">
            <div class="container">
                <div class="hero-content">
                    <h1>Smart Loan Calculator</h1>
                    <p>Calculate your loan payments in Zambian Kwacha with flexible 3-day payment schedules</p>
                </div>
            </div>
        </section>

        <div class="container">
            <!-- Main Calculator Section -->
            <section class="calculator-section">
                <!-- Calculator Form -->
                <div class="calculator-card">
                    <div class="card-header">
                        <h2><i class="fas fa-calculator"></i> Loan Details</h2>
                    </div>
                    <form id="loan-form" @submit.prevent="calculateLoan">
                        <div class="form-group">
                            <label for="loan-amount">Loan Amount (ZMW)</label>
                            <div class="input-with-icon">
                                <i class="fas fa-kwacha"></i>
                                <input type="number" id="loan-amount" x-model="loanAmount" placeholder="10,000"
                                    min="100" max="1000000" step="100" @input="calculateLoan">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="interest-rate">Interest Rate (%)</label>
                            <div class="input-with-icon">
                                <i class="fas fa-percent"></i>
                                <input type="number" id="interest-rate" x-model="interestRate" placeholder="5.5"
                                    min="0.1" max="30" step="0.1" @input="calculateLoan">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Loan Term</label>
                            <div class="term-selector">
                                <div class="term-option" :class="{ 'active': termUnit === 'days' }"
                                    @click="termUnit = 'days'; calculateLoan()">
                                    <i class="fas fa-calendar-day"></i>
                                    <div>Days</div>
                                </div>
                                <div class="term-option" :class="{ 'active': termUnit === 'months' }"
                                    @click="termUnit = 'months'; calculateLoan()">
                                    <i class="fas fa-calendar-alt"></i>
                                    <div>Months</div>
                                </div>
                            </div>
                            <div class="range-container">
                                <input type="range" id="loan-term" x-model="loanTerm"
                                    :min="termUnit === 'days' ? 7 : 1" :max="termUnit === 'days' ? 365 : 36"
                                    @input="calculateLoan">
                                <div class="range-value" id="term-value"
                                    x-text="termUnit === 'days' ? `${loanTerm} days` : `${loanTerm} months`"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="payment-days">Payment Days per Week</label>
                            <div class="input-with-icon">
                                <i class="fas fa-calendar-week"></i>
                                <select id="payment-days" x-model="paymentDaysPerWeek" @change="calculateLoan">
                                    <option value="3">3 Days (e.g., Mon, Wed, Fri)</option>
                                    <option value="2">2 Days (e.g., Tue, Thu)</option>
                                    <option value="1">1 Day (Weekly)</option>
                                </select>
                            </div>
                        </div>

                        <button type="button" class="btn-calculate" @click="calculateLoan" :disabled="loading">
                            <i class="fas fa-calculator"></i>
                            <span x-text="loading ? 'Calculating...' : 'Calculate Loan'"></span>
                        </button>
                    </form>
                </div>

                <!-- Results Card -->
                <div class="results-card">
                    <div class="results-header">
                        <h2>Loan Summary</h2>
                        <button class="reset-btn" @click="resetForm">
                            <i class="fas fa-redo"></i> Reset
                        </button>
                    </div>

                    <div class="monthly-payment">
                        <div class="payment-label">Estimated Payment per Installment</div>
                        <div class="payment-amount" x-text="`ZMW ${paymentPerInstallment}`"></div>
                        <div class="payment-note" x-text="paymentScheduleNote"></div>
                    </div>

                    <div class="result-item">
                        <div class="result-label">
                            <i class="fas fa-money-bill-wave"></i> Total Principal
                        </div>
                        <div class="result-value" x-text="`ZMW ${totalPrincipal}`"></div>
                    </div>

                    <div class="result-item">
                        <div class="result-label">
                            <i class="fas fa-chart-line"></i> Total Interest
                        </div>
                        <div class="result-value" x-text="`ZMW ${totalInterest}`"></div>
                    </div>

                    <div class="result-item">
                        <div class="result-label">
                            <i class="fas fa-receipt"></i> Total Payment
                        </div>
                        <div class="result-value" x-text="`ZMW ${totalPayment}`"></div>
                    </div>

                    <div class="result-item">
                        <div class="result-label">
                            <i class="fas fa-calendar-check"></i> Payoff Date
                        </div>
                        <div class="result-value" x-text="payoffDate"></div>
                    </div>

                    <!-- Payment Schedule -->
                    <div class="payment-schedule" x-show="nextPaymentDate && followingPaymentDate">
                        <div class="schedule-title">
                            <i class="fas fa-calendar-day"></i> Payment Schedule
                        </div>
                        <div class="schedule-dates">
                            <div class="schedule-item">
                                <div class="schedule-label">Next Payment</div>
                                <div class="schedule-value" x-text="nextPaymentDate"></div>
                            </div>
                            <div class="schedule-item">
                                <div class="schedule-label">Following Payment</div>
                                <div class="schedule-value" x-text="followingPaymentDate"></div>
                            </div>
                        </div>
                    </div>

                    <div class="amortization-chart">
                        <div class="chart-header">
                            <div>Principal & Interest</div>
                            <div>100%</div>
                        </div>
                        <div class="chart-bar">
                            <div class="chart-fill" :style="`width: ${principalPercent}%`"></div>
                        </div>
                        <div class="chart-labels">
                            <div x-text="`Principal: ${principalPercent}%`"></div>
                            <div x-text="`Interest: ${interestPercent}%`"></div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

       


    <script>
        function loanCalculator() {
            return {
                // Data properties
                loanAmount: 5000,
                interestRate: 10,
                loanTerm: 30,
                termUnit: 'days',
                paymentDaysPerWeek: 3,
                paymentPerInstallment: '0.00',
                totalPrincipal: '0.00',
                totalInterest: '0.00',
                totalPayment: '0.00',
                payoffDate: '',
                principalPercent: 0,
                interestPercent: 0,
                nextPaymentDate: '',
                followingPaymentDate: '',
                paymentScheduleNote: '',
                loading: false,
                darkMode: false,

                // Initialize calculator
                init() {
                    this.calculateLoan();
                    this.setupEventListeners();
                },

                // Calculate loan function
                calculateLoan() {
                    this.loading = true;

                    // Simulate calculation delay for better UX
                    setTimeout(() => {
                        const principal = parseFloat(this.loanAmount);
                        const annualRate = parseFloat(this.interestRate) / 100;

                        // Convert term to days for calculation
                        let totalDays;
                        if (this.termUnit === 'days') {
                            totalDays = parseInt(this.loanTerm);
                        } else {
                            totalDays = parseInt(this.loanTerm) * 30; // Approximate month as 30 days
                        }

                        if (isNaN(principal) || isNaN(annualRate) || isNaN(totalDays)) {
                            this.loading = false;
                            return;
                        }

                        // Calculate daily interest rate
                        const dailyRate = annualRate / 365;

                        // Calculate total interest
                        const totalInterest = principal * dailyRate * totalDays;

                        // Calculate total payment
                        const totalPayment = principal + totalInterest;

                        // Calculate number of installments based on payment days per week
                        const daysPerWeek = parseInt(this.paymentDaysPerWeek);
                        const totalWeeks = totalDays / 7;
                        const totalInstallments = Math.ceil(totalWeeks * daysPerWeek);

                        // Calculate payment per installment
                        const paymentPerInstallment = totalPayment / totalInstallments;

                        // Update display values with formatting
                        this.paymentPerInstallment = paymentPerInstallment.toLocaleString('en-US', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        });
                        this.totalPrincipal = principal.toLocaleString('en-US', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        });
                        this.totalInterest = totalInterest.toLocaleString('en-US', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        });
                        this.totalPayment = totalPayment.toLocaleString('en-US', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        });

                        // Calculate payoff date
                        const today = new Date();
                        const payoff = new Date(today.getTime() + totalDays * 24 * 60 * 60 * 1000);
                        this.payoffDate = payoff.toLocaleDateString('en-US', {
                            weekday: 'long',
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric'
                        });

                        // Calculate next payment dates (3-day schedule)
                        this.calculatePaymentSchedule(daysPerWeek);

                        // Update payment schedule note
                        this.paymentScheduleNote =
                            `${daysPerWeek} payments per week for ${totalInstallments} installments`;

                        // Update chart percentages
                        this.principalPercent = Math.round((principal / totalPayment) * 100);
                        this.interestPercent = 100 - this.principalPercent;

                        this.loading = false;
                    }, 500);
                },

                // Calculate payment schedule based on 3-day intervals
                calculatePaymentSchedule(daysPerWeek) {
                    const today = new Date();
                    const dayNames = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

                    let nextPayment, followingPayment;

                    if (daysPerWeek === 3) {
                        // 3-day schedule: Today, then skip one day, then next payment
                        nextPayment = new Date(today);
                        nextPayment.setDate(today.getDate() + 2); // Skip one day

                        followingPayment = new Date(nextPayment);
                        followingPayment.setDate(nextPayment.getDate() + 2); // Skip one day
                    } else if (daysPerWeek === 2) {
                        // 2-day schedule: Skip two days between payments
                        nextPayment = new Date(today);
                        nextPayment.setDate(today.getDate() + 3);

                        followingPayment = new Date(nextPayment);
                        followingPayment.setDate(nextPayment.getDate() + 3);
                    } else {
                        // 1-day schedule: Weekly payments
                        nextPayment = new Date(today);
                        nextPayment.setDate(today.getDate() + 7);

                        followingPayment = new Date(nextPayment);
                        followingPayment.setDate(nextPayment.getDate() + 7);
                    }

                    this.nextPaymentDate = nextPayment.toLocaleDateString('en-US', {
                        weekday: 'long',
                        month: 'short',
                        day: 'numeric'
                    });

                    this.followingPaymentDate = followingPayment.toLocaleDateString('en-US', {
                        weekday: 'long',
                        month: 'short',
                        day: 'numeric'
                    });
                },

                // Reset form to default values
                resetForm() {
                    this.loanAmount = 5000;
                    this.interestRate = 10;
                    this.loanTerm = 30;
                    this.termUnit = 'days';
                    this.paymentDaysPerWeek = 3;
                    this.calculateLoan();
                },

                // Setup event listeners
                setupEventListeners() {
                    // Real-time calculations on input
                    const inputs = ['loan-amount', 'interest-rate', 'loan-term'];
                    inputs.forEach(id => {
                        const element = document.getElementById(id);
                        if (element) {
                            element.addEventListener('input', () => {
                                this.calculateLoan();
                            });
                        }
                    });

                    // Keyboard shortcuts
                    document.addEventListener('keydown', (e) => {
                        if (e.ctrlKey && e.key === 'r') {
                            e.preventDefault();
                            this.resetForm();
                        }
                    });
                }
            }
        }
    </script>
</body>

</html>
