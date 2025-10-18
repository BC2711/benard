<section id="impact-numbers"
    style="background: linear-gradient(135deg, #7a4603 0%, #db9123 100%); padding: 4rem 0; font-family: Arial, sans-serif; position: relative; overflow: hidden;">
    <!-- Background Shapes -->
    <span
        style="position: absolute; top: 10%; left: 5%; width: 150px; height: 150px; background-color: white; opacity: 0.1; border-radius: 50%; animation: float 3s ease-in-out infinite;"></span>
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
        <h2 style="font-size: 2.25rem; font-weight: bold; color: white; line-height: 1.3; margin-bottom: 0.75rem;">
            Our Impact in Numbers
        </h2>
        <p style="font-size: 1rem; color: white; line-height: 1.6; max-width: 600px; margin: 0 auto; opacity: 0.9;">
            Real results for marketing professionals and entrepreneurs
        </p>
    </div>

    <!-- Main Stats -->
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 1rem;">
        <div
            style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; text-align: center; margin-bottom: 3rem;">
            <div style="animation: fadeInUp 0.6s ease-in 0.1s both;">
                <h3 style="font-size: 2.5rem; font-weight: bold; color: white; margin-bottom: 0.5rem;">500+</h3>
                <p style="font-size: 0.95rem; color: white; opacity: 0.9;">Marketing Campaigns Funded</p>
            </div>
            <div style="animation: fadeInUp 0.6s ease-in 0.2s both;">
                <h3 style="font-size: 2.5rem; font-weight: bold; color: white; margin-bottom: 0.5rem;">$10M+</h3>
                <p style="font-size: 0.95rem; color: white; opacity: 0.9;">Loans Disbursed</p>
            </div>
            <div style="animation: fadeInUp 0.6s ease-in 0.3s both;">
                <h3 style="font-size: 2.5rem; font-weight: bold; color: white; margin-bottom: 0.5rem;">98%</h3>
                <p style="font-size: 0.95rem; color: white; opacity: 0.9;">Client Satisfaction Rate</p>
            </div>
            <div style="animation: fadeInUp 0.6s ease-in 0.4s both;">
                <h3 style="font-size: 2.5rem; font-weight: bold; color: white; margin-bottom: 0.5rem;">24h</h3>
                <p style="font-size: 0.95rem; color: white; opacity: 0.9;">Average Approval Time</p>
            </div>
        </div>
    </div>

    <!-- Mini Stats -->
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 1rem;">
        <div
            style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1rem; text-align: center; margin-bottom: 3rem;">
            <div style="animation: fadeInUp 0.6s ease-in 0.5s both;">
                <span style="font-size: 1.5rem; font-weight: bold; color: white;">300%</span>
                <p style="font-size: 0.9rem; color: white; opacity: 0.8;">Average ROI for Funded Campaigns</p>
            </div>
            <div style="animation: fadeInUp 0.6s ease-in 0.6s both;">
                <span style="font-size: 1.5rem; font-weight: bold; color: white;">15min</span>
                <p style="font-size: 0.9rem; color: white; opacity: 0.8;">Online Application Process</p>
            </div>
            <div style="animation: fadeInUp 0.6s ease-in 0.7s both;">
                <span style="font-size: 1.5rem; font-weight: bold; color: white;">0-3%</span>
                <p style="font-size: 0.9rem; color: white; opacity: 0.8;">Competitive Interest Rates</p>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div
        style="max-width: 1200px; margin: 0 auto; padding: 0 1rem; text-align: center; animation: fadeInUp 0.6s ease-in 0.8s both;">
        <h3 style="font-size: 1.75rem; font-weight: bold; color: white; margin-bottom: 0.5rem;">Ready to join our
            success stories?</h3>
        <p
            style="font-size: 1rem; color: white; margin-bottom: 1.5rem; max-width: 600px; margin-left: auto; margin-right: auto; opacity: 0.9;">
            Start your application and become our next success story
        </p>
        <div style="display: flex; flex-wrap: wrap; gap: 1rem; justify-content: center;">
            <a href="#!"
                style="padding: 0.75rem 1.5rem; background-color: white; border: 2px solid white; color: #db9123; text-decoration: none; border-radius: 4px; font-weight: bold; transition: all 0.3s;"
                aria-label="Apply now for funding">Apply Now</a>
            <a href="#!"
                style="padding: 0.75rem 1.5rem; border: 2px solid white; color: white; text-decoration: none; border-radius: 4px; font-weight: bold; transition: all 0.3s;"
                aria-label="Calculate your loan amount">Calculate Loan</a>
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

        a:hover {
            transform: translateY(-2px);
        }

        a[aria-label*="Apply now"]:hover {
            background-color: transparent;
            color: white;
        }

        a[aria-label*="Calculate your loan"]:hover {
            background-color: white;
            color: #db9123;
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

            p {
                font-size: 0.9rem;
            }

            img[alt*="Decorative shape"],
            span[style*="background-color: white"] {
                display: none;
            }

            div[style*="display: flex; flex-wrap: wrap"] {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</section>
