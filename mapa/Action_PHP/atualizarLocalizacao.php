<?php
session_start();
include '../../config.php';

$id = $_SESSION['entregadorID'];

$data = json_decode(file_get_contents("php://input"), true);

$lat = $data['latitude'];
$lng = $data['longitude'];

$sql = "UPDATE entregador 
        SET latitude = :lat, longitude = :lng 
        WHERE id_entregador = :id";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    'lat' => $lat,
    'lng' => $lng,
    'id' => $id
]);

echo json_encode(["success" => true]);
