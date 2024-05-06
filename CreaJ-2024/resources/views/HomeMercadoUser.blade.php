<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Home Mercado User</title>
</head>
<body>
    <div class="mx-auto max-w-lg mt-10 mb-32"> <!-- Añadido un margen inferior -->
        <div class="bottom-bar fixed bottom-[5%] left-0 right-0 flex justify-center">
            <div class="bg-gray-800 rounded-2xl w-60 h-10 flex justify-around">
                <div class="flex items-center">
                    <button><img class="w-4" src="{{ asset('imgs/casa2.png') }}" alt="User Icon"></button>
                </div>
        
                <div class="flex items-center">
                    <button><img class="w-4" src="{{ asset('imgs/casa2.png') }}" alt="User Icon"></button>
                </div>
      
                <div class="flex items-center">
                    <button><img class="w-4" src="{{ asset('imgs/casa2.png') }}" alt="User Icon"></button>
                </div>
                <div class="flex items-center">
                    <button><img class="w-4" src="{{ asset('imgs/casa2.png') }}" alt="User Icon"></button>
                </div>
            </div>
        </div>

        <div class="mt-14  w-[90%] mx-auto"> 
            
            <div class="flex justify-between  w-[90%] mx-auto"> <!--Contenedor Principal-->
                <div>
                    <div>
                        Nombre del Mercado
                    </div>
                    <div class="font-bold">
                        Los mejores Precios
                    </div>
                </div>

                <div>
                    <img class="w-5 mt-[50%]" src="{{ asset('imgs/usuario.png') }}" alt="User Icon">
                </div>
            </div><!--Fin Principal-->

        <div class="flex items-center mt-5 ">
                    <!-- Campo de búsqueda con icono de lupa -->
                <div class="relative w-[70%] ml-5">
                    <img class="absolute left-2 top-1/2 transform -translate-y-1/2 w-5 h-5" src="{{ asset('imgs/lupa.png') }}" alt="Search Icon">
                    <input class="pl-8 px-2  w-[100%] border-2 rounded-md border-gray-500 py-1 focus:outline-none" type="text" placeholder="Buscar">
                </div>
                <!-- Botón azul -->
                <div class="mr-5 pl-2">
                    <button class="bg-sky-400  rounded-md px-2   py-1 h-[100%] ml-1"> <!-- Reduje el margen izquierdo a 1 -->
                        <img class="w-6 "   src="{{ asset('imgs/casa2.png') }}" alt="User Icon">
                    </button>
                 </div>
        </div>
        <div class="flex mt-5">
            <div class="flex mx-auto">
                <button class="flex items-center h-8 border-2 text-black px-1 py-0.5 rounded-md mr-2 text-xs hover:bg-blue-200">
                    <img class="w-3" src="{{ asset('imgs/usuario.png') }}" alt="User Icon">
                    <span class="ml-1">Todos Los puestos</span>
                </button>   
                <button class="flex items-center border-2 text-black px-1 py-0.5 rounded-md mr-2 text-xs hover:bg-blue-200">
                    <img class="w-3" src="{{ asset('imgs/usuario.png') }}" alt="User Icon">
                    <span class="ml-1">Otro Botón</span>
                </button>
                <button class="flex items-center border-2 text-black px-1 py-0.5 rounded-md text-xs hover:bg-blue-200">
                    <img class="w-3" src="{{ asset('imgs/usuario.png') }}" alt="User Icon">
                    <span class="ml-1">Último Botón</span>
                </button>  
            </div>
        </div>
        

        <div>

            <div class="flex">
                <div>
                    <img class="w-[50%]" src="{{ asset('imgs/Pizza.jpg') }}" alt="User Icon">
                    <h3>Nombre del producto</h3>
                </div>

                   <div>
                    <img class="w-[50%]" src="{{ asset('imgs/Pizza.jpg') }}" alt="User Icon">
                    <h3>Nombre del producto</h3>
                </div>
            </div>

        </div>
        
        

    </div>

</body>
</html>