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
        Schema::create('ventaproductos', function (Blueprint $table) {
            $table->id();
            $table->String('Imagen');
            $table -> String('Nombre');
            $table -> Double('precio');
            $table -> Integer('Cantidad');
            $table ->String('Talla') ->nullable();

            $table->unsignedBigInteger('FK_Clientes');
            $table -> foreign('FK_Clientes') -> references('id') -> on('clientes') -> onDelete('cascade');

            $table->unsignedBigInteger('FK_Exhibicion');
            $table -> foreign('FK_Exhibicion') -> references('id') -> on('exhibicionproductos') -> onDelete('cascade');
            $table -> String('Estado');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventaproductos');
    }
};
