<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** Reverse-engineered from live table `tbl_faqs` (apca_india). */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_faqs', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';

            $table->increments('id');
            $table->string('uniqueid', 225);
            $table->text('question');
            $table->text('answer')->nullable();
            $table->integer('home')->default(0);
            $table->string('ip', 225)->nullable();
            $table->integer('status')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_faqs');
    }
};
