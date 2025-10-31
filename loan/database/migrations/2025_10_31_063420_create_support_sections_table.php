<?php

// database/migrations/xxxx_create_support_sections_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('support_sections', function (Blueprint $table) {
            $table->id();

            // Header
            $table->string('heading');
            $table->text('description');

            // 3-Step Process
            $table->json('steps')->default('[]');

            // Contact Info
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address_line1')->nullable();
            $table->string('address_line2')->nullable();
            $table->string('hours_line1')->nullable();
            $table->string('hours_line2')->nullable();

            // Social Links
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('instagram')->nullable();

            // Form Settings
            $table->string('form_heading');
            $table->string('form_subheading');

            // Trust Indicators
            $table->json('trust_indicators')->default('[]');

            $table->timestamps();
        });

        DB::table('support_sections')->insert([
            'heading' => 'Get Started with Your Loan Application',
            'description' => 'Ready to fund your next marketing success? Our team is here to help you navigate the loan process and find the perfect financing solution for your business.',
            'steps' => json_encode([
                ['number' => 1, 'title' => 'Submit Application', 'desc' => 'Fill out our simple online form'],
                ['number' => 2, 'title' => 'Consultation', 'desc' => 'Speak with our loan specialist'],
                ['number' => 3, 'title' => 'Get Funded', 'desc' => 'Receive funds in 24-48 hours'],
            ]),
            'email' => 'loans@finexpert.com',
            'phone' => '+1 (800) 555-1234',
            'address_line1' => '123 Finance District',
            'address_line2' => 'San Francisco, CA 94105',
            'hours_line1' => 'Mon-Fri: 8AM-6PM PST',
            'hours_line2' => 'Sat: 9AM-2PM PST',
            'facebook' => '#',
            'twitter' => '#',
            'linkedin' => '#',
            'instagram' => '#',
            'form_heading' => 'Start Your Application',
            'form_subheading' => 'Fill out the form below and our team will contact you within 24 hours',
            'trust_indicators' => json_encode([
                ['icon' => 'fa-lock', 'title' => 'Secure & Encrypted', 'desc' => 'Bank-level security for all applications'],
                ['icon' => 'fa-clock', 'title' => '24-Hour Response', 'desc' => 'Quick turnaround on all applications'],
                ['icon' => 'fa-check-circle', 'title' => 'No Hidden Fees', 'desc' => 'Transparent pricing with no surprises'],
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('support_sections');
    }
};
