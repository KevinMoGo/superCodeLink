<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Lista de Amigos</title>
    <link rel="stylesheet" href="{{ asset('css/registro.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estructura.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navegador.css') }}">
    @include('head.header')
    <style>
        *{
            
        }
        body{
            margin-top: 12vh;
        }
        div.containerAmigos {
            max-width: 1200px;
            margin: 0 auto;
            
        }

        div.amigo{
            display: flex;
            align-items: center;
            padding: 10px;
            
            width: 100%;
            justify-content: space-between;
        }
        div.amigo img {
    width: 75px;
    height: 75px;
    border: 1px solid black;
    margin-right: 10px;
    object-fit: cover;
}


        div.gestionAmigos{
            display: flex;
            gap: 10px;
            justify-content: end;
        }

        div.fotoNombre{
            display: flex;
            gap: 10px;
            align-items: center;
        }

        div.amigo img.eliminarAmigo{
            border: none;
            width: 50px;
            height: 50px;
            object-fit: cover;
            cursor: pointer;
            transition: all 0.2s;
        }

        div.amigo .escribirAmigo{
            border: none;
            width: 50px;
            height: 50px;
            cursor: pointer;
            transition: all 0.2s;
        }


        .datosAmigo{
            display: flex;
            flex-direction: column;
            height: 75px;
            justify-content: space-around;
        }
        .username{
            
            color: grey;
        }

        @media screen and (min-width: 768px) {
            div.amigo img{
                width: 115px;
                height: 115px;
            }
            div.amigo img.eliminarAmigo{
                width: 75px;
                height: 75px;
            }

            div.amigo .escribirAmigo{
                width: 75px;
                height: 75px;
            }
        }


    </style>
</head>
<body>
        @include('nav.navbar')

        <div class="containerAmigos">
        
        </div>
    

</body>
</html>

<script>
    // Extraemos el ID del usuario de la variable de sesión {{ session('user_id') }}


    
                
    var userID = {{ session('user_id') }};
    
    function getAmigos(id){
        fetch('/apiAmigos/' + id)
        .then(response => response.json())
        // Extraemos los datos de la respuesta uno por uno y los mostramos en la consola
        .then(data => {
            console.log(data);
            var containerAmigos = document.querySelector('.containerAmigos');
            data.forEach(amigo => {
                // Creamos un div para cada amigo con la clase "amigo"
                var divAmigo = document.createElement('div');
                divAmigo.classList.add('amigo');
                // Hacemos que su id sea imagen + el id del amigo por ejemplo "imagen1", "imagen2", etc
                divAmigo.id = "imagen" + amigo.id;

                // Ahora creamos una imagen con la foto del amigo
                var imgAmigo = document.createElement('img');

                // sacamos la ruta del json y la asignamos a la imagen
                imgAmigo.src = amigo.PP;

                // Ahora creamos un span con el nombre del amigo
                var spanAmigo = document.createElement('span');
                spanAmigo.textContent = amigo.nombre;

                var spanUsername = document.createElement('span');
                spanUsername.textContent = '@'+amigo.username;
                // le damos una clase al span para poder darle estilos
                spanUsername.classList.add('username');

                // Creamos un div datosAmigo que contenga el span con el nombre y el span con el username
                var divDatosAmigo = document.createElement('div');
                divDatosAmigo.classList.add('datosAmigo');
                divDatosAmigo.appendChild(spanAmigo);

                divDatosAmigo.appendChild(spanUsername);

                // metemos la imagen y el span dentro dentro de un nuevo div cuya clase es "fotoNombre"
                var divFotoNombre = document.createElement('div');
                divFotoNombre.classList.add('fotoNombre');
                divFotoNombre.appendChild(imgAmigo);
                divFotoNombre.appendChild(divDatosAmigo);
                divAmigo.appendChild(divFotoNombre);

                containerAmigos.appendChild(divAmigo);

                // Creamos una imagen para el botón de eliminar que apunte a assets/svg/borrarAmigo.svg
                var aEliminar = document.createElement('img');
                aEliminar.src = "{{ asset('svg/borrarAmigo.svg') }}";
                aEliminar.alt = "Eliminar amigo";
                aEliminar.classList.add('eliminarAmigo');
                aEliminar.addEventListener('click', function(){
                    eliminarAmigo(amigo.id);
                });
                

                // Creamos un enlace para el botón de escribir que apunte a /chat/{idAmigo}
                var aEscribir = document.createElement('img');
                aEscribir.src = "{{ asset('svg/mensaje.svg') }}";
                aEscribir.alt = "Enviar mensaje";
                aEscribir.classList.add('escribirAmigo');

                var gestionAmigos = document.createElement('div');
                gestionAmigos.classList.add('gestionAmigos');
                gestionAmigos.appendChild(aEliminar);
                gestionAmigos.appendChild(aEscribir);

                divAmigo.appendChild(gestionAmigos);





            });
        });
    }

    getAmigos(userID);
</script>




<script type="text/javascript">
    function eliminarAmigo(idAmigo){
        if (confirm("¿Estás seguro de que deseas eliminar a este amigo?")) {
            fetch('/delete_amigo/' + idAmigo, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(result => {
                if (result) {
                    // Find the image container with the corresponding id and remove it
                    document.querySelector('#imagen' + idAmigo).remove();
                }
            });
        }
    }
</script>


