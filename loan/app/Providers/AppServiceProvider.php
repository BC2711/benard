<?php

namespace App\Providers;

use App\Models\Menu;
use App\Services\FrontendContentService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        view()->composer('layouts.admin.sidebar', function ($view) {
            $menus = $this->get_menus(['ADMIN', 'USER', 'WEB']);
            $menu_data = $this->generateMenuData($menus);
            $view->with('menu_data', $menu_data);
        });

        view()->composer(['components.website.header', 'components.website.menu', 'components.website.footer'], function ($view) {
            $content = app(FrontendContentService::class);
            $view->with([
                'frontendSettings' => $content->settings(),
                'primaryMenuItems' => $content->menu('primary'),
                'footerMenuItems' => $content->menu('footer'),
            ]);
        });
    }

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

    private function generateUrl($url)
    {
        if (empty($url)) return '#';

        if (str_starts_with($url, 'http')) {
            return $url;
        }

        if (str_contains($url, '.')) {
            try {
                return route($url);
            } catch (\Exception $e) {
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

        if (!empty($url) && !str_starts_with($url, '/')) {
            try {
                return route("management.$url.index");
            } catch (\Exception $e) {
                return url($url);
            }
        }

        return url($url);
    }
}
