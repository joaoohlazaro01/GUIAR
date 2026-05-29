<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa | Entregador</title>
    <link rel="shortcut icon" type="image/png" href="<?= BASE_URL ?>/img/logoIcon.png">

    <!-- Google Fonts: Inter para interface moderna e limpa -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Leaflet & Routing -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />

    <style>
        @font-face {
            font-family: 'Brice-Bold';
            src: url('<?= BASE_URL ?>/fonts/Brice-BoldSemiCondensed.ttf') format('truetype');
        }

        @font-face {
            font-family: 'BasisGrotesque-Regular';
            src: url('<?= BASE_URL ?>/fonts/BasisGrotesqueArabicPro-Regular.ttf') format('truetype');
        }

        @font-face {
            font-family: 'Brice-SemiBoldSemi';
            src: url('<?= BASE_URL ?>/fonts/Brice-SemiBoldSemiCondensed.ttf');
        }

        body {
            font-family: 'Inter', 'BasisGrotesque-Regular', sans-serif;
            background-color: #F8FAFC;
        }

        /* Scrollbar estilizada */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #F1F5F9;
        }

        ::-webkit-scrollbar-thumb {
            background: #CBD5E1;
            border-radius: 99px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94A3B8;
        }

        .menu-item {
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .menu-item:hover {
            background-color: rgba(233, 78, 0, 0.08);
            transform: translateX(4px);
            color: #E94E00 !important;
        }

        .menu-item:hover svg {
            color: #E94E00 !important;
        }

        .active-menu {
            background: linear-gradient(90deg, rgba(233, 78, 0, 0.12) 0%, rgba(233, 78, 0, 0.03) 100%);
            border-left: 4px solid #E94E00;
            color: #E94E00 !important;
        }

        .active-menu svg {
            color: #E94E00 !important;
        }

        /* Mapa Específico */
        #map {
            width: 100%;
            height: calc(100vh - 180px);
            min-height: 500px;
            border-radius: 1.5rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            z-index: 10;
            border: 1px solid #E2E8F0;
        }

        .emoji-icon {
            text-align: center;
            line-height: 32px;
            filter: drop-shadow(0 4px 3px rgb(0 0 0 / 0.15));
        }

        /* Ajustes de Popups do Leaflet para ficar com cara de Tailwind */
        .leaflet-popup-content-wrapper {
            border-radius: 1rem !important;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1) !important;
        }

        .leaflet-popup-content {
            margin: 16px !important;
            line-height: 1.5 !important;
        }

        .leaflet-popup-content p {
            margin: 0 0 8px 0 !important;
            font-family: 'Inter', sans-serif !important;
            color: #334155 !important;
            font-size: 14px !important;
            font-weight: 500;
        }

        .btn-concluir {
            background-color: #E94E00;
            color: white;
            padding: 10px 16px;
            border-radius: 0.75rem;
            border: none;
            cursor: pointer;
            width: 100%;
            font-weight: 700;
            font-family: 'Inter', sans-serif;
            font-size: 13px;
            margin-top: 8px;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            box-shadow: 0 4px 6px -1px rgba(233, 78, 0, 0.3);
        }

        .btn-concluir:hover {
            background-color: #c63f00;
            transform: scale(1.02);
        }
    </style>
</head>

<body class="min-h-screen flex bg-[#F8FAFC] text-[#0F172A] overflow-x-hidden lg:pl-72">

    <!-- Overlay do Sidebar Mobile -->
    <div id="sidebarOverlay" class="fixed inset-0 bg-slate-900/50 z-40 hidden lg:hidden transition-opacity"></div>

    <!-- SIDEBAR -->
    <aside id="sidebar" class="w-72 bg-white flex flex-col justify-between flex-shrink-0 min-h-screen text-slate-900 fixed top-0 left-0 z-50 shadow-2xl overflow-y-auto transform -translate-x-full lg:translate-x-0 transition-transform duration-300 border-r border-slate-200">

        <div>
            <div class="p-8">
                <img src="<?= BASE_URL ?>/img/LogoGuiar.png" alt="Logo GUIAR" class="w-32 h-auto object-contain">
            </div>

            <nav class="px-4 space-y-1.5">
                <a href="<?= BASE_URL ?>/routes.php?action=meusPedidosEntregador" class="menu-item flex items-center gap-3.5 px-5 py-3.5 rounded-xl font-semibold text-sm text-slate-600 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    Meus Pedidos
                </a>

                <a href="<?= BASE_URL ?>/routes.php?action=mapaEntregador" class="menu-item active-menu flex items-center gap-3.5 px-5 py-3.5 rounded-xl font-semibold text-sm text-[#A16207]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#A16207]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                    </svg>
                    Abrir Mapa
                </a>

                <a href="<?= BASE_URL ?>/routes.php?action=perfilEntregador" class="menu-item flex items-center gap-3.5 px-5 py-3.5 rounded-xl font-semibold text-sm text-slate-600 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Meu Perfil
                </a>
            </nav>
        </div>

        <!-- Logout no rodapé da sidebar -->
        <div class="px-4 pb-8">
            <a href="<?= BASE_URL ?>/routes.php?action=logoutEntregador" class="flex items-center gap-3.5 px-5 py-3.5 rounded-xl font-semibold text-sm text-slate-600 hover:text-[#E94E00] hover:bg-[#E94E00]/10 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-slate-500 hover:text-[#E94E00]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Sair
            </a>
        </div>
    </aside>

    <!-- CONTEÚDO PRINCIPAL -->
    <div class="flex-1 min-w-0 flex flex-col min-h-screen">
        <!-- HEADER DA PÁGINA -->
        <header class="bg-white border-b border-[#E2E8F0] px-4 lg:px-8 py-5 flex items-center justify-between sticky top-0 z-30 shadow-sm">
            <div class="flex items-center gap-4 min-w-0 flex-1">
                <button id="mobileMenuBtn" class="lg:hidden p-2 text-slate-600 hover:bg-slate-100 rounded-xl transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <div class="min-w-0 flex-1">
                    <h1 class="text-xl lg:text-2xl font-extrabold text-slate-900 flex items-center gap-2 truncate">
                        Mapa de Entregas
                    </h1>
                    <p class="text-xs text-slate-500 font-medium mt-0.5 truncate">Visualize a rota das suas entregas e sua localização em tempo real</p>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <button type="button" id="criarRota" class="flex items-center gap-2 bg-[#E94E00] hover:bg-[#c63f00] text-white font-bold text-sm px-5 py-2.5 rounded-xl transition shadow-md hover:scale-[1.02]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    Começar Percurso
                </button>
            </div>
        </header>

        <!-- CONTEÚDO PRINCIPAL -->
        <main class="flex-grow p-8 lg:px-12 xl:px-16">
            <div class="max-w-[1400px] mx-auto bg-white p-2 rounded-3xl border border-slate-100 shadow-sm">
                <div id="map"></div>
            </div>
        </main>

    </div>

    <!-- Scripts Leaflet -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
    <script src="https://rawgit.com/bbecquet/Leaflet.RotatedMarker/master/leaflet.rotatedMarker.js"></script>

    <script>
        // CRIA O MAPA
        var map = L.map('map').setView([-22.3674, -46.9428], 15);

        // ÍCONE MOTO
        var emojiIcon = L.divIcon({
            className: 'emoji-icon',
            html: '<div style="font-size:32px;">🏍️</div>',
            iconSize: [40, 40],
            iconAnchor: [20, 40]
        });

        // MAPA PADRÃO (CLARO)
        var padrao = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; CartoDB'
        }).addTo(map);

        // MAPA SATÉLITE
        var satelite = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            attribution: 'Tiles © Esri'
        });

        // MAPA ESCURO
        var escuro = L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; CartoDB'
        });

        // CONTROLE DE TROCA
        var baseMaps = {
            "Claro": padrao,
            "Satélite": satelite,
            "Escuro": escuro
        };

        L.control.layers(baseMaps).addTo(map);

        fetch('<?= BASE_URL ?>/routes.php?action=apiPedidosMapa')
            .then(response => response.json())
            .then(data => {
                if (data && !data.error) {
                    data.forEach(pedido => {
                        if (pedido.latitude && pedido.longitude) {
                            // Cria o marcador no mapa
                            var marker = L.marker([pedido.latitude, pedido.longitude]).addTo(map);

                            // Adiciona o popup moderno
                            marker.bindPopup(`
                            <div>
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Cliente</p>
                                <p class="text-sm font-semibold text-slate-900 mb-3">${pedido.nome_cliente}</p>
                                
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Endereço</p>
                                <p class="text-sm font-medium text-slate-700">${pedido.endereco}</p>
                                
                                <button class="btn-concluir mt-4" data-id="${pedido.id_pedido}" data-lat="${pedido.latitude}" data-lng="${pedido.longitude}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Concluir Entrega
                                </button>
                            </div>
                            `);

                            // Armazena o marcador para ser removido posteriormente
                            marker.pedidoId = pedido.id_pedido;
                            marker.latitude = pedido.latitude;
                            marker.longitude = pedido.longitude;

                            // Adiciona evento para o botão de concluir
                            marker.on('popupopen', function() {
                                document.querySelectorAll('.btn-concluir').forEach(button => {
                                    button.addEventListener('click', function() {
                                        const btn = this;
                                        const originalText = btn.innerHTML;
                                        btn.innerHTML = 'Processando...';
                                        btn.disabled = true;
                                        concluirEntrega(this.getAttribute('data-id'), marker, btn, originalText);
                                    });
                                });
                            });
                        }
                    });
                }
            });

        var userMarker, routeControl;
        var currentUserPosition;
        var points = [];
        var shortestRouteControl;
        var testando;

        // Função para calcular a rota mais curta entre o usuário e os pontos
        function calcularMelhorRota() {
            if (points.length === 0) {
                alert("Todas as entregas foram concluídas!");
                if (shortestRouteControl) {
                    map.removeControl(shortestRouteControl);
                    shortestRouteControl = null;
                }
                return;
            }

            var promises = points.map(ponto => {
                if (!ponto.latitude || !ponto.longitude) return Promise.resolve(null);

                var waypoints = [
                    currentUserPosition,
                    L.latLng(ponto.latitude, ponto.longitude)
                ];

                return new Promise((resolve, reject) => {
                    testando = L.Routing.control({
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
                        var routeLength = e.routes[0].summary.totalDistance; // Distância da rota em metros
                        resolve({
                            ponto: ponto,
                            distance: routeLength,
                            routeControl: e.control
                        });
                    }).addTo(map);
                });
            });

            Promise.all(promises).then(results => {
                // Filtra nulos
                results = results.filter(r => r !== null);
                if (results.length === 0) return;

                // Remove todas as rotas do mapa
                if (shortestRouteControl) {
                    map.removeControl(shortestRouteControl);
                }

                // Encontra a rota mais curta
                var melhorRota = results.reduce((acc, cur) => cur.distance < acc.distance ? cur : acc);

                // Adiciona a rota mais curta ao mapa
                shortestRouteControl = L.Routing.control({
                    waypoints: [
                        currentUserPosition,
                        L.latLng(melhorRota.ponto.latitude, melhorRota.ponto.longitude)
                    ],
                    show: false,
                    router: L.Routing.osrmv1({
                        serviceUrl: 'https://router.project-osrm.org/route/v1'
                    }),
                    lineOptions: {
                        styles: [{
                            color: '#E94E00', // Corrigido para a cor do tema
                            weight: 6,
                            opacity: 0.8
                        }]
                    },
                    createMarker: function() {
                        return null;
                    }
                }).addTo(map);
            });
        }

        // Função para concluir a entrega
        function concluirEntrega(pedidoId, marker, btn, originalText) {
            fetch('<?= BASE_URL ?>/routes.php?action=concluirEntrega', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id_pedido: pedidoId
                    })
                })
                .then(response => response.text())
                .then(text => {
                    if (text.trim() === 'success') {
                        // Remove o marcador do mapa
                        map.removeLayer(marker);
                        alert("Entrega concluída com sucesso!");
                        location.reload();
                    } else {
                        alert("Erro ao concluir a entrega.");
                        if (btn) {
                            btn.innerHTML = originalText;
                            btn.disabled = false;
                        }
                    }
                })
                .catch(error => {
                    console.error("Erro na requisição:", error);
                    if (btn) {
                        btn.innerHTML = originalText;
                        btn.disabled = false;
                    }
                });
        }

        // Função para atualizar a rota com a nova localização do motoboy
        function rotaParaPontoProximo() {
            calcularMelhorRota();
        }

        function MonitorarProgressoRota() {
            if (!shortestRouteControl) return;

            var routeCoords = shortestRouteControl.getPlan().getWaypoints();
            if (routeCoords.length < 2) return;

            var destination = routeCoords[routeCoords.length - 1].latLng;
            var distanceToDestination = currentUserPosition.distanceTo(destination);

            if (distanceToDestination < 20) {
                // Apenas remove o ponto alcançado da lista de próximos destinos,
                // NÃO deleta do banco para permitir a conclusão manual!
                points = points.filter(p => p.latitude != destination.lat && p.longitude != destination.lng);
                rotaParaPontoProximo();
            }
        }

        // ===== GEOLOCALIZAÇÃO DO MOTOBOY =====
        if (navigator.geolocation) {

            navigator.geolocation.watchPosition(function(position) {

                let lat = position.coords.latitude;
                let lng = position.coords.longitude;

                var userLatLng = L.latLng(lat, lng);
                currentUserPosition = userLatLng;

                // ===== ENVIA LOCALIZAÇÃO PRO BANCO =====
                fetch('<?= BASE_URL ?>/routes.php?action=apiLocalizacaoEntregador', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        latitude: lat,
                        longitude: lng
                    })
                }).catch(err => console.error("Erro ao atualizar localização:", err));

                // ===== ATUALIZA MARCADOR =====
                if (userMarker) {
                    userMarker.setLatLng(userLatLng);
                } else {
                    userMarker = L.marker(userLatLng, {
                            icon: emojiIcon
                        }).addTo(map)
                        .bindPopup("<div style='text-align:center; font-family:Inter; font-weight:600; padding:4px;'>Você está aqui 🚀</div>");
                }

                // CENTRALIZA MAPA (Apenas na primeira vez ou se for útil)
                // map.setView(userLatLng, 17);

                // MONITORA ROTA
                MonitorarProgressoRota();

            }, function(error) {
                console.error("Erro ao obter localização: " + error.message);
            }, {
                enableHighAccuracy: true,
                maximumAge: 0,
                timeout: 5000
            });

        } else {
            alert("Geolocalização não é suportada pelo seu navegador.");
        }

        // ===== BOTÃO CRIAR ROTA =====
        document.getElementById('criarRota').addEventListener('click', function() {

            if (!currentUserPosition) {
                alert("Localização ainda não foi carregada. Aguarde...");
                return;
            }

            fetch('<?= BASE_URL ?>/routes.php?action=apiPedidosMapa')
                .then(response => response.json())
                .then(data => {

                    if (!data || data.length === 0 || data.error) {
                        alert("Nenhuma entrega disponível.");
                        return;
                    }

                    points = data;

                    // CRIA ROTA PARA O MAIS PRÓXIMO
                    rotaParaPontoProximo();

                })
                .catch(error => {
                    console.error("Erro ao buscar pedidos:", error);
                });

        });

        // Script para Sidebar Mobile
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');

        if (mobileMenuBtn && overlay && sidebar) {
            function toggleSidebar() {
                sidebar.classList.toggle('-translate-x-full');
                overlay.classList.toggle('hidden');
            }
            mobileMenuBtn.addEventListener('click', toggleSidebar);
            overlay.addEventListener('click', toggleSidebar);
        }
    </script>
</body>

</html>