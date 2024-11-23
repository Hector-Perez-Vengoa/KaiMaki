<x-app-layout>
    <!-- Sección de estilo adicional -->
    <div class="bg-orange-500 text-white p-4">
        <div class="container mx-auto flex items-center">
            <div class="w-16 h-16 rounded-full overflow-hidden">
                <img src="{{ $trabajador->profile_photo_path ? asset('storage/' . $trabajador->profile_photo_path) : asset('storage/userDefault.png') }}" alt="Foto de perfil">
            </div>
            <div class="ml-4">
                <h1 class="text-lg font-semibold">{{ $trabajador->nombres }} {{ $trabajador->apellidos }}</h1>
            </div>
        </div>
    </div>
    <div class="container mx-auto p-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
            
            <!-- Columna de Información -->
            <div class="bg-white shadow-md rounded-md p-10">
                <h3 class="text-lg font-semibold mb-4">Información</h3>
                <ul class="space-y-2">
                    <li class="flex items-center"><strong>Teléfono: </strong> {{ $trabajador->telefono }}</li>
                    <li class="flex items-center"><strong>Distrito: </strong>{{ $trabajador->ciudad }}, {{ $trabajador->distrito }}</li>
                    <li class="flex items-center"><strong>Dirección: </strong> {{ $trabajador->direccion }}</li>
                    <li class="flex items-center"><strong>Email: </strong>{{ $trabajador->email }}</li>
                    <li class="flex items-center"><strong>Teléfono: </strong>{{ $trabajador->telefono }}</li>
                    <p><strong>Especialidades:</strong></p>
                    @if ($trabajador->oficios->isEmpty())
                        <p class="text-gray-600">No tiene oficios registrados.</p>
                    @else
                        <ul class="list-disc list-inside">
                            @foreach ($trabajador->oficios as $oficio)
                                <li>{{ $oficio->nombre_oficio }}</li>
                            @endforeach
                        </ul>
                    @endif
                </ul>
            </div>
            <!-- Fin Columna de Información -->

            <!-- Columna Principal -->
            <div class="bg-white text-center shadow-md rounded-md p-6 md:col-span-2">
                <div class="bg-white border border-orange-200 rounded-lg shadow-md p-4 text-center hover:shadow-lg transition-shadow duration-300">
                    <div class="text-center">
                        <div class="w-20 h-20 mx-auto rounded-full overflow-hidden border-4 border-gray-300">
                            <img src="{{ $trabajador->profile_photo_path ? asset('storage/' . $trabajador->profile_photo_path) : asset('storage/userDefault.png') }}" alt="Foto de Perfil">
                        </div>
                        <h3 class="text-xl font-semibold mt-4">{{ $trabajador->nombres }} {{ $trabajador->apellidos }}</h3>
                    </div>
                    <div class="mt-4">
                        <p class="flex justify-center mt-4">Calificación:</p>
                        <div class="flex justify-center mt-2">
                            @for ($i = 0; $i < ($trabajador->puntuacion > 5 ? 5 : max(0, $trabajador->puntuacion)); $i++)
                            <svg class="w-6 h-6 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.966a1 1 0 00.95.69h4.167c.969 0 1.371 1.24.588 1.81l-3.363 2.456a1 1 0 00-.364 1.118l1.286 3.966c.3.921-.755 1.688-1.539 1.118L10 13.347l-3.363 2.456c-.784.57-1.838-.197-1.539-1.118l1.286-3.966a1 1 0 00-.364-1.118L2.657 9.393c-.783-.57-.38-1.81.588-1.81h4.167a1 1 0 00.95-.69l1.286-3.966z"/>
                            </svg>
                            @endfor
                        </div>
                    </div>
                    <!--div class="mt-6 text-center">
                        <button class="bg-orange-500 text-white px-4 py-2 rounded-md hover:bg-orange-600">
                            Solicitar
                        </button>
                    </div>-->
                </div>
            </div>
            <!-- Fin Columna Principal -->
        </div>
        
        <div class="grid grid-cols-1 gap-4">
            <!-- Formulario de Reserva -->
            <div class="bg-white shadow-md rounded-md p-6">
                <h3 class="text-lg font-semibold mb-4">Formulario de Reserva</h3>
                <form action="{{ route('servicios.solicitar') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_trabajadores" value="{{ $trabajador->id_trabajadores }}">
                    <!-- Fecha de inicio -->
                    <div class="mb-4">
                        <label for="fech_reserva" class="block text-sm font-medium text-gray-700">Fecha de reserva</label>
                        <input type="date" id="fech_reserva" name="fech_reserva" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm" required>
                    </div>

                    <!-- Descripción -->
                    <div class="mb-4">
                        <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                        <textarea id="descripcion" name="descripcion" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm" placeholder="Escribe una breve descripción" required></textarea>
                    </div>

                    <!-- Botón de envío -->
                    <div class="mt-6 text-center">
                        <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded-md hover:bg-orange-600">Solicitar servicios</button>
                    </div>
                </form>
            </div>
            <!-- Fin Formulario de Reserva -->
        </div>
    </div>
</x-app-layout>
