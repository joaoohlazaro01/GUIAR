<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="Shortcut Icon" type="image/png" href="img/Glogo.png">
    <title>Meu Perfil | Administrador</title>


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
</head>

<body class="bg-[#F3F4F6] text-gray-800 antialiased min-h-screen">

<div class="flex min-h-screen relative">

    <!-- OVERLAY -->
    <div id="overlay"
        class="hidden fixed inset-0 bg-black/40 z-30 md:hidden">
    </div>


   <!-- SIDEBAR -->
<?php
$nomeAdmin = $admin["nome_adm"] ?? "Admin";
?>

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
                class="menu-item flex items-center gap-3.5 px-5 py-3 rounded-xl font-bold text-sm bg-[#FFD400] text-[#0B0D2F] shadow-lg shadow-yellow-500/10 transition-all">
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
            <h2 class="text-lg md:text-2xl font-bold text-gray-800">
                Meu Perfil
            </h2>
        </header>

        <!-- CONTEÚDO -->
        <div class="flex-1 flex items-center justify-center p-4 md:p-10">

            <div class="w-full max-w-xl">

                <!-- ALERTAS -->
                <?php if ($sucesso): ?>

                    <div class="mb-6 bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded-xl font-medium text-center">
                        <?= htmlspecialchars($sucesso) ?>
                    </div>

                <?php endif; ?>

                <?php if ($erro): ?>

                    <div class="mb-6 bg-red-100 border border-red-200 text-red-700 px-4 py-3 rounded-xl font-medium text-center">
                        <?= htmlspecialchars($erro) ?>
                    </div>

                <?php endif; ?>

                <!-- CARD -->
                <div class="profile-card bg-white rounded-3xl shadow-sm border border-gray-100 p-8 md:p-10 text-center">

                    <?php
                        $imagem_path = BASE_URL . "/public/uploads/empresas/" . htmlspecialchars($nome_empresa) . "/" . htmlspecialchars($admin["nome_foto"]);
                    ?>

                    <div class="flex justify-center mb-6">

                        <img src="<?= $imagem_path ?>"
                            alt="Foto de <?= htmlspecialchars($admin["nome_adm"]) ?>"
                            class="w-32 h-32 rounded-full object-cover border-4 border-[#FFD400] shadow-lg">
                    </div>

                    <h1 class="text-3xl font-bold text-gray-800 mb-2">
                        <?= htmlspecialchars($admin["nome_adm"]) ?>
                    </h1>

                    <p class="text-gray-500 mb-8">
                        Administrador da Plataforma
                    </p>

                    <div class="space-y-4 text-left">

                        <div class="bg-gray-50 rounded-2xl p-4 border border-gray-100">

                            <span class="block text-sm text-gray-500 mb-1">
                                Usuário
                            </span>

                            <span class="font-semibold text-gray-800">
                                <?= htmlspecialchars($admin["nome_usuario"]) ?>
                            </span>
                        </div>

                        <div class="bg-gray-50 rounded-2xl p-4 border border-gray-100">

                            <span class="block text-sm text-gray-500 mb-1">
                                Empresa
                            </span>

                            <span class="font-semibold text-gray-800">
                                <?= htmlspecialchars($nome_empresa) ?>
                            </span>
                        </div>
                    </div>

                    <button id="openEditModalBtn"
                        class="mt-8 w-full md:w-auto px-8 py-3 bg-[#fc8835] hover:bg-[#e06c00] text-white rounded-xl shadow-lg hover:shadow-xl transition-all font-medium">

                        Editar Perfil
                    </button>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- MODAL -->
<div id="editProfileModal"
    class="hidden fixed inset-0 z-50 bg-black/50 flex items-center justify-center p-4">

    <div class="bg-white rounded-3xl w-full max-w-lg p-6 md:p-8 relative shadow-2xl">

        <!-- FECHAR -->
        <button id="closeEditModalBtn"
            class="absolute top-5 right-5 text-gray-400 hover:text-gray-700 text-2xl">

            ×
        </button>

        <h2 class="text-2xl font-bold text-gray-800 mb-6">
            Editar Meu Perfil
        </h2>

        <form action="<?= BASE_URL ?>/routes.php?action=editarPerfilAdm"
            method="POST"
            enctype="multipart/form-data"
            class="space-y-5">

            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">
                    Nome Completo
                </label>

                <input type="text"
                    id="nome_adm"
                    name="nome_adm"
                    value="<?= htmlspecialchars($admin["nome_adm"]) ?>"
                    required

                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#fc8835]">
            </div>

            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">
                    Nome de Usuário
                </label>

                <input type="text"
                    id="nome_usuario"
                    name="nome_usuario"
                    value="<?= htmlspecialchars($admin["nome_usuario"]) ?>"
                    required

                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#fc8835]">
            </div>

            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">
                    Nova Senha
                </label>

                <input type="password"
                    id="senha"
                    name="senha"
                    placeholder="Nova senha"

                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#fc8835]">

                <span class="text-xs text-gray-500 mt-2 block">
                    Deixe em branco para manter a senha atual.
                </span>
            </div>

            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">
                    Alterar Foto de Perfil
                </label>

                <input type="file"
                    id="adminFoto"
                    name="adminFoto"
                    accept="image/*"

                    class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white">
            </div>

            <button type="submit"
                class="w-full py-3 bg-[#fc8835] hover:bg-[#e06c00] text-white rounded-xl shadow-lg hover:shadow-xl transition-all font-medium">

                Salvar Alterações
            </button>
        </form>
    </div>
</div>

<!-- SCRIPT -->
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