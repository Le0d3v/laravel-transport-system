<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Compra de Boletos:') }} 
        </h2>
    </x-slot>
  
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-3">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5 w-full">
                <div class="flex gap-5">
                    <div class="w-full">
                        <h1 class="text-center text-blue-500 font-outtfit font-bold text-xl my-1">
                            Selección de Asientos
                        </h1>
                        <p class="text-gray-500 text-center my-1">
                            Seleccione uno o más asientos dando click sobre ellos.
                        </p>
                        <div class="flex justify-center">
                            <div class="my-3 flex gap-7">
                                <div class="flex gap-1">
                                    <div class="w-5 h-5 bg-green-500"></div>
                                    <p>: Disponible</p>
                                </div>
                                <div class="flex gap-1">
                                    <div class="w-5 h-5 bg-red-500"></div>
                                    <p>: Ocupado</p>
                                </div>
                                <div class="flex gap-1">
                                    <div class="w-5 h-5 bg-blue-500"></div>
                                    <p>: Seleccionado</p>
                                </div>
                            </div>
                        </div>
                        <div class="w-full flex justify-center">
                            <div class="w-full flex justify-center">
                                <div class="p-3 border-2 border-blue-500 border-solid rounded-lg">
                                    <div class="mt-3 flex gap-1">
                                        @foreach ($seatings_C as $seating_C)    
                                            <div 
                                                class="p-2 bg-green-500 rounded my-1 text-white  hover:cursor-pointer @if ($seating_C->status == 1)
                                                    bg-red-500 hover:cursor-not-allowed
                                                @endif" 
                                                data-seat-id="{{$seating_C->id}}" 
                                                data-seat-status="{{$seating_C->status}}"
                                                onclick="toggleSeat(this)"
                                            >
                                                <div class="flex justify-center">
                                                    <i class="fa-solid fa-couch"></i>
                                                </div>
                                                <p class="text-center text-[10px]">{{$seating_C->name}}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="flex gap-20">
                                        <div class="grid grid-cols-2 gap-1">
                                            @foreach ($seatings_B as $seating_B)    
                                            <div 
                                                class="p-2 bg-green-500 rounded my-1 text-white  hover:cursor-pointer 
                                                    @if ($seating_B->status == 1)
                                                        bg-red-500 hover:cursor-not-allowed
                                                    @endif" 
                                                data-seat-id="{{$seating_B->id}}" 
                                                data-seat-status="{{$seating_B->status}}"
                                                onclick="toggleSeat(this)"
                                            >
                                                <div class="flex justify-center">
                                                    <i class="fa-solid fa-couch"></i>
                                                </div>
                                                <p class="text-center text-[10px]">{{$seating_B->name}}</p>
                                            </div>
                                        @endforeach
                                        </div>
                                        <div class="grid grid-cols-2 gap-1">
                                            @foreach ($seatings_A as $seating_A)    
                                            <div 
                                                class="p-2 bg-green-500 rounded my-1 text-white  hover:cursor-pointer @if ($seating_A->status == 1)
                                                    bg-red-500 hover:cursor-not-allowed
                                                @endif" 
                                                data-seat-id="{{$seating_A->id}}" 
                                                onclick="toggleSeat(this)"
                                            >
                                                <div class="flex justify-center">
                                                    <i class="fa-solid fa-couch"></i>
                                                </div>
                                                <p class="text-center text-[10px]">{{$seating_A->name}}</p>
                                            </div>
                                        @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full">
                        <h1 class="text-center text-blue-500 font-outtfit font-bold text-xl mb-3">
                            Ruta de Viaje
                        </h1>
                        <input type="hidden" value="{{$trip->id}}" id="id-trip">
                        <div id="map" class="w-full rounded-lg shadow-lg h-72"></div>
                        <ul class="list-none p-4 bg-white rounded-lg mt-1 shadow-md" id="route-info"></ul>
                        <div class="mt-5 p-5 shadow rounded flex gap-10">
                            <div class="flex justify-end">
                                <button onclick="reserveSeats()" class="mt-4 bg-blue-500 text-white p-2 rounded hover:bg-blue-700">
                                    Reservar Asiento(s)
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
    @push("script")
    <script>
        // Variables para Mapa
        const id = document.querySelector("#id-trip").value
        const map = L.map('map').setView([19.4326, -99.1332], 3);
      
        // Crear el Mapa
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 15,
        }).addTo(map);
    
        // Icono para marcadores
        const customIcon = L.icon({
            iconUrl: '/img/location.gif',
            iconSize: [32, 32],
            iconAnchor: [16, 32],
            popupAnchor: [0, -32],
        });
  
      // Función para cargar datos del viaje
      async function loadTripData(tripId) {
          const response = await fetch(`/get-trip/${tripId}`);
          const tripData = await response.json();
  
          // Obtener Terminales 
          const originTerminal = tripData.origin; 
          const destinationTerminal = tripData.destination;
  
          // Coordenadas de las terminales
          const startCoords = [originTerminal.lat, originTerminal.lng];
          const endCoords = [destinationTerminal.lat, destinationTerminal.lng];
  
          // Añadir marcadores para las terminales
          L.marker(startCoords, { icon: customIcon }).addTo(map)
              .bindPopup(`<strong>${originTerminal.name}</strong>`).openPopup();
          L.marker(endCoords, { icon: customIcon }).addTo(map)
              .bindPopup(`<strong>${destinationTerminal.name}</strong>`).openPopup();
  
          // Generar la ruta
          L.Routing.control({
              waypoints: [L.latLng(startCoords), L.latLng(endCoords)],
              routeWhileDragging: true,
              router: L.Routing.osrmv1({ serviceUrl: 'https://router.project-osrm.org/route/v1' }),
              createMarker: () => null
          }).addTo(map);
  
          // Calcular la distancia entre los dos puntos
        const startPoint = L.latLng(startCoords);
        const endPoint = L.latLng(endCoords);
        const distanceMeters = startPoint.distanceTo(endPoint); 

        // Convertir la distancia a kilómetros
        const distanceKm = (distanceMeters / 1000).toFixed(2);

        // Establecer una velocidad promedio (ej. 60 km/h)
        const averageSpeedKmH = 60; 

        // Calcular la duración en horas
        const durationHours = (distanceKm / averageSpeedKmH).toFixed(2);

        // Mostrar información de la ruta
        document.getElementById('route-info').innerHTML = `
            <div class="flex justify-between">
                <li class="flex items-center font-bold text-gray-800 my-1">
                    <p>
                        Origen: 
                        <span class="font-bold text-blue-500 font-outtfit"> 
                            ${originTerminal.name}
                        </span> 
                    </p>
                </li>
                <li class="flex items-center font-bold text-gray-800 my-2">
                    <p>Destino: 
                        <span class="font-bold text-blue-500 font-outtfit"> 
                            ${destinationTerminal.name} 
                        </span>
                    </p>
                </li>
            </div>
            <div class="flex justify-between">
                <li class="flex items-center font-bold text-gray-800 my-1">
                    <p>
                        Fecha de Salida: 
                        <span class="font-bold text-blue-500 font-outtfit"> ${tripData.output_date}</span> 
                    </p>
                </li>
                <li class="flex items-center font-bold text-gray-800 my-2">
                    <p>Hora de Salida 
                        <span class="font-bold text-blue-500 font-outtfit"> ${tripData.output_time} </span>
                    </p>
                </li>
            </div>
            <div class="flex justify-between">
                <li class="flex items-center font-bold text-gray-800 my-1">
                    <p>
                        Distancia (en km): 
                        <span class="font-bold text-blue-500 font-outtfit"> ${distanceKm} km</span> 
                    </p>
                </li>
                <li class="flex items-center font-bold text-gray-800 my-2">
                    <p>Duración (a 60km/h): 
                        <span class="font-bold text-blue-500 font-outtfit"> ${durationHours} horas</span>   
                    </p>
                </li>
            </div>
        `;
      }
  
      // Llamar a la función con el ID del viaje
      loadTripData(id); 

      let selectedSeats = [];

    function toggleSeat(element) {
        const seatId = element.getAttribute('data-seat-id');

        if (element.classList.contains('bg-blue-500')) {
            // Deseleccionar el asiento
            element.classList.remove('bg-blue-500');
            element.classList.add('bg-green-500');
            selectedSeats = selectedSeats.filter(id => id !== seatId);
            console.log(selectedSeats);
        } else {
            // Seleccionar el asiento
            element.classList.remove('bg-green-500');
            element.classList.add('bg-blue-500');
            selectedSeats.push(seatId);
            console.log(selectedSeats);
            
        }
    }

    function reserveSeats() {
        fetch('/api/reservar-asientos', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ seats: selectedSeats }),
        })
        .then(response => response.json())
        .then(data => {
            console.log('Asientos reservados:', data);
            // Aquí puedes agregar lógica para mostrar un mensaje de éxito o redirigir
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    }
     
    </script>
    @endpush
  </x-app-layout>
  