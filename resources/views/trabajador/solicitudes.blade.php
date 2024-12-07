<x-app-layout>
    <div class="flex justify-center min-h-screen bg-gray-100 p-6">
        <div class="w-full max-w-6xl bg-white shadow-md rounded-lg p-6">
            <!-- Botones para filtrar por estado -->
            <div class="mb-4 flex gap-4">
                <form action="{{ route('trabajador.solicitudes') }}" method="GET">
                    <button type="submit" name="estado" value="1" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded shadow">
                        Pendientes
                    </button>
                </form>
                <form action="{{ route('trabajador.solicitudes') }}" method="GET">
                    <button type="submit" name="estado" value="5" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded shadow">
                        En negociación
                    </button>
                </form>
                <form action="{{ route('trabajador.solicitudes') }}" method="GET">
                    <button type="submit" name="estado" value="4" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded shadow">
                        Cancelados
                    </button>
                </form>
                <form action="{{ route('trabajador.solicitudes') }}" method="GET">
                    <button type="submit" name="estado" value="2" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded shadow">
                        Aceptados
                    </button>
                </form>
            </div>

            <!-- Tarjetas de solicitudes -->
            <div class="grid grid-cols-1 gap-6">
                @foreach ($solicitudes as $solicitud)
                    <div class="bg-white shadow-md rounded-lg p-4 border border-gray-200">
                        <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $solicitud->cliente->nom_cliente }} {{ $solicitud->cliente->ape_cliente }}</h3>
                        <p class="text-sm"><span class="font-semibold">Fecha de Reserva:</span> {{ $solicitud->fech_reserva }}</p>
                        
                        @if($solicitud->id_estado_solicitudes == 5)
                            <p class="text-sm">En espera</p>
                        @endif 

                        @if($solicitud->id_estado_solicitudes == 1 || $solicitud->id_estado_solicitudes == 6)
                            <!-- Botón de acción -->
                            <div class="mt-4">
                                <button class="px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600"
                                    onclick="toggleModal('{{ $solicitud->id_solicitudes }}')">
                                    Detalles
                                </button>
                            </div>
                        @endif
                    </div>

                    <!-- Modal -->
                    <div id="modal-{{ $solicitud->id_solicitudes }}" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden z-50">
                        <div class="bg-white p-6 rounded-lg shadow-lg relative">
                            <!-- Modal Header -->
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-xl font-bold">Detalles de la solicitud</h2>
                                <button class="text-gray-500 hover:text-gray-800" onclick="toggleModal('{{ $solicitud->id_solicitudes }}')">
                                    &#x2715;
                                </button>
                            </div>
                            
                            <!-- Modal Body -->
                            <div class="grid grid-cols-2 space-y-4">
                                <div>
                                    @if($solicitud->id_estado_solicitudes == 1)
                                        <p><label class="font-semibold">Cliente:</label> {{ $solicitud->cliente->nom_cliente }} {{ $solicitud->cliente->ape_cliente }}</p>
                                        <p><label class="font-semibold">Fecha de reserva:</label> {{ $solicitud->fech_reserva }}</p>
                                        <p><label class="font-semibold">Hora de inicio:</label> {{ $solicitud->hora_inicio_propuesta }}</p>
                                        <p><label class="font-semibold">Descripción:</label> {{ $solicitud->descripcion }}</p>
                                    @elseif($solicitud->id_estado_solicitudes == 6)
                                        @php
                                            $ultimaNegociacion = $solicitud->negociaciones->first();
                                        @endphp
                                        <p><label class="font-semibold">Cliente:</label> {{ $solicitud->cliente->nom_cliente }} {{ $solicitud->cliente->ape_cliente }}</p>
                                        <p><label class="font-semibold">Monto:</label> {{ $ultimaNegociacion->monto }}</p>
                                        <p><label class="font-semibold">Fecha de reserva:</label> {{ $ultimaNegociacion->nueva_fech_reserva }}</p>
                                        <p><label class="font-semibold">Hora de inicio:</label> {{ $ultimaNegociacion->hora_inicio }}</p>
                                        <p><label class="font-semibold">Mensaje:</label> {{ $ultimaNegociacion->mensaje }}</p>
                                    @endif
                                    <!-- Formulario de Cotización -->
                                    <form action="{{ route('trabajador.negociacion') }}" method="POST" class="max-w-lg mx-auto bg-white p-6 rounded shadow">
                                        @csrf
                                        <input type="hidden" name="id_solicitudes" value="{{ $solicitud->id_solicitudes }}">
                                        
                                        <div class="space-y-4">
                                            <!-- Campo Monto -->
                                            <div>
                                                <label for="monto" class="block text-sm font-medium">Monto:</label>
                                                <input type="number" name="monto" id="monto" class="w-full border border-gray-300 rounded p-2 focus:ring-orange-500 focus:border-orange-500"
                                                    placeholder="Ingrese el monto propuesto" min="0" step="0.01" required>
                                            </div>

                                            <!-- Campo Fecha de Inicio -->
                                            <div>
                                                <label for="nueva_fech_reserva" class="block text-sm font-medium">Fecha de inicio:</label>
                                                <input type="date" name="nueva_fech_reserva" id="nueva_fech_reserva" 
                                                    class="w-full border border-gray-300 rounded p-2 focus:ring-orange-500 focus:border-orange-500"
                                                    value="{{ $solicitud->fech_reserva }}" required>
                                            </div>

                                            <!-- Campo Hora de Inicio -->
                                            <div>
                                                <label for="hora_inicio" class="block text-sm font-medium">Hora de inicio:</label>
                                                <input type="time" name="hora_inicio" id="hora_inicio" 
                                                    class="w-full border border-gray-300 rounded p-2 focus:ring-orange-500 focus:border-orange-500"
                                                    value="{{ $solicitud->hora_inicio_propuesta }}" required>
                                            </div>

                                            <!-- Campo Tiempo Estimado -->
                                            <div>
                                                <label for="tiempo_estimado" class="block text-sm font-medium">Tiempo estimado:</label>
                                                <input type="time" name="tiempo_estimado" id="tiempo_estimado" 
                                                    class="w-full border border-gray-300 rounded p-2 focus:ring-orange-500 focus:border-orange-500"
                                                    placeholder="Ingrese el tiempo estimado" required>
                                            </div>

                                            <!-- Campo Mensaje Adicional -->
                                            <div>
                                                <label for="mensaje" class="block text-sm font-medium">Mensaje adicional:</label>
                                                <textarea name="mensaje" id="mensaje" rows="3" 
                                                    class="w-full border border-gray-300 rounded p-2 focus:ring-orange-500 focus:border-orange-500"
                                                    placeholder="Escriba un mensaje adicional (opcional)"></textarea>
                                            </div>
                                        </div>

                                        <!-- Botón de Enviar -->
                                        <button type="submit" class="mt-6 w-full bg-orange-600 text-white font-medium px-4 py-2 rounded hover:bg-orange-700 focus:outline-none focus:ring focus:ring-orange-500">
                                            Enviar cotización
                                        </button>
                                    </form>
                                    <!-- Fin Formulario de Cotización -->
                                </div>

                                <!-- Carrusel de imágenes -->
                                <div>
                                    @if ($solicitud->imagenes->isNotEmpty())
                                        <div id="carousel-{{ $solicitud->id_solicitudes }}" class="relative">
                                            <div class="carousel-inner relative overflow-hidden w-full">
                                                @foreach ($solicitud->imagenes as $index => $imagen)
                                                    <div class="carousel-item {{ $index == 0 ? 'block' : 'hidden' }} duration-700 ease-in-out">
                                                        <img src="{{ asset('storage/' . $imagen->ruta_imagen) }}" alt="Imagen de la solicitud" class="rounded-md h-18 object-contain">
                                                    </div>
                                                @endforeach
                                            </div>
                                            <!-- Controles del carrusel -->
                                            <button class="absolute top-1/2 left-2 transform -translate-y-1/2 bg-red-600 text-white rounded-full px-3 py-1" 
                                                    onclick="prevSlide('{{ $solicitud->id_solicitudes }}')">&#10094;</button>
                                            <button class="absolute top-1/2 right-2 transform -translate-y-1/2 bg-red-600 text-white rounded-full px-3 py-1" 
                                                    onclick="nextSlide('{{ $solicitud->id_solicitudes }}')">&#10095;</button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Script -->
    <script>
        function toggleModal(id) {
            const modal = document.getElementById(`modal-${id}`);
            modal.classList.toggle('hidden');
        }

        function prevSlide(id) {
            const items = document.querySelectorAll(`#carousel-${id} .carousel-item`);
            let activeIndex = Array.from(items).findIndex(item => item.classList.contains('block'));
            items[activeIndex].classList.replace('block', 'hidden');
            activeIndex = (activeIndex - 1 + items.length) % items.length;
            items[activeIndex].classList.replace('hidden', 'block');
        }

        function nextSlide(id) {
            const items = document.querySelectorAll(`#carousel-${id} .carousel-item`);
            let activeIndex = Array.from(items).findIndex(item => item.classList.contains('block'));
            items[activeIndex].classList.replace('block', 'hidden');
            activeIndex = (activeIndex + 1) % items.length;
            items[activeIndex].classList.replace('hidden', 'block');
        }
    </script>
</x-app-layout>
