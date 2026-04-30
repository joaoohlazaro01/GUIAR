<?php
namespace mvc\Controllers;

use mvc\Models\Empresa;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmpresaController {
    private $empresaModel;
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->empresaModel = new Empresa($pdo);
    }

    public function login() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nome_usuario = $_POST['username'] ?? '';
            $senha = $_POST['password'] ?? '';

            $empresa = $this->empresaModel->login($nome_usuario, $senha);

            if ($empresa) {
                $_SESSION['company_id'] = $empresa['id_empresa'];
                header("Location: /GUIAR_desfunc/routes.php?action=escolherAdm");
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
                $mail->Subject = 'GUIAR - Verificacao de E-mail para Cadastro';
                $mail->Body = "
                    <div style='font-family: Arial, sans-serif; color: #333; line-height: 1.6; max-width: 600px; margin: 0 auto; border: 1px solid #ddd; padding: 20px; border-radius: 8px;'>
                        <h2 style='color: #ff9a52; text-align: center; margin-bottom: 20px;'>GUIAR</h2>
                        <h3 style='color: #333;'>Seja bem-vindo(a) ao GUIAR!</h3>
                        <p>Agradecemos por iniciar o seu cadastro como empresa parceira. Para dar continuidade ao processo e garantir a segurança da sua conta, precisamos confirmar o seu endereço de e-mail.</p>
                        <p>Por favor, utilize o código de verificação de 4 dígitos abaixo na tela de cadastro:</p>
                        <div style='text-align: center; margin: 30px 0;'>
                            <span style='background-color: #f8f9fa; border: 2px dashed #ff9a52; color: #ff9a52; padding: 15px 30px; border-radius: 5px; font-weight: bold; font-size: 24px; display: inline-block; letter-spacing: 5px;'>{$codigo_verificacao}</span>
                        </div>
                        <p>Caso você não tenha se cadastrado na plataforma <strong>GUIAR</strong>, por favor, desconsidere este e-mail de forma segura.</p>
                        <hr style='border: none; border-top: 1px solid #eee; margin: 20px 0;'>
                        <p style='font-size: 12px; color: #777; text-align: center;'>
                            Atenciosamente,<br>
                            <strong>Equipe GUIAR</strong><br>
                        </p>
                    </div>
                ";

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
        $erro = $_GET['erro'] ?? null;'';
        require_once __DIR__ . '/../Views/Empresa/cadastro.php';
    }

    public function esqueceuSenha(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $erro = "E-mail inválido!";
                require_once __DIR__ . '/../Views/Empresa/esqueceuSenha.php';
                return;
            }

            $stmt = $this->pdo->prepare("SELECT id_empresa FROM empresa WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            if ($stmt->rowCount() === 0) {
                $erro = "E-mail não encontrado!";
                require_once __DIR__ . '/../Views/Empresa/esqueceuSenha.php';
                return;
            }

            $userId = $stmt->fetchColumn();
            $token = bin2hex(random_bytes(32));
            $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));

            $stmt = $this->pdo->prepare("INSERT INTO password_resets (user_id, token, expiry) VALUES (:user_id, :token, :expiry)");
            $stmt->bindParam(':user_id', $userId);
            $stmt->bindParam(':token', $token);
            $stmt->bindParam(':expiry', $expiry);
            $stmt->execute();

            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'projGuiar@gmail.com';
                $mail->Password = 'jjuj ysee xhvs fnji';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->setFrom('projGuiar@gmail.com', 'GUIAR');
                $mail->addAddress($email);

                $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
                $host = $_SERVER['HTTP_HOST'];
                $resetLink = "$protocol://$host/GUIAR_desfunc/routes.php?action=redefinirSenha&token=$token";

                $mail->isHTML(true);
                $mail->Subject = 'GUIAR - Solicitacao de Redefinicao de Senha';
                $mail->Body = "
                    <div style='font-family: Arial, sans-serif; color: #333; line-height: 1.6; max-width: 600px; margin: 0 auto; border: 1px solid #ddd; padding: 20px; border-radius: 8px;'>
                        <h2 style='color: #ff9a52; text-align: center; margin-bottom: 20px;'>GUIAR</h2>
                        <h3 style='color: #333;'>Prezado(a) parceiro(a),</h3>
                        <p>Recebemos uma solicitação para redefinir a senha da sua conta empresarial no sistema <strong>GUIAR</strong>.</p>
                        <p>Para cadastrar uma nova senha e recuperar o acesso, por favor, clique no botão abaixo:</p>
                        <div style='text-align: center; margin: 30px 0;'>
                            <a href='{$resetLink}' style='background-color: #ff9a52; color: #ffffff; padding: 12px 24px; text-decoration: none; border-radius: 5px; font-weight: bold; font-size: 16px; display: inline-block;'>Redefinir Minha Senha</a>
                        </div>
                        <p>Se o botão não funcionar, você também pode acessar o endereço abaixo, copiando-o e colando-o em seu navegador:</p>
                        <p style='word-break: break-all; color: #0056b3;'><a href='{$resetLink}'>{$resetLink}</a></p>
                        <p>Ressaltamos que este link de redefinição é válido por apenas <strong>1 hora</strong>. Caso você não tenha solicitado esta alteração, por favor, desconsidere este e-mail. Sua senha atual permanecerá segura e inalterada.</p>
                        <hr style='border: none; border-top: 1px solid #eee; margin: 20px 0;'>
                        <p style='font-size: 12px; color: #777; text-align: center;'>
                            Atenciosamente,<br>
                            <strong>Equipe GUIAR</strong><br>
                        </p>
                    </div>
                ";

                $mail->send();
                
                $sucesso = "Um e-mail foi enviado para " . htmlspecialchars($email) . " com as instruções.";
                require_once __DIR__ . '/../Views/Empresa/esqueceuSenha.php';
                return;
            } catch (Exception $e) {
                $erro = "Erro ao enviar email: {$mail->ErrorInfo}";
                require_once __DIR__ . '/../Views/Empresa/esqueceuSenha.php';
                return;
            }
        }
        
        require_once __DIR__ . '/../Views/Empresa/esqueceuSenha.php';
    }

    public function redefinirSenha(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['token'] ?? '';
            $newPassword = $_POST['password'] ?? '';

            $stmt = $this->pdo->prepare("SELECT user_id FROM password_resets WHERE token = :token AND expiry > NOW()");
            $stmt->bindParam(':token', $token);
            $stmt->execute();

            if ($stmt->rowCount() === 0) {
                $erro = "Token inválido ou expirado.";
                require_once __DIR__ . '/../Views/Empresa/redefinirSenha.php';
                return;
            }

            $userId = $stmt->fetchColumn();

            $stmt = $this->pdo->prepare("UPDATE empresa SET senha = :senha WHERE id_empresa = :id");
            $stmt->bindParam(':senha', $newPassword);
            $stmt->bindParam(':id', $userId);
            $stmt->execute();

            $stmt = $this->pdo->prepare("DELETE FROM password_resets WHERE token = :token");
            $stmt->bindParam(':token', $token);
            $stmt->execute();

            $sucesso = "Senha redefinida com sucesso.";
            require_once __DIR__ . '/../Views/Empresa/redefinirSenha.php';
            return;
        }
        
        require_once __DIR__ . '/../Views/Empresa/redefinirSenha.php';
    }

    private function emailVerificacao(){

    }
}
