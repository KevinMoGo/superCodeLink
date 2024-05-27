<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificaciones</title>
    <link rel="stylesheet" href="{{ asset('css/registro.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estructura.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navegador.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex justify-center">
@include('nav.navbar')
    <div class="cuerpoPagina p-8 max-w-7xl w-full mx-auto bg-white shadow-md">

        <ul class="notificaciones space-y-4">
            @foreach ($usuarios as $usuario)
                <li class="notificacion flex items-center border border-gray-300 bg-white p-4 rounded-md shadow-sm">
                    <img src="{{ $usuario->PP }}" alt="default" class="w-24 h-24 mr-5 object-cover border border-black rounded-full">
                    <div class="contenidoUsuario w-full">
                        <h3 class="text-xl font-semibold">{{ $usuario->nombre }}
                        <div class="botonesAmigos mt-5 flex gap-4 justify-center">
                            <form action="aceptar-solicitud/{{ $usuario->id }}" method="post" class="w-full">
                                @csrf
                                <button type="submit" class="aceptarSolicitud w-full py-2 text-green-600 border border-green-600 hover:bg-green-600 hover:text-white transition duration-300">Aceptar</button>
                            </form>
                            <form action="rechazar-solicitud/{{ $usuario->id }}" method="post" class="w-full">
                                @csrf
                                <button type="submit" class="rechazarSolicitud w-full py-2 text-red-600 border border-red-600 hover:bg-red-600 hover:text-white transition duration-300">Rechazar</button>
                            </form>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</body>
</html>
