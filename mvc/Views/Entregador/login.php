<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Login Entregador | Guiar</title>
  <!-- Tailwind -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="Shortcut Icon" type="image/png" href="<?= BASE_URL ?>/img/Glogo.png">

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
      background-color: #FFF1E5;
    }
  </style>

</head>

<body class="bg-[#FFF1E5] overflow-x-hidden text-gray-900 flex flex-col min-h-screen">

  <!-- HEADER -->
  <header class="bg-[#F37B1D] shadow-md py-0 px-8 sticky top-0 z-50">

    <div class="max-w-7xl mx-auto flex items-center justify-between">

      <!-- LOGO -->
      <div class="flex items-center -my-6">
        <a href="<?= BASE_URL ?>/index.html">
          <img src="<?= BASE_URL ?>/img/LogoGuiar.png" alt="LOGO" class="w-52 h-auto object-contain brightness-0 invert">
        </a>
      </div>

      <!-- MENU DESKTOP -->
      <nav class="hidden md:flex items-center gap-12 font-semibold text-xl">
        <a href="<?= BASE_URL ?>/index.html" class="text-white/90 hover:text-[#FFD400] transition duration-300">Home</a>
        <a href="<?= BASE_URL ?>/routes.php?action=loginEmpresa" class="text-white/90 hover:text-[#FFD400] transition duration-300">Empresa</a>
        <a href="<?= BASE_URL ?>/routes.php?action=loginEntregador" class="text-[#FFD400] font-bold underline decoration-2 underline-offset-4 transition duration-300">Entregador</a>
        <a href="<?= BASE_URL ?>/contato.php" class="text-white/90 hover:text-[#FFD400] transition duration-300">Contato</a>
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
        <a href="<?= BASE_URL ?>/routes.php?action=loginEmpresa" class="text-white/90">Empresa</a>
        <a href="<?= BASE_URL ?>/routes.php?action=loginEntregador" class="text-[#FFD400] font-bold">Entregador</a>
        <a href="<?= BASE_URL ?>/contato.php" class="text-white/90">Contato</a>
      </div>
    </div>

  </header>

  <!-- MAIN -->
  <main class="flex-grow flex items-center justify-center px-6 py-16">

    <!-- CARD -->
    <div class="flex flex-col md:flex-row w-full max-w-4xl my-10 bg-white rounded-[40px] shadow-[0_20px_50px_rgba(0,0,0,0.10)] overflow-hidden min-h-[450px]">

      <!-- LADO ESQUERDO -->
      <div class="md:w-[45%] bg-[#F37B1D] p-10 flex flex-col justify-center relative overflow-hidden text-white">

        <!-- IMAGEM FUNDO -->
        <div
          class="absolute inset-0 bg-no-repeat bg-contain bg-bottom brightness-0 invert opacity-30"
          style="background-image: url('<?= BASE_URL ?>/img/CabecalhoSem.png');">
        </div>

        <div class="relative z-10 flex flex-col h-full">

          <!-- LOGO -->
          <div class="mb-8">
            <img
              src="<?= BASE_URL ?>/img/LogoGuiar.png"
              alt="Logo GUIAR"
              class="w-32 brightness-0 invert">
          </div>

          <!-- TEXTO -->
          <h2
            class="text-3xl font-black leading-tight drop-shadow-sm mb-4"
            style="font-family: 'Inter', sans-serif;">

            Entre e deixe o Guiar<br>
            te mostrar a direção.

          </h2>

          <div class="w-16 h-[3px] bg-[#FFD400] mt-2 mb-8"></div>

          <div class="mt-auto">
            <i class="fa fa-truck text-4xl text-[#FFD400]"></i>
          </div>

        </div>

      </div>

      <!-- LADO DIREITO -->
      <div class="md:w-[55%] p-8 md:p-12 flex flex-col justify-center bg-white relative">

        <!-- TÍTULO -->
        <div class="flex items-center gap-4 mb-8">

          <div class="w-14 h-14 rounded-full bg-[#FFF8D6] flex items-center justify-center flex-shrink-0">

            <i class="fa fa-truck text-2xl text-[#F37B1D]"></i>
          </div>

          <h2 class="text-2xl font-black text-gray-900">

            Login |
            <span class="text-[#F37B1D]">Entregadores</span>

          </h2>

        </div>

        <!-- ERRO ORIGINAL -->
        <?php if (isset($_GET['erro'])): ?>

          <div
            class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-6 font-semibold"
            role="alert">

            <span><?php echo htmlspecialchars($_GET['erro']); ?></span>

          </div>

        <?php endif ?>

        <!-- FORM ORIGINAL -->
        <form
          method="post"
          action="<?= BASE_URL ?>/routes.php?action=loginEntregador"
          class="space-y-6">

          <!-- EMAIL -->
          <div>

            <label
              for="exampleInputEmail1"
              class="block text-sm font-semibold text-gray-600 mb-2">

              Email

            </label>

            <input
              type="email"
              class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-2xl px-5 py-4 outline-none focus:ring-2 focus:ring-[#F37B1D] transition font-medium"
              id="exampleInputEmail1"
              aria-describedby="emailHelp"
              name="email"
              required>

          </div>

          <!-- SENHA -->
          <div>

            <label
              for="exampleInputPassword1"
              class="block text-sm font-semibold text-gray-600 mb-2">

              Senha

            </label>

            <input
              type="password"
              class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-2xl px-5 py-4 outline-none focus:ring-2 focus:ring-[#F37B1D] transition font-medium"
              id="exampleInputPassword1"
              name="senha"
              required>

          </div>

          <!-- BOTÃO -->
          <div class="pt-6">

            <input
              type="submit"
              name="entrar"
              class="w-full bg-[#FFB800] text-gray-900 py-4 rounded-2xl font-black text-xl hover:bg-[#F5B000] hover:scale-[1.02] hover:shadow-lg transition cursor-pointer"
              id="botao"
              value="Entrar">

          </div>

        </form>

      </div>

    </div>

  </main>

  <!-- RODAPÉ -->
  <footer class="w-full bg-[#F37B1D] px-6 py-4 mt-auto border-t border-white/20 shadow-inner z-50">
    <div class="w-full flex flex-col md:flex-row items-center justify-between text-[0.85rem] text-white/90">
      <p class="mb-2 md:mb-0">&copy; <?= date('Y') ?> GUIAR. Todos os direitos reservados.</p>
      <div class="flex space-x-4 font-medium">
        <a href="#" class="hover:text-[#FFD400] transition-colors">Política de Privacidade</a>
        <a href="<?= BASE_URL ?>/routes.php?action=termosUso" class="hover:text-[#FFD400] transition-colors">Termos de Serviço</a>
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