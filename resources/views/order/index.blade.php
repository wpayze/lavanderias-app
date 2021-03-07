<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ordenes') }}
        </h2>
    </x-slot>

    <div class="py-12">
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
</x-app-layout>
