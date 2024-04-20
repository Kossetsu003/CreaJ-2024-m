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

                <div class="mt-[10%] mx-auto ml-12 flex ">
                    <img class="w-14 rounded-lg h-auto" src="{{ asset('imgs/Pizza.jpg') }}" alt="User Icon">
                    <div class="ml-2 ">
                        <h3 class="text-sm">Nombre del puesto</h3> 
                        <h3 class="text-xs">No se</h3>
                        <h3 class="text-sm font-bold">$00.00</h3> 
                    </div>
                    <div class="mx-auto mt-[15px] h-8 bg-blue-400 rounded-md w-20 flex justify-around ">
                        <button class="text-white">+</button>
                        <button class="text-white">0</button>
                        <button class="text-white">-</button>
                    </div>
        
                </div>
                <hr class="mt-5">

                
               

                
            



            <div class="flex w-[90%]  mt-10 ml-5 justify-between">
                <div >
                    <h3>Total(0 Items)</h3>
                    <h3>Shipping Fee</h3>
                </div>
                <div class="flex flex-col">
                    <span class="font-bold">$00.00</span>
                    <span class="font-bold">$00.00</span>
                </div>

            </div>
            <hr>
            <div class="flex w-[90%] mt-3   ml-5 justify-between">
                <div >
                    <h3>Sub Total</h3>
                </div>
                <div class="flex flex-col">
                    <span class="font-bold">$00.00</span>
                </div>

            </div>
            
            <button class="mx-auto mt-[20%] h-12 bg-black rounded-full w-[80%]  text-white flex justify-center items-center">
                <span>Confirmar</span>
            </button>
            
</body>
</html>