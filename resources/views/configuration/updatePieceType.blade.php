<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nuevo Cliente') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mt-10 sm:mt-0">
                <div class="md:grid md:grid-cols-3 md:gap-6">
                  <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                        <a href="{{route('configuracion')}}" class="p-2 my-2 bg-blue-500 text-white rounded-md focus:outline-none focus:ring-2 ring-blue-300 ring-offset-2">Regresar</a>
                        <br><br>
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Actualizar tipo de pieza</h3>
                        <p class="mt-1 text-sm text-gray-600">
                        Porfavor, ingrese la informaci&oacute;n a continuaci&oacute;n.
                      </p>
                    </div>
                  </div>
                  <div class="mt-5 md:mt-0 md:col-span-2">
                    <form action="{{ route('updatePieceType', $pieceType->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <label for="charge_by" class="block text-sm font-medium text-gray-700 mt-3">Nombre:</label>
                                <input id="name" value="{{$pieceType->name}}" type="text" name="name" placeholder="Nombre del tipo de pieza" class="mt-1 form-input block w-full" />

                                @error('name')
                                    <div class="text-red-500">{{ $message }}</div>
                                @enderror

                                <label for="price" class="block text-sm font-medium text-gray-700 mt-3">Precio (Por Peso/Por Pieza):</label>
                                <input id="price" value="{{$pieceType->price}}" type="number" name="price" placeholder="Precio tentativo" class="mt-1 form-input block w-full" />

                                <label for="charge_by" class="block text-sm font-medium text-gray-700 mt-3">Cobrar por:</label>
                                <select id="charge_by" name="charge_by" class="mt-1 form-select block w-full">
                                    <option value="peso"  @if ($pieceType->charge_by == "peso") selected @endif>Peso (Libra)</option>
                                    <option value="pieza" @if ($pieceType->charge_by == "pieza") selected @endif>Pieza</option>
                                </select>

                                <br>
                                <button type="submit" class="p-2 my-2 bg-blue-500 text-white rounded-md focus:outline-none focus:ring-2 ring-blue-300 ring-offset-2">Guardar</button>
                            </div>
                        </div>

                    </form>
                  </div>
                </div>
              </div>
        </div>
    </div>
</x-app-layout>

