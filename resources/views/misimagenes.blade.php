<!DOCTYPE html>
<html lang="en">
<head>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/registro.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estructura.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navegador.css') }}">
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
            grid-template-columns: repeat(2, 1fr);
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

/* Estilos para la ventana flotante de editar */
.ventanaEditar {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    /* Hacemos que sus hijos esten centrados horizontal y verticalmente */
    display: none;
    justify-content: center;
    align-items: center;
    
}

.contenedorEditar {
    position: absolute;
    margin: 0 10px;
    background-color: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    display: block;
    width: 90%;
    max-width: 500px;
}

.contenedorEditar h2 {
    text-align: center;
    margin-bottom: 10px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    color: #007bff;
    text-transform: uppercase;
    letter-spacing: 2px;
}

.contenedorEditar h4 {
    margin: 10px 0;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    color: black;
}

.contenedorEditar input[type="text"], .contenedorEditar textarea {
    width: 100%;
    padding: 5px;
    margin: 5px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.contenedorEditar input[type="button"] {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: none;
    border-radius: 5px;
    background-color: #007bff;
    color: white;
    cursor: pointer;
}








    </style>

</head>

<body>
    @include('nav.navbar')

    

    <div class="contenedor_imagenes">
        @foreach ($fotos as $foto)
     
        <!-- Le damos una id unica a cada contenedor para poder referenciarlo bien en el DOM -->


        <div class="imagen" id="imagen{{ $foto->id_foto }}">

            <img src="{{ $foto->ruta }}" alt="imagen">
            <div class="botonesFoto">
            


                <!-- Botón de Editar -->
                <a href="javascript:void(0)" class="editarFoto" onclick="abrirEdit('{{ $foto->id_foto}}', '{{ $foto->titulo }}', '{{ $foto->descripcion }}')">
                    <img src="{{ asset('svg/editar.svg') }}" alt="Edit" class="editarImagen">
                </a>


                <!-- Botón de Eliminar -->
                <a href="javascript:void(0)" class="eliminarFoto" onclick="deletepost({{ $foto->id_foto }})">
                    <img src="{{ asset('svg/eliminar.svg') }}" alt="Delete" class="eliminarImagen">
                </a>


                <!-- Botón de Compartir -->
                <a href="javascript:void(0)" class="compartirFoto">
                    <img src="{{ asset('svg/compartir.svg') }}" alt="Share" class="compartirImagen">
                </a>




            </div>
        </div>
        @endforeach
    </div>

    <div class="ventanaEditar">
        <div class="contenedorEditar">
            <h2>Editar foto</h2>
            <form id="editpost">
                @csrf
                <input type="hidden" name="id_fotoEdit" id="id_fotoEdit">
                <h4>Título:</h4>
                <input type="text" name="titulo" id="titulo">
                <h4>Descripición:</h4>
                <textarea name="descripcion" id="descripcion" cols="30" rows="10"></textarea>
                <input type="button" value="Enviar" class="enviarEdicion" onclick="editpost()">
            </form>
        </div>
    </div>



</body>
</html>


<script type="text/javascript">

    function deletepost(id) {
        if (confirm("¿Estás seguro de que deseas eliminar esta foto?")) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: 'delete_post/'+id,
                type: 'DELETE',
                success: function (result) {
                    if (result) {
                        // Busca el contenedor de la imagen con la id correspondiente y lo elimina
                        $('#imagen' + id).remove();
                    }
                    

                }
            });
        }
    }


</script>


<script>
    // Función para mostrar la ventana flotante y rellenar los campos con los datos de la foto
    function abrirEdit(id, titulo, descripcion) {
            // Llamaremos a la ruta coger_datos mandano el id de la foto que queremos editar y desde ahi devolveremos los datos de la foto y la colocaremos en los campos del formulario. De esta forma siempre estarán actualizados
            $.ajax({
            url: 'coger_datos/' + id,
            type: 'GET',
            success: function (result) {
                $('#id_fotoEdit').val(result.id_foto);
                $('#titulo').val(result.titulo);
                $('#descripcion').val(result.descripcion);

                // Hacemos la ventana flotante un poco mas pequeña mientras no se ve con un transform scale
                $('.contenedorEditar').css('transform', 'scale(0.9)');
                // Mostramos la ventana flotante con un efecto de fade in y flex
                $('.ventanaEditar').fadeIn(300).css('display', 'flex');

                

            }
        });

        // Hacemos un addEventListener de modo que si se hace click fuera de la ventana flotante, esta se cierre
        $('.ventanaEditar').click(function (e) {
            if (e.target == this) {
                $(this).css('display', 'none');
                // Borramos los textos de los campos
                $('#titulo').val('');
                $('#descripcion').val('');
                
            }
        });

    }

    // Función para cuando se pulse el submit del formulario de edición aparezca un alert con los datos
    function editpost() {
    // Hacer una petición AJAX para enviar los datos del formulario
    $.ajax({
        url: 'editar_foto',
        type: 'POST',
        data: $('#editpost').serialize(),
        success: function (result) {
            // Si la petición ha sido exitosa, actualizar los datos en la página
            var id_foto = $('#id_foto').val();
            var titulo = $('#titulo').val();
            var descripcion = $('#descripcion').val();
            $('#titulo' + id_foto).text(titulo);
            $('#descripcion' + id_foto).text(descripcion);

            // Ocultar la ventana de edición
            $('.ventanaEditar').css('display', 'none');
        }
    });
}







</script>
