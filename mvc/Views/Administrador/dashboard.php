<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Index | Administrador</title>
    <link rel="Shortcut Icon" type="image/png" href="/GUIAR_desfunc/img/G.png">
    <link href="/GUIAR_desfunc/style/indexAdm.css" rel="stylesheet">
</head>
<body>
    <div class="sidebar">
        <!-- Manteremos as rotas antigas até elas serem refatoradas, mas o início já usa o MVC -->
        <a href="/GUIAR_desfunc/routes.php?action=dashboardAdm">Início</a>
        <a href="/GUIAR_desfunc/routes.php?action=pedidos">Pedidos</a>
        <a href="/GUIAR_desfunc/routes.php?action=entregadores">Entregadores</a>
        <a href="/GUIAR_desfunc/routes.php?action=pedidosEntregues">Pedidos Entregues</a>
        <div class="spacer"></div>
        <a href="/GUIAR_desfunc/routes.php?action=perfilAdm">Meu perfil</a>
    </div>

    <!-- Botão de logout (do Administrador) -->
    <a href="/GUIAR_desfunc/routes.php?action=sair" class="logout-btn">Logout</a>

    <div class="main">
        <h1>Olá, <spam><?php echo htmlspecialchars($nomeAdmin) . "!"; ?></spam></h1>
        <hr color="black" size="2px">
        <section class="dicas">
            <center><h2>Dicas e Melhores Práticas</h2></center>
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="card-container">
                        <div class="col-md-3">
                            <div class="card">
                                <img src="/GUIAR_desfunc/img/icon1.png" alt="Organize seus pedidos" class="card-icon">
                                <h3>Organize seus pedidos</h3>
                                <p>Utilize filtros para visualizar pedidos específicos.</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <img src="/GUIAR_desfunc/img/icon2.png" alt="Comunique-se com os entregadores" class="card-icon">
                                <h3>Comunique-se com os entregadores</h3>
                                <p>Mantenha contato direto para evitar atrasos.</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <img src="/GUIAR_desfunc/img/icon3.png" alt="Revise feedbacks" class="card-icon">
                                <h3>Revise feedbacks</h3>
                                <p>Analise as avaliações dos clientes para melhorar o serviço.</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <img src="/GUIAR_desfunc/img/icon4.png" alt="Mantenha registros atualizados" class="card-icon">
                                <h3>Mantenha registros atualizados</h3>
                                <p>Certeza de que todos os dados dos motoboys estejam corretos.</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <img src="/GUIAR_desfunc/img/icon5.png" alt="Use relatórios" class="card-icon">
                                <h3>Use relatórios</h3>
                                <p>Gere relatórios periódicos para acompanhar o desempenho das entregas.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
</html>
