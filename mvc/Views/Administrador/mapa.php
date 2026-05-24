<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Acompanhamento de Entregadores</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet"
        href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />

    <style>
         /* SIDEBAR - Comportamento Responsivo */
        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #111;
            padding-top: 20px;
            display: flex;
            flex-direction: column;
            z-index: 1000;
        }

        .main {
            margin-left: 250px;
            padding: 15px;
            transition: 0.3s;
        }

         /* MOBILE */
        @media(max-width:768px){

            #sidebar{
                transform:translateX(-100%);
                transition:.3s ease;
                border-radius:0 !important;
                top:0 !important;
                left:0 !important;
                margin:0 !important;
                height:100vh !important;
                width:280px !important;
            }

            #sidebar.mobile-open{
                transform:translateX(0);
            }

            #overlay.active{
                display:block;
            }

            .content-mobile{
                margin-left:0 !important;
            }

            .profile-card{
                padding:24px !important;
            }
        }
        body {
            font-family: 'Outfit', sans-serif;
        }

        #map {
            height: 100%;
            width: 100%;
            z-index: 1;
        }

        .leaflet-routing-container {
            display: none !important;
        }

        .moto-marker {
            background: none;
            border: none;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .moto-icon-wrapper {
            font-size: 26px;
            animation: bounce 0.8s ease infinite alternate;
        }

        .pulse-ring {
            position: absolute;
            width: 34px;
            height: 34px;
            border: 3px solid #f97316;
            border-radius: 999px;
            animation: pulse-animation 1.5s infinite;
        }

        .pulse-ring-idle {
            position: absolute;
            width: 34px;
            height: 34px;
            border: 3px solid #10b981;
            border-radius: 999px;
            animation: pulse-animation 1.5s infinite;
        }

        @keyframes pulse-animation {
            0% {
                transform: scale(.6);
                opacity: 1;
            }

            100% {
                transform: scale(1.6);
                opacity: 0;
            }
        }

        @keyframes bounce {
            from {
                transform: translateY(0px);
            }

            to {
                transform: translateY(-4px);
            }
        }

        .delivery-marker {
            background: #f97316;
            border-radius: 999px;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            border: 2px solid white;
            font-size: 12px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, .2);
        }

        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-thumb {
            background: #d4d4d4;
            border-radius: 999px;
        }
    </style>
</head>

<body class="bg-[#f5f7fb] overflow-hidden">

    <div class="flex h-screen">

        <!-- SIDEBAR -->
        <aside id="sidebar"
    class="w-72 bg-[#0B0D2F] flex flex-col fixed top-4 left-4 text-white z-40 shadow-2xl transition-all rounded-[24px] overflow-hidden h-[92vh]">

    <div class="flex flex-col h-full">

        <!-- BOTÃO FECHAR MOBILE -->
        <button id="closeSidebar"
            class="absolute top-5 right-5 md:hidden text-white text-2xl z-50">

            ✕
        </button>

        <!-- LOGO -->
        <div class="p-8 mb-4">
            <img src="<?= BASE_URL ?>/img/logobrancaR.png"
                alt="Logo GUIAR"
                class="w-32 h-auto object-contain">
        </div>

        <!-- MENU -->
        <nav class="px-4 space-y-2 flex-grow overflow-y-auto">

            <!-- INÍCIO -->
            <a href="<?= BASE_URL ?>/routes.php?action=dashboardAdm"
                 class="menu-item flex items-center gap-3.5 px-5 py-3 rounded-xl font-semibold text-sm text-slate-400 hover:text-white hover:bg-white/5 transition-all">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>

                Início
            </a>

            <!-- PEDIDOS -->
            <a href="<?= BASE_URL ?>/routes.php?action=pedidos"
                class="menu-item flex items-center gap-3.5 px-5 py-3 rounded-xl font-semibold text-sm text-slate-400 hover:text-white hover:bg-white/5 transition-all">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 opacity-70"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>

                Pedidos
            </a>

            <!-- ENTREGADORES -->
            <a href="<?= BASE_URL ?>/routes.php?action=entregadores"
                class="menu-item flex items-center gap-3.5 px-5 py-3 rounded-xl font-semibold text-sm text-slate-400 hover:text-white hover:bg-white/5 transition-all">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 opacity-70"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-4a4 4 0 100-8 4 4 0 000 8zm6 4a2 2 0 100-4 2 2 0 000 4zM3 20v-2a2 2 0 012-2h1" />
                </svg>

                Entregadores
            </a>

            <!-- PEDIDOS ENTREGUES -->
            <a href="<?= BASE_URL ?>/routes.php?action=pedidosEntregues"
                class="menu-item flex items-center gap-3.5 px-5 py-3 rounded-xl font-semibold text-sm text-slate-400 hover:text-white hover:bg-white/5 transition-all">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 opacity-70"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                </svg>

                Pedidos Entregues
            </a>

            <!-- MAPA -->
            <a href="<?= BASE_URL ?>/routes.php?action=mapaAdm"
                 class="menu-item flex items-center gap-3.5 px-5 py-3 rounded-xl font-bold text-sm bg-[#FFD400] text-[#0B0D2F] shadow-lg shadow-yellow-500/10 transition-all">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 opacity-70"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                </svg>

                Acompanhar Rotas
            </a>

            <!-- PERFIL -->
            <a href="<?= BASE_URL ?>/routes.php?action=perfilAdm"
                class="menu-item flex items-center gap-3.5 px-5 py-3 rounded-xl font-semibold text-sm text-slate-400 hover:text-white hover:bg-white/5 transition-all">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 opacity-70"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>

                Meu Perfil
            </a>
        </nav>

        <!-- FOOTER -->
        <div class="p-4 mt-auto">

            <div class="flex items-center gap-3.5 p-3 rounded-2xl bg-white/5 border border-white/5">

                <div class="w-10 h-10 rounded-full bg-[#FFD400] text-[#0B0D2F] font-black text-sm flex items-center justify-center shadow-lg">
                    <?= strtoupper(substr($nomeAdmin, 0, 2)) ?>
                </div>

                <div class="flex-grow min-w-0">

                    <p class="font-bold text-xs text-white truncate">
                        <?= htmlspecialchars($nomeAdmin) ?>
                    </p>

                    <p class="text-[10px] text-slate-500 font-bold tracking-wider uppercase">
                        Admin
                    </p>
                </div>

                <!-- LOGOUT -->
                <a href="<?= BASE_URL ?>/routes.php?action=logoutAdm"
                    class="text-slate-500 hover:text-rose-500 transition-colors p-1">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</aside>
        <!-- MAIN -->
        <main class="flex-1 flex flex-col min-h-screen w-full md:ml-[304px]">

            <!-- HEADER -->
            <header class="bg-white/80 backdrop-blur-md border-b border-gray-200 px-4 md:px-8 py-4 md:py-5 flex items-center gap-4 sticky top-0 z-10">

                <!-- MENU MOBILE -->
                <button id="hamburger"
                    class="md:hidden flex items-center justify-center w-10 h-10 rounded-xl bg-gray-100">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-6 h-6 text-gray-700"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <h2 class="text-lg md:text-2xl font-bold text-gray-800">
                    Gerenciamento de Pedidos
                </h2>
            </header>

            <!-- CONTENT -->
            <section class="flex-1 overflow-hidden p-5 lg:p-8">

                <div class="grid grid-cols-1 xl:grid-cols-12 gap-6 h-full">

                    <!-- MAPA -->
                    <div
                        class="xl:col-span-8 bg-white rounded-[30px] p-4 shadow-sm border border-slate-200 flex flex-col min-h-[450px]">

                        <!-- TOP -->
                        <div class="flex items-center justify-between mb-4">

                            <div>
                                <h2 class="text-2xl font-bold text-[#0B0D2F]">
                                    Mapa em Tempo Real
                                </h2>

                                <p class="text-sm text-slate-500">
                                    Rotas e entregadores ativos
                                </p>
                            </div>

                            <div
                                class="bg-orange-100 text-orange-600 px-4 py-2 rounded-xl text-sm font-bold">
                                <span id="totalDriversBadge">0</span> online
                            </div>

                        </div>

                        <!-- MAP -->
                        <div
                            class="flex-1 rounded-[25px] overflow-hidden border border-slate-200">
                            <div id="map"></div>
                        </div>

                    </div>

                    <!-- SIDEBAR ENTREGADORES -->
                    <div
                        class="xl:col-span-4 bg-white rounded-[30px] border border-slate-200 shadow-sm flex flex-col overflow-hidden min-h-[450px]">

                        <div class="p-6 border-b border-slate-100">

                            <h2 class="text-2xl font-bold text-[#0B0D2F]">
                                Entregadores
                            </h2>

                            <p class="text-sm text-slate-500 mt-1">
                                Status e pedidos ativos
                            </p>

                        </div>

                        <div id="driverListContainer"
                            class="flex-1 overflow-y-auto p-5 space-y-4">

                            <div class="text-center text-slate-400 py-10">
                                Carregando entregadores...
                            </div>

                        </div>

                    </div>

                </div>

            </section>

        </main>

    </div>

    <!-- MOBILE NAV -->
    <div
        class="lg:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-slate-200 flex justify-around items-center h-16 z-[9999]">

        <a href="<?= BASE_URL ?>/routes.php?action=dashboardAdm"
            class="flex flex-col items-center text-xs text-slate-600">
            🏠
            Início
        </a>

        <a href="<?= BASE_URL ?>/routes.php?action=pedidos"
            class="flex flex-col items-center text-xs text-slate-600">
            📦
            Pedidos
        </a>

        <a href="<?= BASE_URL ?>/routes.php?action=mapaAdm"
            class="flex flex-col items-center text-xs text-orange-500 font-bold">
            🗺️
            Rotas
        </a>

        <a href="<?= BASE_URL ?>/routes.php?action=perfilAdm"
            class="flex flex-col items-center text-xs text-slate-600">
            👤
            Perfil
        </a>

    </div>

    <!-- LEAFLET -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>

    <script>

        // Inicializa o mapa centralizado em Mogi Guaçu / Região padrão
        var map = L.map('map').setView([-22.3674, -46.9428], 14);

        // Layers de mapas
        var padrao = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; CartoDB'
        }).addTo(map);

        var satelite = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            attribution: 'Tiles © Esri'
        });

        var escuro = L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; CartoDB'
        });

        var baseMaps = {
            "Claro": padrao,
            "Satélite": satelite,
            "Escuro": escuro
        };

        L.control.layers(baseMaps).addTo(map);

        // Paleta de cores para rotas individuais de cada motoboy
        var coresRotas = ['#fc8835', '#0f9f90', '#3a86c8', '#8338ec', '#e63946', '#2a9d8f'];

        // Objetos para rastreamento de instâncias ativas no mapa
        var marcadoresEntregadores = {};
        var marcadoresPedidos = {};
        var rotasEntregadores = {};
        var estadoEntregadores = {};

        // Função para calcular a melhor rota (destino mais próximo) usando o mesmo algoritmo do entregador
        function calcularMelhorRotaParaEntregador(id_entregador, startLatLng, pedidos, corRota) {
            var promises = pedidos.map(ponto => {
                if (!ponto.latitude || !ponto.longitude) return Promise.resolve(null);

                var waypoints = [
                    startLatLng,
                    L.latLng(ponto.latitude, ponto.longitude)
                ];

                return new Promise((resolve) => {
                    var tempControl = L.Routing.control({
                        waypoints: waypoints,
                        router: L.Routing.osrmv1({
                            serviceUrl: 'https://router.project-osrm.org/route/v1'
                        }),
                        show: false,
                        lineOptions: {
                            styles: [{
                                color: 'rgba(0,0,0,0)',
                                weight: 1
                            }]
                        },
                        createMarker: function () {
                            return null;
                        }
                    }).on('routesfound', function (e) {
                        var routeLength = e.routes[0].summary.totalDistance;
                        map.removeControl(tempControl);
                        resolve({
                            ponto: ponto,
                            distance: routeLength
                        });
                    }).on('routingerror', function () {
                        map.removeControl(tempControl);
                        resolve(null);
                    }).addTo(map);

                    setTimeout(() => {
                        try {
                            map.removeControl(tempControl);
                        } catch (err) { }
                        resolve(null);
                    }, 2000);
                });
            });

            Promise.all(promises).then(results => {
                results = results.filter(r => r !== null);
                if (results.length === 0) return;

                var melhorRota = results.reduce((acc, cur) => cur.distance < acc.distance ? cur : acc);

                var finalWaypoints = [
                    startLatLng,
                    L.latLng(melhorRota.ponto.latitude, melhorRota.ponto.longitude)
                ];

                if (rotasEntregadores[id_entregador]) {
                    rotasEntregadores[id_entregador].setWaypoints(finalWaypoints);
                } else {
                    var rota = L.Routing.control({
                        waypoints: finalWaypoints,
                        show: false,
                        addWaypoints: false,
                        draggableWaypoints: false,
                        fitSelectedRoutes: false,
                        createMarker: function () {
                            return null;
                        },
                        lineOptions: {
                            styles: [{
                                color: corRota,
                                weight: 6,
                                opacity: 0.8
                            }]
                        },
                        router: L.Routing.osrmv1({
                            serviceUrl: 'https://router.project-osrm.org/route/v1'
                        })
                    }).addTo(map);

                    rotasEntregadores[id_entregador] = rota;
                }
            });
        }

        // Função para carregar localizações e rotas via API
        function atualizarRastreamento() {
            fetch('<?= BASE_URL ?>/routes.php?action=apiAcompanharEntregadores')
                .then(response => response.json())
                .then(data => {
                    if (data && !data.error) {
                        atualizarInterface(data);
                    }
                })
                .catch(error => console.error("Erro ao carregar dados de rastreamento:", error));
        }

        function atualizarInterface(dados) {

            document.getElementById('totalDriversBadge').textContent = dados.length;

            var container = document.getElementById('driverListContainer');
            container.innerHTML = '';

            var idsEntregadoresAtivos = new Set();
            var idsPedidosAtivos = new Set();

            dados.forEach((entregador, index) => {

                idsEntregadoresAtivos.add(entregador.id_entregador);

                var temLocalizacao = (entregador.latitude !== null && entregador.longitude !== null);
                var pedidosPendentes = entregador.pedidos.filter(p => p.status !== 'entregue');
                var temPedidos = pedidosPendentes.length > 0;

                var statusText = 'Offline';
                var statusColor = 'bg-slate-200 text-slate-600';
                var borderColor = 'border-slate-300';

                if (temLocalizacao) {
                    if (temPedidos) {
                        statusText = 'Em rota';
                        statusColor = 'bg-orange-100 text-orange-600';
                        borderColor = 'border-orange-400';
                    } else {
                        statusText = 'Disponível';
                        statusColor = 'bg-emerald-100 text-emerald-600';
                        borderColor = 'border-emerald-400';
                    }
                }

                // CARD
                var card = document.createElement('div');

                card.className =
                    `bg-[#f8fafc] border-l-4 ${borderColor} rounded-2xl p-4 hover:shadow-lg transition cursor-pointer`;

                card.onclick = function () {
                    if (temLocalizacao) {
                        map.setView([entregador.latitude, entregador.longitude], 16);
                        marcadoresEntregadores[entregador.id_entregador].openPopup();
                    }
                };

                var cardHTML = `
                    <div class="flex items-start justify-between gap-3">

                        <div>
                            <h3 class="font-bold text-[#0B0D2F] text-base">
                                ${entregador.nome_completo}
                            </h3>

                            <p class="text-xs text-slate-500 mt-1">
                                ID: ${entregador.id_entregador}
                            </p>
                        </div>

                        <span class="px-3 py-1 rounded-full text-xs font-bold ${statusColor}">
                            ${statusText}
                        </span>

                    </div>
                `;

                if (temPedidos) {

                    cardHTML += `
                        <div class="mt-4 space-y-2">
                    `;

                    pedidosPendentes.forEach((pedido, pIndex) => {

                        idsPedidosAtivos.add(pedido.id_pedido);

                        cardHTML += `
                            <div 
                                onclick="event.stopPropagation(); centralizarNoPedido(${pedido.id_pedido}, ${pedido.latitude}, ${pedido.longitude});"
                                class="bg-white border border-slate-200 rounded-xl p-3 hover:border-orange-300 transition">

                                <div class="flex items-center justify-between">

                                    <strong class="text-sm text-[#0B0D2F]">
                                        ${pIndex + 1}º ${pedido.nome_cliente}
                                    </strong>

                                    <span class="text-orange-500 text-xs font-bold">
                                        R$ ${pedido.preco}
                                    </span>

                                </div>

                                <p class="text-xs text-slate-500 mt-1">
                                    ${pedido.endereco}, ${pedido.bairro}
                                </p>

                            </div>
                        `;
                    });

                    cardHTML += `</div>`;
                } else {

                    cardHTML += `
                        <div class="mt-4 text-xs text-slate-400 italic">
                            Nenhum pedido atribuído
                        </div>
                    `;
                }

                if (temLocalizacao) {
                    cardHTML += `
                        <button 
                            onclick="event.stopPropagation(); map.setView([${entregador.latitude}, ${entregador.longitude}], 16);"
                            class="mt-4 w-full bg-orange-500 hover:bg-orange-600 text-white py-2 rounded-xl text-sm font-semibold transition">

                            Centralizar no mapa
                        </button>
                    `;
                }

                card.innerHTML = cardHTML;
                container.appendChild(card);

                // MAPA
                if (temLocalizacao) {

                    var lat = parseFloat(entregador.latitude);
                    var lng = parseFloat(entregador.longitude);

                    var pulseColorClass = temPedidos ? 'pulse-ring' : 'pulse-ring-idle';

                    var customIcon = L.divIcon({
                        className: 'moto-marker',
                        html: `<div class="${pulseColorClass}"></div><div class="moto-icon-wrapper">🏍️</div>`,
                        iconSize: [40, 40],
                        iconAnchor: [20, 20]
                    });

                    if (marcadoresEntregadores[entregador.id_entregador]) {
                        marcadoresEntregadores[entregador.id_entregador].setLatLng([lat, lng]);
                    } else {

                        var marker = L.marker([lat, lng], {
                            icon: customIcon
                        }).addTo(map);

                        marcadoresEntregadores[entregador.id_entregador] = marker;
                    }

                    var popupContent = `
                        <div style="font-family: Outfit;">
                            <strong>${entregador.nome_completo}</strong><br>
                            ${statusText}
                        </div>
                    `;

                    marcadoresEntregadores[entregador.id_entregador]
                        .bindPopup(popupContent);

                    if (temPedidos) {

                        pedidosPendentes.forEach(pedido => {

                            if (pedido.latitude && pedido.longitude) {

                                var plat = parseFloat(pedido.latitude);
                                var plng = parseFloat(pedido.longitude);

                                var pedidoIcon = L.divIcon({
                                    className: 'delivery-marker-icon',
                                    html: `<div class="delivery-marker">📍</div>`,
                                    iconSize: [24, 24],
                                    iconAnchor: [12, 24]
                                });

                                if (marcadoresPedidos[pedido.id_pedido]) {

                                    marcadoresPedidos[pedido.id_pedido]
                                        .setLatLng([plat, plng]);

                                } else {

                                    var pMarker = L.marker([plat, plng], {
                                        icon: pedidoIcon
                                    }).addTo(map);

                                    marcadoresPedidos[pedido.id_pedido] = pMarker;
                                }

                                marcadoresPedidos[pedido.id_pedido]
                                    .bindPopup(`
                                        <div style="font-family: Outfit;">
                                            <strong>${pedido.nome_cliente}</strong><br>
                                            ${pedido.endereco}
                                        </div>
                                    `);
                            }
                        });

                        var corRota = coresRotas[index % coresRotas.length];
                        var idsPedidosStr = pedidosPendentes.map(p => p.id_pedido).sort().join(',');

                        var estadoAnterior = estadoEntregadores[entregador.id_entregador];

                        var mudou = !estadoAnterior ||
                            estadoAnterior.lat !== lat ||
                            estadoAnterior.lng !== lng ||
                            estadoAnterior.idsPedidosStr !== idsPedidosStr;

                        if (mudou) {

                            estadoEntregadores[entregador.id_entregador] = {
                                lat: lat,
                                lng: lng,
                                idsPedidosStr: idsPedidosStr
                            };

                            calcularMelhorRotaParaEntregador(
                                entregador.id_entregador,
                                L.latLng(lat, lng),
                                pedidosPendentes,
                                corRota
                            );
                        }

                    } else {

                        if (rotasEntregadores[entregador.id_entregador]) {

                            map.removeControl(rotasEntregadores[entregador.id_entregador]);

                            delete rotasEntregadores[entregador.id_entregador];
                        }

                        delete estadoEntregadores[entregador.id_entregador];
                    }

                } else {

                    if (marcadoresEntregadores[entregador.id_entregador]) {

                        map.removeLayer(marcadoresEntregadores[entregador.id_entregador]);

                        delete marcadoresEntregadores[entregador.id_entregador];
                    }

                    if (rotasEntregadores[entregador.id_entregador]) {

                        map.removeControl(rotasEntregadores[entregador.id_entregador]);

                        delete rotasEntregadores[entregador.id_entregador];
                    }

                    delete estadoEntregadores[entregador.id_entregador];
                }

            });

            Object.keys(marcadoresEntregadores).forEach(id => {

                if (!idsEntregadoresAtivos.has(parseInt(id))) {

                    map.removeLayer(marcadoresEntregadores[id]);

                    delete marcadoresEntregadores[id];

                    if (rotasEntregadores[id]) {

                        map.removeControl(rotasEntregadores[id]);

                        delete rotasEntregadores[id];
                    }
                }
            });

            Object.keys(marcadoresPedidos).forEach(id => {

                if (!idsPedidosAtivos.has(parseInt(id))) {

                    map.removeLayer(marcadoresPedidos[id]);

                    delete marcadoresPedidos[id];
                }
            });
        }

        // Centralizar pedido
        function centralizarNoPedido(idPedido, lat, lng) {

            if (lat && lng) {

                map.setView([lat, lng], 17);

                if (marcadoresPedidos[idPedido]) {
                    marcadoresPedidos[idPedido].openPopup();
                }
            }
        }

        atualizarRastreamento();

        setInterval(atualizarRastreamento, 5000);

    </script>

    <!-- SCRIPT -->
   <script>

    // SIDEBAR MOBILE
    const menuBtn = document.getElementById('hamburger');
    const sidebar = document.getElementById('sidebar');
    const closeSidebar = document.getElementById('closeSidebar');
    const overlay = document.getElementById('overlay');

    menuBtn.addEventListener('click', () => {
        sidebar.classList.add('mobile-open');
        overlay.classList.add('active');
    });

    closeSidebar.addEventListener('click', () => {
        sidebar.classList.remove('mobile-open');
        overlay.classList.remove('active');
    });

    overlay.addEventListener('click', () => {
        sidebar.classList.remove('mobile-open');
        overlay.classList.remove('active');
    });

    // MODAL
    const modal = document.getElementById("editProfileModal");
    const openBtn = document.getElementById("openEditModalBtn");
    const closeBtn = document.getElementById("closeEditModalBtn");

    openBtn.addEventListener("click", () => {
        modal.classList.remove("hidden");
    });

    closeBtn.addEventListener("click", () => {
        modal.classList.add("hidden");
    });

    window.addEventListener("click", (event) => {

        if (event.target === modal) {
            modal.classList.add("hidden");
        }
    });

</script>


</body>

</html>