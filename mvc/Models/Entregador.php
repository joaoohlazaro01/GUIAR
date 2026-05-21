<?php

namespace mvc\Models;

use PDO;
use PDOException;

class Entregador
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllByEmpresa($company_id)
    {
        try {
            $sql = "SELECT id_entregador, nome_completo, CPF, telefone, email, nome_foto3x4 AS foto_3x4, nome_cnh AS foto_CNH, latitude, longitude 
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

    public function create($data)
    {
        try {
            $sql = "INSERT INTO entregador (nome_completo, CPF, telefone, nome_foto3x4, email, nome_usuario, senha, nome_cnh, FK_EMPRESA_id_empresa) 
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

    public function update($id, $company_id, $data)
    {
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

    public function delete($id, $company_id)
    {
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

    public function login($email, $senha)
    {
        try {
            $sql = "SELECT * FROM entregador WHERE email = :email";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);

            if ($user && $user['senha'] === $senha) {
                return $user;
            }
            return false;
        } catch (\PDOException $e) {
            error_log("Erro ao realizar login do entregador: " . $e->getMessage());
            return false;
        }
    }

    public function updateLocation($id, $latitude, $longitude)
    {
        try {
            $sql = "UPDATE entregador SET latitude = :latitude, longitude = :longitude WHERE id_entregador = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':latitude', $latitude);
            $stmt->bindParam(':longitude', $longitude);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao atualizar localização do entregador: " . $e->getMessage());
            return false;
        }
    }

    public function getById($id)
    {
        try {
            $sql = "SELECT id_entregador, nome_completo, CPF, telefone, email, nome_foto3x4 AS foto_3x4, nome_cnh AS foto_CNH, nome_usuario, senha, FK_EMPRESA_id_empresa 
                    FROM entregador 
                    WHERE id_entregador = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao buscar entregador por ID: " . $e->getMessage());
            return false;
        }
    }

    public function updateProfile($id, $data)
    {
        try {
            $sql = "UPDATE entregador 
                    SET nome_completo = :nome_completo, 
                        CPF = :cpf, 
                        telefone = :telefone, 
                        email = :email, 
                        nome_usuario = :nome_usuario, 
                        senha = :senha";
            
            if (!empty($data['foto_3x4'])) {
                $sql .= ", nome_foto3x4 = :foto_3x4";
            }
            if (!empty($data['foto_CNH'])) {
                $sql .= ", nome_cnh = :foto_cnh";
            }
            
            $sql .= " WHERE id_entregador = :id";

            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':nome_completo', $data['nome_completo']);
            $stmt->bindParam(':cpf', $data['cpf']);
            $stmt->bindParam(':telefone', $data['telefone']);
            $stmt->bindParam(':email', $data['email']);
            $stmt->bindParam(':nome_usuario', $data['nome_usuario']);
            $stmt->bindParam(':senha', $data['senha']);
            
            if (!empty($data['foto_3x4'])) {
                $stmt->bindParam(':foto_3x4', $data['foto_3x4']);
            }
            if (!empty($data['foto_CNH'])) {
                $stmt->bindParam(':foto_cnh', $data['foto_CNH']);
            }
            
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao atualizar perfil do entregador: " . $e->getMessage());
            return false;
        }
    }
}

