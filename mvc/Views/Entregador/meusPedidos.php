<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Pedidos | Entregador</title>
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
                <a href="<?= BASE_URL ?>/routes.php?action=meusPedidosEntregador" class="menu-item active-menu flex items-center gap-3.5 px-5 py-3.5 rounded-xl font-semibold text-sm text-[#A16207]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#A16207]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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

                <a href="<?= BASE_URL ?>/routes.php?action=perfilEntregador" class="menu-item flex items-center gap-3.5 px-5 py-3.5 rounded-xl font-semibold text-sm text-slate-600 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                        Meus Pedidos
                    </h1>
                    <p class="text-xs text-slate-500 font-medium mt-0.5 truncate">Acompanhe e gerencie as entregas atribuídas a você</p>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <button type="button" id="refreshPage" class="flex items-center gap-2 bg-[#F8FAFC] hover:bg-[#F1F5F9] text-slate-600 font-bold text-sm px-4 py-2 rounded-xl transition border border-slate-200 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Atualizar
                </button>
            </div>
        </header>

        <!-- CONTEÚDO PRINCIPAL -->
        <main class="flex-grow p-8 space-y-8">

            <!-- Cards de Pedidos -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                <?php
                if (!empty($result) && count($result) > 0) {
                    foreach ($result as $row) {
                ?>
                        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow p-6 flex flex-col justify-between h-full relative overflow-hidden hover-card">
                            <!-- Borda Superior Colorida -->
                            <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-[#E94E00] to-[#FFD400]"></div>

                            <div>
                                <div class="flex items-center justify-between mb-4 mt-2">
                                    <h3 class="text-lg font-bold text-slate-900 truncate pr-4" title="<?= htmlspecialchars($row["nome_cliente"]) ?>">
                                        <?= htmlspecialchars($row["nome_cliente"]) ?>
                                    </h3>
                                    <span class="bg-[#E94E00]/10 text-[#E94E00] text-xs font-bold px-3 py-1 rounded-full whitespace-nowrap">
                                        R$ <?= htmlspecialchars($row["preco"]) ?>
                                    </span>
                                </div>

                                <div class="space-y-4 mt-4">
                                    <div class="flex items-start gap-3">
                                        <div class="bg-slate-50 p-2 rounded-lg flex-shrink-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-semibold text-slate-700"><?= htmlspecialchars($row["endereco"]) ?></p>
                                            <p class="text-xs text-slate-500 font-medium mt-0.5"><?= htmlspecialchars($row["bairro"]) ?></p>
                                        </div>
                                    </div>

                                    <div class="flex items-start gap-3">
                                        <div class="bg-slate-50 p-2 rounded-lg flex-shrink-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </div>
                                        <p class="text-sm text-slate-600 font-medium line-clamp-3 mt-1">
                                            <?= htmlspecialchars($row["descricao"]) ?>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6 pt-5 border-t border-slate-100">
                                <button type="button" class="btn-delivered w-full flex items-center justify-center gap-2 bg-[#E94E00] hover:bg-[#c63f00] text-white font-bold text-sm px-4 py-3 rounded-2xl transition shadow-md hover:scale-[1.02]" data-id="<?= htmlspecialchars($row["id_pedido"]) ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Marcar como Entregue
                                </button>
                            </div>
                        </div>
                    <?php
                    }
                } else {
                    ?>
                    <div class="col-span-full flex flex-col items-center justify-center bg-white rounded-3xl border border-slate-100 shadow-sm p-12 text-center">
                        <div class="bg-slate-50 p-6 rounded-full mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 mb-1">Nenhum pedido atribuído</h3>
                        <p class="text-sm text-slate-500 font-medium">Você não tem entregas pendentes no momento.</p>
                    </div>
                <?php
                }
                ?>
            </div>

        </main>

    </div>

    <!-- Scripts da Página -->
    <script>
        // Função para marcar pedido como entregue
        document.querySelectorAll('.btn-delivered').forEach(button => {
            button.addEventListener('click', function() {
                const pedidoId = this.getAttribute('data-id');
                const btn = this;

                // Feedback visual de carregamento
                const originalText = btn.innerHTML;
                btn.innerHTML = '<svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Processando...';
                btn.disabled = true;

                fetch('<?= BASE_URL ?>/routes.php?action=concluirEntrega', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: 'id_pedido=' + encodeURIComponent(pedidoId)
                    })
                    .then(response => response.text())
                    .then(result => {
                        if (result.trim() === 'success') {
                            // Encontrar o card pai e animar a saída
                            const card = btn.closest('.hover-card');
                            if (card) {
                                card.style.transition = 'all 0.5s ease';
                                card.style.opacity = '0';
                                card.style.transform = 'scale(0.9)';
                            }

                            setTimeout(() => {
                                alert('Pedido marcado como entregue!');
                                location.reload(); // Atualiza a página após animação
                            }, 300);
                        } else {
                            alert('Erro ao marcar pedido como entregue.');
                            btn.innerHTML = originalText;
                            btn.disabled = false;
                        }
                    })
                    .catch(error => {
                        console.error('Erro:', error);
                        alert('Erro na requisição.');
                        btn.innerHTML = originalText;
                        btn.disabled = false;
                    });
            });
        });

        // Função para atualizar a página
        document.getElementById('refreshPage').addEventListener('click', function() {
            const icon = this.querySelector('svg');
            icon.classList.add('animate-spin');

            setTimeout(() => {
                location.reload();
            }, 300);
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