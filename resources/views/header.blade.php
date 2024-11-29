<head>
    <!-- Meta -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>KaiMaki</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <link rel="stylesheet" href="{{ asset('css/carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>

<body>
    <header class="bg-orange-500 text-white py-4 px-6 shadow-lg " >
        <div class="container mx-auto flex justify-between items-center">
            <!-- Logo -->
            <div class="flex items-center space-x-4">
                <a href="/" class="flex items-center space-x-2">
                    <img src="{{ asset('storage/inicio/logo2.png') }}" alt="Logo KaiMaki" class="w-10 h-10">
                    <span class="text-xl font-bold">Kai Maki</span>
                </a>
            </div>

            <!-- Navigation Links (Desktop) -->
            <nav class="hidden md:flex space-x-8">
                <a href="{{ route('welcome') }}#todo-en-3-pasos" class="hover:underline hover:text-orange-300">Ayuda</a>
                <a href="{{ url('about-us') }}" class="hover:underline hover:text-orange-300">Nosotros</a>
            </nav>

            <!-- Authentication Links (Desktop) -->
            <div class="hidden md:flex space-x-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-3 py-2 bg-white text-orange-500 rounded-md shadow hover:bg-orange-100">
                            Ingresar
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-3 py-2 bg-white text-orange-500 rounded-md shadow hover:bg-orange-100">
                            Iniciar sesión
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-3 py-2 bg-white text-orange-500 rounded-md shadow hover:bg-orange-100">
                                Crear cuenta
                            </a>
                        @endif
                    @endauth
                @endif
            </div>

            <!-- Hamburger Menu (Mobile) -->
            <div class="md:hidden">
                <button id="menu-toggle" class="text-white focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden bg-orange-500 text-white flex flex-col space-y-4 mt-4 px-6 md:hidden">
            <a href="{{ route('welcome') }}#todo-en-3-pasos" class="hover:underline">Ayuda</a>
            <a href="{{ url('about-us') }}" class="hover:underline">Nosotros</a>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-3 py-2 bg-white text-orange-500 rounded-md shadow hover:bg-orange-100">
                        Ingresar
                    </a>
                @else
                    <a href="{{ route('login') }}" class="px-3 py-2 bg-white text-orange-500 rounded-md shadow hover:bg-orange-100">
                        Log in
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-3 py-2 bg-white text-orange-500 rounded-md shadow hover:bg-orange-100">
                            Register
                        </a>
                    @endif
                @endauth
            @endif
        </div>
    </header>

    <script>

        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');

        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</body>
