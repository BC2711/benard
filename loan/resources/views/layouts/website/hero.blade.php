<section
    style="background: linear-gradient(135deg, #7a4603 0%, #db9123 100%); color: white; padding: 4rem 0; font-family: Arial, sans-serif; position: relative; overflow: hidden;">
    <!-- Hero Images -->
    <div style="position: absolute; top: 0; right: 0; width: 50%; height: 100%; z-index: 0;">
        <img src="{{ asset('assets/images/shape-01.svg') }}" alt="Decorative shape"
            style="position: absolute; top: 10%; left: -10%; max-width: 200px; display: none; animation: float 3s ease-in-out infinite;"
            class="shape 2xl:block">
        <img src="{{ asset('assets/images/shape-02.svg') }}" alt="Decorative shape"
            style="position: absolute; bottom: 10%; right: 10%; max-width: 150px; display: none; animation: float 4s ease-in-out infinite;"
            class="shape 2xl:block">
        <img src="{{ asset('assets/images/shape-03.svg') }}" alt="Decorative shape"
            style="position: absolute; top: 50%; right: 20%; max-width: 100px; display: none; animation: float 5s ease-in-out infinite;"
            class="shape 2xl:block">
        <img src="{{ asset('assets/images/shape-04.svg') }}" alt="Decorative shape"
            style="position: absolute; bottom: 20%; left: 20%; max-width: 120px; animation: float 3.5s ease-in-out infinite;">
        {{--  --}}
        @if (isset($heroData['hero_image']) && $heroData['hero_image'])
            <img src="{{ Storage::url($heroData['hero_image']) }}" alt="Woman representing business growth"
                style="position: absolute; top: 10%; right: 0; max-width: 100%; height: auto; max-height: 80%;">
        @else
            <img src="{{ asset('assets/images/hero.png') }}" alt="Woman representing business growth"
                style="position: absolute; top: 10%; right: 0; max-width: 100%; height: auto; max-height: 80%;">
        @endif
    </div>

    <!-- Hero Content -->
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 1rem; position: relative; z-index: 1;">
        <div style="max-width: 600px; animation: fadeIn 0.5s ease-in;">
            <!-- Brand Logo -->
            <div style="display: flex; align-items: center; margin-bottom: 1.5rem;">
                <a href="index.html" style="display: flex; flex-direction: column; text-decoration: none;">
                    <div style="display: flex; align-items: center;">
                        <span style="font-size: 2rem; font-weight: bold; color: white;">Londa</span>
                        <span style="font-size: 2rem; font-weight: bold; color: #db9123;">Loans</span>
                    </div>
                    <span style="font-size: 0.9rem; color: rgba(255,255,255,0.8);">empowering marketeers</span>
                </a>
            </div>

            <!-- Heading -->
            <h1 style="font-size: 2.5rem; font-weight: bold; line-height: 1.2; margin-bottom: 1rem;">
                {{ $heroData['heading'] ?? 'Get a Loan for Your Business Growth or Startup' }}
            </h1>

            <!-- Description -->
            <p style="font-size: 1rem; opacity: 0.9; line-height: 1.5; margin-bottom: 1.5rem; max-width: 500px;">
                {{ $heroData['description'] ?? 'Fast, flexible financing solutions designed specifically for marketers and entrepreneurs. Grow your business with our tailored loan programs.' }}
            </p>

            <!-- Call to Action -->
            <div style="display: flex; flex-wrap: wrap; gap: 1rem; align-items: center; margin-bottom: 2rem;">
                <a href="{{ $heroData['ctaButton']['url'] ?? '#!' }}"
                    style="display: inline-block; padding: 0.75rem 1.5rem; background-color: #db9123; border: 2px solid #db9123; color: white; text-decoration: none; border-radius: 4px; font-weight: bold; transition: background-color 0.3s, color 0.3s;"
                    aria-label="Start loan application">
                    {{ $heroData['ctaButton']['text'] ?? 'Get Started Now' }}
                </a>
                <div style="display: flex; flex-direction: column;">
                    <a href="tel:{{ $heroData['ctaPhone'] ?? '+123456789' }}"
                        style="font-size: 1rem; color: #db9123; text-decoration: none; font-weight: bold;"
                        aria-label="Call us at 0123 456 789">Call us {{ $heroData['ctaPhone'] ?? '+123456789' }}</a>
                    <span style="font-size: 0.9rem; opacity: 0.8;">
                        {{ $heroData['ctaPhoneSubtext'] ?? 'For any question or concern' }}</span>
                </div>
            </div>

            <!-- Trust Indicators -->
            <div style="display: flex; flex-wrap: wrap; gap: 2rem;">
                @foreach ($heroData['trustIndicators'] ?? [] as $indicator)
                    <div style="display: flex; flex-direction: column;" role="listitem">
                        <span style="font-size: 1.5rem; font-weight: bold;">{{ $indicator['value'] ?? '' }}</span>
                        <span style="font-size: 0.9rem; opacity: 0.8;">{{ $indicator['label'] ?? '' }}</span>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

    <style>
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

        a:hover {
            opacity: 0.9;
        }

        a[aria-label="Start loan application"]:hover {
            background-color: transparent;
            color: #db9123;
        }

        @media (max-width: 1024px) {
            section {
                padding: 2rem 0;
            }

            h1 {
                font-size: 2rem;
            }

            p {
                font-size: 0.9rem;
            }

            .shape {
                display: none !important;
            }

            div[style*="position: absolute; top: 0; right: 0"] {
                width: 40%;
                height: 80%;
            }
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 1.5rem;
            }

            div[style*="display: flex; flex-wrap: wrap; gap: 2rem"] {
                gap: 1rem;
                justify-content: center;
            }

            div[style*="position: absolute; top: 0; right: 0"] {
                width: 100%;
                height: 50%;
                opacity: 0.3;
            }
        }
    </style>
</section>
