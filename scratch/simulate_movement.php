<?php

/**
 * Script de Simulação de Movimentação do Entregador
 * 
 * Este script roda via CLI (linha de comando) e simula o deslocamento físico
 * de um entregador em direção aos seus pontos de entrega ativos no banco de dados.
 * Ele atualiza as coordenadas de latitude e longitude a cada 2 segundos.
 * 
 * Uso: php scratch/simulate_movement.php [id_entregador]
 */

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../mvc/Models/Entregador.php';
require_once __DIR__ . '/../mvc/Models/Pedido.php';

use mvc\Models\Entregador;
use mvc\Models\Pedido;

// ID do entregador padrão (Jaime do Grau)
$id_entregador = isset($argv[1]) ? intval($argv[1]) : 20;

echo "=========================================================\n";
echo "    SIMULADOR DE MOVIMENTAÇÃO DE ENTREGADOR (GUIAR)      \n";
echo "=========================================================\n";

try {
    $entregadorModel = new Entregador($pdo);
    $pedidoModel = new Pedido($pdo);

    // Buscar entregador
    $stmt = $pdo->prepare("SELECT * FROM entregador WHERE id_entregador = ?");
    $stmt->execute([$id_entregador]);
    $entregador = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$entregador) {
        die("Erro: Entregador com ID {$id_entregador} não encontrado no banco de dados.\n");
    }

    echo "Entregador: {$entregador['nome_completo']} (ID: {$id_entregador})\n";

    // Posição inicial (se nula, usa uma posição central de Mogi Guaçu)
    $currentLat = $entregador['latitude'] ?? -22.3650;
    $currentLng = $entregador['longitude'] ?? -46.9430;

    echo "Posição Inicial: ({$currentLat}, {$currentLng})\n\n";

    // Buscar pedidos ativos
    $pedidos = $pedidoModel->getAllByEntregador($id_entregador);

    if (empty($pedidos)) {
        echo "Aviso: NENHUM pedido ativo encontrado para este entregador.\n";
        echo "Simulando uma rota de teste padrão circular por Mogi Guaçu...\n";

        // Rota fictícia
        $destinos = [
            ['lat' => -22.35275, 'lng' => -46.94562, 'desc' => 'Ponto Fictício A'],
            ['lat' => -22.36868, 'lng' => -46.94254, 'desc' => 'Ponto Fictício B'],
            ['lat' => -22.36500, 'lng' => -46.93800, 'desc' => 'Ponto Fictício C']
        ];
    } else {
        echo "Encontrado(s) " . count($pedidos) . " pedido(s) ativo(s):\n";
        $destinos = [];
        foreach ($pedidos as $p) {
            echo " - Pedido ID {$p['id_pedido']} (Cliente: {$p['nome_cliente']}) -> Endereço: {$p['endereco']} ({$p['latitude']}, {$p['longitude']})\n";
            $destinos[] = [
                'lat' => floatval($p['latitude']),
                'lng' => floatval($p['longitude']),
                'desc' => "Pedido ID {$p['id_pedido']} ({$p['nome_cliente']})"
            ];
        }
    }

    // Função de interpolação linear
    function gerarTrecho($startLat, $startLng, $endLat, $endLng, $passos = 10)
    {
        $pontos = [];
        for ($i = 1; $i <= $passos; $i++) {
            $t = $i / $passos;
            $pontos[] = [
                'lat' => $startLat + ($endLat - $startLat) * $t,
                'lng' => $startLng + ($endLng - $startLng) * $t
            ];
        }
        return $pontos;
    }

    echo "\nIniciando simulação. Pressione Ctrl+C para encerrar.\n";
    echo "---------------------------------------------------------\n";

    while (true) {
        foreach ($destinos as $index => $destino) {
            echo "\n🏍️ Indo em direção a: {$destino['desc']} ({$destino['lat']}, {$destino['lng']})\n";

            // Gera 15 pontos intermediários para a animação ficar suave
            $rota = gerarTrecho($currentLat, $currentLng, $destino['lat'], $destino['lng'], 15);

            foreach ($rota as $passo => $ponto) {
                // Atualiza no banco
                $entregadorModel->updateLocation($id_entregador, $ponto['lat'], $ponto['lng']);

                // Printa progresso
                $percent = round((($passo + 1) / count($rota)) * 100);
                $barra = str_repeat("█", ($passo + 1)) . str_repeat("░", count($rota) - ($passo + 1));
                printf("\r[%s] %3d%% | Lat: %0.6f, Lng: %0.6f", $barra, $percent, $ponto['lat'], $ponto['lng']);

                // Guarda última posição
                $currentLat = $ponto['lat'];
                $currentLng = $ponto['lng'];

                // Aguarda 2 segundos
                sleep(2);
            }
            echo "\n📍 Chegou ao destino: {$destino['desc']}!\n";
            sleep(3); // Pausa no destino
        }

        echo "\n🔄 Rota concluída! Reiniciando a partir da posição atual para manter o loop...\n";
    }
} catch (Exception $e) {
    echo "\nErro na execução: " . $e->getMessage() . "\n";
}
