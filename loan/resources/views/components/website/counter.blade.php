@php $impact = \App\Models\ImpactNumbersSection::first(); @endphp

<section id="impact-numbers" class="relative overflow-hidden py-20 impact-gradient">
    <!-- Background -->
    <div class="shape w-64 h-64 rounded-full bg-white opacity-10 top-10 -left-20 animate-float"></div>
    <div class="shape w-40 h-40 rounded-full bg-white opacity-15 bottom-20 -right-10 animate-float"
        style="animation-delay: 2s;"></div>
    <div class="shape w-32 h-32 rounded-full bg-white opacity-10 top-1/3 right-1/4 animate-float"
        style="animation-delay: 4s;"></div>

    <!-- Floating Icons -->
    <div class="floating-icon absolute top-1/4 left-1/6 text-white opacity-20 text-4xl"><i class="fas fa-chart-line"></i>
    </div>
    <div class="floating-icon absolute top-1/3 right-1/5 text-white opacity-20 text-4xl"><i class="fas fa-rocket"></i>
    </div>
    <div class="floating-icon absolute bottom-1/4 left-1/4 text-white opacity-20 text-4xl"><i class="fas fa-trophy"></i>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <!-- Header -->
        <div class="text-center mb-16 max-w-3xl mx-auto animate-fadeIn">
            <h2 class="text-5xl font-bold text-white mb-6">{{ $impact->heading }}</h2>
            <p class="text-xl text-white opacity-90 leading-relaxed">{{ $impact->description }}</p>
        </div>

        <!-- Main Stats -->
        <div class="max-w-7xl mx-auto mb-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach ($impact->main_stats as $i => $stat)
                    <div class="stat-card bg-white bg-opacity-10 rounded-2xl p-4 text-center backdrop-blur-sm border border-white border-opacity-20 animate-fadeInUp"
                        style="animation-delay: {{ $i * 0.1 }}s;">
                        <div
                            class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas {{ $stat['icon'] }} text-white text-2xl"></i>
                        </div>
                        <div class="counter text-center text-5xl font-bold text-white mb-4"
                            data-target="{{ $stat['target'] }}" data-suffix="{{ $stat['suffix'] ?? '' }}">0
                            @if (!empty($stat['suffix']))
                                <span class="text-3xl text-white">{{ $stat['suffix'] }}</span>
                            @endif
                        </div>

                        <p class="text-white opacity-90 text-lg font-semibold mt-2">{{ $stat['label'] }}</p>
                        <div class="impact-bar mt-4 h-2 bg-white bg-opacity-20 rounded-full overflow-hidden">
                            <div class="impact-progress h-full bg-accent-500 transition-all duration-1000"
                                style="width: 0%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Performance Metrics -->
        <div class="max-w-4xl mx-auto mb-12 animate-fadeInUp" style="animation-delay: 0.4s;">
            <div class="bg-white bg-opacity-10 rounded-2xl p-4 backdrop-blur-sm border border-white border-opacity-20">
                <h3 class="text-2xl font-bold text-white text-center mb-8">Performance Metrics</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach ($impact->performance_metrics as $m)
                        <div class="text-center">
                            <div class="text-4xl font-bold text-white mb-2">{{ $m['value'] }}</div>
                            <p class="text-white opacity-90">{{ $m['label'] }}</p>
                            <div class="flex justify-center mt-3">
                                <i class="fas {{ $m['icon'] }} text-accent-500 text-xl"></i>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Industry Impact -->
        <div class="max-w-7xl mx-auto mb-12 animate-fadeInUp" style="animation-delay: 0.5s;">
            <h3 class="text-2xl font-bold text-white text-center mb-8">Industry Impact</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($impact->industry_impact as $ind)
                    <div class="bg-white bg-opacity-5 rounded-xl p-6 text-center border border-white border-opacity-10">
                        <div class="text-3xl font-bold text-white mb-2">{{ $ind['value'] }}</div>
                        <p class="text-white opacity-90">{{ $ind['label'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Growth Timeline -->
        <div class="max-w-4xl mx-auto mb-12 animate-fadeInUp" style="animation-delay: 0.6s;">
            <div class="bg-white bg-opacity-10 rounded-2xl p-4 backdrop-blur-sm border border-white border-opacity-20">
                <h3 class="text-2xl font-bold text-white text-center mb-4">Our Growth Journey</h3>
                <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                    @foreach ($impact->timeline as $i => $t)
                        <div class="text-center">
                            <div class="flex gap-2 font-bold text-white mb-2">
                                <p class="text-white opacity-90">{{ $t['label'] }}</p>
                                <p>{{ $t['year'] }}</p>
                            </div>

                            <div class="text-accent-500 mt-2">{{ $t['detail'] }}</div>
                        </div>
                        @if ($i < count($impact->timeline) - 1)
                            <div class="hidden md:block"><i
                                    class="fas fa-arrow-right text-white opacity-50 text-xl"></i></div>
                            <div class="block md:hidden"><i class="fas fa-arrow-down text-white opacity-50 text-xl"></i>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        <!-- CTA -->
        <div class="max-w-4xl mx-auto text-center animate-fadeInUp" style="animation-delay: 0.7s;">
            <h3 class="text-3xl font-bold text-white mb-4">{{ $impact->cta_heading }}</h3>
            <p class="text-xl text-white opacity-90 mb-8 max-w-2xl mx-auto">{{ $impact->cta_description }}</p>
            <div class="flex flex-wrap gap-4 justify-center">
                <a href="{{ $impact->cta_primary_link }}"
                    class="px-8 py-4 bg-white text-primary-700 font-semibold rounded-lg transition-all duration-300 hover:bg-primary-50 hover:shadow-lg flex items-center gap-2 animate-pulse-glow">
                    <i class="fas {{ $impact->cta_primary_icon }}"></i>
                    {{ $impact->cta_primary_text }}
                </a>
                <a href="{{ $impact->cta_secondary_link }}"
                    class="px-8 py-4 border-2 border-white text-white font-semibold rounded-lg transition-all duration-300 hover:bg-white hover:text-primary-700 flex items-center gap-2">
                    <i class="fas {{ $impact->cta_secondary_icon }}"></i>
                    {{ $impact->cta_secondary_text }}
                </a>
            </div>

            <!-- Trust Badges -->
            <div class="flex flex-wrap justify-center gap-6 mt-8">
                @foreach ($impact->trust_badges as $badge)
                    <div class="flex items-center gap-2 text-white opacity-80">
                        <i class="fas {{ $badge['icon'] }} text-accent-500"></i>
                        <span>{{ $badge['text'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const counters = document.querySelectorAll('.counter');
        const progressBars = document.querySelectorAll('.impact-progress');

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counter = entry.target.querySelector('.counter');
                    const bar = entry.target.querySelector('.impact-progress');
                    if (counter) animateCounter(counter);
                    if (bar) bar.style.width = bar.parentElement.dataset.progress + '%';
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.5
        });

        document.querySelectorAll('.stat-card').forEach(card => {
            card.querySelector('.impact-bar').dataset.progress = card.querySelector('.impact-progress')
                .style.width;
            card.querySelector('.impact-progress').style.width = '0%';
            observer.observe(card);
        });

        function animateCounter(el) {
            const target = +el.dataset.target;
            const suffix = el.dataset.suffix || '';
            const increment = target / 100;
            let current = 0;
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    el.textContent = target + suffix;
                    clearInterval(timer);
                } else {
                    el.textContent = Math.floor(current) + suffix;
                }
            }, 20);
        }
    });
</script>

<style>
    .impact-bar {
        @apply h-2 bg-white bg-opacity-20 rounded-full overflow-hidden;
    }

    .impact-progress {
        @apply h-full bg-accent-500 transition-all duration-1000;
    }

    .animate-pulse-glow {
        animation: pulse 2s infinite;
    }

    .floating-icon {
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-20px);
        }
    }
</style>
