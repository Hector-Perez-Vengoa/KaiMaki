<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalle del Problema') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Detalle del Problema</h3>
                <p><strong>Cliente:</strong> {{ $problema->cliente->nom_cliente }}</p>
                <p><strong>Oficio:</strong> {{ $problema->oficio->nombre_oficio }}</p>
                <p><strong>Estado:</strong> {{ $problema->estadoProblema->nombre_estado }}</p>
                <p><strong>Descripción:</strong> {{ $problema->descripcion }}</p>
                <p><strong>Monto:</strong> {{ $problema->monto }}</p>
                <p><strong>Fecha:</strong> {{ $problema->fecha }}</p>
                @if($problema->imagen)
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $problema->imagen) }}" alt="Imagen del problema" class="max-w-full h-auto rounded-lg">
                    </div>
                @endif
            
            </div>
        </div>
    </div>
</x-app-layout>
