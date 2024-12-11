<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="user-management"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Gestion de Usuarios"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-3">
                            <div class=" shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-black text-center font-weight-bold">Lista de Usuarios</h6>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.usuarios.index') }}" method="GET" class="row">
                                    <!-- Filtro por Rol -->
                                    <div class="col-md-4 mb-3">
                                        <label for="role" class="form-label fw-bold text-primary">Seleccione Rol</label>
                                        <select name="role" id="role"
                                            class="form-select border-primary shadow-sm custom-selects-design">
                                            <option value="">Todos</option>
                                            <option value="Trabajador" {{ request('role')=='Trabajador' ? 'selected'
                                                : '' }}>Trabajador</option>
                                            <option value="Cliente" {{ request('role')=='Cliente' ? 'selected' : '' }}>
                                                Cliente</option>
                                        </select>
                                    </div>

                                    <!-- CSS para personalización -->
                                    <style>
                                        .custom-selects-design {
                                            background-color: #f8f9fa;
                                            /* Fondo claro */
                                            color: #495057;
                                            /* Texto gris oscuro */
                                            border-width: 2px;
                                            /* Borde más grueso */
                                            border-radius: 6px;
                                            /* Bordes redondeados */
                                            font-size: 1rem;
                                            /* Ajuste del tamaño del texto */
                                            padding: 0.5rem 1rem;
                                            /* Espaciado interno */
                                        }

                                        .custom-selects-design:focus {
                                            outline: none;
                                            /* Quita el borde azul por defecto */
                                            box-shadow: 0 0 4px rgba(0, 123, 255, 0.6);
                                            /* Sombra azul al enfocarse */
                                        }
                                    </style>



                                    <!-- Filtro por DNI -->
                                    <div class="col-md-4 mb-3">
                                        <label for="dni" class="form-label">DNI</label>
                                        <input type="text" name="dni" id="dni" value="{{ request('dni') }}"
                                            class="form-control" placeholder="Buscar por DNI">
                                    </div>

                                    <!-- Botón de búsqueda -->
                                    <div class=" col-md-4 d-flex align-items-end">
                                        <button type="submit" class="btn btn-dark w-100">Buscar</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                ROL
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                DNI</th>
                                            <th
                                                class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                NOMBRE</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                EMAIL</th>
                                            <th
                                                class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                ESTADO</th>

                                            <th class="text-secondary opacity-7"> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($usuariosPaginated as $usuario)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <p class="mb-0 text-sm">{{ $usuario['rol'] }}</p>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $usuario['dni'] }}</h6>

                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-xs text-secondary mb-0">{{ $usuario['nombre'] }}
                                                </p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">{{
                                                    $usuario['correo'] }}</span>
                                            </td>

                                            <td class="align-middle">
                                                <span class="inline-flex items-center">
                                                    @if ($usuario['estado'] === 'Activo')
                                                    <span
                                                        style="width: 10px; height: 10px; background-color: green; display: inline-block; border-radius: 50%; margin-right: 8px;"></span>
                                                    Activo
                                                    @elseif ($usuario['estado'] === 'Pendiente')
                                                    <span
                                                        style="width: 10px; height: 10px; background-color: yellow; display: inline-block; border-radius: 50%; margin-right: 8px;"></span>
                                                    Pendiente
                                                    @elseif ($usuario['estado'] === 'Suspendido')
                                                    <span
                                                        style="width: 10px; height: 10px; background-color: red; display: inline-block; border-radius: 50%; margin-right: 8px;"></span>
                                                    Suspendido
                                                    @else
                                                    <span
                                                        style="width: 10px; height: 10px; background-color: gray; display: inline-block; border-radius: 50%; margin-right: 8px;"></span>
                                                    No definido
                                                    @endif
                                                </span>
                                            </td>

                                            <td class="align-middle">
                                                @if ($usuario['rol'] === 'Trabajador')
                                                <a href="{{ route('administrador.usuario.show', ['id' => $usuario['id'], 'tipo' => 'trabajador']) }}"
                                                    class="btn btn-warning text-white px-4 py-2 rounded shadow">Ver</a>
                                                @elseif ($usuario['rol'] === 'Cliente')
                                                <a href="{{ route('administrador.usuario.show', ['id' => $usuario['id'], 'tipo' => 'cliente']) }}"
                                                    class="btn btn-warning text-white px-4 py-2 rounded shadow">Ver</a>
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
                                    {{ $usuariosPaginated->links('pagination::bootstrap-4') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>


</x-layout>
