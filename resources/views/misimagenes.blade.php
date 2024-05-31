<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/misimagenes.css') }}">
    <title>Document</title>

</head>
@include('nav.navbar')
<body>
    

    <div class="contenedor_imagenes">
        @foreach ($fotos as $foto)
            <div class="imagen" id="imagen{{ $foto->id_foto }}">
                <img src="{{ $foto->ruta }}" alt="imagen">
                <div class="botonesFoto">
                    <!-- Botón de Editar -->
                    <a href="javascript:void(0)" class="editarFoto" onclick="abrirEdit('{{ $foto->id_foto }}')">
                        <img src="{{ asset('svg/editar.svg') }}" alt="Edit" class="editarImagen">
                    </a>
                    <!-- Botón de Eliminar -->
                    <a href="javascript:void(0)" class="eliminarFoto" onclick="deletepost('{{ $foto->id_foto }}')">
                        <img src="{{ asset('svg/eliminar.svg') }}" alt="Delete" class="eliminarImagen">
                    </a>

                    <input type="hidden" name="id_foto" value="{{ $foto->id_foto }}">
                </div>
            </div> 

            
        @endforeach
    </div>
    <div class="fixed top-0 left-0 w-full h-full bg-gray-900 bg-opacity-50 flex justify-center items-center hidden z-50" id="contenedorEditar" style="z-index: 501;">
    <div class="bg-white p-5 rounded-lg w-full max-w-3xl mx-4 relative">
        <h2 class="text-center text-2xl font-bold">Editar Foto</h2>
        <div class="mt-5" id="formEditar">
            <div>
                <input type="hidden" name="id_foto" id="id_foto">
                <label for="titulo" class="block">Título</label>
                <input type="text" name="titulo" id="titulo" class="w-full border border-gray-300 rounded p-2 mb-3">
                <label for="descripcion" class="block">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="w-full border border-gray-300 rounded p-2 mb-3"></textarea>
                <div class="flex justify-between mt-3">
                    <a href="javascript:void(0)" class="bg-blue-500 text-white px-4 py-2 rounded text-center editarButton">Editar</a>
                    <a href="javascript:void(0)" class="bg-red-500 text-white px-4 py-2 rounded text-center" onclick = "cerrarEdit()">Cerrar</a>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>


</body>

</html>


<script type="text/javascript">
    function deletepost(id_foto) {
        if(confirm('¿Estás seguro de eliminar la foto?')) {
            fetch('/deletepost', {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                id_foto: id_foto
                })
        })
        document.querySelector('#imagen' + id_foto).remove();
        }

    }

    function abrirEdit(id_foto) {
        
        // Hacemos un get a la ruta /getpost/id_foto
        fetch('/getpost/' + id_foto)
            .then(response => response.json())
            .then(data => {
                document.querySelector('#id_foto').value = data.id_foto;
                document.querySelector('#titulo').value = data.titulo;
                document.querySelector('#descripcion').value = data.descripcion;
                // Le damos una funcion onclick al botón de editar con la id de la foto como parámetro
                document.querySelector('.editarButton').setAttribute('onclick', "editarFoto('" + id_foto + "')");
                document.querySelector('#contenedorEditar').classList.remove('hidden');


                
            })
        
    }

    function cerrarEdit(){
        document.querySelector('#contenedorEditar').classList.add('hidden');
    }

    function editarFoto(id_foto) {
        // Recojo los valores de los inputs y los mostramos en consola
        let titulo = document.querySelector('#titulo').value;
        let descripcion = document.querySelector('#descripcion').value;

        console.log(id_foto);
        console.log(titulo);
        console.log(descripcion);
        
        fetch('/editpost', {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                id_foto: id_foto,
                titulo: titulo,
                descripcion: descripcion
            })
        })
        .then(response => response.json())
        .then(data => {
            // cerramos el contenedor de editar
            cerrarEdit();
        })


        
    }



</script>

