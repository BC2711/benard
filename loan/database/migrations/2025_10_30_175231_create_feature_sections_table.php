<?php

// database/migrations/xxxx_create_feature_sections_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('feature_sections', function (Blueprint $table) {
            $table->id();

            // Header
            $table->string('badge_text')->default('Why Choose Us');
            $table->string('badge_icon')->default('fa-star');
            $table->string('heading');
            $table->string('highlighted_text'); 
            $table->text('description');

            // Trust stats (4)
            $table->string('stat_1_value')->default('500+');
            $table->string('stat_1_label')->default('Marketing Campaigns Funded');
            $table->string('stat_2_value')->default('98%');
            $table->string('stat_2_label')->default('Approval Rate');
            $table->string('stat_3_value')->default('24h');
            $table->string('stat_3_label')->default('Average Processing Time');
            $table->string('stat_4_value')->default('ZMW10M+');
            $table->string('stat_4_label')->default('Loans Disbursed');

            // CTA
            $table->string('cta_heading')->default('Ready to fund your next marketing success?');
            $table->text('cta_description')->default('Join hundreds of marketeers who have scaled their businesses with Londa Loans');
            $table->string('cta_primary_text')->default('Apply for Loan');
            $table->string('cta_primary_link')->default('/#support');
            $table->string('cta_secondary_text')->default('Calculate Payments');
            $table->string('cta_secondary_link')->default('/calculator');

            // Features (6) – JSON array
            $table->json('features')->default('[]');

            $table->timestamps();
        });

        // Default data
        DB::table('feature_sections')->insert([
            'heading'          => 'Why Marketeers Choose Londa Loans',
            'highlighted_text' => 'Londa Loans',
            'description'      => 'We understand the unique financial needs of marketing professionals and have built our services around your success.',
            'features'         => json_encode([
                ['icon' => 'fa-bolt',       'title' => 'Fast Approval',       'desc' => 'Get loan decisions within 24 hours, so you can seize marketing opportunities when they arise.', 'learn_more' => 'Learn more'],
                ['icon' => 'fa-chart-line', 'title' => 'Marketing Expertise', 'desc' => 'Our team understands marketing needs and tailors loans specifically for campaign funding and growth.', 'learn_more' => 'Learn more'],
                ['icon' => 'fa-sliders-h',  'title' => 'Flexible Terms',      'desc' => 'Repayment plans designed around your campaign ROI cycles and revenue patterns.', 'learn_more' => 'Learn more'],
                ['icon' => 'fa-gem',        'title' => 'Transparent Pricing', 'desc' => 'No hidden fees or surprise charges. Know exactly what you’re paying from day one.', 'learn_more' => 'Learn more'],
                ['icon' => 'fa-headset',    'title' => 'Dedicated Support',   'desc' => 'Get personalized assistance from loan specialists who understand marketing businesses.', 'learn_more' => 'Learn more'],
                ['icon' => 'fa-chart-bar',  'title' => 'Scalable Funding',    'desc' => 'Start small and access larger amounts as your marketing success and business grow.', 'learn_more' => 'Learn more'],
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('feature_sections');
    }
};
