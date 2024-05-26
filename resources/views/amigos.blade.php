<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/registro.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estructura.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navegador.css') }}">
    <title>Lista de Amigos</title>
</head>
<body class="bg-gray-100 flex justify-center mt-48">
@include('nav.navbar')
    <div class="cuerpoPagina p-8 max-w-7xl w-full mx-auto bg-white shadow-md rounded-lg">
        <p class="text-center text-3xl font-bold mb-8">Lista de Amigos</p>
        <div class="space-y-6">
            @foreach ($amigos as $amigo)
                <div class="flex flex-col md:flex-row items-center p-6 bg-gray-50 rounded-md shadow-sm space-y-4 md:space-y-0 md:space-x-6">
                    <img src="{{ $amigo->PP }}" alt="Foto de perfil de {{ $amigo->nombre }}" class="w-24 h-24 md:w-32 md:h-32 object-cover border border-gray-300 rounded-full">
                    <div class="text-center md:text-left flex-1">
                        <h2 class="text-xl font-semibold">{{ $amigo->nombre }}</h2>
                        <p class="text-gray-700">{{ $amigo->username }}</p>
                        <p class="text-gray-600">{{ $amigo->pais }}</p>
                        <p class="text-gray-600">{{ $amigo->edad }} años</p>
                        <p class="text-gray-600">{{ ucfirst($amigo->sexo) }}</p>
                    </div>
                    <div class="flex justify-center md:justify-end space-x-4">
                        <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg border border-green-500 hover:border-green-700">Escribir</button>
                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg border border-red-500 hover:border-red-700" onclick="eliminarAmigo({{ $amigo->id }})">Eliminar</button>
                    </div>
                </div>
            @endforeach
        </div>
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
