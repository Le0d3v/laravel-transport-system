<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Conductores') }}
      </h2>
  </x-slot>

  <div class="py-8">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 text-gray-900">
                  <a href="{{route("terminals.create")}}" class="p-3 text-blue-500 rounded-lg hover:bg-blue-800 hover:text-white transition border-2 border-solid border-blue-500 cursor-hover flex gap-3 items-center w-48">
                    <i class="fa-solid fa-circle-plus"></i>
                    <p>
                      Nueva Terminal
                    </p>
                  </a>
                  @if (count($terminals) === 0)
                    <p class="text-center">
                      Sin registros
                    </p>
                  @endif
                  <div class="mt-5 w-full grid grid-cols-3 gap-5">
                    @foreach ($terminals as $terminal)
                      <div class="p-3 border-2 border-blue-500 rounded">
                        <h1 class="text-center text-blue-500 font-outtfit text-2xl font-bold">
                          {{$terminal->name}}
                        </h1>
                        <div class="w-full flex justify-center mt-5">
                          <div class="flex gap-5 items-center">
                            <a 
                              href="#" 
                              class="p-1 rounded bg-green-500 text-white hover:bg-green-700"
                            >
                              Ver Más
                            </a>
                            <a 
                              href="{{route("terminals.edit", $terminal->id)}}" 
                              class="p-1 rounded bg-blue-500 text-white hover:bg-blue-700"
                            >
                              Editar
                            </a>
                            <a 
                              href="{{route("terminals.destroy", $terminal->id)}}" 
                              class="p-1 rounded bg-red-500 text-white hover:bg-red-700"
                            >
                              Eliminar
                            </a>
                          </div>
                        </div>
                      </div>
                    @endforeach
                  </div>
              </div>
              <div class="p-3">
              </div>
          </div>
      </div>
  </div>
</x-app-layout>