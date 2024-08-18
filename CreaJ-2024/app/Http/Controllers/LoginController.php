<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vendedor;
use App\Models\MercadoLocal;
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
        $user = new User();

        $user->usuario = $request->usuario;
        $user->password = Hash::make($request->password); // Asegúrate de usar Hash::make()
        $user->nombre = $request->nombre;
        $user->apellido = $request->apellido;
        $user->telefono = $request->telefono;
        $user->sexo = $request->sexo;

        $user->save();

       $user = Auth::login($user);


        return redirect(route('UserProfileVista','user'));
    }

    public function LoginUser(Request $request)
    {
        $credentials = $request->only('usuario', 'password');
        $remember = $request->filled('remember');
    
        // Intentar autenticar con el guard por defecto
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            $rol = Auth::user()->ROL;
    
            switch ($rol) {
                case 1:
                    return redirect()->intended('admin'); // Ruta para Admin General
                case 2:
                    return redirect()->intended('mercados'); // Ruta para Admin Mercado
                case 3:
                    return redirect()->intended('vendedores'); // Ruta para Vendedores
                case 4:
                    return redirect()->intended('usuarios'); // Ruta para Usuarios normales
                default:
                    Auth::logout();
                    return redirect('login')->with('error', 'Rol no reconocido.');
            }
        }
    
        // Si la autenticación falla
        return redirect('login')->with('error', 'Credenciales incorrectas. Inténtelo de nuevo.');
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('login'));
    }
}
