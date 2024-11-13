@extends('layouts.app')

@section('content')

<!-- Search Bar -->
<div class="flex justify-center p-6 items-center border-2">
  <div class="w-full max-w-md border-2">
    <label class="block text-xl font-bold mb-2 items-center" for="search">Buscar por oficio</label>
      <div class="relative border-2">
        <form method="GET" action="{{ route('servicios') }}">
          <input type="text" id="search" name="search" placeholder="Buscar oficio..." class="w-full max-w-xs px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2" value="{{ request('search') }}">
          <button type="submit" class="absolute inset-y-0 right-0 flex items-center pr-3">
            <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.9 14.32a7 7 0 111.414-1.414l4.387 4.387a1 1 0 01-1.414 1.414l-4.387-4.387zM14 7a5 5 0 11-10 0 5 5 0 0110 0z" clip-rule="evenodd"></path></svg>
          </button>
        </form>
      </div>
  </div>
</div>
<!-- Search Bar -->
 
<!-- Main Content -->
@if($trabajadores->isEmpty())
  <div class="w-full p-36">
    <div class="w-full p-6 flex justify-center items-center">
      <p class="text-center text-gray-500 text-xl">No se encontraron trabajadores para esa búsqueda.</p>
      <a href="{{ route('servicios') }}" class="mt-4 inline-block bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600">Intentar de nuevo</a>
    </div>
  </div>
@else
  <div class="w-full p-6">
    <!-- Card Container -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
      @foreach($trabajadores as $trabajador)
        <!-- Individual Card -->
        <div class="bg-white border border-orange-200 rounded-lg shadow-md p-4 text-center">
          <img src="{{ $trabajador->foto ? asset('storage/' . $trabajador->foto) : asset('storage/userDefault.png') }}" alt="Foto de perfil de {{ $trabajador->nombres_t }}" class="w-18 h-18 mx-auto rounded-full mb-4">
          <h3 class="text-lg font-semibold">{{ $trabajador->nombres_t }} {{ $trabajador->apellidos_t }}</h3>
          <p class="text-gray-500">Especialidad: {{ $trabajador->oficio_tmp }}</p>
          <p class="text-gray-500">Puntuación:</p>
          <div class="flex justify-center mt-2">
            @for ($i = 0; $i < ($trabajador->puntuacion > 5 ? 5 : max(0, $trabajador->puntuacion)); $i++)
              <svg class="w-6 h-6 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.966a1 1 0 00.95.69h4.167c.969 0 1.371 1.24.588 1.81l-3.363 2.456a1 1 0 00-.364 1.118l1.286 3.966c.3.921-.755 1.688-1.539 1.118L10 13.347l-3.363 2.456c-.784.57-1.838-.197-1.539-1.118l1.286-3.966a1 1 0 00-.364-1.118L2.657 9.393c-.783-.57-.38-1.81.588-1.81h4.167a1 1 0 00.95-.69l1.286-3.966z"/>
              </svg>
            @endfor
          </div>
        </div>
        <!-- End individual Card --> 
      @endforeach
    </div>
    <!-- End card Container -->
  </div>
@endif
<!-- End Main Content -->

@include('footer')

@endsection
