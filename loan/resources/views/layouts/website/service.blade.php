<section id="services" style="background-color: #f8f5f0; padding: 4rem 0; font-family: Arial, sans-serif;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 1rem;">
        <!-- Section Title -->
        <div style="text-align: center; margin-bottom: 3rem; animation: fadeIn 0.6s ease-in;">
            <h2 style="font-size: 2.25rem; font-weight: bold; color: #7a4603; line-height: 1.3; margin-bottom: 0.75rem;">
                {{ $sectionData['sectionHeading'] ?? 'Loan Solutions for Marketeers' }}
            </h2>
            <p style="font-size: 1rem; color: #5a5a5a; line-height: 1.6; max-width: 600px; margin: 0 auto;">
                {{ $sectionData['sectionDescription'] ?? 'We provide specialized financial solutions designed specifically for marketers and entrepreneurs to fuel your growth and marketing initiatives.' }}
            </p>
        </div>

        <!-- Services Grid -->
        <div
            style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem; margin-bottom: 3rem;">
            @foreach ($sectionData['services'] as $service)
                <div
                    style="background-color: white; border-top: 4px solid {{ $service['borderColor'] == 'primary' ? '#db9123' : '#7a4603' }}; border-radius: 8px; padding: 1.5rem; box-shadow: 0 4px 12px rgba(0,0,0,0.1); text-align: center; animation: fadeInUp 0.6s ease-in {{ $service['animationDelay'] }} both;">
                    <div
                        style="width: 60px; height: 60px; background-color: {{ $service['borderColor'] == 'primary' ? '#db9123' : '#7a4603' }}; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                        <img src="{{ asset($service['icon']) }}" alt="{{ $service['iconAlt'] }}"
                            style="width: 32px; height: 32px; filter: brightness(0) invert(1);" />
                    </div>
                    <h4 style="font-size: 1.25rem; font-weight: bold; color: #7a4603; margin-bottom: 0.5rem;">
                        {{ $service['title'] }}
                    </h4>
                    <p style="font-size: 0.95rem; color: #666; line-height: 1.5; margin-bottom: 1rem;">
                        {{ $service['description'] }}
                    </p>
                    <a href="{{ $service['linkUrl'] }}"
                        style="font-size: 0.9rem; color: #db9123; text-decoration: none; font-weight: bold; transition: color 0.3s;"
                        aria-label="{{ $service['linkAriaLabel'] }}">
                        Learn More →
                    </a>
                </div>
            @endforeach
        </div>

        <!-- CTA Section -->
        <div style="text-align: center; animation: fadeIn 0.6s ease-in 0.7s both;">
            <h3 style="font-size: 1.75rem; font-weight: bold; color: #7a4603; margin-bottom: 0.5rem;">
                {{ $sectionData['cta']['heading'] ?? 'Ready to grow your marketing business?' }}
            </h3>
            <p
                style="font-size: 1rem; color: #666; margin-bottom: 1.5rem; max-width: 600px; margin-left: auto; margin-right: auto;">
                {{ $sectionData['cta']['description'] ?? 'Get the financial support you need to scale your marketing efforts' }}
            </p>
            <div style="display: flex; flex-wrap: wrap; gap: 1rem; justify-content: center;">
                @foreach ($sectionData['cta']['buttons'] as $button)
                    <a href="{{ $button['url'] }}"
                        style="padding: 0.75rem 1.5rem; {{ $button['style'] == 'primary' ? 'background-color: #db9123; border: 2px solid #db9123; color: white;' : 'border: 2px solid #7a4603; color: #7a4603;' }} text-decoration: none; border-radius: 4px; font-weight: bold; transition: all 0.3s;"
                        aria-label="{{ $button['ariaLabel'] }}">
                        {{ $button['text'] }}
                    </a>
                @endforeach
            </div>
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

        a:hover {
            transform: translateY(-2px);
        }

        a[style*="color: #db9123"]:hover {
            color: #b3741c;
        }

        a[style*="background-color: #db9123"]:hover {
            background-color: transparent;
            color: #db9123;
        }

        a[style*="border: 2px solid #7a4603"]:hover {
            background-color: #7a4603;
            color: white;
        }

        @media (max-width: 1024px) {
            section {
                padding: 2rem 0;
            }

            div[style*="grid-template-columns"] {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
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

            div[style*="grid-template-columns"] {
                grid-template-columns: 1fr;
            }

            div[style*="display: flex; flex-wrap: wrap"] {
                flex-direction: column;
                align-items: center;
                gap: 0.75rem;
            }
        }
    </style>
</section>
