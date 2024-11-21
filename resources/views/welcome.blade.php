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

</head>
<body>
    <header class="bg-orange-500 text-white py-4 px-6 flex justify-between items-center shadow-lg">
        <!-- Logo -->
        <div class="flex items-center space-x-4">
            <!-- Logo y nombre envueltos dentro de un solo enlace -->
            <a href="/" class="flex items-center space-x-2">
                <!-- Imagen del logo -->
                <img src="/path/to/logo.png" alt="Logo KaiMaki" class="w-10 h-10">
                <!-- Nombre del sitio -->
                <span class="text-xl font-bold">Kai Maki</span>
            </a>
        </div>
        

        <!-- Navigation Links -->
        <nav class="ml-auto flex space-x-8">
            <a href=" {{ url('/servicios') }}" class="hover:underline hover:text-orange-300">Servicios</a>
            <a href="{{ url('/ayuda') }}" class="hover:underline hover:text-orange-300">Ayuda</a>
            <a href="{{ url('about-us') }}" class="hover:underline hover:text-orange-300">Nosotros</a>
        </nav>
        

       <!-- Authentication Links -->
    <div class="flex space-x-4 ml-12">
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

<div class="relative bg-cover bg-center" style="background-image: url('{{ asset('storage/inicio/pantalla.jpg') }}'); height: 80vh;">
    <div class="absolute inset-0 flex items-center justify-end px-6">
        <div class="text-white">
            <h1 class="text-5xl font-bold">¡Soluciones para tu hogar <br>a un clic de distancia!</h1>
            <p class="text-lg mt-4">Encuentra profesionales confiables y <br>capacitados para las tareas que necesitas. <br>Rápido, seguro y bajo demanda.</p>
            <a href="{{ url('/servicios') }}" class="text-right  bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded mt-6 inline-block">Solicita un servicio</a>
        </div>
    </div>
</div>


<!---------------------------------------------------Carruel-------------------------------------------->

<div class="carousel-container bg-orange-100 py-12">
    <h2 class="text-5xl font-bold text-center text-orange-600 mb-6">Nuestros Servicios</h2>
    <p class="text-lg text-center text-gray-600 mb-8 max-w-2xl mx-auto">
        Descubre todo lo que tenemos para ofrecerte. Servicios diseñados pensando en ti.
    </p>

    <div class="carousel-wrapper relative overflow-hidden max-w-6xl mx-auto">
        <div class="carousel flex" id="carousel">
            <!-- Slide 1 -->
            <div class="carousel-item flex-shrink-0 w-full md:w-1/4 px-2">
                <div class="carousel-slide text-center">
                    <img src="{{ asset('storage/inicio/albañileria.jpg') }}" alt="Albañilería" class="carousel-image mx-auto">
                    <p class="mt-2 font-bold text-gray-800">Albañilería</p>
                </div>
            </div>
            <div class="carousel-item flex-shrink-0 w-full md:w-1/4 px-2">
                <div class="carousel-slide text-center">
                    <img src="{{ asset('storage/inicio/electricista.jpg') }}" alt="Electricista" class="carousel-image mx-auto">
                    <p class="mt-2 font-bold text-gray-800">Electricista</p>
                </div>
            </div>
            <div class="carousel-item flex-shrink-0 w-full md:w-1/4 px-2">
                <div class="carousel-slide text-center">
                    <img src="{{ asset('storage/inicio/mecanico.jpg') }}" alt="Mecánico" class="carousel-image mx-auto">
                    <p class="mt-2 font-bold text-gray-800">Mecánico</p>
                </div>
            </div>
            <div class="carousel-item flex-shrink-0 w-full md:w-1/4 px-2">
                <div class="carousel-slide text-center">
                    <img src="{{ asset('storage/inicio/plomeria.jpg') }}" alt="Plomería" class="carousel-image mx-auto">
                    <p class="mt-2 font-bold text-gray-800">Plomería</p>
                </div>
            </div>
            <div class="carousel-item flex-shrink-0 w-full md:w-1/4 px-2">
                <div class="carousel-slide text-center">
                    <img src="{{ asset('storage/inicio/albañileria.jpg') }}" alt="Albañilería" class="carousel-image mx-auto">
                    <p class="mt-2 font-bold text-gray-800">Albañilería</p>
                </div>
            </div>
            <div class="carousel-item flex-shrink-0 w-full md:w-1/4 px-2">
                <div class="carousel-slide text-center">
                    <img src="{{ asset('storage/inicio/electricista.jpg') }}" alt="Electricista" class="carousel-image mx-auto">
                    <p class="mt-2 font-bold text-gray-800">Electricista</p>
                </div>
            </div>
            <div class="carousel-item flex-shrink-0 w-full md:w-1/4 px-2">
                <div class="carousel-slide text-center">
                    <img src="{{ asset('storage/inicio/mecanico.jpg') }}" alt="Mecánico" class="carousel-image mx-auto">
                    <p class="mt-2 font-bold text-gray-800">Mecánico</p>
                </div>
            </div>
            <div class="carousel-item flex-shrink-0 w-full md:w-1/4 px-2">
                <div class="carousel-slide text-center">
                    <img src="{{ asset('storage/inicio/plomeria.jpg') }}" alt="Plomería" class="carousel-image mx-auto">
                    <p class="mt-2 font-bold text-gray-800">Plomería</p>
                </div>
            </div>
        </div>

        <!-- Botones de control -->
        <button class="carousel-btn prev" onclick="prevSlide()">&#10094;</button>
        <button class="carousel-btn next" onclick="nextSlide()">&#10095;</button>
    </div>
</div>



<div class="container mx-auto py-12">
    <div class="flex justify-center items-center">
        <div class="w-full max-w-4xl bg-custom-orange p-10 rounded-lg shadow-xl mx-auto">
            <h2 class="text-3xl text-center font-bold mb-6">TODO EN 3 PASOS</h2>
            <div class="flex items-center justify-end px-6">
                <!-- Imagen -->
                <div class="w-1/3">
                    <img src="{{ asset('storage/inicio/hombreseñalando.png') }}" alt="Imagen ilustrativa" class="mx-auto max-w-xs">
                </div>
                <!-- Pasos -->
                <div class="space-y-6">
                    <!-- Paso 1 -->
                    <div class="flex items-center space-x-4 bg-white p-4 rounded-lg shadow-md">
                        <div class="bg-orange-500 text-white text-xl font-bold h-12 w-12 flex items-center justify-center rounded-full">
                            1
                        </div>
                        <p class="text-gray-800 font-semibold">Crea tu perfil como profesional o cliente.</p>
                    </div>
                    <!-- Paso 2 -->
                    <div class="flex items-center space-x-4 bg-white p-4 rounded-lg shadow-md">
                        <div class="bg-orange-500 text-white text-xl font-bold h-12 w-12 flex items-center justify-center rounded-full">
                            2
                        </div>
                        <p class="text-gray-800 font-semibold">Busca el servicio que necesitas <br> y elige al mejor profesional.</p>
                        
                    </div>
                    <!-- Paso 3 -->
                    <div class="flex items-center space-x-4 bg-white p-4 rounded-lg shadow-md">
                        <div class="bg-orange-500 text-white text-xl font-bold h-12 w-12 flex items-center justify-center rounded-full">
                            3
                        </div>
                        <p class="text-gray-800 font-semibold">El profesional realiza el trabajo <br> y luego puedes calificarlo.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Incluir el footer -->
@include('footer')
<script src="{{ asset('js/carousel.js') }}"></script>

</body>





