@php $clients = \App\Models\TrustedClientsSection::first(); @endphp

<section id="trusted-clients" class="relative overflow-hidden py-20 gradient-client-bg">
    <!-- Background -->
    <div class="shape w-64 h-64 rounded-full bg-primary-100 opacity-20 top-10 -left-20 animate-float"></div>
    <div class="shape w-40 h-40 rounded-full bg-accent-100 opacity-30 bottom-20 -right-10 animate-float"
        style="animation-delay: 2s;"></div>
    <div class="shape w-32 h-32 rounded-full bg-primary-100 opacity-20 top-1/3 right-1/4 animate-float"
        style="animation-delay: 4s;"></div>

    <!-- Floating Icons -->
    <div class="shape absolute top-1/4 left-1/6 text-primary-500 opacity-10 text-6xl"><i class="fas fa-users"></i></div>
    <div class="shape absolute top-1/3 right-1/5 text-accent-500 opacity-10 text-5xl"><i class="fas fa-handshake"></i>
    </div>
    <div class="shape absolute bottom-1/4 left-1/4 text-primary-500 opacity-10 text-4xl"><i class="fas fa-star"></i>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <!-- Header -->
        <div class="text-center mb-16 max-w-3xl mx-auto animate-fadeIn">
            <h2 class="text-5xl font-bold text-primary-700 mb-6">{{ $clients->heading }}</h2>
            <p class="text-xl text-gray-600 leading-relaxed">{{ $clients->description }}</p>
        </div>

        <!-- Industry Badges -->
        <div class="max-w-4xl mx-auto mb-12 animate-fadeInUp">
            <h3 class="text-2xl font-bold text-primary-700 text-center mb-8">Industry Distribution</h3>
            <div class="flex flex-wrap justify-center gap-4">
                @foreach ($clients->industry_badges as $b)
                    <div
                        class="industry-badge bg-primary-100 text-primary-700 px-6 py-3 rounded-full font-semibold flex items-center gap-2">
                        <i class="fas {{ $b['icon'] }}"></i>
                        <span>{{ $b['text'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Client Carousel -->
        <div class="max-w-7xl mx-auto mb-16 animate-fadeInUp" style="animation-delay: 0.1s;">
            <div class="swiper clients-swiper">
                <div class="swiper-wrapper">
                    @foreach ($clients->clients as $c)
                        <div class="swiper-slide">
                            <div class="client-card bg-white rounded-2xl p-8 shadow-lg border border-gray-100 h-full">
                                <div class="text-center h-full flex flex-col">
                                    <div
                                        class="w-20 h-20 bg-gradient-to-br from-primary-500 to-accent-500 rounded-full flex items-center justify-center text-white text-2xl font-bold mx-auto mb-4">
                                        {{ $c['initials'] }}
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-2xl font-bold text-primary-700 mb-2">{{ $c['name'] }}</h4>
                                        <p class="text-accent-500 font-semibold mb-4">{{ $c['type'] }}</p>
                                        <p class="text-gray-600 text-sm leading-relaxed">{{ $c['description'] }}</p>
                                    </div>
                                    <div class="mt-4 pt-4 border-t border-gray-100">
                                        <div class="flex justify-center gap-2 text-sm text-gray-500">
                                            @foreach ($c['tags'] as $tag)
                                                <span
                                                    class="bg-primary-50 text-primary-700 px-2 py-1 rounded">{{ $tag }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Navigation - Moved outside Swiper container -->
            <div class="flex justify-center items-center gap-6 mt-8">
                <div
                    class="swiper-button-prev w-12 h-12 bg-white border-2 border-primary-700 rounded-full flex items-center justify-center cursor-pointer transition-all duration-300 hover:bg-primary-700 group shadow-lg">
                    <i
                        class="fas fa-chevron-left text-primary-700 text-sm transition-colors duration-300 group-hover:text-white"></i>
                </div>

                <div class="swiper-pagination flex gap-3 items-center"></div>

                <div
                    class="swiper-button-next w-12 h-12 bg-white border-2 border-primary-700 rounded-full flex items-center justify-center cursor-pointer transition-all duration-300 hover:bg-primary-700 group shadow-lg">
                    <i
                        class="fas fa-chevron-right text-primary-700 text-sm transition-colors duration-300 group-hover:text-white"></i>
                </div>
            </div>
        </div>

        <!-- Success Highlights -->
        <div class="max-w-6xl mx-auto mb-16">
            <h3 class="text-3xl font-bold text-primary-700 text-center mb-12">Client Success Highlights</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($clients->highlights as $i => $h)
                    <div class="highlight-card bg-white rounded-2xl p-6 shadow-lg border border-gray-100 animate-fadeInUp"
                        style="animation-delay: {{ $i * 0.1 }}s;">
                        <div class="flex items-start gap-4 mb-4">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-primary-500 to-accent-500 rounded-lg flex items-center justify-center text-white font-bold text-lg">
                                {{ $h['amount'] }}
                            </div>
                            <div>
                                <h4 class="text-xl font-bold text-primary-700 mb-1">{{ $h['client'] }}</h4>
                                <p class="text-accent-500 font-semibold">{{ $h['type'] }}</p>
                            </div>
                        </div>
                        <p class="text-gray-600 mb-4">{{ $h['result'] }}</p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2 text-sm text-gray-500">
                                <i class="fas fa-chart-line"></i>
                                <span>{{ $h['metric'] }}</span>
                            </div>
                            <div class="text-primary-700 font-semibold">{{ $h['timeline'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Testimonials -->
        <div class="max-w-4xl mx-auto mb-16 animate-fadeInUp" style="animation-delay: 0.3s;">
            <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100">
                <h3 class="text-2xl font-bold text-primary-700 text-center mb-8">What Our Clients Say</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @foreach ($clients->testimonials as $t)
                        <div class="text-center">
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-primary-500 to-accent-500 rounded-full flex items-center justify-center text-white text-xl font-bold mx-auto mb-4">
                                {{ $t['initials'] }}
                            </div>
                            <p class="text-gray-600 italic mb-4">"{{ $t['quote'] }}"</p>
                            <div class="font-semibold text-primary-700">{{ $t['name'] }}</div>
                            <div class="text-accent-500 text-sm">{{ $t['role'] }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- CTA -->
        <div class="max-w-4xl mx-auto text-center animate-fadeInUp" style="animation-delay: 0.4s;">
            <h3 class="text-3xl font-bold text-primary-700 mb-4">{{ $clients->cta_heading }}</h3>
            <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">{{ $clients->cta_description }}</p>
            <div class="flex flex-wrap gap-4 justify-center">
                <a href="{{ $clients->cta_primary_link }}"
                    class="px-8 py-4 bg-accent-500 text-white font-semibold rounded-lg transition-all duration-300 hover:bg-accent-600 hover:shadow-lg flex items-center gap-2">
                    <i class="fas {{ $clients->cta_primary_icon }}"></i>
                    {{ $clients->cta_primary_text }}
                </a>
                <a href="{{ $clients->cta_secondary_link }}"
                    class="px-8 py-4 border-2 border-primary-700 text-primary-700 font-semibold rounded-lg transition-all duration-300 hover:bg-primary-700 hover:text-white flex items-center gap-2">
                    <i class="fas {{ $clients->cta_secondary_icon }}"></i>
                    {{ $clients->cta_secondary_text }}
                </a>
            </div>

            <!-- Trust Indicators -->
            <div class="flex flex-wrap justify-center gap-6 mt-8">
                @foreach ($clients->trust_indicators as $ti)
                    <div class="flex items-center gap-2 text-gray-600">
                        <i class="fas {{ $ti['icon'] }} text-accent-500"></i>
                        <span>{{ $ti['text'] }}</span>
                    </div>
                @endforeach
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
            spaceBetween: 30,
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
    });
</script>

<style>
    .gradient-client-bg {
        background: linear-gradient(135deg, #db9123 0%, #c08a39 50%, #805a21 100%);
    }

    .industry-badge {
        transition: all 0.3s ease;
    }

    .industry-badge:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.2);
    }

    .shape {
        position: absolute;
        z-index: 0;
    }

    .animate-float {
        animation: float 6s ease-in-out infinite;
    }

    .animate-fadeIn {
        animation: fadeIn 0.6s ease-in;
    }

    .animate-fadeInUp {
        animation: fadeInUp 0.6s ease-in;
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

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

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

    /* Custom Swiper Navigation Styles */
    .swiper-pagination {
        position: relative !important;
        bottom: auto !important;
        display: flex;
        align-items: center;
        gap: 12px;
        margin: 0 20px;
    }

    .swiper-pagination-bullet-custom {
        background: #db9123;
        opacity: 0.3;
        width: 10px;
        height: 10px;
        margin: 0 !important;
        transition: all 0.3s ease;
        border-radius: 5px;
    }

    .swiper-pagination-bullet-custom-active {
        background: #db9123;
        opacity: 1;
        width: 24px;
        transform: scale(1);
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

    .client-card {
        transition: all 0.3s ease;
    }

    .client-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }

    .highlight-card {
        transition: all 0.3s ease;
    }

    .highlight-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
</style>
