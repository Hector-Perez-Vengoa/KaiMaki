<x-app-layout>

  <form action="{{ route('trabajadores.store') }}" method="POST" class="space-y-4">
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
    <!-- Botón Enviar -->
    <div class="mt-6">
        <button type="submit"
            class="w-full bg-indigo-600 text-white font-semibold py-2 px-4 rounded-md shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            Registrar
        </button>
    </div>
</form>


</x-app-layout>