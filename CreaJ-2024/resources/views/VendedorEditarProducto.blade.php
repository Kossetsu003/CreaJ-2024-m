<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Editar Producto Vendedor</title>
    <link rel="shortcut icon" href="{{ asset('imgs/MiCarritoUser.png') }}" type="image/x-icon">
</head>
<body>

   <form action="#" method="get">
    <section>
        <div class="w-72 h-96 mx-auto mt-16">
            <div class="bottom-bar fixed bottom-[5%] left-0 right-0 flex justify-center">
                <!--INICIO DE NAVBAR MOBIL-->
                <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around">
                    <div class="flex items-center  ">
                        <a href="./UserHome"><img class="w-6" src="{{ asset('imgs/HomeIcon.png') }}" alt="User Icon"></a>
                    </div>
                    <div class="flex items-center">
                        <a href="./UserCarritoGeneral"><img class="w-6" src="{{ asset('imgs/CarritoIcon.png') }}" alt="User Icon"></a>
                    </div>
                    <div class="flex items-center">
                        <a href="./UserEstadoPedidos"><img class="w-6" src="{{ asset('imgs/FavIcon.png') }}" alt="User Icon"></a>
                    </div>
                    <div class="flex items-center">
                        <a href="./UserEditarPerfil" class="bg-white rounded-full p-[0.25rem]"><img class="w-6" src="{{ asset('imgs/UserSelectedIcon.png') }}" alt="User Icon"></a>
                    </div>
                </div>
                <!--FIN DE NAVBAR MOBIL-->
            </div>
            <div class="text-center">
                <h1 class="text-3xl font-bold text-black">Editar Producto</h1>
                <h3 class="text-sm mt-2">En El Mercado : <span class="font-bold">Ex-Cuartel</span></h3>
            </div>
            <div class="mt-20 space-y-4">
                <div class="flex justify-center">
                    <input class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400" type="text" placeholder="Nombre del Producto" required>
                </div>
                <div class="flex justify-center">
                    <input class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400" type="text" placeholder="Descripcion del Producto" required>
                </div>
                <div class="flex justify-center">
                    <input class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400" type="number" placeholder="Precio del Producto" step="0.01" min="0" required>
                </div>
                <div class="flex justify-center">
                    <select class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 text-gray-400" required>
                        <option value="NONE">Edite El Estado del Producto</option>
                        <option value="Disponible">Disponible</option>
                        <option value="Sin Prodcuto">Sin Productos</option>
                    </select>
                </div>
                <div class="flex justify-between">
                    <label for="file-input" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 flex items-center relative">
                        <span>Imagen del Producto</span>
                        <input id="file-input" type="file" class="hidden" >
                        <span class="rounded-lg w-5 h-5 absolute right-2 top-2 bg-cover" style="background-image: url('{{ asset('imgs/files2.svg') }}');"></span>
                    </label>
                </div>
            </div>
            <div class="flex justify-center mt-16">
                <button class="bg-black w-72 h-10 text-white font-bold rounded-md">Guardar</button>
            </div>
        </div>
    </section>
</form>

</body>
</html>
