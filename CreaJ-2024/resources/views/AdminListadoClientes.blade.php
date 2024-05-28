@extends('layouts.app')

@section('template_title')
    Cliente
@endsection

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>EditarPuesto Vendedor</title>
    <link rel="shortcut icon" href="{{ asset('imgs/MiCarritoUser.png') }}" type="image/x-icon">
</head>
<body>

     <div class="mx-auto max-w-lg mt-10 mb-32"> <!-- Añadido un margen inferior -->
        <div class="bottom-bar fixed bottom-[5%] left-0 right-0 flex justify-center">
            <!--INICIO DE NAVBAR MOBIL-->
            <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around">
                <div class="flex items-center  ">
                    <a href="./UserHome" ><img class="w-6" src="{{ asset('imgs/HomeIcon.png') }}" alt="User Icon"></a>
                </div>

                <div class="flex items-center">
                    <a href="./UserCarritoGeneral" class=" bg-white rounded-full p-[0.25rem] "><img class="w-6" src="{{ asset('imgs/CarritoSelectedIcon.png') }}" alt="User Icon"></a>
                </div>

                <div class="flex items-center">
                    <a href="./UserEstadoPedidos"><img class="w-6" src="{{ asset('imgs/FavIcon.png') }}" alt="User Icon"></a>
                </div>
                <div class="flex items-center">
                    <a href="./UserEditarPerfil"><img class="w-6" src="{{ asset('imgs/UserIcon.png') }}" alt="User Icon"></a>
                </div>
            </div>

            <!--FIN DE NAVBAR MOBIL-->
        </div>

        <div class="ml-2">
            <div class="flex">
                <div class="font-bold text-4xl">
                    Mini
                </div>
                <div>
                    <img class="w-6 ml-3 mt-3" src="{{ asset('imgs/shop.png') }}" alt="User Icon">
                </div>
            </div>
            <div class="font-bold text-xl  text-end w-[34%]">
                Shop
            </div>
        </div>

        <div class="mt-10">
                    <h2 class="text-center text-xl"><b>Listado de Clientes</b></h2>
        </div>

            <div>
                <!-- Frontend sin backend -->
                <div class="mt-[10%] mx-auto ml-8 mr-8 flex ">
                    <img class="w-28 rounded-lg h-28" src="{{ asset('imgs\AguacateQuintal.jpg') }}" alt="User Icon">
                    <div class="ml-2 ">
                        <h3 class="text-sm font-bold">Vendedor :Nombre Apellido</h3>
                        <h3 class="text-xs ">Con Correo Electronico : correo@example.com</h3>
                        <h3 class="text-xs ">Numero de Telefono : 1234567890</h3>
                        <div class="mt-1 mr-5 gap-2 mb-2 ">
                            <button class="btn btn-danger btn-sm bg-red-500 text-white text-xs px-3 py-2 rounded">Eliminar Usuario</button>
                        </div>
                    </div>
                </div>

                <hr class="w-[90%] mx-auto">

        </div>
    </div>

</body>
</html>
@endsection
