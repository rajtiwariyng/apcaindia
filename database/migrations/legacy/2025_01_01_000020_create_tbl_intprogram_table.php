<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** Reverse-engineered from live table `tbl_intprogram` (apca_india). */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_intprogram', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';

            $table->increments('id');
            $table->string('uniqueid', 225)->nullable();
            $table->string('slug', 225)->nullable();
            $table->string('image', 225)->nullable();
            $table->string('name', 225)->nullable();
            $table->string('duration', 225)->nullable();
            $table->integer('order_by')->nullable();
            $table->string('ip', 225)->nullable();
            $table->integer('status')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_intprogram');
    }
};
