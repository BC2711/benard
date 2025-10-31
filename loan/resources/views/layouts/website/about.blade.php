<style>
    :root {
        --primary: #db9123;
        --secondary: #7a4603;
        --white: #ffffff;
        --light: #f8f9fa;
        --dark: #333333;
        --gray: #666666;
        --border: #e0e0e0;
        --shadow-sm: 0 5px 15px rgba(0, 0, 0, .1);
        --shadow-md: 0 12px 40px rgba(0, 0, 0, .15);
        --shadow-lg: 0 20px 50px rgba(0, 0, 0, .2);
        --radius-sm: 12px;
        --radius-md: 16px;
        --radius-full: 50px;
        --transition: all .3s cubic-bezier(.4, 0, .2, 1);
        --img-size: 360px;
        --gap: clamp(1.5rem, 4vw, 3rem);
        --container: 1400px;
    }

    @media (prefers-color-scheme: dark) {
        :root {
            --light: #1a1a1a;
            --white: #2d2d2d;
            --dark: #ffffff;
            --gray: #cccccc;
            --border: #444444;
        }
    }

   
</style>

<section id="about" class="about" aria-labelledby="about-heading">
    <div class="about__container" style="max-width: 1200px; margin: 0 auto; padding: 0 1rem;">
        <div class="about__grid">

            <!-- Content -->
            <article class="about__content" id="about-content">
                <header class="about__header">
                    <p class="about__kicker">{{ $sectionData['subheading'] ?? 'Why Choose Londa Loans' }}</p>
                    <h2 id="about-heading" class="about__title">
                        {{ $sectionData['heading'] ?? 'We Empower Marketeers with Financial Solutions That Drive Growth' }}
                    </h2>
                    <p class="about__desc">
                        {{ $sectionData['description'] ?? 'At Londa Loans, we understand the unique financial needs of marketers and entrepreneurs. Our tailored loan programs are designed specifically to fuel your business growth and marketing initiatives.' }}
                    </p>
                </header>

                <!-- Features -->
                <div class="features">
                    @foreach ($sectionData['features'] as $i => $f)
                        @php
                            $isPrimary = $f['bg_color'] === 'primary';
                            $delay = $i * 100 . 'ms';
                        @endphp
                        <div class="feature" style="--delay: {{ $delay }};">
                            <div class="feature__icon {{ $isPrimary ? 'primary' : 'secondary' }}">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="feature__text">
                                <h3 class="feature__title">{{ $f['title'] }}</h3>
                                <p class="feature__desc">{{ $f['description'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Stats -->
                <div class="stats">
                    @foreach ($sectionData['stats'] as $s)
                        <div class="stat">
                            <div class="stat__value">{{ $s['value'] }}</div>
                            <div class="stat__label">{{ $s['label'] }}</div>
                        </div>
                    @endforeach
                </div>

                <!-- CTA -->
                @if (isset($sectionData['video_cta']))
                    <a href="{{ $sectionData['video_cta']['url'] }}" data-fslightbox class="cta-video"
                        aria-label="{{ $sectionData['video_cta']['aria_label'] }}">
                    @else
                        <a href="https://www.youtube.com/watch?v=xcJtL7QggTI" data-fslightbox class="cta-video"
                            aria-label="Watch how Londa Loans empowers marketers">
                @endif
                <span class="cta-video__icon">
                    <span class="pulse"></span>
                    <i class="fas fa-play"></i>
                </span>
                <span class="cta-video__text">
                    {{ $sectionData['video_cta']['text'] ?? 'See How We Empower Marketers' }}
                </span>
                </a>
            </article>

            <!-- Images -->
            <aside class="about__media" aria-hidden="true">
                <div class="media-grid">
                    @foreach ($sectionData['images'] as $i => $img)
                        @php
                            $isCentered = in_array($img['is_centered'], [true, '1', 1]);
                            $url = str_starts_with($img['src'], 'assets/')
                                ? asset($img['src'])
                                : Storage::url($img['src']);
                            $delay = $i * 120 . 'ms';
                        @endphp

                        <figure class="media-item {{ $isCentered ? 'span-full' : '' }}"
                            style="--delay: {{ $delay }};">
                            @if ($img['shape'] && $img['shape_position'])
                                <img src="{{ $img['shape'] }}" alt=""
                                    class="shape shape--{{ $img['shape_position'] }}" loading="lazy">
                            @endif

                            @if ($img['src'])
                                <img src="{{ $url }}"
                                    srcset="{{ $url }} 1x, {{ $url }} 2x"
                                    alt="{{ $img['alt'] ?? 'Londa Loans in action' }}" class="media-img" loading="lazy"
                                    width="380" height="380">
                            @endif
                        </figure>
                    @endforeach
                </div>
            </aside>
        </div>
    </div>

    <!-- Professional CSS -->
    <style>
        .about {
            background: var(--secondary);
            padding: clamp(3rem, 8vw, 7rem) 0;
            font-family: system-ui, -apple-system, sans-serif;
            overflow: hidden;
        }

        .about__container {
            max-width: var(--container);
            margin: 0 auto;
            padding: 0 clamp(1rem, 4vw, 2rem);
        }

        .about__grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: var(--gap);
            align-items: center;
        }

        /* Typography */
        .about__kicker {
            font: 700 clamp(.875rem, 2.5vw, 1rem)/1.2 system-ui;
            color: var(--primary);
            letter-spacing: .1em;
            text-transform: uppercase;
            margin-bottom: .75rem;
        }

        .about__title {
            font: 800 clamp(2rem, 5.5vw, 3.5rem)/1.15 system-ui;
            color: var(--light);
            margin: 0 0 1rem;
            max-width: 15ch;
        }

        .about__desc {
            font-size: clamp(1rem, 2.5vw, 1.125rem);
            color: var(--gray);
            line-height: 1.7;
            margin-bottom: 2.5rem;
            max-width: 60ch;
        }

        /* Features */
        .features {
            display: grid;
            gap: 1.25rem;
            margin-bottom: 2.5rem;
        }

        .feature {
            display: flex;
            gap: 1rem;
            padding: 1.5rem;
            background: rgba(255, 255, 255, .95);
            border-radius: var(--radius-sm);
            box-shadow: var(--shadow-sm);
            opacity: 0;
            transform: translateY(20px);
            animation: fadeUp .6s var(--delay) forwards;
            transition: var(--transition);
        }

        .feature__icon {
            flex: 0 0 52px;
            height: 52px;
            border-radius: var(--radius-sm);
            display: grid;
            place-items: center;
            font-size: 1.25rem;
            color: var(--white);
            background: linear-gradient(135deg, var(--primary), color-mix(in srgb, var(--primary) 85%, #000));
            transition: var(--transition);
        }

        .feature__icon.secondary {
            background: linear-gradient(135deg, var(--secondary), color-mix(in srgb, var(--secondary) 85%, #000));
        }

        .feature__title {
            font: 700 clamp(1.05rem, 2.5vw, 1.15rem)/1.3 system-ui;
            color: var(--secondary);
            margin: 0 0 .4rem;
        }

        .feature__desc {
            font-size: clamp(.9rem, 2vw, 1rem);
            color: var(--gray);
            margin: 0;
            line-height: 1.55;
        }

        /* Stats */
        .stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            margin-bottom: 2.5rem;
        }

        .stat {
            text-align: center;
            padding: 1.75rem 1rem;
            background: var(--white);
            border-radius: var(--radius-sm);
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
        }

        .stat__value {
            font: 800 clamp(1.75rem, 4.5vw, 2.25rem)/1 system-ui;
            color: var(--primary);
            display: block;
        }

        .stat__label {
            font: 600 clamp(.8rem, 2vw, .9rem)/1.4 system-ui;
            color: var(--gray);
            text-transform: uppercase;
            letter-spacing: .05em;
        }

        /* CTA */
        .cta-video {
            display: inline-flex;
            align-items: center;
            gap: 1rem;
            padding: clamp(.9rem, 3vw, 1.1rem) clamp(1.8rem, 4.5vw, 2.25rem);
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: var(--white);
            font: 700 clamp(.95rem, 2.5vw, 1.05rem)/1 system-ui;
            text-transform: uppercase;
            letter-spacing: .08em;
            border-radius: var(--radius-full);
            text-decoration: none;
            box-shadow: 0 8px 30px rgba(219, 145, 35, .35);
            transition: var(--transition);
            outline: none;
        }

        .cta-video:focus-visible {
            outline: 3px solid var(--primary);
            outline-offset: 3px;
        }

        .cta-video__icon {
            width: clamp(48px, 9vw, 60px);
            height: clamp(48px, 9vw, 60px);
            background: var(--white);
            border-radius: 50%;
            display: grid;
            place-items: center;
            position: relative;
            transition: var(--transition);
        }

        .pulse {
            inset: 0;
            background: var(--white);
            border-radius: 50%;
            opacity: .3;
            position: absolute;
            animation: pulse 2s infinite;
        }

        /* Media */
        .media-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
            max-width: 600px;
            margin: 0 auto;
        }

        .media-item {
            position: relative;
            border-radius: var(--radius-md);
            overflow: hidden;
            box-shadow: var(--shadow-md);
            opacity: 0;
            transform: translateY(30px);
            animation: fadeUp .7s var(--delay) forwards;
            transition: var(--transition);
        }

        .media-item.span-full {
            grid-column: 1 / -1;
        }

        .media-img {
            width: var(--img-size);
            height: var(--img-size);
            object-fit: cover;
            display: block;
            border-radius: var(--radius-sm);
            transition: var(--transition);
        }

        .shape {
            position: absolute;
            z-index: 2;
            max-width: clamp(60px, 12vw, 110px);
            animation: float 4.5s ease-in-out infinite;
        }

        .shape--top-left {
            top: -1.5rem;
            left: -1.5rem;
        }

        .shape--top-right {
            top: 1rem;
            right: -1rem;
            animation-duration: 5s;
        }

        .shape--bottom-left {
            bottom: -1rem;
            left: .5rem;
            animation-duration: 4.8s;
        }

        .shape--bottom-right {
            bottom: -1rem;
            right: -1rem;
            animation-duration: 5.5s;
        }

        /* Animations */
        @keyframes fadeUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            33% {
                transform: translateY(-12px) rotate(2deg);
            }

            66% {
                transform: translateY(-6px) rotate(-1deg);
            }
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
                opacity: .3;
            }

            50% {
                transform: scale(1.15);
                opacity: .5;
            }
        }

        /* Hover & Focus */
        .feature:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
            background: #fff;
        }

        .feature:hover .feature__icon {
            transform: scale(1.12) rotate(6deg);
        }

        .stat:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-lg);
        }

        .cta-video:hover {
            transform: translateY(-4px);
            box-shadow: 0 14px 40px rgba(219, 145, 35, .5);
            background: linear-gradient(135deg, var(--secondary), var(--primary));
        }

        .cta-video:hover .cta-video__icon {
            transform: scale(1.18);
        }

        .media-item:hover {
            transform: translateY(-10px) scale(1.025);
            box-shadow: var(--shadow-lg);
        }

        /* Responsive */
        @media (min-width: 768px) {
            .about__grid {
                grid-template-columns: 1fr 1fr;
                gap: clamp(2rem, 6vw, 5rem);
            }

            .about__content {
                order: 2;
            }

            .about__media {
                order: 1;
            }

            .media-grid {
                grid-template-columns: 1fr 1fr;
            }

            .features {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (min-width: 1024px) {
            .about__title {
                max-width: 12ch;
            }

            .stats {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        @media (min-width: 1440px) {
            .about__container {
                max-width: 1380px;
            }
        }

        @media (max-width: 480px) {
            .stats {
                grid-template-columns: 1fr;
            }

            .feature__icon {
                flex: 0 0 46px;
                height: 46px;
                font-size: 1.1rem;
            }
        }

        /* Accessibility */
        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                animation-duration: .01ms !important;
                transition-duration: .01ms !important;
            }
        }

        @media (hover: none) {

            .feature:hover,
            .stat:hover,
            .cta-video:hover,
            .media-item:hover {
                transform: none !important;
            }
        }
    </style>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fslightbox/3.4.1/index.min.js" integrity="sha512-..."
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.animationPlayState = 'running';
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.15,
                rootMargin: '0px 0px -60px 0px'
            });

            document.querySelectorAll('.feature, .media-item').forEach(el => {
                el.style.animationPlayState = 'paused';
                observer.observe(el);
            });
        });
    </script>
</section>