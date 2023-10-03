<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();

            $table->string('nombre', 250);
            $table->string('apellido', 250);
            $table->integer('estado');
            $table->unsignedInteger('rol_id');
            $table->integer('usu_registro');
            $table->integer('usu_ult_mod');
            $table->timestamp('fec_reg')->useCurrent();
            $table->timestamp('fec_ult_mod')->useCurrent();

            $table->foreign('rol_id')->references('id')
            ->on('rol');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
