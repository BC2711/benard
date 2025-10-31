@php $hero = \App\Models\HeroSection::first(); @endphp

<section class="gradient-bg min-h-screen flex items-center justify-center relative overflow-hidden"
    aria-labelledby="hero-heading">
    <!-- Background Elements (same as original) -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-10 left-10 w-20 h-20 bg-white/10 rounded-full animate-float"></div>
        <div class="absolute top-1/4 right-20 w-16 h-16 bg-accent-accent/20 rounded-lg animate-float"
            style="animation-delay: 2s;"></div>
        <div class="absolute bottom-20 left-20 w-24 h-24 bg-white/5 rounded-full animate-float"
            style="animation-delay: 4s;"></div>
        <div class="absolute bottom-1/3 right-10 w-12 h-12 bg-accent-accent/30 rounded-lg animate-float"
            style="animation-delay: 1s;"></div>
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-accent-accent/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-primary-primary/10 rounded-full blur-3xl"></div>
    </div>

    <div class="container mx-auto px-4 lg:px-8 relative z-10">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
            <!-- Content -->
            <div class="text-white animate-fade-in-up">
                <div class="mb-8">
                    <a href="/" class="inline-block group">
                        <div class="flex items-baseline space-x-2 mb-2">
                            <span class="text-4xl lg:text-5xl font-black text-white">{{ $hero->brand_name }}</span>
                            <span class="text-4xl lg:text-5xl font-black text-primary-primary">Loans</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-0.5 bg-accent-accent"></div>
                            <span
                                class="text-sm font-medium tracking-widest text-white/80 uppercase">{{ $hero->brand_tagline }}</span>
                            <div class="w-8 h-0.5 bg-accent-accent"></div>
                        </div>
                    </a>
                </div>

                <h1 id="hero-heading" class="text-4xl lg:text-5xl xl:text-6xl font-black leading-tight mb-6">
                    {{ $hero->heading }}
                    <span class="text-gradient">{{ $hero->highlighted_text }}</span>
                </h1>

                <p class="text-xl text-white/90 leading-relaxed mb-8 max-w-2xl">{{ $hero->description }}</p>

                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-6 mb-12">
                    <a href="{{ $hero->cta_link }}"
                        class="group relative bg-white text-primary-primary px-8 py-4 rounded-2xl font-bold text-lg shadow-2xl hover:shadow-3xl transition-all duration-300 hover:scale-105 flex items-center space-x-3">
                        <span>{{ $hero->cta_text }}</span>
                        <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform duration-300"></i>
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-accent-accent to-primary-primary rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300 -z-10 blur-md">
                        </div>
                    </a>

                    <div class="glass-hero-effect rounded-2xl p-4 backdrop-blur-sm">
                        <a href="tel:{{ str_replace([' ', '(', ')', '-'], '', $hero->phone_number) }}"
                            class="group flex items-center space-x-3 text-white hover:text-accent-accent transition-colors duration-300">
                            <div
                                class="w-12 h-12 bg-accent-accent/20 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-phone text-accent-accent text-lg"></i>
                            </div>
                            <div>
                                <div class="font-bold text-lg">{{ $hero->phone_number }}</div>
                                <div class="text-white/70 text-sm">{{ $hero->phone_label }}</div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Trust Stats -->
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                    <x-stat value="{{ $hero->stat_1_value }}" label="{{ $hero->stat_1_label }}" />
                    <x-stat value="{{ $hero->stat_2_value }}" label="{{ $hero->stat_2Agent_label }}" />
                    <x-stat value="{{ $hero->stat_3_value }}" label="{{ $hero->stat_3_label }}" />
                    <x-stat value="{{ $hero->stat_4_value }}" label="{{ $hero->stat_4_label }}" />
                </div>
            </div>

            <!-- Image Column -->
            <div class="relative animate-fade-in-right">
                <div class="bg-white/10 backdrop-blur-lg rounded-3xl p-8 shadow-2xl border border-white/20">
                    <div class="bg-gradient-to-br from-primary-primary to-secondary-secondary rounded-2xl p-1">
                        <div class="bg-white rounded-xl p-6 text-center">
                            <div
                                class="w-full h-64 bg-gradient-to-br from-accent-accent/20 to-primary-primary/10 rounded-lg flex items-center justify-center mb-4 overflow-hidden">
                                @if ($hero->hero_image)
                                    <img src="{{ asset('storage/' . $hero->hero_image) }}" alt="Hero Image"
                                        class="w-full h-full object-cover">
                                @else
                                    <div class="text-gray-400">No Image</div>
                                @endif
                            </div>
                            <h3 class="text-2xl font-bold text-secondary-secondary mb-2">{{ $hero->card_title }}</h3>
                            <p class="text-gray-600">{{ $hero->card_description }}</p>
                        </div>
                    </div>
                </div>

                <!-- Floating Badges -->
                <div class="absolute -top-4 -left-4 glass-hero-effect rounded-2xl p-4 shadow-xl animate-float">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-accent-accent rounded-xl flex items-center justify-center">
                            <i class="fas {{ $hero->badge_1_icon }} text-white"></i>
                        </div>
                        <div class="text-white">
                            <div class="font-bold">{{ $hero->badge_1_title }}</div>
                            <div class="text-white/70 text-xs">{{ $hero->badge_1_subtitle }}</div>
                        </div>
                    </div>
                </div>

                <div class="absolute -bottom-4 -right-4 glass-hero-effect rounded-2xl p-4 shadow-xl animate-float"
                    style="animation-delay: 2s;">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-primary-primary rounded-xl flex items-center justify-center">
                            <i class="fas {{ $hero->badge_2_icon }} text-white"></i>
                        </div>
                        <div class="text-white">
                            <div class="font-bold">{{ $hero->badge_2_title }}</div>
                            <div class="text-white/70 text-xs">{{ $hero->badge_2_subtitle }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <div class="w-6 h-10 border-2 border-white/30 rounded-full flex justify-center">
                <div class="w-1 h-3 bg-white/50 rounded-full mt-2"></div>
            </div>
        </div>
    </div>
</section>
