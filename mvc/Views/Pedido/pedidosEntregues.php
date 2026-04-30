<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos Entregues - GUIAR</title>
    <link rel="Shortcut Icon" type="image/png" href="/GUIAR_desfunc/img/G.png">
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
            flex: 1;
        }

        .main {
            margin-left: 250px;
            padding: 15px;
        }

        .card-container {
            width: 90%;
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
            min-width: 300px;
            flex: 1;
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
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #ff7b00;
            transform: scale(1.05);
            border-bottom-right-radius: 0px;
            border-top-left-radius: 0px;
        }

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
            text-decoration: none;
        }

        .logout-btn:hover {
            background-color: #ff7b00;
            transform: scale(1.05);
            border-bottom-right-radius: 0px;
            border-top-left-radius: 0px;
        }

        .finalizar-btn {
            position: fixed;
            bottom: 50px;
            right: 20px;
            padding: 15px 30px;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <a href="/GUIAR_desfunc/routes.php?action=dashboardAdm">Início</a>
        <a href="/GUIAR_desfunc/routes.php?action=pedidos">Pedidos</a>
        <a href="/GUIAR_desfunc/PHP ADM/entregadores.php">Entregadores</a>
        <a href="/GUIAR_desfunc/routes.php?action=pedidosEntregues">Pedidos Entregues</a>
        <div class="spacer"></div>
        <a href="/GUIAR_desfunc/PHP ADM/meuPerfil.php">Meu perfil</a>
    </div>

    <a href="/GUIAR_desfunc/routes.php?action=logoutAdm" class="logout-btn">Logout</a>

    <div class="main">
        <div class="card-container">
            <?php if (!empty($pedidos)): ?>
                <?php foreach ($pedidos as $pedido): ?>
                    <div class="card">
                        <h3>Pedido #<?= $pedido['id_pedido'] ?></h3>
                        <p><strong>Cliente:</strong> <?= htmlspecialchars($pedido['nome_cliente']) ?></p>
                        <p><strong>Preço:</strong> R$ <?= number_format($pedido['preco'], 2, ',', '.') ?></p>
                        <p><strong>Endereço:</strong> <?= htmlspecialchars($pedido['endereco']) ?></p>
                        <p><strong>Bairro:</strong> <?= htmlspecialchars($pedido['bairro']) ?></p>
                        <p><strong>Descrição:</strong> <?= htmlspecialchars($pedido['descricao']) ?></p>
                        <p><strong>Entregador:</strong> <?= htmlspecialchars($pedido['nome_entregador'] ?? 'Não identificado') ?></p>
                        <p><strong>Status:</strong> <?= htmlspecialchars($pedido['status']) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Nenhum pedido entregue encontrado.</p>
            <?php endif; ?>
        </div>
    </div>

    <form method="POST" action="/GUIAR_desfunc/routes.php?action=finalizarTurno">
        <button type="submit" class="finalizar-btn">Finalizar Turno</button>
    </form>
</body>
</html>
