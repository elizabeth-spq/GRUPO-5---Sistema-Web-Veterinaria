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
        Schema::table('users', function (Blueprint $table) {
            $table->string('apellido', 250);
            $table->integer('estado');
            $table->unsignedInteger('rol_id');
            $table->integer('usu_registro');
            $table->integer('usu_ult_mod');

            $table->foreign('rol_id')->references('id')->on('rol');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['apellido', 'estado', 'rol_id', 'usu_registro', 'usu_ult_mod']);
            $table->dropForeign(['rol_id']);
        });
    }
};
