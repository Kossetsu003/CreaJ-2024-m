<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\MercadoLocal;
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

    public function register(Request $request)
    {
        $cliente = new Cliente();

        $cliente->usuario = $request->usuario;
        $cliente->contrasena = $request->contrasena;
        $cliente->nombre = $request->nombre;
        $cliente->apellido = $request->apellido;
        $cliente->telefono = $request->telefono;
        $cliente->sexo = $request->sexo;

        $cliente->save();

        Auth::login($cliente);

        return redirect(route('privada'));
        

    }
    public function loginuser(Request $request)
    {
        $credentials = [
            'usuario' => $request->usuario,
            'password' => $request->contrasena,
        ];

        $remember = $request->has('remember') ? true : false;

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('privada'));
        } else {
            return redirect()->route('LoginUser')->with('error', 'Credenciales incorrectas. Por favor, inténtelo de nuevo.');
        }
    }
  

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('LoginUser'));
    }
}