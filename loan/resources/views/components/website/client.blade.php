@php $clients = \App\Models\TrustedClientsSection::first(); @endphp

<section id="trusted-clients" class="relative overflow-hidden py-20 bg-gradient-to-br from-primary-50 to-white">
    <!-- Background Shapes -->
    <div class="absolute w-64 h-64 rounded-full bg-primary-100/30 top-10 -left-20 animate-float"></div>
    <div class="absolute w-40 h-40 rounded-full bg-primary-accent/20 bottom-20 -right-10 animate-float"
        style="animation-delay: 2s;"></div>
    <div class="absolute w-32 h-32 rounded-full bg-primary-100/30 top-1/3 right-1/4 animate-float"
        style="animation-delay: 4s;"></div>

    <!-- Floating Icons -->
    <div class="absolute top-1/4 left-1/6 text-primary-primary/5 text-6xl animate-float"><i class="fas fa-users"></i>
    </div>
    <div class="absolute top-1/3 right-1/5 text-primary-secondary/5 text-5xl animate-float" style="animation-delay: 1s;">
        <i class="fas fa-handshake"></i></div>
    <div class="absolute bottom-1/4 left-1/4 text-primary-accent/5 text-4xl animate-float" style="animation-delay: 2s;">
        <i class="fas fa-star"></i></div>

    <div class="container mx-auto px-4 relative z-10">
        <!-- Header -->
        <div class="text-center mb-16 max-w-3xl mx-auto animate-fade-in-up">
            <div
                class="inline-flex items-center space-x-2 bg-primary-100 text-primary-primary px-4 py-2 rounded-full text-sm font-semibold uppercase tracking-wider mb-6 border border-primary-200">
                <i class="fas fa-building text-xs"></i>
                <span>Trusted Partners</span>
            </div>
            <h2 class="text-3xl lg:text-4xl xl:text-5xl font-black text-primary-primary mb-4">{{ $clients->heading }}
            </h2>
            <div class="w-20 h-1 bg-primary-secondary mx-auto rounded-full mb-6"></div>
            <p class="text-lg text-gray-600 leading-relaxed">{{ $clients->description }}</p>
        </div>

        <!-- Industry Badges -->
        <div class="max-w-4xl mx-auto mb-12 animate-fade-in-up">
            <h3 class="text-xl font-bold text-primary-primary text-center mb-6">Industry Distribution</h3>
            <div class="flex flex-wrap justify-center gap-3">
                @foreach ($clients->industry_badges as $b)
                    <div
                        class="industry-badge bg-primary-100 text-primary-primary px-5 py-2 rounded-full font-semibold text-sm flex items-center gap-2 hover:bg-primary-primary hover:text-white transition-all duration-300">
                        <i class="fas {{ $b['icon'] }}"></i>
                        <span>{{ $b['text'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Client Carousel -->
        <div class="max-w-7xl mx-auto mb-16 animate-fade-in-up" style="animation-delay: 0.1s;">
            <div class="swiper clients-swiper">
                <div class="swiper-wrapper">
                    @foreach ($clients->clients as $c)
                        <div class="swiper-slide">
                            <div
                                class="client-card bg-white rounded-2xl p-6 shadow-lg border border-primary-100 hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 h-full">
                                <div class="text-center h-full flex flex-col">
                                    <div
                                        class="w-20 h-20 bg-gradient-to-br from-primary-primary to-primary-secondary rounded-full flex items-center justify-center text-white text-xl font-bold mx-auto mb-4 shadow-lg">
                                        {{ $c['initials'] }}
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-xl font-bold text-primary-primary mb-1">{{ $c['name'] }}</h4>
                                        <p class="text-primary-secondary font-semibold text-sm mb-3">{{ $c['type'] }}
                                        </p>
                                        <p class="text-gray-500 text-sm leading-relaxed">{{ $c['description'] }}</p>
                                    </div>
                                    <div class="mt-4 pt-3 border-t border-primary-100">
                                        <div class="flex flex-wrap justify-center gap-2">
                                            @foreach ($c['tags'] as $tag)
                                                <span
                                                    class="bg-primary-50 text-primary-primary text-xs px-2 py-1 rounded">{{ $tag }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Navigation -->
            <div class="flex justify-center items-center gap-4 mt-8">
                <div
                    class="swiper-button-prev w-10 h-10 bg-white border-2 border-primary-secondary rounded-full flex items-center justify-center cursor-pointer transition-all duration-300 hover:bg-primary-secondary group shadow-md">
                    <i
                        class="fas fa-chevron-left text-primary-secondary text-sm transition-colors duration-300 group-hover:text-white"></i>
                </div>
                <div class="swiper-pagination relative !bottom-auto !w-auto"></div>
                <div
                    class="swiper-button-next w-10 h-10 bg-white border-2 border-primary-secondary rounded-full flex items-center justify-center cursor-pointer transition-all duration-300 hover:bg-primary-secondary group shadow-md">
                    <i
                        class="fas fa-chevron-right text-primary-secondary text-sm transition-colors duration-300 group-hover:text-white"></i>
                </div>
            </div>
        </div>

        <!-- Success Highlights -->
        <div class="max-w-6xl mx-auto mb-16">
            <h3 class="text-2xl font-bold text-primary-primary text-center mb-10">Client Success Highlights</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($clients->highlights as $i => $h)
                    <div class="highlight-card bg-white rounded-xl p-5 shadow-lg border border-primary-100 hover:shadow-xl transition-all duration-300 hover:-translate-y-1 animate-fade-in-up"
                        style="animation-delay: {{ $i * 0.1 }}s;">
                        <div class="flex items-start gap-3 mb-3">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-primary-primary to-primary-secondary rounded-lg flex items-center justify-center text-white font-bold text-sm">
                                {{ $h['amount'] }}
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-primary-primary mb-0.5">{{ $h['client'] }}</h4>
                                <p class="text-primary-secondary text-xs font-semibold">{{ $h['type'] }}</p>
                            </div>
                        </div>
                        <p class="text-gray-500 text-sm mb-3">{{ $h['result'] }}</p>
                        <div class="flex items-center justify-between pt-2 border-t border-primary-100">
                            <div class="flex items-center gap-2 text-xs text-gray-400">
                                <i class="fas fa-chart-line text-primary-secondary"></i>
                                <span>{{ $h['metric'] }}</span>
                            </div>
                            <div class="text-primary-primary text-xs font-semibold">{{ $h['timeline'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Testimonials -->
        <div class="max-w-4xl mx-auto mb-16 animate-fade-in-up" style="animation-delay: 0.3s;">
            <div class="bg-white rounded-2xl p-6 shadow-xl border border-primary-100">
                <h3 class="text-xl font-bold text-primary-primary text-center mb-6">What Our Clients Say</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach ($clients->testimonials as $t)
                        <div class="text-center p-4 rounded-xl bg-primary-50/30">
                            <div
                                class="w-14 h-14 bg-gradient-to-br from-primary-primary to-primary-secondary rounded-full flex items-center justify-center text-white text-lg font-bold mx-auto mb-3 shadow-md">
                                {{ $t['initials'] }}
                            </div>
                            <p class="text-gray-500 italic text-sm mb-3">"{{ $t['quote'] }}"</p>
                            <div class="font-bold text-primary-primary text-sm">{{ $t['name'] }}</div>
                            <div class="text-primary-secondary text-xs">{{ $t['role'] }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- CTA -->
        <div class="max-w-4xl mx-auto text-center animate-fade-in-up" style="animation-delay: 0.4s;">
            <div class="bg-gradient-to-br from-primary-primary to-primary-700 rounded-2xl p-8 shadow-2xl">
                <h3 class="text-2xl lg:text-3xl font-bold text-white mb-3">{{ $clients->cta_heading }}</h3>
                <p class="text-white/80 mb-6 max-w-2xl mx-auto">{{ $clients->cta_description }}</p>
                <div class="flex flex-wrap gap-4 justify-center">
                    <a href="{{ $clients->cta_primary_link }}"
                        class="px-6 py-3 bg-white text-primary-primary font-bold rounded-xl transition-all duration-300 hover:bg-primary-50 hover:shadow-xl hover:scale-105 flex items-center gap-2">
                        <i class="fas {{ $clients->cta_primary_icon }}"></i>
                        {{ $clients->cta_primary_text }}
                        <i class="fas fa-arrow-right text-sm"></i>
                    </a>
                    <a href="{{ $clients->cta_secondary_link }}"
                        class="px-6 py-3 border-2 border-white text-white font-bold rounded-xl transition-all duration-300 hover:bg-white hover:text-primary-primary flex items-center gap-2">
                        <i class="fas {{ $clients->cta_secondary_icon }}"></i>
                        {{ $clients->cta_secondary_text }}
                    </a>
                </div>

                <!-- Trust Indicators -->
                <div class="flex flex-wrap justify-center gap-5 mt-8 pt-4 border-t border-white/20">
                    @foreach ($clients->trust_indicators as $ti)
                        <div class="flex items-center gap-2 text-white/70 text-sm">
                            <i class="fas {{ $ti['icon'] }} text-primary-accent"></i>
                            <span>{{ $ti['text'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Swiper JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const clientsSwiper = new Swiper('.clients-swiper', {
            loop: true,
            slidesPerView: 1,
            spaceBetween: 24,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
                renderBullet: function(index, className) {
                    return '<span class="' + className +
                    ' swiper-pagination-bullet-custom"></span>';
                }
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev'
            },
            breakpoints: {
                768: {
                    slidesPerView: 2
                },
                1024: {
                    slidesPerView: 3
                }
            },
            autoplay: {
                delay: 5000,
                disableOnInteraction: false
            }
        });

        // Pause on hover
        const swiperContainer = document.querySelector('.clients-swiper');
        swiperContainer.addEventListener('mouseenter', () => clientsSwiper.autoplay.stop());
        swiperContainer.addEventListener('mouseleave', () => clientsSwiper.autoplay.start());
    });
</script>

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

    /* Industry Badge Hover */
    .industry-badge {
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .industry-badge:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(122, 70, 3, 0.2);
    }

    /* Client Card */
    .client-card {
        transition: all 0.3s ease;
    }

    /* Swiper Custom Styles */
    .swiper-pagination {
        position: relative !important;
        bottom: auto !important;
        display: flex;
        align-items: center;
        gap: 8px;
        width: auto !important;
    }

    .swiper-pagination-bullet-custom {
        background: #db9123;
        opacity: 0.3;
        width: 8px;
        height: 8px;
        margin: 0 !important;
        transition: all 0.3s ease;
        border-radius: 50%;
        cursor: pointer;
    }

    .swiper-pagination-bullet-custom-active {
        background: #db9123;
        opacity: 1;
        width: 24px;
        border-radius: 4px;
    }

    .swiper-button-prev,
    .swiper-button-next {
        position: relative !important;
        top: auto !important;
        margin-top: 0 !important;
        transform: none !important;
    }

    .swiper-button-prev:after,
    .swiper-button-next:after {
        display: none;
    }

    /* Highlight Card */
    .highlight-card {
        transition: all 0.3s ease;
    }
</style>
