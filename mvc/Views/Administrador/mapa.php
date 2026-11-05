<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" type="image/png" href="<?= BASE_URL ?>/img/Glogo.png">

    <title>Acompanhamento de Entregadores | GUIAR</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?= BASE_URL ?>/style/sidebar.css">

    <!-- Google Fonts: Inter & Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Leaflet CSS & Routing Machine -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />

    <style>
        :root {
            --emp-primary: #4F46E5;
            --emp-primary-hover: #4338CA;
            --emp-primary-active: #3730A3;
            --emp-primary-dark: #312E81;
            --emp-primary-light: #EEF2FF;
            --emp-primary-light-border: #C7D2FE;
            --emp-primary-ring: rgba(79, 70, 229, 0.25);
            --emp-primary-contrast: #FFFFFF;

            --emp-secondary: #FFD400;
            --emp-secondary-hover: #E6BE00;
            --emp-secondary-light: #FEF9C3;
            --emp-secondary-contrast: #0F172A;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background: radial-gradient(ellipse at 60% -10%, rgba(255, 255, 255, .98), transparent 48%), #f1f4fa;
        }

        .heading-font {
            font-family: 'Outfit', 'Inter', sans-serif;
        }

        /* SIDEBAR MOBILE */
        @media (max-width: 768px) {
            #sidebar {
                transform: translateX(-100%);
                transition: transform .3s cubic-bezier(0.4, 0, 0.2, 1);
                border-radius: 0 !important;
                top: 0 !important;
                left: 0 !important;
                margin: 0 !important;
                height: 100vh !important;
                width: 280px !important;
            }

            #sidebar.mobile-open {
                transform: translateX(0);
            }

            #overlay.active {
                display: block;
            }
        }

        /* MAPA */
        #map {
            height: 100%;
            width: 100%;
            z-index: 1;
            background: #eef2f6;
        }

        .leaflet-routing-container {
            display: none !important;
        }

        /* CUSTOM LEAFLET CONTROLS */
        .leaflet-bar {
            border: 0 !important;
            box-shadow: 0 4px 16px rgba(15, 23, 42, 0.12) !important;
            border-radius: 12px !important;
            overflow: hidden;
        }

        .leaflet-bar a {
            background-color: #ffffff !important;
            color: #1e293b !important;
            border-bottom: 1px solid #f1f5f9 !important;
            width: 36px !important;
            height: 36px !important;
            line-height: 36px !important;
            font-weight: 700 !important;
            transition: all 0.2s ease;
        }

        .leaflet-bar a:hover {
            background-color: #f8fafc !important;
            color: var(--emp-primary, #4F46E5) !important;
        }

        /* CUSTOM MODERN POPUP */
        .leaflet-popup-content-wrapper {
            background: #ffffff !important;
            border-radius: 18px !important;
            box-shadow: 0 16px 36px -8px rgba(15, 23, 42, 0.2), 0 4px 12px rgba(15, 23, 42, 0.08) !important;
            border: 1px solid #edf2f7 !important;
            padding: 0 !important;
            overflow: hidden;
        }

        .leaflet-popup-content {
            margin: 0 !important;
            line-height: 1.45 !important;
        }

        .leaflet-popup-tip {
            background: #ffffff !important;
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.08) !important;
        }

        .leaflet-container a.leaflet-popup-close-button {
            top: 10px !important;
            right: 12px !important;
            color: #94a3b8 !important;
            font-size: 17px !important;
            padding: 4px !important;
            border-radius: 999px !important;
            transition: all 0.2s ease;
        }

        .leaflet-container a.leaflet-popup-close-button:hover {
            color: #0f172a !important;
            background: #f1f5f9;
        }

        /* MODERN MOTO MARKER */
        .moto-marker {
            background: none;
            border: none;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .moto-pin-bubble {
            position: relative;
            display: flex;
            align-items: center;
            gap: 5px;
            padding: 4px 8px;
            border-radius: 999px;
            background: #ffffff;
            box-shadow: 0 6px 18px rgba(15, 23, 42, 0.18);
            border: 2px solid var(--emp-primary, #4F46E5);
            font-weight: 700;
            font-size: 11px;
            color: #0f172a;
            white-space: nowrap;
            transition: transform 0.2s ease;
            z-index: 10;
        }

        .moto-pin-bubble.idle {
            border-color: #10b981;
        }

        .moto-pin-bubble:hover {
            transform: scale(1.08);
        }

        .moto-icon-box {
            font-size: 15px;
            line-height: 1;
            display: inline-block;
            animation: moto-bob 1s ease-in-out infinite alternate;
        }

        @keyframes moto-bob {
            from { transform: translateY(0); }
            to { transform: translateY(-2px); }
        }

        .pulse-ring {
            position: absolute;
            width: 44px;
            height: 44px;
            border: 3px solid var(--emp-primary, #4F46E5);
            border-radius: 999px;
            animation: pulse-animation 1.6s infinite ease-out;
            pointer-events: none;
            z-index: 1;
        }

        .pulse-ring-idle {
            position: absolute;
            width: 44px;
            height: 44px;
            border: 3px solid #10b981;
            border-radius: 999px;
            animation: pulse-animation 1.6s infinite ease-out;
            pointer-events: none;
            z-index: 1;
        }

        @keyframes pulse-animation {
            0% {
                transform: scale(0.65);
                opacity: 0.95;
            }
            100% {
                transform: scale(1.75);
                opacity: 0;
            }
        }

        /* DELIVERY MARKER PIN */
        .delivery-marker {
            background: var(--emp-primary, #4F46E5);
            border-radius: 999px;
            width: 26px;
            height: 26px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            border: 2.5px solid #ffffff;
            font-size: 11px;
            font-weight: 800;
            box-shadow: 0 4px 14px rgba(15, 23, 42, 0.25);
            transition: transform 0.2s ease;
        }

        .delivery-marker:hover {
            transform: scale(1.15);
        }

        /* CUSTOM SCROLLBAR */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 999px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* ACTIVE CARDS & TRANSITIONS */
        .driver-card {
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .driver-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 24px -6px rgba(15, 23, 42, 0.08);
        }

        .driver-card.focused {
            border-color: var(--emp-primary, #4F46E5) !important;
            box-shadow: 0 0 0 3px var(--emp-primary-ring, rgba(79, 70, 229, 0.18)) !important;
        }

        /* GLASS FLOATING CONTROLS */
        .glass-panel {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            box-shadow: 0 8px 30px rgba(15, 23, 42, 0.08);
        }
    </style>
</head>

<body class="sidebar-page bg-[#f1f4fa] text-slate-800 antialiased h-screen overflow-hidden flex flex-col md:flex-row">

    <!-- OVERLAY MOBILE -->
    <div id="overlay" class="hidden fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-40 md:hidden transition-opacity"></div>

    <?php
    $nomeAdmin = $nomeAdmin ?? ($_SESSION['nome_usuario'] ?? ($admin["nome_adm"] ?? "Admin"));
    $adminFotoUrl = $adminFotoUrl ?? '';
    $logoEmpresaSidebar = $logoEmpresaSidebar ?? (BASE_URL . '/img/LogoPreto.png');
    ?>

    <!-- SIDEBAR -->
    <aside id="sidebar"
        class="w-72 bg-white flex flex-col fixed top-0 left-0 text-slate-700 z-50 transition-all rounded-none overflow-hidden h-screen border-r border-slate-200/80 shadow-sm">

        <div class="flex flex-col h-full">

            <!-- BOTÃO FECHAR MOBILE -->
            <button id="closeSidebar"
                class="absolute top-5 right-5 md:hidden text-slate-500 hover:text-slate-800 text-xl font-bold p-1 rounded-lg transition-colors z-50">
                ✕
            </button>

            <!-- LOGO DA EMPRESA -->
            <div class="px-6 pt-7 pb-4 mb-2 flex justify-start items-center gap-3">
                <div style="width: 58px; height: 58px; border-radius: 50%; overflow: hidden; flex-shrink: 0; background: #fff; border: 2px solid var(--emp-primary-light-border, rgba(79,70,229,0.18)); box-shadow: 0 4px 14px var(--emp-primary-ring, rgba(79,70,229,0.12)); display: flex; align-items: center; justify-content: center; padding: 5px;">
                    <img src="<?= htmlspecialchars($logoEmpresaSidebar, ENT_QUOTES, 'UTF-8') ?>"
                        alt="Logo da empresa"
                        style="width: 100%; height: 100%; object-fit: contain; object-position: center; display: block;">
                </div>
                <div class="min-w-0">
                    <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Painel do Gestor</p>
                    <p class="text-sm font-extrabold text-slate-800 truncate">GUIAR Entregas</p>
                </div>
            </div>

            <!-- MENU DE NAVEGAÇÃO -->
            <nav class="sidebar-menu px-4 space-y-1.5 flex-grow">

                <!-- INÍCIO -->
                <a href="<?= BASE_URL ?>/routes.php?action=dashboardAdm"
                    class="menu-item flex items-center gap-3.5 px-4 py-3 rounded-xl font-semibold text-sm text-slate-500 hover:text-slate-900 hover:bg-slate-100/80 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Início
                </a>

                <!-- PEDIDOS -->
                <a href="<?= BASE_URL ?>/routes.php?action=pedidos"
                    class="menu-item flex items-center gap-3.5 px-4 py-3 rounded-xl font-semibold text-sm text-slate-500 hover:text-slate-900 hover:bg-slate-100/80 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    Pedidos
                </a>

                <!-- ENTREGADORES -->
                <a href="<?= BASE_URL ?>/routes.php?action=entregadores"
                    class="menu-item flex items-center gap-3.5 px-4 py-3 rounded-xl font-semibold text-sm text-slate-500 hover:text-slate-900 hover:bg-slate-100/80 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-4a4 4 0 100-8 4 4 0 000 8zm6 4a2 2 0 100-4 2 2 0 000 4zM3 20v-2a2 2 0 012-2h1" />
                    </svg>
                    Entregadores
                </a>

                <!-- PEDIDOS ENTREGUES -->
                <a href="<?= BASE_URL ?>/routes.php?action=pedidosEntregues"
                    class="menu-item flex items-center gap-3.5 px-4 py-3 rounded-xl font-semibold text-sm text-slate-500 hover:text-slate-900 hover:bg-slate-100/80 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                    Pedidos Entregues
                </a>

                <!-- MAPA (ATIVO) -->
                <a href="<?= BASE_URL ?>/routes.php?action=mapaAdm"
                    class="menu-item active flex items-center gap-3.5 px-4 py-3 rounded-xl font-bold text-sm transition-all"
                    style="background-color: var(--emp-primary, #4F46E5); color: var(--emp-primary-contrast, #ffffff); box-shadow: 0 8px 18px -4px var(--emp-primary-ring, rgba(79, 70, 229, 0.35));">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                    </svg>
                    Acompanhar Rotas
                </a>

                <!-- PERFIL -->
                <a href="<?= BASE_URL ?>/routes.php?action=perfilAdm"
                    class="menu-item flex items-center gap-3.5 px-4 py-3 rounded-xl font-semibold text-sm text-slate-500 hover:text-slate-900 hover:bg-slate-100/80 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Meu Perfil
                </a>
            </nav>

            <!-- FOOTER SIDEBAR -->
            <div class="p-4 mt-auto border-t border-slate-100">
                <div class="px-2 pb-3.5 flex flex-col items-center gap-1">
                    <img src="<?= BASE_URL ?>/img/LogoPreto.png" alt="GUIAR" class="w-20 h-auto object-contain opacity-90">
                    <p class="text-[10px] text-slate-400 text-center leading-tight">
                        Conectando você ao seu destino.
                    </p>
                </div>

                <div class="admin-user-card flex items-center gap-3 p-2.5 rounded-2xl bg-slate-50 border border-slate-200/80">
                    <?php if (!empty($adminFotoUrl)): ?>
                        <img src="<?= htmlspecialchars($adminFotoUrl, ENT_QUOTES, 'UTF-8') ?>"
                            alt="Foto de <?= htmlspecialchars($nomeAdmin, ENT_QUOTES, 'UTF-8') ?>"
                            class="w-9 h-9 rounded-full object-cover shadow-sm ring-2 ring-white">
                    <?php else: ?>
                        <div class="admin-user-avatar w-9 h-9 rounded-full font-black text-xs flex items-center justify-center shadow-sm"
                            style="background-color: var(--emp-secondary, #FFD400); color: var(--emp-secondary-contrast, #0F172A);">
                            <?= strtoupper(substr($nomeAdmin, 0, 2)) ?>
                        </div>
                    <?php endif; ?>

                    <div class="flex-grow min-w-0">
                        <p class="admin-user-name font-bold text-xs text-slate-800 truncate">
                            <?= htmlspecialchars($nomeAdmin) ?>
                        </p>
                        <p class="admin-user-role text-[10px] text-slate-400 font-bold tracking-wider uppercase">
                            Administrador
                        </p>
                    </div>

                    <!-- LOGOUT -->
                    <button type="button" data-logout-trigger aria-label="Sair da conta"
                        class="text-slate-400 hover:text-rose-500 transition-colors p-1.5 rounded-lg hover:bg-rose-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </aside>

    <?php require __DIR__ . '/partials/logout-confirmation.php'; ?>

    <!-- MAIN WRAPPER -->
    <main class="flex-1 flex flex-col h-screen min-w-0 md:ml-72 overflow-hidden">

        <!-- HEADER SUPERIOR MODERNO -->
        <header class="bg-white/80 backdrop-blur-md border-b border-slate-200/80 px-4 md:px-8 py-3.5 md:py-4 flex items-center justify-between gap-4 sticky top-0 z-20 flex-shrink-0">

            <div class="flex items-center gap-3.5 min-w-0">
                <!-- BOTÃO HAMBURGER MOBILE -->
                <button id="hamburger"
                    class="md:hidden flex items-center justify-center w-10 h-10 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 transition-colors flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <!-- ÍCONE EM DESTAQUE COM AS CORES DA EMPRESA -->
                <div class="hidden sm:flex w-10 h-10 rounded-xl items-center justify-center flex-shrink-0 transition-transform hover:scale-105"
                    style="background-color: var(--emp-primary-light, #EEF2FF); color: var(--emp-primary, #4F46E5); border: 1px solid var(--emp-primary-light-border, #C7D2FE);">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                    </svg>
                </div>

                <div class="min-w-0">
                    <h1 class="heading-font text-lg md:text-xl font-extrabold text-slate-900 tracking-tight flex items-center gap-2 truncate">
                        <span>Acompanhamento em Tempo Real</span>
                    </h1>
                    <p class="text-xs md:text-sm text-slate-500 font-medium truncate">
                        Monitore motoboys, rotas em andamento e destinos de entrega
                    </p>
                </div>
            </div>

            <!-- STATUS LIVE & METRICAS DE TOPO -->
            <div class="flex items-center gap-2.5 sm:gap-3 flex-shrink-0">

                <!-- PULSO DE ATUALIZAÇÃO AO VIVO -->
                <div class="hidden lg:flex items-center gap-2 px-3 py-1.5 rounded-full bg-emerald-50 border border-emerald-200/80 text-emerald-700 text-xs font-semibold">
                    <span class="relative flex h-2.5 w-2.5">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
                    </span>
                    <span>Ao vivo • 5s</span>
                </div>

                <!-- CONTADOR RÁPIDO DE ENTREGADORES -->
                <div class="flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-bold border transition-all"
                    style="background-color: var(--emp-primary-light, #EEF2FF); color: var(--emp-primary, #4F46E5); border-color: var(--emp-primary-light-border, #C7D2FE);">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <span><strong id="badgeDriversCount">0</strong> online</span>
                </div>

                <!-- BOTÃO RE-CENTRALIZAR GERAL -->
                <button id="btnFitBounds" title="Enquadrar todos os motoboys e pedidos no mapa"
                    class="p-2 sm:px-3 sm:py-2 rounded-xl bg-white border border-slate-200 hover:border-slate-300 text-slate-700 hover:text-slate-900 shadow-sm text-xs font-bold flex items-center gap-1.5 transition-all active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" />
                    </svg>
                    <span class="hidden sm:inline">Enquadrar Mapa</span>
                </button>
            </div>
        </header>

        <!-- SELETOR MOBILE ENTRE MAPA E LISTA (SOMENTE DISPOSITIVOS PEQUENOS) -->
        <div class="lg:hidden px-4 pt-3 pb-1 flex gap-2 bg-slate-100 border-b border-slate-200">
            <button id="tabToggleMap"
                class="flex-1 py-2 text-xs font-bold rounded-xl transition-all shadow-sm"
                style="background-color: var(--emp-primary, #4F46E5); color: var(--emp-primary-contrast, #ffffff);">
                🗺️ Visualizar Mapa
            </button>
            <button id="tabToggleList"
                class="flex-1 py-2 text-xs font-bold rounded-xl bg-white text-slate-700 border border-slate-200 transition-all">
                🛵 Entregadores (<span id="mobileCountBadge">0</span>)
            </button>
        </div>

        <!-- CONTEÚDO PRINCIPAL (MAPA + LISTA LATERAL) -->
        <section class="flex-1 overflow-hidden p-3 sm:p-5 lg:p-6">
            <div class="h-full flex flex-col lg:flex-row gap-4 sm:gap-5">

                <!-- ÁREA PRINCIPAL DO MAPA -->
                <div id="mapWrapper"
                    class="flex-1 h-full min-h-[380px] bg-white rounded-2xl sm:rounded-3xl border border-slate-200/90 shadow-sm overflow-hidden flex flex-col relative transition-all">

                    <!-- BARRA FLUTUANTE DE CONTROLES NO MAPA -->
                    <div class="absolute top-3 left-3 right-3 sm:left-4 sm:right-auto z-10 flex flex-wrap items-center gap-2 pointer-events-auto">
                        <div class="glass-panel px-3 py-1.5 rounded-2xl flex items-center gap-2 w-full sm:w-72 shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-slate-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <input id="inputBuscaMapa" type="text"
                                placeholder="Buscar entregador ou pedido..."
                                class="w-full bg-transparent text-xs font-medium text-slate-800 placeholder-slate-400 focus:outline-none" />
                            <button id="btnClearSearch" class="hidden text-slate-400 hover:text-slate-600 text-xs font-bold px-1">✕</button>
                        </div>

                        <!-- FILTRO RÁPIDO: TODOS / EM ROTA / LIVRES -->
                        <div class="hidden sm:flex items-center gap-1 glass-panel p-1 rounded-2xl shadow-md text-xs font-bold text-slate-600">
                            <button class="filter-btn px-2.5 py-1 rounded-xl transition-all active-filter" data-filter="all"
                                style="background-color: var(--emp-primary, #4F46E5); color: var(--emp-primary-contrast, #ffffff);">
                                Todos
                            </button>
                            <button class="filter-btn px-2.5 py-1 rounded-xl text-slate-600 hover:text-slate-900 transition-all" data-filter="in_route">
                                Em rota
                            </button>
                            <button class="filter-btn px-2.5 py-1 rounded-xl text-slate-600 hover:text-slate-900 transition-all" data-filter="idle">
                                Disponíveis
                            </button>
                        </div>
                    </div>

                    <!-- LEAFLET MAP ELEMENT -->
                    <div id="map"></div>

                    <!-- LEGENDA FLUTUANTE INFERIOR -->
                    <div class="absolute bottom-4 left-4 z-10 glass-panel px-3.5 py-2 rounded-2xl text-[11px] font-semibold text-slate-700 flex items-center gap-3.5 shadow-md hidden sm:flex pointer-events-auto">
                        <div class="flex items-center gap-1.5">
                            <span class="w-3 h-3 rounded-full border border-white shadow-sm" style="background-color: var(--emp-primary, #4F46E5);"></span>
                            <span>Em rota</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <span class="w-3 h-3 rounded-full bg-emerald-500 border border-white shadow-sm"></span>
                            <span>Disponível</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <span class="w-3 h-3 rounded-full bg-slate-400 border border-white shadow-sm"></span>
                            <span>Offline</span>
                        </div>
                        <div class="flex items-center gap-1.5 border-l border-slate-200 pl-3">
                            <span class="text-xs">📍</span>
                            <span>Destino da entrega</span>
                        </div>
                    </div>

                </div>

                <!-- LISTA LATERAL DE ENTREGADORES -->
                <div id="driversListWrapper"
                    class="w-full lg:w-[390px] xl:w-[430px] flex-shrink-0 h-full bg-white rounded-2xl sm:rounded-3xl border border-slate-200/90 shadow-sm flex flex-col overflow-hidden hidden lg:flex">

                    <!-- TOPO DA LISTA -->
                    <div class="p-4 sm:p-5 border-b border-slate-100 flex items-center justify-between gap-3 bg-slate-50/50">
                        <div>
                            <h2 class="heading-font text-base sm:text-lg font-bold text-slate-900 flex items-center gap-2">
                                <span>Entregadores Ativos</span>
                            </h2>
                            <p class="text-xs text-slate-500 font-medium">
                                Clique para focar a rota no mapa
                            </p>
                        </div>

                        <!-- BADGE TOTAL -->
                        <div class="flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border"
                            style="background-color: var(--emp-primary-light, #EEF2FF); color: var(--emp-primary, #4F46E5); border-color: var(--emp-primary-light-border, #C7D2FE);">
                            <span class="w-2 h-2 rounded-full animate-pulse" style="background-color: var(--emp-primary, #4F46E5);"></span>
                            <span id="totalDriversBadge">0</span>
                        </div>
                    </div>

                    <!-- CORPO SCROLLÁVEL COM CARDS DOS ENTREGADORES -->
                    <div id="driverListContainer"
                        class="flex-1 overflow-y-auto p-3.5 sm:p-4 space-y-3 divide-y-0">
                        <!-- CARREGANDO PLACEHOLDER -->
                        <div class="flex flex-col items-center justify-center py-16 text-center text-slate-400 gap-3">
                            <svg class="animate-spin h-7 w-7 text-indigo-500" style="color: var(--emp-primary, #4F46E5);" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                            </svg>
                            <span class="text-xs font-semibold">Sincronizando entregadores e rotas...</span>
                        </div>
                    </div>

                    <!-- FOOTER INFORMATIVO -->
                    <div class="px-4 py-3 bg-slate-50 border-t border-slate-100 flex items-center justify-between text-[11px] text-slate-500">
                        <span class="flex items-center gap-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Rotas recalculadas em tempo real
                        </span>
                        <span id="lastUpdateTimestamp" class="font-bold text-slate-600">Agora</span>
                    </div>

                </div>

            </div>
        </section>

    </main>

    <!-- MOBILE BOTTOM NAVIGATION (TELAS PEQUENAS) -->
    <nav class="lg:hidden fixed bottom-0 left-0 right-0 bg-white/95 backdrop-blur-md border-t border-slate-200/90 flex justify-around items-center h-16 z-30 shadow-lg">
        <a href="<?= BASE_URL ?>/routes.php?action=dashboardAdm"
            class="flex flex-col items-center gap-0.5 text-[11px] text-slate-500 hover:text-slate-900 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 opacity-75" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            Início
        </a>

        <a href="<?= BASE_URL ?>/routes.php?action=pedidos"
            class="flex flex-col items-center gap-0.5 text-[11px] text-slate-500 hover:text-slate-900 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 opacity-75" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
            </svg>
            Pedidos
        </a>

        <a href="<?= BASE_URL ?>/routes.php?action=mapaAdm"
            class="flex flex-col items-center gap-0.5 text-[11px] font-bold transition-colors"
            style="color: var(--emp-primary, #4F46E5);">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
            </svg>
            Rotas
        </a>

        <a href="<?= BASE_URL ?>/routes.php?action=perfilAdm"
            class="flex flex-col items-center gap-0.5 text-[11px] text-slate-500 hover:text-slate-900 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 opacity-75" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            Perfil
        </a>
    </nav>

    <!-- LEAFLET SCRIPTS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>

    <!-- SCRIPT DO MAPA E CONTROLE DE ROTAS -->
    <script>
        // Função auxiliar para capturar a cor primária da empresa em tempo real
        function getEmpresaPrimaryColor() {
            var val = getComputedStyle(document.documentElement).getPropertyValue('--emp-primary').trim();
            return val || '#4F46E5';
        }

        function getEmpresaPrimaryLight() {
            var val = getComputedStyle(document.documentElement).getPropertyValue('--emp-primary-light').trim();
            return val || '#EEF2FF';
        }

        // Paleta harmoniosa de rotas: primeiro elemento usa a cor primária da empresa
        function getRotasPalette() {
            var primary = getEmpresaPrimaryColor();
            return [primary, '#0d9488', '#8b5cf6', '#e11d48', '#f59e0b', '#0284c7', '#10b981'];
        }

        // INICIALIZA O MAPA LEAFLET
        var map = L.map('map', {
            zoomControl: false
        }).setView([-22.3674, -46.9428], 14);

        // CONTROLE DE ZOOM NO CANTO INFERIOR DIREITO
        L.control.zoom({
            position: 'bottomright'
        }).addTo(map);

        // CAMADA DE TILES MODERNA (CartoDB Voyager)
        L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}.png?key=cb1_3p8m_1_09944103c911a8c84b986e32', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>, &copy; <a href="https://carto.com/attributions">CARTO</a>',
            subdomains: 'abcd',
            maxZoom: 20
        }).addTo(map);

        // CONTROLE DE INSTÂNCIAS ATIVAS
        var marcadoresEntregadores = {};
        var marcadoresPedidos = {};
        var rotasEntregadores = {};
        var estadoEntregadores = {};
        var dadosEntregadoresCache = [];
        var filtroAtivo = 'all'; // 'all', 'in_route', 'idle'
        var termoBusca = '';

        // FUNÇÃO PARA CALCULAR MELHOR ROTA OSRM
        function calcularMelhorRotaParaEntregador(id_entregador, startLatLng, pedidos, corRota) {
            var promises = pedidos.map(ponto => {
                if (!ponto.latitude || !ponto.longitude) return Promise.resolve(null);

                var waypoints = [
                    startLatLng,
                    L.latLng(ponto.latitude, ponto.longitude)
                ];

                return new Promise((resolve) => {
                    var tempControl = L.Routing.control({
                        waypoints: waypoints,
                        router: L.Routing.osrmv1({
                            serviceUrl: 'https://router.project-osrm.org/route/v1'
                        }),
                        show: false,
                        lineOptions: {
                            styles: [{
                                color: 'rgba(0,0,0,0)',
                                weight: 1
                            }]
                        },
                        createMarker: function () {
                            return null;
                        }
                    }).on('routesfound', function (e) {
                        var routeLength = e.routes[0].summary.totalDistance;
                        try { map.removeControl(tempControl); } catch (err) {}
                        resolve({
                            ponto: ponto,
                            distance: routeLength
                        });
                    }).on('routingerror', function () {
                        try { map.removeControl(tempControl); } catch (err) {}
                        resolve(null);
                    }).addTo(map);

                    setTimeout(() => {
                        try {
                            map.removeControl(tempControl);
                        } catch (err) {}
                        resolve(null);
                    }, 2500);
                });
            });

            Promise.all(promises).then(results => {
                results = results.filter(r => r !== null);
                if (results.length === 0) return;

                var melhorRota = results.reduce((acc, cur) => cur.distance < acc.distance ? cur : acc);

                var finalWaypoints = [
                    startLatLng,
                    L.latLng(melhorRota.ponto.latitude, melhorRota.ponto.longitude)
                ];

                if (rotasEntregadores[id_entregador]) {
                    rotasEntregadores[id_entregador].setWaypoints(finalWaypoints);
                } else {
                    var rota = L.Routing.control({
                        waypoints: finalWaypoints,
                        show: false,
                        addWaypoints: false,
                        draggableWaypoints: false,
                        fitSelectedRoutes: false,
                        createMarker: function () {
                            return null;
                        },
                        lineOptions: {
                            styles: [
                                { color: '#ffffff', weight: 8, opacity: 0.8 },
                                { color: corRota, weight: 5, opacity: 0.95 }
                            ]
                        },
                        router: L.Routing.osrmv1({
                            serviceUrl: 'https://router.project-osrm.org/route/v1'
                        })
                    }).addTo(map);

                    rotasEntregadores[id_entregador] = rota;
                }
            });
        }

        // CARREGA DADOS VIA API
        function atualizarRastreamento() {
            fetch('<?= BASE_URL ?>/routes.php?action=apiAcompanharEntregadores')
                .then(response => response.json())
                .then(data => {
                    if (data && !data.error) {
                        dadosEntregadoresCache = data;
                        renderizarInterface();
                        atualizarTimestamp();
                    }
                })
                .catch(error => {
                    console.warn("Aviso ao carregar dados de rastreamento:", error);
                });
        }

        function atualizarTimestamp() {
            var el = document.getElementById('lastUpdateTimestamp');
            if (el) {
                var agora = new Date();
                var hora = agora.toLocaleTimeString('pt-BR', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
                el.textContent = 'Atualizado às ' + hora;
            }
        }

        // RENDERIZA A INTERFACE COMPLETA
        function renderizarInterface() {
            var dados = dadosEntregadoresCache || [];
            var coresRotas = getRotasPalette();

            // Atualiza contadores dos headers
            var totalDrivers = dados.length;
            var emRotaCount = 0;
            var livresCount = 0;
            var totalPedidosAtivos = 0;

            dados.forEach(e => {
                var temLoc = (e.latitude !== null && e.longitude !== null);
                var pendentes = (e.pedidos || []).filter(p => p.status !== 'entregue');
                totalPedidosAtivos += pendentes.length;
                if (temLoc) {
                    if (pendentes.length > 0) emRotaCount++;
                    else livresCount++;
                }
            });

            var badgeDriversCount = document.getElementById('badgeDriversCount');
            if (badgeDriversCount) badgeDriversCount.textContent = totalDrivers;

            var totalDriversBadge = document.getElementById('totalDriversBadge');
            if (totalDriversBadge) totalDriversBadge.textContent = totalDrivers + ' online';

            var mobileCountBadge = document.getElementById('mobileCountBadge');
            if (mobileCountBadge) mobileCountBadge.textContent = totalDrivers;

            var container = document.getElementById('driverListContainer');
            container.innerHTML = '';

            var idsEntregadoresAtivos = new Set();
            var idsPedidosAtivos = new Set();

            // Aplica filtros de pesquisa e status
            var dadosFiltrados = dados.filter(entregador => {
                var temLocalizacao = (entregador.latitude !== null && entregador.longitude !== null);
                var pedidosPendentes = (entregador.pedidos || []).filter(p => p.status !== 'entregue');
                var temPedidos = pedidosPendentes.length > 0;

                // Filtro por status
                if (filtroAtivo === 'in_route' && (!temLocalizacao || !temPedidos)) return false;
                if (filtroAtivo === 'idle' && (!temLocalizacao || temPedidos)) return false;

                // Filtro por texto de busca
                if (termoBusca) {
                    var nomeMatch = (entregador.nome_completo || '').toLowerCase().includes(termoBusca);
                    var idMatch = String(entregador.id_entregador || '').includes(termoBusca);
                    var pedidoMatch = pedidosPendentes.some(p =>
                        (p.nome_cliente || '').toLowerCase().includes(termoBusca) ||
                        (p.endereco || '').toLowerCase().includes(termoBusca) ||
                        (p.bairro || '').toLowerCase().includes(termoBusca)
                    );
                    if (!nomeMatch && !idMatch && !pedidoMatch) return false;
                }

                return true;
            });

            if (dadosFiltrados.length === 0) {
                container.innerHTML = `
                    <div class="flex flex-col items-center justify-center py-12 px-4 text-center">
                        <div class="w-12 h-12 rounded-2xl bg-slate-100 flex items-center justify-center text-slate-400 mb-3 text-xl">
                            🔍
                        </div>
                        <h4 class="font-bold text-slate-700 text-sm">Nenhum entregador encontrado</h4>
                        <p class="text-xs text-slate-400 mt-1 max-w-xs">
                            ${termoBusca ? 'Nenhum resultado corresponde à sua pesquisa.' : 'Nenhum entregador cadastrado ou disponível no momento.'}
                        </p>
                    </div>
                `;
            }

            dados.forEach((entregador, index) => {
                idsEntregadoresAtivos.add(entregador.id_entregador);

                var temLocalizacao = (entregador.latitude !== null && entregador.longitude !== null);
                var pedidosPendentes = (entregador.pedidos || []).filter(p => p.status !== 'entregue');
                var temPedidos = pedidosPendentes.length > 0;

                var statusText = 'Offline';
                var statusClass = 'bg-slate-100 text-slate-600 border-slate-200';
                var borderAccent = 'border-l-slate-300';
                var statusDot = 'bg-slate-400';

                if (temLocalizacao) {
                    if (temPedidos) {
                        statusText = 'Em rota • ' + pedidosPendentes.length + ' entrega' + (pedidosPendentes.length > 1 ? 's' : '');
                        statusClass = 'text-indigo-600 border-indigo-200';
                        borderAccent = 'border-l-[var(--emp-primary,#4F46E5)]';
                        statusDot = 'bg-[var(--emp-primary,#4F46E5)] animate-pulse';
                    } else {
                        statusText = 'Disponível';
                        statusClass = 'bg-emerald-50 text-emerald-700 border-emerald-200';
                        borderAccent = 'border-l-emerald-500';
                        statusDot = 'bg-emerald-500';
                    }
                }

                var primeiroNome = (entregador.nome_completo || 'Entregador').split(' ')[0];
                var iniciais = (entregador.nome_completo || 'EN').split(' ').map(n => n[0]).slice(0, 2).join('').toUpperCase();

                // CARD LATERAL DO ENTREGADOR (somente se atender aos filtros)
                if (dadosFiltrados.includes(entregador)) {
                    var card = document.createElement('div');
                    card.id = 'driverCard_' + entregador.id_entregador;
                    card.className = `driver-card bg-white border border-slate-200 rounded-2xl p-4 shadow-sm border-l-4 ${borderAccent} cursor-pointer`;

                    card.onclick = function () {
                        document.querySelectorAll('.driver-card').forEach(c => c.classList.remove('focused'));
                        card.classList.add('focused');

                        if (temLocalizacao) {
                            map.flyTo([entregador.latitude, entregador.longitude], 16, { duration: 1.0 });
                            if (marcadoresEntregadores[entregador.id_entregador]) {
                                marcadoresEntregadores[entregador.id_entregador].openPopup();
                            }
                        }
                    };

                    var cardHTML = `
                        <div class="flex items-start justify-between gap-3">
                            <div class="flex items-center gap-3 min-w-0">
                                <div class="w-10 h-10 rounded-xl font-extrabold text-xs flex items-center justify-center flex-shrink-0 shadow-sm"
                                    style="background-color: var(--emp-secondary, #FFD400); color: var(--emp-secondary-contrast, #0F172A);">
                                    ${iniciais}
                                </div>
                                <div class="min-w-0">
                                    <h3 class="font-bold text-slate-900 text-sm truncate flex items-center gap-1.5">
                                        <span>${entregador.nome_completo}</span>
                                    </h3>
                                    <p class="text-[11px] text-slate-400 font-medium">
                                        ID #${entregador.id_entregador}
                                    </p>
                                </div>
                            </div>

                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold border ${statusClass}"
                                style="${temPedidos && temLocalizacao ? 'background-color: var(--emp-primary-light, #EEF2FF); color: var(--emp-primary, #4F46E5); border-color: var(--emp-primary-light-border, #C7D2FE);' : ''}">
                                <span class="w-1.5 h-1.5 rounded-full ${statusDot}"></span>
                                <span>${statusText}</span>
                            </span>
                        </div>
                    `;

                    // LISTAGEM DE PEDIDOS PENDENTES DESTE ENTREGADOR
                    if (temPedidos) {
                        cardHTML += `
                            <div class="mt-3.5 pt-3 border-t border-slate-100 space-y-2">
                                <div class="flex items-center justify-between text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                                    <span>Paradas na rota</span>
                                    <span>${pedidosPendentes.length} pendente${pedidosPendentes.length > 1 ? 's' : ''}</span>
                                </div>
                        `;

                        pedidosPendentes.forEach((pedido, pIndex) => {
                            idsPedidosAtivos.add(pedido.id_pedido);
                            var precoFormatado = pedido.preco ? Number(pedido.preco).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' }) : 'R$ 0,00';

                            cardHTML += `
                                <div onclick="event.stopPropagation(); centralizarNoPedido(${pedido.id_pedido}, ${pedido.latitude}, ${pedido.longitude});"
                                    class="p-2.5 rounded-xl bg-slate-50 hover:bg-slate-100/90 border border-slate-200/80 transition-all flex items-start justify-between gap-2.5 group">
                                    <div class="min-w-0 flex items-start gap-2">
                                        <span class="w-5 h-5 rounded-lg text-white font-extrabold text-[10px] flex items-center justify-center flex-shrink-0 mt-0.5"
                                            style="background-color: var(--emp-primary, #4F46E5);">
                                            ${pIndex + 1}
                                        </span>
                                        <div class="min-w-0">
                                            <p class="text-xs font-bold text-slate-800 truncate group-hover:text-slate-900">
                                                ${pedido.nome_cliente || 'Cliente'}
                                            </p>
                                            <p class="text-[11px] text-slate-500 truncate flex items-center gap-1 mt-0.5">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-slate-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                </svg>
                                                <span>${pedido.endereco || 'Endereço não informado'}${pedido.bairro ? ', ' + pedido.bairro : ''}</span>
                                            </p>
                                        </div>
                                    </div>

                                    <span class="text-[11px] font-extrabold flex-shrink-0" style="color: var(--emp-primary, #4F46E5);">
                                        ${precoFormatado}
                                    </span>
                                </div>
                            `;
                        });

                        cardHTML += `</div>`;
                    } else if (temLocalizacao) {
                        cardHTML += `
                            <div class="mt-3 py-2 px-3 rounded-xl bg-emerald-50/60 border border-emerald-100 flex items-center gap-2 text-xs text-emerald-700 font-medium">
                                <span class="text-sm">✓</span>
                                <span>Livre para novas entregas</span>
                            </div>
                        `;
                    } else {
                        cardHTML += `
                            <div class="mt-3 py-2 px-3 rounded-xl bg-slate-50 border border-slate-100 flex items-center gap-2 text-xs text-slate-400 italic">
                                <span>•</span>
                                <span>Aguardando sinal GPS do motoboy</span>
                            </div>
                        `;
                    }

                    // BOTÃO DE AÇÃO DO CARD
                    if (temLocalizacao) {
                        cardHTML += `
                            <div class="mt-3.5 pt-2 flex items-center gap-2">
                                <button type="button"
                                    onclick="event.stopPropagation(); map.flyTo([${entregador.latitude}, ${entregador.longitude}], 16, { duration: 1.0 }); marcadoresEntregadores[${entregador.id_entregador}]?.openPopup();"
                                    class="w-full py-2 px-3 rounded-xl text-xs font-bold transition-all flex items-center justify-center gap-1.5 shadow-sm active:scale-98"
                                    style="background-color: var(--emp-primary, #4F46E5); color: var(--emp-primary-contrast, #ffffff);">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    Ver no mapa
                                </button>
                            </div>
                        `;
                    }

                    card.innerHTML = cardHTML;
                    container.appendChild(card);
                }

                // ATUALIZAÇÃO NO MAPA LEAFLET
                if (temLocalizacao) {
                    var lat = parseFloat(entregador.latitude);
                    var lng = parseFloat(entregador.longitude);

                    var pulseClass = temPedidos ? 'pulse-ring' : 'pulse-ring-idle';
                    var bubbleClass = temPedidos ? '' : 'idle';

                    var customIcon = L.divIcon({
                        className: 'moto-marker',
                        html: `
                            <div class="${pulseClass}"></div>
                            <div class="moto-pin-bubble ${bubbleClass}">
                                <span class="moto-icon-box">🛵</span>
                                <span>${primeiroNome}</span>
                            </div>
                        `,
                        iconSize: [60, 40],
                        iconAnchor: [30, 20]
                    });

                    var popupContent = `
                        <div class="p-3.5 min-w-[220px]" style="font-family: 'Inter', sans-serif;">
                            <div class="flex items-center gap-2.5 pb-2.5 mb-2.5 border-b border-slate-100">
                                <div class="w-8 h-8 rounded-lg font-bold text-xs flex items-center justify-center"
                                    style="background-color: var(--emp-secondary, #FFD400); color: var(--emp-secondary-contrast, #0F172A);">
                                    ${iniciais}
                                </div>
                                <div>
                                    <strong class="text-xs font-bold text-slate-900 block leading-tight">${entregador.nome_completo}</strong>
                                    <span class="text-[10px] text-slate-400 font-semibold">ID #${entregador.id_entregador}</span>
                                </div>
                            </div>
                            <div class="space-y-1.5 text-xs text-slate-600">
                                <p class="flex items-center justify-between">
                                    <span class="text-slate-400">Status:</span>
                                    <strong class="font-bold ${temPedidos ? 'text-indigo-600' : 'text-emerald-600'}">${statusText}</strong>
                                </p>
                                <p class="flex items-center justify-between">
                                    <span class="text-slate-400">Entregas ativas:</span>
                                    <strong class="font-bold text-slate-800">${pedidosPendentes.length}</strong>
                                </p>
                            </div>
                        </div>
                    `;

                    if (marcadoresEntregadores[entregador.id_entregador]) {
                        marcadoresEntregadores[entregador.id_entregador].setLatLng([lat, lng]);
                        marcadoresEntregadores[entregador.id_entregador].setIcon(customIcon);
                        marcadoresEntregadores[entregador.id_entregador].setPopupContent(popupContent);
                    } else {
                        var marker = L.marker([lat, lng], { icon: customIcon }).addTo(map);
                        marker.bindPopup(popupContent);
                        marcadoresEntregadores[entregador.id_entregador] = marker;
                    }

                    // MARCADORES DOS PEDIDOS NO MAPA
                    if (temPedidos) {
                        pedidosPendentes.forEach((pedido, pIdx) => {
                            if (pedido.latitude && pedido.longitude) {
                                idsPedidosAtivos.add(pedido.id_pedido);
                                var plat = parseFloat(pedido.latitude);
                                var plng = parseFloat(pedido.longitude);

                                var pedidoIcon = L.divIcon({
                                    className: 'delivery-marker-icon',
                                    html: `<div class="delivery-marker">${pIdx + 1}</div>`,
                                    iconSize: [26, 26],
                                    iconAnchor: [13, 26]
                                });

                                var pedidoPopup = `
                                    <div class="p-3.5 min-w-[240px]" style="font-family: 'Inter', sans-serif;">
                                        <div class="flex items-center justify-between gap-2 pb-2 mb-2 border-b border-slate-100">
                                            <span class="px-2 py-0.5 rounded-full text-[10px] font-extrabold text-white"
                                                style="background-color: var(--emp-primary, #4F46E5);">
                                                Parada #${pIdx + 1}
                                            </span>
                                            <span class="text-xs font-extrabold" style="color: var(--emp-primary, #4F46E5);">
                                                ${pedido.preco ? Number(pedido.preco).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' }) : ''}
                                            </span>
                                        </div>
                                        <strong class="text-xs font-bold text-slate-900 block leading-snug">${pedido.nome_cliente || 'Cliente'}</strong>
                                        <p class="text-[11px] text-slate-500 mt-1 flex items-start gap-1">
                                            <span>📍</span>
                                            <span>${pedido.endereco || ''}${pedido.bairro ? ', ' + pedido.bairro : ''}</span>
                                        </p>
                                    </div>
                                `;

                                if (marcadoresPedidos[pedido.id_pedido]) {
                                    marcadoresPedidos[pedido.id_pedido].setLatLng([plat, plng]);
                                    marcadoresPedidos[pedido.id_pedido].setIcon(pedidoIcon);
                                    marcadoresPedidos[pedido.id_pedido].setPopupContent(pedidoPopup);
                                } else {
                                    var pMarker = L.marker([plat, plng], { icon: pedidoIcon }).addTo(map);
                                    pMarker.bindPopup(pedidoPopup);
                                    marcadoresPedidos[pedido.id_pedido] = pMarker;
                                }
                            }
                        });

                        // CÁLCULO E ATUALIZAÇÃO DA ROTA OSRM
                        var corRota = coresRotas[index % coresRotas.length];
                        var idsPedidosStr = pedidosPendentes.map(p => p.id_pedido).sort().join(',');
                        var estadoAnterior = estadoEntregadores[entregador.id_entregador];

                        var mudou = !estadoAnterior ||
                            estadoAnterior.lat !== lat ||
                            estadoAnterior.lng !== lng ||
                            estadoAnterior.idsPedidosStr !== idsPedidosStr;

                        if (mudou) {
                            estadoEntregadores[entregador.id_entregador] = {
                                lat: lat,
                                lng: lng,
                                idsPedidosStr: idsPedidosStr
                            };

                            calcularMelhorRotaParaEntregador(
                                entregador.id_entregador,
                                L.latLng(lat, lng),
                                pedidosPendentes,
                                corRota
                            );
                        }
                    } else {
                        if (rotasEntregadores[entregador.id_entregador]) {
                            try { map.removeControl(rotasEntregadores[entregador.id_entregador]); } catch (e) {}
                            delete rotasEntregadores[entregador.id_entregador];
                        }
                        delete estadoEntregadores[entregador.id_entregador];
                    }
                } else {
                    if (marcadoresEntregadores[entregador.id_entregador]) {
                        try { map.removeLayer(marcadoresEntregadores[entregador.id_entregador]); } catch (e) {}
                        delete marcadoresEntregadores[entregador.id_entregador];
                    }
                    if (rotasEntregadores[entregador.id_entregador]) {
                        try { map.removeControl(rotasEntregadores[entregador.id_entregador]); } catch (e) {}
                        delete rotasEntregadores[entregador.id_entregador];
                    }
                    delete estadoEntregadores[entregador.id_entregador];
                }
            });

            // LIMPA MARCADORES OBSOLETOS DE ENTREGADORES REMOVIDOS
            Object.keys(marcadoresEntregadores).forEach(id => {
                if (!idsEntregadoresAtivos.has(parseInt(id))) {
                    try { map.removeLayer(marcadoresEntregadores[id]); } catch (e) {}
                    delete marcadoresEntregadores[id];

                    if (rotasEntregadores[id]) {
                        try { map.removeControl(rotasEntregadores[id]); } catch (e) {}
                        delete rotasEntregadores[id];
                    }
                }
            });

            // LIMPA MARCADORES OBSOLETOS DE PEDIDOS ENTREGUES/CANCELADOS
            Object.keys(marcadoresPedidos).forEach(id => {
                if (!idsPedidosAtivos.has(parseInt(id))) {
                    try { map.removeLayer(marcadoresPedidos[id]); } catch (e) {}
                    delete marcadoresPedidos[id];
                }
            });
        }

        // CENTRALIZAR MAPA NO PEDIDO
        function centralizarNoPedido(idPedido, lat, lng) {
            if (lat && lng) {
                map.flyTo([lat, lng], 17, { duration: 1.0 });
                if (marcadoresPedidos[idPedido]) {
                    marcadoresPedidos[idPedido].openPopup();
                }
            }
        }

        // ENQUADRAR TODOS OS MARCADORES NO MAPA
        function enquadrarTodos() {
            var bounds = [];

            Object.values(marcadoresEntregadores).forEach(m => {
                bounds.push(m.getLatLng());
            });

            Object.values(marcadoresPedidos).forEach(p => {
                bounds.push(p.getLatLng());
            });

            if (bounds.length > 0) {
                map.fitBounds(L.latLngBounds(bounds), {
                    padding: [60, 60],
                    maxZoom: 16
                });
            } else {
                map.setView([-22.3674, -46.9428], 14);
            }
        }

        document.getElementById('btnFitBounds')?.addEventListener('click', enquadrarTodos);

        // CONTROLE DO CAMPO DE BUSCA RÁPIDA
        var inputBusca = document.getElementById('inputBuscaMapa');
        var btnClearSearch = document.getElementById('btnClearSearch');

        if (inputBusca) {
            inputBusca.addEventListener('input', function (e) {
                termoBusca = (e.target.value || '').trim().toLowerCase();
                if (btnClearSearch) {
                    btnClearSearch.classList.toggle('hidden', termoBusca.length === 0);
                }
                renderizarInterface();
            });
        }

        if (btnClearSearch) {
            btnClearSearch.addEventListener('click', function () {
                if (inputBusca) inputBusca.value = '';
                termoBusca = '';
                btnClearSearch.classList.add('hidden');
                renderizarInterface();
            });
        }

        // FILTROS RÁPIDOS (TODOS / EM ROTA / DISPONÍVEIS)
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                var tipo = this.getAttribute('data-filter');
                filtroAtivo = tipo;

                document.querySelectorAll('.filter-btn').forEach(b => {
                    b.classList.remove('active-filter');
                    b.style.backgroundColor = 'transparent';
                    b.style.color = '#475569';
                });

                this.classList.add('active-filter');
                this.style.backgroundColor = 'var(--emp-primary, #4F46E5)';
                this.style.color = 'var(--emp-primary-contrast, #ffffff)';

                renderizarInterface();
            });
        });

        // NAVEGAÇÃO ENTRE ABAS MOBILE (MAPA vs LISTA)
        var tabToggleMap = document.getElementById('tabToggleMap');
        var tabToggleList = document.getElementById('tabToggleList');
        var mapWrapper = document.getElementById('mapWrapper');
        var driversListWrapper = document.getElementById('driversListWrapper');

        if (tabToggleMap && tabToggleList && mapWrapper && driversListWrapper) {
            tabToggleMap.addEventListener('click', function () {
                mapWrapper.classList.remove('hidden');
                driversListWrapper.classList.add('hidden');

                tabToggleMap.style.backgroundColor = 'var(--emp-primary, #4F46E5)';
                tabToggleMap.style.color = 'var(--emp-primary-contrast, #ffffff)';
                tabToggleList.style.backgroundColor = '#ffffff';
                tabToggleList.style.color = '#334155';

                setTimeout(() => map.invalidateSize(), 200);
            });

            tabToggleList.addEventListener('click', function () {
                mapWrapper.classList.add('hidden');
                driversListWrapper.classList.remove('hidden');

                tabToggleList.style.backgroundColor = 'var(--emp-primary, #4F46E5)';
                tabToggleList.style.color = 'var(--emp-primary-contrast, #ffffff)';
                tabToggleMap.style.backgroundColor = '#ffffff';
                tabToggleMap.style.color = '#334155';
            });
        }

        // DISPARO INICIAL E INTERVALO AUTOMÁTICO
        atualizarRastreamento();
        setInterval(atualizarRastreamento, 5000);

        // INVALIDA TAMANHO DO MAPA AO REDIMENSIONAR TELA
        window.addEventListener('resize', function () {
            map.invalidateSize();
        });
    </script>

    <!-- SCRIPT DA SIDEBAR MOBILE -->
    <script>
        const menuBtn = document.getElementById('hamburger');
        const sidebar = document.getElementById('sidebar');
        const closeSidebar = document.getElementById('closeSidebar');
        const overlay = document.getElementById('overlay');

        if (menuBtn && sidebar && overlay) {
            menuBtn.addEventListener('click', () => {
                sidebar.classList.add('mobile-open');
                overlay.classList.add('active');
            });
        }

        if (closeSidebar && sidebar && overlay) {
            closeSidebar.addEventListener('click', () => {
                sidebar.classList.remove('mobile-open');
                overlay.classList.remove('active');
            });
        }

        if (overlay && sidebar) {
            overlay.addEventListener('click', () => {
                sidebar.classList.remove('mobile-open');
                overlay.classList.remove('active');
            });
        }
    </script>

    <!-- INTEGRAÇÃO COM A PALETA DINÂMICA DA EMPRESA -->
    <script>
        window.GUIAR_EMPRESA_LOGO = <?= json_encode($logoEmpresaSidebar) ?>;
    </script>
    <script src="<?= BASE_URL ?>/public/js/empresa-palette.js"></script>
</body>

</html>
