<?php
require_once __DIR__ . '/../Models/Servico.php';
class ServicoController {
    public function index() {
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: index.php');
            exit;
        }
        
        $servicoModel = new Servico();
        $erro = '';
        $sucesso = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_SESSION['usuario_perfil'] !== 'admin') {
                http_response_code(403);
                echo "Acesso não autorizado.";
                return;
            }
            
            $nome = trim($_POST['nome'] ?? '');
            $descricao = trim($_POST['descricao'] ?? '');
            $duracao = (int) ($_POST['duracao_minutos'] ?? 0); 
            $preco = (float) str_replace(',', '.', $_POST['preco'] ?? '0');

            if ($nome === '' || $duracao <= 0 || $preco <= 0) {
                $erro = 'Preencha nome, duração e preço válidos.';
            } else {
                $servicoModel->cadastrar($nome, $descricao, $duracao, $preco, $_SESSION['usuario_id']);
                $sucesso = 'Serviço cadastrado com sucesso!';
            }
        }
        $servicos = $servicoModel->listar();
        require __DIR__ . '/../Views/servicos.php';
    }
}