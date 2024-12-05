<x-layout bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.sidebar activePage="problemas-management"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Problemas Publicados"></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-3">
                            <div class="bg-gradient-warning shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-center font-weight-bold">Problemas Publicados por los Clientes</h6>
                            </div>
                            <div class="card-body px-0 pb-2">
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">N° Problema</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Cliente</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Oficio</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Descripción</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Imagen</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Monto</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Fecha</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($problemas as $problema)
                                                <tr>
                                                    <td class="text-xs font-weight-bold mb-0">{{ $problema->id_problemas }}</td>
                                                    <td class="text-xs font-weight-bold mb-0">{{ $problema->cliente->nom_cliente }} {{ $problema->cliente->ape_cliente }}</td>
                                                    <td class="text-xs font-weight-bold mb-0">{{ $problema->oficio->nombre_oficio }}</td>
                                                    <td class="text-xs font-weight-bold mb-0">{{ $problema->descripcion }}</td>
                                                    <td class="text-xs font-weight-bold mb-0">
                                                        @if($problema->imagen)
                                                            <img src="{{ asset('storage/' . $problema->imagen) }}" alt="Imagen del Problema" class="img-fluid" style="max-width: 100px;">
                                                        @else
                                                            No disponible
                                                        @endif
                                                    </td>
                                                    <td class="text-xs font-weight-bold mb-0">{{ $problema->monto }}</td>
                                                    <td class="text-xs font-weight-bold mb-0">{{ $problema->fecha }}</td>
                                                    <td class="text-xs font-weight-bold mb-0">{{ $problema->estadoProblema->nombre_estado ?? 'No definido' }}</td>
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

