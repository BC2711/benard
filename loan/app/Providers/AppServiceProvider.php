<?php

namespace App\Providers;

use App\Models\Menu;
use App\Models\Section;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('layouts.admin.sidebar', function ($view) {
            $menus = $this->get_menus(['WEB']);
            $menu_html = $this->generateMenuHtml($menus);
            $view->with('menu_html', $menu_html);
        });

        view()->composer('layouts.website.hero', function ($view) {
            $heroData = $this->get_hero_data();
            $view->with('heroData', $heroData);
        });
    }

    public function get_hero_data()
    {
        $section = Section::where('section_type', 'HERO')->first();
        return $this->getContentAsArray($section->content);
    }

    private function getContentAsArray($content)
    {
        if (is_array($content)) {
            return $content;
        }

        if (is_string($content)) {
            return json_decode($content, true) ?? [];
        }

        return [];
    }

    public function get_menus($menu_type = ['WEB', 'ADMIN'])
    {
        return Menu::whereIn('menu_type', $menu_type)
            ->whereNull('parent_id')
            ->with(['childrenMenus' => function ($query) {
                $query->where('status', 'ACTIVE')
                    ->orderBy('order', 'asc');
            }])
            ->where('status', 'ACTIVE')
            ->orderBy('order', 'asc')
            ->get();
    }

    public function generateMenuHtml($menus)
    {
        $html = '<div class="mt-6">';

        foreach ($menus as $menu) {
            if ($menu->childrenMenus->isNotEmpty()) {
                // Parent menu with children
                $html .= $this->renderParentWithChildren($menu);
            } else {
                // Single menu item
                $html .= $this->renderSingleMenuItem($menu);
            }
        }

        $html .= '</div>';
        return $html;
    }

    private function renderParentWithChildren($menu)
    {
        $html = '<div class="mb-4">';
        $html .= '  <h3 class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">' . $menu->name . '</h3>';
        $html .= '  <div class="mt-2 space-y-1">';

        foreach ($menu->childrenMenus as $child) {
            $url = $this->generateUrl($child->url);
            $isActive = Request::routeIs($child->url) || Request::routeIs($child->url . '.*');
            $activeClass = $isActive ? 'bg-londa-light text-londa-orange' : 'text-gray-700 hover:bg-londa-light hover:text-londa-orange';

            if ($child->name == 'Dashboard') {
                $html .= '<a href="' . $url . '"
                 class="nav-item active flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-londa-light hover:text-londa-orange">
                 <i class="fas fa-tachometer-alt w-6 text-center"></i>
                 <span class="ml-3 font-medium">' . $child->name . '</span>
             </a>';
            } else {
                $html .= '
                <a href="' . $url . '" class="flex items-center px-4 py-2 text-sm rounded-lg transition duration-150 ease-in-out ' . $activeClass . '">
                    <i class="' . $child->icon . ' w-6 text-center"></i>
                    <span class="ml-3 font-medium">' . $child->name . '</span>
                </a>';
            }
        }

        $html .= '  </div>';
        $html .= '</div>';

        return $html;
    }

    private function renderSingleMenuItem($menu)
    {
        $url = $this->generateUrl($menu->url);
        $isActive = Request::routeIs($menu->url) || Request::routeIs($menu->url . '.*');
        $activeClass = $isActive ? 'bg-londa-light text-londa-orange' : 'text-gray-700 hover:bg-londa-light hover:text-londa-orange';

        $html = '<div class="mt-2">';
        $html .= '
            <a href="' . $url . '" class="flex items-center px-4 py-2 text-sm rounded-lg transition duration-150 ease-in-out ' . $activeClass . '">
                <i class="' . $menu->icon . ' w-6 text-center"></i>
                <span class="ml-3 font-medium">' . $menu->name . '</span>
            </a>';
        $html .= '</div>';

        return $html;
    }

    /**
     * Generate proper URL based on the menu URL
     */
    private function generateUrl($url)
    {
        // If URL starts with 'http', use as-is
        // if (str_starts_with($url, 'http')) {
        //     return $url;
        // }

        // If URL contains dots (likely a route name), use route()
        // if (str_contains($url, '.')) {
        //     return route("management.$url");
        // }

        // Otherwise, use url() helper for regular paths
        return route("management.$url");
    }
}
