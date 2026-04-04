@php $footer = \App\Models\FooterSection::first(); @endphp

<footer
    class="bg-gradient-to-br from-primary-primary via-primary-800 to-primary-700 text-white relative overflow-hidden">
    <!-- Background Elements -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-10 left-10 w-32 h-32 bg-primary-accent rounded-full animate-float"></div>
        <div class="absolute top-20 right-20 w-24 h-24 bg-primary-secondary rounded-full animate-float"
            style="animation-delay: 2s;"></div>
        <div class="absolute bottom-20 left-1/4 w-20 h-20 bg-primary-accent rounded-full animate-float"
            style="animation-delay: 4s;"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="py-12 lg:py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

                <!-- Brand Column -->
                <div class="animate-fade-in-up">
                    <div class="flex items-center gap-2 mb-3">
                        <div
                            class="w-10 h-10 bg-primary-accent rounded-lg flex items-center justify-center text-primary-primary font-bold text-lg overflow-hidden">
                            @if ($footer->logo)
                                <img src="{{ asset('storage/' . $footer->logo) }}" alt="Logo"
                                    class="w-full h-full object-cover">
                            @else
                                <span>{{ substr($footer->brand_name, 0, 1) }}</span>
                            @endif
                        </div>
                        <span class="text-xl font-black">{{ $footer->brand_name }}</span>
                    </div>
                    <span class="text-primary-accent text-xs tracking-wider">{{ $footer->brand_tagline }}</span>
                    <p class="text-white/70 text-sm mt-3 leading-relaxed">{{ $footer->brand_description }}</p>

                    <div class="space-y-3 mt-5">
                        <div class="flex items-center gap-3">
                            <div class="w-7 h-7 bg-primary-accent/20 rounded-full flex items-center justify-center">
                                <i class="fas fa-envelope text-primary-accent text-xs"></i>
                            </div>
                            <a href="mailto:{{ $footer->email }}"
                                class="text-white/70 hover:text-primary-accent text-sm transition">{{ $footer->email }}</a>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-7 h-7 bg-primary-accent/20 rounded-full flex items-center justify-center">
                                <i class="fas fa-map-marker-alt text-primary-accent text-xs"></i>
                            </div>
                            <span
                                class="text-white/70 text-sm">{{ $footer->address_line1 }}<br>{{ $footer->address_line2 }}</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-7 h-7 bg-primary-accent/20 rounded-full flex items-center justify-center">
                                <i class="fas fa-phone text-primary-accent text-xs"></i>
                            </div>
                            <a href="tel:{{ preg_replace('/[^0-9]/', '', $footer->phone) }}"
                                class="text-white/70 hover:text-primary-accent text-sm transition">{{ $footer->phone }}</a>
                        </div>
                    </div>

                    <div class="flex gap-2 mt-5">
                        <a href="{{ $footer->facebook }}"
                            class="w-8 h-8 bg-white/10 rounded-full flex items-center justify-center text-white/70 hover:bg-primary-accent hover:text-primary-primary transition-all duration-300">
                            <i class="fab fa-facebook-f text-xs"></i>
                        </a>
                        <a href="{{ $footer->twitter }}"
                            class="w-8 h-8 bg-white/10 rounded-full flex items-center justify-center text-white/70 hover:bg-primary-accent hover:text-primary-primary transition-all duration-300">
                            <i class="fab fa-twitter text-xs"></i>
                        </a>
                        <a href="{{ $footer->linkedin }}"
                            class="w-8 h-8 bg-white/10 rounded-full flex items-center justify-center text-white/70 hover:bg-primary-accent hover:text-primary-primary transition-all duration-300">
                            <i class="fab fa-linkedin-in text-xs"></i>
                        </a>
                        <a href="{{ $footer->instagram }}"
                            class="w-8 h-8 bg-white/10 rounded-full flex items-center justify-center text-white/70 hover:bg-primary-accent hover:text-primary-primary transition-all duration-300">
                            <i class="fab fa-instagram text-xs"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="animate-fade-in-up" style="animation-delay: 0.1s">
                    <h4 class="text-lg font-bold text-primary-accent mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        @foreach ($footer->quick_links as $link)
                            <li>
                                <a href="{{ $link['url'] }}"
                                    class="text-white/60 hover:text-primary-accent text-sm flex items-center gap-2 group transition">
                                    <i
                                        class="fas fa-chevron-right text-primary-accent text-xs group-hover:translate-x-1 transition-transform"></i>
                                    {{ $link['text'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Resources -->
                <div class="animate-fade-in-up" style="animation-delay: 0.2s">
                    <h4 class="text-lg font-bold text-primary-accent mb-4">Resources</h4>
                    <ul class="space-y-2">
                        @foreach ($footer->resources as $res)
                            <li>
                                <a href="{{ $res['url'] }}"
                                    class="text-white/60 hover:text-primary-accent text-sm flex items-center gap-2 group transition">
                                    <i
                                        class="fas fa-chevron-right text-primary-accent text-xs group-hover:translate-x-1 transition-transform"></i>
                                    {{ $res['text'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Newsletter -->
                <div class="animate-fade-in-up" style="animation-delay: 0.3s">
                    <h4 class="text-lg font-bold text-primary-accent mb-3">{{ $footer->newsletter_heading }}</h4>
                    <p class="text-white/60 text-sm mb-4">{{ $footer->newsletter_description }}</p>

                    <form id="newsletterForm" class="space-y-3">
                        @csrf
                        <input type="email" name="email" placeholder="Your email address" required
                            class="w-full px-4 py-2.5 bg-white/10 border border-white/20 rounded-lg text-white placeholder-white/40 text-sm focus:outline-none focus:border-primary-accent focus:ring-1 focus:ring-primary-accent transition">
                        <button type="submit"
                            class="w-full py-2.5 bg-primary-accent text-primary-primary font-bold rounded-lg hover:bg-primary-secondary transition-all duration-300 flex items-center justify-center gap-2 text-sm">
                            <i class="fas fa-paper-plane"></i>
                            <span id="submitText">Subscribe</span>
                            <div id="submitSpinner" class="hidden">
                                <i class="fas fa-spinner fa-spin"></i>
                            </div>
                        </button>
                    </form>
                    <div id="newsletterMessage" class="mt-3 text-xs min-h-6 transition-all duration-300"></div>

                    <div class="mt-6 pt-5 border-t border-white/10">
                        <h5 class="text-primary-accent font-semibold text-sm mb-3">Trust & Security</h5>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($footer->trust_badges as $badge)
                                <div class="bg-white/10 px-3 py-1.5 rounded-lg text-xs text-white/70">
                                    <i class="fas {{ $badge['icon'] }} text-primary-accent mr-1"></i>
                                    {{ $badge['text'] }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="border-t border-white/10 py-6">
            <div class="flex flex-col lg:flex-row justify-between items-center gap-4">
                <div class="flex flex-wrap gap-5 text-xs">
                    @foreach ($footer->legal_links as $link)
                        <a href="{{ $link['url'] }}"
                            class="text-white/50 hover:text-primary-accent transition">{{ $link['text'] }}</a>
                    @endforeach
                </div>
                <div class="text-white/40 text-xs text-center">
                    <p>{{ $footer->copyright_text }}</p>
                    <p class="text-xs mt-1 opacity-60">{{ $footer->footer_note }}</p>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-white/5">
                <div class="flex flex-col md:flex-row justify-between items-center gap-3 text-xs text-white/30">
                    <p>LondaLoan is a registered trademark. All loan products subject to credit approval.</p>
                    <div class="flex items-center gap-3">
                        <span>Follow us:</span>
                        <div class="flex gap-2">
                            <a href="{{ $footer->linkedin }}" class="hover:text-primary-accent transition"><i
                                    class="fab fa-linkedin"></i></a>
                            <a href="{{ $footer->twitter }}" class="hover:text-primary-accent transition"><i
                                    class="fab fa-twitter"></i></a>
                            <a href="{{ $footer->facebook }}" class="hover:text-primary-accent transition"><i
                                    class="fab fa-facebook"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll to Top Button -->
    <button id="scrollTopBtn"
        class="fixed bottom-6 right-6 w-10 h-10 bg-primary-accent rounded-full flex items-center justify-center text-primary-primary shadow-lg hover:bg-primary-secondary hover:scale-110 transition-all duration-300 hidden z-50">
        <i class="fas fa-chevron-up text-sm"></i>
    </button>
</footer>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Newsletter Form
        const newsletterForm = document.getElementById('newsletterForm');

        if (newsletterForm) {
            newsletterForm.addEventListener('submit', async function(e) {
                e.preventDefault();

                const form = this;
                const messageEl = document.getElementById('newsletterMessage');
                const submitBtn = form.querySelector('button[type="submit"]');
                const submitText = document.getElementById('submitText');
                const submitSpinner = document.getElementById('submitSpinner');
                const formData = new FormData(form);
                const email = formData.get('email');

                if (!validateEmail(email)) {
                    showMessage('Please enter a valid email address', 'error');
                    return;
                }

                submitText.textContent = 'Subscribing...';
                submitSpinner.classList.remove('hidden');
                submitBtn.disabled = true;

                try {
                    const response = await fetch('{{ route('newsletter.subscribe') }}', {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]')
                                .value
                        },
                        body: formData
                    });

                    const data = await response.json();

                    if (data.success) {
                        showMessage(data.message, 'success');
                        form.reset();
                    } else {
                        showMessage(data.message || 'Subscription failed. Please try again.',
                            'error');
                    }
                } catch (error) {
                    console.error('Newsletter subscription error:', error);
                    showMessage('Network error. Please check your connection and try again.',
                        'error');
                } finally {
                    submitText.textContent = 'Subscribe';
                    submitSpinner.classList.add('hidden');
                    submitBtn.disabled = false;
                }
            });
        }

        function showMessage(message, type) {
            const messageEl = document.getElementById('newsletterMessage');
            if (!messageEl) return;

            messageEl.textContent = message;
            messageEl.className = 'mt-3 text-xs min-h-6 transition-all duration-300 ';

            if (type === 'success') {
                messageEl.classList.add('text-green-400');
                setTimeout(() => {
                    messageEl.textContent = '';
                    messageEl.className = 'mt-3 text-xs min-h-6';
                }, 5000);
            } else if (type === 'error') {
                messageEl.classList.add('text-red-400');
            }
        }

        function validateEmail(email) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
        }

        // Scroll to Top Button
        const scrollBtn = document.getElementById('scrollTopBtn');

        if (scrollBtn) {
            window.addEventListener('scroll', () => {
                scrollBtn.classList.toggle('hidden', window.scrollY < 300);
            });

            scrollBtn.addEventListener('click', () => {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        }
    });
</script>

<style>
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
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-20px);
        }
    }

    .animate-fade-in-up {
        animation: fadeInUp 0.5s ease-out forwards;
        opacity: 0;
    }

    .animate-float {
        animation: float 6s ease-in-out infinite;
    }
</style>
