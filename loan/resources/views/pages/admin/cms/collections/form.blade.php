@extends('layouts.admin.main')

@section('title', $item ? 'Edit ' . $label : 'Create ' . $label)
@section('page-title', $item ? 'Edit ' . $label : 'Create ' . $label)
@section('page-description', 'Use structured fields for common content and JSON for flexible blocks, galleries, rich text, and metadata.')
@section('page-icon')
    <i class="fas fa-pen-to-square"></i>
@endsection

@section('content')
    @php
        $contentJson = old('content_json', $item ? json_encode(json_decode($item->content ?? '{}', true), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : "{}");
    @endphp
    <form class="admin-card p-5" method="POST" action="{{ $item ? route('management.cms.collections.update', [$type, $item->id]) : route('management.cms.collections.store', $type) }}">
        @csrf
        @if ($item)
            @method('PUT')
        @endif
        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
            <input name="title" class="admin-input h-11 px-4" value="{{ old('title', $item->title ?? '') }}" placeholder="Title">
            <input name="slug" class="admin-input h-11 px-4" value="{{ old('slug', $item->slug ?? '') }}" placeholder="Slug">
            <input name="subtitle" class="admin-input h-11 px-4" value="{{ old('subtitle', $item->subtitle ?? '') }}" placeholder="Subtitle">
            <input name="url" class="admin-input h-11 px-4" value="{{ old('url', $item->url ?? '') }}" placeholder="URL">
            <input name="image" class="admin-input h-11 px-4" value="{{ old('image', $item->image ?? '') }}" placeholder="Image/media path">
            <input type="number" name="sort_order" class="admin-input h-11 px-4" value="{{ old('sort_order', $item->sort_order ?? 0) }}" placeholder="Sort order">
            <select name="status" class="admin-input h-11 px-4">
                @foreach (['draft', 'published', 'disabled'] as $status)
                    <option value="{{ $status }}" @selected(old('status', $item->status ?? 'published') === $status)>{{ ucfirst($status) }}</option>
                @endforeach
            </select>
            <input type="datetime-local" name="published_at" class="admin-input h-11 px-4" value="{{ old('published_at', $item && $item->published_at ? \Carbon\Carbon::parse($item->published_at)->format('Y-m-d\TH:i') : '') }}">
            <textarea name="description" class="admin-input min-h-32 px-4 py-3 md:col-span-2" placeholder="Description">{{ old('description', $item->description ?? '') }}</textarea>
            <textarea name="content_json" class="admin-input min-h-64 px-4 py-3 font-mono text-xs md:col-span-2" placeholder="JSON content">{{ $contentJson }}</textarea>
        </div>
        <div class="mt-6 flex items-center justify-between">
            <a href="{{ route('management.cms.collections.index', $type) }}" class="font-bold text-slate-500">Back</a>
            <button class="rounded-xl bg-brand-700 px-5 py-3 text-sm font-bold text-white shadow-soft">Save</button>
        </div>
    </form>
@endsection
