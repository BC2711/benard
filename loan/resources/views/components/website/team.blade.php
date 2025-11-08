{{-- resources/views/partials/team.blade.php --}}
@php $team = \App\Models\TeamSection::first(); @endphp


<!-- Team Section -->
<section id="team" class="relative overflow-hidden py-20 gradient-team-bg">
    <!-- Background Shapes -->
    <div class="shape w-64 h-64 rounded-full bg-primary-200 opacity-20 top-10 -left-20 animate-float"></div>
    <div class="shape w-40 h-40 rounded-full bg-primary-200 opacity-30 bottom-20 -right-10 animate-float"
        style="animation-delay: 2s;"></div>
    <div class="shape w-32 h-32 rounded-full bg-primary-200 opacity-20 top-1/3 right-1/4 animate-float"
        style="animation-delay: 4s;"></div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center mb-16 max-w-3xl mx-auto animate-fadeIn">
            <h2 class="text-5xl font-bold text-primary-800 mb-6 leading-tight">{{ $team->heading }}</h2>
            <p class="text-xl text-gray-600 leading-relaxed">{{ $team->description }}</p>
        </div>

        <div class="max-w-7xl mx-auto relative">
            <div class="team-carousel overflow-hidden mb-12">
                <div class="carousel-track flex gap-6" id="carousel-track">
                    @php
                      $members = is_string($team->members) ? json_decode($team->members, true) : $team->members;
                    @endphp
                    @foreach ($members as $i => $member)
                        <div class="carousel-slide team-card min-w-[320px] flex-shrink-0 text-center animate-fadeInUp bg-white rounded-2xl p-6 shadow-lg"
                            style="animation-delay: {{ $i * 0.1 }}s;">
                            <div class="relative mb-6">
                                <div class="image-container">
                                    <img src="{{ $member['image'] ? asset('storage/teams/' . $member['image']) : 'https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80' }}"
                                        alt="{{ $member['name'] }}" class="team-image rounded-lg" style="border-radius: 3rem">
                                </div>
                                @if (!empty($member['social']))
                                    <div class="absolute bottom-4 right-4 transform translate-y-1/2">
                                        <div
                                            class="social-links flex gap-2 {{ $member['social'][0]['color'] === 'accent' ? 'bg-primary-500' : 'bg-primary-800' }} p-3 rounded-xl">
                                            @foreach ($member['social'] as $link)
                                                <a href="{{ $link['url'] }}"
                                                    class="w-8 h-8 bg-white rounded-full flex items-center justify-center transition-transform hover:scale-110">
                                                    <i
                                                        class="fab {{ $link['icon'] }} {{ $link['color'] === 'accent' ? 'text-primary-500' : 'text-primary-800' }} text-sm"></i>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <h4 class="text-2xl font-bold text-primary-800 mb-2">{{ $member['name'] }}</h4>
                            <p class="text-primary-500 font-semibold mb-2">{{ $member['role'] }}</p>
                            <p class="text-gray-600 leading-relaxed text-sm">{{ $member['bio'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Navigation -->
            <div class="flex justify-center items-center gap-6 mb-12">
                <button
                    class="carousel-prev w-12 h-12 bg-primary-800 text-white rounded-full flex items-center justify-center transition-all duration-300 hover:bg-primary-500 hover:scale-110">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <div class="carousel-indicators flex gap-2">
                    @foreach ($members as $i => $m)
                        <button
                            class="carousel-indicator w-3 h-3 {{ $i === 0 ? 'bg-primary-800 active' : 'bg-gray-300' }} rounded-full transition-all"
                            data-index="{{ $i }}"></button>
                    @endforeach
                </div>
                <button
                    class="carousel-next w-12 h-12 bg-primary-800 text-white rounded-full flex items-center justify-center transition-all duration-300 hover:bg-primary-500 hover:scale-110">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>

        <div class="max-w-4xl mx-auto text-center animate-fadeIn" style="animation-delay: 0.4s;">
            <h3 class="text-3xl font-bold text-primary-800 mb-4">{{ $team->cta_heading }}</h3>
            <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">{{ $team->cta_description }}</p>
            <div class="flex flex-wrap gap-4 justify-center">
                <a href="{{ $team->cta_primary_link }}"
                    class="px-8 py-4 bg-primary-500 text-white font-semibold rounded-lg transition-all duration-300 hover:bg-primary-600 hover:shadow-lg flex items-center gap-2">
                    <i class="fas {{ $team->cta_primary_icon }}"></i> {{ $team->cta_primary_text }}
                </a>
                <a href="{{ $team->cta_secondary_link }}"
                    class="px-8 py-4 border-2 border-primary-800 text-primary-800 font-semibold rounded-lg transition-all duration-300 hover:bg-primary-800 hover:text-white flex items-center gap-2">
                    <i class="fas {{ $team->cta_secondary_icon }}"></i> {{ $team->cta_secondary_text }}
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
        const total = slides.length;

        function getSlideWidth() {
            return slides[0]?.offsetWidth + 24;
        }

        function update() {
            const width = getSlideWidth();
            track.style.transform = `translateX(-${currentIndex * width}px)`;

            indicators.forEach((ind, i) => {
                ind.classList.toggle('bg-brown-800', i === currentIndex);
                ind.classList.toggle('bg-gray-300', i !== currentIndex);
                ind.classList.toggle('active', i === currentIndex);
            });
        }

        prev.addEventListener('click', () => {
            currentIndex = currentIndex > 0 ? currentIndex - 1 : total - 1;
            update();
        });
        next.addEventListener('click', () => {
            currentIndex = currentIndex < total - 1 ? currentIndex + 1 : 0;
            update();
        });
        indicators.forEach(ind => ind.addEventListener('click', () => {
            currentIndex = +ind.dataset.index;
            update();
        }));

        window.addEventListener('resize', () => setTimeout(update, 100));
        update();
    });
</script>
