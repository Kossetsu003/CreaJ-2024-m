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
   <div class="flex justify-center items-center h-screen border-4">
    <div class=" p-8">
        <div>
            <h3 class="font-bold text-6xl text-center ">Mini <span class="text-blue-500">Shop</span></h3>
            <h3 class="mt-3 text-center w-[90%] mx-auto">Los mejores productos en el mejor lugar</h3>
        </div>
 <div class="mt-16 flex justify-center">
    <button class="mr-2 bg-indigo-300 w-32 h-11 rounded-md"><a href="/LoginUser">Login</a></button>
    <button class="mr-2 border-2 border-black w-32 h-11 rounded-md relative flex items-center">
        <img class="absolute left-0 top-0 bottom-0 m-auto ml-4 mr-[10px]" src="{{ asset('imgs/play.png') }}" alt="User Icon"> <!-- Aumenté el margin-right -->
        <a href="/RegistroUser" class="pl-10">Register</a> <!-- Aumenté el padding-left -->
    </button>
</div>





    </div>
</div>

</body>
</html>
