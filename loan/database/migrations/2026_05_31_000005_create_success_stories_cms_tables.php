<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('success_stories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('summary')->nullable();
            $table->longText('content')->nullable();
            $table->string('customer_name');
            $table->string('customer_occupation')->nullable();
            $table->string('customer_location')->nullable();
            $table->string('customer_company')->nullable();
            $table->string('customer_photo')->nullable();
            $table->string('featured_image')->nullable();
            $table->json('gallery')->nullable();
            $table->string('video_url')->nullable();
            $table->boolean('is_featured')->default(false)->index();
            $table->boolean('show_on_homepage')->default(false)->index();
            $table->boolean('show_in_testimonials')->default(false)->index();
            $table->boolean('show_on_landing_pages')->default(false)->index();
            $table->string('status')->default('draft')->index();
            $table->string('approval_status')->default('pending')->index();
            $table->timestamp('publish_date')->nullable()->index();
            $table->timestamp('expires_at')->nullable()->index();
            $table->unsignedInteger('display_order')->default(0)->index();
            $table->decimal('loan_amount', 15, 2)->nullable();
            $table->string('currency', 8)->default('ZMW');
            $table->decimal('business_growth_percentage', 8, 2)->nullable();
            $table->decimal('revenue_increase', 15, 2)->nullable();
            $table->unsignedInteger('jobs_created')->nullable();
            $table->json('custom_statistics')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->string('og_image')->nullable();
            $table->unsignedBigInteger('views_count')->default(0);
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('success_story_tag', function (Blueprint $table) {
            $table->foreignId('success_story_id')->constrained('success_stories')->cascadeOnDelete();
            $table->foreignId('tag_id')->constrained('tags')->cascadeOnDelete();
            $table->primary(['success_story_id', 'tag_id']);
        });

        Schema::create('success_story_views', function (Blueprint $table) {
            $table->id();
            $table->foreignId('success_story_id')->constrained('success_stories')->cascadeOnDelete();
            $table->string('ip_hash', 64)->nullable()->index();
            $table->string('referer')->nullable();
            $table->string('user_agent', 500)->nullable();
            $table->timestamps();
        });

        Schema::table('success_stories_sections', function (Blueprint $table) {
            $table->unsignedInteger('homepage_story_limit')->default(3);
            $table->string('homepage_story_mode')->default('featured');
        });

        $section = DB::table('success_stories_sections')->first();
        foreach (json_decode($section?->stories ?? '[]', true) ?: [] as $index => $legacy) {
            $categoryName = ucfirst($legacy['category'] ?? 'General');
            $categorySlug = 'success-story-' . Str::slug($categoryName);
            $categoryId = DB::table('categories')->where('slug', $categorySlug)->value('id');
            if (!$categoryId) {
                $categoryId = DB::table('categories')->insertGetId([
                    'name' => $categoryName,
                    'slug' => $categorySlug,
                    'type' => 'success_story',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            DB::table('success_stories')->insert([
                'category_id' => $categoryId,
                'title' => $legacy['title'],
                'slug' => Str::slug($legacy['title']),
                'summary' => $legacy['description'] ?? null,
                'content' => $legacy['description'] ?? null,
                'customer_name' => $legacy['title'],
                'customer_company' => $legacy['title'],
                'customer_occupation' => $legacy['type'] ?? null,
                'is_featured' => true,
                'show_on_homepage' => true,
                'status' => 'published',
                'approval_status' => 'approved',
                'publish_date' => now(),
                'approved_at' => now(),
                'display_order' => ($index + 1) * 10,
                'custom_statistics' => json_encode([
                    ['label' => 'Key Result', 'value' => $legacy['result'] ?? ''],
                    ['label' => 'Timeframe', 'value' => $legacy['time'] ?? ''],
                    ['label' => 'Funding', 'value' => $legacy['funding'] ?? ''],
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        Schema::table('success_stories_sections', function (Blueprint $table) {
            $table->dropColumn(['homepage_story_limit', 'homepage_story_mode']);
        });
        Schema::dropIfExists('success_story_views');
        Schema::dropIfExists('success_story_tag');
        Schema::dropIfExists('success_stories');
    }
};
