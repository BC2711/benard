<section id="testimonials"
    style="background: linear-gradient(135deg, #7a4603 0%, #db9123 100%); padding: 4rem 0; font-family: Arial, sans-serif; position: relative; overflow: hidden;">
    <!-- Dynamic Background Shapes -->
    @foreach ($sectionData['background_shapes'] ?? [] as $shape)
        @if ($shape['type'] === 'circle')
            <span
                style="position: absolute; {{ $shape['position'] }} width: {{ $shape['size'] }}; height: {{ $shape['size'] }}; background-color: white; opacity: {{ $shape['opacity'] }}; border-radius: 50%; animation: float {{ $shape['animationDuration'] }} ease-in-out infinite;"></span>
        @endif
    @endforeach

    <!-- Section Title -->
    <div style="text-align: center; margin-bottom: 3rem; animation: fadeIn 0.6s ease-in;">
        <h2 style="font-size: 2.25rem; font-weight: bold; color: white; line-height: 1.3; margin-bottom: 0.75rem;">
            {{ $sectionData['headline'] ?? 'What Our Marketeers Say' }}
        </h2>
        <p style="font-size: 1rem; color: white; line-height: 1.6; max-width: 600px; margin: 0 auto; opacity: 0.9;">
            {{ $sectionData['subheadline'] ?? 'Hear from marketing professionals and entrepreneurs who have transformed their businesses with our funding solutions.' }}
        </p>
    </div>

    <!-- Swiper Slider -->
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 1rem;">
        <div class="swiper testimonial-slider" style="animation: fadeInUp 0.6s ease-in 0.2s both;">
            <div class="swiper-wrapper">
                @foreach ($sectionData['testimonials'] ?? [] as $testimonial)
                    <!-- Dynamic Slides -->
                    <div class="swiper-slide">
                        <div
                            style="background-color: white; border-radius: 12px; padding: 2rem; box-shadow: 0 4px 12px rgba(0,0,0,0.1); height: 100%;">
                            <div
                                style="display: flex; flex-direction: column; align-items: center; text-align: center; gap: 1rem; height: 100%;">
                                <!-- Client Photo -->
                                <div
                                    style="width: 80px; height: 80px; border-radius: 50%; background: linear-gradient(135deg, #7a4603, #db9123); display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 1.5rem;">
                                    @if (isset($testimonial['photo']) && $testimonial['photo'])
                                        <img src="{{ Storage::url($testimonial['photo']) }}"
                                            alt="{{ $testimonial['name'] }}"
                                            style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;" />
                                    @else
                                        {{ substr($testimonial['name'] ?? '', 0, 1) }}
                                    @endif
                                </div>
                                <div
                                    style="flex: 1; display: flex; flex-direction: column; justify-content: space-between;">
                                    <div>
                                        <img src="{{ asset('assets/images/icon-quote.svg') }}" alt="Quote icon"
                                            style="width: 40px; height: 40px; margin-bottom: 0.5rem; color: #db9123;" />
                                        <p
                                            style="font-size: 1rem; color: #666; line-height: 1.8; margin-bottom: 1rem; min-height: 120px;">
                                            "{{ $testimonial['content'] ?? '' }}"
                                        </p>
                                    </div>
                                    <div
                                        style="display: flex; flex-direction: column; align-items: center; gap: 0.25rem;">
                                        <span
                                            style="font-size: 1.25rem; font-weight: bold; color: #7a4603;">{{ $testimonial['name'] ?? '' }}</span>
                                        <span
                                            style="font-size: 0.95rem; color: #db9123;">{{ $testimonial['position'] ?? '' }}</span>
                                        <span style="font-size: 1.1rem; color: #db9123;">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= ($testimonial['rating'] ?? 5))
                                                    ★
                                                @else
                                                    ☆
                                                @endif
                                            @endfor
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Navigation Buttons -->
            <div style="display: flex; justify-content: center; gap: 1rem; margin-top: 1.5rem;">
                <div class="swiper-button-prev"
                    style="width: 40px; height: 40px; background-color: white; border: 2px solid #db9123; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.3s;">
                    <svg style="width: 14px; height: 14px;" fill="#7a4603" viewBox="0 0 14 14"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M3.52366 7.83336L7.99366 12.3034L6.81533 13.4817L0.333663 7.00002L6.81533 0.518357L7.99366 1.69669L3.52366 6.16669L13.667 6.16669L13.667 7.83336L3.52366 7.83336Z" />
                    </svg>
                </div>
                <div class="swiper-button-next"
                    style="width: 40px; height: 40px; background-color: white; border: 2px solid #db9123; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.3s;">
                    <svg style="width: 14px; height: 14px;" fill="#7a4603" viewBox="0 0 14 14"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10.4763 6.16664L6.00634 1.69664L7.18467 0.518311L13.6663 6.99998L7.18467 13.4816L6.00634 12.3033L10.4763 7.83331H0.333008V6.16664H10.4763Z" />
                    </svg>
                </div>
            </div>
            <!-- Pagination -->
            <div class="swiper-pagination" style="position: relative; margin-top: 1rem;"></div>
        </div>
    </div>

    <!-- Dynamic Trust Indicators -->
    @if (!empty($sectionData['indicators']))
        <div style="max-width: 1200px; margin: 0 auto; padding: 2rem 1rem;">
            <div
                style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; text-align: center; animation: fadeInUp 0.6s ease-in 0.3s both;">
                @foreach ($sectionData['indicators'] as $indicator)
                    <div>
                        <span
                            style="font-size: 2rem; font-weight: bold; color: white;">{{ $indicator['value'] ?? '' }}</span>
                        <p style="font-size: 0.95rem; color: white; opacity: 0.9;">{{ $indicator['label'] ?? '' }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Dynamic CTA Section -->
    <div
        style="max-width: 1200px; margin: 0 auto; padding: 0 1rem; text-align: center; animation: fadeInUp 0.6s ease-in 0.4s both;">
        <h3 style="font-size: 1.75rem; font-weight: bold; color: white; margin-bottom: 0.5rem;">
            {{ $sectionData['cta_headline'] ?? 'Join hundreds of successful marketeers' }}
        </h3>
        <p
            style="font-size: 1rem; color: white; margin-bottom: 1.5rem; max-width: 600px; margin-left: auto; margin-right: auto; opacity: 0.9;">
            {{ $sectionData['cta_subheadline'] ?? 'Get the funding you need to take your marketing business to the next level' }}
        </p>
        <div style="display: flex; flex-wrap: wrap; gap: 1rem; justify-content: center;">
            <a href="#!"
                style="padding: 0.75rem 1.5rem; background-color: white; border: 2px solid white; color: #db9123; text-decoration: none; border-radius: 4px; font-weight: bold; transition: all 0.3s;"
                aria-label="Apply now for funding">
                {{ $sectionData['cta_primary_text'] ?? 'Apply Now' }}
            </a>
            <a href="#!"
                style="padding: 0.75rem 1.5rem; border: 2px solid white; color: white; text-decoration: none; border-radius: 4px; font-weight: bold; transition: all 0.3s;"
                aria-label="Read more client reviews">
                {{ $sectionData['cta_secondary_text'] ?? 'Read More Reviews' }}
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

        .swiper-button-prev:hover,
        .swiper-button-next:hover {
            background-color: #db9123;
            border-color: white;
        }

        .swiper-button-prev:hover svg,
        .swiper-button-next:hover svg {
            fill: white;
        }

        .swiper-pagination-bullet {
            background-color: white;
            opacity: 0.5;
            width: 10px;
            height: 10px;
        }

        .swiper-pagination-bullet-active {
            background-color: #db9123;
            opacity: 1;
        }

        a:hover {
            transform: translateY(-2px);
        }

        a[aria-label*="Apply now"]:hover {
            background-color: transparent;
            color: white;
        }

        a[aria-label*="Read more"]:hover {
            background-color: white;
            color: #db9123;
        }

        .swiper-slide {
            height: auto;
        }

        .swiper-slide>div {
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        @media (max-width: 1024px) {
            section {
                padding: 2rem 0;
            }

            img[alt*="Decorative shape"] {
                max-width: 60px;
            }

            div[style*="grid-template-columns"] {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
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

            span[style*="background-color: white"] {
                display: none;
            }

            div[style*="display: flex; flex-wrap: wrap"] {
                flex-direction: column;
                align-items: center;
            }

            .swiper-slide>div {
                padding: 1.5rem;
            }

            .trust-indicators-grid {
                grid-template-columns: repeat(2, 1fr) !important;
            }
        }

        @media (max-width: 480px) {
            .trust-indicators-grid {
                grid-template-columns: 1fr !important;
            }

            .swiper-slide>div {
                padding: 1rem;
            }
        }
    </style>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const testimonialSlider = new Swiper('.testimonial-slider', {
                loop: true,
                slidesPerView: 1,
                spaceBetween: 20,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                breakpoints: {
                    640: {
                        slidesPerView: 1,
                    },
                    768: {
                        slidesPerView: 2,
                    },
                    1024: {
                        slidesPerView: 3,
                    }
                },
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                effect: 'slide',
                speed: 600
            });

            // Pause autoplay on hover
            const sliderContainer = document.querySelector('.testimonial-slider');
            sliderContainer.addEventListener('mouseenter', () => {
                testimonialSlider.autoplay.stop();
            });
            sliderContainer.addEventListener('mouseleave', () => {
                testimonialSlider.autoplay.start();
            });

            // Update trust indicators grid for responsiveness
            function updateTrustIndicatorsGrid() {
                const trustContainer = document.querySelector('[style*="grid-template-columns"]');
                if (trustContainer) {
                    if (window.innerWidth < 768) {
                        trustContainer.style.gridTemplateColumns = 'repeat(2, 1fr)';
                    } else if (window.innerWidth < 480) {
                        trustContainer.style.gridTemplateColumns = '1fr';
                    } else {
                        trustContainer.style.gridTemplateColumns = 'repeat(auto-fit, minmax(200px, 1fr))';
                    }
                }
            }

            // Initial call
            updateTrustIndicatorsGrid();

            // Update on resize
            window.addEventListener('resize', updateTrustIndicatorsGrid);
        });
    </script>
</section>
