@extends('layouts.admin.main')

@section('title', 'CMS Pages')
@section('page-title', 'CMS Pages')
@section('page-description', 'Create, publish, schedule, and organize dynamic frontend pages.')
@section('page-icon')
    <i class="fas fa-file-lines"></i>
@endsection
@section('page-actions')
    <a href="{{ route('management.cms.pages.create') }}" class="inline-flex h-11 items-center gap-2 rounded-xl bg-brand-700 px-4 text-sm font-bold text-white shadow-soft">
        <i class="fas fa-plus"></i> New Page
    </a>
@endsection

@section('content')
    <section class="admin-card overflow-hidden">
        <div class="border-b border-slate-200 p-5 dark:border-slate-800">
            <form class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-lg font-bold">Website page registry</h2>
                    <p class="text-sm text-slate-500">Every published page can be rendered by slug with dynamic SEO and sections.</p>
                </div>
                <input name="search" value="{{ request('search') }}" class="admin-input h-11 px-4 text-sm" placeholder="Search pages">
            </form>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-sm dark:divide-slate-800">
                <thead class="bg-slate-50 text-left text-xs font-bold uppercase tracking-wider text-slate-500 dark:bg-slate-900">
                    <tr>
                        <th class="px-5 py-4">Page</th>
                        <th class="px-5 py-4">Status</th>
                        <th class="px-5 py-4">Sections</th>
                        <th class="px-5 py-4">Published</th>
                        <th class="px-5 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @forelse ($pages as $page)
                        <tr>
                            <td class="px-5 py-4">
                                <p class="font-bold">{{ $page->title }}</p>
                                <a class="text-slate-500 hover:text-brand-700" href="{{ url($page->is_homepage ? '/' : $page->slug) }}" target="_blank">
                                    /{{ $page->is_homepage ? '' : $page->slug }}
                                </a>
                            </td>
                            <td class="px-5 py-4">
                                <span class="rounded-full px-3 py-1 text-xs font-bold {{ $page->status === 'published' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">{{ ucfirst($page->status) }}</span>
                            </td>
                            <td class="px-5 py-4">{{ $page->sections_count }}</td>
                            <td class="px-5 py-4 text-slate-500">{{ optional($page->published_at)->format('M j, Y') ?? 'Not set' }}</td>
                            <td class="px-5 py-4 text-right">
                                <a href="{{ route('management.cms.pages.edit', $page) }}" class="admin-icon-btn inline-grid h-10 w-10" aria-label="Edit {{ $page->title }}">
                                    <i class="fas fa-pen"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-16 text-center text-slate-500">No CMS pages yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="border-t border-slate-200 px-5 py-4 dark:border-slate-800">{{ $pages->links() }}</div>
    </section>
@endsection
