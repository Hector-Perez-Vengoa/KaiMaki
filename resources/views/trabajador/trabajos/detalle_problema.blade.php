<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Detalles del Problema</h2>

                <!-- Información del problema -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700">Oficio</h3>
                        <p class="text-gray-600">{{ $problema->oficio->nombre_oficio }}</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700">Cliente</h3>
                        <p class="text-gray-600">{{ $problema->cliente->nom_cliente }} {{ $problema->cliente->ape_cliente }}</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700">Descripción</h3>
                        <p class="text-gray-600">{{ $problema->descripcion }}</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700">Fecha de Reserva</h3>
                        <p class="text-gray-600">{{ $problema->fecha_reserva ?? 'No especificada' }}</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700">Monto</h3>
                        <p class="text-gray-600">{{ $problema->monto ?? 'No especificado' }}</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700">Estado</h3>
                        @if ($problema->id_estado_problema == 5)
                        <span class="px-3 py-1 font-semibold text-white rounded-full" style="background-color: red;">
                            Urgente
                        </span>
                    @else
                        <span class=" text-black">
                            Pendiente
                        </span>
                    @endif
                    </div>
                </div>

                <!-- Imagen del problema -->
                @if ($problema->imagen)
                    <div class="mt-6 p-4 bg-gray-100 rounded-md">
                        <h3 class="text-lg font-semibold text-gray-700">Imagen del problema</h3>
                        <img src="{{ asset('storage/' . $problema->imagen) }}" alt="Imagen del problema"
                            class="w-full h-64 object-cover rounded-md mt-2">
                    </div>
                @endif

                <!-- Botón para solicitar -->
                <div class="p-6 border-t border-gray-200">
                    <form method="POST" action="{{ route('trabajador.solicitar', ['problema' => $problema->id_problemas]) }}">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-orange-500 text-white font-semibold rounded-md hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-400">
                            Solicitar Trabajo
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
