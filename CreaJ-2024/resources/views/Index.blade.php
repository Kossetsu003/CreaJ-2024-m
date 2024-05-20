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
    <div class="md:flex md:bg-indigo-200 border">
        <div class="flex justify-center items-center h-screen md:w-[50%]">
            <div class="p-8">
                <div>
                    <h3 class="font-bold text-6xl text-center">Mini <span class="text-blue-500">Shop</span></h3>
                    <h3 class="mt-3 w-[90%] mx-auto text-justify md:text-white md:text-justify md:w-[70%] md:text-lg">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Inventore quos blanditiis sed, omnis excepturi corporis sequi. Consequatur sequi evenie.
                    </h3>
                </div>
                <div class="mt-16 flex justify-center">
                    <a href="./LoginUser">
                        <button class="mr-2 bg-indigo-300 w-32 h-12 rounded-md">
                            Inciar Sesion
                        </button>
                    </a>
                    <a href="./clientes/create" class="mr-2 border border-black w-32 h-12 rounded-md relative flex items-center">
                        <img class="absolute left-0 top-0 bottom-0 m-auto ml-4 mr-[10px]" src="{{ asset('imgs/play.png') }}" alt="User Icon">
                        <span class="pl-10">
                            Registrarse
                        </span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Ocultar la imagen en dispositivos móviles y mostrarla en escritorio -->
        <div class="md:mx-auto h-screen  items-center hidden md:flex">
            <img class="md:w-[75%] mx-auto" src="{{ asset('imgs/imagenindex.png') }}" alt="User Icon">
        </div>
    </div>
</body>
</html>
