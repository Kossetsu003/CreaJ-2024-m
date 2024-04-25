<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Home Mercado User</title>
</head>
<body>
        <div class="flex justify-between mt-5 ml-5 ">
            <div>
              <h3 class=" text-sm ">Nombre del mercado</h3>
              <h3 class="text-xs font-bold">Los mejores precios</h3>
            </div>

            <div>
                <img class="w-5 mt-5 mr-5"  src="{{ asset('imgs/usuario.png') }}" valt="User Icon">
            </div>
        </div>

        <div class="flex justify-center border-4 items-center mt-5 w-[80%] mx-auto ">
                <div class=" w-[90%]">
                    <input type="text" class="px-4 py-2 w-[90%] rounded-lg border" placeholder="Search Clothes">
                </div>

                <div class="ml-4 bg-blue-400 rounded-lg flex justify-center">
                    <div class="items-center">
                         <button class="rounded-full px-2 py-1 ">
                            <img class="w-5 mt-1 " src="{{ asset('imgs/casa2.png') }}" alt="User Icon">
                          </button>
                    </div>
                </div>

        </div>

</body>
</html>