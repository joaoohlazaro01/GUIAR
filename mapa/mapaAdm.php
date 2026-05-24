<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa ADM</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet"
        href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />

    <style>
        #map {
            width: 100%;
            height: 100%;
            border-radius: 24px;
            z-index: 1;
        }

        .leaflet-routing-container {
            display: none;
        }

        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-thumb {
            background: #FFD400;
            border-radius: 10px;
        }
    </style>
</head>

<body class="bg-[#F4F6FB] overflow-hidden">

    <div class="flex h-screen p-4 gap-4">

        <!-- SIDEBAR -->
                  <?php
$nomeAdmin = $admin["nome_adm"] ?? "Admin";
?>
        <aside id="sidebar"
        class="w-72 bg-[#0B0D2F] flex flex-col fixed top-4 left-4 text-white sticky top-0 z-40 shadow-2xl transition-all rounded-[24px] overflow-hidden h-[92vh]">


        <div class="flex flex-col h-full">
            <div class="p-8 mb-4">
                <img src="img/logobrancaR.png" alt="Logo GUIAR" class="w-32 h-auto object-contain">
            </div>

            <nav class="px-4 space-y-2 flex-grow">
                <a href="<?= BASE_URL ?>/routes.php?action=dashboardAdm"
                    class="menu-item flex items-center gap-3.5 px-5 py-3 rounded-xl font-bold text-sm bg-[#FFD400] text-[#0B0D2F] shadow-lg shadow-yellow-500/10 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Início
                </a>

                <a href="<?= BASE_URL ?>/routes.php?action=pedidos"
                    class="menu-item flex items-center gap-3.5 px-5 py-3 rounded-xl font-semibold text-sm text-slate-400 hover:text-white hover:bg-white/5 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    Pedidos
                </a>

                <a href="<?= BASE_URL ?>/routes.php?action=entregadores"
                    class="menu-item flex items-center gap-3.5 px-5 py-3 rounded-xl font-semibold text-sm text-slate-400 hover:text-white hover:bg-white/5 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-4a4 4 0 100-8 4 4 0 000 8zm6 4a2 2 0 100-4 2 2 0 000 4zM3 20v-2a2 2 0 012-2h1" />
                    </svg>
                    Entregadores
                </a>

                <a href="<?= BASE_URL ?>/routes.php?action=pedidosEntregues"
                    class="menu-item flex items-center gap-3.5 px-5 py-3 rounded-xl font-semibold text-sm text-slate-400 hover:text-white hover:bg-white/5 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                    Pedidos Entregues
                </a>

                <a href="<?= BASE_URL ?>/routes.php?action=mapaAdm"
                    class="menu-item flex items-center gap-3.5 px-5 py-3 rounded-xl font-semibold text-sm text-slate-400 hover:text-white hover:bg-white/5 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                    </svg>
                    Acompanhar Rotas
                </a>

                <a href="<?= BASE_URL ?>/routes.php?action=perfilAdm"
                    class="menu-item flex items-center gap-3.5 px-5 py-3 rounded-xl font-semibold text-sm text-slate-400 hover:text-white hover:bg-white/5 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Meu Perfil
                </a>
            </nav>

            <div class="p-4 mt-auto">
                <div class="flex items-center gap-3.5 p-3 rounded-2xl bg-white/5 border border-white/5">
                    <div class="w-10 h-10 rounded-full bg-[#FFD400] text-[#0B0D2F] font-black text-sm flex items-center justify-center shadow-lg">
                        <?= strtoupper(substr($nomeAdmin, 0, 2)) ?>
                    </div>
                    <div class="flex-grow min-w-0">
                        <p class="font-bold text-xs text-white truncate"><?= htmlspecialchars($nomeAdmin) ?></p>
                        <p class="text-[10px] text-slate-500 font-bold tracking-wider uppercase">Admin</p>
                    </div>
                    <a href="<?= BASE_URL ?>/routes.php?action=logoutAdm" class="text-slate-500 hover:text-rose-500 transition-colors p-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </aside>


        <!-- MAIN -->
        <main class="flex-1 flex flex-col gap-4 h-[95vh] overflow-hidden">

            <!-- TOPO -->
            <div
                class="bg-white rounded-[24px] shadow-sm px-8 py-6 flex items-center justify-between">

                <div>
                    <h1 class="text-3xl font-black text-[#0B0D2F]">
                        Acompanhar <span class="text-[#4F46E5]">Rotas</span>
                    </h1>

                    <p class="text-slate-400 mt-1 text-sm">
                        Monitoramento em tempo real dos entregadores
                    </p>
                </div>

                <div
                    class="bg-[#F4F6FB] px-5 py-3 rounded-2xl text-sm font-semibold text-slate-500">
                    Atualização automática • 5s
                </div>
            </div>

            <!-- CONTEÚDO -->
            <div class="grid grid-cols-12 gap-4 flex-1 min-h-0">

                <!-- MAPA -->
                <div
                    class="col-span-9 bg-white rounded-[24px] p-4 shadow-sm h-full">

                    <div id="map"></div>
                </div>

                <!-- SIDEBAR DIREITA -->
                <div
                    class="col-span-3 bg-white rounded-[24px] shadow-sm p-5 flex flex-col overflow-hidden">

                    <div class="flex items-center justify-between mb-5">
                        <h2 class="font-black text-[#0B0D2F] text-lg">
                            Entregadores
                        </h2>

                        <div
                            class="bg-[#EEF2FF] text-[#4F46E5] text-xs font-bold px-3 py-1 rounded-full">
                            ONLINE
                        </div>
                    </div>

                    <div id="listaEntregadores"
                        class="flex flex-col gap-3 overflow-y-auto pr-1">

                        <div
                            class="bg-[#F8FAFC] border border-slate-100 rounded-2xl p-4">

                            <div class="flex items-center gap-3">

                                <div
                                    class="w-12 h-12 rounded-full bg-[#FFD400] flex items-center justify-center text-xl">
                                    🏍️
                                </div>

                                <div class="flex-1">
                                    <h3
                                        class="font-bold text-[#0B0D2F] text-sm">
                                        Carregando...
                                    </h3>

                                    <p class="text-xs text-slate-400">
                                        Aguarde atualização
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </main>

    </div>

    <!-- LEAFLET -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script
        src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>

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
            html: `
                <div class="relative flex items-center justify-center">
                    <div class="absolute w-10 h-10 bg-blue-500/30 rounded-full animate-ping"></div>
                    <div class="relative w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white shadow-lg">
                        🧑
                    </div>
                </div>
            `,
            iconSize: [40, 40],
            className: ''
        });

        // MOTOBOY
        var motoIcon = L.divIcon({
            html: `
                <div class="relative flex items-center justify-center">
                    <div class="absolute w-10 h-10 bg-orange-500/30 rounded-full animate-ping"></div>
                    <div class="relative w-10 h-10 rounded-full bg-[#FFD400] flex items-center justify-center shadow-xl text-lg">
                        🏍️
                    </div>
                </div>
            `,
            iconSize: [40, 40],
            className: ''
        });

        // ===== CORES =====
        var cores = ['red', 'blue', 'green', 'orange', 'purple', 'black'];

        // ===== CONTROLE =====
        var marcadores = {};
        var rotas = {};
        var adminMarker;

        // ===== LOCALIZAÇÃO ADM =====
        if (navigator.geolocation) {

            navigator.geolocation.watchPosition(function (position) {

                var latLng = L.latLng(
                    position.coords.latitude,
                    position.coords.longitude
                );

                if (adminMarker) {

                    adminMarker.setLatLng(latLng);

                } else {

                    adminMarker = L.marker(latLng, {
                        icon: adminIcon
                    })
                        .addTo(map)
                        .bindPopup("Você (ADM)")
                        .openPopup();
                }

            }, function (error) {

                console.error("Erro ADM:", error);

            }, {
                enableHighAccuracy: true
            });
        }

        // ===== FUNÇÃO PRINCIPAL =====
        function carregarEntregadores() {

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

                    let listaHTML = '';

                    data.forEach((entregador, index) => {

                        let latEnt = parseFloat(entregador.latitude);
                        let lngEnt = parseFloat(entregador.longitude);

                        let latDest = parseFloat(entregador.destino_lat);
                        let lngDest = parseFloat(entregador.destino_lng);

                        // ===== CARD SIDEBAR =====
                        listaHTML += `
                            <div class="bg-[#F8FAFC] border border-slate-100 rounded-2xl p-4 hover:shadow-md transition-all">

                                <div class="flex items-center gap-3">

                                    <div class="w-12 h-12 rounded-full bg-[#FFD400] flex items-center justify-center text-xl shadow-md">
                                        🏍️
                                    </div>

                                    <div class="flex-1 min-w-0">

                                        <h3 class="font-bold text-[#0B0D2F] text-sm truncate">
                                            ${entregador.nome}
                                        </h3>

                                        <p class="text-xs text-emerald-500 font-semibold">
                                            Online
                                        </p>
                                    </div>
                                </div>

                                <button onclick="centralizar(${latEnt}, ${lngEnt})"
                                    class="mt-4 w-full bg-[#0B0D2F] hover:bg-[#131646] text-white text-xs font-bold py-2 rounded-xl transition-all">
                                    Ver no mapa
                                </button>

                            </div>
                        `;

                        // ===== MARCADOR =====
                        if (!isNaN(latEnt) && !isNaN(lngEnt)) {

                            var marker = L.marker([latEnt, lngEnt], {
                                icon: motoIcon
                            }).addTo(map)
                                .bindPopup("Motoboy: " + entregador.nome);

                            marcadores[entregador.id_entregador] = marker;

                            bounds.push([latEnt, lngEnt]);
                        }

                        // ===== ROTA =====
                        if (!isNaN(latEnt) && !isNaN(lngEnt)
                            && !isNaN(latDest) && !isNaN(lngDest)) {

                            var rota = L.Routing.control({

                                waypoints: [
                                    L.latLng(latEnt, lngEnt),
                                    L.latLng(latDest, lngDest)
                                ],

                                show: false,
                                addWaypoints: false,
                                draggableWaypoints: false,
                                fitSelectedRoutes: false,

                                createMarker: function () {
                                    return null;
                                },

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

                    document.getElementById('listaEntregadores').innerHTML = listaHTML;

                    // ===== AJUSTAR ZOOM =====
                    if (bounds.length > 0) {

                        map.fitBounds(bounds, {
                            padding: [50, 50]
                        });
                    }

                })

                .catch(error => {

                    console.error("Erro ao carregar entregadores:", error);

                });
        }

        // ===== CENTRALIZAR =====
        function centralizar(lat, lng) {

            map.setView([lat, lng], 16);
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