<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>HomeUser</title>
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

        <!-- Agregar un margen superior al contenido principal igual a la altura de la barra de navegación -->
        <div class="mt-14"> <!-- Puedes ajustar este valor según sea necesario -->
            <div class="flex justify-between mt-5">
                <div class="ml-[10%]">
                    <h1>Hola Bienvenido</h1>
                    <h3 class="text-blue-800 font-bold">Nombre de Usuario</h3>
                </div>
                <div class="mr-[10%] mt-4">
                    <img class="w-4" src="{{ asset('imgs/usuario.png') }}" alt="User Icon">
                </div>
            </div>
        
            <div class="text-center mt-5">
                <h1 class="text-[30px] font-bold">Mini <span class="text-blue-400 font-bold">Shop</span></h1>
            </div>
            
            <div class="mt-5">
                <img class="w-[100%]" src="{{ asset('imgs/ElSalvador.jpg') }}" alt="User Icon">
            </div>
        
            <div class="flex mt-5 justify-around w-[90%] mx-auto">
                <button class="flex items-center px-3 py-2  rounded-md">
                    <img class="w-5 mr-2" src="{{ asset('imgs/ojo.png') }}" alt="User Icon">
                    Nosotros
                </button>
        
                <button class="flex items-center px-3 py-2  rounded-md">
                    <img class="w-5 mr-2" src="{{ asset('imgs/ojo.png') }}" alt="User Icon">
                    Nosotros
                </button>
        
                <button class="flex items-center px-3 py-2  rounded-md">
                    <img class="w-5 mr-2" src="{{ asset('imgs/ojo.png') }}" alt="User Icon">
                    Nosotros
                </button>
            </div>
        
            <div class="flex justify-center mt-5 flex-col items-center">
                <div class="w-[60%] bg-gray-50 rounded-md border border-gray-200 mb-4">
                    <img class="w-[100%] rounded-t-lg" src="{{ asset('imgs/ElSalvador.jpg') }}" alt="User Icon">
                    <div class="text-center mt-2">
                        <h1 class="text-sm font-bold">Nombre Del Mercado</h1>
                        <h3 class="w-[85%] mx-auto text-xs text-justify pb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia, quas!</h3>
                    </div>
                </div>
            
                <div class="w-[60%] bg-gray-50 rounded-md border border-gray-200 mt-5">
                    <img class="w-[100%] rounded-t-lg" src="{{ asset('imgs/ElSalvador.jpg') }}" alt="User Icon">
                    <div class="text-center mt-2">
                        <h1 class="text-sm font-bold">Nombre Del Mercado</h1>
                        <h3 class="w-[85%] mx-auto text-xs text-justify pb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia, quas!</h3>
                    </div>
                </div>
        
                <div class="w-[60%] bg-gray-50 rounded-md border border-gray-200 mt-5">
                    <img class="w-[100%] rounded-t-lg" src="{{ asset('imgs/ElSalvador.jpg') }}" alt="User Icon">
                    <div class="text-center mt-2">
                        <h1 class="text-sm font-bold">Nombre Del Mercado</h1>
                        <h3 class="w-[85%] mx-auto text-xs text-justify pb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia, quas!</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>