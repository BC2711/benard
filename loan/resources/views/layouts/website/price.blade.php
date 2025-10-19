<section id="loan-plans"
    style="background: linear-gradient(135deg, #7a4603 0%, #db9123 100%); padding: 4rem 0; font-family: Arial, sans-serif; position: relative; overflow: hidden; color: white;">
    <!-- Background Shapes -->
    @foreach ($sectionData['shapes'] as $shape)
        <img src="{{ asset($shape['src']) }}" alt="{{ $shape['alt'] }}"
            style="position: absolute; {{ $shape['position'] }} max-width: 80px; animation: float {{ $shape['animationDuration'] }} ease-in-out infinite;" />
    @endforeach

    <!-- Section Title -->
    <div style="text-align: center; margin-bottom: 3rem; animation: fadeIn 0.6s ease-in;">
        <h2 style="font-size: 2.25rem; font-weight: bold; line-height: 1.3; margin-bottom: 0.75rem;">
            {{ $sectionData['sectionHeading'] ?? 'Flexible Loan Plans for Every Marketeer' }}
        </h2>
        <p style="font-size: 1rem; line-height: 1.6; max-width: 600px; margin: 0 auto; opacity: 0.9;">
            {{ $sectionData['sectionDescription'] ??
                'Choose from our range of loan options designed specifically for marketing professionals and businesses. Get
                                        the funding you need with terms that work for you.' }}
        </p>
    </div>

    <!-- Loan Type Switcher -->
    <div style="display: flex; justify-content: center; align-items: center; gap: 1rem; margin-bottom: 2rem;">
        <span style="font-size: 1rem; font-weight: bold;">Short Term Loans</span>
        <button id="loan-type-switcher"
            style="width: 48px; height: 24px; background-color: #7a4603; border-radius: 12px; position: relative; cursor: pointer; border: none; outline: none;"
            aria-label="Toggle between short and long term loans">
            <span id="switcher-knob"
                style="width: 20px; height: 20px; background-color: white; border-radius: 50%; position: absolute; top: 2px; left: 2px; transition: transform 0.3s ease-in-out;"></span>
        </button>
        <span style="font-size: 1rem; font-weight: bold;">Long Term Loans</span>
    </div>

    <!-- Pricing Table -->
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 1rem;">
        <div id="pricing-table"
            style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem; margin-bottom: 3rem;">
            <!-- Pricing items will be dynamically inserted here -->
        </div>
    </div>

    <!-- Custom Loan Option -->
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 1rem;">
        <div
            style="background-color: white; border-radius: 12px; border: 2px solid #db9123; padding: 2rem; text-align: center; animation: fadeInUp 0.6s ease-in 0.7s both;">
            <div style="margin-bottom: 1rem;">
                <span
                    style="font-size: 0.9rem; font-weight: bold; color: white; background-color: #7a4603; padding: 0.5rem 1rem; border-radius: 20px;">
                    {{ $sectionData['customLoan']['label'] ?? 'Custom Solution' }}
                </span>
            </div>
            <h4 style="font-size: 1.5rem; font-weight: bold; color: #7a4603; margin-bottom: 0.5rem;">
                {{ $sectionData['customLoan']['title'] ?? 'Custom Loan Package' }}
            </h4>
            <p
                style="font-size: 0.95rem; color: #666; line-height: 1.5; margin-bottom: 1rem; max-width: 500px; margin-left: auto; margin-right: auto;">
                {{ $sectionData['customLoan']['description'] ?? "Need a different amount or term? We'll create a custom solution for your specific marketing needs." }}
            </p>
            <div style="margin-bottom: 1rem;">
                <h2 style="font-size: 2rem; font-weight: bold; color: #db9123;">
                    {{ $sectionData['customLoan']['amount'] ?? 'Flexible' }}
                </h2>
                <span style="font-size: 0.9rem; color: #666;">
                    {{ $sectionData['customLoan']['term'] ?? 'Tailored to your business' }}
                </span>
            </div>
            <p style="font-size: 0.95rem; color: #7a4603; margin-bottom: 1.5rem;">
                {{ $sectionData['customLoan']['note'] ?? 'Personalized terms and rates' }}
            </p>
            <a href="{{ $sectionData['customLoan']['buttonUrl'] ?? '#!' }}"
                style="display: inline-block; padding: 0.75rem 1.5rem; background-color: #db9123; color: white; text-decoration: none; border-radius: 4px; font-weight: bold; transition: all 0.3s;"
                aria-label="{{ $sectionData['customLoan']['buttonAriaLabel'] ?? 'Get a custom loan quote' }}">
                {{ $sectionData['customLoan']['buttonText'] ?? 'Get Custom Quote' }}
            </a>
            <ul
                style="list-style: none; padding: 0; margin: 1.5rem 0 0; display: flex; flex-direction: column; gap: 0.75rem;">
                @foreach ($sectionData['customLoan']['features'] as $feature)
                    <li style="display: flex; align-items: center; gap: 0.5rem; color: #666;">
                        <svg style="width: 20px; height: 20px; color: #db9123;" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        {{ $feature['text'] }}
                    </li>
                @endforeach
            </ul>
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

        #loan-type-switcher.active span#switcher-knob {
            transform: translateX(24px);
        }

        a:hover {
            transform: translateY(-2px);
        }

        a[aria-label*="Apply Now"]:hover {
            background-color: transparent;
            color: #db9123;
            border-color: #db9123;
        }

        .pricing-card.featured {
            transform: scale(1.05);
            border: 2px solid #db9123;
        }

        @media (max-width: 1024px) {
            section {
                padding: 2rem 0;
            }

            img[alt*="Decorative shape"] {
                max-width: 60px;
            }

            div[style*="grid-template-columns"] {
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            }
        }

        @media (max-width: 768px) {
            h2 {
                font-size: 1.75rem;
            }

            h4 {
                font-size: 1.25rem;
            }

            p {
                font-size: 0.9rem;
            }

            img[alt*="Decorative shape"] {
                display: none;
            }

            .pricing-card.featured {
                transform: scale(1);
            }
        }
    </style>

    <script>
        // Loan Plans Data
        const plans = @json($sectionData['plans']);

        // Render Pricing Table
        function renderPricingTable(loanType = 'short') {
            const table = document.getElementById('pricing-table');
            table.innerHTML = plans.map((plan, index) => `
                <div class="pricing-card" style="background-color: white; border-radius: 12px; padding: 2rem; text-align: center; animation: fadeInUp 0.6s ease-in ${0.2 * (index + 1)}s both; ${plan.featured ? 'transform: scale(1.05); border: 2px solid #db9123;' : ''}">
                    ${plan.featured ? '<div style="margin-bottom: 1rem;"><span style="font-size: 0.9rem; font-weight: bold; color: white; background-color: #db9123; padding: 0.5rem 1rem; border-radius: 20px;">Most Popular</span></div>' : ''}
                    <h4 style="font-size: 1.5rem; font-weight: bold; color: #7a4603; margin-bottom: 0.5rem;">${plan.name}</h4>
                    <p style="font-size: 0.95rem; color: #666; line-height: 1.5; margin-bottom: 1rem;">${plan.description}</p>
                    <div style="margin-bottom: 1rem;">
                        <h2 style="font-size: 2rem; font-weight: bold; color: ${plan.featured ? '#db9123' : '#db9123'};">
                            ${loanType === 'short' ? plan.amount.short : plan.amount.long}
                        </h2>
                        <span style="font-size: 0.9rem; color: #666;">${loanType === 'short' ? plan.term.short : plan.term.long}</span>
                    </div>
                    <p style="font-size: 0.95rem; color: #7a4603; margin-bottom: 1.5rem;">${plan.note}</p>
                    <a href="${plan.buttonUrl}" style="display: inline-block; padding: 0.75rem 1.5rem; background-color: ${plan.featured ? '#db9123' : '#7a4603'}; color: white; text-decoration: none; border-radius: 4px; font-weight: bold; transition: all 0.3s;" aria-label="${plan.buttonAriaLabel}">${plan.buttonText}</a>
                    <ul style="list-style: none; padding: 0; margin: 1.5rem 0 0; display: flex; flex-direction: column; gap: 0.75rem;">
                        ${plan.features.map(feature => `
                                            <li style="display: flex; align-items: center; gap: 0.5rem; color: #666;">
                                                <svg style="width: 20px; height: 20px; color: #db9123;" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                </svg>
                                                ${feature.text}
                                            </li>
                                        `).join('')}
                    </ul>
                </div>
            `).join('');
        }

        // Initialize and Toggle Loan Type
        document.addEventListener('DOMContentLoaded', () => {
            let loanType = 'short';
            renderPricingTable(loanType);
            const switcher = document.getElementById('loan-type-switcher');
            switcher.addEventListener('click', () => {
                loanType = loanType === 'short' ? 'long' : 'short';
                switcher.classList.toggle('active');
                renderPricingTable(loanType);
            });
        });
    </script>
</section>
