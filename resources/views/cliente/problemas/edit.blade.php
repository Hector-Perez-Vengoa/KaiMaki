<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Problema') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('problemas.update', $problema->id_problemas) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Oficio -->
                <div class="mb-4">
                    <label for="id_oficios" class="block text-sm font-medium text-gray-700">Selecciona un Oficio</label>
                    <select name="id_oficios" id="id_oficios" class="w-full border-gray-300 rounded-md shadow-sm" required>
                        @foreach($oficios as $oficio)
                            <option value="{{ $oficio->id_oficios }}" {{ $problema->id_oficios == $oficio->id_oficios ? 'selected' : '' }}>
                                {{ $oficio->nombre_oficio }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Descripción -->
                <div class="mb-4">
                    <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                    <textarea name="descripcion" id="descripcion" rows="4" class="w-full border-gray-300 rounded-md shadow-sm" required>{{ $problema->descripcion }}</textarea>
                </div>

                <!-- Monto -->
                <div class="mb-4">
                    <label for="monto" class="block text-sm font-medium text-gray-700">Monto Propuesto</label>
                    <input type="number" name="monto" id="monto" step="0.01" class="w-full border-gray-300 rounded-md shadow-sm" value="{{ $problema->monto }}">
                </div>

                <!-- Fecha de Reserva -->
                <div class="mb-4">
                    <label for="fecha_reserva" class="block text-sm font-medium text-gray-700">Fecha para Solucionar</label>
                    <input type="date" name="fecha_reserva" id="fecha_reserva" class="w-full border-gray-300 rounded-md shadow-sm" value="{{ $problema->fecha_reserva }}" min="{{ now()->toDateString() }}">
                </div>

                <!-- Estado -->
                <div class="mb-4">
                    <label for="estado" class="block text-sm font-medium text-gray-700">Estado</label>
                    <select name="id_estado_problema" id="estado" class="w-full border-gray-300 rounded-md shadow-sm" required>
                        <option value="1" {{ $problema->id_estado_problema == 1 ? 'selected' : '' }}>Pendiente</option>
                        <option value="5" {{ $problema->id_estado_problema == 5 ? 'selected' : '' }}>Urgente</option>
                    </select>
                </div>

                <!-- Imagen -->
                <div class="mb-4">
                    <label for="imagen" class="block text-sm font-medium text-gray-700">Actualizar Imagen</label>
                    <input type="file" name="imagen" id="imagen" accept="image/*" class="w-full border-gray-300 rounded-md shadow-sm">
                    @if($problema->imagen)
                        <img src="{{ asset('storage/' . $problema->imagen) }}" alt="Imagen actual" class="mt-4 w-48 h-48 object-cover">
                    @endif
                </div>

                <!-- Botón de Guardar -->
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                    Guardar Cambios
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
