<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** Reverse-engineered from live table `tbl_homeslider` (apca_india). */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_homeslider', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';

            $table->increments('id');
            $table->string('uniqueid', 255);
            $table->string('title', 255)->nullable();
            $table->string('image', 100)->nullable();
            $table->string('category', 50)->nullable();
            $table->string('page', 225)->nullable();
            $table->integer('order_by')->nullable()->default(0);
            $table->integer('status')->nullable()->default(1)->comment('1=show,0=not show');
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->string('ip', 100)->nullable();
            $table->string('caption', 225)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_homeslider');
    }
};
