<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MercadoLocalController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VendedorController;
use App\Http\Controllers\AdminClienteController;
use App\Http\Controllers\AdminVendedorController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminMercadoLocalController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReservationItemController;
use App\Http\Controllers\UsuariosController;

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');


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
//use App\Http\Controllers\MercadoLocalController;



/*Vistas Principales*/
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'LoginUser'])->name('inicia-sesion');


Route::view('/','Index')->name('Index');

Route::view('/LoginUser','LoginUser')->name('LoginUser');
Route::view('/RegistroUser','RegistroUser')->name('RegistroUser');

Route::post('/validar-registro', [LoginController::class, 'register'])->name('validar-registro');
Route::post('/inicia-sesion', [LoginController::class, 'loginuser'])->name('inicia-sesion');

Route::get('login', [LoginController::class, 'login'])->name('login');
Route::get('LoginUser', [LoginController::class, 'LoginUser']);

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');



/*Vistas de Clientes*/
Route::view('/UserProductoEnEspecifico','UserProductoEnEspecifico')->name('UserProductoEnEspecifico');
Route::view('/UserEditarPerfil','UserEditarPerfil')->name('UserEditarPerfil');
Route::view('/UserCarritoGeneral','UserCarritoGeneral')->name('UserCarritoGeneral');
Route::view('/UserCarritoDePuesto','UserCarritoDePuesto')->name('UserCarritoDePuesto');
Route::view('/UserPuestosVendedores','UserPuestosVendedores')->name('UserPuestosVendedores');
Route::view('/UserProductosDeUnPuesto','UserProductosDeUnPuesto')->name('UserProductosDeUnPuesto');
Route::view('/UserHome','UserHome')->name('UserHome');
Route::view('/UserEstadoReservas','UserEstadoReservas')->name('UserEstadoReservas');
Route::view('/UserProfileVista', 'UserProfileVista')->name('UserProfileVista')->middleware('check.user.session');
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
Route::view('/MercadoHome','MercadoHome')->name('MercadoHome');


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
Route::view('/AdminConfirmacionMercado','AdminConfirmacionMercado')->name('AdminConfirmacionMercado');
Route::get('/admin-mercado-locals/confirmation', [AdminMercadoLocalController::class, 'confirmation'])->name('admin-mercado-locals.confirmation');






// Auth::routes();
//ROUTES POR CONTROLADORES
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('mercado-locals', MercadoLocalController::class)->middleware('check.user.session');;
Route::resource('vendedors', VendedorController::class);
Route::resource('clientes', ClienteController::class);
Route::resource('admin-clientes', AdminClienteController::class);
Route::resource('admin-vendedors', AdminVendedorController::class);
Route::resource('products', ProductController::class);

/**
 * RUTAS DEL USUARIO
 */
//Controlador e index
Route::resource('usuarios', UsuariosController::Class);
Route::get('/usuarios', [UsuariosController::class, 'index'])->name('usuarios.index');
// Ruta para el método mercado,vendedor y producto
Route::get('/usuarios/mercado/{id}', [UsuariosController::class, 'mercado'])->name('usuarios.mercado');
Route::get('/usuarios/vendedor/{id}', [UsuariosController::class, 'vendedor'])->name('usuarios.vendedor');
Route::get('/usuarios/producto/{id}', [UsuariosController::class, 'producto'])->name('usuarios.producto');
//ruta para aniadir alc arrito e index
Route::post('/usuarios/addcarrito/{product}', [UsuariosController::class, 'addcarrito'])->name('usuarios.addcarrito');
//index
Route::get('/usuarios/carrito', [UsuariosController::class, 'carrito'])->name('usuarios.carrito');
//RESERVAR y RESERVAS
Route::post('/usuarios/reservar', [UsuariosController::class, 'reservar'])->name('usuarios.reservar');
Route::get('/usuarios/reservas', [UsuariosController::class, 'reservas'])->name('usuarios.reservas');






Route::resource('admin-mercado-locals', AdminMercadoLocalController::class);

// Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



//CARRITOOOO
Route::get('/pruebauno', function () {
    return view('layout');
});


//Route::resource('users', UserController::class);




//CARRITOO

Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index')->middleware('check.user.session');
    Route::post('/cart/{product}', [CartController::class, 'add'])->name('cart.add')->middleware('check.user.session');
    Route::delete('/cart/{product}', [CartController::class, 'remove'])->name('cart.remove')->middleware('check.user.session');;
});


//RESERVAAAS
Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout')->middleware('check.user.session');;

// routes/web.php
Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');


//RESERVA


Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
Route::get('/reservations/{reservation}', [ReservationController::class, 'show'])->name('reservations.show');
Route::get('/reservations/{reservation}/edit', [ReservationController::class, 'edit'])->name('reservations.edit');
Route::put('/reservations/{reservation}', [ReservationController::class, 'update'])->name('reservations.update');
Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');

