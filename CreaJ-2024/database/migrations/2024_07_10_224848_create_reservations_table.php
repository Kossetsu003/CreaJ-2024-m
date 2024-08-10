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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->decimal('total');
            //Usuario perteneciente
            $table->unsignedBigInteger('FK_users');
            $table->unsignedBigInteger('fk_mercados');
            $table->foreign('fk_mercados')->references('id')->on('mercado_locals')->onDelete('cascade'); 
            $table->foreign('fk_users')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('fk_mercado');
            $table->foreign('fk_mercado')->references('id')->on('mercado_locals')->onDelete('cascade');
            $table->timestamps();
            $table->string('estado')->default("enviado");
            $table->string('retiro')->default("Entrada del Mercado");
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
