@php $ts = \App\Models\TestimonialsSection::first(); @endphp

<section id="testimonials" class="relative overflow-hidden py-20 testimonial-gradient">
    <!-- Background -->
    <div class="shape w-64 h-64 rounded-full bg-white opacity-10 top-10 -left-20 animate-float"></div>
    <div class="shape w-40 h-40 rounded-full bg-white opacity-15 bottom-20 -right-10 animate-float"
        style="animation-delay: 2s;"></div>
    <div class="shape w-32 h-32 rounded-full bg-white opacity-10 top-1/3 right-1/4 animate-float"
        style="animation-delay: 4s;"></div>

    <div class="container mx-auto px-4 relative z-10">
        <!-- Header -->
        <div class="text-center mb-16 max-w-3xl mx-auto animate-fadeIn">
            <h2 class="text-5xl font-bold text-white mb-6">{{ $ts->heading }}</h2>
            <p class="text-xl text-white opacity-90 leading-relaxed">{{ $ts->description }}</p>
        </div>

        <!-- Video Highlight -->
        <div class="max-w-4xl mx-auto mb-16 animate-fadeInUp">
            <div class="video-testimonial h-80 bg-gray-800 rounded-2xl overflow-hidden relative cursor-pointer">
                <img src="{{ $ts->video_image }}" alt="{{ $ts->video_title }}" class="w-full h-full object-cover">
                <div class="play-button animate-pulse-glow">
                    <i class="fas fa-play text-primary-700 text-xl"></i>
                </div>
                <div class="absolute bottom-6 left-6 z-10 text-white max-w-md">
                    <h3 class="text-2xl font-bold mb-2">{{ $ts->video_title }}</h3>
                    <p class="opacity-90">{{ $ts->video_description }}</p>
                </div>
            </div>
        </div>

        <!-- Swiper Slider -->
        <div class="max-w-7xl mx-auto mb-16">
            <div class="swiper testimonial-slider animate-fadeInUp" style="animation-delay: 0.2s;">
                <div class="swiper-wrapper">
                    @foreach ($ts->testimonials as $i => $t)
                        <div class="swiper-slide">
                            <div class="testimonial-card bg-white rounded-2xl p-8 shadow-lg h-full">
                                <div class="flex flex-col items-center text-center h-full">
                                    <div
                                        class="w-20 h-20 rounded-full bg-gradient-to-br from-primary-700 to-accent-500 flex items-center justify-center text-white font-bold text-2xl mb-6 overflow-hidden">
                                        <img src="{{ $t['image'] }}" alt="{{ $t['name'] }}"
                                            class="w-full h-full object-cover">
                                    </div>
                                    <div class="flex-1 flex flex-col justify-between w-full">
                                        <div>
                                            <div class="flex justify-center mb-4">
                                                <i class="fas fa-quote-left text-3xl text-accent-500 opacity-20"></i>
                                            </div>
                                            <p class="text-gray-600 leading-relaxed mb-6">{{ $t['quote'] }}</p>
                                        </div>
                                        <div class="flex flex-col items-center gap-2">
                                            <span class="text-xl font-bold text-primary-700">{{ $t['name'] }}</span>
                                            <span class="text-accent-500 font-semibold">{{ $t['role'] }}</span>
                                            <div class="flex gap-1 text-accent-500">
                                                @for ($r = 1; $r <= 5; $r++)
                                                    <i
                                                        class="fas fa-star {{ $r <= $t['rating'] ? '' : 'opacity-30' }}"></i>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Navigation -->
                <div class="flex justify-center gap-4 mt-8">
                    <div
                        class="swiper-button-prev w-12 h-12 bg-white border-2 border-accent-500 rounded-full flex items-center justify-center cursor-pointer transition-all duration-300 hover:bg-accent-500 hover:border-white">
                        <i
                            class="fas fa-chevron-left text-accent-500 text-sm transition-colors duration-300 hover:text-white"></i>
                    </div>
                    <div class="swiper-pagination"></div>
                    <div
                        class="swiper-button-next w-12 h-12 bg-white border-2 border-accent-500 rounded-full flex items-center justify-center cursor-pointer transition-all duration-300 hover:bg-accent-500 hover:border-white">
                        <i
                            class="fas fa-chevron-right text-accent-500 text-sm transition-colors duration-300 hover:text-white"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Trust Stats -->
        <div class="max-w-4xl mx-auto mb-16 animate-fadeInUp" style="animation-delay: 0.3s;">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                @foreach ($ts->stats as $stat)
                    <div class="stats-card bg-white bg-opacity-10 rounded-xl p-6 backdrop-blur-sm">
                        <div class="text-3xl font-bold text-white mb-2">{{ $stat['value'] }}</div>
                        <div class="text-white opacity-90">{{ $stat['label'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- CTA -->
        <div class="max-w-4xl mx-auto text-center animate-fadeInUp" style="animation-delay: 0.4s;">
            <h3 class="text-3xl font-bold text-white mb-4">{{ $ts->cta_heading }}</h3>
            <p class="text-xl text-white opacity-90 mb-8 max-w-2xl mx-auto">{{ $ts->cta_description }}</p>
            <div class="flex flex-wrap gap-4 justify-center">
                <a href="{{ $ts->cta_primary_link }}"
                    class="px-8 py-4 bg-white text-primary-700 font-semibold rounded-lg transition-all duration-300 hover:bg-primary-50 hover:shadow-lg flex items-center gap-2">
                    <i class="fas {{ $ts->cta_primary_icon }}"></i>
                    {{ $ts->cta_primary_text }}
                </a>
                <a href="{{ $ts->cta_secondary_link }}"
                    class="px-8 py-4 border-2 border-white text-white font-semibold rounded-lg transition-all duration-300 hover:bg-white hover:text-primary-700 flex items-center gap-2">
                    <i class="fas {{ $ts->cta_secondary_icon }}"></i>
                    {{ $ts->cta_secondary_text }}
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Swiper JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        new Swiper('.testimonial-slider', {
            loop: true,
            slidesPerView: 1,
            spaceBetween: 30,
            pagination: {
                el: '.swiper-pagination',
                clickable: true
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
            }
        });

        // Video popup (optional)
        document.querySelector('.video-testimonial').addEventListener('click', function() {
            const url = "{{ $ts->video_url }}";
            if (url) {
                // You can open a modal or redirect
                window.open(url, '_blank');
            }
        });
    });
</script>

<style>
    .play-button {
        @apply absolute inset-0 flex items-center justify-center text-6xl text-white opacity-70 transition-all duration-300;
    }

    .play-button::before {
        content: '';
        @apply absolute w-20 h-20 bg-white rounded-full opacity-20 scale-100 animate-ping;
    }

    .animate-pulse-glow::before {
        animation: ping 2s infinite;
    }
</style>
