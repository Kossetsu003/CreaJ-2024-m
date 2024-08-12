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
use Illuminate\Support\Facades\Storage;

/**
 * Class UsuariosController
 * @package App/Http/Controllers
 */

 class VendedoresController extends Controller{


        public function index()
        {
            $id = 1;
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

            $id = 1;//ssion('fk_mercado');
            // Obtener todos los productos que pertenecen al vendedor con el ID especificado
            $productos = Product::where('fk_vendedors', $id)->get();

    // Pasar los productos a la vista para su visualización
        return view('VendedorMisProductos', compact('productos'));

        }
        public function verproducto($id){
            $product = Product::find($id);

            // Verificar si el producto existe antes de proceder
            if (!$product) {
                return redirect()->back()->with('error', 'Producto no encontrado.');
            }

            // Obtener el vendedor del producto
            $vendedor = $product->vendedor;

            // Obtener los productos que comparten la misma llave foránea del vendedor,
            // pero excluyendo el producto actual
            $products = Product::where('fk_vendedors', $product->fk_vendedors)
                ->where('id', '!=', $id)
                ->paginate(3);

            // Retornar la vista con los datos del producto y otros productos del mismo vendedor
            return view('VendedorProductoEnEspecifico', compact('product', 'products', 'vendedor'))
                ->with('i', (request()->input('page', 1) - 1) * $products->perPage());
        }
        public function agregarproducto($id){
            $product = new Product();
            $vendedor = Vendedor::find($id);
            return view('VendedorRegistroProducto', compact('product', 'vendedor'));

        }
        public function guardarproducto(ProductRequest $request){
                        // Validar la solicitud
                    // Validar los datos recibidos del formulario
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string|max:200',
        'price' => 'required|numeric|min:0',
        'categoria' => 'required|string',
        'imagen_referencia' => 'image|mimes:jpeg,png,jpg,gif,svg',
    ]);

    // Procesar la imagen

    /*if ($request->hasFile('imagen_referencia')) {
        // Obtener la clasificación para usarla en el nombre del archivo
        $clasificacion = $request->input('categoria');
        $nombreProducto = str_replace(' ', '_', strtolower($request->input('name')));
        $imageName = "{$nombreProducto}_{$clasificacion}.png";

        // Guardar la imagen en public/imgs
        $request->file('imagen_referencia')->move(public_path('imgs'), $imageName);

        // Guardar el nombre de la imagen en la base de datos
        $imageFileName = $imageName;
    }*/



    // Crear un nuevo producto con los datos validados
    $producto = new Product([
        'name' => $request->input('name'),
        'description' => $request->input('description'),
        'price' => $request->input('price'),
        'categoria' => $request->input('categoria'),
        'estado' => 'Disponible',  // Valor por defecto de estado
        'fk_vendedors' => $request->input('fk_vendedors'),
        'imagen' => $imageName, // Guardar el nombre de la imagen en la base de datos
    ]);
    if ($request->hasFile('imagen_referencia')) {
        $file = $request->file('imagen_referencia');
        $imageName = $request->nombre . '_' . $request->categoria . '.png';

        // Movimiento
        $file->move(public_path('imgs'), $imageName);
        // Guardar
        $producto->imagen_referencia = $imageName;
    }

    // Guardar el producto en la base de datos
    $producto->save();

    // Redireccionar a la página de productos con un mensaje de éxito
    return redirect()->route('vendedores.productos')->with('success', 'Producto registrado exitosamente.');
        }
        public function editarproducto($id){
            $producto = Product::find($id);
            $vendedor = $producto->vendedor;
       ;
        return view('VendedorEditarProducto', compact('producto', 'vendedor'));

        }
        public function actualizarproducto(VendedorRequest $request, $id){

            dd($request->all());
            // Validación de los datos del formulario
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string|max:200',
        'price_type' => 'required|string|in:fixed,per_dollar',
        'price' => 'nullable|numeric|required_if:price_type,fixed',
        'quantity_per_dollar' => 'nullable|integer|required_if:price_type,per_dollar',
        'imagen_referencia' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'fk_vendedors' => 'required|integer|exists:vendedors,id',
        'categoria' => 'required|string',
        'estado' => 'nullable|string',
    ]);

    // Encontrar el producto por su ID
    $product = Product::findOrFail($id);

    // Manejo de la imagen
    if ($request->hasFile('imagen_referencia')) {
        // Eliminar la imagen anterior si existe
        if ($product->imagen_referencia) {
            Storage::disk('public')->delete('imgs/' . $product->imagen_referencia);
        }

        // Crear el nombre de la imagen basado en el nombre y la categoría
        $imageName = $request->input('name') . '_' . $request->input('categoria') . '.png';
        $imagePath = 'imgs/' . $imageName;

        // Guardar la imagen en la carpeta 'public/imgs'
        $request->file('imagen_referencia')->move(public_path('imgs'), $imageName);

        // Asignar el nuevo nombre de la imagen al producto
        $product->imagen_referencia = $imageName;
    }

    // Actualizar los campos del producto
    $product->name = $request->input('name');
    $product->description = $request->input('description');
    $product->price_type = $request->input('price_type');

    if ($product->price_type === 'fixed') {
        $product->price = $request->input('price');
        $product->quantity_per_dollar = null;
    } else {
        $product->price = null;
        $product->quantity_per_dollar = $request->input('quantity_per_dollar');
    }

    $product->fk_vendedors = $request->input('fk_vendedors');
    $product->categoria = $request->input('categoria');
    $product->estado = $request->input('estado', 'disponible');

    // Guardar los cambios en la base de datos
    $product->save();

    // Redireccionar a una vista o ruta deseada con un mensaje de éxito
    return redirect()->route('vendedores.productos')->with('success', 'Producto actualizado exitosamente.');


        }
        public function actualizarestadoproducto(){

        }
        public function publicarestadoproducto(){

        }
        public function eliminarproducto($id){
            $producto = Product::find($id);

            if ($producto) {
                // Eliminar el vendedor
                $producto->delete();
                return redirect()->route('vendedores.productos')->with('success', 'Vendedor eliminado correctamente.');
            } else {
                return redirect()->route('vendedores.productos')->with('error', 'Vendedor no encontrado.');
            }
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
