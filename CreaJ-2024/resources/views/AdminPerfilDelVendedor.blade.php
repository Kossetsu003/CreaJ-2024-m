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
    <div class="w-full bg-white text-gray-900">
        <header class="bg-gray-200 py-4 px-8 flex flex-col md:flex-row justify-between md:items-center">
            <div class="flex items-center gap-2">
                <div>
                    <img class="w-12 rounded-full " src="{{ asset('imgs/PerfilJuana.jpg') }}" alt="User Icon">
                </div>
                <h2 href="#" class="text-lg font-semibold">
                    Andrew Food
                </h2>
            </div>
            
        </header>
    
    
        <main class="py-8 px-8 grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <div class="bg-gray-100 rounded-md shadow-md">
                <img src="https://picsum.photos/200" alt="Product Image" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-semibold">Producto 1</h3>
                    <p class="text-gray-600">
                        Descripcion del prodcuto
                    </p>
                    <div class="flex justify-between items-center mt-2">
                        <div class="flex items-center">
                            <img class="w-5 h-5 mr-1" src="{{ asset('imgs/estrella.png') }}" alt="Rating Icon"/>
                            <span class="text-sm text-gray-600">4.5 (123 reviews)</span>
                        </div>
                        <span class="text-lg font-bold">$1,299</span>
                    </div>
                    <button class="block w-full mt-4 px-3 py-2 rounded-md bg-blue-500 text-white hover:bg-blue-600">
                        Comprar
                    </button>
                </div>
            </div>
            <!-- Repite la misma estructura para cada producto -->
        </main>
    </div>
    <div class="mx-auto max-w-lg mt-10 mb-32"> <!-- Añadido un margen inferior -->
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

            <!--FIN DE NAVBAR MOBIL-->
        </div>
    </div>

</body>
</html>
