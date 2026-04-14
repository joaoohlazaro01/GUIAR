


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir senha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
      <link href="../../style/redefinirSenha.css" rel="stylesheet">
   
</head>
<body>
<div class="form-container">
<h1>Recuperar Senha</h1>

    <form method="POST">
    <div class="mb-3">
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token']); ?>">
        <label for="password">Nova senha:</label>
        <input type="password" name="password" required> <br>
    </div>
    <button type="submit" class="btn btn-primary w-100">Redefinir</button>
    </form>
</div>

<footer>
    &copy; <?php echo date('Y'); ?> GUIAR. Todos os direitos reservados.
</footer>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include '../../config.php'; // Certifique-se de que o caminho para a conexão está correto

    $token = $_POST['token'];
    $newPassword = $_POST['password'];

    // Verificar se o token é válido
    $stmt = $pdo->prepare("SELECT user_id FROM password_resets WHERE token = :token AND expiry > NOW()");
    $stmt->bindParam(':token', $token);
    $stmt->execute();

    if ($stmt->rowCount() === 0) {
        echo "Token inválido ou expirado.";
        exit;
    }

    $userId = $stmt->fetchColumn();

    // Atualizar a senha no banco de dados
    $stmt = $pdo->prepare("UPDATE empresa SET senha = :senha WHERE id_empresa = :id");
    $stmt->bindParam(':senha', $newPassword);
    $stmt->bindParam(':id', $userId);
    $stmt->execute();

    // Remover o token usado
    $stmt = $pdo->prepare("DELETE FROM password_resets WHERE token = :token");
    $stmt->bindParam(':token', $token);
    $stmt->execute();

    echo '<div class="alert alert-success"> Senha redefinida com sucesso. </div>';
    echo '<a href="../loginEmpresa.php" class="btn btn-secondary w-50 mx-auto mt-3" style="background-color: #ff9a52; display: block;">Voltar ao Login</a>';
}
?>

