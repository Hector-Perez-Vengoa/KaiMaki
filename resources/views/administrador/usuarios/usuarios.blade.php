<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Lista de Usuarios</h1>
        <form action="{{ route('admin.usuarios.index') }}" method="GET" class="mb-4">
            <div class="flex items-center space-x-4">
                <!-- Filtro por Rol -->
                <div>
                    <label for="role" class="block text-sm font-medium">Rol</label>
                    <select name="role" id="role" class="form-select">
                        <option value="">Todos</option>
                        <option value="Admin" {{ request('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                        <option value="Trabajador" {{ request('role') == 'Trabajador' ? 'selected' : '' }}>Trabajador</option>
                        <option value="Cliente" {{ request('role') == 'Cliente' ? 'selected' : '' }}>Cliente</option>
                    </select>
                </div>

                <!-- Filtro por DNI -->
                <div>
                    <label for="dni" class="block text-sm font-medium">DNI</label>
                    <input type="text" name="dni" id="dni" value="{{ request('dni') }}" class="form-input" placeholder="Buscar por DNI">
                </div>

                <!-- Botón de búsqueda -->
                <div>
                    <button type="submit" class="bg-orange-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                        Buscar
                    </button>
                </div>
            </div>
        </form>

        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 px-4 py-2">Rol</th>
                    <th class="border border-gray-300 px-4 py-2">DNI</th>
                    <th class="border border-gray-300 px-4 py-2">Nombre</th>
                    <th class="border border-gray-300 px-4 py-2">Correo</th>
                    <th class="border border-gray-300 px-4 py-2">Estado</th>
                    <th class="border border-gray-300 px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuariosPaginated as $usuario)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $usuario['rol'] }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $usuario['dni'] }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $usuario['nombre'] }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $usuario['correo'] }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <span class="inline-flex items-center">
                                @if ($usuario['estado'] === 'Activo')
                                <span style="width: 10px; height: 10px; background-color: green; display: inline-block; border-radius: 50%; margin-right: 8px;"></span>
                                        Activo
                                @elseif ($usuario['estado'] === 'Pendiente')
                                <span style="width: 10px; height: 10px; background-color: yellow; display: inline-block; border-radius: 50%; margin-right: 8px;"></span>
                                        Pendiente
                                @elseif ($usuario['estado'] === 'Suspendido')
                                <span style="width: 10px; height: 10px; background-color: red; display: inline-block; border-radius: 50%; margin-right: 8px;"></span>
                                        Suspendido
                                @else
                                    <span  style="width: 10px; height: 10px; background-color: gray; display: inline-block; border-radius: 50%; margin-right: 8px;"></span>
                                    No definido
                                @endif
                            </span>
                        </td>

                        <td class="border border-gray-300 px-4 py-2">
                            @if ($usuario['rol'] === 'Trabajador')
                                <a href="{{ route('administrador.usuario.show', ['id' => $usuario['id'], 'tipo' => 'trabajador']) }}"
                                   class="bg-yellow-500 text-white px-4 py-2 rounded shadow hover:bg-yellow-700">Ver</a>
                            @elseif ($usuario['rol'] === 'Cliente')
                                <a href="{{ route('administrador.usuario.show', ['id' => $usuario['id'], 'tipo' => 'cliente']) }}"
                                   class="bg-orange-500 text-white px-4 py-2 rounded shadow hover:bg-blue-700">Ver</a>
                            @else
                                <span class="text-gray-500">N/A</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Paginación -->
    <div class="mt-4 ">
            {{ $usuariosPaginated->links() }}
    </div>
    </div>
</x-app-layout>





