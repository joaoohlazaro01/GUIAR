<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <title>Perfis de Administradores</title>
  <link rel="Shortcut Icon" type="image/png" href="/GUIAR_desfunc/img/G.png">
  <style>
        @font-face {
            font-family: 'Brice-Bold';
            src: url('/GUIAR_desfunc/fonts/Brice-BoldSemiCondensed.ttf') format('truetype');
        }

        @font-face {
            font-family: 'BasisGrotesque-Regular';
            src: url('/GUIAR_desfunc/fonts/BasisGrotesqueArabicPro-Regular.ttf') format('truetype');
        }

        @font-face {
            font-family: 'Brice-SemiBoldSemi';
            src: url('/GUIAR_desfunc/fonts/Brice-SemiBoldSemiCondensed.ttf');
        }

        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body{
            background-color: #fefaf1 !important;
            font-family: 'BasisGrotesque-Regular';
        }

    .container {
      margin-top: 50px;
    }

    .container h1{
      font-family: 'Brice-Bold';
    }

    .container h1 spam {
      -webkit-text-stroke-width: 1px;
      -webkit-text-stroke-color: #131646;
      -webkit-text-fill-color: #ff9a52;
    }

    .card {
      margin: 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-shadow: 2px 2px 12px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }

    .card-body {
      padding: 20px;
    }

    .card-title {
      font-size: 1.5rem;
      margin-bottom: 15px;
      font-family: 'Brice-SemiBoldSemi';
    }

    .btn {
      background-color: #fc8835;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: 0.5s;
    }

    .btn:hover {
      color: white;
      background-color: #ff7b00;
      transform: scale(1.05);
      border-bottom-right-radius: 0px;
      border-top-left-radius: 0px;
    }

    .fixed-button {
      position: fixed;
      bottom: 20px;
      right: 20px;
      z-index: 1000;
    }

    /* Estilo para posicionar o botão no canto superior direito */
    .logout-btn {
      position: absolute;
      top: 20px;
      right: 20px;
      padding: 10px 20px;
      background-color: #fc8835;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 14px;
      transition: 0.5s;
    }

    .logout-btn:hover {
      color: white;
      background-color: #ff7b00;
      transform: scale(1.05);
      border-bottom-right-radius: 0px;
      border-top-left-radius: 0px;
    }
    #error-message {
        color: #d8000c;
        text-decoration: none;
        font-weight: bold;
    }
  </style>
</head>
<body>
  <!-- Botão de logout (da Empresa) -->
  <a href="/GUIAR_desfunc/routes.php?action=loginEmpresa" class="logout-btn" onclick="return confirm('Deseja sair da conta da empresa?');">Voltar ao Login (Sair)</a>

  <div class="container">
    <h1>Administradores da Empresa: <spam><?php echo htmlspecialchars($nome_empresa); ?></spam></h1>

    <?php if ($erro): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($erro); ?></div>
    <?php endif; ?>

    <div class="row">
      <?php
      if (count($administradores) > 0) {
        foreach ($administradores as $row) {
          // Caminho da imagem ajustado para a rota correta onde as imagens foram salvas
          $imagem_path = "/GUIAR_desfunc/PHP ADM/admin_fotos/" . htmlspecialchars($nome_empresa) . "/" . htmlspecialchars($row["nome_foto"]);
      ?>
          <div class="col-md-4">
            <div class="card">
              <img src="<?php echo $imagem_path; ?>" class="card-img-top" alt="Foto do Administrador" style="width: 100%; height: 300px; object-fit: cover;">
              <div class="card-body">
                <center>
                <h5 class="card-title"><?php echo htmlspecialchars($row["nome_adm"]); ?></h5>
                <button class="btn" data-toggle="modal" data-target="#loginModal" data-username="<?php echo htmlspecialchars($row["nome_usuario"]); ?>">Entrar</button>
                </center>
              </div>
            </div>
          </div>
      <?php
        }
      } else {
        echo "<div class='col-12'><p>Nenhum administrador encontrado.</p></div>";
      }
      ?>
    </div>
  </div>

  <!-- Modal de Login -->
  <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="loginModalLabel">Login do Administrador</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="/GUIAR_desfunc/routes.php?action=loginAdm" method="post" id="adminLoginForm">
          <div class="modal-body">
            <div class="form-group">
              <label for="adminUsername">Nome de Usuário</label>
              <input type="text" class="form-control" id="adminUsername" name="adminUsername" readonly>
            </div>
            <div class="form-group">
              <label for="adminPassword">Senha</label>
              <input type="password" class="form-control" id="adminPassword" name="adminPassword" required>
            </div>
          </div>
          <div class="modal-footer">
            <p id="error-message" class="text-danger" style="display: none;"></p>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Entrar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    $('#loginModal').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget);
      var username = button.data('username');
      var modal = $(this);
      modal.find('.modal-body #adminUsername').val(username);
    });

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
            window.location.href = '/GUIAR_desfunc/routes.php?action=dashboardAdm';
          } else {
            $('#error-message').text('Senha incorreta. Tente novamente.').show();
            var senha = document.getElementById('adminPassword');
            senha.value = "";
          }
        }
      });
    });
  </script>

  <!-- Botão fixo "Adicionar Administrador" -->
  <button class="btn fixed-button" data-toggle="modal" data-target="#addAdminModal"><spam> + </spam> Adicionar Administrador</button>

  <!-- Modal de Adicionar Administrador -->
  <div class="modal fade" id="addAdminModal" tabindex="-1" aria-labelledby="addAdminModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addAdminModalLabel">Adicionar Administrador</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="/GUIAR_desfunc/routes.php?action=adicionarAdm" method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group">
              <label for="adminNome">Nome Completo</label>
              <input type="text" class="form-control" id="adminNome" name="adminNome" required>
            </div>
            <div class="form-group">
              <label for="adminUsername">Nome de Usuário</label>
              <input type="text" class="form-control" id="adminUsername" name="adminUsername" required>
            </div>
            <div class="form-group">
              <label for="adminPassword">Senha</label>
              <input type="password" class="form-control" id="adminPassword" name="adminPassword" required>
            </div>
            <div class="form-group">
              <label for="adminFoto">Foto do Administrador</label>
              <input type="file" class="form-control-file" id="adminFoto" name="adminFoto" accept="image/*" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Salvar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
