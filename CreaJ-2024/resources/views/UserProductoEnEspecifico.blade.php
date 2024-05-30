<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>ProductoUser</title>
    <link rel="shortcut icon" href="{{ asset('imgs/MiCarritoUser.png') }}" type="image/x-icon">
</head>
<body>
            <!-- Desktop Navbar -->
            <div
            class="hidden md:flex p-4 bg-white items-center justify-between shadow-md"
        >
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-black">
                MiniShop
            </h1>
            <div class="flex items-center">
                    <a href="./UserHome" class="bg-white rounded-full p-1">
                        <img
                            class="w-6"
                            src="{{ asset('imgs/HomeSelectedIcon.png') }}"
                            alt="Home Icon"
                        />
                    </a>
                </div>
                <div class="flex items-center">
                    <a href="./UserCarritoGeneral">
                        <img
                            class="w-6"
                            src="{{ asset('imgs/CarritoIcon.png') }}"
                            alt="Cart Icon"
                        />
                    </a>
                </div>
                <div class="flex items-center">
                    <a href="./UserEstadoPedidos">
                        <img
                            class="w-6"
                            src="{{ asset('imgs/FavIcon.png') }}"
                            alt="Favorites Icon"
                        />
                    </a>c
                </div>
                <div class="flex items-center">
                    <a href="./UserProfileVista">
                        <img
                            class="w-6"
                            src="{{ asset('imgs/UserIcon.png') }}"
                            alt="Profile Icon"
                        />
                    </a>
                </div>
        </div>
        <!-- Mobile Navbar -->
        <div class="fixed bottom-0 left-0 right-0 p-4 md:hidden">
            <div class="bg-gray-900 rounded-2xl h-14 flex justify-around">
            <div class="flex items-center">
                    <a href="./UserHome" class="bg-white rounded-full p-1">
                        <img
                            class="w-6"
                            src="{{ asset('imgs/HomeSelectedIcon.png') }}"
                            alt="Home Icon"
                        />
                    </a>
                </div>
                <div class="flex items-center">
                    <a href="./UserCarritoGeneral">
                        <img
                            class="w-6"
                            src="{{ asset('imgs/CarritoIcon.png') }}"
                            alt="Cart Icon"
                        />
                    </a>
                </div>
                <div class="flex items-center">
                    <a href="./UserEstadoPedidos">
                        <img
                            class="w-6"
                            src="{{ asset('imgs/FavIcon.png') }}"
                            alt="Favorites Icon"
                        />
                    </a>
                </div>
                <div class="flex items-center">
                    <a href="./UserProfileVista">
                        <img
                            class="w-6"
                            src="{{ asset('imgs/UserIcon.png') }}"
                            alt="Profile Icon"
                        />
                    </a>
                </div>
            </div>
        </div>
    <div class="mx-auto mt-10 px-4 max-w-7xl">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
            <img class="rounded-lg w-full shadow-lg" src="{{ asset('imgs/NaranjasQuintal.jpg') }}" alt="Naranjas Quintal">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="font-bold text-2xl lg:text-3xl text-gray-800">Ciento de Naranjas</h2>
                    <div class="flex items-center space-x-2">
                        <button class="bg-gray-200 border border-gray-400 rounded-full w-8 h-8 flex justify-center items-center text-lg text-gray-700">-</button>
                        <span class="text-lg text-gray-800">2</span>
                        <button class="bg-gray-200 border border-gray-400 rounded-full w-8 h-8 flex justify-center items-center text-lg text-gray-700">+</button>
                    </div>
                </div>

                <div class="flex items-center mb-4">
                    <img class="w-6 mr-2" src="{{ asset('imgs/775819.svg') }}" alt="Rating Icon">
                    <img class="w-6 mr-2" src="{{ asset('imgs/775819.svg') }}" alt="Rating Icon">
                    <img class="w-6 mr-2" src="{{ asset('imgs/775819.svg') }}" alt="Rating Icon">
                    <img class="w-6 mr-2" src="{{ asset('imgs/775819.svg') }}" alt="Rating Icon">
                    <img class="w-6 mr-2" src="{{ asset('imgs/775819.svg') }}" alt="Rating Icon">
                    <span class="text-lg text-gray-800">5.0</span>
                </div>

                <p class="text-gray-600 mb-4 text-lg">
                    Vendo Ciento de Naranjas Valencia en El Mercado Ex-Cuartel, jugosas y ácidas perfectas para fresco. Recién cortadas desde La Libertad a $9.00 el ciento.
                </p>
                <hr class="my-4">

                <div class="mb-6">
                    <h3 class="font-bold text-xl lg:text-2xl text-gray-800">Precio</h3>
                    <p class="text-xl lg:text-2xl text-gray-900">$9.00</p>
                </div>

                <button class="w-full bg-gray-800 text-white text-lg font-bold py-3 rounded-lg hover:bg-gray-700 flex items-center justify-center">
                    <img class="w-6 h-6 mr-2" src="{{ asset('imgs/carrito-de-compras.png') }}" alt="Add to Cart">
                    Añadir a MiCarrito
                </button>
            </div>
        </div>

        <!-- Recommended Products Section -->
        <div class="mt-16">
            <h2 class="text-2xl lg:text-3xl font-bold text-gray-800 mb-8">Productos Recomendados</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Product Card 1 -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <img class="rounded-lg w-full mb-4" src="{{ asset('imgs/RopaFoto.jpg') }}" alt="Producto 1">
                    <h3 class="font-bold text-lg text-gray-800">Producto 1</h3>
                    <p class="text-gray-600 mb-4">Descripción breve del producto 1. Precio: $5.00</p>
                </div>
                <!-- Product Card 2 -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <img class="rounded-lg w-full mb-4" src="{{ asset('imgs/RopaFoto.jpg') }}" alt="Producto 2">
                    <h3 class="font-bold text-lg text-gray-800">Producto 2</h3>
                    <p class="text-gray-600 mb-4">Descripción breve del producto 2. Precio: $7.50</p>
                </div>
                <!-- Product Card 3 -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <img class="rounded-lg w-full mb-4" src="{{ asset('imgs/RopaFoto.jpg') }}" alt="Producto 3">
                    <h3 class="font-bold text-lg text-gray-800">Producto 3</h3>
                    <p class="text-gray-600 mb-4">Descripción breve del producto 3. Precio: $6.00</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
