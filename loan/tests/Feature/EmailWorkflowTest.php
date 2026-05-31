<?php

namespace Tests\Feature;

use App\Models\EmailDeliveryLog;
use App\Models\EmailSetting;
use App\Models\LoanApplication;
use App\Models\NewsletterSubscriber;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class EmailWorkflowTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Mail::fake();
        EmailSetting::create(['key' => 'admin_recipients', 'value' => 'admin@example.com']);
    }

    public function test_newsletter_subscription_queues_customer_and_admin_emails(): void
    {
        $response = $this->postJson(route('newsletter.subscribe'), ['email' => 'reader@example.com']);

        $response->assertOk()->assertJson(['success' => true]);
        $this->assertDatabaseHas(NewsletterSubscriber::class, ['email' => 'reader@example.com']);
        $this->assertDatabaseHas(EmailDeliveryLog::class, ['template_key' => 'newsletter.confirmation', 'recipient' => 'reader@example.com', 'status' => 'sent']);
        $this->assertDatabaseHas(EmailDeliveryLog::class, ['template_key' => 'newsletter.admin', 'recipient' => 'admin@example.com', 'status' => 'sent']);
    }

    public function test_loan_application_is_persisted_and_emails_both_parties(): void
    {
        $response = $this->postJson(route('loan-application.store'), [
            'fullname' => 'Alex Customer',
            'email' => 'alex@example.com',
            'phone' => '+260955000000',
            'company' => 'Example Company',
            'businessType' => 'marketing-agency',
            'loanAmount' => '25k-75k',
            'loanPurpose' => 'business-expansion',
            'timeline' => '1-month',
            'message' => 'Funding for a new campaign.',
        ]);

        $response->assertOk()->assertJson(['success' => true]);
        $this->assertDatabaseHas(LoanApplication::class, ['email' => 'alex@example.com']);
        $this->assertDatabaseHas(EmailDeliveryLog::class, ['template_key' => 'loan_application.admin', 'recipient' => 'admin@example.com']);
        $this->assertDatabaseHas(EmailDeliveryLog::class, ['template_key' => 'loan_application.confirmation', 'recipient' => 'alex@example.com']);
    }

    public function test_consultation_request_is_persisted_and_emails_both_parties(): void
    {
        $response = $this->postJson(route('consultation.store'), [
            'first_name' => 'Alex',
            'last_name' => 'Customer',
            'email' => 'alex@example.com',
            'phone' => '+260955000000',
            'preferred_date' => now()->addDay()->format('Y-m-d'),
            'preferred_time' => '09:00',
        ]);

        $response->assertOk()->assertJson(['success' => true]);
        $this->assertDatabaseHas('consultation_requests', ['email' => 'alex@example.com']);
        $this->assertDatabaseHas(EmailDeliveryLog::class, ['template_key' => 'consultation.admin', 'recipient' => 'admin@example.com']);
        $this->assertDatabaseHas(EmailDeliveryLog::class, ['template_key' => 'consultation.confirmation', 'recipient' => 'alex@example.com']);
    }

    public function test_registration_requires_email_verification_and_queues_verification_email(): void
    {
        $response = $this->postJson(route('register'), [
            'first_name' => 'Alex',
            'last_name' => 'Customer',
            'email' => 'alex@example.com',
            'phone_number' => '+260955000001',
            'date_of_birth' => now()->subYears(25)->format('Y-m-d'),
            'password' => 'Password123!',
            'confirm_password' => 'Password123!',
            'terms' => '1',
        ]);

        $response->assertOk()->assertJson(['success' => true]);
        $this->assertDatabaseHas(User::class, ['email' => 'alex@example.com', 'status' => 'PENDING', 'email_verified_at' => null]);
        $this->assertDatabaseHas(EmailDeliveryLog::class, ['template_key' => 'auth.registration_verification', 'recipient' => 'alex@example.com']);
    }

    public function test_password_reset_uses_logged_templated_email(): void
    {
        $user = User::factory()->create(['role' => 'ADMIN']);

        $response = $this->post(route('management.password.email'), ['email' => $user->email]);

        $response->assertSessionHas('status');
        $this->assertDatabaseHas(EmailDeliveryLog::class, ['template_key' => 'auth.password_reset', 'recipient' => $user->email]);
    }

    public function test_tracking_pixel_and_action_redirect_update_delivery_log(): void
    {
        $log = EmailDeliveryLog::create([
            'tracking_token' => '11111111-1111-4111-8111-111111111111',
            'template_key' => 'email.test',
            'recipient' => 'alex@example.com',
            'subject' => 'Test',
            'context' => ['action_url' => route('website.home')],
            'status' => 'sent',
        ]);

        $this->get(route('email.track.open', $log->tracking_token))->assertOk();
        $this->get(route('email.track.click', $log->tracking_token))->assertRedirect(route('website.home'));

        $this->assertNotNull($log->fresh()->opened_at);
        $this->assertNotNull($log->fresh()->clicked_at);
    }

    public function test_management_login_queues_two_factor_code_when_enabled(): void
    {
        EmailSetting::updateOrCreate(['key' => 'two_factor_enabled'], ['value' => true]);
        $admin = User::factory()->create(['role' => 'ADMIN']);

        $response = $this->post('/management/login', [
            'email' => $admin->email,
            'password' => 'password',
        ]);

        $response->assertRedirect(route('management.two-factor.form'));
        $this->assertNotNull($admin->fresh()->two_factor_code);
        $this->assertDatabaseHas(EmailDeliveryLog::class, ['template_key' => 'auth.two_factor_code', 'recipient' => $admin->email]);
    }

    public function test_admin_can_open_email_management_pages(): void
    {
        $admin = User::factory()->create(['role' => 'ADMIN']);

        $this->actingAs($admin, 'management')
            ->get(route('management.email-templates.index'))
            ->assertOk();

        $this->actingAs($admin, 'management')
            ->get(route('management.email-settings.edit'))
            ->assertOk();

        $this->actingAs($admin, 'management')
            ->get(route('management.email-logs.index'))
            ->assertOk();
    }
}
