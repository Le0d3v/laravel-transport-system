<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Viajes Disponibles') }}
      </h2>
  </x-slot>

  <div class="py-8">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-3">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex gap-1">
              <div class="p-5">
                <h1 class="text-center text-blue-500 text-4xl font-bold font-outtfit mb-1">
                  ¡Encuentra tu viaje aquí!
                </h1>
                <hr>
                <div class="p-1 bg-white shadow-lg rounded-lg">
                  <form 
                    id="trips-search-form" 
                    action="{{ route('search.trip') }}" 
                    method="POST" 
                    class="w-full rounded shadow-md p-10 mt-5 border-2 border-solid border-blue-500"
                  >
                  @csrf
                    <legend class="font-bold text-black text-sm text-center">
                      Busca tu viaje llenando el formulario
                    </legend>
                    <div class="flex gap-5 mt-5">
                      <div class="w-full">
                        <label for="destino-inicio" class="font-bold text-sm text-gray-700">
                          <i class="fa-solid fa-location-dot"></i>
                          Origen
                        </label>
                        <select 
                          name="origin" 
                          id="destino-inicio" 
                          class="w-full p-2 rounded border-2 border-blue-500"
                        >
                          <option value="0" disabled selected>
                             -- Seleccione -- 
                          </option>
                          @foreach ($terminals as $terminal)
                            <option value="{{$terminal->id}}">
                              {{$terminal->name}}
                            </option>
                          @endforeach
                        </select>
                      </div>
                      <div class="w-full">
                        <label for="destino-inicio" class="font-bold text-sm text-gray-700">
                          <i class="fa-solid fa-location-dot"></i>
                          Destino
                        </label>
                        <select 
                          name="destination" 
                          id="destino-inicio" 
                          class="w-full p-2 rounded border-2 border-blue-500"
                        >
                          <option value="0" disabled selected>
                             -- Seleccione -- 
                          </option>
                          @foreach ($terminals as $terminal)
                            <option value="{{$terminal->id}}">
                              {{$terminal->name}}
                            </option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="flex justify-center w-full mt-5">
                     <div>
                        <label for="fecha-salida" class="w-full font-bold text-sm text-gray-700">
                          <i class="fa-solid fa-calendar-days"></i>
                          Fecha de Salida
                        </label>
                        <input type="date" name="output_date" class="w-full p-2 rounded border-2 border-blue-500">
                     </div>
                    </div>
                    <div class="flex justify-end mt-5">
                      <div class="flex items-end h-full">
                        <div class="p-2 border-2 border-solid border-blue-500 text-blue-500 rounded-lg shadow-sm hover:bg-blue-700 hover:cursor-pointer transition hover:scale-125 hover:text-white flex gap-1 items-center">
                          <i class="fa-solid fa-magnifying-glass hover:cursor-pointer"></i>
                          <input type="submit" value="Buscar Viaje" class="hover:cursor-pointer font-outtfit">
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <div>
                <div class="p-6 text-gray-900">
                      <h1 class="text-center text-3xl font-bold text-blue-500 font-outtfit mb-1">
                        Viajes Disponibles Hoy
                        <hr>
                      </h1>
                      @if (count($trips) == 0)
                        <p class="text-center mt-5 text-gray-500 font-bold">
                          Sin Viajes para Hoy
                        </p>
                      @else 
                        <div class="overflow-y-scroll h-96 p-1 bg-white rounded-lg shadow-md">
                          @foreach ($trips as $trip)
                            <div class="w-full p-5 border-2 border-solid border-blue-500 flex gap-5 rounded-lg my-5">
                              <div class="w-2/3">
                                <h1 class="text-2xl font-bold text-blue-500 font-outtfit">
                                  Datos del Viaje
                                </h1>
                                <div class="flex gap-10 mt-2">
                                  <p>
                                    <span class="font-bold text-blue-500 font-outtfit">Origen: </span>
                                    <br>
                                    {{$trip->originTerminal->name}}
                                  </p>
                                  <p>
                                    <span class="font-bold text-blue-500 font-outtfit">Destino: </span>
                                    <br>
                                    {{$trip->destinationTerminal->name}}
                                  </p>
                                </div>
                                <div class="flex gap-10 mt-2">
                                  <p>
                                    <span class="font-bold text-blue-500 font-outtfit">Fecha de Salida: </span>
                                    <br>
                                    {{date("D-m-Y",strtotime($trip->output_date))}}
                                  </p>
                                  <p>
                                    <span class="font-bold text-blue-500 font-outtfit">Hora de salida: </span>
                                    <br>
                                    {{$trip->output_time}}
                                  </p>
                                </div>
                                <div class="flex gap-10 mt-2">
                                  <p>
                                    <span class="font-bold text-blue-500 font-outtfit">Fecha de Llegada: </span>
                                    <br>
                                    {{date("D-m-Y",strtotime($trip->arrival_date))}}
                                  </p>
                                  <p>
                                    <span class="font-bold text-blue-500 font-outtfit">Hora de Llegada: </span>
                                    <br>
                                    {{$trip->arrival_time}}
                                  </p>
                                </div>
                              </div>
                              <div class="w-1/3 flex justify-center">
                                <div>
                                  <div>
                                    <p>Precio por Boleto:</p>
                                    <h1 class="text-5xl font-bold text-blue-500 font-outtfit">$540</p>
                                  </div>
                                  <div class="mt-10">
                                    <div class="flex justify-center gap-2 mt-3">
                                      <a href="{{route("client.trips.buy", $trip->id)}}" class="p-2 bg-blue-500 text-white rounded cursor-pointer hover:bg-blue-600">
                                        Comprar Boletos
                                      </a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          @endforeach
                        </div>
                      @endif
                </div>
                <div class="p-3">
                </div>
              </div>
          </div>
      </div>
  </div>
  <div id="trips-modal" class="fixed inset-0 bg-black bg-opacity-60 flex justify-center items-center hidden w-full">
    <div class="bg-white p-5 rounded-lg shadow-lg animate__animated animate__fadeIn w-100">
      <h2 class="text-xl font-bold text-blue-500 font-outtfit">Viajes Encontrados:</h2>
      <div id="trips-modal-content" class="mt-5">
        <ul id="trips-modal-list">
          
        </ul>
      </div>
      <button id="close-trips-modal" class="mt-4 p-2 bg-blue-500 text-white rounded hover:bg-blue-700">Cerrar</button>
    </div>
  </div>
  @push("script")
      <script>
          // Show Modal
        document.getElementById("trips-search-form").addEventListener("submit", function(event) {
            event.preventDefault();

            const formData = new FormData(this);
            const list = document.querySelector("#trips-modal-list");
            list.innerHTML = "";

            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                }
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                if (data.viajes.length > 0) {
                  console.log(data.viajes.length);
                  
                  data.viajes.forEach(viaje => {
                    const li = document.createElement('li');
                    li.classList.add('w-full', 'p-3', 'my-3', 'border-2', 'border-solid', 'border-blue-500', 'rounded-lg', 'flex', 'gap-16', 'items-center');


                    li.innerHTML = `
                      <div>
                        <p>
                          Viaje de 
                          <span class="text-blue-500 font-bold">
                            ${viaje.origin.name}
                          </span> 
                          a 
                          <span class="text-blue-500 font-bold">
                            ${viaje.destination.name}
                          </span>
                          a las ${viaje.output_time}
                        </p>
                        <p>
                          Precio: 
                          <span class="text-blue-500 font-bold text-xl">
                            $540
                          </span> 
                        </p>
                      </div>
                      <a 
                        class="mt-4 p-2 bg-blue-500 text-white rounded hover:bg-blue-700 font-bold" 
                        href="{{route("client.trips.buy", 1)}}">
                        Comprar Boletos
                      </a>
                    `;
                    list.appendChild(li);
                  });
                } else {
                    list.innerHTML = '<p>Sin registros coincidentes.</p>';
                }
                document.getElementById("trips-modal").classList.remove("hidden");
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById("trips-modal-content").innerHTML = '<p>Error al obtener los datos.</p>';
                document.getElementById("trips-modal").classList.remove("hidden");
            });
        });

        // Cerrar el modal
        document.getElementById("close-trips-modal").addEventListener("click", function() {
            document.getElementById("trips-modal").classList.add("hidden");
        });
      </script>
  @endpush
</x-app-layout>