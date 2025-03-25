<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Viajes') }}
      </h2>
  </x-slot>

  <div class="py-8">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 text-gray-900">
                  <a href="{{route("trips.create")}}" class="p-3 text-blue-500 rounded-lg hover:bg-blue-800 hover:text-white transition border-2 border-solid border-blue-500 cursor-hover flex gap-3 items-center w-48">
                    <i class="fa-solid fa-circle-plus"></i>
                    <p>
                      Nuevo Viaje
                    </p>
                  </a>
                  @if (count($trips) === 0)
                    <p class="text-center">
                      Sin registros
                    </p>
                  @endif
              </div>
              <div class="p-3">
              </div>
          </div>
      </div>
  </div>
</x-app-layout>