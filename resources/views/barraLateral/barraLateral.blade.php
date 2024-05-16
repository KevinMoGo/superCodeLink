<link rel="stylesheet" href="{{ asset('css/barraLateral.css') }}">

<div class="contenedorBarra">  


    <div class="datosUsuarioBarra">
        <div class="fotoBarra">
            <img src="{{ asset('assets/fotos/3037.jpg') }}" alt="2b">
            <a href="#" class="editarFotoBarra">
                <img src="{{ asset('svg/editarFoto.svg') }}" alt="editarFoto" class="botonEditarFotoBarra">
            </a>
        </div>
        <div class="textoUsuarioBarra">
            <p class="nombreBarra">Nombre</p>
            <p class="usernameBarra">@username</p>
        </div>
    </div>


    <ul class="listaBarra">
        <li class="elementoBarra">
            <p class="textoBarra">Editar Perfil</p>
        </li>
        <li class="elementoBarra">
            <p class="textoBarra">Mis Likes</p>
        </li>
        <li class="elementoBarra">
            <p class="textoBarra">Cerrar Sesión</p>
        </li>
    </ul>




</div>
