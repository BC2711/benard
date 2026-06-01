<section class="bg-gradient-to-br from-primary-primary to-primary-700 py-16 text-white">
    <div class="container mx-auto px-4 text-center">
        <p class="text-sm font-bold uppercase tracking-widest text-primary-accent">Customer outcomes</p>
        <h1 class="mt-4 text-4xl font-black lg:text-6xl">Success Stories</h1>
        <p class="mx-auto mt-4 max-w-3xl text-lg text-white/80">Explore how customers are growing their businesses with practical funding and focused support.</p>
    </div>
</section>

@if ($featuredStories->isNotEmpty())
    <section class="bg-primary-50 py-14">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl font-black text-primary-primary">Featured stories</h2>
            <div class="mt-6 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($featuredStories as $story) @include('components.website.success-story-card', ['story' => $story]) @endforeach
            </div>
        </div>
    </section>
@endif

<section class="bg-white py-14">
    <div class="container mx-auto px-4">
        <form class="grid gap-3 rounded-2xl border border-primary-100 bg-primary-50 p-4 md:grid-cols-[1fr_16rem_auto]">
            <input name="search" value="{{ request('search') }}" class="rounded-xl border border-primary-100 bg-white px-4 py-3" placeholder="Search success stories">
            <select name="category" class="rounded-xl border border-primary-100 bg-white px-4 py-3">
                <option value="">All categories</option>
                @foreach ($categories as $category)<option value="{{ $category->slug }}" @selected(request('category') === $category->slug)>{{ $category->name }}</option>@endforeach
            </select>
            <button class="rounded-xl bg-primary-primary px-5 py-3 font-bold text-white">Filter stories</button>
        </form>

        <div class="mt-10 flex items-end justify-between">
            <div>
                <p class="text-sm font-bold uppercase tracking-wider text-primary-secondary">Latest stories</p>
                <h2 class="mt-2 text-3xl font-black text-primary-primary">Customer growth in focus</h2>
            </div>
            <p class="text-sm text-gray-500">{{ $stories->total() }} stories</p>
        </div>
        <div class="mt-6 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @forelse ($stories as $story)
                @include('components.website.success-story-card', ['story' => $story])
            @empty
                <p class="col-span-full rounded-2xl bg-primary-50 p-8 text-center text-gray-500">No stories matched your search.</p>
            @endforelse
        </div>
        <div class="mt-8">{{ $stories->links() }}</div>
    </div>
</section>
