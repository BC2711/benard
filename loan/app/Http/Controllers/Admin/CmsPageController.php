<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Services\FrontendContentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CmsPageController extends Controller
{
    public function __construct(private readonly FrontendContentService $content)
    {
    }

    public function index(Request $request)
    {
        $pages = Page::query()
            ->withCount('sections')
            ->when($request->search, fn ($query, $search) => $query->where('title', 'like', "%$search%")->orWhere('slug', 'like', "%$search%"))
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

    public function store(Request $request)
    {
        $data = $this->validated($request);
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
        $page->load(['sections', 'seoMeta']);
        return view('pages.admin.cms.pages.form', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $data = $this->validated($request, $page);
        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['updated_by'] = Auth::id();

        if (!empty($data['is_homepage'])) {
            Page::whereKeyNot($page->id)->update(['is_homepage' => false]);
        }

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

    private function validated(Request $request, ?Page $page = null): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'slug' => ['nullable', 'string', 'max:180', Rule::unique('pages', 'slug')->ignore($page?->id)],
            'template' => ['required', 'string', 'max:80'],
            'status' => ['required', Rule::in(['draft', 'published', 'archived'])],
            'is_homepage' => ['nullable', 'boolean'],
            'published_at' => ['nullable', 'date'],
            'scheduled_for' => ['nullable', 'date'],
            'content' => ['nullable', 'array'],
        ]);
    }

    private function syncSeo(Page $page, Request $request): void
    {
        $seo = $request->validate([
            'meta_title' => ['nullable', 'string', 'max:180'],
            'meta_description' => ['nullable', 'string', 'max:300'],
            'canonical_url' => ['nullable', 'url'],
            'robots' => ['nullable', 'string', 'max:80'],
            'og_title' => ['nullable', 'string', 'max:180'],
            'og_description' => ['nullable', 'string', 'max:300'],
            'og_image' => ['nullable', 'string', 'max:255'],
        ]);

        $page->seoMeta()->updateOrCreate([], $seo);
    }
}
