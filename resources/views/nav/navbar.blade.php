<nav class="bg-black fixed top-0 w-full flex items-center justify-between z-50 px-4 py-2 rounded-b-lg shadow-lg" id="navbar">
    <ul class="flex items-center justify-between w-full space-x-1" id="listaNav">
        <li><a href="/inicio" class="flex items-center navbar-item btn rounded-full p-2 hover:bg-gray-700"><img src="{{ asset('svg/home.svg') }}" alt="casa" class="icono"></a></li>
        <li><a href="/amigos" class="flex items-center navbar-item btn rounded-full p-2 hover:bg-gray-700"><img src="{{ asset('svg/gente.svg') }}" alt="gente" class="icono"></a></li>
        <li><a href="misimagenes" class="flex items-center navbar-item btn rounded-full p-2 hover:bg-gray-700"><img src="{{ asset('svg/archivo.svg') }}" alt="buscar" class="icono"></a></li>
        <li><a href="/registroSubir" class="flex items-center navbar-item btn rounded-full p-2 hover:bg-gray-700"><img src="{{ asset('svg/subir.svg') }}" alt="subir" class="icono"></a></li>
        <li><a href="/notis" class="flex items-center navbar-item btn rounded-full p-2 hover:bg-gray-700"><img src="{{ asset('svg/notificacion.svg') }}" alt="notificacion" class="icono"></a></li>
        <li><a href="/menu" class="flex items-center navbar-item btn rounded-full p-2 hover:bg-gray-700"><img src="{{ asset('svg/menu.svg') }}" alt="menu" class="icono"></a></li>
    </ul>
</nav>
<style>
    body {
        margin-top: 16vh;
        height: 100vh;
    }
    #navbar {
        height: 13vh;
    }
    .icono {
        width: 100%;
        max-width: 35px;
    }
    #listaNav {
        justify-content: space-around;
    }
    @media (min-width: 768px) and (min-height: 600px) {
    .icono {
        max-width: 60px;
        max-height: 60px;
    }
}
</style>
