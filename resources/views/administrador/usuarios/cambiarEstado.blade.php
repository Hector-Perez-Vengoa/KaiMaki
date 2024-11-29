<x-app-layout>
    <div class="max-w-2xl mx-auto bg-white shadow-lg rounded-lg p-6 mt-8">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6 border-b pb-4">Cambiar Estado del Usuario</h1>

        <!-- Información del Usuario -->
        <div class="mb-6">
            <p class="text-lg font-medium text-gray-700 mb-2">
                <span class="font-semibold">Usuario:</span> 
                <span class="text-gray-900">{{ $usuario->name }}</span> 
                <span class="text-gray-500">({{ $usuario->email }})</span>
            </p>
            <p class="text-lg font-medium text-gray-700">
                <span class="font-semibold">Estado Actual:</span> 
                <span class="text-gray-900">{{ $usuario->estado->nombre_estado ?? 'Sin estado definido' }}</span>
            </p>
        </div>

        <!-- Formulario para Cambiar Estado -->
        <form action="{{ route('administrador.usuario.actualizarEstado', $usuario->id) }}" method="POST">
            @csrf
            <div class="mb-6">
                <label for="id_estado_users" class="block text-lg font-medium text-gray-700 mb-2">Seleccionar Nuevo Estado</label>
                <select name="id_estado_users" id="id_estado_users" 
                    class="block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    <option value="" disabled selected>-- Selecciona un estado --</option>
                    @foreach($estados as $estado)
                        <option value="{{ $estado->id_estado_users }}" {{ $usuario->id_estado_users == $estado->id_estado_users ? 'selected' : '' }}>
                            {{ $estado->nombre_estado }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Botón de Enviar -->
            <div class="flex justify-end">
                <button type="submit" 
                    class="bg-indigo-500 text-white px-4 py-2 rounded shadow hover:bg-indigo-700">
                    Actualizar Estado
                </button>
            </div>
        </form>
    </div>
</x-app-layout>



