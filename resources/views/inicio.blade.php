<!DOCTYPE html>
<html lang="en">

@include('head.header')
@include('menu.menu')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/registro.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estructura.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navegador.css') }}">

    <style>
        /* Estilos específicos para la página */

        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            margin-top: 12vh;
            font-family: Arial, sans-serif;
        }

        .buscar {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        input.buscador {
            width: 80%;
            height: 50px;
            border-radius: 20px;
            border: 1px solid #004EE1;
            padding: 0 20px;
            margin: 20px 0;
            outline: none;
        }

        button#boton-buscar {
            width: 50px;
            height: 50px;
            border: none;
            background-color: #004EE1;
            margin-left: 10px;
            cursor: pointer;
            padding: 0;
            border-radius: 20px;
        }

        img.lupa {
            width: 20px;
            height: 20px;
        }



        .imagen {
            position: relative;
            overflow: hidden;
        }

        .imagen img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Cubrir completamente el contenedor */
            transition: transform 0.3s ease;
        }

        .imagen:hover img {
            transform: scale(1.1);
        }

        /* Media query para dispositivos móviles */
        @media screen and (max-width: 991px) {
            .container {
                grid-template-columns: repeat(2, 1fr); /* Cambiar a 1 columna en dispositivos móviles */
            }
        }
    </style>

    <title>Inicio</title>
</head>

<body>
    <!-- Encabezado -->
    @include('nav.navbar')

    <!-- Contenedor principal -->
    <main class="container">
        <!-- Formulario de búsqueda -->
        <section class="busqueda-section">
            <form id="formulario" action="buscador" method="post">
                @csrf
                <div class="buscar">
                    <input type="text" id="buscador" name="buscador" class="buscador" placeholder="Buscar...">
                    <button type="submit" id="boton-buscar">
                        <img src="{{ asset('svg/buscar.svg') }}" alt="Buscar" class="lupa">
                    </button>
                </div>
            </form>
        </section>

    </main>
</body>

</html>


