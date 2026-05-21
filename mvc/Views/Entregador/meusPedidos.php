<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos para Entregador</title>
    <link rel="Shortcut Icon" type="image/png" href="<?= BASE_URL ?>/img/G.png">
    <link rel="stylesheet" href="<?= BASE_URL ?>/style/indexEntregador.css" />
</head>

<body>
    <div class="sidebar">
        <div class="spacer"></div>
        <a href="<?= BASE_URL ?>/routes.php?action=mapaEntregador">Abrir Mapa</a>
        <a href="#">Meu Perfil</a>
        <a href="<?= BASE_URL ?>/routes.php?action=logoutEntregador">Sair</a>
    </div>

    <div class="main">
        <h2>Pedidos Atribuídos</h2>
        <div class="container">
            <?php
            if (!empty($result) && count($result) > 0) {
                // Exibir dados de cada linha em um card
                foreach ($result as $row) {
                    echo "<div class='card'>";
                    echo "<h3>" . htmlspecialchars($row["nome_cliente"]) . "</h3>";
                    echo "<p><strong>Preço:</strong> R$" . htmlspecialchars($row["preco"]) . "</p>";
                    echo "<p><strong>Endereço:</strong> " . htmlspecialchars($row["endereco"]) . "</p>";
                    echo "<p><strong>Bairro:</strong> " . htmlspecialchars($row["bairro"]) . "</p>";
                    echo "<p><strong>Descrição:</strong> " . htmlspecialchars($row["descricao"]) . "</p>";
                    echo "<div class='card-actions'>";
                    echo "<button type='button' class='btn-delivered' data-id='" . htmlspecialchars($row["id_pedido"]) . "'>Marcar como Entregue</button>";
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

                fetch('<?= BASE_URL ?>/routes.php?action=concluirEntrega', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: 'id_pedido=' + encodeURIComponent(pedidoId)
                    })
                    .then(response => response.text())
                    .then(result => {
                        if (result.trim() === 'success') {
                            alert('Pedido marcado como entregue!');
                            location.reload(); // Atualiza a página para refletir as mudanças
                        } else {
                            alert('Erro ao marcar pedido como entregue.');
                        }
                    })
                    .catch(error => {
                        console.error('Erro:', error);
                        alert('Erro na requisição.');
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