<x-app-layout>
<!-- Mensajes de Éxito o Información -->
@if (session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md mx-auto max-w-4xl text-center shadow-md" role="alert">
        <p class="font-semibold">{{ session('success') }}</p>
    </div>
@endif

@if (session('info'))
    <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4 mb-6 rounded-md mx-auto max-w-4xl text-center shadow-md" role="alert">
        <p class="font-semibold">{{ session('info') }}</p>
    </div>
@endif
<!-- Formulario -->
    <div class="flex justify-center items-center min-h-screen bg-gray-100 " x-data="{ showModal: false }">
        <div class="w-full max-w-md bg-white shadow-md rounded-md p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Formulario de Registro</h1>
            <form id="registro-form" method="POST" action="{{ route('cliente.store') }}" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div>
                    <label for="dni" class="block text-sm font-medium text-gray-700">DNI</label>
                    <input type="text" id="dni" name="dni" maxlength="8" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>


                <div>
                    <label for="nom_cliente" class="block text-sm font-medium text-gray-700">Nombres</label>
                    <input type="text" id="nom_cliente" name="nom_cliente" maxlength="50" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <!-- Apellidos -->
                <div>
                    <label for="ape_cliente" class="block text-sm font-medium text-gray-700">Apellidos</label>
                    <input type="text" id="ape_cliente" name="ape_cliente" maxlength="50" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <!-- Teléfono -->
                <div>
                    <label for="telefo_cliente" class="block text-sm font-medium text-gray-700">Teléfono</label>
                    <input type="text" id="telefo_cliente" name="telefo_cliente" maxlength="9" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <!-- Provincia -->
                <div>
                    <label for="ciudad" class="block text-sm font-medium text-gray-700">Provincia</label>
                    <input type="text" id="ciudad" name="ciudad" maxlength="50" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                 <!-- Distrito -->
                <div>
                    <label for="distrito" class="block text-sm font-medium text-gray-700">Distrito</label>
                    <input type="text" id="distrito" name="distrito" maxlength="50" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <!-- Dirección -->
                <div>
                    <label for="direccion" class="block text-sm font-medium text-gray-700">Dirección</label>
                    <input type="text" id="direccion" name="direccion" maxlength="50" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:bg-orange-500  sm:text-sm">
                 </div>

                <!-- Sexo -->
                <div>
                    <label for="sexo" class="block text-sm font-medium text-gray-700">Sexo</label>
                    <select id="sexo" name="sexo" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm">
                        <option value="" disabled selected>Selecciona una opción</option>
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                    </select>
                </div>

                <div class="mt-6">
                    <!-- Botón para abrir el modal -->
                    <button type="button" @click="showModal = true"
                        class="w-full bg-orange-500 text-white font-semibold py-2 px-4 rounded-md shadow hover:bg-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-500">
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
            <p><strong>Nombres:</strong> <span id="nom_cliente-preview"></span></p>
            <p><strong>Apellidos:</strong> <span id="ape_cliente-preview"></span></p>
            <p><strong>Teléfono:</strong> <span id="telefo_cliente-preview"></span></p>
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
            const nombresField = document.getElementById('nom_cliente');
            const apellidosField = document.getElementById('ape_cliente');
            const telefonoField = document.getElementById('telefo_cliente');

            dniField.addEventListener('input', function () {
                document.getElementById('dni-preview').textContent = dniField.value;
            });

            nombresField.addEventListener('input', function () {
                document.getElementById('nom_cliente-preview').textContent = nombresField.value;
            });
            apellidosField.addEventListener('input', function () {
                document.getElementById('ape_cliente-preview').textContent = apellidosField.value;
            });

            telefonoField.addEventListener('input', function () {
                document.getElementById('telefo_cliente-preview').textContent = telefonoField.value;
            });
        });
    </script>

</x-app-layout>

