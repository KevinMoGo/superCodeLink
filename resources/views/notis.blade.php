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
            font-family: Arial, sans-serif;

            background-color: #f9f9f9;
        }

        .cuerpoPagina {
            margin-top: 12vh;
            padding: 20px;
        }

        .notificacion {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #ddd;
            background-color: #fff;
            padding: 15px;
            margin-bottom: 10px;
            
            
        }

        .notificacion:hover {
            
        }

        .notificacion h3 {
            margin: 0;
            font-size: 18px;
            color: #333;
        }

        .botonesAmigos {
            display: flex;
        }

        .botonesAmigos button {
            margin-left: 10px;
            padding: 8px 16px;
            border: none;
            
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .botonesAmigos button.aceptar {
            border: 1px solid black;
            background-color: transparent;
            color: black;
        }

        .botonesAmigos button.rechazar {
            background-color: transparent;
            color: red;
            border: 1px solid red;
        }

        .botonesAmigos button.aceptar:hover {
            background-color: black;
            color: white;
        }

        .botonesAmigos button.rechazar:hover {
            background-color: red;
            color: white;
        }


        .notificaciones {
            padding: 0;
            
            max-height: 300px;
            
            
            background-color: #fff;
            
            scrollbar-width: thin;
            scrollbar-color: #999 #f9f9f9;
        }

        .notificaciones::-webkit-scrollbar {
            width: 10px;
        }

        .notificaciones::-webkit-scrollbar-track {
            background: #f9f9f9;
        }

        .notificaciones::-webkit-scrollbar-thumb {
            background-color: #999;
            
            
        }
    </style>
</head>
@include('nav.navbar')
<body>
    <div class="cuerpoPagina">
        <h1>Notificaciones</h1>
        <ul class="notificaciones">
            @foreach ($solicitudes as $index => $solicitud)
                <li class="notificacion">
                    <h3>{{ $nombres[$index] }}</h3>
                    <div class="botonesAmigos">
                        <form method="POST" action="/aceptar-solicitud/{{ $ids[$index] }}">
                            @csrf
                            <button class="aceptar" type="submit">Aceptar</button>
                        </form>
                        <form method="POST" action="/rechazar-solicitud/{{ $ids[$index] }}">
                            @csrf
                            <button class="rechazar" type="submit">Rechazar</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</body>
</html>
