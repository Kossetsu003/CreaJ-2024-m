<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Index</title>
    <link rel="shortcut icon" href="{{ asset('imgs/MiCarritoUser.png') }}" type="image/x-icon">
</head>
<body>
  <div class="mt-36 flex flex-col lg:flex-row flex-wrap"> <!-- Contenedor -->
    <div class="text-center lg:mr-10"> <!-- Sección de imagen -->
        <img src="{{ asset('imgs/Compra.png') }}" alt="Compra">
    </div>
    <div class="lg:ml-10"> <!-- Sección de texto -->
        <div class="font-bold text-center mb-4">Explora MiniShop</div>
        <div class="w-full md:w-4/5 mx-auto"> <!-- Contenedor de texto -->
            <p class="mb-4 w-[70%] font-bold mx-auto text-justify">
                MiniShop es un Mercado Virtual para todos los comerciantes que se encuentaran en nuestros mercados municipales de San Salvador Centro, puedes ver y reservar los productos que quieras.
            </p>
            <div class="flex justify-center mt-10">
                <a href="./LoginUser" class="bg-purple-400 w-[85%] rounded-md font-bold h-9 hover:bg-purple-400 hover:text-black active:bg-purple-300 text-sm px-6 py-2 text-center  outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">Comencemos</a>
</button>

            </div>
        </div>
    </div>
</div> <!-- Fin del Contenedor -->
</body>
</html>
