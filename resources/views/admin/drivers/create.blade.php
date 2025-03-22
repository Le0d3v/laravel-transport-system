<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Conductores') }}
      </h2>
  </x-slot>

  <div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <a 
        href="{{route("drivers.index")}}" 
        class="p-3 text-blue-500 rounded-lg hover:bg-blue-800 hover:text-white transition border-2 border-solid border-blue-500 cursor-hover flex gap-3 items-center w-32 mb-3"
      >
        <i class="fa-solid fa-rotate-left"></i>
        <p>
          Volver
        </p>
      </a>
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <form action="{{route("drivers.store")}}" method="post" class="mt-6 space-y-6">
            @csrf
            <div>
              <legend class="text-center font-bold font-outtfit text-3xl">
                Registrar Nuevo Conductor
              </legend>
            </div>
            <p class="text-center text-sm">
              Registre un nuevo conductor llenando el siguiente formulario
            </p>
            <div class="flex gap-10 w-full">
              <div class="w-1/2">
                  <x-input-error class="my-2" :messages="$erros->get("name")"
                  <x-input-label for="name" :value="__('Nombre')" />
                  <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', '')" required autofocus />
              </div>
              <div class="w-1/2">
                  <x-input-error class="my-2" :messages="$erros->get("last_name")" />
                  <x-input-label for="last_name" :value="__('Apellio')" />
                  <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" :value="old('last_name', '')" required autofocus />
              </div>
            </div>
            <div class="w-full flex gap-10"> 
              <div class="w-1/2">
                  <x-input-error class="my-2" :messages="$erros->get("telephone")" />
                  <x-input-label for="telephone" :value="__('Teléfono (10 digitos)')" />
                  <x-text-input id="telephone" name="telephone" type="tel" class="mt-1 block w-full" :value="old('telephone', '')" required autofocus />
              </div>
              <div class="w-1/2">
                  <x-input-error class="my-2" :messages="$erros->get("email")" /> 
                  <x-input-label for="email" :value="__('Correo Eelectrónico')" />
                  <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', '')" required autofocus />
                </div>
              </div>
            <div class="flex gap-10 justify-end w-full">
              <button 
                type="submit" 
                class="p-3 text-blue-500 rounded-lg hover:bg-blue-800 hover:text-white transition border-2 border-solid border-blue-500 cursor-hover flex gap-3 items-center w-32 mb-3"
              >
                <i class="fa-solid fa-rotate-left"></i>
                Guardar
              </button>
            </div>
          </form>
        </div class="p-6 text-gray-900">
      </div>
    </div>
  </div>
</x-app-layout>