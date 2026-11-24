<?php
require_once __DIR__ . '/../Models/Agendamento.php';
class AgendamentoController {
    public function index() {
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: index.php');
            exit;
        }
        $model = new Agendamento();
        $erro = '';
        $sucesso = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $acaoForm = $_POST['acao_form'] ?? 'criar';
            
            if ($acaoForm === 'atualizar_status') {
                $id = (int) ($_POST['id_agendamento'] ?? 0);
                $novoStatus = $_POST['novo_status'] ?? '';
                
                if ($id > 0 && in_array($novoStatus, ['confirmado', 'cancelado', 'concluido'], true)) {
                    $model->atualizarStatus($id, $novoStatus);
                    $sucesso = 'Status do agendamento atualizado!';
                }
            } else {
                $id_cliente = ($_SESSION['usuario_perfil'] === 'cliente')
                    ? $_SESSION['usuario_id']
                    : (int) ($_POST['id_cliente'] ?? 0);

                $id_prestador = (int) ($_POST['id_prestador'] ?? 0);
                $id_servico = (int) ($_POST['id_servico'] ?? 0);
                $data_hora_raw = trim($_POST['data_hora'] ?? '');

                if ($id_cliente <= 0 || $id_prestador <= 0 || $id_servico <= 0 || $data_hora_raw === '') {
                    $erro = 'Preencha todos os campos do agendamento.';
                } else {
                    $data_hora = str_replace('T', ' ', $data_hora_raw) . ':00';
                    if ($model->existeConflito($id_prestador, $data_hora)) {
                        $erro = 'Este prestador já possui um agendamento neste horário.';
                    } else {
                        $model->cadastrar($id_cliente, $id_prestador, $id_servico, $data_hora);
                        $sucesso = 'Agendamento realizado com sucesso!';
                    }
                }
            }
        }
        $agendamentos = $model->listar($_SESSION['usuario_id'], $_SESSION['usuario_perfil']);
        $prestadores = $model->listarPrestadores();
        $clientes = $model->listarClientes();
        $servicos = $model->listarServicos();
    
        require __DIR__ . '/../Views/agendamentos.php';
    }
}