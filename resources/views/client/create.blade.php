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
                      <h3 class="text-lg font-medium leading-6 text-gray-900">Informaci&oacute;n del Nuevo Cliente</h3>
                      <p class="mt-1 text-sm text-gray-600">
                        Porfavor, ingrese la informaci&oacute;n a continuaci&oacute;n.
                      </p>
                    </div>
                  </div>
                  <div class="mt-5 md:mt-0 md:col-span-2">
                    <form action="{{ route('clientes.store') }}" method="POST">
                    @csrf
                      <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                          <div class="grid grid-cols-12 gap-6">

                            <div class="col-span-12">
                              <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                              <input id="name" name="name" type="text" class="form-input mt-1 block w-full" placeholder="Nombre del cliente" required>
                            </div>

                            <div class="col-span-12">
                                <label for="identity" class="block text-sm font-medium text-gray-700">Identidad</label>
                                <input id="identity" name="identity" type="number" class="form-input mt-1 block w-full" placeholder="Identidad del cliente" required>
                            </div>

                            <div class="col-span-12">
                                <label for="email" class="block text-sm font-medium text-gray-700">Correo Electr&oacute;nico</label>
                                <input id="email" name="email" type="email" class="form-input mt-1 block w-full" placeholder="Correo del cliente">
                            </div>

                            <div class="col-span-12">
                                <label for="telephone" class="block text-sm font-medium text-gray-700">Tel&eacute;fono/Celular</label>
                                <input id="telephone" name="telephone" type="number" class="form-input mt-1 block w-full" placeholder="Celular del cliente">
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
</x-app-layout>

