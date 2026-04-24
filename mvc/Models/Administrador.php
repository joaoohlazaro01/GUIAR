<?php
namespace mvc\Models;

use PDO;
use PDOException;

class Administrador {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getByEmpresaId($company_id) {
        try {
            $sql = "SELECT * FROM administrador WHERE FK_EMPRESA_id_empresa = :company_id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':company_id', $company_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao buscar administradores por empresa: " . $e->getMessage());
            return [];
        }
    }

    public function create($data) {
        try {
            $sql = "INSERT INTO administrador (nome_adm, nome_usuario, nome_foto, senha, FK_EMPRESA_id_empresa) 
                    VALUES (:nome_adm, :nome_usuario, :foto, :senha, :company_id)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':nome_adm', $data['nome_adm'], PDO::PARAM_STR);
            $stmt->bindParam(':nome_usuario', $data['nome_usuario'], PDO::PARAM_STR);
            $stmt->bindParam(':foto', $data['nome_foto'], PDO::PARAM_STR);
            $stmt->bindParam(':senha', $data['senha'], PDO::PARAM_STR);
            $stmt->bindParam(':company_id', $data['company_id'], PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao criar administrador: " . $e->getMessage());
            return false;
        }
    }

    public function login($username, $password) {
        try {
            $sql = "SELECT * FROM administrador WHERE nome_usuario = :nome_usuario AND senha = :senha";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':nome_usuario', $username, PDO::PARAM_STR);
            $stmt->bindParam(':senha', $password, PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return $stmt->fetch(PDO::FETCH_ASSOC);
            }
            return false;
        } catch (PDOException $e) {
            error_log("Erro no login do administrador: " . $e->getMessage());
            return false;
        }
    }

    public function getById($id) {
        try {
            $sql = "SELECT * FROM administrador WHERE id_adm = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao buscar administrador por ID: " . $e->getMessage());
            return false;
        }
    }
}
