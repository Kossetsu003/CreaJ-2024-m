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
use App\Http\Controllers\VendedoresController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MercadosController;


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
/*ELIMINAR
Route::view('/UserProductoEnEspecifico','UserProductoEnEspecifico')->name('UserProductoEnEspecifico');
Route::view('/UserEditarPerfil','UserEditarPerfil')->name('UserEditarPerfil');
Route::view('/UserCarritoGeneral','UserCarritoGeneral')->name('UserCarritoGeneral');
Route::view('/UserCarritoDePuesto','UserCarritoDePuesto')->name('UserCarritoDePuesto');
Route::view('/UserPuestosVendedores','UserPuestosVendedores')->name('UserPuestosVendedores');
Route::view('/UserProductosDeUnPuesto','UserProductosDeUnPuesto')->name('UserProductosDeUnPuesto');
Route::view('/UserHome','UserHome')->name('UserHome');
Route::view('/UserEstadoReservas','UserEstadoReservas')->name('UserEstadoReservas');*/
Route::view('/UserProfileVista', 'UserProfileVista')->name('UserProfileVista');
Route::view('/UserHistorialPedidos','UserHistorialPedidos')->name('UserHistorialPedidos');/*




/*Vistas de Vendedores*/
/*ELIMINAR*/
Route::view('/VendedorRegistroProducto','VendedorRegistroProducto')->name('VendedorRegistroProducto');/*
Route::view('/VendedorEditarProducto','VendedorEditarProducto')->name('VendedorEditarProducto'); //
Route::view('/VendedorMiBuzon','VendedorMiBuzon')->name('VendedorMiBuzon');*/
Route::view('/VendedorProfileVista','VendedorProfileVista')->name('VendedorProfileVista');/*
Route::view('/VendedorProductoEnEspecifico','VendedorProductoEnEspecifico')->name('VendedorProductoEnEspecifico');
Route::view('/VendedorEditarMiPuesto','VendedorEditarMiPuesto')->name('VendedorEditarMiPuesto'); //*/
Route::view('/VendedorMisReservas','VendedorMisReservas')->name('VendedorMisReservas');/*
Route::view('/VendedorHome','VendedorHome')->name('VendedorHome');*/




/*Vistas de Mercado*/
//ELIMINAR
Route::view('/MercadoRegistrarVendedor','MercadoRegistrarVendedor')->name('MercadoRegistrarVendedor');
Route::view('/MercadoEditarVendedor','MercadoEditarVendedor')->name('MercadoEditarVendedor');
Route::view('/MercadoProfileVista','MercadoProfileVista')->name('MercadoProfileVista');
Route::view('/MercadoVista','MercadoVista')->name('MercadoVista'); //
Route::view('/MercadoListadoVendedores','MercadoListadoVendedores')->name('MercadoListadoVendedores'); //
Route::view('/MercadoPuestoDelVendedor','MercadoPuestoDelVendedor')->name('MercadoPuestoDelVendedor'); //
Route::view('/MercadoHome','MercadoHome')->name('MercadoHome');


/*Administrador General*/
/*ELIMINAR
Route::view('/AdminEditarMercado','AdminEditarMercado')->name('AdminEditarMercado');
Route::view('/AdminListadoClientes','AdminListadoClientes')->name('AdminListadoClientes');*/
Route::view('/AdminProfileVista','AdminProfileVista')->name('AdminProfileVista'); /*
Route::view('/AdminHome','AdminHome')->name('AdminHome');*/
Route::view('/AdminPuestosDelMercado','AdminPuestosDelMercado')->name('AdminPuestosDelMercado');/*
Route::view('/AdminListadoVendedores','AdminListadoVendedores')->name('AdminListadoVendedores');
Route::view('/AdminAgregarMercado','AdminAgregarMercado')->name('AdminAgregarMercado');
Route::view('/AdminPerfilDelVendedor','AdminPerfilDelVendedor')->name('AdminPerfilDelVendedor');
Route::view('/AdminListadoVendedores','AdminListadoVendedores')->name('AdminListadoVendedores');
Route::view('/AdminListadoMercados','AdminPuestosDelMercado')->name('AdminListadoMercados');*/
Route::view('/AdminHistorialPedidos','AdminHistorialPedidos')->name('AdminHistorialPedidos');/*
Route::view('/AdminEstadoPedidos','AdminEstadoPedidos')->name('AdminEstadoPedidos');
Route::view('/AdminConfirmacionMercado','AdminConfirmacionMercado')->name('AdminConfirmacionMercado');
Route::get('/admin-mercado-locals/confirmation', [AdminMercadoLocalController::class, 'confirmation'])->name('admin-mercado-locals.confirmation');*/






// Auth::routes();
//ROUTES POR CONTROLADORES
/*ELIMINAR*/
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('mercado-locals', MercadoLocalController::class);;
Route::resource('vendedors', VendedorController::class);
Route::resource('clientes', ClienteController::class);
Route::resource('admin-clientes', AdminClienteController::class);
Route::resource('admin-vendedors', AdminVendedorController::class);
Route::resource('products', ProductController::class);







/**RUTAS DEL ADMINISTRADOR
 */
//mercadolocales
 Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
 Route::get('/admin/crearmercados', [AdminController::class, 'crearmercados'])->name('admin.crearmercados');
 Route::post('/admin/guardarmercados', [AdminController::class, 'guardarmercados'])->name('admin.guardarmercados');
 Route::get('/admin/vermercados/{id}', [AdminController::class, 'vermercados'])->name('admin.vermercados');
 Route::get('/admin/editarmercados/{id}', [AdminController::class, 'editarmercados'])->name('admin.editarmercados');
 Route::patch('/admin/actualizarmercados/{id}', [AdminController::class, 'actualizarmercados'])->name('admin.actualizarmercados');
 Route::delete('/admin/eliminarmercados/{id}', [AdminController::class, 'eliminarmercados'])->name('admin.eliminarmercados');
//VENDEDORES
 Route::get('/admin/vendedores', [AdminController::class, 'vendedores'])->name('admin.vendedores');
 Route::get('/admin/crearvendedores', [AdminController::class, 'crearvendedores'])->name('admin.crearvendedores');
 Route::post('/admin/guardarvendedores', [AdminController::class, 'guardarvendedores'])->name('admin.guardarvendedores');
 Route::get('/admin/vervendedores/{id}', [AdminController::class, 'vervendedores'])->name('admin.vervendedores');
 Route::get('/admin/editarvendedores/{id}', [AdminController::class, 'editarvendedores'])->name('admin.editarvendedores');
 Route::post('/admin/actualizarvendedores', [AdminController::class, 'actualizarvendedores'])->name('admin.actualizarvendedores');
 Route::delete('/admin/eliminarvendedores/{id}', [AdminController::class, 'eliminarvendedores'])->name('admin.eliminarvendedores');
 //CLIENTES
 Route::get('/admin/clientes', [AdminController::class, 'clientes'])->name('admin.clientes');
 Route::delete('/admin/eliminarclientes/{id}', [AdminController::class, 'eliminarclientes'])->name('admin.eliminarclientes');
//producto
Route::get('/admin/verproducto/{id}', [AdminController::class, 'verproducto'])->name('admin.verproducto');




/**
 * RUTAS DEL USUARIO
 */
//Controlador e index
Route::get('/usuarios', [UsuariosController::class, 'index'])->name('usuarios.index');
// Ruta para el método mercado,vendedor y producto
Route::get('/usuarios/mercado/{id}', [UsuariosController::class, 'mercado'])->name('usuarios.mercado');
Route::get('/usuarios/vendedor/{id}', [UsuariosController::class, 'vendedor'])->name('usuarios.vendedor');
Route::get('/usuarios/producto/{id}', [UsuariosController::class, 'producto'])->name('usuarios.producto');
//ruta para aniadir alc arrito e index
Route::post('/usuarios/addcarrito/{product}', [UsuariosController::class, 'addcarrito'])->name('usuarios.addcarrito');
//RESERVAR y RESERVAS
Route::post('/usuarios/reservar', [UsuariosController::class, 'reservar'])->name('usuarios.reservar');
// Ruta para ver el carrito
Route::get('/usuarios/carrito', [UsuariosController::class, 'carrito'])->name('usuarios.carrito');
// Ruta para ver las reservas del usuario
Route::get('/usuarios/reservas', [UsuariosController::class, 'reservas'])->name('usuarios.reservas');





/**
 * RUTAS PARA EL VENDEDOR CONTROLADOR
 */
Route::get('/vendedores', [VendedoresController::class, 'index'])->name('vendedores.index');
Route::get('/vendedores/editar/{id}', [VendedoresController::class, 'editar'])->name('vendedores.editar');
Route::post('/vendedores/actualizar/{id}', [VendedoresController::class, 'actualizar'])->name('vendedores.actualizar');
//producto
Route::get('/vendedores/productos', [VendedoresController::class, 'productos'])->name('vendedores.productos');
Route::get('/vendedores/verproducto/{id}', [VendedoresController::class, 'verproducto'])->name('vendedores.verproducto');
Route::get('/vendedores/agregarproducto/{id}',[VendedoresController::class, 'agregarproducto'])->name('vendedores.agregarproducto');
Route::post('/vendedores/guardarproducto', [VendedoresController::class, 'guardarproducto'])->name('vendedores.guardarproducto');
Route::get('/vendedores/editarproducto/{id}', [VendedoresController::class, 'editarproducto'])->name('vendedores.editarproducto');
Route::put('/vendedores/actualizarproducto/{id}', [VendedoresController::class, 'actualizarproducto'])->name('vendedores.actualizarproducto');
Route::get('/vendedores/actualizarestadoproducto/{id}', [VendedoresController::class, 'actualizarestadoprodcuto'])->name('vendedores.actualizarestadoproducto');
Route::post('/vendedores/publicarestadoproducto/{id}', [VendedoresController::class, 'publicarestadoproducto'])->name('publicarestadoproducto');
Route::delete('/vendedores/eliminarproducto/{id}', [VendedoresController::class, 'eliminarproducto'])->name('vendedores.eliminarproducto');
//Reservas
Route::get('/vendedores/reservas', [VendedoresController::class, 'reservas'])->name('vendedores.reservas');
Route::get('/vendedores/verreserva/{id}', [VendedoresController::class, 'verreserva'])->name('vendedores.verreserva');
Route::get('/vendedores/actualizarestadoreserva/{id}', [VendedoresController::class])->name('vendedores.actualizarestadoreserva');
Route::post('/vendedores/publicar-estado-reserva/{id}', [VendedoresController::class, 'publicarEstadoReserva'])->name('vendedores.publicar-estado-reserva');
Route::get('/vendedores/historial', [VendedoresController::class, 'historial'])->name('vendedores.historial');




/**
 * RUTAS PARA EL MERCADO CONTROLADOR
 */
Route::get('/mercados', [MercadosController::class, 'index'])->name('mercados.index');
Route::get('/mercados/editar/{id}', [MercadosController::class, 'editar'])->name('mercados.editar');
Route::put('/mercados/actualizar', [MercadosController::class, 'actualizar'])->name('mercados.actualizar');
//vendedores
Route::get('/mercados/vervendedor/{id}', [MercadosController::class, 'vervendedor'])->name('mercados.vervendedor');
Route::get('/mercados/listavendedores', [MercadosController::class, 'listavendedores'])->name('mercados.listavendedores');
Route::get('/mercados/editarvendedor/{id}', [MercadosController::class, 'editarvendedor'])->name('mercados.editarvendedor');
Route::post('/mercados/actualizarvendedor/{id}', [MercadosController::class, 'actualizarvendedor'])->name('mercados.actualizarvendedor');
Route::get('/mercados/agregarvendedor', [MercadosController::class, 'agregarvendedor'])->name('mercados.agregarvendedor');
Route::post('/mercados/guardarvendedor', [MercadosController::class, 'guardarvendedor'])->name('mercados.guardarvendedor');
Route::delete('/mercados/eliminarvendedor/{id}', [MercadosController::class, 'eliminarvendedor'])->name('mercados.eliminarvendedor');
//Reservas
Route::get('/mercados/reservas', [MercadosController::class, 'reservas'])->name('mercados.reservas');
Route::get('/mercados/reservadelvendedor/{id}', [MercadosController::class, 'reservasdelvendedor'])->name('mercados.reservasdelvendedor');
Route::get('/mercados/editarreservas/{id}', [MercadosController::class, 'editarreservas'])->name('mercados.editarreservas');
//productos
Route::get('/mercados/verproducto/{id}', [MercadosController::class, 'verproducto'])->name('mercados.verproducto');







/*PRUEBAS PARA EL CARRITO*/
//CARRITOOOO
Route::get('/pruebauno', function () {
    return view('layout');
});
//Route::resource('users', UserController::class);
//CARRITOO
Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/{product}', [CartController::class, 'remove'])->name('cart.remove');;
});
//RESERVAAAS
Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');;
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

