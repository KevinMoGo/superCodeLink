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
        /* Hacemos un grid de 3 columnas para que las imagenes se ordenen en filas de 3 en 3 */
        .contenedor_imagenes {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
        }

        /* Las imagenes tendras un tamaño de 1/3 del ancho de la pantalla y serán cuadradas */
        .imagen img {
            width: calc(100vw / 3);
            height: calc(100vw / 3);
            object-fit: cover;
            transition: all 0.3s ease; /* Agregamos una transición para que el cambio sea gradual */
        }

        .imagen:hover {
            transform: scale(1.1);
            border-radius: 10px;
            position: relative;
            z-index: 1;
        }

        .imagen:not(:hover) {
            transform: scale(1); /* Volvemos al estado original */
            position: static;
            z-index: auto;
        }

        .botonesFoto{
            display: flex;
            color: white;
        }

        .botonesFoto a{
            color: white;
            text-decoration: none;
            padding: 10px;
            width: 33.33%;
            text-align: center;
        }

        .botonesFoto .editarFoto{
            background-color: #4CAF50;
        }

        .botonesFoto .eliminarFoto{
            background-color: #f44336;
        }

        .botonesFoto .compartirFoto{
            background-color: #2196F3;
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
                <a href="#" class="editarFoto">X</a>
                <a href="#" class="eliminarFoto">X</a>
                <a href="#" class="compartirFoto">X</a>
            </div>

        </div>
    @endforeach
</div>

<script>
     // Asignamos un eventlistener a cada imagen para que al hacer click en ella se abra en una nueva pestaña
    document.querySelectorAll('.imagen img').forEach((imagen, index) => {
        imagen.addEventListener('click', () => {
            

            
            
            
        });
    });

</script>
</body>
</html>
