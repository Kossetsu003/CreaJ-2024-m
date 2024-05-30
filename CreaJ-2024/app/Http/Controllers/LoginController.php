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
        return view('login');
}

public function loginpost(ClienteRequest $request){

    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }
    
    $credentials = [
        'usuario' => $request->usuario,
        'password' => $request->password,

    ];

    if(Auth::attempt($credentials)){
        return redirect('/home')->with('success', 'Bienvenido a Minishop');
    }
    else{
        return redirect('login')->with('error', 'Usuario o contraseña incorrecta');
}
}}