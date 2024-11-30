<x-layout bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.sidebar activePage="user-management"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="User Management"></x-navbars.navs.auth>
        <!-- End Navbar -->

        <!-- Mensaje de éxito -->
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <strong>¡Éxito!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="container mt-4">
            <!-- Título -->
            <div class="card mb-4">
                <div class="card-header bg-gradient-warning text-white text-center py-3">
                    <h4 class="mb-0">Detalles del {{ $rol }}</h4>
                </div>
                <div class="card-body">
                    <!-- Información General -->
                    @if ($usuario->nom_cliente || $usuario->nombres)
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <p><strong>Nombre:</strong> {{ $usuario->nombres ?? $usuario->nom_cliente }} {{ $usuario->apellidos ?? $usuario->ape_cliente }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>DNI:</strong> {{ $usuario->dni ?? 'No definido' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Teléfono:</strong> {{ $usuario->telefono ?? ($usuario->telefo_cliente ?? 'No definido') }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Sexo:</strong> {{ $usuario->sexo == 'M' ? 'Masculino' : ($usuario->sexo == 'F' ? 'Femenino' : 'No definido') }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Correo:</strong> {{ optional($usuario->users)->email ?? 'No definido' }}</p>
                        </div>
                    </div>
                    @else
                    <p class="text-center text-muted">Este {{ strtolower($rol) }} aún no registra sus datos.</p>
                    @endif

                    <!-- Ubicación (Solo para Clientes) -->
                    @if ($rol === 'Cliente')
                    <h5 class="text-primary mb-3">Ubicación</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Dirección:</strong> {{ optional($usuario->ubicacion)->direccion ?? 'No definida' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Distrito:</strong> {{ optional($usuario->ubicacion)->distrito ?? 'No definido' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Ciudad:</strong> {{ optional($usuario->ubicacion)->ciudad ?? 'No definida' }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Sección: Antecedentes y Certificados (Solo para Trabajadores) -->
            @if ($rol === 'Trabajador')
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header bg-gradient-warning text-white">
                            <h5 class="mb-0">Antecedentes</h5>
                        </div>
                        <div class="card-body">
                            @forelse ($usuario->antecedentes as $antecedente)
                            <p><strong>Documento:</strong> {{ $antecedente->documento_antecedente ?? 'No definido' }}</p>
                            <p><strong>Estado:</strong> {{ optional($antecedente->estado)->nombre_estado ?? 'No definido' }}</p>
                            <hr>
                            @empty
                            <p class="text-muted">No tiene antecedentes registrados.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header bg-gradient-warning text-white">
                            <h5 class="mb-0">Certificados</h5>
                        </div>
                        <div class="card-body">
                            @forelse ($usuario->certificados as $certificado)
                            <p><strong>Documento:</strong> {{ $certificado->documento_certificado ?? 'No definido' }}</p>
                            <p><strong>Estado:</strong> {{ optional($certificado->estado)->nombre_estado ?? 'No definido' }}</p>
                            <hr>
                            @empty
                            <p class="text-muted">No tiene certificados registrados.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="mt-5">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered align-middle">
                        <thead class="bg-gradient-warning text-white">
                            <tr>
                                <th class="text-center">Tipo</th>
                                <th class="text-center">Estado Actual</th>
                                <th class="text-center">Actualizar Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Fila para Antecedentes -->
                            @forelse ($usuario->antecedentes as $antecedente)
                            <tr>
                                <td class="text-center align-middle"><strong>Antecedente</strong></td>
                                <td class="text-center align-middle">
                                    <span class="badge bg-{{ optional($antecedente->estado)->color_class ?? 'secondary' }}">
                                        {{ optional($antecedente->estado)->nombre_estado ?? 'No definido' }}
                                    </span>
                                </td>
                                <td class="align-middle">
                                    <form action="{{ route('administrador.actualizar.estado', ['id' => $antecedente->id_antecedentes]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="tipo" value="antecedente">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <select name="estado_id" class="form-select me-3 w-auto">
                                                <option value="">Seleccione</option>
                                                @foreach ($estadosAntecedentes as $estado)
                                                <option value="{{ $estado->id_estado_antecedentes }}"
                                                    {{ $estado->id_estado_antecedentes == optional($antecedente->estado)->id_estado_antecedentes ? 'selected' : '' }}>
                                                    {{ $estado->nombre_estado }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="btn btn-warning">
                                                <i class="material-icons">save</i> Guardar
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted">No tiene antecedentes registrados.</td>
                            </tr>
                            @endforelse

                            <!-- Fila para Certificados -->
                            @forelse ($usuario->certificados as $certificado)
                            <tr>
                                <td class="text-center align-middle"><strong>Certificado</strong></td>
                                <td class="text-center align-middle">
                                    <span class="badge bg-{{ optional($certificado->estado)->color_class ?? 'secondary' }}">
                                        {{ optional($certificado->estado)->nombre_estado ?? 'No definido' }}
                                    </span>
                                </td>
                                <td class="align-middle">
                                    <form action="{{ route('administrador.actualizar.estado', ['id' => $certificado->id_certificados]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="tipo" value="certificado">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <select name="estado_id" class="form-select me-3 w-auto">
                                                <option value="">Seleccione</option>
                                                @foreach ($estadosCertificados as $estado)
                                                <option value="{{ $estado->id_estado_certificados }}"
                                                    {{ $estado->id_estado_certificados == optional($certificado->estado)->id_estado_certificados ? 'selected' : '' }}>
                                                    {{ $estado->nombre_estado }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="btn btn-warning">
                                                <i class="material-icons">save</i> Guardar
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted">No tiene certificados registrados.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>


            <!-- Botones de Acción -->
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('admin.usuarios.index') }}" class="btn btn-warning text-white px-4 py-2">
                    <i class="material-icons me-2">arrow_back</i>Regresar
                </a>

                @if (in_array(optional($usuario->users)->id_roles, [2, 3]))
                <form action="{{ route('administrador.usuario.cambiarEstado', ['id' => optional($usuario->users)->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="d-flex align-items-center">
                        <select name="id_estado_users" class="form-select me-3 w-auto">
                            <option value="">Seleccione</option>
                            @foreach ($estados as $estado)
                            <option value="{{ $estado->id_estado_users }}" {{ $usuario->id_estado_users == $estado->id_estado_users ? 'selected' : '' }}>
                                {{ $estado->nombre_estado }}
                            </option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-warning text-white px-4 py-2">
                            Aplicar Cambio
                        </button>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </main>
</x-layout>
