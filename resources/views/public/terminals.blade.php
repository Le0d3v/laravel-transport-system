@extends("app")
@section("title")
  | Terminales
@endsection 
@section("layout")
  @include("public.nav")
  <style>

    #map {
        height: 500px;
        border-radius: 10px;
        margin: 10px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    }

    /* Sidebar */
    .sidebar {
        position: fixed;
        top: 0;
        left: -350px;
        width: 300px;
        height: 100%;
        background-color: #333;
        color: white;
        padding: 20px;
        transition: left 0.4s ease-in-out;
        box-shadow: 3px 0px 10px rgba(0, 0, 0, 0.3);
        z-index: 1000;
    }

    .sidebar.open {
        left: 0;
    }

    .sidebar h3 {
        margin-top: 0;
        font-size: 22px;
        border-bottom: 2px solid #ff9800;
        padding-bottom: 10px;
    }

    .sidebar img {
        width: 100%;
        border-radius: 10px;
        margin-top: 10px;
    }

    #placeInfo {
        font-size: 14px;
        line-height: 1.5;
    }

    /* Botón para cerrar la Sidebar */
    .closeSidebar {
        position: absolute;
        top: 10px;
        right: 10px;
        background: none;
        border: none;
        font-size: 22px;
        color: white;
        cursor: pointer;
    }

    /* Botones y Select */
    .controls {
        margin: 20px;
        display: flex;
        justify-content: center;
        gap: 10px;
    }

    select, button {
        font-size: 16px;
        padding: 10px 15px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    select {
        background-color: white;
        border: 2px solid #ff9800;
        color: #333;
    }

    button {
        background-color: #ff9800;
        color: white;
        font-weight: bold;
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
    }

    button:hover {
        background-color: #e68900;
        transform: scale(1.05);
    }
</style>
  <main class="p-5 mt-10">  
    <div>
      <h1 class="text-center font-bold text-6xl text-blue-500 font-outtfit">
        ¡Visita nuestras Terminales!
      </h1>
      <h2 class="text-lg text-center font-outtfit mt-2">
        Contamos con terminales en distintos puntos por todo el país. Encuentra la más cercana a tu ubicación
      </h2>
    </div>
    <div>
    <div id="map"></div>

    <div class="sidebar" id="sidebar">
        <button class="closeSidebar" onclick="closeSidebar()">✖</button>
        <h3 id="placeName">Nombre del lugar</h3>
        <img id="placeImage" src="" alt="Imagen del lugar" />
        <p id="placeInfo"></p>
    </div>

    <div class="controls">
        <select id="placeType">
            <option value="restaurant">Restaurantes</option>
            <option value="bank">Bancos</option>
            <option value="convenience">Tiendas de conveniencia</option>
            <option value="taxi">Sitios de taxi</option>
        </select>
        <button id="searchButton">Buscar</button>
        <button id="clearButton">Limpiar Marcadores</button>
    </div>
  </main>
  @include("public.footer")
  @push("script")
  <script>
    let map, userLocation = [19.432608, -99.133209]; // Ubicación predeterminada: Ciudad de México
    let markersLayer = L.layerGroup(); // Capa para los marcadores

    function initMap() {
        // Crear el mapa y añadir capa de OpenStreetMap
        map = L.map('map').setView(userLocation, 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);
        markersLayer.addTo(map);

        // Intentar obtener la ubicación del usuario
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    userLocation = [position.coords.latitude, position.coords.longitude];
                    map.setView(userLocation, 13);
                    L.marker(userLocation).addTo(map).bindPopup("Tu ubicación").openPopup();
                },
                () => console.warn("No se pudo obtener la ubicación. Usando ubicación predeterminada."),
                { enableHighAccuracy: true }
            );
        }
    }

    function queryOverpass(placeType) {
        const overpassUrl = https://overpass-api.de/api/interpreter?data=[out:json];node["amenity"="${placeType}"](around:5000,${userLocation[0]},${userLocation[1]});out;;

        fetch(overpassUrl)
            .then(response => response.json())
            .then(data => {
                clearMarkers();
                data.elements.forEach(element => {
                    const { lat, lon, tags } = element;
                    const name = tags?.name || "Sin nombre";
                    const image = "https://via.placeholder.com/150";
                    const info = tags ? JSON.stringify(tags, null, 2) : "Sin información adicional";
                    addMarker(lat, lon, name, image, info);
                });
            })
            .catch(error => console.error("Error en Overpass:", error));
    }

    function addMarker(lat, lon, name, image, info) {
        const marker = L.marker([lat, lon]).addTo(markersLayer);
        marker.bindPopup(name);
        marker.on('click', () => showSidebar(name, image, info));
    }

    function showSidebar(name, image, info) {
        document.getElementById("placeName").textContent = name;
        document.getElementById("placeImage").src = image;
        document.getElementById("placeInfo").textContent = info;
        document.getElementById("sidebar").classList.add("open");
    }

    function closeSidebar() {
        document.getElementById("sidebar").classList.remove("open");
    }

    function clearMarkers() {
        markersLayer.clearLayers();
        closeSidebar();
    }

    document.getElementById("searchButton").addEventListener("click", () => {
        const placeType = document.getElementById("placeType").value;
        queryOverpass(placeType);
    });

    document.getElementById("clearButton").addEventListener("click", clearMarkers);

    window.onload = initMap;
</script>
  @endpush
@endsection