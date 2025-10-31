@php $team = \App\Models\TeamSection::first(); @endphp

<section id="team" class="relative overflow-hidden py-20 gradient-team-bg">
    <!-- Background Shapes -->
    <div class="shape w-64 h-64 rounded-full bg-primary-100 opacity-20 top-10 -left-20 animate-float"></div>
    <div class="shape w-40 h-40 rounded-full bg-accent-100 opacity-30 bottom-20 -right-10 animate-float"
        style="animation-delay: 2s;"></div>
    <div class="shape w-32 h-32 rounded-full bg-primary-100 opacity-20 top-1/3 right-1/4 animate-float"
        style="animation-delay: 4s;"></div>

    <div class="container mx-auto px-4 relative z-10">
        <!-- Header -->
        <div class="text-center mb-16 max-w-3xl mx-auto animate-fadeIn">
            <h2 class="text-5xl font-bold text-primary-700 mb-6 leading-tight">{{ $team->heading }}</h2>
            <p class="text-xl text-gray-600 leading-relaxed">{{ $team->description }}</p>
        </div>

        <!-- Carousel -->
        <div class="max-w-7xl mx-auto relative">
            <div class="team-carousel overflow-hidden mb-12">
                <div class="carousel-track flex gap-6" id="carousel-track">
                    @foreach ($team->members as $i => $member)
                        <div class="carousel-slide team-card min-w-[320px] flex-shrink-0 text-center animate-fadeInUp bg-white rounded-2xl p-6 shadow-lg"
                            style="animation-delay: {{ $i * 0.1 }}s;">
                            <div class="relative mb-6">
                                <div class="w-full h-80 rounded-xl overflow-hidden">
                                    <img src="{{ $member['image'] }}" alt="{{ $member['name'] }}"
                                        class="w-full h-full object-cover" />
                                </div>
                                @if (!empty($member['social']))
                                    <div class="absolute bottom-4 right-4 transform translate-y-1/2">
                                        <div
                                            class="social-links flex gap-2 {{ $member['social'][0]['color'] === 'accent' ? 'bg-accent-500' : 'bg-primary-700' }} p-3 rounded-xl">
                                            @foreach ($member['social'] as $link)
                                                <a href="{{ $link['url'] }}"
                                                    class="w-8 h-8 bg-white rounded-full flex items-center justify-center transition-transform hover:scale-110"
                                                    aria-label="Connect with {{ $member['name'] }} on {{ ucfirst(str_replace('fa-', '', $link['icon'])) }}">
                                                    <i
                                                        class="fab {{ $link['icon'] }} text-{{ $link['color'] === 'accent' ? 'accent' : 'primary' }}-500 text-sm"></i>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <h4 class="text-2xl font-bold text-primary-700 mb-2">{{ $member['name'] }}</h4>
                            <p class="text-accent-500 font-semibold mb-2">{{ $member['role'] }}</p>
                            <p class="text-gray-600 leading-relaxed">{{ $member['bio'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Navigation -->
            <div class="flex justify-center items-center gap-6 mb-12">
                <button
                    class="carousel-prev w-12 h-12 bg-primary-700 text-white rounded-full flex items-center justify-center transition-all duration-300 hover:bg-accent-500 hover:scale-110">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <div class="carousel-indicators flex gap-2">
                    @foreach ($team->members as $i => $m)
                        <button
                            class="carousel-indicator w-3 h-3 {{ $i === 0 ? 'bg-primary-700' : 'bg-gray-300' }} rounded-full"
                            data-index="{{ $i }}"></button>
                    @endforeach
                </div>
                <button
                    class="carousel-next w-12 h-12 bg-primary-700 text-white rounded-full flex items-center justify-center transition-all duration-300 hover:bg-accent-500 hover:scale-110">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>

        <!-- CTA -->
        <div class="max-w-4xl mx-auto text-center animate-fadeIn" style="animation-delay: 0.4s;">
            <h3 class="text-3xl font-bold text-primary-700 mb-4">{{ $team->cta_heading }}</h3>
            <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">{{ $team->cta_description }}</p>
            <div class="flex flex-wrap gap-4 justify-center">
                <a href="{{ $team->cta_primary_link }}"
                    class="px-8 py-4 bg-accent-500 text-white font-semibold rounded-lg transition-all duration-300 hover:bg-accent-600 hover:shadow-lg flex items-center gap-2">
                    <i class="fas {{ $team->cta_primary_icon }}"></i>
                    {{ $team->cta_primary_text }}
                </a>
                <a href="{{ $team->cta_secondary_link }}"
                    class="px-8 py-4 border-2 border-primary-700 text-primary-700 font-semibold rounded-lg transition-all duration-300 hover:bg-primary-700 hover:text-white flex items-center gap-2">
                    <i class="fas {{ $team->cta_secondary_icon }}"></i>
                    {{ $team->cta_secondary_text }}
                </a>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const track = document.getElementById('carousel-track');
        const slides = document.querySelectorAll('.carousel-slide');
        const prev = document.querySelector('.carousel-prev');
        const next = document.querySelector('.carousel-next');
        const indicators = document.querySelectorAll('.carousel-indicator');

        let currentIndex = 0;
        const totalSlides = slides.length;
        const slideWidth = slides[0]?.offsetWidth + 24; // + gap

        function updateCarousel() {
            track.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
            indicators.forEach((ind, i) => {
                ind.classList.toggle('bg-primary-700', i === currentIndex);
                ind.classList.toggle('bg-gray-300', i !== currentIndex);
            });
        }

        prev.addEventListener('click', () => {
            currentIndex = currentIndex > 0 ? currentIndex - 1 : totalSlides - 1;
            updateCarousel();
        });

        next.addEventListener('click', () => {
            currentIndex = currentIndex < totalSlides - 1 ? currentIndex + 1 : 0;
            updateCarousel();
        });

        indicators.forEach(ind => {
            ind.addEventListener('click', () => {
                currentIndex = parseInt(ind.dataset.index);
                updateCarousel();
            });
        });

        // Responsive
        window.addEventListener('resize', updateCarousel);
        updateCarousel();
    });
</script>

<style>
    .team-carousel {
        mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
    }

    .carousel-track {
        transition: transform 0.5s ease;
    }
</style>
