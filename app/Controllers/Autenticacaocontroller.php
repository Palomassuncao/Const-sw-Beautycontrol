<?php

require_once __DIR__ . '/../Models/Usuario.php';

class AutenticacaoController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $senha = $_POST['senha'] ?? '';

            $usuarioModel = new Usuario();
            $usuario = $usuarioModel->autenticar($email, $senha);
            
            if ($usuario) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }

                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nome'] = $usuario['nome'];
                $_SESSION['usuario_perfil'] = $usuario['perfil'];
                
                header('Location: index.php?acao=painel');
                exit;
            } else {
                $erro = "E-mail ou senha invalidos.";
                require __DIR__ . '/../Views/login.php'; 
                return;
            }
        }

        require __DIR__ . '/../Views/login.php';
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
        header('Location: index.php');
        exit;
    }
}