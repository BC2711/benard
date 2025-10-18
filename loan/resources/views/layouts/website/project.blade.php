    <section id="success-stories"
        style="background-color: #f8f5f0; padding: 4rem 0; font-family: Arial, sans-serif; position: relative; overflow: hidden;">
        <!-- Background Shapes -->
        <span
            style="position: absolute; top: 10%; left: 5%; width: 150px; height: 150px; background-color: #db9123; opacity: 0.1; border-radius: 50%; animation: float 3s ease-in-out infinite;"></span>
        <img src="{{ asset('assets/images/shape-08.svg') }}" alt="Decorative shape background"
            style="position: absolute; top: 15%; right: 5%; max-width: 80px; animation: float 3.5s ease-in-out infinite;" />
        <img src="{{ asset('assets/images/shape-09.svg') }}" alt="Decorative shape pattern"
            style="position: absolute; top: 20%; left: 10%; max-width: 70px; animation: float 4s ease-in-out infinite;" />
        <img src="{{ asset('assets/images/shape-10.svg') }}" alt="Decorative shape accent"
            style="position: absolute; bottom: 10%; right: 15%; max-width: 90px; animation: float 3.8s ease-in-out infinite;" />
        <img src="{{ asset('assets/images/shape-11.svg') }}" alt="Decorative shape detail"
            style="position: absolute; bottom: 15%; left: 10%; max-width: 85px; animation: float 4.2s ease-in-out infinite;" />

        <!-- Section Title -->
        <div style="text-align: center; margin-bottom: 3rem; animation: fadeIn 0.6s ease-in;">
            <h2
                style="font-size: 2.25rem; font-weight: bold; color: #7a4603; line-height: 1.3; margin-bottom: 0.75rem;">
                Success Stories: Marketeers We've Empowered
            </h2>
            <p style="font-size: 1rem; color: #666; line-height: 1.6; max-width: 600px; margin: 0 auto;">
                Discover how our loan solutions have helped marketing professionals and businesses achieve remarkable
                growth
                and success in their campaigns and operations.
            </p>
        </div>

        <!-- Project Tabs -->
        <div
            style="max-width: 1200px; margin: 0 auto; padding: 0 1rem; display: flex; justify-content: center; gap: 1rem; margin-bottom: 2rem; background-color: white; border-radius: 8px; padding: 0.5rem;">
            <button id="tab-all" class="tab-btn"
                style="padding: 0.75rem 1.5rem; background-color: #db9123; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: bold; transition: all 0.3s;"
                aria-pressed="true">All Success Stories</button>
            <button id="tab-campaign" class="tab-btn"
                style="padding: 0.75rem 1.5rem; background-color: transparent; color: #7a4603; border: 2px solid #7a4603; border-radius: 6px; cursor: pointer; font-weight: bold; transition: all 0.3s;"
                aria-pressed="false">Marketing Campaigns</button>
            <button id="tab-growth" class="tab-btn"
                style="padding: 0.75rem 1.5rem; background-color: transparent; color: #7a4603; border: 2px solid #7a4603; border-radius: 6px; cursor: pointer; font-weight: bold; transition: all 0.3s;"
                aria-pressed="false">Business Growth</button>
            <button id="tab-startup" class="tab-btn"
                style="padding: 0.75rem 1.5rem; background-color: transparent; color: #7a4603; border: 2px solid #7a4603; border-radius: 6px; cursor: pointer; font-weight: bold; transition: all 0.3s;"
                aria-pressed="false">Startup Funding</button>
        </div>

        <!-- Projects Wrapper -->
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 1rem;">
            <div id="projects-wrapper"
                style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem; margin-bottom: 3rem;">
                <!-- Projects will be dynamically inserted here -->
            </div>
        </div>

        <!-- CTA Section -->
        <div
            style="max-width: 1200px; margin: 0 auto; padding: 0 1rem; text-align: center; animation: fadeIn 0.6s ease-in 0.4s both;">
            <h3 style="font-size: 1.75rem; font-weight: bold; color: #7a4603; margin-bottom: 0.5rem;">Ready to create
                your
                success story?</h3>
            <p
                style="font-size: 1rem; color: #666; margin-bottom: 1.5rem; max-width: 600px; margin-left: auto; margin-right: auto;">
                Join hundreds of marketeers who have transformed their businesses with Londa Loans
            </p>
            <div style="display: flex; flex-wrap: wrap; gap: 1rem; justify-content: center;">
                <a href="#!"
                    style="padding: 0.75rem 1.5rem; background-color: #db9123; border: 2px solid #db9123; color: white; text-decoration: none; border-radius: 4px; font-weight: bold; transition: all 0.3s;"
                    aria-label="Apply for funding to start your success story">Apply for Funding</a>
                <a href="#!"
                    style="padding: 0.75rem 1.5rem; border: 2px solid #7a4603; color: #7a4603; text-decoration: none; border-radius: 4px; font-weight: bold; transition: all 0.3s;"
                    aria-label="View all case studies and success stories">View All Case Studies</a>
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

            .tab-btn[aria-pressed="true"] {
                background-color: #db9123 !important;
                color: white !important;
                border-color: #db9123 !important;
            }

            .tab-btn[aria-pressed="false"]:hover {
                background-color: #7a4603;
                color: white;
                border-color: #7a4603;
            }

            .project-item {
                position: relative;
                border-radius: 12px;
                overflow: hidden;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                animation: fadeInUp 0.6s ease-in both;
            }

            .project-item.hidden {
                display: none;
            }

            .project-overlay {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: linear-gradient(135deg, rgba(122, 70, 3, 0.9) 0%, rgba(219, 145, 35, 0.9) 100%);
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                opacity: 0;
                transition: opacity 0.3s;
            }

            .project-item:hover .project-overlay {
                opacity: 1;
            }

            a:hover {
                transform: translateY(-2px);
            }

            a[aria-label*="Apply for funding"]:hover {
                background-color: transparent;
                color: #db9123;
            }

            a[aria-label*="View all case studies"]:hover {
                background-color: #7a4603;
                color: white;
            }

            .project-overlay a:hover {
                background-color: white;
                color: #7a4603;
            }

            @media (max-width: 1024px) {
                section {
                    padding: 2rem 0;
                }

                img[alt*="Decorative shape"],
                span[style*="background-color: #db9123"] {
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

                div[style*="display: flex; gap: 1rem"] {
                    flex-direction: column;
                    align-items: center;
                }

                .tab-btn {
                    width: 100%;
                    margin-bottom: 0.5rem;
                }
            }
        </style>

        <script>
            // Project Data
            const projects = [{
                    title: 'Social Media Blitz',
                    loan: '$25K Campaign Loan',
                    result: '300% ROI achieved',
                    image: "{{ asset('assets/images/project-01.png') }}",
                    alt: 'Social Media Campaign Success',
                    categories: ['campaign']
                },
                {
                    title: 'Digital Agency Scaling',
                    loan: '$75K Growth Loan',
                    result: 'Team doubled in size',
                    image: "{{ asset('assets/images/project-02.png') }}",
                    alt: 'Agency Expansion',
                    categories: ['growth']
                },
                {
                    title: 'E-commerce Brand Launch',
                    loan: '$50K Startup Package',
                    result: '$1M+ first year revenue',
                    image: "{{ asset('assets/images/project-04.png') }}",
                    alt: 'E-commerce Launch',
                    categories: ['startup', 'campaign']
                },
                {
                    title: 'Content Marketing Platform',
                    loan: '$100K Expansion Loan',
                    result: '5x audience growth',
                    image: "{{ asset('assets/images/project-03.png') }}",
                    alt: 'Content Marketing Success',
                    categories: ['growth']
                }
            ];

            // Render Projects
            function renderProjects(filter = 'all') {
                const wrapper = document.getElementById('projects-wrapper');
                wrapper.innerHTML = projects.map((project, index) => {
                    const isHidden = filter !== 'all' && !project.categories.includes(filter);
                    return `
                    <div class="project-item ${isHidden ? 'hidden' : ''}" style="animation-delay: ${0.1 * (index + 1)}s;">
                        <img src="${project.image}" alt="${project.alt}" style="width: 100%; display: block;" />
                        <div class="project-overlay" style="padding: 1rem; text-align: center;">
                            <h4 style="font-size: 1.25rem; font-weight: bold; color: white; margin-bottom: 0.5rem;">${project.title}</h4>
                            <p style="font-size: 1rem; color: white; margin-bottom: 0.5rem;">${project.loan}</p>
                            <p style="font-size: 0.9rem; color: white; opacity: 0.8; margin-bottom: 1rem;">${project.result}</p>
                            <a href="#!" style="display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; border: 2px solid white; border-radius: 50%; color: white; text-decoration: none; transition: all 0.3s;" aria-label="View details for ${project.title}">
                                <svg style="width: 14px; height: 14px;" fill="currentColor" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.4763 6.16664L6.00634 1.69664L7.18467 0.518311L13.6663 6.99998L7.18467 13.4816L6.00634 12.3033L10.4763 7.83331H0.333008V6.16664H10.4763Z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                `;
                }).join('');
            }

            // Initialize and Tab Filtering
            document.addEventListener('DOMContentLoaded', () => {
                renderProjects();
                const tabs = {
                    all: document.getElementById('tab-all'),
                    campaign: document.getElementById('tab-campaign'),
                    growth: document.getElementById('tab-growth'),
                    startup: document.getElementById('tab-startup')
                };
                Object.keys(tabs).forEach(key => {
                    tabs[key].addEventListener('click', () => {
                        Object.values(tabs).forEach(tab => tab.setAttribute('aria-pressed', 'false'));
                        tabs[key].setAttribute('aria-pressed', 'true');
                        renderProjects(key === 'all' ? 'all' : key);
                    });
                });
            });
        </script>
    </section>
