<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('consultation_requests', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->date('preferred_date');
            $table->time('preferred_time');
            $table->text('message')->nullable();
            $table->enum('status', ['new', 'contacted', 'scheduled', 'cancelled'])->default('new');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('consultation_requests');
    }
};
