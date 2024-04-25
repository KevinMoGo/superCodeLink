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
        .buscar {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        input.buscador {
            width: 80%;
            height: 50px;
            border-radius: 20px;
            border: 1px solid #000;
            padding: 0 20px;
            margin: 20px 0;
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

        /* Reset de estilos */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
        }

        /* Otros estilos... */
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

        <!-- Contenido principal -->
        <section class="main-content">
            <h1>Holaaa github</h1>
            <!-- Otro contenido... -->
        </section>
    </main>
</body>

</html>
