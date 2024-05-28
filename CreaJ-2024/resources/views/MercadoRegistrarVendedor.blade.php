@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Vendedor
@endsection

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Registrar Vendedor</title>
    <link rel="shortcut icon" href="{{ asset('imgs/MiCarritoUser.png') }}" type="image/x-icon">
</head>
<body>
   
    <section>
        <div class="w-72 h-96 mx-auto ">
            <div class="text-center">
                <h1 class="text-3xl font-bold text-red-500">Registrar vendedor</h1>
            </div>

            <form>
                <div class="pb-[7rem] mt-10 space-y-4">
                    <!-- Frontend sin backend -->
                    <!--<div class="flex justify-between">
                        <label for="file-input" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 flex items-center relative">
                            <span class="text-gray-400">Foto del Vendedor</span>
                            <input id="file-input" type="file" class="hidden" required>
                            <span class="rounded-lg w-5 h-5 absolute right-2 top-2 bg-cover" style="background-image: url('{{ asset('imgs/files2.svg') }}');"></span>
                        </label>
                    </div>-->
                    <div class="flex justify-center">
                        <input required type="email" name="usuario" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control" id="usuario" placeholder="Escriba el correo electronico">
                    </div>

                    <div class="flex justify-center">
                        <input type="text" name="contrasena" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control" id="contrasena" placeholder="Escriba su Contrasena">
                    </div>

                    <div class="flex justify-center">
                        <input type="text" name="contrasena-comprobar" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control" id="contrasena" placeholder="Escriba de nuevo su Contraseña">
                    </div>

                    <div class="pt-5 flex justify-center">
                        <input required type="text" name="nombre" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control" id="nombre" placeholder="Escriba el Nombre del Vendedor">
                    </div>
                    <div class="flex justify-center">
                        <input type="text" name="apellidos" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control" id="apellidos" placeholder="Escriba los Apellidos del Vendedor">
                    </div>
                    <div class="flex justify-center">
                        <input type="text" name="telefono" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control" id="telefono" placeholder="Digite el Telefono del Vendedor">
                    </div>
                    <div class="flex justify-center">
                        <input type="text" name="numero_puesto" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control" id="numero_puesto" placeholder="Escriba el Numero Puesto">
                    </div>
                    <div class="flex justify-center">
                        <input type="text" name="fk_mercado" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control" id="fk_mercado" placeholder="Fk Mercado">
                    </div>

                    <div class="flex justify-center mt-16">
                        <button class="btn btn-primary bg-red-600 w-72 h-10 text-white font-bold rounded-md">Registrar Vendedor</button>
                    </div>
                </div>
            </form>

            <div class="bottom-bar fixed bottom-[5%] left-0 right-0 flex justify-center">
                <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around">
                    <div class="flex items-center  ">
                        <a href="./UserHome"><img class="w-6" src="{{ asset('imgs/HomeIcon.png') }}" alt="User Icon"></a>
                    </div>

                    <div class="flex items-center">
                        <a href="./UserCarritoGeneral"  class=" bg-white rounded-full p-[0.25rem] "><img class="w-6" src="{{ asset('imgs/CarritoSelectedIcon.png') }}" alt="User Icon"></a>
                    </div>

                    <div class="flex items-center">
                        <a href="./UserEstadoPedidos"><img class="w-6" src="{{ asset('imgs/FavIcon.png') }}" alt="User Icon"></a>
                    </div>
                    <div class="flex items-center">
                        <a href="./UserEditarPerfil"><img class="w-6" src="{{ asset('imgs/UserIcon.png') }}" alt="User Icon"></a>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>
</html>
@endsection
