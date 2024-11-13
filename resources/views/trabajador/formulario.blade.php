

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registro de Usuario') }}
        </h2>
    </x-slot>


        <div class="flex justify-center items-center min-h-screen bg-gray-100">
            <div class="w-full max-w-md bg-white shadow-md rounded-md p-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Formulario de Registro</h1>
                <form action="#" method="POST" class="space-y-4">
                    <!-- DNI -->
                    <div>
                        <label for="dni" class="block text-sm font-medium text-gray-700">DNI</label>
                        <input type="text" id="dni" name="dni" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
        
                    <!-- Nombres -->
                    <div>
                        <label for="nombres" class="block text-sm font-medium text-gray-700">Nombres</label>
                        <input type="text" id="nombres" name="nombres" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
        
                    <!-- Apellidos -->
                    <div>
                        <label for="apellidos" class="block text-sm font-medium text-gray-700">Apellidos</label>
                        <input type="text" id="apellidos" name="apellidos" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
        
                    <!-- Teléfono -->
                    <div>
                        <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
                        <input type="tel" id="telefono" name="telefono" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
        
                    <!-- Sexo -->
                    <div>
                        <label for="sexo" class="block text-sm font-medium text-gray-700">Sexo</label>
                        <select id="sexo" name="sexo" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="" disabled selected>Selecciona una opción</option>
                            <option value="masculino">Masculino</option>
                            <option value="femenino">Femenino</option>
                            <option value="otro">Otro</option>
                        </select>
                    </div>
        
                    <!-- Antecedentes -->
                    <div>
                        <label for="antecedentes" class="block text-sm font-medium text-gray-700">Antecedentes</label>
                        <textarea id="antecedentes" name="antecedentes" rows="3" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            placeholder="Escribe los antecedentes aquí..."></textarea>
                    </div>
        
                    <!-- Ubicación -->
                    <div>
                        <label for="ubicacion" class="block text-sm font-medium text-gray-700">Ubicación</label>
                        <input type="text" id="ubicacion" name="ubicacion" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            placeholder="Ciudad o dirección completa">
                    </div>
        
                    <!-- Botón Enviar -->
                    <div class="mt-6">
                        <button type="submit"
                            class="w-full bg-indigo-600 text-white font-semibold py-2 px-4 rounded-md shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            Enviar
                        </button>
                    </div>
                </form>
            </div>
        </div>
        



</x-app-layout>
