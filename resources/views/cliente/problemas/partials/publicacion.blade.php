<div class="bg-white shadow-md rounded-md mb-6 p-4 max-w-xl mx-auto"
     style="
        border-left: 5px solid {{ $problema->id_estado_problema == 5 ? 'red' : 'white' }};
        background-color: {{ $problema->id_estado_problema == 5 ? '#ffe5e5' : '#f0f0f0' }};
     ">
    <!-- Encabezado -->
    <div class="flex justify-between items-center">
        <div>
            <p class="font-semibold text-sm text-gray-800">{{ $problema->oficio->nombre_oficio }}</p>
        </div>

        <div class="flex items-center space-x-4">
            <!-- Etiqueta para el estado -->
            @if ($problema->id_estado_problema == 5)
                <span class="px-3 py-1 text-xs font-semibold text-white rounded-full" style="background-color: red;">
                    Urgente
                </span>
            @else
                <span class="px-3 py-1 text-xs font-semibold text-black rounded-full" style="background-color: white;">
                    Pendiente
                </span>
            @endif

            <!-- Menú de opciones -->
            <div class="relative">
                <button onclick="toggleMenu('menu-{{ $problema->id_problemas }}')" class="text-gray-500 hover:text-black focus:outline-none">
                    &#x22EE; <!-- Icono de 3 puntos -->
                </button>

                <!-- Opciones del Menú -->
                <div id="menu-{{ $problema->id_problemas }}" class="absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded-md shadow-lg hidden">
                    <a href="{{ route('problemas.edit', $problema->id_problemas) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        Editar
                    </a>
                    <form action="{{ route('problemas.destroy', $problema->id_problemas) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este problema?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-gray-100">
                            Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Descripción -->
    <p class="text-gray-800 mt-4 text-sm">{{ $problema->descripcion }}</p>

    <!-- Imagen -->
    @if ($problema->imagen)
        <div class="mt-4">
            <img src="{{ asset('storage/' . $problema->imagen) }}" alt="Imagen del problema" class="rounded-md object-cover w-full h-56">
        </div>
    @endif

    <!-- Fecha de Reserva -->
    <p class="text-gray-600 mt-4 text-sm"><strong>Fecha de reserva:</strong> {{ $problema->fecha_reserva ?? 'No especificada' }}</p>

    <!-- Ubicación -->
    <p class="text-gray-600 mt-2 text-sm">
        <strong>Ubicación:</strong>
        @if ($problema->ubicacion_alternativa)
            {{ $problema->ubicacion_alternativa }}
        @else
            {{ $problema->cliente->ubicacion?->direccion }}, {{ $problema->cliente->ubicacion?->distrito }}, {{ $problema->cliente->ubicacion?->ciudad }}
        @endif
    </p>

    <!-- Pie de Publicación -->
    <div class="flex justify-between items-center mt-4 border-t pt-3">
        <span class="text-sm text-gray-600">Monto inicial: {{ $problema->monto ? '$' . number_format($problema->monto, 2) : 'No especificado' }}</span>
        <a href=" " class="bg-orange-500 text-white px-4 py-2 text-sm rounded-md hover:bg-orange-600">
            Negociar
        </a>
    </div>

    <script>
        function toggleMenu(menuId) {
            const menu = document.getElementById(menuId);
            menu.classList.toggle('hidden');
        }

        // Cerrar cualquier menú abierto al hacer clic fuera
        window.addEventListener('click', function (event) {
            const menus = document.querySelectorAll('[id^="menu-"]');
            menus.forEach(menu => {
                if (!menu.contains(event.target) && !menu.previousElementSibling.contains(event.target)) {
                    menu.classList.add('hidden');
                }
            });
        });
    </script>

</div>
