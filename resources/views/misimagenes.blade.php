<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Document</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            margin-top: calc(12vh + 10px);
            font-family: Arial, sans-serif;
        }

        .contenedor_imagenes {
            margin: 0 10px;
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: 10px;
            
        }

        .imagen {
            position: relative;
            overflow: hidden;
        }

        .imagen img {
            width: 100%;
            height: calc(100vw / 2);
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .imagen:hover img {
            transform: scale(1.1);
        }

        .botonesFoto {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: space-around;
            align-items: center;
            padding: 3px;
            box-sizing: border-box;
            opacity: 0;
            transition: opacity 0.3s ease;
            height: 33%;
        }

        .imagen:hover .botonesFoto {
            opacity: 1;
        }

        .botonesFoto a {
            color: white;
            text-decoration: none;
            padding: 3px;
            border-radius: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .botonesFoto a img {
            width: 33%;
            height: auto;
            transition: transform 0.1s ease;
        }


        
        .botonesFoto a img:hover {
            
            transform: scale(1.5);
            
        }





        @media screen and (min-width: 767px) {
            .contenedor_imagenes {
                grid-template-columns: repeat(3, 1fr);
                max-width: 1200px;
                margin: 0 auto;
            }

            .botonesFoto {
                justify-content: center;
                padding: 5px;
            }

            .imagen img {
                height: calc(100vw / 3);
                max-height: 400px;
                
            }

            .contenedorEditar{
                max-width: 800px;
            }
        }








    </style>

</head>

<body>
    @include('nav.navbar')

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
    <div class="fixed top-0 left-0 w-full h-full bg-gray-900 bg-opacity-50 flex justify-center items-center hidden z-50" id="contenedorEditar">
                <div class="bg-white p-5 rounded-lg w-full max-w-3xl mx-4">
                    <h2 class="text-center text-2xl font-bold">Editar Foto</h2>
                    <div class="mt-5" id="formEditar">
                        <div>
                            
                            <input type="hidden" name="id_foto" id="id_foto">
                            <label for="titulo" class="block">Título</label>
                            <input type="text" name="titulo" id="titulo" class="w-full border border-gray-300 rounded p-2 mb-3">
                            <label for="descripcion" class="block">Descripción</label>
                            <textarea name="descripcion" id="descripcion" class="w-full border border-gray-300 rounded p-2 mb-3"></textarea>
                            <a href="javascript:void(0)" class="bg-blue-500 text-white px-4 py-2 rounded block text-center">Editar</a>
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
        
        fetch('/getpost', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                id_foto: id_foto
            })
        })
        .then(response => response.json())
        .then(data => {

        
            document.querySelector('#contenedorEditar').classList.remove('hidden');
            document.querySelector('#titulo').value = data.titulo;  
            document.querySelector('#descripcion').value = data.descripcion;

            // Al boton editar le añadimos una función onclick llamada editarFoto cuyo parámetro es el id de la foto entre '
            document.querySelector('.bg-blue-500').setAttribute('onclick', 'editarFoto(\'' + id_foto + '\')');
            
            document.querySelector('#contenedorEditar').addEventListener('click', function(e) {
                if(e.target.id === 'contenedorEditar') {
                    document.querySelector('#contenedorEditar').classList.add('hidden');
                }
            })

            // le agr

        })
        
    }

    function editarFoto(id_foto) {
        // Recojo los valores de los inputs y los mostramos en consola
        let titulo = document.querySelector('#titulo').value;
        let descripcion = document.querySelector('#descripcion').value;
        
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


        
    }



</script>

