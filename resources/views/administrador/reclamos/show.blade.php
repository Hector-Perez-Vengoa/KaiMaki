<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="user-management"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Usuario"></x-navbars.navs.auth>

        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="container">
                    <h2 class="my-4">Detalles del Reclamo</h2>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Asunto: {{ $reclamo->asunto }}</h5>
                            <p class="card-text">Descripción: {{ $reclamo->descripcion }}</p>

                            <p><strong>Estado:</strong> {{ $reclamo->estado->nombre_estado ?? 'No disponible' }}
                            </p>
                            <hr>
                            <h5 class="my-3">Información del Usuario</h5>
                            <p><strong>Nombre:</strong> {{ $reclamo->users->name ?? 'No disponible' }}</p>
                            <p><strong>Email:</strong> {{ $reclamo->users->email ?? 'No disponible' }}</p>
                            <!-- Agrega aquí más información del usuario según sea necesario -->
                            @if ($reclamo->users->clientes)
                            <h5 class="my-3">Detalles del Cliente</h5>
                            <p><strong>Apellidos:</strong> {{ $reclamo->users->clientes->ape_cliente ?? 'No disponible'
                                }}</p>
                            <p><strong>Teléfono:</strong> {{ $reclamo->users->clientes->telefo_cliente ?? 'No
                                disponible' }}</p>
                            <p><strong>DNI:</strong> {{ $reclamo->users->clientes->dni ?? 'No disponible' }}</p>
                            @elseif ($reclamo->users->trabajadores)
                            <h5 class="my-3">Detalles del Trabajador</h5>
                            <p><strong>Apellidos:</strong> {{ $reclamo->users->trabajadores->apellidos ?? 'No
                                disponible' }}</p>
                            <p><strong>Teléfono:</strong> {{ $reclamo->users->trabajadores->telefono ?? 'No disponible'
                                }}</p>
                            <p><strong>DNI:</strong> {{ $reclamo->users->trabajadores->dni ?? 'No disponible' }}</p>
                            @endif
                            <hr>
                            <h5 class="my-3">Cambiar Estado del Reclamo</h5>
                            <form action="{{ route('administrador.reclamos.update', ['id' => $reclamo->id_reclamo]) }}"
                                method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="estado">Nuevo Estado:</label>
                                    <select name="estado_id" id="estado" class="form-control w-50 custom-select-orange">
                                        <option value="">Seleccione</option>
                                        @foreach ($estados as $estado)
                                        <option value="{{ $estado->id_estado_reclamo }}" {{ $reclamo->id_estado_reclamo
                                            == $estado->id_estado_reclamo ? 'selected' : '' }}>
                                            {{ $estado->nombre_estado }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="d-flex justify-content-between mt-4">
                                    <a href="{{ route('reclamos.index')}}" class="btn btn-warning">Regresar</a>
                                    <button type="submit" class="btn btn-warning">
                                        <i class="material-icons">save</i> Actualizar
                                    </button>

                                    <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ $reclamo->users->email ?? ($reclamo->users->clientes->email ?? $reclamo->users->trabajadores->email) }}"
                                        target="_blank" class="btn btn-warning">Comunicarse</a>

                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <!-- Estilos CSS -->
<style>
    .custom-select-orange {
        background-color: #ffffff; /* Color naranja */
        border: 2px solid #b0b0b0; /* Borde naranja */
        color: #001774; /* Texto blanco */
        border-radius: 5px; /* Bordes redondeados */
        padding: 4px; /* Espaciado interno */
        transition: background-color 0.3s ease, color 0.3s ease; /* Transición suave al cambiar estilo */
    }
</style>


</x-layout>
