<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('testimonials_sections', function (Blueprint $table) {
            // Video
            $table->string('video_image_path')->nullable()->after('video_image');
            $table->string('video_file_path')->nullable()->after('video_url');            
        });
    }

    public function down(): void
    {
        Schema::table('testimonials_sections', function (Blueprint $table) {
            $table->dropColumn(['video_image_path', 'video_file_path']);
        });
    }
};
