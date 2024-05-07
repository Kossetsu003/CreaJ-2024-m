<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>ProductoUser</title>
    <link rel="shortcut icon" href="{{ asset('imgs/MiCarritoUser.png') }}" type="image/x-icon">
</head>
<body>
    <div class="mx-auto max-w-lg mt-10">
        <img class="rounded-lg w-[80%] m-auto" src="{{ asset('imgs/NaranjasQuintal.jpg') }}" alt="User Icon">

        <div class="w-[90%] ml-6">
            <div class="flex justify-between mt-5">
                <div class="font-bold">
                    Ciento de Naranjas
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
                Vendo Ciento de Naranjas Valencia en El Mercado Ex-Cuartel, jugosas y acidas perfectas para fresco. Recien Cortadas desde La Libertad a $9.00 el ciento.
            </h3>
            <hr>

            <div>
                <h3 class="font-bold mt-7">Precio</h3>
                <div class="flex gap-4">
                   <h3>$09.00</h3>

                </div>
            </div>

            <button class="flex justify-center items-center bg-red-800 rounded-2xl w-full h-10 text-white my-4">
                <img class="w-6 h-6 mr-2" src="{{ asset('imgs/carrito-de-compras.png') }}" alt="User Icon">
                <a href="./CarritoDePuestoUser">Añadir a MiCarrito</a>
            </button>
        </div>
    </div>
</body>
</html>
