<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\FrontendContentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CmsCollectionController extends Controller
{
    private array $collections = [
        'faqs' => 'FAQs',
        'services' => 'Services',
        'features' => 'Features',
        'teams' => 'Team Members',
        'partners' => 'Partners & Clients',
        'portfolios' => 'Portfolio',
        'sliders' => 'Banners & Sliders',
        'contact_details' => 'Contact Details',
        'social_links' => 'Social Links',
    ];

    public function __construct(private readonly FrontendContentService $content)
    {
    }

    public function index(string $type)
    {
        $this->authorizeType($type);

        $items = DB::table($type)
            ->whereNull('deleted_at')
            ->orderBy('sort_order')
            ->paginate(15);

        return view('pages.admin.cms.collections.index', [
            'type' => $type,
            'label' => $this->collections[$type],
            'items' => $items,
        ]);
    }

    public function create(string $type)
    {
        $this->authorizeType($type);

        return view('pages.admin.cms.collections.form', [
            'type' => $type,
            'label' => $this->collections[$type],
            'item' => null,
        ]);
    }

    public function store(Request $request, string $type)
    {
        $this->authorizeType($type);
        $data = $this->validated($request);
        $data['slug'] = $data['slug'] ?: Str::slug($data['title'] ?: Str::random(8));
        $data['content'] = json_encode($this->decodeJson($request->input('content_json')));
        $data['created_at'] = now();
        $data['updated_at'] = now();

        DB::table($type)->insert($data);
        $this->content->clearCache();

        return redirect()->route('management.cms.collections.index', $type)->with('success', 'Content created.');
    }

    public function edit(string $type, int $id)
    {
        $this->authorizeType($type);
        $item = DB::table($type)->where('id', $id)->whereNull('deleted_at')->first();
        abort_unless($item, 404);

        return view('pages.admin.cms.collections.form', [
            'type' => $type,
            'label' => $this->collections[$type],
            'item' => $item,
        ]);
    }

    public function update(Request $request, string $type, int $id)
    {
        $this->authorizeType($type);
        $data = $this->validated($request);
        $data['slug'] = $data['slug'] ?: Str::slug($data['title'] ?: Str::random(8));
        $data['content'] = json_encode($this->decodeJson($request->input('content_json')));
        $data['updated_at'] = now();

        DB::table($type)->where('id', $id)->update($data);
        $this->content->clearCache();

        return back()->with('success', 'Content updated.');
    }

    public function destroy(string $type, int $id)
    {
        $this->authorizeType($type);
        DB::table($type)->where('id', $id)->update(['deleted_at' => now()]);
        $this->content->clearCache();

        return back()->with('success', 'Content archived.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'title' => ['nullable', 'string', 'max:180'],
            'slug' => ['nullable', 'string', 'max:180'],
            'subtitle' => ['nullable', 'string', 'max:180'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'string', 'max:255'],
            'url' => ['nullable', 'string', 'max:255'],
            'status' => ['required', Rule::in(['draft', 'published', 'disabled'])],
            'sort_order' => ['required', 'integer', 'min:0'],
            'published_at' => ['nullable', 'date'],
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

    private function authorizeType(string $type): void
    {
        abort_unless(array_key_exists($type, $this->collections), 404);
    }
}
