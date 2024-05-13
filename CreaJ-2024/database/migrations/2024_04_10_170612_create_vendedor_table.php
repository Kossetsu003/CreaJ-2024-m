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
        Schema::create('vendedor', function (Blueprint $table) {
          $table->id();
          $table->string('usuario');
          $table->string('contrasena');
          $table->string('nombre');
          $table -> string('apellidos')->nullable;
          $table -> double('telefono')->nullable;
          $table -> double('numero_puesto');
          $table-> unsignedBigInteger('fk_mercado');
          $table -> foreign('fk_mercado') -> references('id')->on('mercado_local');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendedor');
    }
};
