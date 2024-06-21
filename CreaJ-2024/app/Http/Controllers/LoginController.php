<?php

namespace App\Http\Controllers;

use App\Models\User;
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

    public function loginuser(Request $request)
    {
        $credentials = [
            'usuario' => $request->usuario,
            'password' => $request->password,
        ];

        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended('UserProfileVista');
        } else {
            return redirect('LoginUser')->with('error', 'Credenciales incorrectas. Inténtelo de nuevo.');
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
