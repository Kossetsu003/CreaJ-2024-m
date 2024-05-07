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
    <div class="mx-auto max-w-lg mt-10 mb-32"> <!-- Añadido un margen inferior -->
        <div class="bottom-bar fixed bottom-[5%] left-0 right-0 flex justify-center">
            <div class="bg-gray-800 rounded-2xl w-60 h-10 flex justify-around">
                <div class="flex items-center  ">
                    <button class=" bg-white rounded-full p-[0.25rem] "><img class="w-6" src="{{ asset('imgs/HomeSelectedIcon.png') }}" alt="User Icon"></button>
                </div>

                <div class="flex items-center">
                    <button><img class="w-4" src="{{ asset('imgs/CarritoIcon.png') }}" alt="User Icon"></button>
                </div>

                <div class="flex items-center">
                    <button><img class="w-4" src="{{ asset('imgs/FavIcon.png') }}" alt="User Icon"></button>
                </div>
                <div class="flex items-center">
                    <button><img class="w-4" src="{{ asset('imgs/UserIcon.png') }}" alt="User Icon"></button>
                </div>
            </div>
        </div>

        <div class="mt-14  w-[90%] mx-auto">

         <div>
            <div >
                <div class="flex">
                    <div class="text-[30px] font-bold">
                        MINI
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

       

         <div class="flex flex-wrap justify-center mt-5 text-sm">
            <div class="w-[48%] mb-8 p-2">
                <img class="w-full h-[250px] rounded-md" src="{{ asset('imgs/ElSalvador.jpg') }}" alt="User Icon">
                <h3 class="font-bold mt-5">Nombre del producto</h3>
                <h3 class="mb-2">Nombre Adicional</h3>
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <!-- Círculo amarillo -->
                        <div class="w-3 h-3 bg-green-400 rounded-full mr-2"></div>
                        <h3>Pendiente</h3>
                    </div>
                    <div class="flex items-center">
                        <h3 class="mr-2">5.0</h3>
                        <img class="w-5" src="{{ asset('imgs/estrella.png') }}" alt="User Icon">
                    </div>
                </div>
            </div>
            <div class="w-[48%] mb-8 p-2">
                <img class="w-full h-[250px] rounded-md" src="{{ asset('imgs/ElSalvador.jpg') }}" alt="User Icon">
                <h3 class="font-bold mt-5">Nombre del producto</h3>
                <h3 class="mb-2">Nombre Adicional</h3>
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <!-- Círculo amarillo -->
                        <div class="w-3 h-3 bg-yellow-400 rounded-full mr-2"></div>
                        <h3>Pendiente</h3>
                    </div>
                    <div class="flex items-center">
                        <h3 class="mr-2">5.0</h3>
                        <img class="w-5" src="{{ asset('imgs/estrella.png') }}" alt="User Icon">
                    </div>
                </div>
            </div>

            <div class="w-[48%] mb-8 p-2">
                <img class="w-full h-[250px] rounded-md" src="{{ asset('imgs/ElSalvador.jpg') }}" alt="User Icon">
                <h3 class="font-bold mt-5">Nombre del producto</h3>
                <h3 class="mb-2">Nombre Adicional</h3>
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <!-- Círculo amarillo -->
                        <div class="w-3 h-3 bg-yellow-400 rounded-full mr-2"></div>
                        <h3>Pendiente</h3>
                    </div>
                    <div class="flex items-center">
                        <h3 class="mr-2">5.0</h3>
                        <img class="w-5" src="{{ asset('imgs/estrella.png') }}" alt="User Icon">
                    </div>
                </div>
            </div>

            <div class="w-[48%] mb-8 p-2">
                <img class="w-full h-[250px] rounded-md" src="{{ asset('imgs/ElSalvador.jpg') }}" alt="User Icon">
                <h3 class="font-bold mt-5">Nombre del producto</h3>
                <h3 class="mb-2">Nombre Adicional</h3>
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <!-- Círculo amarillo -->
                        <div class="w-3 h-3 bg-yellow-400 rounded-full mr-2"></div>
                        <h3>Pendiente</h3>
                    </div>
                    <div class="flex items-center">
                        <h3 class="mr-2">5.0</h3>
                        <img class="w-5" src="{{ asset('imgs/estrella.png') }}" alt="User Icon">
                    </div>
                </div>
            </div>
        </div>
        
        
    
        
        
    </div>

</body>
</html>
