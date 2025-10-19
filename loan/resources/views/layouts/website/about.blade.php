<section id="about" class="about-section"
    style="background-color: #f8f5f0; padding: clamp(3rem, 5vw, 5rem) 0; font-family: 'Arial', sans-serif;">
    <div class="about-container"
        style="max-width: 1200px; margin: 0 auto; padding: 0 clamp(1rem, 3vw, 2rem); display: grid; grid-template-columns: 1fr 1fr; gap: clamp(2rem, 4vw, 3rem); align-items: center;">

        <!-- About Images -->
        <div class="about-images" style="position: relative;">
            <div class="about-images-grid"
                style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; align-items: start;">
                @foreach ($sectionData['images'] as $image)
                    @php
                        $isCentered =
                            $image['is_centered'] === true ||
                            $image['is_centered'] === '1' ||
                            $image['is_centered'] === 1;
                        $gridSpan = $isCentered ? 'grid-column: span 2;' : '';
                        $imageWidth = $isCentered ? 'width: 80%; margin: 0 auto;' : 'width: 100%;';
                        $imageClass = $isCentered ? 'about-image--center' : 'about-image';
                    @endphp

                    <div class="about-image-container {{ $imageClass }}"
                        style="position: relative; {{ $gridSpan }} border-radius: 12px; overflow: hidden; box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1); transition: all 0.3s ease;">

                        <!-- Shape -->
                        @if ($image['shape'] && $image['shape_position'])
                            <img src="{{ $image['shape'] }}" alt="{{ $image['shape_alt'] ?? 'Decorative shape' }}"
                                class="shape shape--{{ $image['shape_position'] }}"
                                style="position: absolute; 
                                        max-width: 80px; 
                                        z-index: 0; 
                                        animation: float 3s ease-in-out infinite;
                                        @if ($image['shape_position'] === 'top-left') top: -15px; left: -15px;
                                        @elseif($image['shape_position'] === 'top-right') top: 10px; right: -10px; animation-duration: 4s;
                                        @elseif($image['shape_position'] === 'bottom-left') bottom: -10px; left: 0; animation-duration: 3.5s; @endif" />
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
                                style="{{ $imageWidth }} height: auto; display: block; border-radius: 8px; transition: all 0.3s ease;"
                                onerror="this.style.display='none'" />
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        <!-- About Content -->
        <div class="about-content"
            style="animation: fadeInRight 0.6s ease-in; display: flex; flex-direction: column; justify-content: center;">

            <!-- Subheading -->
            <h4 class="about-subheading"
                style="font-size: clamp(1rem, 2vw, 1.25rem); font-weight: 700; color: #db9123; margin-bottom: 0.75rem; letter-spacing: 1px;">
                {{ $sectionData['subheading'] ?? 'Why Choose Londa Loans' }}
            </h4>

            <!-- Heading -->
            <h2 class="about-heading"
                style="font-size: clamp(1.75rem, 3vw, 2.25rem); font-weight: 700; color: #7a4603; line-height: 1.3; margin-bottom: 1.5rem;">
                {{ $sectionData['heading'] ?? 'We Empower Marketeers with Financial Solutions That Drive Growth' }}
            </h2>

            <!-- Description -->
            <p class="about-description"
                style="font-size: clamp(0.9rem, 2vw, 1rem); color: #666; line-height: 1.6; margin-bottom: 2rem; max-width: 500px;">
                {{ $sectionData['description'] ?? 'At Londa Loans, we understand the unique financial needs of marketers and entrepreneurs. Our tailored loan programs are designed specifically to fuel your business growth and marketing initiatives.' }}
            </p>

            <!-- Features List -->
            <div class="features-list"
                style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
                @foreach ($sectionData['features'] as $feature)
                    @php
                        $bgColor = $feature['bg_color'] === 'primary' ? '#db9123' : '#7a4603';
                        $iconClass = $feature['bg_color'] === 'secondary' ? 'secondary' : '';
                    @endphp
                    <div class="feature-item"
                        style="display: flex; align-items: flex-start; gap: 0.75rem; transition: all 0.3s ease; padding: 1rem; border-radius: 8px;">
                        <div class="feature-icon-container {{ $iconClass }}"
                            style="width: 40px; height: 40px; background-color: {{ $bgColor }}; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; transition: all 0.3s ease;">
                            <img src="{{ asset('assets/images/icon-check.svg') }}"
                                alt="Check mark for {{ $feature['title'] }}" class="feature-icon"
                                style="width: 20px; height: 20px; filter: brightness(0) invert(1);" />
                        </div>
                        <div>
                            <h4 class="feature-title"
                                style="font-size: 1rem; font-weight: 700; color: #7a4603; margin-bottom: 0.25rem;">
                                {{ $feature['title'] }}
                            </h4>
                            <p class="feature-description" style="font-size: 0.875rem; color: #666; line-height: 1.4;">
                                {{ $feature['description'] }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Stats -->
            <div class="stats"
                style="display: flex; flex-wrap: wrap; gap: 1.5rem; margin-bottom: 2rem; justify-content: flex-start;">
                @foreach ($sectionData['stats'] as $stat)
                    <div class="stat-item"
                        style="text-align: center; min-width: 100px; padding: 1rem; transition: all 0.3s ease;">
                        <span class="stat-value"
                            style="font-size: clamp(1.5rem, 2vw, 1.75rem); font-weight: 700; color: #db9123; display: block;">
                            {{ $stat['value'] }}
                        </span>
                        <span class="stat-label" style="font-size: 0.875rem; color: #666; display: block;">
                            {{ $stat['label'] }}
                        </span>
                    </div>
                @endforeach
            </div>

            <!-- Video CTA -->
            @if (isset($sectionData['video_cta']))
                <a href="{{ $sectionData['video_cta']['url'] }}" data-fslightbox class="video-cta"
                    style="display: inline-flex; align-items: center; gap: 0.75rem; text-decoration: none; transition: all 0.3s ease; padding: 0.75rem 1.5rem; border-radius: 50px; background: linear-gradient(135deg, #db9123, #7a4603); color: white; font-weight: 600; box-shadow: 0 4px 12px rgba(219, 145, 35, 0.3);"
                    aria-label="{{ $sectionData['video_cta']['aria_label'] }}">
                    <span class="video-cta-icon-container"
                        style="width: 48px; height: 48px; background-color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; position: relative; transition: all 0.3s ease;">
                        <span class="video-cta-pulse"
                            style="width: 100%; height: 100%; background-color: white; border-radius: 50%; opacity: 0.3; position: absolute; animation: pulse 2s infinite;"></span>
                        <img src="{{ asset('assets/images/icon-play.svg') }}" alt="Play video icon"
                            class="video-cta-icon" style="width: 20px; height: 20px; color: #db9123;" />
                    </span>
                    <span class="video-cta-text"
                        style="font-size: 0.875rem; font-weight: 700; color: white; text-transform: uppercase; letter-spacing: 1px;">
                        {{ $sectionData['video_cta']['text'] }}
                    </span>
                </a>
            @else
                <a href="https://www.youtube.com/watch?v=xcJtL7QggTI" data-fslightbox class="video-cta"
                    style="display: inline-flex; align-items: center; gap: 0.75rem; text-decoration: none; transition: all 0.3s ease; padding: 0.75rem 1.5rem; border-radius: 50px; background: linear-gradient(135deg, #db9123, #7a4603); color: white; font-weight: 600; box-shadow: 0 4px 12px rgba(219, 145, 35, 0.3);"
                    aria-label="Watch video about Londa Loans' impact on marketers">
                    <span class="video-cta-icon-container"
                        style="width: 48px; height: 48px; background-color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; position: relative; transition: all 0.3s ease;">
                        <span class="video-cta-pulse"
                            style="width: 100%; height: 100%; background-color: white; border-radius: 50%; opacity: 0.3; position: absolute; animation: pulse 2s infinite;"></span>
                        <img src="{{ asset('assets/images/icon-play.svg') }}" alt="Play video icon"
                            class="video-cta-icon" style="width: 20px; height: 20px; color: #db9123;" />
                    </span>
                    <span class="video-cta-text"
                        style="font-size: 0.875rem; font-weight: 700; color: white; text-transform: uppercase; letter-spacing: 1px;">
                        See How We Empower Marketers
                    </span>
                </a>
            @endif
        </div>
    </div>

    <style>
        /* Animations */
        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-12px);
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 0.3;
            }

            50% {
                transform: scale(1.15);
                opacity: 0.5;
            }

            100% {
                transform: scale(1);
                opacity: 0.3;
            }
        }

        /* Hover Effects */
        .about-image-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        }

        .feature-item:hover {
            background-color: rgba(219, 145, 35, 0.05);
            transform: translateX(5px);
        }

        .feature-item:hover .feature-icon-container {
            transform: scale(1.1);
        }

        .stat-item:hover {
            transform: translateY(-3px);
        }

        .video-cta:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(219, 145, 35, 0.4);
        }

        .video-cta:hover .video-cta-icon-container {
            transform: scale(1.1);
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .about-container {
                grid-template-columns: 1fr;
            }

            .about-images-grid {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                justify-items: center;
            }

            .shape {
                max-width: 60px;
            }
        }

        @media (max-width: 768px) {
            .about-section {
                padding: 2rem 0;
            }

            .about-heading {
                font-size: clamp(1.5rem, 2vw, 1.75rem);
            }

            .about-subheading {
                font-size: 1rem;
            }

            .features-list {
                grid-template-columns: 1fr;
            }

            .stats {
                flex-direction: column;
                align-items: center;
            }

            .shape {
                display: none;
            }

            .about-image--center {
                width: 80%;
            }
        }

        @media (max-width: 480px) {
            .about-container {
                padding: 0 1rem;
            }

            .about-images-grid {
                gap: 1rem;
            }

            .feature-item {
                padding: 0.75rem;
            }

            .video-cta {
                padding: 0.5rem 1rem;
                font-size: 0.75rem;
            }
        }
    </style>

    <!-- Include fslightbox.js for video lightbox functionality -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fslightbox/3.4.1/index.min.js"></script>
</section>
