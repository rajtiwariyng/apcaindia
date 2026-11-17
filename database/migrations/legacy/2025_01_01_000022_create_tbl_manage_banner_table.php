<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Reverse-engineered from live table `tbl_manage_banner` (apca_india).
 * Column names `buttonName` and `featurs` preserved verbatim (as in the live table).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_manage_banner', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';

            $table->increments('id');
            $table->string('uniqueid', 100)->nullable();
            $table->text('heading1');
            $table->text('heading2')->nullable();
            $table->string('bannerimg', 100);
            $table->text('description')->nullable();
            $table->string('buttonName', 100)->nullable();
            $table->text('url')->nullable();
            $table->text('featurs')->nullable();
            $table->string('type', 100);
            $table->string('status', 5)->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->string('ip', 100)->nullable();
            $table->integer('position')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_manage_banner');
    }
};
