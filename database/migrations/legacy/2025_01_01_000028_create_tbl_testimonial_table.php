<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** Reverse-engineered from live table `tbl_testimonial` (apca_india). */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_testimonial', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';

            $table->increments('id');
            $table->string('uniqueid', 255);
            $table->string('name', 255)->nullable();
            $table->string('program', 225)->nullable();
            $table->text('description')->nullable();
            $table->string('image', 100)->nullable();
            $table->integer('status')->nullable()->comment('1=show,0=not show');
            $table->integer('view_count')->default(1);
            $table->integer('home')->nullable();
            $table->string('ip', 100)->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_testimonial');
    }
};
