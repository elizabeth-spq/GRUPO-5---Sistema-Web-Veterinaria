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
        Schema::create('rol', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->text('modulos');
            $table->integer('estado');
            $table->integer('usu_registro');
            $table->integer('usu_ult_mod');
            $table->timestamp('fec_reg')->useCurrent();
            $table->timestamp('fec_ult_mod')->useCurrent();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rols');
        Schema::dropIfExists('rol');
    }
};
