<nav>
    <ul>
    <li><a href="/amigos"><img src="{{ asset('svg/gente.svg') }}" alt="gente" class="icono"></a></li>
    <li><a href="misimagenes"><img src="{{ asset('svg/archivo.svg') }}" alt="buscar" class="icono"></a></li>
    <li><a href="/registroSubir"><img src="{{ asset('svg/subir.svg') }}" alt="subir" class="icono"></a></li>
    <li><a href="/notis"><img src="{{ asset('svg/notificacion.svg') }}" alt="notificacion" class="icono"></a></li>
    <li class="Menu"><a href="#"><img src="{{ asset('svg/menu.svg') }}" alt="menu" class="icono"></a></li>
    </ul>
</nav>

<script>
    var menu = document.querySelector('.Menu');
    menu.addEventListener('click', function(){
        document.querySelector('.menu').style.right = '0';
    });
</script>