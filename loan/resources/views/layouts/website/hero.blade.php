<section class="hero" aria-labelledby="hero-heading">
    <!-- Hero Images -->
    <div class="hero-background">
        <img src="{{ asset('assets/images/shape-01.svg') }}" alt="" class="shape shape-1" loading="lazy">
        <img src="{{ asset('assets/images/shape-02.svg') }}" alt="" class="shape shape-2" loading="lazy">
        <img src="{{ asset('assets/images/shape-03.svg') }}" alt="" class="shape shape-3" loading="lazy">
        <img src="{{ asset('assets/images/shape-04.svg') }}" alt="" class="shape shape-4" loading="lazy">

        @if (isset($sectionData['hero_image']) && $sectionData['hero_image'])
            <img src="{{ Storage::url($sectionData['hero_image']) }}" alt="Woman representing business growth"
                class="hero-main-image" loading="eager">
        @else
            <img src="{{ asset('assets/images/hero.png') }}" alt="Woman representing business growth"
                class="hero-main-image" loading="eager">
        @endif
    </div>

    <!-- Hero Content -->
    <div class="hero-container">
        <div class="hero-content">
            <!-- Brand Logo -->
            <div class="brand-logo" role="banner">
                <a href="index.html" class="brand-link">
                    <div class="brand-name">
                        <span class="brand-part-1">Londa</span>
                        <span class="brand-part-2">Loans</span>
                    </div>
                    <span class="brand-tagline">empowering marketeers</span>
                </a>
            </div>

            <!-- Heading -->
            <h1 id="hero-heading" class="hero-heading">
                {{ $sectionData['heading'] ?? 'Get a Loan for Your Business Growth or Startup' }}
            </h1>

            <!-- Description -->
            <p class="hero-description">
                {{ $sectionData['description'] ?? 'Fast, flexible financing solutions designed specifically for marketers and entrepreneurs. Grow your business with our tailored loan programs.' }}
            </p>

            <!-- Call to Action -->
            <div class="cta-section">
                <a href="{{ $sectionData['ctaButton']['url'] ?? '#!' }}" class="cta-button"
                    aria-label="Start loan application">
                    {{ $sectionData['ctaButton']['text'] ?? 'Get Started Now' }}
                </a>
                <div class="phone-contact">
                    <a href="tel:{{ $sectionData['ctaPhone'] ?? '+123456789' }}" class="phone-link"
                        aria-label="Call us at {{ $sectionData['ctaPhone'] ?? '+123456789' }}">
                        Call us {{ $sectionData['ctaPhone'] ?? '+123456789' }}
                    </a>
                    <span class="phone-subtext">
                        {{ $sectionData['ctaPhoneSubtext'] ?? 'For any question or concern' }}
                    </span>
                </div>
            </div>

            <!-- Trust Indicators -->
            <div class="trust-indicators" role="list">
                @foreach ($sectionData['trustIndicators'] ?? [] as $indicator)
                    <div class="trust-item" role="listitem">
                        <span class="trust-value">{{ $indicator['value'] ?? '' }}</span>
                        <span class="trust-label">{{ $indicator['label'] ?? '' }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <style>
        .hero {
            background: linear-gradient(135deg, #7a4603 0%, #db9123 100%);
            color: white;
            padding: 4rem 0;
            font-family: Arial, sans-serif;
            position: relative;
            overflow: hidden;
        }

        .hero-background {
            position: absolute;
            top: 0;
            right: 0;
            width: 50%;
            height: 100%;
            z-index: 0;
        }

        .shape {
            position: absolute;
            animation: float 3s ease-in-out infinite;
            max-width: 200px;
        }

        .shape-1 {
            top: 10%;
            left: -10%;
            animation-duration: 3s;
            display: none;
        }

        .shape-2 {
            bottom: 10%;
            right: 10%;
            max-width: 150px;
            animation-duration: 4s;
            display: none;
        }

        .shape-3 {
            top: 50%;
            right: 20%;
            max-width: 100px;
            animation-duration: 5s;
            display: none;
        }

        .shape-4 {
            bottom: 20%;
            left: 20%;
            max-width: 120px;
            animation-duration: 3.5s;
        }

        .hero-main-image {
            z-index: 1;
            position: absolute;
            top: 10%;
            right: 0;
            max-width: 100%;
            height: auto;
            max-height: 80%;
            transform-style: inherit;
            transparency: inherit;
        }

        .hero-main-image {
            margin-right: 20%;
            color: #7a4603;
            background: linear-gradient(135deg, #7a4603 0%, #db9123 100%);
        }

        .hero-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
            position: relative;
            z-index: 1;
        }

        .hero-content {
            max-width: 600px;
            animation: fadeIn 0.5s ease-in;
        }

        .brand-logo {
            margin-bottom: 1.5rem;
        }

        .brand-link {
            display: flex;
            flex-direction: column;
            text-decoration: none;
        }

        .brand-name {
            display: flex;
            align-items: center;
        }

        .brand-part-1 {
            font-size: 2rem;
            font-weight: bold;
            color: white;
        }

        .brand-part-2 {
            font-size: 2rem;
            font-weight: bold;
            color: #db9123;
        }

        .brand-tagline {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.8);
        }

        .hero-heading {
            font-size: 2.5rem;
            font-weight: bold;
            line-height: 1.2;
            margin-bottom: 1rem;
        }

        .hero-description {
            font-size: 1rem;
            opacity: 0.9;
            line-height: 1.5;
            margin-bottom: 1.5rem;
            max-width: 500px;
        }

        .cta-section {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            align-items: center;
            margin-bottom: 2rem;
        }

        .cta-button {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            background-color: #db9123;
            border: 2px solid #db9123;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            transition: background-color 0.3s, color 0.3s;
        }

        .cta-button:hover,
        .cta-button:focus {
            background-color: transparent;
            color: #db9123;
            outline: none;
        }

        .phone-contact {
            display: flex;
            flex-direction: column;
        }

        .phone-link {
            font-size: 1rem;
            color: #db9123;
            text-decoration: none;
            font-weight: bold;
        }

        .phone-link:hover,
        .phone-link:focus {
            text-decoration: underline;
            outline: none;
        }

        .phone-subtext {
            font-size: 0.9rem;
            opacity: 0.8;
        }

        .trust-indicators {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
        }

        .trust-item {
            display: flex;
            flex-direction: column;
        }

        .trust-value {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .trust-label {
            font-size: 0.9rem;
            opacity: 0.8;
            color: white !important;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (min-width: 1536px) {

            .shape-1,
            .shape-2,
            .shape-3 {
                display: block;
            }
        }

        @media (max-width: 1024px) {
            .hero {
                padding: 2rem 0;
            }

            .hero-heading {
                font-size: 2rem;
            }

            .hero-description {
                font-size: 0.9rem;
            }

            .shape {
                display: none !important;
            }

            .hero-background {
                width: 40%;
                height: 80%;
            }
        }

        @media (max-width: 768px) {
            .hero-heading {
                font-size: 1.5rem;
            }

            .trust-indicators {
                gap: 1rem;
                justify-content: center;
            }

            .hero-background {
                width: 100%;
                height: 50%;
                opacity: 0.3;
            }
        }

        @media (max-width: 480px) {
            .cta-section {
                flex-direction: column;
                align-items: flex-start;
            }

            .brand-name {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</section>
