<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nueva Orden') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mt-10 sm:mt-0">
                <div class="md:grid md:grid-cols-3 md:gap-6">
                  <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                      <h3 class="text-lg font-medium leading-6 text-gray-900">Informaci&oacute;n de la Nueva Orden</h3>
                      <p class="mt-1 text-sm text-gray-600">
                        Porfavor, ingrese la informaci&oacute;n a continuaci&oacute;n.
                      </p>
                    </div>
                  </div>
                  <div class="mt-5 md:mt-0 md:col-span-2">
                    <form action="{{ route('ordenes.store') }}" method="POST">
                        @csrf
                      <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                          <div class="grid grid-cols-12 gap-6">

                            <div class="col-span-12">
                              <label for="first_name" class="block text-sm font-medium text-gray-700">Cliente</label>
                              <select id="clientsearch" name="client_id" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></select>
                                @error("client_id")
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-span-12 lg:col-span-6">
                                <label for="bags" class="block text-sm font-medium text-gray-700">Cantidad de Bolsas</label>
                                <input id="bags" type="number" name="bags" placeholder="Cuantas bolsas tiene la orden..." class="form-input mt-1 block w-full" />
                            </div>

                            <div class="col-span-12 lg:col-span-6">
                                <label for="state" class="block text-sm font-medium text-gray-700">Estado</label>
                                <select id="state" name="state" class="mt-1 form-select block w-full">
                                    <option>INGRESADA</option>
                                    <option>EN PROCESO</option>
                                    <option>TERMINADO</option>
                                    <option>ENTREGADO</option>
                                </select>
                                @error("state")
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-span-12 lg:col-span-4">
                                <label for="entrance_date" class="block text-sm font-medium text-gray-700">Fecha de Entrada</label>
                                <input type="date" name="entrance_date" id="entrance_date" />
                                @error("entrance_date")
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-span-12 lg:col-span-4">
                                <label for="ending_date" class="block text-sm font-medium text-gray-700">Fecha de Finalizaci&oacute;n</label>
                                <input type="date" name="ending_date" id="ending_date" />
                            </div>

                            <div class="col-span-12 lg:col-span-4">
                                <label for="delivery_date" class="block text-sm font-medium text-gray-700">Fecha de Salida</label>
                                <input type="date" name="delivery_date" id="delivery_date" />
                            </div>

                            <div class="col-span-12">
                                <label for="observations" class="block text-sm font-medium text-gray-700">Observaciones</label>
                                <textarea id="observations" name="observations" class="form-textarea mt-1 block w-full" rows="3" placeholder="Notas y observaciones de la orden."></textarea>
                            </div>

                            <div class="col-span-12">
                                <x-jet-section-border  />
                            </div>

                            @if (count($service_types) > 0)
                                <div class="col-span-12">
                                    {{-- <div class="grid grid-cols-12 gap-2">
                                        <div class="col-span-10"> --}}
                                            <label for="service_type" class="block text-sm font-medium text-gray-700">Agregar Tipo de Servicio</label>
                                            <select id="service_type" onchange="addServiceType()" class="mt-1 form-select block w-full">
                                                <option value="0">
                                                    Elija un tipo de servicio...
                                                </option>
                                                @foreach ($service_types as $service_type)
                                                    <option value="{{$service_type->id}}">{{$service_type->name}}</option>
                                                @endforeach
                                            </select>
                                        {{-- </div> --}}

                                        {{-- <div class="col-span-2">
                                            <button onclick="addServiceType()" type="button" style="margin-top:22px;" class="border border-indigo-500 bg-indigo-500 text-white rounded-md px-4 py-2 transition duration-500 ease select-none hover:bg-indigo-600 focus:outline-none focus:shadow-outline">
                                                <strong>+</strong>
                                            </button>
                                        </div>
                                    </div> --}}

                                    <div id="service_types_div" class="mt-5">
                                    </div>
                                </div>
                            @else
                                <div class="col-span-12">
                                    <p class="text-lg text-red-500">Porfavor, crear <strong>tipos de servicios</strong> en la ventana "Configuraci&oacute;n"</p>
                                </div>
                            @endif

                            <div class="col-span-12">
                                <x-jet-section-border  />
                            </div>


                            @if (count($piece_types) > 0)
                                <div class="col-span-12">
                                    {{-- <div class="grid grid-cols-12 gap-2">
                                        <div class="col-span-10"> --}}
                                            <label for="piece_type" class="block text-sm font-medium text-gray-700">Agregar Tipo de Pieza</label>
                                            <select id="piece_type" class="mt-1 form-select block w-full" onchange="addPieceType()">
                                                <option value="0">
                                                    Elija un tipo de pieza...
                                                </option>
                                                @foreach ($piece_types as $piece_type)
                                                    <option value="{{$piece_type->id}}" price="{{$piece_type->price}}" charge_by="{{$piece_type->charge_by}}">{{$piece_type->name}}</option>
                                                @endforeach
                                            </select>
                                        {{-- </div> --}}

                                        {{-- <div class="col-span-2">
                                            <button type="button" onclick="addPieceType()" style="margin-top:22px;" class="border border-indigo-500 bg-indigo-500 text-white rounded-md px-4 py-2 transition duration-500 ease select-none hover:bg-indigo-600 focus:outline-none focus:shadow-outline">
                                                <strong>+</strong>
                                            </button>
                                        </div> --}}
                                    {{-- </div> --}}
                                    <div id="piece_types_div" class="mt-5">
                                    </div>
                                </div>
                            @else
                                <div class="col-span-12">
                                    <p class="text-lg text-red-500">Porfavor, crear <strong>tipos de pieza</strong> en la ventana "Configuraci&oacute;n"</p>
                                </div>
                            @endif



                            <div class="col-span-12">
                                <label for="total" class="block text-sm font-medium text-gray-700">Total</label>
                                <input id="total" type="number" name="total" placeholder="Total de la orden" class="mt-1 form-input block w-full" />
                            </div>

                          </div>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                          <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Guardar
                          </button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
        </div>
    </div>

    @once
        @push('scripts')
            <script>
                let existingServiceTypes = [];
                let existingPieceTypes = [];

                Date.prototype.toDateInputValue = (function() {
                    var local = new Date(this);
                    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
                    return local.toJSON().slice(0,10);
                });

                $(document).ready( function() {
                    $('#entrance_date').val(new Date().toDateInputValue());
                });

                <x-order-scripts />
            </script>
        @endpush
    @endonce
</x-app-layout>

