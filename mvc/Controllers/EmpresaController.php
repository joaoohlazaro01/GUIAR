<?php
namespace mvc\Controllers;

use mvc\Models\Empresa;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmpresaController {
    private $empresaModel;

    public function __construct($pdo) {
        $this->empresaModel = new Empresa($pdo);
    }

    public function login() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nome_usuario = $_POST['username'] ?? '';
            $senha = $_POST['password'] ?? '';

            $empresa = $this->empresaModel->login($nome_usuario, $senha);

            if ($empresa) {
                $_SESSION['company_id'] = $empresa['id_empresa'];
                header("Location: /GUIAR_desfunc/PHP ADM/escolherAdm.php"); // Path ajustado
                exit;
            } else {
                $erro = 'Nome de usuário ou senha incorretos';
                // Redireciona com erro (usaremos o roteador)
                header("Location: /GUIAR_desfunc/routes.php?action=loginEmpresa&erro=" . urlencode($erro));
                exit();
            }
        }

        // Se for GET, renderiza a View
        $erro = $_GET['erro'] ?? null;
        require_once __DIR__ . '/../Views/Empresa/login.php';
    }

    public function cadastro() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nome_empresa = $_POST['nome_empresa'] ?? '';
            $cnpj = $_POST['cnpj'] ?? '';
            $nome_usuario = $_POST['nome_usuario'] ?? '';
            $email = $_POST['email'] ?? '';
            $senha = $_POST['senha'] ?? '';

            // Lógica para o upload da imagem
            $diretorio = __DIR__ . '/../../public/uploads/empresas/';
            
            // Verifica se o diretório existe, se não existir, tenta criar
            if (!is_dir($diretorio)) {
                mkdir($diretorio, 0777, true);
            }

            $nome_imagem = '';
            // Lógica para verificar e mover a imagem
            if (isset($_FILES['foto_logo']) && $_FILES['foto_logo']['error'] == 0) {
                $nome_imagem = basename($_FILES['foto_logo']['name']);
                $caminho_imagem = $diretorio . $nome_imagem;
                move_uploaded_file($_FILES['foto_logo']['tmp_name'], $caminho_imagem);
            }

            // Gerar código de verificação (4 números)
            $codigo_verificacao = rand(1000, 9999);

            // Iniciar sessão para salvar temporariamente os dados do cadastro
            $_SESSION['nome_empresa'] = $nome_empresa;
            $_SESSION['cnpj'] = $cnpj;
            $_SESSION['nome_usuario'] = $nome_usuario;
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;
            $_SESSION['nome_imagem'] = $nome_imagem;
            $_SESSION['codigo_verificacao'] = $codigo_verificacao;

            // Enviar o código de verificação via email
            $mail = new PHPMailer(true);
            try {
                // Configurações do servidor de email
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'projGuiar@gmail.com';
                $mail->Password = 'jjuj ysee xhvs fnji';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // Configurações de envio
                $mail->setFrom('projGuiar@gmail.com', 'GUIAR');
                $mail->addAddress($email);

                // Conteúdo do email
                $mail->isHTML(true);
                $mail->Subject = 'Codigo de Verificacao';
                $mail->Body = "Seu codigo de verificacao eh: $codigo_verificacao";

                // Enviar email
                $mail->send();

                // Redirecionar para a página de verificação
                header('Location: /GUIAR_desfunc/PHP ADM/verificarCodigo.php');
                exit();

            } catch (Exception $e) {
                // Ao invés de um simples echo, envia como erro para a página de cadastro
                $erro = "Erro ao enviar email: {$mail->ErrorInfo}";
                header("Location: /GUIAR_desfunc/routes.php?action=cadastroEmpresa&erro=" . urlencode($erro));
                exit();
            }
        }

        // Se for GET, renderiza a View
        $erro = $_GET['erro'] ?? null;
        require_once __DIR__ . '/../Views/Empresa/cadastro.php';
    }
}
