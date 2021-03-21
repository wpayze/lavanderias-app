<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Actualizar ' . $serviceType->name) }}
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
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Actualizar tipo de servicio</h3>
                        <p class="mt-1 text-sm text-gray-600">
                        Porfavor, ingrese la informaci&oacute;n a continuaci&oacute;n.
                      </p>
                    </div>
                  </div>
                  <div class="mt-5 md:mt-0 md:col-span-2">
                    <form action="{{ route('updateServiceType', $serviceType->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <label for="charge_by" class="block text-sm font-medium text-gray-700 mt-3">Nombre:</label>
                                <input id="name" value="{{$serviceType->name}}" type="text" name="name" placeholder="Nombre del tipo de servicio" class="mt-1 form-input block w-full" />

                                @error('name')
                                    <div class="text-red-500">{{ $message }}</div>
                                @enderror

                                <br>
                                <button type="submit" class="p-2 my-2 bg-blue-500 text-white rounded-md focus:outline-none focus:ring-2 ring-blue-300 ring-offset-2">Guardar</button>
                                {{-- <button type="button" onclick="deletePieceType()" class="p-2 my-2 bg-red-500 text-white rounded-md focus:outline-none focus:ring-2 ring-blue-300 ring-offset-2">Borrar</button> --}}
                            </div>
                        </div>

                    </form>

                    {{-- <form class="hidden" id="deletePieceType" action="{{ route('deletePieceType', $pieceType->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                    </form> --}}
                  </div>
                </div>
              </div>
        </div>
    </div>

    {{-- <div class="modal h-screen w-full fixed left-0 top-0 flex justify-center items-center bg-black bg-opacity-50 hidden">
        <!-- modal -->
        <div class="bg-white rounded shadow-lg w-1/3">
          <!-- modal header -->
          <div class="border-b px-4 py-2 flex justify-between items-center">
            <h3 class="font-semibold text-lg">Modal Title</h3>
            <button class="text-black close-modal">&cross;</button>
          </div>
          <!-- modal body -->
          <div class="p-3">
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rerum, delectus cumque fugiat nemo ducimus quae deserunt cupiditate sapiente incidunt aut accusantium dolore assumenda vitae similique, exercitationem voluptatum praesentium laboriosam nam.
          </div>
          <div class="flex justify-end items-center w-100 border-t p-3">
            <button class="bg-red-600 hover:bg-red-700 px-3 py-1 rounded text-white mr-1 close-modal">Cancel</button>
            <button class="bg-blue-600 hover:bg-blue-700 px-3 py-1 rounded text-white">Oke</button>
          </div>
        </div>
      </div> --}}

    @once
        @push('scripts')
            <script>
                // let deletePieceType = () => {
                //     if (confirm('¿Seguro que desea borrar este tipo de pieza?')) {
                //         document.getElementById("deletePieceType").submit();
                //     }
                // }
            </script>
        @endpush
    @endonce
</x-app-layout>

