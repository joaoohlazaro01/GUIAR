<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="Shortcut Icon" type="image/png" href="img/Glogo.png">
    <title>Pedidos Entregues</title>

    

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
            #hamburger {
                display: flex !important;
                flex: 0 0 auto;
            }
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
        .orders-toolbar {
            width: 100%;
            min-width: 0;
            min-height: 44px;
            padding: 6px 10px;
            border: 1px solid #edf0f6;
            border-radius: 14px;
            background: rgba(255, 255, 255, .86);
            box-shadow: 0 5px 16px rgba(27, 48, 82, .035);
        }
        .orders-search:focus { outline: none; }
        .orders-search-wrap {
            min-width: 0;
            flex: 1 1 auto;
        }
        .orders-search {
            min-width: 0;
            font-size: clamp(10px, .8vw, 12px);
        }
        .orders-search-wrap:focus-within {
            border-color: var(--emp-primary, #cad5e7);
            box-shadow: 0 0 0 3px var(--emp-primary-ring, rgba(105, 132, 178, .09));
        }
        .orders-filter-menu { position: relative; }
        .orders-filter-menu summary { white-space: nowrap; }
        .orders-filter-menu[open] .orders-filter-options { display: block; }
        .orders-filter-options {
            display: none;
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            z-index: 30;
            width: 190px;
            padding: 6px;
            border: 1px solid #e8edf5;
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 12px 28px rgba(20, 38, 68, .14);
        }
        .orders-filter-option {
            width: 100%;
            padding: 9px 10px;
            border-radius: 8px;
            color: #52627c;
            font-size: 12px;
            text-align: left;
        }
        .orders-filter-option:hover,
        .orders-filter-option[aria-pressed="true"] {
            background: var(--emp-primary-light, #fff0f3);
            color: var(--emp-primary, #e91e42);
        }
        .orders-results {
            width: 100%;
            min-width: 0;
            margin-top: clamp(10px, 1.4vw, 18px);
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
        .orders-columns,
        .order-card {
            display: grid;
            grid-template-columns: minmax(90px, .7fr) minmax(150px, 1.3fr) minmax(150px, 1.4fr) minmax(130px, 1fr) minmax(95px, .7fr) minmax(105px, .8fr);
            align-items: center;
            gap: 14px;
        }
        .orders-columns {
            padding: 11px 20px;
            background: #f8fafc;
            color: #8290a7;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .045em;
        }
        .orders-grid {
            display: block;
            position: relative;
            padding: 0;
        }
        .order-card {
            padding: 16px 20px;
            border: 0;
            border-bottom: 1px solid #edf0f6;
            border-left: 3px solid var(--emp-primary, #f3243e);
            border-radius: 0;
            background: #fff;
            box-shadow: none;
            transition: background-color .18s ease;
        }
        .order-card:last-child { border-bottom: 0; }
        .order-card:hover { background: #fafbfe; }
        .order-cell { min-width: 0; }
        .order-mobile-label { display: none; }
        .order-reference { color: #172b4d; font-size: 13px; font-weight: 800; }
        .order-primary-text {
            display: block;
            overflow: hidden;
            color: #263957;
            font-size: 12px;
            font-weight: 700;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .order-secondary-text {
            display: block;
            margin-top: 3px;
            overflow: hidden;
            color: #8793a9;
            font-size: 10px;
            line-height: 1.4;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .order-amount { color: #263957; font-size: 12px; font-weight: 700; white-space: nowrap; }
        .order-status-badge {
            display: inline-flex;
            align-items: center;
            width: fit-content;
            gap: 5px;
            padding: 5px 9px;
            border-radius: 999px;
            background: var(--emp-primary-light, #eef2ff);
            color: var(--emp-primary, #4f46e5);
            font-size: 10px;
            font-weight: 700;
            white-space: nowrap;
        }
        .order-status-badge::before {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
            content: "";
        }
        .orders-empty-state {
            position: relative;
            z-index: 1;
            min-height: clamp(280px, 48vh, 560px);
            padding: 25px 16px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        .orders-empty-illustration {
            width: clamp(112px, 12vw, 164px);
            height: auto;
        }
        .orders-illustration-accent { fill: var(--emp-primary, #f3243e); }
        .orders-illustration-accent-stroke { stroke: var(--emp-primary, #f3243e); }
        .orders-empty-title {
            margin-top: 6px;
            color: #172b4d;
            font-size: clamp(15px, 1.2vw, 19px);
            font-weight: 800;
        }
        .orders-empty-copy {
            max-width: min(100%, 340px);
            margin-top: 4px;
            color: #8793a9;
            font-size: clamp(11px, .8vw, 13px);
            line-height: 1.5;
        }
        .orders-retry {
            margin-top: 12px;
            padding: 9px 16px;
            border-radius: 999px;
            background: var(--emp-primary, #f3243e);
            color: var(--emp-primary-contrast, #fff);
            font-size: 11px;
            font-weight: 700;
            box-shadow: 0 5px 12px var(--emp-primary-ring, rgba(241, 21, 60, .2));
        }
        .orders-retry:hover {
            background: var(--emp-primary-hover, #d91d39);
        }
        .order-status { color: var(--emp-primary, #f3243e); }
        .finalize-turn {
            position: fixed;
            right: clamp(12px, 2vw, 32px);
            bottom: clamp(12px, 2vh, 24px);
            z-index: 20;
        }
        .finalize-turn button {
            padding: clamp(10px, .9vw, 14px) clamp(16px, 1.6vw, 26px);
            font-size: clamp(12px, .9vw, 14px);
            background: var(--emp-secondary, #fc8835);
            color: var(--emp-secondary-contrast, #fff);
            box-shadow: 0 8px 24px var(--emp-secondary-light, rgba(252, 136, 53, .2));
        }
        .finalize-turn button:hover {
            background: var(--emp-secondary-hover, #e06c00);
        }

        @media (min-width: 769px) and (max-width: 1100px) {
            .orders-content { padding-right: 16px; padding-left: 16px; }
            .orders-columns,
            .order-card {
                grid-template-columns: minmax(70px, .65fr) minmax(120px, 1.2fr) minmax(120px, 1.3fr) minmax(110px, 1fr) minmax(80px, .7fr) minmax(90px, .8fr);
                gap: 9px;
                padding-right: 14px;
                padding-left: 14px;
            }
        }
        @media (max-width: 768px) {
            .orders-columns { display: none; }
            .order-card {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 13px 12px;
                padding: 15px 14px;
            }
            .order-cell { display: flex; flex-direction: column; gap: 4px; }
            .order-mobile-label {
                display: block;
                color: #8793a9;
                font-size: 9px;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: .04em;
            }
            .order-primary-text,
            .order-secondary-text { white-space: normal; overflow-wrap: anywhere; }
            .orders-list-heading { padding: 13px 14px; }
            .orders-empty-state { min-height: clamp(260px, 55vh, 520px); }
        }
        @media (max-width: 480px) {
            .orders-header {
                display: grid;
                grid-template-columns: 34px minmax(0, 1fr) auto;
                align-items: center;
                gap: 8px;
                padding: 12px;
            }
            .orders-header > #hamburger {
                width: 32px;
                height: 32px;
            }
            .orders-header > .orders-title-group {
                min-width: 0;
                gap: 6px;
            }
            .orders-header > .orders-title-group > span {
                width: 22px;
                height: 28px;
            }
            .orders-header > .orders-title-group > span svg {
                width: 17px;
                height: 17px;
            }
            .orders-header > .orders-date {
                min-width: 0;
                gap: 5px;
                padding: 5px 7px;
            }
            .orders-header > .orders-date svg { width: 28px; height: 28px; }
            .orders-header > .orders-date span { white-space: nowrap; }
            .orders-header > .orders-date span span:first-child { font-size: 9px; }
            .orders-header > .orders-date time { font-size: 8px; }
            .orders-page-title {
                font-size: clamp(14px, 4vw, 16px);
                line-height: 1.2;
            }
            .orders-page-subtitle {
                max-width: 100%;
                font-size: clamp(9px, 2.8vw, 10px);
                line-height: 1.35;
            }
            .orders-content { padding: 12px 10px 88px; }
            .orders-toolbar { gap: 6px; padding: 5px; }
            .orders-toolbar > label { gap: 6px; padding-right: 8px; padding-left: 8px; }
            .orders-search::placeholder { font-size: clamp(9px, 2.7vw, 10px); }
            .orders-toolbar summary { gap: 4px; padding-right: 8px; padding-left: 8px; font-size: 10px; }
            .order-card {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 13px 12px;
                padding: 15px 12px;
            }
            .orders-list-heading { padding: 13px 12px; }
            .orders-list-title { font-size: 13px; }
            .orders-empty-state { padding: 20px 12px; }
            .orders-filter-options { width: min(190px, calc(100vw - 32px)); }
            .order-card { padding: 16px; }
            .finalize-turn { right: 12px; bottom: 12px; }
            .finalize-turn button { padding: 10px 16px; }
        }
        @media (max-height: 480px) and (min-width: 481px) {
            .orders-empty-state { padding-top: 14px; padding-bottom: 14px; }
            .orders-empty-illustration { width: 96px; }
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
                class="menu-item active flex items-center gap-3.5 px-5 py-3 rounded-xl font-bold text-sm bg-[#4F46E5] text-black shadow-lg shadow-indigo-500/10 transition-all">

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
     <!-- MAIN -->
        <main class="orders-main flex-1 flex flex-col min-h-screen w-full md:ml-72">

            <!-- HEADER -->
            <header class="orders-header backdrop-blur-md flex items-center gap-3 sticky top-0 z-10">

                <!-- MENU MOBILE -->
                <button id="hamburger"
                    class="md:hidden flex items-center justify-center w-9 h-9 rounded-xl bg-white shadow-sm">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 text-gray-700"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

            <div class="orders-title-group flex min-w-0 flex-1 items-center gap-3">
                    <span class="orders-page-icon flex h-8 w-8 shrink-0 items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                    </span>
                    <div class="min-w-0">
                    <h1 class="orders-page-title">
                        Pedidos Entregues
                    </h1>
                    <p class="orders-page-subtitle">Aqui estão os status dos seus pedidos entregues hoje.</p>
                    </div>
                </div>
                <div class="orders-date flex shrink-0 items-center gap-2 rounded-xl border border-slate-100 bg-white/90 px-2.5 py-1.5 text-slate-500 shadow-sm" aria-label="Data atual">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 2v4m8-4v4M3 10h18M5 4h14a2 2 0 012 2v13a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2z" />
                    </svg>
                    <span class="leading-tight"><span class="block text-[8px] font-bold text-slate-700">Hoje</span><time id="todayDate" class="block text-[7px]"></time></span>
                </div>
        </header>

        <!-- CONTEÚDO -->
        <div class="orders-content flex flex-1 flex-col">
            <div class="orders-toolbar flex items-center gap-2">
                <label class="orders-search-wrap flex min-w-0 flex-1 items-center gap-2 rounded-full border border-slate-100 px-3 py-1.5 text-slate-400 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <circle cx="11" cy="11" r="7" stroke-width="1.8" />
                        <path stroke-linecap="round" stroke-width="1.8" d="m16 16 4 4" />
                    </svg>
                    <input id="orderSearch" type="search" class="orders-search w-full bg-transparent text-[9px] text-slate-700 placeholder:text-slate-400" placeholder="Buscar por número do pedido, cliente ou entregador..." aria-label="Buscar pedidos entregues">
                </label>
                <details id="orderFilters" class="orders-filter-menu shrink-0">
                    <summary class="flex cursor-pointer list-none items-center gap-1.5 rounded-full border border-slate-100 bg-white px-2.5 py-1.5 text-[9px] font-semibold text-slate-600 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 6h16M7 12h10m-7 6h4" />
                        </svg>
                        Filtros
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m7 10 5 5 5-5" />
                        </svg>
                    </summary>
                    <div class="orders-filter-options">
                        <button type="button" class="orders-filter-option" data-order-filter="all" aria-pressed="true">Todos os pedidos</button>
                        <button type="button" class="orders-filter-option" data-order-filter="assigned" aria-pressed="false">Com entregador</button>
                        <button type="button" class="orders-filter-option" data-order-filter="unassigned" aria-pressed="false">Sem entregador</button>
                    </div>
                </details>
            </div>

            <section class="orders-results" aria-live="polite">
                <div class="orders-list-heading">
                    <h2 class="orders-list-title">Histórico de entregas</h2>
                    <span id="ordersCount" class="orders-count"><?= count($pedidos ?? []) ?> pedidos</span>
                </div>
                <div class="orders-columns" aria-hidden="true">
                    <span>Pedido</span>
                    <span>Cliente</span>
                    <span>Endereço</span>
                    <span>Entregador</span>
                    <span>Valor</span>
                    <span>Status</span>
                </div>
                <div id="ordersEmptyState" class="orders-empty-state" <?= !empty($pedidos) ? 'hidden' : '' ?>>
                    <svg class="orders-empty-illustration" viewBox="0 0 160 130" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <ellipse cx="78" cy="112" rx="48" ry="8" fill="#E9EEF6"/>
                        <path d="m42 45 38-17 38 17-38 20-38-20Z" fill="#F6F8FC"/>
                        <path d="M42 45v42l38 20V65L42 45Z" fill="#E9EEF6"/>
                        <path d="M118 45v42l-38 20V65l38-20Z" fill="#DCE4F0"/>
                        <path d="m42 45 38-17 38 17-38 20-38-20Z" stroke="#D7DFEC" stroke-width="2"/>
                        <path d="m66 34 38 18-14 8-38-20 14-6Z" fill="#FF7890"/>
                        <path d="M80 65v42" stroke="#D3DCE9" stroke-width="2"/>
                        <path class="orders-illustration-accent" d="M119 12c-8 0-14 6-14 14 0 11 14 25 14 25s14-14 14-25c0-8-6-14-14-14Z"/>
                        <circle cx="119" cy="26" r="5" fill="white"/>
                        <circle class="orders-illustration-accent" cx="55" cy="77" r="12"/>
                        <path d="m50 77 4 4 7-8" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path class="orders-illustration-accent-stroke" d="m24 55 5 3-5 3m-1-6 1 6m105 13 5 3-5 3m-1-6 1 6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <h2 id="ordersEmptyTitle" class="orders-empty-title"><?= !empty($pedidos) ? 'Nenhum pedido corresponde à busca' : 'Nenhum pedido entregue encontrado' ?></h2>
                    <p class="orders-empty-copy">Quando um pedido for entregue, ele aparecerá aqui com todos os detalhes.</p>
                    <button id="ordersRetry" type="button" class="orders-retry">Tentar novamente</button>
                </div>
                <div id="ordersGrid" class="orders-grid" <?= empty($pedidos) ? 'hidden' : '' ?>>
                <?php
                if (!empty($pedidos) && count($pedidos) > 0) {

                    foreach ($pedidos as $pedido) {
                        $nomeEntregador = $pedido['nome_entregador'] ?? 'Não atribuído';
                        $pedidoIndexado = implode(' ', [
                            $pedido['id_pedido'] ?? '',
                            $pedido['nome_cliente'] ?? '',
                            $nomeEntregador,
                            $pedido['endereco'] ?? '',
                            $pedido['bairro'] ?? '',
                            $pedido['descricao'] ?? ''
                        ]);
                ?>

                <article class="order-card" data-search="<?= htmlspecialchars($pedidoIndexado, ENT_QUOTES, 'UTF-8') ?>" data-assigned="<?= !empty($pedido['nome_entregador']) ? 'true' : 'false' ?>">
                    <div class="order-cell order-reference">
                        <span class="order-mobile-label">Pedido</span>
                        <span>#<?= htmlspecialchars($pedido['id_pedido']) ?></span>
                    </div>
                    <div class="order-cell">
                        <span class="order-mobile-label">Cliente</span>
                        <span class="order-primary-text"><?= htmlspecialchars($pedido['nome_cliente']) ?></span>
                        <span class="order-secondary-text"><?= htmlspecialchars($pedido['descricao']) ?></span>
                    </div>
                    <div class="order-cell">
                        <span class="order-mobile-label">Endereço</span>
                        <span class="order-primary-text"><?= htmlspecialchars($pedido['endereco']) ?></span>
                        <span class="order-secondary-text"><?= htmlspecialchars($pedido['bairro']) ?></span>
                    </div>
                    <div class="order-cell">
                        <span class="order-mobile-label">Entregador</span>
                        <span class="order-primary-text"><?= htmlspecialchars($nomeEntregador) ?></span>
                    </div>
                    <div class="order-cell order-amount">
                        <span class="order-mobile-label">Valor</span>
                        <span>R$ <?= number_format($pedido['preco'], 2, ',', '.') ?></span>
                    </div>
                    <div class="order-cell">
                        <span class="order-mobile-label">Status</span>
                        <span class="order-status-badge"><?= htmlspecialchars($pedido['status']) ?></span>
                    </div>
                </article>

                <?php
                    }
                }
                ?>
            </div>
            </section>
        </div>
    </main>
</div>

<form method="POST" action="<?= BASE_URL ?>/routes.php?action=finalizarTurno" class="finalize-turn">
    <button type="submit"
        name="finalizar_turno"
        onclick="return confirm('Deseja realmente finalizar o turno e limpar a lista?');"
        class="px-6 py-3 bg-[#fc8835] hover:bg-[#e06c00] text-white rounded-2xl shadow-lg hover:shadow-xl transition-all font-bold">
        Finalizar Turno
    </button>
</form>

<!-- SCRIPT MOBILE -->
<script>

     // SIDEBAR MOBILE
    const menuBtn = document.getElementById('hamburger');
    const sidebar = document.getElementById('sidebar');
    const closeSidebar = document.getElementById('closeSidebar');
    const overlay = document.getElementById('overlay');

    if (menuBtn && sidebar && overlay) {
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
    }

    const orderSearch = document.getElementById('orderSearch');
    const orderCards = Array.from(document.querySelectorAll('.order-card'));
    const emptyState = document.getElementById('ordersEmptyState');
    const emptyTitle = document.getElementById('ordersEmptyTitle');
    const retryButton = document.getElementById('ordersRetry');
    const ordersCount = document.getElementById('ordersCount');
    const filterMenu = document.getElementById('orderFilters');
    let activeOrderFilter = 'all';

    function filterOrders() {
        const query = orderSearch.value.trim().toLocaleLowerCase('pt-BR');
        let visibleCount = 0;

        orderCards.forEach((card) => {
            const matchesSearch = card.dataset.search.toLocaleLowerCase('pt-BR').includes(query);
            const matchesFilter = activeOrderFilter === 'all'
                || (activeOrderFilter === 'assigned' && card.dataset.assigned === 'true')
                || (activeOrderFilter === 'unassigned' && card.dataset.assigned === 'false');
            const isVisible = matchesSearch && matchesFilter;

            card.hidden = !isVisible;
            visibleCount += Number(isVisible);
        });

        const showEmptyState = visibleCount === 0;
        emptyState.hidden = !showEmptyState;
        ordersCount.textContent = `${visibleCount} ${visibleCount === 1 ? 'pedido' : 'pedidos'}`;
        emptyTitle.textContent = orderCards.length > 0 && showEmptyState
            ? 'Nenhum pedido corresponde aos filtros'
            : 'Nenhum pedido entregue encontrado';
        retryButton.textContent = orderCards.length > 0 && showEmptyState
            ? 'Limpar filtros'
            : 'Tentar novamente';
    }

    orderSearch.addEventListener('input', filterOrders);
    document.querySelectorAll('[data-order-filter]').forEach((button) => {
        button.addEventListener('click', () => {
            activeOrderFilter = button.dataset.orderFilter;
            document.querySelectorAll('[data-order-filter]').forEach((option) => {
                option.setAttribute('aria-pressed', String(option === button));
            });
            filterMenu.open = false;
            filterOrders();
        });
    });
    retryButton.addEventListener('click', () => {
        if (orderCards.length > 0) {
            orderSearch.value = '';
            activeOrderFilter = 'all';
            document.querySelector('[data-order-filter="all"]').setAttribute('aria-pressed', 'true');
            document.querySelectorAll('[data-order-filter]:not([data-order-filter="all"])').forEach((option) => {
                option.setAttribute('aria-pressed', 'false');
            });
            filterOrders();
            return;
        }

        window.location.reload();
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