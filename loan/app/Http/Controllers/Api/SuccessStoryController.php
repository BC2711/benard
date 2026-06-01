<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SuccessStoryResource;
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
        return SuccessStoryResource::collection($this->stories->publicQuery($request)->paginate(12));
    }

    public function show(SuccessStory $successStory)
    {
        abort_unless(SuccessStory::published()->whereKey($successStory->id)->exists(), 404);

        return new SuccessStoryResource($successStory->load(['category', 'tags']));
    }
}
