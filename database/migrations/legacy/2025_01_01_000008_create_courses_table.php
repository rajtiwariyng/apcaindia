<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** Reverse-engineered from live table `courses` (apca_india). */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';

            $table->bigIncrements('id');
            $table->string('uniqueid', 225)->nullable();
            $table->string('title', 255);
            $table->string('slug', 255);
            $table->string('image', 255)->nullable();
            $table->string('image_student', 225)->nullable();
            $table->string('duration', 255);
            $table->string('schedule', 255);
            $table->string('certification', 255)->nullable();
            $table->string('internship', 255)->nullable();
            $table->text('overview');
            $table->string('structure', 255)->nullable();
            $table->text('bonus')->nullable();
            $table->text('international_internship')->nullable();
            $table->integer('status')->nullable();
            $table->string('ip', 225)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->unique('slug', 'slug');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
