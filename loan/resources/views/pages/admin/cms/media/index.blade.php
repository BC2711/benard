@extends('layouts.admin.main')

@section('title', 'Media Library')
@section('page-title', 'Media Library')
@section('page-description', 'Upload and reuse images, videos, and documents across website pages.')
@section('page-icon')<i class="fas fa-photo-film"></i>@endsection

@section('content')
    <section class="grid gap-6 xl:grid-cols-[23rem_1fr]">
        <form method="POST" enctype="multipart/form-data" action="{{ route('management.cms.media.store') }}" class="admin-card p-5">
            @csrf
            <h2 class="text-lg font-bold">Upload asset</h2>
            <div class="mt-4 grid gap-3">
                <input type="file" name="file" class="admin-input p-3 text-sm" required>
                <input name="folder" class="admin-input h-11 px-3" value="{{ old('folder', 'general') }}" placeholder="Folder" required>
                <input name="name" class="admin-input h-11 px-3" value="{{ old('name') }}" placeholder="Display name">
                <input name="alt_text" class="admin-input h-11 px-3" value="{{ old('alt_text') }}" placeholder="Alternative text">
                <textarea name="caption" class="admin-input min-h-20 px-3 py-2" placeholder="Caption">{{ old('caption') }}</textarea>
            </div>
            <button class="mt-4 rounded-xl bg-brand-700 px-4 py-3 text-sm font-bold text-white">Upload media</button>
        </form>

        <div>
            <form class="admin-card mb-5 flex flex-col gap-3 p-4 sm:flex-row">
                <input name="search" value="{{ request('search') }}" class="admin-input h-11 flex-1 px-3" placeholder="Search media">
                <select name="folder" class="admin-input h-11 px-3">
                    <option value="">All folders</option>
                    @foreach ($folders as $folder)
                        <option value="{{ $folder }}" @selected(request('folder') === $folder)>{{ $folder }}</option>
                    @endforeach
                </select>
                <button class="rounded-xl bg-slate-900 px-4 text-sm font-bold text-white">Filter</button>
            </form>
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @forelse ($media as $medium)
                    <article class="admin-card overflow-hidden">
                        <div class="grid h-40 place-items-center bg-slate-100 dark:bg-slate-900">
                            @if (str_starts_with($medium->mime_type ?? '', 'image/'))
                                <img src="{{ Storage::disk($medium->disk)->url($medium->path) }}" alt="{{ $medium->alt_text }}" class="h-full w-full object-cover">
                            @else
                                <i class="fas fa-file text-4xl text-slate-400"></i>
                            @endif
                        </div>
                        <form method="POST" action="{{ route('management.cms.media.update', $medium) }}" class="grid gap-2 p-4">
                            @csrf
                            @method('PUT')
                            <input name="name" class="admin-input h-10 px-3 text-sm" value="{{ $medium->name }}" required>
                            <input name="folder" class="admin-input h-10 px-3 text-sm" value="{{ $medium->folder }}" required>
                            <input name="alt_text" class="admin-input h-10 px-3 text-sm" value="{{ $medium->alt_text }}" placeholder="Alt text">
                            <input name="caption" class="admin-input h-10 px-3 text-sm" value="{{ $medium->caption }}" placeholder="Caption">
                            <input class="admin-input h-10 px-3 text-xs" value="{{ Storage::disk($medium->disk)->url($medium->path) }}" readonly>
                            <div class="flex justify-between pt-1">
                                <button class="text-xs font-bold text-brand-700">Update</button>
                                <button type="button" class="text-xs font-bold text-red-600" onclick="AdminUI.confirmSubmit(this.form.nextElementSibling, 'Delete this media asset?')">Delete</button>
                            </div>
                        </form>
                        <form method="POST" action="{{ route('management.cms.media.destroy', $medium) }}" class="hidden">@csrf @method('DELETE')</form>
                    </article>
                @empty
                    <p class="text-sm text-slate-500">No media assets found.</p>
                @endforelse
            </div>
            <div class="mt-5">{{ $media->links() }}</div>
        </div>
    </section>
@endsection
