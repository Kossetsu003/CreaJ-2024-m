<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>MercadoProfileVista</title>
</head>

<body>
    <!--DESKTOP NAVBAR-->

    <div class="hidden md:flex p-4 bg-red-500 items-center justify-between shadow-md">
        <a href="{{ route('mercados.index') }}">
        <h1 class="text-3xl md:text-4xl lg:text- font-bold">
             Mini <span class="text-white font-bold">Mercado</span>
        </h1>
        </a>
        <div class="flex gap-8">
             <a href="{{ route('mercados.index') }}"
                class="font-semibold uppercase text-sm lg:text-base hover:text-gray-200 text-white px-2 py-1">Hogar</a>
           <a href="{{ route('mercados.listavendedores') }}"
                class="font-semibold uppercase text-sm lg:text-base hover:text-gray-200 text-white px-2 py-1">Vendedores</a>
           <a href="{{ route('mercados.reservas') }}"
                class="font-semibold uppercase text-sm lg:text-base hover:text-gray-200 text-white px-2 py-1">Reservas</a>
            <a href="{{ route('mercados.historial') }}"
                class="font-semibold uppercase text-sm lg:text-base hover:text-gray-200 text-white px-2 py-1">Historial</a>
            <a href="{{ route('mercados.perfil') }}"
                class="font-semibold uppercase text-sm lg:text-base  text-white hover:text-black hover:bg-white border border-white px-2 py-1 rounded-md">
                    Perfil
                </a>
        </div>
    </div>
    <!-- Mobile Navbar -->
    <div class="fixed bottom-0 left-0 right-0 p-4 md:hidden">
        <div class="bg-gray-900 rounded-2xl h-14 flex justify-around">
            <div class="flex items-center">
                <a href="{{ route('mercados.index') }}" class="bg-white rounded-full p-1">
                    <img class="w-6" src="{{ asset('imgs/HomeSelectedIcon.png') }}" alt="Home Icon" />
                </a>
            </div>
            <div class="flex items-center">
                <a href="{{ route('mercados.listavendedores') }}">
                    <img class="w-6" src="{{ asset('imgs/CarritoIcon.png') }}" alt="Cart Icon" />
                </a>
            </div>
            <div class="flex items-center">
                <a href="{{ route('mercados.reservas') }}">
                    <img class="w-6" src="{{ asset('imgs/FavIcon.png') }}" alt="Favorites Icon" />
                </a>
            </div>
            <div class="flex items-center">
                <a href="{{ route('mercados.perfil') }}">
                    <img class="w-6" src="{{ asset('imgs/UserIcon.png') }}" alt="Profile Icon" />
                </a>
            </div>
        </div>
    </div>
    <!--END NAVBAR-->
    <div class="mb-[5rem]">
        <div class="bg-red-500 h-36 w-full flex items-center justify-center">
            <h3 class="text-3xl font-bold">Mini<span class="text-white ml-2">Shop</span></h3>
        </div>


        <div class="flex justify-center my-5">
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
            <h3 class="text-xs">{{ $mercadoLocal->municipio }}</h3>
            <h3 class="font-bold">{{ $mercadoLocal->nombre }}</h3>
            <h3 class="text-xs">{{ $mercadoLocal->usuario }}</h3>
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

</body>

</html>
