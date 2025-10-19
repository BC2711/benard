<section id="team"
    style="background-color: #f8f5f0; padding: 4rem 0; font-family: Arial, sans-serif; position: relative; overflow: hidden;">
    <!-- Background Shapes -->
    @foreach ($sectionData['shapes'] as $shape)
        @if ($shape['type'] === 'circle')
            <span
                style="position: absolute; {{ $shape['position'] }} width: {{ $shape['size'] }}; height: {{ $shape['size'] }}; background-color: #db9123; opacity: {{ $shape['opacity'] }}; border-radius: 50%;"></span>
        @elseif($shape['type'] === 'image')
            <img src="{{ asset($shape['src']) }}" alt="{{ $shape['alt'] }}"
                style="position: absolute; {{ $shape['position'] }} max-width: 80px; animation: float {{ $shape['animationDuration'] }} ease-in-out infinite;" />
        @endif
    @endforeach

    <!-- Section Title -->
    <div style="text-align: center; margin-bottom: 3rem; animation: fadeIn 0.6s ease-in;">
        <h2 style="font-size: 2.25rem; font-weight: bold; color: #7a4603; line-height: 1.3; margin-bottom: 0.75rem;">
            {{ $sectionData['sectionHeading'] ?? 'Meet Our Financial Experts' }}
        </h2>
        <p style="font-size: 1rem; color: #666; line-height: 1.6; max-width: 600px; margin: 0 auto;">
            {{ $sectionData['sectionDescription'] ?? "Our team of financial specialists understands the unique needs of marketeers and entrepreneurs. We're here to help you grow your business with the right funding solutions." }}
        </p>
    </div>

    <!-- Team Carousel -->
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 1rem; position: relative;">
        <!-- Carousel Container -->
        <div class="team-carousel" style="position: relative; overflow: hidden; margin-bottom: 3rem;">
            <div class="carousel-track" style="display: flex; transition: transform 0.5s ease-in-out; gap: 1.5rem;">
                @foreach ($sectionData['teamMembers'] as $index => $member)
                    <div class="carousel-slide"
                        style="min-width: 280px; flex: 0 0 280px; text-align: center; animation: fadeInUp 0.6s ease-in {{ 0.1 + $index * 0.1 }}s both;">
                        <div style="position: relative; margin-bottom: 1rem;">
                            <img src="{{ asset($member['image']) }}" alt="{{ $member['alt'] }}"
                                style="width: 100%; height: 300px; object-fit: cover; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);" />
                            <div style="position: absolute; bottom: 10px; right: 10px; transform: translateY(50%);">
                                <div class="social-links"
                                    style="display: flex; gap: 0.5rem; background-color: {{ $index % 2 === 0 ? '#7a4603' : '#db9123' }}; padding: 0.5rem; border-radius: 8px; opacity: 0; transform: translateY(10px); transition: opacity 0.3s, transform 0.3s;">
                                    @foreach ($member['socialLinks'] as $socialLink)
                                        @if ($socialLink['platform'] === 'linkedin')
                                            <a href="{{ $socialLink['url'] }}" target="_blank"
                                                rel="noopener noreferrer"
                                                style="display: flex; align-items: center; justify-content: center;"
                                                aria-label="{{ $socialLink['ariaLabel'] }}">
                                                <svg style="width: 16px; height: 16px; fill: white;" viewBox="0 0 17 16"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M3.78353 2.16665C3.78331 2.60867 3.6075 3.03251 3.29478 3.34491C2.98207 3.65732 2.55806 3.8327 2.11603 3.83248C1.674 3.83226 1.25017 3.65645 0.937761 3.34373C0.625357 3.03102 0.449975 2.60701 0.450196 2.16498C0.450417 1.72295 0.626223 1.29912 0.93894 0.986712C1.25166 0.674307 1.67567 0.498925 2.1177 0.499146C2.55972 0.499367 2.98356 0.675173 3.29596 0.98789C3.60837 1.30061 3.78375 1.72462 3.78353 2.16665V2.16665ZM3.83353 5.06665H0.500195V15.5H3.83353V5.06665ZM9.1002 5.06665H5.78353V15.5H9.06686V10.025C9.06686 6.97498 13.0419 6.69165 13.0419 10.025V15.5H16.3335V8.89165C16.3335 3.74998 10.4502 3.94165 9.06686 6.46665L9.1002 5.06665V5.06665Z" />
                                                </svg>
                                            </a>
                                        @elseif($socialLink['platform'] === 'twitter')
                                            <a href="{{ $socialLink['url'] }}" target="_blank"
                                                rel="noopener noreferrer"
                                                style="display: flex; align-items: center; justify-content: center;"
                                                aria-label="{{ $socialLink['ariaLabel'] }}">
                                                <svg style="width: 16px; height: 16px; fill: white;" viewBox="0 0 18 14"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M17.4683 1.71333C16.8321 1.99475 16.1574 2.17956 15.4666 2.26167C16.1947 1.82619 16.7397 1.14085 16.9999 0.333333C16.3166 0.74 15.5674 1.025 14.7866 1.17917C14.2621 0.617982 13.5669 0.245803 12.809 0.120487C12.0512 -0.00482822 11.2732 0.123742 10.596 0.486211C9.91875 0.848679 9.38024 1.42474 9.06418 2.12483C8.74812 2.82492 8.67221 3.60982 8.84825 4.3575C7.46251 4.28805 6.10686 3.92794 4.86933 3.30055C3.63179 2.67317 2.54003 1.79254 1.66492 0.715833C1.35516 1.24788 1.19238 1.85269 1.19326 2.46833C1.19326 3.67667 1.80826 4.74417 2.74326 5.36917C2.18993 5.35175 1.64878 5.20232 1.16492 4.93333V4.97667C1.16509 5.78142 1.44356 6.56135 1.95313 7.18422C2.46269 7.80709 3.17199 8.23456 3.96075 8.39417C3.4471 8.53337 2.90851 8.55388 2.38576 8.45417C2.60814 9.14686 3.04159 9.75267 3.62541 10.1868C4.20924 10.6209 4.9142 10.8615 5.64159 10.875C4.91866 11.4428 4.0909 11.8625 3.20566 12.1101C2.32041 12.3578 1.39503 12.4285 0.482422 12.3183C2.0755 13.3429 3.93 13.8868 5.82409 13.885C12.2349 13.885 15.7408 8.57417 15.7408 3.96833C15.7408 3.81833 15.7366 3.66667 15.7299 3.51833C16.4123 3.02514 17.0013 2.41418 17.4691 1.71417L17.4683 1.71333Z" />
                                                </svg>
                                            </a>
                                        @elseif($socialLink['platform'] === 'facebook')
                                            <a href="{{ $socialLink['url'] }}" target="_blank"
                                                rel="noopener noreferrer"
                                                style="display: flex; align-items: center; justify-content: center;"
                                                aria-label="{{ $socialLink['ariaLabel'] }}">
                                                <svg style="width: 16px; height: 16px; fill: white;" viewBox="0 0 10 18"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M6.66634 10.25H8.74968L9.58301 6.91669H6.66634V5.25002C6.66634 4.39169 6.66634 3.58335 8.33301 3.58335H9.58301V0.783354C9.31134 0.74752 8.28551 0.666687 7.20218 0.666687C4.93968 0.666687 3.33301 2.04752 3.33301 4.58335V6.91669H0.833008V10.25H3.33301V17.3334H6.66634V10.25Z" />
                                                </svg>
                                            </a>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <h4 style="font-size: 1.25rem; font-weight: bold; color: #7a4603; margin-bottom: 0.25rem;">
                            {{ $member['name'] }}
                        </h4>
                        <p style="font-size: 0.95rem; color: #db9123; margin-bottom: 0.25rem; font-weight: 600;">
                            {{ $member['title'] }}</p>
                        <p style="font-size: 0.9rem; color: #666; line-height: 1.4;">{{ $member['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Carousel Navigation -->
        <div style="display: flex; justify-content: center; align-items: center; gap: 1rem; margin-bottom: 2rem;">
            <button class="carousel-prev"
                style="background: #7a4603; border: none; color: white; width: 40px; height: 40px; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.3s;"
                aria-label="Previous team members">
                <svg style="width: 20px; height: 20px; fill: white;" viewBox="0 0 24 24">
                    <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z" />
                </svg>
            </button>

            <!-- Carousel Indicators -->
            <div class="carousel-indicators" style="display: flex; gap: 0.5rem;">
                @foreach ($sectionData['teamMembers'] as $index => $member)
                    <button class="carousel-indicator {{ $index === 0 ? 'active' : '' }}"
                        data-index="{{ $index }}"
                        style="width: 12px; height: 12px; border-radius: 50%; border: none; background: {{ $index === 0 ? '#db9123' : '#ccc' }}; cursor: pointer; transition: background 0.3s;"
                        aria-label="Go to team member {{ $index + 1 }}"></button>
                @endforeach
            </div>

            <button class="carousel-next"
                style="background: #7a4603; border: none; color: white; width: 40px; height: 40px; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.3s;"
                aria-label="Next team members">
                <svg style="width: 20px; height: 20px; fill: white;" viewBox="0 0 24 24">
                    <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Team CTA Section -->
    <div
        style="max-width: 1200px; margin: 0 auto; padding: 0 1rem; text-align: center; animation: fadeIn 0.6s ease-in 0.4s both;">
        <h3 style="font-size: 1.75rem; font-weight: bold; color: #7a4603; margin-bottom: 0.5rem;">
            {{ $sectionData['cta']['heading'] ?? 'Ready to speak with our experts?' }}
        </h3>
        <p
            style="font-size: 1rem; color: #666; margin-bottom: 1.5rem; max-width: 600px; margin-left: auto; margin-right: auto;">
            {{ $sectionData['cta']['description'] ?? 'Get personalized loan advice from professionals who understand marketing businesses' }}
        </p>
        <div style="display: flex; flex-wrap: wrap; gap: 1rem; justify-content: center;">
            <a href="{{ $sectionData['cta']['primaryButton']['url'] ?? '#!' }}"
                style="padding: 0.75rem 1.5rem; background-color: #db9123; border: 2px solid #db9123; color: white; text-decoration: none; border-radius: 4px; font-weight: bold; transition: all 0.3s;"
                aria-label="{{ $sectionData['cta']['primaryButton']['ariaLabel'] ?? 'Schedule a consultation with our financial experts' }}">
                {{ $sectionData['cta']['primaryButton']['text'] ?? 'Schedule Consultation' }}
            </a>
            <a href="{{ $sectionData['cta']['secondaryButton']['url'] ?? '#!' }}"
                style="padding: 0.75rem 1.5rem; border: 2px solid #7a4603; color: #7a4603; text-decoration: none; border-radius: 4px; font-weight: bold; transition: all 0.3s;"
                aria-label="{{ $sectionData['cta']['secondaryButton']['ariaLabel'] ?? 'Learn more about our team' }}">
                {{ $sectionData['cta']['secondaryButton']['text'] ?? 'Meet the Team' }}
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

        .carousel-slide:hover .social-links {
            opacity: 1;
            transform: translateY(0);
        }

        .carousel-prev:hover,
        .carousel-next:hover {
            background: #db9123 !important;
            transform: scale(1.1);
        }

        a:hover {
            transform: translateY(-2px);
        }

        a[aria-label*="Schedule a consultation"]:hover {
            background-color: transparent;
            color: #db9123;
        }

        a[aria-label*="Learn more about our team"]:hover {
            background-color: #7a4603;
            color: white;
        }

        .social-links a:hover {
            transform: scale(1.2);
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            section {
                padding: 2rem 0;
            }

            img[alt*="Decorative shape"] {
                max-width: 60px;
            }

            .carousel-slide {
                min-width: 250px !important;
                flex: 0 0 250px !important;
            }
        }

        @media (max-width: 768px) {
            h2 {
                font-size: 1.75rem;
            }

            h3 {
                font-size: 1.5rem;
            }

            h4 {
                font-size: 1.1rem;
            }

            p {
                font-size: 0.9rem;
            }

            img[alt*="Decorative shape"],
            span[style*="background-color: #db9123"] {
                display: none;
            }

            .carousel-slide {
                min-width: 280px !important;
                flex: 0 0 280px !important;
            }

            .carousel-indicators {
                display: none !important;
            }

            div[style*="display: flex; flex-wrap: wrap"] {
                flex-direction: column;
                align-items: center;
                gap: 0.75rem;
            }
        }

        @media (max-width: 480px) {
            .carousel-slide {
                min-width: 260px !important;
                flex: 0 0 260px !important;
            }

            .team-carousel {
                margin: 0 -1rem;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const track = document.querySelector('.carousel-track');
            const slides = Array.from(document.querySelectorAll('.carousel-slide'));
            const prevButton = document.querySelector('.carousel-prev');
            const nextButton = document.querySelector('.carousel-next');
            const indicators = document.querySelectorAll('.carousel-indicator');

            let currentIndex = 0;
            const slideWidth = slides[0].getBoundingClientRect().width;
            const slidesPerView = Math.floor(track.parentElement.offsetWidth / slideWidth);

            // Set initial position
            updateCarousel();

            // Next button event
            nextButton.addEventListener('click', () => {
                if (currentIndex < slides.length - slidesPerView) {
                    currentIndex++;
                    updateCarousel();
                }
            });

            // Previous button event
            prevButton.addEventListener('click', () => {
                if (currentIndex > 0) {
                    currentIndex--;
                    updateCarousel();
                }
            });

            // Indicator events
            indicators.forEach((indicator, index) => {
                indicator.addEventListener('click', () => {
                    currentIndex = index;
                    updateCarousel();
                });
            });

            // Update carousel position and indicators
            function updateCarousel() {
                const translateX = -currentIndex * (slideWidth + 24); // 24px is the gap
                track.style.transform = `translateX(${translateX}px)`;

                // Update indicators
                indicators.forEach((indicator, index) => {
                    indicator.style.background = index === currentIndex ? '#db9123' : '#ccc';
                });

                // Update button states
                prevButton.style.opacity = currentIndex === 0 ? '0.5' : '1';
                prevButton.style.cursor = currentIndex === 0 ? 'not-allowed' : 'pointer';

                nextButton.style.opacity = currentIndex >= slides.length - slidesPerView ? '0.5' : '1';
                nextButton.style.cursor = currentIndex >= slides.length - slidesPerView ? 'not-allowed' : 'pointer';
            }

            // Handle window resize
            window.addEventListener('resize', () => {
                const newSlideWidth = slides[0].getBoundingClientRect().width;
                if (newSlideWidth !== slideWidth) {
                    updateCarousel();
                }
            });

            // Auto-advance carousel (optional)
            let autoAdvance = setInterval(() => {
                if (currentIndex < slides.length - slidesPerView) {
                    currentIndex++;
                } else {
                    currentIndex = 0;
                }
                updateCarousel();
            }, 5000);

            // Pause auto-advance on hover
            track.addEventListener('mouseenter', () => {
                clearInterval(autoAdvance);
            });

            track.addEventListener('mouseleave', () => {
                autoAdvance = setInterval(() => {
                    if (currentIndex < slides.length - slidesPerView) {
                        currentIndex++;
                    } else {
                        currentIndex = 0;
                    }
                    updateCarousel();
                }, 5000);
            });
        });
    </script>
</section>
