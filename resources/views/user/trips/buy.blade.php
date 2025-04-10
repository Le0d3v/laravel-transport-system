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
                                                class="p-2 bg-green-500 rounded my-1 text-white cursor-pointer 
                                                    @if ($seating_C->status === 1)
                                                        hover:cursor-not-allowed bg-red-500
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
                                                class="p-2 bg-green-500 rounded my-1 text-white cursor-pointer 
                                                    @if ($seating_B->status === 1)
                                                        hover:cursor-not-allowed bg-red-500
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
                                                class="p-2 bg-green-500 rounded my-1 text-white cursor-pointer 
                                                    @if ($seating_A->status === 1)
                                                        hover:cursor-not-allowed bg-red-500
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
                        <input type="hidden" value="{{$trip->price}}" id="trip-price">
                        <h1 class="text-center text-blue-500 font-outtfit font-bold text-xl my-1">
                            Asientos y Pago
                        </h1>
                        <div class="mt-5 p-5 shadow-lg rounded flex justify-between">
                            <div>
                                <div>
                                    <p class="text-[13px] text-gray-500">
                                        Asientos Seleccionados: 
                                        <span id="num-selected-seats" class="font-bold text-blue-500 font-outtfit text-[15px]">0</span>
                                    </p>
                                </div>
                                <div class="mt-2">
                                    <p class="text-[13px] text-gray-500">
                                        Total a Pagar: 
                                        <span id="total-price" class="font-bold text-blue-500 font-outtfit text-[25px]">$0.00</span>
                                    </p>
                                </div>
                            </div>
                            <div class="">
                                <input type="hidden" name="user_id" value="{{$user->id}}" id="data_user">
                                <input type="hidden" name="trip_id" value="{{$trip->id}}" id="data_trip">
                                <input type="hidden" name="amount" value="0" id="data_amount">
                                <button onclick="buyTrip()" class="mt-4 bg-blue-500 text-white p-2 rounded hover:bg-blue-700">
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
            <div class="flex justify-between">
                <li class="flex items-center font-bold text-gray-800 my-1">
                    <p>
                        Precio por Asiento: 
                        <span class="font-bold text-blue-500 font-outtfit"> $${tripData.price}</span> 
                    </p>
                </li>
            </div>
        `;
      }
  
      // Llamar a la función con el ID del viaje
      loadTripData(id); 

      let selectedSeats = [];
      let textSeatsSelected = document.querySelector("#num-selected-seats");
      let tripPrice = document.querySelector("#trip-price").value;
      let amount = 0;
      let totalPrice = document.querySelector("#total-price");

      function formatearPrecio(precio) {
        let precioFormateado = precio.toFixed(2);
        let partes = precioFormateado.split('.');
        partes[0] = partes[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        return partes.join('.');
      }

    function toggleSeat(element) {
        const seatId = element.getAttribute('data-seat-id');

        if (element.classList.contains('bg-blue-500')) {
            // Deseleccionar el asiento
            element.classList.remove('bg-blue-500');
            element.classList.add('bg-green-500');
            selectedSeats = selectedSeats.filter(id => id !== seatId);
            console.log(selectedSeats);
            textSeatsSelected.textContent = selectedSeats.length;
            amount = tripPrice * selectedSeats.length
            totalPrice.textContent = "$" + formatearPrecio(amount);
            
        } else {
            // Seleccionar el asiento
            element.classList.remove('bg-green-500');
            element.classList.add('bg-blue-500');
            selectedSeats.push(seatId);
            console.log(selectedSeats);
            textSeatsSelected.textContent = selectedSeats.length;
            amount = tripPrice * selectedSeats.length
            totalPrice.textContent = "$" + formatearPrecio(amount);
        }
    }

    async function buyTrip() {
        let dataUser = document.querySelector("#data_user").value;
        let dataTrip = document.querySelector("#data_trip").value;
        let dataAmount = document.querySelector("#data_amount").value;
        dataAmount = totalPrice.textContent;

        try {
            const formData = new FormData();
            formData.append("user_id", dataUser);
            formData.append("trip_id", dataTrip);
            formData.append("amount", dataAmount);

            const response = await fetch("/comprar-boletos", {
            method: "POST",
            body: formData,
            headers: {
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
            },
            });

            const data = await response.json();
            window.location.href = '/dashboard/my-trips';
        } catch (error) {
            console.log(error);
        }
    }
    </script>
    @endpush
  </x-app-layout>