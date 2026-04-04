@php $about = \App\Models\AboutSection::first(); @endphp

<section id="about"
    class="bg-gradient-to-br from-primary-primary via-primary-800 to-primary-700 py-20 lg:py-28 relative overflow-hidden">

    {{-- Background Blobs --}}
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-primary-accent/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-primary-primary/10 rounded-full blur-3xl"></div>
        <div
            class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-white/5 rounded-full blur-3xl">
        </div>
    </div>

    {{-- Floating Shapes --}}
    <div class="absolute top-20 left-10 animate-float">
        <div class="w-20 h-20 bg-primary-accent/20 rounded-2xl rotate-12"></div>
    </div>
    <div class="absolute bottom-20 right-10 animate-float" style="animation-delay:2s;">
        <div class="w-16 h-16 bg-primary-primary/30 rounded-full"></div>
    </div>
    <div class="absolute top-1/3 right-20 animate-float" style="animation-delay:4s;">
        <div class="w-12 h-12 bg-white/20 rounded-lg rotate-45"></div>
    </div>

    <div class="container mx-auto px-4 lg:px-8 relative z-10">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">

            {{-- LEFT COLUMN – CONTENT --}}
            <div class="animate-slide-in-left">
                <div class="mb-8">
                    <span
                        class="inline-block px-4 py-2 bg-white/10 text-primary-accent rounded-full text-sm font-semibold tracking-wider uppercase mb-4 border border-white/20">
                        {{ $about->section_label }}
                    </span>
                    <h2 class="text-3xl lg:text-4xl xl:text-5xl font-black text-white mb-5 leading-tight">
                        {{ $about->heading }}
                        <span
                            class="bg-gradient-to-r from-primary-accent to-primary-secondary bg-clip-text text-transparent">{{ $about->highlighted_text }}</span>
                    </h2>
                    <p class="text-lg text-white/80 leading-relaxed mb-8">
                        {{ $about->description }}
                    </p>
                </div>

                {{-- Features Grid --}}
                @php $features = json_decode($about->features, true); @endphp
                @if ($about->features && count($features) > 0)
                    <div class="grid sm:grid-cols-2 gap-5 mb-10">
                        @foreach ($features as $i => $f)
                            <div class="group bg-white/10 backdrop-blur-sm rounded-xl p-4 hover:bg-white/15 transition-all duration-300 hover:-translate-y-1 animate-fade-in-up"
                                style="animation-delay:{{ ($i + 1) * 100 }}ms">
                                <div class="flex items-start gap-3">
                                    <div
                                        class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-primary-accent to-primary-secondary rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                        <i class="fas {{ $f['icon'] ?? 'fa-circle' }} text-primary-primary text-sm"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-white font-bold text-sm mb-1">
                                            {{ $f['title'] ?? 'Feature Title' }}</h3>
                                        <p class="text-white/70 text-xs leading-relaxed">
                                            {{ $f['desc'] ?? 'Feature description' }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    {{-- Fallback Features --}}
                    <div class="grid sm:grid-cols-2 gap-5 mb-10">
                        @php
                            $fallbackFeatures = [
                                [
                                    'icon' => 'fa-bolt',
                                    'title' => 'Fast Approval',
                                    'desc' => 'Get decisions within 24 hours',
                                ],
                                [
                                    'icon' => 'fa-chart-line',
                                    'title' => 'Marketing Expertise',
                                    'desc' => 'Loans for marketing campaigns',
                                ],
                                [
                                    'icon' => 'fa-sliders-h',
                                    'title' => 'Flexible Terms',
                                    'desc' => 'Repayment plans matching your ROI',
                                ],
                                [
                                    'icon' => 'fa-headset',
                                    'title' => 'Dedicated Support',
                                    'desc' => 'Personalized finance assistance',
                                ],
                            ];
                        @endphp
                        @foreach ($fallbackFeatures as $i => $f)
                            <div class="group bg-white/10 backdrop-blur-sm rounded-xl p-4 hover:bg-white/15 transition-all duration-300 hover:-translate-y-1 animate-fade-in-up"
                                style="animation-delay:{{ ($i + 1) * 100 }}ms">
                                <div class="flex items-start gap-3">
                                    <div
                                        class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-primary-accent to-primary-secondary rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                        <i class="fas {{ $f['icon'] }} text-primary-primary text-sm"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-white font-bold text-sm mb-1">{{ $f['title'] }}</h3>
                                        <p class="text-white/70 text-xs leading-relaxed">{{ $f['desc'] }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- Stats --}}
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                    <div class="text-center animate-fade-in-up" style="animation-delay:500ms">
                        <div class="text-2xl font-black text-primary-accent">{{ $about->stat_1_value }}</div>
                        <div class="text-white/60 text-xs font-semibold uppercase tracking-wider">
                            {{ $about->stat_1_label }}</div>
                    </div>
                    <div class="text-center animate-fade-in-up" style="animation-delay:600ms">
                        <div class="text-2xl font-black text-primary-accent">{{ $about->stat_2_value }}</div>
                        <div class="text-white/60 text-xs font-semibold uppercase tracking-wider">
                            {{ $about->stat_2_label }}</div>
                    </div>
                    <div class="text-center animate-fade-in-up" style="animation-delay:700ms">
                        <div class="text-2xl font-black text-primary-accent">{{ $about->stat_3_value }}</div>
                        <div class="text-white/60 text-xs font-semibold uppercase tracking-wider">
                            {{ $about->stat_3_label }}</div>
                    </div>
                    <div class="text-center animate-fade-in-up" style="animation-delay:800ms">
                        <div class="text-2xl font-black text-primary-accent">{{ $about->stat_4_value }}</div>
                        <div class="text-white/60 text-xs font-semibold uppercase tracking-wider">
                            {{ $about->stat_4_label }}</div>
                    </div>
                </div>

                {{-- CTA Button --}}
                <div class="animate-fade-in-up" style="animation-delay:900ms">
                    <a href="{{ $about->cta_link }}"
                        class="group inline-flex items-center gap-3 bg-white/10 hover:bg-white/20 border border-white/20 hover:border-white/30 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 hover:-translate-y-1 backdrop-blur-sm">
                        <div class="relative">
                            <div
                                class="w-10 h-10 bg-primary-accent rounded-full flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-play text-primary-primary text-sm ml-0.5"></i>
                            </div>
                            <div class="absolute inset-0 bg-primary-accent rounded-full animate-pulse-slow opacity-30">
                            </div>
                        </div>
                        <span class="text-sm">{{ $about->cta_text }}</span>
                        <i
                            class="fas fa-arrow-right text-xs group-hover:translate-x-1 transition-transform duration-300"></i>
                    </a>
                </div>
            </div>

            {{-- RIGHT COLUMN – IMAGES --}}
            <div class="relative">
                <div class="grid grid-cols-2 gap-4">
                    @foreach (['1', '2', '3', '4'] as $n)
                        <div class="animate-fade-in-up" style="animation-delay:{{ $n * 200 }}ms">
                            <div
                                class="bg-white/10 backdrop-blur-sm rounded-xl p-3 shadow-xl hover:-translate-y-2 transition-all duration-300">
                                <div
                                    class="aspect-square bg-gradient-to-br from-primary-accent/20 to-primary-secondary/20 rounded-lg flex items-center justify-center overflow-hidden">
                                    @if ($about["image_{$n}"])
                                        <img src="{{ asset('storage/' . $about["image_{$n}"]) }}"
                                            alt="About image {{ $n }}"
                                            class="w-full h-full object-cover rounded-lg">
                                    @else
                                        <div class="text-white/40 text-sm">No image</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Floating Rating Card --}}
                <div class="absolute -bottom-5 -left-5 animate-fade-in-up" style="animation-delay:1000ms">
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 shadow-2xl border border-white/20">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-primary-accent rounded-lg flex items-center justify-center">
                                <i class="fas {{ $about->rating_icon }} text-primary-primary text-sm"></i>
                            </div>
                            <div>
                                <div class="text-white font-bold text-sm">{{ $about->rating_value }}</div>
                                <div class="text-white/60 text-xs">{{ $about->rating_subtitle }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Animations */
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

    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-30px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
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

    @keyframes pulse-slow {

        0%,
        100% {
            opacity: 0.3;
            transform: scale(1);
        }

        50% {
            opacity: 0.6;
            transform: scale(1.1);
        }
    }

    .animate-fade-in-up {
        animation: fadeInUp 0.5s ease-out forwards;
        opacity: 0;
    }

    .animate-slide-in-left {
        animation: slideInLeft 0.6s ease-out forwards;
        opacity: 0;
    }

    .animate-float {
        animation: float 6s ease-in-out infinite;
    }

    .animate-pulse-slow {
        animation: pulse-slow 2s ease-in-out infinite;
    }
</style>
