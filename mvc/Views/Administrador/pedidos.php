<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Pedidos</title>

    <link rel="shortcut icon" type="image/png" href="<?= BASE_URL ?>/img/G.png">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
      
     /* SIDEBAR */
 /* Ajuste para evitar que a sidebar empurre o conteúdo no mobile */
        @media (max-width: 1024px) {
            body {
                flex-direction: column;
                /* Em vez de linha, coloca um abaixo do outro */
            }

            #sidebar {
                position: fixed;
                left: -100%;
                top: 0;
                bottom: 0;
                z-index: 50;
                width: 280px;
                margin: 0 !important;
                height: 100vh;
                border-radius: 0 !important;
            }

            #sidebar.mobile-open {
                left: 0;
            }

            /* Garante que o conteúdo ocupe a tela toda */
            #mainContent {
                width: 100% !important;
                margin-left: 0 !important;
            }
        }

        /* Transição suave para fechar/abrir */
        #sidebar {
            transition: all 0.3s ease-in-out;
        }

        .sidebar-closed {
            width: 0 !important;
            opacity: 0;
            overflow: hidden;
            margin-left: 0 !important;
            margin-right: 0 !important;
        }

        /* Efeitos visuais mantidos */
        .menu-item {
            transition: all 0.25s ease;
        }

        .menu-item:hover {
            background-color: rgba(255, 255, 255, 0.08);
            transform: translateX(4px);
        }

        .active-menu {
            background: linear-gradient(90deg, rgba(255, 212, 0, 0.15) 0%, rgba(255, 212, 0, 0.02) 100%);
            border-left: 4px solid #FFD400;
            color: #FFD400 !important;
        }

        .hover-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px -10px rgba(0, 0, 0, 0.08);
        }

        /* Impede que a tabela quebre o layout no celular */
        .table-container {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        /* Estilo para esconder e mostrar no mobile */
        @media (max-width: 1024px) {
            #sidebar {
                position: fixed !important;
                left: -100% !important;
                /* Começa totalmente escondida */
                top: 0;
                bottom: 0;
                margin: 0 !important;
                height: 100vh !important;
                border-radius: 0 !important;
                z-index: 9999;
                /* Garante que fique em cima de tudo */
                transition: left 0.3s ease-in-out;
            }

            /* Essa é a classe que o JavaScript vai ativar */
            #sidebar.mobile-open {
                left: 0 !important;
            }
        }

        /* Estilo para recolher no Desktop (Opcional) */
        .sidebar-closed {
            width: 0 !important;
            opacity: 0;
            pointer-events: none;
            margin-left: 0 !important;
            margin-right: 0 !important;
        }
/* MAIN */
.main {
    margin-left: 320px;
    padding: 30px;
}

/* HEADER */
.page-header {
    background: rgba(255,255,255,.8);
    backdrop-filter: blur(15px);
    border: 1px solid rgba(255,255,255,.4);
    padding: 25px 30px;
    border-radius: 24px;
    margin-bottom: 30px;
    box-shadow: 0 10px 25px rgba(0,0,0,.05);
}

.page-header h1 {
    font-family: 'Brice-Bold';
    color: #1E293B;
    font-size: 28px;
}

/* CONTAINER DOS CARDS */
.container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center; /* centraliza */
    gap: 22px;
    padding-bottom: 150px;
}

/* CARD MENOR */
.card {
    position: relative;
    background: white;
    border-radius: 24px;
    padding: 20px;
    border-left: 6px solid #fc8835;
    box-shadow: 0 8px 30px rgba(0,0,0,.06);
    transition: .3s;

    width: 100%;
    max-width: 370px; /* menor */
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,.08);
}

.card input[type="checkbox"] {
    position: absolute;
    top: 20px;
    right: 20px;
    width: 20px;
    height: 20px;
    accent-color: #fc8835;
}

.card h3 {
    color: #1E293B;
    font-size: 20px;
    margin-bottom: 16px;
    padding-right: 30px;
    font-weight: bold;
}

.card p {
    color: #64748B;
    margin-bottom: 10px;
    line-height: 1.5;
}

.card strong {
    color: #1E293B;
}

.status {
    color: #fc8835;
    font-weight: bold;
}

.card-actions {
    display: flex;
    gap: 12px;
    margin-top: 20px;
}

.btn-edit,
.btn-delete {
    flex: 1;
    border: none;
    padding: 14px;
    border-radius: 14px;
    cursor: pointer;
    transition: .3s;
    font-size: 14px;
}

.btn-edit {
    background: #F1F5F9;
    color: #334155;
}

.btn-delete {
    background: #FEF2F2;
    color: #DC2626;
}

.btn-edit:hover,
.btn-delete:hover {
    transform: translateY(-2px);
}

/* BOTÕES FIXOS */
.fixed-buttons {
    position: fixed;
    bottom: 30px;
    right: 30px;
    display: flex;
    flex-direction: column;
    gap: 14px;
    z-index: 9999; /* garante aparecer */
}

.fixed-buttons button {
    border: none;
    background: #fc8835;
    color: white;
    padding: 16px 22px;
    border-radius: 18px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    box-shadow: 0 10px 30px rgba(252,136,53,.3);
    transition: .3s;
}

.fixed-buttons button:hover {
    background: #e06c00;
    transform: translateY(-2px);
}

/* MODAL */
.modal {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,.55);
    backdrop-filter: blur(6px);
    z-index: 1000;
    overflow-y: auto;
}

.modal-content {
    background: white;
    width: 90%;
    max-width: 550px;
    margin: 60px auto;
    border-radius: 28px;
    padding: 30px;
    box-shadow: 0 25px 50px rgba(0,0,0,.15);
}

.modal-content h2 {
    margin-bottom: 25px;
    color: #1E293B;
}

.close {
    float: right;
    font-size: 28px;
    cursor: pointer;
}

.form-group {
    margin-bottom: 18px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
    color: #334155;
}

.form-group input,
.form-group textarea,
select {
    width: 100%;
    border: 1px solid #E2E8F0;
    border-radius: 14px;
    padding: 14px;
    outline: none;
    transition: .3s;
}

.form-group input:focus,
.form-group textarea:focus,
select:focus {
    border-color: #fc8835;
}

.form-group button {
    width: 100%;
    background: #fc8835;
    border: none;
    color: white;
    padding: 16px;
    border-radius: 16px;
    cursor: pointer;
    font-weight: bold;
}

/* RESPONSIVO */
@media(max-width:900px) {
    .sidebar {
        width: 100%;
        height: auto;
        position: relative;
        left: 0;
        top: 0;
        border-radius: 0;
    }

    .main {
        margin-left: 0;
        padding: 20px;
    }

    .container {
        justify-content: center;
    }

    .card {
        max-width: 100%;
    }

    .fixed-buttons {
        left: 20px;
        right: 20px;
    }

    .fixed-buttons button {
        width: 100%;
    }
}
    </style>
</head>

<body>

    <!-- OVERLAY MOBILE -->
        <div id="overlay"
            class="hidden fixed inset-0 bg-black/40 z-30 md:hidden">
        </div>

        <!-- SIDEBAR -->
         <?php
$nomeAdmin = $admin["nome_adm"] ?? "Admin";
?>
        <aside id="sidebar"
    class="w-72 bg-[#0B0D2F] flex flex-col fixed top-4 left-4 text-white z-40 shadow-2xl transition-all rounded-[24px] overflow-hidden h-[92vh]">

    <div class="flex flex-col h-full">

        <!-- BOTÃO FECHAR MOBILE -->
        <button id="closeSidebar"
            class="absolute top-5 right-5 md:hidden text-white text-2xl z-50">

            ✕
        </button>

        <!-- LOGO -->
        <div class="p-8 mb-4">
            <img src="<?= BASE_URL ?>/img/logobrancaR.png"
                alt="Logo GUIAR"
                class="w-32 h-auto object-contain">
        </div>

        <!-- MENU -->
        <nav class="px-4 space-y-2 flex-grow overflow-y-auto">

            <!-- INÍCIO -->
            <a href="<?= BASE_URL ?>/routes.php?action=dashboardAdm"
                 class="menu-item flex items-center gap-3.5 px-5 py-3 rounded-xl font-semibold text-sm text-slate-400 hover:text-white hover:bg-white/5 transition-all">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>

                Início
            </a>

            <!-- PEDIDOS -->
            <a href="<?= BASE_URL ?>/routes.php?action=pedidos"
            class="menu-item flex items-center gap-3.5 px-5 py-3 rounded-xl font-bold text-sm bg-[#FFD400] text-[#0B0D2F] shadow-lg shadow-yellow-500/10 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 opacity-70"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>

                Pedidos
            </a>

            <!-- ENTREGADORES -->
            <a href="<?= BASE_URL ?>/routes.php?action=entregadores"
                class="menu-item flex items-center gap-3.5 px-5 py-3 rounded-xl font-semibold text-sm text-slate-400 hover:text-white hover:bg-white/5 transition-all">


                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 opacity-70"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-4a4 4 0 100-8 4 4 0 000 8zm6 4a2 2 0 100-4 2 2 0 000 4zM3 20v-2a2 2 0 012-2h1" />
                </svg>

                Entregadores
            </a>

            <!-- PEDIDOS ENTREGUES -->
            <a href="<?= BASE_URL ?>/routes.php?action=pedidosEntregues"
                class="menu-item flex items-center gap-3.5 px-5 py-3 rounded-xl font-semibold text-sm text-slate-400 hover:text-white hover:bg-white/5 transition-all">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 opacity-70"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                </svg>

                Pedidos Entregues
            </a>

            <!-- MAPA -->
            <a href="<?= BASE_URL ?>/routes.php?action=mapaAdm"
                class="menu-item flex items-center gap-3.5 px-5 py-3 rounded-xl font-semibold text-sm text-slate-400 hover:text-white hover:bg-white/5 transition-all">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 opacity-70"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                </svg>

                Acompanhar Rotas
            </a>

            <!-- PERFIL -->
            <a href="<?= BASE_URL ?>/routes.php?action=perfilAdm"
                class="menu-item flex items-center gap-3.5 px-5 py-3 rounded-xl font-semibold text-sm text-slate-400 hover:text-white hover:bg-white/5 transition-all">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 opacity-70"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>

                Meu Perfil
            </a>
        </nav>

        <!-- FOOTER -->
        <div class="p-4 mt-auto">

            <div class="flex items-center gap-3.5 p-3 rounded-2xl bg-white/5 border border-white/5">

                <div class="w-10 h-10 rounded-full bg-[#FFD400] text-[#0B0D2F] font-black text-sm flex items-center justify-center shadow-lg">
                    <?= strtoupper(substr($nomeAdmin, 0, 2)) ?>
                </div>

                <div class="flex-grow min-w-0">

                    <p class="font-bold text-xs text-white truncate">
                        <?= htmlspecialchars($nomeAdmin) ?>
                    </p>

                    <p class="text-[10px] text-slate-500 font-bold tracking-wider uppercase">
                        Admin
                    </p>
                </div>

                <!-- LOGOUT -->
                <a href="<?= BASE_URL ?>/routes.php?action=logoutAdm"
                    class="text-slate-500 hover:text-rose-500 transition-colors p-1">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</aside>
    <div class="main">

        <!-- HEADER DA PÁGINA (Com campo de busca, sino e logout) -->
        <header class="bg-white border-b border-[#E2E8F0] px-8 py-5 flex items-center justify-between sticky top-0 z-30 shadow-sm gap-4">

        <!-- MENU MOBILE -->
                <button id="hamburger"
                    class="md:hidden flex items-center justify-center w-10 h-10 rounded-xl bg-gray-100">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-6 h-6 text-gray-700"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

            <div class="flex items-center gap-4 min-w-0">
    
                    <p class="text-2xl font-extrabold text-slate-900 flex items-center gap-2">Pedidos</p>
                </div>
            </div>

        <form id="sendOrdersForm"
              method="POST"
              action="<?= BASE_URL ?>/routes.php?action=enviarPedidos">

            <div class="container">

                <?php
                if (!empty($result) && count($result) > 0) {
                    foreach ($result as $row) {
        ?>
        <div class="card">

    <input type="checkbox"
        name="pedido_ids[]"
        value="<?= htmlspecialchars($row["id_pedido"]) ?>">

    <h3>
        <?= htmlspecialchars($row["nome_cliente"]) ?>
    </h3>

    <p>
        <strong>Preço:</strong>
        R$ <?= htmlspecialchars($row["preco"]) ?>
    </p>

    <p>
        <strong>Endereço:</strong>
        <?= htmlspecialchars($row["endereco"]) ?>
    </p>

    <p>
        <strong>Bairro:</strong>
        <?= htmlspecialchars($row["bairro"]) ?>
    </p>

    <p>
        <strong>Descrição:</strong>
        <?= htmlspecialchars($row["descricao"]) ?>
    </p>

    <p class="status">
        <strong>Status:</strong>
        <?= htmlspecialchars($row["status"]) ?>
    </p>

    <?php if (!empty($row["nome_entregador"])): ?>
        <p>
            <strong>Entregador:</strong>
            <?= htmlspecialchars($row["nome_entregador"]) ?>
        </p>
    <?php else: ?>
        <p>
            <strong>Entregador:</strong>
            <span style="color:#94A3B8;">
                Não atribuído
            </span>
        </p>
    <?php endif; ?>

    <div class="card-actions">

        <button type="button"
            class="btn-edit"
            data-id="<?= htmlspecialchars($row["id_pedido"]) ?>">
            Editar
        </button>

        <button type="button"
            class="btn-delete"
            data-id="<?= htmlspecialchars($row["id_pedido"]) ?>">
            Excluir
        </button>

    </div>

</div>

<?php
        }
    } else {
?>

<div style="
    background:white;
    border-radius:28px;
    padding:50px;
    text-align:center;
    color:#94A3B8;
    font-size:18px;
    grid-column:1/-1;
    box-shadow:0 8px 30px rgba(0,0,0,.05);
">
    Nenhum pedido encontrado
</div>

<?php } ?>

</div>

<!-- BOTÕES FIXOS -->
<div class="fixed-buttons">

    <button type="button"
        id="openNewOrderModal">
        + Adicionar Novo Pedido
    </button>

    <button type="button"
        id="openSendOrdersModal">
        Enviar Pedidos Selecionados
    </button>

</div>

</form>

</div>

<!-- MODAL NOVO PEDIDO -->
<div id="newOrderModal" class="modal">
    <div class="modal-content">

        <span class="close"
            id="closeNewOrderModal">
            &times;
        </span>

        <h2>Adicionar Novo Pedido</h2>

        <form id="newOrderForm"
            method="POST"
            action="<?= BASE_URL ?>/routes.php?action=adicionarPedido">

            <div class="form-group">
                <label for="nome_cliente">
                    Nome do Cliente:
                </label>

                <input type="text"
                    id="nome_cliente"
                    name="nome_cliente"
                    required>
            </div>

            <div class="form-group">
                <label for="preco">
                    Preço:
                </label>

                <input type="number"
                    id="preco"
                    name="preco"
                    step="0.01"
                    required>
            </div>

            <div class="form-group">
                <label for="cep">
                    CEP:
                </label>

                <input type="text"
                    id="cep"
                    name="cep"
                    maxlength="9"
                    minlength="9"
                    placeholder="00000-000"
                    pattern="\d{5}-\d{3}"
                    required>
            </div>

            <div class="form-group">
                <label for="endereco">
                    Endereço:
                </label>

                <input type="text"
                    id="endereco"
                    name="endereco"
                    required>
            </div>

            <div class="form-group">
                <label for="bairro">
                    Bairro:
                </label>

                <input type="text"
                    id="bairro"
                    name="bairro"
                    required>
            </div>

            <input type="hidden"
                id="cidade"
                name="cidade">

            <input type="hidden"
                id="estado"
                name="estado">

            <div class="form-group">
                <label for="descricao">
                    Descrição:
                </label>

                <textarea id="descricao"
                    name="descricao"
                    required></textarea>
            </div>

            <input type="hidden"
                id="latitude"
                name="latitude">

            <input type="hidden"
                id="longitude"
                name="longitude">

            <div class="form-group">
                <button type="button"
                    onclick="geocodeAddress()">
                    Salvar Pedido
                </button>
            </div>

        </form>

    </div>
</div>

<!-- MODAL ENVIAR PEDIDOS -->
<div id="sendOrdersModal" class="modal">

    <div class="modal-content">

        <span class="close"
            id="closeSendOrdersModal">
            &times;
        </span>

        <h2>Enviar Pedidos Selecionados</h2>

        <form id="sendOrdersToDeliveryForm"
            method="POST"
            action="<?= BASE_URL ?>/routes.php?action=enviarPedidos">

            <div class="form-group">

                <label for="entregadorSelect">
                    Selecione um Entregador
                </label>

                <div id="entregadoresContainer">

                    <?php
                    if (!empty($resultEntregadores) && count($resultEntregadores) > 0) {

                        echo "<select id='entregadorSelect' 
                                    name='entregador_id' 
                                    required>";

                        echo "<option value=''>
                                Selecione um Entregador
                              </option>";

                        foreach ($resultEntregadores as $entregador) {

                            echo "<option value='" .
                                htmlspecialchars($entregador["id_entregador"]) .
                                "'>" .
                                htmlspecialchars($entregador["nome_completo"]) .
                                "</option>";
                        }

                        echo "</select>";

                    } else {

                        echo "<p style='color:#94A3B8'>
                                Nenhum entregador encontrado
                              </p>";
                    }
                    ?>

                </div>

            </div>

            <input type="hidden"
                id="selected_pedido_ids"
                name="pedido_ids">

            <button type="submit">
                Enviar Pedidos
            </button>

        </form>

    </div>

</div>


<!-- MODAL EDITAR PEDIDO -->
<div id="editOrderModal" class="modal">

    <div class="modal-content">

        <span class="close"
            id="closeEditOrderModal">
            &times;
        </span>

        <h2>Editar Pedido</h2>

        <form id="editOrderForm"
            method="POST"
            action="<?= BASE_URL ?>/routes.php?action=editarPedido">

            <input type="hidden"
                id="edit_id_pedido"
                name="id_pedido">

            <div class="form-group">

                <label for="edit_nome_cliente">
                    Nome do Cliente:
                </label>

                <input type="text"
                    id="edit_nome_cliente"
                    name="nome_cliente"
                    required>

            </div>

            <div class="form-group">

                <label for="edit_preco">
                    Preço:
                </label>

                <input type="number"
                    id="edit_preco"
                    name="preco"
                    step="0.01"
                    required>

            </div>

            <div class="form-group">

                <label for="edit_cep">
                    CEP:
                </label>

                <input type="text"
                    id="edit_cep"
                    name="cep"
                    maxlength="9"
                    minlength="9"
                    placeholder="00000-000"
                    pattern="\d{5}-\d{3}"
                    required>

            </div>

            <div class="form-group">

                <label for="edit_endereco">
                    Endereço:
                </label>

                <input type="text"
                    id="edit_endereco"
                    name="endereco"
                    required>

            </div>

            <div class="form-group">

                <label for="edit_bairro">
                    Bairro:
                </label>

                <input type="text"
                    id="edit_bairro"
                    name="bairro"
                    required>

            </div>

            <input type="hidden"
                id="edit_cidade"
                name="cidade">

            <input type="hidden"
                id="edit_estado"
                name="estado">

            <div class="form-group">

                <label for="edit_descricao">
                    Descrição:
                </label>

                <textarea id="edit_descricao"
                    name="descricao"
                    required></textarea>

            </div>

            <input type="hidden"
                id="edit_latitude"
                name="latitude">

            <input type="hidden"
                id="edit_longitude"
                name="longitude">

            <div class="form-group">

                <button type="button"
                    onclick="geocodeAddressEdit()">

                    Salvar Alterações

                </button>

            </div>

        </form>

    </div>

</div>


<!-- MODAL EXCLUIR -->
<div id="deleteOrderModal" class="modal">

    <div class="modal-content">

        <span class="close"
            id="closeDeleteOrderModal">
            &times;
        </span>

        <h2>Excluir Pedido</h2>

        <p style="
            color:#64748B;
            margin-bottom:20px;
            line-height:1.6;
        ">
            Tem certeza de que deseja cancelar este pedido?
        </p>

        <form id="deleteOrderForm"
            method="POST"
            action="<?= BASE_URL ?>/routes.php?action=excluirPedido">

            <input type="hidden"
                id="delete_id_pedido"
                name="id_pedido">

            <div style="
                display:flex;
                gap:12px;
            ">

                <button type="submit"
                    style="
                    background:#DC2626;
                    flex:1;
                ">
                    Sim, cancelar
                </button>

                <button type="button"
                    id="cancelDelete"
                    style="
                    background:#E2E8F0;
                    color:#1E293B;
                    flex:1;
                ">
                    Não
                </button>

            </div>

        </form>

    </div>

</div>
<script>

    // =============================
    // ABRIR MODAL NOVO PEDIDO
    // =============================
    document.getElementById('openNewOrderModal')
        .addEventListener('click', function () {

        document.getElementById('newOrderModal')
            .style.display = 'block';
    });


    // =============================
    // FECHAR MODAL NOVO PEDIDO
    // =============================
    document.getElementById('closeNewOrderModal')
        .addEventListener('click', function () {

        document.getElementById('newOrderModal')
            .style.display = 'none';
    });


    // =============================
    // ABRIR MODAL ENVIAR PEDIDOS
    // =============================
    document.getElementById('openSendOrdersModal')
        .addEventListener('click', function () {

        var selectedOrders =
            document.querySelectorAll(
                'input[name="pedido_ids[]"]:checked'
            );

        if (selectedOrders.length === 0) {

            alert('Selecione pelo menos um pedido.');
            return;
        }

        var selectedPedidoIds =
            Array.from(selectedOrders)
            .map(order => order.value)
            .join(',');

        document.getElementById(
            'selected_pedido_ids'
        ).value = selectedPedidoIds;

        document.getElementById(
            'sendOrdersModal'
        ).style.display = 'block';
    });


    // =============================
    // FECHAR MODAL ENVIAR PEDIDOS
    // =============================
    document.getElementById(
        'closeSendOrdersModal'
    ).addEventListener('click', function () {

        document.getElementById(
            'sendOrdersModal'
        ).style.display = 'none';
    });


    // =============================
    // EDITAR PEDIDO
    // =============================
    document.querySelectorAll('.btn-edit')
        .forEach(button => {

        button.addEventListener('click',
            function () {

            const pedidoId =
                this.getAttribute('data-id');

            const card =
                this.closest('.card');

            const nomeCliente =
                card.querySelector('h3')
                .innerText;

            const preco =
                card.querySelector(
                    'p:nth-of-type(1)'
                )
                .innerText
                .replace('Preço:', '')
                .replace('R$', '')
                .trim();

            const endereco =
                card.querySelector(
                    'p:nth-of-type(2)'
                )
                .innerText
                .replace('Endereço:', '')
                .trim();

            const bairro =
                card.querySelector(
                    'p:nth-of-type(3)'
                )
                .innerText
                .replace('Bairro:', '')
                .trim();

            const descricao =
                card.querySelector(
                    'p:nth-of-type(4)'
                )
                .innerText
                .replace('Descrição:', '')
                .trim();

            document.getElementById(
                'edit_id_pedido'
            ).value = pedidoId;

            document.getElementById(
                'edit_nome_cliente'
            ).value = nomeCliente;

            document.getElementById(
                'edit_preco'
            ).value = preco;

            document.getElementById(
                'edit_endereco'
            ).value = endereco;

            document.getElementById(
                'edit_bairro'
            ).value = bairro;

            document.getElementById(
                'edit_descricao'
            ).value = descricao;

            document.getElementById(
                'editOrderModal'
            ).style.display = 'block';
        });
    });


    // =============================
    // FECHAR MODAL EDIÇÃO
    // =============================
    document.getElementById(
        'closeEditOrderModal'
    ).addEventListener('click',
    function () {

        document.getElementById(
            'editOrderModal'
        ).style.display = 'none';
    });


    // =============================
    // EXCLUIR PEDIDO
    // =============================
    document.querySelectorAll('.btn-delete')
        .forEach(button => {

        button.addEventListener(
            'click',
            function () {

            const pedidoId =
                this.getAttribute(
                    'data-id'
                );

            document.getElementById(
                'delete_id_pedido'
            ).value = pedidoId;

            document.getElementById(
                'deleteOrderModal'
            ).style.display = 'block';
        });
    });


    // =============================
    // FECHAR MODAL EXCLUIR
    // =============================
    document.getElementById(
        'closeDeleteOrderModal'
    ).addEventListener('click',
    function () {

        document.getElementById(
            'deleteOrderModal'
        ).style.display = 'none';
    });


    // =============================
    // CANCELAR EXCLUSÃO
    // =============================
    document.getElementById(
        'cancelDelete'
    ).addEventListener('click',
    function () {

        document.getElementById(
            'deleteOrderModal'
        ).style.display = 'none';
    });


    // =============================
    // FECHAR MODAL CLICANDO FORA
    // =============================
    window.addEventListener(
        'click',
        function (event) {

        const modals = [
            'newOrderModal',
            'sendOrdersModal',
            'editOrderModal',
            'deleteOrderModal'
        ];

        modals.forEach(modalId => {

            const modal =
                document.getElementById(
                    modalId
                );

            if (event.target === modal) {

                modal.style.display =
                    'none';
            }
        });
    });


    // =============================
    // MÁSCARA CEP
    // =============================
    function aplicarMascaraCEP(id) {

        const input =
            document.getElementById(id);

        if (!input) return;

        input.addEventListener(
            'input',
            function (e) {

            let value =
                e.target.value
                .replace(/\D/g, '');

            if (value.length > 5) {

                value =
                    value.replace(
                        /^(\d{5})(\d)/,
                        '$1-$2'
                    );
            }

            e.target.value = value;
        });
    }

    aplicarMascaraCEP("cep");
    aplicarMascaraCEP("edit_cep");


    // =============================
    // BUSCA CEP (ViaCEP)
    // =============================
    function buscarCEP(
        cepInputId,
        enderecoId,
        bairroId,
        cidadeId,
        estadoId
    ) {

        const input =
            document.getElementById(
                cepInputId
            );

        if (!input) return;

        input.addEventListener(
            "blur",
            function () {

            let cep =
                this.value.replace(
                    /\D/g,
                    ''
                );

            if (cep.length !== 8) {

                alert(
                    "CEP inválido!"
                );

                return;
            }

            fetch(
                `https://viacep.com.br/ws/${cep}/json/`
            )
            .then(response =>
                response.json()
            )
            .then(data => {

                if (data.erro) {

                    alert(
                        "CEP não encontrado!"
                    );

                    return;
                }

                document.getElementById(
                    enderecoId
                ).value =
                    data.logradouro;

                document.getElementById(
                    bairroId
                ).value =
                    data.bairro;

                document.getElementById(
                    cidadeId
                ).value =
                    data.localidade;

                document.getElementById(
                    estadoId
                ).value =
                    data.uf;
            })

            .catch(error => {

                console.error(
                    "Erro ao buscar CEP:",
                    error
                );
            });
        });
    }


    buscarCEP(
        "cep",
        "endereco",
        "bairro",
        "cidade",
        "estado"
    );

    buscarCEP(
        "edit_cep",
        "edit_endereco",
        "edit_bairro",
        "edit_cidade",
        "edit_estado"
    );


    // =============================
    // GEOCODIFICAÇÃO NOVO PEDIDO
    // =============================
    function geocodeAddress() {

        var endereco =
            document.getElementById(
                'endereco'
            ).value;

        var bairro =
            document.getElementById(
                'bairro'
            ).value;

        var cidade =
            document.getElementById(
                'cidade'
            ).value;

        var estado =
            document.getElementById(
                'estado'
            ).value;

        var address =
            `${endereco}, ${bairro}, ${cidade}, ${estado}, Brasil`;

        var url =
            `https://nominatim.openstreetmap.org/search?q=${encodeURIComponent(address)}&format=json&addressdetails=1&limit=1`;

        fetch(url)
            .then(response =>
                response.json()
            )
            .then(data => {

                if (data.length > 0) {

                    document.getElementById(
                        'latitude'
                    ).value =
                        data[0].lat;

                    document.getElementById(
                        'longitude'
                    ).value =
                        data[0].lon;

                    document.getElementById(
                        'newOrderForm'
                    ).submit();

                } else {

                    alert(
                        'Endereço não encontrado com precisão.'
                    );
                }
            })

            .catch(error =>
                console.error(error)
            );
    }


    // =============================
    // GEOCODIFICAÇÃO EDIÇÃO
    // =============================
    function geocodeAddressEdit() {

        var endereco =
            document.getElementById(
                'edit_endereco'
            ).value;

        var bairro =
            document.getElementById(
                'edit_bairro'
            ).value;

        var cidade =
            document.getElementById(
                'edit_cidade'
            ).value;

        var estado =
            document.getElementById(
                'edit_estado'
            ).value;

        var address =
            `${endereco}, ${bairro}, ${cidade}, ${estado}, Brasil`;

        var url =
            `https://nominatim.openstreetmap.org/search?q=${encodeURIComponent(address)}&format=json&addressdetails=1&limit=1`;

        fetch(url)
            .then(response =>
                response.json()
            )
            .then(data => {

                if (data.length > 0) {

                    document.getElementById(
                        'edit_latitude'
                    ).value =
                        data[0].lat;

                    document.getElementById(
                        'edit_longitude'
                    ).value =
                        data[0].lon;

                    document.getElementById(
                        'editOrderForm'
                    ).submit();

                } else {

                    alert(
                        'Endereço não encontrado com precisão.'
                    );
                }
            })

            .catch(error =>
                console.error(error)
            );
    }

</script>

<script>
         // SIDEBAR MOBILE
    const menuBtn = document.getElementById('hamburger');
    const sidebar = document.getElementById('sidebar');
    const closeSidebar = document.getElementById('closeSidebar');
    const overlay = document.getElementById('overlay');

    menuBtn.addEventListener('click', () => {
        sidebar.classList.add('mobile-open');
        overlay.classList.add('active');
    });

    closeSidebar.addEventListener('click', () => {
        sidebar.classList.remove('mobile-open');
        overlay.classList.remove('active');
    });

    overlay.addEventListener('click', () => {
        sidebar.classList.remove('mobile-open');
        overlay.classList.remove('active');
    });
    </script>


</body>
</html>
</body>
</html>