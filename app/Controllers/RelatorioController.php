<?php
require_once __DIR__ . '/../Models/Relatorio.php';
class RelatorioController {
    public function index() {
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: index.php');
            exit;
        }

        if ($_SESSION['usuario_perfil'] !== 'admin') {
            http_response_code(403);
            echo "Acesso não autorizado.";
            return;
        }
        
        $model = new Relatorio();
        $resumo = $model->resumoGeral();
        $servicos = $model->porServico();
        $prestadores = $model->porPrestador();
        
        require __DIR__ . '/../Views/relatorios.php';
    }
}