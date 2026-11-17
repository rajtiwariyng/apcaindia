<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Reverse-engineered from live table `tbl_admin` (apca_india).
 * NOTE: live `id` is an INT PRIMARY KEY WITHOUT auto-increment (values are assigned by the app).
 * Reproduced faithfully (no autoIncrement). See legacy/README.md.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_admin', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';

            $table->integer('id')->primary();              // NOT auto-increment (matches live)
            $table->string('user_userid', 100);
            $table->string('user_name', 100)->nullable();
            $table->string('user_email', 100);
            $table->string('user_password', 100);
            $table->string('user_roleid', 20);
            $table->string('user_email_verifytoken', 200)->nullable();
            $table->enum('user_email_verifystatus', ['0', '1'])->nullable()
                  ->comment('1 AS VERIFIED, 0 AS REFUTE');
            $table->string('user_token', 150)->nullable();
            $table->enum('user_token_status', ['0', '1'])->nullable();
            $table->enum('user_admin_status', ['0', '1']);
            $table->enum('role', ['admin', 'subadmin', 'user']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_admin');
    }
};
