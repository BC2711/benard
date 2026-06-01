<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cms\SavePageRequest;
use App\Models\ContentVersion;
use App\Models\Page;
use App\Services\CmsVersionService;
use App\Services\FrontendContentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CmsPageController extends Controller
{
    public function __construct(
        private readonly FrontendContentService $content,
        private readonly CmsVersionService $versions,
    )
    {
    }

    public function index(Request $request)
    {
        $pages = Page::query()
            ->withCount('sections')
            ->when($request->search, fn ($query, $search) => $query->where('title', 'like', "%$search%")->orWhere('slug', 'like', "%$search%"))
            ->orderBy('display_order')
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('pages.admin.cms.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('pages.admin.cms.pages.form', ['page' => new Page()]);
    }

    public function show(Page $page)
    {
        return redirect()->route('management.cms.pages.edit', $page);
    }

    public function store(SavePageRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['created_by'] = Auth::id();
        $data['updated_by'] = Auth::id();

        if (!empty($data['is_homepage'])) {
            Page::query()->update(['is_homepage' => false]);
        }

        $page = Page::create($data);
        $this->syncSeo($page, $request);
        $this->content->clearCache();

        return redirect()->route('management.cms.pages.edit', $page)->with('success', 'Page created.');
    }

    public function edit(Page $page)
    {
        $page->load(['sections', 'seoMeta', 'versions.creator']);
        return view('pages.admin.cms.pages.form', compact('page'));
    }

    public function update(SavePageRequest $request, Page $page)
    {
        $data = $request->validated();
        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['updated_by'] = Auth::id();

        if (!empty($data['is_homepage'])) {
            Page::whereKeyNot($page->id)->update(['is_homepage' => false]);
        }

        $this->versions->capture($page);
        $page->update($data);
        $this->syncSeo($page, $request);
        $this->content->clearCache();

        return back()->with('success', 'Page updated.');
    }

    public function destroy(Page $page)
    {
        $page->delete();
        $this->content->clearCache();

        return redirect()->route('management.cms.pages.index')->with('success', 'Page deleted.');
    }

    public function duplicate(Page $page)
    {
        $copy = $page->replicate(['slug', 'is_homepage', 'published_at']);
        $copy->fill([
            'title' => $page->title . ' Copy',
            'slug' => Str::slug($page->slug . '-copy-' . now()->format('His')),
            'status' => 'draft',
            'is_homepage' => false,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ])->save();

        foreach ($page->sections as $section) {
            $copy->sections()->create($section->replicate(['page_id'])->toArray());
        }

        if ($page->seoMeta) {
            $copy->seoMeta()->create($page->seoMeta->replicate(['seoable_id', 'seoable_type'])->toArray());
        }

        return redirect()->route('management.cms.pages.edit', $copy)->with('success', 'Page duplicated as a draft.');
    }

    public function preview(Page $page)
    {
        $page->load(['sections', 'seoMeta']);

        return view('website.cms-page', ['cmsPage' => $page, 'cmsSections' => $page->sections]);
    }

    public function restore(Page $page, ContentVersion $version)
    {
        $this->versions->restore($page, $version);
        $this->content->clearCache();

        return back()->with('success', "Page restored to version {$version->version}.");
    }

    private function syncSeo(Page $page, Request $request): void
    {
        $seo = $request->validate([
            'meta_title' => ['nullable', 'string', 'max:180'],
            'meta_description' => ['nullable', 'string', 'max:300'],
            'meta_keywords' => ['nullable', 'string', 'max:500'],
            'canonical_url' => ['nullable', 'url'],
            'robots' => ['nullable', 'string', 'max:80'],
            'og_title' => ['nullable', 'string', 'max:180'],
            'og_description' => ['nullable', 'string', 'max:300'],
            'og_image' => ['nullable', 'string', 'max:255'],
            'twitter_card' => ['nullable', 'string', 'max:80'],
            'twitter_title' => ['nullable', 'string', 'max:180'],
            'twitter_description' => ['nullable', 'string', 'max:300'],
            'twitter_image' => ['nullable', 'string', 'max:255'],
        ]);

        $page->seoMeta()->updateOrCreate([], $seo);
    }
}
