<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos Entregues</title>
    <link
    rel="Shortcut Icon" 
    type="image/png"
    href="/GUIAR_desfunc/img/G.png">
    <style>
        @font-face {
            font-family: 'Brice-Bold';
            src: url('/GUIAR_desfunc/fonts/Brice-BoldSemiCondensed.ttf') format('truetype');
        }

        @font-face {
            font-family: 'BasisGrotesque-Regular';
            src: url('/GUIAR_desfunc/fonts/BasisGrotesqueArabicPro-Regular.ttf') format('truetype');
        }

        @font-face {
            font-family: 'Brice-SemiBoldSemi';
            src: url('/GUIAR_desfunc/fonts/Brice-SemiBoldSemiCondensed.ttf');
        }

        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body{
            background-color: #fefaf1 !important;
            font-family: 'BasisGrotesque-Regular';
        }

        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #111;
            padding-top: 20px;
            display: flex;
            flex-direction: column;
        }

        .sidebar a {
            padding: 15px 25px;
            text-decoration: none;
            font-size: 18px;
            color: white;
            display: block;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background-color: #575757;
        }

        .sidebar .spacer {
            flex:  0.9;
        }

        .main {
            margin-left: 250px;
            padding: 15px;
        }
        /* Estilo dos cards */
        .card-container {
            width: 80%;
            margin: 20px auto;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            padding: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
            border-left: 7px solid #e06c00;
            border-radius: 5px;
            margin-bottom: 15px;
            background-color: #f9f9f9;
            min-width: 35%;
        }

        .card h3 {
            margin: 0 0 10px;
            font-size: 20px;
            color: #333;
            font-family: 'Brice-SemiBoldSemi';
        }

        .card p {
            margin: 5px 0;
            color: #555;
        }

        .card p strong {
            font-weight: bold;
        }

        button {
            font-family: 'BasisGrotesque-Regular';
            transition: 0.5s;
            background-color: #fc8835;
        }

        button:hover {
            color: white;
            background-color: #ff7b00;
            transform: scale(1.05);
            border-bottom-right-radius: 0px;
            border-top-left-radius: 0px;
        }

        /* Estilo para posicionar o botão no canto superior direito */
        .logout-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            background-color: #fc8835;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .logout-btn:hover {
            color: white;
            background-color: #ff7b00;
            transform: scale(1.05);
            border-bottom-right-radius: 0px;
            border-top-left-radius: 0px;
        }


        /* finalizar turno */
        .finalizar-btn {
            position: fixed;
            bottom: 50px;
            right: 20px; /* Alterado de 'left' para 'right' */
            padding: 10px 20px;
            background-color: #fc8835;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .finalizar-btn:hover {
            color: white;
            background-color: #ff7b00;
            transform: scale(1.05);
            border-bottom-right-radius: 0px;
            border-top-left-radius: 0px;
        }

    </style>
</head>
<body>
    <div class="sidebar">
        <a href="/GUIAR_desfunc/routes.php?action=dashboardAdm">Início</a>
        <a href="/GUIAR_desfunc/routes.php?action=pedidos">Pedidos</a>
        <a href="/GUIAR_desfunc/routes.php?action=entregadores">Entregadores</a>
        <a href="/GUIAR_desfunc/routes.php?action=pedidosEntregues">Pedidos Entregues</a>
        <div class="spacer"></div>
        <a href="/GUIAR_desfunc/routes.php?action=perfilAdm">Meu perfil</a>
    </div>

    <!-- Botão de logout -->
    <a href="/GUIAR_desfunc/routes.php?action=logoutAdm" class="logout-btn">Logout</a>

    <div class="main">
        <div class="card-container">
            <?php
            // Exibição dos pedidos em forma de cards
            if (!empty($pedidos) && count($pedidos) > 0) {
                foreach ($pedidos as $pedido) {
                    echo '<div class="card">';
                    echo '<h3>Pedido #' . htmlspecialchars($pedido['id_pedido']) . '</h3>';
                    echo '<p><strong>Cliente:</strong> ' . htmlspecialchars($pedido['nome_cliente']) . '</p>';
                    echo '<p><strong>Preço:</strong> R$ ' . number_format($pedido['preco'], 2, ',', '.') . '</p>';
                    echo '<p><strong>Endereço:</strong> ' . htmlspecialchars($pedido['endereco']) . '</p>';
                    echo '<p><strong>Bairro:</strong> ' . htmlspecialchars($pedido['bairro']) . '</p>';
                    echo '<p><strong>Descrição:</strong> ' . htmlspecialchars($pedido['descricao']) . '</p>';
                    echo '<p><strong>Entregador:</strong> ' . htmlspecialchars($pedido['nome_entregador'] ?? 'Não atribuído') . '</p>';
                    echo '<p><strong>Status:</strong> ' . htmlspecialchars($pedido['status']) . '</p>';
                    echo '</div>';
                }
            } else {
                echo '<p>Nenhum pedido entregue encontrado.</p>';
            }
            ?>
        </div>
    </div>

    <!-- Botão "Finalizar Turno" -->
    <form method="POST" action="/GUIAR_desfunc/routes.php?action=finalizarTurno">
        <button type="submit" name="finalizar_turno" class="finalizar-btn" onclick="return confirm('Deseja realmente finalizar o turno e limpar a lista?');">Finalizar Turno</button>
    </form>
</body>
</html>
