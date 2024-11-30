<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="user-management"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="User Management"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-center text-white mx-3"><strong> Gestion de Usuarios</strong> </h6>
                            </div>
                        </div>
                        <div class=" me-3 my-3 text-end">
                            <a class="btn bg-gradient-dark mb-0" href="javascript:;"><i
                                    class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New
                                User</a>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Gestión de Usuarios</h4>
                            </div>
                            <div class="card-body px-0 pb-2">
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Foto</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nombre</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">DNI</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Correo</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Rol</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Estado</th>
                                                <th class="text-secondary opacity-7">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($usuariosPaginated as $usuario)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <div>
                                                                <img src="{{ asset($usuario['photo'] ?? 'default-avatar.png') }}" alt="Usuario" class="avatar avatar-sm me-3">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0">{{ $usuario['nombre'] }}</p>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs text-secondary mb-0">{{ $usuario['dni'] }}</p>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs text-secondary mb-0">{{ $usuario['correo'] }}</p>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-sm bg-gradient-info">{{ $usuario['rol'] }}</span>
                                                    </td>
                                                    <td>
                                                        @if ($usuario['estado'] === 'Activo')
                                                            <span class="badge badge-sm bg-gradient-success">Activo</span>
                                                        @elseif ($usuario['estado'] === 'Pendiente')
                                                            <span class="badge badge-sm bg-gradient-warning">Pendiente</span>
                                                        @elseif ($usuario['estado'] === 'Suspendido')
                                                            <span class="badge badge-sm bg-gradient-danger">Suspendido</span>
                                                        @else
                                                            <span class="badge badge-sm bg-gradient-secondary">No definido</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('administrador.usuario.show', ['id' => $usuario['id'], 'tipo' => strtolower($usuario['rol'])]) }}"
                                                           class="btn btn-link text-dark text-sm">
                                                           <i class="material-icons">visibility</i> Ver
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-3">
                                    {{ $usuariosPaginated->links() }}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>
    </main>
    <x-plugins></x-plugins>

</x-layout>
