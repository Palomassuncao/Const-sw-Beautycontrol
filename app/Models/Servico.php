<?php
require_once __DIR__ . '/../../config/database.php';

class Servico {
    private $conn;
    public function __construct() {
        $this->conn = Database::getConnection();
    }

    public function listar() {
        $sql = "SELECT id, nome, descricao, duracao_minutos, preco FROM servicos ORDER BY nome ASC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function cadastrar($nome, $descricao, $duracao_minutos, $preco, $id_admin) {
        $sql = "INSERT INTO servicos (nome, descricao, duracao_minutos, preco, id_admin)
                VALUES (:nome, :descricao, :duracao_minutos, :preco, :id_admin)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':nome' => $nome,
            ':descricao' => $descricao,
            ':duracao_minutos' => $duracao_minutos,
            ':preco' => $preco,
            ':id_admin' => $id_admin
        ]);
    }
}