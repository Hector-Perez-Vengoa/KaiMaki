<x-app-layout>
    <div class="flex justify-center min-h-screen bg-gray-100 p-6">
        <div class="w-full max-w-6xl bg-white shadow-md rounded-lg p-6">
            <!-- Navegación por estados -->
            <div class="mb-6 px-4">
                <div class="flex gap-4 justify-center flex-wrap">
                    <form action="{{ route('cliente.solicitud') }}" method="GET">
                        <button type="submit" name="estado" value="1" class="bg-orange-500 hover:bg-orange-600 text-white font-medium py-2 px-6 rounded-lg shadow-md transition">
                            Pendientes
                        </button>
                    </form>
                    <form action="{{ route('cliente.solicitud') }}" method="GET">
                        <button type="submit" name="estado" value="5" class="bg-orange-500 hover:bg-orange-600 text-white font-medium py-2 px-6 rounded-lg shadow-md transition">
                            En negociación
                        </button>
                    </form>
                    <form action="{{ route('cliente.solicitud') }}" method="GET">
                        <button type="submit" name="estado" value="4" class="bg-orange-500 hover:bg-orange-600 text-white font-medium py-2 px-6 rounded-lg shadow-md transition">
                            Cancelados
                        </button>
                    </form>
                    <form action="{{ route('cliente.solicitud') }}" method="GET">
                        <button type="submit" name="estado" value="2" class="bg-orange-500 hover:bg-orange-600 text-white font-medium py-2 px-6 rounded-lg shadow-md transition">
                            Aceptados
                        </button>
                    </form>
                    <form action="{{ route('cliente.solicitud') }}" method="GET">
                        <button type="submit" name="estado" value="3" class="bg-orange-500 hover:bg-orange-600 text-white font-medium py-2 px-6 rounded-lg shadow-md transition">
                            Completado
                        </button>
                    </form>
                </div>
            </div>

            <!-- Grid de solicitudes -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 px-6">
                @foreach ($solicitudes as $solicitud)
                    <div class="bg-white border border-gray-200 rounded-lg shadow-lg p-6 transition hover:shadow-xl">
                        <!-- Información de la solicitud -->
                        <div class="mb-4">
                            <p class="text-lg font-semibold text-gray-700">Trabajador:</p>
                            <p class="text-gray-600">{{ $solicitud->trabajador->nombres }} {{ $solicitud->trabajador->apellidos }}</p>
                        </div>
                        <div class="mb-4 text-sm">
                            <p class="font-semibold text-gray-700">Solicitud enviada:</p>
                            <p class="text-gray-500">Fecha de Reserva: <span class="text-gray-700">{{ $solicitud->fech_reserva }}</span></p>
                            <p class="text-gray-500">Hora de Inicio: <span class="text-gray-700">{{ $solicitud->hora_inicio_propuesta }}</span></p>
                            <p class="text-gray-500">Descripcion: <span class="text-gray-700">{{ $solicitud->descripcion ?? 'N/A' }}</span></p>
                        </div>
                        @if($solicitud->id_estado_solicitudes !== 1 ) <!-- Estado: negociacion -->
                        <!-- Última negociación -->
                            <div class="mb-4 text-sm">
                                <p class="font-semibold text-gray-700">Ultima negociacion:</p>
                                <p class="text-gray-500">Monto Negociado: <span class="text-gray-700">{{ $solicitud->negociaciones->monto ?? 'En espera' }}</span></p>
                                <p class="text-gray-500">Fecha Reserva: <span class="text-gray-700">{{ $solicitud->negociaciones->nueva_fech_reserva ?? 'En espera' }}</span></p>
                                <p class="text-gray-500">Hora de inicio: <span class="text-gray-700">{{ $solicitud->negociaciones->hora_inicio ?? 'En espera' }}</span></p>
                                <p class="text-gray-500">Tiempo estimado: <span class="text-gray-700">{{ $solicitud->negociaciones->tiempo_estimado ?? 'En espera' }}</span></p>
                                <p class="text-gray-500">Mensaje: <span class="text-gray-700">{{ $solicitud->negociaciones->mensaje ?? 'En espera' }}</span></p>
                            </div>
                        @endif
                        <!-- Botones de acción -->
                        <div class="flex space-x-2">
                            @if($solicitud->id_estado_solicitudes == 5)
                                <form action="{{ route('cliente.actualizarEstado') }}" method="POST" class="w-full">
                                    @csrf
                                    <input type="hidden" name="id_solicitudes" value="{{ $solicitud->id_solicitudes }}">
                                    <input type="hidden" name="estado" value="2">
                                    <button type="submit" class="w-full text-center bg-orange-500 hover:bg-orange-600 text-white py-2 rounded-lg font-medium transition">
                                        Aceptar
                                    </button>
                                </form>

                                <form action="{{ route('cliente.actualizarEstado', $solicitud->id_solicitudes) }}" method="POST" class="w-full">
                                    @csrf
                                    <input type="hidden" name="id_solicitudes" value="{{ $solicitud->id_solicitudes }}">
                                    <input type="hidden" name="estado" value="4">
                                    <button type="submit" class="w-full text-center bg-orange-500 hover:bg-orange-600 text-white py-2 rounded-lg font-medium transition">
                                        Cancelar
                                    </button>
                                </form>
                                <button type="button" class="w-full bg-orange-500 hover:bg-orange-600 text-white py-2 rounded-lg font-medium transition" onclick="toggleModalNegociacion('{{ $solicitud->id_solicitudes }}')">
                                    Renegociar
                                </button>
                            @elseif($solicitud->id_estado_solicitudes == 6)
                                <p class="text-sm">En espera</p>
                            @elseif( $solicitud->id_estado_solicitudes == 2 )
                                <form action="{{ route('cliente.actualizarEstado', $solicitud->id_solicitudes) }}" method="POST" class="w-full">
                                    @csrf
                                    <input type="hidden" name="id_solicitudes" value="{{ $solicitud->id_solicitudes }}">
                                    <input type="hidden" name="estado" value="3">
                                    <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-center text-white py-2 rounded-lg font-medium transition">
                                        Marcar como completado
                                    </button>
                                </form>
                            @elseif($solicitud->id_estado_solicitudes == 3 && (!$solicitud->trabajoCampo || is_null($solicitud->trabajoCampo->puntuacion)))
                                <button type="button" class="w-full bg-yellow-500 text-white py-2 rounded-lg font-medium transition" onclick="toggleModalCalificacion('{{ $solicitud->id_solicitudes }}')">
                                    Calificar servicio
                                </button>
                            @endif

                        </div>
                    </div>
                    @if($solicitud->id_estado_solicitudes == 5)
                        <!-- Modal para renegociar -->
                        <div id="modal-{{ $solicitud->id_solicitudes }}" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
                            <div class="bg-white p-6 rounded-lg shadow-xl w-96">
                                <h3 class="text-xl font-semibold mb-4 text-gray-800">Negociar Solicitud</h3>
                                <form action="{{ route('cliente.renegociar') }}" method="POST">
                                    @csrf
                                    @php
                                        $ultimaNegociacion = $solicitud->negociaciones->first();
                                    @endphp
                                    <input type="hidden" name="id_solicitudes" value="{{ $solicitud->id_solicitudes }}">
                                    <div class="space-y-4">
                                        <div>
                                            <label for="monto" class="block text-sm font-medium text-gray-600">Monto:</label>
                                            <input type="number" name="monto" id="monto" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-orange-500 focus:border-orange-500" placeholder="Ingrese el monto propuesto" min="0" step="0.01" required>
                                        </div>
                                        <div>
                                            <label for="nueva_fech_reserva" class="block text-sm font-medium text-gray-600">Fecha de inicio:</label>
                                            <input type="date" name="nueva_fech_reserva" id="nueva_fech_reserva" value="{{$solicitud->negociaciones->nueva_fech_reserva}}" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-orange-500 focus:border-orange-500" required>
                                        </div>
                                        <div>
                                            <label for="hora_inicio" class="block text-sm font-medium text-gray-600">Hora de inicio:</label>
                                            <input type="time" name="hora_inicio" id="hora_inicio" value="{{$solicitud->negociaciones->hora_inicio}}" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-orange-500 focus:border-orange-500" required>
                                        </div>

                                        <input type="hidden" name="tiempo_estimado" value="{{ $solicitud->negociaciones->tiempo_estimado }}">
                                        <div>
                                            <label for="mensaje" class="block text-sm font-medium text-gray-600">Mensaje adicional:</label>
                                            <textarea name="mensaje" id="mensaje" rows="3" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-orange-500 focus:border-orange-500" placeholder="Escriba un mensaje adicional (opcional)"></textarea>
                                        </div>
                                    </div>
                                    <button type="submit" class="mt-6 w-full bg-orange-600 text-white font-medium px-4 py-2 rounded-lg hover:bg-orange-700 transition focus:outline-none">
                                        Renegociacion
                                    </button>
                                </form>
                            </div>
                        </div>
                        <!-- Modal para renegociar -->
                    @endif
                    <!-- Modal de calificación -->
                    <div id="modalC-{{ $solicitud->id_solicitudes }}" class="fixed inset-0 bg-gray-800 bg-opacity-50 hidden flex items-center justify-center">
                        <div class="bg-white rounded-lg shadow-lg w-96 p-6">
                            <form action="{{ route('cliente.puntuacion') }}" method="POST" class="mt-4">
                                @csrf
                                <!-- Campo oculto para id_solicitudes -->
                                <input type="hidden" name="id_solicitudes" value="{{ $solicitud->id_solicitudes }}">
                                <!-- Campo de estrellas interactivas -->
                                <label for="puntuacion" class="block text-sm font-medium text-gray-600 mt-4">
                                    Califica al trabajador:
                                </label>

                                <div class="flex items-center space-x-1" id="star-rating">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <button type="button" class="star text-gray-300 text-2xl focus:outline-none" data-value="{{ $i }}">
                                            ★
                                        </button>
                                    @endfor
                                </div>
                                <input type="hidden" name="puntuacion" id="puntuacion" value="0">

                                <!-- Campo para hora de salida -->
                                <label for="hora_salida" class="block text-sm font-medium text-gray-600 mt-4">
                                    ¿A que hora termino?:
                                </label>
                                <input type="time" name="hora_salida" id="hora_salida" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-orange-500 focus:border-orange-500" required>

                                <!-- Botón de envío -->
                                <div class="mt-4 flex justify-end">
                                    <button type="submit" class="px-4 py-2 bg-orange-500 text-white rounded ">
                                        Enviar
                                    </button>
                                </div>
                            </form>



                        </div>
                    </div>
                    <!-- Modal de calificación -->
                @endforeach
            </div>
        </div>
    </div>

        <!-- Script -->
        <script>
            function toggleModalNegociacion(id) {
                const modal = document.getElementById(`modal-${id}`);
                modal.classList.toggle('hidden');
            }

            function toggleModalCalificacion(id) {
                const modal = document.getElementById(`modalC-${id}`);
                modal.classList.toggle('hidden');
            }

            document.addEventListener("DOMContentLoaded", function() {
                const stars = document.querySelectorAll("#star-rating .star");
                const puntuacionInput = document.getElementById("puntuacion");

                stars.forEach(star => {
                    star.addEventListener("click", function() {
                        const value = this.dataset.value;
                        puntuacionInput.value = value;

                        // Actualizar las estrellas visualmente
                        stars.forEach(s => {
                            if (s.dataset.value <= value) {
                                s.classList.add("text-yellow-500");
                                s.classList.remove("text-gray-300");
                            } else {
                                s.classList.add("text-gray-300");
                                s.classList.remove("text-yellow-500");
                            }
                        });
                    });
                });
            });
        </script>
</x-app-layout>
