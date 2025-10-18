<section id="about" style="background-color: #f8f5f0; padding: 4rem 0; font-family: Arial, sans-serif;">
    <div
        style="max-width: 1200px; margin: 0 auto; padding: 0 1rem; display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
        <!-- About Images -->
        <div style="position: relative; animation: fadeInLeft 0.6s ease-in;">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; align-items: start;">
                <div style="position: relative;">
                    <img src="{{ asset('assets/images/shape-05.svg') }}" alt="Decorative shape pattern"
                        style="position: absolute; top: -10px; left: -15px; max-width: 80px; z-index: 0; animation: float 3s ease-in-out infinite;" />
                    <img src="{{ asset('assets/images/about-01.png') }}" alt="Team collaborating on a marketing campaign"
                        style="width: 100%; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); z-index: 1;" />
                </div>
                <div style="position: relative;">
                    <img src="{{ asset('assets/images/about-02.png') }}" alt="Entrepreneur analyzing financial growth"
                        style="width: 100%; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); z-index: 1;" />
                </div>
                <div style="position: relative; grid-column: span 2;">
                    <img src="{{ asset('assets/images/shape-06.svg') }}" alt="Decorative shape accent"
                        style="position: absolute; top: 10px; right: -10px; max-width: 70px; z-index: 0; animation: float 4s ease-in-out infinite;" />
                    <img src="{{ asset('assets/images/about-03.png') }}" alt="Marketer presenting a growth strategy"
                        style="width: 60%; margin: 0 auto; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); z-index: 1;" />
                    <img src="{{ asset('assets/images/shape-07.svg') }}" alt="Decorative shape detail"
                        style="position: absolute; bottom: -10px; left: 0; max-width: 80px; z-index: 0; animation: float 3.5s ease-in-out infinite;" />
                </div>
            </div>
        </div>

        <!-- About Content -->
        <div
            style="animation: fadeInRight 0.6s ease-in; display: flex; flex-direction: column; justify-content: center;">
            <h4
                style="font-size: 1.25rem; font-weight: bold; color: #db9123; margin-bottom: 0.5rem; letter-spacing: 1px;">
                Why Choose Londa Loans</h4>
            <h2 style="font-size: 2.25rem; font-weight: bold; color: #7a4603; line-height: 1.3; margin-bottom: 1rem;">
                We Empower Marketeers with Financial Solutions That Drive Growth
            </h2>
            <p style="font-size: 1rem; color: #666; line-height: 1.6; margin-bottom: 1.5rem; max-width: 500px;">
                At Londa Loans, we understand the unique financial needs of marketers and entrepreneurs. Our tailored
                loan programs are designed specifically to fuel your business growth and marketing initiatives.
            </p>

            <!-- Features List -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
                <div style="display: flex; align-items: flex-start; gap: 0.75rem;">
                    <div
                        style="width: 40px; height: 40px; background-color: #db9123; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <img src="{{ asset('assets/images/icon-check.svg') }}" alt="Check mark indicating fast approval"
                            style="width: 20px; height: 20px;" />
                    </div>
                    <div>
                        <h4 style="font-size: 1rem; font-weight: bold; color: #7a4603; margin-bottom: 0.25rem;">Fast
                            Approval</h4>
                        <p style="font-size: 0.875rem; color: #666; line-height: 1.4;">Get decisions within 24 hours</p>
                    </div>
                </div>
                <div style="display: flex; align-items: flex-start; gap: 0.75rem;">
                    <div
                        style="width: 40px; height: 40px; background-color: #7a4603; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <img src="{{ asset('assets/images/icon-check.svg') }}"
                            alt="Check mark indicating flexible terms" style="width: 20px; height: 20px;" />
                    </div>
                    <div>
                        <h4 style="font-size: 1rem; font-weight: bold; color: #7a4603; margin-bottom: 0.25rem;">Flexible
                            Terms</h4>
                        <p style="font-size: 0.875rem; color: #666; line-height: 1.4;">Repayment plans that work for you
                        </p>
                    </div>
                </div>
                <div style="display: flex; align-items: flex-start; gap: 0.75rem;">
                    <div
                        style="width: 40px; height: 40px; background-color: #db9123; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <img src="{{ asset('assets/images/icon-check.svg') }}"
                            alt="Check mark indicating no hidden fees" style="width: 20px; height: 20px;" />
                    </div>
                    <div>
                        <h4 style="font-size: 1rem; font-weight: bold; color: #7a4603; margin-bottom: 0.25rem;">No
                            Hidden Fees</h4>
                        <p style="font-size: 0.875rem; color: #666; line-height: 1.4;">Transparent pricing always</p>
                    </div>
                </div>
                <div style="display: flex; align-items: flex-start; gap: 0.75rem;">
                    <div
                        style="width: 40px; height: 40px; background-color: #7a4603; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <img src="{{ asset('assets/images/icon-check.svg') }}"
                            alt="Check mark indicating marketing focus" style="width: 20px; height: 20px;" />
                    </div>
                    <div>
                        <h4 style="font-size: 1rem; font-weight: bold; color: #7a4603; margin-bottom: 0.25rem;">
                            Marketing Focus</h4>
                        <p style="font-size: 0.875rem; color: #666; line-height: 1.4;">Loans designed for marketeers</p>
                    </div>
                </div>
            </div>

            <!-- Stats -->
            <div style="display: flex; flex-wrap: wrap; gap: 1.5rem; margin-bottom: 2rem; justify-content: flex-start;">
                <div style="text-align: center; min-width: 100px;">
                    <span style="font-size: 1.75rem; font-weight: bold; color: #db9123;">500+</span>
                    <span style="font-size: 0.875rem; color: #666; display: block;">Successful Campaigns Funded</span>
                </div>
                <div style="text-align: center; min-width: 100px;">
                    <span style="font-size: 1.75rem; font-weight: bold; color: #db9123;">98%</span>
                    <span style="font-size: 0.875rem; color: #666; display: block;">Customer Satisfaction</span>
                </div>
                <div style="text-align: center; min-width: 100px;">
                    <span style="font-size: 1.75rem; font-weight: bold; color: #db9123;">$10M+</span>
                    <span style="font-size: 0.875rem; color: #666; display: block;">Loans Disbursed</span>
                </div>
            </div>

            <!-- Video CTA -->
            <a href="https://www.youtube.com/watch?v=xcJtL7QggTI" data-fslightbox
                style="display: inline-flex; align-items: center; gap: 0.75rem; text-decoration: none; transition: transform 0.3s;"
                aria-label="Watch video about Londa Loans' impact on marketers">
                <span
                    style="width: 48px; height: 48px; background-color: #db9123; border-radius: 50%; display: flex; align-items: center; justify-content: center; position: relative;">
                    <span
                        style="width: 100%; height: 100%; background-color: #db9123; border-radius: 50%; opacity: 0.3; position: absolute; animation: pulse 2s infinite;"></span>
                    <img src="{{ asset('assets/images/icon-play.svg') }}" alt="Play video icon"
                        style="width: 20px; height: 20px;" />
                </span>
                <span
                    style="font-size: 0.875rem; font-weight: bold; color: #7a4603; text-transform: uppercase; letter-spacing: 1px;">See
                    How We Empower Marketers</span>
            </a>
        </div>
    </div>

    <style>
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
                transform: translateY(-8px);
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

        a:hover {
            transform: translateY(-2px);
        }

        a[data-fslightbox]:hover span[style*="background-color: #db9123"] {
            transform: scale(1.1);
        }

        @media (max-width: 1024px) {
            section {
                padding: 2rem 0;
            }

            div[style*="grid-template-columns: 1fr 1fr"] {
                grid-template-columns: 1fr;
            }

            div[style*="grid-template-columns: 1fr 1fr; gap: 1rem"] {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                justify-items: center;
            }

            img[alt*="Decorative shape"] {
                max-width: 60px;
            }
        }

        @media (max-width: 768px) {
            h2 {
                font-size: 1.75rem;
            }

            h4 {
                font-size: 1rem;
            }

            div[style*="grid-template-columns: 1fr 1fr; gap: 1.5rem"] {
                grid-template-columns: 1fr;
            }

            div[style*="display: flex; flex-wrap: wrap; gap: 1.5rem"] {
                flex-direction: column;
                align-items: center;
            }

            img[alt*="Decorative shape"] {
                display: none;
            }

            img[alt*="Marketer presenting"] {
                width: 80%;
            }
        }
    </style>

    <!-- Include fslightbox.js for video lightbox functionality -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fslightbox/3.4.1/index.min.js"></script>
</section>
