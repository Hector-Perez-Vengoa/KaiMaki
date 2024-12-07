<x-layout bodyClass="">
    <div>
        <main class="main-content mt-0">
            <section>
                <div class="page-header min-vh-100">
                    <div class="container">
                        <div class="row">
                            <!-- Imagen del lado izquierdo -->
                            <div class="col-6 d-none d-lg-flex align-items-center">
                                <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center"
                                    style="background-image: url('../assets/img/illustrations/illustration-signup.jpg'); background-size: cover; background-position: center;">
                                </div>
                            </div>
                             <!-- Formulario -->
                             <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                                <div class="card card-plain">
                                    <div class="card-header text-center">
                                        <h4 class="font-weight-bolder">Registrar Datos Personales</h4>
                                        <p>Complete los datos para continuar</p>
                                    </div>
                                    <div class="card-body">
                                        <form method="POST" action="{{ route('administrador.store') }}">
                                            @csrf

                                            <!-- DNI -->
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="dni" name="dni"
                                                    value="{{ old('dni') }}" maxlength="8" required>
                                                <label for="dni">DNI</label>
                                            </div>
                                            @error('dni')
                                            <p class="text-danger text-sm mt-1">{{ $message }}</p>
                                            @enderror

                                            <!-- Nombres -->
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="nombres" name="nombres"
                                                    value="{{ old('nombres') }}" required>
                                                <label for="nombres">Nombres</label>
                                            </div>
                                            @error('nombres')
                                            <p class="text-danger text-sm mt-1">{{ $message }}</p>
                                            @enderror

                                            <!-- Apellidos -->
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="apellidos" name="apellidos"
                                                    value="{{ old('apellidos') }}" required>
                                                <label for="apellidos">Apellidos</label>
                                            </div>
                                            @error('apellidos')
                                            <p class="text-danger text-sm mt-1">{{ $message }}</p>
                                            @enderror

                                            <!-- Teléfono -->
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="telefono" name="telefono"
                                                    value="{{ old('telefono') }}" maxlength="15" required>
                                                <label for="telefono">Teléfono</label>
                                            </div>
                                            @error('telefono')
                                            <p class="text-danger text-sm mt-1">{{ $message }}</p>
                                            @enderror

                                            <!-- Botón Registrar -->
                                            <div class="text-center">
                                                <button type="submit"
                                                    class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">Guardar
                                                    Datos</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</x-layout>
