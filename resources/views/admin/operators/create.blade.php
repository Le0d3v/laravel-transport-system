<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Registrar Operador') }}
      </h2>
  </x-slot>

  <div class="py-8">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 text-gray-900">
                <a href="{{route("operators")}}" class="p-3 bg-blue-600 text-white rounded hover:bg-blue-800 cursor-hover">
                    Volver
                  </a>
                <div class="mt-5">
                    <form method="POST" action="{{ route('operators.store') }}">
                      @csrf
              
                      <!-- Name -->
                      <div>
                          <x-input-label for="name" :value="__('Nombre')" />
                          <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Incluir mínimo un apellido"/>
                          <x-input-error :messages="$errors->get('name')" class="mt-2" />
                      </div>
              
                      <!-- Email Address -->
                      <div class="mt-4">
                          <x-input-label for="email" :value="__('Correo Elecrtónico')" />
                          <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="ejemplo@correo.com"/>
                          <x-input-error :messages="$errors->get('email')" class="mt-2" />
                      </div>
              
                      <!-- Password -->
                      <div class="mt-4">
                          <x-input-label for="password" :value="__('Contraseña de Cuenta (Min. 10 caracteres)')" />
              
                          <x-text-input id="password" class="block mt-1 w-full"
                                          type="password"
                                          name="password"
                                          required autocomplete="new-password"
                                          placeholder="Incluir números y carácteres especiales"
                                          />
              
                          <x-input-error :messages="$errors->get('password')" class="mt-2" />
                      </div>
              
                      <!-- Confirm Password -->
                      <div class="mt-4">
                          <x-input-label for="password_confirmation" :value="__('Confirme la Contraseña')" />
              
                          <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                          type="password"
                                          name="password_confirmation" required autocomplete="new-password" 
                                          placeholder="Su contraseña ingresada previamente"
                                          />
              
                          <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                      </div>
              
                      <div class="flex items-center justify-end mt-4">
                            <button 
                            type="submit" 
                            class="p-3 text-blue-500 rounded-lg hover:bg-blue-800 hover:text-white transition border-2 border-solid border-blue-500 cursor-hover flex gap-3 items-center w-32 mb-3"
                            >
                                <i class="fa-solid fa-floppy-disk"></i>
                                Guardar
                            </button>
                      </div>
                    </form>
                </div>
              </div>
          </div>
      </div>
  </div>
</x-app-layout>