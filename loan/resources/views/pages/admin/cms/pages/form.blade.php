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
                    <span class="mb-2 block text-sm font-bold text-slate-600 dark:text-slate-300">Slug</span>
                    <input name="slug" class="admin-input h-11 w-full px-4" value="{{ old('slug', $page->slug) }}" placeholder="auto-generated">
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
                    <input name="og_title" class="admin-input h-11 px-4" value="{{ old('og_title', $page->seoMeta->og_title ?? '') }}" placeholder="OpenGraph title">
                    <input name="og_image" class="admin-input h-11 px-4" value="{{ old('og_image', $page->seoMeta->og_image ?? '') }}" placeholder="OpenGraph image">
                    <textarea name="og_description" class="admin-input min-h-24 px-4 py-3 md:col-span-2" placeholder="OpenGraph description">{{ old('og_description', $page->seoMeta->og_description ?? '') }}</textarea>
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
                    <a href="{{ url($page->is_homepage ? '/' : $page->slug) }}" target="_blank" class="premium-btn mt-4 px-4 py-3 text-sm">Preview page</a>
                @endif
            </div>
        </aside>
    </section>

    @if ($page->exists)
        <section class="admin-card p-5" x-data="{ open: false }">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-lg font-bold">Page sections</h2>
                    <p class="text-sm text-slate-500">Drag-and-drop ordering is API-ready through the reorder endpoint; use sort order for now.</p>
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

            <div class="mt-5 space-y-4">
                @foreach ($page->sections as $section)
                    <form class="rounded-2xl border border-slate-200 p-4 dark:border-slate-800" method="POST" action="{{ route('management.cms.pages.sections.update', [$page, $section]) }}">
                        @csrf
                        @method('PUT')
                        @include('pages.admin.cms.pages.section-fields', ['section' => $section])
                        <div class="mt-4 flex justify-between">
                            <button class="rounded-xl bg-brand-700 px-4 py-2 text-sm font-bold text-white">Update</button>
                            <button type="button" class="rounded-xl bg-red-50 px-4 py-2 text-sm font-bold text-red-600" onclick="AdminUI.confirmSubmit(this.form.nextElementSibling, 'Delete this section?')">Delete</button>
                        </div>
                    </form>
                    <form method="POST" action="{{ route('management.cms.pages.sections.destroy', [$page, $section]) }}" class="hidden">@csrf @method('DELETE')</form>
                @endforeach
            </div>
        </section>
    @endif
@endsection
