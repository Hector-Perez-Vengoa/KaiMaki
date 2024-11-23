<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Lista de Trabajadores</h1>

        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="border border-gray-300 px-4 py-2">Rol</th>
                    <th class="border border-gray-300 px-4 py-2">Nombre</th>
                    <th class="border border-gray-300 px-4 py-2">Apellidos</th>
                    <th class="border border-gray-300 px-4 py-2">Teléfono</th>
                    <th class="border border-gray-300 px-4 py-2">Correo</th>
                    <th class="border border-gray-300 px-4 py-2">Estado</th>
                    <th class="border border-gray-300 px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($trabajadores as $trabajador)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $trabajador->rol->nombre ?? 'No definido' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $trabajador->trabajadores->nombres ?? 'No definido' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $trabajador->trabajadores->apellidos ?? 'No definido' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $trabajador->trabajadores->telefono ?? 'No definido' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $trabajador->email }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $trabajador->estado->nombre_estado ?? 'No definido' }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('administrador.trabajador.show', ['id' => $trabajador->id]) }}" class="bg-yellow-500 text-white px-4 py-2 rounded shadow hover:bg-yellow-700">Ver</a>
                            <a href="{{ route('administrador.usuario.cambiarEstado', $trabajador->id) }}" 
                                class="bg-yellow-500 text-white px-4 py-2 rounded shadow hover:bg-yellow-700">
                                Cambiar Estado
                            </a>
                            
                            <a href="" class="bg-yellow-500 text-white px-4 py-2 rounded shadow hover:bg-yellow-700">Notificar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>





