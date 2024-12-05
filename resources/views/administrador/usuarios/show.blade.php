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
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-header  text-white text-center py-2 rounded-top">
                            <h6 class="mb-0 fw-bold">Detalles del Trabajador</h6>

                        </div>
                        <div class="card-body">
                            @if ($usuario->nom_cliente || $usuario->nombres)
                            <div class="row g-2">
                                <div class="col-12">
                                    <p class="mb-1"><strong>Nombre:</strong> {{ $usuario->nombres ??
                                        $usuario->nom_cliente }} {{ $usuario->apellidos ?? $usuario->ape_cliente }}</p>
                                </div>
                                <div class="col-12">
                                    <p class="mb-1"><strong>DNI:</strong> {{ $usuario->dni ?? 'No definido' }}</p>
                                </div>
                                <div class="col-12">
                                    <p class="mb-1"><strong>Teléfono:</strong> {{ $usuario->telefono ??
                                        ($usuario->telefo_cliente ?? 'No definido') }}</p>
                                </div>
                                <div class="col-12">
                                    <p class="mb-1"><strong>Sexo:</strong> {{ $usuario->sexo == 'M' ? 'Masculino' :
                                        ($usuario->sexo == 'F' ? 'Femenino' : 'No definido') }}</p>
                                </div>
                                <div class="col-12">
                                    <p class="mb-1"><strong>Correo:</strong> {{ optional($usuario->users)->email ?? 'No
                                        definido' }}</p>
                                </div>
                            </div>
                            @else
                            <p class="text-center text-muted">Este trabajador aún no registra sus datos.</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- Antecedentes -->
                    <div class="card mb-3 shadow-sm">
                        <div class="card-header  text-center py-2 rounded-top">
                            <h6 class="mb-0 fw-bold">Antecedentes</h6>
                        </div>
                        <div class="card-body">
                            @forelse ($usuario->antecedentes as $antecedente)
                            <p class="mb-1"><strong>Documento:</strong> {{ $antecedente->documento_antecedente ?? 'No
                                definido' }}</p>
                            <p class="mb-1"><strong>Estado:</strong> {{ optional($antecedente->estado)->nombre_estado ??
                                'No definido' }}</p>
                            <hr class="my-2">
                            @empty
                            <p class="text-muted text-center">No tiene antecedentes registrados.</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- Certificados -->
                    <div class="card shadow-sm">
                        <div class="card-header text-white text-center py-2 rounded-top">
                            <h6 class="mb-0 fw-bold">Certificados</h6>
                        </div>
                        <div class="card-body">
                            @forelse ($usuario->certificados as $certificado)
                            <p class="mb-1"><strong>Documento:</strong> {{ $certificado->documento_certificado ?? 'No
                                definido' }}</p>
                            <p class="mb-1"><strong>Estado:</strong> {{ optional($certificado->estado)->nombre_estado ??
                                'No definido' }}</p>
                            <hr class="my-2">
                            @empty
                            <p class="text-muted text-center">No tiene certificados registrados.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered align-middle">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder ">
                                    Tipo
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder ">
                                    Estado Actual</th>
                                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolderps-2">
                                    Actualizar Estado</th>

                        </thead>
                        <tbody>
                            <!-- Fila para Antecedentes -->
                            @forelse ($usuario->antecedentes as $antecedente)
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <p class="mb-0 text-sm">Antecedente</p>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <span
                                                class="badge bg-{{ optional($antecedente->estado)->color_class ?? 'secondary' }}">
                                                {{ optional($antecedente->estado)->nombre_estado ?? 'No definido' }}
                                            </span>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <div class="d-flex flex-column justify-content-center">
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

                                    </div>
                                </td>
                                @empty

                                <td colspan="3" class="text-center text-muted">No tiene antecedentes registrados.</td>
                                @endforelse
                            </tr>
                            <!-- Fila para Certificados -->
                            @forelse ($usuario->certificados as $certificado)
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <p class="mb-0 text-sm">Certificado</p>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <span
                                                class="badge bg-{{ optional($certificado->estado)->color_class ?? 'secondary' }}">
                                                {{ optional($certificado->estado)->nombre_estado ?? 'No definido' }}
                                            </span>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <div class="d-flex flex-column justify-content-center">
                                        <form
                                            action="{{ route('administrador.actualizar.estado', ['id' => $certificado->id_certificados]) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="tipo" value="certificado">
                                            <div class="d-flex justify-content-center align-items-center">
                                                <select name="estado_id" class="form-select me-3 w-auto">
                                                    <option value="">Seleccione</option>
                                                    @foreach ($estadosCertificados as $estado)
                                                    <option value="{{ $estado->id_estado_certificados }}" {{ $estado->
                                                        id_estado_certificados ==
                                                        optional($certificado->estado)->id_estado_certificados ?
                                                        'selected' : '' }}>
                                                        {{ $estado->nombre_estado }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                <button type="submit" class="btn btn-warning">
                                                    <i class="material-icons">save</i> Guardar
                                                </button>
                                            </div>
                                        </form>

                                    </div>
                                </td>
                                @empty

                                <td colspan="3" class="text-center text-muted">No tiene certificado registrado.</td>
                                @endforelse
                            </tr>

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
                <form
                    action="{{ route('administrador.usuario.cambiarEstado', ['id' => optional($usuario->users)->id]) }}"
                    method="POST">
                    @csrf
                    @method('PUT')
                    <div class="d-flex align-items-center">
                        <select name="id_estado_users" class="form-select me-3 w-auto">
                            <option value="">Seleccione</option>
                            @foreach ($estados as $estado)
                            <option value="{{ $estado->id_estado_users }}" {{ $usuario->id_estado_users ==
                                $estado->id_estado_users ? 'selected' : '' }}>
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
