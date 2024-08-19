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
use App\Http\Requests\ReservationItemRequest;
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
    // Verificar si el usuario autenticado es un vendedor
    if (Auth::guard('vendedor')->check()) {
        // Obtener el vendedor autenticado desde el guard 'vendedor'
        $vendedor = Auth::guard('vendedor')->user();
        // Obtener la información del mercado local relacionado con el vendedor
        $mercadoLocal = $vendedor->mercadoLocal;
        // Obtener los productos del vendedor autenticado
        $products = Product::where('fk_vendedors', $vendedor->id)->get();
        // Retornar la vista con los datos del vendedor, productos y mercado local
        return view('VendedorHome', compact('vendedor', 'products', 'mercadoLocal'));
    }
    // Si el usuario no es un vendedor, se puede redirigir o manejar el error
    return redirect()->route('login')->with('error', 'Acceso no autorizado');
}

public function perfil(){
    if (Auth::guard('vendedor')->check()) {
        // Obtener el vendedor autenticado desde el guard 'vendedor'
        $vendedor = Auth::guard('vendedor')->user();
        // Obtener la información del mercado local relacionado con el vendedor
        $mercadoLocal = $vendedor->mercadoLocal;
        // Obtener los productos del vendedor autenticado
        $products = Product::where('fk_vendedors', $vendedor->id)->get();
        // Retornar la vista con los datos del vendedor, productos y mercado local
        return view('VendedorProfileVista', compact('vendedor', 'products', 'mercadoLocal'));
    }
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
    // Obtener el vendedor autenticado
    $vendedor = Auth::guard('vendedor')->user();
    // Verificar si el vendedor autenticado existe
    if ($vendedor) {
        // Obtener todos los productos que pertenecen al vendedor autenticado
        $productos = Product::where('fk_vendedors', $vendedor->id)->get();
        // Pasar los productos y el vendedor a la vista para su visualización
        return view('VendedorMisProductos', compact('productos', 'vendedor'));
    }
    // Si no hay vendedor autenticado, redirigir al login o manejar el error
    return redirect()->route('login')->with('error', 'Acceso no autorizado');
}

public function verproducto($id)
{
    // Obtener el producto por ID
    $product = Product::find($id);
    // Verificar si el producto existe antes de proceder
    if (!$product) {
        return redirect()->back()->with('error', 'Producto no encontrado.');
    }
    // Obtener el vendedor autenticado
    $vendedorAutenticado = Auth::guard('vendedor')->user();
    // Verificar si el vendedor autenticado es el propietario del producto
    if ($product->fk_vendedors !== $vendedorAutenticado->id) {
        return redirect()->route('vendedor.productos')->with('error', 'No estás autorizado para ver este producto.');
    }
    // Obtener los productos que comparten la misma llave foránea del vendedor,
    // pero excluyendo el producto actual
    $products = Product::where('fk_vendedors', $vendedorAutenticado->id)
        ->where('id', '!=', $id)
        ->paginate(3);
    // Retornar la vista con los datos del producto y otros productos del mismo vendedor
    return view('VendedorProductoEnEspecifico', compact('product', 'products', 'vendedorAutenticado'))
        ->with('i', (request()->input('page', 1) - 1) * $products->perPage());
}


public function agregarproducto()
{
    // Obtener el vendedor autenticado
    $vendedor = Auth::guard('vendedor')->user();
    // Verificar si el vendedor autenticado existe
    if ($vendedor) {
        // Crear una nueva instancia de Product
        $product = new Product();
        // Pasar el producto vacío y el vendedor autenticado a la vista
        return view('VendedorRegistroProducto', compact('product', 'vendedor'));
    }
    // Si no hay un vendedor autenticado, redirigir al login o manejar el error
    return redirect()->route('login')->with('error', 'Acceso no autorizado');
}


        public function guardarproducto(ProductRequest $request)
        {
            // Validar la solicitud
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string|max:200',
                'price' => 'required|numeric|min:0',
                'categoria' => 'required|string',
                'imagen_referencia' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // La imagen es requerida
            ]);
            // Procesar la imagen
            if ($request->hasFile('imagen_referencia')) {
                // Generar el nombre de la imagen según los campos 'name' y 'categoria'
                $nombreProducto = str_replace(' ', '_', strtolower($request->input('name')));
                $clasificacion = str_replace(' ', '_', strtolower($request->input('categoria')));
                $imageName = "{$nombreProducto}_{$clasificacion}.png";
                // Mover la imagen a la carpeta public/imgs
                $path = $request->file('imagen_referencia')->move(public_path('imgs'), $imageName);
                // Verifica si la imagen se movió correctamente
                if (!$path) {
                    return back()->withErrors(['imagen_referencia' => 'No se pudo mover la imagen.']);
                }
            } else {
                return back()->withErrors(['imagen_referencia' => 'Es obligatorio subir una imagen.']);
            }
            // Crear un nuevo producto con los datos validados
            $producto = new Product([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'price' => $request->input('price'),
                'categoria' => $request->input('categoria'),
                'estado' => 'Disponible',  // Valor por defecto de estado
                'fk_vendedors' => $request->input('fk_vendedors'),
                'imagen_referencia' => $imageName, // Guardar el nombre de la imagen en la base de datos
            ]);
            // Guardar el producto en la base de datos
            $producto->save();
            // Redireccionar a la página de productos con un mensaje de éxito
            return redirect()->route('vendedores.productos')->with('success', 'Producto registrado exitosamente.');
        }

        public function editarproducto($id){
            $producto = Product::find($id);
            $vendedor = $producto->vendedor;
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
        public function reservas()
{
    // Obtener el vendedor autenticado desde el guard 'vendedor'
    $vendedor = Auth::guard('vendedor')->user();

    // Verificar si se encontró un vendedor autenticado
    if (!$vendedor) {
        return redirect()->route('login')->with('error', 'Debes iniciar sesión para acceder a esta página.');
    }

    // Obtener el ID del mercado asociado al vendedor autenticado
    $mercadoId = $vendedor->fk_mercado;

    // Obtener las reservas que tienen items relacionados con el vendedor autenticado y su mercado
    $reservations = Reservation::whereHas('items.product.vendedor', function ($query) use ($vendedor) {
            $query->where('fk_vendedors', $vendedor->id);
        })
        ->with(['items' => function ($query) use ($vendedor) {
            $query->whereHas('product.vendedor', function ($q) use ($vendedor) {
                $q->where('fk_vendedors', $vendedor->id);
            })
            ->with('product.vendedor');
        }])
        ->get();

    // Retornar la vista con las reservas filtradas y el vendedor autenticado
    return view('VendedorEstadoReservas', compact('reservations', 'vendedor'));
}




        public function verreserva(){

        }


        public function publicarestadoreserva(Request $request, $id)
{
    // Obtener el vendedor autenticado desde el guard 'vendedor'
    $vendedor = Auth::guard('vendedor')->user();

    // Obtener el ReservationItem por ID
    $item = ReservationItem::find($id);

    // Verificar si el item fue encontrado
    if (!$item) {
        return redirect()->route('vendedores.reservas')->with('error', 'El ítem de la reserva no fue encontrado.');
    }

    // Verificar si el item pertenece al vendedor autenticado
    if ($item->fk_vendedors == $vendedor->id) {
        // Validar el estado enviado
        $estadoValido = ['enviado', 'sin_existencias', 'en_espera', 'sin_espera', 'en_entrega', 'recibido', 'sin_recibir', 'problemas', 'archivado'];
        $nuevoEstado = $request->input('estado');

        if (in_array($nuevoEstado, $estadoValido)) {
            // Actualizar el estado del item
            $item->estado = $nuevoEstado;
            $item->save();

            // Verificar y actualizar el estado de la reserva si todos los items tienen un mismo estado
            $fk_reservation = $item->fk_reservation;

            foreach (['en_entrega', 'sin_existencias', 'en_espera', 'sin_espera', 'archivado', 'problemas'] as $estado) {
                $todosEnEstado = ReservationItem::where('fk_reservation', $fk_reservation)
                    ->where('estado', '!=', $estado)
                    ->count() == 0;

                if ($todosEnEstado) {
                    $reserva = Reservation::find($fk_reservation);
                    $reserva->estado = $estado;
                    $reserva->save();
                    break;
                }
            }

            // Redireccionar a la vista o hacer otra acción
            return redirect()->route('vendedores.reservas')->with('success', 'El estado de la reserva ha sido actualizado.');
        } else {
            // Estado no válido
            return redirect()->route('vendedores.reservas')->with('error', 'El estado proporcionado no es válido.');
        }
    } else {
        // Si no pertenece al vendedor autenticado, mostrar un error
        return redirect()->route('vendedores.reservas')->with('error', 'No tienes permiso para actualizar este item.');
    }
}


        public function eliminarReservationItem(Request $request, $id)
{
    // Obtener el ReservationItem por ID
    $item = ReservationItem::find($id);
    // Verificar si el item fue encontrado
    if (!$item) {
        return redirect()->route('vendedores.reservas')->with('error', 'El ítem de la reserva no fue encontrado.');
    }
    // Obtener la fk_reservation antes de eliminar el item
    $fk_reservation = $item->fk_reservation;
    // Eliminar el ReservationItem
    $item->delete();
    // Verificar si no quedan más ReservationItems asociados a esta reserva
    $itemsRestantes = ReservationItem::where('fk_reservation', $fk_reservation)->count();
    if ($itemsRestantes == 0) {
        // Si no quedan más items, eliminar la Reservation
        $reserva = Reservation::find($fk_reservation);
        if ($reserva) {
            $reserva->delete();
        }
    }
    // Redireccionar o realizar otra acción
    return redirect()->route('vendedores.reservas')->with('success', 'El ítem de la reserva y la reserva asociada (si aplica) han sido eliminados.');
}




public function historial()
{
    // Obtener el vendedor autenticado
    $vendedor = Auth::guard('vendedor')->user();

    // Verificar si el vendedor autenticado existe
    if (!$vendedor) {
        return redirect()->route('login')->with('error', 'Acceso no autorizado');
    }

    // Obtener el ID del vendedor autenticado
    $id = $vendedor->id;

    // Obtener todas las reservas con sus items según el vendedor autenticado
    $reservations = Reservation::whereHas('items', function ($query) use ($id) {
        $query->where('fk_vendedors', $id);
    })
    ->with(['items' => function ($query) use ($id) {
        $query->where('fk_vendedors', $id)->with('product.vendedor');
    }])
    ->get();

    // Retornar la vista con las reservas
    return view('VendedorHistorialReservas', compact('reservations', 'vendedor', 'id'));
}




 }
