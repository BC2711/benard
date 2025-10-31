@php $ss = \App\Models\SuccessStoriesSection::first(); @endphp

<section id="success-stories" class="relative overflow-hidden py-20 gradient-project-bg">
    <!-- Background -->
    <div class="shape w-64 h-64 rounded-full bg-primary-100 opacity-20 top-10 -left-20 animate-float"></div>
    <div class="shape w-40 h-40 rounded-full bg-accent-100 opacity-30 bottom-20 -right-10 animate-float"
        style="animation-delay: 2s;"></div>
    <div class="shape w-32 h-32 rounded-full bg-primary-100 opacity-20 top-1/3 right-1/4 animate-float"
        style="animation-delay: 4s;"></div>

    <div class="container mx-auto px-4 relative z-10">
        <!-- Header -->
        <div class="text-center mb-16 max-w-3xl mx-auto animate-fadeIn">
            <h2 class="text-5xl font-bold text-primary-700 mb-6">{{ $ss->heading }}</h2>
            <p class="text-xl text-gray-600 leading-relaxed">{{ $ss->description }}</p>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-12">
            @foreach ($ss->stats as $stat)
                <div class="stat-card bg-white rounded-xl p-6 text-center shadow-lg">
                    <div class="text-4xl font-bold text-primary-700 mb-2">{{ $stat['value'] }}</div>
                    <div class="text-gray-600">{{ $stat['label'] }}</div>
                </div>
            @endforeach
        </div>

        <!-- Tabs -->
        <div class="max-w-4xl mx-auto mb-12">
            <div class="bg-white rounded-xl p-2 flex flex-wrap justify-center gap-2 shadow-lg">
                @foreach ($ss->categories as $i => $cat)
                    <button
                        class="tab-btn px-6 py-3 rounded-lg font-semibold transition-all duration-300 {{ $i === 0 ? 'bg-primary-500 text-white tab-active' : 'bg-transparent text-primary-700 border-2 border-primary-700 hover:bg-primary-700 hover:text-white' }}"
                        data-filter="{{ $cat }}">
                        {{ ucfirst(str_replace('-', ' ', $cat)) }}
                    </button>
                @endforeach
            </div>
        </div>

        <!-- Stories -->
        <div class="max-w-7xl mx-auto mb-16">
            <div id="projects-wrapper" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($ss->stories as $i => $story)
                    <div class="story-card bg-white rounded-2xl overflow-hidden shadow-lg animate-fadeInUp"
                        data-category="{{ $story['category'] }}" style="animation-delay: {{ $i * 0.1 }}s;">
                        <div
                            class="relative h-64 bg-gradient-to-br from-{{ $story['gradient_from'] }} to-{{ $story['gradient_to'] }}">
                            <div class="absolute inset-0 flex items-center justify-center text-white p-6 text-center">
                                <div>
                                    <h4 class="text-2xl font-bold mb-2">{{ $story['title'] }}</h4>
                                    <p class="text-primary-100">{{ $story['amount'] }}</p>
                                </div>
                            </div>
                            <div
                                class="story-overlay absolute inset-0 bg-gradient-to-br from-{{ $story['gradient_from'] }}/90 to-{{ $story['gradient_to'] }}/90 flex flex-col justify-center items-center p-6 text-center opacity-0 hover:opacity-100 transition-opacity duration-300">
                                <h4 class="text-2xl font-bold text-white mb-2">{{ $story['overlay_title'] }}</h4>
                                <p class="text-white mb-4">{{ $story['overlay_desc'] }}</p>
                                <div class="flex gap-2 mb-4">
                                    @foreach ($story['tags'] as $tag)
                                        <span
                                            class="px-3 py-1 bg-white/20 rounded-full text-white text-sm">{{ $tag }}</span>
                                    @endforeach
                                </div>
                                <a href="#"
                                    class="w-12 h-12 border-2 border-white rounded-full flex items-center justify-center text-white hover:bg-white hover:text-primary-700 transition-all duration-300">
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h4 class="text-xl font-bold text-primary-700 mb-1">{{ $story['title'] }}</h4>
                                    <p class="text-accent-500 font-semibold">{{ $story['type'] }}</p>
                                </div>
                                <div class="text-right">
                                    <div class="text-2xl font-bold text-primary-700">{{ $story['funding'] }}</div>
                                    <div class="text-sm text-gray-600">Funding</div>
                                </div>
                            </div>
                            <p class="text-gray-600 mb-4">{{ $story['description'] }}</p>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2 text-sm text-gray-500">
                                    <i class="fas fa-chart-line"></i>
                                    <span>{{ $story['result'] }}</span>
                                </div>
                                <div class="text-primary-700 font-semibold">{{ $story['time'] }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- CTA -->
        <div class="max-w-4xl mx-auto text-center animate-fadeIn" style="animation-delay: 0.4s;">
            <h3 class="text-3xl font-bold text-primary-700 mb-4">{{ $ss->cta_heading }}</h3>
            <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">{{ $ss->cta_description }}</p>
            <div class="flex flex-wrap gap-4 justify-center">
                <a href="{{ $ss->cta_primary_link }}"
                    class="px-8 py-4 bg-accent-500 text-white font-semibold rounded-lg transition-all duration-300 hover:bg-accent-600 hover:shadow-lg flex items-center gap-2">
                    <i class="fas {{ $ss->cta_primary_icon }}"></i>
                    {{ $ss->cta_primary_text }}
                </a>
                <a href="{{ $ss->cta_secondary_link }}"
                    class="px-8 py-4 border-2 border-primary-700 text-primary-700 font-semibold rounded-lg transition-all duration-300 hover:bg-primary-700 hover:text-white flex items-center gap-2">
                    <i class="fas {{ $ss->cta_secondary_icon }}"></i>
                    {{ $ss->cta_secondary_text }}
                </a>
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
                tabs.forEach(t => {
                    t.classList.remove('bg-primary-500', 'text-white', 'tab-active');
                    t.classList.add('bg-transparent', 'text-primary-700', 'border-2',
                        'border-primary-700');
                });
                tab.classList.add('bg-primary-500', 'text-white', 'tab-active');
                tab.classList.remove('bg-transparent', 'text-primary-700', 'border-2',
                    'border-primary-700');

                cards.forEach(card => {
                    const cat = card.dataset.category;
                    card.style.display = (filter === 'all' || cat === filter) ?
                        'block' : 'none';
                });
            });
        });
    });
</script>

<style>
    .tab-active {
        @apply bg-primary-500 text-white;
    }

    .story-overlay {
        pointer-events: none;
    }

    .story-card:hover .story-overlay {
        pointer-events: auto;
    }
</style>
