<?php

namespace App\Services;

use App\Models\ActivityLog;
use App\Models\Category;
use App\Models\SuccessStoriesSection;
use App\Models\SuccessStory;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SuccessStoryService
{
    public function __construct(private readonly MediaUploadService $media)
    {
    }

    public function adminQuery(Request $request): Builder
    {
        return SuccessStory::query()
            ->with(['category', 'tags'])
            ->when($request->search, fn ($q, $search) => $q->where(fn ($sub) => $sub
                ->where('title', 'like', "%$search%")
                ->orWhere('customer_name', 'like', "%$search%")))
            ->when($request->status, fn ($q, $status) => $q->where('status', $status))
            ->when($request->category, fn ($q, $category) => $q->where('category_id', $category))
            ->when($request->featured !== null && $request->featured !== '', fn ($q) => $q->where('is_featured', $request->boolean('featured')))
            ->orderBy(
                in_array($request->input('sort'), ['title', 'publish_date', 'created_at', 'updated_at', 'display_order'], true)
                    ? $request->input('sort')
                    : 'created_at',
                $request->input('direction') === 'asc' ? 'asc' : 'desc'
            );
    }

    public function publicQuery(Request $request): Builder
    {
        return SuccessStory::query()
            ->published()
            ->with(['category', 'tags'])
            ->when($request->search, fn ($q, $search) => $q->where(fn ($sub) => $sub
                ->where('title', 'like', "%$search%")
                ->orWhere('summary', 'like', "%$search%")
                ->orWhere('customer_name', 'like', "%$search%")))
            ->when($request->category, fn ($q, $category) => $q->whereHas('category', fn ($categoryQuery) => $categoryQuery->where('slug', $category)))
            ->orderByDesc('publish_date')
            ->orderBy('display_order');
    }

    public function homepage(): \Illuminate\Support\Collection
    {
        $section = SuccessStoriesSection::first();
        $mode = $section?->homepage_story_mode ?? 'featured';

        return SuccessStory::query()
            ->published()
            ->with(['category', 'tags'])
            ->where('show_on_homepage', true)
            ->when($mode === 'featured', fn ($q) => $q->where('is_featured', true))
            ->when($mode === 'latest', fn ($q) => $q->orderByDesc('publish_date'), fn ($q) => $q->orderBy('display_order'))
            ->limit($section?->homepage_story_limit ?? 3)
            ->get();
    }

    public function save(Request $request, ?SuccessStory $story = null): SuccessStory
    {
        return DB::transaction(function () use ($request, $story) {
            $story ??= new SuccessStory();
            $data = $request->validated();
            unset($data['tags'], $data['category_name'], $data['customer_photo'], $data['customer_photo_path'], $data['featured_image'], $data['featured_image_path'], $data['gallery_images'], $data['existing_gallery'], $data['custom_statistics_json']);

            $data['slug'] = ($data['slug'] ?? null) ?: Str::slug($data['title']);
            $data['custom_statistics'] = json_decode($request->input('custom_statistics_json', '[]'), true) ?: [];
            if ($request->filled('category_name')) {
                $categoryName = trim($request->input('category_name'));
                $category = Category::firstOrCreate(
                    ['slug' => 'success-story-' . Str::slug($categoryName)],
                    ['name' => $categoryName, 'type' => 'success_story']
                );
                $data['category_id'] = $category->id;
            }
            foreach (['is_featured', 'show_on_homepage', 'show_in_testimonials', 'show_on_landing_pages'] as $toggle) {
                $data[$toggle] = $request->boolean($toggle);
            }
            if ($request->hasFile('customer_photo')) {
                $data['customer_photo'] = $this->media->store($request->file('customer_photo'), 'success-stories/customers');
            } elseif ($request->filled('customer_photo_path')) {
                $data['customer_photo'] = $request->input('customer_photo_path');
            }
            if ($request->hasFile('featured_image')) {
                $data['featured_image'] = $this->media->store($request->file('featured_image'), 'success-stories/featured');
            } elseif ($request->filled('featured_image_path')) {
                $data['featured_image'] = $request->input('featured_image_path');
            }

            $gallery = json_decode($request->input('existing_gallery', '[]'), true) ?: [];
            foreach ($request->file('gallery_images', []) as $image) {
                $gallery[] = $this->media->store($image, 'success-stories/gallery');
            }
            $data['gallery'] = array_values(array_unique($gallery));
            $data['updated_by'] = Auth::id();
            $data['created_by'] = $story->exists ? $story->created_by : Auth::id();
            if ($data['approval_status'] === 'approved') {
                $data['approved_by'] = Auth::id();
                $data['approved_at'] = now();
            }

            $story->fill($data)->save();
            $story->tags()->sync($this->tagIds($request->input('tags', '')));
            $this->log($story->wasRecentlyCreated ? 'success_story.created' : 'success_story.updated', $story);

            return $story;
        });
    }

    public function setPublished(SuccessStory $story, bool $published): void
    {
        $story->update([
            'status' => $published ? 'published' : 'draft',
            'approval_status' => $published ? 'approved' : $story->approval_status,
            'publish_date' => $published ? ($story->publish_date ?: now()) : $story->publish_date,
            'approved_by' => $published ? Auth::id() : $story->approved_by,
            'approved_at' => $published ? now() : $story->approved_at,
            'updated_by' => Auth::id(),
        ]);
        $this->log($published ? 'success_story.published' : 'success_story.unpublished', $story);
    }

    public function recordView(SuccessStory $story, Request $request): void
    {
        $story->increment('views_count');
        DB::table('success_story_views')->insert([
            'success_story_id' => $story->id,
            'ip_hash' => hash('sha256', (string) $request->ip()),
            'referer' => Str::limit((string) $request->headers->get('referer'), 255, ''),
            'user_agent' => Str::limit((string) $request->userAgent(), 500, ''),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function log(string $action, SuccessStory $story): void
    {
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'subject_type' => SuccessStory::class,
            'subject_id' => $story->id,
            'properties' => ['title' => $story->title, 'status' => $story->status],
            'ip_address' => request()->ip(),
        ]);
    }

    private function tagIds(string $tags): array
    {
        return collect(explode(',', $tags))
            ->map(fn ($tag) => trim($tag))
            ->filter()
            ->unique()
            ->map(fn ($tag) => Tag::firstOrCreate(['slug' => Str::slug($tag)], ['name' => $tag])->id)
            ->values()
            ->all();
    }
}
