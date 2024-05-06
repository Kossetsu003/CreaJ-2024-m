<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Producto Index</title>
</head>
<body>
    <section>
        <div class="pl-5 pt-7 mt-9"> <!--Contenedor de Login-->
            <div class="login">
                <div class="flex">
                    <div class="title">
                        <h2 class="font-bold">Register Account</h2>
                    </div>
                    <div class="icon">
                        <img class="w-4 ml-2 pt-1" src="../imgs/usuario.png" alt="">
                    </div>

                </div>

                <h3 class="text-[9px] font-bold">Welcome Back MiniShop!</h3>
            </div>
        </div>

        <div class="w-72 h-96 mt-16 m-auto"> <!--Contenedor Principal-->
            <div class="text-center "> <!--Contenedor Mini Shop-->
                <h1 class="text-[50px] font-bold ">Mini<span class="text-purple-400 font-bold m-2 ">Shop</span> </h1>
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

                <div class="mt-2 flex justify-end"> <!--Contenedor de forgot password-->
                    <h3 class="text-[15px] font-bold "><a href="./LoginUser">Ya Tengo Cuenta</a></h3>
                </div>
            </div>

            <div class="flex justify-center mt-5">
                <button class="bg-purple-400 w-72 h-10  rounded-md ">Registrarse</button>
            </div>

        </div>

    </section>
</body>
</html>