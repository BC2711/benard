<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('consultation_sections', function (Blueprint $table) {
            $table->id();
            $table->string('heading');
            $table->text('description');
            $table->string('info_heading')->default('Why Schedule a Consultation?');
            $table->json('benefits')->nullable();
            $table->string('expect_heading')->default('What to Expect');
            $table->json('expectations')->nullable();
            $table->string('contact_heading')->default('Can\'t find a suitable time?');
            $table->text('contact_description')->default('Contact us directly...');
            $table->string('phone')->default('+260 965508033');
            $table->string('email')->default('binesschama1127@gmail.com');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('consultation_sections');
    }
};
