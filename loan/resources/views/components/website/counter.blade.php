@php $impact = \App\Models\ImpactNumbersSection::first(); @endphp

<section id="impact-numbers"
    class="relative overflow-hidden py-20 bg-gradient-to-br from-primary-primary via-primary-800 to-primary-700">
    <!-- Background Shapes -->
    <div class="absolute w-64 h-64 rounded-full bg-white/10 top-10 -left-20 animate-float"></div>
    <div class="absolute w-40 h-40 rounded-full bg-white/15 bottom-20 -right-10 animate-float"
        style="animation-delay: 2s;"></div>
    <div class="absolute w-32 h-32 rounded-full bg-white/10 top-1/3 right-1/4 animate-float" style="animation-delay: 4s;">
    </div>

    <!-- Floating Icons -->
    <div class="absolute top-1/4 left-1/6 text-white/20 text-4xl animate-float"><i class="fas fa-chart-line"></i></div>
    <div class="absolute top-1/3 right-1/5 text-white/20 text-4xl animate-float" style="animation-delay: 1s;"><i
            class="fas fa-rocket"></i></div>
    <div class="absolute bottom-1/4 left-1/4 text-white/20 text-4xl animate-float" style="animation-delay: 2s;"><i
            class="fas fa-trophy"></i></div>

    <div class="container mx-auto px-4 relative z-10">
        <!-- Header -->
        <div class="text-center mb-16 max-w-3xl mx-auto animate-fade-in-up">
            <h2 class="text-3xl lg:text-4xl xl:text-5xl font-black text-white mb-4">{{ $impact->heading }}</h2>
            <div class="w-20 h-1 bg-primary-accent mx-auto rounded-full mb-6"></div>
            <p class="text-lg text-white/80 leading-relaxed">{{ $impact->description }}</p>
        </div>

        <!-- Main Stats -->
        <div class="max-w-7xl mx-auto mb-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($impact->main_stats as $i => $stat)
                    <div class="stat-card bg-white/10 rounded-2xl p-6 text-center backdrop-blur-sm border border-white/20 hover:bg-white/15 transition-all duration-300 hover:-translate-y-2 animate-fade-in-up"
                        style="animation-delay: {{ $i * 0.1 }}s;">
                        <div
                            class="w-16 h-16 bg-primary-accent/20 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                            <i class="fas {{ $stat['icon'] }} text-primary-accent text-2xl"></i>
                        </div>
                        <div class="text-4xl lg:text-5xl font-black text-white mb-2">
                            {{ $stat['target'] }}@if (!empty($stat['suffix']))
                                <span class="text-2xl text-primary-accent">{{ $stat['suffix'] }}</span>
                            @endif
                        </div>
                        <p class="text-white/80 text-sm font-semibold">{{ $stat['label'] }}</p>
                        <div class="impact-bar mt-4 h-1.5 bg-white/20 rounded-full overflow-hidden">
                            <div class="impact-progress h-full bg-primary-accent rounded-full transition-all duration-1000"
                                style="width: 0%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Performance Metrics -->
        <div class="max-w-4xl mx-auto mb-16 animate-fade-in-up" style="animation-delay: 0.4s;">
            <div class="bg-white/10 rounded-2xl p-8 backdrop-blur-sm border border-white/20">
                <h3 class="text-xl lg:text-2xl font-bold text-white text-center mb-6">Performance Metrics</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach ($impact->performance_metrics as $m)
                        <div class="text-center group">
                            <div class="text-3xl lg:text-4xl font-black text-primary-accent mb-2">{{ $m['value'] }}
                            </div>
                            <p class="text-white/80 text-sm">{{ $m['label'] }}</p>
                            <div class="flex justify-center mt-2">
                                <i
                                    class="fas {{ $m['icon'] }} text-white/40 text-lg group-hover:text-primary-accent transition-colors"></i>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Industry Impact -->
        <div class="max-w-7xl mx-auto mb-16 animate-fade-in-up" style="animation-delay: 0.5s;">
            <h3 class="text-xl lg:text-2xl font-bold text-white text-center mb-6">Industry Impact</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach ($impact->industry_impact as $ind)
                    <div
                        class="bg-white/5 rounded-xl p-5 text-center border border-white/10 hover:bg-white/10 transition-all duration-300 hover:-translate-y-1">
                        <div class="text-2xl lg:text-3xl font-black text-primary-accent mb-1">{{ $ind['value'] }}</div>
                        <p class="text-white/70 text-sm">{{ $ind['label'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Growth Timeline -->
        <div class="max-w-4xl mx-auto mb-16 animate-fade-in-up" style="animation-delay: 0.6s;">
            <div class="bg-white/10 rounded-2xl p-8 backdrop-blur-sm border border-white/20">
                <h3 class="text-xl lg:text-2xl font-bold text-white text-center mb-6">Our Growth Journey</h3>
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    @foreach ($impact->timeline as $i => $t)
                        <div class="text-center">
                            <div class="flex items-center gap-2 justify-center mb-2">
                                <span class="text-primary-accent font-bold">{{ $t['year'] }}</span>
                                <span class="text-white/60 text-sm">{{ $t['label'] }}</span>
                            </div>
                            <div class="text-white/80 text-sm">{{ $t['detail'] }}</div>
                        </div>
                        @if ($i < count($impact->timeline) - 1)
                            <div class="hidden md:block"><i class="fas fa-arrow-right text-white/30 text-xl"></i></div>
                            <div class="block md:hidden"><i class="fas fa-arrow-down text-white/30 text-xl"></i></div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="max-w-4xl mx-auto text-center animate-fade-in-up" style="animation-delay: 0.7s;">
            <h3 class="text-2xl lg:text-3xl font-bold text-white mb-4">{{ $impact->cta_heading }}</h3>
            <p class="text-white/80 mb-8 max-w-2xl mx-auto">{{ $impact->cta_description }}</p>
            <div class="flex flex-wrap gap-4 justify-center">
                <a href="{{ $impact->cta_primary_link }}"
                    class="px-8 py-3 bg-white text-primary-primary font-bold rounded-xl transition-all duration-300 hover:bg-primary-50 hover:shadow-xl hover:scale-105 flex items-center gap-2">
                    <i class="fas {{ $impact->cta_primary_icon }}"></i>
                    {{ $impact->cta_primary_text }}
                    <i class="fas fa-arrow-right text-sm group-hover:translate-x-1 transition-transform"></i>
                </a>
                <a href="{{ $impact->cta_secondary_link }}"
                    class="px-8 py-3 border-2 border-white text-white font-bold rounded-xl transition-all duration-300 hover:bg-white hover:text-primary-primary flex items-center gap-2">
                    <i class="fas {{ $impact->cta_secondary_icon }}"></i>
                    {{ $impact->cta_secondary_text }}
                </a>
            </div>

            <!-- Trust Badges -->
            <div class="flex flex-wrap justify-center gap-6 mt-8">
                @foreach ($impact->trust_badges as $badge)
                    <div class="flex items-center gap-2 text-white/70 text-sm">
                        <i class="fas {{ $badge['icon'] }} text-primary-accent"></i>
                        <span>{{ $badge['text'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<style>
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
