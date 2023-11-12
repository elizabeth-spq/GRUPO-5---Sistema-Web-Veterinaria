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
        Schema::create('citas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tipo_id');
            $table->unsignedInteger('cliente_id');
            $table->unsignedInteger('mascota_id');
            $table->unsignedInteger('espec_id');
            $table->dateTime('fec_ini');
            $table->dateTime('fec_fin');
            $table->unsignedInteger('vet_id');

            $table->text('observaciones')->nullable();
            $table->text('cargos_adicionales')->nullable();
            $table->double('subtotal', 8, 2)->default(0.0);
            $table->double('monto_adicional', 8, 2)->default(0.0);
            $table->double('total', 8, 2)->default(0.0);
            $table->double('pago_previo', 8, 2)->default(0.0);
            $table->double('pago_pendiente', 8, 2)->default(0.0);

            $table->integer('estado_cita')->default(1);
            $table->integer('usu_registro')->nullable();
            $table->integer('usu_ult_mod')->nullable();
            $table->timestamps();

            $table->foreign('tipo_id')->references('id')
                ->on('tipocitas');
            $table->foreign('cliente_id')->references('id')
                ->on('clientes');
            $table->foreign('mascota_id')->references('id')
                ->on('mascotas');
            $table->foreign('espec_id')->references('id')
                ->on('especialidades');
            $table->foreign('vet_id')->references('id')
                ->on('veterinarios');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
