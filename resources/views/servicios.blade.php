<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Servicios</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">

  <!-- Search Bar -->
  <div class="flex justify-center p-12 items-center">
    <div class="w-full max-w-md">
      <label class="block text-orange-500 text-xl font-bold mb-2" for="search">Buscar por oficio</label>
      <div class="relative">
        <form method="GET" action="{{ route('servicios') }}">
          <input type="text" id="search" name="search" placeholder="Buscar oficio..." class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500" value="{{ request('search') }}">
          <button type="submit" class="absolute inset-y-0 right-0 flex items-center pr-3">
            <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.9 14.32a7 7 0 111.414-1.414l4.387 4.387a1 1 0 01-1.414 1.414l-4.387-4.387zM14 7a5 5 0 11-10 0 5 5 0 0110 0z" clip-rule="evenodd"></path></svg>
          </button>
        </form>
      </div>
    </div>
  </div>
  <!-- Search Bar -->


  <div class="flex flex-col md:flex-row p-2">
    <!-- Sidebar
    <aside class="w-full md:w-1/5 text-black p-4 mb-4 md:mb-0">
      <ul>
        <li class="mb-6"><a href="#" class="text-black">Gasfitería</a></li>
        <li class="mb-6"><a href="#" class="text-black">Electricidad</a></li>
        <li class="mb-6"><a href="#" class="text-black">Albañilería</a></li>
        <li class="mb-6"><a href="#" class="text-black">Carpintería</a></li>
        <li class="mb-6"><a href="#" class="text-black">Pintura</a></li>
        <li class="mb-6"><a href="#" class="text-black">Cerrajería</a></li>
        <li class="mb-6"><a href="#" class="text-black">Tecnología</a></li>
      </ul>
    </aside>
    -->



    <!-- Main Content -->
    @if($trabajadores->isEmpty())
      <div class="w-full p-36">
        <div class = "w-full p-6 flex justify-center items-center">
          <p class="text-center text-gray-500 text-xl">No se encontraron trabajadores para esa búsqueda.</p>
        </div>
      </div>
    @else
      <div class="w-full p-6">
          <!-- Card Container -->
          <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($trabajadores as $trabajador)
              <!-- Individual Card -->
              <div class="bg-white border border-orange-200 rounded-lg shadow-md p-4 text-center">
                <img src="{{ asset('storage/userDefault.jpg') }}" alt="Profesional" class="w-24 h-24 mx-auto rounded-full mb-4">
                <h3 class="text-lg font-semibold">{{ $trabajador->nombres_t }} {{ $trabajador->apellidos_t }}</h3>
                <p class="text-gray-500">Especialidad: {{ $trabajador->oficio_tmp }}</p>
                <p class="text-gray-500">Puntuación:</p>
                <div class="flex justify-center mt-2">
                  <!-- Estrellas de puntuación -->
                  <?php
                    $stars = $trabajador->puntuacion;
                    for ($i = 0; $i < $stars; $i++) {
                      echo '<svg class="w-6 h-6 text-yellow-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.966a1 1 0 00.95.69h4.167c.969 0 1.371 1.24.588 1.81l-3.363 2.456a1 1 0 00-.364 1.118l1.286 3.966c.3.921-.755 1.688-1.539 1.118L10 13.347l-3.363 2.456c-.784.57-1.838-.197-1.539-1.118l1.286-3.966a1 1 0 00-.364-1.118L2.657 9.393c-.783-.57-.38-1.81.588-1.81h4.167a1 1 0 00.95-.69l1.286-3.966z"/></svg>';
                    }
                  ?>
                </div>
              </div>
              <!-- End individual Card --> 
            @endforeach
            <!-- Separe search -->
          </div>
        <!-- End card Container -->
      </div>
    @endif
      <!-- End Main Content -->
  </div>    
</body>
</html>
