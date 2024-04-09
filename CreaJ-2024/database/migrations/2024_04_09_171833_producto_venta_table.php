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
         Schema::create('ventaproducto', function (Blueprint $table) {
            $table->id();
            $table->binary('imagen');
            $table->string('nombre');
            $table-> integer('precio');
            $table->integer('cantidad');
            $table -> foreign('fk_cliente') -> references('id') -> on('usuarios');
            $table -> foreign('fk_exhibicion') -> references('id') -> on('producto');
            $table -> foreign('fk_mercado') -> references('id')->on('mercado_local');
            $table->string('estado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('producto_venta');
    }
};
