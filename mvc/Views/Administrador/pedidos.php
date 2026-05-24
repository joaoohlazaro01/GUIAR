<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo - GUIAR</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* SIDEBAR - Comportamento Responsivo */
        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #111;
            padding-top: 20px;
            display: flex;
            flex-direction: column;
            z-index: 1000;
        }

        .main {
            margin-left: 250px;
            padding: 15px;
            transition: 0.3s;
        }

        /* MEDIA QUERY PARA MOBILE */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%; /* Ocupa a tela toda quando aberto ou esconde */
                display: none; /* Você pode alternar com JS para block */
            }
            .main {
                margin-left: 0 !important; /* Remove a margem que quebra o layout */
                width: 100%;
            }
            .card-container {
                width: 100% !important; /* Ocupa total no mobile */
                justify-content: center;
            }
            .card {
                min-width: 90% !important; /* Cards ocupam quase a tela toda */
            }
        }

        /* Estilo dos cards */
        .card-container {
            width: 80%;
            margin: 20px auto;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            padding: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
            border-left: 7px solid #e06c00;
            border-radius: 5px;
            background-color: #f9f9f9;
            min-width: 350px; /* Garante tamanho mínimo */
            flex: 1 1 300px; /* Flexível */
        }

        /* Mantendo os seus botões */
        .logout-btn { position: absolute; top: 20px; right: 20px; padding: 10px 20px; background: #fc8835; color: white; border-radius: 5px; text-decoration: none; }
        .finalizar-btn { position: fixed; bottom: 50px; right: 20px; padding: 15px 25px; background: #fc8835; color: white; border: none; border-radius: 5px; cursor: pointer; }
    </style>
</head>

<body class="bg-[#F3F4F6] text-gray-800 antialiased min-h-screen">

    <div class="flex min-h-screen relative">

        <!-- OVERLAY MOBILE -->
        <div id="overlay"
            class="hidden fixed inset-0 bg-black/40 z-30 md:hidden">
        </div>

        <!-- SIDEBAR -->
         <?php
$nomeAdmin = $admin["nome_adm"] ?? "Admin";
?>
        <aside id="sidebar"
            class="fixed md:fixed
            top-0 md:top-4
            left-0 md:left-4
            w-72
            bg-[#0B0D2F]
            flex flex-col
            text-white
            z-40
            shadow-2xl
            transition-all
            md:rounded-[24px]
            overflow-hidden
            h-screen md:h-[calc(100vh-32px)]">

            <div class="flex flex-col h-full relative">

                <!-- FECHAR MOBILE -->
                <button id="closeSidebar"
                    class="absolute top-5 right-5 md:hidden text-white z-50">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-7 h-7"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <!-- LOGO -->
                <div class="p-8 mb-4">
                    <img src="img/logobrancaR.png"
                        alt="Logo GUIAR"
                        class="w-32 h-auto object-contain">
                </div>

                <!-- MENU -->
                <nav class="px-4 space-y-2 flex-grow overflow-y-auto">

                    <a href="<?= BASE_URL ?>/routes.php?action=dashboardAdm"
                        class="menu-item flex items-center gap-3.5 px-5 py-3 rounded-xl font-bold text-sm bg-[#FFD400] text-[#0B0D2F] shadow-lg shadow-yellow-500/10 transition-all">

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

                    <a href="<?= BASE_URL ?>/routes.php?action=pedidos"
                        class="menu-item flex items-center gap-3.5 px-5 py-3 rounded-xl font-semibold text-sm text-slate-400 hover:text-white hover:bg-white/5 transition-all">

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

                <!-- PERFIL -->
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
        <main class="flex-1 flex flex-col min-h-screen w-full md:ml-[304px]">

            <!-- HEADER -->
            <header class="bg-white/80 backdrop-blur-md border-b border-gray-200 px-4 md:px-8 py-4 md:py-5 flex items-center gap-4 sticky top-0 z-10">

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

                <h2 class="text-lg md:text-2xl font-bold text-gray-800">
                    Gerenciamento de Pedidos
                </h2>
            </header>

            <!-- CONTEÚDO -->
            <div class="p-4 md:p-8 overflow-y-auto flex-1">

               <form id="sendOrdersForm"
    method="POST"
    action="<?= BASE_URL ?>/routes.php?action=enviarPedidos">

    <!-- GRID -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4 md:gap-6 pb-32">

        <?php if (!empty($result) && count($result) > 0): ?>

            <?php foreach ($result as $row): ?>

                <label class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 border-l-4 border-l-[#fc8835] hover:shadow-md transition-shadow relative cursor-pointer flex flex-col h-full group">

                    <div class="absolute top-6 right-6">

                        <input type="checkbox"
                            name="pedido_ids[]"
                            value="<?= htmlspecialchars($row['id_pedido']) ?>"
                            class="w-5 h-5 text-[#fc8835] bg-gray-100 border-gray-300 rounded focus:ring-[#fc8835] focus:ring-2 cursor-pointer">
                    </div>

                    <h3 class="text-xl font-bold mb-4 pr-8 text-gray-800">
                        <?= htmlspecialchars($row["nome_cliente"]) ?>
                    </h3>

                    <div class="space-y-2 text-sm text-gray-600 flex-1">

                        <p>
                            <span class="font-semibold text-gray-800">Preço:</span>
                            R$ <?= htmlspecialchars($row["preco"]) ?>
                        </p>

                        <p>
                            <span class="font-semibold text-gray-800">Endereço:</span>
                            <?= htmlspecialchars($row["endereco"]) ?>
                        </p>

                        <p>
                            <span class="font-semibold text-gray-800">Bairro:</span>
                            <?= htmlspecialchars($row["bairro"]) ?>
                        </p>

                        <p>
                            <span class="font-semibold text-gray-800">Descrição:</span>
                            <?= htmlspecialchars($row["descricao"]) ?>
                        </p>

                        <div class="pt-2 mt-2 border-t border-gray-100">

                            <p class="text-[#fc8835]">
                                <span class="font-semibold">Status:</span>
                                <?= htmlspecialchars($row["status"]) ?>
                            </p>

                            <p>
                                <span class="font-semibold text-gray-800">Entregador:</span>

                                <?= !empty($row["nome_entregador"])
                                    ? htmlspecialchars($row["nome_entregador"])
                                    : '<span class="text-gray-400 italic">Não atribuído</span>' ?>
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-3 mt-6 pt-4">

                        <button type="button"
                            class="btn-edit flex-1 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg text-sm font-medium transition-colors"
                            data-id="<?= htmlspecialchars($row['id_pedido']) ?>">

                            Editar
                        </button>

                        <button type="button"
                            class="btn-delete flex-1 px-4 py-2 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg text-sm font-medium transition-colors"
                            data-id="<?= htmlspecialchars($row['id_pedido']) ?>">

                            Excluir
                        </button>
                    </div>
                </label>

            <?php endforeach; ?>

        <?php else: ?>

            <div class="col-span-full py-12 text-center text-gray-400 font-medium bg-white rounded-2xl border border-dashed border-gray-300">
                Nenhum pedido encontrado.
            </div>

        <?php endif; ?>
    </div>

    <!-- BOTÕES -->
    <div class="fixed bottom-4 right-4 left-4 md:left-auto md:right-8 flex flex-col gap-3 z-20">

        <button type="button"
            id="openNewOrderModal"
            class="w-full md:w-auto px-6 py-3 bg-[#fc8835] hover:bg-[#e06c00] text-white rounded-xl shadow-lg hover:shadow-xl transition-all font-medium">

            + Adicionar Novo Pedido
        </button>

        <button type="button"
            id="openSendOrdersModal"
            class="w-full md:w-auto px-6 py-3 bg-gray-800 hover:bg-gray-900 text-white rounded-xl shadow-lg hover:shadow-xl transition-all font-medium">

            Enviar Selecionados
        </button>
    </div>

</form>
                
            </div>
        </main>
    </div>

    <!-- SCRIPT -->
    <script>

        const menuBtn = document.getElementById('hamburger');
        const sidebar = document.getElementById('sidebar');
        const closeBtn = document.getElementById('closeSidebar');
        const overlay = document.getElementById('overlay');

        menuBtn.addEventListener('click', () => {
            sidebar.classList.add('mobile-open');
            overlay.classList.add('active');
        });

        closeBtn.addEventListener('click', () => {
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