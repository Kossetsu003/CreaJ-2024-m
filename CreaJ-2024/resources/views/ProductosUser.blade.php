<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>ProductoUser</title>
</head>
<body>
    <div class="mx-auto max-w-lg mt-10">
        <img class="rounded-lg w-[80%] m-auto" src="{{ asset('imgs/Imagen-Test.jpg') }}" alt="User Icon">
    
        <div class="w-[90%] ml-6">
            <div class="flex justify-between mt-5">
                <div class="font-bold">
                    Elemento Seleccionado
                </div>
                <div class="flex items-center">
                    <button class="bg-white border w-[27px] border-black rounded-full px-2 py-1 text-xs">-</button>
                    <h1 class="text-sm mx-2">2</h1>
                    <button class="bg-white border border-black rounded-full px-2 py-1 text-xs">+</button>

                </div>
            </div>
    
            <div class="flex items-center mb-4">
                <button class="mr-2"><img class="w-4" src="{{ asset('imgs/775819.svg') }}" alt="User Icon"></button> 
                <button class="mr-2"><img class="w-4" src="{{ asset('imgs/775819.svg') }}" alt="User Icon"></button> 
                <button class="mr-2"><img class="w-4" src="{{ asset('imgs/775819.svg') }}" alt="User Icon"></button> 
                <button class="mr-2"><img class="w-4" src="{{ asset('imgs/775819.svg') }}" alt="User Icon"></button> 
                <button class="mr-2"><img class="w-4" src="{{ asset('imgs/775819.svg') }}" alt="User Icon"></button> 
                <h4 class="text-sm">5.0</h4>
            </div>
    
            <h3 class="text-xs">
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Debitis, consectetur minus quaerat id nihil vero obcaecati natus ut laborum illo maxime laudantium dolorem voluptate unde harum deleniti atque fugiat in!
            </h3>
            <hr>
    
            <div>
                <h3 class="font-bold mt-7">Tamaño</h3>
                <div class="flex gap-4">
                    <button class="bg-white border border-black rounded-full w-[8%] px-2 py-1 text-xs hover:bg-gray-600">s</button>
                    <button class="bg-white border border-black rounded-full w-[8%] px-2 py-1 text-xs hover:bg-gray-600">m</button> 
                    <button class="bg-white border border-black rounded-full w-[8%] px-2 py-1 text-xs hover:bg-gray-600">l</button>
                </div>
            </div>
    
            <button class="flex justify-center items-center bg-red-800 rounded-2xl w-full h-10 text-white mt-4">
                <img class="w-6 h-6 mr-2" src="{{ asset('imgs/carrito-de-compras.png') }}" alt="User Icon">
                <span>Añadir al Carrito</span>
            </button>
        </div>
    </div> 
</body>
</html>