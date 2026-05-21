<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Perfil | Administrador</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/style/meuPerfil.css">
    <link rel="shortcut icon" type="image/png" href="<?= BASE_URL ?>/img/G.png">
    <style>
        /* Custom spacing to accommodate sidebar layout properly */
        body {
            display: block;
            min-height: 100vh;
            margin: 0;
            background-color: #fefaf1 !important;
        }
        .main {
            margin-left: 250px;
            padding: 40px 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .alert {
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 6px;
            font-weight: bold;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
            text-align: center;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }
        .helper-text {
            font-size: 12px;
            color: #666;
            margin-top: 4px;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <a href="<?= BASE_URL ?>/routes.php?action=dashboardAdm">Início</a>
        <a href="<?= BASE_URL ?>/routes.php?action=pedidos">Pedidos</a>
        <a href="<?= BASE_URL ?>/routes.php?action=entregadores">Entregadores</a>
        <a href="<?= BASE_URL ?>/routes.php?action=pedidosEntregues">Pedidos Entregues</a>
        <a href="<?= BASE_URL ?>/routes.php?action=mapaAdm">Acompanhar Rotas</a>
        <div class="spacer"></div>
        <a href="<?= BASE_URL ?>/routes.php?action=perfilAdm" style="background-color: #575757;">Meu perfil</a>
    </div>

    <!-- Botão de logout -->
    <a href="<?= BASE_URL ?>/routes.php?action=logoutAdm" class="logout-btn">Logout</a>

    <div class="main">
        <div>
            <?php if ($sucesso): ?>
                <div class="alert alert-success"><?= htmlspecialchars($sucesso) ?></div>
            <?php endif; ?>
            <?php if ($erro): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
            <?php endif; ?>

            <div class="card">
                <?php 
                    $imagem_path = BASE_URL . "/public/uploads/empresas/" . htmlspecialchars($nome_empresa) . "/" . htmlspecialchars($admin["nome_foto"]);
                ?>
                <img src="<?= $imagem_path ?>" alt="Foto de <?= htmlspecialchars($admin["nome_adm"]) ?>">
                <h1><?= htmlspecialchars($admin["nome_adm"]) ?></h1>
                <p><strong>Usuário:</strong> <?= htmlspecialchars($admin["nome_usuario"]) ?></p>
                <p><strong>Empresa:</strong> <?= htmlspecialchars($nome_empresa) ?></p>
                <br>
                <button id="openEditModalBtn">Editar Perfil</button>
            </div>
        </div>
    </div>

    <!-- Modal de Edição -->
    <div id="editProfileModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeEditModalBtn">&times;</span>
            <h2>Editar Meu Perfil</h2>
            <br>
            <form action="<?= BASE_URL ?>/routes.php?action=editarPerfilAdm" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nome_adm">Nome Completo</label>
                    <input type="text" id="nome_adm" name="nome_adm" class="modal-input" value="<?= htmlspecialchars($admin["nome_adm"]) ?>" required>
                </div>
                <div class="form-group">
                    <label for="nome_usuario">Nome de Usuário</label>
                    <input type="text" id="nome_usuario" name="nome_usuario" class="modal-input" value="<?= htmlspecialchars($admin["nome_usuario"]) ?>" required>
                </div>
                <div class="form-group">
                    <label for="senha">Nova Senha</label>
                    <input type="password" id="senha" name="senha" class="modal-input" placeholder="Nova senha">
                    <span class="helper-text">Deixe em branco para manter a senha atual.</span>
                </div>
                <div class="form-group">
                    <label for="adminFoto">Alterar Foto de Perfil</label>
                    <input type="file" id="adminFoto" name="adminFoto" class="modal-input" accept="image/*">
                </div>
                <button type="submit" class="modal-button">Salvar Alterações</button>
            </form>
        </div>
    </div>

    <script>
        const modal = document.getElementById("editProfileModal");
        const openBtn = document.getElementById("openEditModalBtn");
        const closeBtn = document.getElementById("closeEditModalBtn");

        openBtn.addEventListener("click", () => {
            modal.style.display = "block";
        });

        closeBtn.addEventListener("click", () => {
            modal.style.display = "none";
        });

        window.addEventListener("click", (event) => {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        });
    </script>
</body>

</html>
