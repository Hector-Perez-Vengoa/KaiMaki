<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Kaimaki</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">


    <!-- Material Dashboard Styles -->
    <link href="{{ asset('assets/css/material-dashboard.css?v=3.0.0') }}" rel="stylesheet">


    <!-- Jetstream Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Custom Styles -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    @livewireStyles
</head>
<body class="font-sans antialiased">
    <x-banner />

    <div class="min-h-screen bg-gray-100">
        <!-- Sidebar de Material Dashboard -->
        @if(Auth::check() && Auth::user()->id_roles == 1) <!-- Si es administrador -->
            <div class="wrapper">
                @include('components.navbars.sidebar') <!-- Sidebar para Material Dashboard -->
                <div class="main-panel">
                    @include('components.navbars.navs.auth') <!-- Barra de navegación -->

                    <div class="content">
                        {{ $slot }}
                        @yield('content') <!-- Contenido específico -->
                    </div>
                </div>
            </div>
        @else
            <!-- Layout para otros roles (Jetstream por defecto) -->
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        @endif
    </div>

    @stack('modals')

    @livewireScripts




    @stack('js')
</body>
</html>
