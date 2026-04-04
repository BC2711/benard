@php
    $ts = \App\Models\TestimonialsSection::first();
    $videoUrl = $ts->video_file_path ? asset('storage/' . $ts->video_file_path) : $ts->video_url;
    $videoBg = $ts->video_image_path ? asset('storage/' . $ts->video_image_path) : $ts->video_image;
@endphp

<section id="testimonials"
    class="relative overflow-hidden py-20 bg-gradient-to-br from-primary-primary via-primary-800 to-primary-700">
    <!-- Background Shapes -->
    <div class="absolute w-64 h-64 rounded-full bg-white/10 top-10 -left-20 animate-float"></div>
    <div class="absolute w-40 h-40 rounded-full bg-white/15 bottom-20 -right-10 animate-float"
        style="animation-delay: 2s;"></div>
    <div class="absolute w-32 h-32 rounded-full bg-white/10 top-1/3 right-1/4 animate-float" style="animation-delay: 4s;">
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <!-- Header -->
        <div class="text-center mb-16 max-w-3xl mx-auto animate-fade-in-up">
            <div
                class="inline-flex items-center space-x-2 bg-white/10 text-white px-4 py-2 rounded-full text-sm font-semibold uppercase tracking-wider mb-6 border border-white/20">
                <i class="fas fa-comment-dots text-xs"></i>
                <span>Testimonials</span>
            </div>
            <h2 class="text-3xl lg:text-4xl xl:text-5xl font-black text-white mb-4">{{ $ts->heading }}</h2>
            <div class="w-20 h-1 bg-primary-accent mx-auto rounded-full mb-6"></div>
            <p class="text-lg text-white/80 leading-relaxed">{{ $ts->description }}</p>
        </div>

        <!-- Video Highlight -->
        @if ($videoBg || $videoUrl)
            <div class="max-w-4xl mx-auto mb-16 animate-fade-in-up">
                <div class="video-testimonial h-80 md:h-96 rounded-2xl overflow-hidden relative cursor-pointer group"
                    onclick="openVideoModal('{{ $videoUrl }}')">
                    <img src="{{ $videoBg }}" alt="{{ $ts->video_title }}"
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">

                    <!-- Play Button -->
                    <div class="play-button animate-pulse-glow">
                        <i class="fas fa-play text-primary-primary text-2xl ml-1"></i>
                    </div>

                    <!-- Text Overlay -->
                    <div class="absolute bottom-6 left-6 right-6 z-10 text-white max-w-md">
                        <h3 class="text-xl md:text-2xl font-bold mb-2">{{ $ts->video_title }}</h3>
                        <p class="text-white/80 text-sm">{{ $ts->video_description }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Testimonials Slider -->
        @if ($ts->testimonials && count($ts->testimonials) > 0)
            <div class="max-w-7xl mx-auto mb-16">
                <div class="swiper testimonial-slider animate-fade-in-up" style="animation-delay: 0.2s;">
                    <div class="swiper-wrapper">
                        @foreach ($ts->testimonials as $t)
                            @php
                                $avatar =
                                    isset($t['image']) &&
                                    \Illuminate\Support\Str::startsWith($t['image'], 'testimonials/avatars')
                                        ? asset('storage/' . $t['image'])
                                        : $t['image'] ?? '';
                            @endphp
                            <div class="swiper-slide">
                                <div
                                    class="testimonial-card bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 h-full">
                                    <div class="flex flex-col items-center text-center h-full">
                                        <!-- Avatar -->
                                        <div
                                            class="w-20 h-20 rounded-full bg-gradient-to-br from-primary-primary to-primary-secondary flex items-center justify-center text-white font-bold text-2xl mb-5 overflow-hidden shadow-lg">
                                            @if ($avatar)
                                                <img src="{{ $avatar }}" alt="{{ $t['name'] }}"
                                                    class="w-full h-full object-cover">
                                            @else
                                                {{ substr($t['name'], 0, 1) }}
                                            @endif
                                        </div>

                                        <div class="flex-1 flex flex-col justify-between w-full">
                                            <div>
                                                <div class="flex justify-center mb-3">
                                                    <i
                                                        class="fas fa-quote-left text-3xl text-primary-secondary opacity-20"></i>
                                                </div>
                                                <p class="text-gray-600 leading-relaxed text-sm mb-5 line-clamp-4">
                                                    {{ $t['quote'] }}</p>
                                            </div>

                                            <div class="flex flex-col items-center gap-1">
                                                <span
                                                    class="text-lg font-bold text-primary-primary">{{ $t['name'] }}</span>
                                                <span
                                                    class="text-primary-secondary text-sm font-semibold">{{ $t['role'] }}</span>
                                                <div class="flex gap-1 mt-2">
                                                    @for ($r = 1; $r <= 5; $r++)
                                                        <i
                                                            class="fas fa-star text-sm {{ $r <= ($t['rating'] ?? 5) ? 'text-primary-accent' : 'text-gray-300' }}"></i>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Navigation -->
                <div class="flex justify-center items-center gap-4 mt-10">
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
        @endif

        <!-- Trust Stats -->
        @if ($ts->stats && count($ts->stats) > 0)
            <div class="max-w-4xl mx-auto mb-16 animate-fade-in-up" style="animation-delay: 0.3s;">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
                    @foreach ($ts->stats as $stat)
                        <div
                            class="stats-card bg-white/10 rounded-xl p-5 backdrop-blur-sm transition-all duration-300 hover:bg-white/20 hover:scale-105">
                            <div class="text-2xl lg:text-3xl font-black text-primary-accent mb-1">{{ $stat['value'] }}
                            </div>
                            <div class="text-white/80 text-sm">{{ $stat['label'] }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- CTA -->
        <div class="max-w-4xl mx-auto text-center animate-fade-in-up" style="animation-delay: 0.4s;">
            <div class="bg-white/10 rounded-2xl p-8 backdrop-blur-sm border border-white/20">
                <h3 class="text-2xl lg:text-3xl font-bold text-white mb-3">{{ $ts->cta_heading }}</h3>
                <p class="text-white/80 mb-6 max-w-2xl mx-auto">{{ $ts->cta_description }}</p>
                <div class="flex flex-wrap gap-4 justify-center">
                    <a href="{{ $ts->cta_primary_link }}"
                        class="px-6 py-3 bg-white text-primary-primary font-bold rounded-xl transition-all duration-300 hover:bg-primary-50 hover:shadow-xl hover:scale-105 flex items-center gap-2">
                        <i class="fas {{ $ts->cta_primary_icon }}"></i>
                        {{ $ts->cta_primary_text }}
                        <i class="fas fa-arrow-right text-sm"></i>
                    </a>
                    <a href="{{ $ts->cta_secondary_link }}"
                        class="px-6 py-3 border-2 border-white text-white font-bold rounded-xl transition-all duration-300 hover:bg-white hover:text-primary-primary flex items-center gap-2">
                        <i class="fas {{ $ts->cta_secondary_icon }}"></i>
                        {{ $ts->cta_secondary_text }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Video Modal -->
<div id="videoModal" class="fixed inset-0 bg-black/90 hidden z-50 flex items-center justify-center p-4"
    onclick="closeVideoModal()">
    <div class="relative w-full max-w-5xl" onclick="event.stopPropagation()">
        <button onclick="closeVideoModal()"
            class="absolute -top-10 right-0 text-white text-3xl hover:text-primary-accent transition">&times;</button>
        <div class="bg-black rounded-xl overflow-hidden shadow-2xl">
            <iframe id="videoPlayer" class="w-full aspect-video" frameborder="0" allow="autoplay; encrypted-media"
                allowfullscreen></iframe>
        </div>
    </div>
</div>

<!-- Swiper + Scripts -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const testimonialSwiper = new Swiper('.testimonial-slider', {
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
            autoplay: {
                delay: 5000,
                disableOnInteraction: false
            },
            breakpoints: {
                768: {
                    slidesPerView: 2
                },
                1024: {
                    slidesPerView: 3
                }
            },
            speed: 800
        });

        const slider = document.querySelector('.testimonial-slider');
        slider.addEventListener('mouseenter', () => testimonialSwiper.autoplay.stop());
        slider.addEventListener('mouseleave', () => testimonialSwiper.autoplay.start());
    });

    function openVideoModal(url) {
        const modal = document.getElementById('videoModal');
        const player = document.getElementById('videoPlayer');
        let embedUrl = url;

        if (url.includes('youtube.com') || url.includes('youtu.be')) {
            const id = url.split('v=')[1]?.split('&')[0] || url.split('/').pop();
            embedUrl = `https://www.youtube.com/embed/${id}?autoplay=1`;
        } else if (url.includes('vimeo.com')) {
            const id = url.split('/').pop();
            embedUrl = `https://player.vimeo.com/video/${id}?autoplay=1`;
        } else if (url.endsWith('.mp4')) {
            player.outerHTML =
                `<video id="videoPlayer" controls autoplay class="w-full aspect-video"><source src="${url}" type="video/mp4"></video>`;
            modal.classList.remove('hidden');
            return;
        }

        player.src = embedUrl;
        modal.classList.remove('hidden');
    }

    function closeVideoModal() {
        const modal = document.getElementById('videoModal');
        const player = document.getElementById('videoPlayer');
        player.src = '';
        modal.classList.add('hidden');
    }

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeVideoModal();
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

    @keyframes pulse-glow {
        from {
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.4);
        }

        to {
            box-shadow: 0 0 30px rgba(248, 183, 80, 0.8);
        }
    }

    .animate-fade-in-up {
        animation: fadeInUp 0.6s ease-out forwards;
        opacity: 0;
    }

    .animate-float {
        animation: float 6s ease-in-out infinite;
    }

    .animate-pulse-glow {
        animation: pulse-glow 2s ease-in-out infinite alternate;
    }

    /* Play Button */
    .play-button {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 2;
        width: 70px;
        height: 70px;
        background: rgba(255, 255, 255, 0.95);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .play-button:hover {
        background: white;
        transform: translate(-50%, -50%) scale(1.1);
    }

    /* Video Overlay */
    .video-testimonial::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(122, 70, 3, 0.6), rgba(219, 145, 35, 0.6));
        z-index: 1;
    }

    /* Custom Swiper Styles */
    .swiper-pagination {
        position: relative !important;
        bottom: auto !important;
        display: flex;
        align-items: center;
        gap: 8px;
        width: auto !important;
    }

    .swiper-pagination-bullet-custom {
        background: white;
        opacity: 0.4;
        width: 8px;
        height: 8px;
        margin: 0 !important;
        transition: all 0.3s ease;
        border-radius: 50%;
        cursor: pointer;
    }

    .swiper-pagination-bullet-custom-active {
        background: #f8b750;
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

    /* Line clamp for quotes */
    .line-clamp-4 {
        display: -webkit-box;
        -webkit-line-clamp: 4;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
