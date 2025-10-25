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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['EMAIL', 'SMS', 'PUSH', 'SUBSCRIBE'])->default('SMS');
            $table->string('full_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('message')->nullable();
            $table->string('subject')->nullable();
            $table->enum('status', ['PENDING', 'SENT', 'FAILED'])->default('PENDING');
            $table->text('response')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->boolean('read')->default(0);
            $table->timestamps();

            // Indexes for better performance
            $table->index(['type', 'status']);
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
