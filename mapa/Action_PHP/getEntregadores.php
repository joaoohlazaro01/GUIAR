<?php
header('Content-Type: application/json');

require '../config.php';

$sql = "
SELECT 
    e.id_entregador,
    e.nome_completo AS nome,
    e.latitude,
    e.longitude,
    p.latitude AS destino_lat,
    p.longitude AS destino_lng
FROM entregadores e
LEFT JOIN pedido p 
    ON p.id_entregador = e.id_entregador
    AND p.status = 'Enviado'
WHERE e.latitude IS NOT NULL 
AND e.longitude IS NOT NULL
";

$stmt = $conn->prepare($sql);
$stmt->execute();

$dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($dados);
