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
    <?php if (isset($erro)): ?>
        <div class="alert alert-danger mt-3"><?php echo htmlspecialchars($erro); ?></div>
    <?php endif; ?>
    <?php if (isset($sucesso)): ?>
        <div class="alert alert-success mt-3"><?php echo htmlspecialchars($sucesso); ?></div>
        <a href="/GUIAR_desfunc/routes.php?action=loginEmpresa" class="btn btn-secondary w-50 mx-auto mt-3" style="background-color: #ff9a52; display: block; text-align: center;">Voltar ao Login</a>
    <?php endif; ?>

    <form method="POST">
    <div class="mb-3">
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token'] ?? $_POST['token'] ?? ''); ?>">
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