@include('header')

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

<div class="carousel-container bg-orange-100 py-6">
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
                    <p class="mt-2 font-bold text-gray-800">Obrero</p>
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
                    <p class="mt-2 font-bold text-gray-800">Plomero</p>
                </div>
            </div>
            <div class="carousel-item flex-shrink-0 w-full md:w-1/4 px-2">
                <div class="carousel-slide text-center">
                    <img src="{{ asset('storage/inicio/carpintero.jpg') }}" alt="Carpintero" class="carousel-image mx-auto">
                    <p class="mt-2 font-bold text-gray-800">Carpintero</p>
                </div>
            </div>
            <div class="carousel-item flex-shrink-0 w-full md:w-1/4 px-2">
                <div class="carousel-slide text-center">
                    <img src="{{ asset('storage/inicio/jardinero.jpg') }}" alt="Jardinero" class="carousel-image mx-auto">
                    <p class="mt-2 font-bold text-gray-800">Jardinero</p>
                </div>
            </div>
            <div class="carousel-item flex-shrink-0 w-full md:w-1/4 px-2">
                <div class="carousel-slide text-center">
                    <img src="{{ asset('storage/inicio/pintor.jpg') }}" alt="Pintor" class="carousel-image mx-auto">
                    <p class="mt-2 font-bold text-gray-800">Pintor</p>
                </div>
            </div>
            <div class="carousel-item flex-shrink-0 w-full md:w-1/4 px-2">
                <div class="carousel-slide text-center">
                    <img src="{{ asset('storage/inicio/cerrajero.jpg') }}" alt="Cerrajero" class="carousel-image mx-auto">
                    <p class="mt-2 font-bold text-gray-800">Cerrajero</p>
                </div>
            </div>
            <div class="carousel-item flex-shrink-0 w-full md:w-1/4 px-2">
                <div class="carousel-slide text-center">
                    <img src="{{ asset('storage/inicio/limpieza.jpg') }}" alt="Limpieza Profesional" class="carousel-image mx-auto">
                    <p class="mt-2 font-bold text-gray-800">Limpieza profesional</p>
                </div>
            </div>
            <div class="carousel-item flex-shrink-0 w-full md:w-1/4 px-2">
                <div class="carousel-slide text-center">
                    <img src="{{ asset('storage/inicio/t_aire.png') }}" alt="Técnico en aire acondicionado" class="carousel-image mx-auto">
                    <p class="mt-2 font-bold text-gray-800">Técnico en aire acondicionado</p>
                </div>
            </div>
            <div class="carousel-item flex-shrink-0 w-full md:w-1/4 px-2">
                <div class="carousel-slide text-center">
                    <img src="{{ asset('storage/inicio/reparaciones.jpg') }}" alt="Reparaciones" class="carousel-image mx-auto">
                    <p class="mt-2 font-bold text-gray-800">Reparaciones</p>
                </div>
            </div>
            <div class="carousel-item flex-shrink-0 w-full md:w-1/4 px-2">
                <div class="carousel-slide text-center">
                    <img src="{{ asset('storage/inicio/decoracion.png') }}" alt="Decoración" class="carousel-image mx-auto">
                    <p class="mt-2 font-bold text-gray-800">Decoración</p>
                </div>
            </div>
            <div class="carousel-item flex-shrink-0 w-full md:w-1/4 px-2">
                <div class="carousel-slide text-center">
                    <img src="{{ asset('storage/inicio/fotografia.jpg') }}" alt="Fotografía" class="carousel-image mx-auto">
                    <p class="mt-2 font-bold text-gray-800">Fotografía</p>
                </div>
            </div>
            <div class="carousel-item flex-shrink-0 w-full md:w-1/4 px-2">
                <div class="carousel-slide text-center">
                    <img src="{{ asset('storage/inicio/t_electronica.jpg') }}" alt="Técnico en electrónica" class="carousel-image mx-auto">
                    <p class="mt-2 font-bold text-gray-800">Técnico en electrónica</p>
                </div>
            </div>
            <div class="carousel-item flex-shrink-0 w-full md:w-1/4 px-2">
                <div class="carousel-slide text-center">
                    <img src="{{ asset('storage/inicio/peluqueria.jpg') }}" alt="Peluquería" class="carousel-image mx-auto">
                    <p class="mt-2 font-bold text-gray-800">Peluquería</p>
                </div>
            </div>
            <div class="carousel-item flex-shrink-0 w-full md:w-1/4 px-2">
                <div class="carousel-slide text-center">
                    <img src="{{ asset('storage/inicio/costurero.jpg') }}" alt="Costurero" class="carousel-image mx-auto">
                    <p class="mt-2 font-bold text-gray-800">Costurero</p>
                </div>
            </div>

            <div class="carousel-item flex-shrink-0 w-full md:w-1/4 px-2">
                <div class="carousel-slide text-center">
                    <img src="{{ asset('storage/inicio/entrenador.jpg') }}" alt="Entrenador profesional" class="carousel-image mx-auto">
                    <p class="mt-2 font-bold text-gray-800">Entrenador profesional</p>
                </div>
            </div>
            <div class="carousel-item flex-shrink-0 w-full md:w-1/4 px-2">
                <div class="carousel-slide text-center">
                    <img src="{{ asset('storage/inicio/mudanza.jpg') }}" alt="Mudanza" class="carousel-image mx-auto">
                    <p class="mt-2 font-bold text-gray-800">Mudanza</p>
                </div>
            </div>
            <div class="carousel-item flex-shrink-0 w-full md:w-1/4 px-2">
                <div class="carousel-slide text-center">
                    <img src="{{ asset('storage/inicio/a_contable.jpg') }}" alt="Asesoría Contable" class="carousel-image mx-auto">
                    <p class="mt-2 font-bold text-gray-800">Asesoría contable</p>
                </div>
            </div>
            <div class="carousel-item flex-shrink-0 w-full md:w-1/4 px-2">
                <div class="carousel-slide text-center">
                    <img src="{{ asset('storage/inicio/paseado_perros.jpeg') }}" alt="Paseador de perros" class="carousel-image mx-auto">
                    <p class="mt-2 font-bold text-gray-800">Paseador de perros</p>
                </div>
            </div>
        </div>

        <!-- Botones de control -->
        <button class="carousel-btn prev" onclick="prevSlide()">&#10094;</button>
        <button class="carousel-btn next" onclick="nextSlide()">&#10095;</button>
    </div>
</div>



<div id="todo-en-3-pasos" class=" container mx-auto py-12">
    <div class="flex justify-center items-center">
        <div class="w-full max-w-4xl bg-custom-orange p-10 rounded-lg shadow-xl mx-auto">
            <h2 class="text-3xl text-center font-bold mb-6">TODO EN 3 PASOS</h2>
            <div class="flex items-center justify-end px-6">
                <!-- Imagen solo visible en pantallas grandes -->
                <div class="w-full lg:w-1/3 hidden lg:block">
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





