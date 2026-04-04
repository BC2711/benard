@php $calc = \App\Models\LoanCalculator::first(); @endphp

<!-- Hero Section -->
<section
    class="bg-gradient-to-br from-primary-primary via-primary-800 to-primary-700 text-white relative overflow-hidden">
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-0 left-0 w-72 h-72 bg-white/5 rounded-full blur-3xl animate-float"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-primary-accent/10 rounded-full blur-3xl animate-float"
            style="animation-delay: 2s;"></div>
    </div>

    <div class="container mx-auto px-4 lg:px-8 py-16 lg:py-24 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <div
                class="inline-flex items-center space-x-2 bg-white/10 text-white px-4 py-2 rounded-full text-sm font-semibold uppercase tracking-wider mb-6 border border-white/20">
                <i class="fas fa-calculator text-xs"></i>
                <span>Loan Calculator</span>
            </div>
            <h1 class="text-3xl lg:text-4xl xl:text-5xl font-black leading-tight mb-5 animate-fade-in-up">
                {{ $calc->hero_title }}
            </h1>
            <div class="w-20 h-1 bg-primary-accent mx-auto rounded-full mb-6"></div>
            <p class="text-lg text-white/80 leading-relaxed mb-8 max-w-3xl mx-auto animate-fade-in-up"
                style="animation-delay: 100ms">
                {{ $calc->hero_description }}
            </p>

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-12 animate-fade-in-up" style="animation-delay: 200ms">
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-3 text-center border border-white/20">
                    <div class="text-xl font-black text-primary-accent mb-1">{{ $calc->stat_loan_range }}</div>
                    <div class="text-white/60 text-xs">Loan Range</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-3 text-center border border-white/20">
                    <div class="text-xl font-black text-primary-accent mb-1">{{ $calc->stat_interest_rates }}</div>
                    <div class="text-white/60 text-xs">Interest Rates</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-3 text-center border border-white/20">
                    <div class="text-xl font-black text-primary-accent mb-1">{{ $calc->stat_loan_terms }}</div>
                    <div class="text-white/60 text-xs">Flexible Terms</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-3 text-center border border-white/20">
                    <div class="text-xl font-black text-primary-accent mb-1">{{ $calc->stat_payment_options }}</div>
                    <div class="text-white/60 text-xs">Payment Options</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Calculator Section -->
<section class="py-16 lg:py-24 -mt-20 relative z-20">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-8">

            <!-- Calculator Form -->
            <div class="bg-white rounded-2xl p-6 lg:p-8 shadow-2xl border border-primary-100 animate-fade-in-up">
                <div class="flex items-center gap-3 mb-6">
                    <div
                        class="w-10 h-10 bg-gradient-to-br from-primary-primary to-primary-secondary rounded-xl flex items-center justify-center">
                        <i class="fas fa-calculator text-white text-lg"></i>
                    </div>
                    <div>
                        <h2 class="text-xl lg:text-2xl font-black text-primary-primary">Loan Details</h2>
                        <p class="text-gray-500 text-sm">Customize your loan parameters</p>
                    </div>
                </div>

                <!-- Loan Amount -->
                <div class="mb-6">
                    <label class="block text-sm font-bold text-primary-primary mb-3">
                        <i class="fas fa-coins text-primary-secondary mr-2"></i> Loan Amount (ZMW)
                    </label>
                    <div class="relative">
                        <input type="range" min="{{ $calc->min_amount }}" max="{{ $calc->max_amount }}" step="1000"
                            value="{{ $calc->default_amount }}" class="w-full mb-3" id="loanAmount">
                        <div class="flex justify-between items-center">
                            <span class="text-xs text-gray-500">ZMW {{ number_format($calc->min_amount) }}</span>
                            <div class="bg-primary-100 text-primary-primary font-bold px-3 py-1.5 rounded-lg text-sm">
                                ZMW <span id="loanAmountValue">{{ number_format($calc->default_amount) }}</span>
                            </div>
                            <span class="text-xs text-gray-500">ZMW {{ number_format($calc->max_amount) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Interest Rate -->
                <div class="mb-6">
                    <label class="block text-sm font-bold text-primary-primary mb-3">
                        <i class="fas fa-percent text-primary-secondary mr-2"></i> Interest Rate (%)
                    </label>
                    <div class="relative">
                        <input type="range" min="{{ $calc->min_rate }}" max="{{ $calc->max_rate }}" step="0.1"
                            value="{{ $calc->default_rate }}" class="w-full mb-3" id="interestRate">
                        <div class="flex justify-between items-center">
                            <span class="text-xs text-gray-500">{{ $calc->min_rate }}%</span>
                            <div class="bg-primary-100 text-primary-primary font-bold px-3 py-1.5 rounded-lg text-sm">
                                <span id="interestRateValue">{{ $calc->default_rate }}</span>%
                            </div>
                            <span class="text-xs text-gray-500">{{ $calc->max_rate }}%</span>
                        </div>
                    </div>
                </div>

                <!-- Loan Term -->
                <div class="mb-6">
                    <label class="block text-sm font-bold text-primary-primary mb-3">
                        <i class="fas fa-calendar-alt text-primary-secondary mr-2"></i> Loan Term
                    </label>

                    <div class="grid grid-cols-2 gap-3 mb-4">
                        <button
                            class="term-type-btn active bg-primary-primary text-white py-2 rounded-lg font-bold text-sm transition-all"
                            data-type="days">
                            <i class="fas fa-calendar-day mr-1"></i> Days
                        </button>
                        <button
                            class="term-type-btn bg-gray-100 text-gray-600 py-2 rounded-lg font-bold text-sm transition-all"
                            data-type="months">
                            <i class="fas fa-calendar mr-1"></i> Months
                        </button>
                    </div>

                    <div class="relative">
                        <input type="range" min="{{ $calc->min_days }}" max="{{ $calc->max_days }}" step="1"
                            value="{{ $calc->default_days }}" class="w-full mb-3" id="loanTerm">
                        <div class="flex justify-between items-center">
                            <span class="text-xs text-gray-500" id="termMin">{{ $calc->min_days }} days</span>
                            <div class="bg-primary-100 text-primary-primary font-bold px-3 py-1.5 rounded-lg text-sm">
                                <span id="loanTermValue">{{ $calc->default_days }}</span> <span
                                    id="termUnit">days</span>
                            </div>
                            <span class="text-xs text-gray-500" id="termMax">{{ $calc->max_days }} days</span>
                        </div>
                    </div>
                </div>

                <!-- Payment Schedule -->
                <div class="mb-6">
                    <label class="block text-sm font-bold text-primary-primary mb-3">
                        <i class="fas fa-calendar-week text-primary-secondary mr-2"></i> Payment Schedule
                    </label>
                    <div class="grid grid-cols-3 gap-2">
                        @foreach ($calc->payment_schedules as $i => $sched)
                            <button
                                class="schedule-btn {{ $i == 0 ? 'active bg-primary-primary text-white' : 'bg-gray-100 text-gray-600' }} py-2 rounded-lg font-bold text-sm transition-all"
                                data-days="{{ $sched['days'] }}">
                                {{ $sched['label'] }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <button id="calculateBtn"
                    class="w-full bg-primary-primary text-white py-3 rounded-xl font-bold shadow-lg hover:bg-primary-secondary hover:scale-105 transition-all duration-300 flex items-center justify-center gap-2">
                    <i class="fas fa-calculator"></i> Calculate Loan
                    <i class="fas fa-arrow-right text-sm"></i>
                </button>
            </div>

            <!-- Results Panel -->
            <div class="bg-white rounded-2xl p-6 lg:p-8 shadow-2xl border border-primary-100 animate-fade-in-up"
                style="animation-delay: 200ms">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 bg-gradient-to-br from-primary-primary to-primary-secondary rounded-xl flex items-center justify-center">
                            <i class="fas fa-chart-bar text-white text-lg"></i>
                        </div>
                        <div>
                            <h2 class="text-xl lg:text-2xl font-black text-primary-primary">Loan Summary</h2>
                            <p class="text-gray-500 text-sm">Your payment breakdown</p>
                        </div>
                    </div>
                    <button id="resetBtn"
                        class="bg-gray-100 text-gray-500 px-3 py-1.5 rounded-lg font-bold text-sm hover:bg-gray-200 flex items-center gap-1 transition">
                        <i class="fas fa-redo text-xs"></i> Reset
                    </button>
                </div>

                <div id="resultPanel" class="hidden">
                    <div
                        class="bg-gradient-to-br from-primary-primary to-primary-700 rounded-xl p-6 text-white text-center mb-6 relative overflow-hidden">
                        <div class="absolute inset-0 bg-white/10 animate-pulse"></div>
                        <div class="relative z-10">
                            <div class="text-white/70 text-sm mb-1">Payment per Installment</div>
                            <div class="text-3xl lg:text-4xl font-black mb-1" id="paymentAmount">ZMW 0</div>
                            <div class="text-white/60 text-xs" id="paymentScheduleText"></div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="bg-primary-50 rounded-xl p-4 text-center">
                            <div class="text-xl font-black text-primary-primary mb-1" id="totalPrincipal">ZMW 0</div>
                            <div class="text-gray-500 text-xs">Total Principal</div>
                        </div>
                        <div class="bg-primary-50 rounded-xl p-4 text-center">
                            <div class="text-xl font-black text-primary-secondary mb-1" id="totalInterest">ZMW 0</div>
                            <div class="text-gray-500 text-xs">Total Interest</div>
                        </div>
                    </div>

                    <div class="bg-primary-50 rounded-xl p-4 mb-6 border-l-4 border-primary-accent">
                        <h3 class="text-sm font-bold text-primary-primary mb-3 flex items-center gap-2">
                            <i class="fas fa-calendar-day text-primary-accent"></i> Payment Schedule
                        </h3>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <div class="text-gray-500 text-xs">Next Payment</div>
                                <div class="font-bold text-primary-primary text-sm" id="nextPayment"></div>
                            </div>
                            <div>
                                <div class="text-gray-500 text-xs">Following Payment</div>
                                <div class="font-bold text-primary-primary text-sm" id="followingPayment"></div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl p-4 border border-primary-100">
                        <h3 class="text-sm font-bold text-primary-primary mb-3">Payment Breakdown</h3>
                        <div class="space-y-3">
                            <div>
                                <div class="flex justify-between text-xs text-gray-500 mb-1">
                                    <span>Principal</span>
                                    <span id="principalPercent">0%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-primary-primary h-2 rounded-full" id="principalBar"
                                        style="width: 0%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-xs text-gray-500 mb-1">
                                    <span>Interest</span>
                                    <span id="interestPercent">0%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-primary-secondary h-2 rounded-full" id="interestBar"
                                        style="width: 0%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="noResult" class="text-center text-gray-400 py-10">
                    <i class="fas fa-calculator text-5xl mb-3 text-gray-300"></i>
                    <p class="text-sm">Adjust parameters and click Calculate</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-16 lg:py-20 bg-gradient-to-br from-primary-50 to-white">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <div
                class="inline-flex items-center space-x-2 bg-primary-100 text-primary-primary px-4 py-2 rounded-full text-sm font-semibold uppercase tracking-wider mb-4 border border-primary-200">
                <i class="fas fa-star text-xs"></i>
                <span>Why Choose Us</span>
            </div>
            <h2 class="text-2xl lg:text-3xl font-black text-primary-primary mb-3">Why Use Our Calculator?</h2>
            <div class="w-16 h-1 bg-primary-secondary mx-auto rounded-full"></div>
            <p class="text-gray-500 mt-4">Designed specifically for marketers and entrepreneurs in Zambia</p>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            <div
                class="bg-white rounded-xl p-5 text-center shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1 border border-primary-100">
                <div
                    class="w-14 h-14 bg-gradient-to-br from-primary-primary to-primary-secondary rounded-xl flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-coins text-white text-xl"></i>
                </div>
                <h3 class="text-lg font-bold text-primary-primary mb-2">Zambian Kwacha</h3>
                <p class="text-gray-500 text-sm">All calculations in ZMW with local market rates</p>
            </div>
            <div
                class="bg-white rounded-xl p-5 text-center shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1 border border-primary-100">
                <div
                    class="w-14 h-14 bg-gradient-to-br from-primary-secondary to-primary-accent rounded-xl flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-calendar-alt text-white text-xl"></i>
                </div>
                <h3 class="text-lg font-bold text-primary-primary mb-2">Flexible Scheduling</h3>
                <p class="text-gray-500 text-sm">Choose between 1-3 payment days per week</p>
            </div>
            <div
                class="bg-white rounded-xl p-5 text-center shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1 border border-primary-100">
                <div
                    class="w-14 h-14 bg-gradient-to-br from-primary-accent to-primary-primary rounded-xl flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-chart-line text-white text-xl"></i>
                </div>
                <h3 class="text-lg font-bold text-primary-primary mb-2">Real-time Updates</h3>
                <p class="text-gray-500 text-sm">Instant calculations as you adjust parameters</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 lg:py-20 bg-gradient-to-br from-primary-primary via-primary-800 to-primary-700 text-white">
    <div class="container mx-auto px-4 lg:px-8 text-center">
        <h2 class="text-2xl lg:text-3xl font-black mb-4">{{ $calc->cta_heading }}</h2>
        <p class="text-white/80 mb-6 max-w-2xl mx-auto">{{ $calc->cta_description }}</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ $calc->cta_apply_url }}"
                class="bg-white text-primary-primary px-6 py-3 rounded-xl font-bold shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300">
                <i class="fas fa-paper-plane mr-2"></i>{{ $calc->cta_apply_text }}
            </a>
            <a href="{{ $calc->cta_contact_url }}"
                class="border-2 border-white text-white px-6 py-3 rounded-xl font-bold hover:bg-white hover:text-primary-primary transition-all duration-300 hover:scale-105">
                <i class="fas fa-phone mr-2"></i>{{ $calc->cta_contact_text }}
            </a>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // DOM Elements
        const loanAmount = document.getElementById('loanAmount');
        const loanAmountValue = document.getElementById('loanAmountValue');
        const interestRate = document.getElementById('interestRate');
        const interestRateValue = document.getElementById('interestRateValue');
        const loanTerm = document.getElementById('loanTerm');
        const loanTermValue = document.getElementById('loanTermValue');
        const termUnit = document.getElementById('termUnit');
        const termMin = document.getElementById('termMin');
        const termMax = document.getElementById('termMax');
        const calculateBtn = document.getElementById('calculateBtn');
        const resetBtn = document.getElementById('resetBtn');
        const resultPanel = document.getElementById('resultPanel');
        const noResult = document.getElementById('noResult');

        // Term type (days or months)
        let currentTermType = 'days';
        let currentScheduleDays = 7; // Default: Weekly

        // Get schedule buttons
        const scheduleBtns = document.querySelectorAll('.schedule-btn');
        const termTypeBtns = document.querySelectorAll('.term-type-btn');

        // Update display values
        loanAmount.addEventListener('input', function() {
            loanAmountValue.textContent = Number(this.value).toLocaleString();
        });

        interestRate.addEventListener('input', function() {
            interestRateValue.textContent = this.value;
        });

        // Term type switcher
        termTypeBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                termTypeBtns.forEach(b => {
                    b.classList.remove('active', 'bg-primary-primary', 'text-white');
                    b.classList.add('bg-gray-100', 'text-gray-600');
                });
                this.classList.add('active', 'bg-primary-primary', 'text-white');
                this.classList.remove('bg-gray-100', 'text-gray-600');

                currentTermType = this.dataset.type;

                if (currentTermType === 'months') {
                    const months = Math.floor(loanTerm.value / 30);
                    loanTerm.min = 1;
                    loanTerm.max = 24;
                    loanTerm.value = Math.min(Math.max(months, 1), 24);
                    termMin.textContent = '1 month';
                    termMax.textContent = '24 months';
                    termUnit.textContent = 'months';
                    loanTermValue.textContent = loanTerm.value;
                } else {
                    loanTerm.min = {{ $calc->min_days }};
                    loanTerm.max = {{ $calc->max_days }};
                    loanTerm.value = {{ $calc->default_days }};
                    termMin.textContent = '{{ $calc->min_days }} days';
                    termMax.textContent = '{{ $calc->max_days }} days';
                    termUnit.textContent = 'days';
                    loanTermValue.textContent = loanTerm.value;
                }
            });
        });

        loanTerm.addEventListener('input', function() {
            loanTermValue.textContent = this.value;
        });

        // Schedule buttons
        scheduleBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                scheduleBtns.forEach(b => {
                    b.classList.remove('active', 'bg-primary-primary', 'text-white');
                    b.classList.add('bg-gray-100', 'text-gray-600');
                });
                this.classList.add('active', 'bg-primary-primary', 'text-white');
                this.classList.remove('bg-gray-100', 'text-gray-600');

                currentScheduleDays = parseInt(this.dataset.days);
            });
        });

        // Calculate function
        function calculateLoan() {
            const amount = parseFloat(loanAmount.value);
            const rate = parseFloat(interestRate.value) / 100;
            let term = parseFloat(loanTerm.value);

            // Convert months to days if needed
            if (currentTermType === 'months') {
                term = term * 30;
            }

            const scheduleDays = currentScheduleDays;

            // Calculate number of payments
            const numPayments = Math.ceil(term / scheduleDays);

            // Calculate total interest (simple interest)
            const totalInterest = amount * rate * (term / 365);
            const totalAmount = amount + totalInterest;
            const paymentAmount = totalAmount / numPayments;

            // Update results
            document.getElementById('paymentAmount').textContent = 'ZMW ' + paymentAmount.toFixed(2)
                .toLocaleString();
            document.getElementById('totalPrincipal').textContent = 'ZMW ' + amount.toFixed(2).toLocaleString();
            document.getElementById('totalInterest').textContent = 'ZMW ' + totalInterest.toFixed(2)
                .toLocaleString();
            document.getElementById('paymentScheduleText').textContent = numPayments + ' payments (' +
                scheduleDays + ' days interval)';

            // Calculate percentages for breakdown
            const principalPercent = (amount / totalAmount) * 100;
            const interestPercent = (totalInterest / totalAmount) * 100;

            document.getElementById('principalPercent').textContent = principalPercent.toFixed(1) + '%';
            document.getElementById('interestPercent').textContent = interestPercent.toFixed(1) + '%';
            document.getElementById('principalBar').style.width = principalPercent + '%';
            document.getElementById('interestBar').style.width = interestPercent + '%';

            // Get today's date for payment schedule
            const today = new Date();
            const nextPayment = new Date(today);
            nextPayment.setDate(today.getDate() + scheduleDays);
            const followingPayment = new Date(nextPayment);
            followingPayment.setDate(nextPayment.getDate() + scheduleDays);

            const formatDate = (date) => {
                return date.toLocaleDateString('en-ZM', {
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric'
                });
            };

            document.getElementById('nextPayment').textContent = formatDate(nextPayment);
            document.getElementById('followingPayment').textContent = formatDate(followingPayment);

            // Show results
            resultPanel.classList.remove('hidden');
            noResult.classList.add('hidden');
        }

        // Reset function
        function resetCalculator() {
            // Reset loan amount
            loanAmount.value = {{ $calc->default_amount }};
            loanAmountValue.textContent = Number(loanAmount.value).toLocaleString();

            // Reset interest rate
            interestRate.value = {{ $calc->default_rate }};
            interestRateValue.textContent = interestRate.value;

            // Reset term type to days
            currentTermType = 'days';
            termTypeBtns.forEach(btn => {
                if (btn.dataset.type === 'days') {
                    btn.classList.add('active', 'bg-primary-primary', 'text-white');
                    btn.classList.remove('bg-gray-100', 'text-gray-600');
                } else {
                    btn.classList.remove('active', 'bg-primary-primary', 'text-white');
                    btn.classList.add('bg-gray-100', 'text-gray-600');
                }
            });

            // Reset term value
            loanTerm.min = {{ $calc->min_days }};
            loanTerm.max = {{ $calc->max_days }};
            loanTerm.value = {{ $calc->default_days }};
            termMin.textContent = '{{ $calc->min_days }} days';
            termMax.textContent = '{{ $calc->max_days }} days';
            termUnit.textContent = 'days';
            loanTermValue.textContent = loanTerm.value;

            // Reset schedule to first option
            currentScheduleDays = {{ $calc->payment_schedules[0]['days'] ?? 7 }};
            scheduleBtns.forEach((btn, idx) => {
                if (idx === 0) {
                    btn.classList.add('active', 'bg-primary-primary', 'text-white');
                    btn.classList.remove('bg-gray-100', 'text-gray-600');
                } else {
                    btn.classList.remove('active', 'bg-primary-primary', 'text-white');
                    btn.classList.add('bg-gray-100', 'text-gray-600');
                }
            });

            // Hide results
            resultPanel.classList.add('hidden');
            noResult.classList.remove('hidden');
        }

        // Event listeners
        calculateBtn.addEventListener('click', calculateLoan);
        resetBtn.addEventListener('click', resetCalculator);

        // Auto-calculate on input change (optional)
        const inputs = [loanAmount, interestRate, loanTerm];
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                if (!resultPanel.classList.contains('hidden')) {
                    calculateLoan();
                }
            });
        });

        scheduleBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                if (!resultPanel.classList.contains('hidden')) {
                    calculateLoan();
                }
            });
        });

        termTypeBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                if (!resultPanel.classList.contains('hidden')) {
                    calculateLoan();
                }
            });
        });

        // Range slider styling
        const rangeSliders = document.querySelectorAll('input[type="range"]');
        rangeSliders.forEach(slider => {
            slider.style.accentColor = '#db9123';
        });
    });
</script>

<style>
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

    @keyframes float {

        0%,
        100% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-20px);
        }
    }

    .animate-fade-in-up {
        animation: fadeInUp 0.5s ease-out forwards;
        opacity: 0;
    }

    .animate-float {
        animation: float 6s ease-in-out infinite;
    }

    input[type="range"] {
        -webkit-appearance: none;
        height: 6px;
        border-radius: 5px;
        background: #e5e7eb;
    }

    input[type="range"]::-webkit-slider-thumb {
        -webkit-appearance: none;
        width: 18px;
        height: 18px;
        border-radius: 50%;
        background: #db9123;
        cursor: pointer;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
    }

    input[type="range"]::-webkit-slider-thumb:hover {
        background: #f8b750;
        transform: scale(1.2);
    }
</style>
