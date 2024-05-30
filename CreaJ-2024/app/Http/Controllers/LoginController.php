<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login()
    {
        return view('LoginUser');
    }

    public function loginpost(Request $request)
    {
        // Validar los datos del formulario
        $validator = Validator::make($request->all(), [
            'usuario' => 'required|email',
            'contrasena' => 'required',
        ]);

        // Verificar si la validación falla
        if ($validator->fails()) {
            return redirect()->route('login')
                ->withErrors($validator)
                ->withInput();
        }

        // Buscar al cliente en la base de datos
        $cliente = Cliente::where('usuario', $request->usuario)->first();

        // Verificar si se encontró al cliente y la contraseña coincide
        if ($cliente && Hash::check($request->contrasena, $cliente->contrasena)) {
            // Autenticación exitosa
            Auth::login($cliente);

            // Almacenar los datos del cliente en la sesión
            $request->session()->put('cliente_id', $cliente->id);
            $request->session()->put('cliente_nombre', $cliente->nombre);
            $request->session()->put('cliente_telefono', $cliente->telefono);

            // Redirigir al cliente a la página de inicio
            return redirect()->route('UserHome')->with('success', 'Bienvenido a MiniShop');
        }

        // Autenticación fallida
        return redirect()->route('login')->with('error', 'Usuario o contraseña incorrecta');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidar y regenerar la sesión
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('LoginUser')->with('success', 'Has cerrado sesión correctamente.');
    }
}
