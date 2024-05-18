<!--ESTO SIRVE PARA QUE LARAVEL HAGA FUNCIONAR SUS FUNCIONES, PERO ME OBLIGA A TENER UNA PLANTILLA DE UN MENU COMO LARAVEL-->
@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Cliente
@endsection

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="shortcut icon" href="{{ asset('imgs/MiCarritoUser.png') }}" type="image/x-icon">
    <title>Registrar Usuario</title>
</head>
<body>
    <section>

        <!--INFO DE ARRRIBA COMO MOVIL-->
            <div class="pl-5  "> <!-- Contenedor de Login -->
                <div class="login flex items-center">
                    <div class="title">
                        <h2 class="font-bold">Registrar Cuenta</h2>
                    </div>
                    <div class="icon">
                        <img class="w-4 ml-2 " src="../imgs/usuario.png" alt="User Icon">
                    </div>
                </div>
                <h3 class="text-xs font-bold">¡Bienvenido a MiniShop!</h3>
            </div>

            <!--TITULO DE MINISHOP-->
            <div class="w-72 h-96 mt-16 mx-auto"> <!-- Contenedor Principal -->
                <div class="text-center"> <!-- Contenedor Mini Shop -->
                    <h1 class="text-5xl font-bold">Mini<span class="text-purple-400 font-bold">Shop</span></h1>
                </div>


                <!--FORMULARIO-->
                <form method="POST" action="{{ route('clientes.store') }}"  role="form" enctype="multipart/form-data">
                    @csrf
                    <!--ROL ES INVISIBLE-->
                        <input type="hidden" name="ROL" placeholder="Rol" value="4" id="r_o_l" class="form-control @error('ROL') is-invalid @enderror">
                        {!! $errors->first('ROL', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    <!--FIN DEL ROL-->

                    <div class="flex flex-col mt-6"> <!-- Contenedor De Inputs -->

                        <input required type="email" name="usuario" id="usuario" placeholder="Ingrese su Correo Electrónico" class="border rounded border-gray-400 w-full h-9 pl-5 text-xs mt-2 form-control @error('usuario') is-invalid @enderror" value="{{ old('usuario', $cliente?->usuario) }}">
                        {!! $errors->first('usuario', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}

                        <input required type="text" name="nombre" id="nombre" placeholder="Ingrese sus Nombres" class="border rounded border-gray-400 w-full h-9 pl-5 text-xs mt-2 form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $cliente?->nombre) }}">
                         {!! $errors->first('nombre', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}

                        <input required type="text" name="apellido" id="apellido" placeholder="Ingrese su Apellido" class=" border rounded border-gray-400 w-full h-9 pl-5 text-xs mt-2 form-control @error('apellido') is-invalid @enderror" value="{{ old('apellido', $cliente?->apellido) }}" >
                        {!! $errors->first('apellido', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}

                        <input required type="text" name="telefono" class="border rounded border-gray-400 w-full h-9 pl-5 text-xs mt-2 form-control @error('telefono') is-invalid @enderror" value="{{ old('telefono', $cliente?->telefono) }}" id="telefono" placeholder="Ingrese su Número de Teléfono">
                        {!! $errors->first('telefono', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}

                        <select name="sexo" id="sexo" class="border rounded border-gray-400 w-full h-9 pl-5 text-xs mt-2 text-gray-400 form-control @error('sexo') is-invalid @enderror" required>
                            <option value="{{ old('sexo', $cliente?->sexo) }}" class="">Escoga su Género</option>
                            <option value="Masc">Género: Masculino</option>
                            <option value="Fem">Género: Femenino</option>
                        </select>
                        {!! $errors->first('sexo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}


                        <input required type="password"  name="contrasena" class="border rounded border-gray-400 w-full h-9 pl-5 text-xs mt-2 form-control @error('contrasena') is-invalid @enderror" value="{{ old('contrasena', $cliente?->contrasena) }}" id="contrasena" placeholder="Escriba su Contraseña">
                        {!! $errors->first('contrasena', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                        <input required type="password" name="confirmar_contrasena" class="border rounded border-gray-400 w-full h-9 pl-5 text-xs mt-2 form-control" id="confirmar_contrasena" placeholder="Escriba de nuevo su Contraseña">


                    <div class="flex justify-end mt-2"> <!-- Contenedor de forgot password -->
                        <h3 class="text-sm font-bold"><a href="../LoginUser">Ya tengo cuenta</a></h3>
                    </div>
                    </div>

                <div class="flex justify-center mt-5">
                    <button type="submit" class="btn btn-primary bg-purple-400 w-72 h-10 flex items-center justify-center gap-x-2 rounded-md px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-purple-600 hover:text-white focus:outline-none focus:ring-2 focus:ring-purple-400 focus:ring-opacity-50">Registrarse</button>
                </div>
                </form>
            </div>

    </section>


</body>
</html>
<script src="../js/ComprobarContrasena.js"></script>
@endsection
