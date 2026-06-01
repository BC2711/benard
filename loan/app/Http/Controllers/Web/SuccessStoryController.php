<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SuccessStory;
use App\Services\SuccessStoryService;
use Illuminate\Http\Request;

class SuccessStoryController extends Controller
{
    public function __construct(private readonly SuccessStoryService $stories)
    {
    }

    public function index(Request $request)
    {
        return view('website.success-stories.index', [
            'stories' => $this->stories->publicQuery($request)->paginate(9)->withQueryString(),
            'featuredStories' => SuccessStory::published()->where('is_featured', true)->latest('publish_date')->limit(3)->get(),
            'categories' => Category::where('type', 'success_story')->orderBy('name')->get(),
        ]);
    }

    public function show(Request $request, SuccessStory $successStory)
    {
        abort_unless(SuccessStory::published()->whereKey($successStory->id)->exists(), 404);
        $successStory->load(['category', 'tags']);
        $this->stories->recordView($successStory, $request);

        return view('website.success-stories.show', [
            'story' => $successStory,
            'relatedStories' => SuccessStory::published()
                ->whereKeyNot($successStory->id)
                ->when($successStory->category_id, fn ($q) => $q->where('category_id', $successStory->category_id))
                ->limit(3)
                ->get(),
        ]);
    }
}
