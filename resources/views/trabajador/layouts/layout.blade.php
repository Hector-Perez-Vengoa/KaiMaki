@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <h1>Bienvenido al Layout del trabajador</h1>
                {{ $slot }}
            </div>
        </div>
    </div>
@endsection
