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
        Schema::create('cliente', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 250);
            $table->string('apellido', 250);
            $table->string('documento',15);
            $table->string('telefono', 11);
            $table->string('direccion', 250);
            $table->string('email', 250);
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
        Schema::dropIfExists('cliente');
    }
};
