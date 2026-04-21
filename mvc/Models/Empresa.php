<?php
namespace mvc\Models;

use PDO;
use PDOException;

class Empresa {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function login($username, $password) {
        try {
            $sql = "SELECT * FROM empresa WHERE nome_usuario = :nome_usuario AND senha = :senha";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':nome_usuario', $username);
            $stmt->bindParam(':senha', $password);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return $stmt->fetch(PDO::FETCH_ASSOC);
            }
            return false;
        } catch (PDOException $e) {
            error_log("Erro de login empresa: " . $e->getMessage());
            return false;
        }
    }

    public function create($data) {
        try {
            $sql = "INSERT INTO empresa (nome_empresa, CNPJ, nome_usuario, email, senha, nome_arquivo) 
                    VALUES (:nome_empresa, :cnpj, :nome_usuario, :email, :senha, :nome_arquivo)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':nome_empresa', $data['nome_empresa']);
            $stmt->bindParam(':cnpj', $data['cnpj']);
            $stmt->bindParam(':nome_usuario', $data['nome_usuario']);
            $stmt->bindParam(':email', $data['email']);
            $stmt->bindParam(':senha', $data['senha']);
            $stmt->bindParam(':nome_arquivo', $data['nome_arquivo']);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao criar empresa: " . $e->getMessage());
            return false;
        }
    }

    public function getById($id) {
        try {
            $sql = "SELECT * FROM empresa WHERE id_empresa = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao buscar empresa: " . $e->getMessage());
            return false;
        }
    }
}
