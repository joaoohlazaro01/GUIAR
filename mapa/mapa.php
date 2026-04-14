
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa | Entregador</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="../style/mapa.css" />
</head>

<body>

    <div class="container">
        <br>
        <br>
        <div id="map">
        </div>
        <br><br>
        <center>
            <div class="opcoes">
                <button id="criarRota" type="button" class="btn btn-primary">Começar Percurso</button>
                <form action="" method="post">
                <button id="sair" type="submit" name="sair" class="btn btn-danger">Sair</button>
                </form>
            </div>
        </center>
       
    </div>


    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
    <script src="https://rawgit.com/bbecquet/Leaflet.RotatedMarker/master/leaflet.rotatedMarker.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

 <script>
    // CRIA O MAPA
    var map = L.map('map').setView([-22.3674, -46.9428], 15);

    // ÍCONE MOTO
    var emojiIcon = L.divIcon({
        className: 'emoji-icon',
        html: '<div style="font-size:24px;">🏍️</div>',
        iconSize: [32, 32], // ⚠️ arrumei (1250 tava gigante)
        iconAnchor: [16, 32]
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

  

        fetch('Action_PHP/getLocal.php')
            .then(response => response.json())
            .then(data => {
                data.forEach(pedido => {
                    // Cria o marcador no mapa
                    var marker = L.marker([pedido.latitude, pedido.longitude]).addTo(map);

                    // Adiciona o botão "Concluir Entrega" no popup
                    marker.bindPopup(`
                    <p>Endereço: ${pedido.endereco}</p>
                    <p>Cliente: ${pedido.nome_cliente}</p>
                    <button class="btn-concluir" data-id="${pedido.id_pedido}" data-lat="${pedido.latitude}" data-lng="${pedido.longitude}">Concluir Entrega</button>
                `);

                    // Armazena o marcador para ser removido posteriormente
                    marker.pedidoId = pedido.id;
                    marker.latitude = pedido.latitude;
                    marker.longitude = pedido.longitude;

                    // Adiciona evento para o botão de concluir
                    marker.on('popupopen', function() {
                        document.querySelectorAll('.btn-concluir').forEach(button => {
                            button.addEventListener('click', function() {
                                concluirEntrega(this.getAttribute('data-id'), this.getAttribute('data-lat'), this.getAttribute('data-lng'), marker);
                            });
                        });
                    });
                });
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
                return;
            }

            var promises = points.map(ponto => {
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
                        show:false,
                        LineOptions: {
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
                    show:false,
                    router: L.Routing.osrmv1({
                        serviceUrl: 'https://router.project-osrm.org/route/v1'
                    }),
                    lineOptions: {
                        styles: [{
                            color: 'blue',
                            weight: 7,
                            show: false,
                        }]
                    },
                    createMarker: function() {
                        return null;
                    }
                }).addTo(map);
            });
        }

        // Função para concluir a entrega
        function concluirEntrega(pedidoId, latitude, longitude, marker) {
            fetch('Action_PHP/concluirEntrega.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id: pedidoId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Remove o marcador do mapa
                        map.removeLayer(marker);
                        alert("Entrega concluída com sucesso!");
                        location.reload()
                    } else {
                        alert("Erro ao concluir a entrega.");
                    }
                })
                .catch(error => {
                    console.error("Erro na requisição:", error);
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
                // Remove o ponto alcançado da lista
                points = points.filter(p => p.latitude !== destination.lat && p.longitude !== destination.lng);
                removerPontoDoBanco(destination.lat, destination.lng);
                rotaParaPontoProximo();
            }

        }



        function removerPontoDoBanco(latitude, longitude) {
            fetch('Action_PHP/removePonto.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        latitude: latitude,
                        longitude: longitude
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log("Ponto removido do banco de dados com sucesso.");
                    } else {
                        console.error("Erro ao remover o ponto do banco de dados.");
                    }
                })
                .catch(error => {
                    console.error("Erro na requisição:", error);
                });
        }

     // ===== GEOLOCALIZAÇÃO DO MOTOBOY =====
if (navigator.geolocation) {

    navigator.geolocation.watchPosition(function(position) {

        let lat = position.coords.latitude;
        let lng = position.coords.longitude;

        var userLatLng = L.latLng(lat, lng);
        currentUserPosition = userLatLng;

        // ===== ENVIA LOCALIZAÇÃO PRO BANCO (IMPORTANTE) =====
        fetch('Action_PHP/atualizarLocalizacao.php', {
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
            .bindPopup("Você está aqui 🚀");
        }

        // CENTRALIZA MAPA
        map.setView(userLatLng, 17);

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
        alert("Localização ainda não foi carregada.");
        return;
    }

    fetch('Action_PHP/getLocal.php')
        .then(response => response.json())
        .then(data => {

            if (!data || data.length === 0) {
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
</script>
</body>

</html>

<?php
session_start();
if (empty($_SESSION['entregadorID'])) {
    header('Location: pages/loginEntregador.php');
    exit();
}

if(isset($_POST['sair'])){
    $_SESSION = [];
    session_destroy();
    header('Location: ../ENTREGADOR/loginEntregador.php');
}
?>
