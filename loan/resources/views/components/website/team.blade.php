{{-- resources/views/partials/team.blade.php --}}
@php $team = \App\Models\TeamSection::first(); @endphp

<!-- Team Section -->
<section id="team" class="relative overflow-hidden py-20 bg-gradient-to-br from-primary-50 to-white">
    <!-- Background Shapes -->
    <div class="absolute w-64 h-64 rounded-full bg-primary-100/30 top-10 -left-20 animate-float"></div>
    <div class="absolute w-40 h-40 rounded-full bg-primary-accent/20 bottom-20 -right-10 animate-float"
        style="animation-delay: 2s;"></div>
    <div class="absolute w-32 h-32 rounded-full bg-primary-100/30 top-1/3 right-1/4 animate-float"
        style="animation-delay: 4s;"></div>

    <div class="container mx-auto px-4 relative z-10">
        <!-- Header -->
        <div class="text-center mb-16 max-w-3xl mx-auto animate-fade-in-up">
            <div
                class="inline-flex items-center space-x-2 bg-primary-100 text-primary-primary px-4 py-2 rounded-full text-sm font-semibold uppercase tracking-wider mb-6 border border-primary-200">
                <i class="fas fa-users text-xs"></i>
                <span>Our Team</span>
            </div>
            <h2 class="text-3xl lg:text-4xl xl:text-5xl font-black text-primary-primary mb-4 leading-tight">
                {{ $team->heading }}</h2>
            <div class="w-20 h-1 bg-primary-secondary mx-auto rounded-full mb-6"></div>
            <p class="text-lg text-gray-600 leading-relaxed">{{ $team->description }}</p>
        </div>

        <div class="max-w-7xl mx-auto relative">
            <!-- Carousel -->
            <div class="team-carousel overflow-hidden mb-12">
                <div class="carousel-track flex gap-6 transition-transform duration-500 ease-out" id="carousel-track">
                    @php
                        $members = is_string($team->members) ? json_decode($team->members, true) : $team->members;
                    @endphp
                    @foreach ($members as $i => $member)
                        <div class="carousel-slide team-card min-w-[300px] md:min-w-[320px] flex-shrink-0 text-center bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 animate-fade-in-up border border-primary-100"
                            style="animation-delay: {{ $i * 0.1 }}s;">

                            <!-- Image Container -->
                            <div class="relative mb-5">
                                <div class="relative inline-block">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-br from-primary-primary to-primary-secondary rounded-3xl blur-lg opacity-30">
                                    </div>
                                    <img src="{{ $member['image'] ? asset('storage/teams/' . $member['image']) : 'https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80' }}"
                                        alt="{{ $member['name'] }}"
                                        class="team-image w-48 h-48 mx-auto object-cover border-4 border-white shadow-xl"
                                        style="border-radius: 50%;">
                                </div>

                                <!-- Social Links -->
                                @if (!empty($member['social']))
                                    <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 translate-y-1/2">
                                        <div
                                            class="social-links flex gap-2 bg-primary-primary p-2 rounded-full shadow-lg">
                                            @foreach ($member['social'] as $link)
                                                <a href="{{ $link['url'] }}"
                                                    class="w-8 h-8 bg-white rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110 hover:bg-primary-accent group">
                                                    <i
                                                        class="fab {{ $link['icon'] }} text-primary-primary text-sm group-hover:text-white transition-colors"></i>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Details -->
                            <h4 class="text-xl font-bold text-primary-primary mb-1 mt-4">{{ $member['name'] }}</h4>
                            <p class="text-primary-secondary font-semibold text-sm mb-2">{{ $member['role'] }}</p>
                            <p class="text-gray-500 leading-relaxed text-sm">{{ Str::limit($member['bio'], 100) }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Navigation Buttons -->
            <div class="flex justify-center items-center gap-6 mb-12">
                <button
                    class="carousel-prev w-12 h-12 bg-primary-primary text-white rounded-full flex items-center justify-center transition-all duration-300 hover:bg-primary-secondary hover:scale-110 shadow-lg">
                    <i class="fas fa-chevron-left"></i>
                </button>

                <!-- Indicators -->
                <div class="carousel-indicators flex gap-2">
                    @foreach ($members as $i => $m)
                        <button
                            class="carousel-indicator w-2.5 h-2.5 {{ $i === 0 ? 'bg-primary-primary w-6' : 'bg-primary-300' }} rounded-full transition-all duration-300"
                            data-index="{{ $i }}"></button>
                    @endforeach
                </div>

                <button
                    class="carousel-next w-12 h-12 bg-primary-primary text-white rounded-full flex items-center justify-center transition-all duration-300 hover:bg-primary-secondary hover:scale-110 shadow-lg">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="max-w-4xl mx-auto text-center animate-fade-in-up" style="animation-delay: 0.4s;">
            <div class="bg-gradient-to-br from-primary-primary to-primary-700 rounded-2xl p-8 shadow-2xl">
                <h3 class="text-2xl lg:text-3xl font-bold text-white mb-3">{{ $team->cta_heading }}</h3>
                <p class="text-white/80 mb-6 max-w-2xl mx-auto">{{ $team->cta_description }}</p>
                <div class="flex flex-wrap gap-4 justify-center">
                    <a href="{{ $team->cta_primary_link }}"
                        class="px-6 py-3 bg-white text-primary-primary font-bold rounded-xl transition-all duration-300 hover:bg-primary-50 hover:shadow-xl hover:scale-105 flex items-center gap-2">
                        <i class="fas {{ $team->cta_primary_icon }}"></i>
                        {{ $team->cta_primary_text }}
                        <i class="fas fa-arrow-right text-sm"></i>
                    </a>
                    <a href="{{ $team->cta_secondary_link }}"
                        class="px-6 py-3 border-2 border-white text-white font-bold rounded-xl transition-all duration-300 hover:bg-white hover:text-primary-primary flex items-center gap-2">
                        <i class="fas {{ $team->cta_secondary_icon }}"></i>
                        {{ $team->cta_secondary_text }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const track = document.getElementById('carousel-track');
        const slides = document.querySelectorAll('.carousel-slide');
        const prevBtn = document.querySelector('.carousel-prev');
        const nextBtn = document.querySelector('.carousel-next');
        const indicators = document.querySelectorAll('.carousel-indicator');

        let currentIndex = 0;
        const total = slides.length;
        let autoPlayInterval;
        const autoPlayDelay = 5000;

        function getSlideWidth() {
            return slides[0]?.offsetWidth + 24; // gap is 24px (gap-6)
        }

        function updateCarousel() {
            const width = getSlideWidth();
            track.style.transform = `translateX(-${currentIndex * width}px)`;

            indicators.forEach((ind, i) => {
                if (i === currentIndex) {
                    ind.classList.remove('bg-primary-300', 'w-2.5');
                    ind.classList.add('bg-primary-primary', 'w-6');
                } else {
                    ind.classList.remove('bg-primary-primary', 'w-6');
                    ind.classList.add('bg-primary-300', 'w-2.5');
                }
            });
        }

        function goToSlide(index) {
            currentIndex = (index + total) % total;
            updateCarousel();
            resetAutoPlay();
        }

        function nextSlide() {
            goToSlide(currentIndex + 1);
        }

        function prevSlide() {
            goToSlide(currentIndex - 1);
        }

        function startAutoPlay() {
            autoPlayInterval = setInterval(nextSlide, autoPlayDelay);
        }

        function resetAutoPlay() {
            clearInterval(autoPlayInterval);
            startAutoPlay();
        }

        function stopAutoPlay() {
            clearInterval(autoPlayInterval);
        }

        // Event Listeners
        prevBtn.addEventListener('click', () => {
            prevSlide();
            stopAutoPlay();
            setTimeout(startAutoPlay, 10000);
        });

        nextBtn.addEventListener('click', () => {
            nextSlide();
            stopAutoPlay();
            setTimeout(startAutoPlay, 10000);
        });

        indicators.forEach(ind => {
            ind.addEventListener('click', () => {
                goToSlide(parseInt(ind.dataset.index));
                stopAutoPlay();
                setTimeout(startAutoPlay, 10000);
            });
        });

        // Handle window resize
        let resizeTimeout;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(() => updateCarousel(), 100);
        });

        // Pause on hover
        const carouselContainer = document.querySelector('.team-carousel');
        carouselContainer.addEventListener('mouseenter', stopAutoPlay);
        carouselContainer.addEventListener('mouseleave', startAutoPlay);

        // Initialize
        updateCarousel();
        startAutoPlay();
    });
</script>

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
</style>
