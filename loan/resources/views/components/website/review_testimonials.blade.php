@php
    $ts = \App\Models\TestimonialsSection::first();
@endphp

<style>
    .gradient-review-bg {
        background: linear-gradient(135deg, #f8f5f0 0%, #fef8f0 100%);
    }

    .review-card {
        transition: all 0.3s ease;
    }

    .review-card:hover {
        transform: translateY(-5px);
    }

    .filter-active {
        background-color: #7a4603 !important;
        color: white !important;
    }

    .shape {
        position: absolute;
        z-index: 0;
    }

    .stats-card {
        transition: all 0.3s ease;
    }

    .stats-card:hover {
        transform: scale(1.05);
    }

    .read-more-content {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.5s ease;
    }

    .read-more-content.expanded {
        max-height: 1000px;
    }

    .rating-bar {
        transition: all 0.3s ease;
    }

    .rating-bar:hover {
        transform: scaleX(1.02);
    }
</style>

<!-- Reviews Hero Section -->
<section class="relative overflow-hidden py-16 gradient-review-bg">
    <!-- Background Shapes -->
    <div class="shape w-64 h-64 rounded-full bg-primary-100 opacity-20 top-10 -left-20 animate-float"></div>
    <div class="shape w-40 h-40 rounded-full bg-accent-100 opacity-30 bottom-20 -right-10 animate-float"
        style="animation-delay: 2s;"></div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-4xl mx-auto text-center animate-fadeIn">
            <h1 class="text-5xl font-bold text-primary-700 mb-6">{{ $ts->heading ?? 'Client Reviews & Testimonials' }}
            </h1>
            <p class="text-xl text-gray-600 leading-relaxed mb-8">
                {{ $ts->description ?? 'Discover why hundreds of marketing professionals and entrepreneurs trust FinExpert for their funding needs. Read authentic stories of growth, transformation, and success.' }}
            </p>
            <div class="flex flex-wrap gap-4 justify-center">
                {{-- @php
                    $stats = json_decode($ts->stats ?? '[]', true);
                @endphp --}}
                @foreach ($ts->stats as $stat)
                    <div class="bg-white rounded-lg px-6 py-3 shadow-sm">
                        <div class="text-2xl font-bold text-primary-700">{{ $stat['value'] ?? '150+' }}</div>
                        <div class="text-gray-600">{{ $stat['label'] ?? 'Verified Reviews' }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Rating Summary Section -->
<section class="py-12 bg-white border-b">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Overall Rating -->
            <div class="animate-fadeInUp">
                <h2 class="text-3xl font-bold text-primary-700 mb-6">Overall Client Satisfaction</h2>
                <div class="flex items-center gap-6 mb-8">
                    <div class="text-center">
                        <div class="text-6xl font-bold text-primary-700 mb-2">4.9</div>
                        <div class="flex gap-1 text-accent-500 text-xl mb-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="text-gray-600">Based on 157 reviews</div>
                    </div>
                    <div class="flex-1">
                        <div class="space-y-3">
                            <!-- Rating 5 -->
                            <div class="flex items-center gap-3">
                                <span class="text-sm text-gray-600 w-8">5★</span>
                                <div class="flex-1 bg-gray-200 rounded-full h-3">
                                    <div class="bg-accent-500 h-3 rounded-full w-11/12 rating-bar"></div>
                                </div>
                                <span class="text-sm text-gray-600 w-12">142</span>
                            </div>
                            <!-- Rating 4 -->
                            <div class="flex items-center gap-3">
                                <span class="text-sm text-gray-600 w-8">4★</span>
                                <div class="flex-1 bg-gray-200 rounded-full h-3">
                                    <div class="bg-accent-400 h-3 rounded-full w-3/12 rating-bar"></div>
                                </div>
                                <span class="text-sm text-gray-600 w-12">12</span>
                            </div>
                            <!-- Rating 3 -->
                            <div class="flex items-center gap-3">
                                <span class="text-sm text-gray-600 w-8">3★</span>
                                <div class="flex-1 bg-gray-200 rounded-full h-3">
                                    <div class="bg-yellow-400 h-3 rounded-full w-1/12 rating-bar"></div>
                                </div>
                                <span class="text-sm text-gray-600 w-12">2</span>
                            </div>
                            <!-- Rating 2 -->
                            <div class="flex items-center gap-3">
                                <span class="text-sm text-gray-600 w-8">2★</span>
                                <div class="flex-1 bg-gray-200 rounded-full h-3">
                                    <div class="bg-orange-400 h-3 rounded-full w-0.5/12 rating-bar"></div>
                                </div>
                                <span class="text-sm text-gray-600 w-12">1</span>
                            </div>
                            <!-- Rating 1 -->
                            <div class="flex items-center gap-3">
                                <span class="text-sm text-gray-600 w-8">1★</span>
                                <div class="flex-1 bg-gray-200 rounded-full h-3">
                                    <div class="bg-red-400 h-3 rounded-full w-0/12 rating-bar"></div>
                                </div>
                                <span class="text-sm text-gray-600 w-12">0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rating Categories -->
            <div class="animate-fadeInUp" style="animation-delay: 0.1s;">
                <h3 class="text-2xl font-bold text-primary-700 mb-6">Rating by Category</h3>
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-gray-700">Funding Process</span>
                            <span class="text-primary-700 font-semibold">4.9</span>
                        </div>
                        <div class="flex gap-1 text-accent-500">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-gray-700">Customer Support</span>
                            <span class="text-primary-700 font-semibold">4.8</span>
                        </div>
                        <div class="flex gap-1 text-accent-500">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-gray-700">Loan Terms</span>
                            <span class="text-primary-700 font-semibold">4.7</span>
                        </div>
                        <div class="flex gap-1 text-accent-500">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-gray-700">Business Impact</span>
                            <span class="text-primary-700 font-semibold">5.0</span>
                        </div>
                        <div class="flex gap-1 text-accent-500">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Filter & Sort Section -->
<section class="py-8 bg-gray-50 border-b">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto flex flex-col lg:flex-row justify-between items-center gap-6">
            <div class="flex flex-wrap gap-3">
                <button
                    class="filter-btn px-4 py-2 bg-primary-700 text-white rounded-lg font-medium transition-all duration-300 filter-active"
                    data-filter="all">
                    All Reviews
                </button>
                <button
                    class="filter-btn px-4 py-2 bg-gray-200 text-gray-700 rounded-lg font-medium transition-all duration-300 hover:bg-primary-700 hover:text-white"
                    data-filter="5">
                    5 Stars
                </button>
                <button
                    class="filter-btn px-4 py-2 bg-gray-200 text-gray-700 rounded-lg font-medium transition-all duration-300 hover:bg-primary-700 hover:text-white"
                    data-filter="4">
                    4 Stars
                </button>
                <button
                    class="filter-btn px-4 py-2 bg-gray-200 text-gray-700 rounded-lg font-medium transition-all duration-300 hover:bg-primary-700 hover:text-white"
                    data-filter="marketing">
                    Marketing Agencies
                </button>
                <button
                    class="filter-btn px-4 py-2 bg-gray-200 text-gray-700 rounded-lg font-medium transition-all duration-300 hover:bg-primary-700 hover:text-white"
                    data-filter="ecommerce">
                    E-commerce
                </button>
            </div>

            <div class="flex items-center gap-4">
                <div class="relative">
                    <select
                        class="appearance-none bg-white border border-gray-300 rounded-lg pl-4 pr-10 py-2 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                        <option>Sort by: Most Recent</option>
                        <option>Sort by: Highest Rated</option>
                        <option>Sort by: Most Helpful</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Reviews Grid -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div id="reviews-grid" class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-8">
            @php
                // $testimonials = json_decode($ts->testimonials ?? '[]', true);
                $animationDelays = ['', '0.1s', '0.2s', '0.3s'];
                $categories = ['marketing', 'ecommerce', 'startup', 'sme'];
            @endphp

            @foreach ($ts->testimonials as $index => $testimonial)
                <div class="review-card bg-white rounded-2xl p-8 shadow-lg border border-gray-100 animate-fadeInUp"
                    data-rating="{{ $testimonial['rating'] ?? 5 }}"
                    data-category="{{ $categories[$index] ?? 'marketing' }}"
                    style="animation-delay: {{ $animationDelays[$index] ?? '' }};">

                    <div class="flex justify-between items-start mb-6">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-14 h-14 rounded-full bg-gradient-to-br from-primary-700 to-accent-500 flex items-center justify-center text-white font-bold text-xl overflow-hidden">
                                @if (!empty($testimonial['image']))
                                    <img src="{{ asset('storage/' . $testimonial['image']) }}"
                                        alt="{{ $testimonial['name'] }}" class="w-full h-full object-cover">
                                @else
                                    {{ substr($testimonial['name'], 0, 1) }}
                                @endif
                            </div>
                            <div>
                                <h4 class="text-xl font-bold text-primary-700">
                                    {{ $testimonial['name'] ?? 'Client Name' }}</h4>
                                <p class="text-accent-500">{{ $testimonial['role'] ?? 'Client Role' }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="flex gap-1 text-accent-500 mb-1">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= ($testimonial['rating'] ?? 5))
                                        <i class="fas fa-star"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                            </div>
                            <div class="text-sm text-gray-500">
                                @php
                                    $timeAgo = ['2 weeks ago', '1 month ago', '2 months ago', '3 months ago'];
                                @endphp
                                {{ $timeAgo[$index] ?? 'Recently' }}
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        @php
                            $quote = $testimonial['quote'] ?? '';
                            $sentences = explode('. ', $quote);
                            $preview = implode('. ', array_slice($sentences, 0, 2)) . '.';
                            $fullContent = $quote;
                        @endphp

                        <h5 class="font-semibold text-gray-800 mb-2">
                            @php
                                $titles = [
                                    'Transformed our agency growth trajectory',
                                    'Enabled international expansion we thought was years away',
                                    'Turned our promising technology into a viable business',
                                    'Made the leap from freelancer to agency owner possible',
                                ];
                            @endphp
                            {{ $titles[$index] ?? 'Excellent Service' }}
                        </h5>

                        <p class="text-gray-600 leading-relaxed">
                            {{ $preview }}
                        </p>
                        <div class="read-more-content mt-4" id="review-content-{{ $index + 1 }}">
                            <p class="text-gray-600 leading-relaxed">
                                {{ str_replace($preview, '', $fullContent) }}
                            </p>
                        </div>
                    </div>

                    <div class="flex justify-between items-center">
                        <div class="flex gap-2">
                            @php
                                $tags = [
                                    ['Marketing Agency', 'Growth Loan'],
                                    ['E-commerce', 'Expansion Loan'],
                                    ['Tech Startup', 'Scale-up Loan'],
                                    ['Small Business', 'Business Loan'],
                                ];
                            @endphp
                            @foreach ($tags[$index] ?? [] as $tag)
                                <span
                                    class="px-3 py-1 bg-primary-50 text-primary-700 rounded-full text-sm">{{ $tag }}</span>
                            @endforeach
                        </div>
                        <button
                            class="read-more-btn text-primary-700 font-semibold flex items-center gap-1 transition-colors hover:text-primary-800"
                            data-target="review-content-{{ $index + 1 }}">
                            <span>Read more</span>
                            <i class="fas fa-chevron-down text-sm"></i>
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
                Load More Reviews
            </button>
        </div>
    </div>
</section>

<!-- Stats Section -->
@if (!empty($stats))
    <section class="py-16 bg-primary-700 text-white">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto text-center">
                <h2 class="text-3xl font-bold mb-12">
                    {{ $ts->cta_heading ?? 'Join hundreds of successful marketeers' }}</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    @foreach ($stats as $stat)
                        <div class="stats-card text-center">
                            <div class="text-4xl font-bold text-accent-400 mb-2">{{ $stat['value'] ?? '150+' }}</div>
                            <div class="text-gray-300">{{ $stat['label'] ?? 'Businesses Funded' }}</div>
                        </div>
                    @endforeach
                </div>
                <p class="text-xl text-gray-300 mt-8 mb-8">
                    {{ $ts->cta_description ?? 'Get the funding you need to take your marketing business to the next level' }}
                </p>
                <div class="flex flex-wrap gap-4 justify-center">
                    <a href="{{ $ts->cta_primary_link ?? '/#support' }}"
                        class="px-8 py-4 bg-accent-500 text-white rounded-lg font-semibold transition-all duration-300 hover:bg-accent-600 hover:shadow-lg flex items-center gap-2">
                        <i class="fas {{ $ts->cta_primary_icon ?? 'fa-paper-plane' }}"></i>
                        {{ $ts->cta_primary_text ?? 'Apply Now' }}
                    </a>
                    <a href="{{ $ts->cta_secondary_link ?? '#testimonials' }}"
                        class="px-8 py-4 bg-transparent border-2 border-white text-white rounded-lg font-semibold transition-all duration-300 hover:bg-white hover:text-primary-700 flex items-center gap-2">
                        <i class="fas {{ $ts->cta_secondary_icon ?? 'fa-star' }}"></i>
                        {{ $ts->cta_secondary_text ?? 'Read More Reviews' }}
                    </a>
                </div>
            </div>
        </div>
    </section>
@endif

<!-- Verified Reviews Section -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center mb-12">
            <h2 class="text-3xl font-bold text-primary-700 mb-4">Verified Reviews from Trusted Platforms</h2>
            <p class="text-xl text-gray-600">See what clients are saying about us across different review platforms</p>
        </div>

        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white rounded-2xl p-8 text-center shadow-lg">
                <div class="text-4xl font-bold text-primary-700 mb-2">4.9/5</div>
                <div class="flex gap-1 text-accent-500 justify-center mb-4">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <div class="text-xl font-semibold text-gray-800 mb-2">Google Reviews</div>
                <div class="text-gray-600">Based on 87 reviews</div>
            </div>

            <div class="bg-white rounded-2xl p-8 text-center shadow-lg">
                <div class="text-4xl font-bold text-primary-700 mb-2">4.8/5</div>
                <div class="flex gap-1 text-accent-500 justify-center mb-4">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <div class="text-xl font-semibold text-gray-800 mb-2">Trustpilot</div>
                <div class="text-gray-600">Based on 42 reviews</div>
            </div>

            <div class="bg-white rounded-2xl p-8 text-center shadow-lg">
                <div class="text-4xl font-bold text-primary-700 mb-2">5.0/5</div>
                <div class="flex gap-1 text-accent-500 justify-center mb-4">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <div class="text-xl font-semibold text-gray-800 mb-2">Clutch</div>
                <div class="text-gray-600">Based on 28 reviews</div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Filter functionality
        const filterButtons = document.querySelectorAll('.filter-btn');
        const reviews = document.querySelectorAll('.review-card');

        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                const filter = this.getAttribute('data-filter');

                // Update active filter button
                filterButtons.forEach(btn => {
                    btn.classList.remove('filter-active');
                    btn.classList.add('bg-gray-200', 'text-gray-700');
                    btn.classList.remove('bg-primary-700', 'text-white');
                });

                this.classList.add('filter-active');
                this.classList.remove('bg-gray-200', 'text-gray-700');
                this.classList.add('bg-primary-700', 'text-white');

                // Filter reviews
                reviews.forEach(review => {
                    if (filter === 'all') {
                        review.style.display = 'block';
                    } else if (filter === '5' || filter === '4') {
                        // Filter by rating
                        const rating = review.getAttribute('data-rating');
                        if (rating === filter) {
                            review.style.display = 'block';
                        } else {
                            review.style.display = 'none';
                        }
                    } else {
                        // Filter by category
                        const category = review.getAttribute('data-category');
                        if (category === filter) {
                            review.style.display = 'block';
                        } else {
                            review.style.display = 'none';
                        }
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
                        '<span>Read more</span><i class="fas fa-chevron-down text-sm"></i>';
                } else {
                    content.classList.add('expanded');
                    this.innerHTML =
                        '<span>Show less</span><i class="fas fa-chevron-up text-sm"></i>';
                }
            });
        });

        // Add hover effects to review cards
        reviews.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
                this.style.boxShadow = '0 15px 30px rgba(0, 0, 0, 0.1)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.1)';
            });
        });

        // Add hover effects to rating bars
        const ratingBars = document.querySelectorAll('.rating-bar');
        ratingBars.forEach(bar => {
            bar.addEventListener('mouseenter', function() {
                this.style.transform = 'scaleX(1.02)';
            });

            bar.addEventListener('mouseleave', function() {
                this.style.transform = 'scaleX(1)';
            });
        });
    });
</script>
