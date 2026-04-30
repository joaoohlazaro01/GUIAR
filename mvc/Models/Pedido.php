<?php
namespace mvc\Models;

use PDO;
use PDOException;

class Pedido {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllByEmpresa($company_id, $status = null) {
        try {
            $sql = "
                SELECT p.*, e.nome_completo AS nome_entregador
                FROM pedido p
                LEFT JOIN entregador e ON p.id_entregador = e.id_entregador
                WHERE p.id_empresa = :company_id
            ";
            
            if ($status === 'entregue') {
                $sql .= " AND p.status = 'entregue'";
            } elseif ($status === 'pendente') {
                $sql .= " AND p.status != 'entregue'";
            }

            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':company_id', $company_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao buscar pedidos: " . $e->getMessage());
            return [];
        }
    }

    public function getById($id) {
        try {
            $sql = "SELECT * FROM pedido WHERE id_pedido = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao buscar pedido por ID: " . $e->getMessage());
            return false;
        }
    }

    public function create($data) {
        try {
            $sql = "INSERT INTO pedido (nome_cliente, preco, endereco, bairro, descricao, id_empresa, id_adm, latitude, longitude, status) 
                    VALUES (:nome_cliente, :preco, :endereco, :bairro, :descricao, :id_empresa, :id_adm, :latitude, :longitude, 'Pendente')";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':nome_cliente', $data['nome_cliente']);
            $stmt->bindParam(':preco', $data['preco']);
            $stmt->bindParam(':endereco', $data['endereco']);
            $stmt->bindParam(':bairro', $data['bairro']);
            $stmt->bindParam(':descricao', $data['descricao']);
            $stmt->bindParam(':id_empresa', $data['id_empresa']);
            $stmt->bindParam(':id_adm', $data['id_adm']);
            $stmt->bindParam(':latitude', $data['latitude']);
            $stmt->bindParam(':longitude', $data['longitude']);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao criar pedido: " . $e->getMessage());
            return false;
        }
    }

    public function update($id, $data) {
        try {
            $sql = "UPDATE pedido SET 
                    nome_cliente = :nome_cliente, 
                    preco = :preco, 
                    endereco = :endereco, 
                    bairro = :bairro, 
                    descricao = :descricao, 
                    latitude = :latitude, 
                    longitude = :longitude 
                    WHERE id_pedido = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':nome_cliente', $data['nome_cliente']);
            $stmt->bindParam(':preco', $data['preco']);
            $stmt->bindParam(':endereco', $data['endereco']);
            $stmt->bindParam(':bairro', $data['bairro']);
            $stmt->bindParam(':descricao', $data['descricao']);
            $stmt->bindParam(':latitude', $data['latitude']);
            $stmt->bindParam(':longitude', $data['longitude']);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao atualizar pedido: " . $e->getMessage());
            return false;
        }
    }

    public function delete($id) {
        try {
            $sql = "DELETE FROM pedido WHERE id_pedido = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao excluir pedido: " . $e->getMessage());
            return false;
        }
    }

    public function assignToEntregador($pedido_ids, $entregador_id) {
        try {
            $ids = implode(',', array_map('intval', $pedido_ids));
            $sql = "UPDATE pedido SET id_entregador = :entregador_id, status = 'A caminho' WHERE id_pedido IN ($ids)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':entregador_id', $entregador_id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao atribuir entregador: " . $e->getMessage());
            return false;
        }
    }

    public function deleteDeliveredByEmpresa($company_id) {
        try {
            $sql = "DELETE FROM pedido WHERE status = 'entregue' AND id_empresa = :company_id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':company_id', $company_id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao finalizar turno: " . $e->getMessage());
            return false;
        }
    }

    public function updateStatus($id, $status) {
        try {
            $sql = "UPDATE pedido SET status = :status WHERE id_pedido = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao atualizar status do pedido: " . $e->getMessage());
            return false;
        }
    }
}
