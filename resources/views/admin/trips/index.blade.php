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
                  <a href="{{route("trips.create")}}" class="p-3 text-blue-500 rounded-lg hover:bg-blue-800 hover:text-white transition border-2 border-solid border-blue-500 cursor-hover flex gap-3 items-center w-36">
                    <i class="fa-solid fa-circle-plus"></i>
                    <p>
                      Nuevo Viaje
                    </p>
                  </a>
                  @if (count($trips) === 0)
                    <p class="text-center">
                      Sin registros
                    </p>
                  @else
                    @foreach ($trips as $trip)
                      <div class="w-full p-5 border-2 border-solid border-blue-500 flex gap-10 rounded-lg my-5">
                        <div class="w-2/3">
                          <h1 class="text-2xl font-bold text-blue-500 font-outtfit">
                            Datos del Viaje
                          </h1>
                          <p class="mt-5">
                            <span class="font-bold text-blue-500 font-outtfit">Id del Viaje: </span>
                            {{$trip->id}}
                          </p>
                          <div class="flex gap-10 mt-2">
                            <p>
                              <span class="font-bold text-blue-500 font-outtfit">Origen: </span>
                              {{$trip->originTerminal->name}}
                            </p>
                            <p>
                              <span class="font-bold text-blue-500 font-outtfit">Destino: </span>
                              {{$trip->destinationTerminal->name}}
                            </p>
                          </div>
                          <div class="flex gap-10 mt-2">
                            <p>
                              <span class="font-bold text-blue-500 font-outtfit">Fecha de Salida: </span>
                              {{$trip->output_date}}
                            </p>
                            <p>
                              <span class="font-bold text-blue-500 font-outtfit">Hora de salida: </span>
                              {{$trip->output_time}}
                            </p>
                          </div>
                          <div class="flex gap-10 mt-2">
                            <p>
                              <span class="font-bold text-blue-500 font-outtfit">Fecha de Llegada: </span>
                              {{$trip->arrival_date}}
                            </p>
                            <p>
                              <span class="font-bold text-blue-500 font-outtfit">Hora de Llegada: </span>
                              {{$trip->arrival_time}}
                            </p>
                          </div>
                          <div class="flex gap-10 mt-2">
                            <p>
                              <span class="font-bold text-blue-500 font-outtfit">Autobus: </span>
                              {{$trip->truck->model}}
                            </p>
                            <p>
                              <span class="font-bold text-blue-500 font-outtfit">Conductor: </span>
                              {{$trip->truck->driver->name . " " . $trip->truck->driver->last_name}}
                            </p>
                          </div>
                        </div>
                        <div class="w-1/3 flex justify-center">
                          <div>
                            <h1 class="text-2xl font-bold text-blue-500 font-outtfit">
                              Acciones
                            </h1>
                            <div class="flex justify-center gap-2 mt-3">
                              <a href="{{route("trips.edit", $trip->id)}}" class="p-2 bg-green-500 text-white rounded cursor-pointer hover:bg-green-600">
                                Editar
                              </a>
                              <a href="{{route("trips.destroy", $trip->id)}}" class="p-2 bg-red-500 text-white rounded cursor-pointer hover:bg-red-600">
                                Eliminar
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>
                    @endforeach
                  @endif
              </div>
              <div class="p-3">
              </div>
          </div>
      </div>
  </div>
</x-app-layout>