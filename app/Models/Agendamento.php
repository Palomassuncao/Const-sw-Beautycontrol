<?php
require_once __DIR__ . '/../../config/database.php';
class Agendamento {
    private $conn;
    public function __construct() {
        $this->conn = Database::getConnection();
    }
    public function listar($usuarioId, $perfil) {
        $sql = "SELECT a.id, a.data_hora, a.status,
        c.nome AS cliente_nome,
        p.nome AS prestador_nome,
        s.nome AS servico_nome,
        s.preco
        FROM agendamentos a
        INNER JOIN usuarios c ON a.id_cliente = c.id
        INNER JOIN usuarios p ON a.id_prestador = p.id
        INNER JOIN servicos s ON a.id_servico = s.id";

        if ($perfil === 'cliente') {
            $sql .= " WHERE a.id_cliente = :id";
        } elseif ($perfil === 'prestador') {
            $sql .= " WHERE a.id_prestador = :id";
        }
        $sql .= " ORDER BY a.data_hora DESC";
        $stmt = $this->conn->prepare($sql);

        if ($perfil === 'cliente' || $perfil === 'prestador') {
            $stmt->bindParam(':id', $usuarioId, PDO::PARAM_INT);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function listarPrestadores() {
        $sql = "SELECT id, nome FROM usuarios WHERE perfil = 'prestador' ORDER BY nome ASC";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    public function listarClientes() {
        $sql = "SELECT id, nome FROM usuarios WHERE perfil = 'cliente' ORDER BY nome ASC";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    public function listarServicos() {
        $sql = "SELECT id, nome, preco, duracao_minutos FROM servicos ORDER BY nome ASC";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    public function existeConflito($id_prestador, $data_hora) {
        $sql = "SELECT COUNT(*) FROM agendamentos
                WHERE id_prestador = :id_prestador
                AND data_hora = :data_hora
                AND status != 'cancelado'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':id_prestador' => $id_prestador,
            ':data_hora' => $data_hora
        ]);
        return $stmt->fetchColumn() > 0;
    }
    public function cadastrar($id_cliente, $id_prestador, $id_servico, $data_hora) {
        $sql = "INSERT INTO agendamentos (id_cliente, id_prestador, id_servico, data_hora, status)
                VALUES (:id_cliente, :id_prestador, :id_servico, :data_hora, 'agendado')";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':id_cliente' => $id_cliente,
            ':id_prestador' => $id_prestador,
            ':id_servico' => $id_servico,
            ':data_hora' => $data_hora
        ]);
    }
    public function atualizarStatus($id, $status) {
        $sql = "UPDATE agendamentos SET status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':status' => $status,
            ':id' => $id
        ]);
    }
}