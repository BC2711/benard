@php $about = \App\Models\AboutSection::first();  @endphp

<section id="about" class="gradient-about-bg py-20 lg:py-28 relative overflow-hidden">
    {{-- Background blobs – unchanged --}}
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-accent-accent/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-primary-primary/10 rounded-full blur-3xl"></div>
        <div
            class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-white/5 rounded-full blur-3xl">
        </div>
    </div>

    {{-- Floating shapes – unchanged --}}
    <div class="absolute top-20 left-10 animate-float">
        <div class="w-20 h-20 bg-accent-accent/20 rounded-2xl rotate-12"></div>
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
                        class="inline-block px-4 py-2 bg-primary-primary_2/20 text-primary-primary_2 rounded-full text-sm font-semibold tracking-wider uppercase mb-4 border border-primary-primary/30">
                        {{ $about->section_label }}
                    </span>
                    <h2 class="text-4xl lg:text-5xl xl:text-6xl font-bold text-white mb-6 leading-tight">
                        {{ $about->heading }}
                        <span class="text-gradient">{{ $about->highlighted_text }}</span>
                    </h2>
                    <p class="text-xl text-white/80 leading-relaxed mb-8">
                        {{ $about->description }}
                    </p>
                </div>
                @php $features  = array($about->features); @endphp



                @if ($about->features)

                    <div class="grid sm:grid-cols-2 gap-6 mb-10">
                        @foreach ($features as $i => $f)
                            <div class="group glass-effect rounded-2xl p-6 hover-lift animate-fade-in-up"
                                style="animation-delay:{{ ($i + 1) * 100 }}ms">
                                <div class="flex items-start space-x-4">
                                    <div
                                        class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-primary-primary to-accent-accent rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                        <i class="fas {{ $f['icon'] ?? 'fa-circle' }} text-white text-lg"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-white font-bold text-lg mb-2">
                                            {{ $f['title'] ?? 'Feature Title' }}</h3>
                                        <p class="text-white/70 text-sm leading-relaxed">
                                            {{ $f['desc'] ?? 'Feature description' }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="grid sm:grid-cols-2 gap-6 mb-10">
                        {{-- Fallback features if JSON is invalid --}}
                        @php
                            $fallbackFeatures = [
                                [
                                    'icon' => 'fa-bolt',
                                    'title' => 'Fast Approval',
                                    'desc' => 'Get decisions within 24 hours and funding in 48 hours',
                                ],
                                [
                                    'icon' => 'fa-chart-line',
                                    'title' => 'Marketing Expertise',
                                    'desc' => 'Loans designed specifically for marketing campaigns',
                                ],
                                [
                                    'icon' => 'fa-sliders-h',
                                    'title' => 'Flexible Terms',
                                    'desc' => 'Repayment plans matching your ROI cycles',
                                ],
                                [
                                    'icon' => 'fa-headset',
                                    'title' => 'Dedicated Support',
                                    'desc' => 'Personalized assistance from finance specialists',
                                ],
                            ];
                        @endphp
                        @foreach ($fallbackFeatures as $i => $f)
                            <div class="group glass-effect rounded-2xl p-6 hover-lift animate-fade-in-up"
                                style="animation-delay:{{ ($i + 1) * 100 }}ms">
                                <div class="flex items-start space-x-4">
                                    <div
                                        class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-primary-primary to-accent-accent rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                        <i class="fas {{ $f['icon'] }} text-white text-lg"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-white font-bold text-lg mb-2">{{ $f['title'] }}</h3>
                                        <p class="text-white/70 text-sm leading-relaxed">{{ $f['desc'] }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- STATS --}}
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                    <x-stat value="{{ $about->stat_1_value }}" label="{{ $about->stat_1_label }}" delay="500ms" />
                    <x-stat value="{{ $about->stat_2_value }}" label="{{ $about->stat_2_label }}" delay="600ms" />
                    <x-stat value="{{ $about->stat_3_value }}" label="{{ $about->stat_3_label }}" delay="700ms" />
                    <x-stat value="{{ $about->stat_4_value }}" label="{{ $about->stat_4_label }}" delay="800ms" />
                </div>

                {{-- CTA --}}
                <div class="animate-fade-in-up" style="animation-delay:900ms">
                    <a href="{{ $about->cta_link }}"
                        class="group inline-flex items-center space-x-4 bg-white/10 hover:bg-white/20 border border-white/20 hover:border-white/30 text-white px-8 py-4 rounded-2xl font-semibold transition-all duration-300 hover-lift backdrop-blur-sm">
                        <div class="relative">
                            <div
                                class="w-12 h-12 bg-white rounded-full flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-play text-primary-primary text-lg ml-1"></i>
                            </div>
                            <div class="absolute inset-0 bg-white rounded-full animate-pulse-slow opacity-30"></div>
                        </div>
                        <span class="text-lg">{{ $about->cta_text }}</span>
                    </a>
                </div>
            </div>

            {{-- RIGHT COLUMN – IMAGES --}}
            <div class="relative">
                <div class="grid grid-cols-2 gap-6">
                    @foreach (['1', '2', '3', '4'] as $n)
                        <div class="animate-fade-in-up" style="animation-delay:{{ $n * 200 }}ms">
                            <div class="bg-white rounded-2xl p-4 shadow-2xl hover-lift">
                                <div
                                    class="aspect-square bg-gradient-to-br from-primary-primary/20 to-accent-accent/30 rounded-xl flex items-center justify-center overflow-hidden">
                                    @if ($about["image_{$n}"])
                                        <img src="{{ asset('storage/' . $about["image_{$n}"]) }}"
                                            alt="About image {{ $n }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="text-gray-400">No image</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Floating rating card --}}
                <div class="absolute -bottom-6 -left-6 animate-fade-in-up" style="animation-delay:1000ms">
                    <div class="glass-effect rounded-2xl p-6 shadow-2xl max-w-xs">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-accent-accent rounded-xl flex items-center justify-center">
                                <i class="fas {{ $about->rating_icon }} text-white"></i>
                            </div>
                            <div>
                                <div class="text-white font-bold">{{ $about->rating_value }}</div>
                                <div class="text-white/70 text-sm">{{ $about->rating_subtitle }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
