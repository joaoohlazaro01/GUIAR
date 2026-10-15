<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Administradores | GUIAR</title>
  <link rel="Shortcut Icon" type="image/png" href="<?= BASE_URL ?>/img/G.png">

  <!-- Scripts para os Modais funcionarem (jQuery e Bootstrap JS) -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="<?= BASE_URL ?>/style/sidebar.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    @font-face {
      font-family: 'Brice-Bold';
      src: url('<?= BASE_URL ?>/fonts/Brice-BoldSemiCondensed.ttf') format('truetype');
    }

    @font-face {
      font-family: 'BasisGrotesque-Regular';
      src: url('<?= BASE_URL ?>/fonts/BasisGrotesqueArabicPro-Regular.ttf') format('truetype');
    }

    @font-face {
      font-family: 'Brice-SemiBoldSemi';
      src: url('<?= BASE_URL ?>/fonts/Brice-SemiBoldSemiCondensed.ttf');
    }

    body {
      font-family: 'BasisGrotesque-Regular', 'Inter', sans-serif;
      background-color: #F8FAFC !important;
    }

    /* 
      Estilos essenciais do Bootstrap Modal isolados.
      Remover o "bootstrap.min.css" completo é a única forma de evitar que o Bootstrap 
      destrua os botões, inputs, cards e fontes do Tailwind. 
      Isolando apenas as classes do Modal, os modais funcionam perfeitamente e o 
      layout do Tailwind fica 100% fiel e limpo!
    */
    .modal {
      position: fixed;
      top: 0;
      left: 0;
      z-index: 1050;
      display: none;
      width: 100%;
      height: 100%;
      overflow: hidden;
      outline: 0;
    }

    .modal.fade .modal-dialog {
      transition: transform .3s ease-out;
      transform: translate(0, -50px);
    }

    .modal.show .modal-dialog {
      transform: none;
    }

    .modal-open {
      overflow: hidden;
    }

    .modal-open .modal {
      overflow-x: hidden;
      overflow-y: auto;
    }

    .modal-dialog {
      position: relative;
      width: auto;
      margin: .5rem;
      pointer-events: none;
    }

    .modal.show .modal-dialog {
      pointer-events: auto;
    }

    .modal-dialog-centered {
      display: flex;
      align-items: center;
      min-height: calc(100% - 1rem);
    }

    @media (min-width: 576px) {
      .modal-dialog {
        max-width: 500px;
        margin: 1.75rem auto;
      }

      .modal-dialog-centered {
        min-height: calc(100% - 3.5rem);
      }
    }

    .modal-content {
      position: relative;
      display: flex;
      flex-direction: column;
      width: 100%;
      pointer-events: auto;
      background-color: #fff;
      background-clip: padding-box;
      border: none;
      border-radius: 24px;
      outline: 0;
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
      overflow: hidden;
    }

    .modal-backdrop {
      position: fixed;
      top: 0;
      left: 0;
      z-index: 1040;
      width: 100vw;
      height: 100vh;
      background-color: #000;
    }

    .modal-backdrop.fade {
      opacity: 0;
    }

    .modal-backdrop.show {
      opacity: .5;
    }

    .modal-header {
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
      padding: 20px 24px;
      border-bottom: 1px solid #F1F5F9;
      border-top-left-radius: 24px;
      border-top-right-radius: 24px;
    }

    .modal-title {
      margin-bottom: 0;
      line-height: 1.5;
      font-weight: 800;
      color: #0F172A;
      font-size: 1.25rem;
    }

    .modal-header .close {
      padding: 1rem;
      margin: -1rem -1rem -1rem auto;
    }

    .close {
      float: right;
      font-size: 1.75rem;
      font-weight: 700;
      line-height: 1;
      color: #94A3B8;
      opacity: 1;
      border: 0;
      background: transparent;
      cursor: pointer;
      outline: none !important;
    }

    .close:hover {
      color: #64748B;
    }

    .modal-body {
      position: relative;
      flex: 1 1 auto;
      padding: 24px;
    }

    .modal-footer {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      justify-content: flex-end;
      padding: 16px 24px;
      border-top: 1px solid #F1F5F9;
      background-color: #F8FAFC;
    }

    .modal-footer>* {
      margin: .25rem;
    }

    /* Estilos extras para inputs dentro dos modais */
    .form-group label {
      font-weight: 600;
      color: #334155;
      font-size: 0.875rem;
      margin-bottom: 6px;
      display: block;
    }

    .modal-input {
      width: 100%;
      border-radius: 12px;
      border: 1px solid #CBD5E1;
      padding: 12px 16px;
      font-size: 0.95rem;
      transition: all 0.2s ease;
      outline: none;
    }

    .modal-input:focus {
      border-color: #4F46E5;
      box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
    }

    .admin-card.hidden-by-search {
      display: none !important;
    }

    .logo-circular {
      display: block;
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: center;
      background-color: #ffffff;
    }

    .logo-circular-wrap {
      overflow: hidden;
      border-radius: 9999px;
      background-color: #ffffff;
      flex-shrink: 0;
    }

    .brand-crop-stage {
      position: relative;
      width: 92%;
      max-width: 520px;
      aspect-ratio: 1 / 1;
      overflow: hidden;
      border-radius: 9999px;
      background: radial-gradient(circle at center, rgba(255,255,255,0.18), rgba(255,255,255,0.02) 55%, rgba(255,255,255,0) 70%);
      border: 10px solid rgba(255,255,255,0.15);
      box-shadow: inset 0 0 0 6px rgba(255,255,255,0.05);
      cursor: grab;
      user-select: none;
      touch-action: none;
    }

    .brand-crop-stage:active {
      cursor: grabbing;
    }

    .brand-crop-image {
      position: absolute;
      inset: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      transform: translate(0, 0) scale(1.08);
      transition: transform 0.08s ease-out;
      will-change: transform;
    }
  </style>
</head>

<body class="bg-[#F8FAFC] min-h-screen text-[#0F172A]">

  <!-- ======= TOPO / NAVBAR ======= -->
  <header class="bg-white border-b border-[#E2E8F0] px-8 py-6 sticky top-0 z-40">
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row md:items-center justify-between gap-4">

      <!-- TÍTULO -->
      <div>
        <h1 class="page-heading">
          Administradores
        </h1>
        <p class="page-subheading">Gerencie os administradores com acesso ao sistema.</p>
      </div>

      <!-- DIREITA: empresa + sino + logout -->
      <div class="flex items-center flex-wrap gap-4">

        <?php
        $logoEmpresaHeader = isset($empresa['nome_arquivo']) && !empty($empresa['nome_arquivo'])
            ? BASE_URL . '/public/uploads/empresas/' . htmlspecialchars($empresa['nome_arquivo'])
            : BASE_URL . '/img/logoIcon.png';
        ?>
        <div class="flex items-center gap-2 border border-[#E2E8F0] bg-white rounded-2xl px-4 py-2.5 shadow-sm text-sm">
          <div class="relative">
            <button type="button" id="empresaLogoTrigger" class="block focus:outline-none">
              <div class="logo-circular-wrap w-9 h-9 border border-slate-200 bg-white shadow-sm">
                <img
                  id="empresaLogoTop"
                  src="<?= htmlspecialchars($logoEmpresaHeader) ?>"
                  alt="Logo da empresa"
                  onerror="this.onerror=null; this.src='<?= BASE_URL ?>/img/logoIcon.png';"
                  class="logo-circular"
                >
              </div>
            </button>

            <div id="empresaMenu" class="hidden absolute right-0 top-full mt-2 w-44 bg-white border border-slate-200 rounded-2xl shadow-xl z-50 overflow-hidden">
              <button type="button" id="empresaImageOption" class="block w-full text-left px-4 py-3 text-sm font-medium text-slate-700 hover:bg-slate-50">
                Trocar imagem
              </button>
              <button type="button" id="empresaEditNameBtn" class="block w-full text-left px-4 py-3 text-sm font-medium text-slate-700 hover:bg-slate-50">
                Editar nome
              </button>
            </div>

            <div id="empresaImageCard" class="hidden fixed inset-0 z-[70] bg-black/50 backdrop-blur-[1px]">
              <div class="absolute inset-0" data-close="empresa-card"></div>
              <div class="relative mx-auto mt-12 max-w-5xl rounded-[26px] overflow-hidden border border-slate-700 bg-[#111b21] shadow-[0_20px_60px_rgba(0,0,0,0.45)]" style="width: min(92vw, 1100px);">
                <div class="flex items-center justify-between px-5 py-4 border-b border-slate-700 text-white">
                  <div class="flex items-center gap-3">
                    <button type="button" id="empresaImageCardClose" class="text-xl text-white/90 hover:text-white">←</button>
                    <h3 class="text-xl font-semibold">Editar perfil</h3>
                  </div>
                  <label for="empresaLogoInputCard" class="cursor-pointer inline-flex items-center gap-2 rounded-xl px-3 py-2 text-sm font-semibold bg-transparent text-white hover:bg-white/5 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3-3 3 3M12 16V5" />
                    </svg>
                    Carregar
                  </label>
                </div>

                <div class="grid md:grid-cols-[260px_1fr] gap-0 min-h-[540px]">
                  <aside class="bg-[#0b141a] px-6 py-8 border-r border-slate-700">
                    <div class="flex justify-center">
                      <div class="logo-circular-wrap w-32 h-32 border-2 border-slate-600 bg-slate-800 shadow-lg">
                        <img id="empresaLogoPreview" src="<?= htmlspecialchars($logoEmpresaHeader) ?>" onerror="this.onerror=null; this.src='<?= BASE_URL ?>/img/logoIcon.png';" class="logo-circular" alt="Pré-visualização da logo">
                      </div>
                    </div>

                    <div class="mt-8 text-white">
                      <div class="text-sm text-slate-400 mb-2">Nome</div>
                      <input id="empresaNomeInputCard" type="text" maxlength="120" value="<?= htmlspecialchars($nome_empresa, ENT_QUOTES, 'UTF-8') ?>" aria-label="Nome da empresa" class="w-full rounded-lg border border-slate-600 bg-[#15232c] px-3 py-2 text-base font-semibold text-white outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-500/20">
                    </div>
                  </aside>

                  <main class="bg-[#101a22] px-6 py-8 flex flex-col justify-center">
                    <div class="flex items-center justify-between mb-5 text-white">
                      <h4 class="text-2xl font-semibold">Arraste a imagem para ajustar</h4>
                    </div>

                    <div class="relative flex-1 flex items-center justify-center rounded-[28px] border border-slate-700 bg-[#1d2b33]/70 p-4 overflow-hidden">
                      <div id="empresaCropStage" class="brand-crop-stage">
                        <img id="empresaLogoPreviewCrop" src="<?= htmlspecialchars($logoEmpresaHeader) ?>" onerror="this.onerror=null; this.src='<?= BASE_URL ?>/img/logoIcon.png';" class="brand-crop-image" alt="Logo ajustada">
                      </div>
                    </div>

                    <div class="flex justify-end gap-3 mt-6">
                      <button type="button" id="empresaImageCardCancel" class="border border-slate-600 text-slate-200 font-semibold px-4 py-2.5 rounded-xl text-sm hover:bg-slate-800">
                        Cancelar
                      </button>
                      <button type="button" id="empresaImageCardSave" class="bg-[#4F46E5] text-white font-bold px-5 py-2.5 rounded-xl text-sm hover:bg-[#4338CA] shadow-md shadow-indigo-500/20">
                        Salvar
                      </button>
                    </div>
                  </main>
                </div>
              </div>
              <input id="empresaLogoInputCard" type="file" accept="image/*" class="hidden">
            </div>
          </div>
          <span class="text-[#475569] font-semibold">Empresa: <strong id="empresaNomeDisplay" class="text-[#1B138F] font-bold"><?php echo htmlspecialchars($nome_empresa); ?></strong></span>
        </div>


        <!-- Botão Logout -->
        <a href="<?= BASE_URL ?>/routes.php?action=logoutEmpresa"
          onclick="return confirm('Deseja sair da conta da empresa?');"
          class="border border-[#E2E8F0] text-[#475569] bg-white px-5 py-2.5 rounded-2xl text-sm font-bold shadow-sm hover:bg-[#F8FAFC] hover:text-[#0F172A] transition duration-200">
          Logout
        </a>

      </div>
    </div>
  </header>

  <!-- ======= CONTEÚDO PRINCIPAL ======= -->
  <main class="max-w-7xl mx-auto px-8 py-8">

    <!-- Alerta de erro -->
    <?php if ($erro): ?>
      <div class="mb-6 bg-red-50 border border-red-200 text-red-700 rounded-2xl px-6 py-4 font-semibold text-sm shadow-sm">
        <?php echo htmlspecialchars($erro); ?>
      </div>
    <?php endif; ?>

    <!-- ===== BARRA DE BUSCA + BOTÃO NOVO ===== -->
    <div class="bg-white rounded-3xl border border-[#F1F5F9] px-6 py-4 mb-8 flex flex-col sm:flex-row items-center justify-between gap-4 shadow-sm">

      <!-- Campo de Busca com Lupa -->
      <div class="flex items-center gap-3 border border-[#E2E8F0] rounded-2xl px-4 py-2.5 w-full sm:max-w-md bg-white focus-within:border-[#4F46E5] focus-within:ring-2 focus-within:ring-[#4F46E5]/10 transition duration-200">
        <span class="text-[#94A3B8] flex-shrink-0">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
          </svg>
        </span>
        <input
          type="text"
          id="searchInput"
          placeholder="Buscar administrador..."
          class="w-full bg-transparent border-none outline-none text-sm text-[#334155] placeholder-[#94A3B8]">
      </div>

      <!-- Botão Novo Administrador (Laranja/Amarelo com visual premium) -->
      <button
        data-toggle="modal"
        data-target="#addAdminModal"
        class="flex items-center gap-2 bg-[#FFD400] hover:bg-[#F2C900] text-[#0F172A] font-bold text-sm px-6 py-3 rounded-2xl transition duration-200 whitespace-nowrap shadow-sm hover:shadow">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
        </svg>
        Novo administrador
      </button>

    </div>

    <!-- ===== GRID DE CARDS DOS ADMINISTRADORES ===== -->
    <div id="adminGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php
      if (count($administradores) > 0) {
        foreach ($administradores as $row) {
          $imagem_path = BASE_URL . "/public/uploads/empresas/" . htmlspecialchars($nome_empresa) . "/" . htmlspecialchars($row["nome_foto"]);
          $nome_adm     = htmlspecialchars($row["nome_adm"]);
          $nome_usuario = htmlspecialchars($row["nome_usuario"]);
      ?>
          <div class="admin-card bg-white rounded-3xl border border-[#F1F5F9] shadow-sm p-6 flex flex-col justify-between hover:shadow-md transition-all duration-300 relative" data-name="<?= strtolower($nome_adm) ?> <?= strtolower($nome_usuario) ?>">

            <!-- Conteúdo superior -->
            <div class="flex items-start gap-4">

              <!-- Foto Circular (com fallback inteligente caso a imagem física não exista no servidor) -->
              <div class="flex-shrink-0">
                <img src="<?= $imagem_path ?>"
                  onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name=<?= urlencode($nome_adm) ?>&background=EEF2FF&color=4F46E5&bold=true&size=128'"
                  alt="Foto de <?= $nome_adm ?>"
                  class="w-[72px] h-[72px] rounded-full object-cover border border-[#E2E8F0] shadow-sm">
              </div>

              <!-- Informações textuais -->
              <div class="flex-grow min-w-0">
                <h3 class="font-extrabold text-[#0F172A] text-lg truncate leading-snug">
                  <?= $nome_adm ?>
                </h3>
                <p class="text-xs text-[#94A3B8] font-medium truncate mt-0.5">
                  <?= $nome_usuario ?>
                </p>

                <!-- Badge de Cargo -->
                <span class="inline-block bg-[#EEF2FF] text-[#4F46E5] text-[11px] font-semibold px-3 py-1 rounded-lg mt-3 border border-[#E0E7FF]/60">
                  Administrador
                </span>
              </div>

              <!-- Ícone de 3 pontos decorativo (Igual ao layout de exemplo) -->
              <button class="text-[#94A3B8] hover:text-[#64748B] transition p-1 -mt-1 flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                  <circle cx="12" cy="5" r="1.5" />
                  <circle cx="12" cy="12" r="1.5" />
                  <circle cx="12" cy="19" r="1.5" />
                </svg>
              </button>

            </div>

            <!-- Divisor elegante -->
            <div class="border-t border-[#F1F5F9] my-5"></div>

            <!-- Botão Entrar com estilo Outline roxo/azul premium -->
            <div class="flex justify-center">
              <button
                class="w-[150px] py-2 border-2 border-[#4F46E5] text-[#4F46E5] hover:bg-[#4F46E5] hover:text-white rounded-2xl font-bold text-sm transition-all duration-200 text-center flex justify-center items-center bg-transparent cursor-pointer"
                data-toggle="modal"
                data-target="#loginModal"
                data-username="<?= $nome_usuario ?>">
                Entrar
              </button>
            </div>

          </div>
      <?php
        }
      } else {
        echo "<div class='col-span-3 text-center py-20 text-[#94A3B8] text-base font-medium'>Nenhum administrador encontrado.</div>";
      }
      ?>
    </div>

    <!-- ===== RODAPÉ COM CONTAGEM TOTAL ===== -->
    <div class="flex items-center justify-center gap-2 mt-12 text-[#94A3B8] text-sm font-semibold">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-4a4 4 0 100-8 4 4 0 000 8zm6 4a2 2 0 100-4 2 2 0 000 4zM3 20v-2a2 2 0 012-2h1" />
      </svg>
      <span>Total: <strong><?php echo count($administradores); ?></strong> administradores</span>
    </div>

  </main>

  <!-- ======= MODAL DE LOGIN ======= -->
  <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="loginModalLabel">Login do Administrador</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= BASE_URL ?>/routes.php?action=loginAdm" method="post" id="adminLoginForm">
          <div class="modal-body">
            <div class="form-group">
              <label for="adminUsername">Nome de Usuário</label>
              <input type="text" class="modal-input bg-slate-100 cursor-not-allowed" id="adminUsername" name="adminUsername" readonly>
            </div>
            <div class="form-group mt-3">
              <label for="adminPassword">Senha</label>
              <input type="password" class="modal-input" id="adminPassword" name="adminPassword" required placeholder="Digite sua senha">
            </div>
          </div>
          <div class="modal-footer d-flex align-items-center justify-content-between">
            <p id="error-message" class="mr-auto mb-0 text-red-600 font-bold text-xs" style="display: none;"></p>
            <div class="flex items-center gap-2">
              <button type="button" class="border border-[#E2E8F0] hover:bg-[#F8FAFC] text-[#475569] font-bold px-5 py-2.5 rounded-2xl text-sm transition mr-2" data-dismiss="modal">Cancelar</button>
              <button type="submit"
                class="bg-[#4F46E5] hover:bg-[#4338CA] text-white font-bold px-6 py-2.5 rounded-2xl text-sm transition duration-200 shadow-sm border-0 cursor-pointer">
                Entrar
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- ======= MODAL ADICIONAR ADMINISTRADOR ======= -->
  <div class="modal fade" id="addAdminModal" tabindex="-1" aria-labelledby="addAdminModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addAdminModalLabel">Adicionar Administrador</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= BASE_URL ?>/routes.php?action=adicionarAdm" method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group">
              <label for="adminNome">Nome Completo</label>
              <input type="text" class="modal-input" id="adminNome" name="adminNome" required placeholder="Ex: João Silva">
            </div>
            <div class="form-group mt-3">
              <label for="adminUsernameNew">Nome de Usuário</label>
              <input type="text" class="modal-input" id="adminUsernameNew" name="adminUsername" required placeholder="Ex: joao.silva">
            </div>
            <div class="form-group mt-3">
              <label for="adminPasswordNew">Senha</label>
              <input type="password" class="modal-input" id="adminPasswordNew" name="adminPassword" required placeholder="Crie uma senha forte">
            </div>
            <div class="form-group mt-3">
              <label for="adminFoto">Foto do Administrador</label>
              <input type="file" class="modal-input border border-[#CBD5E1] p-2 w-full" id="adminFoto" name="adminFoto" accept="image/*" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="border border-[#E2E8F0] hover:bg-[#F8FAFC] text-[#475569] font-bold px-5 py-2.5 rounded-2xl text-sm transition mr-2" data-dismiss="modal">Cancelar</button>
            <button type="submit"
              class="bg-[#4F46E5] hover:bg-[#4338CA] text-white font-bold px-6 py-2.5 rounded-2xl text-sm transition duration-200 shadow-sm border-0 cursor-pointer">
              Salvar
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- ======= SCRIPTS DE COMPORTAMENTO ======= -->
  <script>
    const empresaLogoTrigger = document.getElementById('empresaLogoTrigger');
    const empresaMenu = document.getElementById('empresaMenu');
    const empresaLogoTop = document.getElementById('empresaLogoTop');
    const empresaEditNameBtn = document.getElementById('empresaEditNameBtn');
    const empresaImageOption = document.getElementById('empresaImageOption');
    const empresaImageCard = document.getElementById('empresaImageCard');
    const empresaImageCardClose = document.getElementById('empresaImageCardClose');
    const empresaImageCardCancel = document.getElementById('empresaImageCardCancel');
    const empresaImageCardSave = document.getElementById('empresaImageCardSave');
    const empresaLogoPreview = document.getElementById('empresaLogoPreview');
    const empresaLogoPreviewCrop = document.getElementById('empresaLogoPreviewCrop');
    const empresaLogoInputCard = document.getElementById('empresaLogoInputCard');
    const empresaNomeInputCard = document.getElementById('empresaNomeInputCard');
    const empresaCropStage = document.getElementById('empresaCropStage');

    let cropState = {
      active: false,
      x: 0,
      y: 0,
      startX: 0,
      startY: 0,
      originX: 0,
      originY: 0,
    };

    const applyCompanyLogo = (src) => {
      if (empresaLogoTop) empresaLogoTop.src = src;
      if (empresaLogoPreview) empresaLogoPreview.src = src;
      if (empresaLogoPreviewCrop) empresaLogoPreviewCrop.src = src;
      localStorage.setItem('guiar_empresa_logo_url', src);
    };

    const closeAllMenus = () => {
      if (empresaMenu) empresaMenu.classList.add('hidden');
      if (empresaImageCard) empresaImageCard.classList.add('hidden');
    };

    const setCropPosition = (x, y) => {
      if (!empresaLogoPreviewCrop) return;
      empresaLogoPreviewCrop.style.transform = `translate(${x}px, ${y}px) scale(1.08)`;
    };

    if (empresaCropStage && empresaLogoPreviewCrop) {
      empresaCropStage.addEventListener('pointerdown', (event) => {
        cropState.active = true;
        cropState.startX = event.clientX;
        cropState.startY = event.clientY;
        cropState.originX = cropState.x;
        cropState.originY = cropState.y;
        empresaLogoPreviewCrop.setPointerCapture?.(event.pointerId);
      });

      empresaCropStage.addEventListener('pointermove', (event) => {
        if (!cropState.active) return;

        const deltaX = event.clientX - cropState.startX;
        const deltaY = event.clientY - cropState.startY;
        cropState.x = cropState.originX + deltaX;
        cropState.y = cropState.originY + deltaY;
        setCropPosition(cropState.x, cropState.y);
      });

      const stopCropDrag = () => {
        cropState.active = false;
      };

      empresaCropStage.addEventListener('pointerup', stopCropDrag);
      empresaCropStage.addEventListener('pointerleave', stopCropDrag);
      empresaCropStage.addEventListener('pointercancel', stopCropDrag);
    }

    if (empresaLogoTrigger && empresaMenu) {
      empresaLogoTrigger.addEventListener('click', () => {
        empresaMenu.classList.toggle('hidden');
        if (empresaImageCard) empresaImageCard.classList.add('hidden');
      });

      document.addEventListener('click', (event) => {
        if (!empresaLogoTrigger.contains(event.target) && empresaMenu && !empresaMenu.contains(event.target) && empresaImageCard && !empresaImageCard.contains(event.target)) {
          closeAllMenus();
        }
      });
    }

    if (empresaImageOption) {
      empresaImageOption.addEventListener('click', () => {
        if (empresaMenu) empresaMenu.classList.add('hidden');
        if (empresaImageCard) {
          empresaImageCard.classList.remove('hidden');
          const nomeAtual = document.getElementById('empresaNomeDisplay');
          if (empresaNomeInputCard && nomeAtual) empresaNomeInputCard.value = nomeAtual.textContent.trim();
          if (empresaLogoTop && empresaLogoPreview) {
            empresaLogoPreview.src = empresaLogoTop.src;
          }
          if (empresaLogoPreviewCrop && empresaLogoTop) {
            empresaLogoPreviewCrop.src = empresaLogoTop.src;
          }
        }
      });
    }

    if (empresaEditNameBtn) {
      empresaEditNameBtn.addEventListener('click', () => {
        if (empresaMenu) empresaMenu.classList.add('hidden');
        if (empresaImageCard) empresaImageCard.classList.remove('hidden');
        const nomeAtual = document.getElementById('empresaNomeDisplay');
        if (empresaNomeInputCard && nomeAtual) empresaNomeInputCard.value = nomeAtual.textContent.trim();
        empresaNomeInputCard?.focus();
      });
    }

    if (empresaImageCardClose) {
      empresaImageCardClose.addEventListener('click', () => closeAllMenus());
    }

    if (empresaImageCardCancel) {
      empresaImageCardCancel.addEventListener('click', () => closeAllMenus());
    }

    if (empresaLogoInputCard) {
      empresaLogoInputCard.addEventListener('change', (event) => {
        const file = event.target.files && event.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = (e) => {
          const result = e.target.result;
          if (empresaLogoPreview) empresaLogoPreview.src = result;
          if (empresaLogoPreviewCrop) empresaLogoPreviewCrop.src = result;
          applyCompanyLogo(result);
        };
        reader.readAsDataURL(file);
      });
    }

    if (empresaImageCardSave) {
      empresaImageCardSave.addEventListener('click', () => {
        const empresaNomeDisplay = document.getElementById('empresaNomeDisplay');
        const novoNome = empresaNomeInputCard ? empresaNomeInputCard.value.trim() : '';
        if (novoNome && empresaNomeDisplay) {
          empresaNomeDisplay.textContent = novoNome;
          localStorage.setItem('guiar_empresa_nome', novoNome);
        }
        closeAllMenus();
      });
    }

    const localLogo = localStorage.getItem('guiar_empresa_logo_url');
    if (localLogo) {
      applyCompanyLogo(localLogo);
    }

    const localNome = localStorage.getItem('guiar_empresa_nome');
    if (localNome) {
      const empresaNomeDisplay = document.getElementById('empresaNomeDisplay');
      if (empresaNomeDisplay) empresaNomeDisplay.textContent = localNome;
      if (empresaNomeInputCard) empresaNomeInputCard.value = localNome;
    }

    // Preenche o campo de username ao abrir o modal de login
    $('#loginModal').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget);
      var username = button.data('username');
      var modal = $(this);
      modal.find('.modal-body #adminUsername').val(username);
    });

    // Envio do formulário via AJAX para não recarregar a página desnecessariamente
    $('#adminLoginForm').submit(function(event) {
      event.preventDefault();
      var form = $(this);
      $.ajax({
        type: form.attr('method'),
        url: form.attr('action'),
        data: form.serialize(),
        success: function(response) {
          response = response.trim();
          if (response === 'success') {
            window.location.href = '<?= BASE_URL ?>/routes.php?action=dashboardAdm';
          } else {
            $('#error-message').text('Senha incorreta. Tente novamente.').show();
            document.getElementById('adminPassword').value = '';
          }
        }
      });
    });

    // Barra de Busca Inteligente em Tempo Real
    document.getElementById('searchInput').addEventListener('input', function() {
      var query = this.value.toLowerCase().trim();
      var cards = document.querySelectorAll('#adminGrid .admin-card');
      cards.forEach(function(card) {
        var name = card.getAttribute('data-name') || '';
        if (query === '') {
          card.classList.remove('hidden-by-search');
        } else {
          card.classList.toggle('hidden-by-search', !name.includes(query));
        }
      });
    });
  </script>

  <?php
  $logoEmpresaUrl = '';
  if (!empty($empresa['nome_arquivo'])) {
      $logoEmpresaUrl = BASE_URL . '/public/uploads/empresas/' . htmlspecialchars($empresa['nome_arquivo']);
  }
  ?>
  <script>
    window.GUIAR_EMPRESA_LOGO = <?= json_encode($logoEmpresaUrl) ?>;
  </script>
  <script src="<?= BASE_URL ?>/public/js/empresa-palette.js"></script>
</body>

</html>