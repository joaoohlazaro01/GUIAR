<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Pedidos - GUIAR</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/CSSadm/pedidos.css"> 
    <link rel="Shortcut Icon" type="image/png" href="<?= BASE_URL ?>/img/G.png">
    <style>
        @font-face {
            font-family: 'Brice-Bold';
            src: url('<?= BASE_URL ?>/fonts/Brice-BoldSemiCondensed.ttf') format('truetype');
        }

        @font-face {
            font-family: 'BasisGrotesque-Regular';
            src: url('<?= BASE_URL ?>/fonts/BasisGrotesqueArabicPro-Regular.ttf') format('truetype');
        }

        @font-face {
            font-family: 'Brice-SemiBoldSemi';
            src: url('<?= BASE_URL ?>/fonts/Brice-SemiBoldSemiCondensed.ttf');
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            color-scheme: light;
            --orders-ink: #172b4d;
            --orders-muted: #8390a8;
            --orders-border: #edf0f6;
            --orders-surface: #fff;
            --orders-primary: var(--emp-primary, #4f46e5);
            --orders-primary-light: var(--emp-primary-light, #eef2ff);
        }

        body {
            min-height: 100vh;
            overflow-x: hidden;
            background:
                radial-gradient(ellipse at 60% -10%, rgba(255, 255, 255, .98), transparent 48%),
                #f1f4fa !important;
            color: #263957;
            font-family: 'BasisGrotesque-Regular', Arial, sans-serif;
        }

        .sidebar {
            z-index: 20;
            width: 250px;
            height: 100vh;
            padding: 18px 12px;
            overflow-y: auto;
            background: #fff;
            border-right: 1px solid var(--orders-border);
            box-shadow: 6px 0 24px rgba(27, 48, 82, .035);
        }

        .sidebar a {
            margin: 3px 0;
            padding: 12px 14px;
            border-radius: 12px;
            color: #718096;
            font-size: 13px;
            font-weight: 600;
            transition: color .18s ease, background-color .18s ease;
        }

        .sidebar a:hover,
        .sidebar a[href*="action=pedidos"]:not([href*="pedidosEntregues"]) {
            background: var(--orders-primary-light);
            color: var(--orders-primary);
        }

        .sidebar .spacer { flex: 1; }

        .main {
            min-width: 0;
            min-height: 100vh;
            margin-left: 250px;
            padding: 0 clamp(12px, 2vw, 36px) 118px;
        }

        .orders-header {
            position: sticky;
            top: 0;
            z-index: 10;
            display: flex;
            align-items: center;
            min-height: 74px;
            margin: 0 calc(clamp(12px, 2vw, 36px) * -1) 22px;
            padding: 14px clamp(12px, 2vw, 36px);
            border-bottom: 1px solid rgba(237, 240, 246, .8);
            background: rgba(255, 255, 255, .82);
            backdrop-filter: blur(14px);
        }

        .orders-header h1 {
            color: var(--orders-ink);
            font-size: clamp(18px, 1.5vw, 22px);
            font-weight: 800;
            letter-spacing: -.035em;
        }

        .orders-header p {
            margin-top: 3px;
            color: var(--orders-muted);
            font-size: 12px;
        }

        .container {
            width: 100%;
            max-width: 1760px;
            margin: 0 auto;
        }

        .orders-results {
            width: 100%;
            min-width: 0;
            border: 1px solid var(--orders-border);
            border-radius: 16px;
            background: #fff;
            box-shadow: 0 8px 22px rgba(27, 48, 82, .045);
        }

        .orders-list-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 16px 20px;
            border-bottom: 1px solid var(--orders-border);
        }

        .orders-list-title {
            color: var(--orders-ink);
            font-size: 14px;
            font-weight: 800;
        }

        .orders-count {
            padding: 5px 10px;
            border-radius: 999px;
            background: var(--orders-primary-light);
            color: var(--orders-primary);
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        .orders-table-wrap {
            width: 100%;
            overflow-x: auto;
        }

        .orders-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        .orders-table thead {
            background: #f8fafc;
            color: var(--orders-muted);
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .045em;
        }

        .orders-table th {
            padding: 12px 14px;
            white-space: nowrap;
        }

        .orders-table th:first-child,
        .orders-table td:first-child { padding-left: 20px; }

        .orders-table th:last-child,
        .orders-table td:last-child { padding-right: 20px; }

        .orders-table tbody tr {
            border-bottom: 1px solid var(--orders-border);
            transition: background-color .18s ease;
        }

        .orders-table tbody tr:last-child { border-bottom: 0; }
        .orders-table tbody tr.card:hover { background: #fafbfe; }

        .orders-table td {
            min-width: 0;
            padding: 15px 14px;
            color: #263957;
            font-size: 12px;
            vertical-align: middle;
        }

        .order-reference {
            display: flex;
            align-items: center;
            gap: 9px;
            color: var(--orders-ink);
            font-size: 12px;
            font-weight: 800;
            white-space: nowrap;
        }

        .card input[type="checkbox"] {
            width: 15px;
            height: 15px;
            accent-color: var(--orders-primary);
            cursor: pointer;
        }

        .orders-table .card-client {
            color: var(--orders-ink);
            font-size: 12px;
            font-weight: 800;
            overflow-wrap: anywhere;
        }

        .orders-table p {
            margin: 0;
            color: #52627c;
            font-size: 12px;
            line-height: 1.45;
            overflow-wrap: anywhere;
        }

        .orders-table p strong { display: none; }

        .orders-table .card-bairro,
        .orders-table .card-desc {
            display: block;
            margin-top: 3px;
            color: var(--orders-muted);
            font-size: 10px;
            line-height: 1.4;
            overflow-wrap: anywhere;
        }

        .orders-table .card-price {
            color: #263957;
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
        }

        .orders-table .status {
            display: inline-flex;
            align-items: center;
            width: fit-content;
            gap: 5px;
            padding: 5px 9px;
            border-radius: 999px;
            background: var(--orders-primary-light);
            color: var(--orders-primary);
            font-size: 10px;
            font-weight: 700;
            white-space: nowrap;
        }

        .orders-table .status::before {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
            content: "";
        }

        .card-actions {
            display: flex; 
            align-items: center;
            gap: 8px;
        }

        .card-actions button {
            min-height: 32px;
            padding: 6px 10px;
            border: 1px solid var(--orders-border);
            border-radius: 8px;
            background: #f8fafc;
            color: #52627c;
            font-size: 11px;
            font-weight: 700;
            transition: color .18s ease, background-color .18s ease, border-color .18s ease;
        }

        .card-actions .btn-edit:hover {
            border-color: var(--orders-primary-light);
            background: var(--orders-primary-light);
            color: var(--orders-primary);
        }

        .card-actions .btn-delete:hover {
            border-color: #ffe4e8;
            background: #fff1f3;
            color: #d91d39;
        }

        .fixed-buttons {
            position: fixed;
            right: clamp(12px, 2vw, 32px);
            bottom: clamp(12px, 2vh, 24px);
            z-index: 20;
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-end;
            gap: 8px;
        }

        .fixed-buttons button {
            min-height: 42px;
            padding: 10px 16px;
            border: none;
            border-radius: 12px;
            background: var(--emp-secondary, #fc8835);
            box-shadow: 0 8px 24px var(--emp-secondary-light, rgba(252, 136, 53, .2));
            color: var(--emp-secondary-contrast, #fff);
            cursor: pointer;
            font-size: 12px;
            font-weight: 700;
            transition: background-color .18s ease, transform .18s ease;
        }

        .fixed-buttons button:hover { background: var(--emp-secondary-hover, #e06c00); }

        .logout-btn {
            position: fixed;
            top: 16px;
            right: clamp(12px, 2vw, 36px);
            z-index: 15;
            padding: 8px 14px;
            border: 1px solid var(--orders-border);
            border-radius: 999px;
            background: #fff;
            color: #52627c;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
            transition: color .18s ease, background-color .18s ease;
        }

        .logout-btn:hover {
            background: var(--orders-primary-light);
            color: var(--orders-primary);
        }

        #sendOrdersToDeliveryForm {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        #entregadoresContainer {
            margin-bottom: 2px;
        }

        select,
        .form-group input,
        .form-group textarea {
            min-height: 42px;
            padding: 10px 12px;
            border: 1px solid #dfe5ef;
            border-radius: 9px;
            background: #fff;
            color: #263957;
            font: inherit;
            font-size: 13px;
            width: 100%;
        }

        select:focus,
        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--orders-primary);
            box-shadow: 0 0 0 3px var(--orders-primary-light);
        }

        button {
            font-family: 'BasisGrotesque-Regular', Arial, sans-serif;
            background: var(--emp-secondary, #fc8835);
            color: var(--emp-secondary-contrast, #fff);
            padding: 10px 14px;
            border: none;
            border-radius: 9px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 700;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            inset: 0;
            overflow-y: auto;
            width: 100%;
            height: 100%;
            padding: 18px;
            background: rgba(15, 23, 42, .42);
            backdrop-filter: blur(4px);
        }

        .modal-content {
            position: relative;
            width: min(100%, 560px);
            max-height: calc(100vh - 36px);
            margin: 4vh auto;
            padding: clamp(18px, 3vw, 28px);
            overflow-y: auto;
            border: 1px solid var(--orders-border);
            border-radius: 16px;
            background: #fff;
            box-shadow: 0 20px 60px rgba(20, 38, 68, .2);
        }

        .modal-content h2 {
            margin: 0 36px 20px 0;
            color: var(--orders-ink);
            font-size: 18px;
            font-weight: 800;
        }

        .close {
            position: absolute;
            top: 12px;
            right: 16px;
            color: #8793a9;
            font-size: 28px;
            font-weight: 700;
            cursor: pointer;
        }

        .form-group { margin-bottom: 14px; }
        .form-group label {
            display: block;
            margin-bottom: 6px;
            color: #52627c;
            font-size: 12px;
            font-weight: 700;
        }

        .form-group textarea { min-height: 90px; resize: vertical; }

        .orders-empty {
            padding: 34px 20px !important;
            border: 1px solid var(--orders-border);
            background: #fff;
            color: var(--orders-muted);
            text-align: center;
        }

        @media (max-width: 1100px) {
            .orders-table th,
            .orders-table td { padding-right: 10px; padding-left: 10px; }
            .orders-table th:first-child,
            .orders-table td:first-child { padding-left: 14px; }
            .orders-table th:last-child,
            .orders-table td:last-child { padding-right: 14px; }
        }

        @media (max-width: 768px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
                min-height: 0;
                padding: 8px;
                flex-direction: row;
                gap: 4px;
                overflow-x: auto;
                border-right: 0;
                border-bottom: 1px solid var(--orders-border);
                box-shadow: 0 4px 14px rgba(27, 48, 82, .04);
            }

            .sidebar a {
                flex: 0 0 auto;
                margin: 0;
                padding: 10px 12px;
                font-size: 12px;
                white-space: nowrap;
            }

            .sidebar .spacer { display: none; }
            .main { margin-left: 0; padding: 0 14px 120px; }
            .orders-header { margin: 0 -14px 16px; padding: 16px 14px; }
            .logout-btn { top: 10px; right: 14px; }

            .orders-table thead { display: none; }
            .orders-table,
            .orders-table tbody { display: block; }
            .orders-table tbody tr.card {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 0 12px;
                padding: 10px 14px;
                border-left: 3px solid var(--orders-primary);
            }
            .orders-table td,
            .orders-table td:first-child,
            .orders-table td:last-child {
                display: block;
                min-width: 0;
                padding: 9px 4px;
                overflow-wrap: anywhere;
            }
            .orders-table td::before {
                display: block;
                margin-bottom: 4px;
                color: var(--orders-muted);
                font-size: 9px;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: .04em;
                content: attr(data-label);
            }
            .orders-table td:first-child {
                display: flex;
                flex-direction: column;
                align-items: flex-start;
                justify-content: center;
                gap: 4px;
            }
            .orders-table td:first-child::before { margin-bottom: 0; }
            .orders-table td:last-child { grid-column: 1 / -1; }
        }

        @media (max-width: 480px) {
            .main { padding: 0 10px 150px; }
            .orders-header { margin: 0 -10px 14px; padding: 14px 10px; }
            .orders-header h1 { font-size: 17px; }
            .orders-header p { max-width: 230px; font-size: 10px; }
            .orders-list-heading { padding: 13px 12px; }
            .orders-list-title { font-size: 13px; }
            .orders-table tbody tr.card { gap: 0 8px; padding: 8px 10px; }
            .orders-table td,
            .orders-table td:first-child,
            .orders-table td:last-child { padding: 8px 3px; }
            .card-actions { flex-wrap: wrap; }
            .fixed-buttons {
                right: 10px;
                bottom: 10px;
                left: 10px;
                flex-direction: column;
                gap: 7px;
            }
            .fixed-buttons button { width: 100%; min-height: 40px; }
            .modal { padding: 10px; }
            .modal-content { max-height: calc(100vh - 20px); margin: 10px auto; }
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <a href="<?= BASE_URL ?>/routes.php?action=dashboardAdm">Início</a>
        <a href="<?= BASE_URL ?>/routes.php?action=pedidos">Pedidos</a>
        <a href="<?= BASE_URL ?>/PHP ADM/entregadores.php">Entregadores</a>
        <a href="<?= BASE_URL ?>/routes.php?action=pedidosEntregues">Pedidos Entregues</a>
        <a href="<?= BASE_URL ?>/mapa/mapaAdm.php">Mapa das Rotas</a>
        <div class="spacer"></div>
        <a href="<?= BASE_URL ?>/PHP ADM/meuPerfil.php">Meu perfil</a>
    </div>

    <a href="<?= BASE_URL ?>/routes.php?action=logoutAdm" class="logout-btn">Logout</a>

    <div class="main">
        <header class="orders-header">
            <div>
                <h1>Pedidos</h1>
                <p>Acompanhe e gerencie os pedidos cadastrados.</p>
            </div>
        </header>
        <div class="container">
            <section class="orders-results" aria-live="polite">
                <div class="orders-list-heading">
                    <h2 class="orders-list-title">Pedidos cadastrados</h2>
                    <span class="orders-count"><?= count($result ?? []) ?> pedidos</span>
                </div>
                <div class="orders-table-wrap">
                    <table class="orders-table">
                        <thead>
                            <tr>
                                <th>Pedido</th>
                                <th>Cliente</th>
                                <th>Endereço</th>
                                <th>Entregador</th>
                                <th>Valor</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
            <?php if (!empty($result)): ?>
                <?php foreach ($result as $row): ?>
                    <tr class="card">
                        <td data-label="Pedido">
                            <input type="checkbox" name="pedido_ids[]" value="<?= htmlspecialchars($row["id_pedido"]) ?>">
                            <span class="order-reference">#<?= htmlspecialchars($row["id_pedido"]) ?></span>
                        </td>
                        <td data-label="Cliente">
                            <h3 class="card-client"><?= htmlspecialchars($row["nome_cliente"]) ?></h3>
                        </td>
                        <td data-label="Endereço">
                            <p><strong>Endereço:</strong><span class="card-address"><?= htmlspecialchars($row["endereco"]) ?></span></p>
                            <span class="card-bairro"><?= htmlspecialchars($row["bairro"]) ?></span>
                            <span class="card-desc"><?= htmlspecialchars($row["descricao"]) ?></span>
                        </td>
                        <td data-label="Entregador">
                        <?php if (!empty($row["nome_entregador"])): ?>
                            <p><strong>Entregador:</strong> <?= htmlspecialchars($row["nome_entregador"]) ?></p>
                        <?php else: ?>
                            <p><strong>Entregador:</strong> Não atribuído</p>
                        <?php endif; ?>
                        </td>
                        <td data-label="Valor">
                            <p class="card-price"><strong>Preço:</strong> R$<?= number_format($row["preco"], 2, ',', '.') ?></p>
                        </td>
                        <td data-label="Status">
                            <span class="status"><?= htmlspecialchars($row["status"]) ?></span>
                        </td>
                        <td data-label="Ações">
                        <div class="card-actions">
                            <button type='button' class='btn-edit' data-id='<?= htmlspecialchars($row["id_pedido"]) ?>'>Editar</button>
                            <button type='button' class='btn-delete' data-id='<?= htmlspecialchars($row["id_pedido"]) ?>'>Excluir</button>
                        </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td class="orders-empty" colspan="7">Nenhum pedido encontrado</td>
                </tr>
            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </section>
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
            <form id="newOrderForm" method="POST" action="<?= BASE_URL ?>/routes.php?action=adicionarPedido">
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
            <form id="sendOrdersToDeliveryForm" method="POST" action="<?= BASE_URL ?>/routes.php?action=enviarPedidos">
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
            <form id="editOrderForm" method="POST" action="<?= BASE_URL ?>/routes.php?action=editarPedido">
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
            <form id="deleteOrderForm" method="POST" action="<?= BASE_URL ?>/routes.php?action=excluirPedido">
                <input type="hidden" id="delete_id_pedido" name="id_pedido">
                <div class="form-group">
                    <button type="submit">Sim, cancelar</button>
                    <button type="button" id="cancelDelete">Não</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script src="<?= BASE_URL ?>/public/js/map_utils.js"></script>
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
                document.getElementById('edit_nome_cliente').value = card.querySelector('.card-client').innerText;
                document.getElementById('edit_preco').value = card.querySelector('.card-price').innerText.replace(/[^\d,.-]/g, '').replace(/\./g, '').replace(',', '.').trim();
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
