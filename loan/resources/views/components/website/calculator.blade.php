@php $calc = \App\Models\LoanCalculator::first(); @endphp

<!-- Hero -->
<section class="gradient-ca-bg text-white relative overflow-hidden">
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-0 left-0 w-72 h-72 bg-white/5 rounded-full blur-3xl animate-float"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-accent-accent/10 rounded-full blur-3xl animate-float"
            style="animation-delay: 2s;"></div>
    </div>

    <div class="container mx-auto px-4 lg:px-8 py-16 lg:py-24 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl lg:text-5xl xl:text-6xl font-black leading-tight mb-6 animate-fade-in-up">
                {{ $calc->hero_title }}
            </h1>
            <p class="text-xl text-white/90 leading-relaxed mb-8 max-w-3xl mx-auto animate-fade-in-up"
                style="animation-delay: 100ms">
                {{ $calc->hero_description }}
            </p>

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mb-12 animate-fade-in-up" style="animation-delay: 200ms">
                <div class="glass-effect rounded-2xl p-4 text-center">
                    <div class="text-2xl font-black text-accent-accent mb-1">{{ $calc->stat_loan_range }}</div>
                    <div class="text-white/70 text-sm">Loan Range</div>
                </div>
                <div class="glass-effect rounded-2xl p-4 text-center">
                    <div class="text-2xl font-black text-accent-accent mb-1">{{ $calc->stat_interest_rates }}</div>
                    <div class="text-white/70 text-sm">Interest Rates</div>
                </div>
                <div class="glass-effect rounded-2xl p-4 text-center">
                    <div class="text-2xl font-black text-accent-accent mb-1">{{ $calc->stat_loan_terms }}</div>
                    <div class="text-white/70 text-sm">Flexible Terms</div>
                </div>
                <div class="glass-effect rounded-2xl p-4 text-center">
                    <div class="text-2xl font-black text-accent-accent mb-1">{{ $calc->stat_payment_options }}</div>
                    <div class="text-white/70 text-sm">Payment Options</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Calculator -->
<section class="py-16 lg:py-24 -mt-20 relative z-20">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-8 lg:gap-12">
            <!-- Form -->
            <div
                class="bg-white rounded-3xl p-6 lg:p-8 shadow-2xl border border-gray-100 card-hover animate-fade-in-up">
                <div class="flex items-center gap-3 mb-8">
                    <div
                        class="w-12 h-12 bg-gradient-to-br from-secondary-secondary to-accent-accent rounded-2xl flex items-center justify-center">
                        <i class="fas fa-calculator text-white text-xl"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl lg:text-3xl font-black text-primary-primary">Loan Details</h2>
                        <p class="text-gray-600">Customize your loan parameters</p>
                    </div>
                </div>

                <!-- Loan Amount -->
                <div class="mb-8">
                    <label class="block text-lg font-bold text-primary-primary mb-4">
                        <i class="fas fa-kwacha text-secondary-secondary mr-2"></i> Loan Amount (ZMW)
                    </label>
                    <div class="relative">
                        <input type="range" min="{{ $calc->min_amount }}" max="{{ $calc->max_amount }}" step="1000"
                            value="{{ $calc->default_amount }}" class="w-full mb-4" id="loanAmount">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">ZMW {{ number_format($calc->min_amount) }}</span>
                            <div
                                class="bg-primary-primary/10 text-primary-primary font-bold px-4 py-2 rounded-xl text-lg">
                                ZMW <span id="loanAmountValue">{{ number_format($calc->default_amount) }}</span>
                            </div>
                            <span class="text-sm text-gray-600">ZMW {{ number_format($calc->max_amount) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Interest Rate -->
                <div class="mb-8">
                    <label class="block text-lg font-bold text-primary-primary mb-4">
                        <i class="fas fa-percent text-secondary-secondary mr-2"></i> Interest Rate (%)
                    </label>
                    <div class="relative">
                        <input type="range" min="{{ $calc->min_rate }}" max="{{ $calc->max_rate }}" step="0.1"
                            value="{{ $calc->default_rate }}" class="w-full mb-4" id="interestRate">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">{{ $calc->min_rate }}%</span>
                            <div
                                class="bg-primary-primary/10 text-primary-primary font-bold px-4 py-2 rounded-xl text-lg">
                                <span id="interestRateValue">{{ $calc->default_rate }}</span>%
                            </div>
                            <span class="text-sm text-gray-600">{{ $calc->max_rate }}%</span>
                        </div>
                    </div>
                </div>

                <!-- Loan Term -->
                <div class="mb-8">
                    <label class="block text-lg font-bold text-primary-primary mb-4">
                        <i class="fas fa-calendar-alt text-secondary-secondary mr-2"></i> Loan Term
                    </label>

                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <button
                            class="term-type-btn active bg-gradient-to-br from-secondary-secondary to-accent-accent text-white py-3 rounded-xl font-bold"
                            data-type="days">
                            <i class="fas fa-calendar-day mr-2"></i>Days
                        </button>
                        <button class="term-type-btn bg-gray-100 text-gray-600 py-3 rounded-xl font-bold"
                            data-type="months">
                            <i class="fas fa-calendar mr-2"></i>Months
                        </button>
                    </div>

                    <div class="relative">
                        <input type="range" min="{{ $calc->min_days }}" max="{{ $calc->max_days }}" step="1"
                            value="{{ $calc->default_days }}" class="w-full mb-4" id="loanTerm">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600" id="termMin">{{ $calc->min_days }} days</span>
                            <div
                                class="bg-primary-primary/10 text-primary-primary font-bold px-4 py-2 rounded-xl text-lg">
                                <span id="loanTermValue">{{ $calc->default_days }}</span> <span
                                    id="termUnit">days</span>
                            </div>
                            <span class="text-sm text-gray-600" id="termMax">{{ $calc->max_days }} days</span>
                        </div>
                    </div>
                </div>

                <!-- Payment Schedule -->
                <div class="mb-8">
                    <label class="block text-lg font-bold text-primary-primary mb-4">
                        <i class="fas fa-calendar-week text-secondary-secondary mr-2"></i> Payment Schedule
                    </label>
                    <div class="grid grid-cols-3 gap-4">
                        @foreach ($calc->payment_schedules as $i => $sched)
                            <button
                                class="schedule-btn {{ $i == 0 ? 'active bg-gradient-to-br from-secondary-secondary to-accent-accent text-white' : 'bg-gray-100 text-gray-600' }} py-3 rounded-xl font-bold"
                                data-days="{{ $sched['days'] }}">
                                {{ $sched['label'] }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <button id="calculateBtn"
                    class="w-full bg-gradient-to-r from-primary-primary to-primary-primary text-white py-4 rounded-2xl font-bold text-lg shadow-2xl hover:shadow-3xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-3 animate-pulse-glow">
                    <i class="fas fa-calculator"></i> Calculate Loan
                </button>
            </div>

            <!-- Results -->
            <div class="bg-white rounded-3xl p-6 lg:p-8 shadow-2xl border border-gray-100 card-hover animate-fade-in-up"
                style="animation-delay: 200ms">
                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-primary-primary to-secondary-secondary rounded-2xl flex items-center justify-center">
                            <i class="fas fa-chart-bar text-white text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl lg:text-3xl font-black text-primary-primary">Loan Summary</h2>
                            <p class="text-gray-600">Your payment breakdown</p>
                        </div>
                    </div>
                    <button id="resetBtn"
                        class="bg-gray-100 text-gray-600 px-4 py-2 rounded-xl font-bold hover:bg-gray-200 flex items-center gap-2">
                        <i class="fas fa-redo"></i> Reset
                    </button>
                </div>

                <div id="resultPanel" class="hidden">
                    <div
                        class="bg-gradient-to-br from-primary-primary to-primary-primary rounded-2xl p-8 text-white text-center mb-8 relative overflow-hidden">
                        <div class="absolute inset-0 bg-white/10 animate-pulse"></div>
                        <div class="relative z-10">
                            <div class="text-white/80 text-lg mb-2">Payment per Installment</div>
                            <div class="text-4xl lg:text-5xl font-black mb-2" id="paymentAmount">ZMW 0</div>
                            <div class="text-white/70" id="paymentScheduleText"></div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-6 mb-8">
                        <div class="bg-gray-50 rounded-2xl p-6 text-center">
                            <div class="text-2xl font-black text-primary-primary mb-1" id="totalPrincipal">ZMW 0</div>
                            <div class="text-gray-600 text-sm">Total Principal</div>
                        </div>
                        <div class="bg-gray-50 rounded-2xl p-6 text-center">
                            <div class="text-2xl font-black text-secondary-secondary mb-1" id="totalInterest">ZMW 0
                            </div>
                            <div class="text-gray-600 text-sm">Total Interest</div>
                        </div>
                    </div>

                    <div class="bg-primary-primary/5 rounded-2xl p-6 mb-8 border-l-4 border-accent-accent">
                        <h3 class="text-lg font-bold text-primary-primary mb-4 flex items-center gap-2">
                            <i class="fas fa-calendar-day text-accent-accent"></i> Payment Schedule
                        </h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <div class="text-gray-600 text-sm">Next Payment</div>
                                <div class="font-bold text-primary-primary" id="nextPayment"></div>
                            </div>
                            <div>
                                <div class="text-gray-600 text-sm">Following Payment</div>
                                <div class="font-bold text-primary-primary" id="followingPayment"></div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl p-6 border border-gray-200">
                        <h3 class="text-lg font-bold text-primary-primary mb-4">Payment Breakdown</h3>
                        <div class="space-y-4">
                            <div>
                                <div class="flex justify-between text-sm text-gray-600 mb-1">
                                    <span>Principal</span>
                                    <span id="principalPercent">0%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-3">
                                    <div class="bg-gradient-to-r from-primary-primary to-primary-primary h-3 rounded-full"
                                        id="principalBar" style="width: 0%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-sm text-gray-600 mb-1">
                                    <span>Interest</span>
                                    <span id="interestPercent">0%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-3">
                                    <div class="bg-gradient-to-r from-primary-primary to-yellow-400 h-3 rounded-full"
                                        id="interestBar" style="width: 0%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="noResult" class="text-center text-gray-500 py-12">
                    <i class="fas fa-calculator text-6xl mb-4 text-gray-300"></i>
                    <p class="text-lg">Adjust parameters and click Calculate</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features -->
<section class="py-16 lg:py-24 bg-light">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="text-3xl lg:text-4xl font-black text-primary-primary mb-4">Why Use Our Calculator?</h2>
            <p class="text-lg text-gray-600">Designed specifically for marketers and entrepreneurs in Zambia</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white rounded-2xl p-6 text-center card-hover">
                <div
                    class="w-16 h-16 bg-gradient-to-br from-primary-primary to-secondary-secondary rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-zambia text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-primary-primary mb-3">Zambian Kwacha</h3>
                <p class="text-gray-600">All calculations in ZMW with local market rates</p>
            </div>
            <div class="bg-white rounded-2xl p-6 text-center card-hover">
                <div
                    class="w-16 h-16 bg-gradient-to-br from-secondary-secondary to-accent-accent rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-calendar-alt text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-primary-primary mb-3">Flexible Scheduling</h3>
                <p class="text-gray-600">Choose between 1-3 payment days per week</p>
            </div>
            <div class="bg-white rounded-2xl p-6 text-center card-hover">
                <div
                    class="w-16 h-16 bg-gradient-to-br from-accent-accent to-primary-primary rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-chart-line text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-primary-primary mb-3">Real-time Updates</h3>
                <p class="text-gray-600">Instant calculations as you adjust parameters</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="gradient-ca-bg py-16 lg:py-24 text-white">
    <div class="container mx-auto px-4 lg:px-8 text-center">
        <h2 class="text-3xl lg:text-4xl font-black mb-6">{{ $calc->cta_heading }}</h2>
        <p class="text-xl text-white/90 mb-8 max-w-2xl mx-auto">{{ $calc->cta_description }}</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ $calc->cta_apply_url }}"
                class="bg-white text-primary-primary px-8 py-4 rounded-2xl font-bold text-lg shadow-2xl hover:shadow-3xl transition-all duration-300 hover:scale-105">
                {{ $calc->cta_apply_text }}
            </a>
            <a href="{{ $calc->cta_contact_url }}"
                class="border-2 border-white text-white px-8 py-4 rounded-2xl font-bold text-lg hover:bg-white hover:text-primary-primary transition-all duration-300 hover:scale-105">
                {{ $calc->cta_contact_text }}
            </a>
        </div>
    </div>
</section>
