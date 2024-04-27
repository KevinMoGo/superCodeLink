<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            margin-top: 15vh;
            font-family: Arial, sans-serif;
        }

        .contenedor_imagenes {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-gap: 5px;
        }

        .imagen {
            position: relative;
            overflow: hidden;
        }

        .imagen img {
            width: 100%;
            height: 100%;
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
        }

        .imagen:hover .botonesFoto {
            opacity: 1;
        }

        .botonesFoto a {
            color: white;
            text-decoration: none;
            padding: 3px;
            border-radius: 5px;
        }

        /* Estilos específicos para dispositivos móviles */
        @media screen and (max-width: 767px) {
            .contenedor_imagenes {
                grid-template-columns: repeat(1, 1fr);
            }

            .botonesFoto {
                justify-content: center;
                padding: 5px;
            }
        }
    </style>
</head>

<body>
    @include('nav.navbar')

    <div class="contenedor_imagenes">
        @foreach ($fotos as $foto)
        <div class="imagen">
            <img src="{{ $foto->ruta }}" alt="imagen">
            <div class="botonesFoto">
                <a href="#" class="editarFoto">
                    <img src="{{ asset('svg/editar.svg') }}" alt="Edit" class="editarImagen">
                </a>
                <a href="#" class="eliminarFoto" data-id="{{ $foto->id }}">
                    <img src="{{ asset('svg/eliminar.svg') }}" alt="Delete" class="eliminarImagen">
                </a>
                <a href="#" class="compartirFoto">
                    <img src="{{ asset('svg/compartir.svg') }}" alt="Share" class="compartirImagen">
                </a>
            </div>
        </div>
        @endforeach
    </div>

</body>

</html>
