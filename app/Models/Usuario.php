<?php
require_once __DIR__ . '/../../config/database.php';

class Usuario {
    private $conn;
    
    public function __construct() {
        $this->conn = Database::getConnection();
    }

    // Busca o usuário pelo e-mail e verifica senha
    public function autenticar($email, $senha) {
        $sql = "SELECT id, nome, email, senha, perfil FROM usuarios WHERE email = :email LIMIT 1"; 
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            if (password_verify($senha, $usuario['senha']) || $senha === $usuario['senha']) {
                return $usuario;
            }
        }
        return false;
    }
}