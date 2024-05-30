<!DOCTYPE html>
<html lang="es">
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inicio</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    </head>

    @include('nav.navbar')

    <body>
        <form action="/buscar" method="POST" class="flex justify-center mt-10">
            @csrf
            <div class="w-4/5 flex">
                <input type="text" name="search" id="search" class="flex-grow border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-l-lg text-sm focus:outline-none"
                    placeholder="Buscar">
                <button type="submit" class="bg-black hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-r-lg">Buscar</button>
            </div>
        </form>

        <div class="flex justify-center mt-10">
            <div class="w-4/5">
                <div class="flex justify-between">
                    <h1 class="text-3xl">Amigos</h1>
                    <a href="/amigos" class="text-blue-500">Ver todos</a>
                </div>
                <div class="grid grid-cols-3 gap-4 mt-5">
                    @foreach ($amigos as $amigo)
                        <div class="bg-white p-3 rounded-lg shadow-lg">
                            <p>{{ $amigo->nombre }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </body>
</html>
