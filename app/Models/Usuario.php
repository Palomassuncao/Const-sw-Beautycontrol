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
    // Cadastra um novo usuário no banco de dados
    public function cadastrar($nome, $cpf, $email, $telefone, $senha, $perfil) {

    $sql = "INSERT INTO usuarios
            (nome, cpf, email, telefone, senha, perfil)
            VALUES
            (:nome, :cpf, :email, :telefone, :senha, :perfil)";

    $stmt = $this->conn->prepare($sql);

    // Protege a senha usando hash
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    return $stmt->execute([
        ':nome' => $nome,
        ':cpf' => $cpf ?: null,
        ':email' => $email,
        ':telefone' => $telefone,
        ':senha' => $senhaHash,
        ':perfil' => $perfil
    ]);
}
}