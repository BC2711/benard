    <section id="loan-plans"
    style="background: linear-gradient(135deg, #7a4603 0%, #db9123 100%); padding: 4rem 0; font-family: Arial, sans-serif; position: relative; overflow: hidden; color: white;">
    <!-- Background Shapes -->
    <img src="{{ asset('assets/images/shape-06.svg') }}" alt="Decorative shape pattern"
        style="position: absolute; top: 10%; left: 5%; max-width: 80px; animation: float 3s ease-in-out infinite;" />
    <img src="{{ asset('assets/images/shape-03.svg') }}" alt="Decorative shape accent"
        style="position: absolute; bottom: 10%; right: 5%; max-width: 70px; animation: float 4s ease-in-out infinite;" />
    <img src="{{ asset('assets/images/shape-07.svg') }}" alt="Decorative shape detail"
        style="position: absolute; top: 20%; right: 15%; max-width: 90px; animation: float 3.5s ease-in-out infinite;" />
    <img src="{{ asset('assets/images/shape-12.svg') }}" alt="Decorative shape background"
        style="position: absolute; bottom: 15%; left: 10%; max-width: 100px; animation: float 4.5s ease-in-out infinite;" />
    <img src="{{ asset('assets/images/shape-13.svg') }}" alt="Decorative shape element"
        style="position: absolute; top: 15%; right: 10%; max-width: 85px; animation: float 3.2s ease-in-out infinite;" />

    <!-- Section Title -->
    <div style="text-align: center; margin-bottom: 3rem; animation: fadeIn 0.6s ease-in;">
        <h2 style="font-size: 2.25rem; font-weight: bold; line-height: 1.3; margin-bottom: 0.75rem;">
            Flexible Loan Plans for Every Marketeer
        </h2>
        <p style="font-size: 1rem; line-height: 1.6; max-width: 600px; margin: 0 auto; opacity: 0.9;">
            Choose from our range of loan options designed specifically for marketing professionals and businesses. Get
            the funding you need with terms that work for you.
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
                    style="font-size: 0.9rem; font-weight: bold; color: white; background-color: #7a4603; padding: 0.5rem 1rem; border-radius: 20px;">Custom
                    Solution</span>
            </div>
            <h4 style="font-size: 1.5rem; font-weight: bold; color: #7a4603; margin-bottom: 0.5rem;">Custom Loan Package
            </h4>
            <p
                style="font-size: 0.95rem; color: #666; line-height: 1.5; margin-bottom: 1rem; max-width: 500px; margin-left: auto; margin-right: auto;">
                Need a different amount or term? We'll create a custom solution for your specific marketing needs.
            </p>
            <div style="margin-bottom: 1rem;">
                <h2 style="font-size: 2rem; font-weight: bold; color: #db9123;">Flexible</h2>
                <span style="font-size: 0.9rem; color: #666;">Tailored to your business</span>
            </div>
            <p style="font-size: 0.95rem; color: #7a4603; margin-bottom: 1.5rem;">Personalized terms and rates</p>
            <a href="#!"
                style="display: inline-block; padding: 0.75rem 1.5rem; background-color: #db9123; color: white; text-decoration: none; border-radius: 4px; font-weight: bold; transition: all 0.3s;"
                aria-label="Get a custom loan quote">Get Custom Quote</a>
            <ul
                style="list-style: none; padding: 0; margin: 1.5rem 0 0; display: flex; flex-direction: column; gap: 0.75rem;">
                <li style="display: flex; align-items: center; gap: 0.5rem; color: #666;">
                    <svg style="width: 20px; height: 20px; color: #db9123;" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Amounts from $5,000 to $500,000
                </li>
                <li style="display: flex; align-items: center; gap: 0.5rem; color: #666;">
                    <svg style="width: 20px; height: 20px; color: #db9123;" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586 7.293-7.293a1 1 0 011.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Terms from 3 to 60 months
                </li>
                <li style="display: flex; align-items: center; gap: 0.5rem; color: #666;">
                    <svg style="width: 20px; height: 20px; color: #db9123;" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Competitive interest rates
                </li>
                <li style="display: flex; align-items: center; gap: 0.5rem; color: #666;">
                    <svg style="width: 20px; height: 20px; color: #db9123;" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Dedicated account manager
                </li>
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
        const plans = [{
                name: 'Starter Campaign',
                description: 'Perfect for small marketing initiatives',
                featured: false,
                amount: {
                    short: '5,000',
                    long: '15,000'
                },
                features: [
                    'Ideal for social media campaigns',
                    'Quick 24-hour approval',
                    'No collateral required',
                    'Flexible repayment options',
                    'Perfect for testing new markets'
                ]
            },
            {
                name: 'Growth Accelerator',
                description: 'Our most popular option for scaling businesses',
                featured: true,
                amount: {
                    short: '25,000',
                    long: '75,000'
                },
                features: [
                    'Comprehensive marketing campaigns',
                    '48-hour approval process',
                    'Competitive interest rates',
                    'Digital ad budget coverage',
                    'Content marketing support',
                    'Analytics and reporting tools'
                ]
            },
            {
                name: 'Enterprise Scale',
                description: 'For large-scale marketing operations',
                featured: false,
                amount: {
                    short: '100,000',
                    long: '250,000'
                },
                features: [
                    'Major campaign launches',
                    'Multi-channel marketing',
                    'Priority processing',
                    'Dedicated account manager',
                    'Custom reporting dashboard',
                    'Strategic planning support',
                    'Industry expert consultation'
                ]
            }
        ];

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
                            $${loanType === 'short' ? plan.amount.short : plan.amount.long}
                        </h2>
                        <span style="font-size: 0.9rem; color: #666;">${loanType === 'short' ? 'for 6 months' : 'for 24 months'}</span>
                    </div>
                    <p style="font-size: 0.95rem; color: #7a4603; margin-bottom: 1.5rem;">Quick approval process</p>
                    <a href="#!" style="display: inline-block; padding: 0.75rem 1.5rem; background-color: ${plan.featured ? '#db9123' : '#7a4603'}; color: white; text-decoration: none; border-radius: 4px; font-weight: bold; transition: all 0.3s;" aria-label="Apply for ${plan.name} loan">Apply Now</a>
                    <ul style="list-style: none; padding: 0; margin: 1.5rem 0 0; display: flex; flex-direction: column; gap: 0.75rem;">
                        ${plan.features.map(feature => `
                                <li style="display: flex; align-items: center; gap: 0.5rem; color: #666;">
                                    <svg style="width: 20px; height: 20px; color: #db9123;" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    ${feature}
                                </li>
                            `).join('')}
                    </ul>
                    <p style="font-size: 0.95rem; color: #7a4603; margin-top: 1rem;">24-48 hour approval</p>
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
