@php
    $ss = \App\Models\SuccessStoriesSection::first();
    // $stats = json_decode($ss->stats, true);
    // $categories = json_decode($ss->categories, true);
    // $stories = json_decode($ss->stories, true);
@endphp

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

    .gradient-bg {
        background: linear-gradient(135deg, #f8f5f0 0%, #fef8f0 100%);
    }

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

    .shape {
        position: absolute;
        z-index: 0;
    }

    .filter-active {
        background-color: #7a4603 !important;
        color: white !important;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
    }

    .read-more-content {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.5s ease;
    }

    .read-more-content.expanded {
        max-height: 1000px;
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

    @keyframes float {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-20px);
        }
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
</style>

<!-- Case Studies Hero Section -->
<section class="relative overflow-hidden py-20 gradient-bg">
    <!-- Background Shapes -->
    <div class="shape w-64 h-64 rounded-full bg-primary-100 opacity-20 top-10 -left-20 animate-float"></div>
    <div class="shape w-40 h-40 rounded-full bg-accent-100 opacity-30 bottom-20 -right-10 animate-float"
        style="animation-delay: 2s;"></div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-4xl mx-auto text-center animate-fadeIn">
            <h1 class="text-5xl font-bold text-primary-700 mb-6">{{ $ss->heading }}</h1>
            <p class="text-xl text-gray-600 leading-relaxed mb-8">
                {{ $ss->description }}
            </p>
            <div class="flex flex-wrap gap-4 justify-center">
                @foreach ($ss->stats as $stat)
                    <div class="bg-white rounded-lg px-6 py-3 shadow-sm">
                        <div class="text-2xl font-bold text-primary-700">{{ $stat['value'] }}</div>
                        <div class="text-gray-600">{{ $stat['label'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Filter Section -->
<section class="py-8 bg-white border-b">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row justify-between items-center gap-6">
            <div class="flex flex-wrap gap-4">
                <button
                    class="filter-btn px-4 py-2 bg-primary-700 text-white rounded-lg font-medium transition-all duration-300 filter-active"
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
                        class="filter-btn px-4 py-2 bg-gray-100 text-gray-700 rounded-lg font-medium transition-all duration-300 hover:bg-primary-700 hover:text-white"
                        data-filter="{{ $category }}">
                        {{ $label }}
                    </button>
                @endforeach
            </div>

            <div class="flex items-center gap-4">
                <div class="relative">
                    <select
                        class="appearance-none bg-gray-100 border-0 rounded-lg pl-4 pr-10 py-2 focus:outline-none focus:ring-2 focus:ring-primary-500">
                        <option>Sort by: Newest First</option>
                        <option>Sort by: Funding Amount</option>
                        <option>Sort by: Success Rate</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Case Studies Grid -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div id="case-studies-grid" class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            @foreach ($ss->stories as $index => $story)
                <div class="case-study-card bg-white rounded-2xl overflow-hidden shadow-lg animate-fadeInUp"
                    data-category="{{ $story['category'] }}" style="animation-delay: {{ $index * 0.1 }}s;">
                    <div
                        class="relative h-64 bg-gradient-to-br from-{{ $story['gradient_from'] }} to-{{ $story['gradient_to'] }}">
                        <div class="absolute inset-0 flex items-center justify-center text-white p-6 text-center">
                            <div>
                                <h3 class="text-2xl font-bold mb-2">{{ $story['overlay_title'] ?? $story['title'] }}
                                </h3>
                                <p class="text-primary-100">{{ $story['overlay_desc'] ?? $story['description'] }}</p>
                            </div>
                        </div>
                        <div class="absolute top-4 left-4">
                            <span
                                class="px-3 py-1 bg-white/20 rounded-full text-white text-sm">{{ $story['type'] }}</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-2xl font-bold text-primary-700 mb-2">{{ $story['title'] }}</h3>
                                <p class="text-accent-500 font-semibold">{{ $story['type'] }}</p>
                            </div>
                            <div class="text-right">
                                <div class="text-2xl font-bold text-primary-700">{{ $story['funding'] }}</div>
                                <div class="text-sm text-gray-600">{{ $story['amount'] }}</div>
                            </div>
                        </div>

                        <div class="mb-6">
                            <h4 class="font-semibold text-gray-800 mb-2">The Challenge</h4>
                            <p class="text-gray-600 mb-4">{{ $story['description'] }}</p>

                            <h4 class="font-semibold text-gray-800 mb-2">Our Solution</h4>
                            <p class="text-gray-600">Provided tailored funding with strategic support to achieve their
                                growth objectives.</p>
                        </div>

                        <div class="stats-grid mb-6">
                            <div class="bg-primary-50 rounded-lg p-4 text-center">
                                <div class="text-xl font-bold text-primary-700">{{ $story['result'] }}</div>
                                <div class="text-sm text-gray-600">Key Result</div>
                            </div>
                            <div class="bg-primary-50 rounded-lg p-4 text-center">
                                <div class="text-xl font-bold text-primary-700">{{ $story['time'] }}</div>
                                <div class="text-sm text-gray-600">Timeframe</div>
                            </div>
                            <div class="bg-primary-50 rounded-lg p-4 text-center">
                                <div class="text-xl font-bold text-primary-700">{{ $story['funding'] }}</div>
                                <div class="text-sm text-gray-600">Funding</div>
                            </div>
                        </div>

                        <div class="read-more-content" id="content-{{ $index + 1 }}">
                            <h4 class="font-semibold text-gray-800 mb-2">The Results</h4>
                            <p class="text-gray-600 mb-4">{{ $story['overlay_desc'] ?? $story['description'] }}</p>

                            <div class="flex flex-wrap gap-2 mb-4">
                                @foreach ($story['tags'] as $tag)
                                    <span
                                        class="px-3 py-1 bg-primary-100 text-primary-700 rounded-full text-sm">{{ $tag }}</span>
                                @endforeach
                            </div>

                            <div class="bg-accent-50 rounded-lg p-4 mb-4">
                                <p class="text-accent-700 font-semibold italic">"This funding transformed our business
                                    and helped us achieve remarkable growth in record time."</p>
                                <p class="text-accent-600 mt-2">- Management Team</p>
                            </div>
                        </div>

                        <button
                            class="read-more-btn w-full py-3 border-2 border-primary-700 text-primary-700 rounded-lg font-semibold transition-all duration-300 hover:bg-primary-700 hover:text-white flex items-center justify-center gap-2"
                            data-target="content-{{ $index + 1 }}">
                            <span>Read Full Case Study</span>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Load More Button -->
        <div class="text-center mt-12">
            <button
                class="px-8 py-4 bg-primary-700 text-white rounded-lg font-semibold transition-all duration-300 hover:bg-primary-800 hover:shadow-lg flex items-center gap-2 mx-auto">
                <i class="fas fa-sync-alt"></i>
                Load More Case Studies
            </button>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-gradient-to-r from-primary-700 to-accent-500 text-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-4xl font-bold mb-6">{{ $ss->cta_heading }}</h2>
        <p class="text-xl mb-8 max-w-2xl mx-auto">
            {{ $ss->cta_description }}
        </p>
        <div class="flex flex-wrap gap-4 justify-center">
            <a href="{{ $ss->cta_primary_link }}"
                class="px-8 py-4 bg-white text-primary-700 font-semibold rounded-lg transition-all duration-300 hover:bg-primary-50 hover:shadow-lg flex items-center gap-2">
                <i class="fas {{ $ss->cta_primary_icon }}"></i>
                {{ $ss->cta_primary_text }}
            </a>
            <a href="{{ $ss->cta_secondary_link }}"
                class="px-8 py-4 border-2 border-white text-white font-semibold rounded-lg transition-all duration-300 hover:bg-white hover:text-primary-700 flex items-center gap-2">
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

                // Update active filter button
                filterButtons.forEach(btn => {
                    btn.classList.remove('filter-active');
                    btn.classList.add('bg-gray-100', 'text-gray-700');
                    btn.classList.remove('bg-primary-700', 'text-white');
                });

                this.classList.add('filter-active');
                this.classList.remove('bg-gray-100', 'text-gray-700');
                this.classList.add('bg-primary-700', 'text-white');

                // Filter case studies
                caseStudies.forEach(study => {
                    if (filter === 'all' || study.getAttribute('data-category') ===
                        filter) {
                        study.style.display = 'block';
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

                if (content.classList.contains('expanded')) {
                    content.classList.remove('expanded');
                    this.innerHTML =
                        '<span>Read Full Case Study</span><i class="fas fa-chevron-down"></i>';
                } else {
                    content.classList.add('expanded');
                    this.innerHTML = '<span>Show Less</span><i class="fas fa-chevron-up"></i>';
                }
            });
        });

        // Add hover effects to case study cards
        caseStudies.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-8px)';
                this.style.boxShadow = '0 20px 40px rgba(0, 0, 0, 0.1)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.1)';
            });
        });
    });
</script>
