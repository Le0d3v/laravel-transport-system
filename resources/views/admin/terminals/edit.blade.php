<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Actualizar Terminal') }}
      </h2>
  </x-slot>

  <div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <a 
        href="{{route("terminals.index")}}" 
        class="p-3 text-blue-500 rounded-lg hover:bg-blue-800 hover:text-white transition border-2 border-solid border-blue-500 cursor-hover flex gap-1 items-center w-24 mb-3"
      >
        <i class="fa-solid fa-rotate-left"></i>
        <p>
          Volver
        </p>
      </a>
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg h-full">
        <div class="p-6 text-gray-900">
          <form action="{{route("terminals.update", $terminal->id)}}" method="post" class="mt-6 space-y-6">
            @csrf
            <div>
              <legend class="text-center font-bold font-outtfit text-3xl">
                Actualizar Terminal: {{$terminal->name}}
              </legend>
            </div>
            <p class="text-center text-sm">
              Actualice la información de la Terminal llenando el siguiente formulario
            </p>
            <div class="flex gap-10 w-full items-center">
              <div class="w-1/2">
                  <x-input-error class="my-2" :messages="$erros->get("name")">
                  <x-input-label for="name" :value="__('Nombre de la Terminal')" />
                  <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="$terminal->name" required autofocus />
              </div>
              <div class="w-1/2">
                  <x-input-error class="my-2" :messages="$erros->get("telephone")" />
                  <x-input-label for="telephone" :value="__('Telefóno (10 digitos)')" />
                  <x-text-input id="telephone" name="telephone" type="tel" class="mt-1 block w-full" :value="$terminal->telephone" required autofocus />
              </div>
            </div>
            <div class="w-full flex gap-10"> 
              <div class="w-1/2">
                  <x-input-error class="my-2" :messages="$erros->get("address")" />
                  <x-input-label for="address" :value="__('Dirección')" />
                  <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="$terminal->address" required autofocus />
              </div>
              <div class="w-1/2">
                  <x-input-error class="my-2" :messages="$erros->get("cp")" /> 
                  <x-input-label for="cp" :value="__('Código Postal (5 Digitos)')" />
                  <x-text-input id="cp" name="cp" type="number" class="mt-1 block w-full" :value="$terminal->cp" required autofocus />
                </div>
              </div>
            </div>
            <div class="flex gap-10 w-full items-center px-5">
              <div class="w-1/2">
                  <x-input-error class="my-2" :messages="$erros->get("state")">
                  <x-input-label for="state" :value="__('Estado')" />
                  <x-text-input id="state" name="state" type="text" class="mt-1 block w-full" :value="$terminal->state" required autofocus />
              </div>
              <div class="w-1/2">
                <x-input-error class="my-2" :messages="$erros->get("status")" /> 
                <x-input-label for="status" :value="__('Estado de la Terminal')" />
                <select name="status" id="status" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                  <option value="0" disabled selected> -- Seleccione -- </option>
                  <option value="1" {{$terminal->status === "1" ? "selected" : ""}}>Activa</option>
                  <option value="2" {{$terminal->status === "1" ? "selected" : ""}}>Inactiva</option>
                </select>
              </div>
            </div>
            <p class="px-5 mt-3">Datos de Coordenadas:</p>
            <div class="flex gap-10 w-full items-center px-5 my-5">
              <div class="w-1/2">
                  <x-input-error class="my-2" :messages="$erros->get("lat")">
                  <x-input-label for="lat" :value="__('Latitud')" />
                  <x-text-input id="lat" name="lat" type="text" class="mt-1 block w-full" :value="$terminal->lat" required autofocus />
              </div>
              <div class="w-1/2">
                  <x-input-error class="my-2" :messages="$erros->get("lng")" />
                  <x-input-label for="lng" :value="__('Longitud')" />
                  <x-text-input id="lng" name="lng" type="tel" class="mt-1 block w-full" :value="$terminal->lng" required autofocus />
              </div>
            </div>
            <div class="flex gap-10 px-5 py-3 w-full">
              <div class="flex gap-10 justify-end w-full mt-5">
                <button 
                  type="submit" 
                  class="p-3 text-blue-500 rounded-lg hover:bg-blue-800 hover:text-white transition border-2 border-solid border-blue-500 cursor-hover flex gap-3 items-center w-32 mb-3"
                >
                <i class="fa-solid fa-floppy-disk"></i>
                  Guardar
                </button>
              </div>
            </div>
          </form>
        </div class="p-6 text-gray-900">
      </div>
    </div>
  </div>
</x-app-layout>