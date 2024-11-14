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

</head>
<body>
    <header class="bg-orange-500 text-white py-4 px-6 flex justify-between items-center shadow-lg">
        <!-- Logo -->
        <div class="flex items-center space-x-4">
            <a href=""></a>
            <h1 class="text-xl font-bold">KaiMaki</h1>
        </div>

        <!-- Navigation Links -->
        <nav class="ml-auto flex space-x-8">
            <a href=" " class="hover:underline hover:text-orange-300">Servicios</a>
            <a href="{{ url('/ayuda') }}" class="hover:underline hover:text-orange-300">Ayuda</a>
            <a href="{{ url('/nosotros') }}" class="hover:underline hover:text-orange-300">Nosotros</a>
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
            <a href=" " class="text-right  bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded mt-6 inline-block">Solicita un servicio</a>
        </div>
    </div>
</div>

<div class="bg-cover bg-center">
    <div class="container mx-auto py-5">
        <div class="flex justify-center space-x-8">
            <div class="text-center">
                <img src="{{ asset('storage/inicio/mecanico.jpg') }}" alt="Mecanico" class="w-50 h-80 object-cover rounded-lg">
                <p class="font-bold">Mecanico</p>
            </div>
            <div class="text-center">
                <img src="{{ asset('storage/inicio/electricista.jpg') }}" class="w-50 h-80 object-cover rounded-lg">
                <p class="font-bold">Electricista</p>
            </div>
            <div class="text-center">
                <img src="{{ asset('storage/inicio/plomeria.jpg') }}" class="w-50 h-80 object-cover rounded-lg">
                <p class="font-bold">Plomeria</p>
            </div>
            <div class="text-center">
                <img src="{{ asset('storage/inicio/albañileria.jpg') }}" class="w-50 h-80 object-cover rounded-lg">
                <p class="font-bold">Albañileria</p>
            </div>
        </div>
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
                <div class="w-2/4 space-y-6">
                    <div class="flex items-start space-x-4 p-4 bg-white rounded-md shadow-md  ">
                        <a href="#" class="bg-orange-500 text-white font-bold py-2 px-4 rounded hover:bg-orange-600">Clic aquí</a>
                        <p class="font-semibold">Registrate e ingresa como como  profesional o cliente.</p>
                    </div>
                    <div class="flex items-start space-x-4 p-4 bg-white rounded-md shadow-md ">
                        <a href="#" class="bg-orange-500 text-white font-bold py-2 px-4 rounded hover:bg-orange-600">Clic aquí</a>
                        <p class="font-semibold">Busca el servicio que  necesitas y elige al mejor profesional.</p>
                    </div>
                    <div class="flex items-start space-x-4 p-4 bg-white rounded-md shadow-md ">
                        <a href="#" class="bg-orange-500 text-white font-bold py-2 px-4 rounded hover:bg-orange-600">Clic aquí</a>
                        <p class="font-semibold">El profesional realiza el  trabajo y luego puedes calificarlo.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Incluir el footer -->
@include('footer')
</body>





