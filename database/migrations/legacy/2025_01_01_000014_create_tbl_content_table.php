<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** Reverse-engineered from live table `tbl_content` (apca_india). */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_content', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';

            $table->increments('id');
            $table->string('uniqueid', 225);
            $table->string('title', 225)->nullable();
            $table->string('title2', 225)->nullable();
            $table->text('content')->nullable();
            $table->text('content2')->nullable();
            $table->integer('status')->nullable()->default(1);
            $table->string('ip', 225)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_content');
    }
};
