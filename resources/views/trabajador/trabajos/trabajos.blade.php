<x-app-layout>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($problemas as $problema)
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="p-6 border-b border-gray-200">
                            <h5 class="text-xl font-semibold text-gray-800">
                                {{ $problema->oficio->nombre_oficio ?? 'Sin oficio' }}
                            </h5>
                        </div>
                        <div class="p-6">
                            <p class="text-sm text-gray-600"><strong>Cliente:</strong> {{ $problema->cliente->nom_cliente ?? 'Sin cliente' }}</p>
                            <p class="text-sm text-gray-600"><strong>Descripción:</strong> {{ $problema->descripcion }}</p>
                            <p class="text-sm text-gray-600"><strong>Fecha Reserva:</strong> {{ $problema->fecha_reserva }}</p>
                            <p class="text-sm text-gray-600"><strong>Estado:</strong> {{ $problema->estadoProblema->nombre_estado ?? 'Sin estado' }}</p>
                            @if ($problema->imagen)
                                <div class="mt-3">
                                    <img src="{{ asset('storage/' . $problema->imagen) }}" alt="Imagen problema" class="w-full h-48 object-cover rounded-md">
                                </div>
                            @endif
                        </div>
                        <div class="p-4 bg-gray-100">
                            <a href="{{ route('trabajador.problema.detalle', ['problema' => $problema->id_problemas]) }}"
                               class="px-4 py-2 bg-orange-500 text-white font-semibold rounded-md hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-400">
                                Ver detalles
                            </a>
                        </div>

                    </div>
                @empty
                    <p class="text-gray-500 text-center">No hay problemas disponibles actualmente.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>

