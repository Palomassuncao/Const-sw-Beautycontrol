<?php
session_start();
require_once '../app/Controllers/AutenticacaoController.php';

$acao = $_GET['acao'] ?? 'login';
$controller = new AutenticacaoController();

if ($acao === 'logout') {
    $controller->logout();
} elseif ($acao === 'painel') {
    if (!isset($_SESSION['usuario_id'])) {
        header('Location: index.php');
        exit;
    }

    echo "<h1>Bem-vindo(a), " . htmlspecialchars($_SESSION['usuario_nome']) . "!</h1>";
    echo "<p>Seu perfil de acesso é: <strong>" . htmlspecialchars($_SESSION['usuario_perfil']) . "</strong></p>";
    echo '<a href="index.php?acao=logout">Sair</a>';
} else {
    $controller->login();
}