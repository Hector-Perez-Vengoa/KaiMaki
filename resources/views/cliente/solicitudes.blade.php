<x-app-layout>
    <body>
        <!-- Navegación por estados -->
        <div class="flex space-x-4 mb-4">
            <a href="#" class="px-4 py-2 rounded hover:bg-blue-700">En espera</a>
            <a href="#" class="px-4 py-2 rounded hover:bg-yellow-700">Negociada</a>
            <a href="#" class="px-4 py-2 rounded hover:bg-green-700">Aceptadas</a>
        </div>

        <!-- Grid de solicitudes -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($solicitudes as $solicitud)
                <div class="bg-white border border-gray-200 rounded-lg shadow p-4">
                    <!-- Información de la solicitud -->
                    <div class="mb-4">
                        <p class="text-gray-700">Descripción: {{ $solicitud->descripcion }}</p>
                    </div>
                    <div class="mb-4">
                        <p class="text-gray-600">Fecha de Reserva: {{ $solicitud->fech_reserva }}</p>
                        <p class="text-gray-600">Hora de Inicio: {{ $solicitud->hora_inicio_propuesta }}</p>
                        <p class="text-gray-600">Trabajador: {{ $solicitud->trabajador->nombres ?? 'N/A' }} {{ $solicitud->trabajador->apellidos ?? '' }}</p>
                        <p class="text-gray-600">Estado: {{ $solicitud->estado->nombre_estado ?? 'N/A' }}</p>
                    </div>

                    <!-- Última negociación -->
                    @php
                        $ultimaNegociacion = $solicitud->negociaciones->first();
                    @endphp
                    <div class="mb-4">
                        <p class="text-gray-600">Monto Negociado: {{ $ultimaNegociacion->monto ?? 'Sin negociación' }}</p>
                        <p class="text-gray-600">Nueva Fecha Reserva: {{ $ultimaNegociacion->nueva_fech_reserva ?? 'Sin negociación' }}</p>
                        <p class="text-gray-600">Mensaje: {{ $ultimaNegociacion->mensaje ?? 'Sin mensaje' }}</p>
                    </div>

                    <!-- Botones de acción -->
                    <div class="flex space-x-2">
                        <!-- Botón Aceptar -->
                        <form action="{{ route('cliente.cambiarEstado', ['solicitud' => $solicitud->id_solicitud, 'estado' => 2]) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="px-3 py-1 rounded hover:bg-green-700 bg-green-500 text-white">Aceptar</button>
                        </form>

                        <!-- Botón Cancelar -->
                        <form action="{{ route('cliente.cambiarEstado', ['solicitud' => $solicitud->id_solicitud, 'estado' => 4]) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="px-3 py-1 rounded hover:bg-red-700 bg-red-500 text-white">Cancelar</button>
                        </form>
                        <!-- Botón Renegociar -->
                        <button type="button" class="px-3 py-1 rounded hover:bg-yellow-700 bg-yellow-500 text-white" onclick="toggleModal('{{ $solicitud->id_solicitud }}')">Renegociar</button>
                    </div>
                </div>

                <!-- Modal para renegociar -->
                <div id="modal-{{ $solicitud->id_solicitud }}" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
                    <div class="bg-white p-4 rounded-lg">
                        <form action="{{ route('clientes.renegociar') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id_solicitudes" value="{{ $solicitud->id_solicitud }}">
                            
                            <div class="space-y-4">
                                <!-- Campo Monto -->
                                <div>
                                    <label for="monto" class="block text-sm font-medium">Monto:</label>
                                    <input type="number" name="monto" id="monto" class="w-full border border-gray-300 rounded p-2" placeholder="Ingrese el monto propuesto" min="0" step="0.01" required>
                                </div>

                                <!-- Campo Fecha de Inicio -->
                                <div>
                                    <label for="nueva_fech_reserva" class="block text-sm font-medium">Fecha de inicio:</label>
                                    <input type="date" name="nueva_fech_reserva" id="nueva_fech_reserva" class="w-full border border-gray-300 rounded p-2" value="{{ $solicitud->fech_reserva }}" required>
                                </div>

                                <!-- Campo Hora de Inicio -->
                                <div>
                                    <label for="hora_inicio" class="block text-sm font-medium">Hora de inicio:</label>
                                    <input type="time" name="hora_inicio" id="hora_inicio" class="w-full border border-gray-300 rounded p-2" value="{{ $solicitud->hora_inicio_propuesta }}" required>
                                </div>

                                <!-- Campo Tiempo Estimado -->
                                <div>
                                    <label for="tiempo_estimado" class="block text-sm font-medium">Tiempo estimado:</label>
                                    <input type="time" name="tiempo_estimado" id="tiempo_estimado" class="w-full border border-gray-300 rounded p-2" placeholder="Ingrese el tiempo estimado" required>
                                </div>

                                <!-- Campo Mensaje Adicional -->
                                <div>
                                    <label for="mensaje" class="block text-sm font-medium">Mensaje adicional:</label>
                                    <textarea name="mensaje" id="mensaje" rows="3" class="w-full border border-gray-300 rounded p-2" placeholder="Escriba un mensaje adicional (opcional)"></textarea>
                                </div>
                            </div>

                            <button type="submit" class="mt-6 w-full bg-orange-600 text-white font-medium px-4 py-2 rounded hover:bg-orange-700 focus:outline-none">
                                Enviar cotización
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Script -->
        <script>
            function toggleModal(id) {
                const modal = document.getElementById(`modal-${id}`);
                modal.classList.toggle('hidden');
            }
        </script>
    </body>
</x-app-layout>
