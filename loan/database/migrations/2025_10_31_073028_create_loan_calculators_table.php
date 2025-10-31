<?php

// database/migrations/xxxx_create_loan_calculators_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('loan_calculators', function (Blueprint $table) {
            $table->id();

            // Hero Section
            $table->string('hero_title');
            $table->text('hero_description');

            // Quick Stats
            $table->string('stat_loan_range');
            $table->string('stat_interest_rates');
            $table->string('stat_loan_terms');
            $table->string('stat_payment_options');

            // Calculator Settings
            $table->integer('min_amount');
            $table->integer('max_amount');
            $table->integer('default_amount');
            $table->decimal('min_rate', 5, 2);
            $table->decimal('max_rate', 5, 2);
            $table->decimal('default_rate', 5, 2);
            $table->integer('min_days');
            $table->integer('max_days');
            $table->integer('default_days');
            $table->integer('min_months');
            $table->integer('max_months');
            $table->integer('default_months');

            // Payment Schedules
            $table->json('payment_schedules')->default('[]');

            // CTA
            $table->string('cta_heading');
            $table->text('cta_description');
            $table->string('cta_apply_text');
            $table->string('cta_apply_url');
            $table->string('cta_contact_text');
            $table->string('cta_contact_url');

            $table->timestamps();
        });

        DB::table('loan_calculators')->insert([
            'hero_title' => 'Smart Loan Calculator',
            'hero_description' => 'Calculate your loan payments in Zambian Kwacha with flexible payment schedules designed for marketers',
            'stat_loan_range' => 'ZMW 5K-500K',
            'stat_interest_rates' => '5-30%',
            'stat_loan_terms' => '7-365 Days',
            'stat_payment_options' => '1-3x/Week',
            'min_amount' => 1000,
            'max_amount' => 500000,
            'default_amount' => 50000,
            'min_rate' => 5.00,
            'max_rate' => 30.00,
            'default_rate' => 12.50,
            'min_days' => 7,
            'max_days' => 365,
            'default_days' => 90,
            'min_months' => 1,
            'max_months' => 12,
            'default_months' => 3,
            'payment_schedules' => json_encode([
                ['days' => 3, 'label' => '3 Days/Week'],
                ['days' => 2, 'label' => '2 Days/Week'],
                ['days' => 1, 'label' => '1 Day/Week'],
            ]),
            'cta_heading' => 'Ready to Get Your Loan?',
            'cta_description' => 'Apply now and get approved within 24 hours with our streamlined process',
            'cta_apply_text' => 'Apply Now',
            'cta_apply_url' => '#apply',
            'cta_contact_text' => 'Contact Advisor',
            'cta_contact_url' => '/contact',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('loan_calculators');
    }
};
