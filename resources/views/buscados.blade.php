<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: consolas;

        }
        .button1 {
            background-color: cyan;
        }
        .button2 {
            background-color: green;
        }
        ul{
            list-style: none;
            padding: 0;
            width : 80%;
            margin: 0 auto;
        }
        li{
            display: flex;
            padding: 2%;
            justify-content: space-evenly;
            border: 1px solid black;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        li button{
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            background-color: red;
        }
        ul li p{
            color: red;
        }
        
    </style>
</head>
<body>
{{ session('user_id') }}
    <h1>Resultados de la búsqueda</h1>

    <ul>
        @foreach ($usuarios as $usuario)
            <li>
                <p>{{ $usuario->nombre }}</p>
                @if ($solicitudes->contains('usuario_receptor_id', $usuario->id))
                    <button class="button1" disabled>Solicitud enviada</button>
                @elseif ($amigos->contains('usuario1_id', $usuario->id) || $amigos->contains('usuario2_id', $usuario->id))
                    <button class="button2" disabled>Amigo</button>
                @else
                    <form method="POST" action="/agregar-solicitud/{{ $usuario->id }}">
                        @csrf
                        <button type="submit">Enviar solicitud</button>
                    </form>
                @endif
            </li>
        @endforeach
    <a href="/inicio">Volver al inicio</a>
</body>
</html>
