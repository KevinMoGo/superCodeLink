<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    
    <title>Subir Imagen</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    @include('nav.navbar')
    <div class="subbody">
        <div class="container mx-auto py-8 px-4">
            <h1 class="text-2xl font-bold mb-4">Subir Imagen</h1>
            <form action="/subirImagen" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="titulo" class="block text-gray-700">Titulo</label>
                    <input type="text" name="titulo" id="titulo" class="w-full border border-gray-300 rounded px-4 py-2">
                </div>
                <div class="mb-4">
                    <label for="descripcion" class="block text-gray-700">Descripción</label>
                    <input type="text" name="descripcion" id="descripcion" class="w-full border border-gray-300 rounded px-4 py-2">
                </div>
                <div class="mb-4">
                    <label for="foto" class="block text-gray-700">Seleccionar imagen</label>
                    <input type="file" name="foto" id="foto" class="w-full" accept=".jpg, .png">
                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded w-full">SUBIR</button>
                <p id="mensajeError" class="text-red-500 mt-4 hidden">Rellena todos los campos</p>
                <p id="mensajePesoError" class="text-red-500 mt-4 hidden">La imagen debe pesar menos de 1MB</p>
                <p id="mensajeExtensionError" class="text-red-500 mt-4 hidden">La imagen debe ser .jpg o .png</p>
            </form>
        </div>
    </div>
</body>
</html>

<script>
    // hacemos un prevent default para asegurarnos de que todos los campos estén llenos, si lo están continuamos con el submit, si no, mostramos un mensaje de error
    document.querySelector('form').addEventListener('submit', function(e) {
        esconderMensajes();
        if (document.querySelector('#titulo').value === '') {
            e.preventDefault();
            document.querySelector('#mensajeError').classList.remove('hidden');
            document.querySelector('#titulo').classList.add('border-red-500');
            setTimeout(() => {
                document.querySelector('#titulo').classList.remove('border-red-500');
            }, 2000);
        } else if (document.querySelector('#descripcion').value === '') {
            e.preventDefault();
            document.querySelector('#mensajeError').classList.remove('hidden');
            document.querySelector('#descripcion').classList.add('border-red-500');
            setTimeout(() => {
                document.querySelector('#descripcion').classList.remove('border-red-500');
            }, 2000);
        } else if (document.querySelector('#foto').value === '') {
            e.preventDefault();
            document.querySelector('#mensajeError').classList.remove('hidden');
            // Hacemos el borde del boton de subir rojo para indicar que falta la imagen
            document.querySelector('#foto').classList.add('border-red-500');
            setTimeout(() => {
                document.querySelector('#foto').classList.remove('border-red-500');
            }, 2000);
        }
        // Nos aseguramos de que la imagen pesa menos de 1MB
        else if (document.querySelector('#foto').files[0].size > 1048576) {
            e.preventDefault();
            document.querySelector('#mensajePesoError').classList.remove('hidden');
            document.querySelector('#foto').classList.add('border-red-500');
            setTimeout(() => {
                document.querySelector('#foto').classList.remove('border-red-500');
            }, 2000);
        }

    });


    function esconderMensajes(){
        document.querySelector('#mensajeError').classList.add('hidden');
        document.querySelector('#mensajePesoError').classList.add('hidden');
        document.querySelector('#mensajeExtensionError').classList.add('hidden');
    }
</script>
