@extends("app")
@section("layout")
  @push("styles")    
    <style>
      .carousel-container {
        position: relative;
        width: 100%;
        height: 100%; /* Altura fija para el carrusel */
        overflow: hidden;
      }
      .carousel-item {
        display: none;
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        transition: opacity 0.5s ease-in-out, transform 0.5s ease-in-out;
      }
      .active {
        display: block;
        opacity: 1;
        transform: translateX(0);
      }
      .next {
        display: block;
        opacity: 0;
        transform: translateX(100%);
      }
      img {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Asegura que las imágenes llenen el contenedor */
      }

    </style>
  @endpush
  <div class="bg-gray-100">
    @include("public.hader")
      <main class="w-full p-5 bg-blue-500 flex gap-3">
        <div class="mt-5 w-1/2 mx-16">
          <h1 class="text-center text-white text-4xl font-bold font-outtfit">
            ¡Encuentra tu viaje aquí!
          </h1>
          <form 
            id="search-form" 
            action="{{ route('search.trip') }}" 
            method="POST" 
            class="bg-gray-100 w-full rounded shadow-md p-8 mt-5"
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
        <div class="w-1/2 h-screen">
            <div class="w-full h-full">
              <div class="w-full flex justify-center items-center h-full">
                <div class="carousel-container h-full">
                    <div class="carousel-item active mx-auto w-full h-full">
                      <img 
                        src="{{asset("img/viaje-1.png")}}" 
                        alt="Imagen 1" 
                        class="h-full"
                        width="400"
                      >
                    </div>
                    <div class="carousel-item mx-auto w-full">
                      <img 
                        src="{{asset("img/anuncio-viaje-2.jpeg")}}" 
                        alt="Imagen 2" 
                        class="h-full"
                        width="400"
                      >
                    </div>
                    <div class="carousel-item mx-auto w-full">
                      <img 
                        src="{{asset("img/imagen-3.jpg")}}" 
                        alt="Imagen 3" 
                        class="h-full"
                        width="400"
                      >
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal -->
        <div id="modal" class="fixed inset-0 bg-black bg-opacity-60 flex justify-center items-center hidden w-full">
          <div class="bg-white p-5 rounded-lg shadow-lg animate__animated animate__fadeIn w-100">
            <h2 class="text-xl font-bold text-blue-500 font-outtfit">Viajes Encontrados:</h2>
            <div id="modal-content" class="mt-5">
              <ul id="trips-list">
                
              </ul>
            </div>
            <button id="close-modal" class="mt-4 p-2 bg-blue-500 text-white rounded hover:bg-blue-700">Cerrar</button>
          </div>
        </div>

      </div>      
      </main>
      @include("public.iconos")
    @include("public.footer")
  </div>
  @push("script")
    <script>
      let currentIndex = 0;
      const items = document.querySelectorAll(".carousel-item");
      
      function showNextImage() {
          items[currentIndex].classList.remove("active");
          items[currentIndex].classList.add("next");
      
          currentIndex = (currentIndex + 1) % items.length;
      
          items[currentIndex].classList.remove("next");
          items[currentIndex].classList.add("active");
      }
      
      setInterval(showNextImage, 3500);

      // Show Modal
      document.getElementById("search-form").addEventListener("submit", function(event) {
          event.preventDefault();

          const formData = new FormData(this);
          const list = document.querySelector("#trips-list");
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
                        <span class="text-blue-500 font-bold">
                          $540
                        </span> 
                      </p>
                    </div>
                    <a class="mt-4 p-2 bg-blue-500 text-white rounded hover:bg-blue-700 font-bold" href="{{route("login")}}">
                      Ver Más
                    </a>
                  `;

                  list.appendChild(li);
                });
              } else {
                  list.innerHTML = '<p>Sin registros coincidentes.</p>';
              }
              document.getElementById("modal").classList.remove("hidden");
          })
          .catch(error => {
              console.error('Error:', error);
              document.getElementById("modal-content").innerHTML = '<p>Error al obtener los datos.</p>';
              document.getElementById("modal").classList.remove("hidden");
          });
      });


      // Cerrar el modal
      document.getElementById("close-modal").addEventListener("click", function() {
          document.getElementById("modal").classList.add("hidden");
      });

    </script>
  @endpush
@endsection
