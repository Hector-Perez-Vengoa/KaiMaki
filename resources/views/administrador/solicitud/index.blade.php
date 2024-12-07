<x-layout bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.sidebar activePage="solicitudes-management"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Solicitudes"></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-3">
                            <div class="bg-gradient-warning shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-center font-weight-bold">Solicitudes entre Clientes y Trabajadores</h6>
                            </div>
                            <div class="card-body px-0 pb-2">
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">N° Solicitud</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Cliente</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Trabajador</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Estado</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Fecha de Reserva</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Descripción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($solicitudes as $solicitud)
                                                <tr>
                                                    <td class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</td>
                                                    <td class="text-xs font-weight-bold mb-0">{{ $solicitud->cliente->nom_cliente }} {{ $solicitud->cliente->ape_cliente }}</td>
                                                    <td class="text-xs font-weight-bold mb-0">{{ $solicitud->trabajador->nombres }} {{ $solicitud->trabajador->apellidos }}</td>
                                                    <td class="text-xs font-weight-bold mb-0">{{ $solicitud->estado->nombre_estado }}</td>
                                                    <td class="text-xs font-weight-bold mb-0">{{ $solicitud->fech_reserva }}</td>
                                                    <td class="text-xs font-weight-bold mb-0">{{ $solicitud->descripcion }}</td>
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
        </div>
    </main>

</x-layout>

