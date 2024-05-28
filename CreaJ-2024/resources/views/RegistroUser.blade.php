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
    <link rel="shortcut icon" href="{{ asset('imgs/MiCarritoUser.png') }}" type="image/x-icon">
    @vite('resources/css/app.css')

    <title>Registrar Usuario</title>
</head>
<body>
    <section>
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

        <div class="w-72 h-96 mt-16 mx-auto"> <!-- Contenedor Principal -->
            <div class="text-center"> <!-- Contenedor Mini Shop -->
                <h1 class="text-5xl font-bold">Mini<span class="text-purple-400 font-bold">Shop</span></h1>
            </div>

            <!--FORMULARIO-->
            <form>
                <input type="hidden" name="ROL" placeholder="Rol" value="4" id="r_o_l" class="form-control">
                <div class="flex flex-col mt-6"> <!-- Contenedor De Inputs -->
                    <input required type="email" name="usuario" id="usuario" placeholder="Ingrese su Correo Electrónico" class="border rounded border-gray-400 w-full h-9 pl-5 text-xs mt-2 form-control">
                    <input required type="text" name="nombre" id="nombre" placeholder="Ingrese sus Nombres" class="border rounded border-gray-400 w-full h-9 pl-5 text-xs mt-2 form-control">
                    <input required type="text" name="apellido" id="apellido" placeholder="Ingrese su Apellido" class="border rounded border-gray-400 w-full h-9 pl-5 text-xs mt-2 form-control">
                    <input required type="text" name="telefono" class="border rounded border-gray-400 w-full h-9 pl-5 text-xs mt-2 form-control" id="telefono" placeholder="Ingrese su Número de Teléfono">
                    <select name="sexo" id="sexo" class="border rounded border-gray-400 w-full h-9 pl-5 text-xs mt-2 text-gray-400 form-control" required>
                        <option value="">Escoga su Género</option>
                        <option value="Masc">Género: Masculino</option>
                        <option value="Fem">Género: Femenino</option>
                    </select>
                    <input required type="password"  name="contrasena" class="border rounded border-gray-400 w-full h-9 pl-5 text-xs mt-2 form-control" id="contrasena" placeholder="Escriba su Contraseña">
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

@endsection
