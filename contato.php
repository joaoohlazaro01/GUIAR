<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="Shortcut Icon" type="image/png" href="img/Glogo.png">
    <title>Contato | GUIAR</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            overflow-x: hidden;
            margin: 0;
            padding: 0;
        }

        /* glass effect */
        .glass {
            background: rgba(255, 255, 255, 0.10);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Garantia de que o menu mobile fique sobre o conteúdo */
        #nav-menu {
            z-index: 9999 !important;
        }
    </style>
</head>

<body class="bg-[#F5F5F5] min-h-screen flex flex-col">

    <header class="bg-white shadow-md px-4 md:px-8 sticky top-0 z-[1000] flex items-center h-20 md:h-24">

        <div class="max-w-7xl mx-auto flex items-center justify-between w-full">

            <div class="flex items-center">
                <a href="index.html" class="flex items-center">
                    <img src="img/LogoGuiar.png" class="w-32 md:w-44 h-auto object-contain" alt="Logo GUIAR">
                </a>
            </div>

            <button id="nav-toggle" class="md:hidden p-3 bg-[#1B138F] text-white rounded-lg focus:outline-none" type="button">
                ☰
            </button>

            <nav class="hidden md:flex items-center gap-10 font-semibold text-2xl">

                <a href="index.html" class="relative text-[#1B138F] hover:text-[#FFD400] transition duration-300
                    after:content-[''] after:absolute after:left-0 after:-bottom-1
                    after:w-0 after:h-[3px] after:bg-[#FFD400]
                    after:transition-all after:duration-300 hover:after:w-full">
                    Home
                </a>

                <a href="routes.php?action=loginEmpresa" class="relative text-[#1B138F] hover:text-[#FFD400] transition duration-300
                    after:content-[''] after:absolute after:left-0 after:-bottom-1
                    after:w-0 after:h-[3px] after:bg-[#FFD400]
                    after:transition-all after:duration-300 hover:after:w-full">
                    Empresa
                </a>

                <a href="routes.php?action=loginEntregador" class="relative text-[#1B138F] hover:text-[#FFD400] transition duration-300
                    after:content-[''] after:absolute after:left-0 after:-bottom-1
                    after:w-0 after:h-[3px] after:bg-[#FFD400]
                    after:transition-all after:duration-300 hover:after:w-full">
                    Entregador
                </a>

                <a href="contato.php" class="relative text-[#1B138F] hover:text-[#FFD400] transition duration-300
                    after:content-[''] after:absolute after:left-0 after:-bottom-1
                    after:w-0 after:h-[3px] after:bg-[#FFD400]
                    after:transition-all after:duration-300 hover:after:w-full">
                    Contato
                </a>

            </nav>

        </div>

        <div id="nav-menu" class="hidden absolute left-0 top-full w-full bg-white shadow-2xl border-t border-gray-100">
            <div class="flex flex-col font-semibold text-[#1B138F]">
                <a href="index.html" class="px-6 py-4 border-b border-gray-100 hover:bg-gray-50">Home</a>
                <a href="routes.php?action=loginEmpresa" class="px-6 py-4 border-b border-gray-100 hover:bg-gray-50">Empresa</a>
                <a href="routes.php?action=loginEntregador" class="px-6 py-4 border-b border-gray-100 hover:bg-gray-50">Entregador</a>
                <a href="contato.php" class="px-6 py-4 text-[#FFD400] hover:bg-gray-50">Contato</a>
            </div>
        </div>

    </header>

    <main class="flex-1 relative">

        <div class="relative min-h-[90vh] flex items-center justify-center px-4 py-12">

            <div class="absolute inset-0">
                <img src="img/contatosR.png" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-[#1B138F]/30"></div>
            </div>

            <div class="relative z-10 w-full max-w-lg glass rounded-3xl p-8 text-white shadow-2xl">

                <h1 class="text-3xl font-black text-center mb-8 text-[#FFD400]">
                    Fale Conosco
                </h1>

                <form class="space-y-5">
                    <div>
                        <label class="text-sm text-white/80">Nome</label>
                        <input type="text" placeholder="Digite seu nome"
                            class="w-full mt-1 p-4 rounded-xl bg-white text-gray-900 outline-none focus:ring-4 focus:ring-[#FFD400]/40">
                    </div>

                    <div>
                        <label class="text-sm text-white/80">E-mail</label>
                        <input type="email" placeholder="Digite seu e-mail"
                            class="w-full mt-1 p-4 rounded-xl bg-white text-gray-900 outline-none focus:ring-4 focus:ring-[#FFD400]/40">
                    </div>

                    <div>
                        <label class="text-sm text-white/80">Mensagem</label>
                        <textarea rows="4" placeholder="Escreva sua mensagem..."
                            class="w-full mt-1 p-4 rounded-xl bg-white text-gray-900 outline-none resize-none focus:ring-4 focus:ring-[#FFD400]/40"></textarea>
                    </div>

                    <button type="submit"
                        class="w-full py-4 rounded-full bg-white/10 backdrop-blur-md border border-white/30 text-white font-black text-lg hover:bg-[#FFD400] hover:text-[#1B138F] hover:scale-[1.03] transition duration-300 shadow-lg">
                        ENVIAR MENSAGEM
                    </button>
                </form>

            </div>

        </div>

    </main>

    <footer class="w-full bg-[#1B138F] px-6 py-4 mt-auto border-t border-white/10 text-white/80">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between text-[0.85rem]">
            <p>&copy; <?= date('Y') ?> GUIAR. Todos os direitos reservados.</p>
            <div class="flex space-x-4 font-medium mt-2 md:mt-0">
                <a href="#" class="hover:text-yellow-300 transition-colors">Política de Privacidade</a>
                <a href="#" class="hover:text-yellow-300 transition-colors">Termos de Serviço</a>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const btn = document.getElementById("nav-toggle");
            const menu = document.getElementById("nav-menu");

            btn.onclick = (e) => {
                e.stopPropagation();
                menu.classList.toggle("hidden");
            };

            document.onclick = (e) => {
                if (!menu.contains(e.target) && !btn.contains(e.target)) {
                    menu.classList.add("hidden");
                }
            };
        });
    </script>

</body>

</html>