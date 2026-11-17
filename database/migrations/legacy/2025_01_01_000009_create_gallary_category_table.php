<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Reverse-engineered from live table `gallary_category` (apca_india).
 * NOTE: original spelling "gallary" preserved to match the live table name.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gallary_category', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';

            $table->increments('id');
            $table->string('name', 225)->nullable();
            $table->integer('status')->nullable();
            $table->timestamp('created_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gallary_category');
    }
};
