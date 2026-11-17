<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** Reverse-engineered from live table `course_modules` (apca_india). */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('course_modules', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';

            $table->bigIncrements('id');
            $table->string('uniqueid', 225)->nullable();
            $table->string('course_id', 225);
            $table->string('title', 255);
            $table->text('content')->nullable();
            $table->string('image', 255);
            $table->integer('order');
            $table->integer('status')->nullable();
            $table->string('ip', 225)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_modules');
    }
};
