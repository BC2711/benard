<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MenuItemResource;
use App\Http\Resources\MediaResource;
use App\Http\Resources\PageResource;
use App\Models\Media;
use App\Services\FrontendContentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebsiteContentController extends Controller
{
    public function __construct(private readonly FrontendContentService $content)
    {
    }

    public function home(): PageResource
    {
        return new PageResource($this->content->homepage() ?? abort(404));
    }

    public function page(string $slug): PageResource
    {
        return new PageResource($this->content->page($slug) ?? abort(404));
    }

    public function menu(string $location = 'primary')
    {
        abort_unless(in_array($location, ['primary', 'footer'], true), 404);

        return MenuItemResource::collection($this->content->menu($location));
    }

    public function settings()
    {
        return response()->json(['data' => $this->content->settings()]);
    }

    public function media(Request $request)
    {
        return MediaResource::collection(
            Media::query()
                ->when($request->folder, fn ($query, $folder) => $query->where('folder', $folder))
                ->when($request->search, fn ($query, $search) => $query->where('name', 'like', "%$search%"))
                ->latest()
                ->paginate(24)
        );
    }

    public function collection(string $type)
    {
        abort_unless(in_array($type, [
            'faqs', 'services', 'features', 'teams', 'partners', 'portfolios',
            'sliders', 'contact_details', 'social_links',
        ], true), 404);

        return response()->json([
            'data' => DB::table($type)
                ->whereNull('deleted_at')
                ->where('status', 'published')
                ->where(fn ($query) => $query->whereNull('published_at')->orWhere('published_at', '<=', now()))
                ->orderBy('sort_order')
                ->get()
                ->map(fn ($item) => [
                    ...((array) $item),
                    'content' => json_decode($item->content ?? '{}', true),
                ]),
        ]);
    }
}
