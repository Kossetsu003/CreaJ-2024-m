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
        // Verificar si el nombre de usuario ya existe en alguna de las tablas
        if (User::where('usuario', $request->usuario)->exists() || 
            Vendedor::where('usuario', $request->usuario)->exists() || 
            MercadoLocal::where('usuario', $request->usuario)->exists()) {
            return redirect('register')->with('error', 'El nombre de usuario ya está en uso en otra tabla.');
        }

        // Creación del usuario
        $user = new User();
        $user->usuario = $request->usuario;
        $user->password = Hash::make($request->password); // Hashing de la contraseña
        $user->nombre = $request->nombre;
        $user->apellido = $request->apellido;
        $user->telefono = $request->telefono;
        $user->sexo = $request->sexo;

    $user->usuario = $request->usuario;
    $user->password = Hash::make($request->password);
    $user->nombre = $request->nombre;
    $user->apellido = $request->apellido;
    $user->telefono = $request->telefono;
    $user->sexo = $request->sexo;

    $user->save();

    Auth::login($user);

    return redirect(route('UserProfileVista','user'))->with('success', '¡Registro exitoso!');
    }

    public function LoginUser(Request $request)
    {
        $credentials = $request->only('usuario', 'password');
        $remember = $request->filled('remember');
        $user = null;

        // Autenticar según el rol
        $user = User::where('usuario', $credentials['usuario'])->first();
        
        if ($user) {
            \Log::info('Autenticando usuario: ' . $user->usuario);
            // Intentar autenticar al usuario en la tabla `User`
            if (Auth::attempt($credentials, $remember)) {
                $request->session()->regenerate();
                return $this->redirectUser($user->ROL);
            }
        }

        // Si no es un usuario, intentar en las otras tablas según el rol
        if (!$user) {
            // Autenticación para el rol de Vendedor (rol 3)
            $vendedor = Vendedor::where('usuario', $credentials['usuario'])->first();
            if ($vendedor && Hash::check($credentials['password'], $vendedor->password)) {
                Auth::guard('vendedor')->login($vendedor, $remember);
                $request->session()->regenerate();
                return $this->redirectUser(3);
            }

            // Autenticación para el rol de Mercado (rol 2)
            $mercado = MercadoLocal::where('usuario', $credentials['usuario'])->first();
            if ($mercado && Hash::check($credentials['password'], $mercado->password)) {
                Auth::guard('mercado')->login($mercado, $remember);
                $request->session()->regenerate();
                return $this->redirectUser(2);
            }
        }

        // Si la autenticación falla
        return redirect('login')->with('error', 'Credenciales incorrectas. Inténtelo de nuevo.');
    }

    protected function redirectUser($rol)
    {
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

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('login'));
    }
}
