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
    <div class="border-4 p-8">
        <div>
            <h3 class="font-bold text-4xl text-center ">Mini <span class="text-blue-500">Shop</span></h3>
            <h3 class="mt-3 border-4 text-center w-[90%] mx-auto">Los mejores productos en el mejor lugar</h3>
        </div>
        <div class="border-4 mt-4">
            <button class="mr-2">Login</button>
            <button>Register</button>
        </div>
    </div>
</div>

</body>
</html>
