<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ordenes') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="lg:max-w-7xl mx-auto sm:px-6 lg:px-8 mb-5">
            <div class="bg-white lg:overflow-hidden shadow-xl sm:rounded-lg">
                <div class="hover:bg-gray-200 cursor-pointer px-4 py-4" onclick="toggleFiltros()">
                    <p class="text-lg"> + Filtros</p>
                </div>
                <div id="filtros" class="px-4 py-4 hidden">
                    <form>
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-2">
                            <div class="md:col-span-3">
                                <label class="block">
                                    <span class="text-gray-700">ID</span>
                                    <input type="search" name="search[id]" @if( isset($query['id']) ) value="{{$query['id']}}" @endif class="form-input mt-1 block w-full" placeholder="">
                                </label>
                            </div>
                            <div class="md:col-span-3">
                                <label class="block">
                                    <span class="text-gray-700">Estado</span>
                                    <select name="search[state]" class="mt-1 form-select block w-full">
                                        <option @if ( isset($query["state"]) && $query["state"] == "TODOS" ) selected @endif>TODOS</option>
                                        <option @if ( isset($query["state"]) && $query["state"] == "INGRESADA" ) selected @endif>INGRESADA</option>
                                        <option @if ( isset($query["state"]) && $query["state"] == "EN PROCESO" ) selected @endif>EN PROCESO</option>
                                        <option @if ( isset($query["state"]) && $query["state"] == "TERMINADO" ) selected @endif>TERMINADO</option>
                                        <option @if ( isset($query["state"]) && $query["state"] == "ENTREGADO" ) selected @endif>ENTREGADO</option>
                                    </select>
                                </label>
                            </div>
                            <div class="md:col-span-3">
                                <span class="text-gray-700 block">Cliente</span>
                                <select id="clientsearch" name="search[client_id]" style="width: 100%"></select>
                            </div>
                            <div class="md:col-span-3">
                                <label class="block">
                                    <span class="text-gray-700">Bolsas</span>
                                    <input type="search" @if( isset($query['bags']) ) value="{{$query['bags']}}" @endif name="search[bags]" class="form-input mt-1 block w-full" placeholder="">
                                </label>
                            </div>

                            <div class="md:col-span-4 border-2 border-gray-300 p-2">
                                <span class="text-gray-700 block text-center">Fecha de Entrada</span>

                                <span class="text-gray-700 font-bold">Inicio:</span>
                                <input type="date" name="search[entrancemin]" @if( isset($query['entrancemin']) ) value="{{$query['entrancemin']}}" @endif>
                                <br>
                                <span class="text-gray-700 font-bold">Final:</span>
                                <input type="date" name="search[entrancemax]" @if( isset($query['entrancemax']) ) value="{{$query['entrancemax']}}" @endif>
                            </div>
                            <div class="md:col-span-4 border-2 border-gray-300 p-2">
                                <span class="text-gray-700 block text-center">Fecha de Finalizaci&oacute;n</span>
                                <span class="text-gray-700 font-bold">Inicio:</span>
                                <input type="date" name="search[endingmin]" @if( isset($query['endingmin']) ) value="{{$query['endingmin']}}" @endif>
                                <br>
                                <span class="text-gray-700 font-bold">Final:</span>
                                <input type="date" name="search[endingmax]" @if( isset($query['endingmax']) ) value="{{$query['endingmax']}}" @endif>
                            </div>
                            <div class="md:col-span-4 border-2 border-gray-300 p-2">
                                <span class="text-gray-700 block text-center">Fecha de Entrega</span>
                                <span class="text-gray-700 font-bold">Inicio:</span>
                                <input type="date" name="search[deliverymin]" @if( isset($query['deliverymin']) ) value="{{$query['deliverymin']}}" @endif>
                                <br>
                                <span class="text-gray-700 font-bold">Final:</span>
                                <input type="date" name="search[deliverymax]" @if( isset($query['deliverymax']) ) value="{{$query['deliverymax']}}" @endif>
                            </div>

                            <div class="md:col-span-12 text-center">
                                <button id="filtrarBtn" class="w-full inline p-2 bg-blue-500 text-white rounded-md focus:outline-none focus:ring-2 ring-blue-300 ring-offset-2" type="submit">Filtrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg px-4 py-4">

                @if (session()->has('message'))
                    <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                      <div class="flex">
                        <div>
                          <p class="text-sm">{{ session('message') }}</p>
                        </div>
                      </div>
                    </div>
                @endif

                <a href="{{route('ordenes.create')}}" class="mb-10 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Crear nueva orden</a>
                <br>
                {!! $orders->links() !!}
                <br>

                <table class="table-auto w-full bg-white">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2">ID</th>
                            <th class="px-4 py-2">Cliente</th>
                            <th class="px-4 py-2">Bolsas</th>
                            <th class="px-4 py-2">Fecha de Entrada</th>
                            <th class="px-4 py-2">Fecha de Salida</th>
                            <th class="px-4 py-2">Total</th>
                            <th class="px-4 py-2">Estado</th>
                            <th class="px-4 py-2">...</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr class="text-center">
                                <td class="border px-4 py-2">{{$order->id}}</td>
                                <td class="border px-4 py-2">{{$order->client->name}}</td>
                                <td class="border px-4 py-2">{{$order->bags}}</td>
                                <td class="border px-4 py-2">{{$order->entrance_date}}</td>
                                <td class="border px-4 py-2">{{$order->delivery_date}}</td>
                                <td class="border px-4 py-2">{{$order->total}}</td>
                                <td class="border px-4 py-2">{{$order->state}}</td>
                                <td class="border px-4 py-2">
                                    <a href="{{ route('ordenes.show', $order->id) }}">
                                        <i class="fas fa-eye cursor-pointer	text-blue-600 mx-1"></i>
                                    </a>
                                    <a href="{{ route('ordenes.edit', $order->id) }}">
                                        <i class="fas fa-pencil-alt cursor-pointer text-blue-600 mx-1"></i>
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

                $('#clientsearch').select2({
                    placeholder: 'Seleccione al Cliente',
                    ajax: {
                        url: '/ajax-client-search',
                        dataType: 'json',
                        delay: 250,
                        processResults: function (data) {
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        text: item.name,
                                        id: item.id
                                    }
                                })
                            };
                        },
                        cache: true
                    }
                });


            </script>
        @endpush
    @endonce
</x-app-layout>
