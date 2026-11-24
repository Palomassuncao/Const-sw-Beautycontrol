<?php
require_once __DIR__ . '/../../config/database.php';
class Relatorio {
    private $conn;
    
    public function __construct() {
        $this->conn = Database::getConnection();
    }
    public function resumoGeral() {
        $sql = "SELECT
                    COUNT(a.id) AS total_agendamentos,
                    SUM(CASE WHEN a.status IN ('agendado', 'confirmado') THEN 1 ELSE 0 END) AS ativos,
                    SUM(CASE WHEN a.status = 'concluido' THEN 1 ELSE 0 END) AS concluidos,
                    SUM(CASE WHEN a.status = 'cancelado' THEN 1 ELSE 0 END) AS cancelados,
                    COALESCE(SUM(CASE WHEN a.status = 'concluido' THEN s.preco ELSE 0 END), 0) AS faturamento_total
                FROM agendamentos a
                INNER JOIN servicos s ON a.id_servico = s.id";
        return $this->conn->query($sql)->fetch(PDO::FETCH_ASSOC);
    
    }
    public function porServico() {
        $sql = "SELECT
                    s.nome,
                    COUNT(a.id) AS total_agendamentos,
                    SUM(CASE WHEN a.status = 'concluido' THEN 1 ELSE 0 END) AS concluidos,
                    COALESCE(SUM(CASE WHEN a.status = 'concluido' THEN s.preco ELSE 0 END), 0) AS faturamento
                FROM servicos s
                LEFT JOIN agendamentos a ON a.id_servico = s.id
                GROUP BY s.id, s.nome
                ORDER BY total_agendamentos DESC, s.nome ASC";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    public function porPrestador() {
        $sql = "SELECT
                    u.nome,
                    COUNT(a.id) AS total_agendamentos,
                    SUM(CASE WHEN a.status = 'concluido' THEN 1 ELSE 0 END) AS concluidos,
                    COALESCE(SUM(CASE WHEN a.status = 'concluido' THEN s.preco ELSE 0 END), 0) AS faturamento
                    FROM usuarios u
                    LEFT JOIN agendamentos a ON a.id_prestador = u.id
                    LEFT JOIN servicos s ON a.id_servico = s.id
                    WHERE u.perfil = 'prestador'
                    GROUP BY u.id, u.nome
                    ORDER BY concluidos DESC, u.nome ASC";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}