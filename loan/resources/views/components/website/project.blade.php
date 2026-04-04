@php $ss = \App\Models\SuccessStoriesSection::first(); @endphp

<section id="success-stories" class="relative overflow-hidden py-20 bg-gradient-to-br from-primary-50 to-white">
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
                <i class="fas fa-star text-xs"></i>
                <span>Success Stories</span>
            </div>
            <h2 class="text-3xl lg:text-4xl xl:text-5xl font-black text-primary-primary mb-4">{{ $ss->heading }}</h2>
            <div class="w-20 h-1 bg-primary-secondary mx-auto rounded-full mb-6"></div>
            <p class="text-lg text-gray-600 leading-relaxed">{{ $ss->description }}</p>
        </div>

        <!-- Stats Row -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-16">
            @foreach ($ss->stats as $stat)
                <div
                    class="bg-white rounded-xl p-5 text-center shadow-lg border border-primary-100 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="text-3xl lg:text-4xl font-black text-primary-secondary mb-1">{{ $stat['value'] }}</div>
                    <div class="text-gray-500 text-sm font-semibold">{{ $stat['label'] }}</div>
                </div>
            @endforeach
        </div>

        <!-- Tabs Filter -->
        <div class="max-w-4xl mx-auto mb-12">
            <div
                class="bg-white rounded-xl p-2 flex flex-wrap justify-center gap-2 shadow-lg border border-primary-100">
                @foreach ($ss->categories as $i => $cat)
                    <button
                        class="tab-btn px-6 py-2 rounded-lg font-semibold transition-all duration-300 {{ $i === 0 ? 'bg-primary-primary text-white shadow-md' : 'bg-transparent text-primary-primary border-2 border-primary-200 hover:bg-primary-50 hover:border-primary-primary' }}"
                        data-filter="{{ $cat }}">
                        {{ ucfirst(str_replace('-', ' ', $cat)) }}
                    </button>
                @endforeach
            </div>
        </div>

        <!-- Stories Grid -->
        <div class="max-w-7xl mx-auto mb-16">
            <div id="projects-wrapper" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($ss->stories as $i => $story)
                    <div class="story-card bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 animate-fade-in-up hover:-translate-y-2"
                        data-category="{{ $story['category'] }}" style="animation-delay: {{ $i * 0.1 }}s;">

                        <!-- Image/Gradient Header -->
                        <div class="relative h-56 bg-gradient-to-br from-primary-primary to-primary-700">
                            <div class="absolute inset-0 flex items-center justify-center text-white p-6 text-center">
                                <div>
                                    <h4 class="text-xl font-bold mb-1">{{ $story['title'] }}</h4>
                                    <p class="text-primary-accent text-sm font-semibold">{{ $story['amount'] }}</p>
                                </div>
                            </div>
                            <!-- Overlay on Hover -->
                            <div
                                class="story-overlay absolute inset-0 bg-gradient-to-br from-primary-primary/95 to-primary-700/95 flex flex-col justify-center items-center p-6 text-center opacity-0 hover:opacity-100 transition-all duration-300">
                                <h4 class="text-xl font-bold text-white mb-2">{{ $story['overlay_title'] }}</h4>
                                <p class="text-white/80 text-sm mb-4">{{ $story['overlay_desc'] }}</p>
                                <div class="flex flex-wrap gap-2 justify-center mb-4">
                                    @foreach ($story['tags'] as $tag)
                                        <span
                                            class="px-2 py-1 bg-white/20 rounded-full text-white text-xs">{{ $tag }}</span>
                                    @endforeach
                                </div>
                                <a href="#"
                                    class="w-10 h-10 border-2 border-white rounded-full flex items-center justify-center text-white hover:bg-white hover:text-primary-primary transition-all duration-300">
                                    <i class="fas fa-arrow-right text-sm"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-5">
                            <div class="flex justify-between items-start mb-3">
                                <div>
                                    <h4 class="text-lg font-bold text-primary-primary mb-1">{{ $story['title'] }}</h4>
                                    <p class="text-primary-secondary text-xs font-semibold uppercase tracking-wide">
                                        {{ $story['type'] }}</p>
                                </div>
                                <div class="text-right">
                                    <div class="text-xl font-black text-primary-primary">{{ $story['funding'] }}</div>
                                    <div class="text-xs text-gray-400">Funding</div>
                                </div>
                            </div>
                            <p class="text-gray-500 text-sm mb-3 line-clamp-2">{{ $story['description'] }}</p>
                            <div class="flex items-center justify-between pt-3 border-t border-primary-100">
                                <div class="flex items-center gap-2 text-xs text-gray-400">
                                    <i class="fas fa-chart-line text-primary-secondary"></i>
                                    <span>{{ $story['result'] }}</span>
                                </div>
                                <div class="text-primary-primary text-xs font-semibold">{{ $story['time'] }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- CTA Section -->
        <div class="max-w-4xl mx-auto text-center animate-fade-in-up" style="animation-delay: 0.4s;">
            <div class="bg-gradient-to-br from-primary-primary to-primary-700 rounded-2xl p-8 shadow-2xl">
                <h3 class="text-2xl lg:text-3xl font-bold text-white mb-3">{{ $ss->cta_heading }}</h3>
                <p class="text-white/80 mb-6 max-w-2xl mx-auto">{{ $ss->cta_description }}</p>
                <div class="flex flex-wrap gap-4 justify-center">
                    <a href="{{ $ss->cta_primary_link }}"
                        class="px-6 py-3 bg-white text-primary-primary font-bold rounded-xl transition-all duration-300 hover:bg-primary-50 hover:shadow-xl hover:scale-105 flex items-center gap-2">
                        <i class="fas {{ $ss->cta_primary_icon }}"></i>
                        {{ $ss->cta_primary_text }}
                        <i class="fas fa-arrow-right text-sm"></i>
                    </a>
                    <a href="{{ $ss->cta_secondary_link }}"
                        class="px-6 py-3 border-2 border-white text-white font-bold rounded-xl transition-all duration-300 hover:bg-white hover:text-primary-primary flex items-center gap-2">
                        <i class="fas {{ $ss->cta_secondary_icon }}"></i>
                        {{ $ss->cta_secondary_text }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabs = document.querySelectorAll('.tab-btn');
        const cards = document.querySelectorAll('.story-card');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                const filter = tab.dataset.filter;

                // Update active tab styles
                tabs.forEach(t => {
                    t.classList.remove('bg-primary-primary', 'text-white', 'shadow-md');
                    t.classList.add('bg-transparent', 'text-primary-primary',
                        'border-2', 'border-primary-200');
                });
                tab.classList.add('bg-primary-primary', 'text-white', 'shadow-md');
                tab.classList.remove('bg-transparent', 'text-primary-primary', 'border-2',
                    'border-primary-200');

                // Filter cards
                cards.forEach(card => {
                    const cat = card.dataset.category;
                    if (filter === 'all' || cat === filter) {
                        card.style.display = 'block';
                        card.style.animation = 'fadeInUp 0.5s ease-out forwards';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
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

    .story-overlay {
        pointer-events: none;
    }

    .story-card:hover .story-overlay {
        pointer-events: auto;
    }

    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
