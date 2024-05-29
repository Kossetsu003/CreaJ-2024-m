<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Perfil de vendedor</title>
    <link rel="shortcut icon" href="{{ asset('imgs/MiCarritoUser.png') }}" type="image/x-icon">
</head>
<body>
    <div class="mx-auto max-w-lg"> <!-- Añadido un margen inferior -->
        <div class="bottom-bar fixed bottom-[5%] left-0 right-0 flex justify-center">
            <!--INICIO DE NAVBAR MOBIL-->
            <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around">
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
        </div>
    </div>

    <div class="w-full bg-white text-gray-900">
        <header class="bg-gray-200 py-4 px-8 flex flex-col md:flex-row justify-between md:items-center">
            <div>
                <h2 href="#" class="text-lg font-semibold">
                    Mercado Ex-Cuartel
                </h2>
                <p>Los Mejores Precios</p>
            </div>
            <div class="flex items-center">
                <input type="search" class="px-4 text-gray-900 py-2 rounded-md border border-gray-300 focus:outline-none" placeholder="Buscar Puestos">
                <button class="ml-2 p-2 rounded-md bg-gray-300 hover:bg-gray-400">
                    <img width="24" class="" src="{{ asset('imgs/lupa.png') }}" alt="Search Icon"/>
                </button>
            </div>
        </header>
    
        <nav class="bg-gray-300 py-4 px-8 grid grid-cols-[1fr_max-content] gap-2 justify-between items-center">
            <div class="flex overflow-auto min-w-full gap-4 items-center">
                <button class="min-w-max px-3 flex items-center gap-2 py-2 rounded-md text-sm bg-gray-200 hover:bg-gray-400">
                    <img class="w-7 invert" src="{{ asset('imgs/SelectBox.png') }}" alt="User Icon"/>
                    <p>Todos los puestos</p>
                </button>
                <button class="min-w-max px-3 flex items-center gap-2 py-2 rounded-md text-sm bg-gray-200 hover:bg-gray-400">
                    <img class="w-7 " src="{{ asset('imgs/ClotheSelected.png') }}" alt="User Icon"/>
                    <p>Ropa</p>
                </button>
                <button class="min-w-max px-3 flex items-center gap-2 py-2 rounded-md text-sm bg-gray-200 hover:bg-gray-400">
                    <img class="w-7 " src="{{ asset('imgs/FoodSelected.png') }}" alt="User Icon"/>
                    <p>Comida</p>
                </button>
            </div>
            <div>
                <button class="px-3 py-2 rounded-md  text-sm bg-gray-200 hover:bg-gray-400">
                    <img class="w-6 invert" src="{{ asset('imgs/SettingIcon.png') }}" alt="User Icon"/>
                </button>
            </div>
        </nav>
    
        <main class="py-8 px-8 grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <div class="bg-gray-100 rounded-md shadow-md">
                <img src="https://picsum.photos/200" alt="Product Image" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-semibold">Puesto 1</h3>
                    <p class="text-gray-600">
                        Descripcion del Puesto
                    </p>
                    <div class="flex justify-between items-center mt-2">
                        <div class="flex items-center">
                            <img class="w-5 h-5 mr-1" src="{{ asset('imgs/estrella.png') }}" alt="Rating Icon"/>
                            <span class="text-sm text-gray-600">4.5 (123 reviews)</span>
                        </div>
                    </div>
                    <button class="block w-full mt-4 px-3 py-2 rounded-md bg-green-500 text-white hover:bg-green-600">
                        Ver produuctos
                    </button>
                </div>
            </div>
            <!-- Repite la misma estructura para cada producto -->
        </main>
    </div>
    
</body>
</html>
