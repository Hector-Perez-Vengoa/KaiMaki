<x-app-layout>
    <div class="max-w-4xl mx-auto py-10">
        <h2 class="text-2xl font-bold mb-6">Completa tu Registro de Cliente</h2>

        @if (session('error'))
            <p class="text-red-500">{{ session('error') }}</p>
        @endif

        <form action="{{ route('cliente.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="nom_cliente" class="block font-medium">Nombre</label>
                <input type="text" id="nom_cliente" name="nom_cliente" class="form-input w-full" required>
            </div>

            <div>
                <label for="ape_cliente" class="block font-medium">Apellidos</label>
                <input type="text" id="ape_cliente" name="ape_cliente" class="form-input w-full" required>
            </div>

            <div>
                <label for="telefo_cliente" class="block font-medium">Teléfono</label>
                <input type="text" id="telefo_cliente" name="telefo_cliente" class="form-input w-full">
            </div>

            <div>
                <label for="dni" class="block font-medium">DNI</label>
                <input type="text" id="dni" name="dni" class="form-input w-full" required>
            </div>

            <div>
                <label for="ciudad" class="block font-medium">Ciudad</label>
                <input type="text" id="ciudad" name="ciudad" class="form-input w-full" required>
            </div>

            <div>
                <label for="distrito" class="block font-medium">Provincia</label>
                <input type="text" id="distrito" name="distrito" class="form-input w-full">
            </div>

            <div>
                <label for="direccion" class="block font-medium">Dirección</label>
                <input type="text" id="direccion" name="direccion" class="form-input w-full" required>
            </div>

            <div>
                <label for="sexo" class="block font-medium">Sexo</label>
                <select id="sexo" name="sexo" class="form-select w-full" required>
                    <option value="M">Masculino</option>
                    <option value="F">Femenino</option>
                </select>
            </div>

            <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600">
                Registrar
            </button>
        </form>
    </div>
</x-app-layout>
