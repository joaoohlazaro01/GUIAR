
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
            <?php if (isset($erro)): ?>
                <div class="alert alert-danger mt-3"><?php echo htmlspecialchars($erro); ?></div>
            <?php endif; ?>
            <?php if (isset($sucesso)): ?>
                <div class="alert alert-success mt-3"><?php echo htmlspecialchars($sucesso); ?></div>
            <?php endif; ?>
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