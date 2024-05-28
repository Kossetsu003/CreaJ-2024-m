@extends('layouts.app')

@section('template_title')
    Mercado Local
@endsection

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Inicio</title>
    <link rel="shortcut icon" href="{{ asset('imgs/MiCarritoUser.png') }}" type="image/x-icon">
</head>
<body>

    <div class="mx-auto max-w-lg mt-10 mb-32 "> <!-- Añadido un margen inferior -->
        <div class="bottom-bar fixed bottom-[5%] left-0 right-0 flex justify-center z-[100]">
            <!--INICIO DE NAVBAR MOBIL-->
            <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around z-[100]">
                <div class="flex items-center  ">
                    <a href="./UserHome" class=" bg-white rounded-full p-[0.25rem] "><img class="w-6" src="{{ asset('imgs/HomeSelectedIcon.png') }}" alt="User Icon"></a>
                </div>

                <div class="flex items-center">
                    <a href="./UserCarritoGeneral"><img class="w-6" src="{{ asset('imgs/CarritoIcon.png') }}" alt="User Icon"></a>
                </div>

                <div class="flex items-center">
                    <a href="./UserEstadoPedidos" ><img class="w-6" src="{{ asset('imgs/FavIcon.png') }}" alt="User Icon"></a>
                </div>
                <div class="flex items-center">
                    <a href="./Profile"  ><img class="w-6" src="{{ asset('imgs/UserIcon.png') }}" alt="User Icon"></a>
                </div>
            </div>

            <!--FIN DE NAVBAR MOBIL-->
        </div>

        <!-- Agregar un margen superior al contenido principal igual a la altura de la barra de navegación -->
        <div class="mt-10"> <!-- Puedes ajustar este valor según sea necesario -->
            <div class="flex justify-between mt-5">
                <div class="ml-[10%]">
                    <h1>Hola! Bienvenido &#x1F44B;</h1>
                    <h3 class="text-blue-800 font-bold">Sra. Maria Mercedes </h3>
                </div>
                <div class="mr-[10%] mt-4">
                    <img class=" rounded-full w-12" src="{{ asset('imgs/PerfilJuana.jpg') }}" alt="User Icon">
                </div>
            </div>

            <div class="text-center mt-5">
                <h1 class="text-[60px] font-bold">Mini <span class="text-blue-600 font-bold">Shop</span></h1>
            </div>

            <div class="mt-5">
                <img class="w-[100%]" src="{{ asset('imgs/PortadaMiniShop.png') }}" alt="User Icon">
            </div>

            <div class="flex mt-5 justify-around w-[90%] mx-auto">
                <a href="#" class="btn btn-primary btn-sm float-right"  data-placement="left">

                    <span class="flex items-center px-3 py-2  rounded-md">
                        <img class="w-7 mr-2" src="{{ asset('imgs/NosotrosIcon.png') }}" alt="User Icon">
                        Agregar Mercado
                    </span>
                </a>
            </div>

            <div class="flex justify-center mt-5 flex-col items-center">
                <!-- Eliminando la iteración de mercadoLocals -->
                <!--INICIO DE PLANTILLA-->
                <a href="#" class="w-[80%] bg-gray-50 rounded-md border border-gray-200 mb-4">
                    <div>
                        <img class="w-[100%] rounded-t-lg" src="{{ asset('imgs/MercadoExCuartel.jpg') }}" alt="User Icon">
                        <div class="text-center mt-2">
                            <h1 class="text-sm font-bold">Nombre Mercado</h1>
                            <h3 class="w-[85%] mx-auto text-xs text-justify pb-5">El Nombre Mercado se encuentra en Ubicacion, en el municipio de Municipio. En el horario siguiente: HoraEntrada - HoraSalida. Descripción del mercado.</h3>
                        </div>
                    </div>
                    <div class="flex justify-center item-center">
                        <!-- Eliminando botones de editar y eliminar -->
                    </div>
                </a>
                <!--FIN DE PLANTILLA -->
            </div>
        </div>
    </div>
</body>
</html>
@endsection
