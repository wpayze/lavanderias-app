<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Clientes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="lg:max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white lg:overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">

                @if (session()->has('message'))
                    <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                      <div class="flex">
                        <div>
                          <p class="text-sm">{{ session('message') }}</p>
                        </div>
                      </div>
                    </div>
                @endif

                <a href="{{route('clientes.create')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Crear nuevo cliente</a>

                {!! $clients->links() !!}
                <br>

                <table class="table-auto w-full bg-white">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2">Identidad</th>
                            <th class="px-4 py-2">Nombre</th>
                            <th class="px-4 py-2">Tel&eacute;fono</th>
                            <th class="px-4 py-2">Correo Electr&oacute;nico</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clients as $client)
                            <tr>
                                <td class="border px-4 py-2">{{$client->identity}}</td>
                                <td class="border px-4 py-2">{{$client->name}}</td>
                                <td class="border px-4 py-2">{{$client->telephone}}</td>
                                <td class="border px-4 py-2">{{$client->email}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
