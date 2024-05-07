<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Producto Editar</title>
    <link rel="shortcut icon" href="{{ asset('imgs/MiCarritoUser.png') }}" type="image/x-icon">
</head>
<body>
    <section>
        <div class="w-72 h-96  mx-auto mt-[50%]"> <!--Contenedor Principal-->
            <div class="text-center "> <!--Contenedor Mini Shop-->
                <h1 class="text-[50px] font-bold ">Editar<span class="text-purple-400 font-bold m-2 ">Perfil</span> </h1>
            </div>

            <div class="flex flex-col mt-6 "> <!--Contenedor De Inputs-->
                <div class="flex  justify-center">
                    <input class="border-1 rounded border w-80 h-9 pl-5 text-xs  border-gray-400" type="text" placeholder="Enter email ">
                </div>
                <div class="flex justify-center mt-2 ">
                    <input class="border-1 rounded mt-5 border w-80 h-9 pl-5  text-xs  border-gray-400" type="text" placeholder="Enter Password ">
                </div>
                <div class="flex justify-center mt-2 ">
                    <input class="border-1 rounded mt-5 b border w-80 h-9 pl-5  text-xs  border-gray-400" type="text" placeholder="Enter Password ">
                </div>
                <div class="flex justify-center mt-2 ">
                    <input class="border-1 rounded mt-5 b border w-80 h-9 pl-5  text-xs  border-gray-400" type="text" placeholder="Enter Password ">
                </div>
                <div class="flex justify-center mt-2 ">
                    <input class="border-1 rounded mt-5 b border w-80 h-9 pl-5  text-xs  border-gray-400" type="text" placeholder="Enter Password ">
                </div>
            </div>

            <div class="flex justify-center mt-5">
                <button class="bg-purple-400 w-72 h-10  rounded-md ">Guardar</button>
            </div>

        </div>

    </section>
</body>
</html>
