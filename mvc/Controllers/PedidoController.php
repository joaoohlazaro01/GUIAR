<?php
namespace mvc\Controllers;

use mvc\Models\Pedido;
use mvc\Models\Administrador;

class PedidoController {
    private $pedidoModel;
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->pedidoModel = new Pedido($pdo);
    }

    private function checkAuth() {
        if (!isset($_SESSION['company_id'])) {
            header("Location: /GUIAR_desfunc/routes.php?action=loginEmpresa");
            exit;
        }
        if (!isset($_SESSION['id_adm'])) {
            header("Location: /GUIAR_desfunc/routes.php?action=escolherAdm");
            exit;
        }
    }

    public function index() {
        $this->checkAuth();
        $company_id = $_SESSION['company_id'];
        
        $result = $this->pedidoModel->getAllByEmpresa($company_id, 'pendente');
        
        // Buscar entregadores para o modal de envio
        $sqlEntregadores = "SELECT id_entregador, nome_completo FROM entregador WHERE FK_EMPRESA_id_empresa = :company_id";
        $stmt = $this->pdo->prepare($sqlEntregadores);
        $stmt->bindParam(':company_id', $company_id, PDO::PARAM_INT);
        $stmt->execute();
        $resultEntregadores = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        require_once __DIR__ . '/../Views/Administrador/pedidos.php';
    }

    public function entregues() {
        $this->checkAuth();
        $company_id = $_SESSION['company_id'];
        
        $pedidos = $this->pedidoModel->getAllByEmpresa($company_id, 'entregue');

        require_once __DIR__ . '/../Views/Administrador/pedidosEntregues.php';
    }

    public function adicionar() {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nome_cliente' => $_POST['nome_cliente'] ?? '',
                'preco' => $_POST['preco'] ?? 0,
                'endereco' => $_POST['endereco'] ?? '',
                'bairro' => $_POST['bairro'] ?? '',
                'descricao' => $_POST['descricao'] ?? '',
                'id_empresa' => $_SESSION['company_id'],
                'id_adm' => $_SESSION['id_adm'],
                'latitude' => $_POST['latitude'] ?? null,
                'longitude' => $_POST['longitude'] ?? null
            ];

            if ($this->pedidoModel->create($data)) {
                header("Location: /GUIAR_desfunc/routes.php?action=pedidos");
            } else {
                echo "Erro ao adicionar pedido.";
            }
        }
    }

    public function editar() {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_pedido'];
            $data = [
                'nome_cliente' => $_POST['nome_cliente'] ?? '',
                'preco' => $_POST['preco'] ?? 0,
                'endereco' => $_POST['endereco'] ?? '',
                'bairro' => $_POST['bairro'] ?? '',
                'descricao' => $_POST['descricao'] ?? '',
                'latitude' => $_POST['latitude'] ?? null,
                'longitude' => $_POST['longitude'] ?? null
            ];

            if ($this->pedidoModel->update($id, $data)) {
                header("Location: /GUIAR_desfunc/routes.php?action=pedidos");
            } else {
                echo "Erro ao atualizar pedido.";
            }
        }
    }

    public function excluir() {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_pedido'];
            if ($this->pedidoModel->delete($id)) {
                header("Location: /GUIAR_desfunc/routes.php?action=pedidos");
            } else {
                echo "Erro ao excluir pedido.";
            }
        }
    }

    public function enviar() {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pedido_ids = explode(',', $_POST['pedido_ids']);
            $entregador_id = $_POST['entregador_id'];

            if ($this->pedidoModel->assignToEntregador($pedido_ids, $entregador_id)) {
                header("Location: /GUIAR_desfunc/routes.php?action=pedidos");
            } else {
                echo "Erro ao enviar pedidos.";
            }
        }
    }

    public function finalizarTurno() {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->pedidoModel->deleteDeliveredByEmpresa($_SESSION['company_id'])) {
                header("Location: /GUIAR_desfunc/routes.php?action=pedidosEntregues");
            } else {
                echo "Erro ao finalizar turno.";
            }
        }
    }

    public function concluirEntrega() {
        // Geralmente chamado via AJAX ou pelo entregador
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_pedido'];
            if ($this->pedidoModel->updateStatus($id, 'entregue')) {
                echo "success";
            } else {
                echo "error";
            }
            exit;
        }
    }
}
