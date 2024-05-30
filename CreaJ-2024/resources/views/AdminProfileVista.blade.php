<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>AdminProfileVista</title>
</head>
<body>
    <div>
        <div class="bg-violet-500 h-auto pb-[4rem] pt-[2rem] w-full flex items-center justify-center">
            <h3 class="text-3xl font-bold">Mini<span class="text-white ml-2">Shop</span></h3>
        </div>


        <div class="flex justify-center mt-5">
            <img class="w-20 bg-white rounded-full shadow-md  " src="{{ asset('imgs/usuario.png') }}" alt="User Icon">
        </div>
        <div class="flex justify-center mt-2 ">
            <img class="w-3 h-3 ml-1" src="{{ asset('imgs/estrella.png') }}" alt="User Icon">
            <img class="w-3 h-3 ml-1" src="{{ asset('imgs/estrella.png') }}" alt="User Icon">
            <img class="w-3 h-3 ml-1" src="{{ asset('imgs/estrella.png') }}" alt="User Icon">
            <img class="w-3 h-3 ml-1" src="{{ asset('imgs/estrella.png') }}" alt="User Icon">
            <img class="w-3 h-3 ml-1" src="{{ asset('imgs/estrella.png') }}" alt="User Icon">
            <h3 class="text-[10px]"> <span class="ml-2">5.0</span></h3>
        </div>
        <div class="text-center mt-3">
            <h3 class="text-xs">Administrador de MiniShop</h3>
            <h3 class="font-bold">Administrador General</h3>
            <h3 class="text-xs">administracion@minishop.sv</h3>
        </div>

        <div class="w-[50%] mx-auto mt-16">

            <div class=" mx-auto flex items-center">
                <img class="w-5" src="{{ asset('imgs/ReservasIcon.png') }}" alt="User Icon">
                <h3 class="flex-grow text-left font-bold ml-3">Historial De pedidos</h3> <!-- Alineado a la derecha -->
            </div>

            <div class=" mx-auto flex items-center mt-10">
                <img class="w-5" src="{{ asset('imgs/BuzonIcon.png') }}" alt="User Icon">
                <h3 class="flex-grow text-left font-bold ml-5">Estado De pedidos</h3> <!-- Alineado a la derecha -->
            </div>


            <div class=" mx-auto flex items-center mt-10">
                <img class="w-5" src="{{ asset('imgs/addIcon.png') }}" alt="User Icon">
                <h3 class="flex-grow text-left font-bold ml-5">Agregar Mercado</h3> <!-- Alineado a la derecha -->
            </div>


            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <div class="mx-auto flex items-center mt-10">
                    <img class="w-5" src="{{ asset('imgs/tuerca.png') }}" alt="User Icon">
                    <button type="submit" class="flex-grow text-left font-bold ml-5">Cerrar Cuenta</button> <!-- Alineado a la derecha -->
                </div>
            </form>


        </div>

        <div class="bottom-bar fixed bottom-[5%] left-0 right-0 flex justify-center">
                <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around">
                    <div class="flex items-center  ">
                        <a href="{{ route('admin-mercado-locals.index') }}" class=" bg-white rounded-full p-[0.25rem] "><img class="w-6" src="{{ asset('imgs/HomeSelectedIcon.png') }}" alt="User Icon"></a>
                    </div>

                    <div class="flex items-center">
                        <a href="{{ route('admin-vendedors.index') }}"><img class="w-6" src="{{ asset('imgs/VendedorIcon.png') }}" alt="User Icon"></a>
                    </div>

                    <div class="flex items-center">
                        <a href="{{ route('admin-clientes.index') }}" ><img class="w-6" src="{{ asset('imgs/ClienteIcon.png') }}" alt="User Icon"></a>
                    </div>
                    <div class="flex items-center">
                        <a href="./AdminEstadoPedidos" ><img class="w-6" src="{{ asset('imgs/ReservasIcon.png') }}" alt="User Icon"></a>
                    </div>
                    <div class="flex items-center">
    <?php $id = 1; ?>
                        <a href="{{ route('AdminProfileVista')}}"  ><img class="w-6" src="{{ asset('imgs/UserIcon.png') }}" alt="User Icon"></a>

                    </div>
                </div>

            </div>
    </div>

</body>
</html>
