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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->double('ROL')->unsigned()->nullable()->default(4);
            $table->string('usuario');
            $table->string('contrasena');
            $table->string('nombre')->nullable();
            $table->string('apellido')->nullable();
            $table->string('telefono')->nullable();
            $table->string('sexo')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->rememberToken();
        });

        DB::insert('insert into clientes (id, ROL, usuario, contrasena, nombre, apellido, telefono, sexo) values (?, ?, ?, ?, ?, ?, ?, ?)', [1, 1, 'MiniShopAdmin1', 'MiniShop1', 'Administrador', 'De MiniShop', NULL, NULL]);

    }

    //REGISTRO DEL ADMIN POR DEFECTO


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
