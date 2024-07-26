<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Estado de Pedidos</title>
    <link rel="shortcut icon" href="{{ asset('imgs/MiCarritoUser.png') }}" type="image/x-icon">
</head>

<body>


    <!-- Desktop Navbar -->
    <div class="hidden md:flex p-4 bg-white items-center justify-between shadow-md">
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-black">
            MiniShop
        </h1>
        <div class="flex gap-8">
            <a href="{{ route('mercado-locals.index') }}"
                class="font-bold uppercase text-sm lg:text-base hover:text-gray-300">Home</a>
            <a href="./UserCarritoGeneral" class="font-bold uppercase text-sm lg:text-base hover:text-gray-300">Cart</a>
            <a href="./UserEstadoPedidos"
                class="font-bold uppercase text-sm lg:text-base hover:text-gray-300">Favorites</a>
            <a href="./UserProfileVista"
                class="font-bold uppercase text-sm lg:text-base hover:text-gray-300">Profile</a>
        </div>
    </div>
    <!-- Mobile Navbar -->
    <div class="fixed bottom-0 left-0 right-0 p-4 md:hidden">
        <div class="bg-gray-900 rounded-2xl h-14 flex justify-around">
            <div class="flex items-center">
                <a href="{{ route('mercado-locals.index') }}" class="bg-white rounded-full p-1">
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

    <main class="p-4">
        <div class="w-full bg-white p-8 rounded-lg shadow-lg">
            <h1 class="text-3xl font-bold mb-6 text-gray-800">Lista de Reservas</h1>

            <div class="space-y-4">
                <div
                    class="p-4 border border-gray-200 rounded-lg flex flex-col justify-between gap-2 md:flex-row md:items-center transition duration-300 hover:bg-gray-50">
                    <div class="flex items-center">
                        <img src="{{ asset('imgs/AguacateQuintal.jpg') }}" alt="Imagen del producto"
                            class="w-16 h-16 rounded-md mr-4">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800">Reserva #1</h2>
                            <p class="text-sm text-gray-600">Fecha: 25 de Mayo, 2024</p>
                        </div>
                    </div>
                    <span class="px-3 w-fit py-1 text-sm font-semibold bg-green-200 text-green-800 rounded-full">Listo
                        para entregar</span>
                </div>

                <div
                    class="p-4 border border-gray-200 rounded-lg flex flex-col justify-between gap-2 md:flex-row md:items-center transition duration-300 hover:bg-gray-50">
                    <div class="flex items-center">
                        <img src="{{ asset('imgs/AguacateQuintal.jpg') }}" alt="Imagen del producto"
                            class="w-16 h-16 rounded-md mr-4">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800">Reserva #2</h2>
                            <p class="text-sm text-gray-600">Fecha: 25 de Mayo, 2024</p>
                        </div>
                    </div>
                    <span
                        class="px-3 w-fit py-1 text-sm font-semibold bg-gray-200 text-gray-800 rounded-full">Entregado</span>
                </div>

                <div
                    class="p-4 border border-gray-200 rounded-lg flex flex-col justify-between gap-2 md:flex-row md:items-center transition duration-300 hover:bg-gray-50">
                    <div class="flex items-center">
                        <img src="{{ asset('imgs/AguacateQuintal.jpg') }}" alt="Imagen del producto"
                            class="w-16 h-16 rounded-md mr-4">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800">Reserva #</h2>
                            <p class="text-sm text-gray-600">Fecha: 23 de Mayo, 2024</p>
                        </div>
                    </div>
                    <span class="px-3 w-fit py-1 text-sm font-semibold bg-yellow-200 text-yellow-800 rounded-full">En
                        Proceso</span>
                </div>
            </div>
        </div>

    </main>
    <footer class="bg-[#292526] pb-16">
        <div class="flex flex-col gap-6 md:gap-0 md:grid grid-cols-3 text-white  p-12">
            <div>
                <h2>Contact Us</h2>
                <p>Misiones a Futuro</p>
                <p>Misiones a Futuro</p>
                <p>Misiones a Futuro</p>
                <p>Misiones a Futuro</p>
                <p>Misiones a Futuro</p>
                <p>Misiones a Futuro</p>
            </div>
            <div>
                <h2>Sobre nosotros</h2>
                <p>Informacion que un no tenemos
                    pero que supongo que sera de vital
                    importancia para el futuro</p>
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
