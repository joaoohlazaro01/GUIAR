<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard dos Motoboys</title>
   <link rel="Shortcut Icon" type="image/png" href="img/Glogo.png">
    
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

         /* MOBILE */
        @media(max-width:768px){

            #sidebar{
                transform:translateX(-100%);
                transition:.3s ease;
                border-radius:0 !important;
                top:0 !important;
                left:0 !important;
                margin:0 !important;
                height:100vh !important;
                width:280px !important;
            }

            #sidebar.mobile-open{
                transform:translateX(0);
            }

            #overlay.active{
                display:block;
            }

            .content-mobile{
                margin-left:0 !important;
            }

            .profile-card{
                padding:24px !important;
            }
        }
    </style>
    </style>
</head>

<body class="flex h-screen overflow-hidden text-gray-800">

    <div id="sidebarOverlay" class="fixed inset-0 bg-[#0B0D2F]/50 backdrop-blur-sm z-40 hidden transition-opacity md:hidden"></div>

   <aside id="sidebar"
    class="w-72 bg-[#0B0D2F] flex flex-col fixed top-4 left-4 text-white z-40 shadow-2xl transition-all rounded-[24px] overflow-hidden h-[92vh]">

    <div class="flex flex-col h-full">

        <!-- BOTÃO FECHAR MOBILE -->
        <button id="closeSidebar"
            class="absolute top-5 right-5 md:hidden text-white text-2xl z-50">

            ✕
        </button>

        <!-- LOGO -->
        <div class="p-8 mb-4">
            <img src="<?= BASE_URL ?>/img/logobrancaR.png"
                alt="Logo GUIAR"
                class="w-32 h-auto object-contain">
        </div>

        <!-- MENU -->
        <nav class="px-4 space-y-2 flex-grow overflow-y-auto">

            <!-- INÍCIO -->
            <a href="<?= BASE_URL ?>/routes.php?action=dashboardAdm"
                 class="menu-item flex items-center gap-3.5 px-5 py-3 rounded-xl font-semibold text-sm text-slate-400 hover:text-white hover:bg-white/5 transition-all">

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

            <!-- ENTREGADORES -->
            <a href="<?= BASE_URL ?>/routes.php?action=entregadores"
                class="menu-item flex items-center gap-3.5 px-5 py-3 rounded-xl font-bold text-sm bg-[#FFD400] text-[#0B0D2F] shadow-lg shadow-yellow-500/10 transition-all">

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

            <!-- MAPA -->
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

            <!-- PERFIL -->
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

        <!-- FOOTER -->
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

    // MODAL
    const modal = document.getElementById("editProfileModal");
    const openBtn = document.getElementById("openEditModalBtn");
    const closeBtn = document.getElementById("closeEditModalBtn");

    openBtn.addEventListener("click", () => {
        modal.classList.remove("hidden");
    });

    closeBtn.addEventListener("click", () => {
        modal.classList.add("hidden");
    });

    window.addEventListener("click", (event) => {

        if (event.target === modal) {
            modal.classList.add("hidden");
        }
    });

</script>
</body>
</html>