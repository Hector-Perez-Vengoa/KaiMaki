<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="user-management"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Reclamos"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-3">
                            <div class=" shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-black text-center font-weight-bold">Reclamos</h6>
                            </div>
                            <div class="card-body px-0 pb-2">
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Asunto
                                                </th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Descripción
                                                </th>
                                                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Usuario
                                                </th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Estado
                                                </th>
                                                <th class="text-secondary opacity-7"> </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($reclamos as $reclamo)
                                            <tr>
                                                <td class="text-sm">
                                                    <p class="mb-0 text-wrap">{{ $reclamo->asunto }}</p>
                                                </td>
                                                <td class="text-sm">
                                                    <p class="mb-0 text-wrap">{{ $reclamo->descripcion }}</p>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <p class="text-xs text-secondary mb-0">{{ optional($reclamo->users)->name ?? 'No definido' }}</p>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="{{ $reclamo->estado->nombre_estado === 'Pendiente' ? 'warning' : ($reclamo->estado->nombre_estado === 'Resuelto' ? 'success' : 'danger') }}">
                                                        {{ $reclamo->estado->nombre_estado }}
                                                    </span>
                                                </td>
                                                <td class="align-middle">
                                                    <a href="{{ route('administrador.reclamos.ver', ['id' => $reclamo->id_reclamo]) }}" class="btn btn-warning btn-sm">Revisar</a>
                                                </td>


                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                    </div>
                </div>
            </div>

        </div>
    </main>


</x-layout>
