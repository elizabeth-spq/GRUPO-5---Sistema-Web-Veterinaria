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
        Schema::create('mascota', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 250);
            $table->string('raza', 250);
            $table->integer('edad');
            $table->integer('sexo');
            $table->double('peso', 8, 2);
            $table->string('direccion', 250);
            $table->integer('estado');
            $table->unsignedInteger('cliente_id');
            $table->integer('usu_registro');
            $table->integer('usu_ult_mod');
            $table->timestamp('fec_reg')->useCurrent();
            $table->timestamp('fec_ult_mod')->useCurrent();

            $table->foreign('cliente_id')->references('id')
                ->on('cliente');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mascota');
    }
};
