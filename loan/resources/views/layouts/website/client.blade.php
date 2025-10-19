<section id="trusted-clients"
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
            {{ $sectionData['headline'] ?? 'Trusted by Marketing Professionals' }}
        </h2>
        <p style="font-size: 1rem; color: #666; line-height: 1.6; max-width: 600px; margin: 0 auto;">
            {{ $sectionData['subheadline'] ?? "We're proud to support marketing agencies, content creators, and entrepreneurs who are driving innovation and growth in their industries." }}
        </p>
    </div>

    <!-- Client Logos -->
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 1rem; margin-bottom: 3rem;">
        <div
            style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1.5rem; text-align: center;">
            @foreach ($sectionData['clients'] ?? [] as $index => $client)
                <a href="{{ $client['url'] ?? '#!' }}"
                    style="text-decoration: none; animation: fadeInUp 0.6s ease-in {{ $client['animation_delay'] ?? '0.1' }}s both;"
                    aria-label="Visit {{ $client['name'] }} website">
                    <div
                        style="background-color: white; border-radius: 8px; border: 1px solid #e5e7eb; padding: 1.5rem; transition: transform 0.3s, box-shadow 0.3s;">
                        <span
                            style="font-size: 1.25rem; font-weight: bold; color: #7a4603;">{{ $client['name'] }}</span>
                        @if (!empty($client['description']))
                            <p style="font-size: 0.9rem; color: #db9123; margin-top: 0.25rem;">
                                {{ $client['description'] }}</p>
                        @endif
                    </div>
                </a>
            @endforeach

            {{-- Fallback if no clients data --}}
            @if (empty($sectionData['clients']))
                <a href="#!" style="text-decoration: none; animation: fadeInUp 0.6s ease-in 0.1s both;"
                    aria-label="Visit SocialBoost website">
                    <div
                        style="background-color: white; border-radius: 8px; border: 1px solid #e5e7eb; padding: 1.5rem; transition: transform 0.3s, box-shadow 0.3s;">
                        <span style="font-size: 1.25rem; font-weight: bold; color: #7a4603;">SocialBoost</span>
                        <p style="font-size: 0.9rem; color: #db9123; margin-top: 0.25rem;">Marketing Agency</p>
                    </div>
                </a>
                <a href="#!" style="text-decoration: none; animation: fadeInUp 0.6s ease-in 0.2s both;"
                    aria-label="Visit ContentCraft website">
                    <div
                        style="background-color: white; border-radius: 8px; border: 1px solid #e5e7eb; padding: 1.5rem; transition: transform 0.3s, box-shadow 0.3s;">
                        <span style="font-size: 1.25rem; font-weight: bold; color: #7a4603;">ContentCraft</span>
                        <p style="font-size: 0.9rem; color: #db9123; margin-top: 0.25rem;">Content Creators</p>
                    </div>
                </a>
                <a href="#!" style="text-decoration: none; animation: fadeInUp 0.6s ease-in 0.3s both;"
                    aria-label="Visit GrowthGurus website">
                    <div
                        style="background-color: white; border-radius: 8px; border: 1px solid #e5e7eb; padding: 1.5rem; transition: transform 0.3s, box-shadow 0.3s;">
                        <span style="font-size: 1.25rem; font-weight: bold; color: #7a4603;">GrowthGurus</span>
                        <p style="font-size: 0.9rem; color: #db9123; margin-top: 0.25rem;">Digital Marketing</p>
                    </div>
                </a>
                <a href="#!" style="text-decoration: none; animation: fadeInUp 0.6s ease-in 0.4s both;"
                    aria-label="Visit BrandBuilders website">
                    <div
                        style="background-color: white; border-radius: 8px; border: 1px solid #e5e7eb; padding: 1.5rem; transition: transform 0.3s, box-shadow 0.3s;">
                        <span style="font-size: 1.25rem; font-weight: bold; color: #7a4603;">BrandBuilders</span>
                        <p style="font-size: 0.9rem; color: #db9123; margin-top: 0.25rem;">Brand Agency</p>
                    </div>
                </a>
                <a href="#!" style="text-decoration: none; animation: fadeInUp 0.6s ease-in 0.5s both;"
                    aria-label="Visit AdVenture website">
                    <div
                        style="background-color: white; border-radius: 8px; border: 1px solid #e5e7eb; padding: 1.5rem; transition: transform 0.3s, box-shadow 0.3s;">
                        <span style="font-size: 1.25rem; font-weight: bold; color: #7a4603;">AdVenture</span>
                        <p style="font-size: 0.9rem; color: #db9123; margin-top: 0.25rem;">Advertising</p>
                    </div>
                </a>
                <a href="#!" style="text-decoration: none; animation: fadeInUp 0.6s ease-in 0.6s both;"
                    aria-label="Visit MarketMasters website">
                    <div
                        style="background-color: white; border-radius: 8px; border: 1px solid #e5e7eb; padding: 1.5rem; transition: transform 0.3s, box-shadow 0.3s;">
                        <span style="font-size: 1.25rem; font-weight: bold; color: #7a4603;">MarketMasters</span>
                        <p style="font-size: 0.9rem; color: #db9123; margin-top: 0.25rem;">Consulting</p>
                    </div>
                </a>
            @endif
        </div>
    </div>

    <!-- Client Success Highlights -->
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 1rem;">
        <div
            style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem; margin-bottom: 3rem;">
            @foreach ($sectionData['highlights'] ?? [] as $index => $highlight)
                <div style="animation: fadeInUp 0.6s ease-in {{ $highlight['animation_delay'] ?? '0.7' }}s both;">
                    <div
                        style="background-color: white; border-radius: 12px; padding: 1.5rem; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                        <div style="display: flex; align-items: center; gap: 1rem;">
                            <div
                                style="background-color: {{ $highlight['color'] ?? '#db9123' }}; color: white; padding: 0.5rem 1rem; border-radius: 6px; font-weight: bold;">
                                {{ $highlight['amount'] }}</div>
                            <div>
                                <h4
                                    style="font-size: 1.25rem; font-weight: bold; color: #7a4603; margin-bottom: 0.25rem;">
                                    {{ $highlight['client'] }}</h4>
                                <p style="font-size: 0.9rem; color: #666;">{{ $highlight['result'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            {{-- Fallback if no highlights data --}}
            @if (empty($sectionData['highlights']))
                <div style="animation: fadeInUp 0.6s ease-in 0.7s both;">
                    <div
                        style="background-color: white; border-radius: 12px; padding: 1.5rem; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                        <div style="display: flex; align-items: center; gap: 1rem;">
                            <div
                                style="background-color: #db9123; color: white; padding: 0.5rem 1rem; border-radius: 6px; font-weight: bold;">
                                $25K</div>
                            <div>
                                <h4
                                    style="font-size: 1.25rem; font-weight: bold; color: #7a4603; margin-bottom: 0.25rem;">
                                    SocialBoost Agency</h4>
                                <p style="font-size: 0.9rem; color: #666;">Campaign funding led to 300% ROI</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="animation: fadeInUp 0.6s ease-in 0.8s both;">
                    <div
                        style="background-color: white; border-radius: 12px; padding: 1.5rem; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                        <div style="display: flex; align-items: center; gap: 1rem;">
                            <div
                                style="background-color: #7a4603; color: white; padding: 0.5rem 1rem; border-radius: 6px; font-weight: bold;">
                                $50K</div>
                            <div>
                                <h4
                                    style="font-size: 1.25rem; font-weight: bold; color: #7a4603; margin-bottom: 0.25rem;">
                                    ContentCraft Studios</h4>
                                <p style="font-size: 0.9rem; color: #666;">Expansion funding for new content division
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="animation: fadeInUp 0.6s ease-in 0.9s both;">
                    <div
                        style="background-color: white; border-radius: 12px; padding: 1.5rem; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                        <div style="display: flex; align-items: center; gap: 1rem;">
                            <div
                                style="background-color: #db9123; color: white; padding: 0.5rem 1rem; border-radius: 6px; font-weight: bold;">
                                $15K</div>
                            <div>
                                <h4
                                    style="font-size: 1.25rem; font-weight: bold; color: #7a4603; margin-bottom: 0.25rem;">
                                    GrowthGurus Inc</h4>
                                <p style="font-size: 0.9rem; color: #666;">Seed funding for marketing automation tool
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- CTA Section -->
    <div
        style="max-width: 1200px; margin: 0 auto; padding: 0 1rem; text-align: center; animation: fadeInUp 0.6s ease-in 1s both;">
        <h3 style="font-size: 1.75rem; font-weight: bold; color: #7a4603; margin-bottom: 0.5rem;">
            {{ $sectionData['cta']['headline'] ?? 'Ready to join our growing community?' }}
        </h3>
        <p
            style="font-size: 1rem; color: #666; margin-bottom: 1.5rem; max-width: 600px; margin-left: auto; margin-right: auto;">
            {{ $sectionData['cta']['subheadline'] ?? 'Get the funding you need to scale your marketing business' }}
        </p>
        <div style="display: flex; flex-wrap: wrap; gap: 1rem; justify-content: center;">
            <a href="#!"
                style="padding: 0.75rem 1.5rem; background-color: #db9123; border: 2px solid #db9123; color: white; text-decoration: none; border-radius: 4px; font-weight: bold; transition: all 0.3s;"
                aria-label="Start your application for funding">
                {{ $sectionData['cta']['primary_text'] ?? 'Start Your Application' }}
            </a>
            <a href="#!"
                style="padding: 0.75rem 1.5rem; border: 2px solid #7a4603; color: #7a4603; text-decoration: none; border-radius: 4px; font-weight: bold; transition: all 0.3s;"
                aria-label="View client success stories">
                {{ $sectionData['cta']['secondary_text'] ?? 'View Client Stories' }}
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

        a div:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
        }

        a[aria-label*="Start your application"]:hover {
            background-color: transparent;
            color: #db9123;
        }

        a[aria-label*="View client success stories"]:hover {
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

            div[style*="display: flex; flex-wrap: wrap"] {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</section>
