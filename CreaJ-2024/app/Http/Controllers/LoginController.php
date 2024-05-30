<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Http\Requests\ClienteRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('UserHome');
    }

    public function loginpost(ClienteRequest $request)
    {
        $validator = Validator::make($request->all(), [
            'usuario' => 'required|email',
            'contrasena' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $credentials = [
            'usuario' => $request->usuario,
            'password' => $request->contrasena, // Asegúrate de que el nombre del campo coincida
        ];

        // Intentar autenticarse con las credenciales proporcionadas
        if (Auth::guard('web')->attempt($credentials)) {
            return redirect('/home')->with('success', 'Bienvenido a Minishop');
        } else {
            return redirect('login')->with('error', 'Usuario o contraseña incorrecta');
        }
    }
}
