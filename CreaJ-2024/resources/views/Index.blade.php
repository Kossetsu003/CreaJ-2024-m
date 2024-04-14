<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Index</title>
</head>
<body>
  <div class="mt-36 flex flex-col lg:flex-row flex-wrap"> <!-- Contenedor -->
    <div class="text-center lg:mr-10"> <!-- Sección de imagen -->
        <img src="{{ asset('imgs/Compra.png') }}" alt="Compra">
    </div>
    <div class="lg:ml-10"> <!-- Sección de texto -->
        <div class="font-bold text-center mb-4">Explore the App</div>
        <div class="w-full md:w-4/5 mx-auto"> <!-- Contenedor de texto -->
            <p class="text-center mb-4">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex error quia reiciendis est excepturi quasi?
                Aperiam dolor neque fugit in repudiandae, ipsa distinctio error eius, libero autem ipsum id iste.
            </p>
            <div class="flex justify-center">
                <button class="bg-blue-300 w-full md:w-[90%] rounded-md font-bold h-9">Let's Start</button>
            </div>
        </div>
    </div>
</div> <!-- Fin del Contenedor -->
</body>
</html>