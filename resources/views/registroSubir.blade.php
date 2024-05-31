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
            <div>
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
            <button type="button" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded w-full" onclick="subirImagen()">SUBIR</button>
            <p id="mensajeError" class="text-red-500 mt-4 hidden">Rellena todos los campos</p>
            <p id="mensajePesoError" class="text-red-500 mt-4 hidden">La imagen debe pesar menos de 1MB</p>
            <p id="mensajeExtensionError" class="text-red-500 mt-4 hidden">La imagen debe ser .jpg o .png</p>
            </div>
        </div>
    </div>
</body>
</html>

<script>

    function subirImagen(){
        esconderMensajes();
        if (document.querySelector('#titulo').value === '') {
            document.querySelector('#mensajeError').classList.remove('hidden');
            document.querySelector('#titulo').classList.add('border-red-500');
            setTimeout(() => {
                document.querySelector('#titulo').classList.remove('border-red-500');
            }, 2000);
        } else if (document.querySelector('#descripcion').value === '') {
            document.querySelector('#mensajeError').classList.remove('hidden');
            document.querySelector('#descripcion').classList.add('border-red-500');
            setTimeout(() => {
                document.querySelector('#descripcion').classList.remove('border-red-500');
            }, 2000);
        } else if (document.querySelector('#foto').value === '') {
            
            document.querySelector('#mensajeError').classList.remove('hidden');
            // Hacemos el borde del boton de subir rojo para indicar que falta la imagen
            document.querySelector('#foto').classList.add('border-red-500');
            setTimeout(() => {
                document.querySelector('#foto').classList.remove('border-red-500');
            }, 2000);
        }
        // Nos aseguramos de que la imagen pesa menos de 1MB
        else if (document.querySelector('#foto').files[0].size > 1048576) {
            
            document.querySelector('#mensajePesoError').classList.remove('hidden');
            document.querySelector('#foto').classList.add('border-red-500');
            setTimeout(() => {
                document.querySelector('#foto').classList.remove('border-red-500');
            }, 2000);
        }
        else {
    // Crea un nuevo objeto FormData
    let formData = new FormData();
    
    // Añade los campos del formulario al FormData
    formData.append('titulo', document.querySelector('#titulo').value);
    formData.append('descripcion', document.querySelector('#descripcion').value);
    formData.append('foto', document.querySelector('#foto').files[0]);

    // Realiza el fetch POST a la ruta /subirImagen
    fetch('/subirImagen', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            // Nota: No se establece el header 'Content-Type' ya que el navegador se encarga de esto al usar FormData
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
    })
    .catch(error => {
        console.error('Error:', error);
    });
}


        
    }


//subirImagen POST


    function esconderMensajes(){
        document.querySelector('#mensajeError').classList.add('hidden');
        document.querySelector('#mensajePesoError').classList.add('hidden');
        document.querySelector('#mensajeExtensionError').classList.add('hidden');
        
    }
</script>
