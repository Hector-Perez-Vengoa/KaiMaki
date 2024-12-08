<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-6">Publicar un Problema</h1>

        <form action="{{ route('problemas.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    <strong>¡Ups! Algo salió mal:</strong>
                    <ul class="mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <!-- Oficio -->
            <div class="mb-4">
                <label for="id_oficios" class="block text-sm font-medium text-gray-700">Selecciona un Oficio</label>
                <select name="id_oficios" id="id_oficios" class="w-full border-gray-300 rounded-md shadow-sm" required>
                    <option value="">Seleccionar un oficio</option>
                    @foreach($oficios as $oficio)
                        <option value="{{ $oficio->id_oficios }}">{{ $oficio->nombre_oficio }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Descripción -->
            <div class="mb-4">
                <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                <textarea name="descripcion" id="descripcion" rows="4" class="w-full border-gray-300 rounded-md shadow-sm" required></textarea>
                @error('descripcion')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Monto -->
            <div class="mb-4">
                <label for="monto" class="block text-sm font-medium text-gray-700">Monto Propuesto (opcional)</label>
                <input type="number" name="monto" id="monto" step="0.01" class="w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <!-- Fecha de Reserva -->
            <div class="mb-4">
                <label for="fecha_reserva" class="block text-sm font-medium text-gray-700">Fecha para Solucionar</label>
                <input
                    type="date"
                    name="fecha_reserva"
                    id="fecha_reserva"
                    class="w-full border-gray-300 rounded-md shadow-sm"
                    value="{{ old('fecha_reserva') }}"
                    min="{{ now()->toDateString() }}"
                    required>
            </div>


            <!-- Ubicación -->
            <div class="mb-4">
                <p class="block text-sm font-medium text-gray-700">Ubicación</p>
                <label>
                    <input type="radio" name="ubicacion_tipo" value="registrada" checked>
                    Usar ubicación registrada
                </label>
                <label class="block mt-2">
                    <input type="radio" name="ubicacion_tipo" value="alternativa">
                    Ingresar una nueva ubicación:
                </label>
                <div id="ubicacion_alternativa" class="hidden">
                    <input
                        type="text"
                        name="direccion_alternativa"
                        placeholder="Dirección"
                        class="w-full border-gray-300 rounded-md shadow-sm mt-2"
                        value="{{ old('direccion_alternativa') }}">
                    <input
                        type="text"
                        name="distrito_alternativa"
                        placeholder="Distrito"
                        class="w-full border-gray-300 rounded-md shadow-sm mt-2"
                        value="{{ old('distrito_alternativa') }}">
                    <input
                        type="text"
                        name="ciudad_alternativa"
                        placeholder="Ciudad"
                        class="w-full border-gray-300 rounded-md shadow-sm mt-2"
                        value="{{ old('ciudad_alternativa') }}">
                </div>
            </div>

            <!-- Urgente -->
            <div class="mb-4">
                <label>
                    <input type="checkbox" name="urgente" value="1"> Marcar como urgente
                </label>
            </div>

                <!-- Imagen -->
            <div class="mb-4">
                <label for="imagen" class="block text-sm font-medium text-gray-700">Subir Imagen</label>
                <input type="file" name="imagen" id="imagen" accept="image/*" class="w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <!-- Botón de Enviar -->
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                Publicar Problema
            </button>
        </form>
    </div>

    <script>
        // Mostrar/ocultar la ubicación alternativa
        document.querySelectorAll('input[name="ubicacion_tipo"]').forEach(radio => {
            radio.addEventListener('change', (e) => {
                const alternativa = document.getElementById('ubicacion_alternativa');
                if (e.target.value === 'alternativa') {
                    alternativa.classList.remove('hidden');
                } else {
                    alternativa.classList.add('hidden');
                }
            });
        });
    </script>
</x-app-layout>
