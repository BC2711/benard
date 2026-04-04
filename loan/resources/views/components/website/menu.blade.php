<!-- Header -->
<header id="header" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300" role="banner">
    <div class="bg-white/95 backdrop-blur-lg shadow-md border-b border-primary-100">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="flex items-center justify-between h-16 lg:h-20">

                <!-- Logo Section -->
                <a href="/" class="flex items-center gap-2 group" aria-label="Londa Loans Homepage">
                    <div class="relative">
                        <div
                            class="w-10 h-10 lg:w-12 lg:h-12 bg-gradient-to-br from-primary-primary to-primary-secondary rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300 overflow-hidden">
                            <img src="{{ asset('assets/logos/londa.jpg') }}" alt="Londa Loans Logo"
                                class="w-full h-full object-cover rounded-xl">
                        </div>
                        <div
                            class="absolute -inset-1 bg-gradient-to-r from-primary-primary to-primary-secondary rounded-xl blur opacity-30 group-hover:opacity-50 transition-opacity duration-300">
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <div class="flex items-baseline gap-0.5">
                            <span class="text-xl lg:text-2xl font-black text-primary-primary">Londa</span>
                            <span class="text-xl lg:text-2xl font-black text-primary-secondary">Loans</span>
                        </div>
                        <div class="hidden lg:flex items-center gap-1 text-xs">
                            <span class="text-primary-secondary font-semibold">Ma Loans Yama Londa!</span>
                            <span class="text-primary-primary/40">•</span>
                            <span class="text-primary-primary/60">empowering marketeers</span>
                        </div>
                    </div>
                </a>

                <!-- Desktop Navigation -->
                <nav class="hidden lg:flex items-center gap-6" role="navigation" aria-label="Main navigation">
                    <a href="/" class="nav-link text-primary-primary font-semibold relative group">
                        Home
                        <span
                            class="absolute -bottom-1 left-0 w-full h-0.5 bg-primary-secondary transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 rounded-full"></span>
                    </a>
                    <a href="/#about"
                        class="nav-link text-gray-600 hover:text-primary-primary font-medium transition-colors duration-300">
                        About
                    </a>
                    <a href="/#features"
                        class="nav-link text-gray-600 hover:text-primary-primary font-medium transition-colors duration-300">
                        Features
                    </a>
                    <a href="/#services"
                        class="nav-link text-gray-600 hover:text-primary-primary font-medium transition-colors duration-300">
                        Services
                    </a>
                    <a href="/#support"
                        class="nav-link text-gray-600 hover:text-primary-primary font-medium transition-colors duration-300">
                        Contact
                    </a>
                </nav>

                <!-- Desktop Actions -->
                <div class="hidden lg:flex items-center gap-3">
                    <a href="{{ route('login') }}"
                        class="bg-primary-primary text-white px-5 py-2.5 rounded-xl font-semibold shadow-md hover:shadow-lg hover:bg-primary-secondary transition-all duration-300 hover:scale-105 flex items-center gap-2">
                        <i class="fas fa-sign-in-alt text-sm"></i>
                        <span>Sign In</span>
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-button"
                    class="lg:hidden w-10 h-10 flex flex-col items-center justify-center gap-1.5 relative group"
                    aria-label="Toggle navigation" aria-expanded="false">
                    <span class="w-6 h-0.5 bg-primary-primary rounded-full transition-all duration-300"></span>
                    <span class="w-6 h-0.5 bg-primary-primary rounded-full transition-all duration-300"></span>
                    <span class="w-6 h-0.5 bg-primary-primary rounded-full transition-all duration-300"></span>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div id="mobile-menu"
            class="lg:hidden bg-white/98 backdrop-blur-lg border-t border-primary-100 shadow-xl transform origin-top transition-all duration-300 scale-y-0 opacity-0 absolute top-full left-0 right-0">
            <div class="container mx-auto px-4 py-5">
                <nav class="flex flex-col gap-2">
                    <a href="/"
                        class="flex items-center gap-3 p-3 rounded-xl bg-primary-50 text-primary-primary font-semibold border-l-4 border-primary-secondary">
                        <i class="fas fa-home text-primary-secondary w-5"></i>
                        <span>Home</span>
                    </a>
                    <a href="/#about"
                        class="flex items-center gap-3 p-3 rounded-xl text-gray-600 hover:text-primary-primary hover:bg-primary-50 transition-all duration-300">
                        <i class="fas fa-info-circle text-gray-400 w-5"></i>
                        <span>About</span>
                    </a>
                    <a href="/#features"
                        class="flex items-center gap-3 p-3 rounded-xl text-gray-600 hover:text-primary-primary hover:bg-primary-50 transition-all duration-300">
                        <i class="fas fa-star text-gray-400 w-5"></i>
                        <span>Features</span>
                    </a>
                    <a href="/#services"
                        class="flex items-center gap-3 p-3 rounded-xl text-gray-600 hover:text-primary-primary hover:bg-primary-50 transition-all duration-300">
                        <i class="fas fa-hand-holding-usd text-gray-400 w-5"></i>
                        <span>Services</span>
                    </a>
                    <a href="/#support"
                        class="flex items-center gap-3 p-3 rounded-xl text-gray-600 hover:text-primary-primary hover:bg-primary-50 transition-all duration-300">
                        <i class="fas fa-envelope text-gray-400 w-5"></i>
                        <span>Contact</span>
                    </a>
                </nav>

                <!-- Mobile Actions -->
                <div class="mt-5 pt-5 border-t border-primary-100">
                    <a href="{{ route('login') }}"
                        class="w-full bg-primary-primary text-white py-3 rounded-xl font-semibold shadow-md hover:bg-primary-secondary transition-all duration-300 hover:scale-105 flex items-center justify-center gap-2">
                        <i class="fas fa-sign-in-alt"></i>
                        <span>Sign In</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>

<style>
    /* Nav link styles */
    .nav-link {
        position: relative;
        transition: color 0.3s ease;
    }

    /* Header scroll effect */
    .header-scrolled {
        background: rgba(255, 255, 255, 0.98);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }

    /* Mobile menu animation */
    #mobile-menu-button[aria-expanded="true"] span:first-child {
        transform: translateY(7px) rotate(45deg);
    }

    #mobile-menu-button[aria-expanded="true"] span:nth-child(2) {
        opacity: 0;
    }

    #mobile-menu-button[aria-expanded="true"] span:last-child {
        transform: translateY(-7px) rotate(-45deg);
    }

    /* Scale Y animation for mobile menu */
    .scale-y-0 {
        transform: scaleY(0);
    }

    .scale-y-100 {
        transform: scaleY(1);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mobile menu toggle
        const menuBtn = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        if (menuBtn && mobileMenu) {
            menuBtn.addEventListener('click', function() {
                const expanded = this.getAttribute('aria-expanded') === 'true' ? false : true;
                this.setAttribute('aria-expanded', expanded);

                if (expanded) {
                    mobileMenu.classList.remove('scale-y-0', 'opacity-0');
                    mobileMenu.classList.add('scale-y-100', 'opacity-100');
                    document.body.style.overflow = 'hidden';
                } else {
                    mobileMenu.classList.remove('scale-y-100', 'opacity-100');
                    mobileMenu.classList.add('scale-y-0', 'opacity-0');
                    document.body.style.overflow = '';
                }
            });

            // Close mobile menu when clicking a link
            const mobileLinks = mobileMenu.querySelectorAll('a');
            mobileLinks.forEach(link => {
                link.addEventListener('click', function() {
                    menuBtn.setAttribute('aria-expanded', 'false');
                    mobileMenu.classList.remove('scale-y-100', 'opacity-100');
                    mobileMenu.classList.add('scale-y-0', 'opacity-0');
                    document.body.style.overflow = '';
                });
            });
        }

        // Header scroll effect
        const header = document.getElementById('header');
        let lastScroll = 0;

        window.addEventListener('scroll', function() {
            const currentScroll = window.pageYOffset;

            if (currentScroll > 50) {
                header.classList.add('header-scrolled');
                if (currentScroll > lastScroll && currentScroll > 100) {
                    header.style.transform = 'translateY(-100%)';
                } else {
                    header.style.transform = 'translateY(0)';
                }
            } else {
                header.classList.remove('header-scrolled');
                header.style.transform = 'translateY(0)';
            }
            lastScroll = currentScroll;
        });

        // Close mobile menu on window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024) {
                if (mobileMenu) {
                    mobileMenu.classList.remove('scale-y-100', 'opacity-100');
                    mobileMenu.classList.add('scale-y-0', 'opacity-0');
                    document.body.style.overflow = '';
                }
                if (menuBtn) {
                    menuBtn.setAttribute('aria-expanded', 'false');
                }
            }
        });
    });
</script>
