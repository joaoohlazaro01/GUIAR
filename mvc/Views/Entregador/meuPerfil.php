<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Perfil | Entregador</title>
    <link rel="shortcut icon" type="image/png" href="<?= BASE_URL ?>/img/logoIcon.png">

    <!-- Google Fonts: Inter para interface moderna e limpa -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

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

        body {
            font-family: 'Inter', 'BasisGrotesque-Regular', sans-serif;
            background-color: #F8FAFC;
        }

        /* Scrollbar estilizada */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #F1F5F9;
        }

        ::-webkit-scrollbar-thumb {
            background: #CBD5E1;
            border-radius: 99px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94A3B8;
        }

        .menu-item {
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .menu-item:hover {
            background-color: rgba(233, 78, 0, 0.08);
            transform: translateX(4px);
            color: #E94E00 !important;
        }

        .menu-item:hover svg {
            color: #E94E00 !important;
        }

        .active-menu {
            background: linear-gradient(90deg, rgba(233, 78, 0, 0.12) 0%, rgba(233, 78, 0, 0.03) 100%);
            border-left: 4px solid #E94E00;
            color: #E94E00 !important;
        }

        .active-menu svg {
            color: #E94E00 !important;
        }

        .hover-card {
            transition: all 0.3s ease;
        }

        .hover-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px -10px rgba(0, 0, 0, 0.08);
        }
    </style>
</head>

<body class="min-h-screen flex bg-[#F8FAFC] text-[#0F172A] overflow-x-hidden">

    <!-- Overlay do Sidebar Mobile -->
    <div id="sidebarOverlay" class="fixed inset-0 bg-slate-900/50 z-40 hidden lg:hidden transition-opacity"></div>

    <!-- SIDEBAR -->
    <aside id="sidebar" class="w-72 bg-white flex flex-col justify-between flex-shrink-0 min-h-screen text-slate-900 fixed lg:sticky top-0 left-0 z-50 shadow-2xl overflow-y-auto transform -translate-x-full lg:translate-x-0 transition-transform duration-300 border-r border-slate-200">

        <div>
            <div class="p-8">
                <img src="<?= BASE_URL ?>/img/LogoGuiar.png" alt="Logo GUIAR" class="w-32 h-auto object-contain">
            </div>

            <nav class="px-4 space-y-1.5">
                <a href="<?= BASE_URL ?>/routes.php?action=meusPedidosEntregador" class="menu-item flex items-center gap-3.5 px-5 py-3.5 rounded-xl font-semibold text-sm text-slate-600 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    Meus Pedidos
                </a>

                <a href="<?= BASE_URL ?>/routes.php?action=mapaEntregador" class="menu-item flex items-center gap-3.5 px-5 py-3.5 rounded-xl font-semibold text-sm text-slate-600 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                    </svg>
                    Abrir Mapa
                </a>

                <a href="<?= BASE_URL ?>/routes.php?action=perfilEntregador" class="menu-item active-menu flex items-center gap-3.5 px-5 py-3.5 rounded-xl font-semibold text-sm text-[#A16207]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#A16207]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Meu Perfil
                </a>
            </nav>
        </div>

        <!-- Logout no rodapé da sidebar -->
        <div class="px-4 pb-8">
            <a href="<?= BASE_URL ?>/routes.php?action=logoutEntregador" class="flex items-center gap-3.5 px-5 py-3.5 rounded-xl font-semibold text-sm text-slate-600 hover:text-[#E94E00] hover:bg-[#E94E00]/10 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-slate-500 hover:text-[#E94E00]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Sair
            </a>
        </div>
    </aside>

    <!-- CONTEÚDO PRINCIPAL -->
    <div class="flex-1 min-w-0 flex flex-col min-h-screen">
        <!-- HEADER DA PÁGINA -->
        <header class="bg-white border-b border-[#E2E8F0] px-4 lg:px-8 py-5 flex items-center justify-between sticky top-0 z-30 shadow-sm">
            <div class="flex items-center gap-4 min-w-0 flex-1">
                <button id="mobileMenuBtn" class="lg:hidden p-2 text-slate-600 hover:bg-slate-100 rounded-xl transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <div class="min-w-0 flex-1">
                    <h1 class="text-xl lg:text-2xl font-extrabold text-slate-900 flex items-center gap-2 truncate">
                        <?= htmlspecialchars($entregador["nome_completo"]) ?>
                    </h1>
                    <p class="text-xs text-slate-500 font-medium mt-0.5 truncate">Meu Perfil - Gerencie suas informações pessoais</p>
                </div>
            </div>
        </header>

        <!-- CONTEÚDO PRINCIPAL -->
        <main class="flex-grow p-8 space-y-8">

            <!-- Alerts -->
            <?php if ($sucesso): ?>
                <div class="max-w-2xl mx-auto bg-emerald-50 border border-emerald-200 rounded-2xl p-4 flex items-center gap-3">
                    <div class="flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <p class="text-sm font-semibold text-emerald-700"><?= htmlspecialchars($sucesso) ?></p>
                </div>
            <?php endif; ?>

            <?php if ($erro): ?>
                <div class="max-w-2xl mx-auto bg-red-50 border border-red-200 rounded-2xl p-4 flex items-center gap-3">
                    <div class="flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4v2m0 4v2m0 0v2M3 7a3 3 0 013-3h12a3 3 0 013 3v10a3 3 0 01-3 3H6a3 3 0 01-3-3V7z" />
                        </svg>
                    </div>
                    <p class="text-sm font-semibold text-red-700"><?= htmlspecialchars($erro) ?></p>
                </div>
            <?php endif; ?>

            <!-- Card de Perfil Entregador -->
            <div class="max-w-2xl mx-auto">
                <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-8 space-y-6">

                    <!-- Foto de Perfil -->
                    <div class="flex flex-col items-center space-y-4">
                        <?php
                        $foto_path = !empty($entregador["foto_3x4"])
                            ? BASE_URL . "/public/uploads/entregadores/fotos/" . htmlspecialchars($entregador["foto_3x4"])
                            : BASE_URL . "/img/G.png";
                        ?>
                        <div class="relative">
                            <img src="<?= $foto_path ?>" class="w-32 h-32 rounded-full object-cover border-4 border-slate-100 shadow-md" alt="Foto de <?= htmlspecialchars($entregador["nome_completo"]) ?>">
                        </div>
                        <div class="text-center">
                            <h2 class="text-2xl font-bold text-slate-900"><?= htmlspecialchars($entregador["nome_completo"]) ?></h2>
                            <p class="text-sm text-slate-500 font-medium mt-1">Entregador</p>
                        </div>
                    </div>

                    <!-- Divisor -->
                    <div class="h-px bg-slate-100"></div>

                    <!-- Informações Pessoais -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-bold text-slate-900">Informações Pessoais</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-slate-50 rounded-xl p-4">
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Usuário</p>
                                <p class="text-sm font-semibold text-slate-900 mt-1"><?= htmlspecialchars($entregador["nome_usuario"]) ?></p>
                            </div>
                            <div class="bg-slate-50 rounded-xl p-4">
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">E-mail</p>
                                <p class="text-sm font-semibold text-slate-900 mt-1"><?= htmlspecialchars($entregador["email"]) ?></p>
                            </div>
                            <div class="bg-slate-50 rounded-xl p-4">
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">CPF</p>
                                <p class="text-sm font-semibold text-slate-900 mt-1"><?= htmlspecialchars($entregador["CPF"]) ?></p>
                            </div>
                            <div class="bg-slate-50 rounded-xl p-4">
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Telefone</p>
                                <p class="text-sm font-semibold text-slate-900 mt-1"><?= htmlspecialchars($entregador["telefone"]) ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Divisor -->
                    <div class="h-px bg-slate-100"></div>

                    <!-- CNH -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-bold text-slate-900">Documentação</h3>

                        <div class="bg-slate-50 rounded-xl p-6">
                            <p class="text-sm font-bold text-slate-700 mb-4">Foto da CNH</p>
                            <?php if (!empty($entregador["foto_CNH"])): ?>
                                <img src="<?= BASE_URL . "/public/uploads/entregadores/CNH/" . htmlspecialchars($entregador["foto_CNH"]) ?>" class="w-full max-w-sm rounded-xl border border-slate-200 object-contain" alt="Foto da CNH">
                            <?php else: ?>
                                <div class="flex items-center justify-center h-40 border-2 border-dashed border-slate-300 rounded-xl">
                                    <p class="text-sm text-slate-400 font-medium">Nenhuma foto da CNH cadastrada</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Divisor -->
                    <div class="h-px bg-slate-100"></div>

                    <!-- Botão Editar -->
                    <div class="flex items-center gap-3">
                        <button id="openEditModalBtn" class="flex items-center gap-2 bg-[#E94E00] hover:bg-[#FFD400] hover:text-slate-900 text-white font-bold text-sm px-6 py-3 rounded-2xl transition shadow-md hover:scale-[1.02]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Editar Perfil
                        </button>
                    </div>

                </div>
            </div>

        </main>

    </div>
    </div>

    <!-- Modal de Edição -->
    <div id="editProfileModal" class="fixed inset-0 bg-black/50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-2xl w-full max-h-[90vh] overflow-y-auto shadow-2xl">

            <!-- Modal Header -->
            <div class="sticky top-0 bg-white border-b border-slate-100 px-8 py-6 flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-slate-900">Editar Meu Perfil</h2>
                    <p class="text-xs text-slate-500 font-medium mt-1">Atualize suas informações pessoais</p>
                </div>
                <button id="closeEditModalBtn" class="text-slate-400 hover:text-slate-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal Content -->
            <div class="p-8">
                <form action="<?= BASE_URL ?>/routes.php?action=editarPerfilEntregador" method="POST" enctype="multipart/form-data" class="space-y-6">

                    <!-- Seção: Informações Pessoais -->
                    <div class="space-y-4">
                        <h3 class="text-sm font-bold text-slate-700 uppercase tracking-wider">Informações Pessoais</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nome Completo -->
                            <div class="md:col-span-2">
                                <label for="nome_completo" class="block text-sm font-semibold text-slate-700 mb-2">Nome Completo</label>
                                <input type="text" id="nome_completo" name="nome_completo" class="w-full px-4 py-2 border border-slate-200 rounded-xl bg-slate-50 text-slate-900 font-medium focus:outline-none focus:ring-2 focus:ring-[#1B138F] focus:bg-white transition" value="<?= htmlspecialchars($entregador["nome_completo"]) ?>" required>
                            </div>

                            <!-- Nome de Usuário -->
                            <div>
                                <label for="nome_usuario" class="block text-sm font-semibold text-slate-700 mb-2">Nome de Usuário</label>
                                <input type="text" id="nome_usuario" name="nome_usuario" class="w-full px-4 py-2 border border-slate-200 rounded-xl bg-slate-50 text-slate-900 font-medium focus:outline-none focus:ring-2 focus:ring-[#1B138F] focus:bg-white transition" value="<?= htmlspecialchars($entregador["nome_usuario"]) ?>" required>
                            </div>

                            <!-- E-mail -->
                            <div>
                                <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">E-mail</label>
                                <input type="email" id="email" name="email" class="w-full px-4 py-2 border border-slate-200 rounded-xl bg-slate-50 text-slate-900 font-medium focus:outline-none focus:ring-2 focus:ring-[#1B138F] focus:bg-white transition" value="<?= htmlspecialchars($entregador["email"]) ?>" required>
                            </div>

                            <!-- CPF -->
                            <div>
                                <label for="cpf" class="block text-sm font-semibold text-slate-700 mb-2">CPF</label>
                                <input type="text" id="cpf" name="cpf" class="w-full px-4 py-2 border border-slate-200 rounded-xl bg-slate-50 text-slate-900 font-medium focus:outline-none focus:ring-2 focus:ring-[#1B138F] focus:bg-white transition" value="<?= htmlspecialchars($entregador["CPF"]) ?>" required>
                            </div>

                            <!-- Telefone -->
                            <div>
                                <label for="telefone" class="block text-sm font-semibold text-slate-700 mb-2">Telefone</label>
                                <input type="text" id="telefone" name="telefone" class="w-full px-4 py-2 border border-slate-200 rounded-xl bg-slate-50 text-slate-900 font-medium focus:outline-none focus:ring-2 focus:ring-[#1B138F] focus:bg-white transition" value="<?= htmlspecialchars($entregador["telefone"]) ?>" required>
                            </div>
                        </div>
                    </div>

                    <!-- Divisor -->
                    <div class="h-px bg-slate-100"></div>

                    <!-- Seção: Segurança -->
                    <div class="space-y-4">
                        <h3 class="text-sm font-bold text-slate-700 uppercase tracking-wider">Segurança</h3>

                        <div>
                            <label for="senha" class="block text-sm font-semibold text-slate-700 mb-2">Nova Senha</label>
                            <input type="password" id="senha" name="senha" class="w-full px-4 py-2 border border-slate-200 rounded-xl bg-slate-50 text-slate-900 font-medium focus:outline-none focus:ring-2 focus:ring-[#1B138F] focus:bg-white transition" placeholder="Deixe em branco para manter a senha atual">
                            <p class="text-xs text-slate-500 font-medium mt-2">Deixe em branco para manter a senha atual</p>
                        </div>
                    </div>

                    <!-- Divisor -->
                    <div class="h-px bg-slate-100"></div>

                    <!-- Seção: Fotos -->
                    <div class="space-y-4">
                        <h3 class="text-sm font-bold text-slate-700 uppercase tracking-wider">Documentação</h3>

                        <!-- Foto 3x4 -->
                        <div class="relative">
                            <input
                                type="file"
                                id="foto_3x4"
                                name="foto_3x4"
                                accept="image/*"
                                class="w-full px-4 py-2 border border-slate-200 rounded-xl bg-slate-50 text-slate-500 font-medium file:mr-3 file:bg-[#E94E00] file:text-white file:font-bold file:px-4 file:py-1.5 file:border-0 file:rounded-lg file:cursor-pointer hover:file:bg-[#c63f00] transition">
                        </div>

                        <p class="text-xs text-slate-500 font-medium mt-2">
                            Formatos aceitos: JPG, PNG, etc.
                        </p>
                    </div>

                    <!-- Foto CNH -->
                    <div>
                        <label for="foto_CNH" class="block text-sm font-semibold text-slate-700 mb-2">
                            Foto da CNH
                        </label>

                        <div class="relative">
                            <input
                                type="file"
                                id="foto_CNH"
                                name="foto_CNH"
                                accept="image/*"
                                class="w-full px-4 py-2 border border-slate-200 rounded-xl bg-slate-50 text-slate-500 font-medium file:mr-3 file:bg-[#E94E00] file:text-white file:font-bold file:px-4 file:py-1.5 file:border-0 file:rounded-lg file:cursor-pointer hover:file:bg-[#c63f00] transition">
                        </div>

                        <p class="text-xs text-slate-500 font-medium mt-2">
                            Formatos aceitos: JPG, PNG, etc.
                        </p>
                    </div>

                    <!-- Divisor -->
                    <div class="h-px bg-slate-100"></div>

                    <!-- Botões de Ação -->
                    <div class="flex items-center gap-3 justify-end">

                        <button
                            type="button"
                            id="closeEditModalBtn2"
                            class="px-6 py-3 text-sm font-bold text-white bg-[#E94E00] hover:bg-[#c63f00] rounded-2xl transition shadow-md hover:scale-[1.02]">
                            Cancelar
                        </button>

                        <button
                            type="submit"
                            class="flex items-center gap-2 bg-[#E94E00] hover:bg-[#c63f00] text-white font-bold text-sm px-6 py-3 rounded-2xl transition shadow-md hover:scale-[1.02]">

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>

                            Salvar Alterações
                        </button>

                    </div>

                </form>
            </div>

        </div>
    </div>

    <script>
        const modal = document.getElementById("editProfileModal");
        const openBtn = document.getElementById("openEditModalBtn");
        const closeBtn = document.getElementById("closeEditModalBtn");
        const closeBtn2 = document.getElementById("closeEditModalBtn2");

        openBtn.addEventListener("click", () => {
            modal.classList.remove("hidden");
        });

        closeBtn.addEventListener("click", () => {
            modal.classList.add("hidden");
        });

        closeBtn2.addEventListener("click", () => {
            modal.classList.add("hidden");
        });

        window.addEventListener("click", (event) => {
            if (event.target === modal) {
                modal.classList.add("hidden");
            }
        });

        // Script para Sidebar Mobile
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');

        if (mobileMenuBtn && overlay && sidebar) {
            function toggleSidebar() {
                sidebar.classList.toggle('-translate-x-full');
                overlay.classList.toggle('hidden');
            }
            mobileMenuBtn.addEventListener('click', toggleSidebar);
            overlay.addEventListener('click', toggleSidebar);
        }
    </script>
</body>

</html>