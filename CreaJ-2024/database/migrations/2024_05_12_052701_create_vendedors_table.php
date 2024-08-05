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
        Schema::create('vendedors', function (Blueprint $table) {
            $table->id();
            $table->string('usuario')->unique();
            $table->unsignedDouble('ROL')->nullable()->default(3);
            $table->string('password');
            $table->string('nombre');
            $table->string('apellidos')->nullable();
            $table->string('telefono')->nullable();
            $table->integer('numero_puesto')->unique();
            $table->unsignedBigInteger('fk_mercado');
            $table->foreign('fk_mercado')->references('id')->on('mercado_locals')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendedors');
    }
};

