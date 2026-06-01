<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cms\SaveSuccessStoryRequest;
use App\Models\Category;
use App\Models\Media;
use App\Models\SuccessStoriesSection;
use App\Models\SuccessStory;
use App\Services\SuccessStoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuccessStoryController extends Controller
{
    public function __construct(private readonly SuccessStoryService $stories)
    {
    }

    public function index(Request $request)
    {
        return view('pages.admin.cms.success-stories.index', [
            'stories' => $this->stories->adminQuery($request)->paginate(15)->withQueryString(),
            'categories' => $this->categories(),
            'section' => SuccessStoriesSection::first(),
        ]);
    }

    public function create()
    {
        return view('pages.admin.cms.success-stories.form', $this->formData(new SuccessStory()));
    }

    public function store(SaveSuccessStoryRequest $request)
    {
        $story = $this->stories->save($request);

        return redirect()->route('management.cms.success-stories.edit', $story)->with('success', 'Success story created.');
    }

    public function show(SuccessStory $successStory)
    {
        $successStory->load(['category', 'tags', 'creator', 'approver']);

        return view('pages.admin.cms.success-stories.show', ['story' => $successStory]);
    }

    public function edit(SuccessStory $successStory)
    {
        return view('pages.admin.cms.success-stories.form', $this->formData($successStory->load('tags')));
    }

    public function update(SaveSuccessStoryRequest $request, SuccessStory $successStory)
    {
        $this->stories->save($request, $successStory);

        return back()->with('success', 'Success story updated.');
    }

    public function destroy(SuccessStory $successStory)
    {
        $successStory->delete();
        $this->stories->log('success_story.deleted', $successStory);

        return redirect()->route('management.cms.success-stories.index')->with('success', 'Success story deleted.');
    }

    public function publish(SuccessStory $successStory)
    {
        $this->stories->setPublished($successStory, true);

        return redirect()->route('management.cms.success-stories.index')->with('success', 'Success story published.');
    }

    public function unpublish(SuccessStory $successStory)
    {
        $this->stories->setPublished($successStory, false);

        return redirect()->route('management.cms.success-stories.index')->with('success', 'Success story unpublished.');
    }

    public function bulk(Request $request)
    {
        $data = $request->validate([
            'action' => ['required', 'in:publish,unpublish,delete'],
            'stories' => ['required', 'array'],
            'stories.*' => ['exists:success_stories,id'],
        ]);

        SuccessStory::whereKey($data['stories'])->get()->each(function (SuccessStory $story) use ($data) {
            if ($data['action'] === 'delete') {
                $story->delete();
                $this->stories->log('success_story.deleted', $story);
            } else {
                $this->stories->setPublished($story, $data['action'] === 'publish');
            }
        });

        return back()->with('success', 'Bulk action completed.');
    }

    public function export(Request $request)
    {
        $stories = $this->stories->adminQuery($request)->get();

        return response()->streamDownload(function () use ($stories) {
            $output = fopen('php://output', 'w');
            fputcsv($output, ['Title', 'Customer', 'Category', 'Status', 'Featured', 'Publish Date', 'Views']);
            foreach ($stories as $story) {
                fputcsv($output, [$story->title, $story->customer_name, $story->category?->name, $story->status, $story->is_featured ? 'Yes' : 'No', $story->publish_date, $story->views_count]);
            }
            fclose($output);
        }, 'success-stories-' . now()->format('Y-m-d') . '.csv');
    }

    public function updateHomepageSettings(Request $request)
    {
        $data = $request->validate([
            'homepage_story_limit' => ['required', 'integer', 'min:1', 'max:12'],
            'homepage_story_mode' => ['required', 'in:featured,latest,ordered'],
        ]);
        SuccessStoriesSection::firstOrCreate([])->update($data);

        return back()->with('success', 'Homepage story settings updated.');
    }

    private function formData(SuccessStory $story): array
    {
        return [
            'story' => $story,
            'categories' => $this->categories(),
            'media' => Media::latest()->limit(100)->get(),
        ];
    }

    private function categories()
    {
        return Category::where('type', 'success_story')->orderBy('name')->get();
    }
}
