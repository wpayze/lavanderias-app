<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Configuración') }}
        </h2>
    </x-slot>

    @if (session()->has('message'))
    <div class="max-w-7xl mx-auto">
        <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
        <div class="flex">
            <div>
            <p class="text-sm">{{ session('message') }}</p>
            </div>
        </div>
        </div>
    </div>
    @endif


    <div class="max-w-7xl mx-auto mt-9 rounded shadow-xl bg-white p-4">
        <h1 class="text-3xl">Empresa: {{ auth()->user()->company->name }}</h1>
    </div>

    <div class="max-w-7xl mx-auto mt-9 rounded shadow-xl lg:h-64 grid md:grid-cols-2 gap-4 bg-white">

        <div class="p-9">
            <h1 class="text-3xl">Tipos de Servicio</h1>
            <br>
            <ul class="list-disc">
                @foreach ($service_types as $service_type)
                    <li>
                        <a class="text-lg font-bold hover:text-blue-500" href="{{ route('editServiceType', $service_type->id) }}">{{ $service_type->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="p-9">
            <h1 class="text-xl">Agregar un Tipo de Servicio</h1>

            <form action="{{ route('storeServiceType') }}" method="post">
                @csrf
                <input type="text" name="name" placeholder="Nombre del tipo de servicio" class="mt-1 form-input block w-full" />

                @error('name')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror

                <br>
                <button type="submit" class="p-2 my-2 bg-blue-500 text-white rounded-md focus:outline-none focus:ring-2 ring-blue-300 ring-offset-2">Agregar</button>
            </form>

        </div>
    </div>

    <div class="max-w-7xl mx-auto mt-9 shadow-xl rounded grid md:grid-cols-2 gap-4 bg-white">

        <div class="p-9">
            <h1 class="text-3xl">Tipos de Piezas</h1>
            <br>

            <div class="grid grid-cols-12">
                @foreach ($piece_types as $piece_type)
                    <div onclick="redirect('{{route('editPieceType', $piece_type->id)}}')" class="col-span-12 md:col-span-4 m-3 border-2 p-3 rounded-xl bg-blue-100 cursor-pointer hover:bg-blue-200">
                        <p class="text-lg font-bold">{{ $piece_type->name }}</p>
                        @if(isset($piece_type->price))
                            <p class="text-md">Precio: L. {{$piece_type->price}} </p>
                        @endif
                        @if(isset($piece_type->charge_by))
                            <p class="text-md">Cobrar por: {{$piece_type->charge_by}}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        <div class="p-9">
            <h1 class="text-xl">Agregar un Tipo de Pieza</h1>

            <form action="{{ route('storePieceType') }}" method="post">
                @csrf
                <label for="charge_by" class="block text-sm font-medium text-gray-700 mt-3">Nombre:</label>
                <input id="name" type="text" name="name" placeholder="Nombre del tipo de pieza" class="mt-1 form-input block w-full" />

                @error('name')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror

                <label for="price" class="block text-sm font-medium text-gray-700 mt-3">Precio (Por Peso/Por Pieza):</label>
                <input id="price" type="number" name="price" placeholder="Precio tentativo" class="mt-1 form-input block w-full" />

                <label for="charge_by" class="block text-sm font-medium text-gray-700 mt-3">Cobrar por:</label>
                <select id="charge_by" name="charge_by" class="mt-1 form-select block w-full">
                    <option value="peso">Peso (Libra)</option>
                    <option value="pieza">Pieza</option>
                </select>

                <br>
                <button type="submit" class="p-2 my-2 bg-blue-500 text-white rounded-md focus:outline-none focus:ring-2 ring-blue-300 ring-offset-2">Agregar</button>
            </form>

        </div>
    </div>

    @once
        @push('scripts')
            <script>
                let redirect = (url) => {
                    window.location.href = url;
                }
            </script>
        @endpush
    @endonce

</x-app-layout>
