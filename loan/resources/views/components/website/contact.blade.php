@php $support = \App\Models\SupportSection::first(); @endphp

<section id="support"
    class="relative overflow-hidden py-20 bg-gradient-to-br from-primary-primary via-primary-800 to-primary-700">
    <!-- Background Shapes -->
    <div class="absolute w-64 h-64 rounded-full bg-white/10 top-10 -left-20 animate-float"></div>
    <div class="absolute w-40 h-40 rounded-full bg-white/15 bottom-20 -right-10 animate-float"
        style="animation-delay: 2s;"></div>
    <div class="absolute w-32 h-32 rounded-full bg-white/10 top-1/3 right-1/4 animate-float" style="animation-delay: 4s;">
    </div>

    <!-- Floating Icons -->
    <div class="absolute top-1/4 left-1/6 text-white/20 text-3xl animate-float"><i class="fas fa-comments"></i></div>
    <div class="absolute top-1/3 right-1/5 text-white/20 text-3xl animate-float" style="animation-delay: 1s;"><i
            class="fas fa-headset"></i></div>
    <div class="absolute bottom-1/4 left-1/4 text-white/20 text-3xl animate-float" style="animation-delay: 2s;"><i
            class="fas fa-handshake"></i></div>

    <div class="container mx-auto px-4 relative z-10">
        <!-- Header -->
        <div class="text-center mb-16 max-w-3xl mx-auto animate-fade-in-up">
            <div
                class="inline-flex items-center space-x-2 bg-white/10 text-white px-4 py-2 rounded-full text-sm font-semibold uppercase tracking-wider mb-6 border border-white/20">
                <i class="fas fa-headset text-xs"></i>
                <span>Support Center</span>
            </div>
            <h2 class="text-3xl lg:text-4xl xl:text-5xl font-black text-white mb-4">{{ $support->heading }}</h2>
            <div class="w-20 h-1 bg-primary-accent mx-auto rounded-full mb-6"></div>
            <p class="text-lg text-white/80 leading-relaxed">{{ $support->description }}</p>
        </div>

        <!-- 3-Step Process -->
        <div class="max-w-4xl mx-auto mb-12 animate-fade-in-up">
            <div class="bg-white/10 rounded-2xl p-6 backdrop-blur-sm border border-white/20">
                <h3 class="text-xl font-bold text-white text-center mb-5">Simple 3-Step Application Process</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    @foreach ($support->steps as $step)
                        <div class="text-center">
                            <div
                                class="w-10 h-10 bg-primary-accent rounded-full flex items-center justify-center text-primary-primary text-lg font-bold mx-auto mb-3 shadow-lg">
                                {{ $step['number'] }}
                            </div>
                            <h4 class="text-white font-semibold text-sm mb-1">{{ $step['title'] }}</h4>
                            <p class="text-white/70 text-xs">{{ $step['desc'] }}</p>
                        </div>
                    @endforeach
                </div>
                <div class="progress-bar mt-6 h-1.5 bg-white/20 rounded-full overflow-hidden">
                    <div class="progress-fill h-full bg-primary-accent transition-all duration-1000" style="width: 0%">
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Contact Info -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl p-6 shadow-xl animate-fade-in-up">
                        <h3 class="text-xl font-bold text-primary-primary mb-5">Contact Information</h3>
                        <div class="space-y-5 mb-6">
                            <div class="flex items-start gap-3">
                                <div
                                    class="w-10 h-10 bg-primary-secondary rounded-full flex items-center justify-center text-white flex-shrink-0">
                                    <i class="fas fa-envelope text-sm"></i>
                                </div>
                                <div>
                                    <h4 class="text-sm font-semibold text-primary-primary mb-0.5">Email Address</h4>
                                    <a href="mailto:{{ $support->email }}"
                                        class="text-gray-500 text-sm hover:text-primary-secondary transition">{{ $support->email }}</a>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div
                                    class="w-10 h-10 bg-primary-primary rounded-full flex items-center justify-center text-white flex-shrink-0">
                                    <i class="fas fa-building text-sm"></i>
                                </div>
                                <div>
                                    <h4 class="text-sm font-semibold text-primary-primary mb-0.5">Office Location</h4>
                                    <p class="text-gray-500 text-sm">
                                        {{ $support->address_line1 }}<br>{{ $support->address_line2 }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div
                                    class="w-10 h-10 bg-primary-secondary rounded-full flex items-center justify-center text-white flex-shrink-0">
                                    <i class="fas fa-phone text-sm"></i>
                                </div>
                                <div>
                                    <h4 class="text-sm font-semibold text-primary-primary mb-0.5">Phone Number</h4>
                                    <a href="tel:{{ preg_replace('/\D/', '', $support->phone) }}"
                                        class="text-gray-500 text-sm hover:text-primary-secondary transition">{{ $support->phone }}</a>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div
                                    class="w-10 h-10 bg-primary-primary rounded-full flex items-center justify-center text-white flex-shrink-0">
                                    <i class="fas fa-clock text-sm"></i>
                                </div>
                                <div>
                                    <h4 class="text-sm font-semibold text-primary-primary mb-0.5">Business Hours</h4>
                                    <p class="text-gray-500 text-sm">
                                        {{ $support->hours_line1 }}<br>{{ $support->hours_line2 }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="border-t border-gray-200 pt-5">
                            <h4 class="text-sm font-semibold text-primary-primary mb-3">Follow Us</h4>
                            <div class="flex gap-2">
                                <a href="{{ $support->facebook }}"
                                    class="w-9 h-9 bg-primary-primary rounded-full flex items-center justify-center text-white hover:bg-primary-secondary hover:scale-110 transition-all duration-300"><i
                                        class="fab fa-facebook-f text-sm"></i></a>
                                <a href="{{ $support->twitter }}"
                                    class="w-9 h-9 bg-primary-secondary rounded-full flex items-center justify-center text-white hover:bg-primary-primary hover:scale-110 transition-all duration-300"><i
                                        class="fab fa-twitter text-sm"></i></a>
                                <a href="{{ $support->linkedin }}"
                                    class="w-9 h-9 bg-primary-primary rounded-full flex items-center justify-center text-white hover:bg-primary-secondary hover:scale-110 transition-all duration-300"><i
                                        class="fab fa-linkedin-in text-sm"></i></a>
                                <a href="{{ $support->instagram }}"
                                    class="w-9 h-9 bg-primary-secondary rounded-full flex items-center justify-center text-white hover:bg-primary-primary hover:scale-110 transition-all duration-300"><i
                                        class="fab fa-instagram text-sm"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl p-6 shadow-xl animate-fade-in-up" style="animation-delay: 0.1s;">
                        <h3 class="text-xl font-bold text-primary-primary mb-1">{{ $support->form_heading }}</h3>
                        <p class="text-gray-500 text-sm mb-5">{{ $support->form_subheading }}</p>

                        <form id="loanApplicationForm" class="space-y-5">
                            <div id="formMessage" class="hidden p-4 rounded-lg mb-3"></div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <x-input name="fullname" label="Full Name *" required placeholder="Your full name" />
                                <x-input name="email" label="Email Address *" type="email" required
                                    placeholder="your.email@example.com" />
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <x-input name="phone" label="Phone Number" placeholder="0978 803838" />
                                <x-input name="company" label="Company Name" placeholder="Your business name" />
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <x-select name="businessType" label="Business Type *" required :options="[
                                    '' => 'Select your business type',
                                    'marketing-agency' => 'Marketing Agency',
                                    'ecommerce' => 'E-commerce Business',
                                    'content-creator' => 'Content Creator',
                                    'consulting' => 'Consulting Business',
                                    'other' => 'Other',
                                ]" />
                                <x-select name="loanAmount" label="Desired Loan Amount *" required
                                    :options="[
                                        '' => 'Select amount range',
                                        '5k-25k' => 'ZMW5,000 - ZMW25,000',
                                        '25k-75k' => 'ZMW25,000 - ZMW75,000',
                                        '75k-150k' => 'ZMW75,000 - ZMW150,000',
                                        '150k-plus' => 'ZMW150,000+',
                                    ]" />
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <x-select name="loanPurpose" label="Loan Purpose *" required :options="[
                                    '' => 'Select purpose',
                                    'marketing-campaign' => 'Marketing Campaign',
                                    'business-expansion' => 'Business Expansion',
                                    'equipment' => 'Equipment Purchase',
                                    'working-capital' => 'Working Capital',
                                    'other' => 'Other',
                                ]" />
                                <x-select name="timeline" label="Funding Timeline" :options="[
                                    '' => 'When do you need funds?',
                                    'immediately' => 'Immediately',
                                    '1-2-weeks' => 'Within 1-2 weeks',
                                    '1-month' => 'Within 1 month',
                                    'flexible' => 'Flexible',
                                ]" />
                            </div>
                            <x-textarea name="message" label="Tell us about your project" rows="3"
                                placeholder="Describe your business and how you plan to use the loan..." />

                            <div class="flex items-center gap-3 p-3 bg-primary-50 rounded-lg">
                                <i class="fas fa-shield-alt text-primary-secondary text-lg"></i>
                                <p class="text-xs text-gray-500">Your information is secure and will never be shared
                                    with third parties</p>
                            </div>

                            <button type="submit" id="submitBtn"
                                class="w-full py-3 bg-primary-primary text-white font-bold rounded-xl hover:bg-primary-secondary hover:scale-105 transition-all duration-300 flex items-center justify-center gap-2 shadow-lg">
                                <i class="fas fa-paper-plane"></i> Submit Application
                                <i class="fas fa-arrow-right text-sm"></i>
                            </button>

                            <p class="text-center text-xs text-gray-400">One of our loan specialists will contact you
                                within 24 hours.</p>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Trust Indicators -->
        <div class="max-w-4xl mx-auto mt-12 animate-fade-in-up" style="animation-delay: 0.2s;">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-center">
                @foreach ($support->trust_indicators as $t)
                    <div
                        class="bg-white/10 rounded-xl p-4 backdrop-blur-sm border border-white/20 hover:bg-white/15 transition-all duration-300">
                        <i class="fas {{ $t['icon'] }} text-primary-accent text-xl mb-2"></i>
                        <h4 class="text-white font-semibold text-sm mb-1">{{ $t['title'] }}</h4>
                        <p class="text-white/70 text-xs">{{ $t['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<script>
    document.getElementById('loanApplicationForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        const btn = document.getElementById('submitBtn');
        const msg = document.getElementById('formMessage');

        msg.classList.add('hidden');

        const originalText = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Submitting...';

        try {
            const formData = new FormData(this);
            const res = await fetch('/notifications/application', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            const contentType = res.headers.get('content-type');
            if (!contentType || !contentType.includes('application/json')) {
                throw new Error('Server returned non-JSON response');
            }

            const data = await res.json();

            if (data.success) {
                msg.className = 'bg-green-100 text-green-700 p-3 rounded-lg mb-3 text-sm';
                msg.innerHTML = `<i class="fas fa-check-circle mr-2"></i> ${data.message}`;
                this.reset();
                msg.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            } else {
                msg.className = 'bg-red-100 text-red-700 p-3 rounded-lg mb-3 text-sm';
                if (data.errors) {
                    const errorList = Object.values(data.errors).flat().join('<br>');
                    msg.innerHTML = `<i class="fas fa-exclamation-triangle mr-2"></i> ${errorList}`;
                } else {
                    msg.innerHTML = `<i class="fas fa-exclamation-triangle mr-2"></i> ${data.message}`;
                }
                msg.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }
            msg.classList.remove('hidden');

        } catch (err) {
            console.error('Submission error:', err);
            msg.className = 'bg-red-100 text-red-700 p-3 rounded-lg mb-3 text-sm';
            msg.innerHTML =
                `<i class="fas fa-exclamation-triangle mr-2"></i> Network error. Please try again or contact support.`;
            msg.classList.remove('hidden');
            msg.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
        } finally {
            btn.disabled = false;
            btn.innerHTML = originalText;
        }
    });

    // Animate progress bar on scroll
    const progressFill = document.querySelector('.progress-fill');
    if (progressFill) {
        const observer = new IntersectionObserver(entries => {
            if (entries[0].isIntersecting) {
                progressFill.style.width = '100%';
                observer.unobserve(progressFill);
            }
        }, {
            threshold: 0.5
        });
        observer.observe(document.querySelector('.progress-bar'));
    }
</script>

<style>
    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-20px);
        }
    }

    .animate-fade-in-up {
        animation: fadeInUp 0.6s ease-out forwards;
        opacity: 0;
    }

    .animate-float {
        animation: float 6s ease-in-out infinite;
    }

    .progress-fill {
        transition: width 1s ease-out;
    }
</style>
