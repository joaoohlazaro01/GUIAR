<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | Empresa</title>
  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="Shortcut Icon" type="image/png" href="<?= BASE_URL ?>/img/logo_branca.png" class="w-6 h-6">

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
  </script>
</head>

<body class="min-h-screen flex flex-col font-sans">

  <!-- NAVBAR -->
  <nav class="w-full bg-brand-blue px-6 py-3 flex flex-wrap items-center justify-between shadow-md z-50">
    <a href="<?= BASE_URL ?>/index.html">
      <img class="h-[90px] object-contain" src="<?= BASE_URL ?>/img/LogoBranca.png" alt="LOGO" onerror="this.outerHTML='<span class=\'text-white text-2xl font-extrabold\'>GUIAR</span>'">
    </a>
    <button id="nav-toggle" class="md:hidden p-2 text-white focus:outline-none hover:bg-white/10 rounded-lg transition-colors">
      <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
      </svg>
    </button>
    <div id="nav-menu" class="hidden w-full md:flex md:w-auto md:space-x-8 mt-4 md:mt-0 flex-col md:flex-row items-center">
      <a href="<?= BASE_URL ?>/index.html" class="block py-2 text-[1.1rem] font-medium text-white/90 hover:text-brand-yellow transition-colors">Home</a>
      <a href="<?= BASE_URL ?>/routes.php?action=loginEntregador" class="block py-2 text-[1.1rem] font-medium text-white/90 hover:text-brand-yellow transition-colors">Entregador</a>
      <a href="<?= BASE_URL ?>/routes.php?action=loginEmpresa" class="block py-2 text-[1.1rem] font-semibold text-brand-yellow transition-colors underline decoration-2 underline-offset-4">Empresa</a>
      <a href="<?= BASE_URL ?>/contato.php" class="block py-2 text-[1.1rem] font-medium text-white/90 hover:text-brand-yellow transition-colors">Contato</a>
    </div>
  </nav>

  <!-- Container centralizador do formulário -->
  <div class="flex-grow flex items-center justify-center p-4 sm:p-8">

    <!-- Card Principal com Bordas Arredondadas -->
    <div class="bg-white rounded-[2rem] shadow-2xl flex flex-col md:flex-row w-full max-w-[950px] min-h-[580px] overflow-hidden opacity-0 animate-fade-in-up">

      <!-- Painel Esquerdo (Azul) -->
      <div class="bg-brand-blue w-full md:w-[45%] p-10 flex flex-col relative overflow-hidden">
        <!-- Imagem do Mapa de Fundo -->
        <img src="<?= BASE_URL ?>/img/mapapng.png" alt="Mapa Background" class="absolute inset-0 w-[150%] h-[150%] max-w-none -left-[20%] -top-[10%] object-contain opacity-30 pointer-events-none z-0 mix-blend-overlay animate-float">



        <div class="absolute top-[75%] left-[25%] transform -translate-x-1/2 -translate-y-1/2 z-0 opacity-80 pointer-events-none">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-[4.5rem] w-[4.5rem] text-brand-yellow drop-shadow-md" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
          </svg>
        </div>

        <!-- Conteúdo da Lateral Esquerda -->
        <div class="relative z-10 flex flex-col h-full">
          <!-- Logo GUIAR -->
          <div class="-mt-4">
            <!-- Usando logo original transformado para branco, se não existir exibe texto padrão -->
            <img src="<?= BASE_URL ?>/img/LogoBranca.png" alt="GUIAR" class="h-[6.5rem] sm:h-[8rem] w-auto object-contain"
              onerror="this.outerHTML='<span class=\'text-white text-[2.5rem] font-extrabold tracking-widest\'>GUIAR</span>'">
          </div>

          <!-- Slogan e Linha Amarela -->
          <div class="my-auto">
            <h1 class="text-white text-[2rem] leading-[1.2] font-bold mb-5 tracking-tight">
              Entre e deixe o Guiar<br>te mostrar a direção.
            </h1>
            <div class="h-1 w-20 bg-brand-yellow"></div>
          </div>
        </div>
      </div>

      <!-- Painel Direito (Formulário) -->
      <div class="w-full md:w-[55%] bg-white p-8 sm:p-14 flex flex-col justify-center items-center relative">

        <div class="w-full max-w-[360px]">

          <!-- Cabeçalho: Ícone do Prédio e Título -->
          <div class="flex items-center justify-center gap-3 mb-10">
            <!-- Ícone de Empresa (Fundo circular azul claro) -->
            <div class="w-[4.5rem] h-[4.5rem] rounded-full bg-[#d6e0f5] flex items-center justify-center text-brand-blue shrink-0">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
              </svg>
            </div>
            <!-- Título -->
            <h2 class="text-[1.8rem] font-bold text-gray-900 tracking-tight leading-none pt-2">Login <span class="text-brand-blue font-semibold">| Empresa</span></h2>
          </div>

          <!-- Início do Formulário -->
          <form class="flex flex-col gap-5" action="<?= BASE_URL ?>/routes.php?action=loginEmpresa" method="POST">

            <!-- Input Nome de Usuário -->
            <div>
              <label class="block text-[0.85rem] font-medium text-gray-700 mb-1.5 ml-1">Nome de Usuário</label>
              <input type="text" name="username" required
                class="w-full px-4 py-3 rounded-xl border border-brand-inputborder focus:outline-none focus:border-brand-blue focus:ring-2 focus:ring-blue-100 transition-all text-gray-800 shadow-[0_2px_10px_rgba(0,0,0,0.02)]"
                placeholder="">
            </div>

            <!-- Input Senha -->
            <div>
              <label class="block text-[0.85rem] font-medium text-gray-700 mb-1.5 ml-1">Senha</label>
              <input type="password" name="password" required
                class="w-full px-4 py-3 rounded-xl border border-brand-inputborder focus:outline-none focus:border-brand-blue focus:ring-2 focus:ring-blue-100 transition-all text-gray-800 shadow-[0_2px_10px_rgba(0,0,0,0.02)]"
                placeholder="">
            </div>

            <!-- Link Esqueceu a Senha -->
            <div class="text-center mt-1">
              <a href="<?= BASE_URL ?>/routes.php?action=esqueceuSenha" class="text-brand-link text-[0.85rem] font-bold hover:underline tracking-wide">Esqueceu sua senha?</a>
            </div>

            <!-- Exibir mensagem de erro se houver -->
            <?php if (isset($erro) && !empty($erro)): ?>
              <div class="bg-red-50 border border-red-300 text-red-600 px-4 py-3 rounded-xl text-sm text-center font-medium shadow-sm" role="alert">
                <?php echo htmlspecialchars($erro); ?>
              </div>
            <?php endif ?>

            <!-- Botão Entrar -->
            <button type="submit"
              class="w-full bg-brand-yellow text-gray-900 font-bold text-lg py-3.5 rounded-xl hover:bg-[#eacc00] hover:shadow-md transform hover:-translate-y-[1px] transition-all mt-1">
              Entrar
            </button>

            <!-- Link Cadastro -->
            <div class="text-center mt-3">
              <p class="text-sm font-medium text-gray-800">
                Não tem uma conta?
                <a href="<?= BASE_URL ?>/routes.php?action=cadastroEmpresa" class="text-brand-link font-bold hover:underline">Faça cadastro</a>
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
        <a href="#" class="hover:text-brand-yellow transition-colors">Termos de Serviço</a>
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