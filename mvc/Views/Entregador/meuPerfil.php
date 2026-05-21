<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Perfil | Entregador</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/style/meuPerfil.css">
    <link rel="shortcut icon" type="image/png" href="<?= BASE_URL ?>/img/G.png">
    <style>
        /* Custom sidebar spacing to match meusPedidos sidebar layout */
        body {
            display: block;
            min-height: 100vh;
            margin: 0;
            background-color: #fefaf1 !important;
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
        .sidebar .spacer {
            flex: 0.9;
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
        .main {
            margin-left: 250px;
            padding: 40px 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .card {
            max-width: 600px;
            width: 100%;
            margin: 20px auto;
        }
        .card img.profile-pic {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin-bottom: 20px;
            object-fit: cover;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .cnh-container {
            margin: 20px 0;
            text-align: center;
        }
        .cnh-pic {
            width: 100%;
            max-width: 300px;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            object-fit: contain;
            margin-top: 10px;
        }
        .profile-details {
            text-align: left;
            margin: 20px 0;
            padding: 15px;
            background: #fafafa;
            border-radius: 8px;
            border-left: 5px solid #fc8835;
        }
        .profile-details p {
            font-size: 16px !important;
            margin: 10px 0 !important;
            color: #333 !important;
        }
        .alert {
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 6px;
            font-weight: bold;
            max-width: 600px;
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
        <a href="<?= BASE_URL ?>/routes.php?action=meusPedidosEntregador">Meus Pedidos</a>
        <a href="<?= BASE_URL ?>/routes.php?action=mapaEntregador">Abrir Mapa</a>
        <div class="spacer"></div>
        <a href="<?= BASE_URL ?>/routes.php?action=perfilEntregador" style="background-color: #575757;">Meu Perfil</a>
        <a href="<?= BASE_URL ?>/routes.php?action=logoutEntregador">Sair</a>
    </div>

    <div class="main">
        <div style="width: 100%; max-width: 600px;">
            <?php if ($sucesso): ?>
                <div class="alert alert-success"><?= htmlspecialchars($sucesso) ?></div>
            <?php endif; ?>
            <?php if ($erro): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
            <?php endif; ?>

            <div class="card">
                <?php 
                    $foto_path = !empty($entregador["foto_3x4"]) 
                        ? BASE_URL . "/public/uploads/entregadores/fotos/" . htmlspecialchars($entregador["foto_3x4"])
                        : BASE_URL . "/img/G.png"; // fallback photo
                ?>
                <img src="<?= $foto_path ?>" class="profile-pic" alt="Foto de <?= htmlspecialchars($entregador["nome_completo"]) ?>">
                <h1><?= htmlspecialchars($entregador["nome_completo"]) ?></h1>
                
                <div class="profile-details">
                    <p><strong>Usuário:</strong> <?= htmlspecialchars($entregador["nome_usuario"]) ?></p>
                    <p><strong>E-mail:</strong> <?= htmlspecialchars($entregador["email"]) ?></p>
                    <p><strong>CPF:</strong> <?= htmlspecialchars($entregador["CPF"]) ?></p>
                    <p><strong>Telefone:</strong> <?= htmlspecialchars($entregador["telefone"]) ?></p>
                </div>

                <div class="cnh-container">
                    <p><strong>Foto da CNH:</strong></p>
                    <?php if (!empty($entregador["foto_CNH"])): ?>
                        <img src="<?= BASE_URL . "/public/uploads/entregadores/CNH/" . htmlspecialchars($entregador["foto_CNH"]) ?>" class="cnh-pic" alt="Foto da CNH">
                    <?php else: ?>
                        <p style="color: #999; font-style: italic;">Nenhuma foto da CNH cadastrada.</p>
                    <?php endif; ?>
                </div>

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
            <form action="<?= BASE_URL ?>/routes.php?action=editarPerfilEntregador" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nome_completo">Nome Completo</label>
                    <input type="text" id="nome_completo" name="nome_completo" class="modal-input" value="<?= htmlspecialchars($entregador["nome_completo"]) ?>" required>
                </div>
                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <input type="text" id="cpf" name="cpf" class="modal-input" value="<?= htmlspecialchars($entregador["CPF"]) ?>" required>
                </div>
                <div class="form-group">
                    <label for="telefone">Telefone</label>
                    <input type="text" id="telefone" name="telefone" class="modal-input" value="<?= htmlspecialchars($entregador["telefone"]) ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" class="modal-input" value="<?= htmlspecialchars($entregador["email"]) ?>" required>
                </div>
                <div class="form-group">
                    <label for="nome_usuario">Nome de Usuário</label>
                    <input type="text" id="nome_usuario" name="nome_usuario" class="modal-input" value="<?= htmlspecialchars($entregador["nome_usuario"]) ?>" required>
                </div>
                <div class="form-group">
                    <label for="senha">Nova Senha</label>
                    <input type="password" id="senha" name="senha" class="modal-input" placeholder="Nova senha">
                    <span class="helper-text">Deixe em branco para manter a senha atual.</span>
                </div>
                <div class="form-group">
                    <label for="foto_3x4">Foto 3x4</label>
                    <input type="file" id="foto_3x4" name="foto_3x4" class="modal-input" accept="image/*">
                </div>
                <div class="form-group">
                    <label for="foto_CNH">Foto da CNH</label>
                    <input type="file" id="foto_CNH" name="foto_CNH" class="modal-input" accept="image/*">
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
