<!--<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Publicar un Problema') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-6">Publicar un Problema</h1>

                <form action="{{ route('problemas.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Oficio 
                    <div class="mb-4">
                        <label for="id_oficios" class="block text-sm font-medium text-gray-700">Selecciona un Oficio</label>
                        <select name="id_oficios" id="id_oficios" class="w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">Seleccionar un oficio</option>
                                @foreach($oficios as $oficio)
                                    <option value="{{ $oficio->id_oficios }}">{{ $oficio->nombre_oficio }}</option>
                                @endforeach


                        </select>
                    </div>

                    <!-- Descripción 
                    <div class="mb-4">
                        <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                        <textarea name="descripcion" id="descripcion" rows="4" class="w-full border-gray-300 rounded-md shadow-sm" placeholder="Describe tu problema..."></textarea>
                    </div>

                    <!-- Imagen 
                    <div class="mb-4">
                        <label for="imagen" class="block text-sm font-medium text-gray-700">Subir Imagen</label>
                        <input type="file" name="imagen" id="imagen" accept="image/*" class="w-full">
                    </div>

                    <!-- Monto 
                    <div class="mb-4">
                        <label for="monto" class="block text-sm font-medium text-gray-700">Monto Propuesto (opcional)</label>
                        <input type="number" name="monto" id="monto" step="0.01" class="w-full border-gray-300 rounded-md shadow-sm" placeholder="Ingresa un monto en USD">
                    </div>

                    <!-- Botón de Publicar 
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">
                        Publicar Problema
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>-->
