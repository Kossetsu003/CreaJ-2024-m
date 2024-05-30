<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Perfil de vendedor</title>
    <link rel="shortcut icon" href="{{ asset('imgs/MiCarritoUser.png') }}" type="image/x-icon">
</head>
<body>
<<<<<<< HEAD
     <!-- Desktop Navbar -->
     <div
     class="hidden md:flex p-4 bg-white items-center justify-between shadow-md">
     <h1 class="text-3xl md:text-4xl lg:text-5xl font-black font-bold">
         MiniShop
     </h1>
     <div class="flex gap-8">
         <a
             href="../UserHome"
             class="font-bold uppercase text-sm lg:text-base hover:text-gray-300"
             >Home</a
         >
         <a
             href="./UserCarritoGeneral"
             class="font-bold uppercase text-sm lg:text-base hover:text-gray-300"
             >Cart</a
         >
         <a
             href="./UserEstadoPedidos"
             class="font-bold uppercase text-sm lg:text-base hover:text-gray-300"
             >Favorites</a
         >
         <a
             href="./UserProfileVista"
             class="font-bold uppercase text-sm lg:text-base hover:text-gray-300"
             >Profile</a
         >
     </div>
 </div>

    

     <!-- Inicio de nav movil-->
        <div class="bottom-bar fixed bottom-[5%] left-0 right-0 flex justify-center md:hidden">

            <!--INICIO DE NAVBAR MOBIL-->
            <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around ">
                <div class="flex items-center  ">
                    <a href="./VendedorHome" class=" bg-white rounded-full p-[0.25rem] "><img class="w-6" src="{{ asset('imgs/HomeSelectedIcon.png') }}" alt="User Icon"></a>
                </div>

                <div class="flex items-center">
                    <a href="./VendedorMiBuzon"><img class="w-6" src="{{ asset('imgs/BuzonIcon.png') }}" alt="User Icon"></a>
                </div>

                <div class="flex items-center">
                    <a href="./VendedorMisReservas" ><img class="w-6" src="{{ asset('imgs/ReservasIcon.png') }}" alt="User Icon"></a>
                </div>
                <div class="flex items-center">
                    <a href="./VendedorProfileVista"  ><img class="w-6" src="{{ asset('imgs/UserIcon.png') }}" alt="User Icon"></a>
=======
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
                 href="./VendedorMibuzon"
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
     </div>flibfo
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


     <div class="w-full bg-white text-gray-900">
        <header class="bg-gray-200 py-4 px-8 flex flex-col md:flex-row justify-between md:items-center">
            <div>
                <h2 href="#" class="text-lg font-semibold">
                    Mercado Ex-Cuartel
                </h2>
                <p>Los Mejores Precios</p>
            </div>
            <div class="flex items-center">
                <input type="search" class="px-4 text-gray-900 py-2 rounded-md border border-gray-300 focus:outline-none" placeholder="Buscar Puestos">
                <button class="ml-2 p-2 rounded-md bg-gray-300 hover:bg-gray-400">
                    <img width="24" class="" src="{{ asset('imgs/lupa.png') }}" alt="Search Icon"/>
                </button>
            </div>
        </header>

        <nav class="bg-gray-300 py-4 px-8 grid grid-cols-[1fr_max-content] gap-2 justify-between items-center">
            <div class="flex overflow-auto min-w-full gap-4 items-center">
                <button class="min-w-max px-3 flex items-center gap-2 py-2 rounded-md text-sm bg-gray-200 hover:bg-gray-400">
                    <img class="w-7 invert" src="{{ asset('imgs/SelectBox.png') }}" alt="User Icon"/>
                    <p>Todos los puestos</p>
                </button>
                <button class="min-w-max px-3 flex items-center gap-2 py-2 rounded-md text-sm bg-gray-200 hover:bg-gray-400">
                    <img class="w-7 " src="{{ asset('imgs/ClotheSelected.png') }}" alt="User Icon"/>
                    <p>Ropa</p>
                </button>
                <button class="min-w-max px-3 flex items-center gap-2 py-2 rounded-md text-sm bg-gray-200 hover:bg-gray-400">
                    <img class="w-7 " src="{{ asset('imgs/FoodSelected.png') }}" alt="User Icon"/>
                    <p>Comida</p>
                </button>
            </div>
            <div>
                <button class="px-3 py-2 rounded-md  text-sm bg-gray-200 hover:bg-gray-400">
                    <img class="w-6 invert" src="{{ asset('imgs/SettingIcon.png') }}" alt="User Icon"/>
                </button>
            </div>
        </nav>

        <main class="py-8 px-8 grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <div class="bg-gray-100 rounded-md shadow-md">
                <img src="https://picsum.photos/200" alt="Product Image" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-semibold">Puesto 1</h3>
                    <p class="text-gray-600">
                        Descripcion del Puesto
                    </p>
                    <div class="flex justify-between items-center mt-2">
                        <div class="flex items-center">
                            <img class="w-5 h-5 mr-1" src="{{ asset('imgs/estrella.png') }}" alt="Rating Icon"/>
                    e        <span class="text-sm text-gray-600">4.5 (123 reviews)</span>
                        </div>
                    </div>
                    <button class="block w-full mt-4 px-3 py-2 rounded-md bg-green-500 text-white hover:bg-green-600">
                        Ver produuctos
                    </button>
>>>>>>> bfdc3ee39cecdc7d21ac2aa8419a0db9c5fd112d
                </div>
            </div>

            <!--FIN DE NAVBAR MOBIL-->
        </div>

        <div class="mt-14  w-[90%] mx-auto md:text-[30px]">

            <div class="flex justify-between  w-[90%] mx-auto"> <!--Contenedor Principal-->
                <div>
                    <div>
                        Puesto de comida
                    </div>
                    <div class="font-bold">
                        Nombre de Vendedor
                    </div>
                </div>

                <div class="mt-3 md:hidden">
                    <img class="w-4 rounded-full " src="{{ asset('imgs/flecha-izquierda.png') }}" alt="User Icon">
                </div>
            </div>
            <!--Fin Principal-->


        <div class="flex flex-wrap justify-center mt-10 text-sm md:gap-[50px]">
            <div class="w-[48%] mb-8 p-2">
                <img class="w-full h-[250px] rounded-md overflow-hidden object-cover" src="{{ asset('imgs/MercadoMujer.jpg') }}" alt="User Icon">
                <h3 class="font-bold mt-5">Venta de Mayoreo de Blusas</h3>
                <h3 class="mb-2">Tienda Michelina</h3>
                <div class="flex justify-between">
                    <h3>Ropa</h3>
                    <div class="flex items-center">
                        <h3 class="mr-2">4.2</h3>
                        <img class="w-5 " src="{{ asset('imgs/estrella.png') }}" alt="User Icon">
                    </div>
                </div>
            </div>
            <a href="./VendedorProductoEnEspecifico" class="w-[48%] mb-8 p-2">
                <img class="w-full h-[250px] rounded-md overflow-hidden object-cover" src="{{ asset('imgs/NaranjasQuintal.jpg') }}" alt="User Icon">
                <h3 class="font-bold mt-5">Venta de Naranjas Valencia</h3>
                <h3 class="mb-2">Puesto de Don Juan</h3>
                <div class="flex justify-between">
                    <h3>Comida</h3>
                    <div class="flex items-center">
                        <h3 class="mr-2">3.8</h3>
                        <img class="w-5" src="{{ asset('imgs/estrella.png') }}" alt="User Icon">
                    </div>
                </div>
            </a>

            <div class="w-[48%] mb-8 p-2">
                <img class="w-full h-[250px] rounded-md overflow-hidden object-cover" src="{{ asset('imgs/MercadoJeans.jpg') }}" alt="User Icon">
                <h3 class="font-bold mt-5">Venta de Jeans</h3>
                <h3 class="mb-2">Venta Michelina</h3>
                <div class="flex justify-between">
                    <h3>Ropa</h3>
                    <div class="flex items-center">
                        <h3 class="mr-2">3.2</h3>
                        <img class="w-5" src="{{ asset('imgs/estrella.png') }}" alt="User Icon">
                    </div>
                </div>
            </div> <div class="w-[48%] mb-8 p-2">
                <img class="w-full h-[250px] rounded-md overflow-hidden object-cover" src="{{ asset('imgs/MercadoVariado.jpg') }}" alt="User Icon">
                <h3 class="font-bold mt-5">Venta de Ropa Variada</h3>
                <h3 class="mb-2">Puesto de Don Juan</h3>
                <div class="flex justify-between">
                    <h3>Ropa</h3>
                    <div class="flex items-center">
                        <h3 class="mr-2">4.6</h3>
                        <img class="w-5" src="{{ asset('imgs/estrella.png') }}" alt="User Icon">
                    </div>
                </div>

        </div>
        </div>



    </div>
    <footer class="bg-[#292526] pb-16">
                <div class="flex flex-col gap-6 md:gap-0 md:grid grid-cols-3 text-white  p-12">
                    <div>
                        <h2>Contact Us</h2>
                        <p>Misiones a Futuro</p>
                        <p>Misiones a Futuro</p>
                        <p>Misiones a Futuro</p>
                        <p>Misiones a Futuro</p>
                        <p>Misiones a Futuro</p>
                        <p>Misiones a Futuro</p>
                    </div>
                    <div>
                        <h2>Sobre nosotros</h2>
                        <p>Informacion que un no tenemos 
                            pero que supongo que sera de vital 
                            importancia para el futuro</p>
                    </div>
                    <div class="md:self-end md:justify-self-end pb-4">
                        <p class="font-black text-5xl mb-4">Mini <span class="text-blue-600">Shop</span></p>
                        <div class="flex gap-2">
                            <div class="w-8 aspect-square flex justify-center items-center bg-white rounded-full">
                                <img width="18" class="invert" src="{{ asset('imgs/facebook.png') }}" alt="">
                            </div>
                            <div class="w-8 aspect-square  flex justify-center items-center bg-white rounded-full">
                                <img width="18" class="invert" src="{{ asset('imgs/google.png') }}" alt="">
                            </div>
                            <div class="w-8 aspect-square flex justify-center items-center bg-white rounded-full">
                                <img width="18" class="invert" src="{{ asset('imgs/linkedin.png') }}" alt="">
                            </div>
                            <div class="w-8 aspect-square flex justify-center items-center bg-white rounded-full">
                                <img width="18" class="invert" src="{{ asset('imgs/twitter.png') }}" alt="">
                            </div>
                            <div class="w-8 aspect-square flex justify-center items-center bg-white rounded-full">
                                <img width="18" src="{{ asset('imgs/youtube.png') }}" alt="">
                            </div>
                      
                        </div>
                    </div>
                </div>
                <div class="w-full h-[2px] bg-white"></div>
            </footer>

</body>
</html>
