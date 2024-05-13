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
        Schema::create('en_ventas', function (Blueprint $table) {
            $table->id();
            $table->String('Imagen');
            $table -> String('Nombre');
            $table -> Double('precio');
            $table -> Int('Cantidad');
            $table ->String('Talla') ->nullable();
            $table -> foreign('FK_Clientes') -> references('id') -> on('clientes') -> onDelete('cascade');
            $table -> foreign('FK_Exhibicion') -> references('id') -> on('producto_en_exhibicion') -> onDelete('cascade');
            $table -> String('Estado');
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('producto_en_ventas');
    }
};
