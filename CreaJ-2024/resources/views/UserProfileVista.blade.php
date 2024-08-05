<!-- !extends('layouts.app') -->
<!--
!section('template_title')
    {{ $cliente->name ?? __('Show') . ' ' . __('Cliente') }}
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
        <a href="{{ route('mercado-locals.index') }}">
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-black">
            Mini <span class="text-blue-600"><b>Shop</b></span>
        </h1>
        </a>
        <div class="flex gap-8">
            <a href="{{ route('mercado-locals.index') }}"
                class="font-bold uppercase text-sm lg:text-base hover:text-gray-300">Hogar</a>
            <a href="{{ route('cart.index') }}"
                class="font-bold uppercase text-sm lg:text-base hover:text-gray-300">Carrito</a>
            <a href="{{ route('UserEstadoPedidos') }}"
                class="font-bold uppercase text-sm lg:text-base hover:text-gray-300">Reservas</a>
            <a href="{{ route('UserProfileVista') }}"
                class="font-bold uppercase text-sm lg:text-base hover:text-gray-300">Perfil</a>
        </div>
    </div>
    <!-- Mobile Navbar -->
   <div class="bottom-bar fixed bottom-[2%] left-0 right-0 md:hidden flex justify-center">
        <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around">
            <div class="flex items-center">
                <a href="{{ route('mercado-locals.index') }}" class="bg-white rounded-full p-1">
                    <img class="w-6" src="{{ asset('imgs/HomeSelectedIcon.png') }}" alt="Home Icon" />
                </a>
            </div>
            <div class="flex items-center">
                <a href="{{ route('cart.index') }}">
                    <img class="w-6" src="{{ asset('imgs/CarritoIcon.png') }}" alt="Cart Icon" />
                </a>
            </div>
            <div class="flex items-center">
                <a href="{{ route('UserEstadoPedidos') }}">
                    <img class="w-6" src="{{ asset('imgs/FavIcon.png') }}" alt="Favorites Icon" />
                </a>
            </div>
            <div class="flex items-center">
                <a href="{{ route('UserProfileVista') }}">
                    <img class="w-6" src="{{ asset('imgs/UserIcon.png') }}" alt="Profile Icon" />
                </a>
            </div>
        </div>
    </div>

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

        <div class="text-center mt-3">
            @auth
                <div> {{ Auth::user()->nombre }}
                    {{ Auth::user()->apellido }} </div>
                <div> {{ Auth::user()->telefono }} </div>
            @endauth
        </div>




    </div>

    <div class="w-[50%] mx-auto m-16">
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

        <form action="{{ route('logout') }}" method="GET">
            @csrf
            <div class="mx-auto flex items-center mt-10">
                <img class="w-5" src="{{ asset('imgs/tuerca.png') }}" alt="User Icon">
                <button type="submit" class="flex-grow text-left font-bold ml-5">Cerrar Cuenta</button>
                <!-- Alineado a la derecha -->
            </div>
        </form>


    </div>

    </div>
    <footer class="bg-[#292526] pb-16">
        <div class="flex flex-col gap-6 md:gap-0 md:grid grid-cols-3 text-white  p-12">
            <div>
                <b>
                    <h2>Contact Us</h2>
                </b>
                <p>Whatsapp: wa.me/50369565421</p>
                <p>Correo Electronico: contacto@minishop.sv</p>
                <p>Dirección: Calle Ruben Dario &, 3 Avenida Sur, San Salvador</p>
            </div>
            <div>
                <b>
                    <b>
                        <h2>Sobre nosotros</h2>
                    </b>
                </b>
                <p>Somos un equipo de desarrollo web dedicado a apoyar a los vendedores locales y municipales en el área
                    metropolitana de San Salvador, brindando soluciones tecnológicas para fortalecer los mercados
                    locales.</p>
            </div>
            <div class="md:self-end md:justify-self-end pb-4">
                <p class="font-black text-5xl mb-4">Mini <span class="text-blue-600">Shop</span></p>
                <div class="flex gap-2">
                    <div class="w-8 aspect-square flex justify-center items-center bg-white rounded-full">
                        <img width="18" class="invert" src="{{ asset('imgs/facebook.png') }}" alt="">
                    </div>
                    <div class="w-8 aspect-square  flex justify-center items-center bg-white rounded-full">
                        <img width="18" class="invert" src="{{ asset('imgs/google.png') }}" alt="">
                    </div>
                    <div class="w-8 aspect-square flex justify-center items-center bg-white rounded-full">
                        <img width="18" class="invert" src="{{ asset('imgs/linkedin.png') }}" alt="">
                    </div>
                    <div class="w-8 aspect-square flex justify-center items-center bg-white rounded-full">
                        <img width="18" class="invert" src="{{ asset('imgs/twitter.png') }}" alt="">
                    </div>
                    <div class="w-8 aspect-square flex justify-center items-center bg-white rounded-full">
                        <img width="18" src="{{ asset('imgs/youtube.png') }}" alt="">
                    </div>

                </div>
            </div>
        </div>
        <div class="w-full h-[2px] bg-white"></div>
    </footer>
</body>

</html>
<!-- !endsection -->
