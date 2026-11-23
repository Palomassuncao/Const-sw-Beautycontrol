<?php

require_once __DIR__ . '/../Models/Usuario.php';

class UsuarioController {

    public function cadastrar() {

        // Somente administradores podem cadastrar usuários
        if (!isset($_SESSION['usuario_id']) ||
            $_SESSION['usuario_perfil'] !== 'admin') {

            http_response_code(403);
            echo "Acesso não autorizado.";
            return;
        }

        $erro = '';
        $sucesso = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nome = trim($_POST['nome'] ?? '');
            $cpf = trim($_POST['cpf'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $telefone = trim($_POST['telefone'] ?? '');
            $senha = $_POST['senha'] ?? '';
            $perfil = $_POST['perfil'] ?? '';

            if (
                $nome === '' ||
                $email === '' ||
                $senha === '' ||
                !filter_var($email, FILTER_VALIDATE_EMAIL) ||
                !in_array($perfil, ['admin', 'prestador', 'cliente'], true)
            ) {
                $erro = 'Preencha os campos corretamente.';
            } elseif (strlen($senha) < 6) {
                $erro = 'A senha deve ter pelo menos 6 caracteres.';
            } else {
                try {
                    $usuarioModel = new Usuario();

                    $usuarioModel->cadastrar(
                        $nome,
                        $cpf,
                        $email,
                        $telefone,
                        $senha,
                        $perfil
                    );

                    $sucesso = 'Usuário cadastrado com sucesso!';

                } catch (PDOException $e) {
                    if ($e->getCode() === '23000') {
                        $erro = 'E-mail ou CPF já cadastrado.';
                    } else {
                        $erro = 'Erro ao cadastrar usuário.';
                    }
                }
            }
        }

        require __DIR__ . '/../Views/cadastro_usuario.php';
    }
}