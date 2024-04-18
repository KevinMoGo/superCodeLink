<!DOCTYPE html>
<html lang="en">
    @include('head.header')

    <head>
        <meta charset="UTF-8">
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

        </style>


        <title>Document</title>
    </head>

    <body>
        <!-- yeees -->
        @include('nav.navbar')
        <form action="buscador" method="post">
            @csrf
            <div class="buscar">
                <input type="text" id="buscador" name="buscador" class="buscador">
                <button type="submit">Buscar</button>
            </div>
        </form>

        <h1>Holaaa github</h1>


    </body>
</html>
