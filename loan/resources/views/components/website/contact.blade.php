@php $support = \App\Models\SupportSection::first(); @endphp

<section id="support" class="relative overflow-hidden py-20 support-gradient">
    <!-- Background -->
    <div class="shape w-64 h-64 rounded-full bg-white opacity-10 top-10 -left-20 animate-float"></div>
    <div class="shape w-40 h-40 rounded-full bg-white opacity-15 bottom-20 -right-10 animate-float"
        style="animation-delay: 2s;"></div>
    <div class="shape w-32 h-32 rounded-full bg-white opacity-10 top-1/3 right-1/4 animate-float"
        style="animation-delay: 4s;"></div>

    <!-- Floating Icons -->
    <div class="floating-icon absolute top-1/4 left-1/6 text-white opacity-20 text-4xl"><i class="fas fa-comments"></i>
    </div>
    <div class="floating-icon absolute top-1/3 right-1/5 text-white opacity-20 text-4xl"><i class="fas fa-headset"></i>
    </div>
    <div class="floating-icon absolute bottom-1/4 left-1/4 text-white opacity-20 text-4xl"><i
            class="fas fa-handshake"></i></div>

    <div class="container mx-auto px-4 relative z-10">
        <!-- Header -->
        <div class="text-center mb-16 max-w-3xl mx-auto animate-fadeIn">
            <h2 class="text-5xl font-bold text-white mb-6">{{ $support->heading }}</h2>
            <p class="text-xl text-white opacity-90 leading-relaxed">{{ $support->description }}</p>
        </div>

        <!-- 3-Step Process -->
        <div class="max-w-4xl mx-auto mb-12 animate-fadeInUp">
            <div class="bg-white bg-opacity-10 rounded-2xl p-8 backdrop-blur-sm border border-white border-opacity-20">
                <h3 class="text-2xl font-bold text-white text-center mb-6">Simple 3-Step Application Process</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach ($support->steps as $step)
                        <div class="text-center">
                            <div
                                class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center text-white text-xl font-bold mx-auto mb-4">
                                {{ $step['number'] }}
                            </div>
                            <h4 class="text-white font-semibold mb-2">{{ $step['title'] }}</h4>
                            <p class="text-white opacity-80 text-sm">{{ $step['desc'] }}</p>
                        </div>
                    @endforeach
                </div>
                <div class="progress-bar mt-8 h-2 bg-white bg-opacity-20 rounded-full overflow-hidden">
                    <div class="progress-fill h-full bg-accent-500 transition-all duration-1000" style="width: 0%">
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Contact Info -->
                <div class="lg:col-span-1">
                    <div class="contact-card bg-white rounded-2xl p-8 shadow-lg animate-fadeInUp">
                        <h3 class="text-2xl font-bold text-primary-700 mb-6">Contact Information</h3>
                        <div class="space-y-6 mb-8">
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-12 h-12 bg-accent-500 rounded-full flex items-center justify-center text-white">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div>
                                    <h4 class="text-lg font-semibold text-primary-700 mb-1">Email Address</h4>
                                    <a href="mailto:{{ $support->email }}"
                                        class="text-gray-600 hover:text-accent-500">{{ $support->email }}</a>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-12 h-12 bg-primary-700 rounded-full flex items-center justify-center text-white">
                                    <i class="fas fa-building"></i>
                                </div>
                                <div>
                                    <h4 class="text-lg font-semibold text-primary-700 mb-1">Office Location</h4>
                                    <p class="text-gray-600">
                                        {{ $support->address_line1 }}<br>{{ $support->address_line2 }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-12 h-12 bg-accent-500 rounded-full flex items-center justify-center text-white">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div>
                                    <h4 class="text-lg font-semibold text-primary-700 mb-1">Phone Number</h4>
                                    <a href="tel:{{ str_replace([' ', '(', ')', '-'], '', $support->phone) }}"
                                        class="text-gray-600 hover:text-accent-500">{{ $support->phone }}</a>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-12 h-12 bg-primary-700 rounded-full flex items-center justify-center text-white">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div>
                                    <h4 class="text-lg font-semibold text-primary-700 mb-1">Business Hours</h4>
                                    <p class="text-gray-600">
                                        {{ $support->hours_line1 }}<br>{{ $support->hours_line2 }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="border-t border-gray-200 pt-6">
                            <h4 class="text-lg font-semibold text-primary-700 mb-4">Follow Us</h4>
                            <div class="flex gap-3">
                                <a href="{{ $support->facebook }}"
                                    class="w-10 h-10 bg-primary-700 rounded-full flex items-center justify-center text-white hover:bg-accent-500 hover:scale-110 transition-all"><i
                                        class="fab fa-facebook-f"></i></a>
                                <a href="{{ $support->twitter }}"
                                    class="w-10 h-10 bg-accent-500 rounded-full flex items-center justify-center text-white hover:bg-primary-700 hover:scale-110 transition-all"><i
                                        class="fab fa-twitter"></i></a>
                                <a href="{{ $support->linkedin }}"
                                    class="w-10 h-10 bg-primary-700 rounded-full flex items-center justify-center text-white hover:bg-accent-500 hover:scale-110 transition-all"><i
                                        class="fab fa-linkedin-in"></i></a>
                                <a href="{{ $support->instagram }}"
                                    class="w-10 h-10 bg-accent-500 rounded-full flex items-center justify-center text-white hover:bg-primary-700 hover:scale-110 transition-all"><i
                                        class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="lg:col-span-2">
                    <div class="contact-card bg-white rounded-2xl p-8 shadow-lg animate-fadeInUp"
                        style="animation-delay: 0.1s;">
                        <h3 class="text-2xl font-bold text-primary-700 mb-2">{{ $support->form_heading }}</h3>
                        <p class="text-gray-600 mb-6">{{ $support->form_subheading }}</p>

                        <form id="loanApplicationForm" class="space-y-6">
                            <div id="formMessage" class="hidden p-5 rounded-lg mb-4"></div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <x-input name="fullname" label="Full Name *" required placeholder="Your full name" />
                                <x-input name="email" label="Email Address *" type="email" required
                                    placeholder="your.email@example.com" />
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <x-input name="phone" label="Phone Number" placeholder="(555) 123-4567" />
                                <x-input name="company" label="Company Name" placeholder="Your business name" />
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <x-select name="businessType" label="Business Type *" required :options="[
                                    '' => 'Select your business type',
                                    'marketing-agency' => 'Marketing Agency',
                                    'ecommerce' => 'E-commerce Business',
                                    'content-creator' => 'Content Creator',
                                    'consulting' => 'Consulting Business',
                                    'other' => 'Other',
                                ]" />
                                <x-select name="loanAmount" label="Desired Loan Amount *" required :options="[
                                    '' => 'Select amount range',
                                    '5k-25k' => 'ZMW5,000 - ZMW25,000',
                                    '25k-75k' => 'ZMW25,000 - ZMW75,000',
                                    '75k-150k' => 'ZMW75,000 - ZMW150,000',
                                    '150k-plus' => 'ZMW150,000+',
                                ]" />
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
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
                            <x-textarea name="message" label="Tell us about your project" rows="4"
                                placeholder="Describe your business and how you plan to use the loan..." />

                            <div class="flex items-center gap-3 p-4 bg-primary-50 rounded-lg">
                                <i class="fas fa-shield-alt text-accent-500 text-xl"></i>
                                <p class="text-sm text-gray-600">Your information is secure and will never be shared
                                    with third parties</p>
                            </div>

                            <button type="submit" id="submitBtn"
                                class="w-full py-4 bg-accent-500 text-white font-semibold rounded-lg hover:bg-accent-600 hover:shadow-lg flex items-center justify-center gap-2 animate-pulse-glow">
                                <i class="fas fa-paper-plane"></i> Submit Application
                            </button>

                            <p class="text-center text-sm text-gray-500">One of our loan specialists will contact you
                                within 24 hours.</p>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Trust Indicators -->
        <div class="max-w-4xl mx-auto mt-16 animate-fadeInUp" style="animation-delay: 0.2s;">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
                @foreach ($support->trust_indicators as $t)
                    <div
                        class="bg-white bg-opacity-10 rounded-xl p-6 backdrop-blur-sm border border-white border-opacity-20">
                        <i class="fas {{ $t['icon'] }} text-white text-2xl mb-3"></i>
                        <h4 class="text-white font-semibold mb-2">{{ $t['title'] }}</h4>
                        <p class="text-white opacity-80 text-sm">{{ $t['desc'] }}</p>
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

        // Reset message
        msg.classList.add('hidden');

        // Update button state
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

            // Check if response is JSON
            const contentType = res.headers.get('content-type');
            if (!contentType || !contentType.includes('application/json')) {
                throw new Error('Server returned non-JSON response');
            }

            const data = await res.json();

            // Show message
            if (data.success) {
                msg.className = 'bg-green-100 text-green-700 p-4 rounded-lg mb-4';
                msg.innerHTML = `<i class="fas fa-check-circle mr-2"></i> ${data.message}`;
                this.reset(); // Reset form on success

                // Scroll to message
                msg.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            } else {
                msg.className = 'bg-red-100 text-red-700 p-4 rounded-lg mb-4';
                if (data.errors) {
                    // Show validation errors
                    const errorList = Object.values(data.errors).flat().join('<br>');
                    msg.innerHTML = `<i class="fas fa-exclamation-triangle mr-2"></i> ${errorList}`;
                } else {
                    msg.innerHTML = `<i class="fas fa-exclamation-triangle mr-2"></i> ${data.message}`;
                }

                // Scroll to error message
                msg.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }
            msg.classList.remove('hidden');

        } catch (err) {
            console.error('Submission error:', err);
            msg.className = 'bg-red-100 text-red-700 p-4 rounded-lg mb-4';
            msg.innerHTML =
                `<i class="fas fa-exclamation-triangle mr-2"></i> Network error. Please try again or contact support.`;
            msg.classList.remove('hidden');

            // Scroll to error message
            msg.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
        } finally {
            // Restore button
            btn.disabled = false;
            btn.innerHTML = originalText;
        }
    });

    // Animate progress bar on scroll
    const progressFill = document.querySelector('.progress-fill');
    const observer = new IntersectionObserver(entries => {
        if (entries[0].isIntersecting) {
            progressFill.style.width = '100%';
            observer.unobserve(progressFill);
        }
    }, {
        threshold: 0.5
    });
    observer.observe(document.querySelector('.progress-bar'));
</script>

<style>
    .support-gradient {
        @apply bg-gradient-to-br from-primary-600 via-primary-700 to-accent-600;
    }

    .progress-fill {
        @apply transition-all duration-1000;
    }
</style>
