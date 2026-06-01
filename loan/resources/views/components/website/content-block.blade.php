@php
    $content = $sectionContent ?? [];
    $eyebrow = $content['eyebrow'] ?? $cmsSection->name;
    $title = $content['title'] ?? $cmsSection->name;
    $body = $content['body'] ?? $content['description'] ?? null;
    $items = $content['items'] ?? [];
    $cta = $content['cta'] ?? null;
    $image = $content['image'] ?? null;
    $video = $content['video'] ?? null;
    $background = $sectionSettings['background'] ?? null;
    $textColor = $sectionSettings['text_color'] ?? null;
@endphp

<section id="{{ $cmsSection->section_key }}" class="py-20" @style(['background: ' . $background => $background, 'color: ' . $textColor => $textColor])>
    <div class="premium-shell">
        <div class="premium-card rounded-3xl p-6 sm:p-10">
            <div class="max-w-3xl">
                <p class="premium-eyebrow">{{ $eyebrow }}</p>
                <h2 class="mt-5 text-3xl font-black tracking-tight text-slate-950 sm:text-4xl">{{ $title }}</h2>
                @if ($body)
                    <div class="mt-4 max-w-2xl text-base leading-8 text-slate-600">{!! $body !!}</div>
                @endif
            </div>

            @if ($image)
                <img src="{{ asset($image) }}" alt="{{ $content['image_alt'] ?? $title }}" class="mt-8 max-h-[32rem] w-full rounded-3xl object-cover">
            @endif

            @if ($video)
                <div class="mt-8 aspect-video overflow-hidden rounded-3xl bg-slate-950">
                    <iframe class="h-full w-full" src="{{ $video }}" title="{{ $title }}" loading="lazy" allowfullscreen></iframe>
                </div>
            @endif

            @if (!empty($items))
                <div class="mt-8 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($items as $item)
                        <article class="rounded-2xl border border-slate-200 bg-white p-5">
                            @if (!empty($item['icon']))
                                <i class="fas {{ $item['icon'] }} text-xl text-cyan-700"></i>
                            @endif
                            <h3 class="mt-3 font-black text-slate-950">{{ $item['title'] ?? 'Item' }}</h3>
                            <p class="mt-2 text-sm leading-6 text-slate-600">{{ $item['description'] ?? '' }}</p>
                            @if (!empty($item['image']))
                                <img src="{{ asset($item['image']) }}" alt="{{ $item['alt'] ?? ($item['title'] ?? '') }}" class="mt-4 h-36 w-full rounded-xl object-cover">
                            @endif
                            @if (!empty($item['value']))
                                <p class="mt-3 text-2xl font-black text-cyan-700">{{ $item['value'] }}</p>
                            @endif
                            @if (!empty($item['url']))
                                <a href="{{ $item['url'] }}" class="mt-3 inline-block text-sm font-bold text-cyan-700">{{ $item['link_text'] ?? 'Learn more' }}</a>
                            @endif
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
