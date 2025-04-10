<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Mis Viajes') }}
      </h2>
  </x-slot>

  <div class="py-8">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-3">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">
              <h1 class="text-center text-3xl font-bold font-outtfit text-blue-500">
                Visualiza todos tus viajes
              </h1>
              <div class="mt-10">
                @foreach ($tickets as $ticket)
                  <div class="p-3 border-blue-500 border-2 border-solid rounded my-3 flex justify-between">
                    <div>
                      <h1>Información del Viaje</h1>
                    </div>
                    <div>
                      <h1>Ticket</h1>
                    </div>
                  </div>
                @endforeach
              </div>
          </div>
      </div>
  </div>
</x-app-layout>