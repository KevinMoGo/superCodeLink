<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Lista de Amigos</title>
    <style>
        .cuerpoPagina {
            overflow: auto;
            height: 80vh;
            
        }
        body.hardcore{
            overflow: hidden;
        }
    </style>
</head>
<body class="bg-gray-100 flex justify-center hardcore">
    @include('nav.navbar')
    <div class="cuerpoPagina p-8 max-w-7xl w-full mx-auto bg-white shadow-md">
        
        <ul class="notificaciones space-y-4">
            @foreach ($amigos as $amigo)
                <li class="notificacion flex flex-col sm:flex-row items-center border border-gray-300 bg-white p-4 rounded-md shadow-sm">
                    <img src="{{ $amigo->PP }}" alt="Foto de perfil de {{ $amigo->nombre }}" class="w-24 h-24 object-cover border border-black rounded-full" style="width: 96px; height: 96px;">
                    <div class="contenidoUsuario w-full sm:ml-5 mt-4 sm:mt-0">
                        <h3 class="text-xl font-semibold">{{ $amigo->nombre }}</h3>
                        <p class="text-gray-700">{{ $amigo->username }}</p>
                        
                        <div class="botonesAmigos mt-5 flex flex-col sm:flex-row gap-4 justify-center">
                            <div class="w-full">
                                <form action="/chatAmigo/{{ $amigo->id }}" method="GET">
                                    @csrf
                                    <button type="submit" class="w-full py-2 text-green-600 border border-green-600 hover:bg-green-600 hover:text-white transition duration-300">Escribir</button>
                                </form>
                            </div>
                            <div class="w-full">
                                <button type="submit" class="w-full py-2 text-red-600 border border-red-600 hover:bg-red-600 hover:text-white transition duration-300" onclick="eliminarAmigo({{ $amigo->id }})">Eliminar</button>
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

    <script type="text/javascript">
        function eliminarAmigo(idAmigo){
            if (confirm("¿Estás seguro de que deseas eliminar a este amigo?")) {
                fetch('/delete_amigo/' + idAmigo, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(result => {
                    if (result) {
                        // Remove the friend from the list
                        location.reload();
                    }
                });
            }
        }
    </script>



</body>
</html>
