<x-app-layout>
    <div class="py-4 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($problemas as $problema)
                    <div class="shadow-lg rounded-lg overflow-hidden flex flex-col justify-between"
                         style="background-color: {{ $problema->id_estado_problema == 5 ? '' : '#f9f9f9' }}; border-left: 5px solid {{ $problema->id_estado_problema == 5 ? 'red' : 'white' }};">
                        <!-- Encabezado -->
                        <div class="p-6 border-b border-gray-200">
                            <h5 class="text-xl font-semibold text-gray-800">
                                {{ $problema->oficio->nombre_oficio ?? 'Sin oficio' }}
                            </h5>
                        </div>

                        <!-- Contenido -->
                        <div class="p-4 flex-grow">
                            <p class=" text-sm text-gray-600"><strong>Cliente:</strong> {{ $problema->cliente->nom_cliente ?? 'Sin cliente' }}</p>
                            <p class="mt-2 text-sm text-gray-600"><strong>Descripción:</strong> {{ $problema->descripcion }}</p>
                            <p class="mt-2 text-gray-600 mt-2 text-sm"><strong>Fecha de reserva:</strong> {{ $problema->fecha_reserva ?? 'No especificada' }}</p>
                            <p class="mt-2 text-sm text-gray-600"><strong>Estado:</strong>
                                @if ($problema->id_estado_problema == 5)
                                    <span class="px-3 py-1 text-xs font-semibold text-white rounded-full" style="background-color: red;">
                                        Urgente
                                    </span>
                                @else
                                    <span class="px-3 py-1 text-xs font-semibold text-black rounded-full" style="background-color: white;">
                                        Pendiente
                                    </span>
                                @endif
                            </p>

                            <!-- Imagen -->
                            @if ($problema->imagen)
                                <div class="mt-3 h-48 w-full bg-gray-100 rounded-md flex items-center justify-center overflow-hidden">
                                    <img src="{{ asset('storage/' . $problema->imagen) }}" alt="Imagen problema" class="object-cover w-full h-full">
                                </div>
                            @else
                                <div class="mt-3 h-48 w-full bg-gray-200 flex items-center justify-center rounded-md">
                                    <span class="text-gray-500">Sin imagen</span>
                                </div>
                            @endif
                        </div>

                        <!-- Pie de Tarjeta -->
                        <div class="p-6 border-t border-gray-200">
                            <a href="{{ route('trabajador.problema.detalle', ['problema' => $problema->id_problemas]) }}"
                               class="w-full inline-block text-center px-4 py-2 bg-orange-500 text-white font-semibold rounded-md hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-400">
                                Ver detalles
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 text-center col-span-full">No hay problemas disponibles actualmente.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
