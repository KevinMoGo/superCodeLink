<!DOCTYPE html>
<html lang="en">

@include('head.header')
@include('barraLateral.barraLateral')

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
    
    padding: 0 20px;
    margin: 20px 0;
    outline: none;
    border: 1px solid transparent; /* Eliminar el borde predeterminado */
    border-image: linear-gradient(270deg, #fff, #000); /* Establecer el gradiente */
    border-image-slice: 1; /* Hacer que el gradiente se muestre completamente */
}


        button#boton-buscar {
            width: 50px;
            height: 50px;
            border: none;
            background-color: black;
            margin-left: 10px;
            cursor: pointer;
            padding: 0;
            
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

    <a href="/tailwind">A Tailwind</a>
    <a href="/aSubirFotoPerfil">
        Subir foto de perfil
    </a>
</body>

</html>


