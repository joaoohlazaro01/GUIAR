<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acompanhamento de Entregadores | Administrador</title>

    <!-- Leaflet & Leaflet Routing Machine CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />

    <!-- Bootstrap 5 & Google Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="Shortcut Icon" type="image/png" href="<?= BASE_URL ?>/img/G.png">
    <link href="<?= BASE_URL ?>/style/indexAdm.css" rel="stylesheet">

    <style>
        body {
            background-color: #fefaf1 !important;
            font-family: 'Outfit', sans-serif !important;
        }

        .main {
            margin-left: 250px;
            padding: 25px;
            display: flex;
            flex-direction: column;
            height: 100vh;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .page-title h1 {
            font-family: 'Brice-Bold', 'Outfit', sans-serif;
            font-size: 36px;
            margin: 0;
            color: #131646;
        }

        .page-title h1 span {
            -webkit-text-stroke-width: 1px;
            -webkit-text-stroke-color: #131646;
            -webkit-text-fill-color: #ff9a52;
        }

        /* Layout Grid do Rastreamento */
        .tracking-container {
            display: flex;
            gap: 20px;
            flex: 1;
            min-height: 0;
            /* Permite scroll interno */
            margin-bottom: 20px;
        }

        #map {
            flex: 1;
            height: 100%;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border: 2px solid rgba(252, 136, 53, 0.2);
            z-index: 1;
        }

        .tracking-sidebar {
            width: 380px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            border: 1px solid rgba(252, 136, 53, 0.15);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            padding: 20px;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .sidebar-title {
            font-size: 20px;
            font-weight: 600;
            color: #131646;
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #fc8835;
            padding-bottom: 8px;
        }

        .driver-list {
            flex: 1;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 12px;
            padding-right: 5px;
        }

        /* Estilo dos Cards de Entregadores */
        .driver-card {
            background: #fff;
            border-radius: 12px;
            padding: 15px;
            border-left: 6px solid #ccc;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.03);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .driver-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08);
        }

        .driver-card.online-active {
            border-left-color: #ff7b00;
        }

        .driver-card.online-idle {
            border-left-color: #2ec4b6;
        }

        .driver-card.offline {
            border-left-color: #9e9e9e;
            opacity: 0.8;
        }

        .driver-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 8px;
        }

        .driver-name {
            font-weight: 600;
            color: #131646;
            font-size: 16px;
        }

        .status-badge {
            font-size: 11px;
            padding: 4px 8px;
            border-radius: 20px;
            font-weight: 500;
        }

        .badge-active {
            background-color: #ffe6cc;
            color: #d35400;
        }

        .badge-idle {
            background-color: #e6f9f8;
            color: #0f9f90;
        }

        .badge-offline {
            background-color: #f1f3f5;
            color: #6c757d;
        }

        .driver-details {
            font-size: 13px;
            color: #666;
            margin-bottom: 10px;
        }

        /* Pontos de Entrega / Rota */
        .delivery-points-header {
            font-size: 12px;
            text-transform: uppercase;
            font-weight: 600;
            color: #999;
            margin-top: 10px;
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .delivery-point-item {
            font-size: 12.5px;
            background: #fafafa;
            border-radius: 8px;
            padding: 8px 12px;
            margin-bottom: 6px;
            border: 1px solid #eee;
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .delivery-point-item strong {
            color: #131646;
        }

        .delivery-badge {
            align-self: flex-start;
            font-size: 9.5px;
            padding: 2px 6px;
            border-radius: 4px;
            font-weight: 600;
            margin-top: 4px;
        }

        .delivery-badge.pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .delivery-badge.en-route {
            background-color: #cce5ff;
            color: #004085;
        }

        /* Ícones customizados do mapa */
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
            filter: drop-shadow(0px 3px 4px rgba(0, 0, 0, 0.3));
        }

        .pulse-ring {
            position: absolute;
            width: 32px;
            height: 32px;
            border: 3px solid #ff7b00;
            border-radius: 50%;
            animation: pulse-animation 1.5s infinite;
            pointer-events: none;
        }

        .pulse-ring-idle {
            position: absolute;
            width: 32px;
            height: 32px;
            border: 3px solid #2ec4b6;
            border-radius: 50%;
            animation: pulse-animation 1.5s infinite;
            pointer-events: none;
        }

        @keyframes pulse-animation {
            0% {
                transform: scale(0.6);
                opacity: 1;
            }

            100% {
                transform: scale(1.6);
                opacity: 0;
            }
        }

        @keyframes bounce {
            0% {
                transform: translateY(0);
            }

            100% {
                transform: translateY(-4px);
            }
        }

        .delivery-marker {
            background-color: #ff7b00;
            border: 2px solid white;
            border-radius: 50%;
            color: white;
            font-weight: bold;
            font-size: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.4);
            width: 24px;
            height: 24px;
        }

        /* Botão Ações */
        .btn-locate {
            background: #fc8835;
            color: white;
            border: none;
            font-size: 12px;
            padding: 5px 10px;
            border-radius: 6px;
            width: 100%;
            margin-top: 10px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-locate:hover {
            background: #ff7b00;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: #fc8835;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #ff7b00;
        }

        /* Responsividade para Dispositivos Móveis */
        @media (max-width: 768px) {
            .sidebar {
                position: relative !important;
                height: auto !important;
                width: 100% !important;
                flex-direction: row !important;
                flex-wrap: wrap !important;
                padding: 10px !important;
                justify-content: center !important;
            }

            .sidebar a {
                padding: 8px 12px !important;
                font-size: 14px !important;
            }

            .sidebar .spacer {
                display: none !important;
            }

            .logout-btn {
                position: static !important;
                display: block !important;
                margin: 10px auto !important;
                text-align: center !important;
                width: fit-content !important;
            }

            .main {
                margin-left: 0 !important;
                padding: 15px !important;
                height: auto !important;
                min-height: 100vh !important;
            }

            .page-header {
                flex-direction: column !important;
                align-items: center !important;
                text-align: center !important;
            }

            .page-title h1 {
                font-size: 24px !important;
            }

            .tracking-container {
                flex-direction: column !important;
                height: auto !important;
                min-height: 0 !important;
                gap: 15px !important;
            }

            #map {
                height: 400px !important;
                width: 100% !important;
                min-height: 350px !important;
                flex: none !important;
            }

            .tracking-sidebar {
                width: 100% !important;
                height: 450px !important;
                flex: none !important;
            }
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <a href="<?= BASE_URL ?>/routes.php?action=dashboardAdm">Início</a>
        <a href="<?= BASE_URL ?>/routes.php?action=pedidos">Pedidos</a>
        <a href="<?= BASE_URL ?>/routes.php?action=entregadores">Entregadores</a>
        <a href="<?= BASE_URL ?>/routes.php?action=pedidosEntregues">Pedidos Entregues</a>
        <a href="<?= BASE_URL ?>/routes.php?action=mapaAdm" class="active" style="background-color: #575757;">Acompanhar Rotas</a>
        <div class="spacer"></div>
        <a href="<?= BASE_URL ?>/routes.php?action=perfilAdm">Meu perfil</a>
    </div>

    <!-- Botão de logout -->
    <a href="<?= BASE_URL ?>/routes.php?action=logoutAdm" class="logout-btn">Logout</a>

    <div class="main">
        <div class="page-header">
            <div class="page-title">
                <h1>Acompanhamento de <span>Entregadores</span></h1>
            </div>
        </div>

        <div class="tracking-container">
            <!-- Mapa Leaflet -->
            <div id="map"></div>

            <!-- Painel Lateral -->
            <div class="tracking-sidebar">
                <div class="sidebar-title">
                    <span>Entregadores & Rotas</span>
                    <span class="badge bg-secondary" id="totalDriversBadge" style="font-size: 11px;">0</span>
                </div>
                <div class="driver-list" id="driverListContainer">
                    <div class="text-center py-4 text-muted">Carregando dados dos entregadores...</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts do Leaflet e Leaflet Routing Machine -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
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
                        createMarker: function() {
                            return null;
                        }
                    }).on('routesfound', function(e) {
                        var routeLength = e.routes[0].summary.totalDistance;
                        map.removeControl(tempControl);
                        resolve({
                            ponto: ponto,
                            distance: routeLength
                        });
                    }).on('routingerror', function() {
                        map.removeControl(tempControl);
                        resolve(null);
                    }).addTo(map);

                    // Timeout de segurança
                    setTimeout(() => {
                        try {
                            map.removeControl(tempControl);
                        } catch (err) {}
                        resolve(null);
                    }, 2000);
                });
            });

            Promise.all(promises).then(results => {
                results = results.filter(r => r !== null);
                if (results.length === 0) return;

                // Encontra a rota mais curta (mesmo algoritmo do entregador)
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
                        createMarker: function() {
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
            // Atualizar o número total de entregadores cadastrados
            document.getElementById('totalDriversBadge').textContent = dados.length;

            var container = document.getElementById('driverListContainer');
            container.innerHTML = '';

            // Armazenar os IDs que estão ativos no ciclo atual
            var idsEntregadoresAtivos = new Set();
            var idsPedidosAtivos = new Set();

            dados.forEach((entregador, index) => {
                idsEntregadoresAtivos.add(entregador.id_entregador);

                var temLocalizacao = (entregador.latitude !== null && entregador.longitude !== null);
                var pedidosPendentes = entregador.pedidos.filter(p => p.status !== 'entregue');
                var temPedidos = pedidosPendentes.length > 0;

                // Definir status do entregador
                var statusClass = 'offline';
                var statusText = 'Sem sinal';
                var badgeClass = 'badge-offline';

                if (temLocalizacao) {
                    if (temPedidos) {
                        statusClass = 'online-active';
                        statusText = 'Em rota';
                        badgeClass = 'badge-active';
                    } else {
                        statusClass = 'online-idle';
                        statusText = 'Disponível';
                        badgeClass = 'badge-idle';
                    }
                }

                // Renderizar Card do Entregador no painel lateral
                var card = document.createElement('div');
                card.className = `driver-card ${statusClass}`;
                card.onclick = function() {
                    if (temLocalizacao) {
                        map.setView([entregador.latitude, entregador.longitude], 16);
                        marcadoresEntregadores[entregador.id_entregador].openPopup();
                    } else {
                        alert("Este entregador ainda não enviou coordenadas GPS.");
                    }
                };

                var cardHTML = `
                    <div class="driver-header">
                        <span class="driver-name">${entregador.nome_completo}</span>
                        <span class="status-badge ${badgeClass}">${statusText}</span>
                    </div>
                    <div class="driver-details">
                        ID: ${entregador.id_entregador} ${temLocalizacao ? `| Lat: ${parseFloat(entregador.latitude).toFixed(4)}, Lng: ${parseFloat(entregador.longitude).toFixed(4)}` : ''}
                    </div>
                `;

                if (temPedidos) {
                    cardHTML += `<div class="delivery-points-header">📍 Pontos de Entrega (${pedidosPendentes.length})</div>`;
                    pedidosPendentes.forEach((pedido, pIndex) => {
                        idsPedidosAtivos.add(pedido.id_pedido);
                        cardHTML += `
                            <div class="delivery-point-item" onclick="event.stopPropagation(); centralizarNoPedido(${pedido.id_pedido}, ${pedido.latitude}, ${pedido.longitude});">
                                <div><strong>${pIndex + 1}º - ${pedido.nome_cliente}</strong></div>
                                <div style="font-size: 11.5px; color: #555;">${pedido.endereco}, ${pedido.bairro}</div>
                                <div style="font-size: 11px; color: #fc8835; font-weight: 500;">R$ ${pedido.preco}</div>
                            </div>
                        `;
                    });
                } else {
                    cardHTML += `<div class="text-muted" style="font-size: 12px; font-style: italic; margin-top: 8px;">Nenhum pedido atribuído</div>`;
                }

                if (temLocalizacao) {
                    cardHTML += `<button class="btn-locate" onclick="event.stopPropagation(); map.setView([${entregador.latitude}, ${entregador.longitude}], 16);">Centralizar no Mapa</button>`;
                }

                card.innerHTML = cardHTML;
                container.appendChild(card);

                // --- MANIPULAÇÃO DO MAPA ---

                // 1. Atualizar ou Criar Marcador do Entregador
                if (temLocalizacao) {
                    var lat = parseFloat(entregador.latitude);
                    var lng = parseFloat(entregador.longitude);

                    // Seleciona o estilo do anel pulsar dependendo do status do entregador
                    var pulseColorClass = temPedidos ? 'pulse-ring' : 'pulse-ring-idle';

                    var customIcon = L.divIcon({
                        className: 'moto-marker',
                        html: `<div class="${pulseColorClass}"></div><div class="moto-icon-wrapper">🏍️</div>`,
                        iconSize: [40, 40],
                        iconAnchor: [20, 20]
                    });

                    if (marcadoresEntregadores[entregador.id_entregador]) {
                        // Atualiza a posição
                        marcadoresEntregadores[entregador.id_entregador].setLatLng([lat, lng]);
                    } else {
                        // Cria novo marcador
                        var marker = L.marker([lat, lng], {
                            icon: customIcon
                        }).addTo(map);
                        marcadoresEntregadores[entregador.id_entregador] = marker;
                    }

                    // Configura Popup com informações
                    var popupContent = `
                        <div style="font-family: 'Outfit', sans-serif;">
                            <strong style="color:#131646; font-size:14px;">${entregador.nome_completo}</strong><br>
                            <span style="font-size:12px; color:#666;">Status: ${statusText}</span><br>
                            ${temPedidos ? `<span style="font-size:12px; font-weight:600; color:#fc8835;">Em entrega de ${pedidosPendentes.length} pedidos</span>` : ''}
                        </div>
                    `;
                    marcadoresEntregadores[entregador.id_entregador].bindPopup(popupContent);

                    // 2. Desenhar Rotas e Pontos de Entrega do Motoboy
                    if (temPedidos) {
                        pedidosPendentes.forEach(pedido => {
                            if (pedido.latitude && pedido.longitude) {
                                var plat = parseFloat(pedido.latitude);
                                var plng = parseFloat(pedido.longitude);

                                // Adiciona ou atualiza marcador do pedido no mapa
                                var pedidoIcon = L.divIcon({
                                    className: 'delivery-marker-icon',
                                    html: `<div class="delivery-marker">📍</div>`,
                                    iconSize: [24, 24],
                                    iconAnchor: [12, 24]
                                });

                                if (marcadoresPedidos[pedido.id_pedido]) {
                                    marcadoresPedidos[pedido.id_pedido].setLatLng([plat, plng]);
                                } else {
                                    var pMarker = L.marker([plat, plng], {
                                        icon: pedidoIcon
                                    }).addTo(map);
                                    marcadoresPedidos[pedido.id_pedido] = pMarker;
                                }

                                marcadoresPedidos[pedido.id_pedido].bindPopup(`
                                    <div style="font-family: 'Outfit', sans-serif; font-size:12.5px;">
                                        <strong>Cliente:</strong> ${pedido.nome_cliente}<br>
                                        <strong>Endereço:</strong> ${pedido.endereco}<br>
                                        <strong>Bairro:</strong> ${pedido.bairro}<br>
                                        <strong>Entregador:</strong> ${entregador.nome_completo}
                                    </div>
                                `);
                            }
                        });

                        // Desenhar a melhor rota para o ponto mais próximo, usando o mesmo algoritmo do entregador
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
                            calcularMelhorRotaParaEntregador(entregador.id_entregador, L.latLng(lat, lng), pedidosPendentes, corRota);
                        }
                    } else {
                        // Se não tem pedidos, remove rota se houver
                        if (rotasEntregadores[entregador.id_entregador]) {
                            map.removeControl(rotasEntregadores[entregador.id_entregador]);
                            delete rotasEntregadores[entregador.id_entregador];
                        }
                        delete estadoEntregadores[entregador.id_entregador];
                    }
                } else {
                    // Sem localização: remove marcador e rota se existirem
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

            // Limpar do mapa os marcadores de entregadores inativos/removidos
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

            // Limpar do mapa marcadores de pedidos entregues/concluídos
            Object.keys(marcadoresPedidos).forEach(id => {
                if (!idsPedidosAtivos.has(parseInt(id))) {
                    map.removeLayer(marcadoresPedidos[id]);
                    delete marcadoresPedidos[id];
                }
            });
        }

        // Função para centralizar o mapa em um pedido específico
        function centralizarNoPedido(idPedido, lat, lng) {
            if (lat && lng) {
                map.setView([lat, lng], 17);
                if (marcadoresPedidos[idPedido]) {
                    marcadoresPedidos[idPedido].openPopup();
                }
            }
        }

        // Primeira carga e loop de atualização (a cada 5 segundos)
        atualizarRastreamento();
        setInterval(atualizarRastreamento, 5000);
    </script>
</body>

</html>