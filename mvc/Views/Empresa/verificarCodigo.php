<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificação de Código | Empresa</title>

      <link rel="Shortcut Icon" type="image/png" href="img/logoIcon.png" class=" w-50 h-60 object-contain">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

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
</head>



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
        </div>
    </header>
<body class="min-h-screen flex flex-col font-sans">
    <!-- Container centralizador do formulário -->
    <div class="flex-grow flex items-center justify-center p-4 sm:p-8">

        <!-- Card Principal com Bordas Arredondadas -->
        <div class="bg-white rounded-[2rem] shadow-2xl flex flex-col md:flex-row w-full max-w-[950px] min-h-[580px] overflow-hidden opacity-0 animate-fade-in-up">

            <!-- Painel Esquerdo (Azul) -->
            <div class="bg-brand-blue w-full md:w-[45%] p-10 flex flex-col relative overflow-hidden">
                <!-- Imagem do Mapa de Fundo -->
                <img src="<?= BASE_URL ?>/img/Mapa.png" alt="Mapa Background" class="absolute inset-0 w-[150%] h-[150%] max-w-none -left-[20%] -top-[10%] object-contain opacity-40 pointer-events-none z-0 mix-blend-overlay animate-float">

                <div class="absolute top-[75%] left-[25%] transform -translate-x-1/2 -translate-y-1/2 z-0 opacity-80 pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-[4.5rem] w-[4.5rem] text-brand-yellow drop-shadow-md" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                    </svg>
                </div>

                <!-- Conteúdo da Lateral Esquerda -->
                <div class="relative z-10 flex flex-col h-full">
                    <!-- Logo GUIAR -->
                    <div class="mb-8">
                        <img src="<?= BASE_URL ?>/img/LogoGuiar.png" alt="Logo GUIAR" class="w-32 brightness-0 invert">
                    </div>

                    <!-- Slogan e Linha Amarela -->
                    <div class="my-auto">
                        <h1 class="text-white text-[2rem] leading-[1.2] font-bold mb-5 tracking-tight">
                            Segurança em<br>primeiro lugar.
                        </h1>
                        <div class="h-1 w-20 bg-brand-yellow"></div>
                    </div>
                </div>
            </div>

            <!-- Painel Direito (Formulário) -->
            <div class="w-full md:w-[55%] bg-white p-8 sm:p-14 flex flex-col justify-center items-center relative">

                <div class="w-full max-w-[360px]">

                    <!-- Cabeçalho: Ícone e Título -->
                    <div class="flex items-center justify-center gap-3 mb-10">
                        <div class="w-[4.5rem] h-[4.5rem] rounded-full bg-[#d6e0f5] flex items-center justify-center text-brand-blue shrink-0">
                            <!-- Ícone de Lock -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <!-- Título -->
                        <h2 class="text-[1.8rem] font-bold text-gray-900 tracking-tight leading-none pt-2">Código <span class="text-brand-blue font-semibold">| Empresa</span></h2>
                    </div>

                    <!-- Início do Formulário -->
                    <form class="flex flex-col gap-5" action="" method="POST">

                        <!-- Informação -->
                        <div class="text-center mb-2">
                            <p class="text-[0.95rem] text-gray-600 font-medium leading-relaxed">
                                Insira o código de verificação enviado para o seu e-mail.
                            </p>
                        </div>

                        <!-- Input Código -->
                        <div>
                            <label class="block text-[0.85rem] font-medium text-gray-700 mb-1.5 ml-1">Código de Verificação</label>
                            <input type="text" id="codigo_verificacao" name="codigo_verificacao" required
                                class="w-full px-4 py-3 rounded-xl border border-brand-inputborder focus:outline-none focus:border-brand-blue focus:ring-2 focus:ring-blue-100 transition-all text-gray-800 shadow-[0_2px_10px_rgba(0,0,0,0.02)] text-center text-xl tracking-widest font-semibold"
                                placeholder="000000">
                        </div>

                        <!-- Exibir mensagem de erro se houver -->
                        <?php if (isset($erro) && !empty($erro)): ?>
                            <div class="bg-red-50 border border-red-300 text-red-600 px-4 py-3 rounded-xl text-sm text-center font-medium shadow-sm" role="alert">
                                <?php echo htmlspecialchars($erro); ?>
                            </div>
                        <?php endif; ?>

                        <!-- Botão Verificar -->
                        <button type="submit"
                            class="w-full bg-brand-yellow text-gray-900 font-bold text-lg py-3.5 rounded-xl hover:bg-[#eacc00] hover:shadow-md transform hover:-translate-y-[1px] transition-all mt-1">
                            Verificar
                        </button>

                        <!-- Link Voltar -->
                        <div class="text-center mt-3">
                            <p class="text-sm font-medium text-gray-800">
                                <a href="<?= BASE_URL ?>/routes.php?action=loginEmpresa" class="text-brand-link font-bold hover:underline">Voltar para o Login</a>
                            </p>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

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