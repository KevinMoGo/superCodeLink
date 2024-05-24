<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Lista de Amigos</title>

</head>
@include('nav.navbar')
<body class="bg-gray-100 flex justify-center py-10">
    <div class="w-full max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6">
        <p class="text-center text-3xl font-bold mb-8">Lista de Amigos</p>
        <div class="space-y-6">
            @foreach ($amigos as $amigo)
                <div class="p-6 bg-gray-50 rounded-md shadow-sm">
                    <img src="{{ $amigo->PP }}" alt="Foto de perfil de {{ $amigo->nombre }}" class="w-32 h-32 object-cover border border-gray-300 rounded-full mx-auto mb-4">
                    <div class="text-center">
                        <h2 class="text-xl font-semibold">{{ $amigo->nombre }}</h2>
                        <p class="text-gray-700">{{ $amigo->username }}</p>
                        <p class="text-gray-600">{{ $amigo->pais }}</p>
                        <p class="text-gray-600">{{ $amigo->edad }} años</p>
                        <p class="text-gray-600">{{ ucfirst($amigo->sexo) }}</p>
                    </div>
                    <div class="flex justify-center mt-4 space-x-4">
                        <button class="btn btn-primary bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg border border-green-500 hover:border-green-700">Escribir</button>
                        <button class="btn btn-danger bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg border border-red-500 hover:border-red-700">Eliminar</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>





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
                    // Find the image container with the corresponding id and remove it
                    document.querySelector('#imagen' + idAmigo).remove();
                }
            });
        }
    }
</script>


