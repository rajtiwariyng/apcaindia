<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Reverse-engineered from live table `tbl_blog_category` (apca_india).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_blog_category', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';

            $table->increments('id');
            $table->string('uniqueid');
            $table->string('category_name')->nullable();
            $table->string('alt_tag')->nullable();
            $table->string('image_name', 100)->nullable();
            $table->integer('status')->nullable()->comment('1=show,0=not show');
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->string('ip', 100)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_blog_category');
    }
};
