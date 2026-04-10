<?php
// Inicia a sessão
session_start();
require '../config.php';

// Verificar se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_pedido = $_POST["id_pedido"];

    // Excluir o pedido da tabela 'pedido'
    $sql = "DELETE FROM pedido WHERE id_pedido = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_pedido);

    if ($stmt->execute()) {
        echo "Pedido excluído com sucesso";
        header("Location: pedidos.php"); // Redireciona para a página principal
        exit();
    } else {
        echo "Erro ao excluir pedido: " . $stmt->error;
    }

    // Fechar o statement
    $stmt->close();
}

// Fechar a conexão
$conn->close();
?>