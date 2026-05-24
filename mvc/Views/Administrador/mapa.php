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
        <aside
            class="hidden lg:flex w-[280px] bg-[#05073b] text-white flex-col justify-between p-6 rounded-r-[35px]">

            <div>

                <!-- LOGO -->
                <div class="mb-12">
                    <h1 class="text-4xl font-black tracking-wide">
                        GUIAR
                    </h1>
                </div>

                <!-- MENU -->
                <nav class="space-y-3">

                    <a href="<?= BASE_URL ?>/routes.php?action=dashboardAdm"
                        class="flex items-center gap-3 bg-yellow-400 text-black px-5 py-4 rounded-2xl font-bold shadow-lg">
                        🏠
                        <span>Início</span>
                    </a>

                    <a href="<?= BASE_URL ?>/routes.php?action=pedidos"
                        class="flex items-center gap-3 px-5 py-4 rounded-2xl text-slate-300 hover:bg-white/10 transition">
                        📦
                        <span>Pedidos</span>
                    </a>

                    <a href="<?= BASE_URL ?>/routes.php?action=entregadores"
                        class="flex items-center gap-3 px-5 py-4 rounded-2xl text-slate-300 hover:bg-white/10 transition">
                        🏍️
                        <span>Entregadores</span>
                    </a>

                    <a href="<?= BASE_URL ?>/routes.php?action=pedidosEntregues"
                        class="flex items-center gap-3 px-5 py-4 rounded-2xl text-slate-300 hover:bg-white/10 transition">
                        ✅
                        <span>Pedidos Entregues</span>
                    </a>

                    <a href="<?= BASE_URL ?>/routes.php?action=mapaAdm"
                        class="flex items-center gap-3 px-5 py-4 rounded-2xl bg-white/10 text-white font-semibold">
                        🗺️
                        <span>Acompanhar Rotas</span>
                    </a>

                    <a href="<?= BASE_URL ?>/routes.php?action=perfilAdm"
                        class="flex items-center gap-3 px-5 py-4 rounded-2xl text-slate-300 hover:bg-white/10 transition">
                        👤
                        <span>Meu Perfil</span>
                    </a>

                </nav>
            </div>

            <!-- PERFIL -->
            <div
                class="bg-white/5 border border-white/10 rounded-3xl p-4 flex items-center justify-between">

                <div class="flex items-center gap-3">

                    <div
                        class="w-12 h-12 rounded-full bg-yellow-400 text-[#05073b] font-black flex items-center justify-center">
                        VI
                    </div>

                    <div>
                        <p class="font-bold">Vini</p>
                        <p class="text-xs text-slate-400 uppercase">ADMIN</p>
                    </div>
                </div>

                <a href="<?= BASE_URL ?>/routes.php?action=logoutAdm"
                    class="text-slate-400 hover:text-white transition">
                    ↩
                </a>
            </div>

        </aside>

        <!-- MAIN -->
        <main class="flex-1 overflow-hidden flex flex-col">

            <!-- HEADER -->
            <header
                class="h-[95px] bg-white border-b border-slate-200 px-5 lg:px-10 flex items-center justify-between">

                <div>
                    <h1 class="text-3xl font-extrabold text-[#0B0D2F]">
                        Acompanhamento de <span class="text-orange-500">Entregadores</span>
                    </h1>

                    <p class="text-slate-500 mt-1">
                        Monitoramento em tempo real das entregas
                    </p>
                </div>

                <div class="hidden md:flex items-center gap-4">

                    <div
                        class="bg-[#f5f7fb] border border-slate-200 rounded-2xl px-5 h-12 flex items-center w-[320px]">
                        <input type="text"
                            placeholder="Buscar entregador..."
                            class="bg-transparent outline-none w-full text-sm">
                    </div>

                    <a href="<?= BASE_URL ?>/routes.php?action=logoutAdm"
                        class="bg-orange-500 hover:bg-orange-600 transition text-white px-6 h-12 rounded-2xl font-semibold flex items-center">
                        Logout
                    </a>

                </div>

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

</body>

</html>