<?php

// database/migrations/xxxx_create_service_sections_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('service_sections', function (Blueprint $table) {
            $table->id();

            // Header
            $table->string('badge_text')->default('Our Solutions');
            $table->string('badge_icon')->default('fa-hand-holding-usd');
            $table->string('heading');
            $table->string('highlighted_text'); // e.g. Marketeers
            $table->text('description');

            // CTA
            $table->string('cta_heading')->default('Ready to grow your marketing business?');
            $table->text('cta_description')->default('Get the financial support you need to scale your marketing efforts and achieve remarkable growth.');
            $table->string('cta_primary_text')->default('Apply for Loan');
            $table->string('cta_primary_link')->default('#');
            $table->string('cta_primary_icon')->default('fa-rocket');
            $table->string('cta_secondary_text')->default('Calculate Payments');
            $table->string('cta_secondary_link')->default('#');
            $table->string('cta_secondary_icon')->default('fa-calculator');

            // Extra Info (3)
            $table->string('info_1_icon')->default('fa-clock');
            $table->string('info_1_title')->default('24-48 Hour Approval');
            $table->string('info_1_subtitle')->default('Quick decisions');
            $table->string('info_2_icon')->default('fa-shield-alt');
            $table->string('info_2_title')->default('No Hidden Fees');
            $table->string('info_2_subtitle')->default('Transparent pricing');
            $table->string('info_3_icon')->default('fa-headset');
            $table->string('info_3_title')->default('Expert Support');
            $table->string('info_3_subtitle')->default('Marketing specialists');

            // Services (6) – JSON
            $table->json('services')->default('[]');

            $table->timestamps();
        });

        // Default data
        DB::table('service_sections')->insert([
            'heading'          => 'Loan Solutions for Marketeers',
            'highlighted_text' => 'Marketeers',
            'description'      => 'We provide specialized financial solutions designed specifically for marketers and entrepreneurs to fuel your growth and marketing initiatives.',
            'services'         => json_encode([
                ['icon' => 'fa-bolt',        'title' => 'Campaign Expansion',    'desc' => 'Scale your successful marketing campaigns with immediate funding for ad spend and content creation.', 'tag' => 'Fast Approval', 'tag_color' => 'primary'],
                ['icon' => 'fa-chart-line',  'title' => 'Business Growth',       'desc' => 'Long-term financing for expanding your marketing agency, team, or operational capacity.', 'tag' => 'Flexible Terms', 'tag_color' => 'secondary'],
                ['icon' => 'fa-tools',       'title' => 'Equipment Financing',   'desc' => 'Fund cameras, computers, and marketing equipment to enhance your creative capabilities.', 'tag' => 'Low Rates', 'tag_color' => 'primary'],
                ['icon' => 'fa-cash-register', 'title' => 'Working Capital',      'desc' => 'Bridge cash flow gaps between client payments and keep your marketing operations running smoothly.', 'tag' => 'Quick Access', 'tag_color' => 'secondary'],
                ['icon' => 'fa-users',       'title' => 'Team Expansion',        'desc' => 'Hire top marketing talent and build your dream team with our specialized hiring loans.', 'tag' => 'Growth Focused', 'tag_color' => 'primary'],
                ['icon' => 'fa-rocket',      'title' => 'Startup Launch',        'desc' => 'Launch your marketing agency or startup with comprehensive funding and expert guidance.', 'tag' => 'Startup Ready', 'tag_color' => 'secondary'],
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('service_sections');
    }
};
