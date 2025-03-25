<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Crear Viaje') }}
      </h2>
  </x-slot>

  <div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <a 
        href="{{route("trips")}}" 
        class="p-3 text-blue-500 rounded-lg hover:bg-blue-800 hover:text-white transition border-2 border-solid border-blue-500 cursor-hover flex gap-3 items-center w-32 mb-3"
      >
        <i class="fa-solid fa-rotate-left"></i>
        <p>
          Volver
        </p>
      </a>
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <form action="{{route("trips.store")}}" method="post" class="mt-6 space-y-6">
            @csrf
            <div>
              <legend class="text-center font-bold font-outtfit text-3xl">
                Registrar Viaje
              </legend>
            </div>
            <p class="text-center text-sm">
              Registre un nuevo viaje llenando el siguiente formulario
            </p>
            <div class="flex gap-10 w-full items-center">
              <div class="w-1/2">
                <x-input-error class="my-2" :messages="$erros->get("origin")" /> 
                <x-input-label for="origin" :value="__('Origen')" />
                <select name="origin" id="origin" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                  <option value="0" disabled selected> -- Seleccione -- </option>
                  @foreach ($terminals as $terminal)
                    <option value="{{$terminal->id}}">{{$terminal->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="w-1/2">
                <x-input-error class="my-2" :messages="$erros->get("destination")" /> 
                <x-input-label for="destination" :value="__('Destino')" />
                <select name="destination" id="destination" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                  <option value="0" disabled selected> -- Seleccione -- </option>
                  @foreach ($terminals as $terminal)
                    <option value="{{$terminal->id}}">{{$terminal->name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="flex gap-10 py-3 w-full">
              <div class="w-1/2">
                <x-input-error class="my-2" :messages="$erros->get("output_date")" />
                <x-input-label for="output_date" :value="__('Fecha de Salida')" />
                <x-text-input id="output_date" name="output_date" type="date" class="mt-1 block w-full" :value="old('output_date', '')" required autofocus />
              </div>
              <div class="w-1/2">
                <x-input-error class="my-2" :messages="$erros->get("output_time")" /> 
                <x-input-label for="output_time" :value="__('Hora de Salida')" />
                <x-text-input id="output_time" name="output_time" type="time" class="mt-1 block w-full" :value="old('output_time', '')" required autofocus />
              </div>
            </div>
            <div class="w-full flex gap-10"> 
              <div class="w-1/2">
                <x-input-error class="my-2" :messages="$erros->get("arrival_date")" />
                <x-input-label for="arrival_date" :value="__('Fecha de Llegada')" />
                <x-text-input id="arrival_date" name="arrival_date" type="date" class="mt-1 block w-full" :value="old('arrival_date', '')" required autofocus />
              </div>
              <div class="w-1/2">
                <x-input-error class="my-2" :messages="$erros->get("arrival_time")" /> 
                <x-input-label for="arrival_time" :value="__('Hora de Llegada')" />
                <x-text-input id="arrival_time" name="arrival_time" type="time" class="mt-1 block w-full" :value="old('arrival_time', '')" required autofocus />
              </div>
            </div>
            <div class="w-full flex gap-10">
              <div class="w-1/2">
                <x-input-error class="my-2" :messages="$erros->get("truck_id")" /> 
                <x-input-label for="truck_id" :value="__('Camión Asignado')" />
                <select name="truck_id" id="truck_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                  <option value="0" disabled selected> -- Seleccione -- </option>
                  @foreach ($trucks as $truck)
                    <option value="{{$truck->id}}">
                      {{$truck->brand . " - " . $truck->model}}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="flex w-full mt-5">
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