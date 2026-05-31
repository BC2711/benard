<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('email_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        Schema::create('email_templates', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('name');
            $table->string('subject');
            $table->longText('body_html');
            $table->longText('body_text');
            $table->json('variables')->nullable();
            $table->boolean('enabled')->default(true)->index();
            $table->timestamps();
        });

        Schema::create('email_delivery_logs', function (Blueprint $table) {
            $table->id();
            $table->uuid('tracking_token')->unique();
            $table->string('template_key')->index();
            $table->string('recipient')->index();
            $table->string('subject');
            $table->text('context')->nullable();
            $table->string('status')->default('queued')->index();
            $table->unsignedTinyInteger('attempts')->default(0);
            $table->text('error_message')->nullable();
            $table->timestamp('queued_at')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->timestamp('failed_at')->nullable();
            $table->timestamp('opened_at')->nullable();
            $table->timestamp('clicked_at')->nullable();
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('pending_email')->nullable()->after('email');
            $table->string('pending_email_token', 64)->nullable()->index()->after('pending_email');
            $table->string('two_factor_code')->nullable()->after('remember_token');
            $table->timestamp('two_factor_expires_at')->nullable()->after('two_factor_code');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'pending_email',
                'pending_email_token',
                'two_factor_code',
                'two_factor_expires_at',
            ]);
        });

        Schema::dropIfExists('email_delivery_logs');
        Schema::dropIfExists('email_templates');
        Schema::dropIfExists('email_settings');
    }
};
