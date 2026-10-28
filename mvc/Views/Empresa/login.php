<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | Empresa</title>
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
      background: #eef5ff !important;
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
      object-fit: contain;
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

    body > header nav a {
      position: relative;
    }

    body > header nav a::after {
      position: absolute;
      right: 0;
      bottom: -6px;
      left: 0;
      width: 0;
      height: 3px;
      background: #1b138f;
      content: '';
      transition: width 300ms ease;
    }

    body > header nav a:hover,
    body > header #nav-menu a:hover {
      color: #2b6dd6 !important;
    }

    body > header nav a:hover::after {
      width: 100%;
    }

    body > header nav a.text-brand-yellow,
    body > header #nav-menu a.text-brand-yellow {
      color: #111979 !important;
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

    body > .flex-grow {
      position: relative;
      isolation: isolate;
      min-height: calc(100vh - 164px);
      padding: 52px 24px !important;
      background: #eef5ff !important;
    }

    body > .flex-grow > div {
      width: 100% !important;
      max-width: 1240px !important;
      min-height: 510px !important;
      border-radius: 14px !important;
      box-shadow: 0 24px 60px rgb(31 91 166 / 16%) !important;
      animation: none !important;
      opacity: 1 !important;
    }

    body > .flex-grow > div > div:first-child {
      position: relative !important;
      width: 48% !important;
      padding: 52px !important;
      background:
        linear-gradient(135deg, transparent 0 73%, rgb(10 42 151 / 88%) 73% 84%, transparent 84%),
        linear-gradient(135deg, transparent 0 86%, #101c8b 86% 100%),
        #111979 !important;
    }

    body > .flex-grow > div > div:first-child > img {
      width: 150% !important;
      height: 150% !important;
      max-width: none;
      object-fit: contain;
      opacity: .16 !important;
      filter: brightness(0) invert(1) !important;
    }

    body > .flex-grow > div > div:first-child > div:first-of-type {
      display: none;
    }

    body > .flex-grow > div > div:first-child > div:last-child {
      position: relative;
      width: 100%;
    }

    body > .flex-grow > div > div:first-child > div:last-child > div:first-child {
      margin-bottom: 40px !important;
    }

    body > .flex-grow > div > div:first-child > div:last-child > div:first-child img {
      width: 230px !important;
      height: 58px !important;
      max-height: 58px;
      object-fit: cover;
      object-position: center;
    }

    body > .flex-grow > div > div:first-child h1 {
      color: #fff !important;
      font-size: 29px !important;
      line-height: 1.15 !important;
    }

    body > .flex-grow > div > div:first-child .h-1 {
      width: 62px !important;
      height: 4px !important;
      margin: 0 !important;
      background: #0878f9 !important;
    }

    body > .flex-grow > div > div:last-child {
      width: 52% !important;
      padding: 56px !important;
      background: #fff !important;
    }

    .login-form-heading {
      display: block !important;
      position: relative;
      width: 100%;
      max-width: 508px;
      margin: 0 0 34px !important;
      padding-top: 21px;
    }

    .login-form-heading > div:first-child {
      display: none !important;
    }

    .login-form-title {
      display: block !important;
      visibility: visible !important;
      position: static !important;
      margin: 0 !important;
      padding: 0 !important;
      color: #102b61 !important;
      font-size: 24px !important;
      letter-spacing: .025em;
      text-transform: uppercase;
      font-weight: 900 !important;
      line-height: 1.25 !important;
    }

    .login-form-heading::before {
      position: absolute;
      top: 0;
      left: 0;
      width: 46px;
      height: 5px;
      border-radius: 3px;
      background: #111979;
      content: '';
    }

    body > .flex-grow form label {
      color: #102b61 !important;
      font-size: 16px !important;
      font-weight: 500 !important;
    }

    body > .flex-grow form input:not([type='submit']) {
      display: block;
      width: 100%;
      height: 60px;
      min-height: 60px;
      box-sizing: border-box;
      border: 1px solid #c4d8ff !important;
      border-radius: 11px !important;
      background-color: #fff !important;
      color: #102b61 !important;
      padding-left: 50px !important;
      box-shadow: 0 1px 3px rgb(16 43 97 / 5%);
    }

    body > .flex-grow form input[name='username'] {
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%2358769f' stroke-width='1.8' stroke-linecap='round' stroke-linejoin='round'%3E%3Ccircle cx='12' cy='8' r='4'/%3E%3Cpath d='M5 21v-2a7 7 0 0 1 14 0v2'/%3E%3C/svg%3E") !important;
      background-repeat: no-repeat !important;
      background-position: 16px center !important;
      background-size: 22px !important;
    }

    body > .flex-grow form input[name='password'] {
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%2358769f' stroke-width='1.8' stroke-linecap='round' stroke-linejoin='round'%3E%3Crect x='4' y='10' width='16' height='11' rx='2'/%3E%3Cpath d='M8 10V7a4 4 0 0 1 8 0v3m-4 4v3'/%3E%3C/svg%3E") !important;
      background-repeat: no-repeat !important;
      background-position: 16px center !important;
      background-size: 22px !important;
      padding-right: 52px !important;
    }

    .password-field {
      position: relative;
    }

    .password-toggle {
      position: absolute;
      top: 50%;
      right: 12px;
      display: inline-flex;
      width: 36px;
      height: 36px;
      align-items: center;
      justify-content: center;
      padding: 0;
      transform: translateY(-50%);
      border: 0;
      border-radius: 8px;
      background: transparent;
      color: #58769f;
      cursor: pointer;
    }

    .password-toggle:hover {
      background: #eef5ff;
    }

    .password-toggle:focus-visible {
      outline: 2px solid #1b42da;
      outline-offset: 2px;
    }

    .password-toggle svg {
      width: 20px;
      height: 20px;
    }

    body > .flex-grow form input:not([type='submit']):focus {
      border-color: #1b42da !important;
      box-shadow: 0 0 0 3px rgb(27 66 218 / 12%) !important;
    }

    body > .flex-grow form button[type='submit'] {
      position: relative;
      width: 100%;
      height: 60px;
      min-height: 60px;
      box-sizing: border-box;
      border: 0 !important;
      border-radius: 11px !important;
      background: #19179a !important;
      color: #fff !important;
      font-size: 16px !important;
      box-shadow: none !important;
    }

    body > .flex-grow form button[type='submit']:hover {
      background: #111078 !important;
      transform: translateY(-1px) !important;
    }

    body > .flex-grow form button[type='submit']::after {
      display: inline-block;
      width: 20px;
      height: 20px;
      margin-left: 8px;
      vertical-align: middle;
      background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='white' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M5 12h14m-7-7 7 7-7 7'/%3E%3C/svg%3E") center / contain no-repeat;
      content: '';
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
        font-size: 20px !important;
      }

      body > .flex-grow {
        min-height: 0;
        padding: 32px 18px !important;
      }

      body > .flex-grow > div {
        max-width: 520px !important;
        min-height: 0 !important;
        border-radius: 12px !important;
      }

      body > .flex-grow > div > div:first-child,
      body > .flex-grow > div > div:last-child {
        width: 100% !important;
        padding: 30px !important;
      }

      body > .flex-grow > div > div:first-child {
        min-height: 340px;
      }

      body > .flex-grow > div > div:first-child > div:last-child > div:first-child img {
        width: 190px !important;
        height: 50px !important;
      }

      body > .flex-grow > div > div:first-child > div:last-child > div:first-child {
        margin-bottom: 24px !important;
      }

      body > .flex-grow > div > div:first-child h1 {
        font-size: 26px !important;
      }

      .login-form-heading {
        margin-bottom: 24px !important;
      }

      body > footer > div {
        gap: 8px;
        text-align: center;
      }
    }

    @media (max-width: 380px) {
      body > .flex-grow {
        padding: 20px 12px !important;
      }

      body > .flex-grow > div > div:first-child,
      body > .flex-grow > div > div:last-child {
        padding: 24px 20px !important;
      }

      body > footer > div > div {
        flex-wrap: wrap;
        justify-content: center;
      }
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

  <!-- HEADER -->
  <header class="bg-brand-blue shadow-md py-0 px-8 sticky top-0 z-50">

    <div class="max-w-7xl mx-auto flex items-center justify-between">

      <!-- LOGO -->
      <div class="flex items-center -my-6">
        <a href="<?= BASE_URL ?>/index.html">
          <img src="<?= BASE_URL ?>/img/LogoGAzul.png" alt="LOGO" class="h-10 md:h-14 w-auto object-contain">
        </a>
      </div>

      <!-- MENU DESKTOP -->
      <nav class="hidden md:flex items-center gap-12 font-semibold text-xl">
        <a href="<?= BASE_URL ?>/index.html" class="text-white/90 hover:text-brand-yellow transition duration-300">Home</a>
        <a href="<?= BASE_URL ?>/routes.php?action=loginEmpresa" class="text-white/90 hover:text-brand-yellow transition duration-300">Empresa</a>
        <a href="<?= BASE_URL ?>/routes.php?action=loginEntregador" class="text-white/90 hover:text-brand-yellow transition duration-300">Entregador</a>
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
      </div>
    </div>

  </header>

  <!-- Container centralizador do formulário -->
  <div class="flex-grow flex items-center justify-center p-4 sm:p-8">

    <!-- Card Principal com Bordas Arredondadas -->
    <div class="bg-white rounded-[2rem] shadow-2xl flex flex-col md:flex-row w-full max-w-[950px] min-h-[580px] overflow-hidden opacity-0 animate-fade-in-up">

      <!-- Painel Esquerdo (Azul) -->
      <div class="bg-brand-blue w-full md:w-[45%] p-10 flex flex-col relative overflow-hidden">
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
              Entre e deixe o Guiar<br>te mostrar a direção.
            </h1>
            <div class="h-1 w-20 bg-brand-yellow"></div>
          </div>
        </div>
      </div>
    
      <!-- Painel Direito (Formulário) -->
      <div class="w-full md:w-[55%] bg-white p-8 sm:p-14 flex flex-col justify-center items-center relative">

        <div class="login-form-content w-full max-w-[508px]">

          <!-- Cabeçalho: Ícone do Prédio e Título -->
          <div class="login-form-heading flex items-center justify-center gap-3 mb-10">
            <!-- Ícone de Empresa (Fundo circular azul claro) -->
            <div class="w-[4.5rem] h-[4.5rem] rounded-full bg-[#d6e0f5] flex items-center justify-center text-brand-blue shrink-0">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
              </svg>
            </div>
            <!-- Título -->
            <h2 class="login-form-title text-[1.8rem] font-bold text-gray-900 tracking-tight leading-none pt-2">Login Empresa</h2>
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
              <div class="password-field">
                <input id="companyPassword" type="password" name="password" required
                  class="w-full px-4 py-3 rounded-xl border border-brand-inputborder focus:outline-none focus:border-brand-blue focus:ring-2 focus:ring-blue-100 transition-all text-gray-800 shadow-[0_2px_10px_rgba(0,0,0,0.02)]"
                  placeholder="">
                <button id="toggleCompanyPassword" class="password-toggle" type="button" aria-label="Mostrar senha" aria-controls="companyPassword" aria-pressed="false">
                  <svg data-eye-hidden viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M3 3l18 18M10.6 10.6a2 2 0 0 0 2.8 2.8" />
                    <path d="M9.9 5.2A10.8 10.8 0 0 1 12 5c5 0 8.5 4.5 9.5 7-.4 1.1-1.2 2.2-2.2 3.2M6.2 6.2C3.8 7.7 2.6 10.2 2.5 12c.5 1.2 3.8 7 9.5 7 1 0 2-.2 2.9-.5" />
                  </svg>
                  <svg data-eye-visible hidden viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M2.5 12s3.5-7 9.5-7 9.5 7 9.5 7-3.5 7-9.5 7-9.5-7-9.5-7Z" />
                    <circle cx="12" cy="12" r="3" />
                  </svg>
                </button>
              </div>
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

    const companyPassword = document.getElementById('companyPassword');
    const toggleCompanyPassword = document.getElementById('toggleCompanyPassword');
    const hiddenEye = toggleCompanyPassword.querySelector('[data-eye-hidden]');
    const visibleEye = toggleCompanyPassword.querySelector('[data-eye-visible]');

    toggleCompanyPassword.addEventListener('click', () => {
      const showPassword = companyPassword.type === 'password';
      companyPassword.type = showPassword ? 'text' : 'password';
      toggleCompanyPassword.setAttribute('aria-label', showPassword ? 'Ocultar senha' : 'Mostrar senha');
      toggleCompanyPassword.setAttribute('aria-pressed', String(showPassword));
      hiddenEye.hidden = showPassword;
      visibleEye.hidden = !showPassword;
    });
  </script>
</body>

</html>