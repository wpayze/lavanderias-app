<form action="{{ route('saveAccount') }}" method="post">
    @csrf
    <div class="shadow overflow-hidden sm:rounded-md">
        <div class="px-4 py-5 bg-white sm:p-6">
            <label class="block text-sm font-medium text-gray-700 mt-3">EMAIL:</label>
            <input ype="text" name="email" class="mt-1 form-input block w-full" />

            <label class="block text-sm font-medium text-gray-700 mt-3">NOMBRE DE USUARIO:</label>
            <input ype="text" name="username" class="mt-1 form-input block w-full" />

            <label class="block text-sm font-medium text-gray-700 mt-3">COMPANY:</label>
            <input ype="text" name="company" class="mt-1 form-input block w-full" />

            <br>
            <button type="submit" class="p-2 my-2 bg-blue-500 text-white rounded-md focus:outline-none focus:ring-2 ring-blue-300 ring-offset-2">Guardar</button>
            {{-- <button type="button" onclick="deletePieceType()" class="p-2 my-2 bg-red-500 text-white rounded-md focus:outline-none focus:ring-2 ring-blue-300 ring-offset-2">Borrar</button> --}}
        </div>
    </div>
</form>

