<x-app-layout>
    <!-- Mensaje de éxito -->
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">¡Éxito!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20">
                    <title>Cerrar</title>
                    <path
                        d="M14.348 5.652a1 1 0 00-1.414 0L10 8.586 7.066 5.652a1 1 0 10-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 101.414 1.414L10 11.414l2.934 2.934a1 1 0 001.414-1.414L11.414 10l2.934-2.934a1 1 0 000-1.414z" />
                </svg>
            </span>
        </div>
        <script>
            document.querySelectorAll('[role="button"]').forEach(button => {
                button.addEventListener('click', () => {
                    button.parentElement.parentElement.style.display = 'none';
                });
            });
        </script>
    @endif
    <div class="grid grid-cols-2 grid-rows-[auto,auto] gap-4 h-screen max-w-screen-lg mx-auto p-6">
        <!-- Sección: Información General -->
        <div class=" items-center bg-gray-100 shadow-md rounded-lg p-6 h-full">
            <div class=" bg-gray-100 p-6 rounded">
                <h1 class="text-2xl font-bold mb-6 text-gray-800 text-center">Detalles del {{ $rol }}</h1>

                @if ($usuario->nom_cliente || $usuario->nombres)
                    <h2 class="text-xl font-semibold text-gray-700 mb-4">Información General</h2>
                    <div class="grid grid-cols-2 gap-4">
                        <p><strong class="text-gray-600">Nombre:</strong>
                            {{ $usuario->nombres ?? $usuario->nom_cliente }}
                            {{ $usuario->apellidos ?? $usuario->ape_cliente }}</p>
                        <p><strong class="text-gray-600">DNI:</strong> {{ $usuario->dni ?? 'No definido' }}</p>
                        <p><strong class="text-gray-600">Teléfono:</strong>
                            {{ $usuario->telefono ?? ($usuario->telefo_cliente ?? 'No definido') }}</p>
                        <p><strong class="text-gray-600">Sexo:</strong>
                            {{ $usuario->sexo == 'M' ? 'Masculino' : ($usuario->sexo == 'F' ? 'Femenino' : 'No definido') }}
                        </p>
                        <p><strong class="text-gray-600">Correo:</strong>
                            {{ optional($usuario->users)->email ?? 'No definido' }}</p>
                    </div>
                @else
                    <p class="text-gray-500 text-center">Este {{ strtolower($rol) }} aún no registra sus datos.</p>
                @endif
            </div>

            <!-- Sección: Ubicación (Solo para Clientes) -->
            @if ($rol === 'Cliente')
                <div class="bg-gray-100 p-6 rounded">
                    <h2 class="text-xl font-semibold text-gray-700 mb-4">Ubicación</h2>
                    <div class="grid grid-cols-2 gap-4">
                        <p><strong class="text-gray-600">Dirección:</strong>
                            {{ optional($usuario->ubicacion)->direccion ?? 'No definida' }}</p>
                        <p><strong class="text-gray-600">Distrito:</strong>
                            {{ optional($usuario->ubicacion)->distrito ?? 'No definido' }}</p>
                        <p><strong class="text-gray-600">Ciudad:</strong>
                            {{ optional($usuario->ubicacion)->ciudad ?? 'No definida' }}</p>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="bg-gray-100 shadow-md rounded-lg p-6 h-full">
        <!-- Sección: Antecedentes y Certificados (Solo para Trabajadores) -->
        @if ($rol === 'Trabajador')
            <div class="grid grid-cols-2 gap-4">
                <!-- Columna Izquierda: Detalles de Antecedentes y Certificados -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold text-gray-700 mb-4">Detalles</h2>
                    <h3 class="text-lg font-semibold text-gray-600 mb-2">Antecedentes</h3>
                    @forelse ($usuario->antecedentes as $antecedente)
                        <p><strong class="text-gray-600">Documento:</strong>
                            {{ $antecedente->documento_antecedente ?? 'No definido' }}</p>
                        <p><strong class="text-gray-600">Estado:</strong>
                            {{ optional($antecedente->estado)->nombre_estado ?? 'No definido' }}</p>
                    @empty
                        <p class="text-gray-500">No tiene antecedentes registrados.</p>
                    @endforelse

                    <h3 class="text-lg font-semibold text-gray-600 mt-4">Certificados</h3>
                    @forelse ($usuario->certificados as $certificado)
                        <p><strong class="text-gray-600">Documento:</strong>
                            {{ $certificado->documento_certificado ?? 'No definido' }}</p>
                        <p><strong class="text-gray-600">Estado:</strong>
                            {{ optional($certificado->estado)->nombre_estado ?? 'No definido' }}</p>
                    @empty
                        <p class="text-gray-500">No tiene certificados registrados.</p>
                    @endforelse
                </div>

                <!-- Columna Derecha: Tabla para Gestión de Estados -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold text-gray-700 mb-4">Gestión de Estados</h2>
                    <table class="min-w-full bg-white border border-gray-300">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="px-4 py-2 border text-left text-gray-700">Tipo</th>
                                <th class="px-4 py-2 border text-left text-gray-700">Estado Actual</th>
                                <th class="px-4 py-2 border text-left text-gray-700">Actualizar Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Fila para Antecedentes -->
                            @forelse ($usuario->antecedentes as $antecedente)
                                <tr class="border-t">
                                    <td class="px-4 py-2 text-gray-600">Antecedente</td>
                                    <td class="px-4 py-2 text-gray-600">
                                        {{ optional($antecedente->estado)->nombre_estado ?? 'No definido' }}
                                    </td>
                                    <td class="px-4 py-2">
                                        <form
                                            action="{{ route('administrador.actualizar.estado', ['id' => $antecedente->id_antecedentes]) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <!-- Tipo de entidad -->
                                            <input type="hidden" name="tipo" value="antecedente">
                                            <select name="estado_id"
                                                class="rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                                <option value="">Seleccione</option>
                                                @foreach ($estadosAntecedentes as $estado)
                                                    <option value="{{ $estado->id_estado_antecedentes }}"
                                                        {{ $estado->id_estado_antecedentes == optional($antecedente->estado)->id_estado_antecedentes ? 'selected' : '' }}>
                                                        {{ $estado->nombre_estado }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <button type="submit"
                                                class="ml-2 bg-orange-500 text-white px-4 py-2 rounded shadow hover:bg-blue-700">
                                                Guardar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-4 py-2 text-gray-500 text-center">No tiene antecedentes registrados.</td>
                                </tr>
                            @endforelse

                            <!-- Fila para Certificados -->
                            @forelse ($usuario->certificados as $certificado)
                                <tr class="border-t">
                                    <td class="px-4 py-2 text-gray-600">Certificado</td>
                                    <td class="px-4 py-2 text-gray-600">
                                        {{ optional($certificado->estado)->nombre_estado ?? 'No definido' }}
                                    </td>
                                    <td class="px-4 py-2">
                                        <form
                                            action="{{ route('administrador.actualizar.estado', ['id' => $certificado->id_certificados]) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <!-- Tipo de entidad -->
                                            <input type="hidden" name="tipo" value="certificado">
                                            <select name="estado_id"
                                                class="rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                                <option value="">Seleccione</option>
                                                @foreach ($estadosCertificados as $estado)
                                                    <option value="{{ $estado->id_estado_certificados }}"
                                                        {{ $estado->id_estado_certificados == optional($certificado->estado)->id_estado_certificados ? 'selected' : '' }}>
                                                        {{ $estado->nombre_estado }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <button type="submit"
                                                class="ml-2 bg-orange-500 text-white px-4 py-2 rounded shadow hover:bg-blue-700">
                                                Guardar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-4 py-2 text-gray-500 text-center">No tiene certificados registrados.</td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>
            </div>
        @endif
    </div>


    </div>

    <!-- Inferior -->
    <div class="  bg-gray-100 shadow-md rounded-lg p-6 col-span-2">
        <!-- Botones de Acción -->
        <div class="  bg-gray-100 shadow-md rounded-lg p-6 h-full">
            <a href="{{ route('admin.usuarios.index') }}"
                class="inline-block bg-orange-500 text-white px-6 py-2 rounded shadow hover:bg-orange-600">
                Regresar
            </a>

            @if (in_array(optional($usuario->users)->id_roles, [2, 3])) <!-- Trabajador o Cliente -->
                <form
                    action="{{ route('administrador.usuario.cambiarEstado', ['id' => optional($usuario->users)->id]) }}"
                    method="POST" class="inline-block ml-4">
                    @csrf
                    @method('PUT')
                    <div class="flex items-center gap-2">
                        <label for="estado" class="text-sm font-medium text-gray-700">Estado</label>
                        <select name="id_estado_users" id="estado"
                            class="rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            <option value="">Seleccione </option>
                            @foreach ($estados as $estado)
                                <option value="{{ $estado->id_estado_users }}"
                                    {{ $usuario->id_estado_users == $estado->id_estado_users ? 'selected' : '' }}>
                                    {{ $estado->nombre_estado }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit"
                            class="bg-orange-500 text-white px-4 py-2 rounded shadow hover:bg-blue-700">
                            Aplicar Cambio
                        </button>
                    </div>
                </form>
            @endif
        </div>
    </div>
    </div>

    </div>
</x-app-layout>
