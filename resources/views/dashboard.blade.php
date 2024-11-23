<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

            @if(auth()->user()->id_roles == 3) <!-- Si el id_roles es 1, por ejemplo, Cliente -->
                {{ __('Bienvenido, Cliente') }}
            @elseif(auth()->user()->id_roles == 2) <!-- Si el id_roles es 2, por ejemplo, Trabajador -->
                {{ __('Bienvenido Trabajador') }}
            @else
                {{ __('Bienvenido') }}
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-6">Bienvenido, {{ Auth::user()->name }}</h1>


                @if (Auth::user()->id_roles  == 3)
                    <!-- Contenido para Cliente -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Botón Registro de Datos Personales -->
                        <div class="bg-blue-100 rounded-lg p-4 shadow">
                            <h2 class="text-lg font-bold mb-2">Registro de Datos Personales</h2>
                            <p class="text-sm text-gray-600 mb-4">Actualiza tu información personal para estar al día.</p>
                            <a href="{{route('cliente.formulario')}}"
                            class="bg-indigo-500 text-white px-4 py-2 rounded shadow hover:bg-indigo-700">
                            Registrar
                            </a>
                        </div>

                        <!-- Botón Mi Perfil -->
                        <div class="bg-green-100 rounded-lg p-4 shadow">
                            <h2 class="text-lg font-bold mb-2">Mi Perfil</h2>
                            <p class="text-sm text-gray-600 mb-4">Consulta y edita la información de tu perfil.</p>
                            <a href="{{route('profile.show')}}"
                            class="bg-indigo-500 text-white px-4 py-2 rounded shadow hover:bg-indigo-700">
                            Configurar
                            </a>
                        </div>

                        <!-- Botón Mis Solicitudes -->
                        <div class="bg-yellow-100 rounded-lg p-4 shadow">
                            <h2 class="text-lg font-bold mb-2">Mis Solicitudes</h2>
                            <p class="text-sm text-gray-600 mb-4">Revisa el estado de tus solicitudes.</p>
                            <a href=""
                            class="bg-indigo-500 text-white px-4 py-2 rounded shadow hover:bg-indigo-700">
                            Ver solicitudes
                            </a>
                        </div>


                        <!-- Botón Publicar Problema -->
                        <div class="bg-orange-100 rounded-lg p-4 shadow">
                            <h2 class="text-lg font-bold mb-2">Publicar un Problema</h2>
                            <p class="text-sm text-gray-600 mb-4">Describe el problema para que podamos ayudarte.</p>
                            <a href="{{ route('problemas.create') }}"
                               class="bg-orange-500 text-white px-4 py-2 rounded shadow hover:bg-orange-700">
                                Publicar
                            </a>
                        </div>


                        <div class="bg-yellow-100 rounded-lg p-4 shadow">
                            <h2 class="text-lg font-bold mb-2">Mis Publicaciones</h2>
                            <p class="text-sm text-gray-600 mb-4">Revisa y administra tus problemas publicados.</p>
                            <a href="{{ route('cliente.problemas.index') }}"
                               class="bg-yellow-500 text-white px-4 py-2 rounded shadow hover:bg-yellow-700">
                                Ver mis problemas
                            </a>
                        </div>


                    </div>
                @elseif (Auth::user()->id_roles  == 2)

                    <!-- Contenido para Trabajador -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                                <!-- Botont de registro-->
                        <div class="bg-blue-100 rounded-lg p-4 shadow">
                            <h2 class="text-lg font-bold mb-2">Registro de Datos Personales</h2>
                            <p class="text-sm text-gray-600 mb-4">Actualiza tu información personal para estar al día.</p>
                            <a href="{{route('trabajador.formulario')}}"
                            class="bg-indigo-500 text-white px-4 py-2 rounded shadow hover:bg-indigo-700">
                            Registrar
                            </a>
                        </div>
                        <!-- Botón Gestión de Tareas -->
                        <div class="bg-red-100 rounded-lg p-4 shadow">
                            <h2 class="text-lg font-bold mb-2">Gestión de Tareas</h2>
                            <p class="text-sm text-gray-600 mb-4">Administra tus tareas asignadas.</p>
                            <a href=""
                            class="bg-indigo-500 text-white px-4 py-2 rounded shadow hover:bg-indigo-700">
                            Gestionar tareas
                            </a>
                        </div>

                        <!-- Botón Reporte de Actividades -->
                        <div class="bg-purple-100 rounded-lg p-4 shadow">
                            <h2 class="text-lg font-bold mb-2">Reporte de Actividades</h2>
                            <p class="text-sm text-gray-600 mb-4">Genera reportes sobre tus actividades recientes.</p>
                            <a href=""
                            class="bg-indigo-500 text-white px-4 py-2 rounded shadow hover:bg-indigo-700">
                            Generar Reporte
                            </a>
                        </div>

                        <!-- Botón Consultar Solicitudes -->
                        <div class="bg-indigo-100 rounded-lg p-4 shadow">
                            <h2 class="text-lg font-bold mb-2">Consultar Solicitudes</h2>
                            <p class="text-sm text-gray-600 mb-4">Revisa las solicitudes asignadas.</p>
                            <a href=""
                                class="bg-indigo-500 text-white px-4 py-2 rounded shadow hover:bg-indigo-700">
                                Consultar
                            </a>
                        </div>

                        <div class="bg-indigo-100 rounded-lg p-4 shadow">
                            <h2 class="text-lg font-bold mb-2">Configura tu perfil</h2>
                            <p class="text-sm text-gray-600 mb-4">Revisa tu perfil</p>
                            <a href="{{ route('profile.show') }}"
                                class="bg-indigo-500 text-white px-4 py-2 rounded shadow hover:bg-indigo-700">
                                Configurar
                            </a>
                        </div>

                        <div class="bg-indigo-100 rounded-lg p-4 shadow">
                            <h2 class="text-lg font-bold mb-2">Datos Personales</h2>
                            <p class="text-sm text-gray-600 mb-4">Cambia tus datos datos personales</p>
                            <a href=" "
                                class="bg-indigo-500 text-white px-4 py-2 rounded shadow hover:bg-indigo-700">
                                Ingresar
                            </a>
                        </div>

                    </div>
                @else
                    <!-- Contenido General -->
                    <p class="text-gray-600">No tienes un rol asignado.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

