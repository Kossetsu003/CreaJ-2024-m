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

        Auth::login($user);

        return redirect(route('UserProfileVista'));
    }

    public function LoginUser(Request $request)
    {
        $credentials = $request->only('usuario', 'password');
        $remember = $request->filled('remember');

        // Intentar autenticar como usuario normal
        if (Auth::guard('web')->attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended('UserProfileVista'); // Ruta para usuarios normales
        }

        // Intentar autenticar como vendedor
        else if (Auth::guard('vendedor')->attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended('VendedorHome'); // Ruta para vendedores
        }

        // Si ninguna autenticación tiene éxito
        return redirect('LoginUser')->with('error', 'Credenciales incorrectas. Inténtelo de nuevo.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('login'));
    }
}
