<x-app-layout>
    <div class="container mx-auto p-4">
        <!-- Estado de la Negociación -->
        <div class="mb-4">
            <h1 class="text-xl font-bold mb-2">Estado de la Negociación</h1>
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
            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
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
                        action="{{ route('cliente.negociacion.responder.notificacion', ['id' => $negociacion->id_negociacion]) }}"
                        method="POST">
                        @csrf
                        <input type="hidden" name="respuesta" value="aceptar">
                        <input type="hidden" name="notification_id" value="{{ $notification->id }}">
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                            Aceptar
                        </button>
                    </form>

                    <form
                        action="{{ route('cliente.negociacion.responder.notificacion', ['id' => $negociacion->id_negociacion]) }}"
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




        <h1 class="text-xl font-bold mb-4">Negociación: {{ $negociacion->id_negociacion }}</h1>

        <!-- Sección de Mensajes -->
        <div id="chat-box" class="border border-gray-300 rounded p-4 mb-4 max-h-96 overflow-y-auto">
            @foreach ($mensajes as $mensaje)
            <div class="mb-2">
                <strong class="{{ Auth::id() === $mensaje->id_usuario ? 'text-blue-600' : 'text-gray-600' }}">
                    {{ $mensaje->users->name }}
                </strong>:
                <span>{{ $mensaje->contenido }}</span>
            </div>
            @endforeach
        </div>

        <!-- Formulario para Enviar un Mensaje -->
        <form action="{{ route('cliente.mensajes.store') }}" method="POST" class="mb-4">
            @csrf
            <input type="hidden" name="id_negociacion" value="{{ $negociacion->id_negociacion }}">
            <input type="hidden" name="id_usuario" value="{{ Auth::id() }}">

            <textarea name="contenido" rows="3" class="w-full border border-gray-300 rounded p-2"
                placeholder="Escribe tu mensaje aquí"></textarea>
            <button type="submit"
                class="mt-6 bg-orange-600 text-white font-medium px-4 py-2 rounded hover:bg-orange-700">
                Enviar
            </button>
        </form>

        <!-- Propuestas de Cambio -->
        <div class="border border-gray-300 shadow rounded-lg p-6 bg-white">
            <h2 class="text-xl font-semibold mb-4 text-gray-700">Propuestas de Cambio</h2>
            <form action="{{ route('cliente.negociacion.update', $negociacion->id_negociacion) }}" method="POST">
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
                    <textarea name="ubicacion_nueva" id="ubicacion_nueva"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-orange-400">{{ $negociacion->ubicacion_nueva }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="monto" class="block font-bold text-gray-600 mb-2">Nuevo Monto:</label>
                    <input type="number" name="monto" id="monto" step="0.01" value="{{ $negociacion->monto }}"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-orange-400">
                </div>

                <div class="mt-6">
                    <button type="submit"
                        class="bg-orange-600 text-white px-4 py-2 rounded-lg hover:bg-orange-700 focus:outline-none">
                        Proponer Cambios
                    </button>
                </div>
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
