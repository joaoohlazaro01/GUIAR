<?php

namespace mvc\Controllers;

use mvc\Models\Administrador;
use mvc\Models\Empresa;

class AdministradorController
{
    private $administradorModel;
    private $empresaModel;
    private $entregadorModel;
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        $this->administradorModel = new Administrador($pdo);
        $this->empresaModel = new Empresa($pdo);
        $this->entregadorModel = new \mvc\Models\Entregador($pdo);
    }

    public function escolher()
    {
        if (!isset($_SESSION['company_id'])) {
            header("Location: " . BASE_URL . "/routes.php?action=loginEmpresa");
            exit;
        }

        $company_id = $_SESSION['company_id'];
        $empresa = $this->empresaModel->getById($company_id);

        if (!$empresa) {
            header("Location: " . BASE_URL . "/routes.php?action=loginEmpresa");
            exit;
        }

        $nome_empresa = $empresa['nome_empresa'];
        $administradores = $this->administradorModel->getByEmpresaId($company_id);

        $erro = $_GET['erro'] ?? null;

        require_once __DIR__ . '/../Views/Administrador/escolher.php';
    }

    public function adicionar()
    {
        if (!isset($_SESSION['company_id'])) {
            header("Location: " . BASE_URL . "/routes.php?action=loginEmpresa");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $company_id = $_SESSION['company_id'];
            $empresa = $this->empresaModel->getById($company_id);

            if (!$empresa) {
                header("Location: " . BASE_URL . "/routes.php?action=loginEmpresa");
                exit;
            }

            $nome_empresa = $empresa['nome_empresa'];
            $nome_adm = $_POST['adminNome'] ?? '';
            $nome_usuario = $_POST['adminUsername'] ?? '';
            $senha = $_POST['adminPassword'] ?? '';

            // Diretório legado original: 'admin_fotos/' . $nome_empresa . '/'
            // Para manter compatibilidade com a view antiga (até que as views sejam totalmente atualizadas para public/uploads)
            // vamos usar public/uploads/empresas/$nome_empresa/
            $diretorioDestino = __DIR__ . '/../../public/uploads/empresas/' . $nome_empresa . '/';

            // Também vamos manter na pasta antiga por segurança caso algo de fora dependa dela, mas o ideal é concentrar em public.
            // Para refatoração limpa, vamos salvar no diretório raiz do projeto "admin_fotos/..." ou public/uploads
            // Vamos adotar "public/uploads/empresas/..." para centralização.

            // Replicando o comportamento antigo que salva na raiz do site em admin_fotos/
            $diretorioDestinoLegado = __DIR__ . '/../../public/uploads/empresas/' . $nome_empresa . '/';

            if (!is_dir($diretorioDestinoLegado)) {
                mkdir($diretorioDestinoLegado, 0777, true);
            }

            $fotoNomeUnico = '';
            if (isset($_FILES['adminFoto']) && $_FILES['adminFoto']['error'] == 0) {
                $fotoNome = basename($_FILES['adminFoto']['name']);
                $extensaoArquivo = pathinfo($fotoNome, PATHINFO_EXTENSION);
                $fotoNomeUnico = uniqid() . '.' . $extensaoArquivo;

                $fotoDestino = $diretorioDestinoLegado . $fotoNomeUnico;

                if (!move_uploaded_file($_FILES['adminFoto']['tmp_name'], $fotoDestino)) {
                    $fotoNomeUnico = ''; // Falha ao mover
                }
            }

            if ($fotoNomeUnico) {
                $data = [
                    'nome_adm' => $nome_adm,
                    'nome_usuario' => $nome_usuario,
                    'nome_foto' => $fotoNomeUnico,
                    'senha' => $senha,
                    'company_id' => $company_id
                ];

                if ($this->administradorModel->create($data)) {
                    header("Location: " . BASE_URL . "/routes.php?action=escolherAdm");
                    exit();
                } else {
                    $erro = "Erro ao adicionar administrador no banco de dados.";
                    header("Location: " . BASE_URL . "/routes.php?action=escolherAdm&erro=" . urlencode($erro));
                    exit();
                }
            } else {
                $erro = "Erro ao fazer upload da foto.";
                header("Location: " . BASE_URL . "/routes.php?action=escolherAdm&erro=" . urlencode($erro));
                exit();
            }
        }
    }

    public function login()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $adminUsername = $_POST['adminUsername'] ?? '';
            $adminPassword = $_POST['adminPassword'] ?? '';

            $admin = $this->administradorModel->login($adminUsername, $adminPassword);

            if ($admin) {
                $_SESSION['id_adm'] = $admin['id_adm'];
                $_SESSION['nome_usuario'] = $admin['nome_usuario'];
                echo "success";
            } else {
                echo "error";
            }
            exit; // Importante para as chamadas AJAX
        }
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

        header("Location: " . BASE_URL . "/routes.php?action=loginEmpresa");
        exit();
    }

    public function dashboard()
    {
        if (!isset($_SESSION['company_id'])) {
            header("Location: " . BASE_URL . "/routes.php?action=loginEmpresa");
            exit;
        }

        if (!isset($_SESSION['nome_usuario'])) {
            header("Location: " . BASE_URL . "/routes.php?action=escolherAdm&erro=" . urlencode("Administrador não identificado"));
            exit;
        }

        $nomeAdmin = $_SESSION['nome_usuario'];

        require_once __DIR__ . '/../Views/Administrador/dashboard.php';
    }

    public function mapa()
    {
        if (!isset($_SESSION['company_id'])) {
            header("Location: " . BASE_URL . "/routes.php?action=loginEmpresa");
            exit;
        }

        if (!isset($_SESSION['nome_usuario'])) {
            header("Location: " . BASE_URL . "/routes.php?action=escolherAdm&erro=" . urlencode("Administrador não identificado"));
            exit;
        }

        $nomeAdmin = $_SESSION['nome_usuario'];

        require_once __DIR__ . '/../Views/Administrador/mapa.php';
    }

    public function apiAcompanharEntregadores()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['company_id'])) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'error' => 'Não autenticado']);
            exit;
        }

        $company_id = $_SESSION['company_id'];

        $entregadores = $this->entregadorModel->getAllByEmpresa($company_id);
        $pedidoModel = new \mvc\Models\Pedido($this->pdo);

        $dados = [];
        foreach ($entregadores as $e) {
            $pedidos = $pedidoModel->getAllByEntregador($e['id_entregador']);
            $dados[] = [
                'id_entregador' => $e['id_entregador'],
                'nome_completo' => $e['nome_completo'],
                'latitude' => $e['latitude'],
                'longitude' => $e['longitude'],
                'pedidos' => $pedidos
            ];
        }

        header('Content-Type: application/json');
        echo json_encode($dados);
        exit;
    }
}
