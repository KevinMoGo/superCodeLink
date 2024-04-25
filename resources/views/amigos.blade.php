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
    @include('head.header')
    <style>
        div.containerAmigos {
            margin-top: 12vh;
        }
        .friend-container {
            background-color: #fff;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .friend-info {
            display: flex;
            align-items: center;
        }

        .friend-name {
            margin-right: 20px;
            font-size: 18px;
            color: #333;
        }
    </style>
</head>
<body>
    @include('nav.navbar')
    <div class="containerAmigos">
    <ul>
        @foreach ($amigos as $amigo)
            <li class="friend-container">
                <div class="friend-info">
                    <p class="friend-name">{{ $amigo->nombre }}</p>
                </div>
            </li>
        @endforeach
    </ul>
    <a href="/inicio">Volver al inicio</a>
    </div>
</body>
</html>
