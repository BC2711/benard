<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('loan_plans_sections', function (Blueprint $table) {
            $table->id();

            // Header
            $table->string('heading');
            $table->string('highlighted_text');
            $table->text('description');

            // Toggle
            $table->string('short_term_label')->default('Short Term');
            $table->string('long_term_label')->default('Long Term');
            $table->text('short_term_desc')->default('Perfect for seasonal campaigns and short-term projects');
            $table->text('long_term_desc')->default('Ideal for long-term growth and major expansions');

            // Custom Solution
            $table->string('custom_badge')->default('CUSTOM SOLUTION');
            $table->string('custom_heading')->default('Need a Bespoke Solution?');
            $table->text('custom_description');
            $table->string('custom_link_text')->default('Request Custom Quote');
            $table->string('custom_link')->default('/#support');
            $table->string('custom_link_icon')->default('fa-comment-alt');
            $table->string('custom_flexible_text')->default('Flexible');
            $table->string('custom_flexible_subtext')->default('Tailored to your business');
            $table->string('custom_rate_text')->default('Personalized terms and competitive rates');

            // Custom benefits (3)
            $table->json('custom_benefits')->nullable();

            // Dynamic pricing cards
            $table->json('pricing_cards')->nullable();

            $table->timestamps();
        });

        DB::table('loan_plans_sections')->insert([
            'heading' => 'Smart Financing for Marketing Success',
            'highlighted_text' => 'Marketing Success',
            'description' => 'Tailored loan solutions designed specifically for marketers and agencies. Get the capital you need to scale your campaigns and grow your business.',
            'custom_description' => 'Our financial experts will create a custom loan package tailored to your specific marketing needs and business goals.',
            'custom_benefits' => json_encode([
                'Personalized loan amounts and terms',
                'Flexible repayment schedules',
                'Dedicated account manager'
            ]),
            'pricing_cards' => json_encode([
                // Short Term
                ['type' => 'short', 'name' => 'Starter', 'price' => 'ZMW5,000', 'term' => '3 months', 'rate' => '12%', 'features' => ['Up to ZMW5K', '3-month term', 'Fast approval', 'No collateral'], 'featured' => false],
                ['type' => 'short', 'name' => 'Growth', 'price' => 'ZMW15,000', 'term' => '6 months', 'rate' => '10%', 'features' => ['Up to ZMW15K', '6-month term', 'Priority support', 'Flexible payments'], 'featured' => true],
                ['type' => 'short', 'name' => 'Pro', 'price' => 'ZMW30,000', 'term' => '9 months', 'rate' => '9%', 'features' => ['Up to ZMW30K', '9-month term', 'Dedicated manager', 'Lowest rates'], 'featured' => false],
                // Long Term
                ['type' => 'long', 'name' => 'Agency', 'price' => 'ZMW50,000', 'term' => '24 months', 'rate' => '8%', 'features' => ['Up to ZMW50K', '24-month term', 'Team expansion', 'Equipment funding'], 'featured' => false],
                ['type' => 'long', 'name' => 'Enterprise', 'price' => 'ZMW100,000', 'term' => '36 months', 'rate' => '7%', 'features' => ['Up to ZMW100K', '36-month term', 'Custom ROI terms', 'Full support team'], 'featured' => true],
                ['type' => 'long', 'name' => 'Scale', 'price' => 'ZMW250,000+', 'term' => '48+ months', 'rate' => '6%', 'features' => ['ZMW250K+', 'Custom terms', 'Strategic partnership', 'Growth consulting'], 'featured' => false],
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('loan_plans_sections');
    }
};
