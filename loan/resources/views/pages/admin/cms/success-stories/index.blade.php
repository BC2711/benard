@extends('layouts.admin.main')

@section('title', 'Success Stories Management')
@section('page-title', 'Success Stories Management')
@section('page-description', 'Create, approve, feature, publish, and measure customer success stories.')
@section('page-icon')<i class="fas fa-trophy"></i>@endsection
@section('page-actions')
    <a href="{{ route('management.cms.success-stories.export', request()->query()) }}" class="inline-flex h-11 items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 text-sm font-bold text-slate-700 dark:border-slate-800 dark:bg-slate-900">
        <i class="fas fa-file-export"></i> Export CSV
    </a>
    <a href="{{ route('management.cms.success-stories.create') }}" class="inline-flex h-11 items-center gap-2 rounded-xl bg-brand-700 px-4 text-sm font-bold text-white shadow-soft">
        <i class="fas fa-plus"></i> New Story
    </a>
@endsection

@section('content')
    <section class="grid gap-6 xl:grid-cols-[1fr_20rem]">
        <div class="admin-card overflow-hidden">
            <form class="grid gap-3 border-b border-slate-200 p-5 md:grid-cols-5 dark:border-slate-800">
                <input name="search" value="{{ request('search') }}" class="admin-input h-11 px-3 md:col-span-2" placeholder="Search title or customer">
                <select name="status" class="admin-input h-11 px-3">
                    <option value="">All statuses</option>
                    @foreach (['draft', 'published', 'archived'] as $status)
                        <option value="{{ $status }}" @selected(request('status') === $status)>{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
                <select name="category" class="admin-input h-11 px-3">
                    <option value="">All categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected((string) request('category') === (string) $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
                <div class="flex gap-2">
                    <select name="featured" class="admin-input h-11 min-w-0 flex-1 px-3">
                        <option value="">All stories</option>
                        <option value="1" @selected(request('featured') === '1')>Featured</option>
                        <option value="0" @selected(request('featured') === '0')>Not featured</option>
                    </select>
                    <button class="rounded-xl bg-slate-900 px-4 text-white"><i class="fas fa-search"></i></button>
                </div>
                <select name="sort" class="admin-input h-11 px-3">
                    @foreach (['created_at' => 'Created date', 'updated_at' => 'Updated date', 'publish_date' => 'Publish date', 'title' => 'Title', 'display_order' => 'Display order'] as $value => $label)
                        <option value="{{ $value }}" @selected(request('sort', 'created_at') === $value)>Sort: {{ $label }}</option>
                    @endforeach
                </select>
                <select name="direction" class="admin-input h-11 px-3">
                    <option value="desc" @selected(request('direction', 'desc') === 'desc')>Descending</option>
                    <option value="asc" @selected(request('direction') === 'asc')>Ascending</option>
                </select>
            </form>

            <form method="POST" action="{{ route('management.cms.success-stories.bulk') }}">
                @csrf
                <div class="flex gap-3 border-b border-slate-200 p-4 dark:border-slate-800">
                    <select name="action" class="admin-input h-10 px-3 text-sm" required>
                        <option value="">Bulk action</option>
                        <option value="publish">Publish</option>
                        <option value="unpublish">Unpublish</option>
                        <option value="delete">Delete</option>
                    </select>
                    <button class="rounded-xl bg-brand-700 px-4 text-sm font-bold text-white" onclick="return confirm('Apply this action to selected stories?')">Apply</button>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200 text-sm dark:divide-slate-800">
                        <thead class="bg-slate-50 text-left text-xs font-bold uppercase tracking-wide text-slate-500 dark:bg-slate-900">
                            <tr>
                                <th class="px-4 py-4"><input type="checkbox" onclick="document.querySelectorAll('.story-check').forEach(item => item.checked = this.checked)"></th>
                                <th class="px-4 py-4">Story</th>
                                <th class="px-4 py-4">Customer</th>
                                <th class="px-4 py-4">Category</th>
                                <th class="px-4 py-4">Status</th>
                                <th class="px-4 py-4">Featured</th>
                                <th class="px-4 py-4">Dates</th>
                                <th class="px-4 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                            @forelse ($stories as $story)
                                <tr>
                                    <td class="px-4 py-4"><input class="story-check" type="checkbox" name="stories[]" value="{{ $story->id }}"></td>
                                    <td class="px-4 py-4">
                                        <p class="font-bold">{{ $story->title }}</p>
                                        <p class="text-xs text-slate-400">{{ $story->views_count }} views</p>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex items-center gap-3">
                                            @if ($story->customer_photo)<img src="{{ $story->customer_photo }}" alt="" class="h-10 w-10 rounded-xl object-cover">@endif
                                            <span>{{ $story->customer_name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">{{ $story->category?->name ?? 'Uncategorized' }}</td>
                                    <td class="px-4 py-4">
                                        <span class="rounded-full px-2 py-1 text-xs font-bold {{ $story->status === 'published' ? 'bg-emerald-100 text-emerald-700' : ($story->status === 'archived' ? 'bg-slate-200 text-slate-600' : 'bg-amber-100 text-amber-700') }}">{{ ucfirst($story->status) }}</span>
                                        <p class="mt-1 text-xs text-slate-400">{{ ucfirst($story->approval_status) }}</p>
                                    </td>
                                    <td class="px-4 py-4">{{ $story->is_featured ? 'Yes' : 'No' }}</td>
                                    <td class="px-4 py-4 text-xs text-slate-500">
                                        <p>Publish: {{ $story->publish_date?->format('M j, Y') ?? 'Not set' }}</p>
                                        <p>Created: {{ $story->created_at->format('M j, Y') }}</p>
                                        <p>Updated: {{ $story->updated_at->format('M j, Y') }}</p>
                                    </td>
                                    <td class="px-4 py-4 text-right">
                                        <a href="{{ route('management.cms.success-stories.show', $story) }}" class="admin-icon-btn inline-grid h-9 w-9"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('management.cms.success-stories.edit', $story) }}" class="admin-icon-btn inline-grid h-9 w-9"><i class="fas fa-pen"></i></a>
                                        @if ($story->status === 'published')
                                            <button form="unpublish-{{ $story->id }}" class="admin-icon-btn inline-grid h-9 w-9" title="Unpublish"><i class="fas fa-eye-slash"></i></button>
                                        @else
                                            <button form="publish-{{ $story->id }}" class="admin-icon-btn inline-grid h-9 w-9" title="Publish"><i class="fas fa-upload"></i></button>
                                        @endif
                                        <button form="delete-{{ $story->id }}" class="admin-icon-btn inline-grid h-9 w-9 text-red-600" onclick="return confirm('Delete this story?')"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="8" class="px-5 py-16 text-center text-slate-500">No success stories found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </form>
            @foreach ($stories as $story)
                <form id="publish-{{ $story->id }}" method="POST" action="{{ route('management.cms.success-stories.publish', $story) }}" class="hidden">@csrf</form>
                <form id="unpublish-{{ $story->id }}" method="POST" action="{{ route('management.cms.success-stories.unpublish', $story) }}" class="hidden">@csrf</form>
                <form id="delete-{{ $story->id }}" method="POST" action="{{ route('management.cms.success-stories.destroy', $story) }}" class="hidden">@csrf @method('DELETE')</form>
            @endforeach
            <div class="border-t border-slate-200 px-5 py-4 dark:border-slate-800">{{ $stories->links() }}</div>
        </div>

        <form method="POST" action="{{ route('management.cms.success-stories.homepage-settings') }}" class="admin-card h-fit p-5">
            @csrf
            @method('PUT')
            <h2 class="text-lg font-bold">Homepage integration</h2>
            <p class="mt-1 text-sm text-slate-500">Stories must also have the homepage toggle enabled.</p>
            <label class="mt-4 block text-sm font-bold">Stories displayed
                <input type="number" name="homepage_story_limit" min="1" max="12" class="admin-input mt-2 h-11 w-full px-3" value="{{ $section?->homepage_story_limit ?? 3 }}">
            </label>
            <label class="mt-4 block text-sm font-bold">Selection mode
                <select name="homepage_story_mode" class="admin-input mt-2 h-11 w-full px-3">
                    @foreach (['featured' => 'Featured only', 'latest' => 'Latest stories', 'ordered' => 'Display order'] as $value => $label)
                        <option value="{{ $value }}" @selected(($section?->homepage_story_mode ?? 'featured') === $value)>{{ $label }}</option>
                    @endforeach
                </select>
            </label>
            <button class="mt-4 rounded-xl bg-brand-700 px-4 py-3 text-sm font-bold text-white">Save homepage settings</button>
        </form>
    </section>
@endsection
