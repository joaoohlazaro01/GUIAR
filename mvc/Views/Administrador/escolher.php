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
  </style>
</head>

<body class="bg-[#F8FAFC] min-h-screen text-[#0F172A]">

  <!-- ======= TOPO / NAVBAR ======= -->
  <header class="bg-white border-b border-[#E2E8F0] px-8 py-6 sticky top-0 z-40">
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row md:items-center justify-between gap-4">

      <!-- TÍTULO -->
      <div>
        <h1 class="text-3xl font-extrabold text-[#0F172A] tracking-tight">
          Administradores
        </h1>
        <p class="text-sm text-[#64748B] mt-1 font-medium">Gerencie os administradores com acesso ao sistema.</p>
      </div>

      <!-- DIREITA: empresa + sino + logout -->
      <div class="flex items-center flex-wrap gap-4">

        <!-- Card Empresa -->
        <div class="flex items-center gap-2 border border-[#E2E8F0] bg-white rounded-2xl px-4 py-2.5 shadow-sm text-sm">
          <span class="text-[#94A3B8]">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0H5m14 0h2M5 21H3m4-10h2m4 0h2M7 7h2m4 0h2" />
            </svg>
          </span>
          <span class="text-[#475569] font-semibold">Empresa: <strong class="text-[#1B138F] font-bold"><?php echo htmlspecialchars($nome_empresa); ?></strong></span>
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

</body>

</html>