<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | GUIAR</title>
    <link rel="Shortcut Icon" type="image/png" href="img/Glogo.png">
    
    <!-- CSS do Dashboard -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/style/dashboard.css">

    <!-- Fonte Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?= BASE_URL ?>/style/sidebar.css">

    <style>
        @font-face {
            font-family: 'Brice-Bold';
            src: url('<?= BASE_URL ?>/fonts/Brice-BoldSemiCondensed.ttf') format('truetype');
        }

        @font-face {
            font-family: 'BasisGrotesque-Regular';
            src: url('<?= BASE_URL ?>/fonts/BasisGrotesqueArabicPro-Regular.ttf') format('truetype');
        }

        body {
            font-family: 'Inter', 'BasisGrotesque-Regular', sans-serif;
            background-color: #F8FAFC;
        }

        .logo-circular {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            background-color: #ffffff;
        }

        .logo-circular-wrap {
            overflow: hidden;
            border-radius: 9999px;
            background-color: #ffffff;
            flex-shrink: 0;
        }

        .brand-crop-stage {
            position: relative;
            width: 92%;
            max-width: 520px;
            aspect-ratio: 1 / 1;     
            overflow: hidden;
            border-radius: 9999px;
            background: radial-gradient(circle at center, rgba(255,255,255,0.18), rgba(255,255,255,0.02) 55%, rgba(255,255,255,0) 70%);
            border: 10px solid rgba(255,255,255,0.15);
            box-shadow: inset 0 0 0 6px rgba(255,255,255,0.05);
            cursor: grab;
            user-select: none;
            touch-action: none;
        }

        .brand-crop-stage:active {
            cursor: grabbing;
        }

        .brand-crop-image {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transform: translate(0, 0) scale(1.08);
            transition: transform 0.08s ease-out;
            will-change: transform;
        }

        /* --- CORREÇÕES DE ESTILO SEM REMOVER ELEMENTOS --- */

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
            font-family: inherit;
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

        #recentOrdersCard.is-expanded {
            position: fixed;
            top: 50%;
            left: 50%;
            z-index: 60;
            display: flex;
            width: min(90vw, 1200px);
            height: min(80vh, 760px);
            min-width: min(320px, calc(100vw - 2rem));
            min-height: min(280px, calc(100vh - 2rem));
            max-width: calc(100vw - 2rem);
            max-height: calc(100vh - 2rem);
            flex-direction: column;
            overflow: auto;
            resize: both;
            transform: translate(-50%, -50%);
        }

        #recentOrdersCard.is-expanded > .recent-orders-table {
            min-height: 0;
            flex: 1;
            overflow: auto;
        }

        #recentOrdersBackdrop.is-visible {
            display: block;
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

        #mainContent {
            margin-left: 18rem;
            transition: margin-left 0.3s ease-in-out;
        }

        #mainContent.sidebar-expanded {
            margin-left: 0 !important;
        }

        @media (max-width: 1024px) {
            #mainContent {
                margin-left: 0 !important;
            }
        }
    </style>
</head>

<body class="sidebar-page min-h-screen flex bg-[#F8FAFC] text-[#0F172A] overflow-x-hidden">

    <div id="recentOrdersBackdrop" class="fixed inset-0 z-[55] hidden bg-slate-950/40 backdrop-blur-sm" aria-hidden="true"></div>

    <aside id="sidebar"
        class="w-72 bg-[#ffff] flex flex-col fixed top-0 left-0 text-white z-40 transition-all rounded-none overflow-hidden h-screen">


        <?php if (empty($logoEmpresaSidebar)) {
            $logoEmpresaSidebar = BASE_URL . '/img/LogoPreto.png';
        }
        ?>
       <div class="p-8 mb-4 flex justify-center">
            <img src="<?= htmlspecialchars($logoEmpresaSidebar, ENT_QUOTES, 'UTF-8') ?>"
                alt="Logo da empresa"
                class="w-32 h-auto object-contain">
        </div>
            </div>

            <nav id="sidebarMenu" class="sidebar-menu px-4 space-y-2 flex-grow">
                <a href="<?= BASE_URL ?>/routes.php?action=dashboardAdm"
                    class="menu-item active flex items-center gap-3.5 px-5 py-3 rounded-xl font-bold text-sm bg-[#4F46E5] text-black shadow-lg shadow-indigo-500/10 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Início
                </a>

                <a href="<?= BASE_URL ?>/routes.php?action=pedidos"
                    class="menu-item flex items-center gap-3.5 px-5 py-3 rounded-xl font-semibold text-sm text-slate-400 hover:text-black hover:bg-white/5 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    Pedidos
                </a>

                <a href="<?= BASE_URL ?>/routes.php?action=entregadores"
                    class="menu-item flex items-center gap-3.5 px-5 py-3 rounded-xl font-semibold text-sm text-slate-400 hover:text-black hover:bg-white/5 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-4a4 4 0 100-8 4 4 0 000 8zm6 4a2 2 0 100-4 2 2 0 000 4zM3 20v-2a2 2 0 012-2h1" />
                    </svg>
                    Entregadores
                </a>

                <a href="<?= BASE_URL ?>/routes.php?action=pedidosEntregues"
                    class="menu-item flex items-center gap-3.5 px-5 py-3 rounded-xl font-semibold text-sm text-slate-400 hover:text-black hover:bg-white/5 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                    Pedidos Entregues
                </a>

                <a href="<?= BASE_URL ?>/routes.php?action=mapaAdm"
                    class="menu-item flex items-center gap-3.5 px-5 py-3 rounded-xl font-semibold text-sm text-slate-400 hover:text-black hover:bg-white/5 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                    </svg>
                    Acompanhar Rotas
                </a>

                <a href="<?= BASE_URL ?>/routes.php?action=perfilAdm"
                    class="menu-item flex items-center gap-3.5 px-5 py-3 rounded-xl font-semibold text-sm text-slate-400 hover:text-black hover:bg-white/5 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Meu Perfil
                </a>
            </nav>

            <div class="p-4 mt-auto">
                <div class="px-4 pb-4 flex flex-col items-center gap-1.5">
                    <img src="<?= BASE_URL ?>/img/logoPreto.png"
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
                        <p class="admin-user-name font-bold text-xs text-black truncate"><?= htmlspecialchars($nomeAdmin) ?></p>
                        <p class="admin-user-role text-[10px] text-slate-500 font-bold tracking-wider uppercase">Admin</p>
                    </div>
                    <button type="button" data-logout-trigger aria-label="Sair da conta" class="text-slate-500 hover:text-rose-500 transition-colors p-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </aside>

    <?php require __DIR__ . '/partials/logout-confirmation.php'; ?>

    <!-- ================= CONTEÚDO PRINCIPAL (DASHBOARD) ================= -->
    <div id="mainContent" class="flex-1 flex flex-col min-h-screen w-full transition-all duration-300">

        <!-- HEADER DA PÁGINA -->
        <header class="bg-white border-b border-[#E2E8F0] px-8 py-5 flex items-center justify-between sticky top-0 z-30 shadow-sm gap-4">

            <div class="flex items-center gap-4 min-w-0">
                <button id="toggleSidebar" class="p-2 rounded-lg bg-slate-50 hover:bg-slate-100 border border-slate-200 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <div class="min-w-0">
                    <h1 class="page-heading flex items-center gap-2">
                        Olá, <span class="page-heading-highlight" style="color: var(--emp-primary, #f3243e);"><?= htmlspecialchars($nomeAdmin) ?>!</span>
                    </h1>
                    <p class="page-subheading">Aqui está o status das suas entregas hoje.</p>
                </div>
            </div>

            <div class="flex items-center gap-3 flex-shrink-0 ml-auto">
                <div class="hidden">
                    <div class="relative">
                        <button type="button" id="empresaLogoTrigger" class="block focus:outline-none">
                            <div class="logo-circular-wrap w-10 h-10 border border-slate-200 shadow-sm">
                                <img
                                    id="empresaLogoTop"
                                    src="<?= htmlspecialchars($logoEmpresaSidebar ?? (BASE_URL . '/img/logoIcon.png')) ?>"
                                    alt="Logo da empresa"
                                    onerror="this.onerror=null; this.src='<?= BASE_URL ?>/img/logoIcon.png';"
                                    class="logo-circular"
                                >
                            </div>
                        </button>

                        <div id="empresaMenu" class="hidden absolute right-0 top-full mt-2 w-44 bg-white border border-slate-200 rounded-2xl shadow-xl z-50 overflow-hidden">
                            <button type="button" id="empresaImageOption" class="block w-full text-left px-4 py-3 text-sm font-medium text-slate-700 hover:bg-slate-50">
                                Trocar imagem
                            </button>
                            <button type="button" id="empresaEditNameBtn" class="block w-full text-left px-4 py-3 text-sm font-medium text-slate-700 hover:bg-slate-50">
                                Editar nome
                            </button>
                        </div>

                        <div id="empresaImageCard" class="hidden fixed inset-0 z-[70] bg-black/50 backdrop-blur-[1px]">
                            <div class="absolute inset-0" data-close="empresa-card"></div>
                            <div class="relative mx-auto mt-12 max-w-5xl rounded-[26px] overflow-hidden border border-slate-700 bg-[#111b21] shadow-[0_20px_60px_rgba(0,0,0,0.45)]" style="width: min(92vw, 1100px);">
                                <div class="flex items-center justify-between px-5 py-4 border-b border-slate-700 text-white">
                                    <div class="flex items-center gap-3">
                                        <button type="button" id="empresaImageCardClose" class="text-xl text-white/90 hover:text-white">←</button>
                                        <h3 class="text-xl font-semibold">Editar perfil</h3>
                                    </div>
                                    <label for="empresaLogoInputCard" class="cursor-pointer inline-flex items-center gap-2 rounded-xl px-3 py-2 text-sm font-semibold bg-transparent text-white hover:bg-white/5 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3-3 3 3M12 16V5" />
                                        </svg>
                                        Carregar
                                    </label>
                                </div>

                                <div class="grid md:grid-cols-[260px_1fr] gap-0 min-h-[540px]">
                                    <aside class="bg-[#0b141a] px-6 py-8 border-r border-slate-700">
                                        <div class="flex justify-center">
                                            <div class="logo-circular-wrap w-32 h-32 border-2 border-slate-600 bg-slate-800 shadow-lg">
                                                <img id="empresaLogoPreview" src="<?= htmlspecialchars($logoEmpresaSidebar ?? (BASE_URL . '/img/logoIcon.png')) ?>" onerror="this.onerror=null; this.src='<?= BASE_URL ?>/img/logoIcon.png';" class="logo-circular" alt="Pré-visualização da logo">
                                            </div>
                                        </div>

                                        <div class="mt-8 text-white">
                                            <div class="text-sm text-slate-400 mb-2">Nome</div>
                                            <input id="empresaNomeInputCard" type="text" maxlength="120" value="<?= htmlspecialchars($nome_empresa, ENT_QUOTES, 'UTF-8') ?>" aria-label="Nome da empresa" class="w-full rounded-lg border border-slate-600 bg-[#15232c] px-3 py-2 text-base font-semibold text-white outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-500/20">
                                        </div>
                                    </aside>

                                    <main class="bg-[#101a22] px-6 py-8 flex flex-col justify-center">
                                        <div class="flex items-center justify-between mb-5 text-white">
                                            <h4 class="text-2xl font-semibold">Arraste a imagem para ajustar</h4>
                                        </div>

                                        <div class="relative flex-1 flex items-center justify-center rounded-[28px] border border-slate-700 bg-[#1d2b33]/70 p-4 overflow-hidden">
                                            <div id="empresaCropStage" class="brand-crop-stage">
                                                <img id="empresaLogoPreviewCrop" src="<?= htmlspecialchars($logoEmpresaSidebar ?? (BASE_URL . '/img/logoIcon.png')) ?>" onerror="this.onerror=null; this.src='<?= BASE_URL ?>/img/logoIcon.png';" class="brand-crop-image" alt="Logo ajustada">
                                            </div>
                                        </div>

                                        <div class="flex justify-end gap-3 mt-6">
                                            <button type="button" id="empresaImageCardCancel" class="border border-slate-600 text-slate-200 font-semibold px-4 py-2.5 rounded-xl text-sm hover:bg-slate-800">
                                                Cancelar
                                            </button>
                                            <button type="button" id="empresaImageCardSave" class="bg-[#4F46E5] text-white font-bold px-5 py-2.5 rounded-xl text-sm hover:bg-[#4338CA] shadow-md shadow-indigo-500/20">
                                                Salvar
                                            </button>
                                        </div>
                                    </main>
                                </div>
                            </div>
                            <input id="empresaLogoInputCard" type="file" accept="image/*" class="hidden">
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-2.5 border border-slate-200 bg-[#F8FAFC] rounded-2xl px-4 py-2 w-56 lg:w-72 focus-within:border-indigo-500 focus-within:bg-white focus-within:ring-2 focus-within:ring-indigo-500/10 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" id="campoBuscaPedidos" placeholder="Buscar pedidos, clientes..." class="bg-transparent border-none outline-none text-xs text-slate-700 placeholder-slate-400 w-full">
                </div>

            </div>
        </header>

        <!-- ÁREA DE CARDS DE INDICADORES (Dashboard Stats) -->
        <main class="flex-grow p-8 space-y-8">

            <!-- Grid de Indicadores Superiores (Stats) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                <!-- Pedidos Hoje -->
                <div class="bg-white rounded-3xl p-5 border border-slate-100 shadow-sm flex items-center gap-4 hover-card">
                    <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-500 flex items-center justify-center shadow-inner flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 font-semibold uppercase tracking-wider">Total de Pedidos</p>
                        <h4 class="text-2xl font-black text-slate-900 mt-1"><?= $totalPedidos ?></h4>
                        <span class="text-[10px] font-medium text-slate-400 mt-1 block">pedidos cadastrados</span>
                    </div>
                </div>

                <!-- Em Andamento -->
                <div class="bg-white rounded-3xl p-5 border border-slate-100 shadow-sm flex items-center gap-4 hover-card">
                    <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-500 flex items-center justify-center shadow-inner flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 font-semibold uppercase tracking-wider">Em andamento</p>
                        <h4 class="text-2xl font-black text-slate-900 mt-1"><?= $pedidosEmAndamento ?></h4>
                        <span class="text-[10px] font-medium text-slate-400 mt-1 block">A caminho agora</span>
                    </div>
                </div>

                <!-- Entregues -->
                <div class="bg-white rounded-3xl p-5 border border-slate-100 shadow-sm flex items-center gap-4 hover-card">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-500 flex items-center justify-center shadow-inner flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 font-semibold uppercase tracking-wider">Entregues</p>
                        <h4 class="text-2xl font-black text-slate-900 mt-1"><?= $pedidosEntregues ?></h4>
                        <span class="text-[10px] font-medium text-slate-400 mt-1 block">concluídos com sucesso</span>
                    </div>
                </div>

                <!-- Atrasados -->
                <div class="bg-white rounded-3xl p-5 border border-slate-100 shadow-sm flex items-center gap-4 hover-card">
                    <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-500 flex items-center justify-center shadow-inner flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 font-semibold uppercase tracking-wider">Pendentes</p>
                        <h4 class="text-2xl font-black text-slate-900 mt-1"><?= $pedidosPendentes ?></h4>
                        <span class="text-[10px] font-medium text-slate-400 mt-1 block">aguardando envio</span>
                    </div>
                </div>

            </div>

            <!-- ================= SEÇÃO CENTRAL: PEDIDOS RECENTES & GRÁFICOS ================= -->
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">

                <!-- ================= PEDIDOS RECENTES ================= -->
                <div id="recentOrdersCard" class="xl:col-span-2 w-full bg-white rounded-3xl border border-slate-100 shadow-sm p-6 space-y-6 overflow-hidden" role="dialog" aria-label="Tabela de pedidos recentes" aria-modal="false">

                    <!-- TOPO -->
                    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">

                        <div class="flex items-center justify-between gap-3">
                            <h3 class="text-lg font-extrabold text-slate-900">
                                Pedidos Recentes
                            </h3>
                            <button id="resizeRecentOrders" type="button" aria-expanded="false" aria-label="Ampliar e redimensionar a tabela de pedidos" class="flex-shrink-0 rounded-lg border border-slate-200 px-3 py-2 text-xs font-semibold text-slate-600 transition hover:bg-slate-50 hover:text-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                Ampliar tabela
                            </button>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto">

                            <!-- FILTRO -->
                            <select
                                id="filtroStatus"
                                class="border border-slate-200 bg-white text-slate-700 text-sm font-semibold rounded-xl px-4 py-2 outline-none focus:ring-2 focus:ring-indigo-500">

                                <option value="todos">Todos</option>
                                <option value="pendente">Pendentes</option>
                                <option value="a caminho">A caminho</option>
                                <option value="entregue">Entregues</option>

                            </select>

                        </div>

                    </div>

                    <!-- TABELA -->
                    <div class="recent-orders-table w-full overflow-x-auto">

                        <table class="w-full min-w-full text-left">

                            <thead>

                                <tr class="border-b border-slate-100 text-slate-400 uppercase text-xs tracking-wider">

                                    <th class="py-4 px-2">Pedido</th>
                                    <th class="py-4 px-2">Cliente</th>
                                    <th class="py-4 px-2 min-w-[260px]">Endereço</th>
                                    <th class="py-4 px-2 min-w-[220px]">Entregador</th>
                                    <th class="py-4 px-2">Status</th>
                                    <th class="py-4 px-4 whitespace-nowrap">Valor</th>
                                    <th class="py-4 px-2 text-center">Ação</th>

                                </tr>

                            </thead>

                            <tbody id="tabelaPedidos" class="divide-y divide-slate-100">

                                <?php if (empty($pedidosRecentes)): ?>

                                    <tr>

                                        <td colspan="7" class="py-12 text-center text-slate-400 font-semibold">

                                            Nenhum pedido encontrado.

                                        </td>

                                    </tr>

                                <?php else: ?>

                                    <?php foreach ($pedidosRecentes as $p):

                                        $status = strtolower(trim($p['status']));

                                        $entregador = $p['nome_entregador']
                                            ? htmlspecialchars($p['nome_entregador'])
                                            : 'Não atribuído';

                                        // BADGES
                                        if ($status === 'entregue') {

                                            $badge = '
                            <span class="bg-emerald-100 text-emerald-700 px-3 py-1 rounded-xl text-[11px] font-bold">
                                Entregue
                            </span>';
                                        } elseif ($status === 'a caminho') {

                                            $badge = '
                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-xl text-[11px] font-bold">
                                A caminho
                            </span>';
                                        } else {

                                            $badge = '
                            <span class="bg-amber-100 text-amber-700 px-3 py-1 rounded-xl text-[11px] font-bold">
                                Pendente
                            </span>';
                                        }

                                    ?>

                                        <tr
                                            class="hover:bg-slate-50 transition pedido-linha"
                                            data-status="<?= $status ?>">

                                            <!-- ID -->
                                            <td class="py-4 px-2 font-bold text-indigo-600 whitespace-nowrap">

                                                #<?= $p['id_pedido'] ?>

                                            </td>

                                            <!-- CLIENTE -->
                                            <td class="py-4 px-2 font-semibold text-slate-800 whitespace-nowrap">

                                                <?= htmlspecialchars($p['nome_cliente']) ?>

                                            </td>

                                            <!-- ENDEREÇO -->
                                            <td class="py-4 px-2 text-slate-500">

                                                <?= htmlspecialchars($p['endereco']) ?>

                                            </td>

                                            <!-- ENTREGADOR -->
                                            <td class="py-4 px-2">

                                                <?php if ($p['nome_entregador']): ?>

                                                    <div class="flex items-center gap-3">

                                                        <div class="w-8 h-8 rounded-full overflow-hidden bg-indigo-100 flex items-center justify-center text-indigo-700 text-xs font-bold">

                                                            <?= strtoupper(substr($entregador, 0, 2)) ?>

                                                        </div>

                                                        <span class="font-medium text-slate-700">

                                                            <?= $entregador ?>

                                                        </span>

                                                    </div>

                                                <?php else: ?>

                                                    <span class="text-slate-400">

                                                        Não atribuído

                                                    </span>

                                                <?php endif; ?>

                                            </td>

                                            <!-- STATUS -->
                                            <td class="py-4 px-2">

                                                <?= $badge ?>

                                            </td>

                                            <!-- VALOR -->
                                            <td class="py-4 px-4 font-bold text-emerald-600 whitespace-nowrap">
                                                R$ <?= number_format($p['preco'], 2, ',', '.') ?>
                                            </td>

                                            <!-- AÇÕES -->
                                            <td class="py-4 px-2 text-center relative">

                                                <button
                                                    onclick="toggleMenu(<?= $p['id_pedido'] ?>)"
                                                    class="w-9 h-9 rounded-xl hover:bg-slate-100 transition font-bold text-slate-500">

                                                    ⋮

                                                </button>

                                                <!-- MENU -->
                                                <div
                                                    id="menu-<?= $p['id_pedido'] ?>"
                                                    class="hidden absolute right-0 mt-2 w-44 bg-white border border-slate-200 rounded-2xl shadow-xl z-50 overflow-hidden">

                                                    <a
                                                        href="<?= BASE_URL ?>/routes.php?action=pedidos&id=<?= $p['id_pedido'] ?>"
                                                        class="block px-4 py-3 text-sm hover:bg-slate-50">

                                                        Ver Pedido

                                                    </a>

                                                    <a
                                                        href="<?= BASE_URL ?>/routes.php?action=pedidos&id=<?= $p['id_pedido'] ?>"
                                                        class="block px-4 py-3 text-sm hover:bg-slate-50">

                                                        Editar

                                                    </a>

                                                    <a
                                                        href="<?= BASE_URL ?>/routes.php?action=pedidos&id=<?= $p['id_pedido'] ?>"
                                                        class="block px-4 py-3 text-sm text-red-500 hover:bg-red-50">

                                                        Excluir

                                                    </a>

                                                </div>

                                            </td>

                                        </tr>



                                    <?php endforeach; ?>

                                <?php endif; ?>

                            </tbody>

                        </table>

                    </div>

                    <!-- RODAPÉ -->
                    <div class="flex items-center justify-between pt-4 border-t border-slate-100">

                        <span class="text-sm text-slate-400">

                            Exibindo os <?= count($pedidosRecentes) ?> pedidos mais recentes de <?= $totalPedidos ?> no total

                        </span>

                        <a
                            href="<?= BASE_URL ?>/routes.php?action=pedidos"
                            class="text-sm font-bold text-indigo-600 hover:text-indigo-800 transition">

                            Ver todos →

                        </a>

                    </div>

                </div>

                <!-- GRÁFICOS E ENTREGADORES ATIVOS (Coluna 3) -->
                <div class="space-y-8">

                    <!-- Card de Gráficos "Entregas por dia" -->
                    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6 space-y-6">
                        <div class="flex items-center justify-between">
                            <h3 class="text-sm font-extrabold text-slate-900">Entregas por dia</h3>
                            <select class="bg-[#F8FAFC] border border-slate-200 text-[10px] font-bold text-slate-600 rounded-xl px-2 py-1 outline-none">
                                <option>Esta semana</option>
                                <option>Este mês</option>
                            </select>
                        </div>

                        <!-- Gráfico Linear Desenhado em SVG de Alta Qualidade -->
                        <div class="relative py-2">
                            <svg viewBox="0 0 300 130" class="w-full h-auto">
                                <defs>
                                    <linearGradient id="chartGradient" x1="0" y1="0" x2="0" y2="1">
                                        <stop offset="0%" stop-color="#4F46E5" stop-opacity="0.15" />
                                        <stop offset="100%" stop-color="#4F46E5" stop-opacity="0" />
                                    </linearGradient>
                                </defs>
                                <!-- Grid Lines -->
                                <line x1="0" y1="10" x2="300" y2="10" stroke="#F1F5F9" stroke-dasharray="2 2" stroke-width="1" />
                                <line x1="0" y1="40" x2="300" y2="40" stroke="#F1F5F9" stroke-dasharray="2 2" stroke-width="1" />
                                <line x1="0" y1="70" x2="300" y2="70" stroke="#F1F5F9" stroke-dasharray="2 2" stroke-width="1" />
                                <line x1="0" y1="100" x2="300" y2="100" stroke="#F1F5F9" stroke-width="1" />

                                <!-- Gradiente de Preenchimento -->
                                <path d="M 0 100 L 0 55 Q 25 50 50 65 T 100 35 T 150 45 T 200 65 T 250 35 T 300 45 L 300 100 Z" fill="url(#chartGradient)" />

                                <!-- Linha do Gráfico -->
                                <path d="M 0 55 Q 25 50 50 65 T 100 35 T 150 45 T 200 65 T 250 35 T 300 45" fill="none" stroke="#4F46E5" stroke-width="2.5" />

                                <!-- Marcadores -->
                                <circle cx="100" cy="35" r="4.5" fill="#4F46E5" stroke="#FFFFFF" stroke-width="1.5" />
                                <circle cx="250" cy="35" r="4.5" fill="#4F46E5" stroke="#FFFFFF" stroke-width="1.5" />

                                <!-- Tooltip Mockup -->
                                <g transform="translate(75, -5)">
                                    <rect x="0" y="0" width="60" height="24" rx="6" fill="#0F172A" />
                                    <text x="30" y="10" fill="#FFFFFF" font-size="7" font-weight="bold" text-anchor="middle">Qua, 15/05</text>
                                    <text x="30" y="18" fill="#FFD400" font-size="7" font-weight="extrabold" text-anchor="middle">75 entregas</text>
                                </g>
                            </svg>
                            <div class="flex justify-between text-[9px] text-slate-400 font-bold mt-2 uppercase px-1">
                                <span>Seg</span><span>Ter</span><span>Qua</span><span>Qui</span><span>Sex</span><span>Sáb</span><span>Dom</span>
                            </div>
                        </div>

                    </div>

                    <!-- Entregadores Ativos -->
                    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6 space-y-4">
                        <div class="flex items-center justify-between">
                            <h3 class="text-sm font-extrabold text-slate-900">Entregadores ativos</h3>
                            <a href="<?= BASE_URL ?>/routes.php?action=entregadores" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 transition">Ver todos</a>
                        </div>

                        <div class="space-y-3.5">

                            <?php if (empty($entregadoresComContagem)): ?>
                                <p class="text-xs text-slate-400 text-center py-4">Nenhum entregador cadastrado.</p>
                            <?php else: ?>
                                <?php foreach ($entregadoresComContagem as $e):
                                    $nomeEnt      = htmlspecialchars($e['nome_completo']);
                                    $totalEnt     = (int)$e['total_entregas'];
                                ?>
                                    <div class="flex items-center justify-between text-xs font-medium">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full overflow-hidden border border-slate-100 shadow-sm">
                                                <img src="https://ui-avatars.com/api/?name=<?= urlencode($nomeEnt) ?>&background=EEF2FF&color=4F46E5&bold=true&size=64"
                                                    class="w-full h-full object-cover">
                                            </div>
                                            <div>
                                                <p class="font-bold text-slate-800"><?= $nomeEnt ?></p>
                                                <p class="text-[9px] text-emerald-500 font-bold flex items-center gap-1 mt-0.5">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-ping"></span>
                                                    Ativo
                                                </p>
                                            </div>
                                        </div>
                                        <span class="text-slate-400 font-bold"><?= $totalEnt ?> entregas</span>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>

                        </div>
                    </div>

                </div>

            </div>

            <!-- ================= SEÇÃO INFERIOR: METRICAS ADICIONAIS & DICA DO DIA ================= -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                <!-- Total de Clientes -->
                <div class="bg-white rounded-3xl p-5 border border-slate-100 shadow-sm flex items-center gap-4 hover-card">
                    <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-500 flex items-center justify-center shadow-inner flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 font-semibold uppercase tracking-wider">Total de Clientes</p>
                        <h4 class="text-xl font-black text-slate-900 mt-1">5.423</h4>
                        <span class="text-[10px] font-bold text-emerald-500 flex items-center gap-0.5 mt-0.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                            </svg>
                            10% <span class="text-slate-400 font-medium">vs mês passado</span>
                        </span>
                    </div>
                </div>

                <!-- Taxa de Entrega -->
                <div class="bg-white rounded-3xl p-5 border border-slate-100 shadow-sm flex items-center gap-4 hover-card">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-500 flex items-center justify-center shadow-inner flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 font-semibold uppercase tracking-wider">Taxa de Entrega</p>
                        <h4 class="text-xl font-black text-slate-900 mt-1">96.2%</h4>
                        <span class="text-[10px] font-bold text-emerald-500 flex items-center gap-0.5 mt-0.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                            </svg>
                            2.5% <span class="text-slate-400 font-medium">vs mês passado</span>
                        </span>
                    </div>
                </div>

                <!-- Satisfação -->
                <div class="bg-white rounded-3xl p-5 border border-slate-100 shadow-sm flex items-center gap-4 hover-card">
                    <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-500 flex items-center justify-center shadow-inner flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 font-semibold uppercase tracking-wider">Satisfação</p>
                        <h4 class="text-xl font-black text-slate-900 mt-1">4.8 <span class="text-xs text-slate-400 font-bold">/ 5</span></h4>
                        <span class="text-[10px] font-bold text-emerald-500 flex items-center gap-0.5 mt-0.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                            </svg>
                            0.3 <span class="text-slate-400 font-medium">vs mês passado</span>
                        </span>
                    </div>
                </div>

                <!-- Dica do Dia -->
                <div class="bg-gradient-to-br from-amber-50 to-amber-100/50 rounded-3xl p-5 border border-amber-200/40 shadow-sm flex items-start gap-4 hover-card relative overflow-hidden">
                    <div class="absolute -right-4 -bottom-4 w-16 h-16 bg-amber-200/20 rounded-full blur-lg"></div>
                    <div class="w-10 h-10 rounded-xl bg-amber-400 text-white flex items-center justify-center shadow flex-shrink-0 mt-0.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs text-amber-800 font-bold uppercase tracking-wider flex items-center justify-between">
                            Dica do dia

                        </p>
                        <p class="text-[11px] text-amber-900/85 leading-relaxed mt-1.5 font-medium">
                            Organize suas rotas por regiões para otimizar o tempo das entregas e reduzir custos.
                        </p>
                    </div>
                </div>

            </div>

            <!-- ================= DICAS E MELHORES PRÁTICAS DO SISTEMA ================= -->
            <section class="space-y-6 pt-4">

                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-extrabold text-slate-900" style="font-family: 'Brice-Bold', sans-serif;">Dicas e Melhores Práticas</h2>
                    <span class="h-px bg-slate-200 flex-grow mx-6 hidden md:block"></span>
                    <span class="text-xs font-bold text-[#1B138F] tracking-wider uppercase">GUIAR Academy</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-5">

                    <!-- Dica 1 -->
                    <div class="bg-white rounded-3xl p-5 border border-slate-100 shadow-sm flex flex-col justify-between hover-card">
                        <div class="w-11 h-11 rounded-2xl bg-amber-50 text-amber-500 flex items-center justify-center shadow-inner mb-4">
                            <img src="<?= BASE_URL ?>/img/icon1.png" alt="Organize seus pedidos" class="w-6 h-6 object-contain">
                        </div>
                        <div>
                            <h3 class="font-bold text-sm text-slate-900">Organize seus pedidos</h3>
                            <p class="text-xs text-slate-400 leading-relaxed mt-1.5 font-medium">Utilize filtros para visualizar pedidos específicos.</p>
                        </div>
                    </div>

                    <!-- Dica 2 -->
                    <div class="bg-white rounded-3xl p-5 border border-slate-100 shadow-sm flex flex-col justify-between hover-card">
                        <div class="w-11 h-11 rounded-2xl bg-sky-50 text-sky-500 flex items-center justify-center shadow-inner mb-4">
                            <img src="<?= BASE_URL ?>/img/icon2.png" alt="Comunique-se com os entregadores" class="w-6 h-6 object-contain">
                        </div>
                        <div>
                            <h3 class="font-bold text-sm text-slate-900">Comunique-se com os entregadores</h3>
                            <p class="text-xs text-slate-400 leading-relaxed mt-1.5 font-medium">Mantenha contato direto para evitar atrasos.</p>
                        </div>
                    </div>

                    <!-- Dica 3 -->
                    <div class="bg-white rounded-3xl p-5 border border-slate-100 shadow-sm flex flex-col justify-between hover-card">
                        <div class="w-11 h-11 rounded-2xl bg-indigo-50 text-indigo-500 flex items-center justify-center shadow-inner mb-4">
                            <img src="<?= BASE_URL ?>/img/icon3.png" alt="Revise feedbacks" class="w-6 h-6 object-contain">
                        </div>
                        <div>
                            <h3 class="font-bold text-sm text-slate-900">Revise feedbacks</h3>
                            <p class="text-xs text-slate-400 leading-relaxed mt-1.5 font-medium">Analise as avaliações dos clientes para melhorar o serviço.</p>
                        </div>
                    </div>

                    <!-- Dica 4 -->
                    <div class="bg-white rounded-3xl p-5 border border-slate-100 shadow-sm flex flex-col justify-between hover-card">
                        <div class="w-11 h-11 rounded-2xl bg-emerald-50 text-emerald-500 flex items-center justify-center shadow-inner mb-4">
                            <img src="<?= BASE_URL ?>/img/icon4.png" alt="Mantenha registros atualizados" class="w-6 h-6 object-contain">
                        </div>
                        <div>
                            <h3 class="font-bold text-sm text-slate-900">Mantenha registros atualizados</h3>
                            <p class="text-xs text-slate-400 leading-relaxed mt-1.5 font-medium">Certeza de que todos os dados dos motoboys estejam corretos.</p>
                        </div>
                    </div>

                    <!-- Dica 5 -->
                    <div class="bg-white rounded-3xl p-5 border border-slate-100 shadow-sm flex flex-col justify-between hover-card">
                        <div class="w-11 h-11 rounded-2xl bg-rose-50 text-rose-500 flex items-center justify-center shadow-inner mb-4">
                            <img src="<?= BASE_URL ?>/img/icon5.png" alt="Use relatórios" class="w-6 h-6 object-contain">
                        </div>
                        <div>
                            <h3 class="font-bold text-sm text-slate-900">Use relatórios</h3>
                            <p class="text-xs text-slate-400 leading-relaxed mt-1.5 font-medium">Gere relatórios periódicos para acompanhar o desempenho das entregas.</p>
                        </div>
                    </div>

                </div>

            </section>

        </main>

    </div>

    <script>
        // =========================
        // ELEMENTOS
        // =========================

        const campoBuscaTabela = document.getElementById('campoBusca');
        const campoBuscaGeral = document.getElementById('campoBuscaPedidos');
        const filtroStatus = document.getElementById('filtroStatus');

        // =========================
        // BUSCA DA TABELA
        // =========================

        function filtrarTabela() {

            const textoBusca = campoBuscaTabela.value.toLowerCase().trim();
            const statusFiltro = filtroStatus.value;

            const linhas = document.querySelectorAll('.pedido-linha');

            linhas.forEach((linha) => {

                const conteudo = linha.textContent.toLowerCase();
                const status = linha.dataset.status;

                const buscaOk = conteudo.includes(textoBusca);

                const statusOk =
                    statusFiltro === 'todos' ||
                    status === statusFiltro;

                // RESET
                linha.style.display = '';
                linha.style.filter = '';
                linha.style.opacity = '';
                linha.style.transform = '';
                linha.style.transition = 'all 0.25s ease';
                linha.style.backgroundColor = '';
                linha.style.zIndex = '';

                // FILTRO DE STATUS
                if (!statusOk) {

                    linha.style.display = 'none';
                    return;

                }

                // SE TIVER TEXTO NA BUSCA
                if (textoBusca !== '') {

                    if (buscaOk) {

                        // DESTACA A LINHA ENCONTRADA
                        linha.style.filter = 'blur(0px)';
                        linha.style.opacity = '1';
                        linha.style.transform = 'scale(1.01)';
                        linha.style.backgroundColor = '#ffffff';
                        linha.style.position = 'relative';
                        linha.style.zIndex = '10';

                    } else {

                        // DESFOCA AS OUTRAS
                        linha.style.filter = 'blur(2px)';
                        linha.style.opacity = '0.2';
                        linha.style.transform = 'scale(0.98)';

                    }

                }

            });

        }

        // =========================
        // BUSCA GERAL DA PÁGINA
        // =========================

        function buscaGeralPagina() {

            const texto = campoBuscaGeral.value.toLowerCase().trim();

            // TODOS OS BLOCOS PRINCIPAIS
            const elementos = document.querySelectorAll(
                'main section, main .hover-card, main .pedido-linha, main .bg-white'
            );

            elementos.forEach((elemento) => {

                const conteudo = elemento.textContent.toLowerCase();

                // RESET
                elemento.style.transition = 'all 0.25s ease';
                elemento.style.filter = '';
                elemento.style.opacity = '';
                elemento.style.transform = '';
                elemento.style.outline = '';

                // SEM TEXTO = NORMAL
                if (texto === '') return;

                // ENCONTROU
                if (conteudo.includes(texto)) {

                    elemento.style.filter = 'blur(0px)';
                    elemento.style.opacity = '1';
                    elemento.style.transform = 'scale(1.01)';
                    elemento.style.position = 'relative';
                    elemento.style.zIndex = '20';
                    elemento.style.outline = '2px solid rgba(79,70,229,0.15)';

                } else {

                    // DESFOCA RESTO DA PÁGINA
                    elemento.style.filter = 'blur(3px)';
                    elemento.style.opacity = '0.18';
                    elemento.style.transform = 'scale(0.98)';

                }

            });

        }

        // =========================
        // EVENTOS
        // =========================

        // BUSCA DA TABELA
        campoBuscaTabela.addEventListener('keyup', filtrarTabela);

        filtroStatus.addEventListener('change', filtrarTabela);

        // BUSCA GERAL
        campoBuscaGeral.addEventListener('keyup', buscaGeralPagina);

        // =========================
        // MENU DE AÇÕES
        // =========================

        function toggleMenu(id) {

            document.querySelectorAll('[id^="menu-"]').forEach(menu => {

                if (menu.id !== `menu-${id}`) {

                    menu.classList.add('hidden');

                }

            });

            const menu = document.getElementById(`menu-${id}`);

            menu.classList.toggle('hidden');

        }

        // =========================
        // FECHAR MENU AO CLICAR FORA
        // =========================

        document.addEventListener('click', function(e) {

            if (!e.target.closest('[onclick^="toggleMenu"]')) {

                document.querySelectorAll('[id^="menu-"]').forEach(menu => {

                    menu.classList.add('hidden');

                });

            }

        });
    </script>

    <script>
        const empresaLogoTrigger = document.getElementById('empresaLogoTrigger');
        const empresaMenu = document.getElementById('empresaMenu');
        const empresaLogoTop = document.getElementById('empresaLogoTop');
        const empresaEditNameBtn = document.getElementById('empresaEditNameBtn');
        const empresaImageOption = document.getElementById('empresaImageOption');
        const empresaImageCard = document.getElementById('empresaImageCard');
        const empresaImageCardClose = document.getElementById('empresaImageCardClose');
        const empresaImageCardCancel = document.getElementById('empresaImageCardCancel');
        const empresaImageCardSave = document.getElementById('empresaImageCardSave');
        const empresaLogoPreview = document.getElementById('empresaLogoPreview');
        const empresaLogoPreviewCrop = document.getElementById('empresaLogoPreviewCrop');
        const empresaLogoInputCard = document.getElementById('empresaLogoInputCard');
        const empresaNomeInputCard = document.getElementById('empresaNomeInputCard');
        const empresaCropStage = document.getElementById('empresaCropStage');

        let cropState = {
            active: false,
            x: 0,
            y: 0,
            startX: 0,
            startY: 0,
            originX: 0,
            originY: 0,
        };

        const applyCompanyLogo = (src) => {
            if (empresaLogoTop) empresaLogoTop.src = src;
            if (empresaLogoPreview) empresaLogoPreview.src = src;
            if (empresaLogoPreviewCrop) empresaLogoPreviewCrop.src = src;
            localStorage.setItem('guiar_empresa_logo_url', src);
        };

        const closeAllMenus = () => {
            if (empresaMenu) empresaMenu.classList.add('hidden');
            if (empresaImageCard) empresaImageCard.classList.add('hidden');
        };

        const setCropPosition = (x, y) => {
            if (!empresaLogoPreviewCrop) return;
            empresaLogoPreviewCrop.style.transform = `translate(${x}px, ${y}px) scale(1.08)`;
        };

        if (empresaCropStage && empresaLogoPreviewCrop) {
            empresaCropStage.addEventListener('pointerdown', (event) => {
                cropState.active = true;
                cropState.startX = event.clientX;
                cropState.startY = event.clientY;
                cropState.originX = cropState.x;
                cropState.originY = cropState.y;
                empresaLogoPreviewCrop.setPointerCapture?.(event.pointerId);
            });

            empresaCropStage.addEventListener('pointermove', (event) => {
                if (!cropState.active) return;

                const deltaX = event.clientX - cropState.startX;
                const deltaY = event.clientY - cropState.startY;
                cropState.x = cropState.originX + deltaX;
                cropState.y = cropState.originY + deltaY;
                setCropPosition(cropState.x, cropState.y);
            });

            const stopCropDrag = () => {
                cropState.active = false;
            };

            empresaCropStage.addEventListener('pointerup', stopCropDrag);
            empresaCropStage.addEventListener('pointerleave', stopCropDrag);
            empresaCropStage.addEventListener('pointercancel', stopCropDrag);
        }

        if (empresaLogoTrigger && empresaMenu) {
            empresaLogoTrigger.addEventListener('click', () => {
                empresaMenu.classList.toggle('hidden');
                if (empresaImageCard) empresaImageCard.classList.add('hidden');
            });

            document.addEventListener('click', (event) => {
                if (!empresaLogoTrigger.contains(event.target) && empresaMenu && !empresaMenu.contains(event.target) && empresaImageCard && !empresaImageCard.contains(event.target)) {
                    closeAllMenus();
                }
            });
        }

        if (empresaImageOption) {
            empresaImageOption.addEventListener('click', () => {
                if (empresaMenu) empresaMenu.classList.add('hidden');
                if (empresaImageCard) {
                    empresaImageCard.classList.remove('hidden');
                    const nomeAtual = document.getElementById('empresaNomeDisplay');
                    if (empresaNomeInputCard && nomeAtual) empresaNomeInputCard.value = nomeAtual.textContent.trim();
                    if (empresaLogoTop && empresaLogoPreview) {
                        empresaLogoPreview.src = empresaLogoTop.src;
                    }
                    if (empresaLogoPreviewCrop && empresaLogoTop) {
                        empresaLogoPreviewCrop.src = empresaLogoTop.src;
                    }
                }
            });
        }

        if (empresaEditNameBtn) {
            empresaEditNameBtn.addEventListener('click', () => {
                if (empresaMenu) empresaMenu.classList.add('hidden');
                if (empresaImageCard) empresaImageCard.classList.remove('hidden');
                const nomeAtual = document.getElementById('empresaNomeDisplay');
                if (empresaNomeInputCard && nomeAtual) empresaNomeInputCard.value = nomeAtual.textContent.trim();
                empresaNomeInputCard?.focus();
            });
        }

        if (empresaImageCardClose) {
            empresaImageCardClose.addEventListener('click', () => closeAllMenus());
        }

        if (empresaImageCardCancel) {
            empresaImageCardCancel.addEventListener('click', () => closeAllMenus());
        }

        if (empresaLogoInputCard) {
            empresaLogoInputCard.addEventListener('change', (event) => {
                const file = event.target.files && event.target.files[0];
                if (!file) return;

                const reader = new FileReader();
                reader.onload = (e) => {
                    const result = e.target.result;
                    if (empresaLogoPreview) empresaLogoPreview.src = result;
                    if (empresaLogoPreviewCrop) empresaLogoPreviewCrop.src = result;
                    applyCompanyLogo(result);
                };
                reader.readAsDataURL(file);
            });
        }

        if (empresaImageCardSave) {
            empresaImageCardSave.addEventListener('click', () => {
                const empresaNomeDisplay = document.getElementById('empresaNomeDisplay');
                const novoNome = empresaNomeInputCard ? empresaNomeInputCard.value.trim() : '';
                if (novoNome && empresaNomeDisplay) {
                    empresaNomeDisplay.textContent = novoNome;
                    localStorage.setItem('guiar_empresa_nome', novoNome);
                }
                closeAllMenus();
            });
        }

        const localLogo = localStorage.getItem('guiar_empresa_logo_url');
        if (localLogo) {
            applyCompanyLogo(localLogo);
        }

        const localNome = localStorage.getItem('guiar_empresa_nome');
        if (localNome) {
            const empresaNomeDisplay = document.getElementById('empresaNomeDisplay');
            if (empresaNomeDisplay) empresaNomeDisplay.textContent = localNome;
            if (empresaNomeInputCard) empresaNomeInputCard.value = localNome;
        }
    </script>

    <script>
        // =========================
        // SIDEBAR RESPONSIVA
        // =========================

        const toggleSidebarBtn = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');

        toggleSidebarBtn.addEventListener('click', () => {

            // MOBILE
            if (window.innerWidth <= 1024) {

                sidebar.classList.toggle('mobile-open');

            }

            // DESKTOP
            else {

                sidebar.classList.toggle('sidebar-closed');
                mainContent.classList.toggle('sidebar-expanded');

            }

        });

        // FECHAR AO CLICAR FORA NO MOBILE
        document.addEventListener('click', (e) => {

            if (
                window.innerWidth <= 1024 &&
                !sidebar.contains(e.target) &&
                !toggleSidebarBtn.contains(e.target)
            ) {

                sidebar.classList.remove('mobile-open');

            }

        });
    </script>

    <script>
        const recentOrdersCard = document.getElementById('recentOrdersCard');
        const resizeRecentOrdersButton = document.getElementById('resizeRecentOrders');
        const recentOrdersBackdrop = document.getElementById('recentOrdersBackdrop');
        let recentOrdersSize = null;

        function setRecentOrdersExpanded(expanded) {
            if (expanded) {
                recentOrdersCard.style.width = recentOrdersSize ? `${recentOrdersSize.width}px` : '';
                recentOrdersCard.style.height = recentOrdersSize ? `${recentOrdersSize.height}px` : '';
            } else if (recentOrdersCard.classList.contains('is-expanded')) {
                const { width, height } = recentOrdersCard.getBoundingClientRect();
                recentOrdersSize = { width, height };
            }

            recentOrdersCard.classList.toggle('is-expanded', expanded);
            recentOrdersBackdrop.classList.toggle('is-visible', expanded);
            resizeRecentOrdersButton.setAttribute('aria-expanded', String(expanded));
            resizeRecentOrdersButton.setAttribute(
                'aria-label',
                expanded ? 'Redimensionar ou restaurar a tabela de pedidos' : 'Ampliar e redimensionar a tabela de pedidos'
            );
            resizeRecentOrdersButton.textContent = expanded ? 'Restaurar tabela' : 'Ampliar tabela';
            recentOrdersCard.setAttribute('aria-modal', String(expanded));

            if (expanded) {
                resizeRecentOrdersButton.focus();
            } else {
                recentOrdersCard.style.removeProperty('width');
                recentOrdersCard.style.removeProperty('height');
                resizeRecentOrdersButton.focus();
            }
        }

        resizeRecentOrdersButton.addEventListener('click', () => {
            setRecentOrdersExpanded(!recentOrdersCard.classList.contains('is-expanded'));
        });

        recentOrdersBackdrop.addEventListener('click', () => setRecentOrdersExpanded(false));

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && recentOrdersCard.classList.contains('is-expanded')) {
                setRecentOrdersExpanded(false);
            }
        });
    </script>

    <?php
    $logoEmpresaDashboard = '';
    if (isset($company_id) && isset($this->empresaModel)) {
        $empresaInfo = $this->empresaModel->getById($company_id);
        if (!empty($empresaInfo['nome_arquivo'])) {
            $logoEmpresaDashboard = BASE_URL . '/public/uploads/empresas/' . htmlspecialchars($empresaInfo['nome_arquivo']);
        }
    }
    ?>
    <script>
        window.GUIAR_EMPRESA_LOGO = <?= json_encode($logoEmpresaDashboard) ?>;
    </script>
    <script src="<?= BASE_URL ?>/public/js/empresa-palette.js"></script>
</body>

</html>