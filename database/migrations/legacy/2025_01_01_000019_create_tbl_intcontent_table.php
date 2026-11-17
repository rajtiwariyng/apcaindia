<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** Reverse-engineered from live table `tbl_intcontent` (apca_india). */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_intcontent', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';

            $table->increments('id');
            $table->string('uniqueid', 225)->nullable();
            $table->text('content');
            $table->string('program_title', 225)->nullable();
            $table->string('students_title', 225)->nullable();
            $table->text('description')->nullable();
            $table->string('url', 225)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_intcontent');
    }
};
