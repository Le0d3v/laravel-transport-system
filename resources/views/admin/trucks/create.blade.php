<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Camiones') }}
      </h2>
  </x-slot>

  <div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <a 
        href="{{route("trucks.index")}}" 
        class="p-3 text-blue-500 rounded-lg hover:bg-blue-800 hover:text-white transition border-2 border-solid border-blue-500 cursor-hover flex gap-3 items-center w-32 mb-3"
      >
        <i class="fa-solid fa-rotate-left"></i>
        <p>
          Volver
        </p>
      </a>
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <form action="{{route("trucks.store")}}" method="post" class="mt-6 space-y-6">
            @csrf
            <div>
              <legend class="text-center font-bold font-outtfit text-3xl">
                Registrar Camión
              </legend>
            </div>
            <p class="text-center text-sm">
              Registre un nuevo camión llenando el siguiente formulario
            </p>
            <div class="flex gap-10 w-full items-center">
              <div class="w-1/2">
                  <x-input-error class="my-2" :messages="$erros->get("brand")"
                  <x-input-label for="brand" :value="__('Marca del Camión')" />
                  <x-text-input id="brand" name="brand" type="text" class="mt-1 block w-full" :value="old('brand', '')" required autofocus />
              </div>
              <div class="w-1/2">
                  <x-input-error class="my-2" :messages="$erros->get("model")" />
                  <x-input-label for="model" :value="__('Modelo')" />
                  <x-text-input id="model" name="model" type="text" class="mt-1 block w-full" :value="old('model', '')" required autofocus />
              </div>
            </div>
            <div class="w-full flex gap-10"> 
              <div class="w-1/2">
                  <x-input-error class="my-2" :messages="$erros->get("plate")" />
                  <x-input-label for="plate" :value="__('Placa (5 carcateres)')" />
                  <x-text-input id="plate" name="plate" type="text" class="mt-1 block w-full" :value="old('plate', '')" required autofocus />
              </div>
              <div class="w-1/2">
                  <x-input-error class="my-2" :messages="$erros->get("capacity")" /> 
                  <x-input-label for="capacity" :value="__('Número de acientos')" />
                  <x-text-input id="capacity" name="capacity" type="number" class="mt-1 block w-full" :value="old('capacity', '')" required autofocus />
                </div>
              </div>
            </div>
            <div class="flex gap-10 px-5 py-3 w-full">
              <div class="w-1/2">
                <x-input-error class="my-2" :messages="$erros->get("driver_id")" /> 
                <x-input-label for="driver_id" :value="__('Conductor Asignado')" />
                <select name="driver_id" id="driver_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                  <option value="0" disabled selected> -- Seleccione -- </option>
                  @foreach ($drivers as $driver)
                    <option value="{{$driver->id}}">{{$driver->name . " " . $driver->last_name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="flex gap-10 justify-end w-full mt-5">
                <button 
                  type="submit" 
                  class="p-3 text-blue-500 rounded-lg hover:bg-blue-800 hover:text-white transition border-2 border-solid border-blue-500 cursor-hover flex gap-3 items-center w-32 mb-3"
                >
                  <i class="fa-solid fa-rotate-left"></i>
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