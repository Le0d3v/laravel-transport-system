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
                  <div class="p-3 border-blue-500 border-2 border-solid rounded-lg my-5 flex justify-between px-10">
                    <div>
                      <h1 class="text-center text-xl text-blue-500 font-outtfit font-bold">Información del Viaje</h1>
                      <div class="mt-3 flex gap-5">
                        <p class="text-gray-500">Origen: <span class="font-bold text-blue-500">{{$ticket->trip->originTerminal->name}}</span></p>
                        <p class="text-gray-500">Destino: <span class="font-bold text-blue-500">{{$ticket->trip->destinationTerminal->name}}</span></p>
                      </div>
                      <div class="mt-3 flex gap-5">
                        <p class="text-gray-500">Fecha de Salida: <span class="font-bold text-blue-500">{{$ticket->trip->output_date}}</span></p>
                        <p class="text-gray-500">Hora de Salida: <span class="font-bold text-blue-500">{{$ticket->trip->output_time}}</span></p>
                      </div>
                      <div class="mt-3">
                        <p class="text-gray-500 mt-3">Fecha de Compra: <span class="font-bold text-blue-500">{{$ticket->created_at}}</span></p>
                        <p class="text-gray-500 mt-3">Total a Pagar: 
                          <span class="text-xl font-bold text-blue-500 font-outtfit">{{$ticket->amount}}</span>
                        </p>
                      </div>
                    </div>
                    <div>
                      <h1 class="text-center text-xl text-blue-500 font-outtfit font-bold">Acciones</h1>
                      <div class="flex gap-5 mt-10">
                        <a href="{{route("client.trips.ticket", $ticket->id)}}" class="p-2 bg-green-500 text-white rounded cursor-pointer hover:bg-green-600">
                          Descargar Boleto
                        </a>
                        <a href="{{route("client.trips.destroy", $ticket->id)}}" class="p-2 bg-red-500 text-white rounded cursor-pointer hover:bg-red-600">
                          Cancelar Viaje
                        </a>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
          </div>
      </div>
  </div>
</x-app-layout>