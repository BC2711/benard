<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hero_sections', function (Blueprint $table) {
            $table->id();
            $table->string('brand_name')->default('Londa');
            $table->string('brand_tagline')->default('empowering marketeers');
            $table->string('heading');
            $table->string('highlighted_text');
            $table->text('description');
            $table->string('cta_text')->default('Get Started Now');
            $table->string('cta_link')->default('#application');
            $table->string('phone_number')->default('+1 (234) 567-89');
            $table->string('phone_label')->default('For any question or concern');

            // Trust Indicators
            $table->string('stat_1_value')->default('500+');
            $table->string('stat_1_label')->default('Campaigns Funded');
            $table->string('stat_2_value')->default('98%');
            $table->string('stat_2_label')->default('Approval Rate');
            $table->string('stat_3_value')->default('24h');
            $table->string('stat_3_label')->default('Fast Processing');
            $table->string('stat_4_value')->default('$10M+');
            $table->string('stat_4_label')->default('Loans Disbursed');

            // Image Card
            $table->string('card_title')->default('Business Growth');
            $table->text('card_description')->default('Scale your marketing campaigns with our tailored financing solutions');
            $table->string('hero_image')->nullable();
            // Floating Badges
            $table->string('badge_1_icon')->default('fa-rocket');
            $table->string('badge_1_title')->default('Fast Approval');
            $table->string('badge_1_subtitle')->default('24 Hours');

            $table->string('badge_2_icon')->default('fa-shield-alt');
            $table->string('badge_2_title')->default('Secure');
            $table->string('badge_2_subtitle')->default('Protected');

            $table->timestamps();
        });

        // Insert default data
        DB::table('hero_sections')->insert([
            'heading' => 'Get a Loan for Your Business Growth or Startup',
            'highlighted_text' => 'Business Growth',
            'description' => 'Fast, flexible financing solutions designed specifically for marketers and entrepreneurs. Grow your business with our tailored loan programs and expert financial guidance.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('hero_sections');
    }
};
