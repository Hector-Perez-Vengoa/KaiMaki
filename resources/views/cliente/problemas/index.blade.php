<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mis Problemas Publicados') }}
        </h2>
    </x-slot>

    <div class="flex">
        <!-- Barra lateral con botones de filtro -->
        <aside class="w-1/4 h-screen sticky top-0 bg-gray-100 p-4 border-r border-gray-300">
            <h3 class="text-lg font-bold mb-4">Filtrar por Estado</h3>
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('problemas.index', ['estado' => '1']) }}" class="block px-4 py-2 bg-gray-200 rounded-md hover:bg-gray-300">
                        Pendiente
                    </a>
                </li>
                <li>
                    <a href="{{ route('problemas.index', ['estado' => '5']) }}" class="block px-4 py-2 bg-red-200 rounded-md hover:bg-red-300">
                        Urgente
                    </a>
                </li>
                <li>
                    <a href="{{ route('problemas.index', ['estado' => '2']) }}" class="block px-4 py-2 bg-yellow-200 rounded-md hover:bg-yellow-300">
                        En Proceso
                    </a>
                </li>
                <li>
                    <a href="{{ route('problemas.index', ['estado' => '3']) }}" class="block px-4 py-2 bg-green-200 rounded-md hover:bg-green-300">
                        Resuelto
                    </a>
                </li>
                <li>
                    <a href="{{ route('problemas.index', ['estado' => '4']) }}" class="block px-4 py-2 bg-gray-400 rounded-md hover:bg-gray-500">
                        Cancelado
                    </a>
                </li>
            </ul>
        </aside>

        <!-- Contenido principal con publicaciones -->
        <main class="w-3/4 p-4">
            @if ($problemas->isEmpty())
                <p class="text-gray-500">No tienes problemas publicados.</p>
            @else
                @foreach ($problemas as $problema)
                    @include('cliente.problemas.partials.publicacion', compact('problema'))
                @endforeach
            @endif
        </main>
    </div>
</x-app-layout>
