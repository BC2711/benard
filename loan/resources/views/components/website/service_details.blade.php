<style>
    .gradient-detail-bg {
        background: linear-gradient(135deg, #7a4603 0%, #9a5c15 50%, #db9123 100%);
    }

    .card-hover {
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .card-hover:hover {
        transform: translateY(-8px);
    }

    .text-gradient {
        background: linear-gradient(135deg, #ffffff 0%, #f8b750 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .glass-effect {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
</style>

<!-- Service Header -->
<header class="gradient-detail-bg text-white relative overflow-hidden">
    <!-- Background Elements -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-0 left-0 w-72 h-72 bg-white/5 rounded-full blur-3xl animate-float"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-accent/10 rounded-full blur-3xl animate-float"
            style="animation-delay: 2s;"></div>
    </div>

    <div class="container mx-auto px-4 lg:px-8 py-16 lg:py-24 relative z-10">
        <!-- Breadcrumb -->
        <nav class="mb-6 animate-fade-in">
            <a href="services.html" class="text-white/70 hover:text-white transition-colors duration-300">Our Services</a>
            <span class="text-white/50 mx-2">/</span>
            <span class="text-accent font-semibold">Campaign Expansion Loan</span>
        </nav>

        <!-- Header Content -->
        <div class="max-w-4xl">
            <h1 class="text-4xl lg:text-5xl xl:text-6xl font-black leading-tight mb-4 animate-fade-in-up">
                Campaign Expansion <span class="text-gradient">Loan</span>
            </h1>
            <p class="text-xl text-white/90 leading-relaxed mb-8 max-w-3xl animate-fade-in-up"
                style="animation-delay: 100ms">
                Fuel your marketing campaigns with flexible funding designed to scale your advertising efforts and
                maximize ROI
            </p>

            <!-- Meta Information -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mb-8 animate-fade-in-up" style="animation-delay: 200ms">
                <div class="glass-effect rounded-2xl p-4 text-center">
                    <div class="w-12 h-12 bg-accent/20 rounded-xl flex items-center justify-center mx-auto mb-2">
                        <i class="fas fa-dollar-sign text-accent text-xl"></i>
                    </div>
                    <div class="text-2xl font-black text-accent">Up to $100K</div>
                    <div class="text-white/70 text-sm">Loan Amount</div>
                </div>
                <div class="glass-effect rounded-2xl p-4 text-center">
                    <div class="w-12 h-12 bg-accent/20 rounded-xl flex items-center justify-center mx-auto mb-2">
                        <i class="fas fa-calendar-alt text-accent text-xl"></i>
                    </div>
                    <div class="text-2xl font-black text-accent">6-36 Months</div>
                    <div class="text-white/70 text-sm">Term Length</div>
                </div>
                <div class="glass-effect rounded-2xl p-4 text-center">
                    <div class="w-12 h-12 bg-accent/20 rounded-xl flex items-center justify-center mx-auto mb-2">
                        <i class="fas fa-bolt text-accent text-xl"></i>
                    </div>
                    <div class="text-2xl font-black text-accent">48 Hours</div>
                    <div class="text-white/70 text-sm">Funding Time</div>
                </div>
                <div class="glass-effect rounded-2xl p-4 text-center">
                    <div class="w-12 h-12 bg-accent/20 rounded-xl flex items-center justify-center mx-auto mb-2">
                        <i class="fas fa-chart-line text-accent text-xl"></i>
                    </div>
                    <div class="text-2xl font-black text-accent">Marketing</div>
                    <div class="text-white/70 text-sm">Campaign Focus</div>
                </div>
            </div>

            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 animate-fade-in-up" style="animation-delay: 300ms">
                <a href="#apply"
                    class="group bg-white text-primary px-8 py-4 rounded-2xl font-bold text-lg shadow-2xl hover:shadow-3xl transition-all duration-300 hover:scale-105 flex items-center justify-center space-x-3">
                    <span>Apply Now</span>
                    <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform duration-300"></i>
                </a>
                <a href="#details"
                    class="group border-2 border-white text-white px-8 py-4 rounded-2xl font-bold text-lg hover:bg-white hover:text-primary transition-all duration-300 hover:scale-105 flex items-center justify-center space-x-3">
                    <span>Learn More</span>
                    <i class="fas fa-book-open group-hover:scale-110 transition-transform duration-300"></i>
                </a>
            </div>
        </div>
    </div>
</header>

<!-- Main Content -->
<main class="py-16 lg:py-24">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="grid lg:grid-cols-3 gap-12">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Introduction -->
                <section class="mb-16 animate-fade-in-up">
                    <h2 class="text-3xl lg:text-4xl font-black text-primary mb-6">Amplify Your Marketing Impact</h2>
                    <p class="text-lg text-gray-600 leading-relaxed mb-6">
                        Our Campaign Expansion Loan is specifically designed for marketers who need immediate capital to
                        scale successful campaigns, test new channels, or capitalize on time-sensitive opportunities.
                        Whether you're running Facebook ads, Google campaigns, or influencer marketing, this loan
                        provides the fuel to accelerate your growth.
                    </p>

                    <!-- Highlight Testimonial -->
                    <div
                        class="bg-gradient-to-r from-primary/10 to-secondary/10 border-l-4 border-accent rounded-r-2xl p-6 mb-8">
                        <p class="text-lg text-gray-700 italic leading-relaxed">
                            "We increased our campaign budget by 300% with a Campaign Expansion Loan, resulting in a 5x
                            return on ad spend within the first quarter."
                        </p>
                        <div class="flex items-center mt-4">
                            <div
                                class="w-12 h-12 bg-accent rounded-full flex items-center justify-center text-white font-bold mr-4">
                                SJ</div>
                            <div>
                                <div class="font-bold text-gray-800">Sarah Johnson</div>
                                <div class="text-gray-600">Digital Marketing Director</div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Features & Benefits -->
                <section class="mb-16 animate-fade-in-up" style="animation-delay: 100ms">
                    <h2 class="text-3xl lg:text-4xl font-black text-primary mb-8">Key Features & Benefits</h2>

                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Feature 1 -->
                        <div class="bg-white rounded-2xl p-6 shadow-lg card-hover border border-gray-100">
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-secondary to-accent rounded-2xl flex items-center justify-center mb-4">
                                <i class="fas fa-money-bill-wave text-white text-2xl"></i>
                            </div>
                            <h3 class="text-xl font-bold text-primary mb-3">Flexible Funding</h3>
                            <p class="text-gray-600 leading-relaxed">Borrow from $5,000 to $100,000 with terms that
                                match your campaign cycles</p>
                        </div>

                        <!-- Feature 2 -->
                        <div class="bg-white rounded-2xl p-6 shadow-lg card-hover border border-gray-100">
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-primary to-secondary rounded-2xl flex items-center justify-center mb-4">
                                <i class="fas fa-bolt text-white text-2xl"></i>
                            </div>
                            <h3 class="text-xl font-bold text-primary mb-3">Rapid Approval</h3>
                            <p class="text-gray-600 leading-relaxed">Get approved in as little as 24 hours with funding
                                in 48 hours</p>
                        </div>

                        <!-- Feature 3 -->
                        <div class="bg-white rounded-2xl p-6 shadow-lg card-hover border border-gray-100">
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-secondary to-accent rounded-2xl flex items-center justify-center mb-4">
                                <i class="fas fa-chart-line text-white text-2xl"></i>
                            </div>
                            <h3 class="text-xl font-bold text-primary mb-3">Performance-Based</h3>
                            <p class="text-gray-600 leading-relaxed">Terms adapt to your campaign performance and
                                business metrics</p>
                        </div>

                        <!-- Feature 4 -->
                        <div class="bg-white rounded-2xl p-6 shadow-lg card-hover border border-gray-100">
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-primary to-secondary rounded-2xl flex items-center justify-center mb-4">
                                <i class="fas fa-shield-alt text-white text-2xl"></i>
                            </div>
                            <h3 class="text-xl font-bold text-primary mb-3">No Collateral</h3>
                            <p class="text-gray-600 leading-relaxed">Unsecured loans based on your marketing track
                                record</p>
                        </div>
                    </div>
                </section>

                <!-- Use Cases -->
                <section class="mb-16 animate-fade-in-up" style="animation-delay: 200ms">
                    <h2 class="text-3xl lg:text-4xl font-black text-primary mb-8">Ideal Use Cases</h2>

                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Use Case 1 -->
                        <div class="bg-white rounded-2xl p-6 shadow-lg border-t-4 border-primary">
                            <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center mb-4">
                                <i class="fas fa-rocket text-primary text-xl"></i>
                            </div>
                            <h3 class="text-xl font-bold text-primary mb-3">Scale Winning Campaigns</h3>
                            <p class="text-gray-600 leading-relaxed">Increase budget for high-performing campaigns to
                                maximize returns before competitors catch up</p>
                        </div>

                        <!-- Use Case 2 -->
                        <div class="bg-white rounded-2xl p-6 shadow-lg border-t-4 border-secondary">
                            <div class="w-12 h-12 bg-secondary/10 rounded-xl flex items-center justify-center mb-4">
                                <i class="fas fa-flask text-secondary text-xl"></i>
                            </div>
                            <h3 class="text-xl font-bold text-primary mb-3">Test New Channels</h3>
                            <p class="text-gray-600 leading-relaxed">Fund experiments with emerging platforms like
                                TikTok, programmatic, or connected TV</p>
                        </div>

                        <!-- Use Case 3 -->
                        <div class="bg-white rounded-2xl p-6 shadow-lg border-t-4 border-accent">
                            <div class="w-12 h-12 bg-accent/10 rounded-xl flex items-center justify-center mb-4">
                                <i class="fas fa-calendar text-accent text-xl"></i>
                            </div>
                            <h3 class="text-xl font-bold text-primary mb-3">Seasonal Opportunities</h3>
                            <p class="text-gray-600 leading-relaxed">Capitalize on holiday seasons, product launches,
                                or industry events</p>
                        </div>

                        <!-- Use Case 4 -->
                        <div class="bg-white rounded-2xl p-6 shadow-lg border-t-4 border-primary">
                            <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center mb-4">
                                <i class="fas fa-video text-primary text-xl"></i>
                            </div>
                            <h3 class="text-xl font-bold text-primary mb-3">Content Production</h3>
                            <p class="text-gray-600 leading-relaxed">Create high-quality video, photography, or other
                                assets for campaigns</p>
                        </div>
                    </div>
                </section>

                <!-- Process Section -->
                <section class="mb-16 animate-fade-in-up" style="animation-delay: 300ms">
                    <h2 class="text-3xl lg:text-4xl font-black text-primary mb-8">Simple Application Process</h2>

                    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Step 1 -->
                        <div class="text-center">
                            <div
                                class="w-20 h-20 bg-gradient-to-br from-primary to-secondary rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                                <div class="text-2xl font-black text-white">1</div>
                            </div>
                            <h3 class="text-lg font-bold text-primary mb-2">Apply Online</h3>
                            <p class="text-gray-600 text-sm">Complete our streamlined application in under 10 minutes
                            </p>
                        </div>

                        <!-- Step 2 -->
                        <div class="text-center">
                            <div
                                class="w-20 h-20 bg-gradient-to-br from-secondary to-accent rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                                <div class="text-2xl font-black text-white">2</div>
                            </div>
                            <h3 class="text-lg font-bold text-primary mb-2">Submit Documents</h3>
                            <p class="text-gray-600 text-sm">Provide basic business information and campaign data</p>
                        </div>

                        <!-- Step 3 -->
                        <div class="text-center">
                            <div
                                class="w-20 h-20 bg-gradient-to-br from-accent to-primary rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                                <div class="text-2xl font-black text-white">3</div>
                            </div>
                            <h3 class="text-lg font-bold text-primary mb-2">Get Approved</h3>
                            <p class="text-gray-600 text-sm">Receive a decision within 24 hours of application</p>
                        </div>

                        <!-- Step 4 -->
                        <div class="text-center">
                            <div
                                class="w-20 h-20 bg-gradient-to-br from-primary to-secondary rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                                <div class="text-2xl font-black text-white">4</div>
                            </div>
                            <h3 class="text-lg font-bold text-primary mb-2">Receive Funds</h3>
                            <p class="text-gray-600 text-sm">Access your capital in 48 hours or less</p>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="sticky top-8 space-y-8">
                    <!-- Loan Details -->
                    <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 animate-slide-in-left">
                        <h3 class="text-xl font-bold text-primary mb-4 flex items-center">
                            <i class="fas fa-file-invoice-dollar text-secondary mr-3"></i>
                            Loan Details
                        </h3>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                <span class="text-gray-600">Loan Amount</span>
                                <span class="font-bold text-primary">$5,000 - $100,000</span>
                            </div>
                            <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                <span class="text-gray-600">Term Length</span>
                                <span class="font-bold text-primary">6 - 36 Months</span>
                            </div>
                            <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                <span class="text-gray-600">Interest Rate</span>
                                <span class="font-bold text-primary">7.5% - 12.5%</span>
                            </div>
                            <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                <span class="text-gray-600">Monthly Payment</span>
                                <span class="font-bold text-primary">Varies by Amount</span>
                            </div>
                            <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                <span class="text-gray-600">Time to Funding</span>
                                <span class="font-bold text-primary">48 Hours</span>
                            </div>
                            <div class="flex justify-between items-center py-3">
                                <span class="text-gray-600">Collateral</span>
                                <span class="font-bold text-primary">Not Required</span>
                            </div>
                        </div>
                    </div>

                    <!-- Eligibility -->
                    <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 animate-slide-in-left"
                        style="animation-delay: 100ms">
                        <h3 class="text-xl font-bold text-primary mb-4 flex items-center">
                            <i class="fas fa-check-circle text-secondary mr-3"></i>
                            Eligibility
                        </h3>
                        <ul class="space-y-3">
                            <li class="flex items-start">
                                <i class="fas fa-check text-accent mr-3 mt-1"></i>
                                <span class="text-gray-600">Minimum 6 months in business</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-accent mr-3 mt-1"></i>
                                <span class="text-gray-600">Active marketing campaigns with performance data</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-accent mr-3 mt-1"></i>
                                <span class="text-gray-600">Monthly revenue of $10,000+</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-accent mr-3 mt-1"></i>
                                <span class="text-gray-600">Good standing with previous lenders</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-accent mr-3 mt-1"></i>
                                <span class="text-gray-600">US-based business</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Testimonial -->
                    <div class="bg-gradient-to-br from-primary to-secondary rounded-2xl p-6 text-white animate-slide-in-left"
                        style="animation-delay: 200ms">
                        <div class="text-6xl opacity-20 mb-4">"</div>
                        <p class="text-lg leading-relaxed mb-6 italic">
                            The Campaign Expansion Loan allowed us to triple our Google Ads budget during peak season.
                            We generated $350,000 in additional revenue that we would have missed otherwise.
                        </p>
                        <div class="flex items-center">
                            <div
                                class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center text-white font-bold mr-4">
                                MJ</div>
                            <div>
                                <div class="font-bold">Michael Johnson</div>
                                <div class="text-white/70 text-sm">E-commerce Marketing Manager</div>
                            </div>
                        </div>
                    </div>

                    <!-- CTA Sidebar -->
                    <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 text-center animate-slide-in-left"
                        style="animation-delay: 300ms">
                        <h3 class="text-xl font-bold text-primary mb-3">Ready to Scale Your Campaigns?</h3>
                        <p class="text-gray-600 mb-6">Apply now and get a decision within 24 hours</p>
                        <a href="#apply"
                            class="w-full bg-gradient-to-r from-secondary to-accent text-white py-4 px-6 rounded-2xl font-bold text-lg shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105 block">
                            Apply Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- FAQ Section -->
<section class="py-16 lg:py-24 bg-light">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-3xl lg:text-4xl font-black text-primary text-center mb-4">Frequently Asked Questions</h2>
            <p class="text-lg text-gray-600 text-center mb-12 max-w-2xl mx-auto">Get answers to common questions about
                our Campaign Expansion Loan</p>

            <div class="space-y-4">
                <!-- FAQ 1 -->
                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                    <button class="faq-question w-full text-left flex justify-between items-center">
                        <span class="text-lg font-bold text-primary">What can I use the loan for?</span>
                        <i class="fas fa-plus text-secondary"></i>
                    </button>
                    <div class="faq-answer mt-4 hidden">
                        <p class="text-gray-600 leading-relaxed">Campaign Expansion Loans can be used for any
                            marketing-related expenses including ad spend, content creation, agency fees, software
                            tools, and campaign testing.</p>
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                    <button class="faq-question w-full text-left flex justify-between items-center">
                        <span class="text-lg font-bold text-primary">How quickly can I get funded?</span>
                        <i class="fas fa-plus text-secondary"></i>
                    </button>
                    <div class="faq-answer mt-4 hidden">
                        <p class="text-gray-600 leading-relaxed">Most applicants receive funding within 48 hours of
                            approval. We prioritize speed because we understand marketing opportunities are often
                            time-sensitive.</p>
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                    <button class="faq-question w-full text-left flex justify-between items-center">
                        <span class="text-lg font-bold text-primary">What documents do I need?</span>
                        <i class="fas fa-plus text-secondary"></i>
                    </button>
                    <div class="faq-answer mt-4 hidden">
                        <p class="text-gray-600 leading-relaxed">You'll need basic business information, bank
                            statements, and campaign performance data. We've streamlined the process to require minimal
                            documentation.</p>
                    </div>
                </div>

                <!-- FAQ 4 -->
                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                    <button class="faq-question w-full text-left flex justify-between items-center">
                        <span class="text-lg font-bold text-primary">Is there a prepayment penalty?</span>
                        <i class="fas fa-plus text-secondary"></i>
                    </button>
                    <div class="faq-answer mt-4 hidden">
                        <p class="text-gray-600 leading-relaxed">No, you can pay off your loan early without any
                            penalties. We want you to succeed and scale your business.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Services -->
<section class="py-16 lg:py-24">
    <div class="container mx-auto px-4 lg:px-8">
        <h2 class="text-3xl lg:text-4xl font-black text-primary text-center mb-4">Other Services You Might Like</h2>
        <p class="text-lg text-gray-600 text-center mb-12 max-w-2xl mx-auto">Explore our other specialized loan
            solutions for marketers</p>

        <div class="grid md:grid-cols-3 gap-8">
            <!-- Related Service 1 -->
            <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 text-center card-hover">
                <div
                    class="w-16 h-16 bg-gradient-to-br from-primary to-secondary rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-building text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-primary mb-3">Business Growth Loan</h3>
                <p class="text-gray-600 mb-6">Long-term financing for expanding your marketing agency or team</p>
                <a href="business-growth-loan.html"
                    class="text-secondary font-bold hover:text-primary transition-colors duration-300">
                    Learn More <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>

            <!-- Related Service 2 -->
            <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 text-center card-hover">
                <div
                    class="w-16 h-16 bg-gradient-to-br from-secondary to-accent rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-laptop text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-primary mb-3">Equipment Financing</h3>
                <p class="text-gray-600 mb-6">Fund cameras, computers, and other marketing equipment</p>
                <a href="equipment-financing.html"
                    class="text-secondary font-bold hover:text-primary transition-colors duration-300">
                    Learn More <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>

            <!-- Related Service 3 -->
            <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 text-center card-hover">
                <div
                    class="w-16 h-16 bg-gradient-to-br from-accent to-primary rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-cash-register text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-primary mb-3">Working Capital</h3>
                <p class="text-gray-600 mb-6">Bridge cash flow gaps between client payments</p>
                <a href="working-capital.html"
                    class="text-secondary font-bold hover:text-primary transition-colors duration-300">
                    Learn More <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Final CTA -->
<section class="gradient-detail-bg py-16 lg:py-24 text-white">
    <div class="container mx-auto px-4 lg:px-8 text-center">
        <h2 class="text-3xl lg:text-4xl font-black mb-6">Ready to Scale Your Marketing Campaigns?</h2>
        <p class="text-xl text-white/90 mb-8 max-w-2xl mx-auto">Join thousands of marketers who have accelerated their
            growth with our Campaign Expansion Loans</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="#apply"
                class="bg-white text-primary px-8 py-4 rounded-2xl font-bold text-lg shadow-2xl hover:shadow-3xl transition-all duration-300 hover:scale-105">
                Apply Now
            </a>
            <a href="contact.html"
                class="border-2 border-white text-white px-8 py-4 rounded-2xl font-bold text-lg hover:bg-white hover:text-primary transition-all duration-300 hover:scale-105">
                Speak With an Expert
            </a>
        </div>
    </div>
</section>

<script>
    // FAQ Toggle Functionality
    document.addEventListener('DOMContentLoaded', function() {
        const faqQuestions = document.querySelectorAll('.faq-question');

        faqQuestions.forEach(question => {
            question.addEventListener('click', () => {
                const answer = question.nextElementSibling;
                const icon = question.querySelector('i');

                // Toggle answer visibility
                answer.classList.toggle('hidden');

                // Toggle icon
                if (answer.classList.contains('hidden')) {
                    icon.classList.remove('fa-minus');
                    icon.classList.add('fa-plus');
                } else {
                    icon.classList.remove('fa-plus');
                    icon.classList.add('fa-minus');
                }
            });
        });

        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationPlayState = 'running';
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        // Observe all animated elements
        const animatedElements = document.querySelectorAll('[class*="animate-"]');
        animatedElements.forEach(el => {
            el.style.animationPlayState = 'paused';
            observer.observe(el);
        });

        // Handle reduced motion preferences
        if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            const animatedElements = document.querySelectorAll('[class*="animate-"]');
            animatedElements.forEach(el => {
                el.style.animation = 'none';
            });
        }
    });
</script>
