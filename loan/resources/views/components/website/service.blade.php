@php $svc = \App\Models\ServiceSection::first(); @endphp

<section class="gradient-service-bg py-20 lg:py-28 relative overflow-hidden" id="services">
    <!-- Background -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-0 left-0 w-72 h-72 bg-primary-primary/5 rounded-full blur-3xl animate-float"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-secondary-secondary/5 rounded-full blur-3xl animate-float" style="animation-delay:2s;"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-accent-accent/5 rounded-full blur-3xl"></div>
    </div>

    <div class="container mx-auto px-4 lg:px-8 relative z-10">

        <!-- Header -->
        <div class="text-center max-w-4xl mx-auto mb-16 lg:mb-20 animate-fade-in-up">
            <div class="inline-flex items-center space-x-2 bg-primary-primary/10 text-primary-primary px-4 py-2 rounded-full text-sm font-semibold uppercase tracking-wider mb-6 border border-primary-primary/20">
                <i class="fas {{ $svc->badge_icon }} text-xs"></i>
                <span>{{ $svc->badge_text }}</span>
            </div>
            <h2 class="text-4xl lg:text-5xl xl:text-6xl font-bold text-secondary-secondary mb-6 leading-tight">
                {{ $svc->heading }}
                <span class="text-gradient">{{ $svc->highlighted_text }}</span>
            </h2>
            <p class="text-xl text-gray-600 leading-relaxed max-w-3xl mx-auto">{{ $svc->description }}</p>
        </div>

        <!-- Services Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-20">
            @foreach($svc->services as $i => $s)
                <div class="group bg-white rounded-3xl p-8 shadow-xl card-hover animate-fade-in-up border border-gray-100 relative overflow-hidden"
                     style="animation-delay:{{ ($i+1)*100 }}ms">
                    <div class="absolute top-0 left-0 w-full h-1 {{ $s['tag_color'] === 'secondary' ? 'bg-secondary-secondary' : 'bg-primary-primary' }}"></div>
                    <div class="relative mb-6">
                        <div class="w-20 h-20 bg-gradient-to-br from-primary-primary to-accent-accent rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-lg">
                            <i class="fas {{ $s['icon'] }} text-white text-2xl"></i>
                        </div>
                        <div class="absolute -top-2 -right-2 w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-lg">
                            <div class="w-3 h-3 bg-primary-primary rounded-full animate-pulse"></div>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-secondary-secondary mb-4 group-hover:text-primary-primary transition-colors duration-300">
                        {{ $s['title'] }}
                    </h3>
                    <p class="text-gray-600 leading-relaxed mb-6">{{ $s['desc'] }}</p>
                    <div class="flex items-center justify-between">
                        {{-- <a href="#" class="flex items-center text-primary-primary font-semibold text-sm group-hover:translate-x-1 transition-transform duration-300">
                            <span>Learn more</span>
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                        <div class="text-xs font-semibold {{ $s['tag_color'] === 'secondary' ? 'text-secondary-secondary bg-secondary-secondary/10' : 'text-primary-primary bg-primary-primary/10' }} px-3 py-1 rounded-full">
                            {{ $s['tag'] }}
                        </div> --}}
                    </div>
                </div>
            @endforeach
        </div>

        <!-- CTA Section -->
        <div class="bg-gradient-to-br from-primary-primary to-primary-primary rounded-3xl p-8 lg:p-12 shadow-2xl relative overflow-hidden">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-0 left-0 w-64 h-64 bg-white rounded-full -translate-x-1/2 -translate-y-1/2"></div>
                <div class="absolute bottom-0 right-0 w-96 h-96 bg-white rounded-full translate-x-1/2 translate-y-1/2"></div>
            </div>

            <div class="relative z-10 text-center max-w-4xl mx-auto">
                <h3 class="text-3xl lg:text-4xl font-bold text-white mb-4 animate-fade-in-up" style="animation-delay:100ms">
                    {{ $svc->cta_heading }}
                </h3>
                <p class="text-xl text-white/80 mb-8 animate-fade-in-up" style="animation-delay:200ms">
                    {{ $svc->cta_description }}
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center animate-fade-in-up" style="animation-delay:300ms">
                    <a href="{{ $svc->cta_primary_link }}"
                       class="group bg-white text-secondary-secondary px-8 py-4 rounded-2xl font-bold text-lg shadow-2xl hover:bg-gray-50 transition-all duration-300 hover:scale-105 flex items-center space-x-2 animate-pulse-glow">
                        <i class="fas {{ $svc->cta_primary_icon }}"></i>
                        <span>{{ $svc->cta_primary_text }}</span>
                        <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform duration-300"></i>
                    </a>
                    <a href="{{ $svc->cta_secondary_link }}"
                       class="group border-2 border-white text-white px-8 py-4 rounded-2xl font-bold text-lg hover:bg-white hover:text-secondary-secondary transition-all duration-300 hover:scale-105 flex items-center space-x-2">
                        <i class="fas {{ $svc->cta_secondary_icon }}"></i>
                        <span>{{ $svc->cta_secondary_text }}</span>
                    </a>
                </div>

                <!-- Extra Info -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-12 pt-8 border-t border-white/20">
                    @for($i=1;$i<=3;$i++)
                    <div class="text-center animate-fade-in-up" style="animation-delay:{{ ($i*100)+300 }}ms">
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mx-auto mb-3">
                            <i class="fas {{ $svc["info_{$i}_icon"] }} text-white text-xl"></i>
                        </div>
                        <div class="text-white font-semibold">{{ $svc["info_{$i}_title"] }}</div>
                        <div class="text-white/70 text-sm">{{ $svc["info_{$i}_subtitle"] }}</div>
                    </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</section>