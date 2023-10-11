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
        Schema::create('mascotas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 250);
            $table->unsignedInteger('cliente_id');
            $table->unsignedInteger('animal_id');
            $table->unsignedInteger('raza_id');
            $table->date('fec_nac')->nullable();
            $table->integer('sexo');
            $table->string('color', 250);
            $table->double('altura', 8, 2);
            $table->double('peso', 8, 2);
            $table->integer('estirilizado');
            $table->integer('vacunas');
            $table->integer('estado')->default(0);

            $table->integer('usu_registro')->nullable();
            $table->integer('usu_ult_mod')->nullable();
            $table->timestamps();

            $table->foreign('cliente_id')->references('id')
                ->on('clientes');
            $table->foreign('animal_id')->references('id')
                ->on('animales');
            $table->foreign('raza_id')->references('id')
                ->on('razas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mascotas');
    }
};
