
<x-app-layout>

    @php
    $trabajadorDetails = App\Models\Trabajadores::where('id_usuario',auth()->id())->first();
    @endphp

@if($trabajadorDetails)
    <div class="text-center text-green-600">
        <p>Ya has registrado tus datos. No es necesario que completes este formulario nuevamente.</p>
    </div>
@else
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registro de Usuario') }}
        </h2>
    </x-slot>

    <!-- Formulario -->
    <div class="flex justify-center items-center min-h-screen bg-gray-100" x-data="{ showModal: false }">
        <div class="w-full max-w-md bg-white shadow-md rounded-md p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Formulario de Registro</h1>
            <form id="registro-form" method="POST" action="{{ route('trabajadores.store') }}" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <!-- DNI -->
                <div>
                    <label for="dni" class="block text-sm font-medium text-gray-700">DNI</label>
                    <input type="text" id="dni" name="dni" maxlength="8" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <!-- Nombres -->
                <div>
                    <label for="nombres" class="block text-sm font-medium text-gray-700">Nombres</label>
                    <input type="text" id="nombres" name="nombres" maxlength="50" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <!-- Apellidos -->
                <div>
                    <label for="apellidos" class="block text-sm font-medium text-gray-700">Apellidos</label>
                    <input type="text" id="apellidos" name="apellidos" maxlength="50" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            
                <!-- Teléfono -->
                <div>
                    <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
                    <input type="tel" id="telefono" name="telefono" maxlength="9" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            
                <!-- Sexo -->
                <div>
                    <label for="sexo" class="block text-sm font-medium text-gray-700">Sexo</label>
                    <select id="sexo" name="sexo" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="" disabled selected>Selecciona una opción</option>
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                    </select>
                </div>
                <!--Seleccion de oficios-->
                <div>
                    <label for="oficios" class="block text-sm font-medium text-gray-700">Seleccionar Oficios</label>
                    <div id="oficios" class="mt-2 space-y-2">
                        @foreach($oficios as $oficio)
                        <div class="flex items-center">
                            <input type="checkbox" id="oficio-{{ $oficio->id_oficios }}" name="oficios[]" value="{{ $oficio->id_oficios }}"
                                class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                            <label for="oficio-{{ $oficio->id_oficios }}" class="ml-2 block text-sm text-gray-700">
                                {{ $oficio->nombre_oficio }}
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Dirección -->
                <div>
                    <label for="direccion" class="block text-sm font-medium text-gray-700">Dirección</label>
                    <input type="text" id="direccion" name="direccion" maxlength="255" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            
                <!-- Distrito -->
                <div>
                    <label for="distrito" class="block text-sm font-medium text-gray-700">Distrito</label>
                    <input type="text" id="distrito" name="distrito" maxlength="100" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            
                <!-- Ciudad -->
                <div>
                    <label for="ciudad" class="block text-sm font-medium text-gray-700">Ciudad</label>
                    <input type="text" id="ciudad" name="ciudad" maxlength="100" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                
            
                <!-- Antecedente (PDF) -->
                <div>
                    <label for="antecedente" class="block text-sm font-medium text-gray-700">Subir Antecedente (PDF)</label>
                    <input type="file" id="antecedente" name="antecedente" accept=".pdf" required
                        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                        @error('antecedente')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                </div>
            
                <!-- Certificado (PDF) -->
                <div>
                    <label for="certificado" class="block text-sm font-medium text-gray-700">Subir Certificado (PDF)</label>
                    <input type="file" id="certificado" name="certificado" accept=".pdf" 
                        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                        @error('antecedente')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                </div>
                <div class="mt-6">
                    <!-- Botón para abrir el modal -->
                    <button type="button" @click="showModal = true"
                        class="w-full bg-indigo-600 text-white font-semibold py-2 px-4 rounded-md shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        Registrar
                    </button>
                </div>
            </form>
        </div>

       <!-- Modal de Confirmación -->
        <div x-show="showModal" 
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90"
            class="fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-75">
        <div class="bg-white rounded-lg shadow-lg w-96 p-6" @click.away="showModal = false">
            <!-- Contenido del modal -->
            <h2 class="text-lg font-semibold text-gray-800">Confirmar Envío</h2>
            <p class="text-sm text-gray-600 mt-2">¿Estás seguro de que deseas enviar este formulario con los datos proporcionados?</p>
        <!-- Previsualización de los datos -->
        <div class="mt-4 space-y-2">
            <p><strong>DNI:</strong> <span id="dni-preview"></span></p>
            <p><strong>Nombres:</strong> <span id="nombres-preview"></span></p>
            <p><strong>Apellidos:</strong> <span id="apellidos-preview"></span></p>
            <p><strong>Teléfono:</strong> <span id="telefono-preview"></span></p>
        </div>
        <div class="flex justify-end mt-6">
        <!-- Botón Cancelar -->
            <button @click="showModal = false"
                class="bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded-md mr-2 hover:bg-gray-400 focus:outline-none">
                Cancelar
            </button>
            <!-- Botón Confirmar -->
            <button @click="document.getElementById('registro-form').submit()"
                class="bg-indigo-600 text-white font-semibold py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none">
                    Confirmar y Enviar
            </button>
            </div>
        </div>
    </div>

    </div>

    <!-- Script para sincronizar valores al modal -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const dniField = document.getElementById('dni');
            const nombresField = document.getElementById('nombres');
            const apellidosField = document.getElementById('apellidos');
            const telefonoField = document.getElementById('telefono');

            dniField.addEventListener('input', function () {
                document.getElementById('dni-preview').textContent = dniField.value;
            });

            nombresField.addEventListener('input', function () {
                document.getElementById('nombres-preview').textContent = nombresField.value;
            });
            apellidosField.addEventListener('input', function () {
                document.getElementById('apellidos-preview').textContent = apellidosField.value;
            });

            telefonoField.addEventListener('input', function () {
                document.getElementById('telefono-preview').textContent = telefonoField.value;
            });
        });
    </script>
@endif
</x-app-layout>

