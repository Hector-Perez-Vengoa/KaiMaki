<x-app-layout>

<div class="flex justify-center min-h-screen bg-gray-100 p-6">
    <div class="w-full max-w-6xl bg-white shadow-md rounded-lg p-6">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50 border-2">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre del Cliente</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Apellidos del Cliente</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha de Reserva</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descripción</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($solicitudes as $solicitud)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $solicitud->cliente->nom_cliente }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $solicitud->cliente->ape_cliente }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $solicitud->fech_reserva }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $solicitud->descripcion }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $solicitud->estado->nombre_estado }}</td>
                        <td class="px-6 py-4 whitespace-nowrap flex gap-2">
                            <!-- Botón para aceptar -->
                            <form action="{{ route('solicitudes.actualizarEstado', ['id_solicitud' => $solicitud->id_solicitudes, 'estado' => 2]) }}" method="POST" class="inline-block">
                                @csrf
                                <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded shadow">
                                    Aceptar
                                </button>
                            </form>

                            <form action="{{ route('solicitudes.actualizarEstado', ['id_solicitud' => $solicitud->id_solicitudes, 'estado' => 4]) }}" method="POST" class="inline-block">
                                @csrf
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded shadow">
                                    Cancelar
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


</x-app-layout>
