<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamentos - BeautyControl</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Agendamentos</h3>
            <a href="index.php?acao=painel" class="btn btn-secondary">Voltar ao painel</a>
        </div>

        <?php if (!empty($erro)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
        <?php endif; ?>

        <?php if (!empty($sucesso)): ?>
            <div class="alert alert-success"><?= htmlspecialchars($sucesso) ?></div>
        <?php endif; ?>

        <?php if (in_array($_SESSION['usuario_perfil'], ['cliente', 'admin', 'prestador'], true)): ?>
            <div class="card shadow-sm p-4 mb-4">
                <h5 class="mb-3">Novo Agendamento</h5>
                <form method="POST" action="index.php?acao=agendamentos" class="row g-3">
                    <input type="hidden" name="acao_form" value="criar">

                    <?php if ($_SESSION['usuario_perfil'] !== 'cliente'): ?>
                        <div class="col-md-3">
                            <label class="form-label">Cliente</label>
                            <select name="id_cliente" class="form-select" required>
                                <option value="">Selecione...</option>
                                <?php foreach ($clientes as $c): ?>
                                    <option value="<?= (int) $c['id'] ?>"><?= htmlspecialchars($c['nome']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    <?php endif; ?>

                    <div class="col-md-3">
                        <label class="form-label">Serviço</label>
                        <select name="id_servico" class="form-select" required>
                            <option value="">Selecione...</option>
                            <?php foreach ($servicos as $s): ?>
                                <option value="<?= (int) $s['id'] ?>">
                                    <?= htmlspecialchars($s['nome']) ?> (R$ <?= number_format((float) $s['preco'], 2, ',', '.') ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Prestador</label>
                        <select name="id_prestador" class="form-select" required>
                            <option value="">Selecione...</option>
                            <?php foreach ($prestadores as $p): ?>
                                <option value="<?= (int) $p['id'] ?>"><?= htmlspecialchars($p['nome']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Data e Hora</label>
                        <input type="datetime-local" name="data_hora" class="form-control" required>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Agendar horário</button>
                    </div>
                </form>
            </div>
        <?php endif; ?>

        <div class="card shadow-sm p-4">
            <h5 class="mb-3">Horários Marcados</h5>
            <?php if (empty($agendamentos)): ?>
                <p class="text-muted mb-0">Nenhum agendamento encontrado.</p>
            <?php else: ?>
                <table class="table table-striped align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Data/Hora</th>
                            <th>Serviço</th>
                            <th>Cliente</th>
                            <th>Prestador</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($agendamentos as $ag): ?>
                            <tr>
                                <td><?= date('d/m/Y H:i', strtotime($ag['data_hora'])) ?></td>
                                <td><?= htmlspecialchars($ag['servico_nome']) ?></td>
                                <td><?= htmlspecialchars($ag['cliente_nome']) ?></td>
                                <td><?= htmlspecialchars($ag['prestador_nome']) ?></td>
                                <td><span class="badge bg-secondary"><?= htmlspecialchars($ag['status']) ?></span></td>
                                <td>
                                    <?php if ($ag['status'] !== 'cancelado' && $ag['status'] !== 'concluido'): ?>
                                        <form method="POST" action="index.php?acao=agendamentos" class="d-inline">
                                            <input type="hidden" name="acao_form" value="atualizar_status">
                                            <input type="hidden" name="id_agendamento" value="<?= (int) $ag['id'] ?>">
                                            <input type="hidden" name="novo_status" value="cancelado">
                                            <button type="submit" class="btn btn-danger btn-sm">Cancelar</button>
                                        </form>

                                        <?php if ($_SESSION['usuario_perfil'] !== 'cliente'): ?>
                                            <form method="POST" action="index.php?acao=agendamentos" class="d-inline">
                                                <input type="hidden" name="acao_form" value="atualizar_status">
                                                <input type="hidden" name="id_agendamento" value="<?= (int) $ag['id'] ?>">
                                                <input type="hidden" name="novo_status" value="concluido">
                                                <button type="submit" class="btn btn-success btn-sm">Concluir</button>
                                            </form>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>