<header id="header" class="fixed inset-x-0 top-0 z-50 px-3 pt-3 lg:px-6" role="banner">
    <div data-premium-nav class="premium-nav mx-auto max-w-7xl rounded-2xl transition-all duration-300">
        <div class="flex h-16 items-center justify-between px-4 lg:h-18 lg:px-5">
            <a href="/" class="group flex items-center gap-3" aria-label="Londa Loans Homepage">
                <div class="relative grid h-11 w-11 place-items-center overflow-hidden rounded-2xl bg-white shadow-lg ring-1 ring-slate-900/10">
                    <img src="{{ asset('assets/logos/londa.jpg') }}" alt="Londa Loans Logo"
                        class="h-full w-full object-cover transition duration-300 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-br from-cyan-500/10 to-amber-400/20"></div>
                </div>
                <div class="leading-none">
                    <div class="flex items-baseline gap-1">
                        <span class="text-xl font-black tracking-tight text-slate-950">Londa</span>
                        <span class="text-xl font-black tracking-tight text-cyan-700">Loans</span>
                    </div>
                    <div class="mt-1 hidden items-center gap-2 text-xs font-semibold text-slate-500 sm:flex">
                        <span class="text-amber-600">Ma Loans Yama Londas!</span>
                        <span class="h-1 w-1 rounded-full bg-slate-300"></span>
                        <span>empowering marketeers</span>
                    </div>
                </div>
            </a>

            <nav class="hidden items-center gap-8 text-sm font-bold lg:flex" role="navigation" aria-label="Main navigation">
                <a href="/" class="premium-link">Home</a>
                <a href="/#about" class="premium-link">About</a>
                <a href="/#features" class="premium-link">Features</a>
                <a href="/#services" class="premium-link">Services</a>
                <a href="/calculator" class="premium-link">Calculator</a>
                <a href="/#support" class="premium-link">Contact</a>
            </nav>

            <div class="hidden items-center gap-3 lg:flex">
                <a href="/consultation" class="premium-btn-secondary px-5 text-sm">
                    <i class="fas fa-calendar-check text-cyan-700"></i>
                    <span>Consultation</span>
                </a>
                <a href="{{ route('login') }}" class="premium-btn px-5 text-sm">
                    <i class="fas fa-lock text-xs"></i>
                    <span>Sign In</span>
                </a>
            </div>

            <button data-mobile-menu-button
                class="group grid h-11 w-11 place-items-center rounded-2xl bg-white/80 text-slate-900 shadow-sm ring-1 ring-slate-900/10 transition hover:bg-white lg:hidden"
                aria-label="Toggle navigation" aria-expanded="false">
                <span class="relative h-4 w-5">
                    <span class="absolute left-0 top-0 h-0.5 w-5 rounded-full bg-current transition group-aria-expanded:top-1.5 group-aria-expanded:rotate-45"></span>
                    <span class="absolute left-0 top-1.5 h-0.5 w-5 rounded-full bg-current transition group-aria-expanded:opacity-0"></span>
                    <span class="absolute left-0 top-3 h-0.5 w-5 rounded-full bg-current transition group-aria-expanded:top-1.5 group-aria-expanded:-rotate-45"></span>
                </span>
            </button>
        </div>

        <div data-mobile-menu class="premium-mobile-panel absolute left-3 right-3 top-[82px] rounded-3xl border border-white/80 bg-white/95 p-4 shadow-2xl backdrop-blur-2xl lg:hidden">
            <nav class="grid gap-2 text-sm font-bold text-slate-700" aria-label="Mobile navigation">
                <a href="/" class="flex items-center gap-3 rounded-2xl bg-cyan-50 px-4 py-3 text-cyan-800">
                    <i class="fas fa-home w-5"></i>
                    <span>Home</span>
                </a>
                <a href="/#about" class="flex items-center gap-3 rounded-2xl px-4 py-3 transition hover:bg-slate-50">
                    <i class="fas fa-building-columns w-5 text-slate-400"></i>
                    <span>About</span>
                </a>
                <a href="/#features" class="flex items-center gap-3 rounded-2xl px-4 py-3 transition hover:bg-slate-50">
                    <i class="fas fa-star w-5 text-slate-400"></i>
                    <span>Features</span>
                </a>
                <a href="/#services" class="flex items-center gap-3 rounded-2xl px-4 py-3 transition hover:bg-slate-50">
                    <i class="fas fa-hand-holding-dollar w-5 text-slate-400"></i>
                    <span>Services</span>
                </a>
                <a href="/calculator" class="flex items-center gap-3 rounded-2xl px-4 py-3 transition hover:bg-slate-50">
                    <i class="fas fa-calculator w-5 text-slate-400"></i>
                    <span>Calculator</span>
                </a>
                <a href="/#support" class="flex items-center gap-3 rounded-2xl px-4 py-3 transition hover:bg-slate-50">
                    <i class="fas fa-envelope w-5 text-slate-400"></i>
                    <span>Contact</span>
                </a>
            </nav>

            <div class="mt-4 grid gap-3 border-t border-slate-200 pt-4">
                <a href="/consultation" class="premium-btn-secondary px-5 text-sm">
                    <i class="fas fa-calendar-check text-cyan-700"></i>
                    <span>Book Consultation</span>
                </a>
                <a href="{{ route('login') }}" class="premium-btn px-5 text-sm">
                    <i class="fas fa-lock text-xs"></i>
                    <span>Sign In</span>
                </a>
            </div>
        </div>
    </div>
</header>
