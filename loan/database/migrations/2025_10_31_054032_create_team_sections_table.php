<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('team_sections', function (Blueprint $table) {
            $table->id();
            $table->string('heading');
            $table->text('description');
            $table->string('cta_heading');
            $table->text('cta_description');
            $table->string('cta_primary_text');
            $table->string('cta_primary_link');
            $table->string('cta_primary_icon');
            $table->string('cta_secondary_text');
            $table->string('cta_secondary_link');
            $table->string('cta_secondary_icon');
            $table->json('members'); // Stores array of team members
            $table->timestamps();
        });

        // Seed default data
        $this->seedDefaultData();
    }

    /**
     * Seed the default team section data.
     */
    private function seedDefaultData(): void
    {
        $members = [
            [
                'name' => 'Sarah Johnson',
                'role' => 'Senior Financial Advisor',
                'bio' => 'Specializing in marketing business financing with over 10 years of experience helping agencies scale.',
                'image' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                'social' => [
                    ['icon' => 'fa-linkedin-in', 'url' => '#', 'color' => 'primary'],
                    ['icon' => 'fa-twitter', 'url' => '#', 'color' => 'primary'],
                    ['icon' => 'fa-facebook-f', 'url' => '#', 'color' => 'primary'],
                ],
            ],
            [
                'name' => 'Michael Chen',
                'role' => 'Loan Strategy Director',
                'bio' => 'Expert in creating customized financing solutions for growing marketing firms and startups.',
                'image' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                'social' => [
                    ['icon' => 'fa-linkedin-in', 'url' => '#', 'color' => 'accent'],
                    ['icon' => 'fa-twitter', 'url' => '#', 'color' => 'accent'],
                ],
            ],
            [
                'name' => 'Elena Rodriguez',
                'role' => 'Business Funding Specialist',
                'bio' => 'Focused on helping marketing agencies secure growth capital with favorable terms and conditions.',
                'image' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                'social' => [
                    ['icon' => 'fa-linkedin-in', 'url' => '#', 'color' => 'primary'],
                    ['icon' => 'fa-twitter', 'url' => '#', 'color' => 'primary'],
                    ['icon' => 'fa-facebook-f', 'url' => '#', 'color' => 'primary'],
                ],
            ],
            [
                'name' => 'David Wilson',
                'role' => 'Financial Analyst',
                'bio' => 'Expert in financial modeling and helping marketing businesses optimize their funding strategies.',
                'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                'social' => [
                    ['icon' => 'fa-linkedin-in', 'url' => '#', 'color' => 'accent'],
                    ['icon' => 'fa-twitter', 'url' => '#', 'color' => 'accent'],
                ],
            ],
        ];

        DB::table('team_sections')->insert([
            'heading' => 'Meet Our Financial Experts',
            'description' => 'Our team of financial specialists understands the unique needs of marketeers and entrepreneurs. We\'re here to help you grow your business with the right funding solutions.',
            'cta_heading' => 'Ready to speak with our experts?',
            'cta_description' => 'Get personalized loan advice from professionals who understand marketing businesses',
            'cta_primary_text' => 'Schedule Consultation',
            'cta_primary_link' => '/#support',
            'cta_primary_icon' => 'fa-calendar-check',
            'cta_secondary_text' => 'Meet the Team',
            'cta_secondary_link' => '/#team',
            'cta_secondary_icon' => 'fa-users',
            'members' => json_encode($members),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_sections');
    }
};
