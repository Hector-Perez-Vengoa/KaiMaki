<x-app-layout>
    <div class="container mx-auto mt-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Sección: Formulario para Publicar Reclamos -->
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-lg font-bold text-gray-800 mb-4 border-b-2 border-orange-500 pb-2">Publicar Reclamo</h2>
                <!-- Mensaje de éxito -->
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('trabajador.reclamo.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="asunto" class="block text-sm font-medium text-gray-700">Asunto</label>
                        <input type="text" name="asunto" id="asunto" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-orange-500 focus:border-orange-500" required>
                    </div>
                    <div class="mb-4">
                        <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                        <textarea name="descripcion" id="descripcion" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-orange-500 focus:border-orange-500" required></textarea>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="px-4 py-2 bg-orange-500 text-white font-semibold rounded-md hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-400">
                            Publicar
                        </button>
                    </div>
                </form>
            </div>

             <!-- Sección: Reclamos Publicados -->
             <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-lg font-bold text-gray-800 mb-4 border-b-2 border-orange-500 pb-2">Se le contactara via Email</h2>
                @forelse ($reclamos as $reclamo)
                    <div class="mb-4 p-4 border border-gray-300 rounded-lg shadow-sm">
                        <h3 class="text-md font-semibold text-gray-800">{{ $reclamo->asunto }}</h3>
                        <p class="text-sm text-gray-600 mt-1">{{ $reclamo->descripcion }}</p>
                        <p class="text-sm text-gray-500 mt-1">

                        </p>
                        <p class="text-sm mt-2">
                            <span class="font-bold text-gray-800">Estado:</span>
                            <span class="px-2 py-1 rounded-md text-white
                                {{ $reclamo->estado->nombre_estado == 'Pendiente' ? 'bg-yellow-500' : ($reclamo->estado->nombre_estado == 'Resuelto' ? 'bg-green-500' : 'bg-red-500') }}">
                                {{ $reclamo->estado->nombre_estado }}
                            </span>
                        </p>
                    </div>
                @empty
                    <p class="text-gray-500">Aún no has publicado ningún reclamo.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>

