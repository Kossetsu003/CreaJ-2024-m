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
    <div class="md:flex md:bg-[#BDD7FF] ">
        <div class="flex justify-center items-center h-screen md:w-[50%]">
            <div class="p-8">
                <div>
                    <h3 class="font-bold text-6xl text-center">Mini <span class="text-blue-500">Shop</span></h3>
                    <h3 class="mt-3 w-[90%] mx-auto text-justify md:hidden ml-6">
                        Los mejores productos en el mejor
                        <h3 class="text-center md:hidden">lugar</h3>
                    </h3>
                    <div class="hidden md:flex justify-center ml-[34%] w-[60%]">
    <h3 class="text-white mt-5 text-justify">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat, iste possimus, quam ab libero minima impedit eos consectetur exercitationem, magni non reprehenderit nulla dolore. Possimus eligendi ex dignissimos amet explicabo?
    </h3>
</div>


                </div>
                <div class="mt-16 flex justify-center">
                    <a href="./LoginUser">
                        <button class="mr-2 bg-indigo-300 w-32 h-12 rounded-md">
                            Iniciar Sesion
                        </button>
                    </a>
                    <a href="./clientes/create" class="mr-2 border border-black w-32 h-12 rounded-md relative flex items-center">
                        <img class="absolute left-0 top-0 bottom-0 m-auto ml-4 mr-[10px]" src="{{ asset('imgs/play.png') }}" alt="User Icon">
                        <span class="pl-10">
                            Registrarse
                        </span>
                    </a>
                </div>
                <div>
                    <div class="flex gap-7 justify-center mt-8">
                        <div class="bg-black p-1 rounded-full inline-block">
                            <img class="rounded-full w-6" src="{{ asset('imgs/facebook.png') }}" alt="User Icon">
                        </div>
                        <div class="bg-black p-1 rounded-full inline-block">
                            <img class="rounded-full w-6" src="{{ asset('imgs/twitter.png') }}" alt="User Icon">
                        </div>
                        <div class="bg-black p-1 rounded-full inline-block">
                            <img class="rounded-full w-6" src="{{ asset('imgs/instagram.png') }}" alt="User Icon">
                        </div>
                        <div class="bg-black p-1 rounded-full inline-block">
                            <img class="rounded-full w-6" src="{{ asset('imgs/linkedin.png') }}" alt="User Icon">
                        </div>
                    </div>

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
