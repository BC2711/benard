{{-- resources/views/partials/team.blade.php --}}
@php
    $team = \App\Models\TeamSection::first();

    // Safely decode members JSON
    $members = [];
    if ($team && $team->members) {
        if (is_string($team->members)) {
            $decoded = json_decode($team->members, true);
            $members = is_array($decoded) ? $decoded : [];
        } elseif (is_array($team->members)) {
            $members = $team->members;
        }
    }

    $hasTeam = $team && count($members) > 0;
    $totalMembers = count($members);
@endphp

@if ($hasTeam)
    <!-- Team Section -->
    <section id="team" class="relative overflow-hidden py-20 lg:py-28 bg-gradient-to-br from-primary-50 to-white">

        <!-- Animated Background Shapes -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute w-64 h-64 rounded-full bg-primary-100/30 top-10 -left-20 animate-float"></div>
            <div class="absolute w-40 h-40 rounded-full bg-primary-accent/20 bottom-20 -right-10 animate-float"
                style="animation-delay: 2s;"></div>
            <div class="absolute w-32 h-32 rounded-full bg-primary-100/30 top-1/3 right-1/4 animate-float"
                style="animation-delay: 4s;"></div>
            <div class="absolute w-24 h-24 rounded-full bg-primary-200/20 bottom-1/3 left-1/4 animate-float"
                style="animation-delay: 6s;"></div>
        </div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            <!-- Section Header -->
            <div class="text-center mb-16 max-w-3xl mx-auto">
                <div
                    class="inline-flex items-center gap-2 bg-primary-100 text-primary-primary px-4 py-2 rounded-full text-sm font-semibold uppercase tracking-wider mb-6 border border-primary-200 shadow-sm">
                    <i class="fas fa-users text-xs"></i>
                    <span>Our Team</span>
                </div>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-primary-primary mb-4 leading-tight">
                    {{ $team->heading }}
                </h2>
                <div
                    class="w-20 h-1 bg-gradient-to-r from-primary-primary to-primary-secondary mx-auto rounded-full mb-6">
                </div>
                <p class="text-lg text-gray-600 leading-relaxed max-w-2xl mx-auto">
                    {{ $team->description }}
                </p>
            </div>

            <!-- Team Carousel -->
            <div class="max-w-7xl mx-auto">
                <div class="relative px-12">
                    <!-- Carousel Container -->
                    <div class="team-carousel overflow-hidden">
                        <div class="carousel-track flex transition-transform duration-500 ease-out" id="carousel-track">
                            @foreach ($members as $i => $member)
                                <div class="carousel-slide flex-shrink-0 text-center bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-primary-100 group"
                                    data-index="{{ $i }}">
                                    <!-- Member Image -->
                                    <div class="relative mb-5">
                                        <div class="relative inline-block">
                                            <div
                                                class="absolute inset-0 bg-gradient-to-br from-primary-primary to-primary-secondary rounded-full blur-lg opacity-0 group-hover:opacity-30 transition-opacity duration-500">
                                            </div>
                                            <img src="{{ $member['image'] ? asset('storage/teams/' . $member['image']) : 'https://ui-avatars.com/api/?name=' . urlencode($member['name']) . '&background=db9123&color=fff&size=200' }}"
                                                alt="{{ $member['name'] }} - {{ $member['role'] }}"
                                                class="team-image w-48 h-48 mx-auto object-cover border-4 border-white shadow-xl rounded-full"
                                                loading="lazy">
                                        </div>

                                        @if (!empty($member['social']))
                                            <div
                                                class="absolute bottom-0 left-1/2 transform -translate-x-1/2 translate-y-1/2 opacity-0 group-hover:opacity-100 transition-all duration-300">
                                                <div
                                                    class="social-links flex gap-2 bg-primary-primary p-2 rounded-full shadow-lg">
                                                    @foreach ($member['social'] as $link)
                                                        <a href="{{ $link['url'] }}" target="_blank"
                                                            rel="noopener noreferrer"
                                                            class="w-8 h-8 bg-white rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110 hover:bg-primary-accent group/link"
                                                            aria-label="Follow on {{ $link['icon'] }}">
                                                            <i
                                                                class="fab {{ $link['icon'] }} text-primary-primary text-sm group-hover/link:text-white transition-colors"></i>
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <h3 class="text-xl font-bold text-primary-primary mb-1 mt-4">{{ $member['name'] }}
                                    </h3>
                                    <p class="text-primary-secondary font-semibold text-sm mb-3">{{ $member['role'] }}
                                    </p>
                                    <p class="text-gray-500 leading-relaxed text-sm">
                                        {{ Str::limit($member['bio'], 120) }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <button id="carousel-prev"
                        class="absolute left-0 top-1/2 -translate-y-1/2 w-10 h-10 md:w-12 md:h-12 bg-primary-primary text-white rounded-full flex items-center justify-center transition-all duration-300 hover:bg-primary-secondary hover:scale-110 shadow-lg focus:outline-none focus:ring-2 focus:ring-primary-primary focus:ring-offset-2 z-20"
                        aria-label="Previous team member">
                        <i class="fas fa-chevron-left text-sm md:text-base"></i>
                    </button>

                    <button id="carousel-next"
                        class="absolute right-0 top-1/2 -translate-y-1/2 w-10 h-10 md:w-12 md:h-12 bg-primary-primary text-white rounded-full flex items-center justify-center transition-all duration-300 hover:bg-primary-secondary hover:scale-110 shadow-lg focus:outline-none focus:ring-2 focus:ring-primary-primary focus:ring-offset-2 z-20"
                        aria-label="Next team member">
                        <i class="fas fa-chevron-right text-sm md:text-base"></i>
                    </button>
                </div>

                <!-- Carousel Indicators -->
                <div class="flex justify-center items-center gap-2 mt-8" id="carousel-indicators">
                    @foreach ($members as $i => $member)
                        <button class="carousel-indicator w-2.5 h-2.5 rounded-full transition-all duration-300"
                            data-index="{{ $i }}"
                            style="{{ $i === 0 ? 'background-color: #db9123; width: 1.5rem;' : 'background-color: #cbd5e1;' }}"
                            aria-label="Go to slide {{ $i + 1 }}"></button>
                    @endforeach
                </div>
            </div>

            <!-- Call to Action Section -->
            <div class="max-w-4xl mx-auto mt-16">
                <div
                    class="bg-gradient-to-br from-primary-primary to-primary-700 rounded-2xl p-8 md:p-10 shadow-2xl hover:shadow-3xl transition-all duration-500">
                    <div class="text-center">
                        <h3 class="text-2xl md:text-3xl font-bold text-white mb-3">{{ $team->cta_heading }}</h3>
                        <p class="text-white/80 mb-6 max-w-2xl mx-auto">{{ $team->cta_description }}</p>

                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="{{ $team->cta_primary_link }}"
                                class="group px-6 py-3 bg-white text-primary-primary font-bold rounded-xl transition-all duration-300 hover:bg-primary-50 hover:shadow-xl hover:scale-105 flex items-center justify-center gap-2">
                                <i class="fas {{ $team->cta_primary_icon }}"></i>
                                <span>{{ $team->cta_primary_text }}</span>
                                <i
                                    class="fas fa-arrow-right text-sm group-hover:translate-x-1 transition-transform"></i>
                            </a>

                            <a href="{{ $team->cta_secondary_link }}"
                                class="group px-6 py-3 border-2 border-white text-white font-bold rounded-xl transition-all duration-300 hover:bg-white hover:text-primary-primary flex items-center justify-center gap-2">
                                <i class="fas {{ $team->cta_secondary_icon }}"></i>
                                <span>{{ $team->cta_secondary_text }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
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

        .team-carousel {
            overflow: hidden;
            position: relative;
        }

        .carousel-track {
            display: flex;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            gap: 1.5rem;
        }

        .carousel-slide {
            flex: 0 0 auto;
            transition: all 0.3s ease;
        }

        @media (min-width: 1024px) {
            .carousel-slide {
                width: calc(33.333% - 1rem);
            }
        }

        @media (min-width: 768px) and (max-width: 1023px) {
            .carousel-slide {
                width: calc(50% - 0.75rem);
            }
        }

        @media (max-width: 767px) {
            .carousel-slide {
                width: 100%;
            }
        }
    </style>

    <script>
        (function() {
            const track = document.getElementById('carousel-track');
            const prevBtn = document.getElementById('carousel-prev');
            const nextBtn = document.getElementById('carousel-next');
            const indicators = document.querySelectorAll('.carousel-indicator');
            const slides = document.querySelectorAll('.carousel-slide');

            if (!track || slides.length === 0) return;

            let currentIndex = 0;
            let autoPlayInterval;
            const autoPlayDelay = 5000;

            function getSlidesToShow() {
                if (window.innerWidth < 768) return 1;
                if (window.innerWidth < 1024) return 2;
                return Math.min(3, slides.length);
            }

            function getSlideWidth() {
                if (slides.length === 0) return 0;
                const rect = slides[0].getBoundingClientRect();
                return rect.width;
            }

            function getGap() {
                const trackStyle = window.getComputedStyle(track);
                const gap = trackStyle.gap;
                return parseInt(gap) || 24;
            }

            function updateCarousel() {
                const slideWidth = getSlideWidth();
                const gap = getGap();
                const slidesToShow = getSlidesToShow();
                const maxIndex = Math.max(0, slides.length - slidesToShow);

                // Clamp currentIndex
                if (currentIndex > maxIndex) currentIndex = maxIndex;
                if (currentIndex < 0) currentIndex = 0;

                const translateX = -(currentIndex * (slideWidth + gap));
                track.style.transform = `translateX(${translateX}px)`;

                // Update indicators
                indicators.forEach((ind, i) => {
                    if (i === currentIndex) {
                        ind.style.backgroundColor = '#db9123';
                        ind.style.width = '1.5rem';
                    } else {
                        ind.style.backgroundColor = '#cbd5e1';
                        ind.style.width = '0.625rem';
                    }
                });

                // Update button states
                if (prevBtn) {
                    if (currentIndex === 0) {
                        prevBtn.style.opacity = '0.5';
                        prevBtn.style.cursor = 'not-allowed';
                    } else {
                        prevBtn.style.opacity = '1';
                        prevBtn.style.cursor = 'pointer';
                    }
                }

                if (nextBtn) {
                    if (currentIndex >= maxIndex) {
                        nextBtn.style.opacity = '0.5';
                        nextBtn.style.cursor = 'not-allowed';
                    } else {
                        nextBtn.style.opacity = '1';
                        nextBtn.style.cursor = 'pointer';
                    }
                }
            }

            function goToSlide(index) {
                const slidesToShow = getSlidesToShow();
                const maxIndex = Math.max(0, slides.length - slidesToShow);

                if (index < 0) index = 0;
                if (index > maxIndex) index = maxIndex;
                if (index === currentIndex) return;

                currentIndex = index;
                updateCarousel();
                resetAutoPlay();
            }

            function nextSlide() {
                const slidesToShow = getSlidesToShow();
                const maxIndex = Math.max(0, slides.length - slidesToShow);
                if (currentIndex < maxIndex) {
                    goToSlide(currentIndex + 1);
                }
            }

            function prevSlide() {
                if (currentIndex > 0) {
                    goToSlide(currentIndex - 1);
                }
            }

            function startAutoPlay() {
                if (autoPlayInterval) clearInterval(autoPlayInterval);
                const slidesToShow = getSlidesToShow();
                if (slides.length > slidesToShow) {
                    autoPlayInterval = setInterval(() => {
                        const maxIndex = Math.max(0, slides.length - getSlidesToShow());
                        if (currentIndex >= maxIndex) {
                            goToSlide(0);
                        } else {
                            nextSlide();
                        }
                    }, autoPlayDelay);
                }
            }

            function stopAutoPlay() {
                if (autoPlayInterval) {
                    clearInterval(autoPlayInterval);
                    autoPlayInterval = null;
                }
            }

            function resetAutoPlay() {
                stopAutoPlay();
                startAutoPlay();
            }

            // Add event listeners
            if (prevBtn) {
                prevBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    prevSlide();
                    stopAutoPlay();
                    setTimeout(startAutoPlay, 10000);
                });
            }

            if (nextBtn) {
                nextBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    nextSlide();
                    stopAutoPlay();
                    setTimeout(startAutoPlay, 10000);
                });
            }

            indicators.forEach(indicator => {
                indicator.addEventListener('click', () => {
                    const index = parseInt(indicator.dataset.index);
                    if (!isNaN(index)) {
                        goToSlide(index);
                        stopAutoPlay();
                        setTimeout(startAutoPlay, 10000);
                    }
                });
            });

            // Pause on hover
            const carouselContainer = document.querySelector('.team-carousel');
            if (carouselContainer) {
                carouselContainer.addEventListener('mouseenter', stopAutoPlay);
                carouselContainer.addEventListener('mouseleave', startAutoPlay);
            }

            // Handle resize
            let resizeTimeout;
            window.addEventListener('resize', () => {
                clearTimeout(resizeTimeout);
                resizeTimeout = setTimeout(() => {
                    updateCarousel();
                }, 150);
            });

            // Initialize
            setTimeout(() => {
                updateCarousel();
                startAutoPlay();
            }, 100);

            // Update on image load
            const images = document.querySelectorAll('.team-image');
            let loadedCount = 0;
            images.forEach(img => {
                if (img.complete) {
                    loadedCount++;
                } else {
                    img.addEventListener('load', () => {
                        loadedCount++;
                        if (loadedCount === images.length) {
                            updateCarousel();
                        }
                    });
                }
            });
        })();
    </script>
@else
    <!-- Fallback when no team data exists -->
    <section id="team" class="py-20 bg-gradient-to-br from-primary-50 to-white">
        <div class="container mx-auto px-4 text-center">
            <div class="max-w-2xl mx-auto">
                <div
                    class="inline-flex items-center gap-2 bg-primary-100 text-primary-primary px-4 py-2 rounded-full text-sm font-semibold uppercase tracking-wider mb-6">
                    <i class="fas fa-users text-xs"></i>
                    <span>Our Team</span>
                </div>
                <h2 class="text-3xl lg:text-4xl font-black text-primary-primary mb-4">Meet Our Experts</h2>
                <div
                    class="w-20 h-1 bg-gradient-to-r from-primary-primary to-primary-secondary mx-auto rounded-full mb-6">
                </div>
                <p class="text-gray-600">Team section content coming soon. Please check back later.</p>
            </div>
        </div>
    </section>
@endif
