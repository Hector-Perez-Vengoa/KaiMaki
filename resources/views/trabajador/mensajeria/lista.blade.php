<x-app-layout>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-xl font-bold mb-4">Negociaciones Activas</h2>
            <div class="bg-white shadow-md rounded-lg p-6">
                @forelse ($negociaciones as $negociacion)
                <div class="border-b pb-4 mb-4 flex items-center justify-between">
                    <div>
                        <h3 class="font-semibold text-lg">
                            Negociación con {{ $negociacion->solicitud->cliente->nom_cliente ?? 'Cliente no especificado' }}
                        </h3>
                        <p class="text-sm text-gray-600">
                            <strong>Problema:</strong> {{ $negociacion->solicitud->problemas->descripcion ?? 'No especificado' }}
                        </p>
                        <p class="text-sm text-gray-600">
                            <strong>Estado:</strong> {{ $negociacion->estado_negociacion }}
                        </p>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('trabajador.negociacion.ver', $negociacion->id_negociacion) }}"
                            class="px-4 py-2 bg-orange-500 text-white font-semibold rounded-md hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-400">
                            Ver Negociación
                        </a>
                        <button onclick="openModal('modal-{{ $negociacion->id_negociacion }}')"
                            class="px-4 py-2 bg-orange-500 text-white font-semibold rounded-md hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-400">
                            Ver Detalles
                        </button>
                    </div>
                </div>
                @empty
                <p class="text-sm text-gray-600">No tienes negociaciones activas.</p>
                @endforelse
            </div>

            <!-- Lista de Modales -->
            @foreach($negociaciones as $negociacion)
            <!-- Modal -->
            <div id="modal-{{ $negociacion->id_negociacion }}"
                class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                <div class="bg-white rounded-lg p-6 w-96">
                    <h2 class="text-lg font-bold mb-4">Detalles de la Negociación</h2>
                    <p><strong>Fecha Propuesta:</strong> {{ $negociacion->nueva_fech_reserva }}</p>
                    <p><strong>Hora Propuesta:</strong> {{ $negociacion->hora_inicio }}</p>
                    <p><strong>Ubicación Propuesta:</strong> {{ $negociacion->ubicacion_nueva }}</p>
                    <p><strong>Monto Propuesto:</strong> {{ $negociacion->monto }}</p>
                    <p><strong>Mensaje:</strong> {{ $negociacion->mensaje }}</p>

                    <!-- Botón para cerrar el modal -->
                    <button onclick="closeModal('modal-{{ $negociacion->id_negociacion }}')"
                        class="mt-4 bg-gray-500 text-white font-medium px-4 py-2 rounded-lg hover:bg-gray-600">
                        Cerrar
                    </button>
                </div>
            </div>
            @endforeach
        </div>

        <script>
            function openModal(id) {
                document.getElementById(id).classList.remove('hidden');
            }

            function closeModal(id) {
                document.getElementById(id).classList.add('hidden');
            }
        </script>
    </div>
</x-app-layout>
