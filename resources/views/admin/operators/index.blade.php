<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Operadores') }}
      </h2>
  </x-slot>

  <div class="py-8">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 text-gray-900">
                  <a href="{{route("operators.create")}}" class="p-3 bg-blue-600 text-white rounded hover:bg-blue-800 cursor-hover">
                    Agregar Operador
                  </a>
                  <div class="mt-5 w-full">
                    <table class="w-full">
                      <thead class="w-full">
                        <td class="p-3 bg-blue-600 text-white font-bold text-center">ID</td>
                        <td class="p-3 bg-blue-600 text-white font-bold text-center">Nombre</td>
                        <td class="p-3 bg-blue-600 text-white font-bold text-center">Correo Electrónico</td>
                        <td class="p-3 bg-blue-600 text-white font-bold text-center">Acciones</td>
                      </thead>
                      <tbody>
                          @foreach ($users as $user)
                            <tr class="p-6 border-b-2">
                              <td class="text-center">{{$user->id}}</td>
                              <td class="text-center">{{$user->name}}</td>
                              <td class="text-center">{{$user->email}}</td>
                              <td class="text-center">
                                <div class="flex justify-center gap-2">
                                  <a href="{{route("operators.edit", $user)}}" class="p-2 bg-green-500 text-white rounded cursor-pointer hover:bg-green-600">
                                    Editar
                                  </a>
                                  <a href="{{route("operators.destroy", $user)}}" class="p-2 bg-red-500 text-white rounded cursor-pointer hover:bg-red-600">
                                    Eliminar
                                  </a>
                                </div>
                              </td>
                            </tr>
                          @endforeach
                      </tbody>
                    </table>
                  </div>
              </div>
              <div class="p-3">
                {{$users->links()}}
              </div>
          </div>
      </div>
  </div>
</x-app-layout>