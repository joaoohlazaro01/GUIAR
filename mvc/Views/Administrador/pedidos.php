<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Pedidos</title>

    <link rel="shortcut icon" type="image/png" href="<?= BASE_URL ?>/img/G.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?= BASE_URL ?>/style/sidebar.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">


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
    margin-left: 288px;
    padding: 30px;
}

.main > header {
    margin: -30px -30px 30px;
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

    .main > header {
        margin: -20px -20px 20px;
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

/* Lista de pedidos em tabela */
.main > form#sendOrdersForm {
    min-width: 0;
}

#sendOrdersForm .container {
    display: block;
    width: 100%;
    max-width: none;
    padding-bottom: 150px;
}

.orders-results {
    width: 100%;
    min-width: 0;
    overflow: hidden;
    border: 1px solid #edf0f6;
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
    border-bottom: 1px solid #edf0f6;
}

.orders-list-title {
    color: #172b4d;
    font-size: 14px;
    font-weight: 800;
}

.orders-count {
    padding: 5px 10px;
    border-radius: 999px;
    background: #fff0f3;
    color: #e91e42;
    font-size: 11px;
    font-weight: 700;
    white-space: nowrap;
}

.orders-table-wrap {
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}

.orders-table {
    width: 100%;
    border-collapse: collapse;
    text-align: left;
}

.orders-table thead {
    background: #f8fafc;
    color: #8290a7;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: .045em;
    text-transform: uppercase;
}

.orders-table th {
    padding: 12px 14px;
    white-space: nowrap;
}

.orders-table th:first-child,
.orders-table td:first-child { padding-left: 20px; }

.orders-table th:last-child,
.orders-table td:last-child { padding-right: 20px; }

.order-row {
    border-bottom: 1px solid #edf0f6;
    border-left: 3px solid #f3243e;
    transition: background-color .18s ease;
}

.order-row:last-child { border-bottom: 0; }
.order-row:hover { background: #fafbfe; }

.orders-table td {
    min-width: 0;
    padding: 15px 14px;
    color: #263957;
    font-size: 12px;
    vertical-align: middle;
}

.order-id-cell {
    display: flex;
    align-items: center;
    gap: 9px;
    color: #172b4d;
    font-size: 12px;
    font-weight: 800;
    white-space: nowrap;
}

.order-id-cell input {
    width: 15px;
    height: 15px;
    margin: 0;
    accent-color: #e91e42;
}

.order-client {
    color: #172b4d;
    font-size: 12px;
    font-weight: 800;
    overflow-wrap: anywhere;
}

.order-address,
.order-description,
.order-delivery {
    color: #263957;
    font-size: 12px;
    font-weight: 700;
    overflow-wrap: anywhere;
}

.order-description {
    display: block;
    max-width: 260px;
    color: #52627c;
    font-weight: 400;
    line-height: 1.5;
}

.order-secondary {
    display: block;
    margin-top: 3px;
    color: #8793a9;
    font-size: 10px;
    font-weight: 400;
    line-height: 1.4;
    overflow-wrap: anywhere;
}

.order-price {
    color: #263957;
    font-size: 12px;
    font-weight: 700;
    white-space: nowrap;
}

.order-status {
    display: inline-flex;
    align-items: center;
    width: fit-content;
    gap: 5px;
    padding: 5px 9px;
    border-radius: 999px;
    background: #fff0f3;
    color: #e91e42;
    font-size: 10px;
    font-weight: 700;
    white-space: nowrap;
}

.order-status::before {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: currentColor;
    content: "";
}

.order-actions {
    display: flex;
    align-items: center;
    gap: 6px;
}

.order-actions .btn-edit,
.order-actions .btn-delete {
    flex: 0 0 auto;
    min-height: 32px;
    padding: 6px 10px;
    border: 1px solid #edf0f6;
    border-radius: 8px;
    font-size: 11px;
    font-weight: 700;
}

.order-actions .btn-edit {
    background: #f8fafc;
    color: #52627c;
}

.order-actions .btn-delete {
    background: #fff1f3;
    color: #d91d39;
}

.orders-empty {
    padding: 34px 20px !important;
    color: #8793a9 !important;
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
    .orders-table thead { display: none; }
    .orders-table,
    .orders-table tbody { display: block; }
    .orders-table tbody .order-row {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 0 12px;
        padding: 8px 14px;
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
        color: #8793a9;
        font-size: 9px;
        font-weight: 700;
        letter-spacing: .04em;
        text-transform: uppercase;
        content: attr(data-label);
    }
    .orders-table td.order-id-column {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        justify-content: center;
        gap: 4px;
    }
    .orders-table td.order-id-column::before { margin-bottom: 0; }
    .orders-table td.order-actions-column { grid-column: 1 / -1; }
    .order-actions { flex-wrap: wrap; }
}

@media (max-width: 480px) {
    .orders-list-heading { padding: 13px 12px; }
    .orders-list-title { font-size: 13px; }
    .orders-table tbody .order-row { gap: 0 8px; padding: 8px 10px; }
    .orders-table td,
    .orders-table td:first-child,
    .orders-table td:last-child { padding: 8px 3px; }
    .orders-table td.order-actions-column { grid-column: 1 / -1; }
}

.orders-topbar {
    min-height: 74px;
    padding: 14px clamp(16px, 2.4vw, 36px);
}

.orders-topbar-title {
    display: flex;
    align-items: center;
    gap: 14px;
    min-width: 0;
}

.orders-topbar-icon {
    display: flex;
    width: 28px;
    height: 32px;
    flex: 0 0 auto;
    align-items: center;
    justify-content: center;
    color: #f3243e;
}

.orders-topbar-copy { min-width: 0; }
.orders-topbar-copy .page-heading { margin: 0; }
.orders-topbar-copy .page-subheading { margin-top: 3px; }

.orders-topbar-action {
    display: inline-flex;
    min-height: 38px;
    flex: 0 0 auto;
    align-items: center;
    justify-content: center;
    gap: 7px;
    padding: 9px 16px;
    border: 0;
    border-radius: 11px;
    background: #f3243e;
    box-shadow: 0 6px 16px rgba(243, 36, 62, .2);
    color: #fff;
    font-size: 12px;
    font-weight: 700;
    white-space: nowrap;
    transition: background-color .18s ease, transform .18s ease;
}

.orders-topbar-action:hover {
    background: #d91d39;
    transform: translateY(-1px);
}

.orders-topbar-action svg { width: 15px; height: 15px; }

@media (max-width: 640px) {
    .orders-topbar {
        padding: 12px 14px;
    }

    .orders-topbar-title { gap: 9px; }
    .orders-topbar-icon { width: 24px; }
    .orders-topbar-copy .page-heading { font-size: 18px; }
    .orders-topbar-copy .page-subheading { font-size: 10px; }
    .orders-topbar-action { min-height: 36px; gap: 5px; padding: 8px 10px; font-size: 11px; }
}
    </style>
</head>

<body class="sidebar-page">

    <!-- OVERLAY MOBILE -->
        <div id="overlay"
            class="hidden fixed inset-0 bg-black/40 z-30 md:hidden">
        </div>

        <!-- SIDEBAR -->
         <?php
$nomeAdmin = $_SESSION['nome_usuario'] ?? ($admin["nome_adm"] ?? "Admin");
?>
        <aside id="sidebar"
    class="w-72 bg-[#ffff] flex flex-col fixed top-0 left-0 text-white z-40 transition-all rounded-none overflow-hidden h-screen">

    <div class="flex flex-col h-full">

        <!-- BOTÃO FECHAR MOBILE -->
        <button id="closeSidebar"
            class="absolute top-5 right-5 md:hidden text-white text-2xl z-50">

            ✕
        </button>

        <!-- LOGO -->
        <div class="p-8 mb-4 flex justify-center">
            <img src="<?= htmlspecialchars($logoEmpresaSidebar, ENT_QUOTES, 'UTF-8') ?>"
                alt="Logo da empresa"
                class="w-32 h-auto object-contain">
        </div>

        <!-- MENU -->
        <nav class="sidebar-menu px-4 space-y-2 flex-grow">

            <!-- INÍCIO -->
            <a href="<?= BASE_URL ?>/routes.php?action=dashboardAdm"
                 class="menu-item flex items-center gap-3.5 px-5 py-3 rounded-xl font-semibold text-sm text-slate-400 hover:text-black hover:bg-white/5 transition-all">

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
            class="menu-item active flex items-center gap-3.5 px-5 py-3 rounded-xl font-bold text-sm bg-[#4F46E5] text-black shadow-lg shadow-indigo-500/10 transition-all">
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
                class="menu-item flex items-center gap-3.5 px-5 py-3 rounded-xl font-semibold text-sm text-slate-400 hover:text-black hover:bg-white/5 transition-all">


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
                class="menu-item flex items-center gap-3.5 px-5 py-3 rounded-xl font-semibold text-sm text-slate-400 hover:text-black hover:bg-white/5 transition-all">

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
                class="menu-item flex items-center gap-3.5 px-5 py-3 rounded-xl font-semibold text-sm text-slate-400 hover:text-black hover:bg-white/5 transition-all">

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
                class="menu-item flex items-center gap-3.5 px-5 py-3 rounded-xl font-semibold text-sm text-slate-400 hover:text-black hover:bg-white/5 transition-all">

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
            <div class="px-4 pb-4 flex flex-col items-center gap-1.5">
                <img src="<?= BASE_URL ?>/img/LogoPreto.png"
                    alt="GUIAR"
                    class="w-24 h-auto object-contain">
                <p class="text-[10px] text-slate-400 text-center leading-tight">
                    Conectando você ao seu destino.
                </p>
            </div>

            <div class="admin-user-card flex items-center gap-3.5 p-3 rounded-2xl bg-white/5 border border-white/5">

                <?php if (!empty($adminFotoUrl)): ?>
                    <img src="<?= htmlspecialchars($adminFotoUrl, ENT_QUOTES, 'UTF-8') ?>"
                        alt="Foto de <?= htmlspecialchars($nomeAdmin, ENT_QUOTES, 'UTF-8') ?>"
                        class="w-10 h-10 rounded-full object-cover shadow-lg">
                <?php else: ?>
                    <div class="admin-user-avatar w-10 h-10 rounded-full bg-[#FFD400] text-[#0B0D2F] font-black text-sm flex items-center justify-center shadow-lg">
                        <?= strtoupper(substr($nomeAdmin, 0, 2)) ?>
                    </div>
                <?php endif; ?>

                <div class="flex-grow min-w-0">

                    <p class="admin-user-name font-bold text-xs text-black truncate">
                        <?= htmlspecialchars($nomeAdmin) ?>
                    </p>

                    <p class="admin-user-role text-[10px] text-slate-500 font-bold tracking-wider uppercase">
                        Admin
                    </p>
                </div>

                <!-- LOGOUT -->
                <button type="button" data-logout-trigger aria-label="Sair da conta"
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
                </button>
            </div>
        </div>
    </div>
</aside>
<?php require __DIR__ . '/partials/logout-confirmation.php'; ?>
    <div class="main">

        <!-- HEADER DA PÁGINA (Com campo de busca, sino e logout) -->
        <header class="orders-topbar bg-white border-b border-[#E2E8F0] flex items-center justify-between sticky top-0 z-30 shadow-sm gap-4">
            <div class="orders-topbar-title">
                <button id="hamburger" class="md:hidden p-2 rounded-lg bg-slate-50 hover:bg-slate-100 border border-slate-200 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <span class="orders-topbar-icon" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 11V7a4 4 0 0 0-8 0v4M5 9h14l1 12H4L5 9Z" />
                    </svg>
                </span>
                <div class="orders-topbar-copy">
                    <h1 class="page-heading">
                        Gestão de Pedidos
                    </h1>
                    <p class="page-subheading">Aqui está o status das suas entregas hoje.</p>
                </div>
            </div>
            <button type="button" id="openNewOrderModal" class="orders-topbar-action">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.4" d="M12 5v14m-7-7h14" />
                </svg>
                Novo Pedido
            </button>
        </header>

        <form id="sendOrdersForm"
              method="POST"
              action="<?= BASE_URL ?>/routes.php?action=enviarPedidos">

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
                                <th>Descrição</th>
                                <th>Entregador</th>
                                <th>Valor</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($result)): ?>
                                <?php foreach ($result as $row): ?>
                                    <tr class="order-row" data-price="<?= htmlspecialchars((string) $row['preco'], ENT_QUOTES, 'UTF-8') ?>">
                                        <td class="order-id-column" data-label="Pedido">
                                            <span class="order-id-cell">
                                                <input type="checkbox" name="pedido_ids[]" value="<?= htmlspecialchars($row["id_pedido"]) ?>">
                                                #<?= htmlspecialchars($row["id_pedido"]) ?>
                                            </span>
                                        </td>
                                        <td data-label="Cliente">
                                            <h3 class="order-client"><?= htmlspecialchars($row["nome_cliente"]) ?></h3>
                                        </td>
                                        <td data-label="Endereço">
                                            <span class="order-address"><?= htmlspecialchars($row["endereco"]) ?></span>
                                            <span class="order-secondary"><?= htmlspecialchars($row["bairro"]) ?></span>
                                        </td>
                                        <td data-label="Descrição">
                                            <span class="order-description"><?= htmlspecialchars($row["descricao"]) ?></span>
                                        </td>
                                        <td data-label="Entregador">
                                            <span class="order-delivery"><?= !empty($row["nome_entregador"]) ? htmlspecialchars($row["nome_entregador"]) : 'Não atribuído' ?></span>
                                        </td>
                                        <td data-label="Valor">
                                            <span class="order-price">R$ <?= number_format((float) $row["preco"], 2, ',', '.') ?></span>
                                        </td>
                                        <td data-label="Status">
                                            <span class="order-status"><?= htmlspecialchars($row["status"]) ?></span>
                                        </td>
                                        <td class="order-actions-column" data-label="Ações">
                                            <div class="order-actions">
                                                <button type="button" class="btn-edit" data-id="<?= htmlspecialchars($row["id_pedido"]) ?>">Editar</button>
                                                <button type="button" class="btn-delete" data-id="<?= htmlspecialchars($row["id_pedido"]) ?>">Excluir</button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td class="orders-empty" colspan="8">Nenhum pedido encontrado</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </section>

<!-- BOTÕES FIXOS -->
<div class="fixed-buttons">

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

            
<!-- MAPA PARA ESCOLHER A LOCALIZAÇÃO -->
<div class="form-group">
    <label>Localização do cliente:</label>

    <p id="mapStatus">
        Arraste o marcador até o local desejado ou informe o CEP.
    </p>

    <div id="mapaNovoPedido"
         style="width: 100%;
                height: 280px;
                border-radius: 10px;
                display: block;">
    </div>

    <button type="button"
            id="confirmarLocalizacao"
            style="margin-top: 10px;">
        Confirmar localização
    </button>
</div>


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

            const orderRow =
                this.closest('.order-row');

            const nomeCliente =
                orderRow.querySelector('.order-client')
                .innerText;

            const preco =
                orderRow.dataset.price;

            const endereco =
                orderRow.querySelector('.order-address')
                .innerText;

            const bairro =
                orderRow.querySelector('.order-secondary')
                .innerText;

            const descricao =
                orderRow.querySelector('.order-description')
                .innerText;

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

    <?php
    $logoEmpresaDashboard = '';
    if (isset($empresa['nome_arquivo'])) {
        $logoEmpresaDashboard = BASE_URL . '/public/uploads/empresas/' . htmlspecialchars($empresa['nome_arquivo']);
    } elseif (isset($company_id) && isset($this->empresaModel)) {
        $empresaInfo = $this->empresaModel->getById($company_id);
        if (!empty($empresaInfo['nome_arquivo'])) {
            $logoEmpresaDashboard = BASE_URL . '/public/uploads/empresas/' . htmlspecialchars($empresaInfo['nome_arquivo']);
        }
    } elseif (isset($_SESSION['company_id']) && isset($pdo)) {
        try {
            $stmtLogo = $pdo->prepare("SELECT nome_arquivo FROM empresa WHERE id_empresa = :id");
            $stmtLogo->execute([':id' => $_SESSION['company_id']]);
            $arqLogo = $stmtLogo->fetchColumn();
            if ($arqLogo) {
                $logoEmpresaDashboard = BASE_URL . '/public/uploads/empresas/' . htmlspecialchars($arqLogo);
            }
        } catch (\Exception $e) {}
    }
    ?>
    <script>
        window.GUIAR_EMPRESA_LOGO = <?= json_encode($logoEmpresaDashboard) ?>;
    </script>
    <script src="<?= BASE_URL ?>/public/js/empresa-palette.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>


<script>
let mapaNovoPedido;
let marcadorNovoPedido;
let localizacaoConfirmada = false;
let consultaAtual = 0;
let temporizadorEndereco;

// Centro inicial próximo à região de Mogi Guaçu
const LAT_INICIAL = -22.3674;
const LNG_INICIAL = -46.9428;

// Formatar CEP como 00000-000
function formatarCEP(cep) {
    const numeros = (cep || '').replace(/\D/g, '');

    if (numeros.length !== 8) return '';

    return numeros.replace(/^(\d{5})(\d{3})$/, '$1-$2');
}

// Atualizar campos do endereço
function preencherEndereco(endereco) {
    const rua =
        endereco.road ||
        endereco.pedestrian ||
        endereco.residential ||
        endereco.footway ||
        '';

    const bairro =
        endereco.suburb ||
        endereco.neighbourhood ||
        endereco.quarter ||
        endereco.city_district ||
        '';

    const cidade =
        endereco.city ||
        endereco.town ||
        endereco.village ||
        endereco.municipality ||
        '';

    document.getElementById('endereco').value = rua;
    document.getElementById('bairro').value = bairro;
    document.getElementById('cidade').value = cidade;
    document.getElementById('estado').value =
        endereco.state || '';

    document.getElementById('cep').value =
        formatarCEP(endereco.postcode);
}

// Salvar as coordenadas selecionadas
function atualizarCoordenadas(lat, lng) {
    document.getElementById('latitude').value =
        Number(lat).toFixed(7);

    document.getElementById('longitude').value =
        Number(lng).toFixed(7);
}

// Inicializar mapa imediatamente
function iniciarMapaPedido() {
    mapaNovoPedido = L.map('mapaNovoPedido').setView(
        [LAT_INICIAL, LNG_INICIAL],
        14
    );

    L.tileLayer(
        'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
        {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap'
        }
    ).addTo(mapaNovoPedido);

    marcadorNovoPedido = L.marker(
        [LAT_INICIAL, LNG_INICIAL],
        { draggable: true }
    ).addTo(mapaNovoPedido);

    // Ao arrastar, buscar endereço e CEP das coordenadas
    marcadorNovoPedido.on('dragend', async function () {
        const posicao = marcadorNovoPedido.getLatLng();
        const numeroConsulta = ++consultaAtual;

        localizacaoConfirmada = false;

        atualizarCoordenadas(posicao.lat, posicao.lng);

        document.getElementById('mapStatus').textContent =
            'Buscando endereço e CEP da localização...';

        try {
            const url = new URL(
                'https://nominatim.openstreetmap.org/reverse'
            );

            url.search = new URLSearchParams({
                lat: posicao.lat,
                lon: posicao.lng,
                format: 'jsonv2',
                addressdetails: '1',
                zoom: '18'
            });

            const resposta = await fetch(url);

            if (!resposta.ok) {
                throw new Error('Falha na busca do endereço.');
            }

            const dados = await resposta.json();

            if (numeroConsulta !== consultaAtual) return;

            if (!dados.address) {
                throw new Error('Endereço não encontrado.');
            }

            preencherEndereco(dados.address);

            document.getElementById('mapStatus').textContent =
                'Endereço atualizado. Confira os dados e clique ' +
                'em Confirmar localização.';

        } catch (erro) {
            if (numeroConsulta !== consultaAtual) return;

            console.error(erro);

            document.getElementById('mapStatus').textContent =
                'Não foi possível identificar o endereço ou CEP. ' +
                'Você pode preencher o CEP manualmente e tentar novamente.';
        }
    });

    // Ajustar mapa se o modal estiver inicialmente oculto
    document.getElementById('newOrderModal')
        .addEventListener('transitionend', function () {
            mapaNovoPedido.invalidateSize();
        });
}

// Pesquisar endereço quando o CEP for informado
document.getElementById('cep').addEventListener('blur', async function () {
    const cep = this.value.replace(/\D/g, '');

    if (cep.length !== 8) return;

    const numeroConsulta = ++consultaAtual;

    localizacaoConfirmada = false;

    document.getElementById('mapStatus').textContent =
        'Consultando CEP...';

    try {
        const resposta = await fetch(
            `https://viacep.com.br/ws/${cep}/json/`
        );

        if (!resposta.ok) {
            throw new Error('Erro na consulta do CEP.');
        }

        const dados = await resposta.json();

        if (numeroConsulta !== consultaAtual) return;

        if (dados.erro) {
            document.getElementById('mapStatus').textContent =
                'CEP não encontrado. Confira o número informado.';
            return;
        }

        document.getElementById('endereco').value =
            dados.logradouro || '';

        document.getElementById('bairro').value =
            dados.bairro || '';

        document.getElementById('cidade').value =
            dados.localidade || '';

        document.getElementById('estado').value =
            dados.uf || '';

        const endereco = [
            dados.logradouro,
            dados.bairro,
            dados.localidade,
            dados.uf,
            'Brasil'
        ].filter(Boolean).join(', ');

        document.getElementById('mapStatus').textContent =
            'Buscando localização aproximada do CEP...';

        const url = new URL(
            'https://nominatim.openstreetmap.org/search'
        );

        url.search = new URLSearchParams({
            q: endereco,
            format: 'jsonv2',
            limit: '1',
            countrycodes: 'br'
        });

        const respostaMapa = await fetch(url);

        if (!respostaMapa.ok) {
            throw new Error('Falha ao localizar o endereço.');
        }

        const resultados = await respostaMapa.json();

        if (numeroConsulta !== consultaAtual) return;

        if (!resultados.length) {
            document.getElementById('mapStatus').textContent =
                'CEP encontrado, mas não foi possível localizar ' +
                'o ponto no mapa. Arraste o marcador manualmente.';
            return;
        }

        const lat = Number(resultados[0].lat);
        const lng = Number(resultados[0].lon);

        marcadorNovoPedido.setLatLng([lat, lng]);
        mapaNovoPedido.setView([lat, lng], 17);

        atualizarCoordenadas(lat, lng);

        document.getElementById('mapStatus').textContent =
            'Localização aproximada encontrada. Ajuste o marcador ' +
            'e confirme.';

    } catch (erro) {
        if (numeroConsulta !== consultaAtual) return;

        console.error(erro);

        document.getElementById('mapStatus').textContent =
            'Erro ao consultar o endereço. Você pode escolher ' +
            'a localização arrastando o marcador.';
    }
});

// Confirmar localização escolhida
document.getElementById('confirmarLocalizacao')
    .addEventListener('click', function () {
        const posicao = marcadorNovoPedido.getLatLng();

        atualizarCoordenadas(posicao.lat, posicao.lng);
        localizacaoConfirmada = true;

        document.getElementById('mapStatus').textContent =
            'Localização confirmada! CEP: ' +
            (document.getElementById('cep').value || 'não identificado') +
            ' | Coordenadas: ' +
            posicao.lat.toFixed(6) + ', ' +
            posicao.lng.toFixed(6);
    });

// Salvar pedido
window.geocodeAddress = function () {
    if (!localizacaoConfirmada) {
        alert(
            'Escolha a localização no mapa e clique em ' +
            '"Confirmar localização" antes de salvar.'
        );
        return;
    }

    document.getElementById('newOrderForm').requestSubmit();
};

// Criar mapa quando o HTML estiver pronto
iniciarMapaPedido();
</script>

</body>
</html>
