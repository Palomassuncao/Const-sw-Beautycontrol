<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatórios - BeautyControl</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5 mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Relatórios Gerenciais</h3>
            <a href="index.php?acao=painel" class="btn btn-secondary">Voltar ao painel</a>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="card shadow-sm p-3 text-center">
                    <span class="text-muted">Total de Agendamentos</span>
                    <h3 class="mt-2 mb-0"><?= (int) ($resumo['total_agendamentos'] ?? 0) ?></h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm p-3 text-center">
                    <span class="text-muted">Concluídos</span>
                    <h3 class="mt-2 mb-0 text-success"><?= (int) ($resumo['concluidos'] ?? 0) ?></h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm p-3 text-center">
                    <span class="text-muted">Cancelados</span>
                    <h3 class="mt-2 mb-0 text-danger"><?= (int) ($resumo['cancelados'] ?? 0) ?></h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm p-3 text-center">
                    <span class="text-muted">Faturamento (Concluídos)</span>
                    <h3 class="mt-2 mb-0 text-primary">
                        R$ <?= number_format((float) ($resumo['faturamento_total'] ?? 0), 2, ',', '.') ?>
                    </h3>
                </div>
            </div>
        </div>

        <div class="card shadow-sm p-4 mb-4">
            <h5 class="mb-3">Desempenho por Serviço</h5>
            <?php if (empty($servicos)): ?>
                <p class="text-muted mb-0">Nenhum serviço cadastrado.</p>
            <?php else: ?>
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Serviço</th>
                            <th>Agendamentos</th>
                            <th>Concluídos</th>
                            <th>Faturamento</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($servicos as $s): ?>
                            <tr>
                                <td><?= htmlspecialchars($s['nome']) ?></td>
                                <td><?= (int) $s['total_agendamentos'] ?></td>
                                <td><?= (int) $s['concluidos'] ?></td>
                                <td>R$ <?= number_format((float) $s['faturamento'], 2, ',', '.') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>

        <div class="card shadow-sm p-4">
            <h5 class="mb-3">Desempenho por Prestador</h5>
            <?php if (empty($prestadores)): ?>
                <p class="text-muted mb-0">Nenhum prestador cadastrado.</p>
            <?php else: ?>
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Prestador</th>
                            <th>Agendamentos</th>
                            <th>Concluídos</th>
                            <th>Faturamento Gerado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($prestadores as $p): ?>
                            <tr>
                                <td><?= htmlspecialchars($p['nome']) ?></td>
                                <td><?= (int) $p['total_agendamentos'] ?></td>
                                <td><?= (int) $p['concluidos'] ?></td>
                                <td>R$ <?= number_format((float) $p['faturamento'], 2, ',', '.') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>