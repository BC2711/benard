@extends('layouts.admin.main')

@section('title', $page->exists ? 'Edit Page' : 'Create Page')
@section('page-title', $page->exists ? 'Edit Page' : 'Create Page')
@section('page-description', 'Control page content, SEO metadata, status, scheduling, and dynamic section ordering.')
@section('page-icon')
    <i class="fas fa-pen-to-square"></i>
@endsection
@section('page-actions')
    <a href="{{ route('management.cms.pages.index') }}" class="inline-flex h-11 items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 text-sm font-bold text-slate-600 shadow-sm dark:border-slate-800 dark:bg-slate-900">
        <i class="fas fa-arrow-left"></i> Pages
    </a>
    @if ($page->exists)
        <form method="POST" action="{{ route('management.cms.pages.duplicate', $page) }}">
            @csrf
            <button class="inline-flex h-11 items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 text-sm font-bold text-slate-600 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <i class="fas fa-copy"></i> Duplicate
            </button>
        </form>
    @endif
@endsection

@section('content')
    <section class="grid grid-cols-1 gap-6 xl:grid-cols-[1fr_24rem]">
        <form class="admin-card p-5" method="POST" action="{{ $page->exists ? route('management.cms.pages.update', $page) : route('management.cms.pages.store') }}">
            @csrf
            @if ($page->exists)
                @method('PUT')
            @endif

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                <label>
                    <span class="mb-2 block text-sm font-bold text-slate-600 dark:text-slate-300">Title</span>
                    <input name="title" class="admin-input h-11 w-full px-4" value="{{ old('title', $page->title) }}" required>
                </label>
                <label>
                    <span class="mb-2 block text-sm font-bold text-slate-600 dark:text-slate-300">Display order</span>
                    <input type="number" name="display_order" class="admin-input h-11 w-full px-4" value="{{ old('display_order', $page->display_order ?? 0) }}" required>
                </label>
                <label>
                    <span class="mb-2 block text-sm font-bold text-slate-600 dark:text-slate-300">Featured image</span>
                    <input name="featured_image" class="admin-input h-11 w-full px-4" value="{{ old('featured_image', $page->featured_image) }}" placeholder="/storage/cms/general/image.jpg">
                </label>
                <label>
                    <span class="mb-2 block text-sm font-bold text-slate-600 dark:text-slate-300">Slug</span>
                    <input name="slug" class="admin-input h-11 w-full px-4" value="{{ old('slug', $page->slug) }}" placeholder="auto-generated">
                </label>
                <label>
                    <span class="mb-2 block text-sm font-bold text-slate-600 dark:text-slate-300">Expire at</span>
                    <input type="datetime-local" name="expires_at" class="admin-input h-11 w-full px-4" value="{{ old('expires_at', optional($page->expires_at)->format('Y-m-d\TH:i')) }}">
                </label>
                <label>
                    <span class="mb-2 block text-sm font-bold text-slate-600 dark:text-slate-300">Template</span>
                    <input name="template" class="admin-input h-11 w-full px-4" value="{{ old('template', $page->template ?: 'default') }}" required>
                </label>
                <label>
                    <span class="mb-2 block text-sm font-bold text-slate-600 dark:text-slate-300">Status</span>
                    <select name="status" class="admin-input h-11 w-full px-4">
                        @foreach (['draft', 'published', 'archived'] as $status)
                            <option value="{{ $status }}" @selected(old('status', $page->status ?: 'draft') === $status)>{{ ucfirst($status) }}</option>
                        @endforeach
                    </select>
                </label>
                <label>
                    <span class="mb-2 block text-sm font-bold text-slate-600 dark:text-slate-300">Published at</span>
                    <input type="datetime-local" name="published_at" class="admin-input h-11 w-full px-4" value="{{ old('published_at', optional($page->published_at)->format('Y-m-d\TH:i')) }}">
                </label>
                <label>
                    <span class="mb-2 block text-sm font-bold text-slate-600 dark:text-slate-300">Schedule for</span>
                    <input type="datetime-local" name="scheduled_for" class="admin-input h-11 w-full px-4" value="{{ old('scheduled_for', optional($page->scheduled_for)->format('Y-m-d\TH:i')) }}">
                </label>
            </div>

            <label class="mt-5 flex items-center gap-3 rounded-2xl bg-slate-50 p-4 font-bold dark:bg-slate-900">
                <input type="hidden" name="is_homepage" value="0">
                <input type="checkbox" name="is_homepage" value="1" @checked(old('is_homepage', $page->is_homepage)) class="rounded border-slate-300 text-brand-700">
                Set as homepage
            </label>

            <div class="mt-8 border-t border-slate-200 pt-6 dark:border-slate-800">
                <h2 class="text-lg font-bold">SEO metadata</h2>
                <div class="mt-5 grid grid-cols-1 gap-5 md:grid-cols-2">
                    <input name="meta_title" class="admin-input h-11 px-4" value="{{ old('meta_title', $page->seoMeta->meta_title ?? '') }}" placeholder="Meta title">
                    <input name="canonical_url" class="admin-input h-11 px-4" value="{{ old('canonical_url', $page->seoMeta->canonical_url ?? '') }}" placeholder="Canonical URL">
                    <textarea name="meta_description" class="admin-input min-h-24 px-4 py-3 md:col-span-2" placeholder="Meta description">{{ old('meta_description', $page->seoMeta->meta_description ?? '') }}</textarea>
                    <input name="meta_keywords" class="admin-input h-11 px-4 md:col-span-2" value="{{ old('meta_keywords', $page->seoMeta->meta_keywords ?? '') }}" placeholder="Meta keywords">
                    <input name="og_title" class="admin-input h-11 px-4" value="{{ old('og_title', $page->seoMeta->og_title ?? '') }}" placeholder="OpenGraph title">
                    <input name="og_image" class="admin-input h-11 px-4" value="{{ old('og_image', $page->seoMeta->og_image ?? '') }}" placeholder="OpenGraph image">
                    <textarea name="og_description" class="admin-input min-h-24 px-4 py-3 md:col-span-2" placeholder="OpenGraph description">{{ old('og_description', $page->seoMeta->og_description ?? '') }}</textarea>
                    <input name="robots" class="admin-input h-11 px-4" value="{{ old('robots', $page->seoMeta->robots ?? 'index,follow') }}" placeholder="index,follow">
                    <input name="twitter_card" class="admin-input h-11 px-4" value="{{ old('twitter_card', $page->seoMeta->twitter_card ?? 'summary_large_image') }}" placeholder="summary_large_image">
                    <input name="twitter_title" class="admin-input h-11 px-4" value="{{ old('twitter_title', $page->seoMeta->twitter_title ?? '') }}" placeholder="Twitter card title">
                    <input name="twitter_image" class="admin-input h-11 px-4" value="{{ old('twitter_image', $page->seoMeta->twitter_image ?? '') }}" placeholder="Twitter card image">
                    <textarea name="twitter_description" class="admin-input min-h-24 px-4 py-3 md:col-span-2" placeholder="Twitter card description">{{ old('twitter_description', $page->seoMeta->twitter_description ?? '') }}</textarea>
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <button class="inline-flex h-11 items-center gap-2 rounded-xl bg-brand-700 px-5 text-sm font-bold text-white shadow-soft">
                    <i class="fas fa-save"></i> Save page
                </button>
            </div>
        </form>

        <aside class="space-y-6">
            <div class="admin-card p-5">
                <h2 class="text-lg font-bold">Live preview</h2>
                <p class="mt-2 text-sm text-slate-500">Open the current published version in a new tab.</p>
                @if ($page->exists)
                    <a href="{{ route('management.cms.pages.preview', $page) }}" target="_blank" class="premium-btn mt-4 px-4 py-3 text-sm">Preview draft</a>
                @endif
            </div>
            @if ($page->exists && $page->versions->isNotEmpty())
                <div class="admin-card p-5">
                    <h2 class="text-lg font-bold">Content versions</h2>
                    <div class="mt-3 space-y-2">
                        @foreach ($page->versions->take(8) as $version)
                            <form method="POST" action="{{ route('management.cms.pages.versions.restore', [$page, $version]) }}" class="flex items-center justify-between gap-2 text-sm">
                                @csrf
                                <span>v{{ $version->version }} <span class="text-slate-400">{{ $version->created_at->diffForHumans() }}</span></span>
                                <button class="font-bold text-brand-700">Restore</button>
                            </form>
                        @endforeach
                    </div>
                </div>
            @endif
        </aside>
    </section>

    @if ($page->exists)
        <section class="admin-card p-5" x-data="{ open: false }">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-lg font-bold">Page sections</h2>
                    <p class="text-sm text-slate-500">Drag section cards to reorder them, or set an exact sort order.</p>
                </div>
                <button type="button" class="inline-flex h-11 items-center gap-2 rounded-xl bg-brand-700 px-4 text-sm font-bold text-white" @click="open = !open">
                    <i class="fas fa-plus"></i> Add section
                </button>
            </div>

            <form x-show="open" x-transition class="mt-5 rounded-2xl bg-slate-50 p-4 dark:bg-slate-900" method="POST" action="{{ route('management.cms.pages.sections.store', $page) }}">
                @csrf
                @include('pages.admin.cms.pages.section-fields', ['section' => null])
                <button class="mt-4 rounded-xl bg-brand-700 px-4 py-2 text-sm font-bold text-white">Create section</button>
            </form>

            <div id="cms-section-list" class="mt-5 space-y-4" data-reorder-url="{{ route('management.cms.pages.sections.reorder', $page) }}">
                @foreach ($page->sections as $section)
                    <div class="cms-section-card rounded-2xl border border-slate-200 p-4 dark:border-slate-800" draggable="true" data-section-id="{{ $section->id }}">
                    <form method="POST" action="{{ route('management.cms.pages.sections.update', [$page, $section]) }}">
                        @csrf
                        @method('PUT')
                        @include('pages.admin.cms.pages.section-fields', ['section' => $section])
                        <div class="mt-4 flex justify-between gap-2">
                            <button class="rounded-xl bg-brand-700 px-4 py-2 text-sm font-bold text-white">Update</button>
                            <div class="flex gap-2">
                                <button type="button" class="rounded-xl bg-slate-100 px-4 py-2 text-sm font-bold text-slate-700" onclick="this.closest('.cms-section-card').querySelector('.clone-section-form').submit()">Clone</button>
                                <button type="button" class="rounded-xl bg-red-50 px-4 py-2 text-sm font-bold text-red-600" onclick="AdminUI.confirmSubmit(this.closest('.cms-section-card').querySelector('.delete-section-form'), 'Delete this section?')">Delete</button>
                            </div>
                        </div>
                    </form>
                    <form method="POST" action="{{ route('management.cms.pages.sections.duplicate', [$page, $section]) }}" class="clone-section-form hidden">@csrf</form>
                    <form method="POST" action="{{ route('management.cms.pages.sections.destroy', [$page, $section]) }}" class="delete-section-form hidden">@csrf @method('DELETE')</form>
                    </div>
                @endforeach
            </div>
        </section>
    @endif
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const list = document.getElementById('cms-section-list');
        if (!list) return;
        let dragged;
        list.querySelectorAll('.cms-section-card').forEach(card => {
            card.addEventListener('dragstart', () => dragged = card);
            card.addEventListener('dragover', event => event.preventDefault());
            card.addEventListener('drop', event => {
                event.preventDefault();
                if (dragged && dragged !== card) list.insertBefore(dragged, card);
            });
            card.addEventListener('dragend', async () => {
                const sections = [...list.querySelectorAll('.cms-section-card')].map((card, index) => ({ id: Number(card.dataset.sectionId), sort_order: (index + 1) * 10 }));
                await fetch(list.dataset.reorderUrl, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
                    body: JSON.stringify({ sections })
                });
                AdminUI.toast('Section order updated.', 'success');
            });
        });
    });
</script>
@endpush
