<!-- !extends('layouts.app') -->
<!--
!section('template_title')
    {{ $cliente->name ?? __('Show') . " " . __('Cliente') }}
!endsection -->

<!-- !section('content') -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>ProfileUser</title>
</head>
<body>
     <!-- Desktop Navbar -->
     <div class="hidden md:flex p-4 bg-white items-center justify-between shadow-md">
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-black">MiniShop</h1>
        <div class="flex gap-8">
            <a href="../UserHome" class="font-bold uppercase text-sm lg:text-base hover:text-gray-300">Home</a>
            <a href="../UserCarritoGeneral" class="font-bold uppercase text-sm lg:text-base hover:text-gray-300">Cart</a>
            <a href="../UserEstadoPedidos" class="font-bold uppercase text-sm lg:text-base hover:text-gray-300">Favorites</a>
            <a href="../UserProfileVista" class="font-bold uppercase text-sm lg:text-base hover:text-gray-300">Profile</a>
        </div>
    </div>
    <!-- Mobile Navbar -->
    <div class="fixed bottom-0 left-0 right-0 p-4 md:hidden">
        <div class="bg-gray-900 rounded-2xl h-14 flex justify-around">
            <div class="flex items-center">
                <a href="./UserHome" class="bg-white rounded-full p-1">
                    <img class="w-6" src="{{ asset('imgs/HomeSelectedIcon.png') }}" alt="Home Icon" />
                </a>
            </div>
            <div class="flex items-center">
                <a href="./UserCarritoGeneral">
                    <img class="w-6" src="{{ asset('imgs/CarritoIcon.png') }}" alt="Cart Icon" />
                </a>
            </div>
            <div class="flex items-center">
                <a href="./UserEstadoPedidos">
                    <img class="w-6" src="{{ asset('imgs/FavIcon.png') }}" alt="Favorites Icon" />
                </a>
            </div>
            <div class="flex items-center">
                <a href="./UserProfileVista">
                    <img class="w-6" src="{{ asset('imgs/UserIcon.png') }}" alt="Profile Icon" />
                </a>
            </div>
        </div>
    </div>
    <div>
       <div class="bg-indigo-300 h-[160px] flex items-center justify-center">
            <h3 class="font-bold text-center text-4xl">Mini<span class="text-white ml-2">Shop</span></h3>
        </div>
        <div class="flex justify-center mt-5">
            <img class="w-20 bg-white rounded-full shadow-md  " src="{{ asset('imgs/usuario.png') }}" alt="User Icon">
        </div>
        <div class="flex justify-center mt-2 ">
            <img class="w-3 h-3 ml-1" src="{{ asset('imgs/estrella.png') }}" alt="User Icon">
            <img class="w-3 h-3 ml-1" src="{{ asset('imgs/estrella.png') }}" alt="User Icon">
            <img class="w-3 h-3 ml-1" src="{{ asset('imgs/estrella.png') }}" alt="User Icon">
            <img class="w-3 h-3 ml-1" src="{{ asset('imgs/estrella.png') }}" alt="User Icon">
            <img class="w-3 h-3 ml-1" src="{{ asset('imgs/estrella.png') }}" alt="User Icon">
            <h3 class="text-[10px]"> <span class="ml-2">5.0</span></h3>
        </div>
        <div class="text-center mt-3">
            <!-- <h3 class="text-xs"><b>{  $cliente->nombre }&nbsp;{ $cliente->apellido }}</b></h3> -->
            <!-- <h3 class="font-bold"><b>Numero Telefonico : </b>{ $cliente->telefono }}</h3> -->
            <!-- <h3 class="text-xs"><b>Correo Electronico : </b>{ $cliente->usuario }}</h3> -->

            <h3 class="text-xs"><b>xd&nbsp;XD</b></h3>
            <h3 class="font-bold"><b>Numero Telefonico : </b>7777-7777</h3>
            <h3 class="text-xs"><b>Correo Electronico : </b>juan@juan.com</h3>
        </div>

        <div class="w-[50%] mx-auto mt-16">
            <div class=" mx-auto flex items-center">
                <img class="w-5" src="{{ asset('imgs/heart.png') }}" alt="User Icon">
                <h3 class="flex-grow text-left font-bold ml-3">Historial De pedidos</h3> <!-- Alineado a la derecha -->
            </div>

            <div class=" mx-auto flex items-center mt-10">
                <img class="w-5" src="{{ asset('imgs/credit-card.png') }}" alt="User Icon">
                <h3 class="flex-grow text-left font-bold ml-5">Estado De pedidos</h3> <!-- Alineado a la derecha -->
            </div>


            <div class=" mx-auto flex items-center mt-10">
                <img class="w-5" src="{{ asset('imgs/megaphone.png') }}" alt="User Icon">
                <h3 class="flex-grow text-left font-bold ml-5">Mi Buzon</h3> <!-- Alineado a la derecha -->
            </div>


            <div class=" mx-auto flex items-center mt-10">
                <img class="w-5" src="{{ asset('imgs/tuerca.png') }}" alt="User Icon">
                <h3 class="flex-grow text-left font-bold  ml-5">Cerrar Cuenta</h3> <!-- Alineado a la derecha -->
            </div>


        </div>

    </div>
</body>
</html>
<!-- !endsection -->
