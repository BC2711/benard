<section id="about" class="about-section"
    style="background-color:  #7a4603 0%; padding: clamp(2rem, 6vw, 6rem) 0; font-family: 'Arial', sans-serif; overflow: hidden;">
    <div class="about-container" style="max-width: 1400px; margin: 0 auto; padding: 0 clamp(1rem, 4vw, 3rem);">
        <div class="about-content-wrapper"
            style="display: grid; grid-template-columns: 1fr; gap: clamp(3rem, 6vw, 5rem);">

            <!-- Mobile First: Content Above Images -->
            <div class="about-content-mobile" style="order: 1; display: block;">
                <!-- Subheading -->
                <h4 class="about-subheading"
                    style="font-size: clamp(0.875rem, 3vw, 1.125rem); font-weight: 700; color: #db9123; margin-bottom: 0.5rem; letter-spacing: 1px; text-transform: uppercase;">
                    {{ $sectionData['subheading'] ?? 'Why Choose Londa Loans' }}
                </h4>

                <!-- Heading -->
                <h2 class="about-heading"
                    style="font-size: clamp(1.75rem, 5vw, 3rem); font-weight: 800; color: #7a4603; line-height: 1.2; margin-bottom: 1rem; max-width: 600px;">
                    {{ $sectionData['heading'] ?? 'We Empower Marketeers with Financial Solutions That Drive Growth' }}
                </h2>

                <!-- Description -->
                <p class="about-description"
                    style="font-size: clamp(1rem, 2.5vw, 1.125rem); color: #666; line-height: 1.6; margin-bottom: 2rem; max-width: 500px;">
                    {{ $sectionData['description'] ?? 'At Londa Loans, we understand the unique financial needs of marketers and entrepreneurs. Our tailored loan programs are designed specifically to fuel your business growth and marketing initiatives.' }}
                </p>

                <!-- Features List -->
                <div class="features-list"
                    style="display: grid; grid-template-columns: 1fr; gap: 1rem; margin-bottom: 2.5rem;">
                    @foreach ($sectionData['features'] as $index => $feature)
                        @php
                            $bgColor = $feature['bg_color'] === 'primary' ? '#db9123' : '#7a4603';
                            $iconClass = $feature['bg_color'] === 'secondary' ? 'secondary' : '';
                            $delay = $index * 100;
                        @endphp
                        <div class="feature-item"
                            style="display: flex; align-items: flex-start; gap: 1rem; transition: all 0.3s ease; padding: 1.25rem; border-radius: 12px; background: rgba(255, 255, 255, 0.8); box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08); animation-delay: {{ $delay }}ms;">
                            <div class="feature-icon-container {{ $iconClass }}"
                                style="width: 50px; height: 50px; background: linear-gradient(135deg, {{ $bgColor }}, {{ $bgColor }}dd); border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; transition: all 0.3s ease;">
                                <i class="fas fa-check" style="font-size: 1.125rem; color: white;"></i>
                            </div>
                            <div style="flex: 1;">
                                <h4 class="feature-title"
                                    style="font-size: clamp(1rem, 2.5vw, 1.125rem); font-weight: 700; color: #7a4603; margin-bottom: 0.5rem;">
                                    {{ $feature['title'] }}
                                </h4>
                                <p class="feature-description"
                                    style="font-size: clamp(0.875rem, 2vw, 1rem); color: #666; line-height: 1.5;">
                                    {{ $feature['description'] }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Stats -->
                <div class="stats"
                    style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; margin-bottom: 2.5rem;">
                    @foreach ($sectionData['stats'] as $stat)
                        <div class="stat-item"
                            style="text-align: center; padding: 1.5rem 1rem; background: white; border-radius: 12px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08); transition: all 0.3s ease;">
                            <span class="stat-value"
                                style="font-size: clamp(1.5rem, 4vw, 2rem); font-weight: 800; color: #db9123; display: block; margin-bottom: 0.25rem;">
                                {{ $stat['value'] }}
                            </span>
                            <span class="stat-label"
                                style="font-size: clamp(0.75rem, 2vw, 0.875rem); color: #666; display: block; font-weight: 600;">
                                {{ $stat['label'] }}
                            </span>
                        </div>
                    @endforeach
                </div>

                <!-- Video CTA -->
                @if (isset($sectionData['video_cta']))
                    <a href="{{ $sectionData['video_cta']['url'] }}" data-fslightbox class="video-cta"
                        style="display: inline-flex; align-items: center; gap: 1rem; text-decoration: none; transition: all 0.3s ease; padding: clamp(0.875rem, 3vw, 1rem) clamp(1.5rem, 4vw, 2rem); border-radius: 50px; background: linear-gradient(135deg, #db9123, #7a4603); color: white; font-weight: 700; box-shadow: 0 8px 25px rgba(219, 145, 35, 0.3); width: fit-content;"
                        aria-label="{{ $sectionData['video_cta']['aria_label'] }}">
                        <span class="video-cta-icon-container"
                            style="width: clamp(44px, 8vw, 56px); height: clamp(44px, 8vw, 56px); background-color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; position: relative; transition: all 0.3s ease;">
                            <span class="video-cta-pulse"
                                style="width: 100%; height: 100%; background-color: white; border-radius: 50%; opacity: 0.3; position: absolute; animation: pulse 2s infinite;"></span>
                            <i class="fas fa-play"
                                style="color: #db9123; font-size: clamp(0.875rem, 2.5vw, 1rem); margin-left: 2px;"></i>
                        </span>
                        <span class="video-cta-text"
                            style="font-size: clamp(0.875rem, 2.5vw, 1rem); font-weight: 700; color: white; text-transform: uppercase; letter-spacing: 0.5px;">
                            {{ $sectionData['video_cta']['text'] }}
                        </span>
                    </a>
                @else
                    <a href="https://www.youtube.com/watch?v=xcJtL7QggTI" data-fslightbox class="video-cta"
                        style="display: inline-flex; align-items: center; gap: 1rem; text-decoration: none; transition: all 0.3s ease; padding: clamp(0.875rem, 3vw, 1rem) clamp(1.5rem, 4vw, 2rem); border-radius: 50px; background: linear-gradient(135deg, #db9123, #7a4603); color: white; font-weight: 700; box-shadow: 0 8px 25px rgba(219, 145, 35, 0.3); width: fit-content;"
                        aria-label="Watch video about Londa Loans' impact on marketers">
                        <span class="video-cta-icon-container"
                            style="width: clamp(44px, 8vw, 56px); height: clamp(44px, 8vw, 56px); background-color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; position: relative; transition: all 0.3s ease;">
                            <span class="video-cta-pulse"
                                style="width: 100%; height: 100%; background-color: white; border-radius: 50%; opacity: 0.3; position: absolute; animation: pulse 2s infinite;"></span>
                            <i class="fas fa-play"
                                style="color: #db9123; font-size: clamp(0.875rem, 2.5vw, 1rem); margin-left: 2px;"></i>
                        </span>
                        <span class="video-cta-text"
                            style="font-size: clamp(0.875rem, 2.5vw, 1rem); font-weight: 700; color: white; text-transform: uppercase; letter-spacing: 0.5px;">
                            See How We Empower Marketers
                        </span>
                    </a>
                @endif
            </div>

            <!-- About Images -->
            <div class="about-images" style="order: 2; position: relative;">
                <div class="about-images-grid"
                    style="display: grid; grid-template-columns: 1fr; gap: 1.5rem; align-items: start; max-width: 600px; margin: 0 auto;">
                    @foreach ($sectionData['images'] as $index => $image)
                        @php
                            $isCentered =
                                $image['is_centered'] === true ||
                                $image['is_centered'] === '1' ||
                                $image['is_centered'] === 1;
                            $gridSpan = $isCentered ? 'grid-column: 1 / -1;' : '';
                            $imageWidth = $isCentered ? 'width: 90%; margin: 0 auto;' : 'width: 100%;';
                            $imageClass = $isCentered ? 'about-image--center' : 'about-image';
                            $delay = $index * 150;
                        @endphp

                        <div class="about-image-container {{ $imageClass }}"
                            style="position: relative; {{ $gridSpan }} border-radius: 16px; overflow: hidden; box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15); transition: all 0.4s ease; animation-delay: {{ $delay }}ms;">

                            <!-- Shape -->
                            @if ($image['shape'] && $image['shape_position'])
                                <img src="{{ $image['shape'] }}" alt="{{ $image['shape_alt'] ?? 'Decorative shape' }}"
                                    class="shape shape--{{ $image['shape_position'] }}"
                                    style="position: absolute; 
                                            max-width: clamp(60px, 10vw, 100px); 
                                            z-index: 2; 
                                            animation: float 4s ease-in-out infinite;
                                            @if ($image['shape_position'] === 'top-left') top: -20px; left: -20px;
                                            @elseif($image['shape_position'] === 'top-right') top: 15px; right: -15px; animation-duration: 5s;
                                            @elseif($image['shape_position'] === 'bottom-left') bottom: -15px; left: 10px; animation-duration: 4.5s; 
                                            @elseif($image['shape_position'] === 'bottom-right') bottom: -15px; right: -15px; animation-duration: 5.5s; @endif" />
                            @endif

                            <!-- Main Image -->
                            @if ($image['src'])
                                @php
                                    $imageUrl = str_starts_with($image['src'], 'assets/')
                                        ? asset($image['src'])
                                        : Storage::url($image['src']);
                                @endphp
                                <img src="{{ $imageUrl }}" alt="{{ $image['alt'] ?? 'About us image' }}"
                                    class="about-image"
                                    style="{{ $imageWidth }} height: auto; display: block; border-radius: 12px; transition: all 0.4s ease;"
                                    onerror="this.style.display='none'" loading="lazy" />
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Animations */
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

        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            33% {
                transform: translateY(-10px) rotate(2deg);
            }

            66% {
                transform: translateY(-5px) rotate(-1deg);
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 0.3;
            }

            50% {
                transform: scale(1.1);
                opacity: 0.5;
            }

            100% {
                transform: scale(1);
                opacity: 0.3;
            }
        }

        /* Base Animations */
        .about-content-mobile>* {
            animation: fadeInUp 0.6s ease-out both;
        }

        .about-image-container {
            animation: fadeInUp 0.8s ease-out both;
        }

        /* Hover Effects */
        .about-image-container:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
        }

        .feature-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
            background: white !important;
        }

        .feature-item:hover .feature-icon-container {
            transform: scale(1.1) rotate(5deg);
        }

        .stat-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        }

        .video-cta:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(219, 145, 35, 0.5);
            background: linear-gradient(135deg, #7a4603, #db9123) !important;
        }

        .video-cta:hover .video-cta-icon-container {
            transform: scale(1.15);
        }

        /* Responsive Design - Mobile First Approach */

        /* Small Mobile (320px - 480px) */
        @media (max-width: 480px) {
            .about-section {
                padding: 1.5rem 0;
            }

            .features-list {
                gap: 0.75rem;
            }

            .feature-item {
                padding: 1rem;
                gap: 0.75rem;
            }

            .feature-icon-container {
                width: 44px !important;
                height: 44px !important;
            }

            .stats {
                grid-template-columns: 1fr;
                gap: 0.75rem;
            }

            .about-images-grid {
                gap: 1rem;
            }
        }

        /* Tablet (768px and up) */
        @media (min-width: 768px) {
            .about-content-wrapper {
                grid-template-columns: 1fr 1fr;
                gap: clamp(2rem, 4vw, 4rem);
                align-items: center;
            }

            .about-content-mobile {
                order: 2;
            }

            .about-images {
                order: 1;
            }

            .features-list {
                grid-template-columns: 1fr;
            }

            .stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .about-images-grid {
                grid-template-columns: 1fr 1fr;
                gap: 1.5rem;
            }
        }

        /* Desktop (1024px and up) */
        @media (min-width: 1024px) {
            .about-content-wrapper {
                gap: clamp(3rem, 6vw, 6rem);
            }

            .about-heading {
                font-size: clamp(2rem, 4vw, 3.5rem) !important;
            }

            .features-list {
                grid-template-columns: 1fr 1fr;
                gap: 1.5rem;
            }

            .stats {
                grid-template-columns: repeat(2, 1fr);
                gap: 1.5rem;
            }

            .about-images-grid {
                gap: 2rem;
            }
        }

        /* Large Desktop (1440px and up) */
        @media (min-width: 1440px) {
            .about-container {
                max-width: 1400px;
            }

            .about-content-wrapper {
                gap: 8rem;
            }

            .features-list {
                gap: 2rem;
            }
        }

        /* Extra Large Screens (1920px and up) */
        @media (min-width: 1920px) {
            .about-container {
                max-width: 1600px;
            }
        }

        /* Print Styles */
        @media print {
            .about-section {
                background: white !important;
                padding: 2rem 0 !important;
            }

            .video-cta {
                display: none !important;
            }

            .about-image-container:hover {
                transform: none !important;
            }
        }

        /* Reduced Motion Support */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }

        /* High Contrast Support */
        @media (prefers-contrast: high) {
            .about-section {
                background: white !important;
                border: 2px solid black;
            }

            .feature-item {
                border: 1px solid black;
            }
        }

        /* Dark Mode Support */
        @media (prefers-color-scheme: dark) {
            .about-section {
                background-color: #1a1a1a !important;
            }

            .about-heading,
            .feature-title {
                color: #ffffff !important;
            }

            .about-description,
            .feature-description,
            .stat-label {
                color: #cccccc !important;
            }

            .feature-item,
            .stat-item {
                background: #2d2d2d !important;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3) !important;
            }
        }

        /* Touch Device Optimizations */
        @media (hover: none) and (pointer: coarse) {

            .about-image-container:hover,
            .feature-item:hover,
            .stat-item:hover,
            .video-cta:hover {
                transform: none;
            }

            .about-image-container:active,
            .feature-item:active,
            .stat-item:active {
                transform: scale(0.98);
            }
        }

        /* Landscape Mobile Optimization */
        @media (max-height: 500px) and (orientation: landscape) {
            .about-section {
                padding: 1rem 0 !important;
            }

            .about-content-wrapper {
                grid-template-columns: 1fr 1fr !important;
                gap: 2rem !important;
            }

            .about-images-grid {
                grid-template-columns: 1fr !important;
            }
        }
    </style>

    <!-- Include fslightbox.js for video lightbox functionality -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fslightbox/3.4.1/index.min.js"></script>

    <!-- Optional: Intersection Observer for scroll animations -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Simple intersection observer for animations
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.animationPlayState = 'running';
                    }
                });
            }, observerOptions);

            // Observe all animated elements
            document.querySelectorAll('.about-content-mobile > *, .about-image-container').forEach(el => {
                el.style.animationPlayState = 'paused';
                observer.observe(el);
            });
        });
    </script>
</section>
