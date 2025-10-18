<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('description')->nullable();
            $table->enum('status', ['ACTIVE', 'INACTIVE', 'MAINTENANCE'])->default('ACTIVE');
            $table->enum('section_type', ['HERO', 'FEATURES', 'ABOUT_US', 'SERVICES', 'PRICE', 'TEAM', 'PROJECT', 'TESTIMONIALS', 'COUNTER', 'CLIENT', 'BLOG', 'CONTACT_US', 'CTA', 'FAQ', 'FOOTER'])->default('HERO');
            $table->json('content')->nullable();
            $table->date('published_at')->nullable();
            $table->string('author')->nullable();
            $table->string('last_modified_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
