<!DOCTYPE html>
<html lang="es">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .seccionAmigos::-webkit-scrollbar {
            overflow-x: auto;
        }
    </style>
</head>
@include('nav.navbar')

<body class="bg-gray-100">

    <div class="container mx-auto py-8 p-4">
        <form action="/buscar" method="POST" class="flex justify-center mb-8">
            @csrf
            <div class="w-full md:w-3/5 flex items-center">
                <input type="text" name="search" id="search" class="w-full border-2 border-gray-300 bg-white h-10 px-5 rounded-l-lg text-sm focus:outline-none"
                    placeholder="Buscar">
                <button type="submit" class="bg-black hover:bg-gray-700 text-white font-bold h-10 px-4 rounded-r-lg whitespace-nowrap">Buscar</button>
            </div>
        </form>

        <h1 class="text-3xl mb-4">Amigos</h1>
        <div class="w-full md:w-3/5 mx-auto">
            <div class="seccionAmigos flex gap-2 overflow-x-auto p-2">
                @foreach ($amigos as $amigo)
                    <div class="p-2 rounded-lg flex-shrink-0">
                        <img src="{{ $amigo->PP }}" alt="{{ $amigo->nombre }}" class="w-24 h-24 object-cover rounded-full mx-auto mb-2 border-4 border-orange-500">
                        <h2 class="text-lg font-semibold text-center">{{ $amigo->nombre }}</h2>
                    </div>
                @endforeach
            </div>
        </div>

        <div>
            @foreach ($fotosAmigos as $foto)
                <img src=" {{ $foto->ruta }}" alt="{{ $foto->descripcion }}" class="w-full object-cover rounded-lg">
                <p> {{ $foto->titulo }} </p>
            @endforeach
        </div>
    </div>
</body>



</html>
