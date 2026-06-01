@php
    $stories = app(\App\Services\SuccessStoryService::class)->publicQuery(request())->paginate(9)->withQueryString();
    $featuredStories = \App\Models\SuccessStory::published()->where('is_featured', true)->latest('publish_date')->limit(3)->get();
    $categories = \App\Models\Category::where('type', 'success_story')->orderBy('name')->get();
@endphp
@include('website.success-stories.index-content')
