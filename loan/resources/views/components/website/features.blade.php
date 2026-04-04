@php $feat = \App\Models\FeatureSection::first(); @endphp

<section class="py-20 lg:py-28 relative overflow-hidden bg-gradient-to-br from-primary-50 to-white" id="features">
    <!-- Background Blobs -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-0 left-0 w-72 h-72 bg-primary-primary/5 rounded-full blur-3xl animate-float"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-primary-secondary/5 rounded-full blur-3xl animate-float"
            style="animation-delay:2s;"></div>
        <div
            class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-primary-accent/5 rounded-full blur-3xl">
        </div>
    </div>

    <div class="container mx-auto px-4 lg:px-8 relative z-10">

        <!-- Header -->
        <div class="text-center max-w-4xl mx-auto mb-16 lg:mb-20 animate-fade-in-up">
            <div
                class="inline-flex items-center space-x-2 bg-primary-100 text-primary-primary px-4 py-2 rounded-full text-sm font-semibold uppercase tracking-wider mb-6 border border-primary-200">
                <i class="fas {{ $feat->badge_icon }} text-xs"></i>
                <span>{{ $feat->badge_text }}</span>
            </div>
            <h2 class="text-3xl lg:text-4xl xl:text-5xl font-black mb-6 leading-tight">
                <span class="text-primary-primary">{{ $feat->heading }}</span>
                <span
                    class="text-gradient bg-gradient-to-r from-primary-secondary to-primary-accent bg-clip-text text-transparent">{{ $feat->highlighted_text }}</span>
            </h2>
            <p class="text-lg text-gray-600 leading-relaxed max-w-3xl mx-auto">
                {{ $feat->description }}
            </p>
        </div>

        <!-- Feature Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-20">
            @foreach ($feat->features as $i => $f)
                <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 animate-fade-in-up border border-primary-100 hover:border-primary-200 hover:-translate-y-2"
                    style="animation-delay:{{ ($i + 1) * 100 }}ms">

                    <!-- Icon -->
                    <div class="relative mb-6">
                        <div
                            class="w-20 h-20 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-all duration-300 shadow-lg bg-gradient-to-br from-primary-primary to-primary-700">
                            <i class="fas {{ $f['icon'] }} text-white text-2xl"></i>
                        </div>
                        <div
                            class="absolute -top-2 -right-2 w-8 h-8 bg-primary-accent rounded-full flex items-center justify-center shadow-lg">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                    </div>

                    <!-- Content -->
                    <h3
                        class="text-xl font-bold text-primary-primary mb-3 group-hover:text-primary-secondary transition-colors duration-300">
                        {{ $f['title'] }}
                    </h3>
                    <p class="text-gray-600 leading-relaxed">{{ $f['desc'] }}</p>

                    <!-- Learn More Link (optional) -->
                    {{-- @if (isset($f['learn_more']) && $f['learn_more'])
                        <div
                            class="mt-4 flex items-center text-primary-secondary font-semibold text-sm group-hover:text-primary-primary transition-colors">
                            <span>{{ $f['learn_more'] }}</span>
                            <i
                                class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform duration-300"></i>
                        </div>
                    @endif --}}
                </div>
            @endforeach
        </div>

        <!-- Trust + CTA Section -->
        <div
            class="bg-gradient-to-br from-primary-primary via-primary-800 to-primary-700 rounded-3xl p-8 lg:p-12 shadow-2xl relative overflow-hidden">
            <!-- Decorative blobs -->
            <div class="absolute inset-0 opacity-10">
                <div
                    class="absolute top-0 left-0 w-64 h-64 bg-primary-accent rounded-full -translate-x-1/2 -translate-y-1/2">
                </div>
                <div
                    class="absolute bottom-0 right-0 w-96 h-96 bg-primary-accent rounded-full translate-x-1/2 translate-y-1/2">
                </div>
            </div>

            <!-- Stats grid -->
            <div class="relative z-10">
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8 mb-12">
                    <div class="text-center animate-fade-in-up" style="animation-delay:100ms">
                        <div class="text-3xl lg:text-4xl font-black text-primary-accent mb-2">{{ $feat->stat_1_value }}
                        </div>
                        <div class="text-white/80 text-sm font-semibold uppercase tracking-wider">
                            {{ $feat->stat_1_label }}</div>
                    </div>
                    <div class="text-center animate-fade-in-up" style="animation-delay:200ms">
                        <div class="text-3xl lg:text-4xl font-black text-primary-accent mb-2">{{ $feat->stat_2_value }}
                        </div>
                        <div class="text-white/80 text-sm font-semibold uppercase tracking-wider">
                            {{ $feat->stat_2_label }}</div>
                    </div>
                    <div class="text-center animate-fade-in-up" style="animation-delay:300ms">
                        <div class="text-3xl lg:text-4xl font-black text-primary-accent mb-2">{{ $feat->stat_3_value }}
                        </div>
                        <div class="text-white/80 text-sm font-semibold uppercase tracking-wider">
                            {{ $feat->stat_3_label }}</div>
                    </div>
                    <div class="text-center animate-fade-in-up" style="animation-delay:400ms">
                        <div class="text-3xl lg:text-4xl font-black text-primary-accent mb-2">{{ $feat->stat_4_value }}
                        </div>
                        <div class="text-white/80 text-sm font-semibold uppercase tracking-wider">
                            {{ $feat->stat_4_label }}</div>
                    </div>
                </div>

                <!-- CTA Buttons -->
                <div class="text-center max-w-3xl mx-auto">
                    <h3 class="text-2xl lg:text-3xl font-bold text-white mb-4 animate-fade-in-up"
                        style="animation-delay:500ms">
                        {{ $feat->cta_heading }}
                    </h3>
                    <p class="text-white/80 mb-8 animate-fade-in-up" style="animation-delay:600ms">
                        {{ $feat->cta_description }}
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center animate-fade-in-up"
                        style="animation-delay:700ms">
                        <a href="{{ $feat->cta_primary_link }}"
                            class="group bg-white text-primary-primary px-8 py-4 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105 flex items-center space-x-2">
                            <span>{{ $feat->cta_primary_text }}</span>
                            <i
                                class="fas fa-arrow-right group-hover:translate-x-1 transition-transform duration-300"></i>
                        </a>
                        <a href="{{ $feat->cta_secondary_link }}"
                            class="group border-2 border-white text-white px-8 py-4 rounded-xl font-bold hover:bg-white hover:text-primary-primary transition-all duration-300 hover:scale-105 flex items-center space-x-2">
                            <span>{{ $feat->cta_secondary_text }}</span>
                            <i class="fas fa-calculator group-hover:scale-110 transition-transform duration-300"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Custom gradient text */
    .text-gradient {
        background: linear-gradient(135deg, #db9123, #f8b750);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    /* Animation delays */
    .animate-fade-in-up {
        animation: fadeInUp 0.6s ease-out forwards;
        opacity: 0;
    }

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
</style>
