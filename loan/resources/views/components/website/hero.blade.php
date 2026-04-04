@php $hero = \App\Models\HeroSection::first(); @endphp

<section
    class="bg-gradient-to-br from-primary-primary via-primary-800 to-primary-700 min-h-screen flex items-center justify-center relative overflow-hidden"
    aria-labelledby="hero-heading">

    <!-- Background Elements -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-10 left-10 w-20 h-20 bg-white/10 rounded-full animate-float"></div>
        <div class="absolute top-1/4 right-20 w-16 h-16 bg-primary-accent/20 rounded-lg animate-float"
            style="animation-delay: 2s;"></div>
        <div class="absolute bottom-20 left-20 w-24 h-24 bg-white/5 rounded-full animate-float"
            style="animation-delay: 4s;"></div>
        <div class="absolute bottom-1/3 right-10 w-12 h-12 bg-primary-accent/30 rounded-lg animate-float"
            style="animation-delay: 1s;"></div>
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-primary-accent/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-primary-primary/10 rounded-full blur-3xl"></div>
    </div>

    <div class="container mx-auto px-4 lg:px-8 relative z-10">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">

            <!-- Left Content -->
            <div class="text-white animate-fade-in-up">
                <!-- Brand -->
                <div class="mb-8">
                    <a href="/" class="inline-block group">
                        <div class="flex items-baseline space-x-2 mb-2">
                            <span class="text-2xl lg:text-3xl font-black text-white">{{ $hero->brand_name }}</span>
                            <span class="text-2xl lg:text-3xl font-black text-primary-accent">Loans</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-0.5 bg-primary-accent"></div>
                            <span
                                class="text-sm font-medium tracking-widest text-white/80 uppercase">{{ $hero->brand_tagline }}</span>
                            <div class="w-8 h-0.5 bg-primary-accent"></div>
                        </div>
                    </a>
                </div>

                <!-- Heading -->
                <h1 id="hero-heading" class="text-3xl lg:text-4xl xl:text-5xl font-black leading-tight mb-5">
                    {{ $hero->heading }}
                    <span
                        class="bg-gradient-to-r from-primary-accent to-primary-secondary bg-clip-text text-transparent">{{ $hero->highlighted_text }}</span>
                </h1>

                <!-- Description -->
                <p class="text-lg text-white/80 leading-relaxed mb-8 max-w-2xl">{{ $hero->description }}</p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-5 mb-10">
                    <a href="{{ $hero->cta_link }}"
                        class="group relative bg-white text-primary-primary px-7 py-3 rounded-xl font-bold shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 flex items-center gap-2">
                        <span>{{ $hero->cta_text }}</span>
                        <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform duration-300"></i>
                    </a>

                    <div class="glass-hero-effect rounded-xl p-3 backdrop-blur-sm bg-white/10">
                        <a href="tel:{{ preg_replace('/\D/', '', $hero->phone_number) }}"
                            class="group flex items-center gap-3 text-white hover:text-primary-accent transition-colors duration-300">
                            <div
                                class="w-10 h-10 bg-primary-accent/20 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-phone text-primary-accent"></i>
                            </div>
                            <div>
                                <div class="font-bold">{{ $hero->phone_number }}</div>
                                <div class="text-white/60 text-xs">{{ $hero->phone_label }}</div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Trust Stats -->
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-5">
                    <div class="text-center">
                        <div class="text-2xl font-black text-primary-accent">{{ $hero->stat_1_value }}</div>
                        <div class="text-white/70 text-xs font-semibold uppercase tracking-wider">
                            {{ $hero->stat_1_label }}</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-black text-primary-accent">{{ $hero->stat_2_value }}</div>
                        <div class="text-white/70 text-xs font-semibold uppercase tracking-wider">
                            {{ $hero->stat_2Agent_label }}</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-black text-primary-accent">{{ $hero->stat_3_value }}</div>
                        <div class="text-white/70 text-xs font-semibold uppercase tracking-wider">
                            {{ $hero->stat_3_label }}</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-black text-primary-accent">{{ $hero->stat_4_value }}</div>
                        <div class="text-white/70 text-xs font-semibold uppercase tracking-wider">
                            {{ $hero->stat_4_label }}</div>
                    </div>
                </div>
            </div>

            <!-- Right Image Column -->
            <div class="relative animate-fade-in-right">
                <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-6 shadow-2xl border border-white/20">
                    <div class="bg-gradient-to-br from-primary-primary to-primary-secondary rounded-xl p-1">
                        <div class="bg-white rounded-lg p-5 text-center">
                            <div
                                class="w-full h-56 bg-gradient-to-br from-primary-accent/20 to-primary-primary/10 rounded-lg flex items-center justify-center mb-3 overflow-hidden">
                                @if ($hero->hero_image)
                                    <img src="{{ asset('storage/' . $hero->hero_image) }}" alt="Hero Image"
                                        class="w-full h-full object-cover">
                                @else
                                    <div class="text-gray-400">No Image</div>
                                @endif
                            </div>
                            <h3 class="text-xl font-bold text-primary-primary mb-1">{{ $hero->card_title }}</h3>
                            <p class="text-gray-500 text-sm">{{ $hero->card_description }}</p>
                        </div>
                    </div>
                </div>

                <!-- Floating Badge 1 -->
                <div
                    class="absolute -top-4 -left-4 glass-hero-effect rounded-xl p-3 shadow-xl animate-float bg-white/10 backdrop-blur-sm">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-primary-accent rounded-lg flex items-center justify-center">
                            <i class="fas {{ $hero->badge_1_icon }} text-white text-sm"></i>
                        </div>
                        <div>
                            <div class="font-bold text-white text-sm">{{ $hero->badge_1_title }}</div>
                            <div class="text-white/60 text-xs">{{ $hero->badge_1_subtitle }}</div>
                        </div>
                    </div>
                </div>

                <!-- Floating Badge 2 -->
                <div class="absolute -bottom-4 -right-4 glass-hero-effect rounded-xl p-3 shadow-xl animate-float bg-white/10 backdrop-blur-sm"
                    style="animation-delay: 2s;">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-primary-primary rounded-lg flex items-center justify-center">
                            <i class="fas {{ $hero->badge_2_icon }} text-white text-sm"></i>
                        </div>
                        <div>
                            <div class="font-bold text-white text-sm">{{ $hero->badge_2_title }}</div>
                            <div class="text-white/60 text-xs">{{ $hero->badge_2_subtitle }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <div class="w-6 h-10 border-2 border-white/30 rounded-full flex justify-center">
                <div class="w-1 h-3 bg-primary-accent rounded-full mt-2 animate-pulse"></div>
            </div>
        </div>
    </div>
</section>

<style>
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

    @keyframes fadeInRight {
        from {
            opacity: 0;
            transform: translateX(30px);
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

    @keyframes bounce {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(10px);
        }
    }

    .animate-fade-in-up {
        animation: fadeInUp 0.8s ease-out forwards;
        opacity: 0;
    }

    .animate-fade-in-right {
        animation: fadeInRight 0.8s ease-out forwards;
        opacity: 0;
    }

    .animate-float {
        animation: float 6s ease-in-out infinite;
    }

    .animate-bounce {
        animation: bounce 2s ease-in-out infinite;
    }

    .animate-pulse {
        animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {

        0%,
        100% {
            opacity: 0.5;
        }

        50% {
            opacity: 1;
        }
    }

    /* Glass effect */
    .glass-hero-effect {
        backdrop-filter: blur(8px);
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
</style>
