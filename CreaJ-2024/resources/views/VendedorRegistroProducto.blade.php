<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="shortcut icon" href="{{ asset('imgs/MiCarritoUser.png') }}" type="image/x-icon">
    <title>Registrar Producto Vendedor</title>
</head>
<body>
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
    
    <form action="#" method="get">
    <section>
        <div class="w-72 h-96 mx-auto mt-16">
        

            <div class="text-center">
                <h1 class="text-3xl font-bold text-black">Registrar Producto</h1>
                <h3 class="mt-5">Puesto de: <b>Maria Jose Gamez</b></h3>
            </div>
            <div class="mt-20 space-y-4">
                <div class="flex justify-between">
                    <label for="file-input" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 flex items-center relative">
                        <span class="text-gray-600">Imagen del Producto</span>
                        <input id="file-input" type="file" class="hidden" >
                        <span class="rounded-lg w-5 h-5 absolute right-2 top-2 bg-cover" style="background-image: url('{{ asset('imgs/files2.svg') }}');"></span>
                    </label>
                </div>
                <div class="flex justify-center">
                    <input class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400" type="text" placeholder="Nombre del Producto" required>
                </div>
                <div class="flex justify-center">
                    <input class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400" type="text" placeholder="Descripción del Producto" required>
                </div>
                <div class="flex justify-center">
                    <input class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400" type="number" placeholder="Precio del Producto" required>
                </div>
                <div class="flex justify-center">
                    <select class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 text-gray-400" required>
                        <option value="NULL">Seleccione el Estado</option>
                        <option value="Disponible">Disponible</option>
                        <option value="Agotado">Agotado</option>
                    </select>
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
