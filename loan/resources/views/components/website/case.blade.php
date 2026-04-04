@php
    $ss = \App\Models\SuccessStoriesSection::first();
@endphp

<style>
    .case-study-card {
        transition: all 0.3s ease;
    }

    .case-study-card:hover {
        transform: translateY(-8px);
    }

    .tab-active {
        background-color: #db9123 !important;
        color: white !important;
        border-color: #db9123 !important;
    }

    .filter-active {
        background-color: #7a4603 !important;
        color: white !important;
    }

    .read-more-content {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.5s ease;
    }

    .read-more-content.expanded {
        max-height: 800px;
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

    .animate-float {
        animation: float 6s ease-in-out infinite;
    }

    .animate-fade-in-up {
        animation: fadeInUp 0.6s ease-out forwards;
        opacity: 0;
    }
</style>

<!-- Hero Section -->
<section class="relative overflow-hidden py-16 lg:py-20 bg-gradient-to-br from-primary-50 to-white">
    <div class="absolute w-64 h-64 rounded-full bg-primary-100/30 top-10 -left-20 animate-float"></div>
    <div class="absolute w-40 h-40 rounded-full bg-primary-accent/20 bottom-20 -right-10 animate-float"
        style="animation-delay: 2s;"></div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-4xl mx-auto text-center animate-fade-in-up">
            <div
                class="inline-flex items-center space-x-2 bg-primary-100 text-primary-primary px-4 py-2 rounded-full text-sm font-semibold uppercase tracking-wider mb-6 border border-primary-200">
                <i class="fas fa-star text-xs"></i>
                <span>Success Stories</span>
            </div>
            <h1 class="text-3xl lg:text-4xl xl:text-5xl font-black text-primary-primary mb-5">{{ $ss->heading }}</h1>
            <div class="w-20 h-1 bg-primary-secondary mx-auto rounded-full mb-6"></div>
            <p class="text-lg text-gray-600 leading-relaxed mb-8">{{ $ss->description }}</p>
            <div class="flex flex-wrap gap-4 justify-center">
                @foreach ($ss->stats as $stat)
                    <div class="bg-white rounded-xl px-5 py-2 shadow-md border border-primary-100">
                        <div class="text-xl font-black text-primary-primary">{{ $stat['value'] }}</div>
                        <div class="text-gray-500 text-xs">{{ $stat['label'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Filter Section -->
<section class="py-6 bg-white border-b border-primary-100">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row justify-between items-center gap-4">
            <div class="flex flex-wrap gap-2 justify-center">
                <button
                    class="filter-btn px-4 py-2 bg-primary-primary text-white rounded-lg font-semibold text-sm transition-all duration-300 filter-active"
                    data-filter="all">
                    All Case Studies
                </button>
                @foreach ($ss->categories as $category)
                    @php
                        $categoryLabels = [
                            'marketing' => 'Marketing Agencies',
                            'ecommerce' => 'E-commerce Brands',
                            'startup' => 'Tech Startups',
                            'sme' => 'Small Businesses',
                        ];
                        $label = $categoryLabels[$category] ?? ucfirst($category);
                    @endphp
                    <button
                        class="filter-btn px-4 py-2 bg-gray-100 text-gray-700 rounded-lg font-semibold text-sm transition-all duration-300 hover:bg-primary-primary hover:text-white"
                        data-filter="{{ $category }}">
                        {{ $label }}
                    </button>
                @endforeach
            </div>

            <div class="relative">
                <select
                    class="appearance-none bg-gray-100 border-0 rounded-lg pl-4 pr-10 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-secondary">
                    <option>Sort by: Newest First</option>
                    <option>Sort by: Funding Amount</option>
                    <option>Sort by: Success Rate</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-primary-primary">
                    <i class="fas fa-chevron-down text-xs"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Case Studies Grid -->
<section class="py-16 bg-gradient-to-br from-primary-50 to-white">
    <div class="container mx-auto px-4">
        <div id="case-studies-grid" class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            @foreach ($ss->stories as $index => $story)
                <div class="case-study-card bg-white rounded-xl overflow-hidden shadow-lg border border-primary-100 animate-fade-in-up"
                    data-category="{{ $story['category'] }}" style="animation-delay: {{ $index * 0.1 }}s;">

                    <!-- Header Gradient -->
                    <div class="relative h-48 bg-gradient-to-br from-primary-primary to-primary-700">
                        <div class="absolute inset-0 flex items-center justify-center text-white p-6 text-center">
                            <div>
                                <h3 class="text-xl font-bold mb-1">{{ $story['overlay_title'] ?? $story['title'] }}</h3>
                                <p class="text-white/80 text-sm">{{ $story['overlay_desc'] ?? $story['description'] }}
                                </p>
                            </div>
                        </div>
                        <div class="absolute top-3 left-3">
                            <span
                                class="px-2 py-0.5 bg-primary-accent/20 backdrop-blur-sm rounded-full text-white text-xs font-semibold">{{ $story['type'] }}</span>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-5">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <h3 class="text-lg font-bold text-primary-primary mb-1">{{ $story['title'] }}</h3>
                                <p class="text-primary-secondary text-xs font-semibold">{{ $story['type'] }}</p>
                            </div>
                            <div class="text-right">
                                <div class="text-lg font-black text-primary-primary">{{ $story['funding'] }}</div>
                                <div class="text-xs text-gray-400">{{ $story['amount'] }}</div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h4 class="font-semibold text-gray-700 text-sm mb-1">The Challenge</h4>
                            <p class="text-gray-500 text-sm">{{ Str::limit($story['description'], 100) }}</p>
                        </div>

                        <!-- Stats Grid -->
                        <div class="grid grid-cols-3 gap-2 mb-4">
                            <div class="bg-primary-50 rounded-lg p-2 text-center">
                                <div class="text-sm font-black text-primary-primary">{{ $story['result'] }}</div>
                                <div class="text-xs text-gray-500">Key Result</div>
                            </div>
                            <div class="bg-primary-50 rounded-lg p-2 text-center">
                                <div class="text-sm font-black text-primary-primary">{{ $story['time'] }}</div>
                                <div class="text-xs text-gray-500">Timeframe</div>
                            </div>
                            <div class="bg-primary-50 rounded-lg p-2 text-center">
                                <div class="text-sm font-black text-primary-primary">{{ $story['funding'] }}</div>
                                <div class="text-xs text-gray-500">Funding</div>
                            </div>
                        </div>

                        <!-- Read More Content -->
                        <div class="read-more-content" id="content-{{ $index }}">
                            <h4 class="font-semibold text-gray-700 text-sm mb-1 mt-3">Our Solution</h4>
                            <p class="text-gray-500 text-sm mb-3">Provided tailored funding with strategic support to
                                achieve their growth objectives.</p>

                            <h4 class="font-semibold text-gray-700 text-sm mb-1">The Results</h4>
                            <p class="text-gray-500 text-sm mb-3">{{ $story['overlay_desc'] ?? $story['description'] }}
                            </p>

                            <div class="flex flex-wrap gap-1 mb-3">
                                @foreach ($story['tags'] as $tag)
                                    <span
                                        class="px-2 py-0.5 bg-primary-100 text-primary-primary rounded-full text-xs">{{ $tag }}</span>
                                @endforeach
                            </div>

                            <div class="bg-primary-50 rounded-lg p-3 mb-2 border-l-4 border-primary-accent">
                                <p class="text-primary-700 text-xs italic">"This funding transformed our business and
                                    helped us achieve remarkable growth in record time."</p>
                                <p class="text-primary-600 text-xs mt-1 font-semibold">- Management Team</p>
                            </div>
                        </div>

                        <button
                            class="read-more-btn w-full py-2 border-2 border-primary-primary text-primary-primary rounded-lg font-semibold text-sm transition-all duration-300 hover:bg-primary-primary hover:text-white flex items-center justify-center gap-2 mt-2"
                            data-target="content-{{ $index }}">
                            <span>Read Full Case Study</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Load More Button -->
        <div class="text-center mt-10">
            <button
                class="px-6 py-3 bg-primary-primary text-white rounded-xl font-semibold text-sm transition-all duration-300 hover:bg-primary-secondary hover:shadow-lg flex items-center gap-2 mx-auto">
                <i class="fas fa-sync-alt text-xs"></i>
                Load More Case Studies
            </button>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-gradient-to-br from-primary-primary via-primary-800 to-primary-700 text-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-2xl lg:text-3xl font-black mb-4">{{ $ss->cta_heading }}</h2>
        <p class="text-white/80 mb-6 max-w-2xl mx-auto">{{ $ss->cta_description }}</p>
        <div class="flex flex-wrap gap-4 justify-center">
            <a href="{{ $ss->cta_primary_link }}"
                class="px-6 py-3 bg-white text-primary-primary rounded-xl font-bold shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300 flex items-center gap-2">
                <i class="fas {{ $ss->cta_primary_icon }}"></i>
                {{ $ss->cta_primary_text }}
                <i class="fas fa-arrow-right text-sm"></i>
            </a>
            <a href="{{ $ss->cta_secondary_link }}"
                class="px-6 py-3 border-2 border-white text-white rounded-xl font-bold hover:bg-white hover:text-primary-primary transition-all duration-300 hover:scale-105 flex items-center gap-2">
                <i class="fas {{ $ss->cta_secondary_icon }}"></i>
                {{ $ss->cta_secondary_text }}
            </a>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Filter functionality
        const filterButtons = document.querySelectorAll('.filter-btn');
        const caseStudies = document.querySelectorAll('.case-study-card');

        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                const filter = this.getAttribute('data-filter');

                filterButtons.forEach(btn => {
                    btn.classList.remove('filter-active', 'bg-primary-primary',
                        'text-white');
                    btn.classList.add('bg-gray-100', 'text-gray-700');
                });

                this.classList.add('filter-active', 'bg-primary-primary', 'text-white');
                this.classList.remove('bg-gray-100', 'text-gray-700');

                caseStudies.forEach(study => {
                    if (filter === 'all' || study.getAttribute('data-category') ===
                        filter) {
                        study.style.display = 'block';
                        study.style.animation = 'fadeInUp 0.5s ease-out forwards';
                    } else {
                        study.style.display = 'none';
                    }
                });
            });
        });

        // Read more functionality
        const readMoreButtons = document.querySelectorAll('.read-more-btn');

        readMoreButtons.forEach(button => {
            button.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const content = document.getElementById(targetId);
                const icon = this.querySelector('i');
                const span = this.querySelector('span');

                if (content.classList.contains('expanded')) {
                    content.classList.remove('expanded');
                    span.textContent = 'Read Full Case Study';
                    icon.classList.remove('fa-chevron-up');
                    icon.classList.add('fa-chevron-down');
                } else {
                    content.classList.add('expanded');
                    span.textContent = 'Show Less';
                    icon.classList.remove('fa-chevron-down');
                    icon.classList.add('fa-chevron-up');
                }
            });
        });
    });
</script>
