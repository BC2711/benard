<section id="financial-insights"
    style="background-color: #f8f5f0; padding: 4rem 0; font-family: Arial, sans-serif; position: relative; overflow: hidden;">
    <!-- Background Shapes -->
    <span
        style="position: absolute; top: 10%; left: 5%; width: 150px; height: 150px; background-color: #db9123; opacity: 0.1; border-radius: 50%; animation: float 3s ease-in-out infinite;"></span>
    <img src="{{ asset('assets/images/shape-07.svg') }}" alt="Decorative shape background"
        style="position: absolute; top: 15%; right: 5%; max-width: 80px; animation: float 3.5s ease-in-out infinite;" />
    <img src="{{ asset('assets/images/shape-11.svg') }}" alt="Decorative shape pattern"
        style="position: absolute; top: 20%; left: 10%; max-width: 70px; animation: float 4s ease-in-out infinite;" />
    <img src="{{ asset('assets/images/shape-14.svg') }}" alt="Decorative shape accent"
        style="position: absolute; bottom: 10%; right: 15%; max-width: 90px; animation: float 3.8s ease-in-out infinite;" />
    <img src="{{ asset('assets/images/shape-15.svg') }}" alt="Decorative shape detail"
        style="position: absolute; bottom: 15%; left: 10%; max-width: 85px; animation: float 4.2s ease-in-out infinite;" />

    <!-- Section Title -->
    <div style="text-align: center; margin-bottom: 3rem; animation: fadeIn 0.6s ease-in;">
        <h2 style="font-size: 2.25rem; font-weight: bold; color: #7a4603; line-height: 1.3; margin-bottom: 0.75rem;">
            {{ $sectionData['headline'] ?? 'Financial Insights for Marketeers' }}
        </h2>
        <p style="font-size: 1rem; color: #666; line-height: 1.6; max-width: 600px; margin: 0 auto;">
            {{ $sectionData['subheadline'] ?? 'Expert advice and insights to help marketing professionals make smart financial decisions and grow their businesses effectively.' }}
        </p>
    </div>

    <!-- Blog Posts -->
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 1rem;">
        <div
            style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem; margin-bottom: 3rem;">
            @foreach ($sectionData['posts'] ?? [] as $index => $post)
                <!-- Blog Post {{ $index + 1 }} -->
                <article
                    style="background-color: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.1); animation: fadeInUp 0.6s ease-in {{ $post['animation_delay'] ?? '0.1' }}s both;">
                    <div style="position: relative;">
                        @if (isset($post['image']) && $post['image'])
                            <img src="{{ Storage::url($post['image']) }}" alt="{{ $post['alt'] ?? $post['title'] }}"
                                style="width: 100%; height: 200px; object-fit: cover; display: block;" />
                        @else
                            <!-- Fallback image if no uploaded image -->
                            <img src="{{ asset('assets/images/blog-0' . ($index + 1) . '.png') }}"
                                alt="{{ $post['alt'] ?? $post['title'] }}" style="width: 100%; display: block;" />
                        @endif
                        <span
                            style="position: absolute; top: 1rem; left: 1rem; background-color: {{ $post['category_color'] ?? '#db9123' }}; color: white; padding: 0.5rem 1rem; border-radius: 4px; font-size: 0.85rem; font-weight: bold;">
                            {{ $post['category'] ?? 'Funding Guide' }}
                        </span>
                        <div class="blog-overlay"
                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(135deg, rgba(122, 70, 3, 0.9) 0%, rgba(219, 145, 35, 0.9) 100%); display: flex; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.3s;">
                            <a href="{{ $post['url'] ?? '#!' }}"
                                style="padding: 0.75rem 1.5rem; background-color: white; color: #db9123; border: 2px solid white; text-decoration: none; border-radius: 4px; font-weight: bold; transition: all 0.3s;"
                                aria-label="Read more about {{ $post['title'] }}">Read More</a>
                        </div>
                    </div>
                    <div style="padding: 1.5rem;">
                        <div
                            style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                <div
                                    style="background-color: #7a4603; padding: 0.5rem; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                    <img src="{{ asset('assets/images/icon-man.svg') }}" alt="Author icon"
                                        style="width: 16px; height: 16px;" />
                                </div>
                                <p style="font-size: 0.9rem; color: #666;">{{ $post['author'] ?? 'Sarah Johnson' }}</p>
                            </div>
                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                <div
                                    style="background-color: #db9123; padding: 0.5rem; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                    <img src="{{ asset('assets/images/icon-calendar.svg') }}" alt="Calendar icon"
                                        style="width: 16px; height: 16px;" />
                                </div>
                                <p style="font-size: 0.9rem; color: #666;">
                                    {{ \Carbon\Carbon::parse($post['date'] ?? now())->format('d M, Y') }}
                                </p>
                            </div>
                        </div>
                        <h3 style="font-size: 1.25rem; font-weight: bold; color: #7a4603; margin-bottom: 0.5rem;">
                            <a href="{{ $post['url'] ?? '#!' }}" style="text-decoration: none; color: inherit;"
                                aria-label="Read more about {{ $post['title'] }}">{{ $post['title'] }}</a>
                        </h3>
                        <p style="font-size: 0.9rem; color: #666; margin-bottom: 0.75rem; line-height: 1.5;">
                            {{ $post['excerpt'] ?? 'Learn to budget effectively and maximize ROI on your marketing investments with proper funding planning.' }}
                        </p>
                        <div style="display: flex; gap: 0.5rem; align-items: center;">
                            <span
                                style="font-size: 0.85rem; color: #db9123;">{{ $post['read_time'] ?? '5 min read' }}</span>
                            <span style="font-size: 0.85rem; color: #666;">•</span>
                            <span
                                style="font-size: 0.85rem; color: #db9123;">{{ $post['category'] ?? 'Funding Guide' }}</span>
                        </div>
                    </div>
                </article>
            @endforeach

            {{-- Fallback content if no posts data --}}
            @if (empty($sectionData['posts']))
                <!-- Blog Post 1 (Fallback) -->
                <article
                    style="background-color: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.1); animation: fadeInUp 0.6s ease-in 0.1s both;">
                    <div style="position: relative;">
                        <img src="{{ asset('assets/images/blog-01.png') }}" alt="Marketing campaign funding strategies"
                            style="width: 100%; display: block;" />
                        <span
                            style="position: absolute; top: 1rem; left: 1rem; background-color: #db9123; color: white; padding: 0.5rem 1rem; border-radius: 4px; font-size: 0.85rem; font-weight: bold;">Funding
                            Tips</span>
                        <div class="blog-overlay"
                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(135deg, rgba(122, 70, 3, 0.9) 0%, rgba(219, 145, 35, 0.9) 100%); display: flex; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.3s;">
                            <a href="./blog-single.html"
                                style="padding: 0.75rem 1.5rem; background-color: white; color: #db9123; border: 2px solid white; text-decoration: none; border-radius: 4px; font-weight: bold; transition: all 0.3s;"
                                aria-label="Read more about calculating the right loan amount">Read More</a>
                        </div>
                    </div>
                    <div style="padding: 1.5rem;">
                        <div
                            style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                <div
                                    style="background-color: #7a4603; padding: 0.5rem; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                    <img src="{{ asset('assets/images/icon-man.svg') }}" alt="Author icon"
                                        style="width: 16px; height: 16px;" />
                                </div>
                                <p style="font-size: 0.9rem; color: #666;">Sarah Johnson</p>
                            </div>
                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                <div
                                    style="background-color: #db9123; padding: 0.5rem; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                    <img src="{{ asset('assets/images/icon-calendar.svg') }}" alt="Calendar icon"
                                        style="width: 16px; height: 16px;" />
                                </div>
                                <p style="font-size: 0.9rem; color: #666;">15 Jan, 2024</p>
                            </div>
                        </div>
                        <h3 style="font-size: 1.25rem; font-weight: bold; color: #7a4603; margin-bottom: 0.5rem;">
                            <a href="./blog-single.html" style="text-decoration: none; color: inherit;"
                                aria-label="Read more about calculating the right loan amount">How to Calculate the
                                Right
                                Loan Amount for Your Marketing Campaign</a>
                        </h3>
                        <p style="font-size: 0.9rem; color: #666; margin-bottom: 0.75rem;">Learn to budget effectively
                            and
                            maximize ROI on your marketing investments with proper funding planning.</p>
                        <div style="display: flex; gap: 0.5rem; align-items: center;">
                            <span style="font-size: 0.85rem; color: #db9123;">5 min read</span>
                            <span style="font-size: 0.85rem; color: #666;">•</span>
                            <span style="font-size: 0.85rem; color: #db9123;">Funding Guide</span>
                        </div>
                    </div>
                </article>
                <!-- Blog Post 2 (Fallback) -->
                <article
                    style="background-color: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.1); animation: fadeInUp 0.6s ease-in 0.2s both;">
                    <div style="position: relative;">
                        <img src="{{ asset('assets/images/blog-02.png') }}"
                            alt="Business growth strategies for agencies" style="width: 100%; display: block;" />
                        <span
                            style="position: absolute; top: 1rem; left: 1rem; background-color: #7a4603; color: white; padding: 0.5rem 1rem; border-radius: 4px; font-size: 0.85rem; font-weight: bold;">Growth</span>
                        <div class="blog-overlay"
                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(135deg, rgba(122, 70, 3, 0.9) 0%, rgba(219, 145, 35, 0.9) 100%); display: flex; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.3s;">
                            <a href="./blog-single.html"
                                style="padding: 0.75rem 1.5rem; background-color: white; color: #db9123; border: 2px solid white; text-decoration: none; border-radius: 4px; font-weight: bold; transition: all 0.3s;"
                                aria-label="Read more about scaling your agency">Read More</a>
                        </div>
                    </div>
                    <div style="padding: 1.5rem;">
                        <div
                            style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                <div
                                    style="background-color: #7a4603; padding: 0.5rem; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                    <img src="{{ asset('assets/images/icon-man.svg') }}" alt="Author icon"
                                        style="width: 16px; height: 16px;" />
                                </div>
                                <p style="font-size: 0.9rem; color: #666;">Michael Chen</p>
                            </div>
                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                <div
                                    style="background-color: #db9123; padding: 0.5rem; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                    <img src="{{ asset('assets/images/icon-calendar.svg') }}" alt="Calendar icon"
                                        style="width: 16px; height: 16px;" />
                                </div>
                                <p style="font-size: 0.9rem; color: #666;">8 Jan, 2024</p>
                            </div>
                        </div>
                        <h3 style="font-size: 1.25rem; font-weight: bold; color: #7a4603; margin-bottom: 0.5rem;">
                            <a href="./blog-single.html" style="text-decoration: none; color: inherit;"
                                aria-label="Read more about scaling your agency">Scaling Your Agency: When to Seek
                                Business
                                Expansion Loans</a>
                        </h3>
                        <p style="font-size: 0.9rem; color: #666; margin-bottom: 0.75rem;">Identify the key growth
                            indicators that signal it's time to invest in scaling your marketing agency.</p>
                        <div style="display: flex; gap: 0.5rem; align-items: center;">
                            <span style="font-size: 0.85rem; color: #db9123;">7 min read</span>
                            <span style="font-size: 0.85rem; color: #666;">•</span>
                            <span style="font-size: 0.85rem; color: #db9123;">Growth Strategy</span>
                        </div>
                    </div>
                </article>
                <!-- Blog Post 3 (Fallback) -->
                <article
                    style="background-color: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.1); animation: fadeInUp 0.6s ease-in 0.3s both;">
                    <div style="position: relative;">
                        <img src="{{ asset('assets/images/blog-03.png') }}" alt="Financial planning for marketeers"
                            style="width: 100%; display: block;" />
                        <span
                            style="position: absolute; top: 1rem; left: 1rem; background-color: #db9123; color: white; padding: 0.5rem 1rem; border-radius: 4px; font-size: 0.85rem; font-weight: bold;">Finance</span>
                        <div class="blog-overlay"
                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(135deg, rgba(122, 70, 3, 0.9) 0%, rgba(219, 145, 35, 0.9) 100%); display: flex; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.3s;">
                            <a href="./blog-single.html"
                                style="padding: 0.75rem 1.5rem; background-color: white; color: #db9123; border: 2px solid white; text-decoration: none; border-radius: 4px; font-weight: bold; transition: all 0.3s;"
                                aria-label="Read more about understanding loan terms">Read More</a>
                        </div>
                    </div>
                    <div style="padding: 1.5rem;">
                        <div
                            style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                <div
                                    style="background-color: #7a4603; padding: 0.5rem; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                    <img src="{{ asset('assets/images/icon-man.svg') }}" alt="Author icon"
                                        style="width: 16px; height: 16px;" />
                                </div>
                                <p style="font-size: 0.9rem; color: #666;">David Rodriguez</p>
                            </div>
                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                <div
                                    style="background-color: #db9123; padding: 0.5rem; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                    <img src="{{ asset('assets/images/icon-calendar.svg') }}" alt="Calendar icon"
                                        style="width: 16px; height: 16px;" />
                                </div>
                                <p style="font-size: 0.9rem; color: #666;">2 Jan, 2024</p>
                            </div>
                        </div>
                        <h3 style="font-size: 1.25rem; font-weight: bold; color: #7a4603; margin-bottom: 0.5rem;">
                            <a href="./blog-single.html" style="text-decoration: none; color: inherit;"
                                aria-label="Read more about understanding loan terms">Understanding Loan Terms: What
                                Every
                                Marketeer Should Know</a>
                        </h3>
                        <p style="font-size: 0.9rem; color: #666; margin-bottom: 0.75rem;">Demystify interest rates,
                            repayment periods, and collateral requirements for marketing businesses.</p>
                        <div style="display: flex; gap: 0.5rem; align-items: center;">
                            <span style="font-size: 0.85rem; color: #db9123;">6 min read</span>
                            <span style="font-size: 0.85rem; color: #666;">•</span>
                            <span style="font-size: 0.85rem; color: #db9123;">Financial Education</span>
                        </div>
                    </div>
                </article>
            @endif
        </div>
    </div>

    <!-- CTA Section -->
    <div
        style="max-width: 1200px; margin: 0 auto; padding: 0 1rem; text-align: center; animation: fadeInUp 0.6s ease-in 0.4s both;">
        <h3 style="font-size: 1.75rem; font-weight: bold; color: #7a4603; margin-bottom: 0.5rem;">
            {{ $sectionData['cta']['headline'] ?? 'Want more financial insights?' }}
        </h3>
        <p
            style="font-size: 1rem; color: #666; margin-bottom: 1.5rem; max-width: 600px; margin-left: auto; margin-right: auto;">
            {{ $sectionData['cta']['subheadline'] ?? 'Explore our complete library of resources for marketing professionals' }}
        </p>
        <div style="display: flex; flex-wrap: wrap; gap: 1rem; justify-content: center;">
            <a href="#!"
                style="padding: 0.75rem 1.5rem; background-color: #db9123; border: 2px solid #db9123; color: white; text-decoration: none; border-radius: 4px; font-weight: bold; transition: all 0.3s;"
                aria-label="View all financial insight articles">
                {{ $sectionData['cta']['primary_text'] ?? 'View All Articles' }}
            </a>
            <a href="#!"
                style="padding: 0.75rem 1.5rem; border: 2px solid #7a4603; color: #7a4603; text-decoration: none; border-radius: 4px; font-weight: bold; transition: all 0.3s;"
                aria-label="Subscribe to financial updates">
                {{ $sectionData['cta']['secondary_text'] ?? 'Subscribe to Updates' }}
            </a>
        </div>
    </div>

    <style>
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

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-8px);
            }
        }

        article:hover .blog-overlay {
            opacity: 1;
        }

        .blog-overlay a:hover {
            background-color: transparent;
            color: white;
        }

        a[aria-label*="View all financial insight articles"]:hover {
            background-color: transparent;
            color: #db9123;
        }

        a[aria-label*="Subscribe to financial updates"]:hover {
            background-color: #7a4603;
            color: white;
        }

        @media (max-width: 1024px) {
            section {
                padding: 2rem 0;
            }

            img[alt*="Decorative shape"] {
                max-width: 60px;
            }

            div[style*="grid-template-columns"] {
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            }
        }

        @media (max-width: 768px) {
            h2 {
                font-size: 1.75rem;
            }

            h3 {
                font-size: 1.5rem;
            }

            p {
                font-size: 0.9rem;
            }

            img[alt*="Decorative shape"],
            span[style*="background-color: #db9123"] {
                display: none;
            }

            div[style*="display: flex; flex-wrap: wrap"] {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</section>
