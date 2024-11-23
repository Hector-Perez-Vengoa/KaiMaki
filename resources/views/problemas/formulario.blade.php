<x-app-layout>
    <div class="max-w-4xl mx-auto py-12 px-6 bg-white shadow-md rounded">
        <h2 class="text-2xl font-bold mb-6 text-center">Publicar un Problema</h2>

        <!-- Mostrar mensajes de error -->
        @if ($errors->any())
            <div class="mb-6 bg-red-100 text-red-800 p-4 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('problemas.store') }}" method="POST">
            @csrf

            <!-- Campo: Oficio -->
            <div class="mb-6">
                <label for="id_oficios" class="block text-black-700 font-bold mb-2">Oficio:</label>
                <select name="id_oficios" id="id_oficios" class="form-control">
                    <option value="">Seleccionar un oficio</option>
                    @foreach($oficios as $oficio)
                        <option value="{{ $oficio->id_oficios }}">{{ $oficio->nombre_oficio }}</option>
                    @endforeach
                </select>
                
            </div>

            <!-- Campo: Fecha -->
            <div class="mb-6">
                <label for="fecha" class="block text-gray-700 font-bold mb-2">Fecha:</label>
                <input type="date" name="fecha" id="fecha" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-orange-500 focus:border-orange-500" value="{{ old('fecha') }}">
            </div>

            <!-- Campo: Monto -->
            <div class="mb-6">
                <label for="monto" class="block text-gray-700 font-bold mb-2">Monto (en soles):</label>
                <input type="number" name="monto" id="monto" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-orange-500 focus:border-orange-500" placeholder="Ingrese el monto estimado" value="{{ old('monto') }}">
            </div>

            <!-- Campo: Descripción -->
            <div class="mb-6">
                <label for="descripcion" class="block text-gray-700 font-bold mb-2">Descripción del problema:</label>
                <textarea name="descripcion" id="descripcion" rows="4" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-orange-500 focus:border-orange-500" placeholder="Describe el problema...">{{ old('descripcion') }}</textarea>
            </div>

            <!-- Botón de Enviar -->
            <div class="text-center">
                <button type="submit" class="bg-orange-500 text-white font-bold py-2 px-4 rounded hover:bg-orange-600">
                    Publicar Problema
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
