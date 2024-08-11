<?php

namespace App\Http\Controllers;

//modelos
use App\Models\User;
use App\Models\Clientes;
use App\Models\MercadoLocal;
use App\Models\Vendedor;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Reservation;
use App\Models\ReservationItem;
//request
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\ClienteRequest;
use App\Http\Requests\MercadoLocalRequest;
use App\Http\Requests\VendedorRequest;
use App\Http\Requests\CartRequest;
use App\Http\Requests\ReservationRequest;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\VendedorRequest as RequestsVendedorRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

/**
 * Class UsuariosController
 * @package App/Http/Controllers
 */

 class VendedoresController extends Controller{


        public function index()
        {
            $id = 3;
            $vendedor = Vendedor::with('mercadoLocal')->find($id);
            $mercadoLocal = $vendedor->mercadoLocal;
            $products = Product::where('fk_vendedors', $id)->get();

            return view('VendedorHome', compact('vendedor', 'products','mercadoLocal'));
        }
        public function editar($id){
             //MercadoEditarVendedor.blade.php
        $vendedor = Vendedor::find($id);
        $mercados = MercadoLocal::all();
        return view('VendedorEditarPuesto', compact('vendedor', 'mercados'));

        }
        public function actualizar(VendedorRequest $request, $id){
            $request->validate([
                'password' => 'nullable|string|min:8|confirmed',
                'nombre' => 'required|string|max:255',
                'nombre_del_local' => 'required|string|max:255',
                'imagen_de_referencia' => 'required|image|mimes:jpeg,png,jpg,gif,svg ',
                'clasificacion' => 'required|string|max:255',
                'apellidos' => 'required|string|max:255',
                'telefono' => 'required|string|max:255',
                'numero_puesto' => 'required|integer|unique:vendedors,numero_puesto,' . $id,
                'fk_mercado' => 'required|exists:mercado_locals,id',
            ]);

            // Encontrar el vendedor por ID
            $vendedor = Vendedor::findOrFail($id);

            // Actualizar los campos
            $vendedor->usuario = $request->input('usuario');
            $vendedor->ROL = $request->input('ROL');

            // Si la contraseña se envía, actualiza, de lo contrario, deja la existente
            if ($request->filled('password')) {
                $vendedor->password = bcrypt($request->input('password'));
            }

            $vendedor->nombre = $request->input('nombre');
            $vendedor->nombre_del_local = $request->input('nombre_del_local');
            $vendedor->clasificacion = $request->input('clasificacion');
            $vendedor->apellidos = $request->input('apellidos');
            $vendedor->telefono = $request->input('telefono');
            $vendedor->numero_puesto = $request->input('numero_puesto');
            $vendedor->fk_mercado = $request->input('fk_mercado');

            // Manejar la imagen de referencia
            if ($request->hasFile('imagen_de_referencia')) {
                // Guardar la imagen
                $imageName = time() . '.' . $request->imagen_de_referencia->extension();
                $request->imagen_de_referencia->move(public_path('imgs'), $imageName);

                // Eliminar la imagen antigua si existe
                if ($vendedor->imagen_de_referencia && file_exists(public_path('imgs/' . $vendedor->imagen_de_referencia))) {
                    unlink(public_path('imgs/' . $vendedor->imagen_de_referencia));
                }

                // Actualizar la referencia en la base de datos
                $vendedor->imagen_de_referencia = $imageName;
            }

            // Guardar los cambios en la base de datos
            $vendedor->save();

            // Redireccionar o devolver una respuesta
            return redirect()->route('vendedores.index', $id)->with('success', 'Vendedor actualizado correctamente.');

        }





        /**
         * PRODUCTO
         */
        public function productos(){
            $id = 3;
            // Obtener todos los productos que pertenecen al vendedor con el ID especificado
    $productos = Product::where('fk_vendedors', $id)->get();

    // Pasar los productos a la vista para su visualización
    return view('productos.index', compact('productos'));

        }
        public function verproducto(){

        }
        public function agregarproducto($id){
            $product = new Product();
            $vendedor = Vendedor::find($id);
            return view('VendedorRegistroProducto', compact('product', 'vendedor'));

        }
        public function guardarproducto(ProductRequest $request){
                        // Validar la solicitud
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'categoria' => 'required|string|max:255',
        'imagen_referencia' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'fk_vendedors' => 'required|exists:vendedors,id',
    ]);

    // Manejar la imagen de referencia si se proporciona
    if ($request->hasFile('imagen_referencia')) {
        // Construir el nombre de la imagen
        $producto = str_replace(' ', '_', strtolower($request->input('name')));
        $categoria = str_replace(' ', '_', strtolower($request->input('categoria')));
        $imageName = "{$producto}_{$categoria}.png";

        // Mover el archivo a la carpeta 'imgs' y guardar solo el nombre del archivo
        $request->file('imagen_referencia')->move(public_path('imgs'), $imageName);

        // Guardar solo el nombre del archivo en la base de datos
        $imagenReferencia = $imageName;
    }



    // Crear el nuevo producto
    $product = new Product();
    $product->name = $request->name;
    $product->description = $request->description;
    $product->price = $request->price;
    $product->categoria = $request->categoria;
    $product->estado = 'Disponible';
    $product->imagen_referencia = $imagenReferencia;
    $product->fk_vendedors = $request->fk_vendedors;
    $product->save();

    // Redirigir o mostrar mensaje de éxito
    return redirect()->route('vendedores.index')->with('success', 'Producto agregado exitosamente.');

        }
        public function editarproducto(){

        }
        public function actualizarproducto(){

        }
        public function actualizarestadoproducto(){

        }
        public function publicarestadoproducto(){

        }
        public function eliminarproducto(){

        }


        /**
         * RESERVAS
         */
        public function reservas(){

        }
        public function verreserva(){

        }
        public function actualizarestadoreserva(){

        }
        public function publicarestadoreseva(){

        }


 }
