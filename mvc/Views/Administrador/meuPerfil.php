<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="Shortcut Icon" type="image/png" href="img/logoIcon.png" class=" w-50 h-60 object-contain">
    <title>Meu Perfil | Administrador - GUIAR</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?= BASE_URL ?>/style/sidebar.css">

    <!-- Google Fonts: Inter & Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">

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
    </style>
</head>

<body class="sidebar-page bg-[#f1f4fa] text-slate-800 antialiased min-h-screen flex flex-col md:flex-row">

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

                <!-- MAPA -->
                <a href="<?= BASE_URL ?>/routes.php?action=mapaAdm"
                    class="menu-item flex items-center gap-3.5 px-4 py-3 rounded-xl font-semibold text-sm text-slate-500 hover:text-slate-900 hover:bg-slate-100/80 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                    </svg>
                    Acompanhar Rotas
                </a>

                <!-- PERFIL (ATIVO) -->
                <a href="<?= BASE_URL ?>/routes.php?action=perfilAdm"
                    class="menu-item active flex items-center gap-3.5 px-4 py-3 rounded-xl font-bold text-sm transition-all"
                    style="background-color: var(--emp-primary, #4F46E5); color: var(--emp-primary-contrast, #ffffff); box-shadow: 0 8px 18px -4px var(--emp-primary-ring, rgba(79, 70, 229, 0.35));">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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

    <!-- MAIN CONTENT -->
    <main class="flex-1 flex flex-col min-h-screen w-full md:ml-72">

        <!-- HEADER MODERNO -->
        <header class="bg-white/80 backdrop-blur-md border-b border-slate-200/80 px-4 md:px-8 py-3.5 md:py-4 flex items-center justify-between gap-4 sticky top-0 z-20 flex-shrink-0">

            <div class="flex items-center gap-3.5 min-w-0">
                <!-- BOTÃO HAMBURGER MOBILE -->
                <button id="hamburger"
                    class="md:hidden flex items-center justify-center w-10 h-10 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 transition-colors flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <!-- ÍCONE DA ABA -->
                <div class="hidden sm:flex items-center justify-center flex-shrink-0 transition-transform hover:scale-105"
                    style="color: var(--emp-primary, #4F46E5);">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>

                <div class="min-w-0">
                    <h1 class="heading-font text-lg md:text-xl font-extrabold text-slate-900 tracking-tight truncate">
                        Meu Perfil
                    </h1>
                    <p class="text-xs md:text-sm text-slate-500 font-medium truncate">
                        Gerencie suas informações pessoais e credenciais de acesso
                    </p>
                </div>
            </div>

            <!-- CHIP DE STATUS DO ADMIN -->
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold border"
                    style="background-color: var(--emp-primary-light, #EEF2FF); color: var(--emp-primary, #4F46E5); border-color: var(--emp-primary-light-border, #C7D2FE);">
                    <span class="w-2 h-2 rounded-full animate-pulse" style="background-color: var(--emp-primary, #4F46E5);"></span>
                    <span>Gestor Ativo</span>
                </span>
            </div>
        </header>

        <!-- ÁREA DO CONTEÚDO DO PERFIL -->
        <div class="flex-1 flex items-center justify-center p-4 sm:p-8 lg:p-12">
            <div class="w-full max-w-xl">

                <!-- ALERTAS DE SUCESSO / ERRO -->
                <?php if (!empty($sucesso)): ?>
                    <div class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-semibold flex items-center gap-3 shadow-sm animate-fade-in">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span><?= htmlspecialchars($sucesso) ?></span>
                    </div>
                <?php endif; ?>

                <?php if (!empty($erro)): ?>
                    <div class="mb-6 p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-sm font-semibold flex items-center gap-3 shadow-sm animate-fade-in">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-rose-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span><?= htmlspecialchars($erro) ?></span>
                    </div>
                <?php endif; ?>

                <!-- CARD PRINCIPAL DO PERFIL -->
                <div class="bg-white rounded-3xl shadow-sm border border-slate-200/90 p-6 sm:p-10 text-center relative overflow-hidden transition-all">

                    <!-- FAIXA SUPERIOR DECORATIVA -->
                    <div class="absolute top-0 left-0 right-0 h-28 opacity-90"
                        style="background: linear-gradient(135deg, var(--emp-primary, #4F46E5) 0%, var(--emp-primary-hover, #4338CA) 100%);">
                    </div>

                    <?php
                    $imagem_path = !empty($admin["nome_foto"])
                        ? BASE_URL . "/public/uploads/empresas/" . rawurlencode($nome_empresa) . "/" . rawurlencode($admin["nome_foto"])
                        : '';
                    ?>

                    <!-- FOTO DE PERFIL / AVATAR -->
                    <div class="relative flex justify-center mt-6 mb-4">
                        <div class="relative">
                            <?php if (!empty($imagem_path)): ?>
                                <img src="<?= $imagem_path ?>"
                                    alt="Foto de <?= htmlspecialchars($admin["nome_adm"] ?? 'Admin') ?>"
                                    class="w-28 h-28 sm:w-32 sm:h-32 rounded-full object-cover ring-4 ring-white shadow-xl">
                            <?php else: ?>
                                <div class="w-28 h-28 sm:w-32 sm:h-32 rounded-full ring-4 ring-white shadow-xl font-black text-2xl sm:text-3xl flex items-center justify-center"
                                    style="background-color: var(--emp-secondary, #FFD400); color: var(--emp-secondary-contrast, #0F172A);">
                                    <?= strtoupper(substr($admin["nome_adm"] ?? 'AD', 0, 2)) ?>
                                </div>
                            <?php endif; ?>

                            <div class="absolute bottom-1 right-1 w-6 h-6 rounded-full bg-emerald-500 border-2 border-white shadow-sm flex items-center justify-center text-white text-[10px]" title="Online">
                                ✓
                            </div>
                        </div>
                    </div>

                    <h2 class="heading-font text-2xl sm:text-3xl font-extrabold text-slate-900 mb-1">
                        <?= htmlspecialchars($admin["nome_adm"] ?? 'Administrador') ?>
                    </h2>

                    <p class="text-xs sm:text-sm text-slate-400 font-semibold mb-6 flex items-center justify-center gap-1.5">
                        <span class="w-2 h-2 rounded-full" style="background-color: var(--emp-primary, #4F46E5);"></span>
                        Administrador da Plataforma • <?= htmlspecialchars($nome_empresa ?? '') ?>
                    </p>

                    <!-- DETALHES EM TILES MODERNOS -->
                    <div class="space-y-3 text-left mb-8">
                        <div class="bg-slate-50/80 rounded-2xl p-4 border border-slate-100 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-white border border-slate-200/80 flex items-center justify-center text-slate-500 shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div>
                                    <span class="block text-[11px] font-bold uppercase tracking-wider text-slate-400">Nome de Usuário</span>
                                    <span class="font-bold text-sm text-slate-800"><?= htmlspecialchars($admin["nome_usuario"] ?? '') ?></span>
                                </div>
                            </div>
                            <span class="text-xs font-semibold text-slate-400">Login</span>
                        </div>

                        <div class="bg-slate-50/80 rounded-2xl p-4 border border-slate-100 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-white border border-slate-200/80 flex items-center justify-center text-slate-500 shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                </div>
                                <div>
                                    <span class="block text-[11px] font-bold uppercase tracking-wider text-slate-400">Empresa Vinculada</span>
                                    <span class="font-bold text-sm text-slate-800"><?= htmlspecialchars($nome_empresa ?? '') ?></span>
                                </div>
                            </div>
                            <span class="text-xs font-bold" style="color: var(--emp-primary, #4F46E5);">Principal</span>
                        </div>
                    </div>

                    <!-- BOTÃO EDITAR PERFIL -->
                    <button id="openEditModalBtn" type="button"
                        class="w-full py-3.5 px-6 rounded-2xl text-sm font-bold shadow-md hover:shadow-lg transition-all flex items-center justify-center gap-2 active:scale-98"
                        style="background-color: var(--emp-primary, #4F46E5); color: var(--emp-primary-contrast, #ffffff); box-shadow: 0 6px 20px var(--emp-primary-ring, rgba(79, 70, 229, 0.25));">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Editar Informações do Perfil
                    </button>
                </div>
            </div>
        </div>
    </main>

    <!-- MODAL DE EDIÇÃO -->
    <div id="editProfileModal"
        class="hidden fixed inset-0 z-50 bg-slate-950/60 backdrop-blur-sm flex items-center justify-center p-4">

        <div class="bg-white rounded-3xl w-full max-w-lg p-6 sm:p-8 relative shadow-2xl border border-slate-100 animate-scale-up">

            <!-- FECHAR -->
            <button id="closeEditModalBtn" type="button"
                class="absolute top-6 right-6 text-slate-400 hover:text-slate-700 text-xl font-bold w-8 h-8 rounded-full flex items-center justify-center hover:bg-slate-100 transition-colors">
                ✕
            </button>

            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center"
                    style="background-color: var(--emp-primary-light, #EEF2FF); color: var(--emp-primary, #4F46E5);">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </div>
                <div>
                    <h3 class="heading-font text-xl font-extrabold text-slate-900">
                        Editar Meu Perfil
                    </h3>
                    <p class="text-xs text-slate-500">Atualize seus dados de acesso como gestor</p>
                </div>
            </div>

            <form action="<?= BASE_URL ?>/routes.php?action=editarPerfilAdm"
                method="POST"
                enctype="multipart/form-data"
                class="space-y-4">

                <div>
                    <label class="block mb-1.5 text-xs font-bold uppercase tracking-wider text-slate-600">
                        Nome Completo
                    </label>
                    <input type="text"
                        id="nome_adm"
                        name="nome_adm"
                        value="<?= htmlspecialchars($admin["nome_adm"] ?? '') ?>"
                        required
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-800 text-sm font-medium focus:outline-none focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all">
                </div>

                <div>
                    <label class="block mb-1.5 text-xs font-bold uppercase tracking-wider text-slate-600">
                        Nome de Usuário
                    </label>
                    <input type="text"
                        id="nome_usuario"
                        name="nome_usuario"
                        value="<?= htmlspecialchars($admin["nome_usuario"] ?? '') ?>"
                        required
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-800 text-sm font-medium focus:outline-none focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all">
                </div>

                <div>
                    <label class="block mb-1.5 text-xs font-bold uppercase tracking-wider text-slate-600">
                        Nova Senha
                    </label>
                    <input type="password"
                        id="senha"
                        name="senha"
                        placeholder="••••••••"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-800 text-sm font-medium focus:outline-none focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all">
                    <span class="text-[11px] text-slate-400 mt-1 block">
                        Deixe em branco caso deseje manter a senha atual.
                    </span>
                </div>

                <div>
                    <label class="block mb-1.5 text-xs font-bold uppercase tracking-wider text-slate-600">
                        Foto de Perfil
                    </label>
                    <input type="file"
                        id="foto"
                        name="foto"
                        accept="image/*"
                        class="w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200 cursor-pointer">
                </div>

                <div class="pt-4 flex items-center justify-end gap-3">
                    <button type="button" id="cancelEditModalBtn"
                        class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 font-semibold text-sm transition-colors">
                        Cancelar
                    </button>
                    <button type="submit"
                        class="px-6 py-2.5 rounded-xl font-bold text-sm shadow-md transition-all active:scale-98"
                        style="background-color: var(--emp-primary, #4F46E5); color: var(--emp-primary-contrast, #ffffff);">
                        Salvar Alterações
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- SCRIPTS -->
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

        // MODAL DE EDIÇÃO
        const modal = document.getElementById("editProfileModal");
        const openBtn = document.getElementById("openEditModalBtn");
        const closeBtn = document.getElementById("closeEditModalBtn");
        const cancelBtn = document.getElementById("cancelEditModalBtn");

        if (openBtn && modal) {
            openBtn.addEventListener("click", () => {
                modal.classList.remove("hidden");
            });
        }

        if (closeBtn && modal) {
            closeBtn.addEventListener("click", () => {
                modal.classList.add("hidden");
            });
        }

        if (cancelBtn && modal) {
            cancelBtn.addEventListener("click", () => {
                modal.classList.add("hidden");
            });
        }

        window.addEventListener("click", (event) => {
            if (event.target === modal) {
                modal.classList.add("hidden");
            }
        });
    </script>

    <!-- PALETA DINÂMICA DA EMPRESA -->
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
    if (empty($logoEmpresaDashboard) && !empty($logoEmpresaSidebar)) {
        $logoEmpresaDashboard = $logoEmpresaSidebar;
    }
    ?>
    <script>
        window.GUIAR_EMPRESA_LOGO = <?= json_encode($logoEmpresaDashboard) ?>;
    </script>
    <script src="<?= BASE_URL ?>/public/js/empresa-palette.js"></script>
</body>

</html>
