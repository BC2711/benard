@php
    $hero = \App\Models\HeroSection::firstOrNew([], [
        'brand_name' => 'Londa',
        'brand_tagline' => 'empowering marketeers',
        'heading' => 'Fast working capital for ambitious market businesses',
        'highlighted_text' => 'built for growth',
        'description' => 'Flexible, clear financing designed for Zambian marketeers, entrepreneurs, and small teams that need reliable capital without the friction.',
        'cta_text' => 'Get Started',
        'cta_link' => '/consultation',
        'phone_number' => '+260 965508033',
        'phone_label' => 'Talk to our team',
        'stat_1_value' => '500+',
        'stat_1_label' => 'Clients served',
        'stat_2_value' => '24h',
        'stat_2_label' => 'Fast review',
        'stat_3_value' => 'ZMW10M+',
        'stat_3_label' => 'Loans supported',
        'stat_4_value' => '98%',
        'stat_4_label' => 'Satisfaction',
        'card_title' => 'Business Growth',
        'card_description' => 'Capital planning, repayment clarity, and support in one modern lending experience.',
        'badge_1_icon' => 'fa-bolt',
        'badge_1_title' => 'Fast Review',
        'badge_1_subtitle' => '24 hours',
        'badge_2_icon' => 'fa-shield-halved',
        'badge_2_title' => 'Clear Terms',
        'badge_2_subtitle' => 'No surprises',
    ]);
@endphp

<section class="premium-hero relative min-h-screen overflow-hidden pb-16 pt-28 text-white lg:pt-36" aria-labelledby="hero-heading">
    <div class="pointer-events-none absolute inset-0 overflow-hidden">
        <div class="absolute left-0 top-28 h-px w-full bg-gradient-to-r from-transparent via-white/20 to-transparent"></div>
        <div class="absolute bottom-20 left-1/2 h-40 w-[52rem] -translate-x-1/2 -skew-y-6 bg-gradient-to-r from-cyan-400/10 via-white/5 to-amber-300/10 blur-2xl"></div>
    </div>

    <div class="premium-shell relative z-10">
        <div class="grid items-center gap-12 lg:grid-cols-[1.05fr_0.95fr] lg:gap-16">
            <div class="premium-reveal">
                <div class="premium-eyebrow border-white/15 bg-white/10 text-cyan-100">
                    <i class="fas fa-chart-line text-amber-300"></i>
                    <span>{{ $hero->brand_tagline }}</span>
                </div>

                <div class="mt-7 flex items-baseline gap-2">
                    <span class="text-2xl font-black tracking-tight text-white lg:text-3xl">{{ $hero->brand_name }}</span>
                    <span class="text-2xl font-black tracking-tight text-amber-300 lg:text-3xl">Loans</span>
                </div>

                <h1 id="hero-heading" class="mt-6 max-w-4xl text-4xl font-black leading-[1.02] tracking-tight sm:text-5xl lg:text-6xl">
                    {{ $hero->heading }}
                    <span class="premium-gradient-text block">{{ $hero->highlighted_text }}</span>
                </h1>

                <p class="mt-6 max-w-2xl text-base leading-8 text-slate-200 sm:text-lg">
                    {{ $hero->description }}
                </p>

                <div class="mt-9 flex flex-col gap-4 sm:flex-row">
                    <a href="{{ $hero->cta_link }}" class="premium-btn premium-gradient-shift px-7 py-3.5 text-sm">
                        <span>{{ $hero->cta_text }}</span>
                        <i class="fas fa-arrow-right text-xs"></i>
                    </a>
                    <a href="tel:{{ preg_replace('/\D/', '', $hero->phone_number) }}"
                        class="premium-btn-secondary border-white/15 bg-white/10 px-7 py-3.5 text-sm text-white hover:bg-white/15">
                        <i class="fas fa-phone text-amber-300"></i>
                        <span>{{ $hero->phone_number }}</span>
                    </a>
                </div>

                <div class="premium-stagger mt-10 grid grid-cols-2 gap-3 sm:grid-cols-4">
                    @foreach ([
                        [$hero->stat_1_value, $hero->stat_1_label],
                        [$hero->stat_2_value, $hero->stat_2_label],
                        [$hero->stat_3_value, $hero->stat_3_label],
                        [$hero->stat_4_value, $hero->stat_4_label],
                    ] as $stat)
                        <div class="rounded-2xl border border-white/10 bg-white/[0.07] p-4 backdrop-blur-xl">
                            <div class="text-2xl font-black text-white">{{ $stat[0] }}</div>
                            <div class="mt-1 text-xs font-bold uppercase tracking-wide text-slate-300">{{ $stat[1] }}</div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="premium-reveal relative">
                <div class="premium-card relative overflow-hidden rounded-[2rem] bg-white/12 p-4 text-slate-950">
                    <div class="rounded-[1.45rem] bg-white p-5 shadow-2xl">
                        <div class="relative aspect-[4/3] overflow-hidden rounded-[1.25rem] bg-gradient-to-br from-cyan-50 via-white to-amber-50">
                            @if ($hero->hero_image)
                                <img src="{{ asset('storage/' . $hero->hero_image) }}" alt="Londa Loans customer experience"
                                    class="h-full w-full object-cover">
                            @else
                                <img src="{{ asset('assets/images/hero.png') }}" alt="Londa Loans financial support"
                                    class="h-full w-full object-cover">
                            @endif
                            <div class="absolute inset-x-4 bottom-4 rounded-2xl bg-white/85 p-4 shadow-xl backdrop-blur-xl">
                                <div class="flex items-center justify-between gap-4">
                                    <div>
                                        <h2 class="text-lg font-black text-slate-950">{{ $hero->card_title }}</h2>
                                        <p class="mt-1 text-sm leading-5 text-slate-600">{{ $hero->card_description }}</p>
                                    </div>
                                    <div class="grid h-12 w-12 flex-none place-items-center rounded-2xl bg-cyan-700 text-white">
                                        <i class="fas fa-arrow-trend-up"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-5 grid grid-cols-2 gap-3">
                            <div class="rounded-2xl bg-slate-50 p-4">
                                <i class="fas {{ $hero->badge_1_icon }} text-cyan-700"></i>
                                <div class="mt-2 text-sm font-black">{{ $hero->badge_1_title }}</div>
                                <div class="text-xs font-semibold text-slate-500">{{ $hero->badge_1_subtitle }}</div>
                            </div>
                            <div class="rounded-2xl bg-slate-50 p-4">
                                <i class="fas {{ $hero->badge_2_icon }} text-amber-600"></i>
                                <div class="mt-2 text-sm font-black">{{ $hero->badge_2_title }}</div>
                                <div class="text-xs font-semibold text-slate-500">{{ $hero->badge_2_subtitle }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="premium-float absolute -left-4 top-8 hidden rounded-2xl border border-white/15 bg-white/10 p-4 shadow-2xl backdrop-blur-xl sm:block">
                    <div class="text-xs font-bold uppercase tracking-wide text-slate-200">{{ $hero->phone_label }}</div>
                    <div class="mt-1 text-sm font-black text-white">Human support</div>
                </div>
            </div>
        </div>
    </div>
</section>
