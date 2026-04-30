<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Pedidos - GUIAR</title>
    <link rel="stylesheet" href="/GUIAR_desfunc/CSSadm/pedidos.css"> 
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
        /* cards */
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
            font-family: 'Brice-SemiBoldSemi';
        }

        .card-actions {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        .card input[type="checkbox"] {
            position: absolute;
            top: 10px;
            right: 10px;
            border-radius: 5px;
        }

        .status {
            font-weight: bold;
            color: #ff7b00;
        }

        .fixed-buttons {
            font-family: 'BasisGrotesque-Regular';
            position: fixed;
            bottom: 20px;
            right: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            transition: 0.5s;
        }

        .fixed-buttons button {
            font-family: 'BasisGrotesque-Regular';
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            background-color: #fc8835;
            color: white;
            border: none;
            border-radius: 5px;
            transition: 0.5s;
        }

        .fixed-buttons button:hover {
            background-color: #ff7b00;
            transform: scale(1.05);
            border-bottom-right-radius: 0px;
            border-top-left-radius: 0px;
        }

        /* Estilo para o formulário dentro do modal */
        #sendOrdersToDeliveryForm {
            font-family: 'BasisGrotesque-Regular';
            display: flex;
            flex-direction: column;
        }

        #entregadoresContainer {
            font-family: 'BasisGrotesque-Regular';
            margin-bottom: 15px;
        }

        select {
            font-family: 'BasisGrotesque-Regular';
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
        }

        button {
            font-family: 'BasisGrotesque-Regular';
            background-color: #fc8835;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #ff7b00;
            transform: scale(1.05);
            border-bottom-right-radius: 0px;
            border-top-left-radius: 0px;
        }

        /* Estilo para campos ocultos */
        input[type="hidden"] {
            display: none;
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
            text-decoration: none;
            display: inline-block;
        }

        .logout-btn:hover {
            background-color: #ff7b00;
            transform: scale(1.05);
            border-bottom-right-radius: 0px;
            border-top-left-radius: 0px;
        }

        .main {
            margin-left: 260px;
            padding: 20px;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
            border-radius: 10px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input, .form-group textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <a href="/GUIAR_desfunc/routes.php?action=dashboardAdm">Início</a>
        <a href="/GUIAR_desfunc/routes.php?action=pedidos">Pedidos</a>
        <a href="/GUIAR_desfunc/PHP ADM/entregadores.php">Entregadores</a>
        <a href="/GUIAR_desfunc/routes.php?action=pedidosEntregues">Pedidos Entregues</a>
        <a href="/GUIAR_desfunc/mapa/mapaAdm.php">Mapa das Rotas</a>
        <div class="spacer"></div>
        <a href="/GUIAR_desfunc/PHP ADM/meuPerfil.php">Meu perfil</a>
    </div>

    <a href="/GUIAR_desfunc/routes.php?action=logoutAdm" class="logout-btn">Logout</a>

    <div class="main">
        <div class="container">
            <?php if (!empty($result)): ?>
                <?php foreach ($result as $row): ?>
                    <div class='card'>
                        <input type='checkbox' name='pedido_ids[]' value='<?= htmlspecialchars($row["id_pedido"]) ?>'>
                        <h3><?= htmlspecialchars($row["nome_cliente"]) ?></h3>
                        <p><strong>Preço:</strong> R$<?= number_format($row["preco"], 2, ',', '.') ?></p>
                        <p><strong>Endereço:</strong> <span class="card-address"><?= htmlspecialchars($row["endereco"]) ?></span></p>
                        <p><strong>Bairro:</strong> <span class="card-bairro"><?= htmlspecialchars($row["bairro"]) ?></span></p>
                        <p><strong>Descrição:</strong> <span class="card-desc"><?= htmlspecialchars($row["descricao"]) ?></span></p>
                        <p class='status'><strong>Status:</strong> <?= htmlspecialchars($row["status"]) ?></p>
                        <?php if (!empty($row["nome_entregador"])): ?>
                            <p><strong>Entregador:</strong> <?= htmlspecialchars($row["nome_entregador"]) ?></p>
                        <?php else: ?>
                            <p><strong>Entregador:</strong> Não atribuído</p>
                        <?php endif; ?>
                        <div class='card-actions'>
                            <button type='button' class='btn-edit' data-id='<?= htmlspecialchars($row["id_pedido"]) ?>'>Editar</button>
                            <button type='button' class='btn-delete' data-id='<?= htmlspecialchars($row["id_pedido"]) ?>'>Excluir</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Nenhum pedido encontrado</p>
            <?php endif; ?>
        </div>

        <!-- Botões fixos no canto inferior direito -->
        <div class="fixed-buttons">
            <button type="button" id="openNewOrderModal">Adicionar Novo Pedido</button>
            <button type="button" id="openSendOrdersModal">Enviar Pedidos Selecionados</button>
        </div>
    </div>

    <!-- Modal de Novo Pedido -->
    <div id="newOrderModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeNewOrderModal">&times;</span>
            <h2>Adicionar Novo Pedido</h2>
            <form id="newOrderForm" method="POST" action="/GUIAR_desfunc/routes.php?action=adicionarPedido">
                <div class="form-group">
                    <label for="nome_cliente">Nome do Cliente:</label>
                    <input type="text" id="nome_cliente" name="nome_cliente" required>
                </div>
                <div class="form-group">
                    <label for="preco">Preço:</label>
                    <input type="number" id="preco" name="preco" step="0.01" required>
                </div>
                <div class="form-group">
                    <label for="cep">CEP:</label>
                    <input type="text" id="cep" name="cep" maxlength="9" placeholder="00000-000" required>
                </div>
                <div class="form-group">
                    <label for="endereco">Endereço:</label>
                    <input type="text" id="endereco" name="endereco" required>
                </div>
                <div class="form-group">
                    <label for="bairro">Bairro:</label>
                    <input type="text" id="bairro" name="bairro" required>
                </div>
                <input type="hidden" id="cidade" name="cidade">
                <input type="hidden" id="estado" name="estado">

                <div class="form-group">
                    <label for="descricao">Descrição:</label>
                    <textarea id="descricao" name="descricao" required></textarea>
                </div>
                <input type="hidden" id="latitude" name="latitude">
                <input type="hidden" id="longitude" name="longitude">

                <div class="form-group">
                    <button type="button" onclick="geocodeAddress()">Salvar Pedido</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal de Enviar Pedidos -->
    <div id="sendOrdersModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeSendOrdersModal">&times;</span>
            <h2>Enviar Pedidos Selecionados</h2>
            <form id="sendOrdersToDeliveryForm" method="POST" action="/GUIAR_desfunc/routes.php?action=enviarPedidos">
                <div id="entregadoresContainer">
                    <?php if (!empty($resultEntregadores)): ?>
                        <select id='entregadorSelect' name='entregador_id' required>
                            <option value=''>Selecione um Entregador</option>
                            <?php foreach ($resultEntregadores as $entregador): ?>
                                <option value='<?= htmlspecialchars($entregador["id_entregador"]) ?>'><?= htmlspecialchars($entregador["nome_completo"]) ?></option>
                            <?php endforeach; ?>
                        </select>
                    <?php else: ?>
                        <p>Nenhum entregador encontrado</p>
                    <?php endif; ?>
                </div>

                <input type="hidden" id="selected_pedido_ids" name="pedido_ids">
                <button type="submit">Enviar Pedidos</button>
            </form>
        </div>
    </div>

    <!-- Modal de Edição de Pedido -->
    <div id="editOrderModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeEditOrderModal">&times;</span>
            <h2>Editar Pedido</h2>
            <form id="editOrderForm" method="POST" action="/GUIAR_desfunc/routes.php?action=editarPedido">
                <input type="hidden" id="edit_id_pedido" name="id_pedido">
                <div class="form-group">
                    <label for="edit_nome_cliente">Nome do Cliente:</label>
                    <input type="text" id="edit_nome_cliente" name="nome_cliente" required>
                </div>
                <div class="form-group">
                    <label for="edit_preco">Preço:</label>
                    <input type="number" id="edit_preco" name="preco" step="0.01" required>
                </div>
                <div class="form-group">
                    <label for="edit_cep">CEP:</label>
                    <input type="text" id="edit_cep" name="cep" maxlength="9" placeholder="00000-000">
                </div>
                <div class="form-group">
                    <label for="edit_endereco">Endereço:</label>
                    <input type="text" id="edit_endereco" name="endereco" required>
                </div>
                <div class="form-group">
                    <label for="edit_bairro">Bairro:</label>
                    <input type="text" id="edit_bairro" name="bairro" required>
                </div>
                <input type="hidden" id="edit_cidade" name="cidade">
                <input type="hidden" id="edit_estado" name="estado">

                <div class="form-group">
                    <label for="edit_descricao">Descrição:</label>
                    <textarea id="edit_descricao" name="descricao" required></textarea>
                </div>
                <input type="hidden" id="edit_latitude" name="latitude">
                <input type="hidden" id="edit_longitude" name="longitude">

                <div class="form-group">
                    <button type="button" onclick="geocodeAddressEdit()">Salvar Alterações</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal de Exclusão -->
    <div id="deleteOrderModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeDeleteOrderModal">&times;</span>
            <h2>Excluir Pedido</h2>
            <p>Tem certeza de que deseja cancelar este pedido?</p>
            <form id="deleteOrderForm" method="POST" action="/GUIAR_desfunc/routes.php?action=excluirPedido">
                <input type="hidden" id="delete_id_pedido" name="id_pedido">
                <div class="form-group">
                    <button type="submit">Sim, cancelar</button>
                    <button type="button" id="cancelDelete">Não</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script src="/GUIAR_desfunc/public/js/map_utils.js"></script>
    <script>
        // Modal Handlers
        function openModal(id) { document.getElementById(id).style.display = 'block'; }
        function closeModal(id) { document.getElementById(id).style.display = 'none'; }

        document.getElementById('openNewOrderModal').onclick = () => openModal('newOrderModal');
        document.getElementById('closeNewOrderModal').onclick = () => closeModal('newOrderModal');

        document.getElementById('openSendOrdersModal').onclick = function() {
            const selected = Array.from(document.querySelectorAll('input[name="pedido_ids[]"]:checked')).map(cb => cb.value);
            if (selected.length === 0) return alert('Selecione pelo menos um pedido.');
            document.getElementById('selected_pedido_ids').value = selected.join(',');
            openModal('sendOrdersModal');
        };
        document.getElementById('closeSendOrdersModal').onclick = () => closeModal('sendOrdersModal');

        document.querySelectorAll('.btn-edit').forEach(btn => {
            btn.onclick = function() {
                const id = this.dataset.id;
                const card = this.closest('.card');
                document.getElementById('edit_id_pedido').value = id;
                document.getElementById('edit_nome_cliente').value = card.querySelector('h3').innerText;
                document.getElementById('edit_preco').value = card.querySelector('p:nth-of-type(1)').innerText.replace('Preço: R$', '').replace('.', '').replace(',', '.').trim();
                document.getElementById('edit_endereco').value = card.querySelector('.card-address').innerText;
                document.getElementById('edit_bairro').value = card.querySelector('.card-bairro').innerText;
                document.getElementById('edit_descricao').value = card.querySelector('.card-desc').innerText;
                openModal('editOrderModal');
            };
        });
        document.getElementById('closeEditOrderModal').onclick = () => closeModal('editOrderModal');

        document.querySelectorAll('.btn-delete').forEach(btn => {
            btn.onclick = function() {
                document.getElementById('delete_id_pedido').value = this.dataset.id;
                openModal('deleteOrderModal');
            };
        });
        document.getElementById('closeDeleteOrderModal').onclick = () => closeModal('deleteOrderModal');
        document.getElementById('cancelDelete').onclick = () => closeModal('deleteOrderModal');

        window.onclick = function(event) {
            if (event.target.className === 'modal') {
                event.target.style.display = 'none';
            }
        };

        // Initialize CEP lookup
        buscarCEP("cep", "endereco", "bairro", "cidade", "estado");
        buscarCEP("edit_cep", "edit_endereco", "edit_bairro", "edit_cidade", "edit_estado");
    </script>
</body>
</html>
