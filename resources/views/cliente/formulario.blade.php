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

        <div class="max-w-4xl mx-auto py-10 px-6 bg-white shadow-lg rounded-lg">
            <h2 class="text-3xl font-bold text-orange-600 text-center mb-8">Completa tu Registro de Cliente</h2>

            <form action="{{ route('cliente.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="flex flex-col items-start">
                    <label for="nom_cliente" class="block font-medium text-orange-800 mb-1">Nombres</label>
                    <input type="text" id="nom_cliente" name="nom_cliente" class="form-input w-full border-gray-300 rounded-md focus:border-orange-500 focus:ring focus:ring-orange-200 focus:ring-opacity-50" required>
                </div>

                <div class="flex flex-col items-start">
                    <label for="ape_cliente" class="block font-medium text-orange-800 mb-1">Apellidos</label>
                    <input type="text" id="ape_cliente" name="ape_cliente" class="form-input w-full border-gray-300 rounded-md focus:border-orange-500 focus:ring focus:ring-orange-200 focus:ring-opacity-50" required>
                </div>

                <div class="flex flex-col items-start">
                    <label for="telefo_cliente" class="block font-medium text-orange-800 mb-1">Teléfono</label>
                    <input type="text" id="telefo_cliente" name="telefo_cliente" maxlength="9" class="form-input w-full border-gray-300 rounded-md focus:border-orange-500 focus:ring focus:ring-orange-200 focus:ring-opacity-50">
                </div>

                <div class="flex flex-col items-start">
                    <label for="dni" class="block font-medium text-orange-800 mb-1">DNI</label>
                    <input type="text" id="dni" name="dni" maxlength="8" class="form-input w-full border-gray-300 rounded-md focus:border-orange-500 focus:ring focus:ring-orange-200 focus:ring-opacity-50" required>
                </div>

                <div class="flex flex-col items-start">
                    <label for="ciudad" class="block font-medium text-orange-800 mb-1">Provincia</label>
                    <input type="text" id="ciudad" name="ciudad" class="form-input w-full border-gray-300 rounded-md focus:border-orange-500 focus:ring focus:ring-orange-200 focus:ring-opacity-50" required>
                </div>

                <div class="flex flex-col items-start">
                    <label for="distrito" class="block font-medium text-orange-800 mb-1">Distrito</label>
                    <input type="text" id="distrito" name="distrito" class="form-input w-full border-gray-300 rounded-md focus:border-orange-500 focus:ring focus:ring-orange-200 focus:ring-opacity-50">
                </div>

                <div class="flex flex-col items-start">
                    <label for="direccion" class="block font-medium text-orange-800 mb-1">Dirección</label>
                    <input type="text" id="direccion" name="direccion" class="form-input w-full border-gray-300 rounded-md focus:border-orange-500 focus:ring focus:ring-orange-200 focus:ring-opacity-50" required>
                </div>

                <div class="flex flex-col items-start">
                    <label for="sexo" class="block font-medium text-orange-800 mb-1">Sexo</label>
                    <select id="sexo" name="sexo" class="form-select w-full border-gray-300 rounded-md focus:border-orange-500 focus:ring focus:ring-orange-200 focus:ring-opacity-50" required>
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                    </select>
                </div>

                <div class="text-center">
                    <button type="submit" class="bg-orange-500 text-white font-bold px-6 py-3 rounded-md hover:bg-orange-600 transition duration-300 shadow-md">
                        Registrar
                    </button>
                </div>
            </form>
        </div>
</x-app-layout>

