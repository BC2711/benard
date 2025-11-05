@php
    $ts = \App\Models\TestimonialsSection::first();
    $videoUrl = $ts->video_file_path ? asset('storage/' . $ts->video_file_path) : $ts->video_url;

    $videoBg = $ts->video_image_path ? asset('storage/' . $ts->video_image_path) : $ts->video_image;
@endphp

<section id="testimonials" class="relative overflow-hidden py-20 testimonial-gradient">
    <!-- Background Shapes -->
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
        @if ($videoBg || $videoUrl)
            <div class="max-w-4xl mx-auto mb-16 animate-fadeInUp">
                <div class="video-testimonial h-80 bg-gray-800 rounded-2xl overflow-hidden relative cursor-pointer group"
                    onclick="openVideoModal('{{ $videoUrl }}')">
                    <img src="{{ $videoBg }}" alt="{{ $ts->video_title }}"
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">

                    <!-- Play Button -->
                    <div class="play-button animate-pulse-glow">
                        <i class="fas fa-play text-primary-700 text-2xl"></i>
                    </div>

                    <!-- Text Overlay -->
                    <div class="absolute bottom-6 left-6 z-10 text-white max-w-md">
                        <h3 class="text-2xl font-bold mb-2">{{ $ts->video_title }}</h3>
                        <p class="opacity-90">{{ $ts->video_description }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Testimonials Slider -->
        @if ($ts->testimonials && count($ts->testimonials) > 0)
            <div class="max-w-7xl mx-auto mb-16">
                <div class="swiper testimonial-slider animate-fadeInUp" style="animation-delay: 0.2s;">
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
                                    class="testimonial-card bg-white rounded-2xl p-8 shadow-lg h-full transition-all duration-300 hover:shadow-xl">
                                    <div class="flex flex-col items-center text-center h-full">
                                        <!-- Avatar -->
                                        <div
                                            class="w-20 h-20 rounded-full bg-gradient-to-br from-primary-700 to-accent-500 flex items-center justify-center text-white font-bold text-2xl mb-6 overflow-hidden">
                                            @if ($avatar)
                                                <img src="{{ $avatar }}" alt="{{ $t['name'] }}"
                                                    class="w-full h-full object-cover">
                                            @else
                                                {{ substr($t['name'], 0, 1) }}
                                            @endif
                                        </div>

                                        <div class="flex-1 flex flex-col justify-between w-full">
                                            <div>
                                                <div class="flex justify-center mb-4">
                                                    <i
                                                        class="fas fa-quote-left text-3xl text-accent-500 opacity-20"></i>
                                                </div>
                                                <p class="text-gray-600 leading-relaxed mb-6">{{ $t['quote'] }}</p>
                                            </div>

                                            <div class="flex flex-col items-center gap-2">
                                                <span
                                                    class="text-xl font-bold text-primary-700">{{ $t['name'] }}</span>
                                                <span class="text-accent-500 font-semibold">{{ $t['role'] }}</span>
                                                <div class="flex gap-1 text-accent-500">
                                                    @for ($r = 1; $r <= 5; $r++)
                                                        <i
                                                            class="fas fa-star {{ $r <= ($t['rating'] ?? 5) ? '' : 'opacity-30' }}"></i>
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
                            class="swiper-button-prev w-12 h-12 bg-white border-2 border-accent-500 rounded-full flex items-center justify-center cursor-pointer transition-all duration-300 hover:bg-accent-500 hover:border-white group">
                            <i
                                class="fas fa-chevron-left text-accent-500 text-sm transition-colors duration-300 group-hover:text-white"></i>
                        </div>
                        <div class="swiper-pagination"></div>
                        <div
                            class="swiper-button-next w-12 h-12 bg-white border-2 border-accent-500 rounded-full flex items-center justify-center cursor-pointer transition-all duration-300 hover:bg-accent-500 hover:border-white group">
                            <i
                                class="fas fa-chevron-right text-accent-500 text-sm transition-colors duration-300 group-hover:text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Trust Stats -->
        @if ($ts->stats && count($ts->stats) > 0)
            <div class="max-w-4xl mx-auto mb-16 animate-fadeInUp" style="animation-delay: 0.3s;">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                    @foreach ($ts->stats as $stat)
                        <div
                            class="stats-card bg-white bg-opacity-10 rounded-xl p-6 backdrop-blur-sm transition-all duration-300 hover:bg-opacity-20 hover:scale-105">
                            <div class="text-3xl font-bold text-white mb-2">{{ $stat['value'] }}</div>
                            <div class="text-white opacity-90">{{ $stat['label'] }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

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

<!-- Video Modal -->
<div id="videoModal" class="fixed inset-0 bg-black bg-opacity-90 hidden z-50 flex items-center justify-center p-4"
    onclick="closeVideoModal()">
    <div class="relative w-full max-w-5xl" onclick="event.stopPropagation()">
        <button onclick="closeVideoModal()"
            class="absolute -top-10 right-0 text-white text-3xl hover:text-gray-300 transition">&times;</button>
        <div class="bg-black rounded-lg overflow-hidden shadow-2xl">
            <iframe id="videoPlayer" class="w-full h-96 md:h-screen max-h-screen" frameborder="0"
                allow="autoplay; encrypted-media" allowfullscreen></iframe>
        </div>
    </div>
</div>

<!-- Swiper + Scripts -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Swiper
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
            autoplay: {
                delay: 6000,
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
            effect: 'slide',
            speed: 800
        });

        // Pause autoplay on hover
        const slider = document.querySelector('.testimonial-slider');
        slider.addEventListener('mouseenter', () => slider.swiper.autoplay.stop());
        slider.addEventListener('mouseleave', () => slider.swiper.autoplay.start());
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
            // Local MP4 → use <video> tag
            player.outerHTML =
                `<video id="videoPlayer" controls autoplay class="w-full h-96 md:h-screen max-h-screen"><source src="${url}" type="video/mp4"></video>`;
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

    // Close on ESC
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeVideoModal();
    });
</script>

<style>
    .testimonial-gradient {
        background: linear-gradient(135deg, #7a4603 0%, #db9123 100%);
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

    .animate-pulse-glow {
        animation: pulse-glow 2s ease-in-out infinite alternate;
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

    @keyframes float {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-10px);
        }
    }

    @keyframes pulse-glow {
        from {
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }

        to {
            box-shadow: 0 0 30px rgba(255, 255, 255, 0.9);
        }
    }

    .play-button {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 2;
        width: 80px;
        height: 80px;
        background: rgba(255, 255, 255, 0.95);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        backdrop-filter: blur(4px);
    }

    .play-button:hover {
        background: white;
        transform: translate(-50%, -50%) scale(1.1);
        box-shadow: 0 0 30px rgba(255, 255, 255, 0.8);
    }

    .video-testimonial::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(122, 70, 3, 0.7), rgba(219, 145, 35, 0.7));
        z-index: 1;
    }

    .swiper-pagination-bullet {
        background: white;
        opacity: 0.5;
        width: 10px;
        height: 10px;
    }

    .swiper-pagination-bullet-active {
        background: #db9123;
        opacity: 1;
    }
</style>
