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
        Schema::create('mercado_local', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->binary('imagen_referencia');
            $table->string('municipio');
            $table->string('ubicacion');
            $table->string('horario');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mercado_local');
    }
};
