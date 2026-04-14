
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contato | GUIAR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <link rel="stylesheet" href="style/contato.css">
    <link rel="Shortcut Icon" type="image/png" href="img/G.png">
    <link rel="stylesheet" href="CssnavbarRodape.css">

</head>
<body>
    <!--CABEÇALHO-->
    <nav class="navbar navbar-expand-lg custom-navbar" id="gblur">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.html"><img style="height: 90px;" src="img/Guiar.png" alt="LOGO"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="ADM/loginEmpresa.php">Empresa</a></li>
                    <li class="nav-item"><a class="nav-link" href="ENTREGADOR/loginEntregador.php">Entregador</a></li>
                    <li class="nav-item"><a class="nav-link active" href="contato.php">Contato</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- FORMS PARA ENVIAR CONTATO -->
    <div class="contact-container container">
        <div class="row align-items-center">
            <!-- Formulário de Contato -->
            <div class="col-md-6 contact-form">
                <h2>Entre em Contato</h2>
                <form action="contato.php" method="POST">

                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Mensagem</label>
                        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                    </div>

                    <!-- Container para o botão e ícones -->
                    <div class='submit-container'>
                        <!-- Ícones de Redes Sociais -->
                        <div class='social-icons'>
                            <a href="https://web.whatsapp.com"><i class='fa fa-whatsapp' style="font-size:30px;color:#000"></i></a>
                            <a href="https://www.instagram.com/guiartcc?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="><i class='fa fa-instagram' style="font-size:30px;color:#000"></i></a>
                            <a href="https://www.facebook.com/?locale=pt_BR"><i class='fa fa-facebook' style="font-size:30px;color:#000"></i></a>
                        </div>

                        <!-- Botão de Enviar -->
                        <button type='submit' id='botao' class='btn btn-primary'>Enviar</button>
                    </div>

                </form>
            </div>

            <!-- Imagem ao lado do formulário -->
            <div class='col-md-6'>
                <img src="img/Questions-bro.png" alt="" style='max-width: 100%; height: auto;'>
            </div>
        </div>
    </div>

    <!-- RODAPÉ -->
    <footer class='footer text-center'>
        <div class='container p-3'>
            <p>&copy; 2024 GUIAR. Todos os direitos reservados.</p>
            <ul class='list-unstyled'>
                <li><a href='#' class='text-black'>Política de Privacidade</a></li>
                <li><a href='#' class='text-black'>Termos de Serviço</a></li>
            </ul>
        </div>
    </footer>

    <!-- Scripts do Bootstrap -->
    <script src='https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js'></script>

</body>
</html>

<?php 
session_start(); 
require 'config.php';

// ===== SALVAR DADOS =====
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $mensagem = $_POST['message'] ?? '';

    if (!empty($nome) && !empty($email) && !empty($mensagem)) {

        try {
            $stmt = $pdo->prepare("INSERT INTO contato (nome, email, mensagem) VALUES (:nome, :email, :mensagem)");

            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':mensagem', $mensagem);

            $stmt->execute();

            echo "<script>alert('Mensagem enviada com sucesso!');</script>";

        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }

    } else {
        echo "<script>alert('Preencha todos os campos!');</script>";
    }
}
?>