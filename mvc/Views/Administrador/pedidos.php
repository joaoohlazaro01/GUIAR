<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Pedidos</title>
    <!-- Considerando que este arquivo está rodando a partir do routes.php, a base é /GUIAR_desfunc/ -->
    <link rel="stylesheet" href="/GUIAR_desfunc/CSSadm/pedidos.css"> 
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
        }

        .logout-btn:hover {
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
        <a href="/GUIAR_desfunc/mapa/mapaAdm.php">Mapa das Rotas</a>
        <div class="spacer"></div>
        <a href="/GUIAR_desfunc/routes.php?action=perfilAdm">Meu perfil</a>
    </div>

      <!-- Botão de logout -->
      <a href="/GUIAR_desfunc/routes.php?action=logoutAdm" class="logout-btn">Logout</a>

    <div class="main">
        <form id="sendOrdersForm" method="POST" action="/GUIAR_desfunc/routes.php?action=enviarPedidos">
            <div class="container">
                <?php
                if (!empty($result) && count($result) > 0) {
                    // Exibir dados de cada linha em um card
                    foreach ($result as $row) {
                        echo "<div class='card'>";
                        echo "<input type='checkbox' name='pedido_ids[]' value='" . htmlspecialchars($row["id_pedido"]) . "'>";
                        echo "<h3>" . htmlspecialchars($row["nome_cliente"]) . "</h3>";
                        echo "<p><strong>Preço:</strong> R$" . htmlspecialchars($row["preco"]) . "</p>";
                        echo "<p><strong>Endereço:</strong> " . htmlspecialchars($row["endereco"]) . "</p>";
                        echo "<p><strong>Bairro:</strong> " . htmlspecialchars($row["bairro"]) . "</p>";
                        echo "<p><strong>Descrição:</strong> " . htmlspecialchars($row["descricao"]) . "</p>";
                        echo "<p class='status'><strong>Status:</strong> " . htmlspecialchars($row["status"]) . "</p>";
                        // Exibir o nome do entregador, se houver
                        if (!empty($row["nome_entregador"])) {
                            echo "<p><strong>Entregador:</strong> " . htmlspecialchars($row["nome_entregador"]) . "</p>";
                        } else {
                            echo "<p><strong>Entregador:</strong> Não atribuído</p>";
                        }
                        echo "<div class='card-actions'>";
                        echo "<button type='button' class='btn-edit' data-id='" . htmlspecialchars($row["id_pedido"]) . "'>Editar</button>";
                        echo "<button type='button' class='btn-delete' data-id='" . htmlspecialchars($row["id_pedido"]) . "'>Excluir</button>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>Nenhum pedido encontrado</p>";
                }
                ?>
            </div>


            <!-- Botões fixos no canto inferior direito -->
            <div class="fixed-buttons">
                <button type="button" id="openNewOrderModal">Adicionar Novo Pedido</button>
                <button type="button" id="openSendOrdersModal">Enviar Pedidos Selecionados</button>
            </div>
        </form>
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
                    <?php
                    if (!empty($resultEntregadores) && count($resultEntregadores) > 0) {
                        echo "<select id='entregadorSelect' name='entregador_id' required>";
                        echo "<option value=''>Selecione um Entregador</option>";
                        foreach ($resultEntregadores as $entregador) {
                            echo "<option value='" . htmlspecialchars($entregador["id_entregador"]) . "'>" . htmlspecialchars($entregador["nome_completo"]) . "</option>";
                        }
                        echo "</select>";
                    } else {
                        echo "<p>Nenhum entregador encontrado</p>";
                    }
                    ?>
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
                    <button type="button" id="cancelDelete">não</button>
                </div>
            </form>
        </div>
    </div>
</div>  

    

<script>
// Função para abrir o modal de novo pedido
document.getElementById('openNewOrderModal').addEventListener('click', function() {
    document.getElementById('newOrderModal').style.display = 'block';
});

// Função para fechar o modal de novo pedido
document.getElementById('closeNewOrderModal').addEventListener('click', function() {
    document.getElementById('newOrderModal').style.display = 'none';
});

// Função para abrir o modal de envio de pedidos
document.getElementById('openSendOrdersModal').addEventListener('click', function() {
            var selectedOrders = document.querySelectorAll('input[name="pedido_ids[]"]:checked');
            if (selectedOrders.length === 0) {
                alert('Selecione pelo menos um pedido.');
                return;
            }
            // Coleta os IDs dos pedidos selecionados
            var selectedPedidoIds = Array.from(selectedOrders).map(order => order.value).join(',');

            // Define os IDs dos pedidos selecionados no campo oculto
            document.getElementById('selected_pedido_ids').value = selectedPedidoIds;

            // Exibe o modal
            document.getElementById('sendOrdersModal').style.display = 'block';
        });
// Função para fechar o modal de envio de pedidos
document.getElementById('closeSendOrdersModal').addEventListener('click', function() {
    document.getElementById('sendOrdersModal').style.display = 'none';
});

// Função para abrir o modal de edição e preencher os campos com os dados atuais
document.querySelectorAll('.btn-edit').forEach(button => {
    button.addEventListener('click', function() {
        const pedidoId = this.getAttribute('data-id');
        const card = this.closest('.card');

        const nomeCliente = card.querySelector('h3').innerText;
        const preco = card.querySelector('p:nth-of-type(1)').innerText.replace('Preço: R$', '').trim();
        const endereco = card.querySelector('p:nth-of-type(2)').innerText.replace('Endereço:', '').trim();
        const bairro = card.querySelector('p:nth-of-type(3)').innerText.replace('Bairro:', '').trim();
        const descricao = card.querySelector('p:nth-of-type(4)').innerText.replace('Descrição:', '').trim();

        document.getElementById('edit_id_pedido').value = pedidoId;
        document.getElementById('edit_nome_cliente').value = nomeCliente;
        document.getElementById('edit_preco').value = preco;
        document.getElementById('edit_endereco').value = endereco;
        document.getElementById('edit_bairro').value = bairro;
        document.getElementById('edit_descricao').value = descricao;

        document.getElementById('editOrderModal').style.display = 'block';
    });
});


// Função para fechar o modal de edição
document.getElementById('closeEditOrderModal').addEventListener('click', function() {
    document.getElementById('editOrderModal').style.display = 'none';
});

// Função para abrir o modal de exclusão
document.querySelectorAll('.btn-delete').forEach(button => {
    button.addEventListener('click', function() {
        const pedidoId = this.getAttribute('data-id');
        document.getElementById('delete_id_pedido').value = pedidoId;
        document.getElementById('deleteOrderModal').style.display = 'block';
    });
});

// Função para fechar o modal de exclusão
document.getElementById('closeDeleteOrderModal').addEventListener('click', function() {
    document.getElementById('deleteOrderModal').style.display = 'none';
});

// Função para cancelar a exclusão
document.getElementById('cancelDelete').addEventListener('click', function() {
    document.getElementById('deleteOrderModal').style.display = 'none';
});

// =============================
// BUSCA CEP (ViaCEP)
// =============================
function buscarCEP(cepInputId, enderecoId, bairroId, cidadeId, estadoId) {

    const input = document.getElementById(cepInputId);
    if (!input) return;

    input.addEventListener("blur", function () {

        let cep = this.value.replace(/\D/g, '');

        if (cep.length !== 8) {
            alert("CEP inválido!");
            return;
        }

        fetch(`https://viacep.com.br/ws/${cep}/json/`)
            .then(response => response.json())
            .then(data => {

                if (data.erro) {
                    alert("CEP não encontrado!");
                    return;
                }

                document.getElementById(enderecoId).value = data.logradouro;
                document.getElementById(bairroId).value = data.bairro;
                document.getElementById(cidadeId).value = data.localidade;
                document.getElementById(estadoId).value = data.uf;

            })
            .catch(error => {
                console.error("Erro ao buscar CEP:", error);
            });
    });
}

// Aplicar nos dois modais
buscarCEP("cep", "endereco", "bairro", "cidade", "estado");
buscarCEP("edit_cep", "edit_endereco", "edit_bairro", "edit_cidade", "edit_estado");


// =============================
// GEOCODIFICAÇÃO PRECISA
// =============================

function geocodeAddress() {

    var endereco = document.getElementById('endereco').value;
    var bairro = document.getElementById('bairro').value;
    var cidade = document.getElementById('cidade').value;
    var estado = document.getElementById('estado').value;

    var address = `${endereco}, ${bairro}, ${cidade}, ${estado}, Brasil`;

    var url = `https://nominatim.openstreetmap.org/search?q=${encodeURIComponent(address)}&format=json&addressdetails=1&limit=1`;

    fetch(url)
        .then(response => response.json())
        .then(data => {
            if (data.length > 0) {

                document.getElementById('latitude').value = data[0].lat;
                document.getElementById('longitude').value = data[0].lon;

                document.getElementById('newOrderForm').submit();

            } else {
                alert('Endereço não encontrado com precisão.');
            }
        })
        .catch(error => console.error(error));
}


function geocodeAddressEdit() {

    var endereco = document.getElementById('edit_endereco').value;
    var bairro = document.getElementById('edit_bairro').value;
    var cidade = document.getElementById('edit_cidade').value;
    var estado = document.getElementById('edit_estado').value;

    var address = `${endereco}, ${bairro}, ${cidade}, ${estado}, Brasil`;

    var url = `https://nominatim.openstreetmap.org/search?q=${encodeURIComponent(address)}&format=json&addressdetails=1&limit=1`;

    fetch(url)
        .then(response => response.json())
        .then(data => {
            if (data.length > 0) {

                document.getElementById('edit_latitude').value = data[0].lat;
                document.getElementById('edit_longitude').value = data[0].lon;

                document.getElementById('editOrderForm').submit();

            } else {
                alert('Endereço não encontrado com precisão.');
            }
        })
        .catch(error => console.error(error));
}

</script>
</body>

</html>
