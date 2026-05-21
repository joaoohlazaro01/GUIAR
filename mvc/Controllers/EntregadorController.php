<?php

namespace mvc\Controllers;

use mvc\Models\Entregador;

class EntregadorController
{
    private $entregadorModel;
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        $this->entregadorModel = new Entregador($pdo);
    }

    private function checkAuth()
    {
        if (!isset($_SESSION['company_id'])) {
            header("Location: " . BASE_URL . "/routes.php?action=loginEmpresa");
            exit;
        }
        if (!isset($_SESSION['id_adm']) && !isset($_SESSION['nome_usuario'])) {
            header("Location: " . BASE_URL . "/routes.php?action=escolherAdm");
            exit;
        }
    }

    public function index()
    {
        $this->checkAuth();
        $company_id = $_SESSION['company_id'];
        $nomeAdmin = $_SESSION['nome_usuario'] ?? '';

        $result = $this->entregadorModel->getAllByEmpresa($company_id);
        require_once __DIR__ . '/../Views/Administrador/entregadores.php';
    }

    public function cadastrar()
    {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $company_id = $_SESSION['company_id'];

            $diretorio_3x4 = __DIR__ . '/../../public/uploads/entregadores/fotos/';
            $diretorio_CNH = __DIR__ . '/../../public/uploads/entregadores/CNH/';

            if (!is_dir($diretorio_3x4)) {
                mkdir($diretorio_3x4, 0777, true);
            }
            if (!is_dir($diretorio_CNH)) {
                mkdir($diretorio_CNH, 0777, true);
            }

            $foto_3x4 = $_FILES['foto_3x4'];
            $foto_CNH = $_FILES['foto_CNH'];

            // Nome seguro
            $nome_foto_3x4 = uniqid() . '_' . basename($foto_3x4['name']);
            $nome_foto_CNH = uniqid() . '_' . basename($foto_CNH['name']);

            $caminho_3x4 = $diretorio_3x4 . $nome_foto_3x4;
            $caminho_CNH = $diretorio_CNH . $nome_foto_CNH;

            move_uploaded_file($foto_3x4['tmp_name'], $caminho_3x4);
            move_uploaded_file($foto_CNH['tmp_name'], $caminho_CNH);

            $data = [
                'nome_completo' => $_POST['nome_completo'] ?? '',
                'cpf' => $_POST['cpf'] ?? '',
                'telefone' => $_POST['telefone'] ?? '',
                'email' => $_POST['email'] ?? '',
                'nome_usuario' => $_POST['nome_usuario'] ?? '',
                'senha' => $_POST['senha'] ?? '',
                'foto_3x4' => $nome_foto_3x4,
                'foto_CNH' => $nome_foto_CNH,
                'company_id' => $company_id
            ];

            if ($this->entregadorModel->create($data)) {
                header("Location: " . BASE_URL . "/routes.php?action=entregadores");
            } else {
                echo "Erro ao adicionar entregador.";
            }
            exit;
        }

        // Se acessar por GET acidentalmente, redireciona para a listagem
        header("Location: " . BASE_URL . "/routes.php?action=entregadores");
        exit;
    }

    public function editar()
    {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $company_id = $_SESSION['company_id'];
            $id = $_POST['id'] ?? null;

            $data = [
                'nome_completo' => $_POST['nome_completo'] ?? '',
                'cpf' => $_POST['CPF'] ?? '',
                'telefone' => $_POST['telefone'] ?? '',
                'email' => $_POST['email'] ?? ''
            ];

            if ($this->entregadorModel->update($id, $company_id, $data)) {
                header("Location: " . BASE_URL . "/routes.php?action=entregadores");
            } else {
                echo "Erro ao editar entregador.";
            }
            exit;
        }
    }

    public function excluir()
    {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
            $company_id = $_SESSION['company_id'];
            $id = $_GET['id'];

            if ($this->entregadorModel->delete($id, $company_id)) {
                header("Location: " . BASE_URL . "/routes.php?action=entregadores");
            } else {
                echo "Erro ao excluir entregador.";
            }
            exit;
        }
    }

    public function login()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['entregador_id']) && !empty($_SESSION['entregador_id'])) {
            header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
            header("Location: " . BASE_URL . "/routes.php?action=mapaEntregador");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $senha = $_POST['senha'] ?? '';

            $user = $this->entregadorModel->login($email, $senha);

            if ($user) {
                $_SESSION['entregador_id'] = $user['id_entregador'];
                session_write_close();
                header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
                header("Location: " . BASE_URL . "/routes.php?action=mapaEntregador");
                exit;
            } else {
                header("Location: " . BASE_URL . "/routes.php?action=loginEntregador&erro=" . urlencode('Email ou senha incorreto'));
                exit;
            }
        }

        require_once __DIR__ . '/../Views/Entregador/login.php';
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        // Limpa todas as variáveis da sessão
        $_SESSION = [];

        // Exclui o cookie de sessão do navegador
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        // Destrói a sessão no servidor
        session_destroy();
        
        header("Location: " . BASE_URL . "/routes.php?action=loginEntregador");
        exit;
    }

    public function mapa()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['entregador_id'])) {
            header("Location: " . BASE_URL . "/routes.php?action=loginEntregador");
            exit;
        }

        require_once __DIR__ . '/../Views/Entregador/mapa.php';
    }

    public function atualizarLocalizacao()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['entregador_id'])) {
            echo json_encode(['success' => false, 'error' => 'Não autenticado']);
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents("php://input"), true);
            $latitude = $data['latitude'] ?? null;
            $longitude = $data['longitude'] ?? null;

            if ($latitude !== null && $longitude !== null) {
                if ($this->entregadorModel->updateLocation($_SESSION['entregador_id'], $latitude, $longitude)) {
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false, 'error' => 'Erro ao salvar no banco']);
                }
            } else {
                echo json_encode(['success' => false, 'error' => 'Dados de localização incompletos']);
            }
            exit;
        }
    }
}
