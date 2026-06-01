@php
    $ss = \App\Models\SuccessStoriesSection::firstOrNew([], [
        'heading' => 'Customer success stories',
        'description' => 'See how growing businesses are using flexible funding to move forward.',
        'stats' => [],
        'cta_heading' => 'Ready to create your success story?',
        'cta_description' => 'Talk to our team about funding that fits your business.',
        'cta_primary_text' => 'Apply for Funding',
        'cta_primary_link' => '/consultation',
        'cta_primary_icon' => 'fa-paper-plane',
        'cta_secondary_text' => 'View All Success Stories',
        'cta_secondary_link' => '/success-stories',
        'cta_secondary_icon' => 'fa-book-open',
    ]);
    $stories = app(\App\Services\SuccessStoryService::class)->homepage();
@endphp

<section id="success-stories" class="relative overflow-hidden bg-gradient-to-br from-primary-50 to-white py-20">
    <div class="container relative z-10 mx-auto px-4">
        <div class="mx-auto mb-12 max-w-3xl text-center">
            <p class="text-sm font-bold uppercase tracking-wider text-primary-secondary">Success Stories</p>
            <h2 class="mt-4 text-3xl font-black text-primary-primary lg:text-5xl">{{ $ss->heading }}</h2>
            <p class="mt-4 text-lg leading-relaxed text-gray-600">{{ $ss->description }}</p>
        </div>

        @if (!empty($ss->stats))
            <div class="mx-auto mb-12 grid max-w-5xl grid-cols-2 gap-4 md:grid-cols-4">
                @foreach ($ss->stats as $stat)
                    <div class="rounded-xl border border-primary-100 bg-white p-5 text-center shadow-lg">
                        <div class="text-3xl font-black text-primary-secondary">{{ $stat['value'] }}</div>
                        <div class="mt-1 text-sm font-semibold text-gray-500">{{ $stat['label'] }}</div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="mx-auto grid max-w-7xl gap-8 md:grid-cols-2 lg:grid-cols-3">
            @forelse ($stories as $story)
                @include('components.website.success-story-card', ['story' => $story])
            @empty
                <div class="col-span-full rounded-2xl border border-primary-100 bg-white p-10 text-center text-gray-500">
                    Published homepage stories will appear here.
                </div>
            @endforelse
        </div>

        <div class="mx-auto mt-12 max-w-4xl rounded-2xl bg-gradient-to-br from-primary-primary to-primary-700 p-8 text-center shadow-2xl">
            <h3 class="text-2xl font-bold text-white">{{ $ss->cta_heading }}</h3>
            <p class="mx-auto mt-3 max-w-2xl text-white/80">{{ $ss->cta_description }}</p>
            <div class="mt-6 flex flex-wrap justify-center gap-4">
                <a href="{{ $ss->cta_primary_link }}" class="rounded-xl bg-white px-6 py-3 font-bold text-primary-primary"><i class="fas {{ $ss->cta_primary_icon }} mr-2"></i>{{ $ss->cta_primary_text }}</a>
                <a href="/success-stories" class="rounded-xl border-2 border-white px-6 py-3 font-bold text-white"><i class="fas {{ $ss->cta_secondary_icon }} mr-2"></i>View All Success Stories</a>
            </div>
        </div>
    </div>
</section>
