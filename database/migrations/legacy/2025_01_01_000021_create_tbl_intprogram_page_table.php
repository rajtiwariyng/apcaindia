<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Reverse-engineered from live table `tbl_intprogram_page` (apca_india).
 * NOTE: `img_alt` has an explicit per-column utf8mb4 charset (table default latin1).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_intprogram_page', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';

            $table->increments('id');
            $table->string('uniqueid', 255);
            $table->string('title', 255)->nullable();
            $table->text('blog_short_desc')->nullable();
            $table->text('description')->nullable();
            $table->string('image', 100)->nullable();
            $table->string('category', 100)->nullable();
            $table->text('slug')->nullable();
            $table->integer('status')->nullable()->comment('1=show,0=not show');
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->string('ip', 100)->nullable();
            $table->text('metatitle')->nullable();
            $table->text('metakeywords')->nullable();
            $table->text('metadesc')->nullable();
            $table->integer('view_count')->default(1);
            $table->integer('email_sent')->nullable()->default(0);
            $table->string('img_alt', 150)->charset('utf8mb4')->collation('utf8mb4_general_ci')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_intprogram_page');
    }
};
