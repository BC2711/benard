@php $feat = \App\Models\FeatureSection::first(); @endphp

<section class="gradient-feature-bg py-20 lg:py-28 relative overflow-hidden" id="features">
    <!-- Background Blobs -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-0 left-0 w-72 h-72 bg-primary-primary/5 rounded-full blur-3xl animate-float"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-secondary-secondary/5 rounded-full blur-3xl animate-float"
            style="animation-delay:2s;"></div>
        <div
            class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-accent-accent/5 rounded-full blur-3xl">
        </div>
    </div>

    <div class="container mx-auto px-4 lg:px-8 relative z-10">

        <!-- Header -->
        <div class="text-center max-w-4xl mx-auto mb-16 lg:mb-20">
            <div
                class="inline-flex items-center space-x-2 bg-primary-primary/10 text-primary-primary px-4 py-2 rounded-full text-sm font-semibold uppercase tracking-wider mb-6 border border-primary-primary/20">
                <i class="fas {{ $feat->badge_icon }} text-xs"></i>
                <span>{{ $feat->badge_text }}</span>
            </div>
            <h2 class="text-4xl lg:text-5xl xl:text-6xl font-bold text-secondary-secondary mb-6 leading-tight">
                {{ $feat->heading }}
                <span class="text-gradient">{{ $feat->highlighted_text }}</span>
            </h2>
            <p class="text-xl text-gray-600 leading-relaxed max-w-3xl mx-auto">
                {{ $feat->description }}
            </p>
        </div>

        <!-- Feature Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-20">
            @foreach ($feat->features as $i => $f)
                <div class="group bg-white rounded-3xl p-8 shadow-xl card-hover animate-fade-in-up border border-gray-100"
                    style="animation-delay:{{ ($i + 1) * 100 }}ms">
                    <div class="relative mb-6">
                        <div
                            class="w-20 h-20 {{ $i % 2 == 0 ? 'icon-gradient-primary' : 'icon-gradient-secondary' }} rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-lg">
                            <i class="fas {{ $f['icon'] }} text-white text-2xl"></i>
                        </div>
                        <div
                            class="absolute -top-2 -right-2 w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-lg">
                            <div class="w-3 h-3 bg-primary-primary rounded-full animate-pulse"></div>
                        </div>
                    </div>
                    <h3
                        class="text-2xl font-bold text-secondary-secondary mb-4 group-hover:text-primary-primary transition-colors duration-300">
                        {{ $f['title'] }}
                    </h3>
                    <p class="text-gray-600 leading-relaxed mb-6">{{ $f['desc'] }}</p>
                    <div class="flex items-center text-primary-primary font-semibold text-sm">
                        <span>{{ $f['learn_more'] }}</span>
                        <i
                            class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform duration-300"></i>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Trust + CTA -->
        <div
            class="bg-gradient-to-br from-primary-primary to-primary-primary rounded-3xl p-8 lg:p-12 shadow-2xl relative overflow-hidden">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-0 left-0 w-64 h-64 bg-white rounded-full -translate-x-1/2 -translate-y-1/2">
                </div>
                <div class="absolute bottom-0 right-0 w-96 h-96 bg-white rounded-full translate-x-1/2 translate-y-1/2">
                </div>
            </div>

            <div class="relative z-10">
                <!-- Stats -->
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                    <x-stat class="text-white" value="{{ $feat->stat_1_value }}" label="{{ $feat->stat_1_label }}" delay="100ms"
                        color="white" />
                    <x-stat value="{{ $feat->stat_2_value }}" label="{{ $feat->stat_2_label }}" delay="200ms"
                        color="white" />
                    <x-stat value="{{ $feat->stat_3_value }}" label="{{ $feat->stat_3_label }}" delay="300ms"
                        color="white" />
                    <x-stat value="{{ $feat->stat_4_value }}" label="{{ $feat->stat_4_label }}" delay="400ms"
                        color="white" />
                </div>

                <!-- CTA -->
                <div class="text-center max-w-3xl mx-auto">
                    <h3 class="text-3xl lg:text-4xl font-bold text-white mb-4 animate-fade-in-up"
                        style="animation-delay:500ms">
                        {{ $feat->cta_heading }}
                    </h3>
                    <p class="text-xl text-white/80 mb-8 animate-fade-in-up" style="animation-delay:600ms">
                        {{ $feat->cta_description }}
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center animate-fade-in-up"
                        style="animation-delay:700ms">
                        <a href="{{ $feat->cta_primary_link }}"
                            class="group bg-white text-secondary-secondary px-8 py-4 rounded-2xl font-bold text-lg shadow-2xl hover:bg-gray-50 transition-all duration-300 hover:scale-105 flex items-center space-x-2 animate-pulse-glow">
                            <span>{{ $feat->cta_primary_text }}</span>
                            <i
                                class="fas fa-arrow-right group-hover:translate-x-1 transition-transform duration-300"></i>
                        </a>
                        <a href="{{ $feat->cta_secondary_link }}"
                            class="group border-2 border-white text-white px-8 py-4 rounded-2xl font-bold text-lg hover:bg-white hover:text-secondary-secondary transition-all duration-300 hover:scale-105 flex items-center space-x-2">
                            <span>{{ $feat->cta_secondary_text }}</span>
                            <i class="fas fa-calculator group-hover:scale-110 transition-transform duration-300"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
