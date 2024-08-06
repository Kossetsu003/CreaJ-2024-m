<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="cache-control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="expires" content="0">
    @vite('resources/css/app.css')
    <title>Index</title>
    <link rel="shortcut icon" href="{{ asset('imgs/MiCarritoUser.png') }}" type="image/x-icon">
</head>
<body>
    <div class="md:flex h-screen">
        <div class="pt-7 md:bg-[#BDD7FF] md:w-[50%] md:flex md:flex-col md:justify-center">
            <div class="login pl-5">
                <div class="flex items-center">
                    <div class="md:hidden">
                        <h1 class="font-bold">Iniciar Sesión</h1>
                    </div>
                    <div class="hidden">
                        <img class="md:w-[75%] mx-auto" src="{{ asset('imgs/imagenindex.png') }}" alt="Login Image">
                    </div>
                </div>
                <div class="md:hidden">
                    <h3 class="text-xs font-bold">¡Bienvenidos a MiniShop!</h3>
                </div>
            </div>
            <form action="{{route('login') }}" method="POST">
                @csrf
                <div class="w-72 h-96 mt-10 mx-auto">
                    <div class="text-center">
                        <h1 class="text-6xl font-bold">Mini<span class="text-[#3679F5] ml-3 font-bold">Shop</span></h1>
                    </div>
                    <div class="flex flex-col mt-5">
                        <div class="flex justify-center pt-5">
                            <input class="border rounded w-80 md:h-12 h-9 pl-5 md:text-[1rem] text-sm border-gray-400 bg-transparent" type="email" name="usuario" id="usuario" placeholder="Ingrese su correo electrónico">
                        </div>
                        <div class="flex justify-center mt-2">
                            <input class="border rounded w-80 md:h-12 h-9 pl-5 md:text-[1rem] text-sm border-gray-400 bg-transparent" type="text" name="password" id="contrasena" placeholder="Ingrese su contraseña">
                        </div>
                        <!--DEBERIAMOS PONERLO?
                        <div class="flex justify-end mt-3 pr-2">
                            <h3 class="text-xs font-bold">Forgot Password?</h3>
                        </div>-->
                    </div>
                    <div class="flex justify-center mt-5">
                        <button type="submit" class="w-72 h-12 font-bold btn overflow-hidden relative bg-[#96A6E8] text-black py-2 px-4 rounded-xl">Iniciar Sesión</button>
                    </div>
            </form>
                    <div class="hidden md:flex items-center mt-8">
                        <div class="flex-grow border-t border-gray-400"></div>
                        <span class="px-4 text-xs">O</span>
                        <div class="flex-grow border-t border-gray-400"></div>

                    </div>
                    <div class="mt-11">
                        <h3 class="text-center text-sm">¿Aún no se ha registrado? <a href="{{ route('RegistroUser') }}" class="text-blue-950 font-bold">Crear Cuenta</a></h3>
                    </div>


                </div>

        </div>
        <div class="hidden md:flex md:flex-col md:items-center md:justify-center md:w-[50%]">
            <div class="text-center mb-4">
                <h3 class="font-bold text-3xl">Login Account</h3>
            </div>
            <div class="flex justify-center">
                <img class="md:w-[75%] mx-auto" src="{{ asset('imgs/imagenindex.png') }}" alt="Login Image">
            </div>
            <div>
                <h3 class="font-bold text-xl">Welcome Back</h3>
                <h3 class="font-bold text-center text-xl">Mini Shop!</h3>
            </div>
        </div>
    </div>
</body>
</html>
