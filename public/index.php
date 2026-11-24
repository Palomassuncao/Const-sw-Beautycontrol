<?php

session_start();

require_once '../app/Controllers/AutenticacaoController.php';
require_once '../app/Controllers/UsuarioController.php';
require_once '../app/Controllers/ServicoController.php';
require_once '../app/Controllers/AgendamentoController.php';
require_once '../app/Controllers/RelatorioController.php';

$acao = $_GET['acao'] ?? 'login';

$controller = new AutenticacaoController();

if ($acao === 'logout') {
    $controller->logout();
} elseif ($acao === 'painel') {
    if (!isset($_SESSION['usuario_id'])) {
        header('Location: index.php');
        exit;
    }
    
    require '../app/Views/painel.php';
} elseif ($acao === 'cadastrarUsuario') {
    $controllerUsuario = new UsuarioController();
    $controllerUsuario->cadastrar();

} elseif ($acao === 'servicos') {
    $controllerServico = new ServicoController();
    $controllerServico->index();

} elseif ($acao === 'agendamentos') {
    $controllerAgendamento = new AgendamentoController();
    $controllerAgendamento->index();

} elseif ($acao === 'relatorios') {
    $controllerRelatorio = new RelatorioController();
    $controllerRelatorio->index();
} else {
    $controller->login();
}