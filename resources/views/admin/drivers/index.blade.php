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
                  <a href="{{route("drivers.create")}}" class="p-3 text-blue-500 rounded-lg hover:bg-blue-800 hover:text-white transition border-2 border-solid border-blue-500 cursor-hover flex gap-3 items-center w-48">
                    <i class="fa-solid fa-circle-plus"></i>
                    <p>
                      Nuevo Conductor
                    </p>
                  </a>
                  @if (count($drivers) === 0)
                    <p class="text-center">
                      Sin registros
                    </p>
                  @endif
                  <div class="mt-5 w-full">
                    <table class="w-full">
                      <thead class="w-full">
                        <td class="p-3 bg-blue-600 text-white font-bold text-center">ID</td>
                        <td class="p-3 bg-blue-600 text-white font-bold text-center">Nombre</td>
                        <td class="p-3 bg-blue-600 text-white font-bold text-center">Apellido</td>
                        <td class="p-3 bg-blue-600 text-white font-bold text-center">Teléfono</td>
                        <td class="p-3 bg-blue-600 text-white font-bold text-center">Email</td>
                        <td class="p-3 bg-blue-600 text-white font-bold text-center">Estatus</td>
                        <td class="p-3 bg-blue-600 text-white font-bold text-center">Acciones<td>
                      </thead>
                      <tbody>
                        @foreach ($drivers as $driver)
                          <div class="p-3">
                            <tr class="p-3 border-b-2 mb-2">
                              <td class="text-center p-2">{{$driver->id}}</td>
                              <td class="text-center p-2">{{$driver->name}}</td>
                              <td class="text-center p-2">{{$driver->last_name}}</td>
                              <td class="text-center p-2">{{$driver->telephone}}</td>
                              <td class="text-center p-2">{{$driver->email}}</td>
                              <td class="text-center p-2">
                                @if ($driver->status === 1)
                                  {{"Activo"}}
                                @else
                                  {{"Inactivo"}}
                                @endif
                              </td>
                              <td class="text-center p-2">
                                <div class="flex justify-center gap-2">
                                  <a href="{{route("drivers.edit", $driver)}}" class="p-2 bg-green-500 text-white rounded cursor-pointer hover:bg-green-600">
                                    Editar
                                  </a>
                                  <a href="{{route("drivers.destroy", $driver->id)}}" class="p-2 bg-red-500 text-white rounded cursor-pointer hover:bg-red-600">
                                    Eliminar
                                  </a>
                                </div>
                              </td>
                            </tr>
                          </div>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
              </div>
              <div class="p-3">
              </div>
          </div>
      </div>
  </div>
</x-app-layout>