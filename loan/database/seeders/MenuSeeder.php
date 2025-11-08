<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // First, insert the parent menu
        $parentId = DB::table('menus')->insertGetId([
            'name' => 'Website Management',
            'menu_type' => 'WEB',
            'parent_id' => null,
            'url' => '#',
            'icon' => 'fas fa-globe',
            'status' => 'ACTIVE',
            'type' => 'MAIN',
            'order' => 1,
        ]);

        // Then, insert all child menus
        DB::table('menus')->insert([
            [
                'name' => 'Dashboard',
                'menu_type' => 'WEB',
                'parent_id' => $parentId,
                'url' => 'dashboard',
                'icon' => 'fas fa-home',
                'status' => 'ACTIVE',
                'type' => 'SUB',
                'order' => 0,
            ],
            [
                'name' => 'Hero Section',
                'menu_type' => 'WEB',
                'parent_id' => $parentId,
                'url' => 'hero',
                'icon' => 'fas fa-home',
                'status' => 'ACTIVE',
                'type' => 'SUB',
                'order' => 1,
            ],
            [
                'name' => 'About Section',
                'menu_type' => 'WEB',
                'parent_id' => $parentId,
                'url' => 'about',
                'icon' => 'fas fa-info-circle',
                'status' => 'ACTIVE',
                'type' => 'SUB',
                'order' => 2,
            ],
            [
                'name' => 'Feature Section',
                'menu_type' => 'WEB',
                'parent_id' => $parentId,
                'url' => 'features',
                'icon' => 'fas fa-star',
                'status' => 'ACTIVE',
                'type' => 'SUB',
                'order' => 3,
            ],
            [
                'name' => 'Service Section',
                'menu_type' => 'WEB',
                'parent_id' => $parentId,
                'url' => 'service',
                'icon' => 'fas fa-cogs',
                'status' => 'ACTIVE',
                'type' => 'SUB',
                'order' => 4,
            ],
            [
                'name' => 'Loan Plans Section',
                'menu_type' => 'WEB',
                'parent_id' => $parentId,
                'url' => 'price',
                'icon' => 'fas fa-tag',
                'status' => 'ACTIVE',
                'type' => 'SUB',
                'order' => 5,
            ],
            [
                'name' => 'Team Section',
                'menu_type' => 'WEB',
                'parent_id' => $parentId,
                'url' => 'team',
                'icon' => 'fas fa-users',
                'status' => 'ACTIVE',
                'type' => 'SUB',
                'order' => 6,
            ],
             [
                'name' => 'Consult Section',
                'menu_type' => 'WEB',
                'parent_id' => $parentId,
                'url' => 'consultation',
                'icon' => 'fas fa-users',
                'status' => 'ACTIVE',
                'type' => 'SUB',
                'order' => 6,
            ],
            [
                'name' => 'Success Stories Section',
                'menu_type' => 'WEB',
                'parent_id' => $parentId,
                'url' => 'project',
                'icon' => 'fas fa-briefcase',
                'status' => 'ACTIVE',
                'type' => 'SUB',
                'order' => 7,
            ],
            [
                'name' => 'Testimonial Section',
                'menu_type' => 'WEB',
                'parent_id' => $parentId,
                'url' => 'testimonial',
                'icon' => 'fas fa-comments',
                'status' => 'ACTIVE',
                'type' => 'SUB',
                'order' => 8,
            ],
            [
                'name' => 'Counter Section',
                'menu_type' => 'WEB',
                'parent_id' => $parentId,
                'url' => 'counter',
                'icon' => 'fas fa-chart-line',
                'status' => 'ACTIVE',
                'type' => 'SUB',
                'order' => 9,
            ],
            [
                'name' => 'Client Section',
                'menu_type' => 'WEB',
                'parent_id' => $parentId,
                'url' => 'client',
                'icon' => 'fas fa-handshake',
                'status' => 'ACTIVE',
                'type' => 'SUB',
                'order' => 10,
            ],
            // [
            //     'name' => 'Blog Section',
            //     'menu_type' => 'WEB',
            //     'parent_id' => $parentId,
            //     'url' => 'blog',
            //     'icon' => 'fas fa-blog',
            //     'status' => 'ACTIVE',
            //     'type' => 'SUB',
            //     'order' => 11,
            // ],
            [
                'name' => 'Contact Section',
                'menu_type' => 'WEB',
                'parent_id' => $parentId,
                'url' => 'support',
                'icon' => 'fas fa-envelope',
                'status' => 'ACTIVE',
                'type' => 'SUB',
                'order' => 11,
            ],
            // [
            //     'name' => 'CTA Section',
            //     'menu_type' => 'WEB',
            //     'parent_id' => $parentId,
            //     'url' => 'cta',
            //     'icon' => 'fas fa-bullhorn',
            //     'status' => 'ACTIVE',
            //     'type' => 'SUB',
            //     'order' => 13,
            // ],
            [
                'name' => 'Footer Section',
                'menu_type' => 'WEB',
                'parent_id' => $parentId,
                'url' => 'footer',
                'icon' => 'fas fa-shoe-prints',
                'status' => 'ACTIVE',
                'type' => 'SUB',
                'order' => 12,
            ]
        ]);
    }
}
