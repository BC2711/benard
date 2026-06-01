<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use App\Models\Page;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class CmsSeeder extends Seeder
{
    public function run(): void
    {
        $home = Page::updateOrCreate(
            ['slug' => 'home'],
            [
                'title' => 'Home',
                'template' => 'homepage',
                'status' => 'published',
                'is_homepage' => true,
                'published_at' => now(),
            ]
        );

        $sections = [
            ['Hero', 'hero', 'website.hero', 10],
            ['Company profile', 'profile', 'website.profile', 20],
            ['About', 'about', 'website.about', 30],
            ['Features', 'features', 'website.features', 40],
            ['Services', 'services', 'website.service', 50],
            ['Statistics', 'statistics', 'website.counter', 60],
            ['Projects', 'projects', 'website.project', 70],
            ['Team', 'team', 'website.team', 80],
            ['Pricing', 'pricing', 'website.price', 90],
            ['Testimonials', 'testimonials', 'website.testimonial', 100],
            ['Clients', 'clients', 'website.client', 110],
            ['Contact', 'support', 'website.contact', 120],
        ];

        foreach ($sections as [$name, $key, $component, $order]) {
            $home->sections()->updateOrCreate(
                ['section_key' => $key],
                [
                    'name' => $name,
                    'component' => $component,
                    'status' => 'published',
                    'sort_order' => $order,
                    'published_at' => now(),
                    'content' => [],
                    'settings' => [],
                ]
            );
        }

        foreach ([
            ['Consultation', 'consultation', 'website.consultation'],
            ['Loan Calculator', 'calculator', 'website.calculator'],
            ['Service Details', 'service-details', 'website.service_details'],
            ['Testimonials', 'testimonial-reviews', 'website.review_testimonials'],
            ['Success Stories', 'view-success-stories', 'website.case'],
        ] as [$title, $slug, $component]) {
            $page = Page::updateOrCreate(
                ['slug' => $slug],
                ['title' => $title, 'status' => 'published', 'published_at' => now()]
            );
            $page->sections()->updateOrCreate(
                ['section_key' => $slug],
                [
                    'name' => $title,
                    'type' => 'custom',
                    'component' => $component,
                    'status' => 'published',
                    'published_at' => now(),
                ]
            );
        }

        foreach ([
            ['Terms & Conditions', 'terms', 'Terms & Conditions', 'Please review the terms that govern the use of Londa Loans services.'],
            ['Privacy Policy', 'privacy', 'Privacy Policy', 'Learn how Londa Loans handles personal information submitted through this website.'],
            ['Frequently Asked Questions', 'faq', 'Frequently Asked Questions', 'Find answers to common questions about Londa Loans products and services.'],
        ] as [$title, $slug, $heading, $body]) {
            $page = Page::updateOrCreate(
                ['slug' => $slug],
                ['title' => $title, 'status' => 'published', 'published_at' => now()]
            );
            $page->sections()->updateOrCreate(
                ['section_key' => $slug],
                [
                    'name' => $heading,
                    'type' => 'content',
                    'component' => 'website.content-block',
                    'status' => 'published',
                    'published_at' => now(),
                    'content' => ['title' => $heading, 'body' => $body],
                ]
            );
        }

        $home->seoMeta()->updateOrCreate([], [
            'meta_title' => 'Londa Loans - Flexible business funding for marketeers',
            'meta_description' => 'Fast, flexible financing solutions for Zambian marketeers, entrepreneurs, and small teams.',
            'og_title' => 'Londa Loans',
            'og_description' => 'Flexible working capital built for growth.',
            'robots' => 'index,follow',
        ]);

        $settings = [
            ['site', 'brand_name', ['Londa Loans']],
            ['site', 'meta_description', ['Flexible financing solutions for marketeers and growing businesses.']],
            ['site', 'consultation_url', ['/consultation']],
            ['contact', 'email', ['hello@londaloans.com']],
            ['contact', 'phone', ['+260 965508033']],
            ['contact', 'address', ['Lusaka, Zambia']],
        ];

        foreach ($settings as [$group, $key, $value]) {
            Setting::updateOrCreate(
                ['group' => $group, 'key' => $key],
                ['value' => $value, 'type' => 'text', 'is_public' => true]
            );
        }

        $menuItems = [
            ['Home', '/', 'fas fa-home', 10],
            ['About', '/#about', 'fas fa-building-columns', 20],
            ['Features', '/#features', 'fas fa-star', 30],
            ['Services', '/#services', 'fas fa-hand-holding-dollar', 40],
            ['Calculator', '/calculator', 'fas fa-calculator', 50],
            ['Contact', '/#support', 'fas fa-envelope', 60],
            ['Success Stories', '/success-stories', 'fas fa-trophy', 70],
        ];

        foreach ($menuItems as [$label, $url, $icon, $order]) {
            MenuItem::updateOrCreate(
                ['location' => 'primary', 'label' => $label],
                ['url' => $url, 'icon' => $icon, 'status' => 'published', 'sort_order' => $order]
            );
        }
    }
}
