<?php

namespace Tests\Feature;

use App\Models\LoanCalculator;
use App\Models\User;
use Database\Seeders\CmsSeeder;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductionReadinessTest extends TestCase
{
    use RefreshDatabase;

    public function test_seeded_public_pages_and_content_apis_load_successfully(): void
    {
        $this->seed(CmsSeeder::class);

        foreach ([
            '/',
            '/consultation',
            '/calculator',
            '/service-details',
            '/testimonial-reviews',
            '/terms',
            '/privacy',
            '/faq',
            '/api/website/home',
            '/api/website/settings',
            '/api/website/menus/primary',
            '/api/website/media',
            '/api/website/collections/services',
        ] as $path) {
            $this->get($path)->assertOk();
        }
    }

    public function test_non_admin_management_user_cannot_access_admin_panel(): void
    {
        $user = User::factory()->create(['role' => 'USER']);

        $this->actingAs($user, 'management')
            ->get(route('management.dashboard.index'))
            ->assertForbidden();

        $this->actingAs($user, 'management')
            ->get('/notifications/statistics')
            ->assertForbidden();
    }

    public function test_singleton_admin_editors_do_not_expose_unimplemented_create_routes(): void
    {
        $admin = User::factory()->create(['role' => 'ADMIN']);

        foreach ([
            '/management/features/create',
            '/management/service/create',
            '/management/price/create',
            '/management/team/create',
            '/management/project/create',
            '/management/testimonial/create',
            '/management/counter/create',
            '/management/client/create',
            '/management/support/create',
            '/management/footer/create',
        ] as $path) {
            $this->actingAs($admin, 'management')->get($path)->assertMethodNotAllowed();
        }
    }

    public function test_calculator_update_persists_settings_and_payment_schedules(): void
    {
        $admin = User::factory()->create(['role' => 'ADMIN']);
        $calculator = LoanCalculator::firstOrFail();

        $response = $this->actingAs($admin, 'management')
            ->put(route('management.calculator.update', $calculator), [
                'hero_title' => 'Updated Calculator',
                'hero_description' => 'Updated description',
                'stat_loan_range' => 'ZMW 10K-300K',
                'stat_interest_rates' => '8-20%',
                'stat_loan_terms' => '14-180 Days',
                'stat_payment_options' => '1-2x/Week',
                'min_amount' => 10000,
                'max_amount' => 300000,
                'default_amount' => 75000,
                'min_rate' => 8,
                'max_rate' => 20,
                'default_rate' => 12,
                'min_days' => 14,
                'max_days' => 180,
                'default_days' => 60,
                'min_months' => 1,
                'max_months' => 6,
                'default_months' => 2,
                'schedule_days_0' => 2,
                'schedule_label_0' => 'Twice weekly',
                'cta_heading' => 'Apply today',
                'cta_description' => 'Talk to our team',
                'cta_apply_text' => 'Apply',
                'cta_apply_url' => '/#support',
                'cta_contact_text' => 'Contact',
                'cta_contact_url' => '/#support',
            ]);

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('loan_calculators', [
            'id' => $calculator->id,
            'hero_title' => 'Updated Calculator',
            'default_amount' => 75000,
        ]);
        $this->assertSame(
            [['days' => 2, 'label' => 'Twice weekly']],
            $calculator->fresh()->payment_schedules,
        );
    }

    public function test_admin_navigation_pages_load_successfully(): void
    {
        $this->seed(DatabaseSeeder::class);
        $admin = User::factory()->create(['role' => 'ADMIN']);

        foreach ([
            '/management/dashboard',
            '/management/users',
            '/management/users/create',
            '/management/profile',
            '/management/change-password',
            '/management/consultation',
            '/management/consultation?search=test',
            '/management/consultation/create',
            '/management/cms/pages',
            '/management/cms/pages/create',
            '/management/cms/navigation',
            '/management/cms/media',
            '/management/cms/settings',
            '/management/cms/success-stories',
            '/management/cms/success-stories/create',
            '/management/cms/collections/services',
            '/management/hero',
            '/management/about',
            '/management/features',
            '/management/service',
            '/management/price',
            '/management/team',
            '/management/project',
            '/management/testimonial',
            '/management/counter',
            '/management/client',
            '/management/consultation-page',
            '/management/support',
            '/management/calculator',
            '/management/footer',
            '/management/email/settings',
            '/management/email/templates',
            '/management/email/logs',
            '/notifications',
            '/notifications/statistics',
        ] as $path) {
            $this->actingAs($admin, 'management')->get($path)->assertOk();
        }
    }
}
