@php $plans = \App\Models\LoanPlansSection::first(); @endphp

<section id="loan-plans" class="relative overflow-hidden py-20 gradient-price-bg text-white">
    <!-- Background Shapes -->
    <div class="shape w-64 h-64 rounded-full bg-white top-10 -left-20 animate-float"></div>
    <div class="shape w-40 h-40 rounded-full bg-white bottom-20 -right-10 animate-float" style="animation-delay: 2s;">
    </div>
    <div class="shape w-32 h-32 rounded-full bg-white top-1/3 right-1/4 animate-float" style="animation-delay: 4s;"></div>

    <div class="container mx-auto px-4 relative z-10">
        <!-- Header -->
        <div class="text-center mb-16 max-w-3xl mx-auto animate-fadeIn">
            <h2 class="text-5xl font-bold mb-6 leading-tight">
                {{ $plans->heading }}
                <span class="text-primary-100">{{ $plans->highlighted_text }}</span>
            </h2>
            <p class="text-xl opacity-90 leading-relaxed">{{ $plans->description }}</p>
        </div>

        <!-- Toggle -->
        <div class="flex flex-col items-center mb-12">
            <div class="flex items-center gap-6 mb-4">
                <span class="text-lg font-semibold">{{ $plans->short_term_label }}</span>
                <div class="toggle-switch" id="loan-type-switcher">
                    <div class="toggle-knob">S</div>
                </div>
                <span class="text-lg font-semibold">{{ $plans->long_term_label }}</span>
            </div>
            <p class="text-primary-100 text-sm font-medium" id="loan-description">
                {{ $plans->short_term_desc }}
            </p>
        </div>

        <!-- Pricing Cards -->
        <div id="pricing-table" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
            @foreach ($plans->pricing_cards as $card)
                @if ($card['type'] === 'short')
                    <div class="pricing-card short-term {{ $card['featured'] ? 'featured' : '' }} bg-white text-gray-800 rounded-2xl p-8 shadow-xl card-hover"
                        data-type="short">
                        <div class="text-center mb-6">
                            <h3 class="text-2xl font-bold mb-2">{{ $card['name'] }}</h3>
                            <div class="text-4xl font-bold text-primary-600 mb-1">{{ $card['price'] }}</div>
                            <div class="text-sm text-gray-600">{{ $card['term'] }} • {{ $card['rate'] }} APR</div>
                        </div>
                        <ul class="space-y-3 mb-8">
                            @foreach ($card['features'] as $feat)
                                <li class="flex items-center gap-2"><i class="fas fa-check text-primary-500"></i>
                                    {{ $feat }}</li>
                            @endforeach
                        </ul>
                        <a href="#"
                            class="block text-center bg-primary-600 text-white py-3 rounded-lg font-semibold hover:bg-primary-700 transition">Apply
                            Now</a>
                    </div>
                @endif
            @endforeach

            @foreach ($plans->pricing_cards as $card)
                @if ($card['type'] === 'long')
                    <div class="pricing-card long-term {{ $card['featured'] ? 'featured' : '' }} bg-white text-gray-800 rounded-2xl p-8 shadow-xl card-hover hidden"
                        data-type="long">
                        <div class="text-center mb-6">
                            <h3 class="text-2xl font-bold mb-2">{{ $card['name'] }}</h3>
                            <div class="text-4xl font-bold text-primary-600 mb-1">{{ $card['price'] }}</div>
                            <div class="text-sm text-gray-600">{{ $card['term'] }} • {{ $card['rate'] }} APR</div>
                        </div>
                        <ul class="space-y-3 mb-8">
                            @foreach ($card['features'] as $feat)
                                <li class="flex items-center gap-2"><i class="fas fa-check text-primary-500"></i>
                                    {{ $feat }}</li>
                            @endforeach
                        </ul>
                        <a href="#"
                            class="block text-center bg-primary-600 text-white py-3 rounded-lg font-semibold hover:bg-primary-700 transition">Apply
                            Now</a>
                    </div>
                @endif
            @endforeach
        </div>

        <!-- Custom Solution -->
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-2xl p-8 text-center featured-card card-hover animate-fadeInUp">
                <div class="loan-badge">{{ $plans->custom_badge }}</div>
                <div class="flex flex-col md:flex-row items-center gap-8">
                    <div class="flex-1 text-left">
                        <h4 class="text-2xl font-bold text-primary-700 mb-3">{{ $plans->custom_heading }}</h4>
                        <p class="text-gray-600 mb-6">{{ $plans->custom_description }}</p>
                        <ul class="space-y-3 mb-6">
                            @foreach ($plans->custom_benefits as $benefit)
                                <li class="flex items-center gap-3 text-gray-700">
                                    <i class="fas fa-check-circle text-primary-500"></i> {{ $benefit }}
                                </li>
                            @endforeach
                        </ul>
                        <a href="{{ $plans->custom_link }}"
                            class="inline-flex items-center gap-2 px-6 py-3 bg-primary-500 text-white font-semibold rounded-lg transition-all duration-300 hover:bg-primary-600 hover:shadow-lg">
                            <i class="fas {{ $plans->custom_link_icon }}"></i>
                            {{ $plans->custom_link_text }}
                        </a>
                    </div>
                    <div class="flex-1">
                        <div
                            class="bg-gradient-to-br from-primary-50 to-accent-50 p-6 rounded-xl border border-primary-100">
                            <div class="text-5xl font-bold text-primary-700 mb-2">{{ $plans->custom_flexible_text }}
                            </div>
                            <div class="text-gray-600 mb-4">{{ $plans->custom_flexible_subtext }}</div>
                            <div class="text-primary-500 font-semibold">{{ $plans->custom_rate_text }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.getElementById('loan-type-switcher').addEventListener('click', function() {
        const isLong = this.classList.toggle('active');
        document.querySelectorAll('.pricing-card').forEach(card => {
            card.classList.toggle('hidden', card.dataset.type !== (isLong ? 'long' : 'short'));
        });
        document.getElementById('loan-description').textContent = isLong ?
            `{!! addslashes($plans->long_term_desc) !!}` :
            `{!! addslashes($plans->short_term_desc) !!}`;
    });
</script>

<style>
    .toggle-switch {
        @apply relative w-16 h-8 bg-gray-300 rounded-full cursor-pointer transition;
    }

    .toggle-switch.active {
        @apply bg-primary-500;
    }

    .toggle-knob {
        @apply absolute top-1 left-1 w-6 h-6 bg-white rounded-full transition;
    }

    .toggle-switch.active .toggle-knob {
        @apply translate-x-8;
    }

    .pricing-card.featured {
        @apply ring-4 ring-primary-500 ring-offset-2 scale-105;
    }

    .loan-badge {
        @apply absolute -top-3 left-1/2 -translate-x-1/2 bg-primary-600 text-white px-4 py-1 rounded-full text-xs font-bold;
    }
</style>
