<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SuccessStory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SuccessStorySeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            [
                'title' => 'SocialBoost Media',
                'category' => 'Marketing',
                'customer_name' => 'SocialBoost Media Team',
                'customer_company' => 'SocialBoost Media',
                'customer_occupation' => 'Marketing Agency',
                'summary' => 'A focused growth loan helped SocialBoost Media expand its team and accelerate client acquisition.',
                'content' => '<p>SocialBoost Media used working capital to hire specialized talent and expand client acquisition campaigns. Within six months, the agency increased revenue and doubled its active client roster.</p>',
                'loan_amount' => 75000,
                'business_growth_percentage' => 150,
                'jobs_created' => 4,
                'custom_statistics' => [['label' => 'Timeframe', 'value' => '6 months']],
            ],
            [
                'title' => 'EcomPulse',
                'category' => 'Ecommerce',
                'customer_name' => 'EcomPulse Team',
                'customer_company' => 'EcomPulse',
                'customer_occupation' => 'E-commerce Brand',
                'summary' => 'Expansion funding helped EcomPulse broaden its product range and enter three new markets.',
                'content' => '<p>EcomPulse invested in inventory, fulfillment, and market entry campaigns. The business launched three product lines and expanded to new markets while increasing monthly revenue.</p>',
                'loan_amount' => 125000,
                'business_growth_percentage' => 200,
                'custom_statistics' => [['label' => 'New markets', 'value' => '3']],
            ],
            [
                'title' => 'AdTech Innovations',
                'category' => 'Startup',
                'customer_name' => 'AdTech Innovations Team',
                'customer_company' => 'AdTech Innovations',
                'customer_occupation' => 'Technology Startup',
                'summary' => 'Scale-up capital supported product development and helped AdTech Innovations secure enterprise clients.',
                'content' => '<p>AdTech Innovations invested in product development and enterprise sales. The company completed its advertising platform and secured five enterprise contracts.</p>',
                'loan_amount' => 250000,
                'jobs_created' => 7,
                'custom_statistics' => [['label' => 'Enterprise clients', 'value' => '5']],
            ],
        ] as $index => $data) {
            $category = Category::firstOrCreate(
                ['slug' => 'success-story-' . Str::slug($data['category'])],
                ['name' => $data['category'], 'type' => 'success_story']
            );
            unset($data['category']);

            SuccessStory::updateOrCreate(
                ['slug' => Str::slug($data['title'])],
                [
                    ...$data,
                    'category_id' => $category->id,
                    'currency' => 'ZMW',
                    'is_featured' => true,
                    'show_on_homepage' => true,
                    'show_on_landing_pages' => true,
                    'status' => 'published',
                    'approval_status' => 'approved',
                    'publish_date' => now(),
                    'approved_at' => now(),
                    'display_order' => ($index + 1) * 10,
                ]
            );
        }
    }
}
