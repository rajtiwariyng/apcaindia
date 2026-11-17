<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Reverse-engineered from live table `subscribed_user` (apca_india).
 * NOTE: created_at / updated_at are VARCHAR(100) in the live table (not timestamps);
 * reproduced faithfully as strings.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subscribed_user', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';

            $table->increments('id');
            $table->string('name', 255)->default('Guest');
            $table->string('email', 255);
            $table->string('created_at', 100)->nullable();
            $table->string('updated_at', 100)->nullable();
            $table->string('ip', 100)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subscribed_user');
    }
};
