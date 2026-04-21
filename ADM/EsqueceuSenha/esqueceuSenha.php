



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esqueceu sua senha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
     <link href="../../style/esqueceuSenha.css" rel="stylesheet">
   
</head>
<body>
<div class="container-fluid">
<div class="row align-items-center">
    <center>
    <div class="form-container">
        <h1>Recuperar Senha</h1>
            <form method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">Digite o e-mail cadastrado</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Digite seu e-mail" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Enviar</button>
            </form>
    </div>
    </center>
</div>
</div>

    <footer>
        &copy; <?php echo date('Y'); ?> GUIAR. Todos os direitos reservados.
    </footer>
</body>
</html>

<?php
require '../../vendor/autoload.php'; // Ajuste o caminho para a instalação do PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<div class="alert alert-danger">E-mail inválido!</div>';
        exit;
    }

    // Conexão com o banco de dados
    include '../../config.php'; // Certifique-se de que o caminho para a conexão está correto

    $stmt = $pdo->prepare("SELECT id_empresa FROM empresa WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() === 0) {
        echo '<div class="alert alert-warning">E-mail não encontrado!</div>';
        exit;
    }

    $userId = $stmt->fetchColumn();
    $token = bin2hex(random_bytes(32));
    $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));

    // Inserir o token no banco de dados  comita por favor
    $stmt = $pdo->prepare("INSERT INTO password_resets (user_id, token, expiry) VALUES (:user_id, :token, :expiry)");
    $stmt->bindParam(':user_id', $userId);
    $stmt->bindParam(':token', $token);
    $stmt->bindParam(':expiry', $expiry);
    $stmt->execute();

    // Configurar o PHPMailer
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Use o servidor SMTP do Gmail ou de outro provedor
        $mail->SMTPAuth = true;
        $mail->Username = 'projGuiar@gmail.com'; // Substitua pelo seu e-mail
        $mail->Password = 'edts pdst pvfj ffkv'; // Substitua pela sua senha ou App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Configuração do e-mail
        $mail->setFrom('projGuiar@gmail.com', 'GUIAR');
        $mail->addAddress($email);

        $resetLink = "http://localhost/GUIAR/GUIAR/ADM/EsqueceuSenha/redefinirSenha.php?token=$token";
        $mail->isHTML(true);
        $mail->Subject = 'Redefinicao de Senha';
        $mail->Body = "Clique no link para redefinir sua senha: <a href='$resetLink'>$resetLink</a>";

        $mail->send();
        echo '<div class="alert alert-success">Um e-mail foi enviado para ' . htmlspecialchars($email) . ' com as instruções.</div>';
    } catch (Exception $e) {
        echo '<div class="alert alert-danger">Falha ao enviar o e-mail: ' . htmlspecialchars($mail->ErrorInfo) . '</div>';
    }
}
?>
