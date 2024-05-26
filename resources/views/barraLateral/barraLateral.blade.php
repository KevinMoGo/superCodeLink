<div id="sidebar" class="bg-gray-100">
    <!-- Right Sidebar -->
    

    <div id="sidebar" class="fixed top-0 right-0 h-full bg-gray-800 text-white w-64 space-y-6 py-7 px-2" style="margin-top: 12vh;">
        <!-- User Info -->
        <div class="flex items-center space-x-4 p-2">
            <div class="relative">
                <img src="{{ asset('assets/fotos/664d0e3678b12.jpg') }}" alt="User Photo" class="h-16 w-16 rounded-full">
                <a href="#" class="absolute bottom-0 right-0 bg-blue-500 rounded-full p-1">
                    <img src="{{ asset('svg/editarFoto.svg') }}" alt="Editar Foto" class="h-4 w-4">
                </a>
            </div>
            <div>
                <p class="font-medium text-lg">Nombre</p>
                <p class="text-sm text-gray-400">@username</p>
            </div>
        </div>
        <!-- Navigation -->
        <ul class="space-y-2">
            <li>
                <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
                    Editar Perfil
                </a>
            </li>
            <li>
                <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
                    Mis Likes
                </a>
            </li>
            <li>
                <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
                    Cerrar Sesión
                </a>
            </li>
        </ul>
    </div>
</div>

