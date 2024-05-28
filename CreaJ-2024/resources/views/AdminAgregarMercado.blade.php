@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Mercado Local
@endsection

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="shortcut icon" href="{{ asset('imgs/MiCarritoUser.png') }}" type="image/x-icon">
    <title>Agregar Mercado Local</title>
</head>
<body>

<section>
    <div class="w-72 mx-auto mt-16 ">

        <div class="text-center">
            <h1 class="text-3xl font-bold text-purple-600">Agregar Mercado</h1>
            <h3 class="mt- "><b>LOCAL</b></h3>
        </div>
        
        <form method="POST" action="#" role="form" enctype="multipart/form-data">
            @csrf
            <div class="mt-20 space-y-4">
                <div class="flex justify-between">
                    <label for="imagen_referencia" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 flex items-center relative">
                        <span class="text-gray-400 text-xs">Imagen del mercado</span>
                        <input required type="file" name="imagen_referencia" class="hidden border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control" id="imagen_referencia" placeholder="Imagen Referencia">
                        <span class="rounded-lg w-5 h-5 absolute right-2 top-2 bg-cover" style="background-image: url('{{ asset('imgs/files2.svg') }}');"></span>
                    </label>
                </div>

                <div class="flex justify-center">
                    <input required type="text" name="nombre" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control" id="nombre" placeholder="Nombre Registrado del Mercado">
                </div>

                <div class="flex justify-center">
                    <input required type="text" name="municipio" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control" id="municipio" placeholder="Municipio Ubicado">
                </div>

                <div class="flex justify-center">
                    <input required type="text" name="ubicacion" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control" id="ubicacion" placeholder="Ubicacion Especifica del Mercado">
                </div>

                <div class="flex justify-center">
                    <span class="text-xs text-gray-400 px-6">Hora de Entrada</span>
                    <span class="px-6 text-xs text-gray-400">Hora de Salida</span>
                </div>

                <div class="flex justify-center">
                    <input required type="time" name="horaentrada" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control" id="horaentrada" placeholder="Horaentrada">
                    <input required type="time" name="horasalida" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control" id="horasalida" placeholder="Horasalida">
                </div>

                <div class="flex justify-center">
                    <span class="text-xs text-gray-400 px-6">Descripcion del Mercado</span>
                </div>

                <div class="flex justify-center">
                    <textarea required name="descripcion" class="border-1 rounded border w-80 h-24 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control" id="descripcion"></textarea>
                </div>

                <div class="flex justify-center ">
                    <button class="btn btn-primary bg-purple-500 w-72 h-10 flex items-center mt-10 mb-20 justify-center gap-x-2 rounded-md px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-purple-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-opacity-50">Guardar</button>
                </div>
            </div>
        </form>

        <!--INICIO DE NAVBAR MOBIL-->
        <div class="bottom-bar fixed bottom-[1%] left-0 right-0 flex justify-center">
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
        <!--FIN DE NAVBAR MOBIL-->
    </div>
</section>

</body>
</html>
@endsection
