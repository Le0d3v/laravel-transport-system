<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Compra de Boletos:') }} 
        </h2>
    </x-slot>
  
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-3">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5 w-full flex gap-5">
                <div class="w-full">
                    <h1 class="text-center text-blue-500 font-outtfit font-bold text-xl mb-3">
                        Ruta de Viaje
                    </h1>
                    <input type="hidden" value="{{$trip->id}}" id="id-trip">
                    <div id="map" class="w-full rounded-lg shadow-lg h-64"></div>
                    <ul class="list-none p-4 bg-white rounded-lg mt-1 shadow-md" id="route-info"></ul>
                </div>
                <div class="w-full">
                    <h1 class="text-center text-blue-500 font-outtfit font-bold text-xl mb-3">
                        Seleccion de asientos
                    </h1>
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
    </script>
    @endpush
  </x-app-layout>
  