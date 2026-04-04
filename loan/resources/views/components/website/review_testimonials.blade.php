@php
    $ts = \App\Models\TestimonialsSection::first();
@endphp

<style>
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
        max-height: 500px;
    }

    .rating-bar {
        transition: all 0.3s ease;
    }

    .rating-bar:hover {
        transform: scaleX(1.02);
    }
</style>

<!-- Reviews Hero Section -->
<section class="relative overflow-hidden py-16 bg-gradient-to-br from-primary-50 to-white">
    <div class="absolute w-64 h-64 rounded-full bg-primary-100/30 top-10 -left-20 animate-float"></div>
    <div class="absolute w-40 h-40 rounded-full bg-primary-accent/20 bottom-20 -right-10 animate-float"
        style="animation-delay: 2s;"></div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-4xl mx-auto text-center animate-fade-in-up">
            <div
                class="inline-flex items-center space-x-2 bg-primary-100 text-primary-primary px-4 py-2 rounded-full text-sm font-semibold uppercase tracking-wider mb-6 border border-primary-200">
                <i class="fas fa-star text-xs"></i>
                <span>Client Reviews</span>
            </div>
            <h1 class="text-3xl lg:text-4xl xl:text-5xl font-black text-primary-primary mb-5">
                {{ $ts->heading ?? 'Client Reviews & Testimonials' }}</h1>
            <div class="w-20 h-1 bg-primary-secondary mx-auto rounded-full mb-6"></div>
            <p class="text-lg text-gray-600 leading-relaxed mb-8">
                {{ $ts->description ?? 'Discover why hundreds of marketing professionals and entrepreneurs trust Londa Loan for their funding needs.' }}
            </p>
            <div class="flex flex-wrap gap-4 justify-center">
                @foreach ($ts->stats as $stat)
                    <div class="bg-white rounded-lg px-5 py-2 shadow-md border border-primary-100">
                        <div class="text-xl font-black text-primary-primary">{{ $stat['value'] ?? '150+' }}</div>
                        <div class="text-gray-500 text-xs">{{ $stat['label'] ?? 'Verified Reviews' }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Rating Summary Section -->
<section class="py-12 bg-white border-b border-primary-100">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-10">

            <!-- Overall Rating -->
            <div class="animate-fade-in-up">
                <h2 class="text-2xl font-bold text-primary-primary mb-5">Overall Client Satisfaction</h2>
                <div class="flex items-center gap-6 mb-6">
                    <div class="text-center">
                        <div class="text-5xl font-black text-primary-primary mb-1">4.9</div>
                        <div class="flex gap-1 text-primary-accent text-lg mb-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="text-gray-500 text-sm">Based on 157 reviews</div>
                    </div>
                    <div class="flex-1">
                        <div class="space-y-2">
                            <div class="flex items-center gap-2">
                                <span class="text-xs text-gray-600 w-7">5★</span>
                                <div class="flex-1 bg-gray-200 rounded-full h-2">
                                    <div class="bg-primary-accent h-2 rounded-full w-11/12 rating-bar"></div>
                                </div>
                                <span class="text-xs text-gray-500 w-10">142</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-xs text-gray-600 w-7">4★</span>
                                <div class="flex-1 bg-gray-200 rounded-full h-2">
                                    <div class="bg-primary-secondary h-2 rounded-full w-3/12 rating-bar"></div>
                                </div>
                                <span class="text-xs text-gray-500 w-10">12</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-xs text-gray-600 w-7">3★</span>
                                <div class="flex-1 bg-gray-200 rounded-full h-2">
                                    <div class="bg-primary-accent/60 h-2 rounded-full w-1/12 rating-bar"></div>
                                </div>
                                <span class="text-xs text-gray-500 w-10">2</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-xs text-gray-600 w-7">2★</span>
                                <div class="flex-1 bg-gray-200 rounded-full h-2">
                                    <div class="bg-primary-accent/40 h-2 rounded-full w-0.5/12 rating-bar"></div>
                                </div>
                                <span class="text-xs text-gray-500 w-10">1</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-xs text-gray-600 w-7">1★</span>
                                <div class="flex-1 bg-gray-200 rounded-full h-2">
                                    <div class="bg-gray-300 h-2 rounded-full w-0/12 rating-bar"></div>
                                </div>
                                <span class="text-xs text-gray-500 w-10">0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rating Categories -->
            <div class="animate-fade-in-up" style="animation-delay: 0.1s;">
                <h3 class="text-xl font-bold text-primary-primary mb-5">Rating by Category</h3>
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-gray-600 text-sm">Funding Process</span>
                            <span class="text-primary-primary font-bold text-sm">4.9</span>
                        </div>
                        <div class="flex gap-1 text-primary-accent text-sm">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-gray-600 text-sm">Customer Support</span>
                            <span class="text-primary-primary font-bold text-sm">4.8</span>
                        </div>
                        <div class="flex gap-1 text-primary-accent text-sm">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-gray-600 text-sm">Loan Terms</span>
                            <span class="text-primary-primary font-bold text-sm">4.7</span>
                        </div>
                        <div class="flex gap-1 text-primary-accent text-sm">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-gray-600 text-sm">Business Impact</span>
                            <span class="text-primary-primary font-bold text-sm">5.0</span>
                        </div>
                        <div class="flex gap-1 text-primary-accent text-sm">
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

<!-- Filter Section -->
<section class="py-6 bg-primary-50 border-b border-primary-100">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto flex flex-col lg:flex-row justify-between items-center gap-4">
            <div class="flex flex-wrap gap-2 justify-center">
                <button
                    class="filter-btn px-4 py-2 bg-primary-primary text-white rounded-lg font-semibold text-sm transition-all duration-300 filter-active"
                    data-filter="all">
                    All Reviews
                </button>
                <button
                    class="filter-btn px-4 py-2 bg-gray-200 text-gray-700 rounded-lg font-semibold text-sm transition-all duration-300 hover:bg-primary-primary hover:text-white"
                    data-filter="5">
                    5 Stars
                </button>
                <button
                    class="filter-btn px-4 py-2 bg-gray-200 text-gray-700 rounded-lg font-semibold text-sm transition-all duration-300 hover:bg-primary-primary hover:text-white"
                    data-filter="4">
                    4 Stars
                </button>
                <button
                    class="filter-btn px-4 py-2 bg-gray-200 text-gray-700 rounded-lg font-semibold text-sm transition-all duration-300 hover:bg-primary-primary hover:text-white"
                    data-filter="marketing">
                    Marketing
                </button>
                <button
                    class="filter-btn px-4 py-2 bg-gray-200 text-gray-700 rounded-lg font-semibold text-sm transition-all duration-300 hover:bg-primary-primary hover:text-white"
                    data-filter="ecommerce">
                    E-commerce
                </button>
            </div>

            <div class="relative">
                <select
                    class="appearance-none bg-white border border-primary-200 rounded-lg pl-4 pr-10 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-secondary">
                    <option>Sort by: Most Recent</option>
                    <option>Sort by: Highest Rated</option>
                    <option>Sort by: Most Helpful</option>
                </select>
                <div
                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-primary-primary">
                    <i class="fas fa-chevron-down text-xs"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Reviews Grid -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div id="reviews-grid" class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-6">
            @php
                $animationDelays = ['', '0.1s', '0.2s', '0.3s'];
                $categories = ['marketing', 'ecommerce', 'startup', 'sme'];
                $timeAgo = ['2 weeks ago', '1 month ago', '2 months ago', '3 months ago'];
                $titles = [
                    'Transformed our business growth',
                    'Enabled expansion we thought was years away',
                    'Turned our idea into a viable business',
                    'Made the leap from freelancer to owner possible',
                ];
                $tags = [
                    ['Marketing Agency', 'Growth Loan'],
                    ['E-commerce', 'Expansion Loan'],
                    ['Tech Startup', 'Scale-up Loan'],
                    ['Small Business', 'Business Loan'],
                ];
            @endphp

            @foreach ($ts->testimonials as $index => $testimonial)
                <div class="review-card bg-white rounded-xl p-6 shadow-lg border border-primary-100 animate-fade-in-up"
                    data-rating="{{ $testimonial['rating'] ?? 5 }}"
                    data-category="{{ $categories[$index % count($categories)] }}"
                    style="animation-delay: {{ $animationDelays[$index % count($animationDelays)] }};">

                    <div class="flex justify-between items-start mb-4">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-12 h-12 rounded-full bg-gradient-to-br from-primary-primary to-primary-secondary flex items-center justify-center text-white font-bold text-lg overflow-hidden">
                                @if (!empty($testimonial['image']))
                                    <img src="{{ asset('storage/' . $testimonial['image']) }}"
                                        alt="{{ $testimonial['name'] }}" class="w-full h-full object-cover">
                                @else
                                    {{ substr($testimonial['name'], 0, 1) }}
                                @endif
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-primary-primary">
                                    {{ $testimonial['name'] ?? 'Client Name' }}</h4>
                                <p class="text-primary-secondary text-xs font-semibold">
                                    {{ $testimonial['role'] ?? 'Client Role' }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="flex gap-0.5 text-primary-accent text-sm mb-1">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= ($testimonial['rating'] ?? 5))
                                        <i class="fas fa-star"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                            </div>
                            <div class="text-xs text-gray-400">{{ $timeAgo[$index % count($timeAgo)] }}</div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h5 class="font-bold text-gray-800 text-sm mb-2">{{ $titles[$index % count($titles)] }}</h5>
                        @php
                            $quote = $testimonial['quote'] ?? '';
                            $preview = Str::limit($quote, 120);
                            $hasMore = strlen($quote) > 120;
                        @endphp
                        <p class="text-gray-500 text-sm leading-relaxed">
                            {{ $preview }}
                        </p>
                        @if ($hasMore)
                            <div class="read-more-content mt-2" id="review-content-{{ $index }}">
                                <p class="text-gray-500 text-sm leading-relaxed">
                                    {{ Str::after($quote, $preview) }}
                                </p>
                            </div>
                        @endif
                    </div>

                    <div class="flex justify-between items-center pt-3 border-t border-primary-100">
                        <div class="flex gap-2">
                            @foreach ($tags[$index % count($tags)] as $tag)
                                <span
                                    class="px-2 py-0.5 bg-primary-50 text-primary-primary rounded-full text-xs font-semibold">{{ $tag }}</span>
                            @endforeach
                        </div>
                        @if ($hasMore)
                            <button
                                class="read-more-btn text-primary-secondary font-semibold text-xs flex items-center gap-1 hover:text-primary-primary transition"
                                data-target="review-content-{{ $index }}">
                                <span>Read more</span>
                                <i class="fas fa-chevron-down text-xs"></i>
                            </button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Load More -->
        <div class="text-center mt-10">
            <button
                class="px-6 py-3 bg-primary-primary text-white rounded-xl font-semibold text-sm transition-all duration-300 hover:bg-primary-secondary hover:shadow-lg flex items-center gap-2 mx-auto">
                <i class="fas fa-sync-alt text-xs"></i>
                Load More Reviews
            </button>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-gradient-to-br from-primary-primary via-primary-800 to-primary-700 text-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-2xl lg:text-3xl font-black mb-4">
                {{ $ts->cta_heading ?? 'Join hundreds of successful marketeers' }}</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8">
                @foreach ($ts->stats as $stat)
                    <div class="stats-card text-center">
                        <div class="text-2xl font-black text-primary-accent mb-1">{{ $stat['value'] ?? '150+' }}</div>
                        <div class="text-white/70 text-xs">{{ $stat['label'] ?? 'Businesses Funded' }}</div>
                    </div>
                @endforeach
            </div>
            <p class="text-white/80 mb-8 max-w-2xl mx-auto">
                {{ $ts->cta_description ?? 'Get the funding you need to take your business to the next level' }}
            </p>
            <div class="flex flex-wrap gap-4 justify-center">
                <a href="{{ $ts->cta_primary_link ?? '/#support' }}"
                    class="px-6 py-3 bg-white text-primary-primary rounded-xl font-bold shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300 flex items-center gap-2">
                    <i class="fas {{ $ts->cta_primary_icon ?? 'fa-paper-plane' }}"></i>
                    {{ $ts->cta_primary_text ?? 'Apply Now' }}
                    <i class="fas fa-arrow-right text-sm"></i>
                </a>
                <a href="{{ $ts->cta_secondary_link ?? '#testimonials' }}"
                    class="px-6 py-3 border-2 border-white text-white rounded-xl font-bold hover:bg-white hover:text-primary-primary transition-all duration-300 flex items-center gap-2">
                    <i class="fas {{ $ts->cta_secondary_icon ?? 'fa-star' }}"></i>
                    {{ $ts->cta_secondary_text ?? 'Read More Reviews' }}
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Verified Platforms Section -->
<section class="py-12 bg-primary-50">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto text-center mb-8">
            <h2 class="text-2xl font-bold text-primary-primary mb-2">Verified Reviews from Trusted Platforms</h2>
            <p class="text-gray-500 text-sm">See what clients are saying about us across different review platforms</p>
        </div>

        <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-5">
            <div class="bg-white rounded-xl p-5 text-center shadow-md border border-primary-100">
                <div class="text-3xl font-black text-primary-primary mb-1">4.9/5</div>
                <div class="flex gap-1 text-primary-accent justify-center mb-2 text-sm">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                        class="fas fa-star"></i><i class="fas fa-star"></i>
                </div>
                <div class="font-semibold text-gray-800 text-sm mb-1">Google Reviews</div>
                <div class="text-gray-400 text-xs">Based on 87 reviews</div>
            </div>
            <div class="bg-white rounded-xl p-5 text-center shadow-md border border-primary-100">
                <div class="text-3xl font-black text-primary-primary mb-1">4.8/5</div>
                <div class="flex gap-1 text-primary-accent justify-center mb-2 text-sm">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                        class="fas fa-star"></i><i class="fas fa-star"></i>
                </div>
                <div class="font-semibold text-gray-800 text-sm mb-1">Trustpilot</div>
                <div class="text-gray-400 text-xs">Based on 42 reviews</div>
            </div>
            <div class="bg-white rounded-xl p-5 text-center shadow-md border border-primary-100">
                <div class="text-3xl font-black text-primary-primary mb-1">5.0/5</div>
                <div class="flex gap-1 text-primary-accent justify-center mb-2 text-sm">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                        class="fas fa-star"></i><i class="fas fa-star"></i>
                </div>
                <div class="font-semibold text-gray-800 text-sm mb-1">Clutch</div>
                <div class="text-gray-400 text-xs">Based on 28 reviews</div>
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

                filterButtons.forEach(btn => {
                    btn.classList.remove('filter-active', 'bg-primary-primary',
                        'text-white');
                    btn.classList.add('bg-gray-200', 'text-gray-700');
                });

                this.classList.add('filter-active', 'bg-primary-primary', 'text-white');
                this.classList.remove('bg-gray-200', 'text-gray-700');

                reviews.forEach(review => {
                    if (filter === 'all') {
                        review.style.display = 'block';
                    } else if (filter === '5' || filter === '4') {
                        const rating = review.getAttribute('data-rating');
                        review.style.display = rating === filter ? 'block' : 'none';
                    } else {
                        const category = review.getAttribute('data-category');
                        review.style.display = category === filter ? 'block' : 'none';
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

                if (content.classList.contains('expanded')) {
                    content.classList.remove('expanded');
                    this.innerHTML =
                        '<span>Read more</span><i class="fas fa-chevron-down text-xs"></i>';
                } else {
                    content.classList.add('expanded');
                    this.innerHTML =
                        '<span>Show less</span><i class="fas fa-chevron-up text-xs"></i>';
                }
            });
        });
    });
</script>

<style>
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
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-20px);
        }
    }

    .animate-fade-in-up {
        animation: fadeInUp 0.5s ease-out forwards;
        opacity: 0;
    }

    .animate-float {
        animation: float 6s ease-in-out infinite;
    }
</style>
