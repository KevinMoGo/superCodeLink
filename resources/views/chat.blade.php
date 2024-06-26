<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Chat con {{ $usuario->nombre }}</title>
    <style>
        /* Aplicar overflow-wrap a los contenedores de mensajes */
        .mensaje {
            overflow-wrap: break-word;
        }
        .chat-container {
            display: flex;
            flex-direction: column;
            height: 86%;
        }
        .messages {
            flex: 1;
            overflow-y: auto;
            
            margin-bottom: 1rem; /* Ajustar según la altura del input de mensaje */
        }
        .message-input {
            position: sticky;
            bottom: 0;
            background: white;
            padding: 1rem;
            border-top: 1px solid #e2e8f0; /* Tailwind's border-gray-300 */
        }
        .enunciado {
            top: 0;
        }


    </style>
</head>
<body class="bg-gray-100 fixed w-full h-full">

@include('nav.navbar')

<div class="chat-container mx-auto px-4 py-8 max-w-4xl">
    
    <div class="flex items-center space-x-4 enunciado absolute">
        <h1 class="text-2xl font-semibold">Chat con {{ $usuario->nombre }}</h1>
    </div>
    <div class="messages space-y-4">
        <!-- Mensajes -->

    </div>
    <!-- Input de mensaje -->
    <div class="message-input fixed bottom-0 left-0 right-0 flex">
        <input type="text" placeholder="Escribe tu mensaje" class="flex-1 border border-gray-300 rounded-l-md px-4 py-2 focus:outline-none focus:ring focus:ring-blue-500" id="mensaje">
        <a href="javascript:void(0)" class="bg-blue-500 text-white px-4 py-2 rounded-r-md hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-500" onclick="enviarMensaje('{{ $usuario->id }}')">Enviar</a>
    </div>
</div>

</body>
</html>


<script>

    
        let numeroMensajesActual = 0;

        function getMensajes(){
            fetch('/getMensajes', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                id: '{{ $usuario->id }}',
                user_id: '{{ session('user_id') }}'
            })
        })
        .then(response => response.json())
        .then(data => {

            numeroMensajesActual = data.length;
            
            
            data.forEach(mensaje => {
                if(mensaje.usuario1_id == '{{ session('user_id') }}'){
                    var div = document.createElement('div');
                    div.className = 'flex items-center justify-end';
                    var div2 = document.createElement('div');
                    div2.className = 'bg-gray-200 rounded-lg py-2 px-4 max-w-xs mensaje';
                    var p = document.createElement('p');
                    p.innerHTML = mensaje.mensaje;
                    div2.appendChild(p);
                    div.appendChild(div2);
                    document.querySelector('.messages').appendChild(div);
                   
        }
                else{
                    var div = document.createElement('div');
                    div.className = 'flex items-center justify-start';
                    var div2 = document.createElement('div');
                    div2.className = 'bg-blue-500 text-white rounded-lg py-2 px-4 max-w-xs mensaje';
                    var p = document.createElement('p');
                    p.innerHTML = mensaje.mensaje;
                    div2.appendChild(p);
                    div.appendChild(div2);
                    document.querySelector('.messages').appendChild(div);
                }
    
    
    });

    // Nos vamos al final del contenedor de mensajes para no tener que hacer scroll
    document.querySelector('.messages').scrollTo({
        top: document.querySelector('.messages').scrollHeight,
        behavior: 'smooth'
    });
            

        });
        }

        getMensajes();


        function getNuevosMensajes(){
    fetch('/getMensajes', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            id: '{{ $usuario->id }}',
            user_id: '{{ session('user_id') }}'
        })
    })
    .then(response => response.json())
    .then(data => {
        if(data.length > numeroMensajesActual){
            let nuevosMensajes = data.length - numeroMensajesActual;
            let mensajesParaMostrar = data.slice(-nuevosMensajes);

            // Si el último mensaje es del usuario actual, no lo incluimos en la lista de mensajes a mostrar
            if(mensajesParaMostrar.length > 0 && mensajesParaMostrar[mensajesParaMostrar.length - 1].usuario1_id == '{{ session('user_id') }}'){
                mensajesParaMostrar.pop();
            }

            // Usamos un slice para obtener los mensajes nuevos
            mensajesParaMostrar.forEach(mensaje => {
                if(mensaje.usuario1_id == '{{ session('user_id') }}'){
                    var div = document.createElement('div');
                    div.className = 'flex items-center justify-end';
                    var div2 = document.createElement('div');
                    div2.className = 'bg-gray-200 rounded-lg py-2 px-4 max-w-xs mensaje';
                    var p = document.createElement('p');
                    p.innerHTML = mensaje.mensaje;
                    div2.appendChild(p);
                    div.appendChild(div2);
                    document.querySelector('.messages').appendChild(div);
                } else {
                    var div = document.createElement('div');
                    div.className = 'flex items-center justify-start';
                    var div2 = document.createElement('div');
                    div2.className = 'bg-blue-500 text-white rounded-lg py-2 px-4 max-w-xs mensaje';
                    var p = document.createElement('p');
                    p.innerHTML = mensaje.mensaje;
                    div2.appendChild(p);
                    div.appendChild(div2);
                    document.querySelector('.messages').appendChild(div);

                    // Nos vamos al final del contenedor de mensajes para no tener que hacer scroll
                    document.querySelector('.messages').scrollTo({
                        top: document.querySelector('.messages').scrollHeight,
                        behavior: 'smooth'
                    });
                }
            });

            // Actualizamos el número de mensajes
            numeroMensajesActual = data.length;
        }
    });
}

setInterval(getNuevosMensajes, 2000);











    function enviarMensaje(id) {
        var mensaje = document.getElementById('mensaje').value;
        if (mensaje != '') {
            fetch('/enviarMensaje', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    id: id,
                    mensaje: mensaje,
                    user_id: '{{ session('user_id') }}'
                })
            })
            .then(response => response.json())
            .then(data => {
                var div = document.createElement('div');
                div.className = 'flex items-center justify-end';
                var div2 = document.createElement('div');
                div2.className = 'bg-gray-200 rounded-lg py-2 px-4 max-w-xs mensaje';
                var p = document.createElement('p');
                p.innerHTML = mensaje;
                div2.appendChild(p);
                div.appendChild(div2);
                document.querySelector('.messages').appendChild(div);
                document.getElementById('mensaje').value = '';
                // Nos vamos al final del contenedor de mensajes para no tener que hacer scroll
                document.querySelector('.messages').scrollTo({
                    top: document.querySelector('.messages').scrollHeight,
                    behavior: 'smooth'
                });
                
            });
        }
    }
</script>

