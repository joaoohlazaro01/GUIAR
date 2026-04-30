<?php
namespace mvc\Controllers;

use mvc\Models\Entregador;

class EntregadorController {
    private $entregadorModel;
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->entregadorModel = new Entregador($pdo);
    }

    private function checkAuth() {
        if (!isset($_SESSION['company_id'])) {
            header("Location: /GUIAR_desfunc/routes.php?action=loginEmpresa");
            exit;
        }
        if (!isset($_SESSION['id_adm']) && !isset($_SESSION['nome_usuario'])) {
            header("Location: /GUIAR_desfunc/routes.php?action=escolherAdm");
            exit;
        }
    }

    public function index() {
        $this->checkAuth();
        $company_id = $_SESSION['company_id'];
        $nomeAdmin = $_SESSION['nome_usuario'] ?? '';
        
        $result = $this->entregadorModel->getAllByEmpresa($company_id);
        
        require_once __DIR__ . '/../Views/Administrador/entregadores.php';
    }

    public function adicionar() {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $company_id = $_SESSION['company_id'];

            // Lógica de upload (copiada da versão procedural)
            $diretorio_3x4 = __DIR__ . '/../../PHP ADM/admin_fotos/Entregadores/';
            $diretorio_CNH = __DIR__ . '/../../PHP ADM/admin_fotos/Entregadores/';

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
                'cpf' => $_POST['CPF'] ?? '',
                'telefone' => $_POST['telefone'] ?? '',
                'email' => $_POST['email'] ?? '',
                'nome_usuario' => $_POST['nome_usuario'] ?? '',
                'senha' => $_POST['senha'] ?? '',
                'foto_3x4' => $nome_foto_3x4,
                'foto_CNH' => $nome_foto_CNH,
                'company_id' => $company_id
            ];

            if ($this->entregadorModel->create($data)) {
                header("Location: /GUIAR_desfunc/routes.php?action=entregadores");
            } else {
                echo "Erro ao adicionar entregador.";
            }
            exit;
        }
    }

    public function editar() {
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
                header("Location: /GUIAR_desfunc/routes.php?action=entregadores");
            } else {
                echo "Erro ao editar entregador.";
            }
            exit;
        }
    }

    public function excluir() {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
            $company_id = $_SESSION['company_id'];
            $id = $_GET['id'];

            if ($this->entregadorModel->delete($id, $company_id)) {
                header("Location: /GUIAR_desfunc/routes.php?action=entregadores");
            } else {
                echo "Erro ao excluir entregador.";
            }
            exit;
        }
    }
}
