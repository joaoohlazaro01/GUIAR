<?php
require '../config.php';
session_start();

// Verifica se o ID do entregador está definido na sessão
if (!isset($_SESSION['entregador_id'])) {
    die("Entregador não identificado. Faça login novamente.");
}

// Recupera o ID do entregador
$entregador_id = $_SESSION['entregador_id'];

// Consulta SQL para selecionar os pedidos atribuídos ao entregador
$sql = "SELECT pedido.id_pedido, pedido.nome_cliente, pedido.preco, pedido.endereco, pedido.bairro, pedido.descricao 
        FROM pedido 
        WHERE pedido.id_entregador = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $entregador_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos para Entregador</title>
    <link
    rel="Shortcut Icon" 
    type="image/png"
    href="../img/G.png">

      <link rel="stylesheet" href="../style/indexEntregador.css" />
  
</head>
<body>
    <div class="sidebar">
        <div class="spacer"></div>
        <a href="#">Meu Perfil</a>
        <!-- Adicione outros links de navegação conforme necessário -->
    </div>

    <div class="main">
        <h2>Pedidos Atribuídos</h2>
        <div class="container">
            <?php
            if ($result->num_rows > 0) {
                // Exibir dados de cada linha em um card
                while($row = $result->fetch_assoc()) {
                    echo "<div class='card'>";
                    echo "<h3>" . htmlspecialchars($row["nome_cliente"]) . "</h3>";
                    echo "<p><strong>Preço:</strong> R$" . htmlspecialchars($row["preco"]) . "</p>";
                    echo "<p><strong>Endereço:</strong> " . htmlspecialchars($row["endereco"]) . "</p>";
                    echo "<p><strong>Bairro:</strong> " . htmlspecialchars($row["bairro"]) . "</p>";
                    echo "<p><strong>Descrição:</strong> " . htmlspecialchars($row["descricao"]) . "</p>";
                    echo "<div class='card-actions'>";
                    echo "<button type='button' class='btn-delivered' data-id='" . $row["id_pedido"] . "'>Marcar como Entregue</button>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p>Nenhum pedido atribuído</p>";
            }
            ?>
        </div>

        <!-- Barra de ação fixa -->
        <div class="fixed-action-bar">
            <button type="button" id="refreshPage">Atualizar</button>
        </div>
    </div>

    <script>
        // Função para marcar pedido como entregue
        document.querySelectorAll('.btn-delivered').forEach(button => {
            button.addEventListener('click', function() {
                const pedidoId = this.getAttribute('data-id');
                fetch('marcarComoEntregue.php?id_pedido=' + pedidoId)
                    .then(response => response.text())
                    .then(result => {
                        alert(result);
                        location.reload(); // Atualiza a página para refletir as mudanças
                    });
            });
        });

        // Função para atualizar a página
        document.getElementById('refreshPage').addEventListener('click', function() {
            location.reload();
        });
    </script>
</body>
</html>

<?php
// Fechar a conexão
$conn->close();
?>