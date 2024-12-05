<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Bienvenido') }}
        </h2>
    </x-slot>
<div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-6">Bienvenido, {{ Auth::user()->name }}</h1>
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
                        <h2 class="text-lg font-bold mb-2">Reclamos</h2>
                        <p class="text-sm text-gray-600 mb-4">Registra tu reclamo.</p>
                        <a href="{{route('trabajadores.reclamo.create')}}" class="bg-indigo-500 text-white px-4 py-2 rounded shadow hover:bg-indigo-700">
                            Registrar
                        </a>
                    </div>



                    <!-- Botón Reporte de Actividades -->
                    <div class="bg-purple-100 rounded-lg p-4 shadow">
                        <h2 class="text-lg font-bold mb-2">Reporte de Actividades</h2>
                        <p class="text-sm text-gray-600 mb-4">Genera reportes sobre tus actividades recientes.</p>
                        <a href="" class="bg-indigo-500 text-white px-4 py-2 rounded shadow hover:bg-indigo-700">
                            Generar Reporte
                        </a>
                    </div>

                    <!-- Botón Consultar Solicitudes -->
                    <div class="bg-indigo-100 rounded-lg p-4 shadow">
                        <h2 class="text-lg font-bold mb-2">Consultar Solicitudes</h2>
                        <p class="text-sm text-gray-600 mb-4">Revisa las solicitudes asignadas.</p>
                        <a href="{{ route('trabajador.solicitudes') }}"
                            class="bg-indigo-500 text-white px-4 py-2 rounded shadow hover:bg-indigo-700">
                            Consultar
                        </a>
                    </div>

                    <div class="bg-indigo-100 rounded-lg p-4 shadow">
                        <h2 class="text-lg font-bold mb-2">Configura tu perfil</h2>
                        <p class="text-sm text-gray-600 mb-4">Revisa tu perfil</p>
                        <a href="{{route('profile.show')}}"
                            class="bg-indigo-500 text-white px-4 py-2 rounded shadow hover:bg-indigo-700">
                            Configurar
                        </a>
                    </div>

                    <div class="bg-indigo-100 rounded-lg p-4 shadow">
                        <h2 class="text-lg font-bold mb-2">Datos Personales</h2>
                        <p class="text-sm text-gray-600 mb-4">Ver datos Personales</p>
                        <a href="{{route('trabajador.show')}}"
                            class="bg-indigo-500 text-white px-4 py-2 rounded shadow hover:bg-indigo-700">
                            Ingresar
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
