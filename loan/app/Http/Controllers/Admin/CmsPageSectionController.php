<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PageSection;
use App\Services\FrontendContentService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CmsPageSectionController extends Controller
{
    public function __construct(private readonly FrontendContentService $content)
    {
    }

    public function store(Request $request, Page $page)
    {
        $data = $this->validated($request);
        $data['content'] = $this->decodeJson($request->input('content_json'));
        $data['settings'] = $this->decodeJson($request->input('settings_json'));

        $page->sections()->create($data);
        $this->content->clearCache();

        return back()->with('success', 'Section added.');
    }

    public function update(Request $request, Page $page, PageSection $section)
    {
        abort_unless($section->page_id === $page->id, 404);

        $data = $this->validated($request);
        $data['content'] = $this->decodeJson($request->input('content_json'));
        $data['settings'] = $this->decodeJson($request->input('settings_json'));

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

    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:180'],
            'section_key' => ['required', 'string', 'max:120'],
            'component' => ['nullable', 'string', 'max:160'],
            'status' => ['required', Rule::in(['draft', 'published', 'disabled'])],
            'sort_order' => ['required', 'integer', 'min:0'],
            'published_at' => ['nullable', 'date'],
            'scheduled_for' => ['nullable', 'date'],
        ]);
    }

    private function decodeJson(?string $json): array
    {
        if (!$json) {
            return [];
        }

        $decoded = json_decode($json, true);
        return is_array($decoded) ? $decoded : [];
    }
}
