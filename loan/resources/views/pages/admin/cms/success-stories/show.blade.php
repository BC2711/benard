@extends('layouts.admin.main')

@section('title', $story->title)
@section('page-title', $story->title)
@section('page-description', 'Administrative story preview and publication summary.')
@section('page-icon')<i class="fas fa-eye"></i>@endsection
@section('page-actions')
    <a href="{{ route('management.cms.success-stories.edit', $story) }}" class="rounded-xl bg-brand-700 px-4 py-3 text-sm font-bold text-white"><i class="fas fa-pen mr-2"></i>Edit Story</a>
@endsection

@section('content')
    <section class="admin-card overflow-hidden">
        @if ($story->featured_image)<img src="{{ $story->featured_image }}" alt="{{ $story->title }}" class="max-h-[28rem] w-full object-cover">@endif
        <div class="p-6">
            <div class="flex flex-wrap gap-2 text-xs font-bold">
                <span class="rounded-full bg-cyan-50 px-3 py-1 text-cyan-700">{{ ucfirst($story->status) }}</span>
                <span class="rounded-full bg-amber-50 px-3 py-1 text-amber-700">{{ ucfirst($story->approval_status) }}</span>
                @if ($story->is_featured)<span class="rounded-full bg-emerald-50 px-3 py-1 text-emerald-700">Featured</span>@endif
            </div>
            <p class="mt-5 text-lg text-slate-600">{{ $story->summary }}</p>
            <div class="prose mt-6 max-w-none dark:prose-invert">{!! $story->content !!}</div>
            <div class="mt-8 grid gap-4 rounded-2xl bg-slate-50 p-5 text-sm md:grid-cols-3 dark:bg-slate-900">
                <p><strong>Customer:</strong> {{ $story->customer_name }}</p>
                <p><strong>Company:</strong> {{ $story->customer_company ?: 'Not set' }}</p>
                <p><strong>Category:</strong> {{ $story->category?->name ?: 'Uncategorized' }}</p>
                <p><strong>Publish date:</strong> {{ $story->publish_date?->format('M j, Y g:i A') ?: 'Not set' }}</p>
                <p><strong>Views:</strong> {{ $story->views_count }}</p>
                <p><strong>Tags:</strong> {{ $story->tags->pluck('name')->implode(', ') ?: 'None' }}</p>
            </div>
        </div>
    </section>
@endsection
