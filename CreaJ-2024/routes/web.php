<?php
use App\Http\Controllers\MercadoLocalController;
use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VendedorController;
use App\Http\Controllers\AdminClienteController;
use App\Http\Controllers\AdminVendedorController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminMercadoLocalController;

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


/*Vistas Principales*/
Route::view('/','2Index')->name('Index');
Route::view('/LoginUser','LoginUser')->name('LoginUser');
Route::view('/RegistroUser','RegistroUser')->name('RegistroUser');



/*Vistas de Clientes*/
Route::view('/UserProductoEnEspecifico','UserProductoEnEspecifico')->name('UserProductoEnEspecifico');
Route::view('/UserEditarPerfil','UserEditarPerfil')->name('UserEditarPerfil');
Route::view('/UserCarritoGeneral','UserCarritoGeneral')->name('UserCarritoGeneral');
Route::view('/UserCarritoDePuesto','UserCarritoDePuesto')->name('UserCarritoDePuesto');
Route::view('/UserPuestosVendedores','UserPuestosVendedores')->name('UserPuestosVendedores');
Route::view('/UserProductosDeUnPuesto','UserProductosDeUnPuesto')->name('UserProductosDeUnPuesto');
Route::view('/UserHome','UserHome')->name('UserHome');
Route::view('/UserEstadoPedidos','UserEstadoPedidos')->name('UserEstadoPedidos');
Route::view('/UserProfileVista','UserProfileVista')->name('UserProfileVista');
Route::view('/UserHistorialPedidos','UserHistorialPedidos')->name('UserHistorialPedidos');



/*Vistas de Vendedores*/

Route::view('/VendedorRegistroProducto','VendedorRegistroProducto')->name('VendedorRegistroProducto');
Route::view('/VendedorEditarProducto','VendedorEditarProducto')->name('VendedorEditarProducto'); //
Route::view('/VendedorMiBuzon','VendedorMiBuzon')->name('VendedorMiBuzon');
Route::view('/VendedorProfileVista','VendedorProfileVista')->name('VendedorProfileVista');
Route::view('/VendedorProductoEnEspecifico','VendedorProductoEnEspecifico')->name('VendedorProductoEnEspecifico');
Route::view('/VendedorEditarMiPuesto','VendedorEditarMiPuesto')->name('VendedorEditarMiPuesto'); //
Route::view('/VendedorMisReservas','VendedorMisReservas')->name('VendedorMisReservas');
Route::view('/VendedorHome','VendedorHome')->name('VendedorHome');




/*Vistas de Mercado*/

Route::view('/MercadoRegistrarVendedor','MercadoRegistrarVendedor')->name('MercadoRegistrarVendedor');
Route::view('/MercadoEditarVendedor','MercadoEditarVendedor')->name('MercadoEditarVendedor');
Route::view('/MercadoProfileVista','MercadoProfileVista')->name('MercadoProfileVista');
Route::view('/MercadoVista','MercadoVista')->name('MercadoVista'); //
Route::view('/MercadoListadoVendedores','MercadoListadoVendedores')->name('MercadoListadoVendedores'); //
Route::view('/MercadoPuestoDelVendedor','MercadoPuestoDelVendedor')->name('MercadoPuestoDelVendedor'); //


/*Administrador General*/

Route::view('/AdminEditarMercado','AdminEditarMercado')->name('AdminEditarMercado');
Route::view('/AdminListadoClientes','AdminListadoClientes')->name('AdminListadoClientes');
Route::view('/AdminProfileVista','AdminProfileVista')->name('AdminProfileVista'); //
Route::view('/AdminHome','AdminHome')->name('AdminHome');
Route::view('/AdminPuestosDelMercado','AdminPuestosDelMercado')->name('AdminPuestosDelMercado');
Route::view('/AdminListadoVendedores','AdminListadoVendedores')->name('AdminListadoVendedores');
Route::view('/AdminAgregarMercado','AdminAgregarMercado')->name('AdminAgregarMercado');
Route::view('/AdminPerfilDelVendedor','AdminPerfilDelVendedor')->name('AdminPerfilDelVendedor');
Route::view('/AdminListadoVendedores','AdminListadoVendedores')->name('AdminListadoVendedores');
Route::view('/AdminPerfilDelVendedor','AdminPerfilDelVendedor')->name('AdminPerfilDelVendedor');
Route::view('/AdminListadoMercados','AdminPuestosDelMercado')->name('AdminListadoMercados');
Route::view('/AdminHistorialPedidos','AdminListadoVendedores')->name('AdminHistorialPedidos');
Route::view('/AdminEstadoPedidos','AdminEstadoPedidos')->name('AdminEstadoPedidos');






// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('mercado-locals', MercadoLocalController::class);
Route::resource('vendedors', VendedorController::class);
Route::resource('clientes', ClienteController::class);
Route::resource('admin-clientes', AdminClienteController::class);
Route::resource('admin-vendedors', AdminVendedorController::class);


Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('login-submit', [LoginController::class, 'loginpost'])->name('login-submit');


Route::resource('admin-mercado-locals', AdminMercadoLocalController::class);

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
