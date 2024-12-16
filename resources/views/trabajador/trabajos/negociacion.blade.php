<x-app-layout>
    <div class="flex justify-center items-center min-h-screen bg-gray-100">
        <div class="bg-white shadow-lg rounded-lg p-6 w-full max-w-5xl">
            <!-- Título y Estado de la Negociación -->
            <div class="mb-6 text-center">
                <h1 class="text-2xl font-bold mb-4">Negociación con {{ $negociacion->solicitud->trabajador->nombres }}
                </h1>
                <p>
                    @if($negociacion->estado_negociacion === 'En proceso')
                    <span class="text-yellow-600 font-bold">Propuesta Pendiente</span>
                    @elseif($negociacion->estado_negociacion === 'Aceptada')
                    <span class="text-green-600 font-bold">Propuesta Aceptada</span>
                    @elseif($negociacion->estado_negociacion === 'Rechazada')
                    <span class="text-red-600 font-bold">Propuesta Rechazada</span>
                    @endif
                </p>

            </div>

            <!-- Notificaciones -->
        <!-- Filtrar notificaciones para la negociación actual -->
        @php
        $notificacionesRelevantes = auth()->user()->notifications->filter(function ($notification) use ($negociacion) {
        return isset($notification->data['negociacion_id']) && $notification->data['negociacion_id'] ==
        $negociacion->id_negociacion;
        });
        @endphp

        <!-- Mostrar notificaciones filtradas -->
        @foreach ($notificacionesRelevantes as $notification)
        <div class="p-4 mb-2 bg-gray-100 border border-gray-300 rounded">
            <p><strong>{{ $notification->data['mensaje'] }}</strong></p>
            <p>{{ $notification->data['detalle'] }}</p>

            <!-- Botón para abrir el modal -->
            <button onclick="openModal('modal-{{ $notification->id }}')" class="text-blue-600 hover:underline">
                Ver
            </button>
        </div>

        <!-- Modal -->
        <div id="modal-{{ $notification->id }}"
            class="fixed inset-0 flex-items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white rounded-lg p-6 w-96">
                <h2 class="text-lg font-bold mb-4">Cambios Propuestos</h2>

                <!-- Mostrar detalles de los cambios -->
                <ul class="mb-4 space-y-2">
                    <li><strong>Nueva Fecha:</strong> {{ $notification->data['nueva_fech_reserva'] ?? 'No especificado'
                        }}</li>
                    <li><strong>Nueva Hora:</strong> {{ $notification->data['hora_inicio'] ?? 'No especificado' }}</li>
                    <li><strong>Nueva Ubicación:</strong> {{ $notification->data['ubicacion_nueva'] ?? 'No especificado'
                        }}</li>
                    <li><strong>Nuevo Monto:</strong> {{ $notification->data['monto'] ?? 'No especificado' }}</li>
                </ul>

                <!-- Botones para aceptar o rechazar -->
                <div class="flex justify-between">
                    <form
                        action="{{ route('trabajador.negociacion.responder.notificacion', ['id' => $negociacion->id_negociacion]) }}"
                        method="POST">
                        @csrf
                        <input type="hidden" name="respuesta" value="aceptar">
                        <input type="hidden" name="notification_id" value="{{ $notification->id }}">
                        <button type="submit" class="bg-orange-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                            Aceptar
                        </button>
                    </form>

                    <form
                        action="{{ route('trabajador.negociacion.responder.notificacion', ['id' => $negociacion->id_negociacion]) }}"
                        method="POST">
                        @csrf
                        <input type="hidden" name="respuesta" value="rechazar">
                        <input type="hidden" name="notification_id" value="{{ $notification->id }}">
                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                            Rechazar
                        </button>
                    </form>
                </div>

                <!-- Botón para cerrar el modal -->
                <button onclick="closeModal('modal-{{ $notification->id }}')"
                    class="mt-4 bg-gray-500 text-white font-medium px-4 py-2 rounded-lg hover:bg-gray-600">
                    Cerrar
                </button>
            </div>
        </div>
        @endforeach






    <!-- Contenido dividido en tres secciones -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <!-- Cambios Propuestos por el Cliente -->
        <div class="border border-gray-300 shadow rounded-lg p-6 bg-white">
            <h2 class="text-lg font-bold text-gray-700 mb-4">Cambios Propuestos por el Cliente</h2>
            <p><strong>Nueva Fecha:</strong> {{ $negociacion->nueva_fech_reserva ?? 'No especificada' }}</p>
            <p><strong>Nueva Hora:</strong> {{ $negociacion->hora_inicio ?? 'No especificada' }}</p>
            <p><strong>Nueva Ubicación:</strong> {{ $negociacion->ubicacion_nueva ?? 'No especificada' }}</p>
            <p><strong>Nuevo Monto:</strong> {{ $negociacion->monto ?? 'No especificado' }}</p>
        </div>

        <!-- Chat de Negociación al centro -->
        <div class="col-span-1 border border-gray-300 shadow rounded-lg p-4 bg-white">
            <h2 class="text-lg font-bold mb-4 text-center">Chat de Negociación</h2>
            <div id="chat-box" class="max-h-96 overflow-y-auto mb-4 border border-gray-300 rounded-lg p-4 bg-gray-50">
                @foreach ($mensajes as $mensaje)
                <div class="flex {{ Auth::id() === $mensaje->id_usuario ? 'justify-end' : 'justify-start' }} mb-4">
                    <div
                        class="max-w-xs px-4 py-2 rounded-lg {{ Auth::id() === $mensaje->id_usuario ? 'bg-orange-500 text-white' : 'bg-gray-200 text-black' }}">
                        <p class="font-bold">{{ Auth::id() === $mensaje->id_usuario ? 'Tú' : $mensaje->users->name }}
                        </p>
                        <p>{{ $mensaje->contenido }}</p>
                        <p
                            class="text-xs {{ Auth::id() === $mensaje->id_usuario ? 'text-orange-200' : 'text-gray-500' }}">
                            {{ $mensaje->created_at->format('d M h:i a') }}
                        </p>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Formulario para enviar mensajes -->
            <form action="{{ route('mensajes.store') }}" method="POST">
                @csrf
                <input type="hidden" name="id_negociacion" value="{{ $negociacion->id_negociacion }}">
                <textarea name="contenido" rows="2" class="w-full border border-gray-300 rounded-lg p-2 mb-2"
                    placeholder="Escribe tu mensaje aquí..." required></textarea>
                <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600">
                    Enviar
                </button>
            </form>
        </div>

        <!-- Cambios Propuestos por el Trabajador -->
        <div class="border border-gray-300 shadow rounded-lg p-6 bg-white">
            <h2 class="text-lg font-bold text-gray-700 mb-4">Cambios Propuestos por el Trabajador</h2>
            <form action="{{ route('trabajador.negociacion.update', $negociacion->id_negociacion) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="nueva_fecha_reserva" class="block font-bold text-gray-600 mb-2">Nueva Fecha:</label>
                    <input type="date" name="nueva_fecha_reserva" id="nueva_fecha_reserva"
                        value="{{ $negociacion->nueva_fech_reserva }}"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-orange-400">
                </div>
                <div class="mb-4">
                    <label for="hora_inicio" class="block font-bold text-gray-600 mb-2">Nueva Hora:</label>
                    <input type="time" name="hora_inicio" id="hora_inicio" value="{{ $negociacion->hora_inicio }}"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-orange-400">
                </div>
                <div class="mb-4">
                    <label for="ubicacion_nueva" class="block font-bold text-gray-600 mb-2">Nueva Ubicación:</label>
                    <textarea name="ubicacion_nueva" id="ubicacion_nueva" rows="2"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-orange-400">{{ $negociacion->ubicacion_nueva }}</textarea>
                </div>
                <div class="mb-4">
                    <label for="monto" class="block font-bold text-gray-600 mb-2">Nuevo Monto:</label>
                    <input type="number" name="monto" id="monto" step="0.01" value="{{ $negociacion->monto }}"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-orange-400">
                </div>
                <button type="submit" class="bg-orange-600 text-white px-4 py-2 rounded-lg hover:bg-orange-700">
                    Proponer Cambios
                </button>
            </form>
        </div>
    </div>


    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }
    </script>
</x-app-layout>
