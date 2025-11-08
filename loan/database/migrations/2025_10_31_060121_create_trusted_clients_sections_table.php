<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('trusted_clients_sections', function (Blueprint $table) {
            $table->id();

            // Header
            $table->string('heading');
            $table->text('description');

            // Industry Badges
            $table->json('industry_badges')->default('[]');

            // Clients (Carousel)
            $table->json('clients')->default('[]');

            // Success Highlights
            $table->json('highlights')->default('[]');

            // Testimonials
            $table->json('testimonials')->default('[]');

            // CTA
            $table->string('cta_heading');
            $table->text('cta_description');
            $table->string('cta_primary_text')->default('Start Your Application');
            $table->string('cta_primary_link')->default('/#support');
            $table->string('cta_primary_icon')->default('fa-paper-plane');
            $table->string('cta_secondary_text')->default('View Client Stories');
            $table->string('cta_secondary_link')->default('#success-stories');
            $table->string('cta_secondary_icon')->default('fa-book-open');

            // Trust Indicators
            $table->json('trust_indicators')->default('[]');

            $table->timestamps();
        });

        DB::table('trusted_clients_sections')->insert([
            'heading' => 'Trusted by Marketing Professionals',
            'description' => "We're proud to support marketing agencies, content creators, and entrepreneurs who are driving innovation and growth in their industries.",
            'industry_badges' => json_encode([
                ['icon' => 'fa-bullhorn', 'text' => 'Marketing Agencies'],
                ['icon' => 'fa-shopping-cart', 'text' => 'E-commerce Brands'],
                ['icon' => 'fa-pen-fancy', 'text' => 'Content Creators'],
                ['icon' => 'fa-rocket', 'text' => 'Tech Startups'],
            ]),
            'clients' => json_encode([
                [
                    'initials' => 'SB',
                    'name' => 'SocialBoost',
                    'type' => 'Marketing Agency',
                    'description' => 'Specializing in social media marketing for tech startups with proven ROI-driven campaigns.',
                    'tags' => ['Social Media', 'Tech'],
                ],
                [
                    'initials' => 'CC',
                    'name' => 'ContentCraft',
                    'type' => 'Content Studio',
                    'description' => 'Premium content creation studio focused on video production and brand storytelling.',
                    'tags' => ['Video', 'Content'],
                ],
                [
                    'initials' => 'GG',
                    'name' => 'GrowthGurus',
                    'type' => 'Digital Marketing',
                    'description' => 'Data-driven growth marketing agency specializing in scaling e-commerce brands.',
                    'tags' => ['E-commerce', 'Growth'],
                ],
                [
                    'initials' => 'BB',
                    'name' => 'BrandBuilders',
                    'type' => 'Brand Agency',
                    'description' => 'Full-service branding agency creating memorable brand identities and experiences.',
                    'tags' => ['Branding', 'Design'],
                ],
                [
                    'initials' => 'AD',
                    'name' => 'AdVenture Media',
                    'type' => 'Advertising Agency',
                    'description' => 'Performance-focused advertising agency driving measurable results through innovative campaigns.',
                    'tags' => ['PPC', 'Performance'],
                ],
                [
                    'initials' => 'MM',
                    'name' => 'MarketMasters',
                    'type' => 'Consulting Firm',
                    'description' => 'Strategic marketing consultants helping businesses optimize their marketing operations.',
                    'tags' => ['Strategy', 'Consulting'],
                ],
            ]),
            'highlights' => json_encode([
                [
                    'amount' => 'ZMW25K',
                    'client' => 'SocialBoost Agency',
                    'type' => 'Marketing Agency',
                    'result' => 'Campaign funding led to 300% ROI and 50 new enterprise clients in 6 months.',
                    'metric' => '300% ROI',
                    'timeline' => '6 Months',
                ],
                [
                    'amount' => 'ZMW50K',
                    'client' => 'ContentCraft Studios',
                    'type' => 'Content Creators',
                    'result' => 'Expansion funding enabled new video production division and 120% revenue growth.',
                    'metric' => 'New Division',
                    'timeline' => '9 Months',
                ],
                [
                    'amount' => 'ZMW15K',
                    'client' => 'GrowthGurus Inc',
                    'type' => 'Digital Marketing',
                    'result' => 'Seed funding for marketing automation tool resulted in 5x user growth and acquisition offers.',
                    'metric' => '5x Growth',
                    'timeline' => '12 Months',
                ],
            ]),
            'testimonials' => json_encode([
                [
                    'initials' => 'SJ',
                    'name' => 'Sarah Johnson',
                    'role' => 'CEO, SocialBoost Agency',
                    'quote' => "LondaLoan's funding transformed our agency. We went from struggling to scale to becoming industry leaders in just 6 months.",
                ],
                [
                    'initials' => 'MC',
                    'name' => 'Michael Chen',
                    'role' => 'Founder, ContentCraft',
                    'quote' => "The strategic guidance was as valuable as the funding itself. They truly understand marketing businesses.",
                ],
            ]),
            'cta_heading' => 'Ready to join our growing community?',
            'cta_description' => 'Get the funding you need to scale your marketing business',
            'trust_indicators' => json_encode([
                ['icon' => 'fa-check-circle', 'text' => '150+ Happy Clients'],
                ['icon' => 'fa-star', 'text' => '4.9/5 Rating'],
                ['icon' => 'fa-award', 'text' => 'Industry Leader'],
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('trusted_clients_sections');
    }
};
