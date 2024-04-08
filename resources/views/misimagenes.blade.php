<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('css/registro.css') }}">
        <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
        <link rel="stylesheet" href="{{ asset('css/estructura.css') }}">
        <link rel="stylesheet" href="{{ asset('css/navegador.css') }}">

        <style>
            .contenedor {
                display: inline-block;
                width: 100%;
                height: 100%;
                justify-content: center;
                align-items: center;
                text-align: center;
            }
            .apartado_imagenes {
                width: 100%;
                justify-content: center;
                align-items: center;
                text-align: center;
            }

            .publicacion {
                margin: 0 auto;
                border: 1px solid red;
                max-width: 600px;
                width: 100%;
                height: 100%;
                justify-content: center;
                align-items: center;
                text-align: center;
                margin-bottom: 20px;
            }
            .publicacion img{
                max-width: 600px;
                width: 100%;
                height: auto;
                aspect-ratio: 3/4;
                object-fit: cover;
            }

            
            .publicacion .botonEliminar {
                background-color: #f44336;
                color: white;
                padding: 14px 20px;
                border: none;
                cursor: pointer;
                width: 100%;
            }
            .publicacion .botonEliminar:hover {
                background-color: #f44326;
            }

            .publicacion .botonEditar {
                background-color: #4CAF50;
                color: white;
                padding: 14px 20px;
                border: none;
                cursor: pointer;
                width: 100%;
            }
            .publicacion .botonEditar:hover {
                background-
                color: #4CAF40;
            }

            .publicacion .botonLike {
                background-color: #008CBA;
                color: white;
                padding: 14px 20px;
                border: none;
                cursor: pointer;
                width: 100%;
            }
            .publicacion .botonLike:hover {
                background-color: #008CBB;
            }



            .botones {
                display: flex;
                // Agrupamos los botones a la izquierda
                justify-content: flex-start;

            }

            h1{
                text-align: center;
                color: white;
            }
            h3
            {
                color: white;
                background-color: #333;
            }

        </style>
</head>
<body>
<div class="apartado_imagenes">
@include('nav.navbar')

<h1>Mis imagenes</h1>

            @foreach ($fotos as $foto)
                <div class="publicacion">
                    <img src="{{ ($foto->ruta) }}" alt="imagen">
                    <h3> {{$foto->titulo}} </h3>
                    <p> {{$foto->descripcion}} </p>

                    <div class="botones">
                        <!-- boton de eliminar -->
                    <form action="eliminarFoto/{{$foto->id_foto}}" method="post">
                        @csrf
                        <button type="submit" class="botonEliminar">Eliminar</button>
                    </form>
                        <!-- boton de editar -->
                        <form action="editarFoto/{{$foto->id_foto}}" method="post">
                            @csrf
                            <button type="submit" class="botonEditar">Editar</button>
                        </form>

                        <!-- boton de like -->
                        <form action="like/{{$foto->id_foto}}" method="post">
                            @csrf
                            <button type="submit" class="botonLike">Like</button>
                        </form>

                    </div>


                </div>
            @endforeach
        </div>
</body>
</html>



