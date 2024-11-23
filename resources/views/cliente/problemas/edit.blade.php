<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Problema') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Editar Problema</h3>
                <form action="{{ route('problemas.update', $problema->id_problemas) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Oficio -->
                    <div class="mb-4">
                        <label for="id_oficios" class="block text-gray-700">Oficio</label>
                        <select name="id_oficios" id="id_oficios" class="w-full border rounded p-2">
                            @foreach($oficios as $oficio)
                                <option value="{{ $oficio->id_oficios }}" 
                                    {{ $problema->id_oficios == $oficio->id_oficios ? 'selected' : '' }}>
                                    {{ $oficio->nombre_oficio }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Descripción -->
                    <div class="mb-4">
                        <label for="descripcion" class="block text-gray-700">Descripción</label>
                        <textarea name="descripcion" id="descripcion" class="w-full border rounded p-2">{{ $problema->descripcion }}</textarea>
                    </div>

                    <!-- Monto -->
                    <div class="mb-4">
                        <label for="monto" class="block text-gray-700">Monto</label>
                        <input type="text" name="monto" id="monto" value="{{ $problema->monto }}" class="w-full border rounded p-2">
                    </div>

                    <button type="submit" class="bg-indigo-500 text-white px-4 py-2 rounded shadow hover:bg-indigo-700">
                        Guardar Cambios
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
