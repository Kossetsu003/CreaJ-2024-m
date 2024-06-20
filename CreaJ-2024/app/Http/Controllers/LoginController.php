<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MercadoLocal;
use App\Models\Vendedor;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Cliente;


class LoginController extends Controller
{
    public function login()
    {
        return view('LoginUser');
    }

    public function register(Request $request){
        $user = new User();

        $user->email = $request->email;
        $user->password = Hash::make($request->password); // Asegúrate de usar Hash::make()
        $user->nombre = $request->nombre;
        $user->apellido = $request->apellido;
        $user->telefono = $request->telefono;
        $user->sexo = $request->sexo;
    
        $user->save();
    
        Auth::login($user);
    
        return redirect(route('UserProfileVista'));
    }

     public function loginuser(Request $request){
        $credentials = [
            "email"=>$request->email,
            "password"=>$request->password,
        ];

        $remember = ($request->has('remember') ? true:false);
        if(Auth::attempt($credentials,$remember)){
            $request->session()->regenerate();
            return redirect()->intended('privado');
        }else{
            return redirect('LoginUser');
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
