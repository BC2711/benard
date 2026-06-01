@php
    $pageTitle = $story->title;
    $pageSeo = (object) [
        'meta_title' => $story->meta_title ?: $story->title . ' - Londa Loans',
        'meta_description' => $story->meta_description ?: $story->summary,
        'meta_keywords' => $story->meta_keywords,
        'og_image' => $story->og_image ?: $story->featured_image,
    ];
@endphp
@include('components.website.header')
@include('components.website.menu')
<div class="h-20"></div>
<main>
    <section class="bg-gradient-to-br from-primary-primary to-primary-700 py-16 text-white">
        <div class="container mx-auto max-w-5xl px-4">
            <p class="text-sm font-bold uppercase tracking-wider text-primary-accent">{{ $story->category?->name ?? 'Success story' }}</p>
            <h1 class="mt-4 text-4xl font-black lg:text-6xl">{{ $story->title }}</h1>
            <p class="mt-5 max-w-3xl text-lg leading-8 text-white/80">{{ $story->summary }}</p>
        </div>
    </section>
    <section class="bg-white py-14">
        <div class="container mx-auto grid max-w-6xl gap-8 px-4 lg:grid-cols-[1fr_20rem]">
            <article>
                @if ($story->featured_image)<img src="{{ $story->featured_image }}" alt="{{ $story->title }}" class="max-h-[34rem] w-full rounded-3xl object-cover">@endif
                <div class="prose mt-8 max-w-none text-gray-700">{!! $story->content !!}</div>
                @if (!empty($story->gallery))
                    <div class="mt-10 grid gap-4 sm:grid-cols-2">
                        @foreach ($story->gallery as $image)<img src="{{ $image }}" alt="{{ $story->title }} gallery image" class="h-56 w-full rounded-2xl object-cover">@endforeach
                    </div>
                @endif
                @if ($story->video_url)
                    <div class="mt-10 aspect-video overflow-hidden rounded-3xl bg-slate-950"><iframe class="h-full w-full" src="{{ $story->video_url }}" title="{{ $story->title }}" loading="lazy" allowfullscreen></iframe></div>
                @endif
            </article>
            <aside class="space-y-5">
                <div class="rounded-2xl bg-primary-50 p-5">
                    <h2 class="font-black text-primary-primary">Customer profile</h2>
                    @if ($story->customer_photo)<img src="{{ $story->customer_photo }}" alt="{{ $story->customer_name }}" class="mt-4 h-20 w-20 rounded-2xl object-cover">@endif
                    <p class="mt-4 font-bold">{{ $story->customer_name }}</p>
                    <p class="text-sm text-gray-500">{{ $story->customer_occupation }}</p>
                    <p class="text-sm text-gray-500">{{ $story->customer_company }}</p>
                    <p class="text-sm text-gray-500">{{ $story->customer_location }}</p>
                </div>
                <div class="rounded-2xl bg-primary-50 p-5">
                    <h2 class="font-black text-primary-primary">Success metrics</h2>
                    <div class="mt-4 space-y-3 text-sm">
                        @if ($story->loan_amount)<p><strong>Loan:</strong> {{ $story->currency }} {{ number_format($story->loan_amount, 2) }}</p>@endif
                        @if ($story->business_growth_percentage)<p><strong>Growth:</strong> {{ $story->business_growth_percentage }}%</p>@endif
                        @if ($story->revenue_increase)<p><strong>Revenue increase:</strong> {{ $story->currency }} {{ number_format($story->revenue_increase, 2) }}</p>@endif
                        @if ($story->jobs_created)<p><strong>Jobs created:</strong> {{ $story->jobs_created }}</p>@endif
                        @foreach ($story->custom_statistics ?? [] as $stat)<p><strong>{{ $stat['label'] ?? 'Metric' }}:</strong> {{ $stat['value'] ?? '' }}</p>@endforeach
                    </div>
                </div>
                <div class="rounded-2xl bg-primary-50 p-5">
                    <h2 class="font-black text-primary-primary">Share this story</h2>
                    <div class="mt-4 flex gap-3 text-primary-secondary">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" rel="noopener"><i class="fab fa-facebook text-xl"></i></a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($story->title) }}" target="_blank" rel="noopener"><i class="fab fa-twitter text-xl"></i></a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}" target="_blank" rel="noopener"><i class="fab fa-linkedin text-xl"></i></a>
                    </div>
                </div>
            </aside>
        </div>
    </section>
    @if ($relatedStories->isNotEmpty())
        <section class="bg-primary-50 py-14"><div class="container mx-auto max-w-6xl px-4"><h2 class="text-3xl font-black text-primary-primary">Related stories</h2><div class="mt-6 grid gap-6 md:grid-cols-3">@foreach ($relatedStories as $related) @include('components.website.success-story-card', ['story' => $related]) @endforeach</div></div></section>
    @endif
</main>
@include('components.website.footer')
@include('components.website.closing_header')
