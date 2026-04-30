<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard dos Motoboys</title>
    <!-- Considerando que este arquivo está rodando a partir do routes.php, a base é /GUIAR_desfunc/ -->
    <link rel="stylesheet" href="/GUIAR_desfunc/CSSadm/entregadores.css">
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
            transition: 0.5s;
        }

.card-actions {
    margin-top: 15px;
    text-align: left;
}
        .card-actions button {
    background-color: #ff7b00;
    border: none;
    color: #fff;
    padding: 10px 15px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
    margin-left: 10px;
        }

        .card h3 {
            font-family: 'Brice-SemiBoldSemi';
        }

.card-actions button:hover {
    color: white;
      background-color: #ff7b00;
      transform: scale(1.05);
      border-bottom-right-radius: 0px;
      border-top-left-radius: 0px;
}

        button {
            font-family: 'BasisGrotesque-Regular';
            transition: 0.5s;
            background-color: #fc8835;
        }

        button:hover{
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
            transition: 0.5s;
        }

        .logout-btn:hover {
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
    <div class="container">
        <?php if (!empty($result)): ?>
            <?php foreach ($result as $row): ?>
                <div class='card'>
                    <h3><?php echo htmlspecialchars($row["nome_completo"]); ?></h3>
                    <p><strong>ID:</strong> <?php echo htmlspecialchars($row["id_entregador"]); ?></p>
                    <p><strong>CPF:</strong> <?php echo htmlspecialchars($row["CPF"]); ?></p>
                    <p><strong>Telefone:</strong> <?php echo htmlspecialchars($row["telefone"]); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($row["email"]); ?></p>
                    <div class='card-actions'>
                        <button class='btn-edit' data-id='<?php echo htmlspecialchars($row["id_entregador"]); ?>' data-nome='<?php echo htmlspecialchars($row["nome_completo"]); ?>' data-cpf='<?php echo htmlspecialchars($row["CPF"]); ?>' data-telefone='<?php echo htmlspecialchars($row["telefone"]); ?>' data-email='<?php echo htmlspecialchars($row["email"]); ?>'>Editar</button>
                        <button class='btn-delete' data-id='<?php echo htmlspecialchars($row["id_entregador"]); ?>'>Excluir</button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Nenhum motoboy encontrado...</p>
        <?php endif; ?>
    </div>

    <div class="fixed-card">
        <button id="openNewMotoboyModal">Cadastrar Motoboy</button>
    </div>

    <div id="newMotoboyModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeNewMotoboyModal">&times;</span>
            <h2>Cadastrar Motoboy</h2>
            <form id="newMotoboyForm" method="POST" action="/GUIAR_desfunc/routes.php?action=adicionarEntregador" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nome_completo">Digite o nome completo:</label>
                    <input type="text" id="nome_completo" name="nome_completo" required>
                </div>
                <div class="form-group">
                    <label for="cpf">Digite o CPF:</label>
                    <input type="text" id="CPF" name="CPF" required>
                </div>
                <div class="form-group">
                    <label for="telefone">Telefone:</label>
                    <input type="text" id="telefone" name="telefone" required>
                </div>
                <div class="form-group">
                    <label for="foto_3x4">Foto 3x4:</label>
                    <input type="file" id="foto_3x4" name="foto_3x4" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="username">Nome de usuário:</label>
                    <input type="text" id="nome_usuario" name="nome_usuario" required>
                </div>
                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" required>
                </div>
                <div class="form-group">
                    <label for="foto_cnh">Foto CNH:</label>
                    <input type="file" id="foto_CNH" name="foto_CNH" required>
                </div>
                <div class="form-group">
                    <button type="submit">Salvar</button>
                </div>
            </form>
        </div>
    </div>

</div>

<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close" id="closeEdit">&times;</span>
        <h2>Editar Motoboy</h2>
        <form id="editForm" method="POST" action="/GUIAR_desfunc/routes.php?action=editarEntregador">
            <div class="form-group">
                <label for="edit_nome_completo">Nome Completo:</label>
                <input type="text" id="edit_nome_completo" name="nome_completo" required>
            </div>
            <div class="form-group">
                <label for="edit_CPF">CPF:</label>
                <input type="text" id="edit_CPF" name="CPF" required>
            </div>
            <div class="form-group">
                <label for="edit_telefone">Telefone:</label>
                <input type="text" id="edit_telefone" name="telefone" required>
            </div>
            <div class="form-group">
                <label for="edit_email">Email:</label>
                <input type="email" id="edit_email" name="email" required>
            </div>
            <input type="hidden" id="edit_id" name="id">
            <div class="form-group">
                <button type="submit">Atualizar</button>
            </div>
        </form>
    </div>
</div>

<div id="deleteModal" class="modal">
    <div class="modal-content">
        <span class="close" id="closeDelete">&times;</span>
        <h2>Excluir Motoboy</h2>
        <p>Tem certeza de que deseja excluir este motoboy?</p>
        <form id="deleteForm" method="GET" action="/GUIAR_desfunc/routes.php">
            <input type="hidden" name="action" value="excluirEntregador">
            <input type="hidden" id="delete_id" name="id">
            <div class="form-group">
                <button type="submit" class="btn-danger">Excluir</button>
                <button type="button" id="cancelDelete">Cancelar</button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var editModal = document.getElementById('editModal');
    var deleteModal = document.getElementById('deleteModal');
    var closeEdit = document.getElementById('closeEdit');
    var closeDelete = document.getElementById('closeDelete');
    var btnEdit = document.querySelectorAll('.btn-edit');
    var btnDelete = document.querySelectorAll('.btn-delete');
    var cancelDelete = document.getElementById('cancelDelete');

    var newMotoboyModal = document.getElementById('newMotoboyModal');
    var closeNewMotoboyModal = document.getElementById('closeNewMotoboyModal');
    var openNewMotoboyModal = document.getElementById('openNewMotoboyModal');

    openNewMotoboyModal.onclick = function() {
        newMotoboyModal.style.display = 'block';
    }

    closeNewMotoboyModal.onclick = function() {
        newMotoboyModal.style.display = 'none';
    }

    btnEdit.forEach(function(button) {
        button.addEventListener('click', function() {
            var id = this.getAttribute('data-id');
            var nome = this.getAttribute('data-nome');
            var cpf = this.getAttribute('data-cpf');
            var telefone = this.getAttribute('data-telefone');
            var email = this.getAttribute('data-email');

            document.getElementById('edit_id').value = id;
            document.getElementById('edit_nome_completo').value = nome;
            document.getElementById('edit_CPF').value = cpf;
            document.getElementById('edit_telefone').value = telefone;
            document.getElementById('edit_email').value = email;

            editModal.style.display = 'block';
        });
    });

    btnDelete.forEach(function(button) {
        button.addEventListener('click', function() {
            var id = this.getAttribute('data-id');

            document.getElementById('delete_id').value = id;

            deleteModal.style.display = 'block';
        });
    });

    closeEdit.onclick = function() {
        editModal.style.display = 'none';
    }

    closeDelete.onclick = function() {
        deleteModal.style.display = 'none';
    }

    cancelDelete.onclick = function() {
        deleteModal.style.display = 'none';
    }

    window.onclick = function(event) {
        if (event.target == editModal) {
            editModal.style.display = 'none';
        }
        if (event.target == deleteModal) {
            deleteModal.style.display = 'none';
        }
        if (event.target == newMotoboyModal) {
            newMotoboyModal.style.display = 'none';
        }
    }
});
</script>

</body>
</html>
