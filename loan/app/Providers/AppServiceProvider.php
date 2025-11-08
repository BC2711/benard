<?php

namespace App\Providers;

use App\Models\Menu;
use App\Models\Section;
use Illuminate\Support\Facades\Log;
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
        // Admin sidebar menu - now passing structured data instead of HTML
        view()->composer('layouts.admin.sidebar', function ($view) {
            $menus = $this->get_menus(['ADMIN', 'USER', 'WEB']);
            $menu_data = $this->generateMenuData($menus);
            // dd($menu_data);
            $view->with('menu_data', $menu_data);
        });

        // Website sections (unchanged)
        $this->registerWebsiteSections();
    }

    /**
     * Register all website section view composers
     */
    private function registerWebsiteSections(): void
    {
        $sections = [
            'layouts.website.hero' => 'HERO',
            'layouts.website.smallfeatures' => 'FEATURES',
            'layouts.website.about' => 'ABOUT_US',
            'layouts.website.service' => 'SERVICES',
            'layouts.website.price' => 'PRICE',
            'layouts.website.team' => 'TEAM',
            'layouts.website.project' => 'PROJECT',
            'layouts.website.testimonials' => 'TESTIMONIALS',
            'layouts.website.counter' => 'COUNTER',
            'layouts.website.client' => 'CLIENT',
            'layouts.website.blog' => 'BLOG',
            'layouts.website.contact' => 'CONTACT_US',
            'layouts.website.cta' => 'CTA',
            'layouts.website.footer' => 'FOOTER',
        ];

        foreach ($sections as $view => $sectionType) {
            view()->composer($view, function ($view) use ($sectionType) {
                $sectionData = $this->get_website_section_data($sectionType);
                $view->with('sectionData', $sectionData);
            });
        }
    }

    /**
     * Get website section data
     */
    public function get_website_section_data($sectionType)
    {
        $section = Section::where('section_type', $sectionType)->where('status', 'ACTIVE')->first();
        return $section ? $this->getContentAsArray($section->content) : [];
    }

    /**
     * Convert content to array format
     */
    private function getContentAsArray($content)
    {
        if (is_array($content)) return $content;
        if (is_string($content)) return json_decode($content, true) ?? [];
        if (is_object($content)) return (array) $content;
        return [];
    }

    /**
     * Get menus by type
     */
    public function get_menus($menu_type = ['WEB', 'ADMIN', 'USER'])
    {
        return Menu::whereIn('menu_type', $menu_type)
            ->whereNull('parent_id')
            ->with(['childrenMenus' => function ($query) {
                $query->where('status', 'ACTIVE')
                    ->orderBy('order', 'asc')
                    ->with(['childrenMenus' => function ($subQuery) {
                        $subQuery->where('status', 'ACTIVE')
                            ->orderBy('order', 'asc');
                    }]);
            }])
            ->where('status', 'ACTIVE')
            ->orderBy('order', 'asc')
            ->get();
    }

    /**
     * Generate structured menu data for JavaScript
     */
    public function generateMenuData($menus)
    {
        return $menus->map(function ($menu) {
            return [
                'id' => $menu->id,
                'name' => $menu->name,
                'url' => $this->generateUrl($menu->url),
                'icon' => $menu->icon,
                'order' => $menu->order,
                'children' => $menu->childrenMenus->map(function ($child) {
                    return [
                        'id' => $child->id,
                        'name' => $child->name,
                        'url' => $this->generateUrl($child->url),
                        'icon' => $child->icon,
                        'order' => $child->order,
                        'children' => $child->childrenMenus->map(function ($grandChild) {
                            return [
                                'id' => $grandChild->id,
                                'name' => $grandChild->name,
                                'url' => $this->generateUrl($grandChild->url),
                                'icon' => $grandChild->icon,
                                'order' => $grandChild->order,
                            ];
                        })->toArray()
                    ];
                })->toArray()
            ];
        })->toArray();
    }

    /**
     * Generate proper URL based on the menu URL
     */
    private function generateUrl($url)
    {
        if (empty($url)) return '#';

        // If URL starts with 'http', use as-is
        if (str_starts_with($url, 'http')) {
            return $url;
        }

        // If URL contains dots (likely a route name), use route()
        if (str_contains($url, '.')) {
            try {
                return route($url);
            } catch (\Exception $e) {
                // If route doesn't exist, try with management prefix
                if (!str_starts_with($url, 'management.')) {
                    try {                       
                        return route("management.$url");
                    } catch (\Exception $e) {
                        return url('/');
                    }
                }
                return url('/');
            }
        }

        // If it's a named route without dots, prepend management
        if (!empty($url) && !str_starts_with($url, '/')) {
            try {
                return route("management.$url.index");
            } catch (\Exception $e) {
                return url($url);
            }
        }

        // Otherwise, use url() helper for regular paths
      
        return url($url);
    }
}
