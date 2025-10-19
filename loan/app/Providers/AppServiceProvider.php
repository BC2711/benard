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
        // Admin sidebar menu
        view()->composer('layouts.admin.sidebar', function ($view) {
            $menus = $this->get_menus(['ADMIN', 'USER', 'WEB']);
            $menu_html = $this->generateMenuHtml($menus);
            $view->with('menu_html', $menu_html);
        });

        // Website sections
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

        if (!$section) {
            // Return empty array if section doesn't exist
            return [];
        }

        return $this->getContentAsArray($section->content);
    }

    /**
     * Convert content to array format
     */
    private function getContentAsArray($content)
    {
        if (is_array($content)) {
            return $content;
        }

        if (is_string($content)) {
            return json_decode($content, true) ?? [];
        }

        if (is_object($content)) {
            return (array) $content;
        }

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
                    ->orderBy('order', 'asc');
            }])
            ->where('status', 'ACTIVE')
            ->orderBy('order', 'asc')
            ->get();
    }

    /**
     * Generate menu HTML
     */
    public function generateMenuHtml($menus)
    {
        $html = '';

        foreach ($menus as $menu) {
            if ($menu->childrenMenus->isNotEmpty()) {
                // Parent menu with children
                $html .= $this->renderParentWithChildren($menu);
            } else {
                // Single menu item
                $html .= $this->renderSingleMenuItem($menu);
            }
        }

        return $html;
    }

    /**
     * Render parent menu with children
     */
    private function renderParentWithChildren($menu)
    {
        $hasActiveChild = false;

        // Check if any child is active
        foreach ($menu->childrenMenus as $child) {
            if ($this->isMenuActive($child->url)) {
                $hasActiveChild = true;
                break;
            }
        }

        $html = '<div class="mb-4">';
        $html .= '  <h3 class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">' . $menu->name . '</h3>';
        $html .= '  <div class="mt-2 space-y-1">';

        foreach ($menu->childrenMenus as $child) {
            $url = $this->generateUrl($child->url);
            $isActive = $this->isMenuActive($child->url);
            $activeClass = $isActive ? 'bg-londa-light text-londa-orange border-l-4 border-londa-orange' : 'text-gray-700 hover:bg-londa-light hover:text-londa-orange border-l-4 border-transparent';

            $html .= '
                <a href="' . $url . '" class="nav-item flex items-center px-4 py-3 rounded-lg transition-all duration-200 ease-in-out ' . $activeClass . '">
                    <i class="' . ($child->icon ?? 'fas fa-circle') . ' w-5 text-center text-sm"></i>
                    <span class="ml-3 font-medium">' . $child->name . '</span>
                    ' . ($isActive ? '<span class="ml-auto w-2 h-2 bg-londa-orange rounded-full"></span>' : '') . '
                </a>';
        }

        $html .= '  </div>';
        $html .= '</div>';

        return $html;
    }

    /**
     * Render single menu item
     */
    private function renderSingleMenuItem($menu)
    {
        $url = $this->generateUrl($menu->url);
        $isActive = $this->isMenuActive($menu->url);
        $activeClass = $isActive ? 'bg-londa-light text-londa-orange border-l-4 border-londa-orange' : 'text-gray-700 hover:bg-londa-light hover:text-londa-orange border-l-4 border-transparent';

        $html = '
            <a href="' . $url . '" class="nav-item flex items-center px-4 py-3 rounded-lg transition-all duration-200 ease-in-out ' . $activeClass . '">
                <i class="' . ($menu->icon ?? 'fas fa-circle') . ' w-5 text-center text-sm"></i>
                <span class="ml-3 font-medium">' . $menu->name . '</span>
                ' . ($isActive ? '<span class="ml-auto w-2 h-2 bg-londa-orange rounded-full"></span>' : '') . '
            </a>';

        return $html;
    }

    /**
     * Check if a menu item is active
     */
    private function isMenuActive($menuUrl)
    {
        $currentRoute = Request::route()->getName();
        $currentPath = Request::path();

        // If menu URL is a route name
        if (str_contains($menuUrl, '.')) {
            // Check exact route match
            if ($currentRoute === $menuUrl) {
                return true;
            }

            // Check if current route starts with menu URL (for nested routes)
            if (str_starts_with($currentRoute, $menuUrl . '.')) {
                return true;
            }

            // Special case for dashboard
            if ($menuUrl === 'management.dashboard' && $currentRoute === 'management.dashboard') {
                return true;
            }
        }

        // If menu URL is a path
        if (str_starts_with($menuUrl, '/')) {
            $menuPath = trim($menuUrl, '/');
            $currentPath = trim($currentPath, '/');

            // Exact path match
            if ($currentPath === $menuPath) {
                return true;
            }

            // Check if current path starts with menu path (for nested paths)
            if (str_starts_with($currentPath, $menuPath)) {
                return true;
            }
        }

        // Special cases for common admin routes
        $specialCases = [
            'users' => ['management.users.index', 'management.users.create', 'management.users.edit', 'management.users.show'],
            'loans' => ['management.loans.index', 'management.loans.create', 'management.loans.edit', 'management.loans.show'],
            'customers' => ['management.customers.index', 'management.customers.create', 'management.customers.edit', 'management.customers.show'],
            'payments' => ['management.payments.index', 'management.payments.create', 'management.payments.edit', 'management.payments.show'],
        ];

        foreach ($specialCases as $menuKey => $routes) {
            if ($menuUrl === $menuKey && in_array($currentRoute, $routes)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Generate proper URL based on the menu URL
     */
    private function generateUrl($url)
    {
        // If URL starts with 'http', use as-is
        if (str_starts_with($url, 'http')) {
            return $url;
        }

        // If URL contains dots (likely a route name), use route()
        if (str_contains($url, '.')) {
            // Check if it's already a full route name
            if (str_starts_with($url, 'management.')) {
                return route($url);
            }
            return route("management.$url");
        }

        // If it's a named route without dots, prepend management
        if (!empty($url) && !str_starts_with($url, '/')) {
            return route("management.$url");
        }

        // Otherwise, use url() helper for regular paths
        return url($url);
    }
}
