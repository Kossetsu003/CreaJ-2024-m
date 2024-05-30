@extends('layouts.app')

@section('template_title')
    {{ $mercadoLocal->name ?? __('Show') . " " . __('Mercado Local') }}
@endsection
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Home Mercado User</title>
    <link rel="shortcut icon" href="{{ asset('imgs/MiCarritoUser.png') }}" type="image/x-icon">
</head>
<body>
    <div class="mx-auto max-w-lg mt-10 mb-32"> <!-- Añadido un margen inferior -->
        <div class="bottom-bar fixed bottom-[5%] left-0 right-0 flex justify-center">
            <!--INICIO DE NAVBAR MOBIL-->
            <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around">
                <div class="flex items-center  ">
                    <a href="./HomeUser" class=" bg-white rounded-full p-[0.25rem] "><img class="w-6" src="{{ asset('imgs/HomeSelectedIcon.png') }}" alt="User Icon"></a>
                </div>

                <div class="flex items-center">
                    <a href="./CarritoGeneralUser"><img class="w-6" src="{{ asset('imgs/CarritoIcon.png') }}" alt="User Icon"></a>
                </div>

                <div class="flex items-center">
                    <a href="./EstadoPedidosUser" ><img class="w-6" src="{{ asset('imgs/FavIcon.png') }}" alt="User Icon"></a>
                </div>
                <div class="flex items-center">
                    <a href="./Profile"  ><img class="w-6" src="{{ asset('imgs/UserIcon.png') }}" alt="User Icon"></a>
                </div>
            </div>

            <!--FIN DE NAVBAR MOBIL-->
        </div>

        <div class="mt-14  w-[90%] mx-auto">

            <div class="flex justify-between  w-[90%] mx-auto"> <!--Contenedor Principal-->
                <div>
                    <h1>
                        {{ $mercadoLocal->nombre }}
                    </h1>
                    <div >
                        <b>{{ $mercadoLocal->municipio }}</b>, <br> {{ $mercadoLocal->ubicacion }}
                    </div>
                </div>

                <div>
                    <img class="w-12 rounded-full " src="{{ asset('imgs/PerfilJuana.jpg') }}" alt="User Icon">
                </div>
            </div><!--Fin Principal-->



        <div class="flex items-center mt-5 ">
                    <!-- Campo de búsqueda con icono de lupa -->
                <div class="relative w-[70%] ml-5">
                    <img class="absolute left-2 top-1/2 transform -translate-y-1/2 w-5 h-5" src="{{ asset('imgs/lupa.png') }}" alt="Search Icon">
                    <input class="pl-8 px-2  w-[100%] border rounded-md border-gray-500 py-1 focus:outline-none" type="text" placeholder="Buscar">
                </div>


                <!-- Botón azul -->
                <div class="mr-5 pl-2">
                    <button class="bg-blue-600 rounded-md px-2 py-1 h-[100%] ml-1"> <!-- Reduje el margen izquierdo a 1 -->
                        <img class="w-6 "   src="{{ asset('imgs/SettingIcon.png') }}" alt="User Icon">
                    </button>
                 </div>
        </div>
        <h1 class="justify-center text-bold text-center pt-6 text-[1.5rem]">Vendedores en {{ $mercadoLocal->nombre }} : </h1>
        <div class="flex mt-5">
            <div class="flex mx-auto">
                <button class="flex items-center h-8 border  px-1 py-0.5 rounded-md mr-2 text-xs bg-blue-300 border-blue-300 text-white font-bold">
                    <img class="w-7" src="{{ asset('imgs/SelectBox.png') }}" alt="User Icon">
                    <span class="ml-1">Todos Los puestos</span>
                </button>

                <button class="flex items-center border text-black px-1 py-0.5 rounded-md mr-2 text-xs ">
                    <img class="w-5" src="{{ asset('imgs/ClotheSelected.png') }}" alt="User Icon">
                    <span class="ml-1">Ropa</span>
                </button>

                <button class="flex items-center border text-black px-1 py-0.5 rounded-md text-xs hover:bg-blue-200">
                    <img class="w-5" src="{{ asset('imgs/FoodSelected.png') }}" alt="User Icon">
                    <span class="ml-1">Comida</span>
                </button>
            </div>
        </div>

        <div class="flex flex-wrap justify-center mt-5 text-sm">

          @foreach ($vendedors as $vendedor)
            <a href="./ProductosUser" class="w-[48%] mb-8 p-2">
                <img class="w-full h-[250px] rounded-md overflow-hidden object-cover" src="{{ asset('imgs/NaranjasQuintal.jpg') }}" alt="User Icon">
                <h3 class="font-bold mt-5">Puesto de {{ $vendedor->nombre }} {{ $vendedor->apellidos }}</h3>
                <h3 class="mb-2">Puesto #N {{ $vendedor->numero_puesto }}</h3>
                <div class="flex justify-between">
                    <h3>Correo : {{ $vendedor->usuario }}</h3>

                </div>
            </a>
            @endforeach





        </div>




    </div>
<!-- Paginación -->


</body>
</html>
@endsection
