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
use App\Http\Request\UserRequest;
use App\Http\Request\ClienteRequest;
use App\Http\Request\MercadoLocalRequest;
use App\Http\Request\VendedorRequest;
use App\Http\Request\CartRequest;
use App\Http\Request\ReservationRequest;
use App\Http\Request\ProductRequest;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;



/**
 * Class UsuariosController
 * @package App/Http/Controllers
 */

 class UsuariosController extends Controller{


    //VER MERCADOS LOCALES O INDEX
    public function index(){
        $mercadoLocals = MercadoLocal::paginate();
        $vendedors = Vendedor::paginate();

        $iVendedors = (request()->input('page', 1) - 1) * $vendedors->perPage();
        $iMercadoLocals = (request()->input('page', 1) - 1) * $mercadoLocals->perPage();

        // Retorna la vista 'UserHome' con los datos paginados
        return view('UserHome', compact('vendedors', 'mercadoLocals'))
        ->with('iVendedors', $iVendedors)
        ->with('iMercadoLocals', $iMercadoLocals);
    }

    //VER MERCADO Y SUS PUESTOS
    public function mercado($id)
    {
        // Buscar el mercado local por ID
        $mercadoLocal = MercadoLocal::find($id);

        // Obtener los vendedores con fk_mercado igual al ID del mercado local con paginación
        $vendedors = Vendedor::where('fk_mercado', $id)->paginate();

        // Retornar la vista con ambos datos
        return view('UserPuestosVendedores', compact('mercadoLocal', 'vendedors'))
            ->with('i', (request()->input('page', 1) - 1) * $vendedors->perPage());
    }

    //VER VENDEDOR Y SUS PRODUCTOS
    public function vendedor($id)
    {
        $vendedor = Vendedor::find($id);

        if(!$vendedor) {
            return redirect()->back()->with('error','Vendedor no encontrado');
        }

        //Esta variable es para sacar el nombre del fk__mercadolocal
        $mercadoLocal = $vendedor->mercadoLocal;

        //esta varaible es para sacar los productos
        $products = Product::where('fk_vendedors',$id)->paginate();

        return view('UserProductosDeUnPuesto', compact('vendedor','mercadoLocal','products'))->with('i',(request()->input('page',1) - 1) * $products->perPage());
    }

    //VER EL PRODCUTO
    public function producto($id)
    {
        // Obtener el producto específico por su ID
        $product = Product::find($id);

        // Obtener todos los productos con paginación
        $products = Product::where('id', '!=', $id)->paginate();
        $vendedor = $product->vendedor;

        // Retornar la vista con ambos datos
        return view('UserProductoEnEspecifico', compact('product', 'products','vendedor'))
            ->with('i', (request()->input('page', 1) - 1) * $products->perPage());
    }

    //AGREGAR EL PRODUCTO AL CARRITO
    public function addcarrito(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $quantity = $request->input('quantity');

        $cartItem = Cart::where('fk_product', $product->id)
                        ->where('fk_users', Auth::id())
                        ->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->subtotal = $cartItem->quantity * $cartItem->product->price;
            $cartItem->save();
        } else {
            Cart::create([
                'fk_product' => $product->id,
                'fk_users' => Auth::id(),
                'quantity' => $quantity,
                'subtotal' => $quantity * $product->price
            ]);
        }

        return redirect()->route('usuarios.carrito')->with('success', 'Producto agregado al carrito correctamente.');
    }

    public function carrito()
    {
        try {
            $userid = Auth::id();
            $cartItems = Cart::with('product')->where('fk_users', $userid)->get();
            $total = $cartItems->reduce(fn ($carry, $item) => $carry + ($item->product->price * $item->quantity), 0);
            return view('UserCarritoGeneral', compact('cartItems', 'total', 'userid'));
        } catch (\Exception $e) {
            \Log::error('Error en carrito: ' . $e->getMessage());
            return response()->json(['error' => 'Ocurrió un error interno del servidor'], 500);
        }
    }
    public function reservar(Request $request)
    {
        $user = Auth::user();
        $cartItems = Cart::where('fk_users', $user->id)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Tu carrito está vacío.');
        }

        $total = $cartItems->reduce(function ($carry, $item) {
            return $carry + ($item->product->price * $item->quantity);
        }, 0);

        // Crear la reserva
        $reservation = Reservation::create([
            'fk_users' => $user->id,
            'total' => $total,
        ]);

        // Crear los items de la reserva
        foreach ($cartItems as $item) {
            ReservationItem::create([
                'fk_reservation' => $reservation->id,
                'fk_product' => $item->fk_product,
                'quantity' => $item->quantity,
                'subtotal' => $item->quantity * $item->product->price,
            ]);
        }

        // Vaciar el carrito
        Cart::where('fk_users', $user->id)->delete();

        return redirect()->route('usuarios.reservas')->with('success', 'Reserva creada exitosamente.');
    }
    public function reservas()
    {
        // Obtener las reservas del usuario autenticado con los ítems y productos relacionados
        $reservations = Reservation::where('fk_users', Auth::id())->with('items.product')->get();

        return view('UserEstadoReservas', compact('reservations'));
    }
    public function test()
    {
        return 'Test method works';
    }
    public function carritoPublico()
{
    try {
        return 'Carrito Público';
    } catch (\Exception $e) {
        // Log the exception and return an error message
        \Log::error('Error en carritoPublico: ' . $e->getMessage());
        return response()->json(['error' => 'Ocurrió un error interno del servidor'], 500);
    }
}


    public function reservasPublico()
    {
        return 'Reservas Públicas';
    }

 }

