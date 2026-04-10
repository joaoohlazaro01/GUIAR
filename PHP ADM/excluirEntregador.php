<?php
// Inicia a sessão
session_start();
require '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET["id"];

    $sql = "DELETE FROM entregador WHERE id_entregador=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Registro excluído com sucesso";
    } else {
        echo "Erro ao excluir registro: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
header("Location: entregadores.php");
exit();
?>