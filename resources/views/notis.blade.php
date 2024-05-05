<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificaciones</title>
    <link rel="stylesheet" href="{{ asset('css/registro.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estructura.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navegador.css') }}">
    <style>
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            font-family: Arial, sans-serif;
            justify-content: center;
            margin-top: 12vh;
            background-color: #f9f9f9;
        }

        .cuerpoPagina {
            
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .notificacion {
            display: flex;
            
            align-items: center;
            border: 1px solid #ddd;
            background-color: #fff;
            padding: 15px;
            margin-bottom: 10px;
        }

        .notificacion img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-right: 20px;
        }

        .botonesAmigos {
            margin-top: 20px;
            display: flex;
            width: 100%;
            gap: 10px;
            justify-content: center;
        }
        .contenidoUsuario {
            width: 100%;
        }
        form{
            width: 50%;
        }
        button.aceptarSolicitud {
            background-color: transparent;
            color: green;
            padding: 10px;
            outline: none;
            border: 1px solid green;
            width: 100%;
            transition: all 0.3s;
        }

        button.aceptarSolicitud:hover {
            background-color: green;
            color: white;
        }
        button.rechazarSolicitud {
            background-color: transparent;
            color: red;
            padding: 10px;
            outline: none;
            border: 1px solid red;
            width: 100%;
            transition: all 0.3s;
        }

        button.rechazarSolicitud:hover {
            background-color: red;
            color: white;
        }

    </style>
</head>
@include('nav.navbar')
<body>
    <div class="cuerpoPagina">
        <h1>Notificaciones</h1>
        <ul class="notificaciones">
            @foreach ($usuarios as $usuario)
                <li class="notificacion">
                    <img src="{{ $usuario->PP }}" alt="default">

                    <div class="contenidoUsuario">
                    <h3>{{ $usuario->nombre }}</h3>

                    <div class="botonesAmigos">
                        <form action="aceptar-solicitud/{{ $usuario->id }}" method="post">
                            @csrf
                            <button type="submit" class="aceptarSolicitud">Aceptar</button>
                        </form>
                        <form action="rechazar-solicitud/{{ $usuario->id }}" method="post">
                            @csrf
                            <button type="submit" class="rechazarSolicitud">Rechazar</button>
                        </form>
                    </div>
                    </div>



                </li>
                
            @endforeach
        </ul>
    </div>
</body>
</html>
