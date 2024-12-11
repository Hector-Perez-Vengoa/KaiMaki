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
                <form action="{{ route('trabajador.negociaciones') }}" method="GET">
                    <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded shadow">
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
                <form action="{{ route('trabajador.solicitudes') }}" method="GET">
                    <button type="submit" name="estado" value="3" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded shadow">
                        Completados
                    </button>
                </form>
            </div>

            <!-- Tarjetas de solicitudes -->
            <div class="grid grid-cols-1 gap-6">
                @foreach ($solicitudes as $solicitud)
                    <div class="bg-white shadow-md rounded-lg p-4 border border-gray-200">
                        <h3 class="text-lg font-bold text-gray-800 mb-2">Cliente: {{ $solicitud->cliente->nom_cliente }} {{ $solicitud->cliente->ape_cliente }}</h3>
                        <p class="text-sm"><span class="font-semibold">Fecha de Reserva:</span> {{ $solicitud->fech_reserva }}</p>
                        <p class="text-sm"><span class="font-semibold">Hora de inicio propuesto:</span> {{ $solicitud->hora_inicio_propuesta }}</p>
                        <p class="text-sm"><span class="font-semibold">Fecha de creacion:</span> {{ $solicitud->created_at }}</p>


                        @if($solicitud->id_estado_solicitudes == 5)
                            <p class="text-sm">En espera</p>
                        @endif

                        @if($solicitud->id_estado_solicitudes == 1 || $solicitud->id_estado_solicitudes == 6)
                            <!-- Botón de acción -->
                            <div class="mt-4 flex space-x-4">
                                <button class="px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600"
                                    onclick="toggleModal('{{ $solicitud->id_solicitudes }}')">
                                    Detalles
                                </button>
                                @if($solicitud->id_estado_solicitudes == 6)
                                    <form action="{{ route('trabajador.actualizarEstado') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id_solicitudes" value="{{ $solicitud->id_solicitudes }}">
                                        <input type="hidden" name="estado" value="2">
                                        <button type="submit" class="px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600">
                                            Aceptar
                                        </button>
                                    </form>

                                    <form action="{{ route('trabajador.actualizarEstado') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id_solicitudes" value="{{ $solicitud->id_solicitudes }}">
                                        <input type="hidden" name="estado" value="4">
                                        <button type="submit" class="px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600">
                                            Cancelar
                                        </button>
                                    </form>
                                @endif
                            </div>
                        @endif
                    </div>

                    <!-- Modal -->
                    <div id="modal-{{ $solicitud->id_solicitudes }}" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden z-50">
                        <div class=" bg-white p-6 rounded-lg shadow-lg">
                            <!-- Modal Header -->
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-xl font-bold">Detalles de la solicitud</h2>
                                <button class="text-gray-500 hover:text-gray-800" onclick="toggleModal('{{ $solicitud->id_solicitudes }}')">
                                    &#x2715;
                                </button>
                            </div>
                            <div class="p-6">
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
                            </div>
                            <!-- Modal Body -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6">
                                <!-- Primera columna -->
                                <div class="space-y-6 md:col-span-1">
                                    <!-- Formulario de Cotización -->
                                    <form action="{{ route('trabajador.negociacion') }}" method="POST" class="bg-white p-4 rounded shadow space-y-4">
                                        @csrf
                                        <input type="hidden" name="id_solicitudes" value="{{ $solicitud->id_solicitudes }}">

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

                                        <button type="submit" class="mt-4 w-full bg-orange-600 text-white font-medium px-4 py-2 rounded hover:bg-orange-700 focus:outline-none focus:ring focus:ring-orange-500">
                                            Enviar cotización
                                        </button>
                                    </form>
                                    <!-- Fin Formulario de Cotización -->
                                </div>

                                <!-- Segunda columna -->
                                <div class="md:col-span-2 shadow space-y-4">
                                    <!-- Carrusel de imágenes -->
                                    @if ($solicitud->imagenes->isNotEmpty())
                                        <div id="carousel-{{ $solicitud->id_solicitudes }}" class="relative">
                                            <div class="carousel-inner relative overflow-hidden w-full">
                                                @foreach ($solicitud->imagenes as $index => $imagen)
                                                    <div class="carousel-item {{ $index == 0 ? 'block' : 'hidden' }} duration-700 ease-in-out"
                                                        data-index="{{ $index }}">
                                                        <div class="h-64 w-full flex items-center justify-center bg-gray-200 overflow-hidden rounded-md">
                                                            <img src="{{ asset('storage/' . $imagen->ruta_imagen) }}" alt="Imagen de la solicitud"
                                                                class="image h-full w-auto object-cover">
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <!-- Controles del carrusel -->
                                            <button class="carousel-control prev absolute top-1/2 transform -translate-y-1/2 text-white hover:bg-orange-600"
                                                    onclick="prevSlide('{{ $solicitud->id_solicitudes }}')">
                                                &#10094;
                                            </button>
                                            <button class="carousel-control next absolute top-1/2 transform -translate-y-1/2 text-white hover:bg-orange-600"
                                                    onclick="nextSlide('{{ $solicitud->id_solicitudes }}')">
                                                &#10095;
                                            </button>
                                        </div>

                                        <style>
                                            .carousel-inner {
                                                position: relative;
                                            }

                                            .carousel-control {
                                                display: flex;
                                                align-items: center;
                                                justify-content: center;
                                                width: 50px;
                                                height: 100%;
                                                cursor: pointer;
                                                transition: background-color 0.3s ease;
                                            }

                                            .carousel-control.prev {
                                                left: 1px; /* Distancia desde el lado izquierdo */
                                            }

                                            .carousel-control.next {
                                                right: 1px; /* Distancia desde el lado derecho */
                                            }

                                            /* Ajustar posición vertical */
                                            .carousel-control {
                                                top: 50%;
                                                transform: translateY(-50%);
                                            }
                                        </style>
                                    @endif
                                    <!-- Fin Carrusel de imágenes -->
                                </div>
                            </div>
                            <!-- Fin Modal Body -->

                        </div>
                    </div>
                    <!-- Fin Modal -->
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
        //Imagenes
        window.addEventListener('load', () => {
            const images = document.querySelectorAll('.image'); // Combina las clases

            images.forEach((imgElement) => {
                const canvas = document.createElement('canvas');
                const ctx = canvas.getContext('2d');

                const targetWidth = 600; // Ancho deseado
                const targetHeight = 550; // Alto deseado

                const originalImage = new Image();
                originalImage.crossOrigin = 'anonymous';
                originalImage.src = imgElement.src;

                originalImage.onload = () => {
                    const aspectRatio = originalImage.width / originalImage.height;
                    let sourceWidth, sourceHeight, startX, startY;

                    if (aspectRatio > targetWidth / targetHeight) {
                        sourceHeight = originalImage.height;
                        sourceWidth = sourceHeight * (targetWidth / targetHeight);
                        startX = (originalImage.width - sourceWidth) / 2;
                        startY = 0;
                    } else {
                        sourceWidth = originalImage.width;
                        sourceHeight = sourceWidth * (targetHeight / targetWidth);
                        startX = 0;
                        startY = (originalImage.height - sourceHeight) / 2;
                    }

                    canvas.width = targetWidth;
                    canvas.height = targetHeight;

                    ctx.drawImage(
                        originalImage,
                        startX, startY, sourceWidth, sourceHeight,
                        0, 0, targetWidth, targetHeight
                    );

                    imgElement.src = canvas.toDataURL('image/png');
                };

                originalImage.onerror = () => {
                    console.error('Error al cargar la imagen:', imgElement.src);
                };
            });
        });
    </script>
</x-app-layout>
