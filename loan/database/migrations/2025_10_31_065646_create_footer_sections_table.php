<?php

// database/migrations/xxxx_create_footer_sections_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('footer_sections', function (Blueprint $table) {
            $table->id();

            // Brand
            $table->string('brand_name');
            $table->string('brand_tagline');
            $table->text('brand_description');
            $table->string('email');
            $table->string('address_line1');
            $table->string('address_line2');
            $table->string('phone');

            // Social Links
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('instagram')->nullable();

            // Quick Links
            $table->json('quick_links')->default('[]');

            // Resources
            $table->json('resources')->default('[]');

            // Newsletter
            $table->string('newsletter_heading');
            $table->text('newsletter_description');

            // Trust Badges
            $table->json('trust_badges')->default('[]');

            // Legal Links
            $table->json('legal_links')->default('[]');

            // Copyright
            $table->string('copyright_text');
            $table->string('footer_note');

            $table->timestamps();
        });

        DB::table('footer_sections')->insert([
            'brand_name' => 'LondaLoans',
            'brand_tagline' => 'Empowering Marketeers',
            'brand_description' => 'Providing specialized financial solutions for marketing professionals and entrepreneurs to fuel business growth and campaign success.',
            'email' => 'binesschama1127@gmail.cpm',
            'address_line1' => '123 Finance District',
            'address_line2' => 'Lusaka',
            'phone' => '+260 965508033',
            'facebook' => '#',
            'twitter' => '#',
            'linkedin' => '#',
            'instagram' => '#',
            'quick_links' => json_encode([
                ['text' => 'About Us', 'url' => '/#about'],
                // ['text' => 'Loan Products', 'url' => '/loans'],
                ['text' => 'Apply Now', 'url' => '/#support'],
                ['text' => 'Contact', 'url' => '/#support'],
                ['text' => 'Success Stories', 'url' => '/#success-stories'],
            ]),
            'resources' => json_encode([
                // ['text' => 'Blog & Insights', 'url' => '/blog'],
                // ['text' => 'FAQ', 'url' => '/faq'],
                // ['text' => 'Business Guides', 'url' => '/guides'],
                ['text' => 'Loan Calculator', 'url' => '/calculator'],
                // ['text' => 'Marketing Resources', 'url' => '/resources'],
            ]),
            'newsletter_heading' => 'Stay Updated',
            'newsletter_description' => 'Get marketing finance tips, loan insights, and industry updates delivered to your inbox.',
            'trust_badges' => json_encode([
                ['icon' => 'fa-shield-alt', 'text' => 'SSL Secure'],
                ['icon' => 'fa-lock', 'text' => 'GDPR Compliant'],
                ['icon' => 'fa-award', 'text' => 'Licensed Lender'],
            ]),
            'legal_links' => json_encode([
                ['text' => 'Privacy Policy', 'url' => '/#privacy'],
                ['text' => 'Terms of Service', 'url' => '/#terms'],
                ['text' => 'Compliance', 'url' => '/#compliance'],
                ['text' => 'Cookie Policy', 'url' => '/#cookies'],
                ['text' => 'Disclaimer', 'url' => '/#disclaimer'],
            ]),
            'copyright_text' => '© 2025 LondaLoans. All rights reserved.',
            'footer_note' => 'Empowering marketeers with financial solutions',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('footer_sections');
    }
};
