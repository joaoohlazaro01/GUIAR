
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Mapa ADM</title>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css"/>

<style>
#map {
    height: 90vh;
}
</style>
</head>

<body>

<div id="map"></div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>

<script>

// ===== MAPA =====
var map = L.map('map').setView([-22.3674, -46.9428], 14);

// ===== TILE =====
L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
    attribution: '&copy; CartoDB'
}).addTo(map);

// ===== ÍCONES =====

// ADM
var adminIcon = L.divIcon({
    html: '<div style="font-size:22px;">🧑</div>',
    iconSize: [30,30],
    className: ''
});

// MOTOBOY
var motoIcon = L.divIcon({
    html: '<div style="font-size:20px;">🏍️</div>',
    iconSize: [30,30],
    className: ''
});

// ===== CORES =====
var cores = ['red','blue','green','orange','purple','black'];

// ===== CONTROLE =====
var marcadores = {};
var rotas = {};
var adminMarker;

// ===== LOCALIZAÇÃO ADM =====
if (navigator.geolocation) {
    navigator.geolocation.watchPosition(function(position) {

        var latLng = L.latLng(position.coords.latitude, position.coords.longitude);

        if (adminMarker) {
            adminMarker.setLatLng(latLng);
        } else {
            adminMarker = L.marker(latLng, { icon: adminIcon })
                .addTo(map)
                .bindPopup("Você (ADM)")
                .openPopup();
        }

    }, function(error) {
        console.error("Erro ADM:", error);
    }, {
        enableHighAccuracy: true
    });
}

// ===== FUNÇÃO PRINCIPAL =====
function carregarEntregadores(){

    fetch('Action_PHP/getEntregadores.php')
    .then(res => res.json())
    .then(data => {

        console.log("Dados:", data);

        // LIMPAR
        Object.values(marcadores).forEach(m => map.removeLayer(m));
        Object.values(rotas).forEach(r => map.removeControl(r));

        marcadores = {};
        rotas = {};

        var bounds = [];

        data.forEach((entregador, index) => {

            let latEnt = parseFloat(entregador.latitude);
            let lngEnt = parseFloat(entregador.longitude);

            let latDest = parseFloat(entregador.destino_lat);
            let lngDest = parseFloat(entregador.destino_lng);

            // ===== MARCADOR =====
            if(!isNaN(latEnt) && !isNaN(lngEnt)){

                var marker = L.marker([latEnt, lngEnt], {
                    icon: motoIcon
                }).addTo(map)
                .bindPopup("Motoboy: " + entregador.nome);

                marcadores[entregador.id_entregador] = marker;

                bounds.push([latEnt, lngEnt]);
            }

            // ===== ROTA =====
            if(!isNaN(latEnt) && !isNaN(lngEnt) && !isNaN(latDest) && !isNaN(lngDest)){

                var rota = L.Routing.control({
                    waypoints: [
                        L.latLng(latEnt, lngEnt),
                        L.latLng(latDest, lngDest)
                    ],
                    show: false,
                    addWaypoints: false,
                    draggableWaypoints: false,
                    fitSelectedRoutes: false,
                    createMarker: function(){ return null; },

                    lineOptions: {
                        styles: [{
                            color: cores[index % cores.length],
                            weight: 5
                        }]
                    },

                    router: L.Routing.osrmv1({
                        serviceUrl: 'https://router.project-osrm.org/route/v1'
                    })

                }).addTo(map);

                rotas[entregador.id_entregador] = rota;

                bounds.push([latDest, lngDest]);
            }

        });

        // ===== AJUSTAR ZOOM AUTOMÁTICO =====
        if(bounds.length > 0){
            map.fitBounds(bounds, { padding: [50, 50] });
        }

    })
    .catch(error => {
        console.error("Erro ao carregar entregadores:", error);
    });
}

// ===== INIT =====
carregarEntregadores();
setInterval(carregarEntregadores, 5000);

</script>

</body>
</html>

<?php
session_start();
if (empty($_SESSION['company_id'])) {
    header('Location: loginEmpresa.php');
    exit();
}
?>
