<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Clientes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="lg:max-w-7xl mx-auto sm:px-6 lg:px-8 mb-5">
            <div class="lg:overflow-hidden shadow-xl sm:rounded-lg">
                @if (session()->has('message'))
                    <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                    <div class="flex">
                        <div>
                        <p class="text-sm">{{ session('message') }}</p>
                        </div>
                    </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="lg:max-w-7xl mx-auto sm:px-6 lg:px-8 mb-5">
            <div class="bg-white lg:overflow-hidden shadow-xl sm:rounded-lg">
                <div class="hover:bg-gray-200 cursor-pointer px-4 py-4" onclick="toggleFiltros()">
                    <p class="text-lg"> + Filtros</p>
                </div>
                <div id="filtros" class="px-4 py-4 hidden">
                    <form>
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-2">
                            <div class="col-span-3">
                                <label for="paginacion">Numero de Registros</label>
                                <select name="paginacion" class="form-select" onchange="filtrar()">
                                    <option value="15" @if ($paginacion == 15 ) selected @endif >15</option>
                                    <option value="25" @if ($paginacion == 25 ) selected @endif>25</option>
                                    <option value="50" @if ($paginacion == 50 ) selected @endif>50</option>
                                    <option value="100" @if ($paginacion == 100 ) selected @endif>100</option>
                                    <option value="500" @if ($paginacion == 500 ) selected @endif>500</option>
                                </select>
                            </div>
                            <div class="col-span-6">
                                <input type="search" value="{{$query}}" name="search" class="form-input inline w-full" placeholder="Nombre, Email, Identidad, Celular...">
                            </div>
                            <div class="col-span-3 text-center">
                                <button id="filtrarBtn" class="w-full inline p-2 bg-blue-500 text-white rounded-md focus:outline-none focus:ring-2 ring-blue-300 ring-offset-2" type="submit">Filtrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="lg:max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white lg:overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">

                <div class="mt-1">
                    <a href="{{route('clientes.create')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Crear nuevo cliente</a>
                </div>
                <div class="mt-4">
                    {!! $clients->links() !!}
                </div>

                <table class="table-auto w-full bg-white mt-4">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2">Identidad</th>
                            <th class="px-4 py-2">Nombre</th>
                            <th class="px-4 py-2">Tel&eacute;fono</th>
                            <th class="px-4 py-2">Correo Electr&oacute;nico</th>
                            <th class="px-4 py-2">...</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clients as $client)
                            <tr>
                                <td class="border px-4 py-2">{{$client->identity}}</td>
                                <td class="border px-4 py-2">{{$client->name}}</td>
                                <td class="border px-4 py-2">{{$client->telephone}}</td>
                                <td class="border px-4 py-2">{{$client->email}}</td>
                                <td class="border px-4 py-2">
                                    <a href="{{ route('clientes.edit', $client->id) }}">
                                        <i class="fas fa-pencil-alt cursor-pointer	text-blue-600 mx-1"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @once
        @push('scripts')
            <script>
                let filtrar = () => {
                    document.getElementById("filtrarBtn").click();
                }

                let toggleFiltros = () => {
                    $("#filtros").toggle("hidden");
                }
            </script>
        @endpush
    @endonce
</x-app-layout>
