<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Carrito de un puesto</title>
</head>
<body>
        <div class="mx-auto max-w-lg mt-10 ">
            <div class="flex justify-around ">
                <div>
                    <button><img class="w-5" src="{{ asset('imgs/Flecha3.png') }}" alt="User Icon"></button>
                </div>
                <div>
                    <h2>Carrito</h2>
                </div>
                <div>
                    <img src="{{ asset('imgs/menu.png') }}" alt="User Icon">
                </div>
            </div>

            <div>
                <div class="mt-[10%] ml-12 flex">
                    <img class="w-14 rounded-lg h-auto" src="{{ asset('imgs/Pizza.jpg') }}" alt="User Icon">
                    <div class="ml-2">
                        <h3 class="text-sm">Nombre del puesto</h3> 
                        <h3 class="text-xs">No se</h3>
                    </div>
                </div>
                <div class="mt-1 mr-5 gap-2 mb-2 flex justify-end">
                    <button class="bg-blue-500 text-white text-xs px-2 py-1 rounded">Confirmar</button>
                    <button class="bg-red-500 text-white text-xs px-2 py-1 rounded">Cancelar</button>
                    
                </div>
                <hr class="w-[90%] mx-auto">

                
            </div>
            
            <div class="bg-gray-800 rounded-2xl w-60 h-10 mx-auto mb-16 flex justify-around fixed bottom-0 left-0 right-0">
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
</body>
</html>