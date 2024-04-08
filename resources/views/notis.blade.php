<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificaciones</title>
</head>
<body>
    <h1>Notificaciones</h1>

    <ul>
        @foreach ($solicitudes as $index => $solicitud)
            <li>
                <form method="POST" action="/aceptar-solicitud/{{ $ids[$index] }}">
                    {{ $nombres[$index] }} te ha enviado una solicitud
                    @csrf
                    <button type="submit">Aceptar</button>
                </form>
                <form method="POST" action="/rechazar-solicitud/{{ $ids[$index] }}">
                    @csrf
                    <button type="submit">Rechazar</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>
