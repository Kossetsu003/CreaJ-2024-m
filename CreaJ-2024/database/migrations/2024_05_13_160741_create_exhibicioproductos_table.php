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
        Schema::create('exhibicioproductos', function (Blueprint $table) {
            $table->id();
            $table -> string('Imagen');
            $table -> String('Nombre');
            $table -> String('Descripcion');
            $table -> Double('Precio');
            $table -> foreign('FK_Vendedor') -> references('id') -> on('vendedor') -> onDelete('cascade');
            $table -> String('Estado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exhibicioproductos');
    }
};