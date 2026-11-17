<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** Reverse-engineered from live table `contactus` (apca_india). */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contactus', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';

            $table->increments('id');
            $table->string('full_name', 225)->nullable();
            $table->string('email', 100);
            $table->string('mobile', 50);
            $table->dateTime('date_time')->nullable();
            $table->string('program', 255);
            $table->string('questions', 225)->nullable();
            $table->tinyInteger('privacy')->default(0);
            $table->string('page_name', 225)->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->string('ip', 50)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contactus');
    }
};
