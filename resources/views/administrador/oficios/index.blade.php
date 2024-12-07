<x-layout bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.sidebar activePage="user-management"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Oficios"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <!-- Formulario para crear un nuevo oficio -->
                    <div class="card my-4">
                        <div class="card-header p-3">
                            <div class="bg-gradient-warning shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-center font-weight-bold">Oficios</h6>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('administrador.almacenar-oficio') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="nombre_oficio" class="form-label">Nombre del Oficio</label>
                                        <input type="text" class="form-control" id="nombre_oficio" name="nombre_oficio"
                                            required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Agregar Oficio</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="container mt-4" x-data="{ showEditForm: false, currentOficio: { id_oficios: '', nombre_oficio: '' } }">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="card-body px-0 pb-2">
                                    <div class="table-responsive p-0">
                                        <table class="table align-items-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">N°</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Oficios</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($oficios as $oficio)
                                                    <tr>
                                                        <td class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</td> <!-- Mostrar un número secuencial en lugar del ID -->
                                                        <td class="text-xs font-weight-bold mb-0">{{ $oficio->nombre_oficio }}</td>
                                                        <td>
                                                            <!-- Botón para editar el oficio -->
                                                            <button type="button" class="btn btn-warning btn-sm"
                                                                    @click="showEditForm = true; currentOficio = { id_oficios: '{{ $oficio->id_oficios }}', nombre_oficio: '{{ $oficio->nombre_oficio }}' };">
                                                                Cambiar Nombre
                                                            </button>
                                                            <!-- Botón para eliminar el oficio -->
                                                            <form action="{{ route('administrador.eliminar-oficio', $oficio->id_oficios) }}" method="POST" style="display:inline-block;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm"
                                                                    onclick="return confirm('¿Está seguro de que desea eliminar este oficio?')">Quitar Oficio</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Div del Costado para Editar Oficio -->
                            <div class="col-md-6" x-show="showEditForm" x-cloak>
                                <div class="card" x-cloak>
                                    <div class="card-body" x-cloak>
                                        <h2>Editar Oficio</h2>
                                        <form method="POST" :action="'/oficios/' + currentOficio.id_oficios" @submit.prevent="showEditForm = false; $el.submit();">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="nombre_oficio" class="form-label">Nombre del Oficio</label>
                                                <input type="text" id="nombre_oficio" name="nombre_oficio" x-model="currentOficio.nombre_oficio" class="form-control" required>
                                            </div>
                                            <button type="button" class="btn btn-secondary" @click="showEditForm = false">Cancelar</button>
                                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        </div>
        </div>
    </main>

</x-layout>
