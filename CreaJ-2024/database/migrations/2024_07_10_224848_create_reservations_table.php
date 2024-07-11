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
            $table->unsignedBigInteger('FK_users');
            $table->foreign('fk_users')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->string('estado')->default("enviado");
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
