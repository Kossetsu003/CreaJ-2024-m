<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 8, 2);
            $table->string('imagen_referencia')->nullable();
            $table->string('categoria');
            $table->string('estado')->default('Disponible');
            $table->unsignedBigInteger('fk_vendedors');
            $table->foreign('fk_vendedors')->references('id')->on('vendedors')->onDelete('cascade');
        });

        /**
         * COMEDOR ROSIO
         */
        // Insertar producto "Lasagna"
        DB::table('products')->insert([
            'name' => 'Lasagna',
            'description' => 'Almuerzo de Lasagna, con dos acompaniamientos que pueden ser arroz, casamiento, ensalada de coditos o fresa, incluye dos tortillas y fresco.',
            'price' => 2.75,
            'imagen_referencia' => 'lasagna.png',  // Suponiendo que tengas esta imagen en tu carpeta de imágenes
            'categoria' => 'Comida',
            'estado' => 'Disponible',
            'fk_vendedors' => 1,  // Asumiendo que el ID del vendedor es 1
        ]);DB::table('products')->insert([
            'name' => 'Pollo en Salsa',
            'description' => 'Almuerzo de Pollo en Salsa, con dos acompaniamientos que pueden ser arroz, casamiento, ensalada de coditos o fresa, incluye dos tortillas y fresco.',
            'price' => 2.75,
            'imagen_referencia' => 'polloensalsa.png',  // Suponiendo que tengas esta imagen en tu carpeta de imágenes
            'categoria' => 'Comida',
            'estado' => 'Disponible',
            'fk_vendedors' => 1,  // Asumiendo que el ID del vendedor es 1
        ]);DB::table('products')->insert([
            'name' => 'Carne Guisada',
            'description' => 'Almuerzo de Carne Guisada, con dos acompaniamientos que pueden ser arroz, casamiento, ensalada de coditos o fresa, incluye dos tortillas y fresco.',
            'price' => 3.00,
            'imagen_referencia' => 'carneguisada.png',  // Suponiendo que tengas esta imagen en tu carpeta de imágenes
            'categoria' => 'Comida',
            'estado' => 'Disponible',
            'fk_vendedors' => 1,  // Asumiendo que el ID del vendedor es 1
        ]);
        /**
         * EMBUTIDOS COJUTEPECANOS
         */DB::table('products')->insert([
            'name' => 'Lasagna',
            'description' => 'Almuerzo de Lasagna, con dos acompaniamientos que pueden ser arroz, casamiento, ensalada de coditos o fresa, incluye dos tortillas y fresco.',
            'price' => 2.75,
            'imagen_referencia' => 'lasagna.png',  // Suponiendo que tengas esta imagen en tu carpeta de imágenes
            'categoria' => 'Comida',
            'estado' => 'Disponible',
            'fk_vendedors' => 1,  // Asumiendo que el ID del vendedor es 1
        ]);DB::table('products')->insert([
            'name' => 'Lasagna',
            'description' => 'Almuerzo de Lasagna, con dos acompaniamientos que pueden ser arroz, casamiento, ensalada de coditos o fresa, incluye dos tortillas y fresco.',
            'price' => 2.75,
            'imagen_referencia' => 'lasagna.png',  // Suponiendo que tengas esta imagen en tu carpeta de imágenes
            'categoria' => 'Comida',
            'estado' => 'Disponible',
            'fk_vendedors' => 1,  // Asumiendo que el ID del vendedor es 1
        ]);DB::table('products')->insert([
            'name' => 'Lasagna',
            'description' => 'Almuerzo de Lasagna, con dos acompaniamientos que pueden ser arroz, casamiento, ensalada de coditos o fresa, incluye dos tortillas y fresco.',
            'price' => 2.75,
            'imagen_referencia' => 'lasagna.png',  // Suponiendo que tengas esta imagen en tu carpeta de imágenes
            'categoria' => 'Comida',
            'estado' => 'Disponible',
            'fk_vendedors' => 1,  // Asumiendo que el ID del vendedor es 1
        ]);
        /**
         * Artesanias
         */
        DB::table('products')->insert([
            'name' => 'Lasagna',
            'description' => 'Almuerzo de Lasagna, con dos acompaniamientos que pueden ser arroz, casamiento, ensalada de coditos o fresa, incluye dos tortillas y fresco.',
            'price' => 2.75,
            'imagen_referencia' => 'lasagna.png',  // Suponiendo que tengas esta imagen en tu carpeta de imágenes
            'categoria' => 'Comida',
            'estado' => 'Disponible',
            'fk_vendedors' => 1,  // Asumiendo que el ID del vendedor es 1
        ]);DB::table('products')->insert([
            'name' => 'Lasagna',
            'description' => 'Almuerzo de Lasagna, con dos acompaniamientos que pueden ser arroz, casamiento, ensalada de coditos o fresa, incluye dos tortillas y fresco.',
            'price' => 2.75,
            'imagen_referencia' => 'lasagna.png',  // Suponiendo que tengas esta imagen en tu carpeta de imágenes
            'categoria' => 'Comida',
            'estado' => 'Disponible',
            'fk_vendedors' => 1,  // Asumiendo que el ID del vendedor es 1
        ]);DB::table('products')->insert([
            'name' => 'Lasagna',
            'description' => 'Almuerzo de Lasagna, con dos acompaniamientos que pueden ser arroz, casamiento, ensalada de coditos o fresa, incluye dos tortillas y fresco.',
            'price' => 2.75,
            'imagen_referencia' => 'lasagna.png',  // Suponiendo que tengas esta imagen en tu carpeta de imágenes
            'categoria' => 'Comida',
            'estado' => 'Disponible',
            'fk_vendedors' => 1,  // Asumiendo que el ID del vendedor es 1
        ]);

    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
