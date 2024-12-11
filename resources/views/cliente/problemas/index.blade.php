<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mis Problemas Publicados') }}
        </h2>
    </x-slot>

    <div class="flex">
        <!-- Barra lateral con botones de filtro -->
        <div class="flex pt-6">
        <aside class="w-1/4 h-screen bg-gray-50 p-4 border-r border-gray-200">
            <h3 class="text-lg font-semibold mb-4 text-gray-700">Filtrar por Estado</h3>
            <ul class="space-y-2">
                @foreach ([
                    ['estado' => '1', 'label' => 'Pendiente', 'color' => 'bg-gray-200', 'hover' => 'hover:bg-gray-300'],
                    ['estado' => '5', 'label' => 'Urgente', 'color' => 'bg-gray-200', 'hover' => 'hover:bg-red-300'],
                    ['estado' => '2', 'label' => 'En Proceso', 'color' => 'bg-gray-200', 'hover' => 'hover:bg-yellow-300'],
                    ['estado' => '3', 'label' => 'Resuelto', 'color' => 'bg-gray-200', 'hover' => 'hover:bg-green-300'],
                    ['estado' => '4', 'label' => 'Cancelado', 'color' => 'bg-gray-200', 'hover' => 'hover:bg-gray-500']
                ] as $filter)
                    <li>
                        <a href="{{ route('problemas.index', ['estado' => $filter['estado']]) }}"
                           class="block px-4 py-2 rounded-md {{ request('estado') == $filter['estado'] ? 'bg-orange-500 text-white font-bold' : $filter['color'].' '.$filter['hover'] }}">
                            {{ $filter['label'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        </aside>


        <!-- Contenido principal con publicaciones -->
        <main class="w-3/4 p-4 ">
            @if ($problemas->isEmpty())
                <p class="text-gray-500 ">No tienes problemas publicados.</p>
            @else
                @foreach ($problemas as $problema)
                    @include('cliente.problemas.partials.publicacion', compact('problema'))
                @endforeach
            @endif
        </main>
    </div>
</x-app-layout>
