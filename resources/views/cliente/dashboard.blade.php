<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Bienvenido ') }}
        </h2>
    </x-slot>

<div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-6">Bienvenido, {{ Auth::user()->name }}</h1>
                <!-- Contenido para Cliente -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Botón Registro de Datos Personales
                            <div class="bg-blue-100 rounded-lg p-4 shadow">
                                <h2 class="text-lg font-bold mb-2">Registro de Datos Personales</h2>
                                <p class="text-sm text-gray-600 mb-4">Actualiza tu información personal para estar al día.</p>
                                <a href="{{route('cliente.formulario')}}"
                                class="bg-indigo-500 text-white px-4 py-2 rounded shadow hover:bg-indigo-700">
                                Registrar
                                </a>
                            </div>-->

                    <!-- Botón Mi Perfil -->
                    <div class="bg-white hover-effect p-6 rounded-lg shadow-sm border border-gray-200">
                        <div class="flex items-center mb-4">
                        <!-- Icono para "Mi Perfil" -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-orange-500 mr-3" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                        </svg>
                            <h2 class="text-xl font-semibold text-gray-800">Mi Perfil</h2>
                        </div>
                        <p class="text-gray-600 text-sm mb-4">
                            Consulta y edita la información de tu perfil.
                        </p>
                        <a href="{{ route('profile.show') }}" class="bg-orange-500 text-white px-4 py-2 rounded shadow hover:bg-yellow-600 transition">
                            Configurar
                        </a>
                    </div>

                    <!-- Botón Mis Solicitudes -->
                    <div class="bg-white hover-effect p-6 rounded-lg shadow-sm border border-gray-200">
                        <div class="flex items-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-orange-500 mr-3" viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd" d="M6.75 2.25A.75.75 0 0 1 7.5 3v1.5h9V3A.75.75 0 0 1 18 3v1.5h.75a3 3 0 0 1 3 3v11.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V7.5a3 3 0 0 1 3-3H6V3a.75.75 0 0 1 .75-.75Zm13.5 9a1.5 1.5 0 0 0-1.5-1.5H5.25a1.5 1.5 0 0 0-1.5 1.5v7.5a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5v-7.5Z" clip-rule="evenodd" />
                            </svg>
                            <h2 class="text-xl font-semibold text-gray-800">Mis Solicitudes Recibidas</h2>
                        </div>
                        <p class="text-gray-600 text-sm mb-4">
                            Revisa el estado de tus solicitudes.
                        </p>
                        <a href="{{ route('cliente.solicitudes') }}" class="bg-orange-500 text-white px-4 py-2 rounded shadow hover:bg-yellow-600 transition">
                            Ver solicitudes
                        </a>
                    </div>

                    <!-- Botón Mis Solicitudes -->
                    <div class="bg-white hover-effect p-6 rounded-lg shadow-sm border border-gray-200">
                        <div class="flex items-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-orange-500 mr-3" viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd" d="M6.75 2.25A.75.75 0 0 1 7.5 3v1.5h9V3A.75.75 0 0 1 18 3v1.5h.75a3 3 0 0 1 3 3v11.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V7.5a3 3 0 0 1 3-3H6V3a.75.75 0 0 1 .75-.75Zm13.5 9a1.5 1.5 0 0 0-1.5-1.5H5.25a1.5 1.5 0 0 0-1.5 1.5v7.5a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5v-7.5Z" clip-rule="evenodd" />
                            </svg>
                            <h2 class="text-xl font-semibold text-gray-800">Mis Solicitudes Enviadas</h2>
                        </div>
                        <p class="text-gray-600 text-sm mb-4">
                            Revisa el estado de tus solicitudes.
                        </p>
                        <a href="{{ route('cliente.solicitud') }}" class="bg-orange-500 text-white px-4 py-2 rounded shadow hover:bg-yellow-600 transition">
                            Ver solicitudes
                        </a>
                    </div>

                    <div class="bg-white hover-effect p-6 rounded-lg shadow-sm border border-gray-200">
                        <div class="flex items-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-orange-500 mr-3" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd" d="M12 6.75a5.25 5.25 0 0 1 6.775-5.025.75.75 0 0 1 .313 1.248l-3.32 3.319c.063.475.276.934.641 1.299.365.365.824.578 1.3.64l3.318-3.319a.75.75 0 0 1 1.248.313 5.25 5.25 0 0 1-5.472 6.756c-1.018-.086-1.87.1-2.309.634L7.344 21.3A3.298 3.298 0 1 1 2.7 16.657l8.684-7.151c.533-.44.72-1.291.634-2.309A5.342 5.342 0 0 1 12 6.75ZM4.117 19.125a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75h-.008a.75.75 0 0 1-.75-.75v-.008Z" clip-rule="evenodd" />
                            <path d="m10.076 8.64-2.201-2.2V4.874a.75.75 0 0 0-.364-.643l-3.75-2.25a.75.75 0 0 0-.916.113l-.75.75a.75.75 0 0 0-.113.916l2.25 3.75a.75.75 0 0 0 .643.364h1.564l2.062 2.062 1.575-1.297Z" />
                            <path fill-rule="evenodd" d="m12.556 17.329 4.183 4.182a3.375 3.375 0 0 0 4.773-4.773l-3.306-3.305a6.803 6.803 0 0 1-1.53.043c-.394-.034-.682-.006-.867.042a.589.589 0 0 0-.167.063l-3.086 3.748Zm3.414-1.36a.75.75 0 0 1 1.06 0l1.875 1.876a.75.75 0 1 1-1.06 1.06L15.97 17.03a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                        </svg>

                            <h2 class="text-xl font-semibold text-gray-800">Busca Servicios</h2>
                        </div>
                        <p class="text-gray-600 text-sm mb-4">
                            Encuentra servicios profesionales fácilmente.
                        </p>
                        <a href="{{ route('servicios') }}" class="bg-orange-500 text-white px-4 py-2 rounded shadow hover:bg-yellow-600 transition">
                            Buscar
                        </a>
                    </div>

                    <div class="bg-white hover-effect p-6 rounded-lg shadow-sm border border-gray-200">
                        <div class="flex items-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-orange-500 mr-3" viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.848 2.771A49.144 49.144 0 0 1 12 2.25c2.43 0 4.817.178 7.152.52 1.978.292 3.348 2.024 3.348 3.97v6.02c0 1.946-1.37 3.678-3.348 3.97a48.901 48.901 0 0 1-3.476.383.39.39 0 0 0-.297.17l-2.755 4.133a.75.75 0 0 1-1.248 0l-2.755-4.133a.39.39 0 0 0-.297-.17 48.9 48.9 0 0 1-3.476-.384c-1.978-.29-3.348-2.024-3.348-3.97V6.741c0-1.946 1.37-3.68 3.348-3.97ZM6.75 8.25a.75.75 0 0 1 .75-.75h9a.75.75 0 0 1 0 1.5h-9a.75.75 0 0 1-.75-.75Zm.75 2.25a.75.75 0 0 0 0 1.5H12a.75.75 0 0 0 0-1.5H7.5Z" clip-rule="evenodd" />
                              </svg>

                            <h2 class="text-xl font-semibold text-gray-800">Realiza tu reclamo</h2>
                        </div>
                        <p class="text-gray-600 text-sm mb-4">
                            Escribe tu reclamo para poder ayudarte.
                        </p>
                        <a href="{{ route('cliente.reclamo.create') }}" class="bg-orange-500 text-white px-4 py-2 rounded shadow hover:bg-yellow-600 transition">
                            Registrar
                        </a>
                    </div>


                    <div class="bg-white hover-effect p-6 rounded-lg shadow-sm border border-gray-200">
                        <div class="flex items-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-orange-500 mr-3" viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm11.378-3.917c-.89-.777-2.366-.777-3.255 0a.75.75 0 0 1-.988-1.129c1.454-1.272 3.776-1.272 5.23 0 1.513 1.324 1.513 3.518 0 4.842a3.75 3.75 0 0 1-.837.552c-.676.328-1.028.774-1.028 1.152v.75a.75.75 0 0 1-1.5 0v-.75c0-1.279 1.06-2.107 1.875-2.502.182-.088.351-.199.503-.331.83-.727.83-1.857 0-2.584ZM12 18a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                            </svg>
                            <h2 class="text-xl font-semibold text-gray-800">Mis Problemas</h2>
                        </div>
                        <p class="text-gray-600 text-sm mb-4">
                            Revisa y administra tus problemas publicados.
                        </p>
                        <a href="{{ route('cliente.problemas.index') }}" class="bg-orange-500 text-white px-4 py-2 rounded shadow hover:bg-yellow-600 transition">
                            Ver mis problemas
                        </a>
                    </div>

                    <div class="bg-white hover-effect p-6 rounded-lg shadow-sm border border-gray-200">
                        <div class="flex items-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-orange-500 mr-3" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M5.566 4.657A4.505 4.505 0 0 1 6.75 4.5h10.5c.41 0 .806.055 1.183.157A3 3 0 0 0 15.75 3h-7.5a3 3 0 0 0-2.684 1.657ZM2.25 12a3 3 0 0 1 3-3h13.5a3 3 0 0 1 3 3v6a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3v-6ZM5.25 7.5c-.41 0-.806.055-1.184.157A3 3 0 0 1 6.75 6h10.5a3 3 0 0 1 2.683 1.657A4.505 4.505 0 0 0 18.75 7.5H5.25Z" />
                              </svg>

                            <h2 class="text-xl font-semibold text-gray-800">Publicar problema</h2>
                        </div>
                        <p class="text-gray-600 text-sm mb-4">
                            Publica tus problemas
                        </p>
                        <a href="{{ route('cliente.problemas.create') }}" class="bg-orange-500 text-white px-4 py-2 rounded shadow hover:bg-yellow-600 transition">
                            Publicar problemas
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</x-app-layout>

