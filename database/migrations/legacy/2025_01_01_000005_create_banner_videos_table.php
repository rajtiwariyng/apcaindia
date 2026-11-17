<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** Reverse-engineered from live table `banner_videos` (apca_india). */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('banner_videos', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';

            $table->increments('id');
            $table->string('uniqueid', 225);
            $table->string('video_path', 225)->nullable();
            $table->string('image', 225)->nullable();
            $table->string('page', 225);
            $table->integer('status')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('banner_videos');
    }
};
