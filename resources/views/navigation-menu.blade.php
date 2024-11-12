<nav class="bg-orange-600 text-white p-4">
    <div class="container mx-auto flex justify-between items-center">
        <a href="{{ url('/') }}" class="text-2xl font-bold">KaiMaki</a>
        <div>
            <a href="  " class="mr-4 hover:underline">Servicios</a>
            <a href="  " class="mr-4 hover:underline">Ayuda</a>
            <a href="  " class="hover:underline">Nosotros</a>
        </div>
        <div>
            @auth
                <a href="  " class="mr-4">Perfil</a>
                <form method="POST" action="  " class="inline">
                    @csrf
                    <button type="submit" class="hover:underline">Cerrar sesión</button>
                </form>
            @else
                <a href="  " class="mr-4 hover:underline">Ingresar</a>
                <a href="  " class="hover:underline">Registrarse</a>
            @endauth
        </div>
    </div>
</nav>
