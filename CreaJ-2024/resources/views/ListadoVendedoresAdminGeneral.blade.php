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
                    <a href="./HomeUser" ><img class="w-6" src="{{ asset('imgs/HomeIcon.png') }}" alt="User Icon"></a>
                </div>

                <div class="flex items-center">
                    <a href="./CarritoGeneralUser" class=" bg-white rounded-full p-[0.25rem] "><img class="w-6" src="{{ asset('imgs/CarritoSelectedIcon.png') }}" alt="User Icon"></a>
                </div>

                <div class="flex items-center">
                    <a href="./EstadoPedidosUser"><img class="w-6" src="{{ asset('imgs/FavIcon.png') }}" alt="User Icon"></a>
                </div>
                <div class="flex items-center">
                    <a href="./EditarPerfilUser"><img class="w-6" src="{{ asset('imgs/UserIcon.png') }}" alt="User Icon"></a>
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
                    <h2 class="text-center text-xl"><b>Listado de vendedores</b></h2>
        </div>

            <div>
                <div class="mt-[10%] mx-auto ml-12 flex ">
                    <img class="w-14 rounded-lg h-auto" src="{{ asset('imgs\AguacateQuintal.jpg') }}" alt="User Icon">
                    <div class="ml-2 ">
                        <h3 class="text-sm font-bold">Vendedor:Andrew</h3>
                        <h3 class="text-xs ">Descripcion del vendedor</h3>
                        <h3 class="text-sm font-bold">Comida</h3>
                    </div>

                </div>
                <div class="mt-1 mr-5 gap-2 mb-2 flex justify-end">
                    <button class="bg-blue-500 text-white text-xs px-2 py-1 rounded">Eliminar</button>
                    <button class="bg-red-500 text-white text-xs px-2 py-1 rounded">Ver</button>

                </div>
                <hr class="w-[90%] mx-auto">

                <div class="mt-[10%] mx-auto ml-12 flex ">
                    <img class="w-14 rounded-lg h-auto" src="{{ asset('imgs\AguacateQuintal.jpg') }}" alt="User Icon">
                    <div class="ml-2 ">
                        <h3 class="text-sm font-bold">Vendedor:Andrew</h3>
                        <h3 class="text-xs ">Descripcion del vendedor</h3>
                        <h3 class="text-sm font-bold">Comida</h3>
                    </div>

                </div>
                <div class="mt-1 mr-5 gap-2 mb-2 flex justify-end">
                    <button class="bg-blue-500 text-white text-xs px-2 py-1 rounded">Eliminar</button>
                    <button class="bg-red-500 text-white text-xs px-2 py-1 rounded">Ver</button>

                </div>
                <hr class="w-[90%] mx-auto"><div class="mt-[10%] mx-auto ml-12 flex ">
                    <img class="w-14 rounded-lg h-auto" src="{{ asset('imgs\AguacateQuintal.jpg') }}" alt="User Icon">
                    <div class="ml-2 ">
                        <h3 class="text-sm font-bold">Vendedor:Andrew</h3>
                        <h3 class="text-xs ">Descripcion del vendedor</h3>
                        <h3 class="text-sm font-bold">Comida</h3>
                    </div>

                </div>
                <div class="mt-1 mr-5 gap-2 mb-2 flex justify-end">
                    <button class="bg-blue-500 text-white text-xs px-2 py-1 rounded">Eliminar</button>
                    <button class="bg-red-500 text-white text-xs px-2 py-1 rounded">Ver</button>

                </div>
                <hr class="w-[90%] mx-auto"><div class="mt-[10%] mx-auto ml-12 flex ">
                    <img class="w-14 rounded-lg h-auto" src="{{ asset('imgs\AguacateQuintal.jpg') }}" alt="User Icon">
                    <div class="ml-2 ">
                        <h3 class="text-sm font-bold">Vendedor:Andrew</h3>
                        <h3 class="text-xs ">Descripcion del vendedor</h3>
                        <h3 class="text-sm font-bold">Comida</h3>
                    </div>

                </div>
                <div class="mt-1 mr-5 gap-2 mb-2 flex justify-end">
                    <button class="bg-blue-500 text-white text-xs px-2 py-1 rounded">Eliminar</button>
                    <button class="bg-red-500 text-white text-xs px-2 py-1 rounded">Ver</button>

                </div>
                <hr class="w-[90%] mx-auto"><div class="mt-[10%] mx-auto ml-12 flex ">
                    <img class="w-14 rounded-lg h-auto" src="{{ asset('imgs\AguacateQuintal.jpg') }}" alt="User Icon">
                    <div class="ml-2 ">
                        <h3 class="text-sm font-bold">Vendedor:Andrew</h3>
                        <h3 class="text-xs ">Descripcion del vendedor</h3>
                        <h3 class="text-sm font-bold">Comida</h3>
                    </div>

                </div>
                <div class="mt-1 mr-5 gap-2 mb-2 flex justify-end">
                    <button class="bg-blue-500 text-white text-xs px-2 py-1 rounded">Eliminar</button>
                    <button class="bg-red-500 text-white text-xs px-2 py-1 rounded">Ver</button>

                </div>
                <hr class="w-[90%] mx-auto"><div class="mt-[10%] mx-auto ml-12 flex ">
                    <img class="w-14 rounded-lg h-auto" src="{{ asset('imgs\AguacateQuintal.jpg') }}" alt="User Icon">
                    <div class="ml-2 ">
                        <h3 class="text-sm font-bold">Vendedor:Andrew</h3>
                        <h3 class="text-xs ">Descripcion del vendedor</h3>
                        <h3 class="text-sm font-bold">Comida</h3>
                    </div>

                </div>
                <div class="mt-1 mr-5 gap-2 mb-2 flex justify-end">
                    <button class="bg-blue-500 text-white text-xs px-2 py-1 rounded">Eliminar</button>
                    <button class="bg-red-500 text-white text-xs px-2 py-1 rounded">Ver</button>

                </div>
                <hr class="w-[90%] mx-auto"><div class="mt-[10%] mx-auto ml-12 flex ">
                    <img class="w-14 rounded-lg h-auto" src="{{ asset('imgs\AguacateQuintal.jpg') }}" alt="User Icon">
                    <div class="ml-2 ">
                        <h3 class="text-sm font-bold">Vendedor:Andrew</h3>
                        <h3 class="text-xs ">Descripcion del vendedor</h3>
                        <h3 class="text-sm font-bold">Comida</h3>
                    </div>

                </div>
                <div class="mt-1 mr-5 gap-2 mb-2 flex justify-end">
                    <button class="bg-blue-500 text-white text-xs px-2 py-1 rounded">Eliminar</button>
                    <button class="bg-red-500 text-white text-xs px-2 py-1 rounded">Ver</button>

                </div>
                <hr class="w-[90%] mx-auto"><div class="mt-[10%] mx-auto ml-12 flex ">
                    <img class="w-14 rounded-lg h-auto" src="{{ asset('imgs\AguacateQuintal.jpg') }}" alt="User Icon">
                    <div class="ml-2 ">
                        <h3 class="text-sm font-bold">Vendedor:Andrew</h3>
                        <h3 class="text-xs ">Descripcion del vendedor</h3>
                        <h3 class="text-sm font-bold">Comida</h3>
                    </div>

                </div>
                <div class="mt-1 mr-5 gap-2 mb-2 flex justify-end">
                    <button class="bg-blue-500 text-white text-xs px-2 py-1 rounded">Eliminar</button>
                    <button class="bg-red-500 text-white text-xs px-2 py-1 rounded">Ver</button>

                </div>
                <hr class="w-[90%] mx-auto"><div class="mt-[10%] mx-auto ml-12 flex ">
                    <img class="w-14 rounded-lg h-auto" src="{{ asset('imgs\AguacateQuintal.jpg') }}" alt="User Icon">
                    <div class="ml-2 ">
                        <h3 class="text-sm font-bold">Vendedor:Andrew</h3>
                        <h3 class="text-xs ">Descripcion del vendedor</h3>
                        <h3 class="text-sm font-bold">Comida</h3>
                    </div>

                </div>
                <div class="mt-1 mr-5 gap-2 mb-2 flex justify-end">
                    <button class="bg-blue-500 text-white text-xs px-2 py-1 rounded">Eliminar</button>
                    <button class="bg-red-500 text-white text-xs px-2 py-1 rounded">Ver</button>

                </div>
                <hr class="w-[90%] mx-auto">
                


        </div>
    </div>

</body>
</html>
