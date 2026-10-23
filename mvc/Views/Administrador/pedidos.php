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

    <style>
        .sidebar-page {
            background:
                radial-gradient(ellipse at 60% -10%, rgba(255, 255, 255, .98), transparent 48%),
                #f1f4fa !important;
            overflow-x: hidden;
        }

        @media (max-width: 768px) {
            #sidebar {
                transform: translateX(-100%);
                transition: transform .3s ease;
                border-radius: 0 !important;
                top: 0 !important;
                left: 0 !important;
                margin: 0 !important;
                height: 100vh !important;
                width: 280px !important;
            }
            #sidebar.mobile-open { transform: translateX(0); }
            #overlay.active { display: block; }
            #hamburger { display: flex !important; flex: 0 0 auto; }
            .orders-main { margin-left: 0 !important; }
            #closeSidebar { color: #475569; }
        }

        .orders-main {
            min-width: 0;
            width: 100%;
            min-height: 100vh;
        }
        [hidden] { display: none !important; }
        .orders-header {
            min-height: clamp(64px, 8vh, 84px);
            padding: 12px clamp(14px, 2.4vw, 36px);
            background:
                radial-gradient(ellipse at 65% -125%, rgba(226, 218, 238, .62), transparent 48%),
                rgba(255, 255, 255, .72);
            border: 0;
        }
        .orders-page-title {
            color: #172b4d;
            font-size: clamp(16px, 1.35vw, 21px);
            font-weight: 800;
            letter-spacing: -.035em;
        }
        .orders-page-icon { color: var(--emp-primary, #f3243e); }
        .orders-page-subtitle {
            margin-top: 2px;
            color: #8390a8;
            font-size: clamp(10px, .72vw, 12px);
            line-height: 1.45;
        }
        .orders-content {
            width: 100%;
            max-width: 1760px;
            margin: 0 auto;
            padding: clamp(12px, 1.8vw, 28px) clamp(12px, 2vw, 36px) 96px;
        }
        .orders-results {
            width: 100%;
            min-width: 0;
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
        .orders-list-title { color: #172b4d; font-size: 14px; font-weight: 800; }
        .orders-count {
            padding: 5px 10px;
            border-radius: 999px;
            background: var(--emp-primary-light, #eef2ff);
            color: var(--emp-primary, #4f46e5);
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }
        .container {
            display: grid;
            grid-template-columns: minmax(0, 1fr);
            gap: 0;
            padding: 0;
            min-width: 0;
        }
        .card {
            position: relative;
            display: grid;
            grid-template-columns: minmax(125px, 1fr) minmax(90px, .7fr) minmax(160px, 1.4fr) minmax(125px, 1fr) minmax(125px, 1fr) minmax(155px, 1.2fr);
            align-items: center;
            gap: 8px 14px;
            min-width: 0;
            padding: 16px 20px;
            border: 0;
            border-bottom: 1px solid #edf0f6;
            border-left: 3px solid var(--emp-primary, #f3243e);
            border-radius: 0;
            background: #fff;
            box-shadow: none;
            transition: background-color .18s ease;
        }
        .card:last-child { border-bottom: 0; }
        .card:hover { background: #fafbfe; }
        .card input[type="checkbox"] {
            position: absolute;
            top: 13px;
            left: 12px;
            width: 16px;
            height: 16px;
            accent-color: var(--emp-primary, #f3243e);
        }
        .card h3 {
            min-width: 0;
            grid-column: 1;
            grid-row: 1;
            margin: 0;
            padding-left: 16px;
            color: #172b4d;
            font-size: 13px;
            font-weight: 800;
            overflow-wrap: anywhere;
        }
        .card p {
            min-width: 0;
            margin: 0;
            color: #8793a9;
            font-size: 11px;
            line-height: 1.45;
            overflow-wrap: anywhere;
        }
        .card strong { color: #52627c; }
        .card p:nth-of-type(1) {
            grid-column: 2;
            grid-row: 1;
            color: #263957;
            font-weight: 700;
            white-space: nowrap;
        }
        .card p:nth-of-type(2) { grid-column: 3; grid-row: 1; }
        .card p:nth-of-type(3) { grid-column: 3; grid-row: 2; }
        .card p:nth-of-type(4) { grid-column: 4; grid-row: 1 / span 2; }
        .card p:nth-of-type(5) { grid-column: 5; grid-row: 1; }
        .card p:nth-of-type(6) { grid-column: 5; grid-row: 2; }
        .status { color: var(--emp-primary, #f3243e) !important; font-weight: 700; }
        .card-actions {
            grid-column: 6;
            grid-row: 1 / span 2;
            display: flex;
            gap: 7px;
            margin: 0;
        }
        .btn-edit,
        .btn-delete {
            flex: 1;
            border: 0;
            padding: 8px 10px;
            border-radius: 9px;
            cursor: pointer;
            transition: .18s ease;
            font-size: 11px;
            font-weight: 700;
        }
        .btn-edit { background: #f1f5f9; color: #334155; }
        .btn-delete { background: #fef2f2; color: #dc2626; }
        .btn-edit:hover,
        .btn-delete:hover { transform: translateY(-1px); }
        .orders-empty-state {
            min-height: 280px;
            padding: 25px 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #8793a9;
            font-size: 13px;
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
            border: 0;
            padding: clamp(10px, .9vw, 14px) clamp(14px, 1.4vw, 22px);
            border-radius: 12px;
            background: var(--emp-secondary, #fc8835);
            color: var(--emp-secondary-contrast, #fff);
            font-size: clamp(11px, .9vw, 13px);
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 8px 24px var(--emp-secondary-light, rgba(252, 136, 53, .2));
            transition: .18s ease;
        }
        .fixed-buttons button:hover { background: var(--emp-secondary-hover, #e06c00); }

        .modal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, .48);
            backdrop-filter: blur(5px);
            z-index: 1000;
            overflow-y: auto;
            padding: 16px 0;
        }
        .modal-content {
            width: min(90%, 550px);
            max-height: calc(100vh - 32px);
            max-height: calc(100dvh - 32px);
            overflow-y: auto;
            margin: 0 auto;
            padding: 26px;
            border: 1px solid #edf0f6;
            border-radius: 20px;
            background: #fff;
            box-shadow: 0 25px 50px rgba(20, 38, 68, .15);
        }
        .modal-content h2 { margin-bottom: 22px; color: #172b4d; font-size: 20px; font-weight: 800; }
        .close { float: right; color: #64748b; font-size: 28px; cursor: pointer; }
        .form-group { margin-bottom: 16px; }
        .form-group label {
            display: block;
            margin-bottom: 7px;
            color: #334155;
            font-size: 13px;
            font-weight: 700;
        }
        .form-group input,
        .form-group textarea,
        .form-group select,
        select {
            width: 100%;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 11px 12px;
            outline: none;
            transition: .2s;
        }
        .form-group input:focus,
        .form-group textarea:focus,
        select:focus {
            border-color: var(--emp-primary, #fc8835);
            box-shadow: 0 0 0 3px var(--emp-primary-ring, rgba(105, 132, 178, .09));
        }
        .form-group button,
        #sendOrdersToDeliveryForm > button {
            width: 100%;
            border: 0;
            border-radius: 10px;
            padding: 13px;
            background: var(--emp-secondary, #fc8835);
            color: var(--emp-secondary-contrast, #fff);
            font-weight: 700;
            cursor: pointer;
        }

        @media (min-width: 1101px) and (max-width: 1250px) {
            .orders-content { padding-right: 16px; padding-left: 16px; }
            .card {
                grid-template-columns: repeat(3, minmax(0, 1fr));
                gap: 10px;
                padding-right: 14px;
                padding-left: 14px;
            }
            .card h3,
            .card-actions { grid-column: auto; grid-row: auto; }
            .card p:nth-of-type(n) { grid-column: auto; grid-row: auto; }
            .card-actions { grid-column: 3; }
        }
        @media (min-width: 769px) and (max-width: 1100px) {
            .orders-content { padding-right: 16px; padding-left: 16px; }
            .card {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 10px 14px;
                padding-right: 16px;
                padding-left: 16px;
            }
            .card h3,
            .card-actions { grid-column: auto; grid-row: auto; }
            .card p:nth-of-type(n) { grid-column: auto; grid-row: auto; }
            .card-actions { grid-column: 1 / -1; }
            .orders-content { padding-bottom: 150px; }
            .fixed-buttons {
                right: 16px;
                bottom: max(16px, env(safe-area-inset-bottom));
                flex-direction: column;
                align-items: stretch;
                width: min(290px, calc(100vw - 32px));
            }
            .fixed-buttons button { min-height: 44px; width: 100%; }
        }
        @media (max-width: 768px) {
            .container { grid-template-columns: 1fr; }
            .card {
                grid-template-columns: minmax(0, 1fr);
                gap: 12px;
                padding: 15px 14px;
            }
            .card h3 {
                grid-column: 1;
                grid-row: auto;
                padding: 0 24px 0 22px;
                overflow-wrap: anywhere;
            }
            .card p:nth-of-type(n) {
                grid-column: 1;
                grid-row: auto;
                white-space: normal;
            }
            .card-actions {
                grid-column: 1;
                grid-row: auto;
                width: 100%;
                margin-top: 2px;
            }
            .orders-list-heading { padding: 13px 14px; }
            .orders-empty-state { min-height: 260px; }
            .orders-content { padding-bottom: 150px; }
            .fixed-buttons {
                right: 12px;
                bottom: max(12px, env(safe-area-inset-bottom));
                left: auto;
                flex-direction: column;
                align-items: stretch;
                width: min(290px, calc(100vw - 24px));
            }
            .fixed-buttons button {
                min-height: 44px;
                width: 100%;
            }
            .modal { padding: 12px 0; }
            .modal-content {
                width: calc(100% - 24px);
                max-height: calc(100vh - 24px);
                max-height: calc(100dvh - 24px);
                padding: 20px 16px;
                border-radius: 16px;
            }
        }
        @media (max-width: 480px) {
            .orders-header {
                display: grid;
                grid-template-columns: 34px minmax(0, 1fr) auto;
                align-items: center;
                gap: 8px;
                padding: 12px;
            }
            .orders-header > #hamburger { width: 32px; height: 32px; }
            .orders-header > .orders-title-group { min-width: 0; gap: 6px; }
            .orders-header > .orders-title-group > span { width: 22px; height: 28px; }
            .orders-header > .orders-title-group > span svg { width: 17px; height: 17px; }
            .orders-header > .orders-date { min-width: 0; gap: 5px; padding: 5px 7px; }
            .orders-header > .orders-date svg { width: 28px; height: 28px; }
            .orders-header > .orders-date span { white-space: nowrap; }
            .orders-header > .orders-date span span:first-child { font-size: 9px; }
            .orders-header > .orders-date time { font-size: 8px; }
            .orders-page-title { font-size: clamp(14px, 4vw, 16px); line-height: 1.2; }
            .orders-page-subtitle { max-width: 100%; font-size: clamp(9px, 2.8vw, 10px); line-height: 1.35; }
            .orders-content { padding: 12px 10px 150px; }
            .orders-list-heading { padding: 13px 12px; }
            .orders-list-title { font-size: 13px; }
            .card { padding: 16px 12px; }
            .fixed-buttons {
                right: 10px;
                bottom: max(10px, env(safe-area-inset-bottom));
                width: min(290px, calc(100vw - 20px));
            }
            .fixed-buttons button { padding: 10px 8px; font-size: 10px; }
        }
        @media (max-width: 360px) {
            .orders-header { grid-template-columns: 30px minmax(0, 1fr) auto; gap: 5px; padding: 10px 8px; }
            .orders-header > #hamburger { width: 30px; height: 30px; }
            .orders-header > .orders-title-group { gap: 4px; }
            .orders-header > .orders-date { gap: 3px; padding: 4px 5px; }
            .orders-header > .orders-date svg { width: 24px; height: 24px; }
            .orders-page-subtitle { font-size: 9px; }
            .card { grid-template-columns: minmax(0, 1fr); }
            .card h3,
            .card p,
            .card-actions { grid-column: 1; }
            .card-actions { grid-row: auto; }
        }
    </style>
</head>

<body class="sidebar-page bg-[#F3F4F6] text-gray-800 antialiased min-h-screen">

    <div class="flex min-h-screen relative">

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
            <img src="<?= BASE_URL ?>/img/LogoPreto.png"
                alt="Logo GUIAR"
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
                class="menu-item flex items-center gap-3.5 px-5 py-3 rounded-xl font-semibold text-sm text-slate-400 hover:text-black hover:bg-white/5 transition-all">
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

                <div class="admin-user-avatar w-10 h-10 rounded-full bg-[#FFD400] text-[#0B0D2F] font-black text-sm flex items-center justify-center shadow-lg">
                    <?= strtoupper(substr($nomeAdmin, 0, 2)) ?>
                </div>

                <div class="flex-grow min-w-0">

                    <p class="admin-user-name font-bold text-xs text-black truncate">
                        <?= htmlspecialchars($nomeAdmin) ?>
                    </p>

                    <p class="admin-user-role text-[10px] text-slate-500 font-bold tracking-wider uppercase">
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
        <main class="orders-main flex-1 flex flex-col min-h-screen w-full md:ml-72">

        <header class="orders-header backdrop-blur-md flex items-center gap-3 sticky top-0 z-10">
                <button id="hamburger"
                    class="md:hidden flex items-center justify-center w-9 h-9 rounded-xl bg-white shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <div class="orders-title-group flex min-w-0 flex-1 items-center gap-3">
                    <span class="orders-page-icon flex h-8 w-8 shrink-0 items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </span>
                    <div class="min-w-0">
                    <h1 class="orders-page-title">
                        Gestão de Pedidos
                    </h1>
                    <p class="orders-page-subtitle">Gerencie os pedidos e acompanhe o status das entregas.</p>
                    </div>
                </div>
                <div class="orders-date flex shrink-0 items-center gap-2 rounded-xl border border-slate-100 bg-white/90 px-2.5 py-1.5 text-slate-500 shadow-sm" aria-label="Data atual">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 2v4m8-4v4M3 10h18M5 4h14a2 2 0 012 2v13a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2z" />
                    </svg>
                    <span class="leading-tight"><span class="block text-[8px] font-bold text-slate-700">Hoje</span><time id="todayDate" class="block text-[7px]"></time></span>
                </div>
        </header>

        <form id="sendOrdersForm"
              method="POST"
              action="<?= BASE_URL ?>/routes.php?action=enviarPedidos">

            <div class="orders-content flex flex-1 flex-col">
                <section class="orders-results" aria-live="polite">
                <div class="orders-list-heading">
                    <h2 class="orders-list-title">Pedidos em andamento</h2>
                    <span class="orders-count"><?= count($result ?? []) ?> pedidos</span>
                </div>
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

<div class="orders-empty-state">
    Nenhum pedido encontrado
</div>

<?php } ?>

</div>
                </section>
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

        </main>
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

    document.getElementById('todayDate').textContent = new Intl.DateTimeFormat('pt-BR', {
        day: '2-digit',
        month: 'short',
        year: 'numeric'
    }).format(new Date()).replace('.', '');
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
</body>
</html>