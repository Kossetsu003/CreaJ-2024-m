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
        Schema::create('producto_exhibicion', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table -> binary('imagen_referencia')->nulleable;
            $table ->string('descripcion');
            $table -> double('precio');
            $table -> unsignedBigInteger('fk_vendedor');
            $table -> foreign('fk_vendedor') -> references('id') -> on('vendedor');
            $table -> string('estado');
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('producto');
    }
};
