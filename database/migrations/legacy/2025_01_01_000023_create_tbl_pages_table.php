<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Reverse-engineered from live table `tbl_pages` (apca_india).
 * NOTE: `uniqueid` is TEXT NOT NULL in the live table (not varchar); reproduced faithfully.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_pages', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';

            $table->increments('id');
            $table->text('uniqueid');
            $table->text('title')->nullable();
            $table->text('content')->nullable();
            $table->string('image', 225)->nullable();
            $table->string('video_path', 225)->nullable();
            $table->string('pages', 225)->nullable();
            $table->integer('status')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('ip', 225)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_pages');
    }
};
