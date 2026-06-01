<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->string('featured_image')->nullable()->after('content');
            $table->unsignedInteger('display_order')->default(0)->index()->after('is_homepage');
            $table->timestamp('expires_at')->nullable()->index()->after('scheduled_for');
        });

        Schema::table('page_sections', function (Blueprint $table) {
            $table->string('type')->default('custom')->index()->after('section_key');
            $table->timestamp('expires_at')->nullable()->index()->after('scheduled_for');
        });

        Schema::table('menu_items', function (Blueprint $table) {
            $table->timestamp('published_at')->nullable()->index()->after('sort_order');
            $table->timestamp('expires_at')->nullable()->index()->after('published_at');
        });

        Schema::table('media', function (Blueprint $table) {
            $table->string('folder')->default('general')->index()->after('disk');
        });

        Schema::table('seo_meta', function (Blueprint $table) {
            $table->text('meta_keywords')->nullable()->after('meta_description');
            $table->string('twitter_title')->nullable()->after('twitter_card');
            $table->text('twitter_description')->nullable()->after('twitter_title');
            $table->string('twitter_image')->nullable()->after('twitter_description');
        });

        Schema::create('content_versions', function (Blueprint $table) {
            $table->id();
            $table->morphs('versionable');
            $table->unsignedInteger('version');
            $table->json('snapshot');
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->unique(['versionable_type', 'versionable_id', 'version']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('content_versions');

        Schema::table('seo_meta', function (Blueprint $table) {
            $table->dropColumn(['meta_keywords', 'twitter_title', 'twitter_description', 'twitter_image']);
        });

        Schema::table('media', function (Blueprint $table) {
            $table->dropColumn('folder');
        });

        Schema::table('menu_items', function (Blueprint $table) {
            $table->dropColumn(['published_at', 'expires_at']);
        });

        Schema::table('page_sections', function (Blueprint $table) {
            $table->dropColumn(['type', 'expires_at']);
        });

        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn(['featured_image', 'display_order', 'expires_at']);
        });
    }
};
