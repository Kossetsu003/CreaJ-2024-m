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

    <div class="mx-auto max-w-lg"> <!-- Añadido un margen inferior -->
        <div class="bottom-bar fixed bottom-[5%] left-0 right-0 flex justify-center">
            <!--INICIO DE NAVBAR MOBIL-->
            <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around">
                <div class="flex items-center  ">
                    <a href="{{ route('mercado-locals.index') }}"><img class="w-6"
                            src="{{ asset('imgs/HomeIcon.png') }}" alt="User Icon"></a>
                </div>

                <div class="flex items-center">
                    <a href="{{ route('cart.index') }}" class=" bg-white rounded-full p-[0.25rem] "><img class="w-6"
                            src="{{ asset('imgs/CarritoSelectedIcon.png') }}" alt="User Icon"></a>
                </div>

                <div class="flex items-center">
                    <a href="{{ route('UserEstadoPedidos') }}"><img class="w-6" src="{{ asset('imgs/FavIcon.png') }}"
                            alt="User Icon"></a>
                </div>
                <div class="flex items-center">
                    <a href="./UserEditarPerfil"><img class="w-6" src="{{ asset('imgs/UserIcon.png') }}"
                            alt="User Icon"></a>
                </div>
            </div>

            <!--FIN DE NAVBAR MOBIL-->
        </div>
    </div>

    <main class="p-4">
        <div class="w-full bg-white p-8 rounded-lg shadow-lg">
            <div class="pb-4">
                <div>
                    <div class="flex">
                        <div class="text-[30px] font-bold">
                            Mini
                        </div>
                        <div class="mt-3 ml-3">
                            <img class="w-8" src="{{ asset('imgs/caja.png') }}" alt="User Icon">
                        </div>
                    </div>
                </div>
                <div class="ml-16 w-[20%]">
                    <h3 class="text-blue-600 text-[25px] font-bold">Shop</h3>
                </div>

            </div>
            <h1 class="text-3xl font-bold mb-6 text-gray-800">Lista de Vendedores</h1>

            <div class="space-y-4">
                <div
                    class="p-4 border border-gray-200 rounded-lg flex flex-col justify-between gap-2 md:flex-row md:items-center transition duration-300 hover:bg-gray-50">
                    <div class="flex items-center">
                        <img src="{{ asset('imgs/AguacateQuintal.jpg') }}" alt="Imagen del producto"
                            class="w-16 h-16 rounded-md mr-4">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800">Pedido #1</h2>
                            <p class="text-sm text-gray-600">Fecha: 25 de Mayo, 2024</p>
                        </div>
                    </div>
                    <div class="flex">
                        <button
                            class="px-3 py-2 text-sm font-medium text-white bg-blue-500 rounded-md hover:bg-blue-600">Ver</button>
                        <button
                            class="px-3 py-2 text-sm font-medium text-white bg-red-500 rounded-md ml-2 hover:bg-red-600">Eliminar</button>
                    </div>
                </div>

                <div
                    class="p-4 border border-gray-200 rounded-lg flex flex-col justify-between gap-2 md:flex-row md:items-center transition duration-300 hover:bg-gray-50">
                    <div class="flex items-center">
                        <img src="{{ asset('imgs/AguacateQuintal.jpg') }}" alt="Imagen del producto"
                            class="w-16 h-16 rounded-md mr-4">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800">Pedido #2</h2>
                            <p class="text-sm text-gray-600">Fecha: 23 de Mayo, 2024</p>
                        </div>
                    </div>
                    <div class="flex">
                        <button
                            class="px-3 py-2 text-sm font-medium text-white bg-blue-500 rounded-md hover:bg-blue-600">Ver</button>
                        <button
                            class="px-3 py-2 text-sm font-medium text-white bg-red-500 rounded-md ml-2 hover:bg-red-600">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>

    </main>

</body>

</html>
