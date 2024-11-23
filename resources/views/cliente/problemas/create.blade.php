<x-app-layout>
    <div class="max-w-4xl mx-auto py-6">
        <h1 class="text-2xl font-bold mb-4">Publicar un Problema</h1>

        <form action="{{ route('problemas.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="id_oficios">Selecciona un Oficio</label>
                <select name="id_oficios" id="id_oficios" class="form-control">
                    <option value="">Seleccionar un oficio</option>
                    @foreach($oficios as $oficio)
                        <option value="{{ $oficio->id_oficios }}">{{ $oficio->nombre_oficio }}</option>
                    @endforeach
                </select>
            </div>
            

            <div class="mb-4">
                <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                <textarea name="descripcion" id="descripcion" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
            </div>

            <div class="mb-4">
                <label for="monto" class="block text-sm font-medium text-gray-700">Monto (opcional)</label>
                <input type="number" name="monto" id="monto" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded-md hover:bg-orange-600">
                Publicar Problema
            </button>
        </form>
    </div>
</x-app-layout>
