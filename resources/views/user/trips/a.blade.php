<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa con Rutas</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: #f4f4f4; }
        #map { height: 70vh; width: 100%; }
        .controls {
            position: absolute;
            top: 10px; left: 10px;
            padding: 15px;
            background: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            display: flex;
            flex-direction: column;
            max-width: 350px;
            z-index: 1000;
        }
        select, button {
            margin: 5px 0;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
            transition: 0.3s;
        }
        button {
            background-color: #28a745;
            color: white;
            cursor: pointer;
            font-weight: bold;
        }
        button:hover { background-color: #218838; }
        .route-info {
            list-style: none;
            padding: 0;
            background: white;
            border-radius: 8px;
            padding: 10px;
            margin-top: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .route-info li {
            display: flex;
            align-items: center;
            margin: 5px 0;
            font-weight: bold;
            color: #333;
        }
        .popup-content {
            font-size: 14px;
            padding: 5px;
            width: 250px;
        }
        @media (max-width: 600px) {
            .controls { width: 90%; left: 50%; transform: translateX(-50%); }
            select, button { width: 100%; }
        }
    </style>
</head>
<body>
    <div id="map"></div>
    <div class="controls">
        <label for="start">Origen:</label>
        <select id="start"></select>
        <label for="end">Destino:</label>
        <select id="end"></select>
        <button id="generateRouteBtn">Generar Ruta</button>
        <button id="clearRouteBtn" style="background-color: #dc3545;">Cambiar Ruta</button>
        <ul class="route-info" id="route-info"></ul>
    </div>
    
    <script>
        const map = L.map('map').setView([19.4326, -99.1332], 6);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        const customIcon = L.icon({
            iconUrl: 'icono.gif',
            iconSize: [32, 32],
            iconAnchor: [16, 32],
            popupAnchor: [0, -32],
        });

        const predefinedMarkers = [
            { lat: 19.0414, lng: -98.2063, name: "ADO Puebla" },
            { lat: 19.4870, lng: -99.1277, name: "Central del Norte CDMX" },
            { lat: 19.4002, lng: -99.1458, name: "Terminal ADO AU" },
            { lat: 21.1619, lng: -86.8515, name: "ADO Cancún" },
            { lat: 20.6760, lng: -88.5688, name: "Playa del Carmen" },
            { lat: 20.6597, lng: -103.3496, name: "Central de Autobuses Guadalajara" },
            { lat: 19.2931, lng: -99.6676, name: "Terminal de Toluca" },
            { lat: 17.0654, lng: -96.7237, name: "ADO Oaxaca" },
            { lat: 25.6866, lng: -100.3161, name: "Central de Autobuses Monterrey" },
            { lat: 21.8853, lng: -102.2916, name: "Terminal Aguascalientes" },
            { lat: 20.5888, lng: -100.3899, name: "Central Querétaro" },
            { lat: 19.1653, lng: -96.1443, name: "ADO Veracruz" }
        ];

        let markers = predefinedMarkers.map(markerData => {
            let marker = L.marker([markerData.lat, markerData.lng], { icon: customIcon }).addTo(map);
            marker.bindPopup(`<div class="popup-content"><strong>${markerData.name}</strong><br>Lat: ${markerData.lat}, Lng: ${markerData.lng}</div>`);
            return marker;
        });

        const startSelect = document.getElementById('start');
        const endSelect = document.getElementById('end');
        predefinedMarkers.forEach(markerData => {
            startSelect.add(new Option(markerData.name, `${markerData.lat},${markerData.lng}`));
            endSelect.add(new Option(markerData.name, `${markerData.lat},${markerData.lng}`));
        });
        
        let routingControl;
        document.getElementById('generateRouteBtn').addEventListener('click', () => {
            if (routingControl) map.removeControl(routingControl);
            const startCoords = startSelect.value.split(',').map(Number);
            const endCoords = endSelect.value.split(',').map(Number);
            routingControl = L.Routing.control({
                waypoints: [L.latLng(startCoords), L.latLng(endCoords)],
                routeWhileDragging: true,
                router: L.Routing.osrmv1({ serviceUrl: 'https://router.project-osrm.org/route/v1' }),
                createMarker: () => null
            }).addTo(map);

            fetch(`https://router.project-osrm.org/route/v1/driving/${startCoords[1]},${startCoords[0]};${endCoords[1]},${endCoords[0]}?overview=false&geometries=geojson`)
            .then(res => res.json())
            .then(data => {
                const route = data.routes[0];
                const distanceKm = (route.distance / 1000).toFixed(2); // Km con dos decimales
                const durationHours = (route.duration / 3600).toFixed(2); // Horas con dos decimales
                document.getElementById('route-info').innerHTML = `
                    <li>📏 ${distanceKm} km</li>
                    <li>⏳ ${durationHours} horas</li>
                `;
            });
        });

        document.getElementById('clearRouteBtn').addEventListener('click', () => {
            if (routingControl) map.removeControl(routingControl);
            markers.forEach(marker => marker.addTo(map));
            document.getElementById('route-info').innerHTML = "";
        });
    </script>
</body>
</html>
