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

 <link rel="Shortcut Icon" type="image/png" href="<?= BASE_URL ?>/img/quero deixr essa " class=" w-50 h-60 object-contain">


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
              yellow: '#111979',
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
      background-color: #eef5ff !important;
      background-image: none !important;
      color: #102b61;
      font-family: 'Inter', sans-serif !important;
    }

    body > header {
      min-height: 80px;
      background: #fff !important;
      box-shadow: 0 4px 6px -1px rgb(0 0 0 / 10%), 0 2px 4px -2px rgb(0 0 0 / 10%) !important;
    }

    body > header > div:first-child {
      min-height: 80px;
    }

    body > header > div:first-child > div {
      margin-top: 0 !important;
      margin-bottom: 0 !important;
    }

    body > header img {
      width: auto !important;
      height: 56px !important;
      max-height: none;
      filter: none !important;
    }

    body > header nav {
      gap: 48px !important;
      font-size: 24px !important;
      font-weight: 600 !important;
      font-family: ui-sans-serif, system-ui, sans-serif !important;
    }

    body > header nav a,
    body > header #nav-menu a {
      color: #1b138f !important;
      text-decoration: none !important;
      transition: color 300ms ease;
    }

    body > header nav a:hover,
    body > header #nav-menu a:hover {
      color: #2b6dd6 !important;
    }

    body > header #nav-toggle {
      color: #fff !important;
      background: #1b138f !important;
    }

    body > header #nav-menu {
      padding-bottom: 16px;
    }

    body > header #nav-menu > div {
      gap: 16px;
      margin-top: 16px;
      font-size: 18px;
      font-weight: 600;
    }

    body > main {
      position: relative;
      isolation: isolate;
      min-height: calc(100vh - 164px);
      padding: 52px 24px !important;
      background-color: #eef5ff !important;
      background-image: none !important;
    }

    body > main > div {
      position: relative;
      width: 100% !important;
      max-width: 1240px !important;
      min-height: 496px !important;
      margin: 0 !important;
      border-radius: 14px !important;
      box-shadow: 0 24px 60px rgb(31 91 166 / 16%) !important;
    }

    body > main > div > div:first-child {
      position: relative !important;
      width: 48% !important;
      padding: 52px !important;
      background:
        linear-gradient(135deg, transparent 0 73%, rgb(10 42 151 / 88%) 73% 84%, transparent 84%),
        linear-gradient(135deg, transparent 0 86%, #101c8b 86% 100%),
        #111979 !important;
    }

    body > main > div > div:first-child > div:first-child {
      display: block !important;
      opacity: 0.16 !important;
      filter: brightness(0) invert(1) !important;
      background-position: right bottom !important;
      background-size: 85% auto !important;
      pointer-events: none;
    }

    body > main > div > div:first-child > div:last-child {
      position: static !important;
      width: 100%;
    }

    body > main > div > div:first-child img:not(.route-illustration) {
      width: 230px !important;
      height: 58px !important;
      max-height: 58px;
      object-fit: cover;
      object-position: center;
    }

    body > main > div > div:first-child > div:last-child > div:first-child {
      margin-bottom: 40px !important;
    }

    body > main > div > div:first-child .route-illustration {
      display: block;
      width: 100%;
      max-height: 142px;
      object-fit: contain;
      object-position: right bottom;
      filter: brightness(1.55) saturate(1.35);
    }

    body > main > div > div:first-child h2 {
      margin: 12px 0 10px !important;
      font-size: 29px !important;
      line-height: 1.15 !important;
      color: #fff !important;
    }

    body > main > div > div:first-child h2 span {
      display: block;
      color: #0878f9 !important;
      font-size: 34px;
    }

    body > main > div > div:first-child .panel-description {
      max-width: 320px;
      margin: 0 0 19px;
      color: #dce8ff;
      font-size: 14px;
      line-height: 1.45;
    }

    body > main > div > div:first-child .w-16 {
      width: 62px !important;
      height: 4px !important;
      margin: 0 !important;
      background-color: #111979 !important;
    }

    body > main > div > div:first-child > div:last-child > div:last-child {
      position: absolute;
      right: 18px;
      bottom: 8px;
      width: 58%;
      margin: 0 !important;
    }

    body > main > div > div:last-child {
      width: 50% !important;
      padding: 56px !important;
      background-color: #fff !important;
    }

    body > main > div > div:last-child > div:first-child {
      display: block !important;
      margin-bottom: 34px !important;
    }

    body > main > div > div:last-child > div:first-child > div {
      display: none !important;
    }

    body > main > div > div:last-child > div:first-child h2 {
      position: relative;
      margin-top: 16px;
      font-size: 24px !important;
      letter-spacing: 0.025em;
      text-transform: uppercase;
      color: #102b61 !important;
    }

    body > main > div > div:last-child > div:first-child h2 span {
      color: #102b61 !important;
    }

    body > main > div > div:last-child > div:first-child::before {
      display: block;
      width: 46px;
      height: 5px;
      border-radius: 3px;
      background: #111979;
      content: '';
    }

    body > main form label {
      color: #102b61 !important;
      font-size: 16px !important;
      font-weight: 500 !important;
    }

    body > main form input:not([type='submit']) {
      min-height: 60px;
      border: 1px solid #c4d8ff !important;
      border-radius: 11px !important;
      background-color: #fff !important;
      color: #102b61 !important;
      padding-left: 56px !important;
      box-shadow: 0 1px 3px rgb(16 43 97 / 5%);
    }

    body > main form input[type='email'] {
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%2358769f' stroke-width='1.8' stroke-linecap='round' stroke-linejoin='round'%3E%3Crect x='3' y='5' width='18' height='14' rx='2'/%3E%3Cpath d='m3 7 9 6 9-6'/%3E%3C/svg%3E") !important;
      background-repeat: no-repeat !important;
      background-position: 20px center !important;
      background-size: 22px !important;
    }

    body > main form input[type='password'] {
      background-image:
        url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%2358769f' stroke-width='1.8' stroke-linecap='round' stroke-linejoin='round'%3E%3Crect x='4' y='10' width='16' height='11' rx='2'/%3E%3Cpath d='M8 10V7a4 4 0 0 1 8 0v3m-4 4v3'/%3E%3C/svg%3E"),
        url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%2358769f' stroke-width='1.8' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M3 3l18 18M10.6 10.6a2 2 0 0 0 2.8 2.8'/%3E%3Cpath d='M9.9 5.2A10.8 10.8 0 0 1 12 5c5 0 8.5 4.5 9.5 7-.4 1.1-1.2 2.2-2.2 3.2M6.2 6.2C3.8 7.7 2.6 10.2 2.5 12c.5 1.2 3.8 7 9.5 7 1 0 2-.2 2.9-.5'/%3E%3C/svg%3E");
      background-repeat: no-repeat, no-repeat !important;
      background-position: 20px center, right 18px center !important;
      background-size: 22px, 20px !important;
      padding-right: 52px !important;
    }

    body > main form input:not([type='submit']):focus {
      border-color: #1b42da !important;
      box-shadow: 0 0 0 3px rgb(27 66 218 / 12%) !important;
    }

    body > main form input[type='submit'] {
      min-height: 60px;
      border: 1px solid #c4d8ff !important;
      border-radius: 11px !important;
      background-color: #19179a !important;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='white' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M5 12h14m-7-7 7 7-7 7'/%3E%3C/svg%3E") !important;
      background-repeat: no-repeat !important;
      background-position: calc(50% + 42px) center !important;
      background-size: 20px !important;
      color: #fff !important;
      font-size: 16px !important;
      box-shadow: none !important;
    }

    body > main form input[type='submit']:hover {
      background-color: #111078 !important;
      transform: translateY(-1px) !important;
    }

    body > footer {
      border-color: #e1ebf8 !important;
      background: #fff !important;
      color: #58769f !important;
      box-shadow: 0 -2px 12px rgb(16 43 97 / 4%) !important;
    }

    body > footer a {
      color: #31567f !important;
    }

    body > footer a:hover {
      color: #0878f9 !important;
    }

    @media (max-width: 767px) {
      body > header,
      body > header > div:first-child {
        min-height: 80px;
      }

      body > header img {
        height: 40px !important;
      }

      body > header nav {
        font-size: 24px !important;
      }

      body > main {
        min-height: 0;
        padding: 32px 18px !important;
      }

      body > main > div {
        max-width: 520px !important;
        min-height: 0 !important;
        border-radius: 12px !important;
      }

      body > main > div > div:first-child,
      body > main > div > div:last-child {
        width: 100% !important;
        padding: 30px !important;
      }

      body > main > div > div:first-child {
        min-height: 420px;
      }

      body > main > div > div:first-child img:not(.route-illustration) {
        width: 190px !important;
        height: 50px !important;
      }

      body > main > div > div:first-child > div:last-child > div:first-child {
        margin-bottom: 20px !important;
      }

      body > main > div > div:first-child h2 {
        font-size: 26px !important;
      }

      body > main > div > div:first-child h2 span {
        font-size: 30px;
      }

      body > main > div > div:first-child .panel-description {
        max-width: 250px;
        margin-bottom: 12px;
        font-size: 13px;
      }

      body > main > div > div:first-child .route-illustration {
        width: 100% !important;
        max-height: 90px;
      }

      body > main > div > div:first-child > div:last-child > div:last-child {
        width: 52%;
        right: 10px;
        bottom: 6px;
      }

      body > main > div > div:last-child > div:first-child {
        gap: 14px !important;
        margin-bottom: 24px !important;
      }

      body > main > div > div:last-child > div:first-child > div {
        width: 54px !important;
        height: 54px !important;
      }

      body > main > div > div:last-child > div:first-child h2 {
        font-size: 24px !important;
      }

      body > footer > div {
        gap: 8px;
        text-align: center;
      }
    }
  </style>

</head>

<body class="bg-[#FFF1E5] overflow-x-hidden text-gray-900 flex flex-col min-h-screen">

  <!-- HEADER -->
    <header class="bg-white shadow-md py-0 px-4 md:px-4 sticky top-0 z-50">

        <div class="max-w-7xl mx-auto flex min-h-20 items-center justify-between">

            <!-- LOGO -->
            <div class="flex items-center">

                <img src="img/LogoGAzul.png" alt="Logo GUIAR" class="h-10 md:h-14 w-auto object-contain">

            </div>

            <!-- MENU DESKTOP -->
            <nav class="hidden md:flex items-center gap-12 font-semibold text-2xl">

                <a href="index.html" class="relative text-[#1B138F] hover:text-[#2b6dd6] transition duration-300
                    after:content-[''] after:absolute after:left-0 after:-bottom-1
                    after:w-0 after:h-[3px] after:bg-[#1B138F]
                    after:transition-all after:duration-300
                    hover:after:w-full">

                    Home

                </a>

                <a href="routes.php?action=loginEmpresa" class="relative text-[#1B138F] hover:text-[#2b6dd6] transition duration-300
                    after:content-[''] after:absolute after:left-0 after:-bottom-1
                    after:w-0 after:h-[3px] after:bg-[#1B138F]
                    after:transition-all after:duration-300
                    hover:after:w-full">

                    Empresa

                </a>

                <a href="routes.php?action=loginEntregador" class="relative text-[#1B138F] hover:text-[#2b6dd6] transition duration-300
                    after:content-[''] after:absolute after:left-0 after:-bottom-1
                    after:w-0 after:h-[3px] after:bg-[#1B138F]
                    after:transition-all after:duration-300
                    hover:after:w-full">

                    Entregador

                </a>

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

            Bem-vindo ao<br>
            <span>GUIAR</span>

          </h2>

          <p class="panel-description">
            Conectamos sua operação com mais eficiência, controle e agilidade.
          </p>

          <div class="w-16 h-[3px] bg-[#FFD400] mt-2 mb-8"></div>

          <div class="mt-auto">
            <img
              src="<?= BASE_URL ?>/img/Rota de Entrega com Camião e Pins.png"
              alt="Rota de entrega com caminhão e pontos no mapa"
              class="route-illustration">
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
        <a href="#" class="hover:text-[#111979] transition-colors">Política de Privacidade</a>
        <a href="<?= BASE_URL ?>/routes.php?action=termosUso" class="hover:text-[#111979] transition-colors">Termos de Serviço</a>
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