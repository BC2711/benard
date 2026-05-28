<?php

namespace App\Services;

use App\Models\MenuItem;
use App\Models\Page;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class FrontendContentService
{
    public function homepage(): ?Page
    {
        return Cache::remember('cms.page.home', 300, function () {
            return Page::with(['publishedSections', 'seoMeta'])
                ->published()
                ->where('is_homepage', true)
                ->first();
        });
    }

    public function page(string $slug): ?Page
    {
        $slug = trim($slug, '/') ?: 'home';

        return Cache::remember("cms.page.$slug", 300, function () use ($slug) {
            return Page::with(['publishedSections', 'seoMeta'])
                ->published()
                ->where('slug', $slug)
                ->first();
        });
    }

    public function menu(string $location = 'primary')
    {
        return Cache::remember("cms.menu.$location", 300, function () use ($location) {
            return MenuItem::with(['page', 'children.page'])
                ->published()
                ->whereNull('parent_id')
                ->where('location', $location)
                ->orderBy('sort_order')
                ->get();
        });
    }

    public function settings(?string $group = null): array
    {
        $cacheKey = $group ? "cms.settings.$group" : 'cms.settings.public';

        return Cache::remember($cacheKey, 300, function () use ($group) {
            return Setting::query()
                ->where('is_public', true)
                ->when($group, fn ($query) => $query->where('group', $group))
                ->get()
                ->groupBy('group')
                ->map(fn ($settings) => $settings->pluck('value', 'key')->toArray())
                ->toArray();
        });
    }

    public function clearCache(): void
    {
        Cache::flush();
    }
}
