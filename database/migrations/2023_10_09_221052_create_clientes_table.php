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
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 250);
            $table->string('apellido', 250);
            $table->integer('tip_doc');
            $table->string('documento',15)->unique();
            $table->string('telefono', 11);
            $table->string('direccion', 250)->default('');
            $table->string('email', 250)->default('');
            $table->integer('estado')->default(0);
            $table->integer('usu_registro')->nullable();
            $table->integer('usu_ult_mod')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
