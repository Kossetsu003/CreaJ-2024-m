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
                    <input class="border-1 rounded border w-80 h-9 pl-5 text-xs  border-gray-400" type="text" placeholder="Editar Correo Electronico ">
                </div>
                <div class="flex justify-center mt-2 ">
                    <input class="border-1 rounded mt-5 border w-80 h-9 pl-5  text-xs  border-gray-400" type="text" placeholder="Editar Nombres ">
                </div>
                <div class="flex justify-center mt-2 ">
                    <input class="border-1 rounded mt-5 b border w-80 h-9 pl-5  text-xs  border-gray-400" type="text" placeholder="Editar Apellido">
                </div>
                <div class="flex justify-center mt-2 ">
                    <input class="border-1 rounded mt-5 b border w-80 h-9 pl-5  text-xs  border-gray-400" type="text" placeholder="Editar Numero Telefonico">
                </div>
                <div class="flex justify-center mt-2 ">
                    <select class="border-1 rounded mt-5 b border w-80 h-9 pl-5  text-xs  text-gray-400 border-gray-400" type="text">
                        <option value="NONE">Editar Genero</option>
                        <option value="Masc">Masculino</option>
                        <option value="Fem">Femenino</option>
                    </select>
                </div>
                <div class="flex justify-center mt-2 ">
                    <input class="border-1 rounded mt-5 b border w-80 h-9 pl-5  text-xs  border-gray-400" type="text" placeholder="Modificar Contraseña">
                </div>
                 <div class="flex justify-center mt-2 ">
                    <input class="border-1 rounded mt-5 b border w-80 h-9 pl-5  text-xs  border-gray-400" type="text" placeholder="Escriba de nuevo su contraseña modificada">
                </div>
            </div>

            <div class="flex justify-center py-5">
                <button class="bg-purple-400 w-72 h-10  rounded-md ">Guardar</button>
            </div>

        </div>

    </section>
</body>
</html>
