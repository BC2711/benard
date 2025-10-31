<?php

// database/migrations/xxxx_create_testimonials_sections_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('testimonials_sections', function (Blueprint $table) {
            $table->id();

            // Header
            $table->string('heading');
            $table->text('description');

            // Video Highlight
            $table->string('video_title')->default("Sarah's Success Story");
            $table->text('video_description')->default('See how Sarah transformed her marketing agency with our growth funding');
            $table->string('video_image')->default('https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80');
            $table->string('video_url')->nullable(); // Optional YouTube/Vimeo

            // Stats
            $table->json('stats')->default('[]');

            // CTA
            $table->string('cta_heading');
            $table->text('cta_description');
            $table->string('cta_primary_text')->default('Apply Now');
            $table->string('cta_primary_link')->default('#consultation');
            $table->string('cta_primary_icon')->default('fa-paper-plane');
            $table->string('cta_secondary_text')->default('Read More Reviews');
            $table->string('cta_secondary_link')->default('#testimonials');
            $table->string('cta_secondary_icon')->default('fa-star');

            // Testimonials
            $table->json('testimonials')->default('[]');

            $table->timestamps();
        });

        DB::table('testimonials_sections')->insert([
            'heading' => 'What Our Marketeers Say',
            'description' => 'Hear from marketing professionals and entrepreneurs who have transformed their businesses with our funding solutions.',
            'video_title' => "Sarah's Success Story",
            'video_description' => 'See how Sarah transformed her marketing agency with our growth funding',
            'video_image' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80',
            'stats' => json_encode([
                ['value' => '150+', 'label' => 'Businesses Funded'],
                ['value' => '$25M+', 'label' => 'Total Funding'],
                ['value' => '94%', 'label' => 'Success Rate'],
                ['value' => '4.9/5', 'label' => 'Client Rating'],
            ]),
            'cta_heading' => 'Join hundreds of successful marketeers',
            'cta_description' => 'Get the funding you need to take your marketing business to the next level',
            'testimonials' => json_encode([
                [
                    'name' => 'Sarah Johnson',
                    'role' => 'CEO, SocialBoost Media',
                    'quote' => "The funding from FinExpert completely transformed our agency. We were able to hire specialized talent and scale our client acquisition efforts, resulting in 150% revenue growth in just 6 months. The flexible repayment terms were perfect for our seasonal business.",
                    'image' => 'https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80',
                    'rating' => 5,
                ],
                [
                    'name' => 'Michael Chen',
                    'role' => 'Founder, EcomPulse',
                    'quote' => "Expanding our e-commerce brand to international markets seemed impossible until we connected with FinExpert. Their expansion loan and market entry support helped us launch in three European countries. Our monthly revenue increased by 200% within 9 months.",
                    'image' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80',
                    'rating' => 5,
                ],
                [
                    'name' => 'Elena Rodriguez',
                    'role' => 'CTO, AdTech Innovations',
                    'quote' => "As a tech startup, we had groundbreaking AI technology but lacked the capital to scale. FinExpert's scale-up loan with technical milestones was exactly what we needed. We secured five Fortune 500 clients and increased our valuation by $2 million in just 12 months.",
                    'image' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80',
                    'rating' => 5,
                ],
                [
                    'name' => 'David Wilson',
                    'role' => 'Founder, ContentCraft Studio',
                    'quote' => "Transitioning from freelancer to agency owner was daunting, but FinExpert made it possible. Their business loan and mentorship program gave me the confidence and resources to build a team and secure retainer clients. We've grown revenue by 120% in our first year.",
                    'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80',
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
