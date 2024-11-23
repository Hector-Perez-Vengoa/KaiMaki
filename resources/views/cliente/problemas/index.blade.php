<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mis Problemas Publicados') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-6">Mis Publicaciones</h1>

                @if($problemas->isEmpty())
                    <p class="text-gray-500">No tienes problemas publicados.</p>
                @else
                    <table class="min-w-full table-auto bg-white border-collapse border border-gray-200">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2">Fecha</th>
                                <th class="border px-4 py-2">Oficio</th>
                                <th class="border px-4 py-2">Descripción</th>
                                <th class="border px-4 py-2">Estado</th>
                                <th class="border px-4 py-2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($problemas as $problema)
                                <tr>
                                    <td class="border px-4 py-2">{{ $problema->created_at->format('d/m/Y') }}</td>
                                    <td class="border px-4 py-2">{{ $problema->oficio->nombre_oficio}}</td>
                                    <td class="border px-4 py-2">{{ $problema->descripcion }}</td>
                                    <td class="border px-4 py-2">{{ $problema->estadoProblema->nombre_estado ?? 'N/A' }}</td>
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('problemas.show', $problema->id_problemas) }}" class="bg-blue-500 text-black px-4 py-2 rounded shadow hover:bg-blue-700">Ver</a>
                                        <a href="{{ route('problemas.edit', $problema->id_problemas) }}" class="bg-yellow-500 text-white px-4 py-2 rounded shadow hover:bg-yellow-700">Editar</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
