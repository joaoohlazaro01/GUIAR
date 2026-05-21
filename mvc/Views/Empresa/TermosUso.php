<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Termos de Uso | Empresa</title>
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
    /* Estilização suave para a barra de rolagem dos termos */
    .custom-scrollbar::-webkit-scrollbar {
      width: 6px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
      background: #f1f5f9;
      border-radius: 8px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
      background: #cbd5e1;
      border-radius: 8px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
      background: #94a3b8;
    }
  </style>
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

  <!-- Container centralizador do card -->
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
            <img src="<?= BASE_URL ?>/img/LogoBranca.png" alt="GUIAR" class="h-[6.5rem] sm:h-[8rem] w-auto object-contain"
              onerror="this.outerHTML='<span class=\'text-white text-[2.5rem] font-extrabold tracking-widest\'>GUIAR</span>'">
          </div>

          <!-- Slogan e Linha Amarela -->
          <div class="my-auto">
            <h1 class="text-white text-[2rem] leading-[1.2] font-bold mb-5 tracking-tight">
              Termos de Uso<br>E Privacidade.
            </h1>
            <div class="h-1 w-20 bg-brand-yellow"></div>
          </div>
        </div>
      </div>

      <!-- Painel Direito (Termos e Ação) -->
      <div class="w-full md:w-[55%] bg-white p-8 sm:p-12 flex flex-col justify-center items-center relative">

        <div class="w-full max-w-[400px]">

          <!-- Cabeçalho: Ícone do Escudo/Contrato e Título -->
          <div class="flex items-center justify-center gap-3 mb-6">
            <!-- Ícone de Contrato (Fundo circular azul claro) -->
            <div class="w-[4rem] h-[4rem] rounded-full bg-[#d6e0f5] flex items-center justify-center text-brand-blue shrink-0">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
              </svg>
            </div>
            <!-- Título -->
            <h2 class="text-[1.6rem] font-bold text-gray-900 tracking-tight leading-none pt-2">Termos <span class="text-brand-blue font-semibold">| de Uso</span></h2>
          </div>

          <!-- Caixa Rolável de Conteúdo dos Termos -->
          <div class="w-full h-64 overflow-y-auto border border-brand-inputborder rounded-2xl p-4 text-[0.8rem] text-gray-600 mb-6 bg-slate-50 leading-relaxed custom-scrollbar shadow-[inset_0_2px_4px_rgba(0,0,0,0.03)]">
            <h3 class="font-bold text-gray-800 mb-2 text-[0.85rem]">1. Aceitação dos Termos</h3>
            <p class="mb-4 text-justify">
              Ao utilizar a plataforma e os serviços de rastreamento e roteirização do <strong>GUIAR</strong>, você declara estar ciente e de acordo com todas as disposições estabelecidas neste documento. Caso não concorde com qualquer uma das condições, por favor, interrompa imediatamente a utilização do sistema.
            </p>

            <h3 class="font-bold text-gray-800 mb-2 text-[0.85rem]">2. Descrição dos Serviços</h3>
            <p class="mb-4 text-justify">
              O GUIAR oferece uma solução tecnológica para empresas e entregadores parceiros com o objetivo de facilitar a gestão de rotas, acompanhamento de entregas em tempo real e administração de pedidos.
            </p>

            <h3 class="font-bold text-gray-800 mb-2 text-[0.85rem]">3. Cadastro de Empresa e Segurança</h3>
            <p class="mb-4 text-justify">
              Para acessar os recursos exclusivos da plataforma, a empresa deverá realizar o cadastro fornecendo informações verdadeiras, atualizadas e completas (incluindo Razão Social, CNPJ e e-mail). A segurança das credenciais de acesso (nome de usuário e senha) é de responsabilidade única e exclusiva do usuário administrador da empresa cadastrada.
            </p>

            <h3 class="font-bold text-gray-800 mb-2 text-[0.85rem]">4. Privacidade e Proteção de Dados (LGPD)</h3>
            <p class="mb-4 text-justify">
              Nós do GUIAR levamos sua privacidade a sério. Coletamos e processamos dados de localização geográfica dos entregadores e informações dos pedidos cadastrados estritamente para o funcionamento de nossos serviços. Toda a coleta e processamento são regidos em estrita conformidade com a Lei Geral de Proteção de Dados Pessoais (LGPD - Lei nº 13.709/2018).
            </p>

            <h3 class="font-bold text-gray-800 mb-2 text-[0.85rem]">5. Responsabilidades do Usuário</h3>
            <p class="mb-4 text-justify">
              O usuário concorda em utilizar a plataforma de forma ética e de acordo com a finalidade para a qual foi projetada. É expressamente proibida a inserção de dados falsos, bem como qualquer tentativa de engenharia reversa, violação de segurança ou envio de dados maliciosos ao servidor do GUIAR.
            </p>

            <h3 class="font-bold text-gray-800 mb-2 text-[0.85rem]">6. Limitação de Responsabilidade</h3>
            <p class="mb-4 text-justify">
              O GUIAR se esforça para manter a plataforma sempre acessível e estável. Contudo, não nos responsabilizamos por quedas temporárias de sinal do servidor, lentidão gerada por provedores de internet externos ou imprecisões decorrentes de falhas de hardware nos dispositivos móveis dos entregadores.
            </p>

            <h3 class="font-bold text-gray-800 mb-2 text-[0.85rem]">7. Alterações e Rescisão</h3>
            <p class="text-justify">
              O GUIAR reserva-se o direito de atualizar ou modificar este termo a qualquer momento para refletir melhorias no sistema ou mudanças regulatórias. Notificações sobre alterações significativas serão enviadas por e-mail ou publicadas em destaque em nosso sistema.
            </p>
          </div>

          <!-- Botão Voltar ou Ações de Aceite -->
          <?php if (isset($_SESSION['aceite_termos_pendente']) && $_SESSION['aceite_termos_pendente'] === true): ?>
            <div class="flex flex-col sm:flex-row gap-3 w-full">
              <a href="<?= BASE_URL ?>/routes.php?action=recusarTermos"
                class="w-full sm:w-1/2 border border-gray-300 text-gray-700 font-bold text-base py-3 rounded-xl hover:bg-gray-50 hover:shadow-sm transform hover:-translate-y-[0.5px] transition-all flex items-center justify-center gap-2 text-center">
                Recusar
              </a>
              <a href="<?= BASE_URL ?>/routes.php?action=confirmarTermos"
                class="w-full sm:w-1/2 bg-brand-yellow text-gray-900 font-bold text-base py-3 rounded-xl hover:bg-[#eacc00] hover:shadow-md transform hover:-translate-y-[0.5px] transition-all flex items-center justify-center gap-2 text-center">
                Aceitar e Continuar
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
              </a>
            </div>
          <?php else: ?>
            <div class="flex flex-col gap-3">
              <button onclick="window.history.back()"
                class="w-full bg-brand-yellow text-gray-900 font-bold text-base py-3 rounded-xl hover:bg-[#eacc00] hover:shadow-md transform hover:-translate-y-[0.5px] transition-all flex items-center justify-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Voltar à página anterior
              </button>
            </div>
          <?php endif; ?>

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
        <a href="<?= BASE_URL ?>/routes.php?action=termosUso" class="hover:text-brand-yellow transition-colors underline decoration-brand-yellow underline-offset-4">Termos de Serviço</a>
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
