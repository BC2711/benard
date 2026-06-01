<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cms\SavePageSectionRequest;
use App\Models\Page;
use App\Models\PageSection;
use App\Services\FrontendContentService;
use App\Services\CmsVersionService;
use Illuminate\Http\Request;

class CmsPageSectionController extends Controller
{
    public function __construct(
        private readonly FrontendContentService $content,
        private readonly CmsVersionService $versions,
    )
    {
    }

    public function store(SavePageSectionRequest $request, Page $page)
    {
        $data = $request->validated();
        $data['content'] = $this->decodeJson($request->input('content_json'));
        $this->mergeRichText($data['content'], $request);
        $data['settings'] = $this->decodeJson($request->input('settings_json'));

        $page->sections()->create($data);
        $this->content->clearCache();

        return back()->with('success', 'Section added.');
    }

    public function update(SavePageSectionRequest $request, Page $page, PageSection $section)
    {
        abort_unless($section->page_id === $page->id, 404);

        $data = $request->validated();
        $data['content'] = $this->decodeJson($request->input('content_json'));
        $this->mergeRichText($data['content'], $request);
        $data['settings'] = $this->decodeJson($request->input('settings_json'));

        $this->versions->capture($section);
        $section->update($data);
        $this->content->clearCache();

        return back()->with('success', 'Section updated.');
    }

    public function destroy(Page $page, PageSection $section)
    {
        abort_unless($section->page_id === $page->id, 404);
        $section->delete();
        $this->content->clearCache();

        return back()->with('success', 'Section removed.');
    }

    public function reorder(Request $request, Page $page)
    {
        $data = $request->validate([
            'sections' => ['required', 'array'],
            'sections.*.id' => ['required', 'integer'],
            'sections.*.sort_order' => ['required', 'integer'],
        ]);

        foreach ($data['sections'] as $item) {
            $page->sections()->whereKey($item['id'])->update(['sort_order' => $item['sort_order']]);
        }

        $this->content->clearCache();

        return response()->json(['ok' => true]);
    }

    public function duplicate(Page $page, PageSection $section)
    {
        abort_unless($section->page_id === $page->id, 404);
        $copy = $section->replicate(['section_key']);
        $copy->section_key = $section->section_key . '-copy-' . now()->format('His');
        $copy->name = $section->name . ' Copy';
        $copy->sort_order = $section->sort_order + 1;
        $copy->save();
        $this->content->clearCache();

        return back()->with('success', 'Section cloned.');
    }

    private function decodeJson(?string $json): array
    {
        if (!$json) {
            return [];
        }

        $decoded = json_decode($json, true);
        return is_array($decoded) ? $decoded : [];
    }

    private function mergeRichText(array &$content, Request $request): void
    {
        if ($request->filled('body_html')) {
            $content['body'] = $request->input('body_html');
        } else {
            unset($content['body']);
        }
    }
}
