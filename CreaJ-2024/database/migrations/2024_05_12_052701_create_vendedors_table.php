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
            $table->string('usuario');
            $table->double('ROL')->unsigned()->nullable()->default(3);
            $table->string('password');
            $table->string('nombre');
            $table->string('nombre_del_local')->nullable();
            $table->string('imagen_de_referencia');
            $table->string('clasificacion')->nullable();
            $table->string('apellidos')->nullable();
            $table->string('telefono')->nullable();
            $table->Integer('numero_puesto');
            $table->unsignedBigInteger('fk_mercado'); // Cambiado a unsignedBigInteger
            $table->foreign('fk_mercado')->references('id')->on('mercado_locals')->onDelete('cascade');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

        });

        DB::table('vendedors')->insert([
            'usuario' => 'rosio.martinez@gmail.com',
            'ROL' => 3,
            'password' => Hash::make('rosio123'), // Ajusta la contraseña según tus necesidades
            'nombre' => 'Rosio',
            'nombre_del_local' => 'Comedor Rosio',
            'imagen_de_referencia' => 'rosiomartinez.png', // Valor por defecto null
            'clasificacion' => 'comedor', // Valor por defecto null
            'apellidos' => 'Martinez',
            'telefono' => '75469651', // Valor por defecto null
            'numero_puesto' => '001', // Valor por defecto null
            'fk_mercado' => 1, // Ajusta esto según el ID de un mercado local existente
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendedors');
    }
};
