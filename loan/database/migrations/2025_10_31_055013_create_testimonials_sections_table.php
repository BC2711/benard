<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('testimonials_sections', function (Blueprint $table) {
            $table->id();
            $table->string('heading')->nullable();
            $table->text('description')->nullable();

            // Video
            $table->string('video_title')->nullable();
            $table->text('video_description')->nullable();
            $table->string('video_image')->nullable();
            $table->string('video_url')->nullable();

            // Stats (JSON)
            $table->json('stats')->default('[]');

            // CTA
            $table->string('cta_heading')->nullable();
            $table->text('cta_description')->nullable();
            $table->string('cta_primary_text')->nullable();
            $table->string('cta_primary_link')->nullable();
            $table->string('cta_primary_icon')->nullable();
            $table->string('cta_secondary_text')->nullable();
            $table->string('cta_secondary_link')->nullable();
            $table->string('cta_secondary_icon')->nullable();

            // Testimonials (JSON)
            $table->json('testimonials')->default('[]');

            $table->timestamps();
        });

        // Seed initial data
        DB::table('testimonials_sections')->insert([
            'heading' => 'What Our Marketeers Say',
            'description' => 'Hear from marketing professionals and entrepreneurs who have transformed their businesses with our funding solutions.',
            'video_title' => "Sarah's Success Story",
            'video_description' => 'See how Sarah transformed her marketing agency with our growth funding',
            'video_image' => '',
            'video_url' => null,
            'stats' => json_encode([
                ['value' => '150+', 'label' => 'Businesses Funded'],
                ['value' => 'ZMW25M+', 'label' => 'Total Funding'],
                ['value' => '94%', 'label' => 'Success Rate'],
                ['value' => '4.9/5', 'label' => 'Client Rating'],
            ]),
            'cta_heading' => 'Join hundreds of successful marketeers',
            'cta_description' => 'Get the funding you need to take your marketing business to the next level',
            'cta_primary_text' => 'Apply Now',
            'cta_primary_link' => '/#support',
            'cta_primary_icon' => 'fa-paper-plane',
            'cta_secondary_text' => 'Read More Reviews',
            'cta_secondary_link' => '#testimonials',
            'cta_secondary_icon' => 'fa-star',
            'testimonials' => json_encode([
                [
                    'name' => 'Sarah Johnson',
                    'role' => 'CEO, SocialBoost Media',
                    'quote' => "The funding from FinExpert completely transformed our agency. We were able to hire specialized talent and scale our client acquisition efforts, resulting in 150% revenue growth in just 6 months. The flexible repayment terms were perfect for our seasonal business.",
                    'image' => '',
                    'rating' => 5,
                ],
                [
                    'name' => 'Michael Chen',
                    'role' => 'Founder, EcomPulse',
                    'quote' => "Expanding our e-commerce brand to international markets seemed impossible until we connected with FinExpert. Their expansion loan and market entry support helped us launch in three European countries. Our monthly revenue increased by 200% within 9 months.",
                    'image' => '',
                    'rating' => 5,
                ],
                [
                    'name' => 'Elena Rodriguez',
                    'role' => 'CTO, AdTech Innovations',
                    'quote' => "As a tech startup, we had groundbreaking AI technology but lacked the capital to scale. FinExpert's scale-up loan with technical milestones was exactly what we needed. We secured five Fortune 500 clients and increased our valuation by $2 million in just 12 months.",
                    'image' => '',
                    'rating' => 5,
                ],
                [
                    'name' => 'David Wilson',
                    'role' => 'Founder, ContentCraft Studio',
                    'quote' => "Transitioning from freelancer to agency owner was daunting, but FinExpert made it possible. Their business loan and mentorship program gave me the confidence and resources to build a team and secure retainer clients. We've grown revenue by 120% in our first year.",
                    'image' => '',
                    'rating' => 5,
                ],
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('testimonials_sections');
    }
};
