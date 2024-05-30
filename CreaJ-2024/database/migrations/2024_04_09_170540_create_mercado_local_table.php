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
        Schema::create('mercado_locals', function (Blueprint $table) {

            $table->id();
            $table->string('nombre');
            $table->double('ROL')->unsigned()->nullable()->default(2);
            $table->binary('imagen_referencia')->nullable();
            $table->string('municipio');
            $table->string('ubicacion');
            $table->string('horaentrada');
            $table->string('horasalida');
            $table->string('descripcion');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

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
