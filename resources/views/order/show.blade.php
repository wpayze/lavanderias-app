<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("ORDEN") }}
        </h2>
    </x-slot>


    <div class="max-w-7xl mx-auto mt-9 rounded shadow-xl bg-white p-8">
        <a href="{{route('ordenes.create')}}" class="mb-10 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Crear nueva</a>
        <a href="{{route('ordenes.edit', $order->id)}}" class="mb-10 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Editar</a>
    </div>

    <div class="max-w-7xl mx-auto mt-9 rounded shadow-xl bg-white p-8">
        <p class="text-3xl">Orden N. {{$order->id}}</p>
        <x-jet-section-border  />
        <div class="grid grid-cols-12">
            <div class="col-span-6">
                <p class="text-xl"><strong>Fecha de Ingreso:</strong> {{$order->entrance_date}}</p>
                <p class="text-xl"><strong>Fecha de Finalizaci&oacute;n:</strong> {{$order->ending_date}}</p>
                <p class="text-xl"><strong>Fecha de Salida:</strong> {{$order->delivery_date}}</p>
            </div>
            <div class="col-span-6">
                <p class="text-xl"><strong>N&uacute;mero de Bolsas:</strong> {{$order->bags}} </p>
                <p class="text-xl"><strong>Estado:</strong> {{$order->state}}</p>
            </div>
        </div>
        <x-jet-section-border  />
        <div class="grid grid-cols-12">
            <div class="col-span-6">
                <p class="text-2xl"><strong>Cliente:</strong></p>
            </div>
            <div class="col-span-6">
                <p class="text-xl"><strong>Nombre:</strong> {{$order->client->name}}</p>
                <p class="text-xl"><strong>Identidad:</strong> {{$order->client->identity}}</p>
                <p class="text-xl"><strong>Email:</strong> {{$order->client->email}}</p>
                <p class="text-xl"><strong>Tel&eacute;fono:</strong> {{$order->client->telephone}}</p>
            </div>
        </div>
        <x-jet-section-border  />
        <div class="grid grid-cols-12">
            <div class="col-span-6">
                <p class="text-2xl"><strong>Servicios Brindados:</strong></p>
            </div>
            <div class="col-span-6">
                <ul class="list-disc">
                    @foreach ($order->serviceTypes as $serviceType)
                        <li class="text-xl">{{$serviceType->name}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <x-jet-section-border  />
        <table class="table-fixed w-full">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2">Tipo de Pieza</th>
                    <th class="px-4 py-2">Cantidad</th>
                    <th class="px-4 py-2">Peso (Libras)</th>
                    <th class="px-4 py-2">Precio</th>
                    <th class="px-4 py-2">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->pieceTypes as $pieceType)
                    <tr class="text-center">
                        <td class="border px-4 py-2">{{$pieceType->name}}</td>
                        <td class="border px-4 py-2">{{$pieceType->pivot->quantity}}</td>
                        <td class="border px-4 py-2">{{$pieceType->pivot->weight}}</td>
                        <td class="border px-4 py-2">{{$pieceType->pivot->price}}

                            @if ($pieceType->charge_by == "peso")
                                por Libra.
                            @elseif ($pieceType->charge_by == "pieza")
                                por Pieza.
                            @endif

                        </td>
                        <td class="border px-4 py-2">
                            @if ($pieceType->charge_by == "peso")
                                {{ number_format( $pieceType->pivot->weight * $pieceType->pivot->price ,2) }}
                            @elseif ($pieceType->charge_by == "pieza")
                            {{ number_format( $pieceType->pivot->quantity * $pieceType->pivot->price ,2) }}
                            @endif

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <x-jet-section-border  />
        <div class="grid grid-cols-12">
            <div class="col-span-6">
                <p class="text-2xl"><strong>Observaciones:</strong></p>
                <p class="text-lg">{{$order->observations}}</p>
            </div>
            <div class="col-span-6 text-center">
                <p class="text-2xl"><strong>Total:</strong></p>
                <p class="text-xl">L. {{$order->total}}</p>
            </div>
        </div>

    </div>

</x-app-layout>
