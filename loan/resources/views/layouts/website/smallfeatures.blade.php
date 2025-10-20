<section id="features" style="background-color: #f8f5f0; padding: 4rem 0; font-family: Arial, sans-serif;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 1rem;">
        <!-- Section Title -->
        <div style="text-align: center; margin-bottom: 3rem; animation: fadeIn 0.5s ease-in;">
            <h2 style="font-size: 2.5rem; font-weight: bold; color: #7a4603; margin-bottom: 1rem; line-height: 1.2;">
                {{ $sectionData['section_heading'] ?? 'Why Marketeers Choose Londa Loans' }}
            </h2>
            <p style="font-size: 1rem; color: #666; max-width: 600px; margin: 0 auto; line-height: 1.5;">
                {{ $sectionData['section_description'] ?? 'We understand the unique financial needs of marketing professionals and have built our services around your success.' }}
            </p>
        </div>

        <!-- Features Grid -->
        <div class="features-grid" id="featuresGrid">
            @foreach ($sectionData['feature_cards'] ?? [] as $card)
                <div class="feature-card">
                    <div class="feature-icon-container {{ $card['bg_color'] === 'secondary' ? 'secondary' : '' }}">
                        <img src="{{ asset($card['icon'] ?? 'assets/images/icon-01.svg') }}"
                            alt="{{ $card['title'] }} Icon" class="feature-icon" />
                    </div>
                    <h4 class="feature-heading">{{ $card['title'] }}</h4>
                    <p class="feature-description" style="color: #110101;">{{ $card['description'] }}</p>
                </div>
            @endforeach

            @if (empty($sectionData['feature_cards']))
                <!-- Feature 1 -->
                <div
                    style="text-align: center; animation: fadeInUp 0.6s ease-in; background: white; padding: 1.5rem; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                    <div
                        style="width: 60px; height: 60px; background-color: #db9123; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                        <img src="{{ asset('assets/images/icon-01.svg') }}" alt="Fast Approval Icon"
                            style="width: 32px; height: 32px;" />
                    </div>
                    <h4 style="font-size: 1.25rem; font-weight: bold; color: #7a4603; margin-bottom: 0.5rem;">
                        Fast Approval
                    </h4>
                    <p style="color: #666; line-height: 1.5; font-size: 0.95rem;">
                        Get loan decisions within 24 hours, so you can seize marketing opportunities when they arise.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div
                    style="text-align: center; animation: fadeInUp 0.6s ease-in 0.1s both; background: white; padding: 1.5rem; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                    <div
                        style="width: 60px; height: 60px; background-color: #7a4603; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                        <img src="{{ asset('assets/images/icon-02.svg') }}" alt="Marketing Expertise Icon"
                            style="width: 32px; height: 32px;" />
                    </div>
                    <h4 style="font-size: 1.25rem; font-weight: bold; color: #7a4603; margin-bottom: 0.5rem;">
                        Marketing Expertise
                    </h4>
                    <p style="color: #666; line-height: 1.5; font-size: 0.95rem;">
                        Our team understands marketing needs and tailors loans specifically for campaign funding and
                        growth.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div
                    style="text-align: center; animation: fadeInUp 0.6s ease-in 0.2s both; background: white; padding: 1.5rem; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                    <div
                        style="width: 60px; height: 60px; background-color: #db9123; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                        <img src="{{ asset('assets/images/icon-03.svg') }}" alt="Flexible Terms Icon"
                            style="width: 32px; height: 32px;" />
                    </div>
                    <h4 style="font-size: 1.25rem; font-weight: bold; color: #7a4603; margin-bottom: 0.5rem;">
                        Flexible Terms
                    </h4>
                    <p style="color: #666; line-height: 1.5; font-size: 0.95rem;">
                        Repayment plans designed around your campaign ROI cycles and revenue patterns.
                    </p>
                </div>

                <!-- Feature 4 -->
                <div
                    style="text-align: center; animation: fadeInUp 0.6s ease-in 0.3s both; background: white; padding: 1.5rem; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                    <div
                        style="width: 60px; height: 60px; background-color: #7a4603; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                        <img src="{{ asset('assets/images/icon-04.svg') }}" alt="Transparent Pricing Icon"
                            style="width: 32px; height: 32px;" />
                    </div>
                    <h4 style="font-size: 1.25rem; font-weight: bold; color: #7a4603; margin-bottom: 0.5rem;">
                        Transparent Pricing
                    </h4>
                    <p style="color: #666; line-height: 1.5; font-size: 0.95rem;">
                        No hidden fees or surprise charges. Know exactly what you're paying from day one.
                    </p>
                </div>

                <!-- Feature 5 -->
                <div
                    style="text-align: center; animation: fadeInUp 0.6s ease-in 0.4s both; background: white; padding: 1.5rem; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                    <div
                        style="width: 60px; height: 60px; background-color: #db9123; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                        <img src="{{ asset('assets/images/icon-05.svg') }}" alt="Dedicated Support Icon"
                            style="width: 32px; height: 32px;" />
                    </div>
                    <h4 style="font-size: 1.25rem; font-weight: bold; color: #7a4603; margin-bottom: 0.5rem;">
                        Dedicated Support
                    </h4>
                    <p style="color: #666; line-height: 1.5; font-size: 0.95rem;">
                        Get personalized assistance from loan specialists who understand marketing businesses.
                    </p>
                </div>

                <!-- Feature 6 -->
                <div
                    style="text-align: center; animation: fadeInUp 0.6s ease-in 0.5s both; background: white; padding: 1.5rem; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                    <div
                        style="width: 60px; height: 60px; background-color: #7a4603; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                        <img src="{{ asset('assets/images/icon-06.svg') }}" alt="Scalable Funding Icon"
                            style="width: 32px; height: 32px;" />
                    </div>
                    <h4 style="font-size: 1.25rem; font-weight: bold; color: #7a4603; margin-bottom: 0.5rem;">
                        Scalable Funding
                    </h4>
                    <p style="color: #666; line-height: 1.5; font-size: 0.95rem;">
                        Start small and access larger amounts as your marketing success and business grow.
                    </p>
                </div>
            @endif
        </div>

        <!-- Trust Indicators & CTA -->
        <div
            style="text-align: center; background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
            <!-- Trust Indicators -->
            <div style="display: flex; justify-content: space-around; flex-wrap: wrap; gap: 2rem; margin-bottom: 2rem;">
                @foreach ($sectionData['trust_indicators'] ?? [] as $indicator)
                    <div class="trust-indicator" role="listitem">
                        <span class="trust-value">{{ $indicator['value'] }}</span>
                        <span class="trust-label">{{ $indicator['label'] }}</span>
                    </div>
                @endforeach
                @if (empty($sectionData['trust_indicators']))
                    <div style="flex: 1; min-width: 150px;">
                        <span style="font-size: 2rem; font-weight: bold; color: #db9123;">500+</span>
                        <span style="font-size: 0.9rem; color: #666;">Marketing Campaigns Funded</span>
                    </div>
                    <div style="flex: 1; min-width: 150px;">
                        <span style="font-size: 2rem; font-weight: bold; color: #db9123;">98%</span>
                        <span style="font-size: 0.9rem; color: #666;">Approval Rate</span>
                    </div>
                    <div style="flex: 1; min-width: 150px;">
                        <span style="font-size: 2rem; font-weight: bold; color: #db9123;">24h</span>
                        <span style="font-size: 0.9rem; color: #666;">Average Processing Time</span>
                    </div>
                    <div style="flex: 1; min-width: 150px;">
                        <span style="font-size: 2rem; font-weight: bold; color: #db9123;">$10M+</span>
                        <span style="font-size: 0.9rem; color: #666;">Loans Disbursed</span>
                    </div>
                @endif
            </div>

            <!-- CTA -->
            <div style="animation: fadeInUp 0.6s ease-in 0.6s both;">
                <h3 style="font-size: 1.75rem; font-weight: bold; color: #7a4603; margin-bottom: 0.5rem;">
                    {{ $sectionData['cta_heading'] ?? 'Ready to fund your next marketing success?' }}
                </h3>
                <p style="font-size: 1rem; color: #666; margin-bottom: 1.5rem;">
                    {{ $sectionData['cta_description'] ?? 'Join hundreds of marketeers who have scaled their businesses with Londa Loans' }}
                </p>
                <div style="display: flex; flex-wrap: wrap; gap: 1rem; justify-content: center;">

                    @foreach ($sectionData['cta_buttons'] ?? [] as $button)
                        <a href="{{ $button['url'] ?? '#!' }}"
                            style="display: inline-block; padding: 0.75rem 1.5rem; background-color: #db9123; border: 2px solid #db9123; color: white; text-decoration: none; border-radius: 4px; font-weight: bold; transition: all 0.3s;"
                            aria-label="{{ $button['aria_label'] ?? 'CTA button' }}">
                            {{ $button['text'] }}
                        </a>
                    @endforeach
                    @if (empty($sectionData['cta_buttons']))
                        <a href="#!"
                            style="display: inline-block; padding: 0.75rem 1.5rem; background-color: #db9123; border: 2px solid #db9123; color: white; text-decoration: none; border-radius: 4px; font-weight: bold; transition: all 0.3s;"
                            aria-label="CTA button">
                            Apply for Loan
                        </a>
                        <a href="#!"
                            style="display: inline-block; padding: 0.75rem 1.5rem; border: 2px solid #7a4603; color: #7a4603; text-decoration: none; border-radius: 4px; font-weight: bold; transition: all 0.3s;"
                            aria-label="Calculate loan payments">
                            Calculate Payments
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <style>
        .feature-heading {
            font-size: 1.25rem;
            font-weight: bold;
            color: #7a4603;
            margin-bottom: 0.5rem;
        }

        .feature-description {
            color: #666;
            line-height: 1.5;
            font-size: 0.95rem;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .feature-card {
            text-align: center;
            animation: fadeInUp 0.6s ease-in;
            background: white;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .feature-icon-container {
            width: 60px;
            height: 60px;
            background-color: #db9123;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
        }

        .feature-icon {
            width: 32px;
            height: 32px;
        }

        .trust-indicator {
            flex: 1;
            min-width: 150px
        }

        .trust-value {
            font-size: 2rem;
            font-weight: bold;
            color: #db9123;
        }

        .trust-label {
            font-size: 0.9rem;
            color: #666;
        }

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

        a:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        a[aria-label="Apply for a loan"]:hover {
            background-color: transparent;
            color: #db9123;
        }

        a[aria-label="Calculate loan payments"]:hover {
            background-color: #7a4603;
            color: white;
        }

        @media (max-width: 768px) {
            section {
                padding: 2rem 0;
            }

            h2 {
                font-size: 2rem;
            }

            h3 {
                font-size: 1.5rem;
            }

            div[style*="grid-template-columns"] {
                grid-template-columns: 1fr;
            }

            div[style*="display: flex; justify-content: space-around"] {
                flex-direction: column;
                gap: 1rem;
            }
        }
    </style>
</section>
