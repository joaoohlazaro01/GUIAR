

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
    <form method="post" action="">
        <label for="codigo_verificacao">Código de Verificação:</label>
        <input type="text" id="codigo_verificacao" name="codigo_verificacao" required>
        <button type="submit">Verificar</button>
    </form>
</body>
</html>

<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $codigo_inserido = $_POST['codigo_verificacao'] ?? '';

    if ($codigo_inserido == $_SESSION['codigo_verificacao']) {
        // Código correto, registrar a empresa no banco de dados
        require '../config.php';

        try {
            // Prepara a query para inserir os dados
            $sql = "INSERT INTO empresa (nome_empresa, cnpj, nome_usuario, email, senha, nome_arquivo) 
                    VALUES (:nome_empresa, :cnpj, :nome_usuario, :email, :senha, :nome_arquivo)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':nome_empresa', $_SESSION['nome_empresa']);
            $stmt->bindParam(':cnpj', $_SESSION['cnpj']);
            $stmt->bindParam(':nome_usuario', $_SESSION['nome_usuario']);
            $stmt->bindParam(':email', $_SESSION['email']);
            $stmt->bindParam(':senha', $_SESSION['senha']);
            $stmt->bindParam(':nome_arquivo', $_SESSION['nome_imagem']);

            // Executa a query
            if ($stmt->execute()) {
                // Sucesso no cadastro
                echo 'Cadastro realizado com sucesso!';
                session_unset(); // Limpar a sessão após o sucesso
                header("Location: ../ADM/loginEmpresa.php");
                exit();
            } else {
                echo 'Erro ao cadastrar a empresa.';
            }
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
        }
    } else {
        echo 'Código de verificação incorreto.';
    }
}
?>