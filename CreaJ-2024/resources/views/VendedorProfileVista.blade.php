<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>VendedorProfileVista</title>
</head>
<body>
</div>
<!-- Desktop Navbar -->
<div
class="hidden md:flex p-4 bg-white items-center justify-between shadow-md"
>
<h1 class="text-3xl md:text-4xl lg:text-5xl font-black">
    MiniShop
</h1>
<div class="flex gap-8">
    <a
        href="./VendedorHome"
        class="font-bold uppercase text-sm lg:text-base hover:text-gray-300"
        >Home</a
    >
    <a
        href="./VendedorMiBuzon"
        class="font-bold uppercase text-sm lg:text-base hover:text-gray-300"
        >Buzon</a
    >
    <a
        href="./VendedorMisReservas"
        class="font-bold uppercase text-sm lg:text-base hover:text-gray-300"
        >Reservas</a
    >
    <a
        href="./VendedorProfileVista"
        class="font-bold uppercase text-sm lg:text-base hover:text-gray-300"
        >Perfil</a
    >
</div>
</div>
    <div class="pb-[7rem]">
       <div class="bg-zinc-700 h-[160px] flex items-center justify-center">
            <h3 class="font-bold text-center text-4xl">Mini<span class="text-white ml-2">Shop</span></h3>
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
            <h3 class="text-xs">Puesto de Comida</h3>
            <h3 class="font-bold">Andrew Food</h3>
            <h3 class="text-xs">corre123@gmail.com</h3>
        </div>

        <div class="w-[50%] mx-auto mt-16">
            <div class=" mx-auto flex items-center mt-10">
                <img class="w-5" src="{{ asset('imgs/AddSelectedICon.png') }}" alt="User Icon">
                <h3 class="flex-grow text-left font-bold ml-5">Agregar Productos</h3> <!-- Alineado a la derecha -->
            </div>
            <a href="./VendedorMiBuzon">
                <div class=" mx-auto flex items-center mt-10">
                    <img class="w-5" src="{{ asset('imgs/EditSelectedIcon.png') }}" alt="User Icon">
                    <h3 class="flex-grow text-left font-bold ml-5">Editar Mi Puesto</h3> <!-- Alineado a la derecha -->
                </div>
            </a>
            <a href="./VendedorMiBuzon">
                <div class=" mx-auto flex items-center mt-10">
                    <img class="w-5" src="{{ asset('imgs/BuzonSelectedIcon.png') }}" alt="User Icon">
                    <h3 class="flex-grow text-left font-bold ml-5">Ver Mi Buzon</h3> <!-- Alineado a la derecha -->

                </div>
            </a>
            <a href="">
                <div class=" mx-auto flex items-center mt-10">
                    <img class="w-5" src="{{ asset('imgs/ReservasSelectedIcon.png') }}" alt="User Icon">
                    <h3 class="flex-grow text-left font-bold ml-5">Ver Mis Reservas</h3> <!-- Alineado a la derecha -->
                </div>
            </a>









            <div class=" mx-auto flex items-center mt-10">
                <img class="w-5" src="{{ asset('imgs/tuerca.png') }}" alt="User Icon">
                <h3 class="flex-grow text-left font-bold  ml-5">Cerrar Sesion</h3> <!-- Alineado a la derecha -->
            </div>



     <!-- Mobile Navbar -->
     <div class="fixed bottom-0 left-0 right-0 p-4 md:hidden">
         <div class="bg-gray-900 rounded-2xl h-14 flex justify-around">
             <div class="flex items-center">
                 <a href="./VendedorHome" class="bg-white rounded-full p-1">
                     <img
                         class="w-6"
                         src="{{ asset('imgs/HomeSelectedIcon.png') }}"
                         alt="Home Icon"
                     />
                 </a>
             </div>
             <div class="flex items-center">
                 <a href="./VendedorMiBuzon">
                     <img
                         class="w-6"
                         src="{{ asset('imgs/BuzonIcon.png') }}"
                         alt="Cart Icon"
                     />
                 </a>
             </div>
             <div class="flex items-center">
                 <a href="./VendedorMisReservas">
                     <img
                         class="w-6"
                         src="{{ asset('imgs/ReservasIcon.png') }}"
                         alt="Favorites Icon"
                     />
                 </a>
             </div>
             <div class="flex items-center">
                 <a href="./VendedorProfileVista">
                     <img
                         class="w-6"
                         src="{{ asset('imgs/UserIcon.png') }}"
                         alt="Profile Icon"
                     />
                 </a>
             </div>
         </div>
     </div>
    </div>
</body>
</html>
