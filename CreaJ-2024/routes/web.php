<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*Vistas de usuarios*/
Route::view('/','Index')->name('Index');
Route::view('/LoginUser','LoginUser')->name('LoginUser');
Route::view('/RegistroUser','RegistroUser')->name('RegistroUser');
Route::view('/ProductosUser','ProductosUser')->name('ProductosUser');
Route::view('/EditarPerfilUser','EditarPerfilUser')->name('EditarPerfilUser');
Route::view('/CarritoGeneralUser','CarritoGeneralUser')->name('CarritoGeneralUser');
Route::view('/CarritoDePuestoUser','CarritoDePuestoUser')->name('CarritoDePuestoUser');
Route::view('/HomeMercadoUser','HomeMercadoUser')->name('HomeMercadoUser');
Route::view('/HomeUser','HomeUser')->name('HomeUser');
Route::view('/EstadoPedidosUser','EstadoPedidosUser')->name('EstadoPedidosUser');



/*Vistas de Vendedores*/
Route::view('/RegistroProductoVendedor','RegistroProductoVendedor')->name('RegistroProductoVendedor');
Route::view('/EditarProductoVendedor','EditarProductoVendedor')->name('EditarProductoVendedor');
Route::view('/AgregarMercadoVendedor','AgregarMercadoVendedor')->name('AgregarMercadoVendedor');






/*Vistas de adminsitrador*/
Route::view('/EditarMercadoAdmin','EditarMercadoAdmin')->name('EditarMercadoAdmin');
Route::view('/RegistrarVendedorAdmin','RegistrarVendedorAdmin')->name('RegistrarVendedorAdmin');
