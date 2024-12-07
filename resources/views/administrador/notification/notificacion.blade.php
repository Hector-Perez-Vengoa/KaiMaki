<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="notifications"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Notifications"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-3">
                            <h4 class="text-black text-center font-weight-bold">Notificaciones</h4>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <ul class="list-group">
                                @foreach ($notificaciones->whereNull('read_at') as $notificacion)
                                    <li class="list-group-item bg-light">
                                        <strong>{{ $notificacion->data['message'] }}</strong>
                                        <p class="mb-0">
                                            <strong>Asunto:</strong> {{ $notificacion->data['asunto'] ?? 'N/A' }} <br>
                                            <strong>Descripción:</strong> {{ $notificacion->data['descripcion'] ?? 'No disponible' }} <br>
                                            <strong>Usuario:</strong> {{ $notificacion->data['usuario'] ?? 'Desconocido' }}
                                        </p>
                                        <small class="text-muted">{{ $notificacion->created_at->diffForHumans() }}</small>
                                        <a href="{{ route('admin.markNotificationRead', $notificacion->id) }}" class="btn btn-sm btn-primary float-right">Marcar como leída</a>
                                    </li>
                                @endforeach
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</x-layout>

