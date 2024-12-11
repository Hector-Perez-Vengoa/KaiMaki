<x-app-layout>
    <div class="max-w-xs sm:max-w-md lg:max-w-full mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Datos Personales</h1>
        <!-- Datos y Ubicación en dos columnas -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Datos Personales -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-lg font-bold mb-2">Datos Personales</h2> <br>
                <p><strong>DNI:</strong> {{ $trabajador->dni }}</p> <br>
                <p><strong>Nombre:</strong> {{ $trabajador->nombres }}</p> <br>
                <p><strong>Apellidos:</strong> {{ $trabajador->apellidos }}</p> <br>
                <p><strong>Teléfono:</strong> {{ $trabajador->telefono }}</p> <br>
                <p><strong>Sexo:</strong> {{ $trabajador->sexo == 'M' ? 'Masculino' : 'Femenino' }}</p> <br>
            </div>

            <!-- Ubicación -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-lg font-bold mb-2">Ubicación</h2> <br>
                <p><strong>Dirección:</strong> {{ $trabajador->ubicacion->direccion ?? 'No registrada' }}</p> <br>
                <p><strong>Distrito:</strong> {{ $trabajador->ubicacion->distrito ?? 'No registrado' }}</p> <br>
                <p><strong>Ciudad:</strong> {{ $trabajador->ubicacion->ciudad ?? 'No registrada' }}</p> <br>
            </div>
        </div>

        <!-- Antecedentes y Certificados en dos columnas -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Antecedentes -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-lg font-bold mb-2">Antecedentes</h2>

                @if($trabajador->antecedentes && !$trabajador->antecedentes->isEmpty())
                    <ul class="list-disc pl-6">
                        @foreach($trabajador->antecedentes as $antecedente)
                            <li class="mb-4">
                                <span class="font-semibold">Archivo:</span>
                                <a href="{{ asset('storage/' . $antecedente->documento_antecedente) }}" target="_blank" class="text-blue-500 underline">
                                    Ver PDF
                                </a> <br>
                                <span class="font-semibold">Estado:</span> {{ $antecedente->estado->nombre_estado ?? 'Sin estado definido' }}
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500">No se encontraron antecedentes registrados para este trabajador.</p>
                @endif


            <!-- Certificados -->

                <h2 class="text-lg font-bold mb-2">Certificados</h2>

                @if($trabajador->certificados && !$trabajador->certificados->isEmpty())
                    <ul class="list-disc pl-6">
                        @foreach($trabajador->certificados as $certificado)
                            <li class="mb-4">
                                <span class="font-semibold">Archivo:</span>
                                    <a href="{{ asset('storage/' . $certificado->documento_certificado) }}" target="_blank" class="text-blue-500 underline">
                                    Ver PDF
                                    </a> <br>
                                <span class="font-semibold">Estado:</span> {{ $certificado->estado->nombre_estado ?? 'Sin estado definido' }}
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500">No se encontraron certificados registrados para este trabajador.</p>
                @endif
            </div>

                    <!-- Oficios a una columna -->
                <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-lg font-bold mb-2">Oficios</h2>

                @if($trabajador->oficios && !$trabajador->oficios->isEmpty())
                <ul>
                    @foreach($trabajador->oficios as $oficio)
                        <li>{{ $oficio->nombre_oficio }}</li>
                    @endforeach
                </ul>

                @else
                    <p>No se encontraron oficios registrados.</p>
                @endif
            </div>
        </div>
    </div>

    </div>

        </div>



        @if (Auth::user()->id_roles  == 1)
        <div class="bg-indigo-100 rounded-lg p-4 shadow">
                <a href="{{route('administrador.trabajador')}}"
                    class="bg-indigo-500 text-white px-4 py-2 rounded shadow hover:bg-indigo-700">
                    Regresar
                </a>
        </div>
        @endif


    </div>
</x-app-layout>
