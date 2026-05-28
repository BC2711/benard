@php
    $content = $sectionContent ?? [];
    $eyebrow = $content['eyebrow'] ?? $cmsSection->name;
    $title = $content['title'] ?? $cmsSection->name;
    $body = $content['body'] ?? $content['description'] ?? null;
    $items = $content['items'] ?? [];
    $cta = $content['cta'] ?? null;
@endphp

<section id="{{ $cmsSection->section_key }}" class="py-20">
    <div class="premium-shell">
        <div class="premium-card rounded-3xl p-6 sm:p-10">
            <div class="max-w-3xl">
                <p class="premium-eyebrow">{{ $eyebrow }}</p>
                <h2 class="mt-5 text-3xl font-black tracking-tight text-slate-950 sm:text-4xl">{{ $title }}</h2>
                @if ($body)
                    <div class="mt-4 max-w-2xl text-base leading-8 text-slate-600">{!! $body !!}</div>
                @endif
            </div>

            @if (!empty($items))
                <div class="mt-8 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($items as $item)
                        <article class="rounded-2xl border border-slate-200 bg-white p-5">
                            @if (!empty($item['icon']))
                                <i class="fas {{ $item['icon'] }} text-xl text-cyan-700"></i>
                            @endif
                            <h3 class="mt-3 font-black text-slate-950">{{ $item['title'] ?? 'Item' }}</h3>
                            <p class="mt-2 text-sm leading-6 text-slate-600">{{ $item['description'] ?? '' }}</p>
                        </article>
                    @endforeach
                </div>
            @endif

            @if (is_array($cta) && !empty($cta['text']))
                <a href="{{ $cta['url'] ?? '#' }}" class="premium-btn mt-8 px-6 py-3 text-sm">
                    <span>{{ $cta['text'] }}</span>
                    <i class="fas fa-arrow-right text-xs"></i>
                </a>
            @endif
        </div>
    </div>
</section>
