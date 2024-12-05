<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mis Problemas Publicados') }}
        </h2>
    </x-slot>

    <!-- Barra para publicar un problema -->
    <div class="bg-gray-100 p-4 rounded-md shadow-md mb-6 ">
        <!-- Contenedor centrado en la pantalla -->
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">

            <!-- Flexbox para alinear el contenido en el centro -->
            <div class="flex items-center justify-center">
                <!-- Contenedor del input con flex-1 para que ocupe todo el espacio -->
                <div class="flex-1">
                    <input 
                        type="text" 
                        placeholder="¿Qué problema tienes?" 
                        class="w-full border border-gray-300 rounded-md shadow-sm px-4 py-2 cursor-pointer"
                        readonly
                        id="openModal"
                    />
                </div>
            </div>
        </div>
    </div>
    

    <!-- Modal para publicar un problema -->
    <div id="publishModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 w-11/12 md:w-2/3 lg:w-1/2">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Publicar un Problema</h2>
                <button id="closeModal" class="text-gray-500 hover:text-black">&times;</button>
            </div>

            <form action="{{ route('problemas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Oficio -->
                <div class="mb-4">
                    <label for="id_oficios" class="block text-sm font-medium text-gray-700">Selecciona un Oficio</label>
                    <select name="id_oficios" id="id_oficios" class="w-full border-gray-300 rounded-md shadow-sm">
                        <option value="">Seleccionar un oficio</option>
                        @foreach($oficios as $oficio)
                            <option value="{{ $oficio->id_oficios }}">{{ $oficio->nombre_oficio }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Descripción -->
                <div class="mb-4">
                    <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                    <textarea name="descripcion" id="descripcion" rows="4" class="w-full border-gray-300 rounded-md shadow-sm" placeholder="Describe tu problema..."></textarea>
                </div>

                <!-- Imagen -->
                <div class="mb-4">
                    <label for="imagen" class="block text-sm font-medium text-gray-700">Subir Imagen</label>
                    <div class="flex items-center">
                        <label class="cursor-pointer flex items-center">
                            <input type="file" name="imagen" id="imagen" accept="image/*" class="hidden">
                            <i class="fas fa-image text-blue-500 text-2xl"></i>
                            <span class="ml-2 text-sm text-gray-600">Subir imagen</span>
                        </label>
                    </div>
                </div>

                <!-- Monto -->
                <div class="mb-4">
                    <label for="monto" class="block text-sm font-medium text-gray-700">Monto Propuesto (opcional)</label>
                    <input type="number" name="monto" id="monto" step="0.01" class="w-full border-gray-300 rounded-md shadow-sm" placeholder="Ingresa un monto en USD">
                </div>

                <!-- Urgencia -->
                <div class="mb-4 flex items-center">
                    <input type="checkbox" name="urgente" id="urgente" value="1" class="mr-2">
                    <label for="urgente" class="text-sm font-medium text-gray-700">Marcar como urgente</label>
                </div>                

                <!-- Botón de Publicar -->
                <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded-md hover:bg-green-600">
                    Publicar Problema
                </button>
            </form>
        </div>
    </div>

    <!-- Lista de Problemas -->
    <div class="py-6">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">

            @if($problemas->isEmpty())
                <p class="text-gray-500">No tienes problemas publicados.</p>
            @else
            @foreach ($problemas as $problema)
            <div class="shadow-md rounded-md mb-6 p-4 {{ $problema->estadoProblema->nombre_estado == 'Urgente' ? 'bg-red-400 border-red-600 border-2' : 'bg-white' }}">
                @if ($problema->estadoProblema->nombre_estado == 'Urgente')
                    <!-- Texto "Urgente" -->
                    <div class="text-white bg-red-600 rounded-md px-2 py-1 w-max text-sm font-bold uppercase mb-2">
                        Urgente
                    </div>
                @endif
        
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-bold">{{ $problema->oficio->nombre_oficio }}</h3>
                        <p class="text-sm text-gray-400">{{ $problema->created_at->format('d/m/Y') }}</p>
                    </div>
                    <div class="relative">
                        <button class="text-gray-500 hover:text-black">
                            &#x22EE; <!-- Icono de 3 puntos -->
                        </button>
                        <div class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg hidden">
                            <a href="{{ route('problemas.edit', $problema->id_problemas) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Editar</a>
                            <form action="{{ route('problemas.destroy', $problema->id_problemas) }}" method="POST" class="block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-gray-100">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
        
                <p class="text-gray-700 mt-4">{{ $problema->descripcion }}</p>
        
                @if ($problema->imagen)
                    <img src="{{ asset('storage/' . $problema->imagen) }}" 
                        alt="Imagen del problema" 
                        class="mt-4 rounded-md object-cover w-full h-48">
           
                @endif
        
                <div class="flex justify-between items-center mt-4">
                    <span class="text-gray-700">Monto inicial: {{ $problema->monto ?? 'No especificado' }}</span>
                    <a href="#" class="bg-orange-500 text-white px-4 py-2 rounded-md hover:bg-orange-600">
                        Negociar Monto
                    </a>
                    
                </div>
            </div>
        @endforeach        
            @endif
        </div>
    </div>

    <!-- Scripts para el modal -->
    <script>
        const openModal = document.getElementById('openModal');
        const closeModal = document.getElementById('closeModal');
        const publishModal = document.getElementById('publishModal');

        openModal.addEventListener('click', () => {
            publishModal.classList.remove('hidden');
        });

        closeModal.addEventListener('click', () => {
            publishModal.classList.add('hidden');
        });

        window.addEventListener('click', (e) => {
            if (e.target === publishModal) {
                publishModal.classList.add('hidden');
            }
        });
    </script>
</x-app-layout>
