<x-app-layout>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-xl font-bold mb-4">Solicitudes de Trabajo</h2>
            <div class="bg-white shadow-md rounded-lg p-6">
                @forelse ($solicitudes as $solicitud)
                    <div class="border-b pb-4 mb-4">
                        <!-- Título principal -->
                        <h3 class="font-semibold text-lg">
                            Solicitud de Trabajo
                        </h3>
                        <!-- Subtítulo con el nombre del trabajador -->
                        <p class="text-md font-medium text-gray-800 mb-2">
                            {{ $solicitud->trabajador?->nombres ?? 'Trabajador no especificado' }}
                            {{ $solicitud->trabajador?->apellidos ?? '' }}
                        </p>
                        <!-- Descripción del problema -->
                        <p class="text-sm text-gray-600">
                            <strong>Descripción:</strong>
                            {{ $solicitud->problemas?->descripcion ?? 'Descripción no disponible' }}
                        </p>
                        <!-- Estado de la solicitud -->
                        <p class="text-sm text-gray-600">
                            <strong>Estado:</strong>
                            {{ $solicitud->estado?->nombre_estado ?? 'Estado no especificado' }}
                        </p>
                        <!-- Botones para aceptar o rechazar -->
                        <div class="mt-2">
                            @if ($solicitud->id_estado_solicitudes == 1) <!-- Estado 1: Pendiente -->
                                <!-- Formulario para aceptar la solicitud -->
                                <form action="{{ route('cliente.aceptarSolicitud', $solicitud->id_solicitudes) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="bg-orange-500 text-white font-bold px-6 py-3 rounded-md hover:bg-orange-600 transition duration-300 shadow-md">
                                        Aceptar
                                    </button>
                                </form>

                                <!-- Formulario para rechazar la solicitud -->
                                <form action="{{ route('cliente.rechazarSolicitud', $solicitud->id_solicitudes) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="bg-orange-500 text-white font-bold px-6 py-3 rounded-md hover:bg-orange-600 transition duration-300 shadow-md">
                                        Rechazar
                                    </button>
                                </form>
                            @elseif ($solicitud->id_estado_solicitudes == 2) <!-- Estado 2: Aceptada -->
                                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                                    <strong class="font-bold">Solicitud aceptada.</strong>
                                </div>
                                <div class="flex space-x-2">
                                    <a href="{{ route('cliente.negociacion.ver', $solicitud->negociaciones->id_negociacion ?? '') }}"
                                        class="bg-orange-500 text-white font-bold px-6 py-3 rounded-md hover:bg-orange-600 transition duration-300 shadow-md">
                                         Negociar
                                     </a>
                                     <!-- Botón Ver Detalles -->
                                     <button onclick="openModal('modal-{{ $solicitud->id_solicitudes }}')"
                                        class="bg-orange-500 text-white font-bold px-6 py-3 rounded-md hover:bg-orange-600 transition duration-300 shadow-md">
                                        Ver Detalles
                                     </button>
                                </div>
                            @elseif ($solicitud->id_estado_solicitudes == 3) <!-- Estado 3: Rechazada -->
                                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                                    <strong class="font-bold">Solicitud rechazada.</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Modal para ver detalles -->
                    <div id="modal-{{ $solicitud->id_solicitudes }}"
                        class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-30 hidden-50">
                        <div class="bg-white rounded-lg p-6 w-96">
                            <h2 class="text-lg font-bold mb-4">Detalles de la Negociación</h2>
                            <p><strong>Fecha Propuesta:</strong> {{ $solicitud->negociaciones->nueva_fech_reserva ?? 'Sin cambios' }}</p>
                            <p><strong>Hora Propuesta:</strong> {{ $solicitud->negociaciones->hora_inicio ?? 'Sin cambios' }}</p>
                            <p><strong>Monto Propuesto:</strong> {{ $solicitud->negociaciones->monto?? 'Sin cambios' }}</p>
                            <p><strong>Ubicación Propuesta:</strong> {{ $solicitud->negociaciones->ubicacion_nueva ?? 'Sin cambios'}}</p>
                            <p><strong>Mensaje</strong> {{ $solicitud->negociaciones->mensaje ?? 'Sin cambios'}}</p>

                            <!-- Botón para cerrar -->
                            <button onclick="closeModal('modal-{{ $solicitud->id_solicitudes }}')"
                                class="mt-4 bg-gray-500 text-white font-medium px-4 py-2 rounded-lg hover:bg-gray-600">
                                Cerrar
                            </button>
                        </div>
                    </div>

                @empty
                    <p class="text-sm text-gray-600">No tienes solicitudes pendientes.</p>
                @endforelse
            </div>
        </div>
    </div>

    <script>
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }
    </script>
</x-app-layout>



