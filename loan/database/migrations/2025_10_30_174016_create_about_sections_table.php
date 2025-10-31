<?php
// database/migrations/xxxx_create_about_sections_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('about_sections', function (Blueprint $table) {
            $table->id();
            // Header
            $table->string('section_label')->default('Why Choose Londa Loans');
            $table->string('heading');
            $table->string('highlighted_text');
            $table->text('description');

            // CTA
            $table->string('cta_text')->default('See How We Empower Marketers');
            $table->string('cta_link')->default('#');

            // Stats (4)
            $table->string('stat_1_value')->default('500+');
            $table->string('stat_1_label')->default('Campaigns Funded');
            $table->string('stat_2_value')->default('98%');
            $table->string('stat_2_label')->default('Approval Rate');
            $table->string('stat_3_value')->default('24h');
            $table->string('stat_3_label')->default('Fast Processing');
            $table->string('stat_4_value')->default('$10M+');
            $table->string('stat_4_label')->default('Loans Disbursed');

            // Features (4) – stored as JSON for easy expansion
            $table->json('features')->default('[]');

            // Images (4)
            $table->string('image_1')->nullable();
            $table->string('image_2')->nullable();
            $table->string('image_3')->nullable();
            $table->string('image_4')->nullable();

            // Floating rating card
            $table->string('rating_icon')->default('fa-star');
            $table->string('rating_value')->default('4.9/5 Rating');
            $table->string('rating_subtitle')->default('Trusted by 500+ marketers');

            $table->timestamps();
        });

        // Insert default data
        DB::table('about_sections')->insert([
            'heading'          => 'We Empower Marketeers with Financial Solutions',
            'highlighted_text' => 'Marketeers',
            'description'      => 'At Londa Loans, we understand the unique financial needs of marketers and entrepreneurs. Our tailored loan programs are designed specifically to fuel your business growth and marketing initiatives with flexible terms and expert support.',
            'features'         => json_encode([
                ['icon' => 'fa-bolt',          'title' => 'Fast Approval',          'desc' => 'Get decisions within 24 hours and funding in 48 hours'],
                ['icon' => 'fa-chart-line',    'title' => 'Marketing Expertise',    'desc' => 'Loans designed specifically for marketing campaigns'],
                ['icon' => 'fa-sliders-h',     'title' => 'Flexible Terms',         'desc' => 'Repayment plans matching your ROI cycles'],
                ['icon' => 'fa-headset',       'title' => 'Dedicated Support',      'desc' => 'Personalized assistance from finance specialists'],
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('about_sections');
    }
};
