<?php
// database/migrations/xxxx_create_success_stories_sections_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('success_stories_sections', function (Blueprint $table) {
            $table->id();

            // Header
            $table->string('heading');
            $table->text('description');

            // Stats
            $table->json('stats')->default('[]');

            // Tabs (categories)
            $table->json('categories')->default('[]');

            // CTA
            $table->string('cta_heading');
            $table->text('cta_description');
            $table->string('cta_primary_text')->default('Apply for Funding');
            $table->string('cta_primary_link')->default('/#support');
            $table->string('cta_primary_icon')->default('fa-paper-plane');
            $table->string('cta_secondary_text')->default('View All Case Studies');
            $table->string('cta_secondary_link')->default('#');
            $table->string('cta_secondary_icon')->default('fa-book-open');

            // Success Stories
            $table->json('stories')->default('[]');

            $table->timestamps();
        });

        DB::table('success_stories_sections')->insert([
            'heading' => 'Success Stories: Marketeers We\'ve Empowered',
            'description' => 'Discover how our loan solutions have helped marketing professionals and businesses achieve remarkable growth and success in their campaigns and operations.',
            'stats' => json_encode([
                ['value' => '150+', 'label' => 'Businesses Funded'],
                ['value' => 'ZMW25M+', 'label' => 'Total Funding'],
                ['value' => '94%', 'label' => 'Success Rate'],
                ['value' => '48h', 'label' => 'Avg. Approval Time'],
            ]),
            'categories' => json_encode(['all', 'marketing', 'ecommerce', 'startup']),
            'cta_heading' => 'Ready to create your success story?',
            'cta_description' => 'Join hundreds of marketeers who have transformed their businesses with our loans',
            'stories' => json_encode([
                [
                    'title' => 'SocialBoost Media',
                    'amount' => 'ZMW75,000 Growth Loan',
                    'category' => 'marketing',
                    'funding' => 'ZMW75K',
                    'type' => 'Marketing Agency',
                    'result' => '150% Revenue Growth',
                    'time' => '6 Months',
                    'description' => 'Used funding to hire specialized talent and scale client acquisition efforts, resulting in 150% revenue growth.',
                    'overlay_title' => 'SocialBoost Media',
                    'overlay_desc' => 'Expanded team and doubled client roster within 6 months',
                    'tags' => ['Marketing Agency', 'Growth'],
                    'gradient_from' => 'primary-700',
                    'gradient_to' => 'accent-500',
                ],
                [
                    'title' => 'EcomPulse',
                    'amount' => 'ZMW125,000 Expansion Loan',
                    'category' => 'ecommerce',
                    'funding' => 'ZMW125K',
                    'type' => 'E-commerce Brand',
                    'result' => '3 New Markets',
                    'time' => '9 Months',
                    'description' => 'Expanded product offerings and entered new international markets, increasing monthly revenue by 200%.',
                    'overlay_title' => 'EcomPulse',
                    'overlay_desc' => 'Launched 3 new product lines and expanded to European markets',
                    'tags' => ['E-commerce', 'International'],
                    'gradient_from' => 'primary-600',
                    'gradient_to' => 'accent-400',
                ],
                [
                    'title' => 'AdTech Innovations',
                    'amount' => 'ZMW250,000 Scale-up Loan',
                    'category' => 'startup',
                    'funding' => 'ZMW250K',
                    'type' => 'Tech Startup',
                    'result' => '5 Enterprise Clients',
                    'time' => '12 Months',
                    'description' => 'Built advanced AI-powered advertising platform and secured contracts with Fortune 500 companies.',
                    'overlay_title' => 'AdTech Innovations',
                    'overlay_desc' => 'Developed proprietary AI technology and secured enterprise clients',
                    'tags' => ['Tech Startup', 'AI Technology'],
                    'gradient_from' => 'primary-800',
                    'gradient_to' => 'accent-600',
                ],
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('success_stories_sections');
    }
};
