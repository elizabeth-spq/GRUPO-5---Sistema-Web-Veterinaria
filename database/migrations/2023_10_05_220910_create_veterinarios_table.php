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
        Schema::create('veterinarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 250);
            $table->string('apellido', 250);
            $table->date('fec_nac')->nullable();
            $table->integer('tip_doc');
            $table->string('documento', 20)->unique();
            $table->string('num_telefono', 20);
            $table->integer('especialidad');
            $table->integer('estado')->default(0);
            $table->unsignedInteger('horario_id');
            $table->integer('usu_registro')->nullable();
            $table->integer('usu_ult_mod')->nullable();
            $table->timestamps();

            $table->foreign('horario_id')->references('id')
                ->on('horarios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('veterinarios');
    }
};
