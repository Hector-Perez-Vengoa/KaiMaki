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

    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

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

        <!-- Hero Section -->
        <div class="relative bg-cover bg-center" style="background-image: url('{{ asset('storage/about-us/portada.jpg') }}'); height: 40vh;">
            <!-- Capa de opacidad -->
            <div class="absolute inset-0 bg-black bg-opacity-1"></div>

        
            <!-- Contenido centrado -->
            <div class="absolute inset-0 flex flex-col items-center justify-center text-center text-white px-6">
                <h1 class="text-5xl font-bold mb-4">Acerca de Nosotros</h1>
                <p class="text-lg max-w-2xl">
                    Descubre nuestra misión, visión y el equipo que trabaja para transformar tus ideas en soluciones. <br>
                    En KaiMaki, creemos que la vida puede ser más fácil cuando tienes el apoyo adecuado. Por eso, 
                    creamos esta plataforma para conectar hogares con trabajadores confiables y capacitados que 
                    puedan ayudarte con esas tareas que a veces parecen complicadas o difíciles de gestionar.
                </p>
            </div>
        </div>
        
        
    
        <!-- Our History Section -->
        <div class="history-section py-12 px-6 bg-white-100">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl font-bold mb-6">¿Cómo Inició?</h2>
                <p class="text-gray-700 leading-relaxed">
                    Kai Maki nació de nuestra experiencia buscando soluciones confiables para el hogar, 
                    lo que nos inspiró a crear una plataforma accesible para todos.
                    Todos merecen acceso a servicios de calidad de manera rápida, confiable y sin complicaciones. 
                    Como equipo, hemos trabajado pensando en ambas partes: en quienes necesitan ayuda y en 
                    quienes ofrecen su talento para resolver esos problemas diarios.
                </p>
            </div>
        </div>
    
        <!-- Mission, Vision, and Values -->
        <div class="mission-vision-section py-12 px-6 bg-gray-100">
            <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-gray-50 p-6 shadow-lg rounded-md text-center">
                    <img src="{{ asset('storage/about-us/mision.png') }}" alt="Misión" class="w-16 h-16 mx-auto mb-4">
                    <h3 class="text-xl font-bold mb-4">Nuestra Misión</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Nuestra misión es simple: hacer que las personas puedan encontrar soluciones rápidas 
                        y seguras para sus necesidades del hogar, mientras ofrecemos oportunidades justas a 
                        los trabajadores que colaboran con nosotros.
                    </p>
                </div>
                <div class="bg-gray-50 p-6 shadow-lg rounded-md text-center">
                    <img src="{{ asset('storage/about-us/vision.png') }}" alt="Visión" class="w-16 h-16 mx-auto mb-4">
                    <h3 class="text-xl font-bold mb-4">Nuestra Visión</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Ser la plataforma líder en servicios a domicilio, destacándonos por la calidad y la innovación.
                    </p>
                </div>
                <div class="bg-gray-50 p-6 shadow-lg rounded-md text-center">
                    <img src="{{ asset('storage/about-us/valor.png') }}" alt="Valores" class="w-16 h-16 mx-auto mb-4">
                    <h3 class="text-xl font-bold mb-4">Nuestros Valores</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Confianza: Porque sabemos lo importante que es sentirte seguro en tu hogar. <br>
                        Eficiencia: Queremos que encuentres lo que necesitas en poco tiempo. <br>
                        Compromiso: Estamos aquí para asegurarnos de que tengas la mejor experiencia.
                    </p>
                </div>
            </div>
        </div>
    
        <!-- Team Section -->
        <<div class="team-section py-12 px-6 bg-white">
            <div class="max-w-6xl mx-auto">
                <h2 class="text-3xl font-bold text-center mb-8">Nuestro Equipo</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="team-member text-center">
                        <img src="{{ asset('storage/about-us/gato1.jpg') }}" alt="Team Member 1" class="w-22 h-22 rounded-full mx-auto mb-4 object-cover">
                        <h3 class="text-xl font-bold">Hector Henrique Perez Vengoa</h3>
                        <p class="text-gray-600">Gerente</p>
                    </div>
                    <div class="team-member text-center">
                        <img src="{{ asset('storage/about-us/gato2.jpg') }}" alt="Team Member 2" class="w-100 h-100 rounded-full mx-auto mb-4 object-cover">
                        <h3 class="text-xl font-bold">Hector Hanmer Castro Peñaloza</h3>
                        <p class="text-gray-600">Gerente</p>
                    </div>
                    <div class="team-member text-center">
                        <img src="{{ asset('storage/about-us/gato4.jpg') }}" alt="Team Member 3" class="w-80 h-60 rounded-full mx-auto mb-4 object-cover">
                        <h3 class="text-xl font-bold">Franklin Alvaro Huaytalla Rodriguez</h3>
                        <p class="text-gray-600">Gerente</p>
                    </div>
                </div>
            </div>
        </div>
        
             
        
        
    
        <!-- FAQ Section -->
        <div class="faq-section py-12 px-6 bg-gray-100">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-3xl font-bold text-center mb-6 text-orange-600">Preguntas Frecuentes</h2>
                <div class="space-y-6">
                    <!-- Pregunta 1 -->
                    <div class="faq-item">
                        <button class="faq-question flex justify-between items-center w-full py-4 px-6 bg-white shadow-md rounded-lg">
                            <span class="font-bold text-lg text-orange-600">¿Cómo puedo registrarme?</span>
                            <span class="faq-icon text-orange-600">+</span>
                        </button>
                        <div class="faq-answer hidden mt-2 px-6 text-gray-600">
                            Haz clic en "Registrarse" y sigue las instrucciones.
                        </div>
                    </div>
                    <!-- Pregunta 2 -->
                    <div class="faq-item">
                        <button class="faq-question flex justify-between items-center w-full py-4 px-6 bg-white shadow-md rounded-lg">
                            <span class="font-bold text-lg text-orange-600">¿Qué tipo de servicios puedo encontrar en KaiMaki?</span>
                            <span class="faq-icon text-orange-600">+</span>
                        </button>
                        <div class="faq-answer hidden mt-2 px-6 text-gray-600">
                            Puedes encontrar una amplia variedad de servicios, como limpieza, reparaciones, cuidado de mascotas, jardinería, entre otros.
                        </div>
                    </div>
                    <!-- Agrega más preguntas aquí -->
                    <div class="faq-item">
                        <button class="faq-question flex justify-between items-center w-full py-4 px-6 bg-white shadow-md rounded-lg">
                            <span class="font-bold text-lg text-orange-600">¿Cómo contacto con un trabajador?</span>
                            <span class="faq-icon text-orange-600">+</span>
                        </button>
                        <div class="faq-answer hidden mt-2 px-6 text-gray-600">
                            Una vez que encuentres al trabajador ideal en nuestra 
                            plataforma, puedes comunicarte directamente con él fuera de la página 
                            para coordinar los detalles del servicio.
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question flex justify-between items-center w-full py-4 px-6 bg-white shadow-md rounded-lg">
                            <span class="font-bold text-lg text-orange-600">¿Cómo sé si los trabajadores son confiables?</span>
                            <span class="faq-icon text-orange-600">+</span>
                        </button>
                        <div class="faq-answer hidden mt-2 px-6 text-gray-600">
                            Todos los trabajadores en KaiMaki son verificados antes 
                            de ser listados en la plataforma. Además, puedes revisar las calificaciones 
                            y comentarios de otros clientes para tomar una decisión informada.
                        </div>
                    </div>


                    <div class="faq-item">
                        <button class="faq-question flex justify-between items-center w-full py-4 px-6 bg-white shadow-md rounded-lg">
                            <span class="font-bold text-lg text-orange-600">¿Cuánto cuesta utilizar KaiMaki?</span>
                            <span class="faq-icon text-orange-600">+</span>
                        </button>
                        <div class="faq-answer hidden mt-2 px-6 text-gray-600">
                            La plataforma es completamente gratuita para los 
                            clientes. Solo pagas el servicio directamente al trabajador según lo acordado.
                        </div>
                    </div>


                    <div class="faq-item">
                        <button class="faq-question flex justify-between items-center w-full py-4 px-6 bg-white shadow-md rounded-lg">
                            <span class="font-bold text-lg text-orange-600">¿Cómo funcionan los reportes de los trabajadores?</span>
                            <span class="faq-icon text-orange-600">+</span>
                        </button>
                        <div class="faq-answer hidden mt-2 px-6 text-gray-600">
                            Después de completar un trabajo, el trabajador elabora 
                            un reporte detallado que incluye información sobre el servicio realizado, 
                            el monto acordado y los resultados obtenidos.
                        </div>
                    </div>


                    <div class="faq-item">
                        <button class="faq-question flex justify-between items-center w-full py-4 px-6 bg-white shadow-md rounded-lg">
                            <span class="font-bold text-lg text-orange-600">¿Qué pasa si tengo problemas con un servicio?</span>
                            <span class="faq-icon text-orange-600">+</span>
                        </button>
                        <div class="faq-answer hidden mt-2 px-6 text-gray-600">
                            En caso de cualquier inconveniente, puedes contactarnos 
                            a través de nuestro soporte para ayudarte a resolver el problema lo más rápido posible.
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question flex justify-between items-center w-full py-4 px-6 bg-white shadow-md rounded-lg">
                            <span class="font-bold text-lg text-orange-600">¿Cómo puedo convertirme en trabajador de KaiMaki?</span>
                            <span class="faq-icon text-orange-600">+</span>
                        </button>
                        <div class="faq-answer hidden mt-2 px-6 text-gray-600">
                            Si ofreces un servicio y quieres unirte a KaiMaki, 
                            puedes registrarte en nuestra plataforma. Luego, verificaremos tu perfil 
                            antes de hacerlo visible para los clientes.
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question flex justify-between items-center w-full py-4 px-6 bg-white shadow-md rounded-lg">
                            <span class="font-bold text-lg text-orange-600">¿KaiMaki garantiza los servicios ofrecidos?</span>
                            <span class="faq-icon text-orange-600">+</span>
                        </button>
                        <div class="faq-answer hidden mt-2 px-6 text-gray-600">
                            KaiMaki conecta a clientes y trabajadores, pero no garantiza 
                            los servicios directamente. Sin embargo, trabajamos para asegurarnos de que los 
                            trabajadores sean profesionales y confiables.
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question flex justify-between items-center w-full py-4 px-6 bg-white shadow-md rounded-lg">
                            <span class="font-bold text-lg text-orange-600">¿Cómo puedo contactar al equipo de KaiMaki?</span>
                            <span class="faq-icon text-orange-600">+</span>
                        </button>
                        <div class="faq-answer hidden mt-2 px-6 text-gray-600">
                            Puedes escribirnos a través de nuestro formulario de 
                            contacto en la página web o enviarnos un correo electrónico a 
                            <a href="https://mail.google.com/mail/?view=cm&fs=1&to=hola.kaimaki@gmail.com" 
                            target="_blank" class="hover:underline">hola.kaimaki@gmail.com</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


         

@include('footer')

<script src="{{ asset('js/customabout-us.js') }}"></script>
</body>