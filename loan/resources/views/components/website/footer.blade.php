@php $footer = \App\Models\FooterSection::first(); @endphp

<footer class="footer-gradient text-white relative overflow-hidden">
    <!-- Background -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-10 left-10 w-32 h-32 bg-accent-500 rounded-full animate-float"></div>
        <div class="absolute top-20 right-20 w-24 h-24 bg-primary-500 rounded-full animate-float"
            style="animation-delay: 2s;"></div>
        <div class="absolute bottom-20 left-1/4 w-20 h-20 bg-accent-500 rounded-full animate-float"
            style="animation-delay: 4s;"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="py-16">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Brand -->
                <div class="footer-card animate-fadeIn">
                    <div class="flex flex-col items-start mb-6">
                        <div class="flex items-center gap-2 mb-2">
                            <div
                                class="w-10 h-10 bg-accent-500 rounded-lg flex items-center justify-center text-white font-bold text-xl">
                                {{ substr($footer->brand_name, 0, 1) }}
                            </div>
                            <span class="text-2xl font-bold">{{ $footer->brand_name }}</span>
                        </div>
                        <span class="text-accent-300 text-sm">{{ $footer->brand_tagline }}</span>
                    </div>
                    <p class="text-gray-300 mb-6 leading-relaxed">{{ $footer->brand_description }}</p>

                    <div class="space-y-4 mb-6">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-accent-500 rounded-full flex items-center justify-center text-white">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <a href="mailto:{{ $footer->email }}"
                                class="text-gray-300 hover:text-white">{{ $footer->email }}</a>
                        </div>
                        <div class="flex items-center gap-3">
                            <div
                                class="w-8 h-8 bg-primary-600 rounded-full flex items-center justify-center text-white">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <span
                                class="text-gray-300">{{ $footer->address_line1 }}<br>{{ $footer->address_line2 }}</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-accent-500 rounded-full flex items-center justify-center text-white">
                                <i class="fas fa-phone"></i>
                            </div>
                            <a href="tel:{{ preg_replace('/[^0-9]/', '', $footer->phone) }}"
                                class="text-gray-300 hover:text-white">{{ $footer->phone }}</a>
                        </div>
                    </div>

                    <div class="flex gap-3">
                        <a href="{{ $footer->facebook }}"
                            class="social-icon w-10 h-10 bg-primary-600 rounded-full flex items-center justify-center text-white hover:bg-accent-500"><i
                                class="fab fa-facebook-f"></i></a>
                        <a href="{{ $footer->twitter }}"
                            class="social-icon w-10 h-10 bg-accent-500 rounded-full flex items-center justify-center text-white hover:bg-primary-600"><i
                                class="fab fa-twitter"></i></a>
                        <a href="{{ $footer->linkedin }}"
                            class="social-icon w-10 h-10 bg-primary-600 rounded-full flex items-center justify-center text-white hover:bg-accent-500"><i
                                class="fab fa-linkedin-in"></i></a>
                        <a href="{{ $footer->instagram }}"
                            class="social-icon w-10 h-10 bg-accent-500 rounded-full flex items-center justify-center text-white hover:bg-primary-600"><i
                                class="fab fa-instagram"></i></a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="footer-card animate-fadeIn" style="animation-delay: 0.1s;">
                    <h4 class="text-xl font-bold text-accent-400 mb-6">Quick Links</h4>
                    <ul class="space-y-3">
                        @foreach ($footer->quick_links as $link)
                            <li>
                                <a href="{{ $link['url'] }}"
                                    class="text-gray-300 hover:text-white flex items-center gap-2 group">
                                    <i
                                        class="fas fa-chevron-right text-accent-500 text-xs group-hover:translate-x-1 transition-transform"></i>
                                    {{ $link['text'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Resources -->
                <div class="footer-card animate-fadeIn" style="animation-delay: 0.2s;">
                    <h4 class="text-xl font-bold text-accent-400 mb-6">Resources</h4>
                    <ul class="space-y-3">
                        @foreach ($footer->resources as $res)
                            <li>
                                <a href="{{ $res['url'] }}"
                                    class="text-gray-300 hover:text-white flex items-center gap-2 group">
                                    <i
                                        class="fas fa-chevron-right text-accent-500 text-xs group-hover:translate-x-1 transition-transform"></i>
                                    {{ $res['text'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Newsletter -->
                <div class="footer-card animate-fadeIn" style="animation-delay: 0.3s;">
                    <h4 class="text-xl font-bold text-accent-400 mb-6">{{ $footer->newsletter_heading }}</h4>
                    <p class="text-gray-300 mb-6">{{ $footer->newsletter_description }}</p>


                    <form id="newsletterForm" class="space-y-4">
                        @csrf
                        <input type="email" name="email" placeholder="Your email address" required
                            class="w-full px-4 py-3 bg-white bg-opacity-10 border border-accent-500 rounded-lg newsletter-input focus:outline-none focus:border-accent-400 text-white placeholder-gray-400">
                        <button type="submit"
                            class="w-full py-3 bg-accent-500 text-white font-semibold rounded-lg hover:bg-accent-600 hover:shadow-lg flex items-center justify-center gap-2 transition-all duration-300">
                            <i class="fas fa-paper-plane"></i>
                            <span id="submitText">Subscribe</span>
                            <div id="submitSpinner" class="hidden">
                                <i class="fas fa-spinner fa-spin"></i>
                            </div>
                        </button>
                    </form>
                    <div id="newsletterMessage" class="mt-4 text-sm min-h-6 transition-all duration-300"></div>

                    <div class="mt-8 pt-6 border-t border-gray-600">
                        <h5 class="text-accent-400 font-semibold mb-4">Trust & Security</h5>
                        <div class="flex flex-wrap gap-3">
                            @foreach ($footer->trust_badges as $badge)
                                <div class="trust-badge bg-white bg-opacity-10 px-3 py-2 rounded-lg text-xs">
                                    <i class="fas {{ $badge['icon'] }} text-accent-400 mr-1"></i>
                                    {{ $badge['text'] }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom -->
        <div class="border-t border-accent-500 border-opacity-30 py-8">
            <div class="flex flex-col lg:flex-row justify-between items-center gap-4">
                <div class="flex flex-wrap gap-6 text-sm">
                    @foreach ($footer->legal_links as $link)
                        <a href="{{ $link['url'] }}" class="text-gray-300 hover:text-white">{{ $link['text'] }}</a>
                    @endforeach
                </div>
                <div class="text-gray-300 text-sm text-center lg:text-right">
                    <p>{{ $footer->copyright_text }}</p>
                    <p class="text-xs mt-1 opacity-80">{{ $footer->footer_note }}</p>
                </div>
            </div>
            <div class="mt-6 pt-6 border-t border-gray-600 border-opacity-30">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-gray-400">
                    <p>FinExpert is a registered trademark. All loan products subject to credit approval.</p>
                    <div class="flex items-center gap-4">
                        <span>Follow us:</span>
                        <div class="flex gap-2">
                            <a href="{{ $footer->linkedin }}" class="text-gray-400 hover:text-accent-400"><i
                                    class="fab fa-linkedin"></i></a>
                            <a href="{{ $footer->twitter }}" class="text-gray-400 hover:text-accent-400"><i
                                    class="fab fa-twitter"></i></a>
                            <a href="{{ $footer->facebook }}" class="text-gray-400 hover:text-accent-400"><i
                                    class="fab fa-facebook"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll to Top -->
    <button id="scrollTopBtn"
        class="scroll-top-btn fixed bottom-8 right-8 w-12 h-12 bg-accent-500 rounded-full flex items-center justify-center text-white shadow-lg hover:shadow-xl transition-all duration-300 hidden z-50">
        <i class="fas fa-chevron-up"></i>
    </button>
</footer>

<script>
    document.getElementById('newsletterForm').addEventListener('submit', async function(e) {
        e.preventDefault();

        const form = this;
        const messageEl = document.getElementById('newsletterMessage');
        const submitBtn = form.querySelector('button[type="submit"]');
        const submitText = document.getElementById('submitText');
        const submitSpinner = document.getElementById('submitSpinner');

        // Get form data
        const formData = new FormData(form);
        const email = formData.get('email');

        // Validate email
        if (!validateEmail(email)) {
            showMessage('Please enter a valid email address', 'error');
            return;
        }

        // Show loading state
        submitText.textContent = 'Subscribing...';
        submitSpinner.classList.remove('hidden');
        submitBtn.disabled = true;

        try {
            const response = await fetch('{{ route('newsletter.subscribe') }}', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                },
                body: formData
            });

            const data = await response.json();

            if (data.success) {
                showMessage(data.message, 'success');
                form.reset();
            } else {
                showMessage(data.message || 'Subscription failed. Please try again.', 'error');
            }
        } catch (error) {
            console.error('Newsletter subscription error:', error);
            showMessage('Network error. Please check your connection and try again.', 'error');
        } finally {
            // Reset button state
            submitText.textContent = 'Subscribe';
            submitSpinner.classList.add('hidden');
            submitBtn.disabled = false;
        }
    });

    function showMessage(message, type) {
        const messageEl = document.getElementById('newsletterMessage');
        messageEl.textContent = message;
        messageEl.className = 'mt-4 text-sm min-h-6 transition-all duration-300 ';

        if (type === 'success') {
            messageEl.classList.add('text-green-400');
        } else if (type === 'error') {
            messageEl.classList.add('text-red-400');
        } else {
            messageEl.classList.add('text-gray-300');
        }

        // Auto-hide success messages after 5 seconds
        if (type === 'success') {
            setTimeout(() => {
                messageEl.textContent = '';
                messageEl.className = 'mt-4 text-sm min-h-6';
            }, 5000);
        }
    }

    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    // Scroll to top functionality remains the same
    const scrollBtn = document.getElementById('scrollTopBtn');
    window.addEventListener('scroll', () => {
        scrollBtn.classList.toggle('hidden', window.scrollY < 300);
    });
    scrollBtn.addEventListener('click', () => window.scrollTo({
        top: 0,
        behavior: 'smooth'
    }));
</script>

<style>
    .footer-gradient {
        @apply bg-gradient-to-br from-primary-800 via-primary-900 to-accent-900;
    }

    .newsletter-input::placeholder {
        @apply text-gray-400;
    }
</style>
