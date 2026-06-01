<article class="overflow-hidden rounded-2xl border border-primary-100 bg-white shadow-lg transition duration-300 hover:-translate-y-1 hover:shadow-2xl">
    <a href="{{ route('website.success-stories.show', $story) }}" class="block">
        @if ($story->featured_image)
            <img src="{{ $story->featured_image }}" alt="{{ $story->title }}" class="h-52 w-full object-cover">
        @else
            <div class="grid h-52 place-items-center bg-gradient-to-br from-primary-primary to-primary-700 p-6 text-center text-white">
                <div>
                    <i class="fas fa-chart-line text-3xl text-primary-accent"></i>
                    <p class="mt-3 text-xl font-black">{{ $story->customer_company ?: $story->customer_name }}</p>
                </div>
            </div>
        @endif
    </a>
    <div class="p-5">
        <div class="flex items-center justify-between gap-3 text-xs font-bold uppercase tracking-wide text-primary-secondary">
            <span>{{ $story->category?->name ?? 'Success story' }}</span>
            @if ($story->is_featured)<span class="rounded-full bg-amber-50 px-2 py-1 text-amber-700">Featured</span>@endif
        </div>
        <h3 class="mt-3 text-xl font-black text-primary-primary"><a href="{{ route('website.success-stories.show', $story) }}">{{ $story->title }}</a></h3>
        <p class="mt-3 line-clamp-3 text-sm leading-6 text-gray-500">{{ $story->summary }}</p>
        <div class="mt-4 flex items-center justify-between border-t border-primary-100 pt-4 text-sm">
            <span class="font-semibold text-gray-500">{{ $story->customer_name }}</span>
            <a href="{{ route('website.success-stories.show', $story) }}" class="font-bold text-primary-secondary">Read story <i class="fas fa-arrow-right ml-1 text-xs"></i></a>
        </div>
    </div>
</article>
