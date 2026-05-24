<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard dos Motoboys</title>
    <link rel="shortcut icon" type="image/png" href="<?= BASE_URL ?>/src/G.png">
    
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
            font-family: 'BasisGrotesque-Regular', sans-serif;
            background-color: #f0f2f5;
        }

        .modal {
            display: none;
        }
    </style>
</head>

<body class="flex h-screen overflow-hidden text-gray-800">

    <div id="sidebarOverlay" class="fixed inset-0 bg-[#0B0D2F]/50 backdrop-blur-sm z-40 hidden transition-opacity md:hidden"></div>

    <aside id="sidebar"
        class="w-72 bg-[#0B0D2F] flex flex-col fixed top-4 left-4 text-white sticky top-0 z-40 shadow-2xl transition-all rounded-[24px] overflow-hidden h-[92vh]">

        <div class="flex flex-col h-full">
            
            <button id="closeSidebarBtn" class="absolute top-6 right-6 text-gray-400 hover:text-white md:hidden">
                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>

            <div class="h-28 flex items-center justify-center px-8 mt-2">
                <img src="img/logobrancaR.png" alt="Logo GUIAR" class="w-32 h-auto object-contain">
            </div>

            <nav class="flex-1 px-6 py-2 space-y-2 overflow-y-auto">
                
                <a href="<?= BASE_URL ?>/routes.php?action=dashboardAdm" class="flex items-center gap-4 px-5 py-3.5 text-[#8890A4] font-medium hover:text-white rounded-2xl transition-colors">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" /></svg>
                    Início
                </a>

                <a href="<?= BASE_URL ?>/routes.php?action=pedidos" class="flex items-center gap-4 px-5 py-3.5 text-[#8890A4] font-medium hover:text-white rounded-2xl transition-colors">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" /></svg>
                    Pedidos
                </a>

                <a href="<?= BASE_URL ?>/routes.php?action=entregadores" class="flex items-center gap-4 px-5 py-3.5 bg-[#FFC107] text-[#0c1120] font-bold rounded-xl shadow-lg transition-colors">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" /></svg>
                    Entregadores
                </a>

                <a href="<?= BASE_URL ?>/routes.php?action=pedidosEntregues" class="flex items-center gap-4 px-5 py-3.5 text-[#8890A4] font-medium hover:text-white rounded-2xl transition-colors">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" /></svg>
                    Pedidos Entregues
                </a>

                <a href="<?= BASE_URL ?>/routes.php?action=mapaAdm" class="flex items-center gap-4 px-5 py-3.5 text-[#8890A4] font-medium hover:text-white rounded-2xl transition-colors">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M9 6.75V15m6-6v8.25m.503 3.498 4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 0 0-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0Z" /></svg>
                    Acompanhar Rotas
                </a>

                <a href="<?= BASE_URL ?>/routes.php?action=perfilAdm" class="flex items-center gap-4 px-5 py-3.5 text-[#8890A4] font-medium hover:text-white rounded-2xl transition-colors">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" /></svg>
                    Meu Perfil
                </a>
                
            </nav>

            <div class="p-6 mb-2 mt-auto">
                <div class="flex items-center justify-between bg-[#13192B] p-3 rounded-2xl border border-white/5">
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="w-11 h-11 flex-shrink-0 bg-[#FFC107] text-[#0c1120] font-extrabold text-sm flex items-center justify-center rounded-full shadow-inner">
                            <?= strtoupper(substr($nomeAdmin, 0, 2)) ?>
                        </div>
                        <div class="flex flex-col min-w-0">
                            <span class="text-white font-bold text-sm tracking-wide truncate"><?= htmlspecialchars($nomeAdmin) ?></span>
                            <span class="text-[10px] text-gray-500 font-bold tracking-widest mt-0.5 uppercase">Admin</span>
                        </div>
                    </div>
                    <a href="<?= BASE_URL ?>/routes.php?action=logoutAdm" class="flex-shrink-0 text-[#8890A4] hover:text-[#FFC107] transition-colors p-2" title="Sair">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </aside>

    <main class="flex-1 flex flex-col h-full overflow-hidden w-full relative">
        
        <header class="px-5 md:px-10 py-6 md:py-8 flex justify-between items-center z-10 flex-shrink-0 gap-4">
            <div class="flex items-center gap-4">
                <button id="openSidebarBtn" class="md:hidden bg-white text-gray-800 p-2.5 rounded-xl shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[#FFC107]">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                
                <div>
                    <h2 class="text-2xl md:text-4xl font-extrabold text-gray-900 mb-1 md:mb-2">Entregadores</h2>
                    <p class="text-xs md:text-sm text-gray-500 font-medium">Gerencie os administradores com acesso ao sistema.</p>
                </div>
            </div>
            
            <div class="flex items-center gap-4">
                <div class="relative hidden md:block shadow-sm">
                   <input type="text" id="searchInput" placeholder="Buscar administrador..." class="pl-11 pr-4 py-3 border-none bg-white rounded-xl focus:outline-none focus:ring-2 focus:ring-[#FFC107] w-72 text-sm">
                    <svg class="w-5 h-5 text-gray-400 absolute left-4 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <button id="openNewMotoboyModal" class="hidden md:flex bg-[#FFC107] hover:bg-yellow-500 text-gray-900 font-bold px-6 py-3 rounded-xl shadow-md transition-all items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Novo Entregador
                </button>
            </div>
        </header>

        <div class="px-5 md:px-10 pb-8 overflow-y-auto flex-1 relative w-full">
            <div id="cardsContainer" class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
    <?php if (!empty($result)): ?>
        <?php foreach ($result as $row): ?>
            <div class="motoboy-card bg-white rounded-[24px] p-6 shadow-sm hover:shadow-md transition-shadow flex flex-col relative">
                            
                            <button class="absolute top-5 right-5 text-gray-300 hover:text-gray-500">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path></svg>
                            </button>

                            <div class="flex flex-col items-center mb-6 mt-3">
                                <div class="w-20 h-20 rounded-full bg-gray-100 mb-4 border-4 border-white shadow-sm overflow-hidden flex items-center justify-center text-gray-300">
                                     <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800 text-center"><?php echo htmlspecialchars($row["nome_completo"]); ?></h3>
                                <p class="text-sm text-gray-400 text-center font-medium mt-1 mb-3 break-all"><?php echo htmlspecialchars($row["email"]); ?></p>
                                <span class="px-4 py-1.5 bg-blue-50 text-blue-600 text-xs font-bold rounded-full">Administrador</span>
                            </div>

                            <div class="text-[13px] text-gray-500 mb-6 space-y-2 px-4 bg-gray-50 p-4 rounded-xl">
                                <p class="flex justify-between"><span>ID:</span> <span class="font-bold text-gray-700">#<?php echo htmlspecialchars($row["id_entregador"]); ?></span></p>
                                <p class="flex justify-between"><span>CPF:</span> <span class="font-bold text-gray-700"><?php echo htmlspecialchars($row["CPF"]); ?></span></p>
                                <p class="flex justify-between"><span>Telefone:</span> <span class="font-bold text-gray-700"><?php echo htmlspecialchars($row["telefone"]); ?></span></p>
                            </div>

                            <div class="flex gap-3 mt-auto pt-2 flex-wrap sm:flex-nowrap">
                                <button class="btn-edit w-full sm:flex-1 flex items-center justify-center gap-1.5 py-2.5 text-sm font-bold text-blue-600 bg-white border-2 border-blue-100 rounded-xl hover:bg-blue-50 transition-colors" 
                                    data-id='<?php echo htmlspecialchars($row["id_entregador"]); ?>' 
                                    data-nome='<?php echo htmlspecialchars($row["nome_completo"]); ?>' 
                                    data-cpf='<?php echo htmlspecialchars($row["CPF"]); ?>' 
                                    data-telefone='<?php echo htmlspecialchars($row["telefone"]); ?>' 
                                    data-email='<?php echo htmlspecialchars($row["email"]); ?>'>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    Editar
                                </button>
                                <button class="btn-delete w-full sm:flex-1 flex items-center justify-center gap-1.5 py-2.5 text-sm font-bold text-red-500 bg-white border-2 border-red-100 rounded-xl hover:bg-red-50 transition-colors" 
                                    data-id='<?php echo htmlspecialchars($row["id_entregador"]); ?>'>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    Remover
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-span-full py-12 text-center text-gray-400 font-medium bg-white rounded-2xl">
                        Nenhum motoboy encontrado...
                    </div>
                <?php endif; ?>
            </div>

            <div class="mt-8 text-center flex items-center justify-center gap-2 text-sm text-gray-400 font-bold pb-24">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                Total: <?php echo !empty($result) ? count($result) : 0; ?> administradores
            </div>
            
            <button onclick="document.getElementById('newMotoboyModal').style.display='block'" class="fixed bottom-6 right-6 md:bottom-8 md:right-8 w-16 h-16 md:w-20 md:h-20 bg-[#FFC107] hover:bg-yellow-500 text-gray-900 rounded-full shadow-[0_8px_30px_rgb(255,193,7,0.4)] hover:scale-105 transition-all flex flex-col items-center justify-center font-bold text-[10px] md:text-[11px] gap-1 z-30">
                <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                <span class="hidden md:inline">Adicionar</span>
            </button>
        </div>
    </main>

    <div id="newMotoboyModal" class="modal fixed inset-0 z-[60] bg-[#0c1120]/80 backdrop-blur-sm overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen p-4 text-center">
            <div class="relative bg-white rounded-3xl text-left shadow-2xl transform transition-all w-full max-w-lg p-6 md:p-8">
                <span class="close absolute top-4 right-4 md:top-5 md:right-5 text-gray-300 hover:text-gray-800 cursor-pointer text-3xl font-bold" id="closeNewMotoboyModal">&times;</span>
                <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 mb-6 pr-8">Cadastrar Motoboy</h2>
                
                <form id="newMotoboyForm" method="POST" action="<?= BASE_URL ?>/routes.php?action=cadastrarEntregador" enctype="multipart/form-data" class="space-y-4">
                    <div>
                        <label for="nome_completo" class="block text-sm font-bold text-gray-700 mb-2">Nome completo:</label>
                        <input type="text" id="nome_completo" name="nome_completo" required class="w-full px-4 py-3 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-[#FFC107] outline-none font-medium text-sm md:text-base">
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="cpf" class="block text-sm font-bold text-gray-700 mb-2">CPF:</label>
                            <input type="text" id="cpf" name="cpf" required minlength="14" maxlength="14" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" oninput="this.value = formatCPF(this.value)" class="w-full px-4 py-3 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-[#FFC107] outline-none font-medium text-sm md:text-base">
                        </div>
                        <div>
                            <label for="telefone" class="block text-sm font-bold text-gray-700 mb-2">Telefone:</label>
                            <input type="text" id="telefone" name="telefone" required minlength="14" maxlength="15" pattern="\(\d{2}\)\s\d{4,5}-\d{4}" oninput="this.value = formatPhone(this.value)" class="w-full px-4 py-3 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-[#FFC107] outline-none font-medium text-sm md:text-base">
                        </div>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-bold text-gray-700 mb-2">Email:</label>
                        <input type="email" id="email" name="email" required class="w-full px-4 py-3 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-[#FFC107] outline-none font-medium text-sm md:text-base">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="nome_usuario" class="block text-sm font-bold text-gray-700 mb-2">Usuário:</label>
                            <input type="text" id="nome_usuario" name="nome_usuario" required class="w-full px-4 py-3 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-[#FFC107] outline-none font-medium text-sm md:text-base">
                        </div>
                        <div>
                            <label for="senha" class="block text-sm font-bold text-gray-700 mb-2">Senha:</label>
                            <input type="password" id="senha" name="senha" required class="w-full px-4 py-3 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-[#FFC107] outline-none font-medium text-sm md:text-base">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                        <div>
                            <label for="foto_3x4" class="block text-sm font-bold text-gray-700 mb-2">Foto 3x4:</label>
                            <input type="file" id="foto_3x4" name="foto_3x4" required class="w-full text-xs md:text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:font-bold file:bg-[#FFC107]/10 file:text-yellow-700 hover:file:bg-[#FFC107]/20 cursor-pointer">
                        </div>
                        <div>
                            <label for="foto_CNH" class="block text-sm font-bold text-gray-700 mb-2">Foto CNH:</label>
                            <input type="file" id="foto_CNH" name="foto_CNH" required class="w-full text-xs md:text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:font-bold file:bg-[#FFC107]/10 file:text-yellow-700 hover:file:bg-[#FFC107]/20 cursor-pointer">
                        </div>
                    </div>

                    <div class="pt-6">
                        <button type="submit" class="w-full bg-[#FFC107] hover:bg-yellow-500 text-gray-900 font-extrabold py-4 px-4 rounded-xl transition-colors shadow-md">Salvar Cadastro</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="editModal" class="modal fixed inset-0 z-[60] bg-[#0c1120]/80 backdrop-blur-sm overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen p-4 text-center">
            <div class="relative bg-white rounded-3xl text-left shadow-2xl transform transition-all w-full max-w-md p-6 md:p-8">
                <span class="close absolute top-4 right-4 md:top-5 md:right-5 text-gray-300 hover:text-gray-800 cursor-pointer text-3xl font-bold" id="closeEdit">&times;</span>
                <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 mb-6 pr-8">Editar Motoboy</h2>
                
                <form id="editForm" method="POST" action="<?= BASE_URL ?>/routes.php?action=editarEntregador" class="space-y-4">
                    <div>
                        <label for="edit_nome_completo" class="block text-sm font-bold text-gray-700 mb-2">Nome Completo:</label>
                        <input type="text" id="edit_nome_completo" name="nome_completo" required class="w-full px-4 py-3 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-blue-500 outline-none font-medium text-sm md:text-base">
                    </div>
                    <div>
                        <label for="edit_CPF" class="block text-sm font-bold text-gray-700 mb-2">CPF:</label>
                        <input type="text" id="edit_CPF" name="CPF" required minlength="14" maxlength="14" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" oninput="this.value = formatCPF(this.value)" class="w-full px-4 py-3 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-blue-500 outline-none font-medium text-sm md:text-base">
                    </div>
                    <div>
                        <label for="edit_telefone" class="block text-sm font-bold text-gray-700 mb-2">Telefone:</label>
                        <input type="text" id="edit_telefone" name="telefone" required minlength="14" maxlength="15" pattern="\(\d{2}\)\s\d{4,5}-\d{4}" oninput="this.value = formatPhone(this.value)" class="w-full px-4 py-3 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-blue-500 outline-none font-medium text-sm md:text-base">
                    </div>
                    <div>
                        <label for="edit_email" class="block text-sm font-bold text-gray-700 mb-2">Email:</label>
                        <input type="email" id="edit_email" name="email" required class="w-full px-4 py-3 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-blue-500 outline-none font-medium text-sm md:text-base">
                    </div>
                    
                    <input type="hidden" id="edit_id" name="id">
                    
                    <div class="pt-6">
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-extrabold py-4 px-4 rounded-xl transition-colors shadow-md">Atualizar Dados</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="deleteModal" class="modal fixed inset-0 z-[60] bg-[#0c1120]/80 backdrop-blur-sm overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen p-4 text-center">
            <div class="relative bg-white rounded-3xl text-center shadow-2xl transform transition-all w-full max-w-sm p-6 md:p-8">
                <span class="close absolute top-4 right-4 text-gray-300 hover:text-gray-800 cursor-pointer text-2xl font-bold" id="closeDelete">&times;</span>
                
                <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-red-50 mb-6">
                    <svg class="h-10 w-10 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                
                <h2 class="text-2xl font-extrabold text-gray-900 mb-2">Atenção!</h2>
                <p class="text-sm text-gray-500 font-medium mb-8">Tem certeza de que deseja excluir este motoboy? Essa ação não poderá ser desfeita.</p>
                
                <form id="deleteForm" method="GET" action="<?= BASE_URL ?>/routes.php">
                    <input type="hidden" name="action" value="excluirEntregador">
                    <input type="hidden" id="delete_id" name="id">
                    <div class="flex gap-3">
                        <button type="button" id="cancelDelete" class="flex-1 bg-gray-100 text-gray-700 hover:bg-gray-200 font-bold py-3.5 px-4 rounded-xl transition-colors">Cancelar</button>
                        <button type="submit" class="flex-1 bg-red-500 hover:bg-red-600 text-white font-bold py-3.5 px-4 rounded-xl transition-colors shadow-md">Excluir</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Lógica de Formatação
        function formatCPF(cpf) {
            cpf = cpf.replace(/\D/g, "");
            cpf = cpf.replace(/^(\d{3})(\d)/, "$1.$2");
            cpf = cpf.replace(/^(\d{3})\.(\d{3})(\d)/, "$1.$2.$3");
            cpf = cpf.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
            return cpf;
        }

        function formatPhone(phone) {
            phone = phone.replace(/\D/g, "");
            phone = phone.replace(/^(\d{2})(\d)/g, "($1) $2");
            phone = phone.replace(/(\d)(\d{4})$/, "$1-$2");
            return phone;
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Lógica da Sidebar Mobile
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const openSidebarBtn = document.getElementById('openSidebarBtn');
            const closeSidebarBtn = document.getElementById('closeSidebarBtn');

            function toggleSidebar() {
                sidebar.classList.toggle('-translate-x-full');
                overlay.classList.toggle('hidden');
            }

            if(openSidebarBtn) openSidebarBtn.addEventListener('click', toggleSidebar);
            if(closeSidebarBtn) closeSidebarBtn.addEventListener('click', toggleSidebar);
            if(overlay) overlay.addEventListener('click', toggleSidebar);

            // Modais
            var editModal = document.getElementById('editModal');
            var deleteModal = document.getElementById('deleteModal');
            var closeEdit = document.getElementById('closeEdit');
            var closeDelete = document.getElementById('closeDelete');
            var btnEdit = document.querySelectorAll('.btn-edit');
            var btnDelete = document.querySelectorAll('.btn-delete');
            var cancelDelete = document.getElementById('cancelDelete');

            var newMotoboyModal = document.getElementById('newMotoboyModal');
            var closeNewMotoboyModal = document.getElementById('closeNewMotoboyModal');
            var openNewMotoboyModal = document.getElementById('openNewMotoboyModal');

            if (openNewMotoboyModal) {
                openNewMotoboyModal.onclick = function() {
                    newMotoboyModal.style.display = 'block';
                }
            }

            if (closeNewMotoboyModal) {
                closeNewMotoboyModal.onclick = function() {
                    newMotoboyModal.style.display = 'none';
                }
            }

            btnEdit.forEach(function(button) {
                button.addEventListener('click', function() {
                    var id = this.getAttribute('data-id');
                    var nome = this.getAttribute('data-nome');
                    var cpf = this.getAttribute('data-cpf');
                    var telefone = this.getAttribute('data-telefone');
                    var email = this.getAttribute('data-email');

                    document.getElementById('edit_id').value = id;
                    document.getElementById('edit_nome_completo').value = nome;
                    document.getElementById('edit_CPF').value = formatCPF(cpf);
                    document.getElementById('edit_telefone').value = formatPhone(telefone);
                    document.getElementById('edit_email').value = email;

                    editModal.style.display = 'block';
                });
            });

            btnDelete.forEach(function(button) {
                button.addEventListener('click', function() {
                    var id = this.getAttribute('data-id');
                    document.getElementById('delete_id').value = id;
                    deleteModal.style.display = 'block';
                });
            });

            if (closeEdit) closeEdit.onclick = () => editModal.style.display = 'none';
            if (closeDelete) closeDelete.onclick = () => deleteModal.style.display = 'none';
            if (cancelDelete) cancelDelete.onclick = () => deleteModal.style.display = 'none';

            window.onclick = function(event) {
                if (event.target == editModal) editModal.style.display = 'none';
                if (event.target == deleteModal) deleteModal.style.display = 'none';
                if (event.target == newMotoboyModal) newMotoboyModal.style.display = 'none';
            }
        });
    </script>

    <script>// --- LÓGICA DE BUSCA EM TEMPO REAL ---
            const searchInput = document.getElementById('searchInput');
            const cardsContainer = document.getElementById('cardsContainer');
            
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    // Pega o texto digitado e converte para minúsculo
                    const filter = this.value.toLowerCase();
                    const cards = document.querySelectorAll('.motoboy-card');
                    let visibleCount = 0;

                    // Passa por todos os cartões
                    cards.forEach(card => {
                        // Pega todo o texto dentro do cartão (nome, cpf, email, etc)
                        const text = card.textContent.toLowerCase();
                        
                        // Se o texto do cartão contém o que foi digitado
                        if (text.includes(filter)) {
                            card.style.display = ''; // Mostra o cartão
                            visibleCount++;
                        } else {
                            card.style.display = 'none'; // Esconde o cartão
                        }
                    });

                    // Lógica para mostrar mensagem de "Nenhum encontrado" na busca
                    let noResultsMsg = document.getElementById('noResultsMsg');
                    
                    if (visibleCount === 0 && cards.length > 0) {
                        if (!noResultsMsg) {
                            noResultsMsg = document.createElement('div');
                            noResultsMsg.id = 'noResultsMsg';
                            noResultsMsg.className = 'col-span-full py-12 text-center text-gray-400 font-medium bg-white rounded-2xl';
                            noResultsMsg.textContent = 'Nenhum entregador encontrado nesta busca.';
                            cardsContainer.appendChild(noResultsMsg);
                        } else {
                            noResultsMsg.style.display = 'block';
                        }
                    } else if (noResultsMsg) {
                        noResultsMsg.style.display = 'none';
                    }
                });
            }
            </script>
</body>
</html>