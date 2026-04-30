<?php
namespace mvc\Models;

use PDO;
use PDOException;

class Entregador {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllByEmpresa($company_id) {
        try {
            $sql = "SELECT id_entregador, nome_completo, CPF, telefone, email, foto_3x4, foto_CNH, status 
                    FROM entregador 
                    WHERE FK_EMPRESA_id_empresa = :company_id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':company_id', $company_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao buscar entregadores: " . $e->getMessage());
            return [];
        }
    }

    public function create($data) {
        try {
            $sql = "INSERT INTO entregador (nome_completo, CPF, telefone, foto_3x4, email, nome_usuario, senha, foto_CNH, FK_EMPRESA_id_empresa) 
                    VALUES (:nome_completo, :cpf, :telefone, :foto_3x4, :email, :nome_usuario, :senha, :foto_CNH, :company_id)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':nome_completo', $data['nome_completo']);
            $stmt->bindParam(':cpf', $data['cpf']);
            $stmt->bindParam(':telefone', $data['telefone']);
            $stmt->bindParam(':foto_3x4', $data['foto_3x4']);
            $stmt->bindParam(':email', $data['email']);
            $stmt->bindParam(':nome_usuario', $data['nome_usuario']);
            $stmt->bindParam(':senha', $data['senha']);
            $stmt->bindParam(':foto_CNH', $data['foto_CNH']);
            $stmt->bindParam(':company_id', $data['company_id'], PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao cadastrar entregador: " . $e->getMessage());
            return false;
        }
    }

    public function update($id, $company_id, $data) {
        try {
            $sql = "UPDATE entregador 
                    SET nome_completo = :nome_completo, CPF = :cpf, telefone = :telefone, email = :email 
                    WHERE id_entregador = :id AND FK_EMPRESA_id_empresa = :company_id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':nome_completo', $data['nome_completo']);
            $stmt->bindParam(':cpf', $data['cpf']);
            $stmt->bindParam(':telefone', $data['telefone']);
            $stmt->bindParam(':email', $data['email']);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':company_id', $company_id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao atualizar entregador: " . $e->getMessage());
            return false;
        }
    }

    public function delete($id, $company_id) {
        try {
            // Verifica se o entregador tem pedidos associados que não podem ser excluídos, ou tenta excluir com FK cascade (depende do banco).
            // Apenas tentamos excluir.
            $sql = "DELETE FROM entregador WHERE id_entregador = :id AND FK_EMPRESA_id_empresa = :company_id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':company_id', $company_id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao excluir entregador: " . $e->getMessage());
            return false;
        }
    }
}
