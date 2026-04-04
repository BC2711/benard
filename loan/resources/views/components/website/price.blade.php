@php $plans = \App\Models\LoanPlansSection::first(); @endphp

<section id="loan-plans"
    class="relative overflow-hidden py-20 bg-gradient-to-br from-primary-primary via-primary-800 to-primary-700">
    <!-- Background Shapes -->
    <div class="absolute w-64 h-64 rounded-full bg-white/10 top-10 -left-20 animate-float"></div>
    <div class="absolute w-40 h-40 rounded-full bg-white/15 bottom-20 -right-10 animate-float"
        style="animation-delay: 2s;"></div>
    <div class="absolute w-32 h-32 rounded-full bg-white/10 top-1/3 right-1/4 animate-float" style="animation-delay: 4s;">
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <!-- Header -->
        <div class="text-center mb-16 max-w-3xl mx-auto animate-fade-in-up">
            <div
                class="inline-flex items-center space-x-2 bg-white/10 text-white px-4 py-2 rounded-full text-sm font-semibold uppercase tracking-wider mb-6 border border-white/20">
                <i class="fas fa-coins text-xs"></i>
                <span>Loan Plans</span>
            </div>
            <h2 class="text-3xl lg:text-4xl xl:text-5xl font-black text-white mb-4 leading-tight">
                {{ $plans->heading }}
                <span class="text-primary-accent">{{ $plans->highlighted_text }}</span>
            </h2>
            <div class="w-20 h-1 bg-primary-accent mx-auto rounded-full mb-6"></div>
            <p class="text-lg text-white/80 leading-relaxed">{{ $plans->description }}</p>
        </div>

        <!-- Toggle Switch -->
        <div class="flex flex-col items-center mb-12">
            <div class="flex items-center gap-6 mb-4">
                <span class="text-lg font-semibold text-white/90">{{ $plans->short_term_label }}</span>
                <div class="toggle-switch" id="loan-type-switcher">
                    <div class="toggle-knob"></div>
                </div>
                <span class="text-lg font-semibold text-white/90">{{ $plans->long_term_label }}</span>
            </div>
            <p class="text-primary-accent text-sm font-medium" id="loan-description">
                {{ $plans->short_term_desc }}
            </p>
        </div>

        <!-- Pricing Cards Grid -->
        <div id="pricing-table" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
            @foreach ($plans->pricing_cards as $card)
                @if ($card['type'] === 'short')
                    <div class="pricing-card short-term {{ $card['featured'] ? 'featured' : '' }} bg-white rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2"
                        data-type="short">
                        @if ($card['featured'])
                            <div
                                class="absolute -top-3 left-1/2 -translate-x-1/2 bg-primary-secondary text-primary-primary text-xs font-black px-4 py-1 rounded-full shadow-lg">
                                POPULAR</div>
                        @endif
                        <div class="text-center mb-5">
                            <h3 class="text-xl font-bold text-primary-primary mb-2">{{ $card['name'] }}</h3>
                            <div class="text-4xl font-black text-primary-secondary mb-1">{{ $card['price'] }}</div>
                            <div class="text-xs text-gray-500">{{ $card['term'] }} • {{ $card['rate'] }} APR</div>
                        </div>
                        <ul class="space-y-2 mb-6">
                            @foreach ($card['features'] as $feat)
                                <li class="flex items-center gap-2 text-sm text-gray-600">
                                    <i class="fas fa-check-circle text-primary-secondary text-sm"></i>
                                    {{ $feat }}
                                </li>
                            @endforeach
                        </ul>
                        <a href="#"
                            class="block text-center bg-primary-primary text-white py-3 rounded-xl font-bold hover:bg-primary-secondary hover:scale-105 transition-all duration-300 shadow-lg">
                            Apply Now <i class="fas fa-arrow-right ml-1 text-sm"></i>
                        </a>
                    </div>
                @endif
            @endforeach

            @foreach ($plans->pricing_cards as $card)
                @if ($card['type'] === 'long')
                    <div class="pricing-card long-term {{ $card['featured'] ? 'featured' : '' }} bg-white rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 hidden"
                        data-type="long">
                        @if ($card['featured'])
                            <div
                                class="absolute -top-3 left-1/2 -translate-x-1/2 bg-primary-secondary text-primary-primary text-xs font-black px-4 py-1 rounded-full shadow-lg">
                                BEST VALUE</div>
                        @endif
                        <div class="text-center mb-5">
                            <h3 class="text-xl font-bold text-primary-primary mb-2">{{ $card['name'] }}</h3>
                            <div class="text-4xl font-black text-primary-secondary mb-1">{{ $card['price'] }}</div>
                            <div class="text-xs text-gray-500">{{ $card['term'] }} • {{ $card['rate'] }} APR</div>
                        </div>
                        <ul class="space-y-2 mb-6">
                            @foreach ($card['features'] as $feat)
                                <li class="flex items-center gap-2 text-sm text-gray-600">
                                    <i class="fas fa-check-circle text-primary-secondary text-sm"></i>
                                    {{ $feat }}
                                </li>
                            @endforeach
                        </ul>
                        <a href="#"
                            class="block text-center bg-primary-primary text-white py-3 rounded-xl font-bold hover:bg-primary-secondary hover:scale-105 transition-all duration-300 shadow-lg">
                            Apply Now <i class="fas fa-arrow-right ml-1 text-sm"></i>
                        </a>
                    </div>
                @endif
            @endforeach
        </div>

        <!-- Custom Solution Section -->
        <div class="max-w-5xl mx-auto">
            <div class="bg-white rounded-2xl p-6 md:p-8 shadow-2xl relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-primary-accent/10 rounded-full blur-2xl"></div>
                <div class="absolute bottom-0 left-0 w-32 h-32 bg-primary-primary/10 rounded-full blur-2xl"></div>

                <div class="relative z-10">
                    <div
                        class="inline-flex items-center gap-2 bg-primary-100 text-primary-primary px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider mb-4">
                        <i class="fas fa-star"></i>
                        <span>{{ $plans->custom_badge }}</span>
                    </div>

                    <div class="flex flex-col lg:flex-row items-center gap-8">
                        <!-- Left Content -->
                        <div class="flex-1">
                            <h4 class="text-2xl font-bold text-primary-primary mb-3">{{ $plans->custom_heading }}</h4>
                            <p class="text-gray-600 mb-4">{{ $plans->custom_description }}</p>
                            <ul class="space-y-2 mb-6">
                                @foreach ($plans->custom_benefits as $benefit)
                                    <li class="flex items-center gap-2 text-gray-700 text-sm">
                                        <i class="fas fa-check-circle text-primary-secondary"></i>
                                        {{ $benefit }}
                                    </li>
                                @endforeach
                            </ul>
                            <a href="{{ $plans->custom_link }}"
                                class="inline-flex items-center gap-2 px-6 py-3 bg-primary-primary text-white font-bold rounded-xl transition-all duration-300 hover:bg-primary-secondary hover:scale-105 shadow-lg">
                                <i class="fas {{ $plans->custom_link_icon }}"></i>
                                {{ $plans->custom_link_text }}
                                <i class="fas fa-arrow-right text-sm"></i>
                            </a>
                        </div>

                        <!-- Right Card -->
                        <div class="flex-1">
                            <div
                                class="bg-gradient-to-br from-primary-50 to-primary-100 p-6 rounded-xl border border-primary-200 text-center">
                                <div class="text-5xl font-black text-primary-primary mb-2">
                                    {{ $plans->custom_flexible_text }}</div>
                                <div class="text-gray-500 text-sm mb-3">{{ $plans->custom_flexible_subtext }}</div>
                                <div
                                    class="inline-block bg-primary-secondary/20 text-primary-primary text-sm font-bold px-4 py-2 rounded-full">
                                    <i class="fas fa-percent mr-1"></i>
                                    {{ $plans->custom_rate_text }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const switcher = document.getElementById('loan-type-switcher');
        const shortCards = document.querySelectorAll('.pricing-card.short-term');
        const longCards = document.querySelectorAll('.pricing-card.long-term');
        const description = document.getElementById('loan-description');

        let isLongTerm = false;

        switcher.addEventListener('click', function() {
            isLongTerm = !isLongTerm;

            // Toggle switcher active class
            if (isLongTerm) {
                switcher.classList.add('active');
            } else {
                switcher.classList.remove('active');
            }

            // Show/hide cards
            shortCards.forEach(card => {
                card.classList.toggle('hidden', isLongTerm);
            });
            longCards.forEach(card => {
                card.classList.toggle('hidden', !isLongTerm);
            });

            // Update description text
            if (isLongTerm) {
                description.textContent = "{{ addslashes($plans->long_term_desc) }}";
            } else {
                description.textContent = "{{ addslashes($plans->short_term_desc) }}";
            }
        });
    });
</script>

<style>
    /* Toggle Switch */
    .toggle-switch {
        position: relative;
        width: 64px;
        height: 32px;
        background-color: rgba(255, 255, 255, 0.3);
        border-radius: 9999px;
        cursor: pointer;
        transition: all 0.3s ease;
        border: 2px solid rgba(255, 255, 255, 0.5);
    }

    .toggle-switch.active {
        background-color: #f8b750;
        border-color: #f8b750;
    }

    .toggle-knob {
        position: absolute;
        top: 2px;
        left: 2px;
        width: 24px;
        height: 24px;
        background-color: white;
        border-radius: 50%;
        transition: transform 0.3s ease;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    .toggle-switch.active .toggle-knob {
        transform: translateX(32px);
    }

    /* Pricing Cards */
    .pricing-card {
        position: relative;
        transition: all 0.3s ease;
    }

    .pricing-card.featured {
        border: 2px solid #db9123;
        box-shadow: 0 20px 35px -10px rgba(0, 0, 0, 0.2);
        transform: scale(1.02);
    }

    .pricing-card.hidden {
        display: none;
    }

    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
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
        animation: fadeInUp 0.6s ease-out forwards;
        opacity: 0;
    }

    .animate-float {
        animation: float 6s ease-in-out infinite;
    }
</style>
