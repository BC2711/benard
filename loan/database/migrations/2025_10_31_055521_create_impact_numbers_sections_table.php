<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('impact_numbers_sections', function (Blueprint $table) {
            $table->id();

            // Header
            $table->string('heading');
            $table->text('description');

            // Main Stats
            $table->json('main_stats')->default('[]');

            // Performance Metrics
            $table->json('performance_metrics')->default('[]');

            // Industry Impact
            $table->json('industry_impact')->default('[]');

            // Growth Timeline
            $table->json('timeline')->default('[]');

            // CTA
            $table->string('cta_heading');
            $table->text('cta_description');
            $table->string('cta_primary_text')->default('Apply Now');
            $table->string('cta_primary_link')->default('/#support');
            $table->string('cta_primary_icon')->default('fa-paper-plane');
            $table->string('cta_secondary_text')->default('Calculate Loan');
            $table->string('cta_secondary_link')->default('/calculator');
            $table->string('cta_secondary_icon')->default('fa-calculator');

            // Trust Badges
            $table->json('trust_badges')->default('[]');

            $table->timestamps();
        });

        DB::table('impact_numbers_sections')->insert([
            'heading' => 'Our Impact in Numbers',
            'description' => 'Real results for marketing professionals and entrepreneurs. See how we\'re transforming businesses through strategic funding.',
            'main_stats' => json_encode([
                ['target' => 500, 'label' => 'Marketing Campaigns Funded', 'icon' => 'fa-bullseye', 'progress' => 95],
                ['target' => 25, 'suffix' => 'M+', 'label' => 'Loans Disbursed', 'icon' => 'fa-dollar-sign', 'progress' => 88],
                ['target' => 98, 'suffix' => '%', 'label' => 'Client Satisfaction Rate', 'icon' => 'fa-heart', 'progress' => 98],
                ['target' => 24, 'suffix' => 'h', 'label' => 'Average Approval Time', 'icon' => 'fa-bolt', 'progress' => 92],
            ]),
            'performance_metrics' => json_encode([
                ['value' => '300%', 'label' => 'Average ROI for Funded Campaigns', 'icon' => 'fa-chart-bar'],
                ['value' => '15min', 'label' => 'Online Application Process', 'icon' => 'fa-clock'],
                ['value' => '0-3%', 'label' => 'Competitive Interest Rates', 'icon' => 'fa-percentage'],
            ]),
            'industry_impact' => json_encode([
                ['value' => '150+', 'label' => 'Marketing Agencies Funded'],
                ['value' => '75+', 'label' => 'E-commerce Brands Supported'],
                ['value' => '50+', 'label' => 'Tech Startups Accelerated'],
                ['value' => '25+', 'label' => 'Industries Served'],
            ]),
            'timeline' => json_encode([
                ['year' => '2025', 'label' => 'Founded', 'detail' => '50+ Clients'],
                ['year' => '2026', 'label' => 'Expansion', 'detail' => 'ZMW5M+ Funding'],
                ['year' => '2027', 'label' => 'Market Leader', 'detail' => 'ZMW25M+ Funding'],
            ]),
            'cta_heading' => 'Ready to join our success stories?',
            'cta_description' => 'Start your application and become our next success story',
            'trust_badges' => json_encode([
                ['icon' => 'fa-shield-alt', 'text' => 'Secure & Confidential'],
                ['icon' => 'fa-lock', 'text' => 'SSL Encrypted'],
                ['icon' => 'fa-badge-check', 'text' => 'Verified Lender'],
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('impact_numbers_sections');
    }
};
