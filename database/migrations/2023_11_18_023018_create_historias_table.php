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
        Schema::create('historias', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('cita_id');
            $table->unsignedInteger('mascota_id');
            $table->unsignedInteger('cliente_id');
            $table->unsignedInteger('tipo_id');

            $table->text('notas_cita')->nullable();
            $table->text('receta')->nullable();
            $table->text('procedimiento')->nullable();
            $table->date('fecha_creacion')->nullable();
            $table->text('resultados_examenes')->nullable();
            $table->text('archivos_adjuntos')->nullable();
            $table->text('vacunacion')->nullable();
            $table->text('foto')->nullable();

            $table->integer('estado_historia')->default(1);
            $table->integer('usu_registro')->nullable();
            $table->integer('usu_ult_mod')->nullable();
            $table->timestamps();

            $table->foreign('cita_id')->references('id')
                ->on('citas');
            $table->foreign('mascota_id')->references('id')
                ->on('mascotas');
            $table->foreign('cliente_id')->references('id')
                ->on('clientes');
            $table->foreign('tipo_id')->references('id')
                ->on('tipocitas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historias');
    }
};
