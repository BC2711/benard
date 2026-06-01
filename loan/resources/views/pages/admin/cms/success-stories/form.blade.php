@extends('layouts.admin.main')

@section('title', $story->exists ? 'Edit Success Story' : 'Create Success Story')
@section('page-title', $story->exists ? 'Edit Success Story' : 'Create Success Story')
@section('page-description', 'Manage the customer profile, story content, media, publishing workflow, placement, metrics, and SEO.')
@section('page-icon')<i class="fas fa-trophy"></i>@endsection
@section('page-actions')
    <a href="{{ route('management.cms.success-stories.index') }}" class="inline-flex h-11 items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 text-sm font-bold text-slate-700 dark:border-slate-800 dark:bg-slate-900"><i class="fas fa-arrow-left"></i> Stories</a>
@endsection

@section('content')
    @php
        $gallery = old('existing_gallery', json_encode($story->gallery ?? []));
        $customStatistics = old('custom_statistics_json', json_encode($story->custom_statistics ?? [['label' => 'Key result', 'value' => '']], JSON_PRETTY_PRINT));
    @endphp
    <form method="POST" enctype="multipart/form-data" action="{{ $story->exists ? route('management.cms.success-stories.update', $story) : route('management.cms.success-stories.store') }}" class="space-y-6">
        @csrf
        @if ($story->exists) @method('PUT') @endif
        <section class="admin-card p-5">
            <h2 class="text-lg font-bold">Basic information</h2>
            <div class="mt-4 grid gap-4 md:grid-cols-2">
                <label class="text-sm font-bold">Story title<input name="title" class="admin-input mt-2 h-11 w-full px-3" value="{{ old('title', $story->title) }}" required></label>
                <label class="text-sm font-bold">Slug<input name="slug" class="admin-input mt-2 h-11 w-full px-3" value="{{ old('slug', $story->slug) }}" placeholder="auto-generated"></label>
                <label class="text-sm font-bold">Category
                    <select name="category_id" class="admin-input mt-2 h-11 w-full px-3">
                        <option value="">Choose category</option>
                        @foreach ($categories as $category)<option value="{{ $category->id }}" @selected((string) old('category_id', $story->category_id) === (string) $category->id)>{{ $category->name }}</option>@endforeach
                    </select>
                </label>
                <label class="text-sm font-bold">Or create category<input name="category_name" class="admin-input mt-2 h-11 w-full px-3" value="{{ old('category_name') }}" placeholder="New category name"></label>
                <label class="text-sm font-bold md:col-span-2">Tags<input name="tags" class="admin-input mt-2 h-11 w-full px-3" value="{{ old('tags', $story->tags->pluck('name')->implode(', ')) }}" placeholder="growth, retail, Lusaka"></label>
                <label class="text-sm font-bold md:col-span-2">Short summary<textarea name="summary" class="admin-input mt-2 min-h-24 w-full px-3 py-2" required>{{ old('summary', $story->summary) }}</textarea></label>
                <div class="md:col-span-2">
                    <label class="text-sm font-bold">Full story content</label>
                    <div class="my-2 flex gap-2">
                        <button type="button" class="rounded-lg bg-slate-100 px-3 py-1 text-xs font-bold dark:bg-slate-800" onclick="document.execCommand('bold')">Bold</button>
                        <button type="button" class="rounded-lg bg-slate-100 px-3 py-1 text-xs font-bold dark:bg-slate-800" onclick="document.execCommand('italic')">Italic</button>
                        <button type="button" class="rounded-lg bg-slate-100 px-3 py-1 text-xs font-bold dark:bg-slate-800" onclick="document.execCommand('insertUnorderedList')">List</button>
                    </div>
                    <input type="hidden" name="content" value="{{ old('content', $story->content) }}">
                    <div contenteditable="true" class="admin-input min-h-52 px-3 py-3" oninput="this.previousElementSibling.value = this.innerHTML">{!! old('content', $story->content) !!}</div>
                </div>
            </div>
        </section>

        <section class="admin-card p-5">
            <h2 class="text-lg font-bold">Customer information</h2>
            <div class="mt-4 grid gap-4 md:grid-cols-2">
                @foreach (['customer_name' => 'Customer name', 'customer_occupation' => 'Occupation', 'customer_location' => 'Location', 'customer_company' => 'Company'] as $name => $label)
                    <label class="text-sm font-bold">{{ $label }}<input name="{{ $name }}" class="admin-input mt-2 h-11 w-full px-3" value="{{ old($name, $story->$name) }}" @required($name === 'customer_name')></label>
                @endforeach
            </div>
        </section>

        <section class="admin-card p-5">
            <h2 class="text-lg font-bold">Media</h2>
            <div class="mt-4 grid gap-4 md:grid-cols-2">
                <label class="text-sm font-bold">Customer photo<input type="file" name="customer_photo" accept="image/*" class="admin-input mt-2 w-full p-3"></label>
                <label class="text-sm font-bold">Or media library URL<input list="media-assets" name="customer_photo_path" class="admin-input mt-2 h-11 w-full px-3" value="{{ old('customer_photo_path', $story->customer_photo) }}"></label>
                <label class="text-sm font-bold">Featured image<input type="file" name="featured_image" accept="image/*" class="admin-input mt-2 w-full p-3"></label>
                <label class="text-sm font-bold">Or media library URL<input list="media-assets" name="featured_image_path" class="admin-input mt-2 h-11 w-full px-3" value="{{ old('featured_image_path', $story->featured_image) }}"></label>
                <label class="text-sm font-bold">Gallery images<input type="file" name="gallery_images[]" accept="image/*" multiple class="admin-input mt-2 w-full p-3"></label>
                <label class="text-sm font-bold">Video URL<input name="video_url" class="admin-input mt-2 h-11 w-full px-3" value="{{ old('video_url', $story->video_url) }}"></label>
                <input type="hidden" name="existing_gallery" value="{{ $gallery }}">
            </div>
            <datalist id="media-assets">@foreach ($media as $asset)<option value="{{ Storage::disk($asset->disk)->url($asset->path) }}">{{ $asset->name }}</option>@endforeach</datalist>
        </section>

        <section class="admin-card p-5">
            <h2 class="text-lg font-bold">Story metrics</h2>
            <div class="mt-4 grid gap-4 md:grid-cols-3">
                <label class="text-sm font-bold">Loan amount<input type="number" step="0.01" name="loan_amount" class="admin-input mt-2 h-11 w-full px-3" value="{{ old('loan_amount', $story->loan_amount) }}"></label>
                <label class="text-sm font-bold">Currency<input name="currency" class="admin-input mt-2 h-11 w-full px-3" value="{{ old('currency', $story->currency ?: 'ZMW') }}" required></label>
                <label class="text-sm font-bold">Business growth %<input type="number" step="0.01" name="business_growth_percentage" class="admin-input mt-2 h-11 w-full px-3" value="{{ old('business_growth_percentage', $story->business_growth_percentage) }}"></label>
                <label class="text-sm font-bold">Revenue increase<input type="number" step="0.01" name="revenue_increase" class="admin-input mt-2 h-11 w-full px-3" value="{{ old('revenue_increase', $story->revenue_increase) }}"></label>
                <label class="text-sm font-bold">Jobs created<input type="number" name="jobs_created" class="admin-input mt-2 h-11 w-full px-3" value="{{ old('jobs_created', $story->jobs_created) }}"></label>
                <label class="text-sm font-bold md:col-span-3">Other statistics JSON<textarea name="custom_statistics_json" class="admin-input mt-2 min-h-36 w-full px-3 py-2 font-mono text-xs">{{ $customStatistics }}</textarea></label>
            </div>
        </section>

        <section class="grid gap-6 xl:grid-cols-2">
            <div class="admin-card p-5">
                <h2 class="text-lg font-bold">Display and publishing</h2>
                <div class="mt-4 grid gap-4 md:grid-cols-2">
                    <label class="text-sm font-bold">Status<select name="status" class="admin-input mt-2 h-11 w-full px-3">@foreach (['draft', 'published', 'archived'] as $status)<option value="{{ $status }}" @selected(old('status', $story->status ?: 'draft') === $status)>{{ ucfirst($status) }}</option>@endforeach</select></label>
                    <label class="text-sm font-bold">Approval<select name="approval_status" class="admin-input mt-2 h-11 w-full px-3">@foreach (['pending', 'approved', 'rejected'] as $status)<option value="{{ $status }}" @selected(old('approval_status', $story->approval_status ?: 'pending') === $status)>{{ ucfirst($status) }}</option>@endforeach</select></label>
                    <label class="text-sm font-bold">Publish date<input type="datetime-local" name="publish_date" class="admin-input mt-2 h-11 w-full px-3" value="{{ old('publish_date', $story->publish_date?->format('Y-m-d\TH:i')) }}"></label>
                    <label class="text-sm font-bold">Expire at<input type="datetime-local" name="expires_at" class="admin-input mt-2 h-11 w-full px-3" value="{{ old('expires_at', $story->expires_at?->format('Y-m-d\TH:i')) }}"></label>
                    <label class="text-sm font-bold">Display order<input type="number" name="display_order" class="admin-input mt-2 h-11 w-full px-3" value="{{ old('display_order', $story->display_order ?? 0) }}" required></label>
                </div>
                <div class="mt-4 grid gap-2 text-sm font-bold">
                    @foreach (['is_featured' => 'Featured story', 'show_on_homepage' => 'Show on homepage', 'show_in_testimonials' => 'Show in testimonials section', 'show_on_landing_pages' => 'Available on landing pages'] as $name => $label)
                        <label><input type="hidden" name="{{ $name }}" value="0"><input type="checkbox" name="{{ $name }}" value="1" @checked(old($name, $story->$name))> {{ $label }}</label>
                    @endforeach
                </div>
            </div>
            <div class="admin-card p-5">
                <h2 class="text-lg font-bold">SEO settings</h2>
                <div class="mt-4 grid gap-4">
                    @foreach (['meta_title' => 'Meta title', 'meta_keywords' => 'Meta keywords', 'og_image' => 'Open Graph image URL'] as $name => $label)
                        <label class="text-sm font-bold">{{ $label }}<input name="{{ $name }}" class="admin-input mt-2 h-11 w-full px-3" value="{{ old($name, $story->$name) }}"></label>
                    @endforeach
                    <label class="text-sm font-bold">Meta description<textarea name="meta_description" class="admin-input mt-2 min-h-24 w-full px-3 py-2">{{ old('meta_description', $story->meta_description) }}</textarea></label>
                </div>
            </div>
        </section>
        <button class="rounded-xl bg-brand-700 px-5 py-3 text-sm font-bold text-white shadow-soft">Save success story</button>
    </form>
@endsection
