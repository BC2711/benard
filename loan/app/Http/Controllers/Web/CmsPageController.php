<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\FrontendContentService;

class CmsPageController extends Controller
{
    public function __construct(private readonly FrontendContentService $content)
    {
    }

    public function home()
    {
        $page = $this->content->homepage();

        if (!$page) {
            return view('website.index');
        }

        return view('website.cms-page', [
            'cmsPage' => $page,
            'cmsSections' => $page->publishedSections,
        ]);
    }

    public function show(string $slug)
    {
        $page = $this->content->page($slug);
        abort_unless($page, 404);

        return view('website.cms-page', [
            'cmsPage' => $page,
            'cmsSections' => $page->publishedSections,
        ]);
    }
}
