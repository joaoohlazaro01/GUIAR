<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificação de Código</title>
    <link
        rel="Shortcut Icon"
        type="image/png"
        href="../img/G.png">
    <link href="../style/verificarCodigo.css" rel="stylesheet">

</head>

<body>
    <h2>Insira o código de verificação</h2>
    <?php if (isset($erro) && !empty($erro)): ?>
        <div style="color: red; text-align: center; margin-bottom: 15px;">
            <?php echo htmlspecialchars($erro); ?>
        </div>
    <?php endif; ?>
    <form method="post" action="">
        <label for="codigo_verificacao">Código de Verificação:</label>
        <input type="text" id="codigo_verificacao" name="codigo_verificacao" required>
        <button type="submit">Verificar</button>
    </form>
</body>

</html>