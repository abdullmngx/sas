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
        Schema::create('staff_topics', function (Blueprint $table) {
            $table->id();
            $table->string('topic');
            $table->longText('abstract');
            $table->unsignedBigInteger('staff_id');
            $table->unsignedBigInteger('session_id');
            $table->unsignedBigInteger('student_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff_topics');
    }
};
