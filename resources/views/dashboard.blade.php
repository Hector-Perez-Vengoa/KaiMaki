<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if(auth()->user()->id_roles == 1) <!-- Si el id_roles es 1, por ejemplo, Cliente -->
                {{ __('Bienvenido, Cliente') }}
            @elseif(auth()->user()->id_roles == 2) <!-- Si el id_roles es 2, por ejemplo, Trabajador -->
                {{ __('Bienvenido, Trabajador') }}
            @else
                {{ __('Bienvenido') }}
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-welcome />
            </div>
        </div>
    </div>
</x-app-layout>
