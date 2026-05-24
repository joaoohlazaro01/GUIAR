<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro | Empresa</title>

   
    

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="Shortcut Icon" type="image/png" href="<?= BASE_URL ?>/img/logoIcon.png" class=" w-50 h-60 object-contain">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            blue: '#001b69',
                            yellow: '#ffd400',
                            inputborder: '#c3d2e6',
                            link: '#00288a'
                        }
                    },
                    animation: {
                        'fade-in-up': 'fadeInUp 0.8s ease-out forwards',
                        'float': 'float 6s ease-in-out infinite',
                    },
                    keyframes: {
                        fadeInUp: {
                            '0%': {
                                opacity: '0',
                                transform: 'translateY(30px)'
                            },
                            '100%': {
                                opacity: '1',
                                transform: 'translateY(0)'
                            },
                        },
                        float: {
                            '0%, 100%': {
                                transform: 'translateY(0)'
                            },
                            '50%': {
                                transform: 'translateY(-15px)'
                            },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body {
            background: linear-gradient(135deg, #e6eaf0 0%, #f0f4f8 100%);
        }
    </style>

    <script>
        // Função para remover o parâmetro 'erro' da URL após carregar a página
        window.onload = function() {
            const url = new URL(window.location);
            if (url.searchParams.has('erro')) {
                url.searchParams.delete('erro');
                window.history.replaceState({}, document.title, url);
            }
        };

        // Função para formatar o CNPJ enquanto o usuário digita
        function formatCNPJ(cnpj) {
            cnpj = cnpj.replace(/\D/g, ""); // Remove caracteres não numéricos
            cnpj = cnpj.replace(/^(\d{2})(\d)/, "$1.$2"); // Coloca ponto após os dois primeiros dígitos
            cnpj = cnpj.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3"); // Coloca ponto após os próximos três dígitos
            cnpj = cnpj.replace(/\.(\d{3})(\d)/, ".$1/$2"); // Coloca uma barra após os três dígitos seguintes
            cnpj = cnpj.replace(/(\d{4})(\d)/, "$1-$2"); // Coloca um traço após os quatro dígitos seguintes
            return cnpj;
        }

        function validateCNPJInput(event) {
            const input = event.target;
            input.value = formatCNPJ(input.value);
        }

        function VerificarEmail() {
            const email = document.getElementById('email').value;
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!emailPattern.test(email)) {
                alert('O e-mail não está no formato correto');
                return;
            }

            const domain = email.split('@')[1];
            fetch(`https://dns.google/resolve?name=${domain}&type=MX`)
                .then(response => response.json())
                .then(data => {
                    if (data.Answer && data.Answer.length > 0) {
                        // Se válido, envia o formulário
                        document.getElementById('cadaForm').submit();
                    } else {
                        alert('Domínio de e-mail desconhecido ou sem registros.');
                    }
                })
                .catch(() => {
                    alert('Erro ao fazer a verificação de domínio.');
                });
        }
    </script>
</head>

<body class="min-h-screen flex flex-col font-sans">

    <!-- HEADER -->
    <header class="bg-brand-blue shadow-md py-0 px-8 sticky top-0 z-50">

        <div class="max-w-7xl mx-auto flex items-center justify-between">

            <!-- LOGO -->
            <div class="flex items-center -my-6">
                <a href="<?= BASE_URL ?>/index.html">
                    <img src="<?= BASE_URL ?>/img/LogoGuiar.png" alt="LOGO" class="w-52 h-auto object-contain brightness-0 invert">
                </a>
            </div>

            <!-- MENU DESKTOP -->
            <nav class="hidden md:flex items-center gap-12 font-semibold text-xl">
                <a href="<?= BASE_URL ?>/index.html" class="text-white/90 hover:text-brand-yellow transition duration-300">Home</a>
                <a href="<?= BASE_URL ?>/routes.php?action=loginEmpresa" class="text-brand-yellow font-bold underline decoration-2 underline-offset-4 transition duration-300">Empresa</a>
                <a href="<?= BASE_URL ?>/routes.php?action=loginEntregador" class="text-white/90 hover:text-brand-yellow transition duration-300">Entregador</a>
                <a href="<?= BASE_URL ?>/contato.php" class="text-white/90 hover:text-brand-yellow transition duration-300">Contato</a>
            </nav>

            <!-- BOTÃO MOBILE -->
            <button id="nav-toggle" class="md:hidden p-2 text-white focus:outline-none hover:bg-white/10 rounded-lg transition-colors" type="button">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>

        <!-- MENU MOBILE -->
        <div id="nav-menu" class="hidden w-full md:hidden pb-4">
            <div class="flex flex-col gap-4 text-lg font-semibold mt-4">
                <a href="<?= BASE_URL ?>/index.html" class="text-white/90">Home</a>
                <a href="<?= BASE_URL ?>/routes.php?action=loginEmpresa" class="text-brand-yellow font-bold">Empresa</a>
                <a href="<?= BASE_URL ?>/routes.php?action=loginEntregador" class="text-white/90">Entregador</a>
                <a href="<?= BASE_URL ?>/contato.php" class="text-white/90">Contato</a>
            </div>
        </div>

    </header>

    <!-- Container centralizador do formulário -->
    <div class="flex-grow flex items-center justify-center p-4 sm:p-8">

        <!-- Card Principal com Bordas Arredondadas -->
        <div class="bg-white rounded-[2rem] shadow-2xl flex flex-col md:flex-row w-full max-w-[1080px] min-h-[260px] overflow-hidden opacity-0 animate-fade-in-up">

            <!-- Painel Esquerdo (Azul) -->
            <div class="bg-brand-blue w-full md:w-[40%] p-10 flex flex-col relative overflow-hidden">
                <!-- Imagem do Mapa de Fundo -->
                  <img src="<?= BASE_URL ?>/img/Mapa.png" alt="Mapa Background" class="absolute inset-0 w-[150%] h-[150%] max-w-none -left-[20%] -top-[10%] object-contain opacity-40 pointer-events-none z-0 mix-blend-overlay animate-float">




                <div class="hidden md:block absolute top-[75%] left-[25%] transform -translate-x-1/2 -translate-y-1/2 z-0 opacity-80 pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-[4.5rem] w-[4.5rem] text-brand-yellow drop-shadow-md" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                    </svg>
                </div>

                <!-- Conteúdo da Lateral Esquerda -->
                <div class="relative z-10 flex flex-col h-full">
                    <!-- Logo GUIAR -->
            <div class="mb-8">
            <img
              src="<?= BASE_URL ?>/img/LogoGuiar.png"
              alt="Logo GUIAR"
              class="w-32 brightness-0 invert">
          </div>

                    <!-- Slogan e Linha Amarela -->
                    <div class="my-auto">
                        <h1 class="text-white text-[2rem] leading-[1.2] font-bold mb-5 tracking-tight">
                            Junte-se ao Guiar e<br>cresça conosco.
                        </h1>
                        <div class="h-1 w-20 bg-brand-yellow"></div>
                    </div>
                </div>
            </div>

            <!-- Painel Direito (Formulário Cadastro) -->
            <div class="w-full md:w-[60%] bg-white p-5 sm:p-8 flex flex-col justify-center items-center relative">

                <div class="w-full max-w-[520px]">

                    <!-- Cabeçalho: Ícone e Título -->
                    <div class="flex items-center justify-center gap-3 mb-8">
                        <div class="w-[4.5rem] h-[4.5rem] rounded-full bg-[#d6e0f5] flex items-center justify-center text-brand-blue shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <h2 class="text-[1.8rem] font-bold text-gray-900 tracking-tight leading-none pt-2">Cadastro <span class="text-brand-blue font-semibold">| Empresa</span></h2>
                    </div>

                    <!-- Formulário -->
                    <form class="flex flex-col gap-3" action="<?= BASE_URL ?>/routes.php?action=cadastroEmpresa" method="POST" id="cadaForm" enctype="multipart/form-data">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-[0.85rem] font-medium text-gray-700 mb-1 ml-1">Email</label>
                                <input type="email" id="email" name="email" required
                                    class="w-full px-4 py-3 rounded-xl border border-brand-inputborder focus:outline-none focus:border-brand-blue focus:ring-2 focus:ring-blue-100 transition-all text-gray-800 shadow-[0_2px_10px_rgba(0,0,0,0.02)]">
                            </div>

                            <!-- Senha -->
                            <div>
                                <label for="inputPassword4" class="block text-[0.85rem] font-medium text-gray-700 mb-1 ml-1">Senha</label>
                                <input type="password" id="inputPassword4" name="senha" required
                                    class="w-full px-4 py-3 rounded-xl border border-brand-inputborder focus:outline-none focus:border-brand-blue focus:ring-2 focus:ring-blue-100 transition-all text-gray-800 shadow-[0_2px_10px_rgba(0,0,0,0.02)]">
                            </div>
                        </div>

                        <!-- Nome da Empresa -->
                        <div>
                            <label for="inputAddress" class="block text-[0.85rem] font-medium text-gray-700 mb-1 ml-1">Nome da Empresa</label>
                            <input type="text" id="inputAddress" name="nome_empresa" required
                                class="w-full px-4 py-3 rounded-xl border border-brand-inputborder focus:outline-none focus:border-brand-blue focus:ring-2 focus:ring-blue-100 transition-all text-gray-800 shadow-[0_2px_10px_rgba(0,0,0,0.02)]">
                        </div>

                        <!-- Nome de Usuario -->
                        <div>
                            <label for="inputAddress2" class="block text-[0.85rem] font-medium text-gray-700 mb-1 ml-1">Nome de Usuário</label>
                            <input type="text" id="inputAddress2" name="nome_usuario"
                                class="w-full px-4 py-3 rounded-xl border border-brand-inputborder focus:outline-none focus:border-brand-blue focus:ring-2 focus:ring-blue-100 transition-all text-gray-800 shadow-[0_2px_10px_rgba(0,0,0,0.02)]">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- CNPJ -->
                            <div>
                                <label for="inputCity" class="block text-[0.85rem] font-medium text-gray-700 mb-1 ml-1">CNPJ</label>
                                <input type="text" id="inputCity" name="cnpj" required minlength="18" maxlength="18" pattern="\d{2}\.\d{3}\.\d{3}\/\d{4}-\d{2}" title="Digite um CNPJ válido" oninput="validateCNPJInput(event)"
                                    class="w-full px-4 py-3 rounded-xl border border-brand-inputborder focus:outline-none focus:border-brand-blue focus:ring-2 focus:ring-blue-100 transition-all text-gray-800 shadow-[0_2px_10px_rgba(0,0,0,0.02)]">
                            </div>

                            <!-- Imagem da Empresa -->
                            <div>
                                <label for="formFile" class="block text-[0.85rem] font-medium text-gray-700 mb-1 ml-1">Imagem da Empresa</label>
                                <input type="file" id="formFile" name="foto_logo"
                                    class="w-full px-3 py-2 rounded-xl border border-brand-inputborder focus:outline-none focus:border-brand-blue focus:ring-2 focus:ring-blue-100 transition-all text-gray-800 shadow-[0_2px_10px_rgba(0,0,0,0.02)] file:mr-3 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-[0.75rem] file:font-bold file:bg-blue-50 file:text-brand-blue hover:file:bg-blue-100 bg-white">
                            </div>
                        </div>

                        <!-- Exibir mensagem de erro se houver -->
                        <?php if (isset($erro) && !empty($erro)): ?>
                            <div class="bg-red-50 border border-red-300 text-red-600 px-4 py-3 rounded-xl text-sm text-center font-medium shadow-sm mt-2" role="alert">
                                <?php echo htmlspecialchars($erro); ?>
                            </div>
                        <?php endif ?>

                        <!-- Informativo de Termos de Uso -->
                        <div class="bg-blue-50/50 border border-brand-inputborder/40 p-4 rounded-xl text-center mt-2">
                            <p class="text-xs text-gray-600 leading-normal">
                                Ao clicar em <strong>Fazer Cadastro</strong>, você concorda com nossos <a href="<?= BASE_URL ?>/routes.php?action=termosUso" target="_blank" class="text-brand-link font-bold hover:underline">Termos de Uso e Política de Privacidade</a> e será direcionado para confirmá-los.
                            </p>
                        </div>

                        <!-- Botão Fazer Cadastro -->
                        <button type="submit" id="botao"
                            class="w-full bg-brand-yellow text-gray-900 font-bold text-lg py-3 rounded-xl hover:bg-[#eacc00] hover:shadow-md transform hover:-translate-y-[1px] transition-all mt-4">
                            Fazer Cadastro
                        </button>

                        <!-- Link Login -->
                        <div class="text-center mt-2">
                            <p class="text-sm font-medium text-gray-800">
                                Já tem uma conta?
                                <a id="cadastro" href="<?= BASE_URL ?>/routes.php?action=loginEmpresa" class="text-brand-link font-bold hover:underline">Faça login</a>
                            </p>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- RODAPÉ -->
    <footer class="w-full bg-brand-blue px-6 py-4 mt-auto border-t border-white/10 shadow-inner z-50">
        <div class="w-full flex flex-col md:flex-row items-center justify-between text-[0.85rem] text-white/80">
            <p class="mb-2 md:mb-0">&copy; <?= date('Y') ?> GUIAR. Todos os direitos reservados.</p>
            <div class="flex space-x-4 font-medium">
                <a href="#" class="hover:text-brand-yellow transition-colors">Política de Privacidade</a>
                <a href="<?= BASE_URL ?>/routes.php?action=termosUso" class="hover:text-brand-yellow transition-colors">Termos de Serviço</a>
            </div>
        </div>
    </footer>



    <script>
        // Toggle do menu mobile
        const btn = document.getElementById('nav-toggle');
        const menu = document.getElementById('nav-menu');
        if (btn && menu) {
            btn.addEventListener('click', () => {
                menu.classList.toggle('hidden');
                menu.classList.toggle('flex');
            });
        }
    </script>
</body>

</html>